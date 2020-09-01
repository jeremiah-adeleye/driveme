<?php

namespace App\Http\Controllers;

use App\Driver;
use App\User;
use Illuminate\Http\Request;

class DashboardController extends Controller{

    public function index() {
        $userId = auth()->id();
        if ($userId != null) {
            $user = User::find($userId);

            if ($user->role == 1) {
                return view('user.home', compact('user'));
            }elseif ($user->role == 2) {
                $driver = Driver::whereUserId(auth()->id())->first();
                return view('driver.dashboard', compact('user', 'driver'));
            }else {
                return view('admin.home', compact('user'));
            }
        }

        return redirect()->route('login');
    }
}
