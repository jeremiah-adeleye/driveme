<?php

namespace App\Http\Controllers\Corporate;

use App\Corporate;
use App\Http\Controllers\Controller;
use App\Http\Requests\CorporateCompleteRegistrationRequset;
use App\Http\Service\CorporateService;
use Illuminate\Http\Request;

class AccountController extends Controller{

    private $corporateService;

    public function __construct(){
        $this->corporateService = new CorporateService();
    }

    public function completeRegistration() {
        $active = 'dashboard.complete-registration';
        $user = auth()->user();
        $corporate = Corporate::whereUserId(auth()->id())->first();
        if ($corporate == null) $corporate = new Corporate();
        $data = compact('active', 'user', 'corporate');

        return view('corporate.complete-registration', $data);
    }

    public function submitCompleteRegistration(CorporateCompleteRegistrationRequset $request) {
        $corporateRequest = $request->only('company_name', 'registration_number', 'address');
        $saveCorporate = $this->corporateService->saveCorporateDetails($corporateRequest);

        if ($saveCorporate) {
            return redirect()->back()->with('success', 'Profile updated successfully');
        }else return redirect()->back()->with('error', 'An error occurred');
    }
}
