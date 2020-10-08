<?php

namespace App\Http\Controllers\User;

use App\Driver;
use App\DriverHire;
use App\Http\Controllers\Controller;
use App\Http\Requests\HireDriverRequest;
use App\Http\Service\DriverService;
use App\Http\Service\PaymentService;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

class DriverController extends Controller
{

    private $driverService;
    private $paymentService;

    public function __construct(){
        $this->driverService = new DriverService();
        $this->paymentService = new PaymentService();
    }

    public function selectHireType() {
        $active = 'dashboard.hireDriver';
        $data = compact('active');

        return view('user.select-hire-type', $data);
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
        $inCart = $this->driverService->inCart($id);

        $data = compact('active', 'driver', 'pendingRequest', 'activeEmployment', 'inCart');
        if ($driver != null) {
            return view('user.driver', $data);
        }else return redirect()->route('user.drivers');
    }

    public function hireDriver() {
        $active = 'dashboard.hireDriver';
        $user = auth()->user();
        $cartItems = $user->cart();
        $driverIds = $cartItems->pluck('driver_id');
        $drivers = Driver::whereIn('id', $driverIds)->get();
        if (sizeof($drivers) % 2 != 0) {
            return redirect()->route('user.drivers')->with('error', 'You must select double the number of drivers you wish to hire');
        }

        $id = 2;
        $driver = $this->driverService->userGetDriver($id);
        $data = compact('active', 'drivers', 'driverIds');

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
            return redirect()->intended(route('user.drivers'))->with('success', $response['message']);
        }else return redirect()->intended(route('user.hire-driver', ['id' => $hireRequest['driver_id']]))->with('error', $response['message']);
    }

    public function viewCart() {
        $active = 'dashboard.hireDriver';
        $user = auth()->user();
        $cartItems = $user->cart();
        $drivers = Driver::whereIn('id', $cartItems->pluck('driver_id'))->get();
        $data = compact('active', 'drivers');

        return view('user.cart', $data);
    }

    public function addToCart($id) {
        $driver = Driver::find($id);

        if ($driver != null) {
            $this->driverService->addToCart($driver);
            return redirect()->back()->with('success', 'driver added to cart');
        }else return redirect()->route('user.drivers')->with('error', 'Invalid driver id');
    }

    public function removeFromCart($id) {
        $driver = Driver::find($id);

        if ($driver != null) {
            $this->driverService->removeFromCart($driver);
            return redirect()->back()->with('success', 'driver removed from cart');
        }else return redirect()->route('user.drivers')->with('error', 'invalid driver id');
    }

    public function getHireDriverReference(Request $request) {
        $data = $request->only('start_date', 'end_date', 'type', 'user_id', 'driver_id');

        if ($request->has('start_date') && $data['start_date'] != null) {
            $startDate = Date::parse($data['start_date']);
            if ($startDate <= Date::now()) {
                return response('Bad request', 400);
            }else {
                $data['start_date'] = $startDate;
                if ($data['type'] == 'short_term') {
                    if ($request->has('end_date') && $data['end_date'] != null) {
                        $endDate = Date::parse($data['end_date']);
                        if ($endDate <= $startDate) {
                            return response('Bad request', 400);
                        }else $data['end_date'] = $endDate;
                    }else return response('Bad request', 400);
                }
            }
        }else return response('Bad request', 400);

        $reference = $this->paymentService->initHireRequestPayment($data);
        if ($reference != null) {
            return response()->json($reference);
        }else return response('Error occurred',500);
    }
}
