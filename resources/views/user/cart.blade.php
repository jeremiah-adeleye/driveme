@extends('user.layout.dashboard')

@section('head')
<style>
    .page-title {
        font-size: 1.2rem;
        font-weight: bold;
        margin-bottom: 2rem;
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

    #proceed-button {
        text-align: right;
    }
</style>
@endsection

@section('content')
    <p class="text-primary page-title" >Driver Hire List</p>
    <div id="cart-items" >
        <table class="table table-striped table-borderless">
            <thead>
            <tr>
                <th scope="col">IMAGE</th>
                <th scope="col">DRIVER NAME</th>
                <th scope="col">STATUS</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody id="drivers" >
            @foreach($drivers as $driver)
                <tr class="driver" data-id="${driver.id}" >
                    <td class="image" ><img src="{{$driver->passport}}" alt="passport" ></td>
                    <td class="name" >{{ucfirst($driver->user->first_name. ' '. $driver->user->last_name)}}</td>
                    @if($driver->available)
                        <td class="status" ><span class="badge-pill badge-warning" ><i class="fas fa-circle"></i> AVAILABLE</span></td>
                    @else
                        <td class="status" ><span class="badge-pill badge-success" ><i class="fas fa-circle"></i> HIRED</span></td>
                    @endif
                    <td class="image" >
                        <a href="{{route('user.driver', ['id' => $driver->id])}}" >
                            <button class="btn btn-custom-primary-outline" >VIEW</button>
                        </a>
                    </td>
                    <td class="image" >
                        <a href="{{route('user.cart.remove', ['id' => $driver->id])}}" >
                            <i class="far fa-trash-alt text-danger"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div id="proceed-button"  >
        <a href="{{route('user.hire-driver')}}"><button type="button" class="btn btn-custom-primary mt-5" >PROCEED</button></a>
    </div>
@endsection

@section('scripts')

@endsection
