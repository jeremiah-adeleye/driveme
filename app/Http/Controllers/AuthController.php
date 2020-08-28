<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Http\Service\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    private $userService;

    public function __construct(){
        $this->userService = new UserService();
    }

    public function login() {
        return view('login');
    }

    public function register() {
        return view('user.register');
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

    public function registerUser(UserRequest $request) {
        $userRequest = $request->only('first_name', 'last_name', 'phone_number', 'email', 'password');
        $userRequest['role'] = 1;

        if ($this->userService->make($userRequest)) {
            return redirect()->route('home')->with('success', 'Account registered');
        }else return redirect()->route('register')->with('Error', 'An error occurred');
    }

    public function logout() {
        Session::flush();
        Auth::logout();
        return Redirect('');
    }
}
