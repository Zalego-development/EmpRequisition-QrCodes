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
         <div class="pull-left">
            <a class="btn btn-primary" href="{{ route('tabspage') }}"> Back</a>
        </div>
        <br>
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
 <form action="{{ route('employeerequisitions.update',$employeeRequisition->id) }}" method="POST">
                @csrf

 @method('PUT')
      <fieldset class="col-md-12" >
        <div class="row">
            <div class="col">
            <div class="form-group">
         <label for="disabledTextInput">Job Tittle</label>
           <input type="text" class="form-control" readonly="" id="exampleFormControlTextarea1" value="{{$employeeRequisition->jobtittle}}" name="jobtittle" required="">
           </div> 
            </div>

            <div class="col">
                    <div class="form-group">
                  <label for="disabledTextInput">Budgeted Salary </label>
                    <input type="number" readonly="" class="form-control" id="exampleFormControlTextarea1" name="salary" value="{{$employeeRequisition->salary}}" required="">
                  </div>
            </div>
  <!--               <div class="col">
                <div class="form-group">
                  <label for="disabledTextInput">Salary Range to?</label>
                    <input type="number" readonly="" class="form-control" id="exampleFormControlTextarea1" name="salaryto" value="{{$employeeRequisition->salaryto}}" required="">
                  </div>
            </div> -->
                     
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                  <label for="disabledTextInput">Location</label>
                    <input type="text" readonly="" class="form-control" id="exampleFormControlTextarea1" name="location" value="{{$employeeRequisition->location}}" required="">
                  </div>
            </div>
            <div class="col">
                <div class="form-group">
                  <label for="disabledTextInput">People Targeted</label><br>
                                                 @php
                                                    $intenting = unserialize($employeeRequisition->intenting)
                                                    @endphp
                                                
                                                    @foreach($intenting as $intent)
                                                        <input type="checkbox" name="intenting[]"   checked="true">{{ $intent }} &nbsp;
                                                    @endforeach
                                                   
                  </div>
            </div>
         <div class="col">
                <div class="form-group">
                  <label for="disabledTextInput">Job Type</label>
                    <input type="text" readonly="" class="form-control" id="exampleFormControlTextarea1" name="salary" value="{{$employeeRequisition->employementtype}}" required="">
                  </div>
            </div>
        </div>
        <div class="row">

                <div class="col">
                <div class="form-group">
                  <label for="disabledTextInput">PWD Apply</label>
                    <input type="text" readonly="" class="form-control" id="exampleFormControlTextarea1" name="salary" value="{{$employeeRequisition->pwd}}" required="">
                  </div>
            </div>
                      <div class="col">
                <div class="form-group">
                  <label for="disabledTextInput">Levels Of Interviews</label>
                  @php
                 $interviews = unserialize($employeeRequisition->interviews)
                                                    @endphp
                                                 
                                                    @foreach($interviews as $intent)
                                                        <input type="checkbox" name="interviews[]"  checked="true">{{ $intent }} &nbsp;
                                                    @endforeach
                                                    </ul>
                  </div>
            </div>
          <div class="col">
            <div class="form-group">
            <label for="disabledTextInput">Number of Positions</label>
             <input type="number" class="form-control" readonly="" id="exampleFormControlTextarea1" value="{{ $employeeRequisition->positions}}" name="positions" required="">
             </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                <label>Starting Date</label>
                <input type="date" name="" class="form-control" readonly="" value="{{$employeeRequisition->startdate}}">
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                <label>JobCategory</label>
                <input type="text" name="" class="form-control" readonly="" value="{{$employeeRequisition->jobcategory}}">
                </div>
            </div>
                <div class="col">
                <div class="form-group">
                  <label for="disabledTextInput">Manager Reported to</label>
                     @php
                     $reportto=DB::table('employeerequisitions')
                              ->where('id', $employeeRequisition->id)
                              ->first();
                    $manager = App\Models\User::find($employeeRequisition->manager)->where('id',$reportto->manager)->first();
                    @endphp
                                               
                    <input type="text" readonly="" class="form-control" id="exampleFormControlTextarea1" name="salary" value="{{$manager->name}}" required="">
                  </div>
            </div>
      </div>
          <div class="form-group">
      <label for="disabledTextInput">Job Description</label>
      <textarea class="form-control textarea" readonly="" id="exampleFormControlTextarea1"  name="jobdescription" rows="3">{!!$employeeRequisition->jobdescription!!}</textarea>
    </div>
          <div class="form-group">
      <label for="disabledTextInput">Responsibilities</label>
      <textarea class="form-control textarea" readonly="" id="exampleFormControlTextarea1" name="resposnsibilities" rows="3">{!! $employeeRequisition->responsibilities!!}</textarea>
    </div>
              <div class="form-group">
    <label for="disabledTextInput">Requirements</label>
      <textarea class="form-control textarea summernote" id="exampleFormControlTextarea1" required name="salarybudget" rows="3">{!! $employeeRequisition->salarybudget!!}</textarea>
    </div>
                      <div class="form-group">
                  <label for="disabledTextInput">Skills</label>
                     <textarea class="form-control textarea" readonly="" id="exampleFormControlTextarea1" name="resposnsibilities" rows="3">{!! $employeeRequisition->posrequirements!!}</textarea>
                  </div>
  

 

      </fieldset>
        </form>
</section>
</div>
<script type="text/javascript">
</script>
  
         

@endsection
