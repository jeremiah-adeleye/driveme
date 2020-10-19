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
    </style>
@endsection

@section('content')
    <div id="content" >
        <p class="h5 page-title" >Test</p>
<script>
    var ap = {!! json_encode($quizee, JSON_HEX_TAG) !!};
    //content is the div to hold the quiz

    // get()

</script>
        <div id="question-cover">
           <h1>Question {{$quizee->id}}.</h1>  
        <h5>{{$quizee->question}}</h5>
            <div id="options" >
              <form action="" questionId={{$quizee->id}}>
                
                     <div class="custom-control custom-radio option">
                      <input type="radio" id="{{$quizee->option_a}}" name="quiz"  class="custom-control-input" value="option_a" onClick="reply_click(this)">A.
                      <label class="custom-control-label ml-5" for="{{$quizee->option_a}}">{{$quizee->option_a}}</label>
                    </div>
                    <div class="custom-control custom-radio option">
                        <input type="radio" id="{{$quizee->option_b}}" name="quiz" class="custom-control-input" value="option_b" onClick="reply_click(this)">B.
                        <label class="custom-control-label ml-5" for="{{$quizee->option_b}}">{{$quizee->option_b}}</label>
                    </div>
                    <div class="custom-control custom-radio option">
                        <input type="radio" id="{{$quizee->option_c}}" name="quiz" class="custom-control-input" value="option_c" onClick="reply_click(this)">C.
                        <label class="custom-control-label ml-5" for="{{$quizee->option_c}}">{{$quizee->option_c}}</label>
                    </div>
                    <div class="custom-control custom-radio option">
                        <input type="radio" id="{{$quizee->option_d}}" name="quiz" class="custom-control-input" value="option_d" onClick="reply_click(this)">D.
                        <label class="custom-control-label ml-5" for="{{$quizee->option_d}}">{{$quizee->option_d}}</label>
                    </div>
                    
                    
                    
                    
                </div>
                
                <div id="actions" >
                    {{-- Hide previous button if id = 1 or less --}}
                    @if($quizee->id >1)
                    <a href="{{route('startQuiz', ['module_id' => $quizee->module_id, 'quiz_id' => $quizee->id-1, 'period_id'=> $quizee->period_id])}}" class="btn btn-custom-primary prev-btn" >PREVIOUS</a>
                    @endif
                    @if ($quizee->id !== $totalQuiz)
                        
                    <a href="{{route('startQuiz', ['module_id' => $quizee->module_id, 'quiz_id' => $quizee->id+1, 'period_id'=> $quizee->period_id])}}" class="btn btn-custom-primary nxt-btn" >NEXT</a>
                    @endif
                    <a href="#" class="btn btn-custom-primary submit-btn" >SUBMIT</a>
                </div>
                @csrf
                
            </form>
            </div>
    </div>

@endsection
<script type="text/javascript">
let value = [];
document.getElementById("question-cover").innerText = "Hello"
function test(){
    alert("loaded")
}
    function reply_click(clicked_id)
    {
        
        // alert(clicked_id);
        let questionId = clicked_id.form.attributes.questionid.value
        // let correct_option = clicked_id.form.attributes.correct_option.value
        let userAnswer = clicked_id.value;
        // var jobs = JSON.parse("{{ json_encode($quizee) }}");
        // storeAnswer(questionId, userAnswer);
        //get the value clicked by the user
        //save the value against the question
        var ap = {!! json_encode($quizee, JSON_HEX_TAG) !!};
        console.log(ap)
    }
  </script>
