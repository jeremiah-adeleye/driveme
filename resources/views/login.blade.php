@extends('layout/app', ['title' => 'login'])

@section('head')
    <link rel="stylesheet" href="{{asset('css/login.css')}}" >
@endsection

@section('content')
    <section id="login-section" class="d-flex flex-column" >
        <div class="row my-auto">
            <div class="col-md-6">
                <form>
                    <div class="form-group custom" id="email-input" >
                        <label for="email">Email Address</label>
                        <input type="email" class="form-control input-custom-primary" id="email" aria-describedby="email">
                    </div>

                    <div class="form-group custom" id="password-input" >
                        <label for="password">Password</label>
                        <input type="password" class="form-control input-custom-primary" id="password" aria-describedby="password">
                    </div>

                    <div class="form-group custom" id="login-button" >
                        <button type="submit" class="btn btn-custom-primary">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
@endsection
