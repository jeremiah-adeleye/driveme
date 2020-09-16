@extends('driver.layout.dashboard', ['title' => 'driver dashboard'])

@section('head')
    <style>
        form {
            background: #ffffff;
        }
        #guarantor-details {
            display: none;
        }
    </style>
@endsection

@section('content')
    <section id="dashboard-section" class="d-flex flex-column" >
        <p class="font-weight-bold px-4 text-primary" >Driver Application</p>

        <div class="row my-auto" >
            <div class=" col-lg-10">
                <form class="p-5" method="post" action="{{route('driver.register.compete')}}" enctype="multipart/form-data" >
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
                            <div class="form-group custom col-md-6" id="first-name-input" >
                                <label for="full-name">Full Name</label>
                                <input type="text" class="form-control input-custom-primary" name="full_name" readonly id="full-name" aria-describedby="fullName" value="{{ucwords($user->first_name.' '.$user->last_name)}}" >
                                @error('first_name')
                                <small class="text-danger" >{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group custom col-md-6" id="email-input" >
                                <label for="email">Email Address</label>
                                <input type="email" class="form-control input-custom-primary" id="email" name="email" aria-describedby="email" value="{{old('email')}}" >
                                @error('email')
                                <small class="text-danger" >{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group custom col-md-6" id="phone-number-input" >
                                <label for="phone-number">Phone Number</label>
                                <input type="tel" class="form-control input-custom-primary" id="phone-number" name="phone_number" aria-describedby="phoneNumber" value="{{old('phone_number')}}" >
                                @error('phone_number')
                                <small class="text-danger" >{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group custom col-md-6" id="dob-input" >
                                <label for="dob">Date of Birth</label>
                                <input type="date" class="form-control input-custom-primary" id="dob" name="dob" aria-describedby="dateOfBirth" value="{{old('dob')}}" >
                                @error('dob')
                                <small class="text-danger" >{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group custom col-md-6" id="address-input" >
                                <label for="address">Residential Address</label>
                                <input type="text" class="form-control input-custom-primary" id="address" name="address" aria-describedby="address" value="{{old('address')}}" >
                                @error('address')
                                <small class="text-danger" >{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group custom col-md-6" id="location-input" >
                                <label for="state">State of residence</label>
                                <input type="text" class="form-control input-custom-primary" id="state" name="state" aria-describedby="state" value="{{old('state')}}" >
                                @error('state')
                                <small class="text-danger" >{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group custom col-md-6" id="location-input" >
                                <label for="salary-range">Salary Range <small>(amount you want to be paid)</small></label>
                                <input type="text" class="form-control input-custom-primary" id="salary-range" name="salary_range" aria-describedby="salaryRange" value="{{old('salary_range')}}" >
                                @error('salary_range')
                                <small class="text-danger" >{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group custom col-md-6" id="vehicle-type-input" >
                                <label for="vehicle-type">What kind of Vehicle do you drive?</label>
                                <select class="custom-select input-custom-primary" id="vehicle-type" name="vehicle_type" >
                                    <option hidden value="" >Vehicle type</option>
                                    <option @if(old('vehicle_type') == 'sedan') selected @endif value="sedan">Sedan</option>
                                    <option @if(old('vehicle_type') == 'suv') selected @endif value="suv">SUV</option>
                                    <option @if(old('vehicle_type') == 'truck') selected @endif value="truck">Truck</option>
                                    <option @if(old('vehicle_type') == 'coaster bus') selected @endif value="coaster bus">Coaster Bus</option>
                                </select>
                                @error('vehicle_type')
                                <small class="text-danger" >{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group custom col-md-6" id="licence-number-input" >
                                <label for="licence-number">Driver License Number</label>
                                <input type="text" class="form-control input-custom-primary" id="licence-number" name="licence_number" aria-describedby="licenceNumber" value="{{old('licence_number')}}" >
                                @error('licence_number')
                                <small class="text-danger" >{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group custom col-md-6" id="experience-input" >
                                <label for="experience">Years of driving experience</label>
                                <input type="number" class="form-control input-custom-primary" id="experience" name="experience" aria-describedby="experience" value="{{old('experience')}}" >
                                @error('experience')
                                <small class="text-danger" >{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group custom col-md-6 dv-image-input" id="cv-input" >
                                <label for="cv">Upload Your CV</label><br>
                                <p class="file-name-preview d-none" ></p>
                                <label for="cv" class="input-label" data-target="#cv"></label>
                                <input type="file" id="cv" name="cv" aria-describedby="cv" value="{{old('cv')}}" >
                                @error('cv')
                                <small class="text-danger" >{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group custom col-md-6 dv-image-input" id="passport-input" >
                                <label for="passport">Upload Your Passport Photograph</label><br>
                                <label for="passport" class="input-label" data-target="#passport" ></label>
                                <input type="file" id="passport" name="passport" aria-describedby="passport" value="{{old('passport')}}" >
                                @error('passport')
                                <small class="text-danger" >{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group custom col-12" >
                                <button type="button" class="btn btn-custom-primary" id="save-and-continue" >SAVE AND CONTINUE</button>
                            </div>
                        </div>
                    </div>
                    <div id="guarantor-details" >
                        <div class="row" >
                            <div class="form-group custom col-md-6" id="first-name-input" >
                                <label for="guarantor-name">Guarantor Name</label>
                                <input type="text" class="form-control input-custom-primary" name="guarantor_name" id="guarantor-name" aria-describedby="guarantorName" value="{{old('guarantor_name')}}" >
                                @error('guarantor_name')
                                <small class="text-danger" >{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group custom col-md-6" id="first-name-input" >
                                <label for="guarantor-email">Guarantor Email Address</label>
                                <input type="text" class="form-control input-custom-primary" name="guarantor_email" id="guarantor-email" aria-describedby="guarantorEmail" value="{{old('guarantor_email')}}" >
                                @error('guarantor_email')
                                <small class="text-danger" >{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group custom col-md-6" id="first-name-input" >
                                <label for="guarantor-phone-number">Guarantor Phone Number</label>
                                <input type="text" class="form-control input-custom-primary" name="guarantor_phone_number" id="guarantor-phone-number" aria-describedby="guarantorPhoneNumber" value="{{old('guarantor_phone_number')}}" >
                                @error('guarantor_phone_number')
                                <small class="text-danger" >{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group custom col-md-6" id="first-name-input" >
                                <label for="guarantor-relationship">Relationship</label>
                                <input type="text" class="form-control input-custom-primary" name="guarantor_relationship" id="guarantor-relationship" aria-describedby="guarantorRelationship" value="{{old('guarantor_relationship')}}" >
                                @error('guarantor_relationship')
                                <small class="text-danger" >{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group custom col-md-6" id="first-name-input" >
                                <label for="guarantor-residential-address">Guarantor Residential Address</label>
                                <input type="text" class="form-control input-custom-primary" name="guarantor_residential_address" id="guarantor-residential-address" aria-describedby="guarantorResidentialAddress" value="{{old('guarantor_residential_address')}}" >
                                @error('guarantor_residential_address')
                                <small class="text-danger" >{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group custom col-md-6" id="first-name-input" >
                                <label for="guarantor-state-of-residence">Guarantor State of Residence</label>
                                <input type="text" class="form-control input-custom-primary" name="guarantor_state_of_residence" id="guarantor-state-of-residence" aria-describedby="guarantorStateOfResidence" value="{{old('guarantor_state_of_residence')}}" >
                                @error('guarantor_state_of_residence')
                                <small class="text-danger" >{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group custom col-md-6 mt-0" id="first-name-input" >
                                <label for="guarantor-work-address">Full Name</label>
                                <input type="text" class="form-control input-custom-primary" name="guarantor_work_address" id="guarantor-work-address" aria-describedby="guarantorWorkAddress" value="{{old('guarantor_work_address')}}" >
                                @error('guarantor_work_address')
                                <small class="text-danger" >{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group custom col-md-6 dv-image-input" id="passport-input" >
                                <label for="guarantor-passport">Guarantor Passport Photograph</label><br>
                                <label for="guarantor-passport" class="input-label" data-target="#passport" ></label>
                                <input type="file" id="guarantor-passport" name="guarantor_passport" aria-describedby="guarantor-passport" value="{{old('guarantor_passport')}}" >
                                @error('guarantor_passport')
                                <small class="text-danger" >{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="form-group custom col-12" >
                                <button type="submit" class="btn btn-custom-primary" id="save-and-continue" >SUBMIT APPLICATION</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script src="{{asset('js/preview_file.js')}}" ></script>
    <script>
        let saveAndContinueBtn = $('#save-and-continue')
        saveAndContinueBtn.on('click', function () {
            $('#driver-details').css('display', 'none')
            $('#guarantor-details').css('display', 'block')
        })
    </script>
@endsection
