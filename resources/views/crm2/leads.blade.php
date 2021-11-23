@extends('crm2.crm_layout')
@section('content')
<style type="text/css">
.w3-input{
background-color:white;
}

.card{
  background: #fff !important;
  border-radius: 0px !important;
  box-shadow: rgba(17, 12, 46, 0.15) 0px 48px 100px 0px;
}

 .form2{
      padding: 20px;
    }

@media screen and (max-width: 480px) {
    
    #actionBarHolder {
        display: none;
    }

     .modaledd{
      bottom: 20px;
      z-index:9999 !important;
       position: fixed;
       right: 0px;
          top: 5px;
          width:100%;
    }
}

@media screen and (min-width: 480px) {
    .mobileMenu{
        display: none;
    }

     .modaledd{
      bottom: 20px;
      z-index:9999 !important;
       position: fixed;
       right: 0px;
          top: 5px;
          width: 57%;
    }
}


 .dive {
                        
                        animation-name: example;
                        animation-duration: 4s;
                        animation-iteration-count: infinite;
                      
                      }

                      @keyframes example {
                        from {background-color: white;}
                        to {background-color: #39ac73;}
                      }

</style>
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-muted ml-2 mt-4"><strong>CRM </strong></h1>
            <ol class="breadcrumb float-sm-left ml-2">
              <li class="breadcrumb-item"><a href="{{url('/home')}}"><i class="fa fa-home"></i></a></li>
              <li class="breadcrumb-item active"><a href="#">HR</a></li>
              <li class="breadcrumb-item active">My Leads</li>
            </ol>
  </div>
<div class="col-sm-6">
   <ol class="breadcrumb float-sm-right ml-2">
            </ol>
          </div><!-- /.col -->
        </div>
      </div>
    </div>

<div class="container-fluid">
    <a href="#" data-toggle="modal" data-target="#addModal"><button class="btn btn-flat btn-success mt-2"><i class="fas fa-plus"></i> Add new lead</button></a>&nbsp

<?php
$calls=0;
?>
     @foreach($leads2 as $ldd)
                      <?php
                          $dNext="";
                          if(substr($ldd->nextDate, 0, 2)>12 && substr($ldd->nextDate, 2, 1)=="/"){
                            $dNext=substr($ldd->nextDate, 3, 2)."/".substr($ldd->nextDate, 0, 2)."/".substr($ldd->nextDate, -4);
                          }else{
                            $dNext=$ldd->nextDate;
                          }
                      ?>

                     @if(Carbon\Carbon::parse($dNext)->format('Y-m-d')===date('Y-m-d') && $ldd->completeness==0 && $ldd->nextDate!="")
                    
                        <?php
                          $calls++;
                        ?>
                      @endif

      @endforeach

    <span class="dropdown">
  <button class="btn btn-secondary btn-flat dropdown-toggle mt-2" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Actions
  </button>

  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    <a class="dropdown-item text-success" href="#" onClick="takeAction(12)"><i class="fas fa-check-double"></i> Convert to successful deals</a>
     <a class="dropdown-item text-danger" href="#" onClick="takeAction(13)"><i class="fas fa-times"></i> Convert to failed deals</a>
     <a class="dropdown-item text-warning" href="#" onClick="takeAction(14)"><i class="fas fa-play"></i> Convert to active deals</a>
     <a class="dropdown-item text-warning" href="#" onClick="takeAction(121)"><i class="fas fa-play"></i> achive deals</a>
      <a class="dropdown-item text-info" href="#" onClick="takeAction(24)"><i class="fas fa-minus"></i> Move to lead logs</a>
     <a class="dropdown-item" href="#" onClick="takeAction(2)"><i class="fas fa-file-export"></i> Export</a>
     <a class="dropdown-item" href="#" data-toggle="modal" data-target="#offlineModal"><i class="fas fa-upload"></i> Upload offline work</a>

  </div>
</span>



<!--offline modal-->
<div class="modal" id="offlineModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-light">
        <h6><strong><i class="fas fa-upload"></i> Upload my offline work</strong></h6>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{url('/uploadOffline')}}" onsubmit="submissionLoader()" enctype="multipart/form-data">
          @csrf
          <div class="form-group files col-sm-12">
               <label>Your offline csv file <span class="text-danger">*(.csv format)</span></label>
               <center> 
                <input  type="file"   name="filed" onchange="showFiles()" >
              </center>

              </div>
              <button class="btn btn-flat btn-success" type="submit"><i class="fas fa-upload"></i> Upload</button>&nbsp  <button class="btn btn-flat btn-danger" onclick="event.preventDefault()" data-dismiss="modal" type="button"><i class="fas fa-times"></i> Close</button>
        </form>
      </div>
    </div>
  </div>
  </div>
<!--offline modal-->

 <span class="dropdown">
  <button class="btn btn-info btn-flat dropdown-toggle mt-2" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Toggle options
  </button>

  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    <a class="dropdown-item text-warning" href="{{url('/leads/active')}}"><i class="fas fa-play"></i> Active deals</a>
     <a class="dropdown-item text-success" href="{{url('/leads/success')}}" ><i class="fas fa-check-double"></i> Successful deals</a>
     <a class="dropdown-item text-danger" href="{{url('/leads/failed')}}" ><i class="fas fa-times"></i> Failed deals</a>
     <a class="dropdown-item text-secondary" href="{{url('/leads/waiting')}}" ><i class="fas fa-school"></i> Waiting bay</a>
     <a class="dropdown-item text-danger" href="{{url('/leads/achived')}}" ><i class="fas fa-times"></i> Archived deals</a>
  </div>
