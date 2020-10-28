<?php

namespace App\Http\Controllers;

use App\Notification;
use Illuminate\Http\Request;

class FeedController extends Controller
{
    public function index()
    {
        $active = 'admin.feed';

        $notifications = Notification::whereSeen(false)->orderBy('created_at', 'desc')->get();

        $data = compact('notifications', 'active');


        return view('admin.feed', $data);
    }
}
