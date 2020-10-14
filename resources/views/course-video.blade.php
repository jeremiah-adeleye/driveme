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
    </style>
@endsection

@section('content')
    <div id="content" >
        <p class="h5 page-title" >Video</p>

        <div id="videos-cover" >
            <video controls >

            </video>
            <div id="description" >
                <p class="title h6" >Video Title</p>
                <div>
                    <p>this is the description of the video</p>
                </div>
            </div>
        </div>
    </div>
@endsection
