<?php


namespace App\Http\Service;


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
            $notification->link = getenv('APP_URL') .'/dashboard/drivers/'.$driver->id;
            $notification->save();

        }catch (\Exception $e) {
            return false;
        }

        return $driver;
    }

    public function update($driverRequest) {
        $user = auth()->user();
        $userId = $user->id;

        if ($userId) {
            $driver = Driver::whereUserId($userId)->first();
            $driver->location = $driverRequest['location'];
            $driver->salary_range = $driverRequest['salary_range'];
            $driver->address = $driverRequest['address'];
            $driver->licence_number = $driverRequest['licence_number'];
            $driver->experience = $driverRequest['experience'];
            $driver->vehicle_type = $driverRequest['vehicle_type'];
            $driver->save();

            $notification = new Notification();
            $fullName = ucfirst($user->first_name .' '. $user->last_name);
            $notification->notification = "$fullName has updated his/her profile";
            $notification->link = getenv('APP_URL') .'/dashboard/admin/drivers/'.$driver->id;
            $notification->save();

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
}
