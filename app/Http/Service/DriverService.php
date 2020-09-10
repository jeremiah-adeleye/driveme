<?php


namespace App\Http\Service;


use App\ApprovalRejectionMessage;
use App\Driver;
use App\Notification;
use App\User;
use Illuminate\Http\Client\Request;

class DriverService{

    private $fileUploadService;
    private $twilioService;

    public function __construct(){
        $this->fileUploadService = new FileUploadService();
        $this->twilioService = new TwilioService();
    }

    public function make(Array $driverRequest) {
        $driver = Driver::create($driverRequest);
        $user = auth()->user();

        try {
            $to = $user->phone_number;
            $this->twilioService->sendMessage($to, 'Account registered, Please await approval');
            $driver = $this->uploadPassportAndCv($driver, $driverRequest);
            $driver->save();

            $notification = new Notification();
            $fullName = ucfirst($user->first_name .' '. $user->last_name);
            $notification->notification = "$fullName has submitted application to be a driver";
            $notification->link = getenv('APP_URL') .'/dashboard/admin/drivers/'.$driver->id;
            $notification->save();

        }catch (\Exception $e) {
            return false;
        }

        return $driver;
    }

    public function resubmitRequest($driverRequest) {
        $user = auth()->user();
        $driver = Driver::whereUserId($user->id)->first();
        $driver->dob = $driverRequest['dob'];
        $driver->approval_status = 1;
        $driver->save();
        $this->updateDetails($driverRequest);

        $fullName = ucfirst($user->first_name .' '. $user->last_name);
        $this->saveNotification(
            "$fullName has re-submitted his/her profile for registration",
            getenv('APP_URL') .'/dashboard/admin/drivers/'.$driver->id
        );
    }

    public function update($driverRequest) {
        $user = auth()->user();
        $userId = $user->id;

        if ($userId) {
            $driver = Driver::whereUserId($userId)->first();
            $this->updateDetails($driverRequest);

            $fullName = ucfirst($user->first_name .' '. $user->last_name);
            $this->saveNotification(
                "$fullName has updated his/her profile",
                getenv('APP_URL') .'/dashboard/admin/drivers/'.$driver->id
            );

            try {
                $driver = $this->uploadPassportAndCv($driver, $driverRequest);
                $driver->save();
            }catch (\Exception $e) {
                return false;
            }

            return $driver;
        }

        return false;
    }

    private function updateDetails($driverRequest) {
        $driver = Driver::whereUserId(auth()->id())->first();
        $driver->location = $driverRequest['location'];
        $driver->salary_range = $driverRequest['salary_range'];
        $driver->address = $driverRequest['address'];
        $driver->licence_number = $driverRequest['licence_number'];
        $driver->experience = $driverRequest['experience'];
        $driver->vehicle_type = $driverRequest['vehicle_type'];
        $driver->save();
    }

    private function saveNotification($message, $link, $userId = 1) {
        $notification = new Notification();

        $notification->notification = $message;
        $notification->link = $link;
        $notification->user_id = $userId;
        $notification->save();
    }

    private function uploadPassportAndCv(Driver $driver, $driverRequest) {

        if (array_key_exists('passport', $driverRequest) && is_file($driverRequest['passport'])) {
            $passportResponse = $this->fileUploadService->cloudinaryUpload($driverRequest['passport']);
            $driver->passport = $passportResponse;
        }

        if (array_key_exists('cv', $driverRequest) && is_file($driverRequest['cv'])) {
            $cvResponse = $this->fileUploadService->cloudinaryUpload($driverRequest['cv']);
            $driver->cv = $cvResponse;
        }

        return $driver;
    }

    public function updateApproval(Driver $driver, $approve, $rejectionMessage = null) {
        $message = $this->getMessage($driver, $approve);
        if ($approve) {
            $driver->approval_status = 2;
        }else {
            if ($driver->approval_status == 1) {
                $driver->approval_status = 3;
            }else {
                $driver->approval_status = 4;
            }
        }

        $driver->save();
        $this->twilioService->sendMessage($driver->user->phone_number, $message);

        if ($rejectionMessage != null) {
            $rejectionComment = new ApprovalRejectionMessage();
            $rejectionComment->message = $rejectionMessage;
            $rejectionComment->driver_id = $driver->id;
            $rejectionComment->save();
        }
    }

    private function getMessage($driver, $approve) {
        if ($approve) {
            if ($driver->approval_status == 1) {
                return 'Your account has been approved';
            }else {
                return 'Your driver privileges have been restored';
            }
        }else {
            if ($driver->approval_status == 1) {
                return 'Your request to become a driver was rejected';
            }else {
                return 'Your driver privileges have been revoked';
            }
        }
    }
}
