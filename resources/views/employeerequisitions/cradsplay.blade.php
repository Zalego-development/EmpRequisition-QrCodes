$("#formid").on(submit, function(event){
    event.preventDefault()
  $(".summernote").map( note=>{
    if (!note.value()) {
      toastr.err("fields  required")  
    }
    else{

    }
  })
    var fields =$("textarea")
    if (!fields.val()) {
        toastr.err("fields people targeted required")
    }
})

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
        <!--                           <td>
                            <?php 
                          if( $approver['action'] == "submit") {
                             $approver->action
                              }
                          else{
                            {{$approver->action->"pending"}}
                          } 
                        ?></td> -->
                                 <div class="form-group">
      <label for="disabledTextInput">Employees</label>
        <select class="form-control" name="userId">
            
            <option value="">Select User</option> 
           @foreach ($users as $user)
           @php
         $managercompany=DB::table('users')
         ->join('companies' ,'companies.id' ,'=', 'users.company_id')
          ->where('users.id',$user->id)
          ->first();
         @endphp
        <option value="{{ $user->id }}"> {{ $user->name }}&nbsp;&nbsp;company- &nbsp;{{$managercompany->company}}</option> @endforeach    
      </select>   
    </div>

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
        $('table').dataTable();
    });
</script>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-muted ml-2 mt-2"><strong>Curriculums</strong></h1>
                    <ol class="breadcrumb float-sm-left ml-2">
                        <li class="breadcrumb-item"><a href="{{ route('instructor.home') }}"><i
                                    class="fa fa-home"></i></a></li>
                        <li class="breadcrumb-item active"><a href="#">Curriculums</a></li>
                    </ol>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <div class="float-right mt-2">
                        <div class="btn-group btn-group-justified">
                            <a href="{{ route('curriculum.index') }}" class="btn btn-primary" data-toggle="modal"
                                data-target="#exampleModal">
                                <i class=" fa fa-cog"></i> Refresh
                            </a>
                        </div>
                    </div>
                </div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="mt-2">
                        <div class="btn-group btn-group-justified">
                            <!--Button trigger modal -->
                            <a href="#" class="btn btn-info" data-toggle="modal" data-target="#addCurriculumModal"><i
                                    class=" fa fa-plus"></i>
                                Add Curriculum</a>
                            <!-- Modal -->
                            <div class="modal fade" id="addCurriculumModal" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Add Curriculum</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{ route('curriculum.store') }}" method="post">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="container">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="wrap-input100 validate-input">
                                                                <span class="label-input100">Curriculum Name<i
                                                                        class="text-danger">*</i></span>
                                                                <input type="text"
                                                                    class="form-control input100 @error('name') is-invalid @enderror"
                                                                    name="name" value="{{ old('name') }}" required
                                                                    autocomplete="name" placeholder="Curriculum Name">
                                                                <span class="focus-input100"></span>
                                                            </div>
                                                            <div>
                                                                {!! $errors->first('name', '<p
                                                                    class="help-block alert alert-danger">:message</p>')
                                                                !!}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Save</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
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
                            <strong> Curriculum <sup class="badge bg-white shadow-lg text-muted"></sup></strong>
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
                                                <th>Name</th>
                                                <th>Course</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                            $count = 1;
                                            @endphp
                                            @forelse ($curriculums as $curriculum)
                                            <tr>
                                                <td>{{ $count++ }}</td>
                                                <td>
                                                    <a href="{{ route('curriculum.show', $curriculum) }}">
                                                        {{ $curriculum->name }}
                                                    </a>
                                                </td>
                                                <td>{{ $curriculum->courses[0]->course_name ?? 'Not Assigned'}}</td>
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
                                                            <a class="dropdown-item"
                                                                href="{{ route('curriculum.show', $curriculum) }}"
                                                                style="cursor:pointer;" title="View more">
                                                                <i class="fa fa-eye text-warning"></i> View
                                                                curriculum</a>
                                                            <div>
                                                                <a class="dropdown-item" href="#"
                                                                    style="cursor:pointer;" data-toggle="modal"
                                                                    data-target="#editCurriculum-{{ $curriculum->id }}">
                                                                    <i class="fa fa-pen text-warning"></i> Edit
                                                                </a>
                                                            </div>
                                                            <div style="text-align: center">
                                                                <form
                                                                    action="{{ route('curriculum.destroy', $curriculum) }}"
                                                                    method="post">
                                                                    @method('DELETE')
                                                                    @csrf
                                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                                        title="Delete"
                                                                        onclick="return confirm(&quot;Confirm delete?&quot;)">
                                                                        Delete
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </div><br>
                                                    </span>
                                                </td>
                                            </tr>

                                            {{-- Curriculum Edit Form Modal --}}
                                            @include('curriculum.edit')

                                            @empty
                                            <tr>
                                                <td colspan="11" clas="text-center">
                                                    <div class="text-center py-5 " style="color:#b3cccc !important">
                                                        <i class="fa fa-file fa-5x"></i>
                                                        <i class="fa fa-times fa-2x"
                                                            style="z-index: 9999; color: #fff; margin-left: -25px;"></i>
                                                        <br>
                                                        <h6>No Curriculums available</h6>
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
</div>
</section>
</div>

<script type="text/javascript">
</script>


@endsection
///
<div class="row">
     @forelse ($employeeRequisitions as $emprequest)
                        <?php
                         $approvalsprogress=DB::table('requsitionsapprovals')
                         ->join('users', 'users.id', '=', 'requsitionsapprovals.userId')
                         ->where('requsitionsapprovals.jobid', $emprequest->id)
                          ->get(); 
                          
                        ?>
<div class="col-sm-4 mt-3">
                  <div class="card shadow-lg">
                    <div class="card-header bg-info py-4 ">
                      <h6>Job Tittle: {{ $emprequest->jobtittle }}</h6>
                      <div class="row">
                          <div class="col-sm-6"></div>
                           <div class="col-sm-6">
                                  <label for="disabledTextInput">Approvedby:</label>
                          <select  name="useremail">
                               @foreach ($approvalsprogress as $approver)
                          <option>{{$approver->name}}</option> 
                           @endforeach 
                         </select>
                           </div>
                      </div>
   
                    </div>
                    <div class="card-body">
                        <!--   <img src="https://hrmis.zalegoacademy.ac.ke/zalegohrms/public/assets/images/1436653_1629967331.png" alt="" width="80px" height="80px" class="rounded-circle shadow-lg float-right" style="position: relative; margin-top: -47px; border:3px solid #d0d0e1;"> -->
                        <div class="row">
                        <div class="col-12">
                          <strong class="text-muted"><i class="fa fa-briefcase"></i> Job type: </strong>{{ $emprequest->type }}<br>
                          <strong class="text-muted"><i class="fa fa-money"></i> Budgeted Salary: </strong>{{ $emprequest->salary }}<br>
                           <strong class="text-muted"><i class="fa fa-users"></i> No. of Positions: </strong>{{ $emprequest->positions }}<br>
                          <strong class="text-muted"><i class="fa fa-graduation-cap"></i> Education: </strong>{{$emprequest->posrequirements}} 
                                <br>
                                <strong class="text-muted"><i class="fa fa-users"></i> Experience: </strong>
                                {{$emprequest->posskills}} years of working Experience, 
                                <br>
                                 <!-- <span><i class="fa fa-clock-o"></i> Deadline: <i style="color:red;">30-Sep-2021</i></span> -->
                             </div>
                     <div class="col-12 mt-4">
<!--                 <a href="https://hrmis.zalegoacademy.ac.ke/jobPost/viewJob/81">
                        <button class="btn btn-default bg-orange shadow-lg" style="color:#fff !important;">View More &nbsp;<i class="fa fa-arrow-right"></i></button>
                    </a>&nbsp;&nbsp; -->
                    <form action="{{ route('employeerequisitions.destroy',$emprequest->id) }}" method="POST">
   
                    <a class="btn btn-info" href="{{ route('employeerequisitions.show',$emprequest->id) }}">View More</a>
                      @if($emprequest->status != 'initiated')
                    <a class="btn btn-primary" id="{{$emprequest->id}}" href="{{route('employeerequisitions.edit',$emprequest) }}">Edit</a>
                        @csrf
                        @method('DELETE')
                      
                    <button type="submit" class="btn btn-danger" id="{{$emprequest->id}}" >Delete</button>
                   
                         <a class="btn btn-success" id="{{$emprequest->id}}" href="{{route('employeerequisitions.initiate',$emprequest) }}" onclick="buttonToggler({{$emprequest->id}})">Initiate</a>
                    @endif
                   
                    </form>
                      </div>
                   </div>
                  </div>
                  </div>

                  <br>
                 
                </div>
                @empty
                <h6> No Requisitions</h6>
                @endforelse
</div>









@forelse ($employeeRequisitions as $emprequest)
<div class="modal fade" id="exampleModalapprovers{{$emprequest->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Approvers</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table ">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Approver Level</th>
      <th scope="col">Action</th>
      <th scope="col">Date</th>
    </tr>
  </thead>
  <tbody>
    @php
 $approvalsprogress=DB::table('requsitionsapprovals')
  ->join('users', 'users.id', '=', 'requsitionsapprovals.userId')
  ->join('employeerequisitionusers', 'employeerequisitionusers.userId' ,'=', 'users.id')
  ->where('requsitionsapprovals.jobid', $emprequest->id)
  ->where('requsitionsapprovals.initiator' ,'')
   ->get();


$aprroverslevels=DB::table('employeerequisitionusers')
  ->join('users', 'users.id', '=', 'employeerequisitionusers.userId')
    ->orderBy('employeerequisitionusers.employeetype', 'DESC')
   ->get()
    ->toArray();   
    $gettheinitator=DB::table('requsitionsapprovals') 
                                        ->join('users' , 'users.id', '=', 'requsitionsapprovals.userId') 
                                        ->where('requsitionsapprovals.jobid', $emprequest->id)
                                        ->where('requsitionsapprovals.initiator' ,'initiator')
                                        ->first();
                                       
                            $ininame=$gettheinitator->name;
                            $action='submit';
                            $emplyeetype='initiator';
                            $idini=$gettheinitator->id;
                            $date=$gettheinitator->date;
                           $pushdata=(object) ['userId'=> $idini,'name'=>$ininame, 'employeetype'=>$emplyeetype ,'action'=>"submit", 'date'=>$date]; 
                           array_unshift($aprroverslevels, $pushdata);
                           
                           
    $count = 1;
    @endphp
@foreach ($aprroverslevels as $approver)
    <tr>
      <td>{{ $count++ }}</td>
      <td>{{$approver->name}}</td>
      <td>{{$approver->employeetype}}</td>
      <td>
     @foreach($approvalsprogress as $aprove)
        @if($aprove->userId == $approver->userId)
      approved
        @else
      pending 
      @endif
      @endforeach
  </td>
      <td>
    @foreach($approvalsprogress as $aprove)
        @if($aprove->userId == $approver->userId)
       {{$aprove->date}}
      @else

      @endif
      @endforeach
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>                               @empty

                               @endforelse













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
        $('table').dataTable();
    });
