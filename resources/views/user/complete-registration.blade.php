@extends('user.layout.dashboard')

@section('content')
    <section id="dashboard-section" class="d-flex flex-column" >
        <p class="font-weight-bold px-4 text-primary" >Driver Application</p>

        <div class="row my-auto" >
            <div class=" col-lg-10">
                <form class="p-5" id="complete-registration-form" method="post" action="@if($driver->approval_status == null) {{route('driver.register.compete')}} @else {{route('driver.register.resubmit')}} @endif" enctype="multipart/form-data" >
                    @if(session()->has('error'))
                        <div class="alert alert-danger alert-dismissible fade show mb-4">
                            {{ session()->get('error') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @elseif(session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show mb-4">
                            {{ session()->get('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    {{ csrf_field() }}
                    <div id="driver-details" >
                        <div class="row" >
                            <div class="form-group custom col-md-12" id="first-name-input" >
                                <label for="full-name">Full Name</label>
                                <input type="text" class="form-control input-custom-primary" readonly id="full-name" aria-describedby="fullName" value="{{ucwords($user->first_name.' '.$user->last_name)}}" >
                                @error('first_name')
                                <small class="text-danger" >{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group custom col-md-6" id="email-input" >
                                <label for="email">Email Address</label>
                                <input type="email" class="form-control input-custom-primary" id="email" aria-describedby="email" value="{{$user->email}}" readonly >
                                @error('email')
                                <small class="text-danger" >{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group custom col-md-6" id="phone-number-input" >
                                <label for="phone-number">Phone Number</label>
                                <input type="tel" class="form-control input-custom-primary" id="phone-number" aria-describedby="phoneNumber" value="{{$user->phone_number}}" readonly >
                                @error('phone_number')
                                <small class="text-danger" >{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group custom col-md-6" id="car-make-input" >
                                <label for="car-make">Car make</label>
                                <input type="text" class="form-control input-custom-primary" id="car-make" name="car_make" aria-describedby="carMake" value="{{old('car_make') ?? $customer->car_make}}" >
                                @error('car_make')
                                <small class="text-danger" >{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group custom col-md-6" id="car-model-input" >
                                <label for="car-model">Car model</label>
                                <input type="text" class="form-control input-custom-primary" id="car-model" name="car_model" aria-describedby="carModel" value="{{old('car_model') ?? $customer->car_model}}" >
                                @error('car_model')
                                <small class="text-danger" >{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group custom col-md-6" id="address-input" >
                                <label for="address">Address</label>
                                <input type="text" class="form-control input-custom-primary" id="address" name="address" aria-describedby="address" value="{{old('address') ?? $customer->address}}" >
                                @error('address')
                                <small class="text-danger" >{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group custom col-md-6" id="working-hour-input" >
                                <label for="working-hour">Working hours</label>
                                <select class="custom-select input-custom-primary" id="working-hour" name="working_hour" >
                                    <option @if(old('working_hour') == '7am - 5pm' || $customer->working_hour == '7am - 5pm') selected @endif value="'7am - 5pm'">7am - 5pm</option>
                                    <option @if(old('working_hour') == '6:30am - 6pm' || $customer->working_hour == '6:30am - 6pm') selected @endif value="6:30am - 6pm'">6:30am - 6pm</option>
                                    <option @if(old('working_hour') == '7:30am - 7pm' || $customer->working_hour == '7:30am - 7pm') selected @endif value="'7:30am - 7pm'">7:30am - 7pm</option>
                                </select>
                                @error('working_hour')
                                <small class="text-danger" >{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group custom col-md-6" id="occupation-input" >
                                <label for="occupation">Occupation</label>
                                <input type="text" class="form-control input-custom-primary" id="occupation" name="occupation" aria-describedby="occupation" value="{{old('occupation') ?? $customer->occupation}}" >
                                @error('occupation')
                                <small class="text-danger" >{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group custom col-md-6" id="insurance-input" >
                                <label for="insurance-policy">Insurance policy</label>
                                <input type="text" class="form-control input-custom-primary" id="insurance-policy" name="insurance_policy" aria-describedby="insurancePolicy" value="{{old('insurance_policy') ?? $customer->insurance_policy}}" >
                                @error('insurance_policy')
                                <small class="text-danger" >{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group custom col-md-6" id="preferred-driving-city-input" >
                                <label for="preferred-driving-city">Preferred Driving city</label>
                                <input type="text" class="form-control input-custom-primary" id="preferred-driving-city" name="preferred_driving_city" aria-describedby="preferredDrivingCity" value="{{old('preferred_driving_city') ?? $customer->preferred_driving_city}}" >
                                @error('preferred_driving_city')
                                <small class="text-danger" >{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group custom col-md-6" id="driver-class-type-input" >
                                <label for="driver-class-type">Driver class type</label>
                                <select class="custom-select input-custom-primary" id="driver-class-type" name="driver_class_type" >
                                    <option hidden >Select Driver Type</option>
                                    <option @if(old('driver_class_type') == 'a' || $customer->driver_class_type == 'a') selected @endif value="'7am - 5pm'">Class A Driver</option>
                                    <option @if(old('driver_class_type') == 'b' || $customer->driver_class_type == 'b') selected @endif value="6:30am - 6pm'">Class B Driver</option>
                                    <option @if(old('driver_class_type') == 'c' || $customer->driver_class_type == 'c') selected @endif value="'7:30am - 7pm'">Class C Driver</option>
                                </select>
                                @error('driver_class_type')
                                <small class="text-danger" >{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group custom col-12" >
                                <button type="button" class="btn btn-custom-primary" id="save-and-continue" >COMPLETE REGISTRATION</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
