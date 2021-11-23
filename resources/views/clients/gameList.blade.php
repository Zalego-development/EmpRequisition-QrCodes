@extends('layouts.profile')
@section('title','Game List| Machakos Golf Club')
@section('content')
<style type="text/css">
  .box{
        position: relative;
        display: inline-block; /* Make the width of box same as image */
        margin-bottom: 8px;

    }
    .box .text{
        position: absolute;
        z-index: 999;
        margin: 0 auto;
        left: 0;
        right: 0;        
        text-align: center;
        top: 10%;
        font-family: Arial,sans-serif;
        color: #fff;
        width: 90%;
       }
       .select2-search--dropdown .select2-search__field{
        padding: 8px !important;
       }
       .select2-results__option {
    padding: 8px !important;
}
.select2-container--bootstrap4 .select2-selection--single {
    height: calc(2.25rem + 6px) !important;
}
</style>
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h2 class="m-0 text-muted ml-2 mt-4"><strong> Game List </strong></h2>
                      <ol class="breadcrumb float-sm-left ml-2">
                              <!-- <li class="breadcrumb-item"><a href="{{url('/home')}}">Dashboard</a></li> -->
                              <li class="breadcrumb-item active">Games</li>
                              <li class="breadcrumb-item active"> Game List</li>
                            </ol>
                    </div>
                    <div class="col-sm-6">
                          <div class="float-right mt-5">
                          <div class="btn-group btn-group-justified">
                            <a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#firsttee"><i class="fa fa-eye"></i> View all bookings</a>
                        <div class="dropdown dropleft" style="padding-left:10px; padding-top:5px; cursor:pointer;"><i class="fa fa-ellipsis-v" id="dropdownMenu" data-toggle="dropdown" ></i>
                             <div class="dropdown-menu">
                                 <!-- <a href="#" class="dropdown-item"  id="l1">
                                                    <i class="fa fa-print"></i> Print
                                                </a> -->
                                                
                              <form class="form-inline" method="get" action="{{url('/bookedGamesPdf')}}">
                                                  <input type="text" name="game_id" value="{{$game->id}}" style="display:none;">
                                                  <button type="submit" class="dropdown-item" id="l1">
                                                    <i class="fa fa-file-pdf-o"></i> Export Pdf
                                                </button>
                                               </form>
                                               
                               <form class="form-inline" method="get" action="{{url('/bookedGamesExcel')}}">
                                                  <input type="text" name="game_id" value="{{$game->id}}" style="display:none;">
                                                  <button type="submit"  class="dropdown-item" id="l1">
                                                    <i class="fa fa-file-excel-o"></i> Export Excel
                                                </button>
                                               </form>
                                               <div style="display:none">
                                               <form class="form-inline" method="get" action="{{url('/bookedGamesCsv')}}">
                                                  <input type="text" name="game_id" value="{{$game->id}}" style="display:none;">
                                                  <button type="submit"  class="dropdown-item" id="l1">
                                                    <i class="fa fa-file"></i> Export csv
                                                </button>
                                               </form>
                                               </div>
                              </div>
                          </div>
                        </div>
                </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
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
           


         <!-- ./row -->
            <div class="row">
            
                <div class="col-12 col-sm-12 col-lg-12">
                    <div class="card card-light card-outline card-outline-tabs">
                    <div class="card-header p-0 border-bottom-0">
                        <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="custom-tabs-three-home-tab" data-toggle="pill" href="#custom-tabs-three-home" role="tab" aria-controls="custom-tabs-three-home" aria-selected="true" style="color:#333 !important">Booking Details</a>
                        </li>

                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="custom-tabs-three-tabContent">
                            <div class="tab-pane fade show active" id="custom-tabs-three-home" role="tabpanel" aria-labelledby="custom-tabs-three-profile-tab">
                                
                                
                                    <div class="row">
                                        <div class="col-md-12">
                                          
                                            <div class="card">
                                                
                                                <div class="card-body">
                                           
                                                                <div class="row mb-4">
                                                         <div class="col-sm-12">
                                                            <center>
                                                  <img src="{{asset('image/macha.png')}}" class="img-fluid">
                                                            <p style="font-size:16px">
                                                                <b>Game</b>:&nbsp;{{$game->tournament}}
                                                                &nbsp; &nbsp;
                                                                <b>Scheduled On</b>:&nbsp;{{\Carbon\Carbon::parse($game->date_time)->format('d-M-Y')}}&nbsp; &nbsp;
                                                                
                                                                <b>Total Bookings</b>:&nbsp;
                                                                {{(\APP\FirstTee::whereNotNull('client_id')->where('game_id',$game->id)->count())+(\APP\FirstTee::whereNotNull('player1')->where('game_id',$game->id)->count())+(\APP\FirstTee::whereNotNull('player2')->where('game_id',$game->id)->count())+(\APP\FirstTee::whereNotNull('player3')->where('game_id',$game->id)->count())}}
                                                        
                                                                <?php 
                                                                    $today=date('Y-m-d');
                                                                    $date=$game->deadline;
                                                                  $dateTocheck=(\APP\FirstTee::whereNotNull('client_id')->where('game_id',$game->id)->count())+(\APP\FirstTee::whereNotNull('player1')->where('game_id',$game->id)->count())+(\APP\FirstTee::whereNotNull('player2')->where('game_id',$game->id)->count())+(\APP\FirstTee::whereNotNull('player3')->where('game_id',$game->id)->count());
                                                                ?>
                                                                  @if($clientId==5)
                                                                 @if($date>=$today)
                                                                <span class="text-success"> (Ongoing)</span>
                                                                @else
                                                                <span class="text-danger"> (Closed)</span>
                                                                @endif
                                                                @else
                                                                @if($date>=$today && $dateTocheck<=120)
                                                                <span class="text-success"> (Ongoing)</span>
                                                                @else
                                                                <span class="text-danger"> (Closed)</span>
                                                                @endif
                                                                @endif
                                                            </p>    </center>                                                        
                                                         </div>
                                                         <!-- <div class="col-sm-6" id="gmz">

                                                  <center><img src="{{asset('/'.$game->image)}}" height="180" width="200"></center>
                                                         </div> -->

                                                   </div>

                                                   <div class="container-fluid">
                                                    <div class="row">
                                                                
                                                                <?php $count=1;?>
                                                                
                                                                @foreach($times as $time)
                                                                            <?php $stzt=0; 
                                                                $idxxt=[];
                                                                $notBooked=[];
                                                                $allTimes=[];
                                                                $idNew=[];
                                                                 $idst=[];
                                                                $statt=0;
                                                                $n1t=null;
                                                                $n2t=null;
                                                                $n3t=null;
                                                                $tzt=array();
                                                                $p1t=null;
                                                                $p2t=null;
                                                                $p3t=null;
                                                                $c1t=null;
                                                                $nmt=null;
                                                                $tidt=null;
                                                                $withoutNull=[];
                                                                 ?>
                                                                @foreach($firstTees as $tee)
                                                                <?php 
                                                                if (!empty($firstTees)) {
                                                                    if (($tee->client_id==null)||($tee->player1==null)||($tee->player2==null)||($tee->player3==null)) {
                                                                 array_push($idxxt,$tee->time_id);
                                                                    }else{
                                                                        array_push($idNew,$tee->time_id);
                                                                    }
                                                                }
                                                                if($time->id==$tee->time_id){
                                                                $p1t=$tee->player1;
                                                                $p2t=$tee->player2;
                                                                $p3t=$tee->player3;
                                                                $c1t=$tee->client_id;
                                                                $tidt=$tee->id;    
                                                                  }     ?>
                                                                @endforeach
                                                                  <?php $notBook=DB::table('times')->whereIn('id',json_decode($game->time))->whereNotIn('id',$idNew)->whereNotIn('id',$idxxt)->get(['id']); 
                                                                ?>
                                                                @foreach($notBook as $bk)
                                                                <?php  array_push($notBooked, $bk->id); ?>
                                                                @endforeach
                                                                <?php
                                                                $allTimes=array_merge($notBooked,$idxxt);
                                                                // $idsWithoutNull=array_filter($idxxt);
                                                                ?>
                                                                 <?php $idst=[$p1t,$p2t,$p3t,$c1t]; ?>
                                                                  <div class="col-sm-3">
                                                                    
                                                                    <div class="card px-2 py-2 shadow">
                                                                        <center>
                                                                          <div  class="box">
                                                                            <!-- shadow-lg bg-warning style=" border:1px solid transparent; width:65px; height: 65px; border-radius:  50%; color: #fff;" -->
                                                                            <img src="{{asset('assets/images/golf2.png')}}" style="max-heigt:65px; max-width:65px;" class="img-fluid" id="" >
                                                                              <div class="text">
                                                                            <h4 style="margin-top: 12px; color: #28a745; font-size:16px;" ><strong id="pointerElement"> {{$time->name}}</strong></h4>
                                                                          </div>
                                                                          </div>
                                                                              <br> 
                                                                           <!-- <div  class="shadow-lg bg-warning" style=" border:1px solid transparent; width:65px; height: 65px; border-radius:  50%; color: #fff;">
                                                                              <center>
                                                                            <h4 style="margin-top: 15px; color: #fff; font-size:17px;" ><strong id="pointerElement"> {{$time->name}}</strong></h4>
                                                                          </center>
                                                                          </div> -->
                                                                                                                                                   
                                                                 <?php $statt=0;  ?>
                                                                      <strong class="text-muted">
                                                                            <?php $nmt=DB::table('clients')->where('id',$c1t)->first();
                                                                             if(!is_null($nmt)){
                                                                                $statt+=1;
                                                                                echo (ucwords((strtolower($nmt->firstName))." ".(strtolower($nmt->middleName))." ".(strtolower($nmt->lastName)))."<br>");
                                                                            // echo ((strtolower($nmt->firstName))." ".(strtolower($nmt->middleName))." ".(strtolower($nmt->lastName))."</li></ul>");
                                                                            }
                                                                             if(!is_null($p1t)){
                                                                                $statt+=1;
                                                                                $n1t=DB::table('clients')->where('id',$p1t)->first();
                                                                                echo (ucwords((strtolower($n1t->firstName))." ".(strtolower($n1t->middleName))." ".(strtolower($n1t->lastName)))."<br>");
                                                                            }
                                                                            ?>
                                                                                <?php
                                                                             if(!is_null($p2t)){
                                                                                $statt+=1;
                                                                                $n2t=DB::table('clients')->where('id',$p2t)->first();
                                                                                echo (ucwords((strtolower($n2t->firstName))." ".(strtolower($n2t->middleName))." ".(strtolower($n2t->lastName)))."<br>");
                                                                            }
                                                                              if(!is_null($p3t)){
                                                                                $statt+=1;
                                                                                $n3t=DB::table('clients')->where('id',$p3t)->first();
                                                                                echo (ucwords((strtolower($n3t->firstName))." ".(strtolower($n3t->middleName))." ".(strtolower($n3t->lastName)))."<br>");
                                                                            }
                                                                          

                                                                            ?>
                                                                        </strong>
                                                                            <span class="text-info">
                                                                        <br>
                                                                        @if($statt==0)
                                                                        <span style='color:#666;'>No bookings for this slot</span>
                                                                        @endif
                                                                       @if($date>=$today)
                                                                      
                                                                       @if($dateTocheck<=120 || $clientId==5)
                                                                        @if(in_array(null, $idst, true))
                                                                          <?php
                                                                          if ($statt==3) {
                                                                                echo "<a href=# data-toggle='modal' data-target='#editClient".$time->id."'><i class='fa fa-golf-ball'></i> 1 slot available</a><br>";
                                                                            }elseif ($statt==2) {
                                                                                echo "<a href=# data-toggle='modal' data-target='#editClient".$time->id."'><i class='fa fa-golf-ball'></i> 2 slots available</a><br><br>";
                                                                            }
                                                                            elseif ($statt==1) {
                                                                                echo "<br><a href=# data-toggle='modal' data-target='#editClient".$time->id."'><i class='fa fa-golf-ball'></i> 3 slots available</a><br><br>";
                                                                            }elseif ($statt==0) {
                                                                                echo "<br><br><a href=# data-toggle='modal' data-target='#editClient".$time->id."'><i class='fa fa-golf-ball'></i> 4 slots available</a><br><br>";
                                                                            }
                                                                        ?>
                                                                          <i style="cursor: pointer;" data-toggle="modal" data-target="#editClient{{$time->id}}" class="fas fa-plus-circle text-success fa-2x" id="prt" title="Click to book"></i>
                                                                            
                                                                        @endif
                                                                        <?php $withoutNull = array_filter($idst); ?>
                                                                        @if(!empty($withoutNull))
                                                                        
                                                                         <i style="cursor: pointer;margin-left: 10px;color:#17a2c3;" data-toggle="modal" data-target="#rescheduleClient{{$time->id}}" class="fas float-left fa-edit fa-2x" id="prt" title="Click to reschedule" ></i>
                                                                        
                                                                        <i style="cursor: pointer;margin-right: 10px; color:#e40000;" data-toggle="modal" data-target="#removeClient{{$time->id}}" class="float-right fas fa-minus-circle text-danger fa-2x" id="prt" title="Click to cancel booking"></i>
                                                                        @endif
                                                                    <!-- </div> -->
                                                                        @endif
                                                                        @endif
                                                                           </span>
                                                                           </center>
                                                                            </div>
                                                                          </div>

                                                                <!-- </td>
                                                                                                   
                                                                    </tr> -->

                                                                     <div class="modal fade" id="editClient{{$time->id}}">
                                                                    <div class="modal-dialog modal-md">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h2 class="text-muted"><i class="fa fa-golf-ball"></i> Book Game</h2>
                                                                                <button type="button" class="close" aria-label="Close" data-dismiss="modal">
                                                                                    <span aria-hidden="true">X</span>
                                                                                </button>
                                                                            </div>
                                                                            <!-- <form class="" action='{{url("viewGame/admin/add")}}' method="post"> -->
                                                                                <div class="card-body px-2 modalCardBody">
                                                                                    <div class="row">
                                                                                        <div class="col-md-12 text-center">
                                                                                        <div class="alert alert-danger" id="errorP{{$time->id}}" style="display:none">
                                                                                          <a href="#" class="close" data-dismiss="alert">&times</a>
                                                                                           Please select member name before procceeding
                                                                                        </div>
                                                                                       <!--  <div class="alert alert-danger" id="error1{{$time->id}}" style="display:none">
                                                                                          <a href="#" class="close" data-dismiss="alert">&times</a>
                                                                                           Phone number does not exist in the records
                                                                                        </div> -->
                                                                                        <div class="alert alert-danger" id="error1{{$time->id}}" style="display:none">
                                                                                          <a href="#" class="close" data-dismiss="alert">&times</a>
                                                                                           Client has already been booked
                                                                                        </div>
                                                                                        </div>
                                                                                        <div class="form-group col-md-12" id="step1{{$time->id}}">
                                                                                        <input type="hidden" value="{{$game->id}}" id="gameId{{$time->id}}" name="gameId">
                                                                                            <!-- <label class="col-form-label" for="mphone">Enter Phone Number</label> -->
                                                                                            <!-- <input type="text" name="phone"  id="mphone{{$time->id}}" class="form-control is-valid" placeholder="2547********" > -->
                                                                                             <label for="clntId{{$time->id}}" class="col-form-label">Name</label>
                                                                                            <select name="clntId" class="form-control select2" id="clntId{{$time->id}}" data-placeholder="Search and select name" data-dropdown-css-class="select2-success" style="width: 100%;">
                                                                                                <optgroup label="Search name">
                                                                                                        @foreach(DB::table('clients')->orderBy('firstName')->get() as $client)
                                                                                                        <option value="{{$client->id}}">{{ucwords(strtolower($client->firstName))}} {{ucwords(strtolower($client->middleName))}} {{ucwords(strtolower($client->lastName))}}</option>
                                                                                                        @endforeach
                                                                                                </optgroup>
                                                                                            </select>                                                                                        
                                                                                        <br><br>
                                                                                        <span class="input-group-text btn btn-default" disabled id="gifload{{$time->id}}" style="display: none;"><img src="{{asset('image/gifs.gif')}}" style="margin-top: -4px;" width="20px" height="20px"></span>
                                                                                        <center><button class="btn btn-success" type="button" onclick="continueTo('<?php echo $time->id; ?>')" id="ctn{{$time->id}}">
                                                                                        <i class="fa fa-check"></i> Continue
                                                                                        </button>
                                                                                        
                                                                                    </center>
                                                                                    </div>

                                                                                    <div id="step2{{$time->id}}" class="form-group col-md-12" style="display:none">
                                                                                        <form class="" action='{{url("viewGame/admin/add")}}' method="post">
                                                                                            @csrf
                                                                                        <input type="hidden" name="clientIdz" id="clientIdz{{$time->id}}">
                                                                                        <input type="hidden" name="timeId" id="timeId{{$time->id}}" value="{{$time->id}}">
                                                                                        <input type="hidden" name="tee_id" value="1">
                                                                                        <input type="hidden" name="game_id" value="{{$game->id}}">
                                                                                        <input type="hidden" name="new" value="{{$tidt}}">
                                                                                        <center><span id="stm{{$time->id}}">You are about to book <b>{{$time->name}} - 1st Tee</b> slot for </span></center>
                                                                                        <br><br>
                                                                                        <center><button class="btn btn-success" type="submit" onclick="continue" id="continue">
                                                                                        <i class="fa fa-check"></i> Confirm Booking
                                                                                        </button></center>
                                                                                    </form>
                                                                                    </div>
                                                                                    </div>
                                                                                </div>
                                                                                   <!--  <center style="margin-top: -17px;" class="mb-3">
                                                                                    <button class="btn btn-danger" type="button" data-dismiss="modal">
                                                                                        <i class="fa fa-close"></i>Close
                                                                                    </button>
                                                                                    <button type="submit" class="btn btn-primary">
                                                                                        <i class="fa fa-refresh"></i>Update Member
                                                                                    </button>
                                                                                    </center> -->
                                                                            <!-- </form> -->
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                     <div class="modal fade" id="removeClient{{$time->id}}">
                                                                    <div class="modal-dialog">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h2 class="text-muted"><i class="fa fa-golf-ball"></i> Cancel Booking</h2>
                                                                                <button type="button" class="close" aria-label="Close" data-dismiss="modal">
                                                                                    <span aria-hidden="true">X</span>
                                                                                </button>
                                                                            </div>
                                                                                <div class="card-body px-2 modalCardBody">
                                                                                    <div class="row">
                                                                                        <div class="col-md-12 text-center">
                                                                                        <div class="alert alert-danger" id="removeErrorP{{$time->id}}" style="display:none">
                                                                                          <a href="#" class="close" data-dismiss="alert">&times</a>
                                                                                           Please select member name before procceeding
                                                                                        </div>                                                                                        </div>
                                                                                        <div class="form-group col-md-12" id="removeStep1{{$time->id}}">
                                                                                        <input type="hidden" value="{{$game->id}}" id="removeGameId{{$time->id}}" name="gameId">
                                                                                            <!-- <label class="col-form-label" for="mphone">Enter Phone Number</label> -->
                                                                                            <!-- <input type="text" name="phone"  id="mphone{{$time->id}}" class="form-control is-valid" placeholder="2547********" > -->
                                                                                             <label for="removeClntId{{$time->id}}" class="col-form-label">Name</label>
                                                                                            <select name="clntId" class="form-control select2" id="removeClntId{{$time->id}}" data-placeholder="Search and select name" data-dropdown-css-class="select2-success" style="width: 100%;">
                                                                                                <optgroup label="Search name">
                                                                                                        @foreach(DB::table('clients')->whereIn('id',$withoutNull)->get() as $client)
                                                                                                        <option value="{{$client->id}}">{{ucwords(strtolower($client->firstName))}} {{ucwords(strtolower($client->middleName))}} {{ucwords(strtolower($client->lastName))}}</option>
                                                                                                        @endforeach
                                                                                                </optgroup>
                                                                                            </select>                                                                                        
                                                                                        <br><br>
                                                                                        <center><button class="btn btn-danger" type="button" onclick="continueRemove('<?php echo $time->id; ?>')" id="removeCtn{{$time->id}}">
                                                                                         Continue
                                                                                        </button>
                                                                                        
                                                                                    </center>
                                                                                    </div>

                                                                                    <div id="removeStep2{{$time->id}}" class="form-group col-md-12" style="display:none">
                                                                                        <form class="" action='{{url("viewGame/admin/remove")}}' method="post">
                                                                                            @csrf
                                                                                        <input type="hidden" name="clientIdz" id="removeClientIdz{{$time->id}}">
                                                                                        <input type="hidden" name="timeId" id="removeTimeId{{$time->id}}" value="{{$time->id}}">
                                                                                        <input type="hidden" name="teeIdz" value="{{$tidt}}">
                                                                                        <center><span id="removeStm{{$time->id}}">You are about to cancel <b>{{$time->name}} - 1st Tee</b> slot for </span></center>
                                                                                        <br><br>
                                                                                        <center><button class="btn btn-danger" type="submit" id="removeContinue">
                                                                                        <i class="fa fa-check"></i> Confirm Cancelation
                                                                                        </button></center>
                                                                                    </form>
                                                                                    </div>
                                                                                    </div>
                                                                                </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                     <div class="modal fade" id="rescheduleClient{{$time->id}}">
                                                                    <div class="modal-dialog">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h2 class="text-muted"><i class="fa fa-golf-ball"></i> Reschedule Booking</h2>
                                                                                <button type="button" class="close" aria-label="Close" data-dismiss="modal">
                                                                                    <span aria-hidden="true">X</span>
                                                                                </button>
                                                                            </div>
                                                                                <div class="card-body px-2 modalCardBody">
                                                                                    <div class="row">
                                                                                        <div class="col-md-12 text-center">
                                                                                        <div class="alert alert-danger" id="rescheduleErrorP{{$time->id}}" style="display:none">
                                                                                          <a href="#" class="close" data-dismiss="alert">&times</a>
                                                                                           Please select member name before procceeding
                                                                                        </div> </div>
                                                                                        <div class="form-group col-md-12" id="rescheduleStep1{{$time->id}}">
                                                                                        <input type="hidden" value="{{$game->id}}" id="rescheduleGameId{{$time->id}}" name="gameId">
                                                                                             <label for="rescheduleClntId{{$time->id}}" class="col-form-label">Select member to reschedule</label>
                                                                                            <select name="clntId" class="form-control select2" id="rescheduleClntId{{$time->id}}" data-placeholder="Search and select name" data-dropdown-css-class="select2-success" style="width: 100%;">
                                                                                                <optgroup label="Search name">
                                                                                                        @foreach(DB::table('clients')->whereIn('id',$withoutNull)->get() as $client)
                                                                                                        <option value="{{$client->id}}">{{ucwords(strtolower($client->firstName))}} {{ucwords(strtolower($client->middleName))}} {{ucwords(strtolower($client->lastName))}}</option>
                                                                                                        @endforeach
                                                                                                </optgroup>
                                                                                            </select>                                                                                        
                                                                                        <br><br>
                                                                                        <center><button class="btn btn-primary" type="button" onclick="continueReschedule('<?php echo $time->id; ?>')" id="rescheduleCtn{{$time->id}}">
                                                                                         Continue
                                                                                        </button>
                                                                                        
                                                                                    </center>
                                                                                    </div>

                                                                                    <div id="rescheduleStep2{{$time->id}}" class="form-group col-md-12" style="display:none">
                                                                                        <form class="" action='{{url("viewGame/admin/reschedule")}}' method="post">
                                                                                            @csrf
                                                                                        <input type="hidden" name="clientIdz" id="rescheduleClientIdz{{$time->id}}">
                                                                                        <!-- <input type="hidden" name="timeId" id="rescheduleTimeId{{$time->id}}" value="{{$time->id}}"> -->
                                                                                        <input type="hidden" name="tee_id" value="1">
                                                                                        <input type="hidden" name="game_id" value="{{$game->id}}">
                                                                                        <input type="hidden" name="teeIdz" value="{{$tidt}}">
                                                                                        <input type="hidden" name="old_time_id" value="{{$time->id}}">
                                                                                        <span id="rescheduleStm{{$time->id}}">Reschedule <b id="rnames{{$time->id}}"> </b> from <b>{{$time->name}} - 1st Tee</b> to: </span>
                                                                                        <br>
                                                                                        <label for="removetime{{$time->id}}" class="col-form-label">Select time</label>
                                                                                            <select name="timeId" class="form-control select2" id="removetime{{$time->id}}" data-placeholder="Search and select name" data-dropdown-css-class="select2-success" style="width: 100%;">
                                                                                                <optgroup label="Search time">
                                                                                                        @forelse(DB::table('times')->whereIn('id',json_decode($game->time))->whereIn('id',$allTimes)->whereNotIn('id',[$time->id])->get() as $tm)
                                                                                                        <option value="{{$tm->id}}">{{$tm->name}}</option>
                                                                                                        @empty
                                                                                                        <option disabled> No available slot</option>
                                                                                                        @endforelse
                                                                                                </optgroup>
                                                                                            </select>  
                                                                                            <br><br>  
                                                                                        <center><button class="btn btn-primary" type="submit" id="rescheduleContinue">
                                                                                        <i class="fa fa-check"></i> Confirm Reschedule
                                                                                        </button></center>
                                                                                    </form>
                                                                                    </div>
                                                                                    </div>
                                                                                </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                @endforeach
                                                               <!--  </tbody>
                                                            </table> -->
                                                            </div>
                                                           {{$times->links()}}
                                                        </div>
                                                        </div>
                                                        <div class="col-sm-6" style="display:none;">
                                                            <p style="float:right;font-size:20px;">10th Tee</p>
                                                            <table class="table table-bordered table-striped">
                                                                <thead>
                                                                    <tr><th>#</th>
                                                                        <th>Time</th>
                                                                        <th>Players</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                <?php $count=1;?>
                                                                @foreach($tenthTees as $tee)
                                                                    <tr>
                                                                        <td>{{$count++}}</td>
                                                                        <td>{{$tee->time->name}}</td>
                                                                        <td>{{$tee->client->firstName}} {{$tee->client->middleName}} {{$tee->client->lastName}}
                                                                            <br>{{DB::table('clients')->where('id',$tee->player1)->value('firstName')}} {{DB::table('clients')->where('id',$tee->player1)->value('middleName')}}
                                                                            <br>{{DB::table('clients')->where('id',$tee->player2)->value('firstName')}} {{DB::table('clients')->where('id',$tee->player2)->value('middleName')}}
                                                                            <br>{{DB::table('clients')->where('id',$tee->player3)->value('firstName')}} {{DB::table('clients')->where('id',$tee->player3)->value('middleName')}}</td>               
                                                                    </tr>
                                                                @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>        
                                    </div>



                                    <div class="modal fade" id="firsttee">
                                        <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <button type="button" class="btn btn-primary btn-sm" onClick="printDiv()">
                                               Print
                                            </button>


                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" onClick="closeModal()">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            </div>
                                            <div class="card-body px-2 modalCardBody" id="divName" style="background-color:white;">
                                                  <center>
                                                  <img src="{{asset('image/macha.png')}}">
                                                  </center>
                                                  <center>
                                                    <p style="font-size:17px">
                                                        <b>Game</b>:  &nbsp; &nbsp; &nbsp; {{$game->tournament}}
                                                        &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                                                        <b>Scheduled On</b>:&nbsp;&nbsp;{{\Carbon\Carbon::parse($game->date_time)->format('d-M-Y')}}&nbsp; &nbsp;&nbsp;
                                                        <b>Total Bookings</b>:&nbsp;
                                                              {{(\APP\FirstTee::whereNotNull('client_id')->where('game_id',$game->id)->count())+(\APP\FirstTee::whereNotNull('player1')->where('game_id',$game->id)->count())+(\APP\FirstTee::whereNotNull('player2')->where('game_id',$game->id)->count())+(\APP\FirstTee::whereNotNull('player3')->where('game_id',$game->id)->count())}}
                                                    </p>
                                                 </center>
                                                <br>
                                                <hr>
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                    <p style="float:left;font-size:20px;">1st Tee</p>
                                                        <table class="table table-bordered table-striped">
                                                            <thead>
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th>Time</th>
                                                                    <th>Players</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            <?php $count=1;?>
                                                           @foreach(\App\Time::whereIn('id',json_decode($game->time))->get() as $time)
                                                                            <?php $stzt=0; 
                                                                $idxxt=[];
                                                                 $idst=[];
                                                                $statt=0;
                                                                $n1t=null;
                                                                $n2t=null;
                                                                $n3t=null;
                                                                $tzt=array();
                                                                $p1t=null;
                                                                $p2t=null;
                                                                $p3t=null;
                                                                $c1t=null;
                                                                $nmt=null;
                                                                $tidt=null;
                                                                 ?>
                                                                @foreach($firstTees as $tee)
                                                                <?php 
                                                                // if (!empty($firstTees)) {
                                                                //  array_push($idxxt,$tee->time_id);
                                                                // }
                                                                if($time->id==$tee->time_id){
                                                                $p1t=$tee->player1;
                                                                $p2t=$tee->player2;
                                                                $p3t=$tee->player3;
                                                                $c1t=$tee->client_id;
                                                                $tidt=$tee->id;    
                                                                  }     ?>
                                                                @endforeach
                                                                    <tr>
                                                                        <td>{{$count++}}</td>
                                                                        <td>{{$time->name}}</td>
                                                                <td>
                                                                 <?php //array_push($ids,$tee->client_id);  ?>
                                                                            <?php $nmt=DB::table('clients')->where('id',$c1t)->first();
                                                                             if(!is_null($nmt)){
                                                                            echo (ucwords((strtolower($nmt->firstName))." ".(strtolower($nmt->middleName))." ".(strtolower($nmt->lastName)))."<br>");
                                                                            }
                                                                            if(is_null($p1t)){
                                                                            $statt=1;
                                                                            }
                                                                            elseif(is_null($p2t)){
                                                                            $statt=2;
                                                                            $n1t=DB::table('clients')->where('id',$p1t)->first();
                                                                            echo (ucwords((strtolower($n1t->firstName))." ".(strtolower($n1t->middleName))." ".(strtolower($n1t->lastName)))."<br>");
                                                                            // array_push($ids,$tee->player1);
                                                                        }
                                                                            elseif(is_null($p3t)){
                                                                            $statt=3;
                                                                            $n1t=DB::table('clients')->where('id',$p1t)->first();
                                                                            $n2t=DB::table('clients')->where('id',$p2t)->first();
                                                                            echo (ucwords((strtolower($n1t->firstName))." ".(strtolower($n1t->middleName))." ".(strtolower($n1t->lastName)))."<br>".
                                                                                ucwords((strtolower($n2t->firstName))." ".(strtolower($n2t->middleName))." ".(strtolower($n2t->lastName)))."<br>");
                                                                            // array_push($ids,$tee->player1,$tee->player2);
                                                                        }
                                                                            else{
                                                                                $statt=4;
                                                                                $n1t=DB::table('clients')->where('id',$p1t)->first();
                                                                                $n2t=DB::table('clients')->where('id',$p2t)->first();
                                                                                $n3t=DB::table('clients')->where('id',$p3t)->first();
                                                                            echo (ucwords((strtolower($n1t->firstName))." ".(strtolower($n1t->middleName))." ".(strtolower($n1t->lastName)))."<br>".
                                                                                ucwords((strtolower($n2t->firstName))." ".(strtolower($n2t->middleName))." ".(strtolower($n2t->lastName)))."<br>".
                                                                                ucwords((strtolower($n3t->firstName))." ".(strtolower($n3t->middleName))." ".(strtolower($n3t->lastName)))."<br>");
                                                                            // array_push($ids,$tee->player1,$tee->player2,$tee->player3);
                                                                            }
                                                                            ?>
                                                                </td>
                                                                                                   
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <div class="col-sm-6" style="display:none">
                                                        <p style="float:right;font-size:20px;">10th Tee</p>
                                                        <table class="table table-bordered table-striped">
                                                            <thead>
                                                                <tr><th>#</th>
                                                                    <th>Time</th>
                                                                    <th>Players</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                            <?php $count=1;?>
                                                            @foreach($tenthTees as $tee)
                                                                <tr>
                                                                    <td>{{$count++}}</td>
                                                                    <td>{{$tee->time->name}}</td>
                                                                    <td>{{$tee->client->firstName}} {{$tee->client->middleName}} {{$tee->client->lastName}}
                                                                            <br>{{DB::table('clients')->where('id',$tee->player1)->value('firstName')}} {{DB::table('clients')->where('id',$tee->player1)->value('middleName')}}
                                                                            <br>{{DB::table('clients')->where('id',$tee->player2)->value('firstName')}} {{DB::table('clients')->where('id',$tee->player2)->value('middleName')}}
                                                                            <br>{{DB::table('clients')->where('id',$tee->player3)->value('firstName')}} {{DB::table('clients')->where('id',$tee->player3)->value('middleName')}}</td>              
                                                                </tr>
                                                            @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>


                                            </div>
                                            
                                        </div>
                                        <!-- /.modal-content -->
                                        </div>
                                        <!-- /.modal-dialog -->
                                    </div>

                            </div>
                        </div>
                    </div>
                    <!-- /.card -->
                    </div>
                </div>
            </div>
          <!-- /.row -->
 

        </section>



        <script>
          function printDiv(divName){
              var printContents = document.getElementById('divName').innerHTML;
              var originalContents = document.body.innerHTML;

              document.body.innerHTML = printContents;

              window.print();

              document.body.innerHTML = originalContents;

           }

           function printDiv2(divName){
              var printContents = document.getElementById('divName2').innerHTML;
              var originalContents = document.body.innerHTML;

              document.body.innerHTML = printContents;

              window.print();

              document.body.innerHTML = originalContents;

           }


            function closeModal(){
                location.reload(true);  
            }

            function goBack(){
              window.history.back();
            }
        </script>

        <script type="text/javascript">
