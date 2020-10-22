@extends('layout.dashboard')

@section('head')
    <style>
        .page-title {
            color: #20ADF2;
            margin-bottom: 4rem;
        }

        video {
            width: auto;
            height: auto;
            background: #000000;
            margin-bottom: 2rem;
        }
        #video-cover{
            margin: auto;
        }

    </style>
@endsection

@section('content')
    <div id="content" >
        <p class="h5 page-title" >Video</p>

        <div id="videos-cover" >
        <video controls>
            
            <source src="{{ asset('videos/video3.mp4') }}">
          
                Your browser does not support embedded videos.
        </video>
            <div id="description" >
                <p class="title h6" >Video Title</p>
                <div>
                    <p>this is the description of the video</p>
                </div>
            </div>
            <div class="controls">
                <a href="{{ route('course', ['course_id'=>1]) }}" class="btn btn-custom-primary">Course Home</a>
                <a href="{{ route('startQuiz', ['course_id'=>1, 'quiz_id'=> 1]) }}" class="btn btn-custom-primary">Take Test</a>
            </div>
        </div>
    </div>
@endsection
