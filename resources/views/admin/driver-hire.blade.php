@extends('admin.layout.dashboard')

@section('content')
    <div id="details" >
        <p class="h5" >USER DETAILS</p>
        <p><strong>First name</strong>: {{$user->first_name}}</p>
        <p><strong>Last name</strong>: {{$user->last_name}}</p>
        <p><strong>Email</strong>: {{$user->email}}</p>
        <p><strong>Phone number</strong>: {{$user->phone_number}}</p>

        <a href="{{route('admin.driver', ['id' => $hireRequest->driver_id])}}" ><button class="btn btn-custom-primary" >VIEW DRIVER</button></a>

        @if(!$hireRequest->approved)
            <a href="{{route('admin.hire-request.approve', ['id' => $hireRequest->id])}}" ><button class="btn btn-custom-primary" >APPROVE REQUEST</button></a>
            <a href="{{route('admin.hire-request.decline', ['id' => $hireRequest->id])}}" ><button class="btn btn-custom-warning" >DECLINE REQUEST</button></a>
        @elseif($hireRequest->approved && $hireRequest->active)
            <a href="{{route('admin.hire-request.terminate', ['id' => $hireRequest->id])}}" ><button class="btn btn-custom-warning" >TERMINATE EMPLOYMENT</button></a>
        @endif
    </div>
@endsection
