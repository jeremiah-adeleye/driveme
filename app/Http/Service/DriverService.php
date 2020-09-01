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

        try {
            $driver = $this->uploadPassportAndCv($driver, $driverRequest);
            $driver->save();
        }catch (\Exception $e) {
            return false;
        }

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

            try {
                $driver = $this->uploadPassportAndCv($driver, $driverRequest);
                $driver->save();
            }catch (\Exception $e) {
                return false;
            }

            return $driver;
        }
    }

    private function uploadPassportAndCv(Driver $driver, $driverRequest) {
        if (array_key_exists('passport', $driverRequest) && is_file($driverRequest['passport'])) {
            $passportResponse = $this->fileUploadService->cloudinaryUpload($driverRequest['passport']);
            $driver->passport = $passportResponse;
        }

        if (array_key_exists('cv', $driverRequest) && is_file($driverRequest['cv'])) {
            $cvResponse = $this->fileUploadService->cloudinaryUpload($driverRequest['cv']);
            $driver->cv = $cvResponse;
        }

        return $driver;
    }
}