//         function allowNumbersOnly(e) {
//     var code = (e.which) ? e.which : e.keyCode;
//     if (code > 31 && (code < 48 || code > 57)) {
//         e.preventDefault();
//     }
// }
//       if(window.addEventListener){
//   window.addEventListener('load', function(){
//     $("body").addClass('sidebar-collapse');   
//     });
// }
function continueReschedule(id){
    var clntId=$("#rescheduleClntId"+id).val();
    var gameId=$("#rescheduleGameId"+id).val();
    if(clntId.length<=0 ){
      $("#rescheduleErrorP"+id).show();
      }else{

   var path = clntId+"/"+gameId;
        $("#rescheduleErrorP"+id).hide();
        var fullName=$("#rescheduleClntId"+id+" :selected").text();
              $("#rescheduleStep1"+id).hide();
              $("#rescheduleStep2"+id).show();
              $("#rescheduleError1"+id).hide();

            // var names="<b>"+fullName+"</b>";
            document.getElementById('rescheduleClientIdz'+id).value=clntId;
            $("#rnames"+id).text(fullName); 

      }
}
function continueRemove(id){
    var clntId=$("#removeClntId"+id).val();
    var gameId=$("#removeGameId"+id).val();
    if(clntId.length<=0 ){
      $("#removeErrorP"+id).show();
      }else{

   var path = clntId+"/"+gameId;
        $("#removeErrorP"+id).hide();
        var fullName=$("#removeClntId"+id+" :selected").text();
              $("#removeStep1"+id).hide();
              $("#removeStep2"+id).show();
              $("#removeError1"+id).hide();

            var names="<b>"+fullName+"</b>";
            document.getElementById('removeClientIdz'+id).value=clntId;
            $("#removeStm"+id).append(names); 

      }
}
         function continueTo(id){
    var clntId=$("#clntId"+id).val();
    var gameId=$("#gameId"+id).val();
    // alert(clntId.length);
    if(clntId.length<=0 ){
     $("#error1"+id).hide();
      $("#errorP"+id).show();
      }
      else{
        var path = clntId+"/"+gameId;
        $("#errorP"+id).hide();
           $.ajax({
            url:"https://booking.machakosgolfclub.com/mgc/public/adminBooking/"+path,
            type:'GET',
            data:'_token=<?php echo csrf_token() ;?>',
            success:function(data){

             if(data.success=='1'){
              $("#step1"+id).hide();
              $("#step2"+id).show();
              $("#error1"+id).hide();

                // var newName=$("#name").val();
                 var idz=data.id;
                var names="<b>"+data.firstName+" "+data.middleName+" "+data.lastName+"</b>";
                document.getElementById('clientIdz'+id).value=idz;
                $("#stm"+id).append(names);       

                } else if(data.success=='0'){
                $("#error1"+id).show();  
                }   
            }
        });
        //save template and retrieve the id
       
      }
    
  }
  </script>

    </div>
    @endsection
