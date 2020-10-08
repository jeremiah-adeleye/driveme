<?php


namespace App\Http\Service;


use App\Corporate;

class CorporateService{

    private $notificationService;
    private $twilioService;

    public function __construct(){
        $this->notificationService = new NotificationService();
        $this->twilioService = new TwilioService();
    }

    public function saveCorporateDetails($customerRequest) {
        $user = auth()->user();
        $new = false;
        $corporate = Corporate::whereUserId($user->id)->first();

        if ($corporate == null) {
            $new = true;
            $corporate = $this->createNewCorporate();
        }else if ($corporate->approved != 2) return false;

        $corporate->name = $customerRequest['company_name'];
        $corporate->registration_number = $customerRequest['registration_number'];
        $corporate->address = $customerRequest['address'];
        $corporate->approved = 0;

        $corporate->save();
        $this->notifyAdmin($corporate, $new);

        return true;
    }

    public function createNewCorporate() {
        $user = auth()->user();
        $corporate = new Corporate();
        $corporate->user_id = $user->id;

        return $corporate;
    }

    public function notifyAdmin(Corporate $corporate, bool $new = true) {
        $message = $new ? $corporate->name .' has submitted application for corporate approval' : $corporate->name .' has re-submitted application for corporate approval';
        $link = env('APP_URL').'/dashboard/admin/corporate/'.$corporate->id;

        $this->notificationService->newNotification($message, $link);
    }

    public function updateApproval(Corporate $corporate, bool $approve){
        if ($approve) {
            $corporate->approved = 1;
            $this->twilioService->sendMessage($corporate->user->phone_number, "Account approved");
        }else {
            if ($corporate->approved == 0) {
                $corporate->approved = 2;
                $this->twilioService->sendMessage($corporate->user->phone_number, "Approval request rejected");
            }else {
                $corporate->approved = 3;
                $this->twilioService->sendMessage($corporate->user->phone_number, "Account approval has been revoked");
            }
        }

        $corporate->save();
    }
}
