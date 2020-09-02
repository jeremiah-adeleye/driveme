<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-100" >
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}" >
    <link rel="stylesheet" href="{{asset('css/app.css')}}" >
    <link rel="stylesheet" href="{{asset('css/user/dashboard.css')}}" >
    <title>Drive me</title>
    <style>
        body {
            height: 100%;
        }
        .sidenav {
            width: 25rem;
            background: #000000;
            height: 100%;
            transition: width .5s;
        }
        .sidenav.hide {
            width: 0;
        }
        #dashboard-content {
            background: #f8f8f8;
        }
        .close-btn {
        }
    </style>
    @yield('head')
</head>
<body class="d-flex flex-column" >

<div class="dashboard-cover d-flex flex-row flex-grow-1" >
    <div class="sidenav" >
        <div class="close-btn" ><i class="fa fas-tim" ></i></div>
    </div>
    <section id="dashboard-content" class="container-fluid flex-grow-1" >
        @yield('content')
    </section>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="{{asset('js/bootstrap.min.js')}}" ></script>
<script src="{{asset('js/app.js')}}" ></script>
@yield('scripts')
</body>
</html>
