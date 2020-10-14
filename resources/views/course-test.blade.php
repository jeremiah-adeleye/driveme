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

        <div id="question-cover" >
            <p>1. This is a question about something that has to do with the test you took so please take your time before picking any of the options</p>
            <div id="options" >
                @for($i = 0; $i <4; $i++)
                    <div class="custom-control custom-radio option">
                        <input type="radio" id="{{$options[$i]}}" name="customRadio" class="custom-control-input">
                        <label class="custom-control-label" for="{{$options[$i]}}">{{$options[$i]}}. Option {{$options[$i]}}</label>
                    </div>
                @endfor
            </div>

            <div id="actions" >
                <a href="#" class="btn btn-custom-primary prev-btn" >PREVIOUS</a>
                <a href="#" class="btn btn-custom-primary nxt-btn" >NEXT</a>
                <a href="#" class="btn btn-custom-primary submit-btn" >SUBMIT</a>
            </div>
        </div>
    </div>
@endsection
