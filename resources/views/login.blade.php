@extends('layout/auth', ['title' => $title])

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
            @if(session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session()->get('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <form method="post" action="{{route('login')}}" >
                {{csrf_field()}}
                <div class="form-group custom" id="email-input" >
                    <label for="email">Email Address</label>
                    <input type="text" class="form-control input-custom-primary" id="email" name="email" aria-describedby="email">
                </div>

                <div class="form-group custom" id="password-input" >
                    <label for="password">Password</label>
                    <div class="input-group right" >
                        <input type="password" class="form-control input-custom-primary" id="password" name="password" aria-describedby="password" >
                        <div class="input-group-append" id="toggle-password" data-target="#password" >
                            <div class="input-group-text">
                                <i class="fa fa-eye icon"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group custom" id="login-button" >
                    <button type="submit" class="btn btn-custom-primary">LOG IN</button>
                    <div class="text-right" id="forgot-password-link" ><a href="#" >Forgot password?</a></div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
@endsection
