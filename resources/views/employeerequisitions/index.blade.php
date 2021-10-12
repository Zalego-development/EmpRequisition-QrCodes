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
    #model{
        width: 80%;
        margin-right: 40px;
        display: block !important;
         overflow-y: auto;
    }

</style>


 <!-- <script type="text/javascript" src="{{url('js/load.js')}}"></script> -->
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
                    <h1 class="m-0 text-muted ml-2 mt-2"><strong>Employee For Requisition</strong></h1>
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
  Request For Employee
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
<div class="modal fade"  id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" id="model" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Request For an Employee</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{ route('employeerequisitions.store') }}" id="formid">
            @csrf
      <fieldset class="col-md-12" >
    <div class="row">
        <div class="col">
          <div class="form-group">
        <label for="disabledTextInput">Position Type</label>
    <select id="positiontype"  class="form-control"  name="jobcategory" required="">
          <option    value="Replacement"> Replacement </option> 
            <option   value="New">  New </option>  
                    
        </select>
    </div>
         </div>
    <div class="col">  
        <div class="form-group">
    <label for="disabledTextInput">Job Title::</label>

    <div>
      <input type="text" class="form-control"  name="jobtittle_input" id="ifYes" style="display:none">
    </div> 

    <div>
  <select id="JobTittle" required class="form-control" name="jobtittle">
     <?php
       $job_postings=DB::table('job_postings')
               ->get();
        ?>
            <option  disabled selected > Select </option>            

        
         @foreach ($job_postings as $jobtype)


    <option value="{{ $jobtype->name }}"> {{ $jobtype->name }} </option>            
            @endforeach         
        </select>
</div>
    </div>
</div>
    <div class="col">
       <div class="form-group">
      <label for="disabledTextInput">Job Posting Location</label>
   <select class="form-control" name="location" required="">
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


  </div>
  <div class="row">
  <div class="col">
    <div class="form-group">
      <label for="disabledTextInput">Start Date</label>
      <input type="date" class="form-control" id="exampleFormControlTextarea1" min="<?php echo date('Y-m-d'); ?>" name="startdate" required="">
    </div>    
    </div> 
    <div class="col">
          <div class="form-group">
      <label >Employement Type</label>
    <select class="form-control" name="employementtype" required="">
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
    <div class="col">   
       <div class="form-group">
      <label for="disabledTextInput">Target People?::</label>  <br>
      <input type="checkbox" name="intenting[]" value="Internal" checked="true">Internal
      <input type="checkbox" name="intenting[]"  value="External">External
    </div></div> 
  </div>
  <div class="row">
      <div class="col">
          <label>Report to</label>
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
      <div class="col">
    <div class="form-group">
    <label for="disabledTextInput">Budgeted Salary range from</label>
      <input type="number" id="salaryfrom" class="form-control" id="exampleFormControlTextarea1" name="salary" required="">
    </div>
      </div>
    <div class="col">
    <div class="form-group">
    <label for="disabledTextInput">Salary Range to</label>
      <input type="number" id="salaryto" class="form-control " id="exampleFormControlTextarea2" name="salaryto" required="">
    </div>
      </div>
  </div>
  <div class="row">
 <div class="col">
      <div class="form-group">
      <label for="disabledTextInput">No. of Positions</label>
      <input type="number" class="form-control" id="exampleFormControlTextarea1" name="positions" required="">
    </div> 
</div>
      <div class="col">
    <div class="form-group">
    <label for="disabledTextInput">Will PWD Apply?</label>
      <select class="form-control" name="pwd" required="">
          <option value="Yes">Yes</option>
          <option value="No">No</option>
      </select>
    </div>  
      </div>
     <div class="col">
    <div class="form-group">
    <label for="disabledTextInput">Interviews Levels</label>
      <select class="form-control" name="interviews" required="">
          <option value="Online Assessement">Online Assessement</option>
          <option value="Physical Assessment">Physical Assessment</option>
          <option value="First Oral">First Oral</option>
          <option value="Second Oral">Second Oral</option>
      </select>
    </div>  
      </div>
  </div>
      <div class="form-group">
      <label for="disabledTextInput">Job Description</label>
      <textarea class="form-control textarea summernote"   name="jobdescription" rows="3"></textarea>
      @error('jobdescription')
    <div class="alert alert-danger">{{ $message }}</div>
      @enderror
    </div>
    <div class="form-group">
      <label for="disabledTextInput">Responsibilities</label>
      <textarea class="form-control textarea summernote" id="exampleFormControlTextarea1"  name="responsibilities" rows="3"></textarea>
    </div>
    <div class="form-group">
    <label for="disabledTextInput">Requirements</label>
      <textarea class="form-control textarea summernote" id="exampleFormControlTextarea1" required name="salarybudget" rows="3"></textarea>
    </div>
        <div class="form-group">
    <label for="disabledTextInput">Skills</label>
      <textarea class="form-control textarea summernote" id="exampleFormControlTextarea1"  required name="posrequirements" rows="3"></textarea>
    </div>
      </fieldset>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Make Request</button>
        </form>
      </div>
    </div>
  </div>
