@extends('layouts.employee')
@section('content')
<?php
use App\Gsms;
use Illuminate\Support\Str;
?>
    
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1 class="m-0 text-muted ml-2 mt-4"><strong> Training Requests </strong></h1>
            <ol class="breadcrumb float-sm-left ml-2">
              <li class="breadcrumb-item"><a href="{{url('/home')}}"><i class="fa fa-home"></i></a></li>
              <li class="breadcrumb-item active"><a href="#">Trainings</a></li>
              <li class="breadcrumb-item active">Training Requests</li>
            </ol>
                        

                        <div  class="float-right">
                            <a href="{{url('/trainingsrequests')}}"><button class="btn btn-sm btn-warning">
                                <i class="fa fa-refresh"></i> Refresh</button></a>
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
                            <div class="col-md-12 mb-4">
                                <div class="col-md-12 text-left mb-5">
                                   
                                    <button type="button" class="btn theme-green btn-sm" style="color:#fff !important" data-toggle="modal" 
                                            data-target="#addNewMessage">
                                        <i class="fa fa-plus"></i>
                                        Request for training
                                    </button>
                                    <nav class="navbar navbar-expand navbar-white float-right theme-green" style="border-radius: 15px;" id="nav1">

                                        <form method="get" action="{{url('/search/trainingsrequests')}}" class="form-inline ml-3">
                                            @csrf
                                            <div class="input-group input-group-sm">
                                                <input class="form-control form-control-navbar input-sm" name="search" type="search" placeholder="Name" aria-label="Name">
                                                <div class="input-group-append">
                                                    <button class="btn btn-navbar" type="submit">
                                                        <i class="fa fa-search text-primary"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </nav>

                                    {{-- <button type="button" class="btn btn-success btn-sm" data-toggle="modal" 
                                            data-target="#download">
                                            <i class="fa fa-file-pdf-o"></i>
                                            Export
                                    </button> --}}

                                    <form class="form-inline ml-1 float-sm-right bg-default" method="get" action="{{url('sms/filter')}}" style="border-radius: 5px; display:none">
                                        @csrf

                                        @if(isset($from))
                                        <div class="input-group input-group-sm">
                                            <label>From&nbsp</label>
                                            <input type="date" class="form-control" name="from" required value="{{$from}}">
                                        </div>
                                        @else

                                        <div class="input-group input-group-sm">
                                            <label>From&nbsp</label>
                                            <input type="date" class="form-control" name="from" required>
                                        </div>


                                        @endif

                                        @if(isset($to))
                                        <div class="input-group input-group-sm">
                                            <label>To&nbsp</label>
                                            <input type="date" class="form-control" name="to" required value="{{$to}}">
                                        </div>
                                        @else

                                        <div class="input-group input-group-sm">
                                            <label>To&nbsp</label>
                                            <input type="date" class="form-control" name="to" required>
                                        </div>

                                        @endif



                                        <div class="input-group-append">
                                            <button class="btn btn-navbar" type="submit">
                                                <i class="fa fa-filter text-primary"></i>
                                            </button>
                                        </div>
                                    </form>

                                </div>


                                @if(count($errors)>0)
                                    @foreach($errors->all() as $error)
                                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                            {{$error}}
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    @endforeach
                                @endif


                                @if(session('modeError'))
                                    <div class="alert alert-danger">
                                        <a href="#" class="close text-white" data-dismiss="alert">&times</a>
                                        <strong><i class="fa fa-info"></i> {{session('modeError')}}</strong>
                                    </div>
                                @endif
                                @if(session('success'))
                                    <div class="alert alert-success">
                                        <a href="#" class="close text-white" data-dismiss="alert">&times</a>
                                        <strong><i class="fa fa-info"></i> {{session('success')}}</strong>
                                    </div>
                            @endif
                              @if(session('recordAdd'))
                                    <div class="alert alert-success">
                                        <a href="#" class="close text-white" data-dismiss="alert">&times</a>
                                        <strong><i class="fa fa-info"></i> {{session('recordAdd')}}</strong>
                                    </div>
                            @endif
                            <!-- Mail box -->
                                 <div class="card card-default card-outline card-outline-tabs shadow-lg">
                                        <div class="card-header p-0 border-bottom-0 bg-light">
                                            <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" id="custom-tabs-three-home-tab" data-toggle="pill" href="#custom-tabs-three-home" role="tab" aria-controls="custom-tabs-three-home" aria-selected="true" style="color:#333 !important">Training requests</a>
                                            </li>

                                            <li class="nav-item">
                                                <a class="nav-link" id="custom-tabs-three-booked-tab" data-toggle="pill" href="#custom-tabs-three-booked" role="tab" aria-controls="custom-tabs-three-booked" aria-selected="false" style="color:#333 !important">Attended trainings</a>
                                            </li>
                                            </ul>
                                        </div>
                                        <div class="card-body">
                                            <div class="tab-content" id="custom-tabs-three-tabContent">

                                                
                                                <div class="tab-pane fade show active" id="custom-tabs-three-home" role="tabpanel" aria-labelledby="custom-tabs-three-home-tab">
                                                    <div class="card-body pt-0"> 

                                <!-- <div class="card card-default">
                                    <div class="card-header" data-card-widget="collapse">
                                        <h3 class="card-title">Training Requests</h3>
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                <i class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body"> -->
                                        @if(session('recordAddFail'))
                                        <div class="alert alert-danger shadow mt-2 w3-content" style="max-width: 60%;" >
                                          <i class="fas fa-info"></i> {{session('recordAddFail')}}
                                        </div>
                                      @endif
                                   
                        
                                        @if(session('recordEdit'))
                             <script type="text/javascript">
                                setTimeout(success,10);
                                function success(){
                                $('#SuccessEditModal').modal('show');
                              }
                              </script>
                            @endif
                        
                            @if(session('recordDeleteFail'))
                              <div class="alert alert-danger shadow mt-2 w3-content" style="max-width: 60%;" >
                                <i class="fas fa-info"></i> {{session('recordDeleteFail')}}
                              </div>
                            @endif
                        
                         @if(session('recordDelete'))
                             <script type="text/javascript">
                                setTimeout(success,10);
                                function success(){
                                $('#SuccessDeleteModal').modal('show');
                              }
                              </script>
                            @endif
                        
                                        <div class="table-responsive">
                                            <table class="table table-striped" id="smss">
                                                <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Title</th>
                                                    <th>Time</th>
                                                    <th>Date</th>
                                                    <th>Location</th>
                                                    <th>Duration</th>
                                                    <th>Request Status</th>
                                                    <th>Sent On</th>
                                                    <th>Action</th>
                                                    
                                                </tr>
                                                </thead>
                                                <tbody>
                                               @if(isset($trainings))
                                                @foreach($trainings as $key=>$train)
                                                        <?php $toSearch=[]; 
                                                        if (!is_null($train->attendees)) {
                                                            $toSearch=json_decode($train->attendees);
                                                        }
                                                        ?>
                                                        @if(!in_array(Auth::user()->id,$toSearch) || is_null($train->attendees))
                                                   <tr>
                                                        <td>{{++$key}}</td>
                                                        <td>{{$train->title}}</td>
                                                        <td>{{$train->time}}</td>
                                                        <td>{{$train->date}}</td>
                                                        <td>{{$train->location}}</td>
                                                        <td>{{$train->duration}}</a></td>
                                                        <td>
                                                             @if ($train->request_status == 'Pending')
                                                                <span class="badge badge-warning">{{$train->request_status}}</span>
                                                            @elseif($train->request_status == 'Revoked')
                                                             <span class="badge badge-danger"><a class="dropdown-item text-white" data-toggle="modal" data-target="#scheduledInt{{$train->id}}" href="#">{{$train->request_status}}, view reason here</a></span>
                                                            @else
                                                                <span class="badge badge-success">{{$train->request_status}}</span>
                                                            @endif
                                                        </td>
                                                        <td>{{$train->created_at}}</td>
                                                        <td style="cursor:pointer;">
                                                        <center>
                                                          <div class="dropdown"><i class="fas fa-ellipsis-v" id="dropdownMenu" data-toggle="dropdown" ></i>
                                                             <div class="dropdown-menu" > 
                                                            
                                                                @if ($train->request_status == 'Revoked' || $train->request_status == 'Pending')
                                                               
                                                             <a class="dropdown-item" data-toggle="modal" data-target="#editTraining{{$train->id}}" href="#"><i class="fas fa-pencil-alt" ></i> Edit</a>                                                         
                                                            @endif
                                                            @if(($train->date<=\Carbon\Carbon::now()->format('Y-m-d'))&&($train->request_status=='Approved'))
                                                            <a class="dropdown-item" onclick="return confirm('Confirm that you attend this training?');" href='{{url("/confirmAttenance/$train->id")}}'><i class="fa fa-check" ></i> Confirm Attendance</a>
                                                            @endif
                                                            @if($train->request_status == 'Revoked')
                                                            <a class="dropdown-item" data-toggle="modal" data-target="#scheduledInt{{$train->id}}" href="#"><i class="fa fa-eye" ></i> View revoke reason</a>                                                   
                                                            @endif
                                                              </div>
                                                          </div>
                                                      </center>
                                                      </td>
                                                   </tr>
                                                        @endif

                                                @endforeach
                                               @endif
                                                </tbody>
                                            </table>
                                           
                                        </div>
                                    </div>
                                  </div>
                        <div class="tab-pane fade show" id="custom-tabs-three-booked" role="tabpanel" aria-labelledby="custom-tabs-three-home-tab">
                            <div class="card-body pt-0"> 
                                     <table class="table table-striped" id="smss">
                                                <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Title</th>
                                                    <th>Time</th>
                                                    <th>Training Date</th>
                                                    <th>Location</th>
                                                    <th>Training Duration</th>
                                                    <th>Sent On</th>
                                                    <!-- <th>Action</th> -->
                                                    
                                                </tr>
                                                </thead>
                                                <tbody>
                                               @if(isset($trainings))
                                                @foreach($trainings as $key=>$train)
                                                     <?php $toSearch=[]; 
                                                        if (!is_null($train->attendees)) {
                                                            $toSearch=json_decode($train->attendees);
                                                        }
                                                        ?>
                                                        @if(in_array(Auth::user()->id,$toSearch))
                                                  <tr>
                                                        <td>{{++$key}}</td>
                                                        <td>{{$train->title}}</td>
                                                        <td>{{$train->time}}</td>
                                                        <td>{{\Carbon\Carbon::parse($train->date)->format('d-M-Y')}}</td>
                                                        <td>{{$train->location}}</td>
                                                        <td>{{$train->duration}} hrs</a></td>
                                                        <td>{{$train->created_at}}</td>
                                                   </tr>
                                                   @endif
                                                @endforeach
                                               @endif
                                                </tbody>
                                            </table>


                                </div>
                                <!-- /.mail box -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
           <!--View Sms Modal-->
 @if(isset($trainings))
        @foreach($trainings as $key=>$train)
            <div class="modal fade subModal" id="scheduledInt{{$train->id}}">
                <div class="modal-dialog modal-md">
                  <div class="modal-content">
                    <div class="modal-header bg-light">
                      <h6><i class="fa fa-clipboard"></i> {{$train->title}} </h6>
                      <i class="fas fa-window-close float-right mt-3" data-dismiss="modal" style="cursor: pointer;"></i>
                    </div>
                    <div class="modal-body bg-white subModalBody" style="">
                    
                     <a href="#" class="rowed" title="">
                      <div class="row rowed">
                        <div class="col-12 px-2 ml-2 dtx">
                          <strong>
                           <i class="">Revoke reason<br></i> 
                          </strong>
                          <strong class="ml-1 text-muted">{!!$train->revoke_reason!!} </strong>
                          <br>
                          
                     </div>
                      </div>
                      </a>

                    <hr>
                   
                  </div>
                  </div>
                </div>
              </div>

  <div class="modal fade" id="editTraining{{$train->id}}">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Request for Training</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="{{url('/trainingsrequests/edit')}}" id="form">
                            @csrf
                            <input type="hidden" name="id" value="{{$train->id}}">
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label class="col-form-label" for="title">Training Title</label>
                                    <input type="text" class="form-control is-valid" id="title" name="title" value="{{$train->title}}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="col-form-label" for="time">Date</label>
                                    <input type="date" class="form-control"  name="date" id="date" value="{{$train->date}}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="col-form-label" for="time">Time</label>
                                    <input type="time" class="form-control" name="time" id="time" value="{{$train->time}}">
                                </div>
                                <div class="form-group col-md-12">
                                    <label class="col-form-label" for="location">Location</label>
                                    <input type="text" class="form-control" name="location" id="location" value="{{$train->location}}">
                                </div>
                                <div class="form-group col-md-12">
                                    <label class="col-form-label" for="duration">Training Duration</label>
                                    <input type="number" class="form-control" name="duration" id="duration" value="{{$train->duration}}">
                                </div>

                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-warning" data-dismiss="modal">
                                    <i class="fa fa-times"></i>
                                    Close
                                </button>
                                <button type="submit" class="btn btn-primary" id="ajaxSubmit">
                                    <i class="fa fa-send"></i>
                                    Update
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</div>
                                                @endforeach
                                        @endif
                                    <!--View Sms Modal-->


        <!-- Add Client Modal -->
        <div class="modal fade" id="download">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Select Export Type</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <a href="{{url('/noticesSmsAsPDF')}}" class="btn btn-success btn-sm">
                            <i class="fa fa-file-pdf-o"></i>
                            Export PDF
                        </a>
                        <a href="{{url('/noticeSmsAsExcel')}}" class="btn bg-pink btn-sm">
                            <i class="fa fa-file-excel-o"></i>
                            Export Excel
                        </a>
                        <a href="{{url('/noticesSmsAsCSV')}}" class="btn bg-info btn-sm">
                            <i class="fa fa-file-o"></i>
                            Export CSV
                        </a>

                       
                    </div>
                </div>
            </div>
        </div>
        <!-- End Add Client Modal -->

         <!-- Add Client Modal -->
         <div class="modal fade" id="addNewMessage">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Request for Training</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="{{url('/trainingsrequests/add')}}" id="form">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label class="col-form-label" for="title">Training Title</label>
                                    <input type="text" class="form-control is-valid" id="title" name="title" required
                                           placeholder="Training Title">
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="col-form-label" for="time">Date</label>
                                    <input type="date" class="form-control"  name="date" id="date" required
                                           placeholder="Training Date">
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="col-form-label" for="time">Time</label>
                                    <input type="time" class="form-control" name="time" id="time" required
                                           placeholder="Training Time">
                                </div>
                                <div class="form-group col-md-12">
                                    <label class="col-form-label" for="location">Location</label>
                                    <input type="text" class="form-control" name="location" id="location" required
                                           placeholder="Training Location">
                                </div>
                                <div class="form-group col-md-12">
                                    <label class="col-form-label" for="duration">Training Duration</label>
                                    <input type="number" class="form-control" name="duration" id="duration" required
                                           placeholder="Training Duration">
                                </div>

                                <!--<div class="form-group col-md-6">-->
                                <!--    <label for="group_id">Company</label>-->
                                <!--    <select class="form-control" onclick="checkerX()" name="company"  id="company">-->
                                <!--        <option>Select company-</option>-->
                                <!--            @foreach($companies as $company)-->
                                <!--    <option value="{{$company->id}}">{{$company->company}}</option>-->
                                <!--            @endforeach-->
                                    
                                <!--    </select>-->
                                <!--</div>-->

                                <!-- <div class="form-group col-md-6">-->
                                <!--    <label for="group_id">Department</label>-->
                                <!--<span id="dHolder"></span>-->
                                <!--</div>-->

                                <!--<div class="col-md-12">-->
                                <!--    <div class="form-group">-->
                        
                                <!--      <label>Select Recipients</label>&nbsp&nbsp&nbsp<label>-->
                                <!--                <input type="checkbox" id="chk" onclick="checkerX3()">&nbsp Search  manually  &nbsp <input type="checkbox" id="chk2" onclick="checkerX5()">&nbsp Send to cohort -->
                                <!--              </label>-->
                                <!--      <select name="receipient" id="cHolder" class="form-control">-->
                                <!--        <option value=""></option>-->
                                <!--      </select>-->
                                      
                                <!--      <div id="employee2" class="form-group" style="display: none;">-->
                                <!--     <input type="text" readonly=""  class="form-control" placeholder="Results here.." >-->
                                     
                                <!--       <div class="input-group input-group-md mb-3">-->
                                                
                                <!--                 <input type="search"  name="employee" id="employee3" class="form-control" placeholder="Type name here.." >-->
                                <!--                <div class="input-group-append"><span class="input-group-text btn btn-warning" id="confirmBtn"><i class="fas fa-check"></i> Ok</span></div>-->
                                <!--      </div>-->
                                    
                        
                                <!--    </div>-->
                                <!--  </div>-->
                                <!--  <br>-->

                                <!--  <div class="col-md-12" id="cohort" style="display:none;">-->
                                <!--        <div class="card">-->
                                <!--            <div class="card-header">-->
                                <!--                Select Receipients-->
                                <!--            </div>-->
                                <!--            <div class="card-body">-->
                                <!--                <span id="receipientBody"></span>-->
                                <!--            </div>-->
                                <!--        </div>-->
                                <!--  </div>-->
                            
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-warning" data-dismiss="modal">
                                    <i class="fa fa-times"></i>
                                    Close
                                </button>
                                <button type="submit" class="btn btn-primary" id="ajaxSubmit">
                                    <i class="fa fa-send"></i>
                                    Send
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div></div>
        <!-- End Add Client Modal -->

      

    </div>
    <script type="text/javascript">
        function checkerX(){
          var path=document.getElementById('company').value;
             $.ajax({
                  url:"./hr/filterCompX/"+path,
                  type:'GET',
                  data:'_token=<?php echo csrf_token() ;?>',
                  success:function(data){
                   if(data.success=='1'){
                    var output='<select name="department" id="department" class="form-control" required="" onclick="checkerX2()">';
                      for(var x=0;x<data.departments.length;x++){
                          output+='<option value="'+data.departments[x]['id']+'">'+data.departments[x]['department']+'</option> ';
                      } 
      
                      output+=' </select>';
                      document.getElementById('dHolder').innerHTML=output; 
                  } else{
                     
                  }    
                  }
              });
        }
      
         function checkerX2(){
         
          var sel1=document.getElementById('company').value;
          var sel2=document.getElementById('department').value;
          var path=sel1+'/'+sel2;
      
             $.ajax({
                   url:"./hr/filterNameXX/"+path,
                  type:'GET',
                  data:'_token=<?php echo csrf_token() ;?>',
                  success:function(data){
                   if(data.success=='1'){
                      var output='<select name="receipient" id="category" class="form-control" required="" onclick="checkerX4()">';
                      for(var x=0;x<data.employees.length;x++){
                          output+='<option value="'+data.employees[x]['userId']+'">'+data.employees[x]['firstname']+' '+data.employees[x]['lastname']+' '+data.employees[x]['surname']+'</option> ';
                      } 
      
                      output+=' </select>';

            var output2='<div class="form-group">';
                for(var x=0;x<data.employees.length;x++){
                    output2+='<br><br><input type="checkbox" name="client[]" value="'+data.employees[x]['userId']+'">'+data.employees[x]['firstname']+' '+data.employees[x]['lastname']+' '+data.employees[x]['surname'];

                      } 
                output2+='</di>';
      
      
      
                      document.getElementById('cHolder').innerHTML=output;
                     document.getElementById('receipientBody').innerHTML=output2;
                       
                  } else{
                     
                  }    
                  }
              });
        }
      
        function checkerX3(){
          var chk=document.getElementById('chk');
          if(chk.checked){
            $("#cHolder").hide();
            $("#employee2").fadeIn();
          }else{
             $("#cHolder").fadeIn();
            $("#employee2").hide();
          }
        }

         function checkerX5(){
          var chk=document.getElementById('chk2');
          if(chk.checked){
            $("#cHolder").hide();
            $("#cohort").fadeIn();
          }else{
             $("#cHolder").fadeIn();
            $("#cohort").hide();
          }
        }


      
        //listen to user input
        $("#confirmBtn").on("click", function(){
          var sel0=$("#employee3").val();
          var sel1=document.getElementById('company').value;
          var sel2=document.getElementById('department').value;
          var path=sel0+'/'+sel1+'/'+sel2;
           $.ajax({
                  url:"./hr/filterNameX/"+path,
                  type:'GET',
                  data:'_token=<?php echo csrf_token() ;?>',
                  success:function(data){
                   if(data.success=='1'){
                    var id='';
                     var outpu2='<select name="employee" id="employee" class="form-control" required="">';
                      for(var x=0;x<data.employees.length;x++){
                          outpu2+='<option value="'+data.employees[x]['userId']+'">'+data.employees[x]['firstname']+' '+data.employees[x]['lastname']+' '+data.employees[x]['surname']+'</option> ';
                      } 
      
                      outpu2+=' </select>';
                      document.getElementById('cHolder').innerHTML=outpu2; 
                      $("#cHolder").fadeIn();
            $("#employee2").hide(); 
                  } else{
                     
                  }    
                  }
              });
        });
      
      
        function proceed(){
          $(".additionalDetails").fadeIn(3000);
        }
      
        function checkerX4(){
          var sel0=$("#cHolder").val();
           var sel1=document.getElementById('company').value;
          var sel2=document.getElementById('department').value;
          var path=sel0+'/'+sel1+'/'+sel2;
          $.ajax({
                  url:"./hr/filterCatX/"+path,
                  type:'GET',
                  data:'_token=<?php echo csrf_token() ;?>',
                  success:function(data){
                   if(data.success=='1'){
                      var earned=0;
                      var used=0;
                      var pending=0;
                      var bf=0;
                      var available=0;
                      var startDate='';
                      var endDate='';
                      for(var x=0;x<data.categorys.length;x++){
                          earned=data.categorys[x]['duration'];
                          pending=earned-used;
                          available=earned;
                          startDate=data.categorys[x]['startMonth'];
                      }
      
                      endDate=data.expiryDate;
      
      
                      var outpu2='<select name="employee" id="employee" class="form-control" required="">';
                      for(var x=0;x<data.employees.length;x++){
                          outpu2+='<option value="'+data.employees[x]['userId']+'">'+data.employees[x]['firstname']+' '+data.employees[x]['lastname']+' '+data.employees[x]['surname']+'</option> ';
                      } 
      
                      outpu2+=' </select>';
                      document.getElementById('eHolder').innerHTML=outpu2; 
      
                      document.getElementById('earned').innerHTML=earned; 
                      document.getElementById('entitled').innerHTML=earned;
                      document.getElementById('available').innerHTML=earned;
                      document.getElementById('pending').innerHTML=earned;
                      document.getElementById('endDate').value=endDate;
                      document.getElementById('leaveEnd').innerHTML=endDate;
                      document.getElementById('startDate').value=startDate;
                      document.getElementById('dispBtn').style.display='block';
                  } else{
                     
                  }    
                  }
              });
        }
      
      setInterval(dt,1000);
      function dt(){
      const date1 = new Date($("#startDate").val());
      const date2 = new Date($("#endDate").val());
      const diffTime = Math.abs(date2 - date1);
      const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)); 
      
       document.getElementById('earned').innerHTML=diffDays; 
                      document.getElementById('entitled').innerHTML=diffDays;
                      document.getElementById('available').innerHTML=diffDays;
                      document.getElementById('pending').innerHTML=diffDays;
                       document.getElementById('calc').innerHTML=diffDays;
      
      }
        
      </script>
@endsection
