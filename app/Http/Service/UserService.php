<?php


namespace App\Http\Service;


use App\User;

class UserService{

    public function make($userRequest) {
        $user = User::create($userRequest);
        if ($user) {
            return $user->id;
        }

        return false;
    }

    public function update($userRequest, $full=false) {
        $userId = auth()->id();
        if ($userId) {
            $user = User::find($userId);
            $user->email = $userRequest['email'];
            $user->phone_number = $userRequest['phone_number'];

            if ($full) {
                $user->first_name = $userRequest['first_name'];
                $user->last_name = $userRequest['last_name'];
            }

            $user->save();
        }
    }
}
