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

        <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Request Employee
</button>
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
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Request Employee</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{ route('employeerequisitions.store') }}">
            @csrf
      <fieldset >
     <div class="form-group">
      <label for="disabledTextInput">Job Tittle</label>
      <input type="text" class="form-control" id="exampleFormControlTextarea1" name="jobtittle" required="">
    </div>
    <div class="form-group">
      <label >Employement Type</label>
<!--       <input type="text" class="form-control" id="exampleFormControlTextarea1" name="type" required=""> -->
    <select class="form-control" name="type" required="">
        <option value="permanent"> Permanent </option>            
        <option value="Contract"> Contract </option>
        <option value="Internships"> Internships </option>
        <option value="Attachements"> Attachments </option>
      </select>
    </div>
    <div class="form-group">
    <label for="disabledTextInput">Budgeted Salary</label>
      <input type="number" class="form-control" id="exampleFormControlTextarea1" name="salary" required="">
    </div>
        <div class="form-group">
    <label for="disabledTextInput">Position requirements</label>
      <input type="text" class="form-control" id="exampleFormControlTextarea1" name="posrequirements" required="">
    </div>
        <div class="form-group">
    <label for="disabledTextInput">Years Of working Experience</label>
      <input type="number" class="form-control" id="exampleFormControlTextarea1" name="posskills" required="">
    </div>
        <div class="form-group">
      <label for="disabledTextInput">Responsibilities</label>
      <textarea class="form-control textarea" id="exampleFormControlTextarea1" name="responsibilities" rows="3"></textarea>
    </div>
    <div class="form-group">
      <label for="disabledTextInput">Job Description</label>
      <textarea class="form-control textarea" id="exampleFormControlTextarea1" name="jobdescription" rows="3"></textarea>
    </div>
    <div class="form-group">
      <label for="disabledTextInput">Number of Positions</label>
      <input type="number" class="form-control" id="exampleFormControlTextarea1" name="positions" required="">
    </div>
<!--     <div class="form-group">
      <label for="disabledTextInput">Select executive Lead</label>
      <select class="form-control" name="useremail">
           @foreach ($users as $user)
    <option value="{{ $user->email }}"> {{ $user->name }} </option>            
            @endforeach    
      </select>
    </div> -->
      </fieldset>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Request Employee</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!--  requistions list -->
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
                            <strong> Employees Requisitions <sup class="badge bg-white shadow-lg text-muted"></sup></strong>
                        </a>
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
                                                <th>JobTittle</th>
                                                
                                                <th>No. of Positions</th>
                                                 <th>Salary</th>
                                               
                                                <th>Job Type</th>
                                                <th>Location</th>
                                                <th>people Targeted</th>
                                                <th>JobCategory</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                            $count = 1;
                                            @endphp
                                            @forelse ($employeeRequisitions as $emprequest)
                                            <tr>
                                                <td>{{ $count++ }}</td>
                                                <td>{{ $emprequest->jobtittle }}</td>
                                               
                                                <td>{{ $emprequest->positions }}</td>
                                               <td>{{ $emprequest->salary }}-{{$emprequest->salaryto}}</td>
                                               
                                                <td>{{ $emprequest->employementtype }}</td>
                                                <td>{{ $emprequest->location}}</td>
                                                 <td>
                                                    @php
                                                    $intenting = unserialize($emprequest->intenting)
                                                    @endphp
                                                    <ul>
                                                    @foreach($intenting as $intent)
                                                        <li>{{ $intent }}</li>
                                                    @endforeach
                                                    </ul>
                                                </td>
                                                <td>{{ $emprequest->jobcategory}}</td>>
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
                                                                href="{{ route('employeerequisitions.show',$emprequest->id) }}"
                                                                style="cursor:pointer;" title="View more">
                                                                <i class="fa fa-eye text-warning"></i> View More
                                                                </a>
                                                            @if($emprequest->stage1 != '1')
                                                            <a class="dropdown-item" id="{{$emprequest->id}}"
                                                                href="{{ url('approve/' . $emprequest->id)}}"
                                                                style="cursor:pointer;" title="View more">
                                                                <i class="fa fa-eye text-warning"></i> Approve
                                                                Requisition</a>
                                                            <div>
                                                                <a class="dropdown-item" id="{{$emprequest->id}}" href="{{ url('decline/' . $emprequest->id)}}">
                                                                    <i class="fa fa-pen text-warning"></i> Decline Requisition
                                                                </a>
                                                            </div>
                                                            <div>
                                                                <a class="dropdown-item" id="{{$emprequest->id}}" href="{{ url('returnforcorrectionstoleadexec/' . $emprequest->id .'/'.$emprequest->user)}}">
                                                                    <i class="fa fa-pen text-warning"></i> Return For Corrections
                                                                </a>
                                                            </div>
                                                            @endif
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
  
         

@endsection



