@extends('layouts.admin')
@section('title','Clients')
<style>
.dataTables_filter, .dataTables_info { display: none; }
</style>
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h2 class="m-0 text-muted ml-2 mt-4"><strong>Members </strong></h2>
        <ol class="breadcrumb float-sm-left ml-2">
          <li class="breadcrumb-item"><a href="{{url('/home')}}">Dashboard</a></li>
          <li class="breadcrumb-item active">Members</li>
        </ol>
      </div><!-- /.col -->
      <div class="col-sm-6">
          <div class="float-right mt-5">
              <div class="btn-group btn-group-justified">
                  @isset($category)
                <a href="#" class="btn btn-primary btn-sm">{{$category['name']}} <span>{{count($users)}}</span></a>
                @else
                <a href="{{url('/members')}}" class="btn btn-primary btn-sm"><i class=" fa fa-users"></i> Members</a>
                @endif
                <a href="{{url('/members')}}" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i> Refresh</a>
              
             <!--  <div class="dropdown dropleft" style="padding-left:10px; padding-top:5px; cursor:pointer;"><i class="fa fa-ellipsis-v" id="dropdownMenu" data-toggle="dropdown" ></i>
                 <div class="dropdown-menu">
                  <a class="dropdown-item" href="{{url('/clientsPDF')}}" id="l1"><i class="fa fa-file-pdf-o" ></i> Export PDF</a>
                  <a class="dropdown-item" href="{{url('/clientsExcel')}}" id="l1"><i class="fa fa-file-excel-o" ></i> Export Excel</a>
                  <a class="dropdown-item" href="{{url('/clientsCSV')}}" id="l1"><i class="fa fa-file" ></i> Export CSV</a>
                  </div>
              </div> -->
              </div>
            </div>
      </div><!-- /.col -->
      
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->


<!-- Main content -->
<section class="content col-md-12">
<div class="row">
<div class="col-md-12">

  <div class="card">
    <!-- /.card-header -->

    <div class="card-body">
        <div class="col-md-12 text-left mb-3">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addNewClient">
                <i class="fa fa-plus"></i>
                Add Member
            </button>
           
            
            <nav class="navbar navbar-expand navbar-light float-right bg-light" style="border-radius: 10px;">
                <form method="post" action="{{url('/sortGroup')}}" class="form-inline ml-3">
                    @csrf
                    <div class="input-group input-group-sm">
                        <select class="form-control form-control-navbar input-sm" name="filter" required>
                            @if(isset($cGroup))
                                @foreach($cGroup as $cg)
                                    <option value="{{$cg->id}}">{{$cg->name}}</option>
                                @endforeach
                            @endif
                        </select>

                        <div class="input-group-append">
                            <button class="btn btn-navbar" type="submit">
                                <i class="fa fa-filter text-primary"></i>
                            </button>
                        </div>
                    </div>
                </form>
                                      <form class="form-inline ml-1 float-right bg-light" method="get" action="{{url('/sortEmail')}}" style="border-radius: 5px;">
                                        @if(isset($sortEmail))
                                        <div class="input-group input-group-sm">
                                            <label> &nbsp;Search: &nbsp;</label>
                                            <input type="Text" class="form-control" name="sortEmail" required value="{{$sortEmail}}">
                                        </div>
                                        @else

                                        <div class="input-group input-group-sm">
                                            <label> &nbsp;Search: &nbsp;</label>
                                            <input type="text" class="form-control" name="sortEmail" required placeholder="Enter text to search">
                                        </div>

                                        @endif
                                        <div class="input-group-append">
                                            <button class="btn btn-navbar" type="submit">
                                                <i class="fa fa-filter text-primary"></i>
                                            </button>
                                        </div>
                                    </form>
            </nav>
            
        </div>

      <div class="col-md-12 mb-4">
          @if(count($errors)>0)
              @foreach($errors->all() as $error)
                  <div class="alert alert-danger alert-dismissible fade show" role="alert">
                      {{$error}}
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
              @endforeach
          @endif
      </div>
      <table class="table table-striped" id="example1">
        <thead>
        <tr class="bg-default">
          <th>#</th>
          <th>Name</th>
          <th>Email</th>
          <th>Group</th>
          <th>Added On</th>
          <th>Action</th>
        </tr>
        </thead>
        <tbody>

        @forelse($users as $user)
        <tr>
          <td>{{++$count}}</td>
          <td>
             {{$user->firstName}} {{$user->middleName}} {{$user->lastName}}
          </td>
          <td>{{$user->email}}</td>
          <td>{{$user->group->name}}</td>
            <td>{{$user->created_at}}</td>
          <td>
              <div class="btn-group">
                  <button type="button" class="btn btn-default btn-flat btn-sm">
                      <i class="fa fa-cog"></i> 
                  </button>
                  <div class="btn-group text-left">
                      <button type="button" class="btn btn-default dropdown-toggle dropdown-icon" data-toggle="dropdown"></button>
                      <div class="dropdown-menu dropdown-menu-right">
                          <a class="dropdown-item" data-toggle="modal" data-target="#editClient{{$user->id}}" href="#">
                              <i class="fa fa-edit"></i>
                              Edit Member Details
                          </a>
                          <a class="dropdown-item" href='{{url("/deleteClient/$user->id")}}'
                             onclick='return confirm("Are you sure you want to delete {{$user->name}}")' id="l1">
                              <i class="fa fa-trash"></i>
                              Delete
                          </a>
                      </div>
                  </div>
              </div>
          </td>
        <!--Edit Modal-->
        <div class="modal fade" id="editClient{{$user->id}}">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="text-muted"><i class="fa fa-user"></i> Edit {{$user->firstName}}</h2>
                        <button type="button" class="close" aria-label="Close" data-dismiss="modal">
                            <span aria-hidden="true">X</span>
                        </button>
                    </div>
                    <form class="" action='{{url("/members/{$user->id}")}}' method="post">
                        @csrf
                        @method('patch')
                        <div class="card-body px-2 modalCardBody">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label class="col-form-label" for="firstName">First Name</label>
                                    <input type="text" name="firstName" id="EditFirstName" class="form-control is-valid" placeholder="First Name" value="{{$user->firstName}}" >
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="col-form-label" for="middleName">Middle Name</label>
                                    <input type="text" name="middleName" class="form-control is-valid" id="EditMiddleName" placeholder="Middle Name" value="{{$user->middleName}}" >
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="col-form-label" for="lastName">Last Name</label>
                                    <input type="text" name="lastName" class="form-control is-valid" id="EditLastName" placeholder="Last Name" value="{{$user->lastName}}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="col-form-label" for="email">Email</label>
                                    <input type="text" name="email" id="Editemail" class="form-control is-valid" placeholder="Email" value="{{$user->email}}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="col-form-label" for="group_id">Group</label>
                                    <select name="group_id" class="form-control is-valid form-control-navbar input-sm" id="Editgroup_id">
                                        @if(isset($cGroup))
                                            @foreach($cGroup as $group)
                                                <option value="{{$group->id}}">{{$group->name}}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>

                            </div>
                        </div>
                            <center style="margin-top: -17px;" class="mb-3">
                            <button class="btn btn-danger" type="button" data-dismiss="modal">
                                <i class="fa fa-close"></i>Close
                            </button>
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-refresh"></i>Update Member
                            </button>
                            </center>
                    </form>
                </div>
            </div>
        </div>
        <!--/.Edit Modal-->

        </tr>
        @empty
         <tr>
           <td colspan="6" class="text-center">No record found</td>
         </tr>
        @endforelse
        </tbody>
      </table>

      <div class="col-md-12 mt-4">
         {{$users->links()}}
      </div>


    </div>
  </div>
