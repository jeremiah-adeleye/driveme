<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OnlineDrivingController extends Controller{

    public function index() {
        $active = 'dashboard.onlineDriving';
        $data = compact('active');

        return view('online-driving', $data);
    }
}
