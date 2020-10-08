<?php

namespace App\Http\Controllers\User;

use App\Customer;
use App\Driver;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserCompleteRegistrationRequest;
use Illuminate\Http\Request;

class AccountController extends Controller{

    public function completeRegistration() {
        $active = 'dashboard.complete-registration';
        $user = auth()->user();
        $customer = Customer::whereUserId(auth()->id())->first();
        if ($customer == null) $customer = new Customer();

        $driver = new Driver();
        $data = compact('active', 'driver', 'user', 'customer');

        return view('user.complete-registration', $data);
    }

    public function submitCompleteRegistration(UserCompleteRegistrationRequest $request) {
        dd($request);
    }
}
