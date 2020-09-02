@extends('layout/auth', ['title' => $title])

@section('head')
    <link rel="stylesheet" href="{{asset('css/register.css')}}" >
@endsection

@section('intro')
    <div id="auth-intro-text" class="col-sm-8" >
        <h1>Join over 3,000 drivers in the country</h1>
        <h5>Benefits</h5>
        <ul style="list-style-type: none" >
            <li>1. Competitive salary</li>
            <li>2. Free Registration</li>
            <li>3. Easy access to jobs</li>
        </ul>
    </div>
@endsection

@section('content')
    <div class="my-auto" >
        <div id="form-into" class="col-lg-12" >
            <h1>Create an account</h1>
            <p>Sign up with your email and password to create an account</p>
        </div>

        <form class="col-lg-12" method="post" enctype="multipart/form-data" >
            <div class="mb-4" >
                @if(session()->has('error'))
                    <div class="alert alert-danger alert-dismissible fade show">
                        {{ session()->get('error') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @elseif(session()->has('success'))
                    <div class="alert alert-success alert-dismissible fade show">
                        {{ session()->get('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
            </div>

            {{ csrf_field() }}
            <div class="row" >
                <div class="form-group custom col-md-6" id="first-name-input" >
                    <label for="first-name">First Name</label>
                    <input type="text" class="form-control input-custom-primary" id="first-name" name="first_name" aria-describedby="firstName" value="{{ old('first_name') }}" >
                    @error('first_name')
                    <small class="text-danger" >{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group custom col-md-6" id="last-name-input" >
                    <label for="last-name">Last Name</label>
                    <input type="text" class="form-control input-custom-primary" id="last-name" name="last_name"  aria-describedby="lastName" value="{{ old('last_name') }}" >
                    @error('last_name')
                    <small class="text-danger" >{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group custom col-md-6" id="email-input" >
                    <label for="email">Email Address</label>
                    <input type="email" class="form-control input-custom-primary" id="email" name="email" aria-describedby="email" value="{{ old('email') }}" >
                    @error('email')
                    <small class="text-danger" >{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group custom col-md-6" id="phone-number-input" >
                    <label for="phone-number">Phone Number</label>
                    <input type="tel" class="form-control input-custom-primary" id="phone-number" name="phone_number" aria-describedby="phoneNumber" value="{{ old('phone_number') }}" >
                    @error('phone_number')
                    <small class="text-danger" >{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group custom col-md-6" id="dob-input" >
                    <label for="dob">Date of Birth</label>
                    <input type="date" class="form-control input-custom-primary" id="dob" name="dob" aria-describedby="dateOfBirth" value="{{ old('dob') }}" >
                    @error('dob')
                    <small class="text-danger" >{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group custom col-md-6" id="location-input" >
                    <label for="location">Location</label>
                    <input type="text" class="form-control input-custom-primary" id="location" name="location" aria-describedby="location" value="{{ old('location') }}" >
                    @error('location')
                    <small class="text-danger" >{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group custom col-md-6" id="location-input" >
                    <label for="salary-range">Salary Range <small>(amount you want to be paid)</small></label>
                    <input type="text" class="form-control input-custom-primary" id="salary-range" name="salary_range" aria-describedby="salaryRange" value="{{ old('salary_range') }}" >
                    @error('salary_range')
                    <small class="text-danger" >{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group custom col-md-6" id="password-input" >
                    <label for="password">Password</label>
                    <div class="input-group right" >
                        <input type="password" class="form-control input-custom-primary" id="password" name="password" aria-describedby="password" placeholder="Must contain uppercase, lowercase, number and special character" >
                        <div class="input-group-append" id="toggle-password" data-target="#password" >
                            <div class="input-group-text">
                                <i class="fa fa-eye icon"></i>
                            </div>
                        </div>
                    </div>
                    @error('password')
                    <small class="text-danger" >{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group custom col-md-6" id="address-input" >
                    <label for="address">Residential Address <small>(home address)</small></label>
                    <input type="text" class="form-control input-custom-primary" id="address" name="address" aria-describedby="address" value="{{ old('address') }}" >
                    @error('address')
                    <small class="text-danger" >{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group custom col-md-6" id="licence-number-input" >
                    <label for="licence-number">Licence Number</label>
                    <input type="text" class="form-control input-custom-primary" id="licence-number" name="licence_number" aria-describedby="licenceNumber" value="{{ old('licence_number') }}" >
                    @error('licence_number')
                    <small class="text-danger" >{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group custom col-md-6" id="experience-input" >
                    <label for="experience">Driver’s Experience Years</label>
                    <input type="number" class="form-control input-custom-primary" id="experience" name="experience" aria-describedby="experience" value="{{ old('experience') }}" >
                    @error('experience')
                    <small class="text-danger" >{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group custom col-md-6" id="vehicle-type-input" >
                    <label for="vehicle-type">What kind of Vehicle do you drive?</label>
                    <input type="text" class="form-control input-custom-primary" id="vehicle-type" name="vehicle_type" aria-describedby="carType" value="{{ old('vehicle_type') }}" >
                    @error('vehicle_type')
                    <small class="text-danger" >{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group custom col-md-6 dv-image-input" id="cv-input-number-input" >
                    <label for="cv">Upload Your CV</label><br>
                    <label for="cv" class="input-label" data-target="#cv" ></label>
                    <input type="file" id="cv" name="cv" aria-describedby="cv" value="{{ old('cv') }}" >
                    @error('cv')
                    <small class="text-danger" >{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group custom col-md-6 dv-image-input" id="passport-input" >
                    <label for="passport">Passport Photography</label><br>
                    <label for="passport" class="input-label" data-target="#passport" ></label>
                    <input type="file" id="passport" name="passport" aria-describedby="passport" value="{{ old('passport') }}" >
                    @error('passport')
                    <small class="text-danger" >{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group custom col-12" id="register-button" >
                    <button type="submit" class="btn btn-custom-primary">Register</button>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    <script src="{{asset('js/register.js')}}" ></script>
@endsection
