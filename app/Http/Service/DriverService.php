<?php


namespace App\Http\Service;


use App\Driver;
use App\User;

class DriverService{

    public function make($driverRequest) {
        return $driver = Driver::create($driverRequest);
    }
}
