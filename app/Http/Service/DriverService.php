<?php


namespace App\Http\Service;


use App\Driver;
use App\User;

class DriverService{

    public function make($driverRequest) {
        $driver = Driver::create($driverRequest);
    }
}
