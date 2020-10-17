@extends('layout.dashboard')

@section('head')
    <style>
       

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
        .myBtnPd{
            padding: 12px 25px;
        }
        .myBtn, .submit:hover{
            
            color: #20ADF2;
            background: #ffffff;
            border: 1px solid #20ADF2;
        }
        .myBtn:hover, .submit{
            /* padding: 12px 25px; */
            background: #20ADF2;
            color: #ffffff;
            border: 1px solid #20ADF2;
        }
        #car-container img{
            width: 100%;
            height: 100%;
        }
        .primaryColor{
            color: #20ADF2;
        }
        .error{
            color: red;
        }
    </style>
@endsection

@section('content')
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

    <div id="all-vehicles">
      
            
        <div id="single-car" class="w-100 bg-white d-flex">
            <div id="car-container" class="h-100 w-25">
                <img src="{{asset('img/car-1.png')}}" alt="car detail" />
            </div>
            <div id="content" class="w-75">
            <p id="title">{{$singleCar->make}}</p>
                <div class="row">
                    <p class="col-sm">Condition: {{$singleCar->condition}}</p>
                    <p class="col-sm">Type: {{$singleCar->type}}</p>
                    <p class="col-sm">Make: {{$singleCar->make}}</p>
                </div>
                <div class="row">
                    <p class="col-4">Fabrication: {{$singleCar->fabrication}}</p>
                    <p class="col-4">Number of Seats: {{$singleCar->capacity}}</p> 
                </div>
                <div id="car-footer" class="row my-5 d-flex align-items-center">
                    <p class="col-8 amount">N{{$singleCar->amount_day}}/Day</p>
                    
                </div>
            </div>
        </div>
        
        {{-- <form method="post" class="bg-white w-100" action="{{route('hire-vehicle')}}"> --}}
        <form method="POST" class="bg-white w-100"  action="{{ route('hire-vehicle') }}" accept-charset="UTF-8">
            
           <div class="col-6 p-5">

               <p class="primaryColor">Vehicle Hire Information</p>
               <div class="form-group">
               <label for="duration">How many days </label>
               <div>
                   <input type="text" name="duration"  class="form-control" id="duration" required>
                  <span class="error">{{$errors->first('duration')}}</span> 
                </div>
            </div>
            <div class="form-group">
                <label for="delivery-date">Delivery Date </label>
                <div>
                    <input type="date"  class="form-control" name="delivery-date" id="" required>
                    <span class="error">{{$errors->first('delivery-date')}}</span> 
                </div>
            </div>
            <div class="form-group">
                <label for="delivery-time">Delivery Time </label>
                <div>
                    <input type="time" name="delivery-time" class="form-control" id="delivery-time" required>
                    <span class="error">{{$errors->first('delivery-time')}}</span> 
                </div>
            </div>
            <div class="form-group">
                <label for="address">Address </label>
                <div class="">
                    <input type="text" class="form-control" name="address" id="address" required>
                    <span class="error">{{$errors->first('address')}}</span> 
                </div>
            </div>
            <button type="submit" class="btn submit w-100">Hire Vehicle</button>
            @csrf
        </div>
        
        <div class="col-md-8 col-md-offset-2">
        
            <input type="hidden" name="email" value={{$userEmail}}> {{-- required --}}
           {{-- the code below should be uncommented and comment the current active one so as to allow dynamic payment --}}
            {{-- <input type="hidden" name="amount" value={{$amountPayable}}> required in kobo --}}
            <input type="hidden" name="amount" value="800"> {{-- required in kobo --}}
            <input type="hidden" name="quantity" value="1">
            <input type="hidden" name="currency" value="NGN">
            <input type="hidden" name="metadata" value="{{ json_encode($array = ['purpose' => 'hire_vehicle', 'vehicle_id'=>$singleCar->id, 'order_id'=> 1, 'email'=>$userEmail])}}" > {{-- For other necessary things you want to add to your payload. it is optional though --}}
            <input type="hidden" name="reference" value="{{ Paystack::genTranxRef() }}"> {{-- required --}}
            {{ csrf_field() }} {{-- works only when using laravel 5.1, 5.2 --}}

            <input type="hidden" name="_token" value="{{ csrf_token() }}"> {{-- employ this in place of csrf_field only in laravel 5.0 --}}

           
        </div>
    </div>
    
</div>
</form>
    {{-- <form method="POST" action="{{ route('pay') }}" accept-charset="UTF-8" class="form-horizontal" role="form">
        <div class="row" style="margin-bottom:40px;">
            
                <input type="hidden" name="email" value="otemuyiwa@gmail.com"> {{-- required --}}
                {{-- <input type="hidden" name="orderID" value="345"> --}}
                {{-- <input type="hidden" name="amount" value="800"> required in kobo --}}
                {{-- <input type="hidden" name="quantity" value="3"> --}}
                {{-- <input type="hidden" name="currency" value="NGN"> --}}
                {{-- <input type="hidden" name="metadata" value="{{ json_encode($array = ['key_name' => 'value',]) }}" > For other necessary things you want to add to your payload. it is optional though --}}
                {{-- <input type="hidden" name="reference" value="{{ Paystack::genTranxRef() }}"> required --}}
                {{-- {{ csrf_field() }} works only when using laravel 5.1, 5.2 --}}
    
                {{-- <input type="hidden" name="_token" value="{{ csrf_token() }}"> employ this in place of csrf_field only in laravel 5.0 --}}
    
               
            {{-- </div> --}}
        {{-- </div> --}}
    {{-- </form> --}}
@endsection