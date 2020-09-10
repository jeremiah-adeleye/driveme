<?php

namespace App\Http\Controllers\Admin;

use App\Driver;
use App\Http\Controllers\Controller;
use App\Http\Requests\ApprovalRejectionRequest;
use App\Http\Service\DriverService;
use Illuminate\Http\Request;

class DriverController extends Controller{

    private $driverService;

    public function __construct(){
        $this->driverService = new DriverService();
    }

    public function view($id) {
        $driver = Driver::find($id);
        $active = 'dashboard.drivers';

        if ($driver != null) {
            $data = compact('driver', 'active');

            return view('admin.driver', $data);
        }else return redirect()->route('dashboard')->with('error', 'Driver not found');
    }

    public function approveDriver($id) {
        $driver = Driver::find($id);

        if ($driver != null) {
            $this->driverService->updateApproval($driver, true);
            return redirect()->intended(route('dashboard'))->with('success', 'Status updated');
        }else return redirect()->intended(route('dashboard'))->with('error', 'Driver not found');
    }

    public function rejectApproval($id, ApprovalRejectionRequest $request) {
        $driver = Driver::find($id);

        if ($driver != null) {
            $this->driverService->updateApproval($driver, false, $request['comment']);
            return redirect()->intended(route('dashboard'))->with('success', 'Status updated');
        }else return redirect()->intended(route('dashboard'))->with('error', 'Driver not found');
    }

    public function revokeApproval($id) {
        $driver = Driver::find($id);

        if ($driver != null) {
            $this->driverService->updateApproval($driver, false);
            return redirect()->intended(route('dashboard'))->with('success', 'Status updated approved');
        }else return redirect()->intended(route('dashboard'))->with('error', 'Driver not found');
    }
}
