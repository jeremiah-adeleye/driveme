@extends('layout.dashboard')

@section('head')
    <style>
        .page-title {
            color: #20ADF2;
            margin-bottom: 4rem;
        }

        video {
            width: 100%;
            background: #000000;
            margin-bottom: 2rem;
        }

        #options {
            margin-bottom: 1rem;
        }

        #options .option {
            margin-bottom: .25rem;
        }

        #actions {
            display: flex;
            flex-direction: row;
        }

        #actions .nxt-btn {
            margin-left: auto;
        }

        #actions .submit-btn {
            margin-left: 1rem;
        }

        .fade-in {
            opacity: 1;
            animation-name: fadeInOpacity;
            animation-iteration-count: 1;
            animation-timing-function: ease-in;
            animation-duration: 0.5s;
        }

        @keyframes fadeInOpacity {
            0% {
                opacity: 0;
            }
            100% {
                opacity: 1;
            }
        }
    </style>
@endsection

@section('content')
    <div id="content" >
        <p class="h5 page-title" >Test</p>

        <div id="main">
            <b id="questions" class="cardquestion"></b>
            <div id="choices" class="cardquestion">
                <div class="radio">
                    <input type="radio" name="choice" value = 0><span id="answer0"></span>
                </div>
                <div class="radio">
                    <input type="radio" name="choice" value = 1><span id="answer1"></span>
                </div>
                <div class="radio">
                    <input type="radio" name="choice" value = 2><span id="answer2"></span>
                </div>
                <div class="radio">
                    <input type="radio" name="choice" value = 3><span id="answer3"></span>
                </div>
            </div>
            <div>
                <br />
                <button id="backBtn"  class="btn btn-inverse waves-effect waves-light">Back</button>
                <button id="nextBtn"  class="btn btn-inverse waves-effect waves-light">Next</button>
            </div>
        </div>





        <div id="question-cover">
{{--           <h1>Question {{$quizee->id}}.</h1>  --}}
{{--        <h5>{{$quizee->question}}</h5>--}}
{{--            <div id="options" >--}}
{{--              <form action="" questionid={{$quizee->id}}>--}}
{{--                --}}
{{--                     <div class="custom-control custom-radio option">--}}
{{--                      <input type="radio" id="{{$quizee->option_a}}" name="quiz"  class="custom-control-input" value="option_a" onclick="reply_click(this)">A.--}}
{{--                      <label class="custom-control-label ml-5" for="{{$quizee->option_a}}">{{$quizee->option_a}}</label>--}}
{{--                    </div>--}}
{{--                    <div class="custom-control custom-radio option">--}}
{{--                        <input type="radio" id="{{$quizee->option_b}}" name="quiz" class="custom-control-input" value="option_b" onclick="reply_click(this)">B.--}}
{{--                        <label class="custom-control-label ml-5" for="{{$quizee->option_b}}">{{$quizee->option_b}}</label>--}}
{{--                    </div>--}}
{{--                    <div class="custom-control custom-radio option">--}}
{{--                        <input type="radio" id="{{$quizee->option_c}}" name="quiz" class="custom-control-input" value="option_c"  onclick="reply_click(this)">C.--}}
{{--                        <label class="custom-control-label ml-5" for="{{$quizee->option_c}}">{{$quizee->option_c}}</label>--}}
{{--                    </div>--}}
{{--                    <div class="custom-control custom-radio option">--}}
{{--                        <input type="radio" id="{{$quizee->option_d}}" name="quiz" class="custom-control-input" value="option_d" onclick="reply_click(this)">D.--}}
{{--                        <label class="custom-control-label ml-5" for="{{$quizee->option_d}}">{{$quizee->option_d}}</label>--}}
{{--                    </div>--}}
{{--                    --}}
{{--                    --}}
{{--                    --}}
{{--                    --}}
{{--                </div>--}}
{{--                --}}
{{--                <div id="actions" >--}}
{{--                    --}}{{-- Hide previous button if id = 1 or less --}}
{{--                    @if($quizee->id >1)--}}
{{--                    <a href="{{route('startQuiz', ['course_id' => $quizee->course_id, 'quiz_id' => $quizee->id-1])}}" class="btn btn-custom-primary prev-btn" >PREVIOUS</a>--}}
{{--                    @endif--}}
{{--                    @if ($totalQuiz != true)--}}
{{--                        --}}
{{--                    <a href="{{route('startQuiz', ['course_id' => $quizee->course_id, 'quiz_id' => $quizee->id+1])}}" class="btn btn-custom-primary nxt-btn" >NEXT</a>--}}
{{--                    @endif--}}
{{--                    <a href="#" class="btn btn-custom-primary submit-btn" >SUBMIT</a>--}}
{{--                </div>--}}
{{--                @csrf--}}
{{--                --}}
{{--            </form>--}}
{{--            </div>--}}
    </div>

@endsection



<script>

    {{--function reply_click(clicked_id)--}}
    {{--{--}}

    {{--    // alert(clicked_id);--}}
    {{--    let questionId = clicked_id.form.attributes.questionid.value--}}
    {{--    // let correct_option = clicked_id.form.attributes.correct_option.value--}}
    {{--    let userAnswer = clicked_id.value;--}}
    {{--    // var jobs = JSON.parse("{{ json_encode($quizee) }}");--}}
    {{--    // storeAnswer(questionId, userAnswer);--}}
    {{--    //get the value clicked by the user--}}
    {{--    //save the value against the question--}}
    {{--    // var ap = {!! json_encode($quizee, JSON_HEX_TAG) !!};--}}

    {{--   console.log(questionId, userAnswer);--}}
    {{--}--}}
  </script>
