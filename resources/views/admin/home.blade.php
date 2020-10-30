@extends('admin.layout.dashboard')

@section('head')
    <style>
        #feed-cover {
            height: 75vh;
            overflow-y: auto;
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
        }

        .feed {
            margin-bottom: 1rem;
        }

        .feed .message {
            margin-bottom: 0.2rem;
        }
        .media img{
            width: 70px;
            height: 70px;
        }
        .muted{
            color: #abafb3;
        }
        .pry-color{
            color: #00a2ff;
        }
        .red-color{
            color: #FF5722;
        }
        .yellow-color{
            color: #FFC107;
        }
        .bg-blue{
            background: #00a2ff;
        }
        .driver-img{
            width: 30px;
            height: 33px;
        }
        .grey{
            color: #6a707e;
        }
    </style>
@endsection

@section('content')

<div class="row">
    <div class="col-md-4 col-sm-12">

        <div class="card">
            <a href="{{route('all.users')}}">
            <div class="card-body">
                <div class="stat-widget-two">
                    <div class="media">
                        <div class="media-body">

                                <h2 class="mt-0 mb-1 pry-color ">{{count($allUser)}}</h2><span class="muted">Total Users</span>
                            </div>
                            <img class="ml-3" src="{{ asset('img/icons/1.png') }}" alt="">
                        </div>
                    </div>
                </div>
            </a>
        </div>
        
    </div>
    <div class="col-md-4 col-sm-12">

        <div class="card">
            <a href="">
            <div class="card-body">
                <div class="stat-widget-two">
                    <div class="media">
                        <div class="media-body">
                        <h2 class="mt-0 mb-1 red-color ">{{count($allDriver)}}</h2><span class="muted">Active Drivers</span>
                        </div>
                        <img class="ml-3" src="{{ asset('img/icons/2.png') }}" alt="">
                    </div>
                </div>
            </div>
        </a>
        </div>
        
    </div>
    <div class="col-md-4 col-sm-12">

        <div class="card">
            <a href="">

                <div class="card-body">
                    <div class="stat-widget-two">
                        <div class="media">
                            <div class="media-body">
                                <h2 class="mt-0 mb-1 yellow-color ">{{count($hiredDrivers)}}</h2><span class="muted">Drivers with Clients</span>
                            </div>
                            <img class="ml-3" src="{{ asset('img/icons/3.png') }}" alt="">
                        </div>
                    </div>
                </div>
            </a>
        </div>
        
    </div>
</div>
        <p class="pt-4">
            <button class="btn btn-info bg-blue">Show total number of requests received</button>    
        </p>
        <div class="row">

        
<div class="col-lg-12">

    <div class="card">
        <div class="card-body">
            <div class="row">
                
                <div class="col-sm-4 mb-sm-0">
                    <a href="">
                        <div class="py-2">
                            <div class="d-flex">
                                <img class="mr-4 mt-3 driver-img" src="{{ asset('img/icons/4.png') }}" alt="">
                                <div class="media-body">
                                <h2 class="mt-0 mb-1 text-info">{{count($shortTimeDriversRequest)}}</h2>
                                    <span class="text-pale-sky grey">Fulltime Driver Request</span>
                                </div>
                            </div>
                        </div>
                    </a>
                    </div>
                
                <div class="col-sm-4 mb-sm-0">
                    <a href="">
                        <div class="py-2">
                            <div class="d-flex">
                                <img class="mr-4 mt-3 driver-img" src="{{ asset('img/icons/5.png') }}" alt="">
                                <div class="media-body">
                                <h2 class="mt-0 mb-1 text-success">{{count($fullTimeDriversRequest)}}</h2>
                                    <span class="text-pale-sky grey">Short Term Driver Request</span>
                                </div>
                            </div>
                        </div>
                    </a>
                    </div>

                <div class="col-sm-2">
                    <div class="py-2" onclick="window.location.href='fulltime-driver'">
                        <div class="d-flex">
                            <img class="mr-4 mt-3 driver-img" src="{{ asset('img/icons/7.png') }}" alt="">
                            <div class="media-body">
                                <h2 class="mt-0 mb-1 text-warning">0</h2>
                                <span class="text-pale-sky grey">FullTime Processing</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="py-2">
                        <div class="d-flex">
                            <img class="mr-4 mt-3 driver-img" src="{{ asset('img/icons/7.png') }}" alt="">
                            <div class="media-body">
                                <h2 class="mt-0 mb-1 text-warning">0</h2>
                                <span class="text-pale-sky grey">ShortTerm Going</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
</div>
<div class="row">

    <div class="col-lg-12">
        <div class=" transparent-card mt-5">
           <h6>Fulltime Driver Requests</h6>
            <div class="p-0">
                <div class="table-responsive">
                    <table class="table table-padded recent-order-list-table table-responsive-fix-big muted">
                        <thead>
                            <tr>
                                <th>#No</th>
                                <th>First name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>


            </div>
        </div>
    </div>

</div>
    {{-- <div class="row" >
        <div class="col-md-6" >

        </div>
        <div class="col-md-6" id="feed-cover">
            <p class="h5" >Feed</p>
            <hr>
            <ul>
                @foreach ($notifications as $notification)
                    <a href="{{$notification->link}}" >
                        <div class="card feed">
                            <div class="card-body">
                                <p class="message" >{{ $notification->notification }}</p>
                                <small class="card-subtitle mb-2 text-muted">{{$notification->created_at}}</small>
                            </div>
                        </div>
                    </a>
                @endforeach
            </ul>
        </div>
    </div> --}}
@endsection
