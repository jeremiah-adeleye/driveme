<?php

namespace App\Http\Controllers\Admin;

use App\DriverHire;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DriverHireController extends Controller{

    public function hireRequest($id) {
        $active = 'dashboard.drivers';
        $hireRequest = DriverHire::find($id);
        if ($hireRequest != null) {
            $drivers = $hireRequest->drivers;
            $data = compact('active', 'drivers', 'hireRequest');

            return view('admin.driver-hire', $data);
        }return redirect()->route('dashboard');
    }

    public function approveRequest($id, $driverId) {
        $hireRequest = DriverHire::find($id);
        $hireRequestDriver = $hireRequest->drivers->where('id', $driverId);

        if ($hireRequest != null) {
            if (!$hireRequestDriver->approved) {
                $hireRequestDriver->approved = true;
                $hireRequestDriver->active = true;
                $hireRequestDriver->save();

                return redirect()->intended(route('admin.hire-request', ['id' => $id]))->with('success', 'Request Approved');
            }
        }

        return redirect()->intended(route('dashboard'))->with('error', 'Invalid request');
    }

    public function declineRequest($id, $driverId) {
        $hireRequest = DriverHire::find($id);

        if ($hireRequest != null) {
            $hireRequestDriver = $hireRequest->drivers->where('id', $driverId);

            if ($hireRequestDriver != null && !$hireRequestDriver->approved) {
                $hireRequestDriver->approved = true;
                $hireRequestDriver->active = false;
                $hireRequestDriver->save();

                return redirect()->intended(route('admin.hire-request', ['id' => $id]))->with('success', 'Request Declined');
            }
        }

        return redirect()->intended(route('dashboard'))->with('error', 'Invalid request');
    }

    public function terminateEmployment($id, $driverId) {
        $hireRequest = DriverHire::find($id);

        if ($hireRequest != null) {
            $hireRequestDriver = $hireRequest->drivers->where('id', $driverId);

            if ($hireRequestDriver != null && !$hireRequestDriver->approved && $hireRequest->active) {
                $hireRequestDriver->active = false;
                $hireRequestDriver->save();

                return redirect()->intended(route('admin.hire-request', ['id' => $id]))->with('success', 'Employment terminated');
            }
        }

        return redirect()->intended(route('dashboard'))->with('error', 'Invalid request');
    }
}