</div>



<!--  requistions list -->
<!--  -->
<!--- table for all requisitions -->

        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="mt-2">
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
             if ($notify->stages == 0) {
                ?>
         <p style="margin:0;font-size:12px;line-height:14px;font-family:Arial,sans-serif;padding-left: 70%; color: red;"> <a href="{{route ('calltoaction')}}">Employee Requisition Approvals</a></p>
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
             if ($notify->stage3 == 0 && $notify->role =='HR Recruitment Team' && $notify->action =='2') { 
                ?>
                   <p style="margin:0;font-size:12px;line-height:14px;font-family:Arial,sans-serif;padding-left: 70%; color: red;"> <a href="{{route ('calltoactionceorecruinitiator')}}">Employee Requisition From Recruitement Team</a></p>
     
         <?php
            }
            elseif($notify->stage3 == 0 && $notify->role =='' && $notify->action =='3'){
                ?>
                    <p style="margin:0;font-size:12px;line-height:14px;font-family:Arial,sans-serif;padding-left: 70%; color: red;"> <a href="{{route ('calltoaction3')}}">Employee Requisition From Recruitement Team</a></p>
                    <?php      
            }
            elseif ($notify->stage3 == 0 && $notify->role =="HR Manager" && $notify->action =='1') {
                ?>
                <p style="margin:0;font-size:12px;line-height:14px;font-family:Arial,sans-serif;padding-left: 70%; color: red;"> <a href="{{route ('calltoactionceochrinitiator')}}">Employee Requisition From HR Manager</a></p>
                 <?php
            }
             elseif ($notify->stage3 == 0 && $notify->role =="Executive Lead" && $notify->action =='0') {
                ?>
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
             if ($notify->stage1 == 0 && $notify->role== 'HR Recruitment Team') {
                ?>
                  <p style="margin:0;font-size:12px;line-height:14px;font-family:Arial,sans-serif;padding-left: 70%; color: red;">  <a href="{{route ('calltoactionhrrecrurinitiator')}}"> Employee Requisition from HR Recruitment Team</a><br><br></p>
   
         <?php
            }
            else if ($notify->role =="" && $notify->stage1 ==0) {
                ?>
                     <p style="margin:0;font-size:12px;line-height:14px;font-family:Arial,sans-serif;padding-left: 70%; color: red;"> <a href="{{route ('calltoaction1')}}">Employee Requisition Approvals</a></p>
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
                <p style="margin:0;font-size:12px;line-height:14px;font-family:Arial,sans-serif;padding-left: 70%; color: red;">  <a href="{{route ('calltoactionexecrecrurinitiator')}}"> Employee Request From Recruitment Team</a><br><br></p>
                
         <?php
            }
            elseif($notify->stage2 == 0 && $notify->role ==""){
                ?>
                <p style="margin:0;font-size:12px;line-height:14px;font-family:Arial,sans-serif;padding-left: 70%; color: red;"> <a href="{{route ('calltoaction2')}}">Employee Requisition From Hiring Manager</a></p>
                <?php     
            }
            elseif ($notify->stage2 == 0 && $notify->role =="HR Manager") {
                ?>
                <p style="margin:0;font-size:12px;line-height:14px;font-family:Arial,sans-serif;padding-left: 70%; color: red;"> <a href="{{route ('calltoactionexechrinitiator')}}">Employee Requisition From HR Manager</a></p>
                 <?php
            }
            
            }
                        }
                        else{
                            
                         }
                         ?>
                        
                        
                        </div>

                    </div>
                </div>
            </div>
            <hr>
            <div class="col-md-12 mb-3">
                <div class="row">
                    <div class="col-md-6"></div>
                    <div class="col-md-4"></div>
                    <div class="col-md-2">
                          <button class="btn-primary" onClick="window.location.reload();">Refresh Page</button>
                    </div>
                </div>
              

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
                                               
                                                <th>No of Positions</th>
                                                 <th>Budgeted Salary</th>
                                               
                                                <th>Job Type</th>
                                                <th>Location</th>
                                                <th>people Targeted</th>
                                                <th>Request Type</th>
                                                
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                            $count = 1;
                                            @endphp
                                            @forelse ($employeeRequisitions as $emprequest)
                                            <a href="{{ route('employeerequisitions.show',$emprequest->id) }}">
                                            
                                                <tr >
                                                <td class='clickable-row' data-href='{{ route('employeerequisitions.show',$emprequest->id) }}'>{{ $count++ }}</td>
                                                <td class='clickable-row' data-href='{{ route('employeerequisitions.show',$emprequest->id) }}'>{{ $emprequest->jobtittle }}</td>
                                               
                                                <td class='clickable-row' data-href='{{ route('employeerequisitions.show',$emprequest->id) }}'>{{ $emprequest->positions }}</td>
                                                <td>{{ $emprequest->salary }}-{{$emprequest->salaryto}}</td>
                                                
                                                <td class='clickable-row' data-href='{{ route('employeerequisitions.show',$emprequest->id) }}'>{{ $emprequest->employementtype }}</td>
                                                <td class='clickable-row' data-href='{{ route('employeerequisitions.show',$emprequest->id) }}'>{{ $emprequest->location}}</td>
                                                <td class='clickable-row' data-href='{{ route('employeerequisitions.show',$emprequest->id) }}'>
                                                    @php
                                                    $intenting = unserialize($emprequest->intenting)
                                                    @endphp
                                                    <ul>
                                                    @foreach($intenting as $intent)
                                                        <li>{{ $intent }}</li>
                                                    @endforeach
                                                    </ul>
                                                </td>
                                                <td class='clickable-row' data-href='{{ route('employeerequisitions.show',$emprequest->id) }}'>{{ $emprequest->jobcategory}}</td>
                                                @php 
                                                $approvalsprogress=DB::table('requsitionsapprovals')
                                                ->join('users', 'users.id', '=', 'requsitionsapprovals.userId')
                                                ->join('employeerequisitionusers', 'employeerequisitionusers.userId', '=', 'users.id')
                                                ->where('requsitionsapprovals.jobid', $emprequest->id)
                                                ->where('requsitionsapprovals.initiator', '!=', 'initiator')
                                                ->orderBy('requsitionsapprovals.date', 'asc')
                                                 ->get(); 
                                                 @endphp
                                               
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
                                                                   <a href="" class="dropdown-item"  data-toggle="modal" data-target="#exampleModaledit{{$emprequest->id}}"><i class="fa fa-eye text-warning"></i>Approvers
                                                                  </a>
                                                            <div>
                                                                @if($emprequest->status != 'initiated')
                                                                <a class="dropdown-item" id="{{$emprequest->id}}" href="{{route('employeerequisitions.edit',$emprequest) }}">
                                                                    <i class="fa fa-pen text-warning"></i> Edit
                                                                </a>
                                                            </div>
                                                            <div>
                                                                <a class="dropdown-item" id="{{$emprequest->id}}" href="{{route('employeerequisitions.initiate',$emprequest) }}" onclick="buttonToggler({{$emprequest->id}})">
                                                                    <i class="fa fa-hourglass-start"></i> Initiate
                                                                </a>

                                                            </div>

                                                             @endif
                                                        </div><br>
                                                    </span>
                                             </td>
                                            </tr>
                                        </a>
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

                            @forelse ($employeeRequisitions as $emprequest)

                                <!-- Modal -->
                               <div class="modal fade" id="exampleModaledit{{$emprequest->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabeledit"                                aria-hidden="true">
                                 <div class="modal-dialog modal-md" role="document">
                                   <div class="modal-content">
                                     <div class="modal-header">
                                       <h5 class="modal-title" id="exampleModalLabel">Approvers</h5>
                                       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                         <span aria-hidden="true">&times;</span>
                                       </button>
                                     </div>
                                     @php 
                                         $user_id = Auth::user()->id;
                                                $getrole=DB::table('employeerequisitionusers')
                                                        ->where('userId', $user_id)
                                                        ->first();
                                                        $role=$getrole->employeetype ?? null;
                                                        
                                          @endphp
                                     <div class="modal-body">
                                       <table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Role</th>
      <th scope="col">Action</th>
      <th scope="col">Date</th>
    </tr>
  </thead>
  <tbody>
    <tr>
        @php
         $count = 1;
         @endphp
         @php 
                                                $approvalsprogress=DB::table('requsitionsapprovals')
                                                ->join('users', 'users.id', '=', 'requsitionsapprovals.userId')
                                                ->join('employeerequisitionusers', 'employeerequisitionusers.userId', '=', 'users.id')
                                                ->where('requsitionsapprovals.jobid', $emprequest->id)
                                                ->where('requsitionsapprovals.initiator', '!=', 'initiator')
                                              ->get()
                                              ->toArray();

                                                 // get the initiator 
                                        $gettheinitator=DB::table('requsitionsapprovals') 
                                        ->join('users' , 'users.id', '=', 'requsitionsapprovals.userId') 
                                        ->where('requsitionsapprovals.jobid', $emprequest->id)
                                        ->where('requsitionsapprovals.initiator' ,'Initiator')
                                        ->first();
                                       
                            $ininame=$gettheinitator->name;
                            $action='submit';
                            $emplyeetype='initaitor';
                            $date=$gettheinitator->date;
                           $pushdata=(object) ['name'=>$ininame, 'employeetype'=>$emplyeetype ,'action'=>"submit", 'date'=>$date]; 
                           array_unshift($approvalsprogress, $pushdata);
                                                 @endphp
         @foreach ($approvalsprogress as $approver)    
      <th scope="row">{{ $count++ }}</th>
      <td>{{$approver->name}}</td>
      <td>{{$approver->employeetype}}</td>
      <td>       
                            @php

                            if(isset($approver->action) && $approver->action == 'submit')
                              echo "Submitted";
                            else{
                              echo "Approved";
                            } 
                            @endphp
   </td>
      <td>{{$approver->date}}</td>
    </tr>
  </tbody>
                                           
                                                     @endforeach 
                                                    </table>          
                                                     
