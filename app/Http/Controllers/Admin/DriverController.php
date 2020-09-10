<?php

namespace App\Http\Controllers\Admin;

use App\Driver;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    public function view($id) {
        $driver = Driver::find($id)->get();
        $active = 'dashboard.drivers';

        if ($driver != null) {
            $data = compact('driver', 'active');

            return view('admin.driver', $data);
        }else return redirect()->route('dashboard')->with('error', 'Driver not found');
    }
}
