<?php

namespace App\Http\Controllers\Vehicle;

use App\AllTransaction;
use App\hireVehicleRequest;
use App\Http\Controllers\Controller;
use App\Vehicle;
use Illuminate\Http\Request;
use Redirect;
use App\Http\Controllers\PaymentController;
use App\User;

class VehicleHireController extends Controller
{
    private $validatedData;

    public function selectHireVehicleType(Request $request)
    {
        $vehicles = Vehicle::all();
        // $vehicles = Vehicle::all('id');

        $active = 'dashboard.rentVehicle';
        $data = compact('active');

        return view('vehicle.hire-vehicle-period', ['vehicles' => $vehicles, 'active' => $active]);
    }

    public function viewSingleVehicle($id)
    {
        $singleCar = Vehicle::find($id);
        $userId = auth()->id();
        $userEmail = User::find($userId)->email;

        $amountPayable = $singleCar->amount_day * 100;

        $active = 'dashboard.viewSingleVehicle';
        $data = compact('active', 'singleCar', 'userEmail', 'amountPayable', 'userId');
        return view('vehicle.book-vehicle', $data);
    }
    public function setValidatedData($values)
    {
        $this->validatedData = $values;
    }

    public function getValidatedData()
    {
        return $this->validatedData;
    }
    public function hireVehicle()
    {
        $data = request()->validate([
            'duration' => 'required|numeric',
            'delivery-date' => 'required|date_format:Y-m-d',
            'delivery-time' => 'required|date_format:H:i',
            'address' => 'required|string'
        ]);
        //   $userId = auth()->id();
        //   $data['user_id']=$userId;
        session(['vehicle_request' => $data]);



        $paystackPayment = new PaymentController();
        return $paystackPayment->redirectToGateway();
    }
    public function storeVehicleRequest($values, $vehicle)
    {
        // dd($vehicle, $values, "here here");

        $user_id = auth()->id();
        $requestForm = session('vehicle_request');

        $saveVehicleRequest = ['user_id' => $user_id, 'vehicle_id' => $vehicle['vehivle_id'], 'duration' => $requestForm['duration'], 'delivery_date' => $requestForm['delivery-date'], 'delivery_time' => $requestForm['delivery-date'], 'address' => $requestForm['address'], 'status' => 'PENDING'];


        AllTransaction::create($values);
        hireVehicleRequest::create($saveVehicleRequest);

        return redirect('dashboard')->with('success', 'Your payment was successfull and your request for the vehicle has been submitted, we would get back to you soon!');
    }
}
