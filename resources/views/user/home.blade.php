@extends('layout.dashboard')

@section('head')
    <link rel="stylesheet" href="{{asset('css/calender.css')}}" >
    <style>
        #registered-drivers {background: #021827}
        #unavailable-drivers {background: #F9AA29}
        #available-drivers {background: #20ADF2}
        #videos {background: #2BAB7B}
        #videos-completed {background: #6FCF97}

        .statistics {
            margin-top: 2rem;
            padding: 2rem;
            border-radius: 5px;
            color: #ffffff;
        }
        .statistics .stat-cover {
            align-items: center;
        }
        .statistics .icon {
            width: 3rem;
            height: 3rem;
            border-radius: 50%;
            background: #ffffff;
        }

        .statistics .no {
            text-align: right;
            margin-left: 1rem;
        }

        .statistics .desc {
            margin-top: 1rem;
            margin-bottom: 0;
        }

        .statistics-lg .no {
            font-size: 2rem;
            align-self: flex-end;
        }
    </style>
@endsection

@section('content')
    <div class="row" >
        <div class="col-md-8" >
           
{{-- Success here --}}
@if(session()->has('success'))
<div class="alert alert-success alert-dismissible fade show">
    {{ session()->get('success') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

            <div class="row" >
                
                <div class="col-xl-4 col-lg-6">
                    <div class="statistics" id="unavailable-drivers" >
                        <div class="d-flex stat-cover" >
                            <div class="icon" ></div>
                            <div class="no flex-grow-1" >2557</div>
                        </div>
                        <p class="desc" >Number of Hired Drivers</p>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6" >
                    <div class="statistics" id="available-drivers" >
                        <div class="d-flex stat-cover" >
                            <div class="icon" ></div>
                            <div class="no flex-grow-1" >{{$noHiredVehicle}}</div>
                        </div>
                        <p class="desc" >Number of Hired Vehicles</p>
                    </div>
                </div>
                @foreach ($drivingPlans as $plan)
                    <div class="col-md-6">
                        <a href="{{route('course.video', ['id' => 1, 'videoId' => 1])}}">
                            <div class="statistics statistics-lg" style="background: {{$plan->bg_color}}">
                                <div class="d-flex stat-cover" >
                                    <div>
                                        <div class="icon" ></div>
                                    <p class="desc" ><span class="h5">{{$plan->title}} Plan</span>  
                                        <br/>
                                        Number
                                        of Videos Completed</p>
                                    </div>
                                    <div class="no flex-grow-1" >{{$plan->completed_videos}}</div>
                                </div>
                            </div>
                        </a>
                   
                    </div>

                        <div class="col-md-6">
                            

                        <a href="">
                            <div class="statistics statistics-lg" style="background: {{$plan->bg_color}}">
                                <div class="d-flex stat-cover" >
                                    <div>
                                        <div class="icon" ></div>
                                    <p class="desc" ><span class="h5">{{$plan->title}} Plan</span>  
                                        <br/>
                                        Number
                                        of Test Completed</p>
                                    </div>
                                    <div class="no flex-grow-1" >{{$plan->completed_test}}</div>
                                </div>
                            </div>
                        </a>
                    
                        
                        {{-- title
                            +"completed_videos": 0
      +"completed_test": 0 --}}
    </div>
    @endforeach

                    </div>
        </div>
        <div class="col-md-3 mx-auto" >
            <div class="calender-cover mt-5" >
                <div id="calendar"></div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src='https://npmcdn.com/react@15.3.0/dist/react.min.js'></script>
    <script src='https://npmcdn.com/react-dom@15.3.0/dist/react-dom.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.14.1/moment-with-locales.min.js'></script>
    <script src="{{asset('js/calender.js')}}" ></script>
@endsection
