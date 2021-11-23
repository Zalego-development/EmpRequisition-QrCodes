@extends('layouts.main')
@section('content')

<style type="text/css">
    #newStudent .form-control {
        /**padding: 17px !important;**/
        /*border-color: transparent !important;*/
    }

    #successM {
        display: none;
    }

    .btn-default {
        background-color: #fe740b !important;
        color: #fff !important;
    }

    .btn-default:hover {
        color: #fff !important;
        background-color: #60b117 !important;
        -webkit-transition: background-color 1000ms linear;
        -ms-transition: background-color 1000ms linear;
        transition: background-color 1000ms linear;
    }

    .dropdown-menu {
        position: absolute;
        top: 100%;
        left: 0;
        margin-bottom: 20%;
        z-index: 3000;
        display: none;
        float: left;
        min-width: 10rem;
        padding: 0.5rem 0;
        margin: 0.125rem 0 0;
        font-size: 1rem;
        color: #212529;
        text-align: left;
        list-style: none;
        background-color: #ffffff;
        background-clip: padding-box;
        border: 1px solid rgba(0, 0, 0, 0.15);
        border-radius: 0.25rem;
        box-shadow: 0 0.5rem 1rem rgb(0 0 0 / 18%);
    }

    .card {
        border-color: transparent !important;
        border-radius: 0px !important;
        background-color: #fff !important;
    }

    .dropdown-item:focus,
    .dropdown-item:hover {
        background-color: transparent !important;
    }

    #wp-icon:hover {
        border: 1px solid orange !important;
        color: orange !important;
    }

</style>
<script>
      $(function () {
        $('#example1').dataTable();
    });
</script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">

                <div class="col-sm-6">
                    <br>
                    <ol class="breadcrumb float-sm-left ml-2">

                        <li class="breadcrumb-item active"><a href="#">Staff QR Codes Generations</a></li>
                    </ol>
                </div><!-- /.col -->

                <div class="col-sm-6">
                    <div class="float-right mt-2">
                        <div class="btn-group btn-group-justified">

                        </div>
                    </div>
                </div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <section class="content">
                 <div class="row">
              <div class="col"></div> 
            <div class="col"></div> 
    <div class="col" >        <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModaldepartments">
    <i class="fas fa-file-export" ></i>
 Export By Departments
</button>&nbsp;&nbsp;
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
     <i class="fas fa-file-export" ></i>
 Export By Companies
</button>
</div>
   
        </div>

         <!-- modal for selecting exports Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Export Qr Code By Companies</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{ url('export') }}">
            @csrf
      <fieldset >
        <div class="form-group">
      <label for="disabledTextInput">Company</label>

        <select class="form-control" name="company" class="js-example-basic-single" required="">
            <option value="">please Select Company</option>
            @php 
            $company=DB::table('companies')
                    ->get();
                    @endphp
           @foreach ($company as $camp)
        <option value="{{ $camp->id }}"> {{ $camp->company }} </option>          
            @endforeach   
             <option value="All">All Companies</option>   
      </select>   
    </div>

      </fieldset>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Export</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- eddnd of the modal -->



         <!-- modal for selecting exports forf departments Modal -->
