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
                <p><strong>First name</strong>: {{$corporate->user->first_name}}</p>
                <p><strong>Last name</strong>: {{$corporate->user->last_name}}</p>
                <p><strong>Email</strong>: {{$corporate->user->email}}</p>
                <p><strong>Phone number</strong>: {{$corporate->user->phone_number}}</p>
                <p><strong>Company name</strong>: {{$corporate->name}}</p>
                <p><strong>Registration number</strong>: {{$corporate->registration_number}}</p>
                <p><strong>Company Address</strong>: {{$corporate->address}}</p>
            </div>
        </div>

        <div class="col-md-6" >
            <div id="response-cover" >
                @if($corporate->approved == 0)
                    <a href="{{route('admin.corporate.approve', ['id' => $corporate->id])}}"><button type="button" class="btn btn-success" >Approve</button></a>
                    <a href="{{route('admin.corporate.reject', ['id' => $corporate->id])}}"><button type="button" class="btn btn-danger" >Decline</button></a>
                @elseif($corporate->approved == 1)
                    <a href="{{route('admin.corporate.revoke', ['id' => $corporate->id])}}" ><button type="button" class="btn btn-danger">Revoke approval</button></a>
                @else
                    <a href="{{route('admin.corporate.approve', ['id' => $corporate->id])}}"><button type="button" class="btn btn-success" >Restore Approval</button></a>
                @endif
            </div>
        </div>
    </div>
@endsection
