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
            padding: 2rem 1rem;
            margin-bottom: 2rem;
        }

        #search-cover h5 {
            font-weight: bold;
        }

        #search-input-cover {
            /*width: 35rem;*/
        }

        #filters {
            background: #ffffff;
            padding: 1.5rem;
        }

        .filter-section {
            height: 12rem;
            margin-bottom: 2rem;
            overflow-y: auto;
        }

        #filters-title {
            padding-top: .75rem;
        }

        tbody {
            background: #ffffff;
        }

        th {
            color: #20ADF2;
            font-weight: normal;
        }

        td {vertical-align: middle!important;}

        tr:hover {
            cursor: pointer;
        }

        .driver .image img {
            width: 3rem;
            height: 3rem;
            border-radius: 0.5rem;
        }

        .driver .date {
            width: 20%
        }

        .driver .name {
            width: 50%
        }

        .status .badge-pill {
            padding-top: 0.5rem;
            padding-bottom: 0.5rem;
        }

        .status .badge-warning {
            background: #F9AA2940;
            color: #F9AA29;
        }

        .status .badge-success {
            background: #74D19B40;
            color: #2BAB7B;
        }
    </style>
    <script>
        const drivers = @json($drivers);
    </script>
@endsection

@section('content')
    <p class="text-primary page-title" >Hire a Driver</p>
    <div id="search-cover" >
        <p class="my-auto text-primary mx-1" >Drivers</p>

        <div class="mx-auto" >
            <div class="dv-custom-select mx-1" >
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
        </div>

        <div class="w-50" >
            <div class="input-group left mx-1" id="search-input-cover" >
                <div class="input-group-prepend" id="toggle-password" data-target="#password" >
                    <div class="input-group-text">
                        <i class="fas fa-search"></i>
                    </div>
                </div>
                <input type="search" class="form-control input-custom-primary" id="search" name="search" aria-describedby="search" title="search" placeholder="Search for drivers by name" >
            </div>
        </div>
    </div>

    <div class="row" >
        <div class="col-lg-3" id="filters-cover" >
            <p class="text-primary" id="filters-title" >FILTERS DRIVERS LIST BY</p>
            <div id="filters" >
                <div id="location-filter" class="filter-section" >
                    <p>Location</p>
                </div>

                <div id="experience-filter" class="filter-section" >
                    <p>Experience</p>
                </div>

                <div id="age-filter" class="filter-section" >
                    <p>Age</p>
                </div>
            </div>
        </div>
        <div class="col-lg-9" id="search_result" >
            <table class="table table-striped table-borderless">
                <thead>
                <tr>
                    <th scope="col">IMAGE</th>
                    <th scope="col">DRIVER NAME</th>
                    <th scope="col">STATUS</th>
                    <th scope="col" class="data" >DATE ADDED</th>
                </tr>
                </thead>
                <tbody id="drivers" >
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $('.driver').on('click', function () {
            window.location.href = `{{env('APP_URL')}}/dashboard/drivers/${$(this).attr('data-id')}`
        });

        renderTable(drivers)

        function renderTable(data) {
            data.forEach(driver => {
                let status = ''
                if (driver.available) {
                    status = `<td class="status" ><span class="badge-pill badge-warning" ><i class="fas fa-circle"></i> AVAILABLE</span></td>`;
                }else { status = `<td class="status" ><span class="badge-pill badge-success" ><i class="fas fa-circle"></i> HIRED</span></td>`; }

                $('#drivers').append(`
                    <tr class="driver" data-id="${driver.id}" >
                        <td class="image" ><img src="${driver.passport}" alt="passport" ></td>
                        <td class="name" >${driver.user.first_name} ${driver.user.last_name}</td>
                        ${status}
                        <td class="date" >02/10/2018</td>
                    </tr>
                `)
            })
        }
    </script>
@endsection
