<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-100" >
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}" >
    <link rel="stylesheet" href="{{asset('css/app.css')}}" >
    <link rel="stylesheet" href="{{asset('css/dashboard.css')}}" >
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
{{-- <script src="https://code.jquery.com/jquery-3.3.1.js"></script> --}}
    <title>Drive me</title>
    <script>
        .hover{
            
        }
    </script>
    @yield('head')
</head>
<body class="d-flex flex-column" >

<div class="dashboard-cover d-flex flex-row flex-grow-1" >
    <div class="sidenav d-flex flex-column" >
        <div class="close-btn" ><i class="fa fas-tim" ></i></div>
        <div id="logo" >
            <img src="{{ asset('img/driveme_logo.png') }}" alt="logo" >
        </div>
        <div id="menu-items" class="flex-grow-1" >
            <a class="menu-item @if($active == 'admin.feed') active @endif" href="{{route('feed')}}" >
                <img src="{{ asset('img/icons/bar_chart.png') }}" class="menu-item-icon" alt="ic" >
                <p>Feed</p>
            </a>
            <a class="menu-item @if($active == 'dashboard.home') active @endif" href="{{route('dashboard')}}" >
                <img src="{{ asset('img/icons/bar_chart.png') }}" class="menu-item-icon" alt="ic" >
                <p>Dashboard</p>
            </a>
            <a class="menu-item @if($active == 'dashboard.users') active @endif" href="{{route('all.users')}}" >
                <img src="{{ asset('img/icons/online_driving.png') }}" class="menu-item-icon" alt="ic" >
                <p>All Users</p>
            </a>
            <a class="menu-item @if($active == 'dashboard.drivers') active @endif" >
                <img src="{{ asset('img/icons/user_icon.png') }}" class="menu-item-icon" alt="ic" >
                <p>Drivers</p>
            </a>
            <a class="menu-item @if($active == 'dashboard.corporate') active @endif" >
                <img src="{{ asset('img/icons/user_icon.png') }}" class="menu-item-icon" alt="ic" >
                <p>Corporates</p>
            </a>
            {{-- <a class="menu-item @if($active == 'dashboard.users') active @endif">
                <img src="{{ asset('img/icons/online_driving.png') }}" class="menu-item-icon" alt="ic" >
                <p>Users</p>
            </a> --}}
        </div>
    </div>
    <section id="dashboard-content" class="flex-grow-1" >
        <div class="top-nav d-flex">
            {{-- <div class="search"> <img src="{{ asset('img/icons/searche.png') }}" alt="search icon" /></div> --}}
            <p class="search h-100 d-flex align-items-center">Logged in as Admin</p>
            
            <div class="profile-icon d-flex pointer">
            <div>
                <img class="profile-thumbnail" src="{{ asset('img/icons/thumbnail.jpg') }}" alt="user profile image" />
            </div>
                
        <div class="">{{auth()->user()->first_name}}</div>
                <div class="dropdown dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                     
                </div>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="{{ route('logout') }}">Logout</a>
                </div>
            </div>
        </div>
        {{-- <ul id="top-nav" class="nav justify-content-end ">
            <li class="nav-item">
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
                        <span id="username-icon" >{{ strtoupper(auth()->user()->first_name[0] . '.' . auth()->user()->last_name[0])}}</span>
                        {{ ucfirst(auth()->user()->first_name) }}
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="{{ route('logout') }}">Logout</a>
                    </div>
                </div>
            </li>
        </ul> --}}
        <div class="p-3" >
            @yield('content')
        </div>
    </section>
</div>


{{-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> --}}
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
{{-- <link href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" rel="stylesheet">   --}}
{{-- <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script> --}}
<script src="{{asset('js/bootstrap.min.js')}}" ></script>
<script src="https://kit.fontawesome.com/768a7cb0ff.js" crossorigin="anonymous"></script>
<script src="{{asset('js/app.js')}}" ></script>
@yield('scripts')
</body>
</html>