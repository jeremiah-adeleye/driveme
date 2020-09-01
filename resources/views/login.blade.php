@extends('layout/auth', ['title' => 'user.login'])

@section('head')
    <link rel="stylesheet" href="{{asset('css/login.css')}}" >
@endsection

@section('intro')
    <div id="auth-intro-text" class="col-sm-8" >
        @if($title == 'driver.login')
            <h1>Join over 3,000 drivers in the country</h1>
            <h5>Benefits</h5>
            <ul style="list-style-type: none" >
                <li>1. Competitive salary</li>
                <li>2. Free Registration</li>
                <li>3. Easy access to jobs</li>
            </ul>
        @else
            <h1 class="col-sm-8" >Search, hire and manage Professional drivers</h1>
        @endif
    </div>
@endsection

@section('content')
    <div class="my-auto" >
        <div id="form-into" class="col-md-6" >
            <h1>Welcome back</h1>
            <p>Sign in with your email and password to access your account</p>
        </div>

        <div class="col-md-9">
            @if(session()->has('error'))
                <div class="alert alert-danger alert-dismissible fade show">
                    {{ session()->get('error') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <form method="post" >
                {{csrf_field()}}
                <div class="form-group custom" id="email-input" >
                    <label for="email">Email Address</label>
                    <input type="email" class="form-control input-custom-primary" id="email" name="email" aria-describedby="email">
                </div>

                <div class="form-group custom" id="password-input" >
                    <label for="password">Password</label>
                    <input type="password" class="form-control input-custom-primary" id="password" name="password" aria-describedby="password">
                </div>

                <div class="form-group custom" id="login-button" >
                    <button type="submit" class="btn btn-custom-primary">Login</button>
                    <div class="text-right" ><a href="#" >Forgot password?</a></div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
@endsection
