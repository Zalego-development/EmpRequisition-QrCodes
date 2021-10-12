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
            <a class="btn btn-primary" href="{{ route('employeerequisitions.index') }}"> Back</a>
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
           <input type="text" class="form-control"  id="exampleFormControlTextarea1" value="{{$employeeRequisition->jobtittle}}" name="jobtittle" required="">
           </div> 
            </div>
            <div class="col">
            <div class="form-group">
            <label for="disabledTextInput">Budgeted Salary From?</label>
             <input type="number" class="form-control"  id="exampleFormControlTextarea1" value="{{ $employeeRequisition->salary}}" name="salary" required="">
             </div>
            </div>
            <div class="col">
                    <div class="form-group">
                  <label for="disabledTextInput">Budgeted Salary To</label>
                    <input type="number"  class="form-control" id="exampleFormControlTextarea1" name="salaryto" value="{{$employeeRequisition->salaryto}}" required="">
                  </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                  <label for="disabledTextInput">Location</label>
                     <select class="form-control" name="location" required="">
                        <option value="{{$employeeRequisition->location}}">{{$employeeRequisition->location}}</option>
                             <?php
                             $locations=DB::table('workregions')
                                   ->get();
                              ?>
         @foreach ($locations as $location)
         <option value="{{ $location->region }}"> {{ $location->region }} </option>            
            @endforeach 
                 </select>
                  </div>
            </div>
            <div class="col">
                <div class="form-group">
                  <label for="disabledTextInput">People Targeted</label>
                           <select class="form-control" name="intenting" required="">
                            <option value="{{$employeeRequisition->intenting}}">{{$employeeRequisition->intenting}}</option>
                              <option value="Internal"> Internal </option>  
                                <option value="External"> External </option>  
                                  <option value="Both"> Both </option>          
                           </select>
                  </div>
            </div>
         <div class="col">
                <div class="form-group">
                    <label>Job Type</label>
                      <select class="form-control" name="employementtype" required="">
                        <option value="{{$employeeRequisition->employementtype}}">{{$employeeRequisition->employementtype}}</option>
                    <?php
                      $jobstypes=DB::table('job_types')
                                ->get();
                       ?>
                @foreach ($jobstypes as $jobtype)
         <option value="{{ $jobtype->name }}"> {{ $jobtype->name }} </option>            
            @endforeach 
      </select>
                  </div>
            </div>
        </div>
        <div class="row">

                <div class="col">
                <div class="form-group">
                  <label for="disabledTextInput">PWD Apply</label>
                  <select name="pwd" class="form-control">
                      <option value="{{$employeeRequisition->pwd}}">{{$employeeRequisition->pwd}}</option>
                      <option value="Yes">Yes</option>
                      <option value="No">No</option>
                  </select>
                  </div>
            </div>
                      <div class="col">
                <div class="form-group">
                  <label for="disabledTextInput">No Of Interviews</label>
                    <input type="number"  class="form-control" id="exampleFormControlTextarea1" name="interviews" value="{{$employeeRequisition->interviews}}" required="">
                  </div>
            </div>
            <div class="col">
                <div class="form-group">
                  <label for="disabledTextInput">No. Of Positions</label>
                    <input type="number"  class="form-control" id="exampleFormControlTextarea1" name="positions" value="{{$employeeRequisition->positions}}" required="">
                  </div>
            </div>
        </div>
        <div class="row">
             <div class="col">
                <div class="form-group">
                  <label for="disabledTextInput">Starting Date</label>
                    <input type="date"  class="form-control" id="exampleFormControlTextarea1" name="startdate" value="{{$employeeRequisition->startdate}}" required="">
                  </div>
              </div>
                <div class="col">
                <div class="form-group">
                  <label for="disabledTextInput">Position Type</label>
                          <select class="form-control" name="jobcategory" required="">
                            <option value="{{$employeeRequisition->jobcategory}}">{{$employeeRequisition->jobcategory}}</option>
                            <option value="New"> New </option>  
                            <option value="Replacement"> Replacement </option>           
                              </select>
                  </div>
            </div>
                <div class="col">
                <div class="form-group">
                  <label for="disabledTextInput">Manager Reported to</label>
                    <select class="form-control" name="manager" required="">
                           <?php
                          $managers=DB::table('users')
                        ->get();
                              ?>
                     @foreach ($managers as $manager)
                        <option value="{{ $manager->id }}" @if(Auth::user()->id)selected @endif> {{ $manager->name }} </option>            
                           @endforeach 
                            </select> 
                  </div>
            </div>
</div>
    <div class="col">
                <div class="form-group">
                  <label for="disabledTextInput">Position Requirements</label>
                     <textarea class="form-control textarea"  id="exampleFormControlTextarea1" name="posrequirements" rows="3">{!! $employeeRequisition->posrequirements!!}</textarea>
                  </div>
            </div>
        <div class="form-group">
      <label for="disabledTextInput">Responsibilities</label>
      <textarea class="form-control textarea"  id="exampleFormControlTextarea1" name="responsibilities" rows="3">{!! $employeeRequisition->responsibilities!!}</textarea>
    </div>
    <div class="form-group">
      <label for="disabledTextInput">Job Description</label>
      <textarea class="form-control textarea"  id="exampleFormControlTextarea1"  name="jobdescription" rows="3">{!!$employeeRequisition->jobdescription!!}</textarea>
    </div>

      </fieldset>
      <br>
        <button type="submit" class="btn btn-primary">Save Changes</button>
        </form>
</section>
</div>
<script type="text/javascript">
</script>
  
         

@endsection
