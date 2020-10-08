<?php

namespace App\Http\Controllers\Corporate;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Service\UserService;
use Illuminate\Http\Request;

class AuthController extends Controller{

    private $userService;

    public function __construct(){
        $this->userService = new UserService();
    }

    public function register() {
        $title = 'corporate.register';
        $data = compact('title');

        return view('corporate.register', $data);
    }

    public function saveCorporateUser(UserRequest $request) {
        $userRequest = $request->only(['first_name', 'last_name', 'email', 'phone_number', 'password']);
        $userRequest['role'] = 3;
        $user = $this->userService->make($userRequest);

        if ($user) {
            return redirect()->route('login')->with('success', 'Account registered, Please login to complete registration');
        } else return redirect()->back()->with('error', 'An error occurred');
    }
}
