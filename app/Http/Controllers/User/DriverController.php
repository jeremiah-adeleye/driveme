<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DriverController extends Controller
{

    public function list() {
        $active = 'dashboard.hireDriver';
        $data = compact('active');

        return view('user.drivers', $data);
    }
}
