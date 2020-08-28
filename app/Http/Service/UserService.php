<?php


namespace App\Http\Service;


use App\User;

class UserService{

    public function make($userRequest) {
        $user = User::create($userRequest);
        if ($user) {
            auth()->login($user);
            return true;
        }

        return false;
    }
}
