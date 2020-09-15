<?php

namespace App\Http\Controllers\Driver;

use App\Driver;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RegistrationController extends Controller{

    public function completeRegistration() {
        $user = auth()->user();
        $active = 'dashboard.home';
        $data = compact('user', 'active');

        return view('driver.complete-registration', $data);
    }
}
