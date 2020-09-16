<?php

namespace App\Http\Controllers;

use App\Driver;
use App\Notification;
use App\User;

class DashboardController extends Controller{

    public function index() {
        $userId = auth()->id();

        if ($userId != null) {
            $user = User::find($userId);
            $active = 'dashboard.home';
            $data = ['user', 'active'];

            if ($user->role == 1) {
                return view('user.home', compact($data));
            }elseif ($user->role == 2) {
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
            }else {
                $notifications = Notification::whereSeen(false)->orderBy('created_at', 'desc')->get();
                array_push($data, 'notifications');

                return view('admin.home', compact($data));
            }
        }

        return redirect()->route('login');
    }
}
