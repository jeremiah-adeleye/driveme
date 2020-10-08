@extends('layout.dashboard')

@section('content')
    <section id="dashboard-section" class="d-flex flex-column" >
        <p class="font-weight-bold px-4 text-primary" >Update Profile</p>

        <div class="row my-auto" >
            <div class=" col-lg-10">
                <form class="p-5" id="complete-registration-form" method="post" action="{{route('user.submit-complete-registration')}}" enctype="multipart/form-data" >
                    @if(session()->has('error'))
                        <div class="alert alert-danger alert-dismissible fade show mb-4">
                            {{ session('error') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @elseif(session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show mb-4">
                            {{ session('success') }}
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

                            <div class="form-group custom col-md-6" id="company-name-input" >
                                <label for="company-name">Company name</label>
                                <input type="text" class="form-control input-custom-primary" id="company-name" name="company_name" aria-describedby="companyName" value="{{old('company_name') ?? $corporate->company_name}}" >
                                @error('company_name')
                                <small class="text-danger" >{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group custom col-md-6" id="registration-number-input" >
                                <label for="registration-number">Registration Number</label>
                                <input type="text" class="form-control input-custom-primary" id="registration-number" name="registration_number" aria-describedby="registrationNumber" value="{{old('registration_number') ?? $corporate->registration_number}}" >
                                @error('registration_number')
                                <small class="text-danger" >{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group custom col-md-6" id="address-input" >
                                <label for="address">Address</label>
                                <input type="text" class="form-control input-custom-primary" id="address" name="address" aria-describedby="address" value="{{old('address') ?? $corporate->address}}" >
                                @error('address')
                                <small class="text-danger" >{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group custom col-12" >
                                <button type="submit" class="btn btn-custom-primary" id="save-and-continue" >COMPLETE REGISTRATION</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
