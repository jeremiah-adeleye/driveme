@extends('layout.dashboard')

@section('head')
    <style>
        #dates {
            display: flex;
            width: 20rem;
        }

        #start-date-input {
            margin-right: 0.5rem;
        }

        #end-date-input {
            margin-left: 0.5rem;
        }
    </style>
@endsection

@section('content')
    <p class="text-primary page-title" >Hire a Driver</p>

    {{$errors}}

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

    <div id="dates" >
        <div class="form-group" id="start-date-input" >
            <label for="start-date">Start Date</label>
            <input type="date" class="form-control input-custom-primary" id="start-date" name="start_date" aria-describedby="startDate" min="{{date_format(now(), 'Y-m-d')}}" >
            <small class="text-danger" id="start-date-error" ></small>
        </div>
        @if($hireType == 'short-term')
            <div class="form-group" id="end-date-input" >
                <label for="end-date">End Date</label>
                <input type="date" class="form-control input-custom-primary" id="end-date" name="end_date" aria-describedby="endDate" min="{{(new DateTime())->modify('+1 day')->format('Y-m-d')}}" >
                <small class="text-danger" id="end-date-error" ></small>
            </div>
        @endif
    </div>
    @if($hireType == 'full-term')
        <p>NB: You will be required to pay a processing fee of N2,000</p>
    @else
        <p>NB: You will be required to pay a fee of N7,000 per day, per driver</p>
    @endif
    <a href="#" ><button class="btn btn-custom-primary" onclick="hireDriver()" >CONTINUE</button></a>
@endsection

@section('scripts')
    <script src="https://js.paystack.co/v1/inline.js"></script>
    <script>
        let hireType = "{{ ($hireType == 'full-term') ? 'full_term' : 'short_term' }}";
        let endDate = $('#end-date-input');
        let startDateInput =  $('#start-date');
        let endDateInput =  $('#end-date')
        let user = @json(auth()->user());
        let error = false;

        let hireDriver = async () => {

            error = false

            let data = {
                'type': hireType,
                'start_date': startDateInput.val(),
                'end_date': endDateInput.val(),
                'driver_id': {{$driverIds}},
                'user_id': {{auth()->id()}},
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
                let response = await fetch("{{route('user.hire-driver.get-reference')}}", {
                    headers : {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    method: 'POST',
                    body: JSON.stringify(data)
                })

                let res = await response
                if (res.status === 200) {
                    let body = await response.json()
                    data.reference = body.reference
                    if (data.type === 'full_term') data.end_date = null

                    let handler = PaystackPop.setup({
                        ref: body.reference,
                        key: 'pk_test_87b43cb03070ea4c4f584656222db9aa18ff7472', // Replace with your public key
                        email: user.email,
                        amount: body.amount * 100,
                        firstname: user.first_name,
                        lastname: user.last_name,

                        onClose: function(){

                        },

                        callback: function(response){
                            data.reference = response.reference
                            post("{{route('user.hire-driver-payment')}}", data)
                        }
                    });
                    handler.openIframe();
                }else {
                    console.log(res.statusText)
                }
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

        function getAmount() {

        }

    </script>
@endsection
