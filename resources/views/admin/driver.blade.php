@extends('admin.layout.dashboard')

@section('head')
    <style>
        #comment-input {
            resize: none;
            width: 20rem;
            height: 10rem;
        }
    </style>
@endsection

@section('content')
    @if($driver->approval_status == 1)
        <form method="post" action="{{route('admin.driver.reject', ['id' => $driver->id])}}" >
            {{csrf_field()}}
            {{$errors}}
            <div class="form-group" >
                <label class="h5" for="comment-input" >Comment</label>
                <textarea id="comment-input" class="form-control" placeholder="Reason for rejection" name="comment" ></textarea>
            </div>
            <a href="{{route('admin.driver.approve', ['id' => $driver->id])}}"><button type="button" class="btn btn-success" >Approve</button></a>
            <button type="submit" class="btn btn-danger">Reject</button>
        </form>
        <p class="h5" >Rejection messages</p>
        <hr>
        @foreach($driver->rejectionMessages as $rejectionMessage)
            <p>{{$rejectionMessage->message}}</p>
        @endforeach
    @elseif($driver->approval_status == 2)
        <a href="{{route('admin.driver.revoke', ['id' => $driver->id])}}" ><button type="button" class="btn btn-danger">Revoke approval</button></a>
    @elseif($driver->approval_status == 3)
        <p class="h5" >Rejection messages</p>
        <hr>
        <ul>
            @foreach($driver->rejectionMessages as $rejectionMessage)
                <li>{{$rejectionMessage->message}}</li>
            @endforeach
        </ul>
    @else
        <a href="{{route('admin.driver.approve', ['id' => $driver->id])}}"><button type="button" class="btn btn-success" >Approve</button></a>
    @endif
@endsection
