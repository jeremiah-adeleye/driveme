<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class AuthController extends Controller
{
    public function login() {
        return view('login');
    }

    public function register() {
        return view('register');
    }

    public function authenticate(Request $request) {
        $credentials = $request->only('email', 'password');
        $remember_me = false;

        if ($request->has('remember_me')) {
            if ($request->get('remember_me') == true) $remember_me = true;
        }

        if (Auth::attempt($credentials, $remember_me)) {
            return redirect()->intended('/');
        }

        return Redirect::to('login')->with('error', 'Wrong email or password');
    }
}
