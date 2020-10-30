<?php

namespace App\Http\Controllers;

use App\Course_result;
use App\quiz;
use Illuminate\Http\Request;

class quizController extends Controller
{



    public function index($course_id, $quiz_id)
    {

        $data['active'] = $active = 'dashboard.onlineDriving';
        $data['quizee'] = $quizee = quiz::where('id', $quiz_id)->first();



        if ($quizee != null) {
            $totalQuiz = count(quiz::all()) == $quiz_id ? true : false;
            $all_quiz = $quiz_json = quiz::where('course_id', $course_id)->get();


            $data['questions'] = array();
            foreach($all_quiz as $item){

                $option = array();
                $a = $item->option_a;
                $b = $item->option_b;
                $c = $item->option_c;
                $d = $item->option_d;



                switch ($item->correct_option) {
                    case 'option_a':
                        $correct = 0;
                        break;

                    case 'option_b':
                        $correct = 1;
                        break;

                    case 'option_c':
                        $correct = 2;
                        break;

                    case 'option_d':
                        $correct = 3;
                        break;

                    default:
                        # code...
                        break;
                }

                $new_array['question'] = $item->question;
                $new_array['id'] =  $item->id;
                $new_array['correct'] = $correct;
                $new_array['choices'] = array($a, $b, $c, $d);

                array_push($data['questions'], $new_array);
            }

            $data['quiz_json'] =  json_encode($data['questions']);

            $quizpage = 'yes';

            $data['totalQuiz'] = $totalQuiz;
            $data['uid'] = $uid = auth()->id();;
            $data['quizpage'] = $quizpage;;
            $data['course_id'] = $course_id;;

            // $checkStart = (session('current'));
            return view('course-test', $data);
        }
        return \Redirect::back()->with('error', 'No more question here');
    }

    public function savequizresult(Request $request)
    {

        $course_result = new Course_result();

        $user_id = $request->input('user_id');
//        $quiz_id = Request::post('quiz_id');
        $course_id = $request->input('course_id');
        $result = $request->input('result');
        $question_count = $request->input('question_count');


        $course_result->user_id = $user_id;
        $course_result->course_id = $course_id;
        $course_result->result = $result;
        $course_result->question_count = $question_count;
        $course_result->save();

        echo json_encode(array('msg'=>'success','status'=>true));
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
