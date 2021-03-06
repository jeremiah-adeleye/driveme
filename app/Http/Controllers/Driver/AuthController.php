<?php

namespace App\Http\Controllers\Driver;

use App\Driver;
use App\Http\Controllers\Controller;
use App\Http\Requests\DriverRequest;
use App\Http\Requests\DriverUpdateRequest;
use App\Http\Requests\UserRequest;
use App\Http\Service\DriverService;
use App\Http\Service\FileUploadService;
use App\Http\Service\UserService;
use App\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    private $userService;
    private $driverService;
    private $fileUploadService;

    public function __construct(){
        $this->userService = new UserService();
        $this->driverService = new DriverService();
        $this->fileUploadService = new FileUploadService();
    }

    public function register() {
        $title = 'driver.register';
        $data = compact('title');

        return view('driver.register', $data);
    }

    public function login() {
        $title = 'login';
        $data = compact('title');

        return view('login', $data);
    }

    public function createDriver(UserRequest $request) {
        // data coming from the user might be more than but just work with these fields
        $userRequest = $request->only('first_name', 'last_name', 'phone_number', 'email', 'password');
        $userRequest['role'] = 2;
        $user = $this->userService->make($userRequest);

        if ($user) {
            return redirect()->route('login')->with('success', 'Account registered, Please login to complete registration');
        } else return redirect()->back()->with('error', 'An error occurred');
    }

    public function update(DriverUpdateRequest $request) {
        $userRequest = $request->only('first_name', 'last_name', 'phone_number', 'email', 'password');
        $driverRequest = $request->only('location', 'salary_range', 'address', 'licence_number', 'experience', 'vehicle_type', 'passport', 'cv');

        $this->userService->update($userRequest);
        $this->driverService->update($driverRequest);

        return redirect()->route('dashboard')->with('success', 'Account updated');
    }

}
