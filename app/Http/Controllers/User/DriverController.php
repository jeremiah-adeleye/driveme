<?php

namespace App\Http\Controllers\User;

use App\Driver;
use App\DriverHire;
use App\Http\Controllers\Controller;
use App\Http\Requests\HireDriverRequest;
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
        $pendingRequest = $this->driverService->userPendingEmploymentRequest($id);
        $activeEmployment = $this->driverService->userActiveEmployment($id);

        $data = compact('active', 'driver', 'pendingRequest', 'activeEmployment');
        if ($driver != null) {
            return view('user.driver', $data);
        }else return redirect()->route('user.drivers');
    }

    public function hireDriver($id) {
        $active = 'dashboard.hireDriver';
        $driver = $this->driverService->userGetDriver($id);
        $data = compact('active', 'driver');

        if ($driver != null) {
            $pendingRequest = $this->driverService->userPendingEmploymentRequest($id);
            $activeEmployment = $this->driverService->userActiveEmployment($id);
            if ($pendingRequest || $activeEmployment) return redirect()->route('user.driver', ['id' => $driver->id]);

            return view('user.hire-driver', $data);
        }else return redirect()->route('user.drivers');
    }

    public function hireDriverPayment(HireDriverRequest $request) {
        $hireRequest = $request->only('driver_id', 'type', 'start_date', 'end_date', 'reference');
        $response = $this->driverService->hireDriverPayment($hireRequest);

        if ($response['status']) {
            return redirect()->intended(route('user.driver', ['id' => $hireRequest['driver_id']]))->with('success', $response['message']);
        }else return redirect()->intended(route('user.hire-driver', ['id' => $hireRequest['driver_id']]))->with('error', $response['message']);
    }

    public function viewCart() {
        $user = auth()->user();
        dd($user->cart());
    }

    public function addToCart($driverId) {
        $driver = Driver::find($driverId);

        if ($driver != null) {
            $this->driverService->addToCart($driver);
            return redirect()->intended()->with('success', 'driver added to cart');
        }else return redirect()->route('user.drivers')->with('error', 'Invalid driver id');
    }

    public function removeFromCart($driverId) {
        $driver = Driver::find($driverId);

        if ($driver != null) {
            $this->driverService->removeFromCart($driver);
            return redirect()->intended()->with('success', 'driver removed from cart');
        }else return redirect()->route('user.drivers')->with('error', 'invalid driver id');
    }
}
