<?php

namespace App\Http\Controllers;

use App\ActiveTraining;
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


        //call all active plans

        // filter plans according to active plan

        $allPlans = driving_plans::all();
        $userId = auth()->id();
        $userEmail = User::find($userId)->email;
        $data = compact('active', 'allPlans', 'userEmail');

        return view('online-driving', $data);
    }
    public function coursePayment($id)
    {
        $activePlans = ActiveTraining::find($id);
        if ($activePlans != null) {
            return \Redirect::back()->with('error', 'You are currently subscribed to this plan, kindly go to your dashboard to continue the course.');
        }

        $paystackPayment = new PaymentController();
        return $paystackPayment->redirectToGateway();
    }

    public function storePaystackRecord($value, $driving_plan_id, $user)
    {
        $transaction = new AllTransaction($value);
        $user->allTransaction()->save($transaction)->refresh();

        $userId = $user->id;
        $transaction_id = $transaction->id;

        $activePlan = new ActiveTraining([
            'user_id' => $userId,
            'all_transactions_id' => $transaction_id,
            'driving_plans_id' => $driving_plan_id
        ]);

        $getDrivingPlan = driving_plans::find($driving_plan_id);

        $getDrivingPlan->activePlan()->save($activePlan);
        // $activePlan->save();
        // dd($transaction_id);
        // $allDrivePlans = driving_plans::find($driving_plan_id);

        // $user->drivingPlans()->sync($activePlan);

        return redirect('dashboard/course/1')->with('success', 'Your payment was successfull and you have unclocked this lesson!');
    }
}
