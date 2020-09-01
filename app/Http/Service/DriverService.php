<?php


namespace App\Http\Service;


use App\Driver;
use App\User;

class DriverService{

    private $fileUploadService;

    public function __construct(){
        $this->fileUploadService = new FileUploadService();
    }

    public function make(Array $driverRequest) {
        $driver = Driver::create($driverRequest);
        $passportReq = $driverRequest['passport'];
        $cvReq = $driverRequest['cv'];

        if ($passportReq != null) {
            $passportResponse = $this->fileUploadService->cloudinaryUpload($passportReq);
            $driver->passport = $passportResponse->getRealPath();
        }

        if ($cvReq != null) {
            $cvResponse = $this->fileUploadService->cloudinaryUpload($cvReq);
            $driver->cv = $cvResponse->getRealPath();
        }

        $driver->save();
        return $driver;
    }

    public function update($driverRequest) {
        $userId = auth()->id();
        if ($userId) {
            $driver = Driver::whereUserId($userId)->first();
            $driver->dob = $driverRequest['dob'];
            $driver->location = $driverRequest['location'];
            $driver->salary_range = $driverRequest['salary_range'];
            $driver->address = $driverRequest['address'];
            $driver->licence_number = $driverRequest['licence_number'];
            $driver->experience = $driverRequest['experience'];
            $driver->vehicle_type = $driverRequest['vehicle_type'];

            $driver->save();

            if (array_key_exists('passport', $driverRequest) && is_file($driverRequest['passport'])) {
                $passportResponse = $this->fileUploadService->cloudinaryUpload($driverRequest['passport']);
                $driver->passport = $passportResponse;
            }

            if (array_key_exists('cv', $driverRequest) && is_file($driverRequest['cv'])) {
                $cvResponse = $this->fileUploadService->cloudinaryUpload($driverRequest['cv']);
                $driver->cv = $cvResponse;
            }

            $driver->save();
        }
    }
}