</span>
 @if($calls>0)
     <a href="{{url('/leads/calls')}}"><button class="btn btn-flat btn-secondary dive mt-2"><i class="fas fa-mobile-alt"></i> {{$calls}} calls to make today</button></a>&nbsp
  @else
     <a href="#"><button class="btn btn-flat btn-info mt-2"><i class="fas fa-mobile-alt"></i> {{$calls}} calls to make today</button></a>&nbsp
  @endif

  <a href="#"><button class="btn btn-flat btn-warning mt-2" onClick="takeAction(20)"><i class="fas fa-file-csv"></i> Excel File For Offline</button></a>

  <a href="#" data-toggle="modal" data-target="#statusModal"><button class="btn btn-flat btn-default mt-2"><i class="fas fa-tw fa-th"></i> Status codes</button></a>
    <br><br>
    @if(session('success1'))
      <div class="alert alert-info">
        <a href="#" class="close" data-dismiss="alert">&times</a>
        {{session('success1')}}
      </div>
    @endif

<!--status modal-->
<div class="modal" id="statusModal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-light">
        <h6><strong>Status codes</strong></h6>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-sm-4 col-6 border-right">
              <strong>Failed Reasons Codes (Fail_id)</strong>
              <hr>
              <ul>
                <li>1 - Fees to high</li>
                 <li>2 - Distance & location</li>
                  <li>3 - Courses offered not credible</li>
                   <li>4 - Wasn't satisfied with the previous trainings</li>
                    <li>5 - Not interested with the skill</li>
                     <li>6 - Do not have a laptop</li>
                      <li>7 - I do not have internet connectivity</li>
                       <li>8 - I do not have a laptop and internet connectivity</li>
                        <li>9 - Other reasons</li>
              </ul>
          </div>
          <div class="col-sm-4 col-6 border-right">
             <strong>Call Stage (Stage_id)</strong>
              <hr>
              <ul>
                <li>2 - First call</li>
                 <li>3 - Follow Up Call</li>
                  <li>4 - Closing Call</li>
              </ul>
          </div>
          <div class="col-sm-4 col-6">
               <strong>Completeness (Completion_status)</strong>
              <hr>
              <ul>
                <li>0 - Active</li>
                 <li>1 - Success</li>
                  <li>2 - Failed</li>
              </ul>
          </div>
        </div>
        <button class="btn btn-flat btn-danger float-right mt-4" data-dismiss="modal">&times Close</button>
      </div>
    </div>
  </div>
  </div>
