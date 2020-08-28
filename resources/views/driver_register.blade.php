@extends('layout/app', ['title' => 'driverRegister'])

@section('head')
    <link rel="stylesheet" href="{{asset('css/register.css')}}" >
@endsection

@section('content')
    <section id="register-section" class="d-flex flex-column" >
        <p class="font-weight-bold px-4 mb-5" ><a href="/" >Homepage</a> / <span class="text-primary" >Driver Registration</span></p>
        <div class="row my-auto align-items-end">
            <div class="col-lg-6 px-5">
                <form method="post" >
                    {{ csrf_field() }}
                    <div class="row" >
                        <div class="form-group custom col-md-6" id="first-name-input" >
                            <label for="first-name">First Name</label>
                            <input type="text" class="form-control input-custom-primary" id="first-name" name="first_name" aria-describedby="firstName">
                        </div>

                        <div class="form-group custom col-md-6" id="last-name-input" >
                            <label for="last-name">Last Name</label>
                            <input type="text" class="form-control input-custom-primary" id="last-name" name="last_name"  aria-describedby="lastName">
                        </div>

                        <div class="form-group custom col-md-6" id="email-input" >
                            <label for="email">Email Address</label>
                            <input type="email" class="form-control input-custom-primary" id="email" name="email" aria-describedby="email">
                        </div>

                        <div class="form-group custom col-md-6" id="phone-number-input" >
                            <label for="phone-number">Phone Number</label>
                            <input type="tel" class="form-control input-custom-primary" id="phone-number" name="phone_number" aria-describedby="phoneNumber">
                        </div>

                        <div class="form-group custom col-md-6" id="dob-input" >
                            <label for="dob">Date of Birth</label>
                            <input type="date" class="form-control input-custom-primary" id="dob" name="dob" aria-describedby="dateOfBirth">
                        </div>

                        <div class="form-group custom col-md-6" id="location-input" >
                            <label for="location">Location</label>
                            <input type="text" class="form-control input-custom-primary" id="location" name="location" aria-describedby="location">
                        </div>

                        <div class="form-group custom col-md-6" id="location-input" >
                            <label for="salary-range">Salary Range <small>(amount you want to be paid)</small></label>
                            <input type="text" class="form-control input-custom-primary" id="salary-range" name="salary_range" aria-describedby="salaryRange">
                        </div>

                        <div class="form-group custom col-md-6" id="password-input" >
                            <label for="password">Password</label>
                            <input type="password" class="form-control input-custom-primary" id="password" name="password" aria-describedby="password">
                        </div>

                        <div class="form-group custom col-md-6" id="address-input" >
                            <label for="address">Residential Address <small>(home address)</small></label>
                            <input type="text" class="form-control input-custom-primary" id="address" name="address" aria-describedby="address">
                        </div>

                        <div class="form-group custom col-md-6" id="licence-number-input" >
                            <label for="licence-number">Licence Number</label>
                            <input type="text" class="form-control input-custom-primary" id="licence-number" name="licence_number" aria-describedby="licenceNumber">
                        </div>

                        <div class="form-group custom col-md-6" id="experience-input" >
                            <label for="experience">Driver’s Experience Years</label>
                            <input type="number" class="form-control input-custom-primary" id="experience" name="experience" aria-describedby="experience">
                        </div>

                        <div class="form-group custom col-md-6" id="vehicle-type-input" >
                            <label for="vehicle-type">What kind of Vehicle do you drive?</label>
                            <input type="text" class="form-control input-custom-primary" id="vehicle-type" name="vehicle_type" aria-describedby="carType">
                        </div>

                        <div class="form-group custom col-md-6 dv-image-input" id="cv-input-number-input" >
                            <label for="cv">Upload Your CV</label><br>
                            <label for="passport" class="input-label" data-target="#cv" ></label>
                            <input type="file" id="cv" name="cv" aria-describedby="cv" >
                        </div>

                        <div class="form-group custom col-md-6 dv-image-input" id="passport-input" >
                            <label for="passport">Passport Photography</label><br>
                            <label for="passport" class="input-label" data-target="#passport" ></label>
                            <input type="file" id="passport" name="passport" aria-describedby="passport">
                        </div>

                        <div class="form-group custom col-12" id="register-button" >
                            <button type="submit" class="btn btn-custom-primary">Register</button>
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