<div class="modal fade" id="exampleModaldepartments" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Export Qr Code By Department</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{ url('exportdepartments') }}">
            @csrf
      <fieldset >
        <div class="form-group">
      <label for="disabledTextInput">Departments</label>

        <select class="form-control" name="department" id="company" class="js-example-basic-single" required="" class="form-control input-lg dynamic" data-dependent="userId">
            <option value="">please Select Company</option>
            @php 
            $company=DB::table('companies')
                    ->get();
                    @endphp
           @foreach ($company as $camp)
        <option value="{{ $camp->id }}"> {{ $camp->company }} </option>          
            @endforeach     
      </select> 
         <div class="form-group">
      <label for="disabledTextInput">Employees</label>
        <select name="userId" id="userId" class="form-control input-lg dynamic my-select" data-live-search="true">
             <option value="">Select Department</option>  
      </select> 
       {{ csrf_field() }}  
    </div>  
    </div>

      </fieldset>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Export</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- eddnd of the modal -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="mt-2">
                        </div>

                    </div>
                </div>
            </div>
            <hr>
            <div class="col-md-12 mb-3">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#enrolled" role="tab"
                            aria-controls="home" aria-selected="true"
                            style="color: gray !important; font-family: calibri;">
                            <i class="fa fa-clipboard text-primary"></i>
                            <strong> Staff QR Codes Generations <sup class="badge bg-white shadow-lg text-muted"></sup></strong>
                        </a>
                    </li>
                </ul>

                <div class="tab-content " id="myTabContent">
                    <div class="tab-pane fade show active" id="enrolled" role="tabpanel" aria-labelledby="home-tab">
                        <div class="card" style="border-shadow:none !important">
                            <div class="card-body">

                                @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endif

                                <div class="table-responsive mt-3 mb-5">
                                    <table id="example1" class="table table-hover ">
                                        <thead>
                                            <tr class="bg-light">
                                                <th>#</th>
                                                <th>FirstName</th>
                                                 <th>Lastname</th>
                                                <th>Title</th>
                                                <th>Email</th>
                                                 <th>Department</th>
                                                  <th>Phone</th>
                                                <th>Generated QR</th>
                                               
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                            $count = 1;
                                            @endphp
                                            @forelse ($users as $user)
                                            <tr>
                                                <td>{{ $count++ }}</td>
                                                <td>{{ $user->firstname }}</td>
                                                <td>{{ $user->lastname}}</td>
                                                     @php 
                                                    $title=DB::table('titles')
                                                          ->where('id', $user->designationId)
                                                          ->first();
                                                     @endphp
                                                <td>{{ $title->title}}</td>
                                                <td>{{ $user->corporateEmail}}</td>
                                                    @php 
                                                    $departmentId=DB::table('departments')
                                                                 ->where('id', $user->departmentId)
                                                                 ->first();
                                                    @endphp
                                                <td>{{ $departmentId->department}}</td>
                                                <td>{{$user->contact}}</td>
                                                <!-- <td>{!! $user->qrcode !!}</td> -->
                                                 <td>
                                                        <span class="dropdown">
                                                        <a title="Action tab" id="wp-icon" class="btn btn-secondary "
                                                            style="border: 1px dashed gray; border-radius:50%; box-shadow:none !important"
                                                            href="#" id="dropdownMenuButton" data-toggle="dropdown"
                                                            aria-haspopup="true" aria-expanded="false"
                                                            style="cursor: pointer;">
                                                            <i class="fa fa-ellipsis-h"
                                                                style="margin-top: -9px !important;"></i></a>
                                                        <div style="margin-left:-120px !important;"
                                                            class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                            <a class="dropdown-item" href="{{ route('generate',$user->userId) }}"
                                                                style="cursor:pointer;" title="generate qr codes">
                                                                <i class="fas fa-file-export text-warning"></i> Generate Qr Code Staff
                                                                </a>
                                                                 <a class="dropdown-item" href="{{ route('visitor') }}"
                                                                style="cursor:pointer;" title="generate qr codes">
                                                                <i class="fas fa-file-export text-warning"></i> Generate Qr Code Visitor
                                                                </a>
                                                                <a class="dropdown-item" id="" href="{{ route('exportdownload',$user->userId) }}"  style="cursor:pointer;" title="Export Qr Code">
                                                                    <i class="fas fa-file-export text-warning"></i> Export
                                                                </a>
                                                        </div><br>
                                                    </span>
                                            </tr>
                                            @empty
                                            <tr>
                                                <td colspan="11" clas="text-center">
                                                    <div class="text-center py-5 " style="color:#b3cccc !important">
                                                        <i class="fa fa-file fa-5x"></i>
                                                        <i class="fa fa-times fa-2x"
                                                            style="z-index: 9999; color: #fff; margin-left: -25px;"></i>
                                                        <br>
                                                        <h6>No Comments available</h6>
                                                    </div>
                                                </td>
                                            </tr>
                                   @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<div class="d-flex align-items-start">...</div>
<div class="d-flex align-items-end">...</div>
<div class="d-flex align-items-center">...</div>
<div class="d-flex align-items-baseline">...</div>
<div class="d-flex align-items-stretch">...</div>
</section>
</div>
<script type="text/javascript">
</script>
    <script>
$(document).ready(function(){
 $('#company').change(function(){
  if($(this).val() != '')
  {
   var select = $(this).attr("id");
   var value = $(this).val();
   var dependent = $(this).data('dependent');
   var _token = $('input[name="_token"]').val();
   $.ajax({
    url:"{{ route('dynamicdependent.fetch2') }}",
    method:"POST",
    data:{select:select, value:value, _token:_token, dependent:dependent},
    success:function(result)
    {
     $('#'+dependent).html(result.output);
    }

   })
  }
 });
});
</script>
         

@endsection