<!--status modal-->

     <section class="container-fluid card px-3 py-3">
    <div class="card-header">
        <a href="{{url('/leads/active')}}"><button class="btn btn-flat btn-primary"><i class="fas fa-undo"></i> Back</button></a>&nbsp
      
        <form method="GET" action='{{url("/filterLeads")}}' class="form-inline ml-3 nav-linkk mt-2 float-right border-right">
                  @csrf
                  <div class="input-group input-group-sm">
                      <div class="input-group input-group-sm" title="Search by Firstname / lastname /surname / phone / email / course / intake /school">
                          <input type="searcg" class="form-control " name="from" placeholder="Firstname / lastname /surname / phone / email / course / intake" >
                          <input type="hidden" name="page" value="leads">
                      </div>
                      <div class="input-group-append">
                          <button class="btn btn-navbar theme-purple text-white" type="submit">
                              <i class="fa fa-search "></i> Search
                          </button>
                      </div>
                  </div>
              </form>
            </div>
    <form method="POST" action="{{url('/leadActions')}}" id="leadForm">
      @csrf
      <input type="hidden" name="action" id="actionH" value="0">
      <input type="hidden" name="exportStatus" id="exportStatus" value="none">
      <input type="hidden" name="mode" value="handled">
       
         <div class="table-responsive">
          <table class="table" id="my_leads">
            <thead>
              <tr>
                <th><input type="checkbox" onclick="toggle(this)"></th>

                <th>#</th>
                <th>Lead Source</th>
                <th>Names</th>
                <th>Lead_Status</th>
                <th>Email</th>
                <th>Contact</th>
                <th>Gender</th>
                <th>Intake</th>
                <th>Course</th>
                <th>Applied on</th>
                <th>Call_Stage</th>
                <th>Next_Call_Date</th>
                <th>Comments</th>
                <th>Actions</th>
              </tr>
            </thead>
            <?php
              $counter1=1;
            ?>
            @forelse($leads as $ld)
            @if(!empty($handled))
            @foreach($handled as $app)
            @if($ld->customer==$app->id)
              <tr id="row{{$ld->customer}}">
                <td><input type="checkbox" name="checks[]" value="{{$app->id}}" class="sels"></td>
                <td>{{$counter1++}}</td>
                  <td>
                  @if($app->source_category==1)
                     <strong class="text-muted">Walk ins'</strong>
                  @elseif($app->source_category==2)
                     <strong class="text-warning">CSV Upload</strong>
                  @elseif($app->source_category==3)
                      <strong class="text-info">Ambassador App</strong>
                  @elseif($app->source_category==0)
                     <strong class="text-success">Website</strong>
                  @endif
                </td>
                <td><a href="{{url('/viewLead/'.$ld->customer)}}">{{$app->name}}</a></td>
                 <td>
                  @if($ld->completeness==0)
                     <strong class="text-warning">Active</strong>
                     @elseif($ld->completeness==1)
                      <strong class="text-success">Deal Successful</strong>
                      @elseif($ld->completeness==2)
                      <strong class="text-danger">Deal Failed</strong>

                  @endif
                 </td>
                <td>{{$app->email}}</td>
                <td>{{$app->phonenumber}}</td>
                <td>{{$app->gender}}</td>
                <td>{{$app->intake}}</td>
                <td>
                  <?php
                    $cat= str_replace(",", '<br>', $app->category);
                    $cat= str_replace('_', " ", $cat);
                    echo str_replace('"', "", $cat);
                  ?>
               </td>
                <td>{{$app->created_at}}</td>
                <td>
                   @if($ld->level==0)
                                 <strong class="text-secondary"> First call</strong>
                                  @elseif($ld->level==2)
                                  <strong class="text-warning">Follow up call</strong>
                                  @elseif($ld->level==3)
                                  <strong class="text-success">Closing call</strong>
                                  @endif
                </td>
                <td>
                  @foreach($deal_progress_reports as $dpr)
                    @if($dpr->stage==$ld->level && $dpr->customer==$ld->customer)
                     <?php
                          $dNext2="";
                          if(substr($dpr->nextDate, 0, 2)>12 && substr($dpr->nextDate, 2, 1)=="/")
                          {
                            $dNext2=substr($dpr->nextDate, 3, 2)."/".substr($dpr->nextDate, 0, 2)."/".substr($dpr->nextDate, -4);

                           
                          }else{
                            $dNext2=$dpr->nextDate;
                          }
                      ?>
                      {{Carbon\Carbon::parse($dNext2)->format('Y-m-d')}}
                      @if(Carbon\Carbon::parse($dNext2)->format('Y-m-d')==date('Y-m-d') && $dpr->nextDate!="")
                      
                      <style type="text/css">
                        #row<?php echo $ld->customer; ?> {
                        
                        animation-name: example;
                        animation-duration: 4s;
                        animation-iteration-count: infinite;
                      
                      }

                      @keyframes example {
                        from {background-color: white;}
                        to {background-color: #39ac73;}
                      }
                      </style>
                      @endif
                     @endif
                   @endforeach


                </td>
                <td>
                  <a href="#" class="badge badge-info" data-toggle="modal" data-target="#commentModal2<?php echo $ld->customer;?>">Add comments</a> 
                  @if (strlen($ld->comment) > 80)
                   {{substr($ld->comment, 0, 80)}}
                   @if($ld->comment!="")
                   <br>.<a href="#" class="text-primary"  data-toggle="modal" data-target="#commentModal<?php echo $ld->customer;?>">Read more</a>...
                   @endif
                   
                   @else
                    {{$ld->comment}}
                     @if($ld->comment!="")
                    <br>.<a href="#" class="text-primary"  data-toggle="modal" data-target="#commentModal<?php echo $ld->customer;?>">Read more</a>...
                    @endif 
                   
                   @endif


                  
                </td>
                <td><div class="dropdown">
  <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
   <i class="fas fa-ellipsis-v"></i> Actions
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    <br>
    <a class="dropdown-item" href="#" onclick="showModules(1,<?php echo $ld->customer;?>,'<?php echo $app->name;?>','<?php echo $app->phonenumber;?>','<?php echo $app->email;?>')"><i class="fas fa-clock text-warning"></i> Add appointment</a>
    <a class="dropdown-item" href="#" onclick="showModules(2,<?php echo $ld->customer;?>,'<?php echo $app->name;?>','<?php echo $app->phonenumber;?>','<?php echo $app->email;?>')"><i class="fas fa-list text-info"></i> Add task</a>
    <a class="dropdown-item" href="#" onclick="showModules(3,<?php echo $ld->customer;?>,'<?php echo $app->name;?>','<?php echo $app->phonenumber;?>','<?php echo $app->email;?>')"><i class="fas fa-comment text-primary"></i> Send sms</a>
    <a class="dropdown-item" href="#" onclick="showModules(5,<?php echo $ld->customer;?>,'<?php echo $app->name;?>','<?php echo $app->phonenumber;?>','<?php echo $app->email;?>')"><i class="fas fa-envelope text-muted"></i> Send email</a>
    <a class="dropdown-item" href="#" onclick="showModules(4,<?php echo $ld->customer;?>,'<?php echo $app->name;?>','<?php echo $app->phonenumber;?>','<?php echo $app->email;?>')"><i class="fas fa-comment-alt text-success"></i> Whatsapp</a>
    <a class="dropdown-item" href="#" onclick="showModules(6,<?php echo $ld->customer;?>,'<?php echo $app->name;?>','<?php echo $app->phonenumber;?>','<?php echo $app->email;?>')"><i class="fas fa-share text-info"></i> Re-assign Deal</a>
  </div>
</div></td>
              </tr>
              @endif
              @endforeach
              
              @endif
            @empty
              <tr>
                <td colspan="13">
                    <div class="py-5" id="noneItem">
                                  <center style="color:  #b3cccc !important;">
                                    <i class="fas fa-file fa-5x"></i>
                                    <i class="fas fa-times fa-2x" style="z-index: 9999; color: #fff; margin-left: -25px;"></i>
                                    <br>
                                    <h6>You do not have any active leads at the moment</h6>
                                   
                                  </center>
                              </div>
                </td>
              </tr>
            @endforelse
             <tr>
               <td colspan="13">{{$leads->links()}}</td>
             </tr>
          </table>
      </div>
        </form>
    </section>

  </div>

  <!--add modal-->
    <div class="modal" id="addModal">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header bg-light">
            <h6><strong><i class="fas fa-plus"></i> Add</strong></h6>
            <i class="fas fa-window-close text-danger float-right fa-2x" data-dismiss="modal" style="cursor: pointer"></i>
          </div>
          <div class="modal-body">
               <form method="POST" action="https://zalegoacademy.ac.ke/public/api/walkins">
                  @csrf
                  <input type="hidden" name="route" value="{{url('/')}}/logs_leads">
                  <div class="row">
                      <div class="form-group col-sm-6">
                    <label>Names</label>
                    <input type="text" name="name" class="form-control py-4" required="">
                  </div>
                   <div class="form-group col-sm-6">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control py-4" required="">
                  </div>
                  
                  <input type="hidden" name="poster" value="{{Auth::user()->userId}}">
                  
                   <div class="form-group col-sm-6">
                    <label>Contact</label>
                    <input type="number" name="contact" class="form-control py-4" required="">
                  </div>
                  <div class="form-group col-sm-6">
                    <label>School</label>
                    <input type="text" name="school" class="form-control py-4" required="">
                  </div>
                   <div class="form-group col-sm-12">
                    <label>Gender</label><br>

                    <label><input type="radio" name="gender" value="Male"> Male</label>&nbsp
                    <label><input type="radio" name="gender" value="Female"> Female</label>&nbsp
                   
                  </div>
                   <div class="form-group col-sm-6">
                    <label>Intake</label>
                     <select class="form-control" name="intake" required="">
                      <option>January</option>
                      <option>February</option>
                      <option>March</option>
                      <option>April</option>
                      <option>May</option>
                      <option>June</option>
                       <option>July</option>
                        <option>August</option>
                        <option>September</option>
                        <option>October</option>
                        <option>November</option>
                        <option>December</option>
                    </select>
                  </div>
                  
                   <div class="form-group col-sm-6">
                    <label>Form</label>
                     <select class="form-control" name="form" required="">
                      <option>One</option>
                      <option>Two</option>
                       <option>Three</option>
                        <option>Four</option>
                        <option>Completed School</option>
                    </select>
                  </div>
                   <div class="form-group col-sm-12">
                    <label>Category</label>
                    <textarea name="category" class="form-control" required=""></textarea>
                  </div>
                     <div class="form-group col-sm-12">
                    <label>Comments</label>
                    <textarea name="comments" class="form-control" required=""></textarea>
                  </div>
                  </div>
                  <button class="btn btn-success" type="submit"><i class="fas fa-save"></i> Save Lead</button>
                </form>
          </div>
        </div>
      </div>
    </div>
  <!--add modal-->

    @foreach($leads as $ld)
            @if(!empty($handled))
            @foreach($handled as $app)
            @if($ld->customer==$app->id)
               <div class="modal" id="commentModal<?php echo $ld->customer;?>">
                         <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header bg-light">
                            <strong><i class="fas fa-pencil-alt"></i> Comments</strong>
                             <i class="fas fa-window-close fa-2x text-danger float-right" data-dismiss="modal" style="cursor: pointer;"></i>
                          </div>
                          <div class="modal-body">
                            {{$ld->comment}}
                          </div>
                        </div>
                      </div>
                   </div>

                   <div class="modal" id="commentModal2<?php echo $ld->customer;?>">
                       <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header bg-light">
                            <h6><strong><i class="fas fa-pencil-alt"></i> Make remarks</strong></h6>
                            <i class="fas fa-window-close fa-2x text-danger float-right" data-dismiss="modal" style="cursor: pointer;"></i>
                          </div>
                          <div class="modal-body">
                              <form method="POST" action="{{url('/logLeadProgress')}}">
                              @csrf
                              <input type="hidden" name="customer" value="<?php echo $ld->customer;?>">
                              <div class="form-group">
                                <label>Select call stage</label>
                                <select class="form-control" name="stage">
                                  @if($ld->level==0)
                                  <option value="2">First call</option>
                                  @elseif($ld->level==2)
                                  <option value="3">Follow up call</option>
                                  @elseif($ld->level==3)
                                  <option value="4">Closing call</option>
                                  @endif
                                </select>
                              </div>
                              <div class="form-group">
                                <select class="form-control" name="preports" id="preports2<?php echo $ld->customer;?>" onclick="toggleFields(2,<?php echo $ld->customer;?>)">
                                  @foreach($lead_progress_reports as $lpr)
                                  <option value="{{$lpr->progressId}}">{{$lpr->options}}</option>
                                  @endforeach
                                </select>
                              </div>

                              <span id="fieldHolder2<?php echo $ld->customer;?>"></span>
                              <br>
                              <div class="form-group">
                                <label>Make some comments</label>
                                <textarea class="form-control" name="moreInfo"></textarea>
                              </div>

                              <button class="btn btn-success" type="submit"><i class="fas fa-save"></i> Save report</button>
                              
                            </form>
                          </div>
                        </div>
                       </div>
                   </div>
            @endif
            @endforeach
            @endif
            @endforeach

            <!--appointments-->
    <div class="modaledd" id="modal1" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header bg-light">
                <h6><strong><i class="fas fa-clock"></i> Add appointment</strong></h6>
                <i class="fas fa-window-close fa-2x text-danger float-right" onclick="$('#modal1').modal('hide')"></i>
              </div>
              <div class="modal-body">
                <div class="alert alert-info " id="appointmentAlertSend" style="display: none;">
                  Saving and sending appointment...
                </div>

                <div class="alert alert-success " id="appointmentAlertSuccess" style="display: none;">
                  <a href="#" class="close" data-dismiss="alert">&times</a>
                  <i class="fas fa-check-double"></i> Appointment saved and sent...
                </div>

                <div class="alert alert-warning " id="appointmentAlertFail" style="display: none;">
                  <a href="#" class="close" data-dismiss="alert">&times</a>
                  <i class="fas fa-check-double"></i> Unable to save and send appointment...
                </div>
                <form id="appointmentForm" method="GET">
                  @csrf
                  <input type="hidden" id="channel1" name="channel1" value="">
                  <input type="hidden" id="customer1" name="customer1" value="">
                   <input type="hidden" id="contact1" name="contact1" value="">
                    <input type="hidden" id="name1" name="name1" value="">
                    <input type="hidden" id="email1" name="email1" value="">
                  <div class="form-group">
                    <label>Title</label>
                    <input type="text" id="title1" name="title1" required="" class="form-control form2">
                  </div>
                    <div class="form-group">
                    <label>Description</label>
                    <textarea class="form-control" id="description1" name="description1"></textarea>
                  </div>
                  <div class="row">
                      <div class="col-sm-6">
                            <div class="form-group">
                              <label>Date</label>
                              <input type="date" id="date1" name="date1"  required="" class="form-control form2">
                            </div>
                      </div>
                      <div class="col-sm-6">
                            <div class="form-group">
                            <label>Time</label>
                            <input type="time" id="time1" name="time1" required="" class="form-control form2">
                          </div>
                      </div>
                      <br>
                      <hr>
                      <div class="col-4 text-center">
                        <button class="btn btn-info" onclick="saveAppointment('sms')"><i class="fas fa-comment"></i> Share on sms</button>
                      </div>

                      <div class="col-4 text-center">
                        <button class="btn btn-danger" onclick="saveAppointment('email')"><i class="fas fa-envelope"></i> Share on email</button>
                      </div>

                      <div class="col-4 text-center">
                        <button class="btn btn-success" onclick="saveAppointment('whatsapp')"><i class="fas fa-comment-alt"></i> Share on whatsapp</button>
                      </div>

                  </div>
                </form>
              </div>
            </div>
        </div>
    </div>


     <!--tasks-->
    <div class="modaledd" id="modal2" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header bg-light">
                <h6><strong><i class="fas fa-list"></i> Add tasks</strong></h6>
                <i class="fas fa-window-close fa-2x text-danger float-right" onclick="$('#modal2').modal('hide')"></i>
              </div>
              <div class="modal-body">
                <div class="alert alert-info " id="taskAlertSend" style="display: none;">
                  Saving task...
                </div>

                <div class="alert alert-success " id="taskAlertSuccess" style="display: none;">
                  <a href="#" class="close" data-dismiss="alert">&times</a>
                  <i class="fas fa-check-double"></i> Task saved...
                </div>

                <div class="alert alert-warning " id="taskAlertFail" style="display: none;">
                  <a href="#" class="close" data-dismiss="alert">&times</a>
                  <i class="fas fa-check-double"></i> Unable to save task...
                </div>
                <form method="GET" id="taskForm">
                  @csrf
                   <input type="hidden" id="channel2" name="channel2" value="">
                  <input type="hidden" id="customer2" name="customer2" value="">
                   <input type="hidden" id="contact2" name="contact2" value="">
                    <input type="hidden" id="name2" name="name2" value="">
                    <input type="hidden" id="email2" name="email2" value="">
                  <div class="form-group">
                    <label>Title</label>
                    <input type="text" id="title2" name="title2" required="" class="form-control form2">
                  </div>
                    <div class="form-group">
                    <label>Description</label>
                    <textarea class="form-control compose-textarea form2" name="description2" id="description2">
                      
                    </textarea>
                  </div>
                  <div class="row">
                      <div class="col-sm-6">
                            <div class="form-group">
                              <label>Date</label>
                              <input type="date" id="date2" name="date2" required="" class="form-control form2">
                            </div>
                      </div>
                      <div class="col-sm-6">
                            <div class="form-group">
                            <label>Time</label>
                            <input type="time" id="time2" name="time2" required="" class="form-control form2">
                          </div>
                      </div>
                      <br>
                      <hr>
                      <div class="col-6">
                        <button class="btn btn-info" onclick="saveTask('task')"><i class="fas fa-check"></i> Save tasks</button>
                      </div>

                      

                  </div>
                </form>
              </div>
            </div>
        </div>
    </div>


     <!--sms-->
    <div class="modaledd" id="modal3" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header bg-light">
                <h6><strong><i class="fas fa-list"></i> Send sms</strong></h6>
                <i class="fas fa-window-close fa-2x text-danger float-right" onclick="$('#modal3').modal('hide')"></i>
              </div>
              <div class="modal-body">
                 <div class="alert alert-info " id="smsAlertSend" style="display: none;">
                  Sending sms...
                </div>

                <div class="alert alert-success " id="smsAlertSuccess" style="display: none;">
                  <a href="#" class="close" data-dismiss="alert">&times</a>
                  <i class="fas fa-check-double"></i> Sms sent...
                </div>

                <div class="alert alert-warning " id="smsAlertFail" style="display: none;">
                  <a href="#" class="close" data-dismiss="alert">&times</a>
                  <i class="fas fa-check-double"></i> Unable to send sms...
                </div>
                <form method="GET" id="smsForm">
                  @csrf
                    <input type="hidden" id="channel3" name="channel3" value="">
                  <input type="hidden" id="customer3" name="customer3" value="">
                   <input type="hidden" id="contact3" name="contact3" value="">
                    <input type="hidden" id="name3" name="name3" value="">
                    <input type="hidden" id="email3" name="email3" value="">
                    <div class="form-group">
                    <label>Type your message</label>
                    <textarea class="form-control" id="description3" name="description3"></textarea>
                  </div>
                  <div class="row">
                      <br>
                      <hr>
                      <div class="col-6">
                        <button class="btn btn-info" onclick="saveSms('smsMode')"><i class="fas fa-check"></i> Send message</button>
                      </div>

                      

                  </div>
                </form>
              </div>
            </div>
        </div>
    </div>

     <!--whatsapp-->
    <div class="modaledd" id="modal4" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header bg-light">
                <h6><strong><i class="fas fa-list"></i> Whatsapp</strong></h6>
                <i class="fas fa-window-close fa-2x text-danger float-right" onclick="$('#modal4').modal('hide')"></i>
              </div>
              <div class="modal-body">
                <div class="alert alert-info " id="whatsappAlertSend" style="display: none;">
                  Sending whatsapp text...
                </div>

                <div class="alert alert-success " id="whatsappAlertSuccess" style="display: none;">
                  <a href="#" class="close" data-dismiss="alert">&times</a>
                  <i class="fas fa-check-double"></i> Whatsapp text sent...
                </div>

                <div class="alert alert-warning " id="whatsappAlertFail" style="display: none;">
                  <a href="#" class="close" data-dismiss="alert">&times</a>
                  <i class="fas fa-check-double"></i> Unable to send whatsapp text...
                </div>
                <form method="GET" id="whatsappForm">
                  @csrf
                      <input type="hidden" id="channel4" name="channel4" value="">
                  <input type="hidden" id="customer4" name="customer4" value="">
                   <input type="hidden" id="contact4" name="contact4" value="">
                    <input type="hidden" id="name4" name="name4" value="">
                    <input type="hidden" id="email4" name="email4" value="">
                    <div class="form-group">
                    <label>Type your message</label>
                    <textarea class="form-control" id="description4" name="description4"></textarea>
                  </div>
                  <div class="row">
                      
                      <br>
                      <hr>
                      <div class="col-6">
                        <button class="btn btn-info" onclick="saveWhatsapp('whatsappMode')"><i class="fas fa-check"></i> Save and send</button>
                      </div>

                      

                  </div>
                </form>
              </div>
            </div>
        </div>
    </div>

     <!--email-->
    <div class="modaledd" id="modal5" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header bg-light">
                <h6><strong><i class="fas fa-list"></i> Send email</strong></h6>
                <i class="fas fa-window-close fa-2x text-danger float-right" onclick="$('#modal5').modal('hide')"></i>
              </div>
              <div class="modal-body">
                 <div class="alert alert-info " id="emailAlertSend" style="display: none;">
                  Sending email...
                </div>

                <div class="alert alert-success " id="emailAlertSuccess" style="display: none;">
                  <a href="#" class="close" data-dismiss="alert">&times</a>
                  <i class="fas fa-check-double"></i> Email sent...
                </div>

                <div class="alert alert-warning " id="emailAlertFail" style="display: none;">
                  <a href="#" class="close" data-dismiss="alert">&times</a>
                  <i class="fas fa-check-double"></i> Unable to send email...
                </div>
                <form method="POST" id="emailForm" enctype="multipart/form-data" action="{{url('/saveEmail')}}">
                  @csrf
                   <input type="hidden" id="channel5" name="channel5" value="">
                  <input type="hidden" id="customer5" name="customer5" value="">
                   <input type="hidden" id="contact5" name="contact5" value="">
                    <input type="hidden" id="name5" name="name5" value="">
                    <input type="hidden" id="email5" name="email5" value="">
                  <div class="form-group">
                    <label>Subject</label>
                    <input type="text" id="subject5" name="subject" required="" class="form-control form2">
                  </div>
                    <div class="form-group">
                    <label>Message body</label>
                    <textarea class="form-control compose-textarea form2" id="description5" name="body">
                      
                    </textarea>
                  </div>
                  <div class="row">
                      <div class="col-sm-12">
                            <div class="form-group">
                              <label>Attachment</label>
                              <input type="file" id="attachment" name="attachment[]" multiple="" required="" class="form-control form2">
                            </div>
                      </div>
                      <br>
                      <hr>
                      <div class="col-6">
                        <br>
                        <button class="btn btn-info" onclick="saveEmail('emailMode')"><i class="fas fa-check"></i> Send email</button>
                      </div>

                      

                  </div>
                </form>
              </div>
            </div>
        </div>
    </div>

     <!--appointments-->
    <div class="modaledd" id="modal6" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header bg-light">
                <h6><strong><i class="fas fa-list"></i> Re-assign deal</strong></h6>
                <i class="fas fa-window-close fa-2x text-danger float-right" onclick="$('#modal6').modal('hide')"></i>
              </div>
              <div class="modal-body">
                <form method="POST" action="{{url('/reassignDeal')}}">
                   <input type="hidden" id="channel6" name="channel6" value="">
                  <input type="hidden" id="customer6" name="customer6" value="">
                   <input type="hidden" id="contact6" name="contact6" value="">
                    <input type="hidden" id="name6" name="name6" value="">
                    <input type="hidden" id="email6" name="email6" value="">
                  @csrf
                  <div class="form-group">
                    <label>Re-assign to:</label>
                    <select class="form-control" id="handler" name="handler">
                      @foreach($employees as $emp)
                          <option value="{{$emp->userId}}">{{$emp->firstname}} {{$emp->lastname}} {{$emp->surname}}</option>
                      @endforeach
                    </select>
                  </div>
                   
                  <div class="row">
                     
                      <br>
                      <hr>
                      <div class="col-6">
                        <button class="btn btn-info"><i class="fas fa-check"></i> Re-assign</button>
                      </div>

                      

                  </div>
                </form>
              </div>
            </div>
        </div>
    </div>
<!--action moduules-->
</div>



   <script type="text/javascript">
        if(window.addEventListener){
  window.addEventListener('load', function(){
    $("body").addClass('sidebar-collapse');   
    });
}
      //var table= $('#studentLeadss').dataTable( { "lengthMenu": [[10, 25, 50,-1], [10, 25, 50, "All"]] } );
     function toggle(source) {
            checkboxes = document.getElementsByClassName('sels');
            for (var i = 0, n = checkboxes.length; i < n; i++) {
                checkboxes[i].checked = source.checked;
            }

            document.getElementById('exportStatus').value="all";
        }

    function takeAction(index){
      document.getElementById('actionH').value=index;
    
      document.getElementById('leadForm').submit();
    }

    function toggleFields(id,indexx){
  var result=$('#preports'+id+indexx).val();
  if(result=='1'){
    $('#fieldHolder'+id+indexx).html('<div class="form-group"><label>Pick the reporting date</label><input type="date" class="form-control" name="reportingDate" required></div>@foreach($lead_reasons as $l_r)<div class="form-group" style="display:none;"><label><input type="checkbox" name="whyFail[]" value="{{$l_r->reasonId}}"></label>{{$l_r->reason}}</div>@endforeach');
  }
  if(result=='2'){
    $('#fieldHolder'+id+indexx).html('<div class="form-group"><label>Pick the next date of follow up call</label><input type="date" class="form-control" name="reportingDate" required></div>@foreach($lead_reasons as $l_r)<div class="form-group" style="display:none;"><label><input type="checkbox" name="whyFail[]" value="{{$l_r->reasonId}}"></label>{{$l_r->reason}}</div>@endforeach');
  }
  if(result=='3'){
    $('#fieldHolder'+id+indexx).html('<div class="form-group" style="display:none;"><label>Date field</label><input type="date" class="form-control" name="reportingDate" value="----/--/--" readonly></div><br><strong>Give reasons as to why the lead dropped out</strong><br><br>@foreach($lead_reasons as $l_r)<div class="form-group"><label><input type="checkbox" name="whyFail[]" value="{{$l_r->reasonId}}">&nbsp {{$l_r->reason}}</label></div>@endforeach');
  }
  if(result=='4'){
    $('#fieldHolder'+id+indexx).html('<div class="form-group" style="display:none;"><label>Pick the next date of follow up call</label><input type="text" class="form-control" name="reportingDate" value="YYYY-MM-DD" disabled readonly></div> @foreach($lead_reasons as $l_r)<div class="form-group" style="display:none;"><label><input type="checkbox" name="whyFail[]" value="{{$l_r->reasonId}}"></label>{{$l_r->reason}}</div>@endforeach');
  }
}

function showModules(id,customer,name,contact,email){
    $('#modal'+id).modal('show');
    document.getElementById('customer'+id).value=customer;
    document.getElementById('name'+id).value=name;
    document.getElementById('email'+id).value=email;
    document.getElementById('contact'+id).value=contact;
  }

  //save appointments
  function saveAppointment(channel){
    document.getElementById('channel1').value=channel;
    var contact=document.getElementById('contact1').value;

   $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
   var title1=$('#title1').val();
    var description1=$('#description1').val();
     var date1=$('#date1').val();
    var time1=$('#time1').val();
     var channel1=$('#channel1').val();
       var message=title1+" "+description1+" "+date1+" "+time1;

  if(title1=="" || description1=="" || date1=="" || time1==""){
    alert("Please fill in all fields");
   }else{
    $('#appointmentForm').on('submit', function(event)
{
  $('#appointmentAlertSend').fadeIn();
event.preventDefault();

$.ajax({
    url:"https://hrmis.zalegoacademy.ac.ke/zalegoemp/public/saveAppointment",
    type: "GET",
    data:$('#appointmentForm').serialize(),
    success: function (data, status)
    {
      if(data.success=='1'){
       // window.open('https://wa.me/'+contact+'?text='+message+'');
       $('#appointmentAlertSend').hide();
       $('#appointmentAlertSuccess').fadeIn();
       if(data.whatsappCheck=='1'){
          window.open('https://wa.me/'+contact+'?text='+data._message22+'...');
       }
      }else{
         $('#appointmentAlertSend').hide();
       $('#appointmentAlertFail').fadeIn();
      }
    },
    error: function (xhr, desc, err)
    {


    }
});

});
   }  
}


//save tasks
  function saveTask(channel){
    document.getElementById('channel2').value=channel;
   // var contact=document.getElementById('contact1').value;

   $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
   var title1=$('#title2').val();
    var description1=$('#description2').val();
     var date1=$('#date2').val();
    var time1=$('#time2').val();
     var channel1=$('#channel2').val();
       var message=title1+" "+description1+" "+date1+" "+time1;

  if(title1=="" || description1=="" || date1=="" || time1==""){
    alert("Please fill in all fields");
   }else{
    $('#taskForm').on('submit', function(event)
{
  $('#taskAlertSend').fadeIn();
event.preventDefault();

$.ajax({
    url:"https://hrmis.zalegoacademy.ac.ke/zalegoemp/public/saveTasks",
    type: "GET",
    data:$('#taskForm').serialize(),
    success: function (data, status)
    {
      if(data.success=='1'){
       // window.open('https://wa.me/'+contact+'?text='+message+'');
       $('#taskAlertSend').hide();
       $('#taskAlertSuccess').fadeIn();
      }else{
         $('#taskAlertSend').hide();
       $('#taskAlertFail').fadeIn();
      }
    },
    error: function (xhr, desc, err)
    {


    }
});

});
   }  
}

//save sms
  function saveSms(channel){
    document.getElementById('channel3').value=channel;
   // var contact=document.getElementById('contact1').value;

   $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var description1=$('#description3').val();

  if(description1==""){
    alert("Please fill in all fields");
   }else{
    $('#smsForm').on('submit', function(event)
{
  $('#smsAlertSend').fadeIn();
event.preventDefault();

$.ajax({
    url:"https://hrmis.zalegoacademy.ac.ke/zalegoemp/public/saveSms",
    type: "GET",
    data:$('#smsForm').serialize(),
    success: function (data, status)
    {
      if(data.success=='1'){
       // window.open('https://wa.me/'+contact+'?text='+message+'');
       $('#smsAlertSend').hide();
       $('#smsAlertSuccess').fadeIn();
      }else{
         $('#smsAlertSend').hide();
       $('#smsAlertFail').fadeIn();
      }
    },
    error: function (xhr, desc, err)
    {


    }
});

});
   }  
}

//save whatsapp
  function saveWhatsapp(channel){
    document.getElementById('channel4').value=channel;
   var contact=document.getElementById('contact4').value;

   $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var description1=$('#description4').val();

  if(description1==""){
    alert("Please fill in all fields");
   }else{
    $('#whatsappForm').on('submit', function(event)
{
  $('#whatsappAlertSend').fadeIn();
event.preventDefault();

$.ajax({
    url:"https://hrmis.zalegoacademy.ac.ke/zalegoemp/public/saveWhatsapp",
    type: "GET",
    data:$('#whatsappForm').serialize(),
    success: function (data, status)
    {
      if(data.success=='1'){
       // window.open('https://wa.me/'+contact+'?text='+message+'');
       $('#whatsappAlertSend').hide();
       $('#whatsappAlertSuccess').fadeIn();
       if(data.whatsappCheck=='1'){
          window.open('https://wa.me/'+contact+'?text='+data._message22+'...');
       }
      }else{
         $('#whatsappAlertSend').hide();
       $('#whatsappAlertFail').fadeIn();
      }
    },
    error: function (xhr, desc, err)
    {


    }
});

});
   }  
}

//save email
  function saveEmail(channel){
    document.getElementById('channel5').value=channel;
   // var contact=document.getElementById('contact1').value;

   $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var description1=$('#description5').val();
    var subject1=$('#subject5').val();

  if(description1=="" || subject1==""){
    alert("Please fill in all fields");
   }else{
      //$('#emailAlertSend').fadeIn();
    document.getElementById('emailForm').submit();
} 
}
</script>
@endsection