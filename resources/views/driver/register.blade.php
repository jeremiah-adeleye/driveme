@extends('layout/auth', ['title' => $title])

@section('head')
    <link rel="stylesheet" href="{{asset('css/register.css')}}" >
@endsection

@section('intro')
    <div id="auth-intro-text" class="col-sm-8" >
        <h1>Join over 3,000 drivers in the country</h1>
        <h5>Benefits</h5>
        <ul style="list-style-type: none" >
            <li>1. Competitive salary</li>
            <li>2. Free Registration</li>
            <li>3. Easy access to jobs</li>
        </ul>
    </div>
@endsection

@section('content')
    <div class="my-auto" >
        <div id="form-into" class="col-lg-12" >
            <h1>Create an account</h1>
            <p>Sign up with your email and password to create an account</p>
        </div>

        <form class="col-lg-9" method="post" enctype="multipart/form-data" >
            <div class="mb-4" >
                @if(session()->has('error'))
                    <div class="alert alert-danger alert-dismissible fade show">
                        {{ session()->get('error') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @elseif(session()->has('success'))
                    <div class="alert alert-success alert-dismissible fade show">
                        {{ session()->get('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
            </div>

            {{ csrf_field() }}
            <div class="form-group custom" id="first-name-input" >
                <label for="first-name">First Name</label>
                <input type="text" class="form-control input-custom-primary" id="first-name" name="first_name" aria-describedby="firstName" value="{{  old('first_name') }}">
                @error('first_name')
                <small class="text-danger" >{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group custom" id="last-name-input" >
                <label for="last-name">Last Name</label>
                <input type="text" class="form-control input-custom-primary" id="last-name" name="last_name" aria-describedby="lastName" value="{{  old('last_name') }}">
                @error('last_name')
                <small class="text-danger" >{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group custom" id="email-input" >
                <label for="email">Email Address</label>
                <input type="email" class="form-control input-custom-primary" id="email" name="email" aria-describedby="email" value="{{  old('email') }}">
                @error('email')
                <small class="text-danger" >{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group custom" id="phone-number-input" >
                <label for="phone-number">Phone Number</label>
                <input type="text" class="form-control input-custom-primary" id="phone-number" name="phone_number" aria-describedby="phoneNumber" value="{{  old('phone_number') }}">
                @error('phone_number')
                <small class="text-danger" >{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group custom" id="password-input" >
                <label for="password">Password</label>
                <div class="input-group right" >
                    <input type="password" class="form-control input-custom-primary" id="password" name="password" aria-describedby="password" placeholder="Must contain uppercase, lowercase, number and special character" >
                    <div class="input-group-append" id="toggle-password" data-target="#password" >
                        <div class="input-group-text">
                            <i class="fa fa-eye icon"></i>
                        </div>
                    </div>
                </div>
                @error('password')
                <small class="text-danger" >{{ $message }}</small>
                @enderror
            </div>


            <div class="form-group custom col-12" id="register-button" >
                <button type="submit" class="btn btn-custom-primary">CREATE AN ACCOUNT</button>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    <script src="{{asset('js/register.js')}}" ></script>
    <script src="{{asset('js/preview_file.js')}}" ></script>
@endsection
