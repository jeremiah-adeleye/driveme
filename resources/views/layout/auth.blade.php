<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-100" >
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}" >
    <link rel="stylesheet" href="{{asset('css/app.css')}}" >
    <link rel="stylesheet" href="{{asset('css/auth.css')}}" >
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Drive me</title>
    @yield('head')
</head>
<body class="d-flex flex-column" >

<section id="auth-content" class="container-fluid flex-grow-1" >
    <div class="row h-100">
        <div class="col-md-6 d-none d-md-block" id="auth-intro" >
            <div class="shade" ></div>
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{url('/')}}">
                        <img src="{{ asset('img/driveme_logo.png') }}" alt="logo" class="app-logo" >
                    </a>
                </li>
            </ul>
            @yield('intro')
        </div>
        <div class="col-md-6 offset-md-6 px-5 d-flex flex-column">
            <ul class="nav justify-content-end">
                @if(auth()->guest())
                    @if($title != 'driver.register')
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('driver.register')}}">
                                <button type="button" class="btn btn-custom-primary-outline">Become a Driver</button>
                            </a>
                        </li>
                    @endif
                    @if($title != 'corporate.register')
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('corporate.register')}}">
                                <button type="button" class="btn btn-custom-primary-outline">Register as Corporate</button>
                            </a>
                        </li>
                    @endif
                    @if($title != 'user.register')
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('register')}}">
                                <button type="button" class="btn btn-custom-primary-outline">Register as User</button>
                            </a>
                        </li>
                    @endif
                    @if($title != 'login')
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('login')}}">
                                <button type="button" class="btn btn-custom-primary-outline">Login</button>
                            </a>
                        </li>
                    @endif
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('dashboard')}}">
                            <button type="button" class="btn btn-custom-primary-outline">Dashboard</button>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('logout')}}">
                            <button type="button" class="btn btn-custom-primary-outline">Logout</button>
                        </a>
                    </li>
                @endif
            </ul>

            @yield('content')
        </div>
    </div>
</section>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>

<script src="{{asset('js/bootstrap.min.js')}}" ></script>
<script src="{{asset('js/app.js')}}" ></script>
@yield('scripts')

</body>
</html>
