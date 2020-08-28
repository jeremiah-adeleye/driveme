<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use App\Http\Requests\DriverRequest;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function register() {
        return view('driver_register');
    }

    public function createDriver(DriverRequest $request) {
        dd($request);
        return view('login');
    }
}
