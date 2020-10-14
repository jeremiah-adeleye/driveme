<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AppController extends Controller
{
    public function index() {
       
        if (auth()->id() != null) {
            return redirect()->route('dashboard');
        }else return redirect()->route('home');
    }
}
