@extends('admin.layout.dashboard')

@section('head')
    <style>
        .feed {
            margin-bottom: 1rem;
        }

        .feed .message {
            margin-bottom: 0.2rem;
        }
    </style>
@endsection

@section('content')
    <div class="row" >
        <div class="col-md-6" >

        </div>
        <div class="col-md-6">
            <p class="h5" >Feed</p>
            <hr>
            <ul>
                @foreach ($notifications as $notification)
                    <a href="{{$notification->link}}" >
                        <div class="card feed">
                            <div class="card-body">
                                <p class="message" >{{ $notification->notification }}</p>
                                <small class="card-subtitle mb-2 text-muted">{{$notification->created_at}}</small>
                            </div>
                        </div>
                    </a>
                @endforeach
            </ul>
        </div>
    </div>
@endsection
