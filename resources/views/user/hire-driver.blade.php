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

        .hire-type.active {
            border: 3px solid #2BAB7B;
        }

        .user-icon {
            text-align: center;
            margin-bottom: 1rem;
        }

        .user-icon .background{

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
    <div id="hire-types" >
        <div class="hire-type mr-2 active" id="full-term" >
            <div class="user-icon" >
                <span class="background" ><img src="{{asset('img/icons/user_plus.png')}}" alt="user" ></span>
            </div>
            <p>Hire A Full Time Driver</p>
        </div>
        <div class="hire-type ml-2" id="short-term" >
            <div class="user-icon" >
                <span class="background" ><img src="{{asset('img/icons/user_plus.png')}}" alt="user" ></span>
            </div>
            <p>Hire A Short Term Driver</p>
        </div>
    </div>
    <p>NB: You will be required to pay a processing fee of N2,000</p>
    <a href="#" ><button class="btn btn-custom-primary" >CONTINUE</button></a>
@endsection

@section('scripts')
    <script>
        $('.hire-type').on('click', function () {
            $('.hire-type').removeClass('active');
            $(this).addClass('active');
        })
    </script>
@endsection
