@extends('user.layout.dashboard')

@section('head')
    <style>
        #hire-types {
            display: flex;
            flex-direction: row;
            margin-bottom: 1rem;
        }

        .hire-type {
            border-radius: 5px;
            border: 3px solid #ffffff;
            background: #ffffff;
            padding: 1rem;
        }

        .user-icon {
            text-align: center;
            margin-bottom: 1rem;
        }

        .user-icon img {
            width: 2rem;
            height: 2rem;
        }
    </style>
@endsection

@section('content')
    <p class="text-primary page-title" >Hire a Driver</p>
    <p>Choose the option that suits you best</p>

    @if(session()->has('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @if(session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div id="hire-types" >
        <a href="{{route('user.drivers', ['hireType' => 'full-term'])}}" >
            <div class="hire-type mr-2 active" id="full_term" >
                <div class="user-icon" >
                    <span class="background" ><img src="{{asset('img/icons/user_plus.png')}}" alt="user" ></span>
                </div>
                <p>Hire A Full Time Driver</p>
            </div>
        </a>
        <a href="{{route('user.drivers', ['hireType' => 'short-term'])}}" >
            <div class="hire-type ml-2" id="short_term" >
                <div class="user-icon" >
                    <span class="background" ><img src="{{asset('img/icons/user_plus.png')}}" alt="user" ></span>
                </div>
                <p>Hire A Short Term Driver</p>
            </div>
        </a>
    </div>
@endsection
