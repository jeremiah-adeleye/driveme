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
        $driver = Driver::whereUserId($user->id)->first();
        if ($driver == null) $driver = new Driver();
        $data = compact('user', 'active', 'driver');

        return view('driver.complete-registration', $data);
    }

    public function submitRegistration(DriverRequest $request) {
        $driverRequest = $request->only('dob', 'state', 'salary_range', 'address', 'licence_number', 'experience', 'vehicle_type', 'cv', 'passport');
        $guarantor_request = $request->only('guarantor_name', 'guarantor_email', 'guarantor_phone_number', 'guarantor_relationship', 'guarantor_occupation', 'guarantor_residential_address', 'guarantor_state_of_residence', 'guarantor_work_address', 'guarantor_passport');

        $user = auth()->user();
        if ($user-> role == 2) {
            $driver = Driver::whereUserId($user->id)->first();
            if ($driver == null) {
                $driverRequest['user_id'] = auth()->id();
                $this->driverService->make($driverRequest, $guarantor_request);

                return redirect()->route('dashboard')->with('success', 'Registration complete, Please await approval');
            } else return redirect()->route('dashboard')->with('error', 'Registration completed already');

        }else return response()->view('errors.403');
    }

    public function resubmitRegistration(DriverRequest $request) {
        $user = auth()->user();
        if ($user-> role == 2) {
            $driver = Driver::whereUserId($user->id)->first();
            if ($driver != null && $driver->approval_status == 3) {
                if (!($request->has('passport'))) $request['passport'] = $request->get('old_passport');
                if (!($request->has('cv'))) $request['cv'] = $request->get('old_cv');
                if (!($request->has('guarantor_passport'))) $request['guarantor_passport'] = $request->get('old_guarantor_passport');

                $driverRequest = $request->only('dob', 'state', 'salary_range', 'address', 'licence_number', 'experience', 'vehicle_type', 'cv', 'passport');
                $guarantor_request = $request->only('guarantor_name', 'guarantor_email', 'guarantor_phone_number', 'guarantor_relationship', 'guarantor_occupation', 'guarantor_residential_address', 'guarantor_state_of_residence', 'guarantor_work_address', 'guarantor_passport');

                $driverRequest['user_id'] = auth()->id();
                $this->driverService->resubmitRequest($driverRequest, $guarantor_request);

                return redirect()->route('dashboard')->with('success', 'Request re-submitted, Please await approval');
            } else return redirect()->route('dashboard')->with('error', 'An error occurred');

        }else return response()->view('errors.403');
    }
}
