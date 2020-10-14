<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OnlineDrivingController extends Controller{

    public function index() {
        $active = 'dashboard.onlineDriving';
        $data = compact('active');

        return view('online-driving', $data);
    }

    public function course($id) {
        $active = 'dashboard.onlineDriving';
        $data = compact('active');

        return view('course', $data);
    }

    public function courseVideo($id, $videoId) {
        $active = 'dashboard.onlineDriving';
        $data = compact('active');

        return view('course-video', $data);
    }

    public function courseTest($id, $testId) {
        $active = 'dashboard.onlineDriving';
        $options = ['A', 'B', 'C', 'D', 'E', 'F', 'G'];
        $data = compact('active', 'options');

        return view('course-test', $data);
    }
}
