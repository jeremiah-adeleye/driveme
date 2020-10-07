<?php

namespace App\Http\Controllers\Corporate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller{

    public function register() {
        $title = 'corporate.register';
        $data = compact('title');

        return view('corporate.register', $data);
    }
}
