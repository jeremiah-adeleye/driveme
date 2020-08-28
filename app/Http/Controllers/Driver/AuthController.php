<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use App\Http\Requests\DriverRequest;
use App\Http\Service\DriverService;
use App\Http\Service\UserService;
use App\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    private $userService;
    private $driverService;

    public function __construct(){
        $this->userService = new UserService();
        $this->driverService = new DriverService();
    }

    public function register() {
        return view('driver_register');
    }

    public function createDriver(DriverRequest $request) {
        $userRequest = $request->only('first_name', 'last_name', 'phone_number', 'email', 'password');
        $userRequest['role'] = 2;
        $driverRequest = $request->only('dob', 'location', 'salary_range', 'address', 'licence_number', 'experience', 'vehicle_type', 'cv', 'passport');

        if ($this->userService->make($userRequest)) {
            $driverRequest['user_id'] = auth()->id();
            $this->driverService->make($driverRequest);
        }

        dd($userRequest, $driverRequest);
    }
}
