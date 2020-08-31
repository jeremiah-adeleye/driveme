@extends('layout/auth', ['title' => 'user.register'])

@section('head')
    <link rel="stylesheet" href="{{asset('css/register.css')}}" >
@endsection

@section('intro')

@endsection

@section('content')
    <div class="my-auto" >
        <div id="form-into" class="col-lg-12" >
            <h1>Create an account</h1>
            <p>Sign up with your email and password to create an account</p>
        </div>

        <form class="col-lg-9" method="post" >
            {{csrf_field()}}
            <div class="form-group custom" id="first-name-input" >
                <label for="first-name">First Name</label>
                <input type="text" class="form-control input-custom-primary" id="first-name" name="first_name" aria-describedby="firstName">
            </div>

            <div class="form-group custom" id="last-name-input" >
                <label for="last-name">Last Name</label>
                <input type="text" class="form-control input-custom-primary" id="last-name" name="last_name" aria-describedby="lastName">
            </div>

            <div class="form-group custom" id="email-input" >
                <label for="email">Email Address</label>
                <input type="email" class="form-control input-custom-primary" id="email" name="email" aria-describedby="email">
            </div>

            <div class="form-group custom" id="phone-number-input" >
                <label for="phone-number">Phone Number</label>
                <input type="text" class="form-control input-custom-primary" id="phone-number" name="phone_number" aria-describedby="phoneNumber">
            </div>

            <div class="form-group custom" id="password-input" >
                <label for="password">Password</label>
                <input type="password" class="form-control input-custom-primary" id="password" name="password" aria-describedby="password">
            </div>

            <div class="form-group custom" id="register-button" >
                <button type="submit" class="btn btn-custom-primary">Register</button>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
@endsection
