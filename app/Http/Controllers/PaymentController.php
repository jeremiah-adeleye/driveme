<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Redirect;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Vehicle\VehicleHireController;
use App\User as AppUser;
use Illuminate\Foundation\Auth\User as AuthUser;
use Paystack;



class PaymentController extends Controller
{

    /**
     * Redirect the User to Paystack Payment Page
     * @return Url
     */
    public function redirectToGateway()
    {
        try {
            return Paystack::getAuthorizationUrl()->redirectNow();
        } catch (\Exception $e) {
            return \Redirect::back()->withMessage(['msg' => 'The paystack token has expired. Please refresh the page and try again.', 'type' => 'error']);
        }
    }

    /**
     * Obtain Paystack payment information
     * @return void
     */
    public function handleGatewayCallback()
    {
        $paymentDetails = Paystack::getPaymentData();
        //order_id 1 is for vehicle
        if ($paymentDetails['data']['metadata']['order_id'] == 2) {
            //reference status amount order_id email, plan_id
            $reference = $paymentDetails['data']['reference'];
            $status = $paymentDetails['data']['status'];
            $amount = $paymentDetails['data']['amount'] / 100;
            $order_id = $paymentDetails['data']['metadata']['order_id'];
            $driving_plan_id = $paymentDetails['data']['metadata']['driving_plan_id'];
            // $email = $paymentDetails['data']['metadata']['email'];

            $data = ['reference' => $reference, 'status' => $status, 'amount' => $amount, 'order_id' => $order_id];

            // call to save the plans subscribed for and save before saving into transaction table
            $user = AppUser::find(auth()->id());
            $driving_plan = new OnlineDriving();

            return $driving_plan->storePaystackRecord($data, $driving_plan_id, $user);
        } else {

            $reference = $paymentDetails['data']['reference'];
            $status = $paymentDetails['data']['status'];
            $amount = $paymentDetails['data']['amount'] / 100;
            $order_id = $paymentDetails['data']['metadata']['order_id'];
            $vehicle_id = $paymentDetails['data']['metadata']['vehicle_id'];
            // $email = $paymentDetails['data']['metadata']['email'];
            $user = AppUser::find(auth()->id());

            $data = ['reference' => $reference, 'status' => $status, 'amount' => $amount, 'order_id' => $order_id];
            
            $driving_plan = new OnlineDriving();

            $vehicleData = ['vehivle_id' => $vehicle_id];

           

            
            $hireVehicle = new VehicleHireController();

            return $hireVehicle->storeVehicleRequest($data, $vehicleData);
        }

        // dd($paymentDetails['data']['metadata']['order_id']);
        // Now you have the payment details,
        // you can store the authorization_code in your db to allow for recurrent subscriptions
        // you can then redirect or do whatever you want
    }
}
