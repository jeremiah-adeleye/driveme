@extends('user.layout.dashboard')

@section('head')
    <style>
        .text-primary {
            color: #20ADF2;
        }

        .page-title {
            font-size: 1.2rem;
            font-weight: bold;
            margin-bottom: 2rem;
        }

        #search-cover {
            background: #ffffff;
            display: flex;
            flex-direction: row;
            padding: 2rem;
        }

        #search-cover h5 {
            font-weight: bold;
        }

        #search-input-cover {
            width: 30rem;
        }
    </style>
@endsection

@section('content')
    <p class="text-primary page-title" >Hire a Driver</p>
    <div id="search-cover" >
        <h5 class="my-auto text-primary" >Drivers</h5>

        <div class="dv-custom-select mx-auto" >
            <input class="input-value" name="visibility" title="visibility" >
            <div class="dropdown">
                <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" >
                    Showing all registered drivers <i class="fas fa-chevron-down caret"></i>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" data-value="all" href="#">Showing all registered drivers</a>
                    <a class="dropdown-item" data-value="active" href="#">Active drivers</a>
                    <a class="dropdown-item" data-value="inactive" href="#">Inactive drivers</a>
                </div>
            </div>
        </div>

        <div class="input-group left mx-auto" id="search-input-cover" >
            <div class="input-group-prepend" id="toggle-password" data-target="#password" >
                <div class="input-group-text">
                    <i class="fas fa-search"></i>
                </div>
            </div>
            <input type="search" class="form-control input-custom-primary" id="search" name="search" aria-describedby="search" title="search" placeholder="Search for drivers by name" >
        </div>
    </div>
@endsection

@section('scripts')

@endsection
