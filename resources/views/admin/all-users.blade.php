@extends('admin.layout.dashboard')

@section('head')
    <style>
        .content-body{
            min-height: 840px;
        }
    </style>
@endsection

@section('content')
<div class="content-body">


<div class="container-fluid">

    <div class="row">
        <div class="col-12">
            <div class="card">
            <b><p class="btn btn-warning">MAIL ALL USERS</p></b>
            <form action="" class="p-2">
                    <div class="">
                        <h5 class="card-title">All Users</h5>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-responsive-fix-big muted">
                            <thead>
                                <tr>
                                    <th>Sort</th>
                                    <th>Photos</th>
                                    <th>User Id</th>
                                    <th>First name</th>
                                    <th>Last Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <input type="checkbox" value="1">
                                    </td>
                                <td> <img src="{{ asset('img/icons/thumbnail.jpg') }}" alt="search icon" /></td>
                                    <td>1</td>
                                <td>Adeleye</td>
                                <td>Jeremiah</td>
                                <td>Jerrycaffe@gmail.com</td>
                                <td>08088492993</td>
                                <td>Active</td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="checkbox" value="1">
                                    </td>
                                <td> <img src="{{ asset('img/icons/thumbnail.jpg') }}" alt="search icon" /></td>
                                    <td>2</td>
                                <td>Adeleye</td>
                                <td>Jeremiah</td>
                                <td>Jerrycaffe@gmail.com</td>
                                <td>08088492993</td>
                                <td>Active</td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="checkbox" value="1">
                                    </td>
                                <td> <img src="{{ asset('img/icons/thumbnail.jpg') }}" alt="search icon" /></td>
                                    <td>3</td>
                                <td>Adeleye</td>
                                <td>Jeremiah</td>
                                <td>Jerrycaffe@gmail.com</td>
                                <td>08088492993</td>
                                <td>Active</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <button href="#" class="btn btn-primary">Delete Selected</button>
                </form>
                
            </div>
        </div>
    </div>
</div>

               

@endsection