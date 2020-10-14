<?php


namespace App\Http\Service;


use App\ApprovalRejectionMessage;
use App\Driver;
use App\DriverCart;
use App\DriverHire;
use App\Guarantor;
use App\Notification;
use App\Transaction;
use App\User;
use Illuminate\Http\Client\Request;

class DriverService{

    private $fileUploadService;
    private $twilioService;
    private $notificationService;
    private $paymentService;

    public function __construct(){
        $this->fileUploadService = new FileUploadService();
        $this->twilioService = new TwilioService();
        $this->notificationService = new NotificationService();
        $this->paymentService = new PaymentService();
    }

    public function userGetDriver($id) {
        $driver = Driver::find($id);
        if ($driver != null) {
            $driver->user;
            return $driver;
        }else return null;
    }

    public function make(Array $driverRequest, $guarantorRequest) {
        $driver = Driver::create($driverRequest);
        $user = auth()->user();

        try {
            $to = $user->phone_number;
            $this->twilioService->sendMessage($to, "Dear candidate, \n\nCongratulations, your application is successful and a customer care representative would reach out to you shortly");
            $driver = $this->uploadPassportAndCv($driver, $driverRequest);
            $driver->save();
        }catch (\Exception $e) {
        }

        $fullName = ucfirst($user->first_name .' '. $user->last_name);
        $notification = "$fullName has submitted application to be a driver";
        $link = route('admin.driver', ['id' => $driver->id]);
        $this->notificationService->newNotification($notification, $link);
        $this->saveGuarantor(new Guarantor(), $guarantorRequest, $driver->id);

        return $driver;
    }

    public function resubmitRequest($driverRequest, $guarantor_request) {
        $user = auth()->user();
        $driver = Driver::whereUserId($user->id)->first();
        $driver->approval_status = 1;
        $driver->save();
        $this->updateDetails($driverRequest);
        $driver = $this->uploadPassportAndCv($driver, $driverRequest);
        $this->saveGuarantor($driver->guarantor, $guarantor_request, $driver->id);

        $fullName = ucfirst($user->first_name .' '. $user->last_name);
        $this->notificationService->newNotification(
            "$fullName has re-submitted his/her profile for registration",
            route('admin.driver', ['id' => $driver->id])
        );
    }

    public function update($driverRequest) {
        $user = auth()->user();
        $userId = $user->id;

        if ($userId) {
            $driver = Driver::whereUserId($userId)->first();
            $this->updateDetails($driverRequest);

            $fullName = ucfirst($user->first_name .' '. $user->last_name);
            $this->notificationService->newNotification(
                "$fullName has updated his/her profile",
                route('admin.driver', ['id' => $driver->id])
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
        $driver->state = $driverRequest['state'];
        $driver->address = $driverRequest['address'];
        $driver->licence_number = $driverRequest['licence_number'];
        $driver->experience = $driverRequest['experience'];
        $driver->vehicle_type = $driverRequest['vehicle_type'];
        $driver->dob = $driverRequest['dob'];
        $driver->save();
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

        $driver->save();
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
                return "Dear candidate, \n\nCongratulations, your on-board process is successful. \n\nYou will be merged with a client as soon as possible. \n\nWelcome to DriveMe fleet services";
            }else {
                return "Your driver privileges have been restored";
            }
        }else {
            if ($driver->approval_status == 1) {
                return "Your request to become a driver was rejected";
            }else {
                return "Your driver privileges have been revoked";
            }
        }
    }

