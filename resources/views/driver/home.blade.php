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
    </style>
@endsection

@section('content')
    <div class="row" >
        <div class="col-lg-6" >
            <div id="details" class="content" >
                <div class="passport" >
                    <img src="" alt="passport" >
                </div>
                <p id="name" >{{ucwords($user->first_name.' '.$user->last_name)}}</p>
                <p id="location" class="text-muted" >Surulere, Lagos</p>
                <hr class="dashboard-divider" >
                <div id="rating" >
                    <p class="title" >Employer rating</p>
                </div>
                <hr class="dashboard-divider" >
                <div id="verification-status" >
                    <p class="title" >Verification Status</p>
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
