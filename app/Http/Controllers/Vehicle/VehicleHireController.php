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
use App\Http\Service\NotificationService;

class VehicleHireController extends Controller
{
    private $validatedData;
    private $notificationService;

    public function __construct(){
        $this->notificationService = new NotificationService();
    }
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

        //we get session used to store user form filled before proceeding to payment in hire a driver
        $requestForm = session('vehicle_request');

        // here we save the result of transaction after payment
        $transaction = new AllTransaction($values);

        // get the transaction id to be used in other processing

        $user_id = auth()->id();
        $user = User::find($user_id);
        $user->allTransaction()->save($transaction)->refresh();

        $transaction_id = $transaction->id;

        // save the vehicle request in user hire vehicle request table

        $saveVehicleRequest = ['user_id' => $user_id, 'vehicle_id' => $vehicle['vehivle_id'], 'duration' => $requestForm['duration'], 'delivery_date' => $requestForm['delivery-date'], 'delivery_time' => $requestForm['delivery-date'], 'address' => $requestForm['address'], 'status' => 1, 'transaction_id' => $transaction_id];

       $getSaveRequest = hireVehicleRequest::create($saveVehicleRequest)->refresh();
        // also call the notification service to store the notification so as to enable admin see it on the page
        $fullName = ucfirst($user->first_name . ' ' . $user->last_name);
        $notification = "$fullName has submitted application to hire a vehicle";
        $link = route('admin.vehicle-hire', ['id' => $getSaveRequest->id]);
        $this->notificationService->newNotification($notification, $link);
       

        return redirect('dashboard')->with('success', 'Your payment was successfull and your request for the vehicle has been submitted, we would get back to you soon!');
    }
}
