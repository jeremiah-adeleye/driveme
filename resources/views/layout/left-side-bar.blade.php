{{-- <div class="sidenav d-flex flex-column" >
    <div class="close-btn" ><i class="fa fas-tim" ></i></div>
    <div id="logo" >
        <img src="{{ asset('img/driveme_logo_white.png') }}" alt="logo" >
    </div>
    <div id="menu-items" class="flex-grow-1" >
        <a class="menu-item @if($active == 'dashboard.complete-registration') active @endif" href="@if(auth()->user()->role == 1) {{route('user.complete-registration')}} @else {{route('corporate.complete-registration')}} @endif" >
            <img src="{{ asset('img/icons/bar_chart.png') }}" class="menu-item-icon" alt="ic" >
            <p>Update profile</p>
        </a>
        <a class="menu-item @if($active == 'dashboard.home') active @endif" href="{{route('dashboard')}}" >
            <img src="{{ asset('img/icons/bar_chart.png') }}" class="menu-item-icon" alt="ic" >
            <p>Dashboard</p>
        </a>
        <a class="menu-item @if($active == 'dashboard.hireDriver') active @endif" href="{{ route('user.hire-type') }}" >
            <img src="{{ asset('img/icons/user_icon.png') }}" class="menu-item-icon" alt="ic" >
            <p>Hire a Driver</p>
        </a>
        @if(auth()->user()->role == 1)
            <a class="menu-item @if($active == 'dashboard.onlineDriving') active @endif" href="{{route('online-driving')}}" >
                <img src="{{ asset('img/icons/online_driving.png') }}" class="menu-item-icon" alt="ic" >
                <p>Online Driving </p>
            </a>
        @else
            <a class="menu-item @if($active == 'dashboard.driverTraining') active @endif">
                <img src="{{ asset('img/icons/driver_training.png') }}" class="menu-item-icon" alt="ic" >
                <p>Driver Training</p>
            </a>
        @endif
        <a class="menu-item @if($active == 'dashboard.rentVehicle') active @endif">
            <img src="{{ asset('img/icons/hire_vehicle.png') }}" class="menu-item-icon" alt="ic" >
            <p>Hire/Rent a vehicle</p>
        </a>
        <a class="menu-item @if($active == 'dashboard.fleetManagement') active @endif">
            <img src="{{ asset('img/icons/fleet_management.png') }}" class="menu-item-icon" alt="ic" >
            <p>Fleet Management</p>
        </a>
    </div>
</div> --}}