@extends('layout/app', ['title' => 'driver dashboard'])

@section('head')
    <link rel="stylesheet" href="{{asset('css/dashboard.css')}}" >
@endsection

@section('content')
    <section id="dashboard-section" class="d-flex flex-column" >
        <p class="font-weight-bold px-4 mb-5 text-primary" >Edit Profile</p>
        <div class="row my-auto">
            <div class="col-md-4" >
                <div class="form-group custom col-md-10 text-center dv-image-input" id="profile-input" >
                    <label for="profile-pic" class="input-label passport-placeholder" data-target="#passport" ></label><br>
                    <label for="profile-pic">Tap to change Picture</label>
                    <input type="file" id="profile-pic" name="profile_pic" aria-describedby="passport">
                </div>
            </div>
            <div class="col-lg-8 px-5">
                <form method="post" action="{{route('driver.update')}}" enctype="multipart/form-data" >
                    {{ csrf_field() }}
                    <div class="row" >
                        <div class="form-group custom col-md-6" id="first-name-input" >
                            <label for="first-name">First Name</label>
                            <input type="text" class="form-control input-custom-primary" id="first-name" name="first_name" aria-describedby="firstName" value="{{$user->first_name}}" >
                        </div>

                        <div class="form-group custom col-md-6" id="last-name-input" >
                            <label for="last-name">Last Name</label>
                            <input type="text" class="form-control input-custom-primary" id="last-name" name="last_name"  aria-describedby="lastName" value="{{$user->last_name}}" >
                        </div>

                        <div class="form-group custom col-md-6" id="email-input" >
                            <label for="email">Email Address</label>
                            <input type="email" class="form-control input-custom-primary" id="email" name="email" aria-describedby="email" value="{{$user->email}}" >
                        </div>

                        <div class="form-group custom col-md-6" id="phone-number-input" >
                            <label for="phone-number">Phone Number</label>
                            <input type="tel" class="form-control input-custom-primary" id="phone-number" name="phone_number" aria-describedby="phoneNumber" value="{{$user->phone_number}}" >
                        </div>

                        <div class="form-group custom col-md-6" id="dob-input" >
                            <label for="dob">Date of Birth</label>
                            <input type="date" class="form-control input-custom-primary" id="dob" name="dob" aria-describedby="dateOfBirth" value="{{$driver->dob}}" >
                        </div>

                        <div class="form-group custom col-md-6" id="location-input" >
                            <label for="location">Location</label>
                            <input type="text" class="form-control input-custom-primary" id="location" name="location" aria-describedby="location" value="{{$driver->location}}" >
                        </div>

                        <div class="form-group custom col-md-6" id="location-input" >
                            <label for="salary-range">Salary Range <small>(amount you want to be paid)</small></label>
                            <input type="text" class="form-control input-custom-primary" id="salary-range" name="salary_range" aria-describedby="salaryRange" value="{{$driver->salary_range}}" >
                        </div>

                        <div class="form-group custom col-md-6" id="password-input" >
                            <label for="password">Password</label>
                            <input type="password" class="form-control input-custom-primary" id="password" name="password" aria-describedby="password" placeholder="********************" >
                        </div>

                        <div class="form-group custom col-md-6" id="address-input" >
                            <label for="address">Residential Address <small>(home address)</small></label>
                            <input type="text" class="form-control input-custom-primary" id="address" name="address" aria-describedby="address" value="{{$driver->address}}" >
                        </div>

                        <div class="form-group custom col-md-6" id="licence-number-input" >
                            <label for="licence-number">Licence Number</label>
                            <input type="text" class="form-control input-custom-primary" id="licence-number" name="licence_number" aria-describedby="licenceNumber" value="{{$driver->licence_number}}" >
                        </div>

                        <div class="form-group custom col-md-6" id="experience-input" >
                            <label for="experience">Driver’s Experience Years</label>
                            <input type="number" class="form-control input-custom-primary" id="experience" name="experience" aria-describedby="experience" value="{{$driver->experience}}" >
                        </div>

                        <div class="form-group custom col-md-6" id="vehicle-type-input" >
                            <label for="vehicle-type">What kind of Vehicle do you drive?</label>
                            <input type="text" class="form-control input-custom-primary" id="vehicle-type" name="vehicle_type" aria-describedby="vehicle_type" value="{{$driver->vehicle_type}}" >
                        </div>

                        <div class="form-group custom col-md-6 dv-image-input" id="cv-input-number-input" >
                            <label for="cv">Upload Your CV</label><br>
                            <label for="cv" class="input-label" data-target="#cv"
                               @if($driver->cv != null)
                                   style="background: url('{{$driver->cv}}') no-repeat center; background-size: contain;"
                                @endif
                            ></label>
                            <input type="file" id="cv" name="cv" aria-describedby="cv" value="{{ $driver->cv }}" >
                        </div>

                        <div class="form-group custom col-md-6 dv-image-input" id="passport-input" >
                            <label for="passport">Passport Photography</label><br>
                            <label for="passport" class="input-label" data-target="#passport"
                               @if($driver->passport != null)
                                   style="background: url('{{$driver->passport}}') no-repeat center; background-size: contain;"
                               @endif
                            ></label>
                            <input type="file" id="passport" name="passport" aria-describedby="passport" value="{{ $driver->passport }}" >
                        </div>

                        <div class="form-group custom col-12" id="register-button" >
                            <button type="submit" class="btn btn-custom-primary">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script src="{{asset('js/register.js')}}" ></script>
@endsection
