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
                        <div>
                            <input class="form-control" id="search" type="text" name="search" placeholder="Search all user">
                        </div>
                        <h3 align="center">Total User : <span id="total_records"></span></h3>
                        <table id="user-table" class="table table-hover table-striped table-responsive-fix-big muted">
                            <thead>
                                <tr>
                                    <th>Sort</th>
                                    <th>Photos</th>
                                    <th>User Id</th>
                                    <th>First name</th>
                                    <th>Last Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                   
                                </tr>
                            </thead>
                            <tbody>
                               
                            </tbody>
                        </table>
                    </div>
                    <button href="#" class="btn btn-primary">Delete Selected</button>
                </form>
                
            </div>
        </div>
    </div>
</div>

               

<script>


$(document).ready(function(){

fetch_customer_data();

function fetch_customer_data(query = '')
{
 $.ajax({
  url:"{{ route('usersAction') }}",
  method:'GET',
  data:{query:query},
  dataType:'json',
  success:function(data)
  {
      
   $('tbody').html(data.table_data);
   $('#total_records').text(data.total_data);
  }
 })
}

$(document).on('keyup', '#search', function(){
 var query = $(this).val();

 fetch_customer_data(query);
});
});
   </script>
    @endsection