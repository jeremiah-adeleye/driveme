<?php

namespace App\Http\Controllers\Driver;

use App\Driver;
use App\Http\Controllers\Controller;
use App\Http\Requests\DriverRequest;
use App\Http\Service\DriverService;
use App\Http\Service\FileUploadService;
use App\Http\Service\UserService;
use Illuminate\Http\Request;

class RegistrationController extends Controller{

    private $userService;
    private $driverService;

    public function __construct(){
        $this->userService = new UserService();
        $this->driverService = new DriverService();
    }

    public function completeRegistration() {
        $user = auth()->user();
        $active = 'dashboard.home';
        $data = compact('user', 'active');

        return view('driver.complete-registration', $data);
    }

    public function submitRegistration(DriverRequest $request) {
        $user = auth()->user();
        if ($user-> role == 2) {
            $driver = Driver::whereUserId($user->id)->first();
            if ($driver == null) {

                $driverRequest = $request->only('dob', 'location', 'salary_range', 'address', 'licence_number', 'experience', 'vehicle_type', 'cv', 'passport');
                $driverRequest['user_id'] = auth()->id();
                $this->driverService->make($driverRequest);

                return redirect()->route('dashboard')->with('success', 'Registration complete, Please await approval');
            } else return redirect()->route('dashboard')->with('error', 'Registration completed already');

        }else return response()->view('errors.403');
    }

    public function resubmitRegistration(DriverRequest $request) {
        $user = auth()->user();
        if ($user-> role == 2) {
            $driver = Driver::whereUserId($user->id)->first();
            if ($driver != null) {
                $userRequest = $request->only('first_name', 'last_name', 'phone_number', 'email', 'password');
                $driverRequest = $request->only('dob', 'location', 'salary_range', 'address', 'licence_number', 'experience', 'vehicle_type', 'cv', 'passport');
                $driverRequest['user_id'] = auth()->id();
                $this->driverService->resubmitRequest($driverRequest);
                $this->userService->update($userRequest, true);

                return redirect()->route('dashboard')->with('success', 'Request re-submitted, Please await approval');
            } else return redirect()->route('dashboard')->with('error', 'An error occurred');

        }else return response()->view('errors.403');
    }
}