<!--                                        <form action="{{url('employeeRequisitions')}}" method="POST">
                                       @csrf

                                       <fieldset class="col-md-12" >
                                        <div class="form-group">
                                       <input type="text" class="form-control" id="exampleFormControlTextarea1" value="{{$emprequest->id}}" name="id"  required="">
                                     </div>
                                      <div class="form-group">
                                       <label for="disabledTextInput">Employee Type</label>
                                       <input type="text" class="form-control" id="exampleFormControlTextarea1" value="{{$emprequest->employeetype}}" name="employeetype" required="">
                                     </div>
   
                                       </fieldset>
                                       <br>
                                        -->
                                       
                                     </div>
                                     <div class="modal-footer">
                                       <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                         
                                     </div>
                                       
                                   </div>
                                 </div>
                               </div>
                               @empty

                               @endforelse


                                </div>
                            </div>
                        </div>
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

    jQuery(document).ready(function($) {
    $(".clickable-row").click(function() {
        window.location = $(this).data("href");
    });
});
    $(document).ready(
        //  target the minimum input
        $('#salaryfrom').keyup(e=>{
            $('#salaryto').attr('min', $('#salaryfrom').val())
        })
    )
</script>
<script type="text/javascript">

    function buttonToggler(id){
        $('#'+id).slideUp()
    }
</script>
<script type="text/javascript">
$(document).ready(function(){
    $("#positiontype").change(function(){
        yesnoCheck();
    })
})

function yesnoCheck() {
        if ($('#positiontype').val() == 'New') {
            document.getElementById('ifYes').style.display = 'block';
            document.getElementById('ifYes').setAttribute('required', 'required');
            document.getElementById('JobTittle').removeAttribute('required');
            document.getElementById('JobTittle').style.display = 'none';

        }
        else {
            document.getElementById('ifYes').removeAttribute('required');
            document.getElementById('ifYes').style.display = 'none';
            document.getElementById('JobTittle').style.display = 'block';
            document.getElementById('JobTittle').setAttribute('required', 'required');

        }
    }
</script>

  
         

@endsection



