<?php

namespace App\Http\Controllers;

use App\ActiveTraining;
use App\Corporate;
use App\Driver;
use App\DriverHireDrivers;
use App\driving_plans;
use App\hireVehicleRequest;
use App\Http\Requests\HireDriverRequest;
use App\Notification;
use App\User;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{

    public function index()
    {
        // get user id
        $userId = auth()->id();

        if ($userId != null) {

            // check if the user exist if yes check the vehicle user has applied for

            $vehicleHired = ['id' => 1];
            // hireVehicleRequest::where([['user_id', '=', $userId], ['status', '=', '2']])->get();



            //get user data


            $user = User::find($userId);

            // count the numbers of vehicles approved for hiring
            $noHiredVehicle = count($vehicleHired);

            // check the highest plan user subscribed to

            $checkPlans = ActiveTraining::where('user_id', $userId)->orderBy('driving_plans_id', 'desc')->first();
            $completedTest = $checkPlans ? $checkPlans->completed_test : '';
            $completedVideos = $checkPlans ? $checkPlans->completed_videos : '';
            //if user has plan get the plan if not return empty array
            $drivingPlans = $checkPlans ?
                driving_plans::find($checkPlans->driving_plans_id)
                : '';


            // getting the numbers of driver hired by this user


            $hiredDrivers = DriverHireDrivers::where([['driver_hire_id', '=', $userId], ['active', '=', '1']])->get();

            // count the numbers of vehicles approved for hiring
            $noHiredDriver = count($hiredDrivers);


            $active = 'dashboard.home';
            $data = ['user', 'active', 'noHiredVehicle', 'drivingPlans', 'completedVideos', 'completedTest', 'noHiredDriver'];

            if ($user->role == 1) {

                // user with role 1 is a normal user
                // role 2 is a driver
                // role 3 is a coporate or company account
                // role 4 is an admin

                return view('user.home', compact($data));
            } elseif ($user->role == 2) {
                $driver = Driver::whereUserId(auth()->id())->first();
                $registrationComplete = true;
                if ($driver == null) {
                    $driver = new Driver();
                    $registrationComplete = false;
                }

                $percentDone = 25;
                if ($driver->approval_status != null) {
                    switch ($driver->approval_status) {
                        case 1:
                            $percentDone = 75;
                            break;
                        case 2:
                            $percentDone = 100;
                            break;
                        case 3:
                            $percentDone = 50;
                            break;
                    }
                }

                array_push($data, 'driver', 'registrationComplete', 'percentDone');

                return view('driver.home', compact($data));
            } elseif ($user->role == 3) {
                $corporate = Corporate::whereUserId($userId);
                if ($corporate == null) $corporate = new Corporate();

                array_push($data, 'corporate');

                return view('corporate.home', compact($data));
            } else {
                $notifications = Notification::whereSeen(false)->orderBy('created_at', 'desc')->get();
                $allUser = DB::table('users')
                    ->orderBy('id')
                    ->get();
                $allDriver = DB::table('drivers')->orderBy('id')
                    ->get();
                $hiredDrivers = DB::table('driver_hire_drivers')->where('active', 1)->orderBy('id')->get();
                $fullTimeDriversRequest = DB::table('driver_hires')->where('type', 'full_time')->orderBy('id')->get();
                $shortTimeDriversRequest = DB::table('driver_hires')->where('type', 'short_time')->orderBy('id')->get();
                array_push($data, 'notifications', 'allUser', 'allDriver', 'hiredDrivers', 'fullTimeDriversRequest', 'shortTimeDriversRequest');

                return view('admin.home', compact($data));
            }
        }

        return redirect()->route('login');
    }
}
