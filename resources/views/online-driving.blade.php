@extends('layout.dashboard')

@section('head')
    <style>
        .course {
            min-height: 20rem;
            margin-bottom: 2rem;
            padding: 1rem;
            color: #ffffff;
            display: flex;
            flex-direction: column;
        }

        .course .description {
            width: 80%;
        }

        .course .price {
            margin-top: auto;
        }

        .course .submit {
            margin-left: auto;
            width: 35%;
        }
    </style>
@endsection

@section('content')
    <div class="row" >
        <div class="col-md-6" >
            <div class="course" style="background: #021827" >
                <p class="title h4" >Starter</p>
                <p class="description" >Four weeks of driving Lesson (Beginner) 1 Hour per class - Weekdays only</p>
                <p class="no-of-lessons" >Total lessons - 26</p>
                <p class="price h3" >N45,000</p>
                <button class="submit btn btn-outline-light" >CHOOSE PLAN</button>
            </div>
        </div>
        <div class="col-md-6" >
            <div class="course" style="background: #F9AA29" >
                <p class="title" >Weekend (Saturdays only)</p>
                <p class="description" >2 Hour per class for 7 weeks. This class is specifically for busy executives and other career professionals who do not have the luxury of time for our weekly classes.</p>
                <p class="no-of-lessons" >Total lessons - 7</p>
                <p class="price h3" >N40,000</p>
                <button class="submit btn btn-outline-light" >CHOOSE PLAN</button>
            </div>
        </div>
        <div class="col-md-6" >
            <div class="course" style="background: #2BAB7B" >
                <p class="title" >Pay As You Drive (PAYD)</p>
                <p class="description" >30 Minutes per class @ N2,000 per class, a minimum of 5 classes</p>
                <p class="no-of-lessons" >Total lessons - 26</p>
                <p class="price h3" >N2000</p>
                <button class="submit btn btn-outline-light" >CHOOSE PLAN</button>
            </div>
        </div>
        <div class="col-md-6" >
            <div class="course" style="background: #74D19B" >
                <p class="title" ></p>
                <p class="description" >1 Hour per class. This is a refresher class for learner drivers who already have some knowledge of driving. </p>
                <p class="no-of-lessons" >Total lessons - 10</p>
                <p class="price h3" >N20,000</p>
                <button class="submit btn btn-outline-light" >CHOOSE PLAN</button>
            </div>
        </div>
    </div>
@endsection
