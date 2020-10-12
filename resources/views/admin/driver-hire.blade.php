@extends('admin.layout.dashboard')

@section('content')
    <div id="details" >
        <p class="h5" >USER DETAILS</p>
        <div class="row" >
            @foreach($drivers as $driver)
                <div class="col-md-4" >
                    <p><strong>First name</strong>: {{$driver->user->first_name}}</p>
                    <p><strong>Last name</strong>: {{$driver->user->last_name}}</p>
                    <p><strong>Email</strong>: {{$driver->user->email}}</p>
                    <p><strong>Phone number</strong>: {{$driver->user->phone_number}}</p>

                    <a href="{{route('admin.driver', ['id' => $driver->id])}}" ><button class="btn btn-custom-primary" >VIEW DRIVER</button></a>

                    @if(!$hireRequest->approved)
                        <a href="{{route('admin.hire-request.approve', ['id' => $hireRequest->id, 'driverId' => $driver->id])}}" ><button class="btn btn-custom-primary" >APPROVE REQUEST</button></a>
                        <a href="{{route('admin.hire-request.decline', ['id' => $hireRequest->id, 'driverId' => $driver->id])}}" ><button class="btn btn-custom-warning" >DECLINE REQUEST</button></a>
                    @elseif($hireRequest->approved && $hireRequest->active)
                        <a href="{{route('admin.hire-request.terminate', ['id' => $hireRequest->id, 'driverId' => $driver->id])}}" ><button class="btn btn-custom-warning" >TERMINATE EMPLOYMENT</button></a>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
@endsection
