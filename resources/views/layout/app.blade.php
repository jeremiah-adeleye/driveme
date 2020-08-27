<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}" >
    <link rel="stylesheet" href="{{asset('css/app.css')}}" >
    <title>Drive me</title>
    @yield('head')
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light">
    <a class="navbar-brand" href="#">
        <img src="{{ asset('img/driveme_logo.png') }}" alt="logo" >
    </a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
            @if($title == 'login')
                <li class="nav-item">
                    <a class="nav-link" href="/register">
                        <button type="button" class="btn btn-custom-primary">Register</button>
                    </a>
                </li>
            @elseif($title == 'register')
                <li class="nav-item">
                    <a class="nav-link" href="/login">
                        <button type="button" class="btn btn-custom-primary">Login</button>
                    </a>
                </li>
            @else
                <li class="nav-item">
                    <a class="nav-link" href="/login">
                        <button type="button" class="btn btn-custom-primary">Login</button>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/register">
                        <button type="button" class="btn btn-custom-primary">Register</button>
                    </a>
                </li>
            @endif
        </ul>
    </div>
</nav>

<section id="content" >
    @yield('content')
</section>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="{{asset('js/bootstrap.min.js')}}" ></script>
<script src="{{asset('js/app.js')}}" ></script>
@yield('scripts')
</body>
</html>
