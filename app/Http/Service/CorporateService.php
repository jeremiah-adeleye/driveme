<?php


namespace App\Http\Service;


use App\Corporate;

class CorporateService{

    public function saveCorporateDetails($customerRequest) {
        $user = auth()->user();
        $corporate = Corporate::whereUserId($user->id)->first();
        if ($corporate == null) {
            $corporate = $this->createNewCorporate();
        }else if ($corporate->approved == 0 || $corporate->approved == 3) return false;

        $corporate->name = $customerRequest['company_name'];
        $corporate->registration_number = $customerRequest['registration_number'];
        $corporate->address = $customerRequest['address'];

        $corporate->save();
        return true;
    }

    public function createNewCorporate() {
        $user = auth()->user();
        $corporate = new Corporate();
        $corporate->user_id = $user->id;

        return $corporate;
    }
}
