<?php

namespace App\Http\Controllers\Admin;

use App\DriverHire;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DriverHireController extends Controller{

    public function hireRequest($id) {
        $active = 'dashboard.drivers';
        $hireRequest = DriverHire::find($id);
        if ($hireRequest != null) {
            $user = $hireRequest->user;
            $data = compact('active', 'user', 'hireRequest');

            return view('admin.driver-hire', $data);
        }return redirect()->route('dashboard');
    }
}
