@extends('layout.dashboard')

@section('head')
    <style>
        .page-title {
            color: #20ADF2;
            margin-bottom: 4rem;
        }

        #content {
            background: #ffffff;
            padding: 2rem;
            color: #000000;
        }

        #videos-cover .week {
            margin-bottom: 3rem;
        }

        #videos-cover .week .title {
            display: flex;
            flex-direction: row;
            margin-bottom: 1rem;
        }

        #videos-cover .week .title .test-btn {
            margin-left: auto;
        }

        .video {
            margin-bottom: 2rem;
            display: flex;
            padding-top: 56.25%;
            background-color: #4e4e4e;
        }

        .video .duration {
            margin: auto 1rem 1rem auto;
            background: #000000;
            color: #ffffff;
            padding: 0.25rem;
        }
    </style>
@endsection

@section('content')
@if(session()->has('error'))
<div class="alert alert-danger alert-dismissible fade show">
    {{ session()->get('error') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
@if(session()->has('success'))
<div class="alert alert-success alert-dismissible fade show">
    {{ session()->get('success') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
    <div id="content" >
        <p class="h5 page-title" >My Videos</p>

        <div id="videos-cover" >
            @for($i = 1; $i <= 3; $i++)
                <div class="week" >
                    <div class="title" >
                        <p class="h6" >Week {{$i}}</p>
                        <a href="{{route('startQuiz', ['module_id' => 1, 'quiz_id' => 1, 'period_id'=> 1])}}" class="btn btn-custom-primary test-btn" >Take Test {{$i}}</a>
                    </div>
                    <div class="videos" >
                        <div class="row" >
                            @for($j = 1; $j <= 6; $j++)
                                <div class="col-md-4" >
                                    <a href="{{route('course.video', ['id' => 1, 'videoId' => $j])}}" >
                                        <div class="video">
                                            <p class="duration" >30:00</p>
                                        </div>
                                    </a>
                                </div>
                            @endfor
                        </div>
                    </div>
                </div>
            @endfor
        </div>
    </div>
@endsection
