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
            $user = $hireRequest->user;
            $data = compact('active', 'user', 'hireRequest');

            return view('admin.driver-hire', $data);
        }return redirect()->route('dashboard');
    }

    public function approveRequest($id) {
        $hireRequest = DriverHire::find($id);
        if ($hireRequest) {
            if (!$hireRequest->approved) {
                $hireRequest->approved = true;
                $hireRequest->active = true;
                $hireRequest->save();
            }

            return redirect()->intended(route('admin.hire-request', ['id' => $id]))->with('success', 'Request Approved');
        }else return redirect()->intended(route('dashboard'))->with('error', 'Invalid request');
    }

    public function declineRequest($id) {
        dd($id);
        $hireRequest = DriverHire::find($id);
        if ($hireRequest) {
            if (!$hireRequest->approved) {
                $hireRequest->approved = true;
                $hireRequest->active = false;
                $hireRequest->save();
            }

            return redirect()->intended(route('admin.hire-request', ['id' => $id]))->with('success', 'Request Declined');
        }else return redirect()->intended(route('dashboard'))->with('error', 'Invalid request');
    }

    public function terminateEmployment($id) {
        $hireRequest = DriverHire::find($id);
        if ($hireRequest) {
            if ($hireRequest->approved && $hireRequest->active) {
                $hireRequest->active = false;
                $hireRequest->save();
            }

            return redirect()->intended(route('admin.hire-request', ['id' => $id]))->with('success', 'Request Approved');
        }else return redirect()->intended(route('dashboard'))->with('error', 'Invalid request');
    }
}
