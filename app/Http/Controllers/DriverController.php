<?php

namespace App\Http\Controllers;

use App\Corporate;
use App\Customer;
use App\Driver;
use App\Http\Requests\HireDriverRequest;
use App\Http\Service\DriverService;
use App\Http\Service\PaymentService;
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

        return view('select-hire-type', $data);
    }

    public function list($hireType) {
        $active = 'dashboard.hireDriver';
        $drivers = Driver::with('user')->get();
        $locations = ['ikeja', 'amuwo-odofin', 'lekki', 'oshodi', 'ajah'];
        $data = compact('active', 'drivers', 'locations', 'hireType');

        return view('drivers', $data);
    }

    public function showDriver($hireType, $id) {
        $active = 'dashboard.hireDriver';
        $driver = $this->driverService->userGetDriver($id);
        $pendingRequest = $this->driverService->userPendingEmploymentRequest($id);
        $activeEmployment = $this->driverService->userActiveEmployment($id);
        $inCart = $this->driverService->inCart($id);

        $data = compact('active', 'driver', 'pendingRequest', 'activeEmployment', 'inCart', 'hireType');
        if ($driver != null) {
            return view('driver', $data);
        }else return redirect()->route('user.drivers');
    }

    public function hireDriver($hireType) {
        $active = 'dashboard.hireDriver';
        
        $user = auth()->user();

        if (!$this->verifyRegistration()) {
            return redirect()->route($this->getRedirectUrlOnRegFail())->with('error', 'You need to complete registration');
        }

        $cartItems = $user->cart();
        $driverIds = $cartItems->pluck('driver_id');
        $drivers = Driver::whereIn('id', $driverIds)->get();

        if (sizeof($drivers) % 2 != 0) {
            return redirect()->route('user.drivers')->with('error', 'You must select double the number of drivers you wish to hire');
        }

        $id = 2;
        $driver = $this->driverService->userGetDriver($id);
        $data = compact('active', 'drivers', 'driverIds', 'hireType');

        if ($driver != null) {
            $pendingRequest = $this->driverService->userPendingEmploymentRequest($id);
            $activeEmployment = $this->driverService->userActiveEmployment($id);
            if ($pendingRequest || $activeEmployment) return redirect()->route('user.driver', ['id' => $driver->id]);

            return view('hire-driver', $data);
        }else return redirect()->route('user.drivers', ['hireType' => $hireType]);
    }

    public function hireDriverPayment(HireDriverRequest $request) {
        $hireRequest = $request->only('driver_id', 'type', 'start_date', 'end_date', 'reference');
        $response = $this->driverService->hireDriverPayment($hireRequest);

        if (!$this->verifyRegistration()) {
            return redirect()->route($this->getRedirectUrlOnRegFail())->with('error', 'You need to complete registration');
        }

        if ($response['status']) {
            $hireType = $hireRequest['type'] == 'short_term' ? 'short-term' : 'full-term';
            return redirect()->intended(route('user.drivers', ['hireType' => $hireType]))->with('success', $response['message']);
        }else return redirect()->intended(route('user.hire-driver', ['id' => $hireRequest['driver_id']]))->with('error', $response['message']);
    }

    private function verifyRegistration() {
        $user = auth()->user();
        if ($user->role == 1) {
            $customer = Customer::whereUserId($user->id)->first();
            if ($customer != null) return true;
        }elseif ($user->role == 3) {
            $corporate = Corporate::whereUserId($user->id)->first();
            if ($corporate != null) return true;
        }

        return false;
    }

    private function getRedirectUrlOnRegFail() {
        $user = auth()->user();
        if ($user->role == 1) {
            return 'user.complete-registration';
        }elseif ($user->role == 3) {
            return 'corporate.complete-registration';
        }else return 'login';
    }

    public function viewCart($hireType) {
        $active = 'dashboard.hireDriver';
        $user = auth()->user();
        $cartItems = $user->cart();
        $drivers = Driver::whereIn('id', $cartItems->pluck('driver_id'))->get();
        $data = compact('active', 'drivers', 'hireType');

        return view('cart', $data);
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
