<?php

namespace App\Http\Controllers;

use App\quiz;
use Illuminate\Http\Request;

class quizController extends Controller
{
    public function index($module_id, $period_id, $quize_id)
    {

        $totalQuiz = count(quiz::all());
        $active = 'dashboard.onlineDriving';
        $quizee = quiz::where('id', $quize_id)->first();
         
        // dd($totalQuiz);
        $data = compact('quizee', 'active', 'totalQuiz');
        $checkStart = (session('current'));
       
        return view('course-test', $data);


        // dd(request());


        //get a random s/n from the quiz array
        //send the gotten to the view



        // dashboard/course/{module_id}/{period_id}/{quize_id}

    }



    // public function next()
    // {
    //     // get quiz array
    //     $active = 'dashboard.onlineDriving';
    //     $allQuiz = session('allQuiz');
    //     $prevNum = session('prevNum');
    //     $newNum = $prevNum + 1;
    //     $quizee = array_get($allQuiz, $newNum);
    //     $data = compact('active', 'quizee');

    //     //check if not empty
    //     //remove previous from the current array session
    //     //increment the number
    //     //store the new results 
    //     //else call last page
    //     return view('course-test', $data);
    // }
}