</script>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-muted ml-2 mt-2"><strong>Employee Requisition</strong></h1>
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
        <!-- /.list of requisitions-fluid -->


         <div class="row">
            <div class="col">        <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalsetting">
 EmployeeRequisition Settings
</button>&nbsp;&nbsp;<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
 Add EmployeeRequisition Settings Users
</button></div>
    <div class="col"></div>  
        </div>
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
<!-- Modal  for settings-->
<div class="modal fade" id="exampleModalsetting" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">EmployeeRequisition settings</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{ url('employeerequisitionsettingsstore') }}">
            @csrf
      <fieldset >
     <div class="form-group">
      <label for="disabledTextInput">Approvals Levels</label>
      <input type="text" class="form-control" id="exampleFormControlTextarea1" name="employeetype" required="">
    </div>
      </fieldset>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Add</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!--- modals for users --->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Approvers Levels</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{ url('employeerequisitionusersstore') }}">
            @csrf
      <fieldset >
        <div class="form-group">
      <label for="disabledTextInput">Company</label>

        <select class="form-control" name="company" id="company" class="form-control input-lg dynamic" data-dependent="userId">
            <option>please Select Company</option>
            @php 
            $company=DB::table('companies')
                    ->get();
                    @endphp
           @foreach ($company as $camp)
        <option value="{{ $camp->id }}"> {{ $camp->company }} </option>            
            @endforeach    
      </select>   
    </div>
     <div class="form-group">
      <label for="disabledTextInput">Approver Job Title</label>
        <select class="form-control" name="employeetype">
            <option>please Select Job title</option>
           @foreach ($employeeRequisitionsettings as $setting)
        <option value="{{ $setting->employeetype }}"> {{ $setting->employeetype }} </option>            
            @endforeach    
      </select>   
    </div>
         <div class="form-group">
      <label for="disabledTextInput">Employees</label>
        <select name="userId" id="userId" class="form-control input-lg dynamic my-select" data-live-search="true">
             <option value="">Select users</option>  
      </select> 
       {{ csrf_field() }}  
    </div>
      </fieldset>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!--- table for all requisitions -->

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
                            <strong> Approvals Levels<sup class="badge bg-white shadow-lg text-muted"></sup></strong>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="reenabled-tests" data-toggle="tab" href="#reenabledTests" role="tab"
                            aria-controls="recurring" aria-selected="false"
                            style="color: gray !important; font-family: calibri;"><i
                                class="fa fa-users text-primary"></i><strong>
                                &nbsp; Approvers Users </strong></a>
                    </li>
                </ul>
                <div class="tab-content " id="myTabContent">
                    <div class="tab-pane fade show active" id="enrolled" role="tabpanel" aria-labelledby="home-tab">
                        <div class="card" style="border-shadow:none !important">
                            <div class="card-body">
                                <div class="table-responsive mt-3 mb-5">
                                    <table id="example1" class="table table-hover ">
                                        <thead>
                                            <tr class="bg-light">
                                                <th>#</th>
                                                <th>Approval Level</th>
                                                <th>Created_at</th>
                                                <th>Updated_at</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                            $count = 1;
                                            @endphp
                                            @forelse ($employeeRequisitionsettings as $emprequest)
                                            <tr>
                                                <td>{{ $count++ }}</td>
                                                <td>{{ $emprequest->employeetype }}</td>
                                                <td>{!! $emprequest->created_at!!}</td>
                                                <td>{{ $emprequest->updated_at }}</td>
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
                                                            <div style="text-align: center">
                                                                 <form action="{{route('destroyrequisitionsetting',$emprequest->id) }}" method="POST">
                                                                   <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModaledit{{$emprequest->id}}">Edit
                                                                  </button>
                                                                      @csrf
                                                                       @method('DELETE')

                                                                    <button type="submit" id="{{$emprequest->id}}" class="btn btn-danger btn-sm"
                                                                        title="Delete" onclick="return confirm(&quot;Confirm delete?&quot;")> Delete
                                                                    </button>
                                                                     
                                                                </form>
                                                            </div>
                                                        </div><br>
                                                    </span>
                                             </td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <td colspan="11" clas="text-center">
                                                    <div class="text-center py-5 " style="color:#b3cccc !important">
                                                        <i class="fa fa-file fa-5x"></i>
                                                        <i class="fa fa-times fa-2x"
                                                            style="z-index: 9999; color: #fff; margin-left: -25px;"></i>
                                                        <br>
                                                        <h6>No Applicants available</h6>
                                                    </div>
                                                </td>
                                            </tr>
                                   @endforelse
                                        </tbody>
                                    </table>
                                <!-- Button trigger modal -->

                            @forelse ($employeeRequisitionsettings as $emprequest)

                                <!-- Modal -->
                               <div class="modal fade" id="exampleModaledit{{$emprequest->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabeledit"                                aria-hidden="true">
                                 <div class="modal-dialog" role="document">
                                   <div class="modal-content">
                                     <div class="modal-header">
                                       <h5 class="modal-title" id="exampleModalLabel">Employee Requisition settings</h5>
                                       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                         <span aria-hidden="true">&times;</span>
                                       </button>
                                     </div>
                                     <div class="modal-body">
                                       <form action="{{url('employeerequisitionsettingsupdate')}}" method="POST">
                                       @csrf

                                       <fieldset class="col-md-12" >
                                        <div class="form-group">
                                       <input type="text" class="form-control" id="exampleFormControlTextarea1" value="{{$emprequest->id}}" name="id" hidden="" required="">
                                     </div>
                                      <div class="form-group">
                                       <label for="disabledTextInput">Employee Type</label>
                                       <input type="text" class="form-control" id="exampleFormControlTextarea1" value="{{$emprequest->employeetype}}" name="employeetype" required="">
                                     </div>
   
                                       </fieldset>
                                       <br>
                                       
                                       
                                     </div>
                                     <div class="modal-footer">
                                       <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                         <button type="submit" class="btn btn-primary">Save changes</button>
                                     </div>
                                       </form>
                                   </div>
                                 </div>
                               </div>
                               @empty

                               @endforelse


                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- users tabs ---->
                <div class="tab-pane fade" id="reenabledTests" role="tabpanel" aria-labelledby="reenabled-tests">
                        <div class="card" style="border-shadow:none !important">

                            <div class="card-body">
                                <div class="table-responsive mt-3 mb-5">
                                    <table id="example1" class="table table-hover ">
                                        <thead>
                                            <tr class="bg-light">
                                               <th>#</th>
                                               <th>Company</th>
                                               <th>Approval Level</th> 
                                               <th>Approver Name</th>  
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                            $count = 1;
                                            @endphp
                                            @forelse ($employeeRequisitionusers as $emprequest)
                                            <tr>
                                                <td>{{ $count++ }}</td>
                                                @php
                                                $manager=DB::table('users')
                                                         ->join('employeerequisitionusers', 'employeerequisitionusers.userId', '=', 'users.id')
                                                         ->where('employeerequisitionusers.userId',$emprequest->userId)
                                                         ->first();
                                                @endphp

                                                 @php
                                                $managercompany=DB::table('users')
                                                         ->join('employeerequisitionusers', 'employeerequisitionusers.userId', '=', 'users.id')
                                                         ->join('companies' ,'companies.id' ,'=', 'users.company_id')
                                                         ->where('employeerequisitionusers.userId',$emprequest->userId)
                                                         ->first();
                                                @endphp
                                                <td> {{ $managercompany->company }}</td>
                                                <td>{{ $emprequest->employeetype }}</td>
                                                <td> {{ $manager->name }}</td>
                                                

                                                
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
                                                            <div style="text-align: center">
                                                                <form action="{{route('employeerequisitionsusers.destroy',$emprequest->id) }}" method="POST">
                                                                   <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModaledita{{$emprequest->id}}">Edit
                                                                   </button>
                                                                      @csrf
                                                                       @method('DELETE')

                                                                    <button type="submit" id="{{$emprequest->id}}" class="btn btn-danger btn-sm"
                                                                        title="Delete" onclick="return confirm(&quot;Confirm delete?&quot;")> Delete
                                                                    </button>
                                                                     
                                                                </form>
                                                            </div>
                                                        </div><br>
                                                    </span>
                                             </td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <td colspan="11" clas="text-center">
                                                    <div class="text-center py-5 " style="color:#b3cccc !important">
                                                        <i class="fa fa-file fa-5x"></i>
                                                        <i class="fa fa-times fa-2x"
                                                            style="z-index: 9999; color: #fff; margin-left: -25px;"></i>
                                                        <br>
                                                        <h6>No Applicants available</h6>
                                                    </div>
                                                </td>
                                            </tr>
                                   @endforelse
                                        </tbody>
                                    </table>
                                   
                            @forelse ($employeeRequisitionusers as $emprequest)

                                <!-- Modal -->
                               <div class="modal fade" id="exampleModaledita{{$emprequest->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabeledit"aria-hidden="true">
                                 <div class="modal-dialog" role="document">
                                   <div class="modal-content">
                                     <div class="modal-header">
                                       <h5 class="modal-title" id="exampleModalLabel">Employee Requisition settings</h5>
                                       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                         <span aria-hidden="true">&times;</span>
                                       </button>
                                     </div>
                                     <div class="modal-body">
                                       <form action="{{route ('employeerequisitionsettingsupdate')}}" method="POST">
                                       @csrf

                                       <fieldset class="col-md-12" >
                                        <div class="form-group">
                                                @php
                                                $manager=DB::table('users')
                                                         ->join('employeerequisitionusers', 'employeerequisitionusers.userId', '=', 'users.id')
                                                         ->where('employeerequisitionusers.userId',$emprequest->userId)
                                                         ->first();
                                                @endphp
                                       <input type="text" class="form-control"  value="{{$emprequest->id}}" name="id" hidden="" required="">
                                     </div>
                                          <div class="form-group">
                                          <select class="form-control" name="employeetype">
                                            <option value="{{$emprequest->employeetype}}">{{$emprequest->employeetype}}</option>
                                         @foreach ($employeeRequisitionsettings as $setting)
                                         <option value="{{ $setting->employeetype }}"> {{ $setting->employeetype }} </option>            
                                        @endforeach    
                                       </select> 
                                   </div>
                                         <div class="form-group">
                                       <label for="disabledTextInput">Employee Type</label>
                                               <select class="form-control" name="userId">
                                                <option value="{{$manager->userId}}">{{$manager->name}}&nbsp; </option>
                                                    @foreach ($users as $user)
                                                 <option value="{{ $user->id }}"> {{ $user->name }} </option>            
                                                     @endforeach    
                                               </select> 

                                               </div>
                                       </fieldset>
                                       <br>
                                       
                                       
                                     </div>
                                     <div class="modal-footer">
                                       <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                         <button type="submit" class="btn btn-primary">Save changes</button>
                                     </div>
                                       </form>
                                   </div>
                                 </div>
                               </div>
                               @empty

                               @endforelse                                    <!-- Button trigger modal -->


                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

