<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-100" >
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}" >
    <link rel="stylesheet" href="{{asset('css/app.css')}}" >
    <link rel="stylesheet" href="{{asset('css/dashboard.css')}}" >
    <title>Drive me</title>
    @yield('head')
</head>
<body class="d-flex flex-column" >

<div class="dashboard-cover d-flex flex-row flex-grow-1" >
    <div class="sidenav d-flex flex-column" >
        <div class="close-btn" ><i class="fa fas-tim" ></i></div>
        <div id="logo" >
            <img src="{{ asset('img/driveme_logo_white.png') }}" alt="logo" >
        </div>
        <div id="menu-items" class="flex-grow-1" >
            <a class="menu-item @if($active == 'dashboard.complete-registration') active @endif" href="@if(auth()->user()->role == 1) {{route('user.complete-registration')}} @else {{route('corporate.complete-registration')}} @endif" >
                <img src="{{ asset('img/icons/bar_chart.png') }}" class="menu-item-icon" alt="ic" >
                <p>Update profile</p>
            </a>
            <a class="menu-item @if($active == 'dashboard.home') active @endif" href="{{route('dashboard')}}" >
                <img src="{{ asset('img/icons/bar_chart.png') }}" class="menu-item-icon" alt="ic" >
                <p>Dashboard</p>
            </a>
            <a class="menu-item @if($active == 'dashboard.hireDriver') active @endif" href="{{ route('user.hire-type') }}" >
                <img src="{{ asset('img/icons/user_icon.png') }}" class="menu-item-icon" alt="ic" >
                <p>Hire a Driver</p>
            </a>
            @if(auth()->user()->role == 1)
                <a class="menu-item @if($active == 'dashboard.onlineDriving') active @endif" href="{{route('online-driving')}}" >
                    <img src="{{ asset('img/icons/online_driving.png') }}" class="menu-item-icon" alt="ic" >
                    <p>Online Driving </p>
                </a>
            @else
                <a class="menu-item @if($active == 'dashboard.driverTraining') active @endif" href="{{route('online-driving')}}">
                    <img src="{{ asset('img/icons/driver_training.png') }}" class="menu-item-icon" alt="ic" >
                    <p>Driver Training</p>
                </a>
            @endif
            <a class="menu-item
                @if($active == 'dashboard.rentVehicle') active
                @endif" href="{{route('select-vehicle-hire-type')}}">
                <img src="{{ asset('img/icons/hire_vehicle.png') }}" class="menu-item-icon" alt="ic" >
                <p>Hire/Rent a vehicle</p>
            </a>
            <a class="menu-item @if($active == 'dashboard.fleetManagement') active @endif">
                <img src="{{ asset('img/icons/fleet_management.png') }}" class="menu-item-icon" alt="ic" >
                <p>Fleet Management</p>
            </a>
        </div>
    </div>
    <section id="dashboard-content" class="container-fluid flex-grow-1" >
        <ul id="top-nav" class="nav justify-content-end ">
            <li class="nav-item">
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
                        <span id="username-icon" >{{ strtoupper(auth()->user()->first_name[0] . '.' . auth()->user()->last_name[0])}}</span>
                        {{ ucfirst(auth()->user()->first_name) }}
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="{{ route('logout') }}">Logout</a>
                    </div>
                </div>
            </li>
        </ul>
        <div class="p-5" >

            @yield('content')
        </div>
    </section>
</div>
{{--https://code.jquery.com/jquery-3.5.1.min.js--}}
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
{{--<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>--}}
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="{{asset('js/bootstrap.min.js')}}" ></script>
<script src="https://kit.fontawesome.com/768a7cb0ff.js" crossorigin="anonymous"></script>
<script src="{{asset('js/app.js')}}" ></script>
@yield('scripts')

@if(isset($quizpage) && $quizpage =='yes')
    <script>

        // Quiz Object: holds questions, choices and answers.
        var quiz = <?php echo $quiz_json; ?>;


        $(document).ready(function() {

            // jQuery("#toTop").addClass('fade-in');

            var numQuestions = quiz.length;
            var numCorrect = 0;
            var feedback_answer = 0;
            var feedback_value = 0;
            var counter = 0;



            // display question function
            function nextQuest(){
                $('#questions').text(quiz[counter].question);
                $('#answer0').text(quiz[counter].choices[0]);
                $('#answer1').text(quiz[counter].choices[1]);
                $('#answer2').text(quiz[counter].choices[2]);
                $('#answer3').text(quiz[counter].choices[3]);
                // $('#answer4').text(quiz[counter].choices[4]);

                console.log(quiz[counter])
            }


            // client-sided validation
            function validate() {
                if ($('input').is(':checked')) {
                    // alert('yes')
                    nextQuest(); // display next question
                }
                else {
                    alert("Please make a selection.");
                    counter--;
                }
            }

            // display first question
            nextQuest();


            // next button function
            $('#nextBtn').on('click', function() {
                var answer = ($('input[name="choice"]:checked').val());

                // increment score if answer is correct
                if (answer == quiz[counter].correct) {
                    numCorrect++;
                }

                switch(answer){
                    case "0":
                        feedback_value = feedback_value + 5;
                        break;


                    case "1":
                        feedback_value = feedback_value + 4;
                        break;


                    case "2":
                        feedback_value = feedback_value + 3;
                        break;


                    case "3":
                        feedback_value = feedback_value + 2;
                        break;


                    case "4":
                        feedback_value = feedback_value + 1;
                        break;


                }

                counter++;

                console.log(feedback_value);


                // display score screen
                if (counter >= numQuestions) {
                    // $('#main').hide().fadeIn("slow");
                    $('#main').hide();

                    var myUrl = "<?php echo url('savequizresult'); ?>";
                    $.post( myUrl, {
                            user_id: "<?php echo $uid; ?>",
                            course_id: "<?php echo $course_id; ?>",
                            result: numCorrect,
                            question_count: numQuestions,
                            feedback_value: feedback_value
                        },
                        function( data ) {
                            console.log(data);
                        });

                    $('#main').show();
                    var result = "Thank you for completing the test, You have scored " + numCorrect + " out of " + numQuestions;
                    $('#main').text(result);
                    // document.getElementById('main').innerHTML="Thanks for the Feedback, Complete! You scored " + numCorrect + " out of " + numQuestions;

                    // document.getElementById('main').innerHTML="Thanks for the Feedback, Congrats!";
                    return; // returns false *(there has to be a better way! figure it out.)*
                }

                validate();
                // fade in new question
                // $('.cardquestion').hide().fadeIn("slow");
                // $('.cardquestion').hide();

                // clear previous selection
                $('input[name="choice"]').prop('checked', false);
            });


            // back button function
            $('#backBtn').on('click', function() {

                // fade out current question and fade in previous question
                // $('.card').hide().fadeIn("slow");
                $('.card').hide();
                numCorrect--;
                counter--;

                // display previous question
                nextQuest();
            });
        });
    </script>
@endif
</body>
</html>