    private function saveGuarantor($guarantor, $guarantorRequest, $driverId){
        $guarantor->name = $guarantorRequest['guarantor_name'];
        $guarantor->email = $guarantorRequest['guarantor_email'];
        $guarantor->phone_number = $guarantorRequest['guarantor_phone_number'];
        $guarantor->relationship = $guarantorRequest['guarantor_relationship'];
        $guarantor->occupation = $guarantorRequest['guarantor_occupation'];
        $guarantor->residential_address = $guarantorRequest['guarantor_residential_address'];
        $guarantor->state_of_residence = $guarantorRequest['guarantor_state_of_residence'];
        $guarantor->work_address = $guarantorRequest['guarantor_work_address'];
        $guarantor->driver_id = $driverId;
        $guarantor->save();

        try {
            if (array_key_exists('guarantor_passport', $guarantorRequest) && is_file($guarantorRequest['guarantor_passport'])) {
                $passportResponse = $this->fileUploadService->cloudinaryUpload($guarantorRequest['guarantor_passport']);
                $guarantor->passport = $passportResponse;
                $guarantor->save();
            }
        }catch (\Exception $e) {
        }
    }

    public function hireDriverPayment($hireRequest) {
        $hireRequest['user_id'] = auth()->id();

        if (!$this->paymentService->validateTransaction($hireRequest['reference'])) {
            return [
                'status' => false,
                'message' => 'Invalid reference number'
            ];
        }

        $paystackResponse = $this->paymentService->getTransactionDetails($hireRequest['reference']);
        if ($paystackResponse) {
            if ($paystackResponse['status']) {
                $data = $paystackResponse['data'];
                if ($data['status'] == 'success') {
                    $this->saveDriverHire($hireRequest);
                    return [
                        'status' => true,
                        'message' => 'Payment successful'
                    ];
                }else $message = $data['gateway_response'];
            }else $message = $paystackResponse['message'];
        }else $message = 'An error occurred';

        $this->paymentService->updateTransaction($hireRequest['reference'], false);
        return [
            'status' => false,
            'message' => $message
        ];
    }

    private function saveDriverHire($hireRequest){
        $driverIds = explode(',', $hireRequest['driver_id']);
        $drivers = Driver::whereIn('id', $driverIds)->get();

        unset($hireRequest['driver_id']);
        $user = auth()->user();

        if ($drivers != null  && $user) {
            $driverHire = DriverHire::make($hireRequest);
            $driverHire->save();

            foreach ($drivers as $driver) {
                $driverHire->drivers()->attach($driver);
            }

            $driverHire->save();
            $notification = ucfirst($user->first_name. ' '. $user->last_name). ' has requested to Hire driver(s)';
            $link = route('admin.hire-request', ['id' => $driverHire->id]);

            $this->notificationService->newNotification($notification, $link);
            $this->paymentService->updateTransaction($hireRequest['reference'], true);
        }

        $user->cart()->delete();
        $user->save();
    }

    public function userActiveEmployment($driverId) {
        $driver = Driver::find($driverId);

        if ($driver != null) {
            $hireDriver = $driver->hires()->where([['active', true], ['approved', true], ['user_id', auth()->id()]])->first();
            if ($hireDriver == null) {
                return false;
            }else return true;
        }else return false;
    }

    public function userPendingEmploymentRequest($driverId) {
        $driver = Driver::find($driverId);

        if ($driver != null) {
            $hireDriver = $driver->hires()->where([['approved', false], ['user_id', auth()->id()]])->first();
            if ($hireDriver == null) {
                return false;
            }else return true;
        }else return false;
    }

    public function inCart($id){
        $user = auth()->user();

        if ($user != null) {
            $inCart = $user->cart()->where('driver_id', $id)->first();
            if ($inCart == null) {
                return false;
            }else return true;
        }else return false;
    }

    public function addToCart(Driver $driver){
        $user = auth()->user();
        if ($user != null) {
            $driverCartItem = DriverCart::where([['user_id', $user->id], ['driver_id', $driver->id]])->first();
            if ($driverCartItem == null) {
                $driverCartItem = DriverCart::make(['user_id' => $user->id, 'driver_id' => $driver->id]);
                $driverCartItem->save();
            }
        }
    }

    public function removeFromCart(Driver $driver){
        $user = auth()->user();
        $driverCartItem = DriverCart::where([['user_id', $user->id], ['driver_id', $driver->id]])->first();

        if ($driverCartItem != null) {
            try {
                $driverCartItem->delete();
            } catch (\Exception $e) {
            }
        }
    }
}
