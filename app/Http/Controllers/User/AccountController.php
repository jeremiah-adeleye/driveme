<?php

namespace App\Http\Controllers\User;

use App\Customer;
use App\Driver;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserCompleteRegistrationRequest;
use App\Http\Service\CustomerService;
use App\Http\Service\UserService;

class AccountController extends Controller{

    private $userService;
    private $customerService;

    public function __construct(){
        $this->userService = new UserService();
        $this->customerService = new CustomerService();
    }

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
        $customerRequest = $request->only('car_make', 'car_model', 'address', 'working_hour', 'occupation', 'insurance_policy', 'preferred_driving_city', 'driver_class_type');
        $saveCustomer = $this->customerService->saveCustomerDetails($customerRequest);

        if ($saveCustomer) {
            return redirect()->back()->with('success', 'Profile updated successfully');
        }else return redirect()->back()->with('error', 'An error occurred');
    }
}
