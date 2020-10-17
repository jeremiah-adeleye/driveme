@extends('layout.dashboard')

@section('head')
    <style>
        .course {
            min-height: 20rem;
            margin-bottom: 2rem;
            padding: 1rem;
            color: #ffffff;
            display: flex;
            flex-direction: column;
        }

        .course .description {
            width: 80%;
        }

        .course .price {
            margin-top: auto;
        }

        .course .submit {
            margin-left: auto;
            width: 35%;
        }
    </style>
@endsection

@section('content')
    <div class="row" >
        @foreach ($allPlans as $plan)
        <div class="col-md-6" >
            
       
            <form method="POST" action="{{ route('online-driving-payment') }}" accept-charset="UTF-8" class="form-horizontal" role="form">
            <div class="course" style="background: {{$plan->bg_color}}">
            <p class="title h4" >{{$plan->title}}</p>
                <p class="description" >{{$plan->description}}</p>
            <p>Time -{{$plan->lesson_period}}</p>
            <p class="no-of-lessons" >Total lessons - {{$plan->total_lessons}}</p>
            <p class="price h3" >N{{$plan->amount}}</p>
                <button class="submit btn btn-outline-light" type="submit">CHOOSE PLAN</button>
                
            </div>
            <div class="row" style="margin-bottom:40px;">
                <div class="col-md-8 col-md-offset-2">
                  
                    <input type="hidden" name="email" value={{$userEmail}}> {{-- required --}}
                    
                    <input type="hidden" name="amount" value={{$plan->amount*100}}> {{-- required in kobo --}}
                    <input type="hidden" name="order_id" value="Driving_Class">
                    <input type="hidden" name="quantity" value="1">
                    <input type="hidden" name="currency" value="NGN">
                    <input type="hidden" name="metadata" value="{{ json_encode($array = ['purpose' => 'driving curse enrollment', 'email'=> $userEmail, 'plan_id'=>$plan->id, 'order_id'=> 2]) }}" > {{-- For other necessary things you want to add to your payload. it is optional though --}}
                    <input type="hidden" name="reference" value="{{ Paystack::genTranxRef() }}"> {{-- required --}}
                    {{ csrf_field() }} {{-- works only when using laravel 5.1, 5.2 --}}
        
                    <input type="hidden" name="_token" value="{{ csrf_token() }}"> {{-- employ this in place of csrf_field only in laravel 5.0 --}}
        
                   
                </div>
            </div>
            </form>
        </div>
        @endforeach
       
        
        
    </div>
@endsection
