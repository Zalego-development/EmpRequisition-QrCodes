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
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
  </div>
<div class="col-sm-6">
   <ol class="breadcrumb float-sm-right ml-2">
            </ol>
          </div><!-- /.col -->
        </div>
      </div>
    </div>


    <?php
      //variables declaration and assignment
      date_default_timezone_set("Africa/Nairobi");
      $timenow = date("Y-m-d H:i:s",strtotime("+0 HOURS"));
      $successCount=0;
      $failedCount=0;
      $leadsCount=0;
      $activeCount=0;
      $waitingBay=0;

      foreach($leads as $l_d){
      if($l_d->completeness==1)
      {
        $successCount++;
      }

       if($l_d->completeness==2)
      {
        $failedCount++;
      }

       if($l_d->completeness==0)
      {
        $activeCount++;
      }

       if($l_d->completeness==15)
      {
        $waitingBay++;
      }

      $leadsCount++;
    }


    $ambassador=0;
      $website=0;
      $csv=0;
      $job=0;

    foreach($applications as $a_p){
        foreach($leads as $l_d){
          if($l_d->customer==$a_p->id){
            if($a_p->source_category==3){
              $ambassador++;
            }

            if($a_p->source_category==2){
              $csv++;
            }

            if($a_p->source_category==0){
              $website++;
            }

            if($a_p->source_category==1){
              $job++;
            }
          }
        }
    }

     foreach($handled as $a_p){
        foreach($leads as $l_d){
          if($l_d->customer==$a_p->id){
            if($a_p->source_category==3){
              $ambassador++;
            }

            if($a_p->source_category==2){
              $csv++;
            }

            if($a_p->source_category==0){
              $website++;
            }

            if($a_p->source_category==1){
              $job++;
            }
          }
        }
    }

      

      $ambassador2=0;
      $website2=0;
      $csv2=0;
      $job2=0;

       foreach($applications as $a_p){
       if($a_p->leadHandler!=1){
        
            if($a_p->source_category==3){
              $ambassador2++;
            }

            if($a_p->source_category==2){
              $csv2++;
            }

            if($a_p->source_category==0){
              $website2++;
            }

            if($a_p->source_category==1){
              $job2++;
            }
         
       }
    }

     foreach($handled as $a_p){
        if($a_p->leadHandler!=1){
            if($a_p->source_category==3){
              $ambassador2++;
            }

            if($a_p->source_category==2){
              $csv2++;
            }

            if($a_p->source_category==0){
              $website2++;
            }

            if($a_p->source_category==1){
              $job2++;
            }
         
       }
    }

      $emails=0;
      $whatsapp=0;
      $sms=0;
      $calls=0;

      foreach($leadsActivity as $la){
        if($la->activity_status=="whatsappMode"){
          $whatsapp++;
        }
        if($la->activity_status=="emailMode"){
          $emails++;
        }
        if($la->activity_status=="smsMode"){
          $sms++;
        }
      }
    ?>

    <div class="container-fluid">
      <!-- Info boxes -->
     
        <div class="row">
          <div class=" col-sm-6 col-md-3 col-6">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-check-double"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Active Deals</span>
                <span class="info-box-number">
                  {{$activeCount}}
                </span>
              </div>
              <!-- /.info-box-content -->
              <a href="{{url('/makecall')}}" ><button class="btn btn-outline-success"><i class="fas fa-eye"></i> Call Knowledge base</button></a>&nbsp

            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class=" col-sm-6 col-md-3 col-6">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-thumbs-up"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Successful Deals</span>
                <span class="info-box-number">{{$successCount}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

          <div class=" col-sm-6 col-md-3 col-6">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-thumbs-down"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Failed Deals</span>
                <span class="info-box-number">{{$failedCount}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class=" col-sm-6 col-md-3 col-6">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-secondary elevation-1"><i class="fas fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Lead Logs</span>
                <span class="info-box-number">{{$leadsCount}}</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <div class=" col-sm-6 col-md-3 col-6" id="refresh_me">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-check-single"></i></span>
           
              <div class="info-box-content" >
                <span class="info-box-text">Hours worked Today</span>
              <div id="div">
                <span class="info-box-number" id="hoursworked">
                @foreach($testimonials as $testimonial)
                    
                      {{round((strtotime($timenow)-strtotime($testimonial->login_time))*0.000277778,2)}}</br>
                      
                  <!-- @endforeach -->
                 
                </span>
               </div>
              </div>
 

              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>

          <div class=" col-sm-6 col-md-3 col-6" id="refresh_me1">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Agents loged in Now</span>
                <div id="div1" >
                <span class="info-box-number" id="agentsum">
               {{$AgentSum}}
              
                </span>                   
                </div>               
                  <?php 
                  use App\Http\Controllers\LeadsController;
                //echo LeadsController::log1();
                  ?>
                </span>
                <a href="#" data-toggle="modal" data-target="#addModal"><button class="btn btn-outline-info"><i class="fas fa-eye"></i> View agents in</button></a>&nbsp
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>


          <div class=" col-sm-6 col-md-3 col-6" id="refresh_me2">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Agents complete Shift Today</span>
                <div>
                <span class="info-box-number" >
               {{$AgentSum1}}
                </span>   
               </div>                
                                       
                 
                </span>
                <a href="#" data-toggle="modal" data-target="#addModal1"><button class="btn btn-outline-success"><i class="fas fa-eye"></i> View agents in</button></a>&nbsp
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <div class=" col-sm-6 col-md-3 col-6">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-2"><i class="fas fa-check-double"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Break(s) Taken Today</span>
                <div id="">
                <span class="info-box-number" >
               {{$AgentBreak}}({{$totalBreak}} Hours) 
                </span>                   
              </div>

                </span>
                <a href="#" data-toggle="modal" data-target="#addModal2"><button class="btn btn-outline-warning"><i class="fas fa-bell"></i> Take a Break </button></a>&nbsp
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
        </div>
        <!-- /.row -->
        <br>
       
      </div>
    
    <section class="container px-3 py-3">
       
       <div class="row">
          <div class="col-sm-12">
        <a href="{{url('/leads/waiting')}}"><span class="ml-5  float-right bg-info px-3 rounded shadow-lg"  title=" You have <?php echo $waitingBay ;?> leads in the waiting bay"  style="margin-top: -8px; cursor:pointer;">
      <h6 class="text-white"><i class="fas fa-users"></i> <?php echo $waitingBay ;?> leads in waiting bay</h6>
    </span></a>


    <?php
    $start= $testimonial->login_time;
    //break allowed in a day
     $acceptedbreaktime=0;
     $workingHours = (strtotime($timenow) - strtotime($start)) / 3600;
      $workingHours1= round($workingHours,3);
      $totalbr= round($totalBreak/60,2);
      //add accepted breaktime
      $realworktime=($workingHours1-$totalBreak)+($acceptedbreaktime);
      $occupancy=($realworktime)/($workingHours1);
      $occupancyRate=round($occupancy*100,3);
      //add call time 
      
      if($occupancyRate<40){
    ?>
                  @endforeach
    
<div class="card py-4 px-2" id="occupancy1">
<span class="mb-1 text-muted">Occupancy Rate<strong class="float-right">{{$occupancyRate}}%</strong></span>
 <div class="progress" style="height:4px;">
<div class="progress-bar bg-danger" role="progressbar" style="width:{{$occupancyRate}}%; " aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
</div>
weak
</div>
<?php }
if($occupancyRate>40 && $occupancyRate<=70){
?>
 <div class="card py-4 px-2" id="occupancy2">
<span class="mb-1 text-muted">Occupancy Rate<strong class="float-right">{{$occupancyRate}}%</strong></span>
 <div class="progress" style="height:4px;">
<div class="progress-bar bg-info" role="progressbar" style="width:{{$occupancyRate}}%; " aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
</div>
average
</div>

<?php }if($occupancyRate>70){?>
  <div class="card py-4 px-2" id="occupancy3">
<span class="mb-1 text-muted">Occupancy Rate<strong class="float-right">{{$occupancyRate}}%</strong><span class="text-muted"> <i class="fas fa-thumbs-up text-success"></i><strong>good</strong></span>
</span>
 <div class="progress" style="height:4px;">
<div class="progress-bar bg-success" role="progressbar" style="width:{{$occupancyRate}}%; " aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
</div>
</div>
<?php }?>
</div>


          <div class="col-sm-6">
               <div class="card">
           
                  <div class="card-body">
                    <h6 class="text-muted"><strong>Leads Conversion</strong> &nbsp<a data-toggle="tooltip" data-placement="top" title="Refresh" class="float-right refreshBtn" href="{{url('/crm')}}"><small class="text-muted"><i class="fa fa-undo"></i></small></a></h6><hr>
                    <span class="text-muted"> <i class="fas fa-thumbs-up text-success"></i> Success Count : <strong class="text-success">{{$successCount}}</strong> , <i class="fas fa-thumbs-down text-danger"></i> Failed Count : <strong class="text-danger">{{$failedCount}}</strong></span>
                  <canvas id="myChart" height="203px"></canvas>
                  </div>
                </div>
          </div>

           <div class="col-sm-6">
               <div class="card">
           
                  <div class="card-body">
                    <h6 class="text-muted"><strong>My Leads Analysis</strong> &nbsp<a data-toggle="tooltip" data-placement="top" title="Refresh" class="float-right refreshBtn" href="{{url('/crm')}}"><small class="text-muted"><i class="fa fa-undo"></i></small></a></h6><hr>
                    <span class="text-muted"> <i class="fas fa-mobile-alt text-success"></i> Ambassador app : <strong class="text-success">{{$ambassador}}</strong> , <i class="fas fa-globe text-info"></i> Website  : <strong class="text-info">{{$website}}</strong>, <i class="fas fa-file-csv text-danger"></i> CSV  : <strong class="text-danger">{{$csv}}</strong>, <i class="fas fa-briefcase text-secondary"></i> Walk in leads : <strong class="text-secondary">{{$job}}</strong></span>
                  <canvas id="myChart2" height="203px"></canvas>
                  </div>
                </div>
          </div>


          <div class="col-sm-6 mt-3">
               <!-- Widget: user widget style 1 -->
            <div class="card card-widget widget-user">
              <!-- Add the bg color to the header using any of the bg-* classes -->
              <div class="widget-user-header bg-secondary">
                <h3 class="widget-user-username">CRM</h3>
                <h5 class="widget-user-desc">Lead Sources</h5>
                 <center>
             
               
                <i class="fas fa-chart-pie fa-3x text-white"></i>
                
              </center>
              </div>
              
              <div class="card-footer">
                <div class="row">
                  <div class="col-sm-3 col-6 border-right">
                    <div class="description-block">
                      <h5 class="description-header">{{$website2}}</h5>
                      <span class="description-text">Website</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-3 col-6 border-right">
                    <div class="description-block">
                      <h5 class="description-header">{{$ambassador2}}</h5>
                      <span class="description-text">Ambassador app</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-3 col-6 border-right">
                    <div class="description-block">
                      <h5 class="description-header">{{$csv2}}</h5>
                      <span class="description-text">CSV Upload</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->

                  <div class="col-sm-3 col-6">
                    <div class="description-block">
                      <h5 class="description-header">{{$job2}}</h5>
                      <span class="description-text">Walk in leads</span>
                    </div>
                    <!-- /.description-block -->
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
            </div>
            <!-- /.widget-user -->
          </div>

          <div class="col-sm-6 mt-3">
              <div class="row">
                <div class="col-sm-6 col-6">
                  <div class="info-box bg-gradient-warning ">
                    <span class="info-box-icon"><i class="far fa-envelope"></i></span>

                    <div class="info-box-content">
                      <span class="info-box-text">Emails</span>
                      <span class="info-box-number">{{$emails}}</span>

                      <div class="progress">
                        <div class="progress-bar" style="width: 70%"></div>
                      </div>
                      <span class="progress-description">
                        Sent from CRM
                      </span>
                    </div>
                    <!-- /.info-box-content -->
                  </div>
                </div>
                  <!-- /.info-box -->

                  <div class="col-sm-6 col-6">
                   <div class="info-box bg-gradient-info">
                    <span class="info-box-icon"><i class="far fa-comment"></i></span>

                    <div class="info-box-content">
                      <span class="info-box-text">Text Messages</span>
                      <span class="info-box-number">{{$sms}}</span>

                      <div class="progress">
                        <div class="progress-bar" style="width: 60%"></div>
                      </div>
                      <span class="progress-description">
                        Sent from CRM
                      </span>
                    </div>
                    <!-- /.info-box-content -->
                  </div>
                </div>
                  <!-- /.info-box -->

                  <div class="col-sm-6 col-6">
                   <div class="info-box bg-gradient-success">
                    <span class="info-box-icon"><i class="far fa-comment-alt"></i></span>

                    <div class="info-box-content">
                      <span class="info-box-text">Whatsapp Messages</span>
                      <span class="info-box-number">{{$whatsapp}}</span>

                      <div class="progress">
                        <div class="progress-bar" style="width: 60%"></div>
                      </div>
                      <span class="progress-description">
                        Sent from CRM
                      </span>
                    </div>
                    <!-- /.info-box-content -->
                  </div>
                </div>
                  <!-- /.info-box -->

                  <div class="col-sm-6 col-6">
                   <div class="info-box bg-gradient-secondary">
                    <span class="info-box-icon"><i class="fas fa-mobile-alt"></i></span>

                    <div class="info-box-content">
                      <span class="info-box-text">Calls</span>
                      <span class="info-box-number">{{$calls}}</span>

                      <div class="progress">
                        <div class="progress-bar" style="width: 60%"></div>
                      </div>
                      <span class="progress-description">
                        Made from CRM
                      </span>
                    </div>
                    <!-- /.info-box-content -->
                  </div>
                </div>
                  <!-- /.info-box -->
              </div>
          </div>

       </div>
      
    </section>
  </div>

<script src="{{asset('assets/libs/js/Chart.js')}}"></script>

   <script type="text/javascript">


var ctx = document.getElementById("myChart");
var ctx2 = document.getElementById("myChart2");
var ctx3 = document.getElementById("myChart3");

var myChart = new Chart(ctx, {
    type: 'doughnut',//specify the type of graph you want to deal with
    data: {
        labels: ["Success ", "Failed "],//the labels of your graphs
        datasets: [{
            label: '# Leads',//what the user sees when he/she overs a given label
            data:[<?php echo $successCount; ?>,<?php echo $failedCount; ?>], //The data set of your graph
            backgroundColor: [
                'rgba(45, 185, 77, 0.2)', //the colors of your labels
                'rgba(249, 111, 52, 0.2)', 
            ],
            borderColor: [
                'rgba(45, 185, 77,1)', //the color of the label borders 
                'rgba(249, 111, 52, 1)',
            ],
            borderWidth: 1
        }]
    },
   
}); 

var myChart2 = new Chart(ctx2, {
    type: 'bar',//specify the type of graph you want to deal with
    data: {
        labels: ["Ambassador","Website","CSV", "Job Portal"],//the labels of your graphs
        datasets: [{
            label: '# Leads',//what the user sees when he/she overs a given label
            data:[<?php echo $ambassador; ?>,<?php echo $website; ?>,<?php echo $csv; ?>,<?php echo $job; ?>], //The data set of your graph
            backgroundColor: [
                'rgba(45, 185, 77, 0.4)', //the colors of your labels
                 'rgba(249, 111, 52, 0.2)',
                 'rgba(75, 192, 192, 0.2)',
                'rgba(220, 53, 69, 0.2)',  
                
            ],

            borderColor: [
                'rgba(45, 185, 77,1)', //the color of the label borders 
                'rgba(249, 111, 52, 1)',
                 //the color of the label borders 
                'rgba(75, 192, 192, 1)', //the color of the label borders 
                'rgba(220, 53, 69, 1)', //the color of the label borders 
            ],
          
            borderWidth: 1
        }]
    },
    
});

var myChart3 = new Chart(ctx3, {
    type: 'pie',//specify the type of graph you want to deal with
    data: {
        labels: ["Ambassador","Website","CSV", "Job Portal"],//the labels of your graphs
        datasets: [{
            label: '# Leads',//what the user sees when he/she overs a given label
            data:[<?php echo $ambassador2; ?>,<?php echo $website2; ?>,<?php echo $csv2; ?>,<?php echo $job2; ?>], //The data set of your graph
            backgroundColor: [
                'rgba(45, 185, 77, 0.4)', //the colors of your labels
                 'rgba(249, 111, 52, 0.2)',
                 'rgba(75, 192, 192, 0.2)',
                'rgba(220, 53, 69, 0.2)',  
                
            ],

            borderColor: [
                'rgba(45, 185, 77,1)', //the color of the label borders 
                'rgba(249, 111, 52, 1)',
                 //the color of the label borders 
                'rgba(75, 192, 192, 1)', //the color of the label borders 
                'rgba(220, 53, 69, 1)', //the color of the label borders 
            ],
          
            borderWidth: 1
        }]
    },
    
});
</script>






<!--add modal-->
<div class="modal" id="addModal">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header bg-light">
            <h6><strong></i> Available Agents Now</strong></h6>
            <i class="fas fa-window-close text-danger float-right fa-2x" data-dismiss="modal" style="cursor: pointer"></i>
          </div>
          <div class="modal-body">
            
          <div class="table-responsive">
        
          <table class="table">
            <thead>
              <tr>
                <th>Agent Name</th>
                <th>Machine loged on</th>
                <th>Hours Spent</th>
                <th></th>
              </tr>
            </thead>
          
            @foreach($test as $test)
                    <tr>
                    <td class="text-info">
                    <i class="fas fa-man-alt"></i>{{$test->name}}</td>
                      <td >{{$test->host}}</td>
                     
                      <td >3</td>
                      <td >
                        <form method="get" action='{{url("/viewAgentlocation")}}' target="_blank">
                          <input type="hidden" name="agent" id="" value="{{$test->email_address}}">
                          <input type="hidden" name="time" id="" value="{{$test->login_time}}">
                        <button  type="submit">
                        view location
                          </button>
                       </form>
                      </td>
                    </tr>
            @endforeach
          </table>
        </form>
      </div>
          </div>
        </div>
      </div>
    </div>
  <!--add modal-->
  <!--add modal-->
<div class="modal" id="addModal1">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header bg-light">
            <h6><strong> Agents Shift Today</strong></h6>
            <i class="fas fa-window-close text-danger float-right fa-2x" data-dismiss="modal" style="cursor: pointer"></i>
          </div>
          <div class="modal-body">
            
          <div class="table-responsive">
        
          <table class="table">
            <thead>
              <tr>
                <th>Agent Name</th>
                <th>Login at</th>
                <th>Last Logout</th>
                <th>Hours in Shift </th>
                <th>Machine </th>
              </tr>
            </thead>
            @foreach($test1 as $test1)
                    <tr>
                    <td class="text-info">
                    <i class="fas fa-man-alt"></i>{{$test1->name}}</td>
                    <td >{{$test1->login_time}}</td>
                    <td >{{$test1->logout_time}}</td>
                    <td>{{round((strtotime($test1->logout_time)-strtotime($test1->login_time))*0.000277778,2)}}</td>
                    <td >{{$test1->host}}</td>
                    <td><form method="get" action='{{url("/viewAgentlocation")}}' target="_blank">
                          <input type="hidden" name="agent" id="" value="{{$test1->email_address}}">
                          <input type="hidden" name="time" id="" value="{{$test1->login_time}}">
                        <button  type="submit">
                        view location
                          </button>
                       </form>
                   </td>
                    </tr>
            @endforeach
          </table>
        </form>
      </div>
          </div>
        </div>
      </div>
    </div>
  <!--add modal-->
  <div class="modal" id="addModal2">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header bg-light">
            <h6><strong><i class="fas fa-plus"></i> take a break</strong></h6>
            <i class="fas fa-window-close text-danger float-right fa-2x" data-dismiss="modal" style="cursor: pointer"></i>
          </div>
          <div class="modal-body">
            
          <div class="table-responsive">
        
          <form  method="POST" action="{{url('takeBreak')}}">
                  @csrf        
                   <div class="form-group col-sm-12">
                    <label>Form</label>
                     <select class="form-control" name="break" id="break" required="">
                     <option >select duration</option>
                      <option value='0.25'>15 minutes</option>
                      <option value='0.5'>30 minutes</option>
                       <option value='1'>one hour</option>
                      <option value='2'>2 hours</option>
                      <option value='3'>3 hours</option>
                      <option value='4'>4 hours</option>
                      <option value='5'>5 hours</option>
                    </select>
                  </div> 
                  </div>
                  <button class="btn btn-success" type="submit" id="btnsave"><i class="fas fa-save"></i> Logout</button>
         </form>
      </div>
          </div>
        </div>
      </div>
    </div>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
              <script language="javascript" type="text/javascript">
              setInterval("my_function();",1000); 
              function my_function(){
              $("#refresh_me").load(" #refresh_me > *");
              $("#refresh_me1").load(" #refresh_me1 > *");
              $("#refresh_me2").load(" #refresh_me2 > *");
              $("#occupancy1").load(" #occupancy1 > *");
              $("#occupancy2").load(" #occupancy2 > *");
              $("#occupancy3").load(" #occupancy3 > *");
              
              }
             </script>
@endsection