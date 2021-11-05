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
<script type="text/javascript">
      $(function () {
        $('table').dataTable();
        $('#example1').dataTable();
        $('#example2').dataTable();
        $('#example3').dataTable();
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
        <?php 

$user=Auth::user()->id;
 //get the role if any
$getrole=DB::table('employeerequisitionusers')
                ->where('userId', $user)
                ->first();

$role=$getrole->employeetype ?? null;
if($role == "Executive Lead" || $role =="Group CEO"){

} 
else{
    ?>
    <a title="Add Workspace" class=" shadow-lg mr-2 btn btn-default bg-primary " href="#" data-toggle="modal" data-target="#exampleModalstore" style="width: 50px; cursor: pointer; height: 50px; border-radius: 50%; position: absolute; left:90%; top:11%; z-index: 1;"><i class="fas fa-plus" style="margin-top: 14px;"></i></a>

            <!-- Button trigger modal -->
 <!--            <div class="btn"  style="padding-left: 80%;">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalstore">
    <i class="fas fa-plus"></i>
  Request For Employee
</button>
            </div> -->
            

<?php
}
?>
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
        <!-- /.list of requisitions-fluid -->
<!--- table for all requisitions -->
<!-- Modal -->
<div class="modal fade"  id="exampleModalstore" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" id="model" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Request For an Employee</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span style="color: red; font-size: 30px;" aria-hidden="true">&times;</span>
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
<input list="brow" id="JobTittle" class="form-control" name="jobtittle">
<datalist id="brow">
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
        </datalist>  
</div>
    </div>
</div>
    <div class="col">
       <div class="form-group">
      <label for="disabledTextInput">Work Station</label>
      <input list="region" name="location" class="form-control" required="">
   <datalist id="region">
 <!--   <select class="form-control" name="location" required=""> -->
     <?php
       $locations=DB::table('workregions')
               ->get();
        ?>
         @foreach ($locations as $location)
         <option value="{{ $location->region }}"> {{ $location->region }} </option>            
            @endforeach 
   <!--    </select> -->
      </datalist>  
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
<input list="employementtype" class="form-control" name="employementtype" required="">
<datalist id="employementtype">
<!--     <select class="form-control" name="employementtype" required=""> -->
        <option value=""> select Employement Type</option>
     <?php
       $jobstypes=DB::table('job_types')
               ->get();
        ?>
         @foreach ($jobstypes as $jobtype)
    <option value="{{ $jobtype->name }}"> {{ $jobtype->name }} </option>            
            @endforeach 
      <!-- </select> -->
      </datalist>  
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
          <label>Reports to</label>
    <select class="form-control" name="manager" required="">
     <?php
        $managers=DB::table('users')
            ->get();
        ?>
         @foreach ($managers as $manager)

    <option value="{{ $manager->id }}" @if(Auth::user()->id == $manager->id) selected @endif> {{ $manager->name }} </option>            
            @endforeach 
      </select> 
      </div>
      <div class="col">
    <div class="form-group">
    <label for="disabledTextInput">Budgeted Salary</label>
      <input type="number" id="salaryfrom" class="form-control" min="1" id="exampleFormControlTextarea1" name="salary" required="">
    </div>
      </div>
    <div class="col">
    <div class="form-group">
    <label for="disabledTextInput">No. of Positions</label>
    <input type="number" class="form-control" id="exampleFormControlTextarea1" min="1" name="positions" required="">
      <!-- <input type="number" id="salaryto" class="form-control " min="1" id="exampleFormControlTextarea2" name="salaryto" required=""> -->
    </div>
      </div>
  </div>
  <div class="row">
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
    <label for="disabledTextInput">Interviews Levels</label><br>
     <input type="checkbox" name="interviews[]"  value="Pre-Test" checked="true">Pre-Test &nbsp;
     <input type="checkbox" name="interviews[]" value="Online Test" checked="true">Online Test &nbsp;
     <input type="checkbox" name="interviews[]" value="Online Interview" checked="true">Online Interview&nbsp;
       <input type="checkbox" name="interviews[]"  value="Physical Assessment">Physical Assessment &nbsp;
    <input type="checkbox" name="interviews[]"  value="First Oral" checked="true">First Oral&nbsp;&nbsp;<br>
     <input type="checkbox" name="interviews[]" value="Second Oral" checked="true" >Second Oral
    
    

    </div>  
      </div>
  </div>
      <div class="form-group">
      <label for="disabledTextInput">Job Description</label>
      <textarea class="form-control textarea summernote"  required=""  name="jobdescription" rows="3"></textarea>
      @error('jobdescription')
    <div class="alert alert-danger">{{ $message }}</div>
      @enderror
    </div>
    <div class="form-group">
      <label for="disabledTextInput">Responsibilities</label>
      <textarea class="form-control textarea summernote" required="" id="exampleFormControlTextarea1"  name="responsibilities" rows="3"></textarea>
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
        <button type="submit" class="btn btn-primary">Submit Request</button>
        </form>
      </div>
    </div>
  </div>
</div>

    <?php 

if (!extension_loaded('imagick')){
    echo 'imagick not installed';
}
?>
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
                @php 
                $user=Auth::user()->id;

                @endphp
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#enrolled" role="tab"
                            aria-controls="home" aria-selected="true"
                            style="color: gray !important; font-family: calibri;">
                            <i class="fa fa-clipboard text-primary"></i>
                            <strong>All Requisitions<sup class="badge bg-white shadow-lg text-muted"></sup></strong>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " id="Pending-approvals" data-toggle="tab" href="#Pending" role="tab"
                            aria-controls="recurring" aria-selected="false"
                            style="color: gray !important; font-family: calibri;"><i
                                class="fa fa-clipboard" style="color: #FFBF00;"></i><strong>
                                &nbsp; Pending Requisitions </strong></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " id="reenabled-tests" data-toggle="tab" href="#reenabledTests" role="tab"
                            aria-controls="recurring" aria-selected="true"
                            style="color: gray !important; font-family: calibri;">
                            <i class="fa fa-clipboard" style="color: green;"></i>
                            <strong> Approved Requisitions<sup class="badge bg-white shadow-lg text-muted"></sup></strong>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " id="declined-requisitions" data-toggle="tab" href="#declined" role="tab"
                            aria-controls="recurring" aria-selected="true"
                            style="color: gray !important; font-family: calibri;"><i
                                class="fa fa-clipboard text-danger"></i><strong>
                                &nbsp; Declined Requisitions  </strong></a>
                    </li>
                </ul>
                <div class="tab-content " id="myTabContent">
                    <div class="tab-pane fade show active" id="enrolled" role="tabpanel" aria-labelledby="home-tab">
                        <div class="card" style="border-shadow:none !important">
                            <div class="card-body">
                                <div class="table-responsive mt-3 mb-5">
                                    <table id="example1" class="table table-hover table-bordered ">
                                       <thead>
                                            <tr class="bg-light">
                                                <th>#</th>
                                                <th>JobTittle</th>
                                                
                                                <th>No. of Positions</th>
                                                 <th>Salary</th>
                                               
                                                <th>Job Type</th>
                                                <th>Location</th>
                                                <th>Aproval status</th>
                                                <th>Action</th>                           
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                            $count = 1;
                                            @endphp
                                            @forelse ($employeeRequisitionall as $emprequest)
                                            <tr>
                                                <td>{{ $count++ }}</td>
                                                <a href=""></a>
                                                <td class='clickable-row' data-href='{{ route('employeerequisitions.show',$emprequest->id) }}'>{{ $emprequest->jobtittle }}</td>
                                               
                                                <td>{{ $emprequest->positions }}</td>
                                                <td>{{ $emprequest->salary }}</td>
                                               
                                                <td>{{ $emprequest->employementtype }}</td>
                                                <td>{{ $emprequest->location}}</td>
                                                @php 
                                                 $getdecline=DB::table('requisitionsdeclines')
                                                            ->join('users', 'users.id', '=', 'requisitionsdeclines.userId')
                                                            ->where('jobid', $emprequest->id)
                                                            ->first();
                                                    $getid=$getdecline->name ?? null;
                                                @endphp
                                                <td title="">
                                                    <?php
                                                if($emprequest->approved_status == 0){
                                                    echo "pending";
                                                   }
                                                elseif($emprequest->approved_status ==1){
                                                    echo "Approved";
                                                }
                                                else{
                                                     
                                                    echo  "<p title='$getid'>Declined</p>";
                                                }
                                                    ?>
                                                </td>
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
                                                                   <a href="" class="dropdown-item"  data-toggle="modal" data-target="#exampleModaleditapprovals{{$emprequest->id}}"><i class="fa fa-eye text-warning"></i>Approvers
                                                                  </a>
                                                            <div>
                                                                
                                                                @if ($emprequest->posskills ==$user) 
                                                                    @if($emprequest->status != 'initiated')
                                                                <a class="dropdown-item" id="{{$emprequest->id}}" href="{{route('employeerequisitions.edit',$emprequest) }}">
                                                                    <i class="fa fa-pen text-warning"></i> Edit
                                                                </a>
                                                                <a class="dropdown-item" id="{{$emprequest->id}}" href="{{url('viewcomments',$emprequest) }}">
                                                                    <i class="fa fa-pen text-warning"></i> view Comments
                                                                </a>
                                                            </div>
                                                            <div>

                                                            </div>

                                                             @endif
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
                                   
                            @forelse ($employeeRequisitionall as $emprequest)

                                <!-- Modal -->
                               <div class="modal fade" id="exampleModaleditapprovals{{$emprequest->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabeledit"aria-hidden="true">
                                 <div class="modal-dialog" role="document">
                                   <div class="modal-content">
                                     <div class="modal-header">
                                       <h5 class="modal-title" id="exampleModalLabel">Employee Requisition Status</h5>
                                       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                         <span aria-hidden="true">&times;</span>
                                       </button>
                                     </div>
                                     <div class="modal-body">
                                         @php 
                                         $user_id = Auth::user()->id;
                                                $getrole=DB::table('employeerequisitionusers')
                                                        ->where('userId', $user_id)
                                                        ->first();
                                                        $role=$getrole->employeetype ?? null;
                                                        
                                          @endphp
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
              $approvalsprogress=DB::table('requsitionsapprovals')
                                ->join('users', 'users.id', '=', 'requsitionsapprovals.userId')
                                ->join('employeerequisitionusers', 'employeerequisitionusers.userId', '=', 'users.id')
                                ->where('requsitionsapprovals.jobid', $emprequest->id)
                               ->where('requsitionsapprovals.initiator', '!=', 'initiator')
                               ->get()
                               ->toArray();
        $getdecline=DB::table('requisitionsdeclines')
                    ->join('users', 'users.id', '=', 'requisitionsdeclines.userId')
                    ->join('employeerequisitionusers', 'employeerequisitionusers.userId', '=', 'users.id')
                    ->where('requisitionsdeclines.jobid', $emprequest->id)
                    ->first();

                        $ininame=$getdecline->name ?? null;
                        if($ininame !=''){
                           $action='Declined';  
                            $emplyeetype=$getdecline->employeetype ?? null;
                            $idini=$getdecline->userId ?? null;
                            $date=$getdecline->date ?? null;
                           $pushdata=(object) ['userId'=> $idini,'name'=>$ininame, 'employeetype'=>$emplyeetype ,'action'=>$action, 'date'=>$date];     
                          array_push($approvalsprogress, $pushdata) ;
                        }
                        else{

                        }
                           
                        

                                                 // get the initiator 
                         $gettheinitator=DB::table('requsitionsapprovals') 
                                        ->join('users' , 'users.id', '=', 'requsitionsapprovals.userId') 
                                        ->where('requsitionsapprovals.jobid', $emprequest->id)
                                        ->where('requsitionsapprovals.initiator' ,'initiator')
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
      <td>@php
                  
     if(isset($approver->action) && $approver->action == 'Declined')
     echo "Declined";
    elseif(isset($approver->action) && $approver->action == 'submit')
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
                                       
                                       
                                     </div>
                                     <div class="modal-footer">
                                       <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        
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
                    <!-- pending  tabs ---------------->
                    <div class="tab-pane fade" id="Pending" role="tabpanel" aria-labelledby="Pending">
                        <div class="card" style="border-shadow:none !important">

                            <div class="card-body">
                                <div class="table-responsive mt-3 mb-5">
                                    <table class="table table-hover table-bordered" id="PendingTable">
                                        <thead>
                                            <tr class="bg-light">
                                                <th>#</th>
                                                <th>JobTittle</th>
                                                
                                                <th>No. of Positions</th>
                                                 <th>Salary</th>
                                               
                                                <th>Job Type</th>
                                                <th>Location</th>
                                                 <th>Status</th>
                                                 <th>Action</th>
                                                                          
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                            $count = 1;
                                            @endphp
                                            @forelse ($employeeRequisitionspending as $emprequest)
                                            <tr>
                                                <td>{{ $count++ }}</td>
                                                <td>{{ $emprequest->jobtittle }}</td>
                                               
                                                <td>{{ $emprequest->positions }}</td>
                                                <td>{{ $emprequest->salary }}</td>
                                               
                                                <td>{{ $emprequest->employementtype }}</td>
                                                <td>{{ $emprequest->location}}</td>
                                                                                              <td>
                                              <?php
                                                   $getonepending=DB::table('employeerequisitions')
                                                                 ->where('id',$emprequest->id )
                                                                 ->first();
                                                                 // dd($getonepending);
                                                  if($getonepending->stages == 0 && $getonepending->stage1 =='0' && $getonepending->stages == '0' && $getonepending->stage2 =='0' && $getonepending->stage3 =='0'){
                                                    ?>
                                                    <ul style="font-size: 12px;">
                                                       <li>Pending -HR Recruitment Team</li>
                                                     </ul>
                                                     <?php
                                                  }
                                                    
                                                  if($getonepending->stage1 =='0' && $getonepending->stages == '1'){
                                                                                                        ?>
                                                    <ul style="font-size: 12px;">
                                                       <li>Pending -HR Manager</li>
                                                     </ul>
                                                     <?php
                                                  }
                                              
                                                 if($getonepending->stage1 =='1' && $getonepending->stages == '1' && $getonepending->stage2 =='1' && $getonepending->stage3 =='0'){
                                                    ?>
                                                    <ul style="font-size: 12px;">
                                                       <li>Pending -Group CEO</li>
                                                     </ul>
                                                     <?php     
                                                  }
                                                  
                                                if($getonepending->stage1 =='1'||$getonepending->stage1 =='2' && $getonepending->stages == '1' && $getonepending->stage2 =='0'){
                                                 ?>
                                                    <ul style="font-size: 12px;">
                                                       <li>Pending -Executive Lead</li>
                                                     </ul>
                                                     <?php
                                               
                                            }
                                                ?> 
                                               </td>
                                                <td>
                                                    <?php


                                                         $user=Auth::user()->id;
                                                            //get the role if any
                                                            $getrole=DB::table('employeerequisitionusers')
                                                                     ->where('userId', $user)
                                                                     ->first();

                                                                    $role=$getrole->employeetype ?? null;

                                                    $getnotification =DB::table('employeerequisitions')
                                                                     ->where('status', 'initiated')
                                                                      ->get();
                                                      $getinitators=DB::table('employeerequisitions')
                                                                  ->where('status', 'initiated')
                                                                  ->where('stages', 0)
                                                                  ->get();
                                                            if ($role =='HR Manager' && $emprequest->role =='HR Recruitment Team' ) {

                                                           
                                                               ?>
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
                                                            @if($emprequest->stage1 != '1'  && $emprequest->stages == '1' && $emprequest->action !='1')
                                                            <a class="dropdown-item" id="{{$emprequest->id}}"
                                                                href="{{ url('hrapprovingtoexec/' . $emprequest->id)}}"
                                                                style="cursor:pointer;" title="View more">
                                                                <i class="fa fa-eye text-warning"></i> Approve
                                                                Requisition</a>
                                                            <div>
                                                                <a class="dropdown-item" id="{{$emprequest->id}}" href="{{ url('declinereasonfromhrrecinitiator/' . $emprequest->id)}}">
                                                                    <i class="fa fa-pen text-warning"></i> Decline Requisition
                                                                </a>
                                                            </div>
                                                            <div>
                                                                <a class="dropdown-item" id="{{$emprequest->id}}" href="{{ url('returnforcorrections/' . $emprequest->id .'/'.$emprequest->user)}}">
                                                                    <i class="fa fa-pen text-warning"></i> Return For Corrections
                                                                </a>
                                                            </div>
                                                            @endif
                                                        </div><br>
                                                    </span>
                                                    <?php

                                                    }
                                                    elseif ($role =='Group CEO' && $emprequest->role =='HR Team') {
                                                        ?>
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
                                                            @if($emprequest->stage3 != '1')
                                                            <a class="dropdown-item" id="{{$emprequest->id}}"
                                                                href="{{ url('ceoapprovingtoexerectohiring/' . $emprequest->id)}}"
                                                                style="cursor:pointer;" title="View more">
                                                                <i class="fa fa-eye text-warning"></i> Approve
                                                                Requisition</a>
                                                            <div>
                                                                <a class="dropdown-item" id="{{$emprequest->id}}" href="{{ url('declinereasonfromceorectohiring/' . $emprequest->id)}}">
                                                                    <i class="fa fa-pen text-warning"></i> Decline Requisition
                                                                </a>
                                                            </div>
                                                            <div>
                                                                <a class="dropdown-item" id="{{$emprequest->id}}" href="{{ url('returnforcorrections/' . $emprequest->id .'/'.$emprequest->user)}}">
                                                                    <i class="fa fa-pen text-warning"></i> Return For Corrections
                                                                </a>
                                                            </div>
                                                            @endif
                                                        </div><br>
                                                    </span>
                                                    <?php
                                                    }
                                                    elseif($role =='Executive Lead' && $emprequest->role =='HR Team'){
                                                         ?>
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
                                                            @if($emprequest->stage2 != '1')
                                                            <a class="dropdown-item" id="{{$emprequest->id}}"
                                                                href="{{ url('execapprovingtoexerectohiring/' . $emprequest->id)}}"
                                                                style="cursor:pointer;" title="View more">
                                                                <i class="fa fa-eye text-warning"></i> Approve
                                                                Requisition</a>
                                                            <div>
                                                                <a class="dropdown-item" id="{{$emprequest->id}}" href="{{ url('declinereasonfromexerectohiring/' . $emprequest->id)}}">
                                                                    <i class="fa fa-pen text-warning"></i> Decline Requisition
                                                                </a>
                                                            </div>
                                                            <div>
                                                                <a class="dropdown-item" id="{{$emprequest->id}}" href="{{ url('returnforcorrections/' . $emprequest->id .'/'.$emprequest->user)}}">
                                                                    <i class="fa fa-pen text-warning"></i> Return For Corrections
                                                                </a>
                                                            </div>
                                                            @endif
                                                        </div><br>
                                                    </span>
                                                    <?php
                                                    

                                                    }
                                                    elseif ($role =='HR Manager' && $emprequest->role =='HR Team') {
                                                       ?>
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
                                                            @if($emprequest->stage1 != '2')
                                                            <a class="dropdown-item" id="{{$emprequest->id}}"
                                                                href="{{ url('hrapprovingtoexerectohiring/' . $emprequest->id)}}"
                                                                style="cursor:pointer;" title="View more">
                                                                <i class="fa fa-eye text-warning"></i> Approve
                                                                Requisition</a>
                                                            <div>
                                                                <a class="dropdown-item" id="{{$emprequest->id}}" href="{{ url('declinereasonhrtohiringrec/' . $emprequest->id)}}">
                                                                    <i class="fa fa-pen text-warning"></i> Decline Requisition
                                                                </a>
                                                            </div>
                                                            <div>
                                                                <a class="dropdown-item" id="{{$emprequest->id}}" href="{{ url('returnforcorrections/' . $emprequest->id .'/'.$emprequest->user)}}">
                                                                    <i class="fa fa-pen text-warning"></i> Return For Corrections
                                                                </a>
                                                            </div>
                                                            @endif
                                                        </div><br>
                                                    </span>
                                                    <?php
                                                    }
                                                    elseif($role =='HR Manager' && $emprequest->role =='' ){
                                                        ?>
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
                                                            @if($emprequest->stage1 != '1' && $emprequest->stages == '1')
                                                            <a class="dropdown-item" id="{{$emprequest->id}}"
                                                                href="{{ url('approve/' . $emprequest->id)}}"
                                                                style="cursor:pointer;" title="View more">
                                                                <i class="fa fa-eye text-warning"></i> Approve
                                                                Requisition</a>
                                                            <div>
                                                                <a class="dropdown-item" id="{{$emprequest->id}}" href="{{ url('declinereasonfromhrempinitator/' . $emprequest->id)}}">
                                                                    <i class="fa fa-pen text-warning"></i> Decline Requisition
                                                                </a>
                                                            </div>
                                                            <div>
                                                                <a class="dropdown-item" id="{{$emprequest->id}}" href="{{ url('returnforcorrections/' . $emprequest->id .'/'.$emprequest->user)}}">
                                                                    <i class="fa fa-pen text-warning"></i> Return For Corrections
                                                                </a>
                                                            </div>
                                                            @endif
                                                        </div><br>
                                                    </span>
                                                    <?php

                                                    }
                                                 elseif($role =='HR Recruitment Team' && $emprequest->role ==''){
                                                        ?>
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
                                                            @if($emprequest->stages != '1')
                                                            <a class="dropdown-item" id="{{$emprequest->id}}"
                                                                href="{{ url('approvetoHR/' . $emprequest->id)}}"
                                                                style="cursor:pointer;" title="View more">
                                                                <i class="fa fa-eye text-warning"></i> Approve
                                                                Requisition</a>
                                                            <div>
                                                                <a class="dropdown-item" id="{{$emprequest->id}}" href="{{ url('declinereasonrechiringinitiator/' . $emprequest->id)}}">
                                                                    <i class="fa fa-pen text-warning"></i> Decline Requisition
                                                                </a>
                                                            </div>
                                                            <div>
                                                                <a class="dropdown-item" id="{{$emprequest->id}}" href="{{ url('returnforcorrections/' . $emprequest->id .'/'.$emprequest->user)}}">
                                                                    <i class="fa fa-pen text-warning"></i> Return For Corrections
                                                                </a>
                                                            </div>
                                                            @endif
                                                        </div><br>
                                                    </span>
                                                    <?php
                                                     }
                                                    elseif ($role =='Executive Lead' && $emprequest->role =='HR Manager') {
                                                            ?>
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
                                                            @if($emprequest->stage2 != '1')
                                                            <a class="dropdown-item" id="{{$emprequest->id}}"
                                                                href="{{ url('execapprovinghrinitiator/' . $emprequest->id)}}"
                                                                style="cursor:pointer;" title="View more">
                                                                <i class="fa fa-eye text-warning"></i> Approve
                                                                Requisition</a>
                                                            <div>
                                                                <a class="dropdown-item" id="{{$emprequest->id}}" href="{{ url('declinereason/' . $emprequest->id)}}">
                                                                    <i class="fa fa-pen text-warning"></i> Decline Requisition
                                                                </a>
                                                            </div>
                                                            <div>
                                                                <a class="dropdown-item" id="{{$emprequest->id}}" href="{{ url('returnforcorrections/' . $emprequest->id .'/'.$emprequest->user)}}">
                                                                    <i class="fa fa-pen text-warning"></i> Return For Corrections
                                                                </a>
                                                            </div>
                                                            @endif
                                                        </div><br>
                                                    </span>
                                                    <?php
                                                  
                                                        }
                                                          elseif ($role =='Executive Lead' && $emprequest->role =='') {
                                                            ?>
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
                                                            @if($emprequest->stage2 != '1' && $emprequest->stage1 == '1' && $emprequest->stages == '1')
                                                            <a class="dropdown-item" id="{{$emprequest->id}}"
                                                                href="{{ url('approvetoceo/' . $emprequest->id)}}"
                                                                style="cursor:pointer;" title="View more">
                                                                <i class="fa fa-eye text-warning"></i> Approve
                                                                Requisition</a>
                                                            <div>
                                                                <a class="dropdown-item" id="{{$emprequest->id}}" href="{{ url('declinereasonfromexecempinitator/' . $emprequest->id)}}">
                                                                    <i class="fa fa-pen text-warning"></i> Decline Requisition
                                                                </a>
                                                            </div>
                                                            <div>
                                                                <a class="dropdown-item" id="{{$emprequest->id}}" href="{{ url('returnforcorrections/' . $emprequest->id .'/'.$emprequest->user)}}">
                                                                    <i class="fa fa-pen text-warning"></i> Return For Corrections
                                                                </a>
                                                            </div>
                                                            @endif
                                                        </div><br>
                                                    </span>
                                                            <?php
                                                        
                                                    }
                                                        elseif($role =='Executive Lead' && $emprequest->role =='HR Recruitment Team'){
                                                  
                                                            ?>
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
                                                            @if($emprequest->stage2 != '1' &&  $emprequest->stage1 == '1'&& $emprequest->stages == '1')
                                                            <a class="dropdown-item" id="{{$emprequest->id}}"
                                                                href="{{ url('execapprovingtoceorecruinitiator/' . $emprequest->id)}}"
                                                                style="cursor:pointer;" title="View more">
                                                                <i class="fa fa-eye text-warning"></i> Approve
                                                                Requisition</a>
                                                            <div>
                                                                <a class="dropdown-item" id="{{$emprequest->id}}" href="{{ url('declinereasonfromexecrecinitiator/' . $emprequest->id)}}">
                                                                    <i class="fa fa-pen text-warning"></i> Decline Requisition
                                                                </a>
                                                            </div>
                                                            <div>
                                                                <a class="dropdown-item" id="{{$emprequest->id}}" href="{{ url('returnforcorrections/' . $emprequest->id .'/'.$emprequest->user)}}">
                                                                    <i class="fa fa-pen text-warning"></i> Return For Corrections
                                                                </a>
                                                            </div>
                                                            @endif
                                                        </div><br>
                                                    </span>
                                                    <?php
                                                    }

                                                    elseif ($role='Group CEO' && $emprequest->role =='HR Manager') {
                                                        ?>
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
                                                            @if($emprequest->stage3 != '1' && $emprequest->stage2 == '1')
                                                            <a class="dropdown-item" id="{{$emprequest->id}}"
                                                                href="{{ url('approvefromchiefhrinitiator/' . $emprequest->id)}}"
                                                                style="cursor:pointer;" title="View more">
                                                                <i class="fa fa-eye text-warning"></i> Approve
                                                                Requisition</a>
                                                            <div>
                                                                <a class="dropdown-item" id="{{$emprequest->id}}" href="{{ url('declinereasonfromceohrinitiator/' . $emprequest->id)}}">
                                                                    <i class="fa fa-pen text-warning"></i> Decline Requisition
                                                                </a>
                                                            </div>
                                                            <div>
                                                                <a class="dropdown-item" id="{{$emprequest->id}}" href="{{ url('returnforcorrections/' . $emprequest->id .'/'.$emprequest->user)}}">
                                                                    <i class="fa fa-pen text-warning"></i> Return For Corrections
                                                                </a>
                                                            </div>
                                                            @endif
                                                        </div><br>
                                                    </span>
                                                    <?php
                                                }
                                                elseif ($role=''&& $emprequest->role =='') {
                                                    echo 'approvign';
                                                }
                                                elseif($role='Group CEO' && $emprequest->role ==''){
                                                    ?>
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
                                                            @if($emprequest->stage3 != '1' && $emprequest->stage2 == '1' && $emprequest->stage1 == '1' && $emprequest->stages == '1')
                                                            <a class="dropdown-item" id="{{$emprequest->id}}"
                                                                href="{{ url('approvefromchief/' . $emprequest->id)}}"
                                                                style="cursor:pointer;" title="View more">
                                                                <i class="fa fa-eye text-warning"></i> Approve
                                                                Requisition</a>
                                                            <div>
                                                                <a class="dropdown-item" id="{{$emprequest->id}}" href="{{ url('declinereasonfroceoempinitator/' . $emprequest->id)}}">
                                                                    <i class="fa fa-pen text-warning"></i> Decline Requisition
                                                                </a>
                                                            </div>
                                                            <div>
                                                                <a class="dropdown-item" id="{{$emprequest->id}}" href="{{ url('returnforcorrections/' . $emprequest->id .'/'.$emprequest->user)}}">
                                                                    <i class="fa fa-pen text-warning"></i> Return For Corrections
                                                                </a>
                                                            </div>
                                                            @endif
                                                        </div><br>
                                                    </span>
                                                    <?php

                                                }
                                                    elseif ($role='Group CEO' && $emprequest->role =='HR Recruitment Team') {
                                                        ?>
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
                                                            @if($emprequest->stage3 != '1' && $emprequest->stage2 == '1' && $emprequest->stage1 == '1'&& $emprequest->stages == '1')
                                                            <a class="dropdown-item" id="{{$emprequest->id}}"
                                                                href="{{ url('approvefromchiefrecruinitiator/' . $emprequest->id)}}"
                                                                style="cursor:pointer;" title="View more">
                                                                <i class="fa fa-eye text-warning"></i> Approve
                                                                Requisition</a>
                                                            <div>
                                                                <a class="dropdown-item" id="{{$emprequest->id}}" href="{{ url('declinereasonfromceorecinitiator/' . $emprequest->id)}}">
                                                                    <i class="fa fa-pen text-warning"></i> Decline Requisition
                                                                </a>
                                                            </div>
                                                            <div>
                                                                <a class="dropdown-item" id="{{$emprequest->id}}" href="{{ url('returnforcorrections/' . $emprequest->id .'/'.$emprequest->user)}}">
                                                                    <i class="fa fa-pen text-warning"></i> Return For Corrections
                                                                </a>
                                                            </div>
                                                            @endif
                                                        </div><br>
                                                    </span>
                                                    <?php

                                                    }
                                                    elseif($role =='HR Recruitment Team' ){
                                                        ?>
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
                                                            @if($emprequest->stages != '1' && $emprequest->stage2 == '1' && $emprequest->stage1 == '1'&& $emprequest->stage3 == '1'  )
                                                            <a class="dropdown-item" id="{{$emprequest->id}}"
                                                                href="{{ url('approvefromchiefrecruinitiator/' . $emprequest->id)}}"
                                                                style="cursor:pointer;" title="View more">
                                                                <i class="fa fa-eye text-warning"></i> Approve
                                                                Requisition</a>
                                                            <div>
                                                                <a class="dropdown-item" id="{{$emprequest->id}}" href="{{ url('declinereasonfromceorecinitiator/' . $emprequest->id)}}">
                                                                    <i class="fa fa-pen text-warning"></i> Decline Requisition
                                                                </a>
                                                            </div>
                                                            <div>
                                                                <a class="dropdown-item" id="{{$emprequest->id}}" href="{{ url('returnforcorrections/' . $emprequest->id .'/'.$emprequest->user)}}">
                                                                    <i class="fa fa-pen text-warning"></i> Return For Corrections
                                                                </a>
                                                            </div>
                                                            @endif
                                                        </div><br>
                                                    </span>
                                                    <?php
                                                    }

                                                    ?>
                                                        
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
                                   
                            @forelse ($employeeRequisitionspending as $emprequest)

                                <!-- Modal -->
                               <div class="modal fade" id="exampleModaleditpending{{$emprequest->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabeledit"aria-hidden="true">
                                 <div class="modal-dialog" role="document">
                                   <div class="modal-content">
                                     <div class="modal-header">
                                       <h5 class="modal-title" id="exampleModalLabel">Employee Requisition settings</h5>
                                       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                         <span aria-hidden="true">&times;</span>
                                       </button>
                                     </div>
                                     <div class="modal-body">

                                       
                                     </div>
                                     <div class="modal-footer">
                                       <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                      
                                     </div>
                                  
                                   </div>
                                 </div>
                               </div>
                               @empty

                               @endforelse                                    <!-- Button trigger modal -->


                                </div>
                            </div>
                        </div>
                    </div>
               
                <!-- declined tbas ----->
                    <div class="tab-pane fade" id="declined" role="tabpanel" aria-labelledby="declined-requisitions">
                        <div class="card" style="border-shadow:none !important">
                            <div class="card-body">
                                <div class="table-responsive mt-3 mb-5">
                                    <table id="example2" class="table table-hover table-bordered" >
                                        <thead>
                                            <tr class="bg-light">
                                                <th>#</th>
                                                <th>JobTittle</th>
                                                 <th>Salary</th>
                                               
                                                <th>Job Type</th>
                                                <th>Location</th>
                                                <th>Reason</th> 
                                                <th>Action</th>                           
                                            </tr>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                            $count = 1;
                                            @endphp
                                            @forelse ($employeeRequisitionsdecline as $emprequest)
                                            <tr>
                                                <td>{{ $count++ }}</td>
                                                <td>{{ $emprequest->jobtittle }}</td>
                                               
                                              
                                                <td>{{ $emprequest->salary }}</td>
                                               
                                                <td>{{ $emprequest->employementtype }}</td>
                                                <td>{{ $emprequest->location}}</td>
                                                 <td>{!! $emprequest->comment !!}</td>
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
                                                           <a href="" class="dropdown-item"  data-toggle="modal" data-target="#exampleModaleditdecline{{$emprequest->id}}"><i class="fa fa-eye text-warning"></i>Approvers|Declined
                                                                  </a>
                                                           
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
                                   
                            @forelse ($employeeRequisitionsdecline as $emprequest)

                                <!-- Modal -->
                               <div class="modal fade" id="exampleModaleditdecline{{$emprequest->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabeledit"aria-hidden="true">
                                 <div class="modal-dialog" role="document">
                                   <div class="modal-content">
                                     <div class="modal-header">
                                       <h5 class="modal-title" id="exampleModalLabel">Employee Requisition Declines</h5>
                                       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                         <span aria-hidden="true">&times;</span>
                                       </button>
                                     </div>
                                     <div class="modal-body">
                                         @php 
                                         $user_id = Auth::user()->id;
                                                $getrole=DB::table('employeerequisitionusers')
                                                        ->where('userId', $user_id)
                                                        ->first();
                                                        $role=$getrole->employeetype ?? null;
                                                        
                                          @endphp
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
              $approvalsprogress=DB::table('requsitionsapprovals')
                                ->join('users', 'users.id', '=', 'requsitionsapprovals.userId')
                                ->join('employeerequisitionusers', 'employeerequisitionusers.userId', '=', 'users.id')
                                ->where('requsitionsapprovals.jobid', $emprequest->id)
                               ->where('requsitionsapprovals.initiator', '!=', 'initiator')
                               ->get()
                               ->toArray();
        $getdecline=DB::table('requisitionsdeclines')
                    ->join('users', 'users.id', '=', 'requisitionsdeclines.userId')
                    ->join('employeerequisitionusers', 'employeerequisitionusers.userId', '=', 'users.id')
                    ->where('requisitionsdeclines.jobid', $emprequest->id)
                    ->first();
                        $ininame=$getdecline->name;
                            $action='Declined';
                            $emplyeetype=$getdecline->employeetype;
                            $idini=$getdecline->userId;
                            $date=$getdecline->date;
                           $pushdata=(object) ['userId'=> $idini,'name'=>$ininame, 'employeetype'=>$emplyeetype ,'action'=>$action, 'date'=>$date];     
                          array_push($approvalsprogress, $pushdata);

                                                 // get the initiator 
                         $gettheinitator=DB::table('requsitionsapprovals') 
                                        ->join('users' , 'users.id', '=', 'requsitionsapprovals.userId') 
                                        ->where('requsitionsapprovals.jobid', $emprequest->id)
                                        ->where('requsitionsapprovals.initiator' ,'initiator')
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
      <td>@php
                  
     if(isset($approver->action) && $approver->action == 'Declined')
     echo "Declined";
    elseif(isset($approver->action) && $approver->action == 'submit')
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
                                       
                                       
                                     </div>
                                     <div class="modal-footer">
                                       <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                     
                                     </div>
                                     
                                   </div>
                                 </div>
                               </div>
                               @empty

                               @endforelse                                    <!-- Button trigger modal -->


                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- users tabs ---->
                <div class="tab-pane fade" id="reenabledTests" role="tabpanel" aria-labelledby="reenabled-tests">
                        <div class="card" style="border-shadow:none !important">
                            <div class="card-body">
                                <div class="table-responsive mt-3 mb-5">
                                    <table class="table table-hover" id="example3" >
                                        <thead>
                                            <tr class="bg-light">
                                                <th>#</th>
                                                <th>JobTittle</th>
                                                
                                                <th>No. of Positions</th>
                                                 <th>Salary</th>
                                               
                                                <th>Job Type</th>
                                                <th>Location</th>

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
                                                <td>{{ $emprequest->salary }}</td>
                                               
                                                <td>{{ $emprequest->employementtype }}</td>
                                                <td>{{ $emprequest->location}}</td>

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
                                        ->where('requsitionsapprovals.initiator' ,'initiator')
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
        @if(isset($approver->action) && $approver->action == 'submit')
                               Submitted
                            
                            @else
                                Approved
                            @endif
  </td>
      <td>{{$approver->date}}</td>
    </tr>
  </tbody>
                                           
                                                     @endforeach 
                                                    </table>          
                                                    
                                       
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

</section>
</div>
<script type="text/javascript">
    function buttonToggler(id){
        $('#'+id).slideUp()
    }
</script>
<script type="text/javascript">

    jQuery(document).ready(function($) {
    $(".clickable-row").click(function() {
        window.location = $(this).data("href");
    });
});
    // $(document).ready(
    //     //  target the minimum input
    //     $('#salaryfrom').keyup(e=>{
    //         $('#salaryto').attr('min', $('#salaryfrom').val())
    //     })
    // )
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
    url:"{{ route('dynamic_dependent.fetchusers') }}",
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
         
<script type="text/javascript">
    function buttonToggler(id){
        $('#'+id).slideUp()
    }
</script>
<script type="text/javascript">

    jQuery(document).ready(function($) {
    $(".clickable-row").click(function() {
        window.location = $(this).data("href");
    });
});
    // $(document).ready(
    //     //  target the minimum input
    //     $('#salaryfrom').keyup(e=>{
    //         $('#salaryto').attr('min', $('#salaryfrom').val())
    //     })
    // )
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



