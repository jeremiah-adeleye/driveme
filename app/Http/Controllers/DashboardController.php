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
            $data = [
                'user' => $user
            ];

            if ($user->role == 1) {
                return view('user.dashboard', $data);
            }elseif ($user->role == 2) {
                $driver = Driver::where('user_id', $user->id)->get()->first();
                $data['driver'] = $driver;

                return view('driver.dashboard', $data);
            }else {
                return view('admin.dashboard', $data);
            }
        }

        return redirect()->route('login');
    }
}
