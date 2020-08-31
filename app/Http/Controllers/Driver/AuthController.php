<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use App\Http\Requests\DriverRequest;
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
        return view('driver.register');
    }

    public function createDriver(DriverRequest $request) {
        $userRequest = $request->only('first_name', 'last_name', 'phone_number', 'email', 'password');
        $userRequest['role'] = 2;
        $driverRequest = $request->only('dob', 'location', 'salary_range', 'address', 'licence_number', 'experience', 'vehicle_type', 'cv', 'passport');
        $user = $this->userService->make($userRequest);

        if ($user) {
            $driverRequest['user_id'] = auth()->id();
            $driver = $this->driverService->make($driverRequest);

            if ($driver) {
                $passport = $request->file('passport');
                $cv = $request->file('cv');
                if ($passport != null) $this->fileUploadService->cloudinaryUpload($passport, $user->id);
                if ($cv != null) $this->fileUploadService->cloudinaryUpload($cv, $user->id);
            }

            return redirect()->route('home')->with('success', 'Account registered, Please await approval');
        } else return redirect()->back()->with('Error', 'An error occurred');
    }
}
