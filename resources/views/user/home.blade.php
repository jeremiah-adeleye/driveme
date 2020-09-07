@extends('user.layout.dashboard')

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
        }
    </style>
@endsection

@section('content')
    <div class="row" >
        <div class="col-md-8" >
            <div class="row" >
                <div class="col-xl-4 col-lg-6">
                    <div class="statistics" id="registered-drivers" >
                        <div class="d-flex stat-cover" >
                            <div class="icon" ></div>
                            <div class="no flex-grow-1" >3000</div>
                        </div>
                        <p class="desc" >Number of Registered Drivers</p>
                    </div>
                </div>
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
                            <div class="no flex-grow-1" >433</div>
                        </div>
                        <p class="desc" >Number of Available Drivers</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="statistics statistics-lg" id="videos" >
                        <div class="d-flex stat-cover" >
                            <div>
                                <div class="icon" ></div>
                                <p class="desc" >Number of Videos Completed</p>
                            </div>
                            <div class="no flex-grow-1" >0</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="statistics statistics-lg" id="videos-completed" >
                        <div class="d-flex stat-cover" >
                            <div>
                                <div class="icon" ></div>
                                <p class="desc" >Number of Test Completed</p>
                            </div>
                            <div class="no flex-grow-1" >0</div>
                        </div>
                    </div>
                </div>
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
