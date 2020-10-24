<?php

namespace App\Http\Controllers;

use App\quiz;
use Illuminate\Http\Request;

class quizController extends Controller
{
    public function index($course_id, $quiz_id)
    {

        $active = 'dashboard.onlineDriving';
        $quizee = quiz::where('id', $quiz_id)->first();

        if ($quizee != null) {
            $totalQuiz = count(quiz::all()) == $quiz_id ? true : false;
            $data = compact('quizee', 'active', 'totalQuiz');
         

            // $checkStart = (session('current'));
            return view('course-test', $data);
        }
        return \Redirect::back()->with('error', 'No more question here');
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
