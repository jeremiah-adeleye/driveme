@extends('driver.layout.dashboard', ['title' => 'driver dashboard'])

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
                <div id="approval-status-cover" >
                    <p>
                        Status:

                        @if($driver->approval_status == 1)
                            <span class="badge badge-warning" >Pending approval</span>
                        @elseif($driver->approval_status == 2)
                            <span class="badge badge-success" >Approved</span>
                        @elseif($driver->approval_status == 3)
                            <span class="badge badge-danger" >Approval denied</span>
                        @elseif($driver->approval_status == 4)
                            <span class="badge badge-danger" >Approval revoked</span>
                        @else
                            <span class="badge badge-warning" >Incomplete registration</span>
                        @endif
                    </p>
                </div>
                <form method="post"
                      action=
                      " @if($driver->approval_status == 1)
                            {{route('driver.register.compete')}}
                        @elseif($driver->approval_status == 2)
                            {{route('driver.update')}}
                        @elseif($driver->approval_status == 3)
                            {{route('driver.register.resubmit')}}
                        @endif
                      "
                      enctype="multipart/form-data" >
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
                            <input type="text" class="form-control input-custom-primary" name="first_name" readonly id="first-name" aria-describedby="firstName" value="{{$user->first_name}}" >
                            @error('first_name')
                            <small class="text-danger" >{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group custom col-md-6" id="last-name-input" >
                            <label for="last-name">Last Name</label>
                            <input type="text" class="form-control input-custom-primary" readonly id="last-name" name="last_name"  aria-describedby="lastName" value="{{$user->last_name}}" >
                            @error('last_name')
                            <small class="text-danger" >{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group custom col-md-6" id="email-input" >
                            <label for="email">Email Address</label>
                            <input type="email" class="form-control input-custom-primary" id="email" name="email" aria-describedby="email" value="{{$user->email}}" >
                            @error('email')
                            <small class="text-danger" >{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group custom col-md-6" id="phone-number-input" >
                            <label for="phone-number">Phone Number</label>
                            <input type="tel" class="form-control input-custom-primary" id="phone-number" name="phone_number" aria-describedby="phoneNumber" value="{{$user->phone_number}}" >
                            @error('phone_number')
                            <small class="text-danger" >{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group custom col-md-6" id="dob-input" >
                            <label for="dob">Date of Birth</label>
                            <input type="date" class="form-control input-custom-primary" id="dob" name="dob" aria-describedby="dateOfBirth" value="{{$driver->dob}}" @if($registrationComplete) readonly @endif >
                            @error('dob')
                            <small class="text-danger" >{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group custom col-md-6" id="location-input" >
                            <label for="location">Location</label>
                            <input type="text" class="form-control input-custom-primary" id="location" name="location" aria-describedby="location" value="{{$driver->location}}" >
                            @error('location')
                            <small class="text-danger" >{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group custom col-md-6" id="location-input" >
                            <label for="salary-range">Salary Range <small>(amount you want to be paid)</small></label>
                            <input type="text" class="form-control input-custom-primary" id="salary-range" name="salary_range" aria-describedby="salaryRange" value="{{$driver->salary_range}}" >
                            @error('salary_range')
                            <small class="text-danger" >{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group custom col-md-6" id="password-input" >
                            <label for="password">Password</label>
                            <input type="password" class="form-control input-custom-primary" readonly id="password" name="password" aria-describedby="password" placeholder="********************" >
                        </div>

                        <div class="form-group custom col-md-6" id="address-input" >
                            <label for="address">Residential Address <small>(home address)</small></label>
                            <input type="text" class="form-control input-custom-primary" id="address" name="address" aria-describedby="address" value="{{$driver->address}}" >
                            @error('address')
                            <small class="text-danger" >{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group custom col-md-6" id="licence-number-input" >
                            <label for="licence-number">Licence Number</label>
                            <input type="text" class="form-control input-custom-primary" id="licence-number" name="licence_number" aria-describedby="licenceNumber" value="{{$driver->licence_number}}" >
                            @error('licence_number')
                            <small class="text-danger" >{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group custom col-md-6" id="experience-input" >
                            <label for="experience">Driver’s Experience Years</label>
                            <input type="number" class="form-control input-custom-primary" id="experience" name="experience" aria-describedby="experience" value="{{$driver->experience}}" >
                            @error('experience')
                            <small class="text-danger" >{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group custom col-md-6" id="vehicle-type-input" >
                            <label for="vehicle-type">What kind of Vehicle do you drive?</label>
                            <select class="custom-select input-custom-primary" id="vehicle-type" name="vehicle_type" >
                                <option hidden >Vehicle type</option>
                                <option @if($driver->vehicle_type == 'sedan') selected @endif value="sedan">Sedan</option>
                                <option @if($driver->vehicle_type == 'suv') selected @endif value="suv">SUV</option>
                                <option @if($driver->vehicle_type == 'truck') selected @endif value="truck">Truck</option>
                                <option @if($driver->vehicle_type == 'coaster bus') selected @endif value="coaster bus">Coaster Bus</option>
                            </select>
                            @error('vehicle_type')
                            <small class="text-danger" >{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group custom col-md-6 dv-image-input" id="cv-input" >
                            <label for="cv">Upload Your CV</label><br>
                            <p class="file-name-preview d-none" ></p>
                            <label for="cv" class="input-label" data-target="#cv"></label>
                            <input type="file" id="cv" name="cv" aria-describedby="cv" value="{{ $driver->cv }}" >
                            @error('cv')
                            <small class="text-danger" >{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group custom col-md-6 dv-image-input" id="passport-input" >
                            <label for="passport">Passport Photography</label><br>
                            <label for="passport" class="input-label" data-target="#passport"
                               @if($driver->passport != null)
                                   style="background: url('{{$driver->passport}}') no-repeat center; background-size: contain;"
                               @endif
                            ></label>
                            <input type="file" id="passport" name="passport" aria-describedby="passport" value="{{ $driver->passport }}" >
                            @error('passport')
                            <small class="text-danger" >{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group custom col-12" id="register-button" >
                            <button type="submit" class="btn btn-custom-primary">
                                @if($driver->approval_status == 1)
                                    COMPLETE REGISTRATION
                                @elseif($driver->approval_status == 2)
                                    UPDATE
                                @elseif($driver->approval_status == 3)
                                    RESUBMIT
                                @else
                                    ACCESS HAS BEEN REVOKED
                                @endif
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script src="{{asset('js/preview_file.js')}}" ></script>
@endsection
