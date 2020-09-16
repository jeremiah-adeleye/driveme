@extends('driver.layout.dashboard', ['title' => 'driver dashboard'])

@section('head')
    <style>
        #employer-comment, #employer-details {
            height: 40vh;
            margin-bottom: 2rem;
            overflow-y: auto;
        }

        #employer-comment .title, #employer-details .title {
            padding-top: 1rem;
            padding-bottom: 1rem;
            padding-left: 1rem;
            border-bottom: 2px solid #2BAB7B;
        }

        .progress {
            height: 0.5rem;
        }
    </style>
@endsection

@section('content')
    <div class="row" >
        <div class="col-lg-6" >
            <div id="details" class="content" >
                <div class="passport" >
                    @if(!empty($driver->passport))
                        <img src="" alt="passport" >
                    @endif
                </div>
                <p id="name" >{{ucwords($user->first_name.' '.$user->last_name)}}</p>
                <p id="location" class="text-muted" >@if($driver->approval_status != null) {{$driver->address}}, {{$driver->state_of_residence}} @endif</p>
                <hr class="dashboard-divider" >
                <div id="rating" >
                    <p class="title" >Employer rating</p>
                </div>
                <hr class="dashboard-divider" >
                <div id="verification-status" >
                    <p class="title" >Verification Status</p>
                    <div class="progress my-2">
                        <div class="progress-bar bg-success w-{{$percentDone}}" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <p id="registration-status" class="text-left" >{{$percentDone}}%</p>

                    @if($driver->approval_status == 1 || $driver->approval_status == null)
                        <p id="get-verified-text" >Apply to become a driver to get verified</p>
                        <a href="{{route('driver.complete-registration')}}" ><button class="btn btn-custom-primary" >APPLY NOW</button></a>
                    @else

                    @endif
                </div>
            </div>
        </div>

        <div class="col-lg-6" >
           <div class="content" id="employer-comment" >
               <p class="title" >Employers comments</p>
           </div>
           <div class="content" id="employer-details" >
               <p class="title" >Employer Details</p>
           </div>
        </div>
    </div>
@endsection
