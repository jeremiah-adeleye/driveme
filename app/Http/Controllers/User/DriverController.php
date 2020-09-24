<?php

namespace App\Http\Controllers\User;

use App\Driver;
use App\Http\Controllers\Controller;
use App\Http\Service\DriverService;
use App\User;
use Illuminate\Http\Request;

class DriverController extends Controller
{

    private $driverService;

    public function __construct(){
        $this->driverService = new DriverService();
    }

    public function list() {
        $active = 'dashboard.hireDriver';
        $drivers = Driver::with('user')->get();
        $locations = ['ikeja', 'amuwo-odofin', 'lekki', 'oshodi', 'ajah'];
        $data = compact('active', 'drivers', 'locations');

        return view('user.drivers', $data);
    }

    public function showDriver($id) {
        $active = 'dashboard.hireDriver';
        $driver = $this->driverService->userGetDriver($id);
        $data = compact('active', 'driver');

        if ($driver != null) {
            return view('user.driver', $data);
        }else return redirect()->route('user.drivers');
    }
}
