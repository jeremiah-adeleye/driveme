@extends('user.layout.dashboard')

@section('head')
    <style>
        #hire-types {
            display: flex;
            flex-direction: row;
            margin-bottom: 1rem;
        }

        .hire-type {
            border-radius: 5px;
            border: 3px solid #ffffff;
            background: #ffffff;
            padding: 1rem;
        }

        .hire-type.active {
            border: 3px solid #2BAB7B;
        }

        .user-icon {
            text-align: center;
            margin-bottom: 1rem;
        }

        .user-icon .background{

        }

        .user-icon img {
            width: 2rem;
            height: 2rem;
        }

        #dates {
            display: flex;
            width: 20rem;
        }

        #start-date-input {
            margin-right: 0.5rem;
        }

        #end-date-input {
            margin-left: 0.5rem;
            display: none;
        }
    </style>
@endsection

@section('content')
    <p class="text-primary page-title" >Hire a Driver</p>
    <p>Choose the option that suits you best</p>

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

    <div id="hire-types" >
        <div class="hire-type mr-2 active" id="full_term" >
            <div class="user-icon" >
                <span class="background" ><img src="{{asset('img/icons/user_plus.png')}}" alt="user" ></span>
            </div>
            <p>Hire A Full Time Driver</p>
        </div>
        <div class="hire-type ml-2" id="short_term" >
            <div class="user-icon" >
                <span class="background" ><img src="{{asset('img/icons/user_plus.png')}}" alt="user" ></span>
            </div>
            <p>Hire A Short Term Driver</p>
        </div>
    </div>
    <div id="dates" >
        <div class="form-group" id="start-date-input" >
            <label for="start-date">Start Date</label>
            <input type="date" class="form-control input-custom-primary" id="start-date" name="start_date" aria-describedby="startDate" min="{{date_format(now(), 'Y-m-d')}}" >
            <small class="text-danger" id="start-date-error" ></small>
        </div>
        <div class="form-group" id="end-date-input" >
            <label for="end-date">End Date</label>
            <input type="date" class="form-control input-custom-primary" id="end-date" name="end_date" aria-describedby="endDate" min="{{(new DateTime())->modify('+1 day')->format('Y-m-d')}}" >
            <small class="text-danger" id="end-date-error" ></small>
        </div>
    </div>
    <p>NB: You will be required to pay a processing fee of N2,000</p>
    <a href="#" ><button class="btn btn-custom-primary" onclick="hireDriver()" >CONTINUE</button></a>
@endsection

@section('scripts')
    <script src="https://js.paystack.co/v1/inline.js"></script>
    <script>
        let hireType = 'full_term';
        let endDate = $('#end-date-input');
        let startDateInput =  $('#start-date');
        let endDateInput =  $('#end-date')
        let user = @json(auth()->user());
        let error = false;

        $('.hire-type').on('click', function () {
            $('.hire-type').removeClass('active');
            $(this).addClass('active');

            hireType = $(this).attr('id');
            console.log(hireType)
            if (hireType === 'full_term') {
                endDate.css('display', 'none');
            }else endDate.css('display', 'block');
        });

        let hireDriver = () => {
            error = false

            let data = {
                'type': hireType,
                'start_date': startDateInput.val(),
                'end_date': endDateInput.val(),
                'driver_id': {{$driver->id}},
                'reference': ''
            };

            if (data.start_date === '') {
                $('#start-date-error').html('Start date is required');
                error = true;
            }

            if (data.type === 'short_term' && data.end_date === '') {
                $('#end-date-error').html('Start date is required');
                error = true;
            }

            if (!error) {
                let handler = PaystackPop.setup({
                    key: 'pk_test_87b43cb03070ea4c4f584656222db9aa18ff7472', // Replace with your public key
                    email: user.email,
                    amount: 2000 * 100,
                    firstname: user.first_name,
                    lastname: user.last_name,

                    onClose: function(){

                    },

                    callback: function(response){
                        data.reference = response.reference
                        console.log(data)
                        post("{{route('user.hire-driver-payment')}}", data)
                    }
                });
                handler.openIframe();
            }
        }

        function post(path, params, method='post') {
            // The rest of this code assumes you are not using a library.
            // It can be made less wordy if you use one.
            const form = document.createElement('form');
            form.method = method;
            form.action = path;

            for (const key in params) {
                if (params.hasOwnProperty(key)) {
                    const hiddenField = document.createElement('input');
                    hiddenField.type = 'hidden';
                    hiddenField.name = key;
                    hiddenField.value = params[key];

                    form.appendChild(hiddenField);
                }
            }

            const hiddenField = document.createElement('input');
            hiddenField.type = 'hidden';
            hiddenField.name = '_token';
            hiddenField.value = "{{csrf_token()}}";
            form.appendChild(hiddenField)

            document.body.appendChild(form);
            form.submit();
        }

    </script>
@endsection
