@extends('layout.dashboard')

@section('head')
    <style>
        #all-vehicles {
        
        }

#content{
    padding: 25px 40px 29px 18px;
}
        
#title{
    font-size: 1.25rem;
}
       
        #single-car{
            height: 284px;
            margin: 18px 0;
        }
        #car-container{
            background: #062230;
            padding: 18px;
        }
        .amount{
            font-size: 24px;
            color: #20ADF2;
            
        }
        .myBtn{
            padding: 12px 25px;
            color: #20ADF2;
            background: #ffffff;
            border: 1px solid #20ADF2;
        }
        .myBtn:hover{
            padding: 12px 25px;
            background: #20ADF2;
            color: #ffffff;
            border: 1px solid #20ADF2;
        }
        #car-container img{
            width: 100%;
            height: 100%;
        }
    </style>
@endsection

@section('content')
    <div id="all-vehicles">
        @foreach ($vehicles as $vehicle)       
        
        <div id="single-car" class="w-100 bg-white d-flex">
            <div id="car-container" class="h-100 w-25">
                <img src="{{asset('img/car-1.png')}}" alt="car detail" />
            </div>
            <div id="content" class="w-75">
            <p id="title">{{$vehicle->make}}</p>
                <div class="row">
                <p class="col-sm">Condition: {{$vehicle->condition}}</p>
                <p class="col-sm">Type: {{$vehicle->type}}</p>
                    <p class="col-sm">Make: {{$vehicle->make}}</p>
                </div>
                <div class="row">
                <p class="col-4">Fabrication: {{$vehicle->fabrication}}</p>
                <p class="col-4">Number of Seats: {{$vehicle->capacity}}</p> 
                </div>
                <div id="car-footer" class="row my-5 d-flex align-items-center">
                    <p class="col-8 amount">N{{$vehicle->amount_day}}/Day</p>
                    <p class="col-sm">
                        
                        <a href='/dashboard/view-single-vehicle/{{$vehicle->id}}' class="btn myBtn">Book Now</a>
                    </p>
                </div>
            </div>
        </div>
        @endforeach
        {{-- Another car --}}
        {{-- <div id="single-car" class="w-100 bg-white d-flex">
            <div id="car-container" class="h-100 w-25">
                <img src="{{asset('img/car-1.png')}}" alt="car detail" />
            </div>
            <div id="content" class="w-75">
                <p id="title">Toyota- Camry</p>
                <div class="row">
                    <p class="col-sm">Condition: Used</p>
                    <p class="col-sm">Type: Automatic</p>
                    <p class="col-sm">Make: Toyota</p>
                </div>
                <div class="row">
                    <p class="col-4">Fabrication: 2011</p>
                    <p class="col-4">Number of Seats: 4</p> 
                </div>
                <div id="car-footer" class="row my-5 d-flex align-items-center">
                    <p class="col-8 amount">N30,000/Day</p>
                    <p class="col-sm">
                        <a href="{{route('view-single-vehicle')}}" class="btn myBtn">Book Now</a>
                    </p>
                </div>
            </div>
        </div>
        {{-- Another car --}}
        {{-- <div id="single-car" class="w-100 bg-white d-flex">

            <div id="car-container" class="h-100 w-25">
                <img src="{{asset('img/car-1.png')}}" alt="car detail" />
            </div>
            <div id="content" class="w-75">
                <p id="title">Toyota- Camry</p>
                <div class="row">
                    <p class="col-sm">Condition: Used</p>
                    <p class="col-sm">Type: Automatic</p>
                    <p class="col-sm">Make: Toyota</p>
                </div>
                <div class="row">
                    <p class="col-4">Fabrication: 2011</p>
                    <p class="col-4">Number of Seats: 4</p> 
                </div>
                <div id="car-footer" class="row my-5 d-flex align-items-center">
                    <p class="col-8 amount">N30,000/Day</p>
                    <p class="col-sm">

                        <a href="{{route('view-single-vehicle')}}" class="btn myBtn">Book Now</a>
                    </p>
                </div>
            </div>
        </div> --}}
    </div>
@endsection

