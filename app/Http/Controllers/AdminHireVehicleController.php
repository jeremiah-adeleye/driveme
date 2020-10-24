<?php

namespace App\Http\Controllers;

use App\hireVehicleRequest;
use App\Vehicle;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;

class AdminHireVehicleController extends Controller
{
    public function hireVehicleRequest($id)
    {
        // check the driver vehicle request for the request id
        //get car details
        // get the person detail
        $active = 'dashboard.drivers'; //set driver tab to active
        $hireRequest = hireVehicleRequest::find($id);

        if ($hireRequest != null) {
            $vehicleId = $hireRequest->vehicle_id;
            $userId = $hireRequest->user_id;
            $user = User::find($userId);
            $vehicle = Vehicle::find($vehicleId);
            $data = compact('active', 'hireRequest', 'vehicle', 'user');

            return view('admin.vehicle-hire', $data);
        }
        return redirect()->route('dashboard');
    }
    public function approveVehicle($id)
    {
        $hireRequest = hireVehicleRequest::find($id);;
        if ($hireRequest != null && $hireRequest->status != 2) {
            $hireRequest->status = 2;
            $hireRequest->save();



            return redirect()->intended(route('admin.hire-request', ['id' => $id]))->with('success', 'Request Approved');
        }


        return redirect()->intended(route('dashboard'))->with('error', 'Invalid request');
    }


    public function rejectApproval($id)
    {
        dd($id);
    }

    public function revokeApproval($id)
    {
        $hireRequest = hireVehicleRequest::find($id);;
        if ($hireRequest != null && $hireRequest->status != 3) {
            $hireRequest->status = 3;
            $hireRequest->save();



            return redirect()->intended(route('admin.hire-request', ['id' => $id]))->with('success', 'Request Declined');
        }


        return redirect()->intended(route('dashboard'))->with('error', 'Invalid request');
    }
}
