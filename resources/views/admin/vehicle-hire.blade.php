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
                <img src="{{ asset('img/car-1.png') }}" width="200px" height="auto" alt="car image" >
                <p class="h4" >Vehicle Information</p>
                <p><strong>Vehicle Make</strong>: {{$vehicle->mame}}</p>
                <p><strong>Fabrication</strong>: {{$vehicle->fabrication}}</p>
                <p><strong>Condition</strong>: {{$vehicle->condition}}</p>
                <p><strong>Transmission</strong>: {{$vehicle->type}}</p>
                <p><strong>Daily Amount</strong>: {{$vehicle->amount_day}}</p>
            </div>

            <div id="details" >
                <p class="h4" >Applicant Information</p>
                {{-- <img src="{{ asset('img/car-1.png') }}" width="200px" height="auto" alt="passport" > --}}
                <p><strong>First Name</strong>: {{$user->first_name}}</p>
                <p><strong>Last Name</strong>: {{$user->last_name}}</p>
                <p><strong>Phone number</strong>: {{$user->phone_number}}</p>
                <p><strong>Email</strong>: {{$user->email}}</p>
                <p><strong>Period of Hiring</strong>: {{$hireRequest->duration}}</p>
                <p><strong>Delivery Date</strong>: {{$user->address}}</p>
              
            </div>
        </div>

        <div class="col-md-6" >
            <div id="response-cover" >
                @if($hireRequest->status == 1)
                    <form class="mb-4" method="post" action="{{route('admin.vehicle.reject', ['id' => $vehicle->id])}}" >
                        {{csrf_field()}}
                        <div class="form-group" >
                            <label class="h5" for="comment-input" >Comment</label>
                            <textarea id="comment-input" class="form-control" placeholder="Reason for rejection" name="comment" ></textarea>
                        </div>
                        <a href="{{route('admin.vehicle.approve', ['id' => $hireRequest->id])}}"><button type="button" class="btn btn-success" >Approve</button></a>
                        <button type="submit" class="btn btn-danger">Reject</button>
                    </form>
                    <p class="h5" >Rejection messages</p>
                    <hr>
                    {{-- @foreach($driver->rejectionMessages as $rejectionMessage)
                        <p>{{$rejectionMessage->message}}</p>
                    @endforeach --}}
                @elseif($hireRequest->status == 2)
                    <a href="{{route('admin.vehicle.revoke', ['id' => $hireRequest->id])}}" ><button type="button" class="btn btn-danger">Revoke approval</button></a>
                @elseif($hireRequest->status == 3)
                    <p class="h5" >Rejection messages</p>
                    <hr>
                    {{-- <ul>
                        @foreach($driver->rejectionMessages as $rejectionMessage)
                            <li>{{$rejectionMessage->message}}</li>
                        @endforeach
                    </ul> --}}
                @else
                    <a href="{{route('admin.vehicle.approve', ['id' => $hireRequest->id])}}"><button type="button" class="btn btn-success" >Restore Approval</button></a>
                @endif
            </div>
        </div>
    </div>
@endsection
