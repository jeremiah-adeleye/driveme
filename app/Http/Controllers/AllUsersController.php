<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class AllUsersController extends Controller
{
    public function index()
    {
        $active = "dashboard.users";

        $users = User::all()->toArray();
        
        // $users = Users::paginate(5); to paginate data from user db
        $data = compact('active', 'users');

        return view('admin.all-users', $data);
    }
}
