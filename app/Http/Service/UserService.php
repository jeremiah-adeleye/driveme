<?php


namespace App\Http\Service;


use App\User;

class UserService{

    public function make($userRequest) {
        $user = User::create($userRequest);
        if ($user) {
            auth()->login($user);
            return $user->id;
        }

        return false;
    }

    public function update($userRequest) {
        $userId = auth()->id();
        if ($userId) {
            $user = User::find($userId);
            $user->first_name = $userRequest['first_name'];
            $user->last_name = $userRequest['last_name'];
            $user->email = $userRequest['email'];
            $user->phone_number = $userRequest['phone_number'];

            $user->save();
        }
    }
}
