<?php

namespace App\Http\Controllers;

use App\Corporate;
use App\Driver;
use App\driving_plans;
use App\Notification;
use App\User;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{

    public function index()
    {
        $userId = auth()->id();

        if ($userId != null) {
            $hireDriver = User::find($userId)->hireVehicleRequests;
            $user = User::find($userId);

            $noHiredVehicle = count($hireDriver);
            $drivingPlans = DB::table('users')
                ->join('active_trainings', 'users.id', '=', 'active_trainings.user_id')
                ->join('driving_plans', 'active_trainings.driving_plans_id', '=', 'driving_plans.id')
                ->select('active_trainings.*', 'driving_plans.*')
                ->get();

           

            $active = 'dashboard.home';
            $data = ['user', 'active', 'noHiredVehicle', 'drivingPlans'];

            if ($user->role == 1) {
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
                array_push($data, 'notifications');

                return view('admin.home', compact($data));
            }
        }

        return redirect()->route('login');
    }
}
