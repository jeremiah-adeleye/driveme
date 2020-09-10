@extends('admin.layout.dashboard')

@section('head')
    <style>
        #details {
            background: #ffffff;
            margin-bottom: 1rem;
            padding: 1rem;
            box-shadow: 0 0 5px 1px rgba(0,0,0,0.1);
        }

        #details img {
            margin-bottom: 1rem;
        }

        #response-cover {
            padding: 1rem;
        }

        #comment-input {
            resize: none;
            width: 100%;
            height: 10rem;
        }
    </style>
@endsection

@section('content')
    <div class="row" >
        <div class="col-md-6" >
            <div id="details" >
                <img src="{{$driver->passport}}" width="100px" height="auto" alt="passport" >
                <p><strong>First name</strong>: {{$driver->user->first_name}}</p>
                <p><strong>Last name</strong>: {{$driver->user->last_name}}</p>
                <p><strong>Email</strong>: {{$driver->user->email}}</p>
                <p><strong>Phone number</strong>: {{$driver->user->phone_number}}</p>
                <p><strong>Date of birth</strong>: {{$driver->dob}}</p>
                <p><strong>Location</strong>: {{$driver->location}}</p>
                <p><strong>Salary range</strong>: {{$driver->salary_range}}</p>
                <p><strong>Residential address</strong>: {{$driver->address}}</p>
                <p><strong>Licence number</strong>: {{$driver->licence_number}}</p>
                <p><strong>Experience Years</strong>: {{$driver->experience}}</p>
                <p><strong>Vehicle type</strong>: {{$driver->vehicle_type}}</p>
                <p><strong>CV</strong>: <a href="{{$driver->cv}}" >Click to download</a></p>
            </div>
        </div>

        <div class="col-md-6" >
            <div id="response-cover" >
                @if($driver->approval_status == 1)
                    <form method="post" action="{{route('admin.driver.reject', ['id' => $driver->id])}}" >
                        {{csrf_field()}}
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
            </div>
        </div>
    </div>
@endsection
