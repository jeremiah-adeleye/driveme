<?php

namespace App\Http\Controllers;

use App\Notification;
use Illuminate\Http\Request;

class FeedController extends Controller
{
    public function index()
    {
        // this shows the admin feed
        // I will still check if the user is an admin before serving this page
        $active = 'admin.feed';

        $notifications = Notification::whereSeen(false)->orderBy('created_at', 'desc')->get();

        $data = compact('notifications', 'active');


        return view('admin.feed', $data);
    }
}
