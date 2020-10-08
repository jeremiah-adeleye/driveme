<?php

namespace App\Http\Controllers\Corporate;

use App\Corporate;
use App\Http\Controllers\Controller;
use App\Http\Requests\CorporateCompleteRegistrationRequset;
use Illuminate\Http\Request;

class AccountController extends Controller{

    public function completeRegistration() {
        $active = 'dashboard.complete-registration';
        $user = auth()->user();
        $corporate = Corporate::whereUserId(auth()->id())->first();
        if ($corporate == null) $corporate = new Corporate();
        $data = compact('active', 'user', 'corporate');

        return view('corporate.complete-registration', $data);
    }

    public function submitCompleteRegistration(CorporateCompleteRegistrationRequset $request) {

    }
}
