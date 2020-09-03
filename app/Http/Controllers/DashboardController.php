<?php

namespace App\Http\Controllers;

use App\Driver;
use App\User;

class DashboardController extends Controller{

    public function index() {
        $userId = auth()->id();

        if ($userId != null) {
            $user = User::find($userId);
            $active = 'dashboard.home';

            if ($user->role == 1) {
                return view('user.home', compact('user', 'active'));
            }elseif ($user->role == 2) {
                $driver = Driver::whereUserId(auth()->id())->first();
                return view('driver.dashboard', compact('user', 'driver', 'active'));
            }else {
                return view('admin.home', compact('user', 'active'));
            }
        }

        return redirect()->route('login');
    }
}
