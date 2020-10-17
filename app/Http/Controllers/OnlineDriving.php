<?php

namespace App\Http\Controllers;

use App\AllTransaction;
use App\driving_plans;
use Illuminate\Http\Request;

use App\User;
use Redirect;

class OnlineDriving extends Controller
{
    public function index()
    {

        $active = 'dashboard.onlineDriving';
        $black = '#021827';
        $yellow = '#F9AA29';
        $green = '#2BAB7B';
        $light_green = '#74D19B';
        $allPlans = driving_plans::all();
        $userId = auth()->id();
        $userEmail = User::find($userId)->email;
        $data = compact('active', 'allPlans', 'userEmail');

        return view('online-driving', $data);
    }
    public function coursePayment()
    {

        $paystackPayment = new PaymentController();
        return $paystackPayment->redirectToGateway();
    }

    public function storePaystackRecord($value)
    {
        AllTransaction::create($value);
        return redirect('dashboard/course/1')->with('success', 'Your payment was successfull and you have unclocked this lesson!');
    }
}