</div>
</div>
</section>

    <!-- Add Client Modal -->
    <div class="modal fade" id="addNewClient">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <div class="alert alert-danger" style="display:none"></div>
                <div class="modal-header">
                    <h2 class="modal-title"><i class="fa fa-user"></i> Add Member</h2>
                    <button type="button" class="close" aria-label="Close" data-dismiss="modal">
                        <span aria-hidden="true">X</span>
                    </button>
                </div>
                <form class="" action="{{url('/members/addClient')}}" method="post" id='form'>
                  @csrf
                    <div class="ard-body px-2 modalCardBody">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="col-form-label" for="firstName">First Name</label>
                                <input type="text" name="firstName" id="firstName" class="form-control is-valid" placeholder="First Name" required >
                            </div>
                            <div class="form-group col-md-6">
                                <label class="col-form-label" for="middleName">Middle Name</label>
                                <input type="text" name="middleName" id="middleName"  class="form-control is-valid"  placeholder="Middle Name" >
                            </div>
                            <div class="form-group col-md-6">
                                <label class="col-form-label" for="lastName">Last Name</label>
                                <input type="text" name="lastName"  id="lastName" class="form-control is-valid"  placeholder="Last Name" required >
                            </div>
                            <div class="form-group col-md-6">
                                <label class="col-form-label" for="email">Email</label>
                                <input type="text" name="email" id="email" class="form-control is-valid" placeholder="Email" required >
                            </div>

                            <div class="form-group col-md-6">
                                <label class="col-form-label" for="group_id">Group</label>
                                <select name="group_id" class="form-control is-valid form-control-navbar input-sm" id="group_id" required>
                                    @if(isset($cGroup))
                                        @foreach($cGroup as $group)
                                            <option value="{{$group->id}}">{{$group->name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>
                    <center style="margin-top: -17px;" class="mb-3">
                        <button class="btn btn-danger" type="button" data-dismiss="modal">
                            <i class="fa fa-close"></i>Close
                        </button>
                        <button type="submit" class="btn btn-primary" >
                            <i class="fa fa-plus-circle"></i>Add Member
                        </button>
                    </center>
                </form>
            </div>
        </div>
    </div>
    <!-- End Add Client Modal -->

</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta.3/js/bootstrap.min.js"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.0/jquery.js"></script> 
<script src="http://code.jquery.com/jquery-3.3.1.min.js"  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="  crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<!---
sweet alert
<--->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.all.min.js"></script>


      <script>
         jQuery(document).ready(function(){
            jQuery('#ajaxSubmit').click(function(e){
               e.preventDefault();
               $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                  }
              });
               jQuery.ajax({
                  url: "{{ url('/members/addClient') }}",
                  method: 'post',
                  data: {
                     firstName: jQuery('#firstName').val(),
                     middleName: jQuery('#middleName').val(),
                     lastName: jQuery('#lastName').val(),
                     email: jQuery('#email').val(),
                     phone: jQuery('#phone').val(),
                     workPlace: jQuery('#workPlace').val(),
                     group_id: jQuery('#group_id').val(),
                     club: jQuery('#club').val(),

                  },
                  success: function(result){
                  	if(result.errors)
                  	{
                  		jQuery('.alert-danger').html('');

                  		jQuery.each(result.errors, function(key, value){
                  			jQuery('.alert-danger').show();
                  			jQuery('.alert-danger').append('<li>'+value+'</li>');
                  		});
                  	}
                  	else
                  	{
                  		$('#addNewClient').modal('hide');
                        swal("Done!","It was succesfully deleted!","success");
                        window.location.href ="http://mgc.zalegobusiness.com/mgc/public/members";
                       
                  	}
                  }});
               });
            });

      </script>  
      
@endsection