</section>
</div>
<script type="text/javascript">
    function buttonToggler(id){
        $('#'+id).slideUp()
    }
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
    url:"{{ route('dynamicdependent.fetch') }}",
    method:"POST",
    data:{select:select, value:value, _token:_token, dependent:dependent},
    success:function(result)
    {
     $('#'+dependent).html(result.output);
    }

   })
  }
 });
 
// $('.my-select').selectpicker();
});
</script>
         

@endsection



































 <?php 


// if the initiator is the HR Recruiter
 $getinitators=DB::table('employeerequisitions')
              ->where('status', 'initiated')
              ->where('stages', 0)
              ->get();

        $user=Auth::user()->id;
        //get the role if any
        $getrole=DB::table('employeerequisitionusers')
                ->where('userId', $user)
                ->first();

                $role=$getrole->employeetype ?? null;
$getnotification =DB::table('employeerequisitions')
                 ->where('status', 'initiated')
                  ->get();

        if ($role=='HR Recruitment Team') {

            foreach($getnotification as $notify){
             if ($notify->stages == 0 && $notify->stage1==0 && $notify->stage2 ==0 && $notify->stage3 ==0 && $notify->action==0) {
                ?>
                <script>
                if (window.confirm('click OK to Approve Employee Requisition From Hiring Manager . Cancel to ignore ')) 
                 {
                window.location.href='{{route ('calltoaction')}}';
                 };
                </script>
     <!--     <p style="margin:0;font-size:12px;line-height:14px;font-family:Arial,sans-serif;padding-left: 70%; color: red;"> <a href="{{route ('calltoaction')}}">Employee Requisition Approvals</a></p> -->
         <?php
            }
            
            }

             }
        elseif($role =='Group CEO'){
     $getnotificationceo =DB::table('employeerequisitions')
                 ->where('status', 'initiated')
                 ->where('stages', 1)
                 ->where('stage1', 1)
                 ->where('stage2', 1)
                  ->get();
            foreach($getnotificationceo as $notify){
             if ($notify->stage3 == 0 && $notify->role =='HR Recruitment Team') { 
                ?>
                 <script>
                if (window.confirm('click OK to Approve Employee Requisition From Recruitement Team . Cancel to ignore ')) 
                 {
                window.location.href='{{route ('calltoactionceorecruinitiator')}}';
                 };
                </script>
               <!--     <p style="margin:0;font-size:12px;line-height:14px;font-family:Arial,sans-serif;padding-left: 70%; color: red;"> <a href="{{route ('calltoactionceorecruinitiator')}}">Employee Requisition From Recruitement Team</a></p> -->
     
         <?php
            }
            elseif($notify->stage3 == 0 && $notify->role =='' && $notify->action =='3'){
                ?>
                <script>
                if (window.confirm('click OK to Approve Employee Requisition From Hiring Manager . Cancel to ignore ')) 
                 {
                window.location.href='{{route ('calltoaction3')}}';
                 };
                </script>
 <!--                    <p style="margin:0;font-size:12px;line-height:14px;font-family:Arial,sans-serif;padding-left: 70%; color: red;"> <a href="{{route ('calltoaction3')}}">Employee Requisition From Recruitement Team</a></p> -->
                    <?php      
            }
            elseif ($notify->stage3 == 0 && $notify->role =="HR Manager" && $notify->action =='1') {
                ?>
                <script>
                if (window.confirm('click OK to Approve Employee Requisition From HR Manager . Cancel to ignore ')) 
                 {
                window.location.href='{{route ('calltoactionceochrinitiator')}}';
                 };
                </script>
<!--                 <p style="margin:0;font-size:12px;line-height:14px;font-family:Arial,sans-serif;padding-left: 70%; color: red;"> <a href="{{route ('calltoactionceochrinitiator')}}">Employee Requisition From HR Manager</a></p> -->
                 <?php
            }
             elseif ($notify->stage3 == 0 && $notify->role =="Executive Lead" && $notify->action =='0') {
                ?>
                <script>
                if (window.confirm('click OK to Approve Employee Requisition From Executive Lead . Cancel to ignore ')) 
                 {
                window.location.href='{{route ('calltoactionceoexecinitiator')}}';
                 };
                </script>
                <p style="margin:0;font-size:12px;line-height:14px;font-family:Arial,sans-serif;padding-left: 70%; color: red;"> <a href="{{route ('calltoactionceoexecinitiator')}}">Employee Requisition From Executive Lead</a></p>
                 <?php
            }
            
            }    
                        }
             elseif ($role =="HR Manager") {
                $getnotificationhr =DB::table('employeerequisitions')
                 ->where('status', 'initiated')
                 ->where('stages', 1)
                  ->get();
            foreach($getnotificationhr as $notify){
             if ($notify->stage1 == 0 && $notify->role== 'HR Recruitment Team' && $notify->action==0) {
                ?>
                <script>
                if (window.confirm('click OK to Approve Employee Requisition From Recruitment Team . Cancel to ignore ')) 
                 {
                window.location.href='{{route ('calltoactionhrrecrurinitiator')}}';
                 };
                </script>
<!--                   <p style="margin:0;font-size:12px;line-height:14px;font-family:Arial,sans-serif;padding-left: 70%; color: red;">  <a href="{{route ('calltoactionhrrecrurinitiator')}}"> Employee Requisition from HR Recruitment Team</a><br><br></p> -->
   
         <?php
            }
            else if ($notify->role =="" && $notify->stage1 ==0) {
                ?>
                <script>
                if (window.confirm('click OK to Approve Employee Requisition From Recruitment Team . Cancel to ignore ')) 
                 {
                window.location.href='{{route ('calltoaction1')}}';
                 };
                </script>
<!--                      <p style="margin:0;font-size:12px;line-height:14px;font-family:Arial,sans-serif;padding-left: 70%; color: red;"> <a href="{{ route ('calltoaction1')}}">Employee Requisition Approvals</a></p> -->
                     <?php
            }
            
            }
                }
             elseif ($role =="Executive Lead") {
                $getnotificationexec =DB::table('employeerequisitions')
                 ->where('status', 'initiated')
                 ->where('stages', 1)
                 ->where('stage1', 1)
                  ->get();
            foreach($getnotificationexec as $notify){
             if ($notify->stage2 == 0 && $notify->role =="HR Recruitment Team") {
                ?>
                <script>
                if (window.confirm('click OK to Approve Employee Requisition From Recruitment Team . Cancel to ignore ')) 
                 {
                window.location.href='{{route ('calltoactionexecrecrurinitiator')}}';
                 };
                </script>
<!--                 <p style="margin:0;font-size:12px;line-height:14px;font-family:Arial,sans-serif;padding-left: 70%; color: red;">  <a href="{{route ('calltoactionexecrecrurinitiator')}}"> Employee Request From Recruitment Team</a><br><br></p> -->
                
         <?php
            }
            elseif($notify->stage2 == 0 && $notify->role ==""){
                ?>
                <script>
                if (window.confirm('click OK to Approve Employee Requisition From Hiring Manager . Cancel to ignore ')) 
                 {
                window.location.href='{{route ('calltoaction2')}}';
                 };
                </script>
            <!--     <p style="margin:0;font-size:12px;line-height:14px;font-family:Arial,sans-serif;padding-left: 70%; color: red;"> <a href="{{route ('calltoaction2')}}">Employee Requisition From  Manager</a></p> -->
                <?php     
            }
            elseif ($notify->stage2 == 0 && $notify->role =="HR Manager") {
                ?>
                <script>
                if (window.confirm('click OK to Approve Employee Requisition From HR Manager . Cancel to ignore ')) 
                 {
                window.location.href='{{route ('calltoactionexechrinitiator')}}';
                 };
                </script>
                
                <!-- <p style="margin:0;font-size:12px;line-height:14px;font-family:Arial,sans-serif;padding-left: 70%; color: red;"> <a href="{{route ('calltoactionexechrinitiator')}}"></a></p> -->
                 <?php
            }
            
            }
                        }
                        else{
                            
                         }
                         ?>
                        