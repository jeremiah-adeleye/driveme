@extends('user.layout.dashboard')

@section('head')
    <style>
        #back {
            margin-bottom: 2rem;
        }

        #passport img {
            width: 10rem;
            height: 10rem;
            border-radius: 50%;
        }

        #driver-details {
            background: #ffffff;
            padding: 2rem;
        }

        #information {
            margin-bottom: 2rem;
        }

        .detail-sec-title {
            margin-bottom: 2rem;
        }

        #detail-value-cover {
            margin-bottom: 1rem;
        }

        #detail-value-cover .badge-pill {
            padding-top: 0.5rem;
            padding-bottom: 0.5rem;
        }

        #detail-value-cover .badge-warning {
            background: #F9AA2940;
            color: #F9AA29;
        }

        #detail-value-cover .badge-success {
            background: #74D19B40;
            color: #2BAB7B;
        }
    </style>
@endsection

@section('content')
    <div id="back" >
        <a class="h6 mb-5" href="{{route('user.drivers')}}" >Back to Driver list</a>
    </div>
    <div class="row" >
        <div class="col-lg-2" >
             <div id="passport" >
                 <img src="{{$driver->passport}}" alt="passport" >
             </div>
        </div>
        <div class="col-lg-10" >
            <div id="driver-details" >
                <div id="information" >
                    <p class="text-primary detail-sec-title" >Driver Information</p>

                    @if(session()->has('error'))
                        <div class="alert alert-danger alert-dismissible fade show">
                            {{ session('error') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    @if(session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <div class="row" >
                        <div class="col-md-4" id="detail-value-cover" >
                            <p class="detail-label text-muted" >Name of driver</p>
                            <p class="detail-value" >{{ucfirst($driver->user->first_name.' '.$driver->user->last_name)}}</p>
                        </div>
                        <div class="col-md-4" id="detail-value-cover" >
                            <p class="detail-label text-muted" >Age</p>
                            <p class="detail-value" >{{ (new DateTime($driver->dob))->diff(new DateTime('today'))->y }} Years old</p>
                        </div>
                        <div class="col-md-4" id="detail-value-cover" >
                            <p class="detail-label text-muted" >Years of experience</p>
                            <p class="detail-value" >{{$driver->experience}} Year(s)</p>
                        </div>
                        <div class="col-md-4" id="detail-value-cover" >
                            <p class="detail-label text-muted" >Address</p>
                            <p class="detail-value" >{{ucfirst($driver->address)}}, {{$driver->state}}</p>
                        </div>
                        <div class="col-md-4" id="detail-value-cover" >
                            <p class="detail-label text-muted" >Status</p>
                            @if($driver->available)
                                <span class="badge-pill badge-warning" ><i class="fas fa-circle"></i> AVAILABLE</span>
                            @else
                                <span class="badge-pill badge-success" ><i class="fas fa-circle"></i> HIRED</span>
                            @endif
                        </div>
                        <div class="col-md-4" id="detail-value-cover" >
                            <p class="detail-label text-muted" >Date registered</p>
                            <p class="detail-value" >{{date_format(new DateTime($driver->user->created_at), 'd/m/Y')}}</p>
                        </div>
                        <div class="col-md-4" id="detail-value-cover" >
                            <p class="detail-label text-muted" >Rating</p>
                        </div>
                    </div>
                </div>
                <div id="comments" >
                    <p class="text-primary detail-sec-title" >Comments</p>
                </div>

                @if($activeEmployment)
                    <button class="btn btn-custom-success" >ACTIVE EMPLOYMENT</button>
                @elseif($pendingRequest)
                    <button class="btn btn-custom-warning" >PENDING REQUEST</button>
                @else
                    <a href="{{route('user.hire-driver', ['id' => $driver->id])}}" >
                        <button class="btn btn-custom-primary" >HIRE DRIVER</button>
                    </a>
                @endif
            </div>
        </div>
    </div>
@endsection
