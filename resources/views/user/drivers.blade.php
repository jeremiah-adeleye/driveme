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

        .filters {
            padding-left: 0.5rem;
            padding-right: 0.5rem;
        }

        #search-result {
            height: 80vh;
        }

        #view-list-button {
            text-align: right;
        }
    </style>
    <script>
    </script>
@endsection

@section('content')
    <p class="text-primary page-title" >Hire a Driver</p>
    <div id="search-cover" >
        <p class="my-auto text-primary mx-1" >Drivers</p>

        <div class="mx-auto" >
            <div class="dv-custom-select mx-1" >
                <input class="input-value" name="visibility" title="visibility" id="driver-availability" >
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

    <p>NB: Select double the number of drivers you wish to hire</p>

    <div class="row" >
        <div class="col-lg-3" id="filters-cover" >
            <p class="text-primary" id="filters-title" >FILTERS DRIVERS LIST BY</p>
            <div id="filters" >
                <div id="location-filter" class="filter-section" >
                    <p>Location</p>
                    <div class="filters" >
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="all" name="location-filter" >
                            <label class="custom-control-label" for="all">All</label>
                        </div>
                        @foreach($locations as $location)
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="{{$location}}" name="location-filter" >
                                <label class="custom-control-label" for="{{$location}}">{{ucfirst($location)}}</label>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div id="experience-filter" class="filter-section" >
                    <p>Experience</p>
                    <div class="filters" >
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="1" name="experience-filter" >
                            <label class="custom-control-label" for="1">1 Year</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="2" name="experience-filter" >
                            <label class="custom-control-label" for="2">2 Years</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="3" name="experience-filter" >
                            <label class="custom-control-label" for="3">3 Years</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="4" name="experience-filter" >
                            <label class="custom-control-label" for="4">4 Years</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="5" name="experience-filter" >
                            <label class="custom-control-label" for="5">5 Years</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="6" name="experience-filter" >
                            <label class="custom-control-label" for="6">6 Years and above</label>
                        </div>
                    </div>
                </div>

                <div id="age-filter" class="filter-section" >
                    <p>Age</p>
                    <div class="filters" >
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="18-25" name="age-filter" >
                            <label class="custom-control-label" for="18-25">18 - 25</label>
                        </div>
                    </div>
                    <div class="filters" >
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="25-35" name="age-filter" >
                            <label class="custom-control-label" for="25-35">25 - 35</label>
                        </div>
                    </div>
                    <div class="filters" >
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="35-45" name="age-filter" >
                            <label class="custom-control-label" for="35-45">35 - 45</label>
                        </div>
                    </div>
                    <div class="filters" >
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="45-55" name="age-filter" >
                            <label class="custom-control-label" for="45-55">45 - 55</label>
                        </div>
                    </div>
                    <div class="filters" >
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="55-60" name="age-filter" >
                            <label class="custom-control-label" for="55-60">55 - 60</label>
                        </div>
                    </div>
                    <div class="filters" >
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="60-200" name="age-filter" >
                            <label class="custom-control-label" for="60-200">60 Years and above</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-9" id="search-result" >
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
    <div id="view-list-button" >
        <a href="{{route('user.cart')}}" ><button type="button" class="btn btn-custom-primary">VIEW LIST</button></a>
    </div>
@endsection

@section('scripts')
    <script>
        let drivers = @json($drivers);

        $(document).on('click', '.driver', function () {
            window.location.href = `{{env('APP_URL')}}/dashboard/drivers/${$(this).attr('data-id')}`
        });

        $('#search').change(function () {
            let name = $(this).val();
            console.log(name)

            let res = drivers.filter((driver) => {
                let driverName = driver.user.first_name + ' ' + driver.user.last_name
                return driverName.search(name) >= 0 ? true : name.search(driverName) >= 0
            })

            renderTable(res)
        })

        renderTable(drivers)

        function renderTable(data) {
            let tableBody = $('#drivers')
            tableBody.html('');

            data.forEach(driver => {
                let createdDate = new Date(driver.created_at);
                console.log(createdDate)

                let status = '';
                if (driver.available) {
                    status = `<td class="status" ><span class="badge-pill badge-warning" ><i class="fas fa-circle"></i> AVAILABLE</span></td>`;
                }else { status = `<td class="status" ><span class="badge-pill badge-success" ><i class="fas fa-circle"></i> HIRED</span></td>`; }

                tableBody.append(`
                    <tr class="driver" data-id="${driver.id}" >
                        <td class="image" ><img src="${driver.passport}" alt="passport" ></td>
                        <td class="name" >${driver.user.first_name} ${driver.user.last_name}</td>
                        ${status}
                        <td class="date" >${createdDate.getDate()}/${createdDate.getMonth() + 1}/${createdDate.getFullYear()}</td>
                    </tr>
                `)
            })
        }
    </script>
@endsection
