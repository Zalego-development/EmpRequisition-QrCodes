@extends('layouts.profile')
@section('title','Game List| Machakos Golf Club')
<style type="text/css">
@media (max-width: 767px) {
    #gmz{
        display:none !important;
    }
}</style>
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h2 class="m-0 text-muted ml-2 mt-2"><strong> Game List </strong></h2>
                      <ol class="breadcrumb float-sm-left ml-2">
                              <!-- <li class="breadcrumb-item"><a href="{{url('/home')}}">Dashboard</a></li> -->
                              <!-- <li class="breadcrumb-item active">Game List</li> -->
                            </ol>
                    </div>
                    <div class="col-sm-6">
                          <div class="float-right mt-5">
                          <div class="btn-group btn-group-justified">
                                    <button type="button" class="btn btn-primary" onClick="printDiv()">
                                             <i class="fa fa-print"></i>  Print
                                            </button>
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
                                                
                                                <div class="card-body" id="divName">
                                                   <div class="row mb-4">
                                                         <div class="col-sm-6">
                                                            <center>
                                                  <img src="{{asset('image/macha.png')}}" class="img-fluid">
                                                            <p style="font-size:17px">
                                                                <b>Game</b>:&nbsp;{{$game->tournament}}
                                                                &nbsp; &nbsp;
                                                                <b>Scheduled On</b>:&nbsp;{{$game->date_time}}&nbsp; &nbsp;
                                                                @if(!empty($bTime))
                                                                <br>
                                                                 <b>Booked for</b>:&nbsp; @if($bTime->tee_id==1)
                                                                 1st Tee - {{$bTime->name}}&nbsp; &nbsp;
                                                                 @else
                                                                 10th Tee - {{$bTime->name}}&nbsp; &nbsp;
                                                                @endif
                                                                @endif
                                                                <b>Bookings</b>:&nbsp;<?php 
                                                                    $today=date('Y-m-d');
                                                                    $date=$game->deadline;
                                                                ?>
                                                                @if($date>=$today)
                                                                <span class="text-success"> Ongoing</span>
                                                                @else
                                                                <span class="text-success"> Closed</span>
                                                                @endif
                                                            </p>    </center>                                                        
                                                         </div>
                                                         <div class="col-sm-6" id="gmz">

                                                  <center><img src="{{asset('/'.$game->image)}}" height="180" width="200"></center>
                                                         </div>

                                                   </div>
                                                    <div class="row">
                                                        <div class="col-sm-12 mb-4">
                                                        <!-- <p style="float:left;font-size:20px;"></p> -->
                                                            <table class="table table-bordered table-striped" id="example8">
                                                                <thead>
                                                                    <tr>
                                                                        <th>1st Tee</th>
                                                                        <th>Time</th>
                                                                        <th>Players</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                <?php $countt=1; ?>

                                                                @foreach(\App\Time::all() as $time)
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
                                                                if (!empty($firstTees)) {
                                                                 array_push($idxxt,$tee->time_id);
                                                                }
                                                                if($time->id==$tee->time_id){
                                                                $p1t=$tee->player1;
                                                                $p2t=$tee->player2;
                                                                $p3t=$tee->player3;
                                                                $c1t=$tee->client_id;
                                                                $tidt=$tee->id;    
                                                                  }     ?>
                                                                @endforeach
                                                                <?php $idst=[$p1t,$p2t,$p3t,$c1t]; ?>
                                                                    <tr>
                                                                        <td>{{$countt++}}</td>
                                                                        <td>{{$time->name}}</td>
                                                            

                                                                
                                                                @if (in_array($time->id, $idxxt))
                                                                <td>
                                                                 <?php //array_push($ids,$tee->client_id);  ?>

                                                                            <?php $nmt=DB::table('clients')->where('id',$c1t)->first();
                                                                             if(!is_null($nmt)){
                                                                                $statt=1;
                                                                                echo ("<li>".ucwords((strtolower($nmt->firstName))." ".(strtolower($nmt->middleName))." ".(strtolower($nmt->lastName)))."</li>");
                                                                            // echo ((strtolower($nmt->firstName))." ".(strtolower($nmt->middleName))." ".(strtolower($nmt->lastName))."</li></ul>");
                                                                            }
                                                                             if(!is_null($p1t)){
                                                                                $statt=2;
                                                                                $n1t=DB::table('clients')->where('id',$p1t)->first();
                                                                                echo ("<li>".ucwords((strtolower($n1t->firstName))." ".(strtolower($n1t->middleName))." ".(strtolower($n1t->lastName)))."</li>");
                                                                            }
                                                                             if(!is_null($p2t)){
                                                                                $statt=3;
                                                                                $n2t=DB::table('clients')->where('id',$p2t)->first();
                                                                                echo ("<li>".ucwords((strtolower($n2t->firstName))." ".(strtolower($n2t->middleName))." ".(strtolower($n2t->lastName)))."</li>");
                                                                            }
                                                                              if(!is_null($p3t)){
                                                                                $statt=4;
                                                                                $n3t=DB::table('clients')->where('id',$p3t)->first();
                                                                                echo ("<li>".ucwords((strtolower($n3t->firstName))." ".(strtolower($n3t->middleName))." ".(strtolower($n3t->lastName)))."</li>");
                                                                            }
                                                                             
                                                                        
                                                                            ?>
                                                                            </ul>
                                                                            @if($date>=$today)
                                                                            @if ((DB::table('first_tees')->where('game_id',$globalId)->where('client_id',$clientId)->orWhere('player1',$clientId)->orWhere('player2',$clientId)->orWhere('player3',$clientId)->count())<=0)
                                                                            @if(in_array(null, $idst, true))
                                                                            <i style="cursor: pointer;" onclick="showEditzBooking('<?php echo $time->id; ?>')" class="fas fa-plus-circle text-success float-right mt-1" id="prt" title="Click to book"></i>
                                                                            <div class="form-group mt-4 text-center" style="display: none;" id="bookingz{{$time->id}}">
                                                                                <form class="form-horizontal" action="{{url('viewGame/addz')}}" method="post"> 
                                                                                @csrf                           
                                                                                <input type="hidden" name="client_id" value="{{$clientId}}">
                                                                                <input type="hidden" name="tee_id" value="1">
                                                                                <input type="hidden" name="game_id" value="{{$globalId}}">
                                                                                <input type="hidden" name="time_id" value="{{$time->id}}">
                                                                                <input type="hidden" name="stat" value="{{$statt}}">
                                                                                <input type="hidden" name="teeIdz" value="{{$tidt}}">
                                                                                <button class="btn btn-success text-center" type="submit" style="cursor: pointer;">Confirm Booking <i class="fas fa-check"></i></button>
                                                                                </form>
                                                                            </div>
                                                                            @endif
                                                                            @else
                                                                            @if (in_array($clientId, $idst))
                                                                            <i style="cursor: pointer;" onclick="showDelete1Booking('<?php echo $time->id; ?>')" class="fas fa-minus-circle text-danger float-right mt-1" title="Click to cancel"></i>
                                                                            <div class="form-group mt-4 text-center" style="display: none;" id="cancellx{{$time->id}}">
                                                                                <form class="form-horizontal" action="{{url('viewGame/remove')}}" method="post"> 
                                                                                @csrf                           
                                                                                <input type="hidden" name="client_id" value="{{$clientId}}">
                                                                                <!-- <input type="hidden" name="game_id" value="{{$globalId}}"> -->
                                                                                <!-- <input type="hidden" name="time_id" value="{{$time->id}}"> -->
                                                                                <input type="hidden" name="teeIdz" value="{{$tidt}}">
                                                                                <button class="btn btn-danger text-center" type="submit" style="cursor: pointer;">Confirm Cancelation </button>
                                                                                </form>
                                                                            </div>
                                                                            @endif
                                                                            @endif
                                                                            @endif
                                                                </td>
                                                                @else
                                                                <td>
                                                                    @if($date>=$today)
                                                                    @if ((DB::table('first_tees')->where('game_id',$globalId)->where('client_id',$clientId)->orWhere('player1',$clientId)->orWhere('player2',$clientId)->orWhere('player3',$clientId)->count())<=0)
                                                                       <i style="cursor: pointer;" onclick="firstEditBooking('<?php echo $time->id; ?>')" class="fas fa-plus-circle text-success float-right mt-1" id="prt" title="Click to book"></i>
                                                                            <div class="form-group mt-4 text-center" style="display: none;" id="firstBooking{{$time->id}}">
                                                                                <form class="form-horizontal" action="{{url('viewGame/addz')}}" method="post"> 
                                                                                @csrf                           
                                                                                <input type="hidden" name="client_id" value="{{$clientId}}">
                                                                                <input type="hidden" name="tee_id" value="1">
                                                                                <input type="hidden" name="game_id" value="{{$globalId}}">
                                                                                <input type="hidden" name="time_id" value="{{$time->id}}">
                                                                                <input type="hidden" name="stat" value="10">
                                                                                <input type="hidden" name="new" value="10">
                                                                                <button class="btn btn-success text-center" type="submit" style="cursor: pointer;">Confirm Booking <i class="fas fa-check"></i></button>
                                                                                </form>
                                                                            </div> 
                                                                    @else
                                                                    @if (in_array($clientId, $idst))
                                                                    <?php /* <i style="cursor: pointer;" onclick="showDeleteBooking('<?php echo $time->id; ?>')" class="fas fa-minus-circle text-danger float-right mt-1" title="Click to cancel"></i>
                                                                            <div class="form-group mt-4 text-center" style="display: none;" id="cancell{{$time->id}}">
                                                                                <form class="form-horizontal" action="{{url('viewGame/remove')}}" method="post"> 
                                                                                @csrf                           
                                                                                <input type="hidden" name="client_id" value="{{$clientId}}">
                                                                                <!-- <input type="hidden" name="game_id" value="{{$globalId}}"> -->
                                                                                <!-- <input type="hidden" name="time_id" value="{{$time->id}}"> -->
                                                                                <input type="hidden" name="teeIdz" value="{{$tidt}}">
                                                                                <button class="btn btn-danger text-center" type="submit" style="cursor: pointer;">Confirm Cancelation </button>
                                                                                </form>
                                                                            </div>*/?>
                                                                    @endif
                                                                    @endif
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                                @endif
                                                                @endforeach

                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <div class="col-sm-6 mb-4" style="display:none">
                                                            <table class="table table-bordered table-striped" id="example">
                                                                <thead>
                                                                    <tr><th>10th Tee</th>
                                                                        <th>Time</th>
                                                                        <th>Players</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                <?php $count=1;?>
                                                                
                                                                @foreach(\App\Time::all() as $timet)
                                                                <?php $stz=0; 
                                                                $idxx=[];
                                                                 $ids=[];
                                                                $stat=0;
                                                                $n1=null;
                                                                $n2=null;
                                                                $n3=null;
                                                                $tz=array();
                                                                $p1=null;
                                                                $p2=null;
                                                                $p3=null;
                                                                $c1=null;
                                                                $nm=null;
                                                                $tid=null;
                                                                 ?>
                                                                @foreach($tenthTees as $tez)
                                                                <?php if (!empty($tenthTees)) {
                                                                array_push($idxx,$tez->time_id);
                                                            }
                                                                if($timet->id==$tez->time_id){
                                                                $p1=$tez->player1;
                                                                $p2=$tez->player2;
                                                                $p3=$tez->player3;
                                                                $c1=$tez->client_id;
                                                                $tid=$tez->id;    
                                                                  }     ?>
                                                                @endforeach
                                                                    <tr>
                                                                        <td>{{$count++}}</td>
                                                                        <td>{{$timet->name}}</td>
                                                            

                                                                
                                                                @if (in_array($timet->id, $idxx))
                                                                <td>
                                                                  
                                                                 <?php //array_push($ids,$tee->client_id);  ?>
                                                                            <?php $nm=DB::table('clients')->where('id',$c1)->first();
                                                                            echo ($c1);
                                                                            //(strtolower($nm->firstName))." ".(strtolower($nm->middleName))." ".(strtolower($nm->lastName))."<br>");
                                                                            ?>
                                                                            <?php if(is_null($p1)){
                                                                            $stat=1;
                                                                            }
                                                                            elseif(is_null($p2)){
                                                                            $stat=2;
                                                                            $n1=DB::table('clients')->where('id',$p1)->first();
                                                                            echo ((strtolower($n1->firstName))." ".(strtolower($n1->middleName))." ".(strtolower($n1->lastName))."<br>");
                                                                            // array_push($ids,$tee->player1);
                                                                        }
                                                                            elseif(is_null($p3)){
                                                                            $stat=3;
                                                                            $n1=DB::table('clients')->where('id',$p1)->first();
                                                                            $n2=DB::table('clients')->where('id',$p2)->first();
                                                                            echo ((strtolower($n1->firstName))." ".(strtolower($n1->middleName))." ".(strtolower($n1->lastName))."<br>".
                                                                                (strtolower($n2->firstName))." ".(strtolower($n2->middleName))." ".(strtolower($n2->lastName))."<br>");
                                                                            // array_push($ids,$tee->player1,$tee->player2);
                                                                        }
                                                                            else{
                                                                                $stat=4;
                                                                                $n1=DB::table('clients')->where('id',$p1)->first();
                                                                                $n2=DB::table('clients')->where('id',$p2)->first();
                                                                                $n3=DB::table('clients')->where('id',$p3)->first();
                                                                            echo ((strtolower($n1->firstName))." ".(strtolower($n1->middleName))." ".(strtolower($n1->lastName))."<br>".
                                                                                (strtolower($n2->firstName))." ".(strtolower($n2->middleName))." ".(strtolower($n2->lastName))."<br>".
                                                                                (strtolower($n3->firstName))." ".(strtolower($n3->middleName))." ".(strtolower($n3->lastName))."<br>");
                                                                            // array_push($ids,$tee->player1,$tee->player2,$tee->player3);
                                                                            }
                                                                            ?>
                                                                            @if($date>=$today)
                                                                            @if ((DB::table('first_tees')->where('game_id',$globalId)->where('client_id',$clientId)->orWhere('player1',$clientId)->orWhere('player2',$clientId)->orWhere('player3',$clientId)->count())<=0)
                                                                            @if($stat==1||$stat==2||$stat==3)
                                                                            <i style="cursor: pointer;" onclick="showEditBooking('<?php echo $timet->id; ?>')" class="fas fa-plus-circle text-success float-right mt-1" title="Click to book"></i>
                                                                            <div class="form-group mt-4 text-center" style="display: none;" id="booking{{$timet->id}}">
                                                                                <form class="form-horizontal" action="{{url('viewGame/addz')}}" method="post"> 
                                                                                @csrf                           
                                                                                <input type="hidden" name="client_id" value="{{$clientId}}">
                                                                                <input type="hidden" name="tee_id" value="2">
                                                                                <input type="hidden" name="game_id" value="{{$globalId}}">
                                                                                <input type="hidden" name="time_id" value="{{$timet->id}}">
                                                                                <input type="hidden" name="stat" value="{{$stat}}">
                                                                                <input type="hidden" name="teeIdz" value="{{$tid}}">
                                                                                <button class="btn btn-success text-center" type="submit" style="cursor: pointer;">Confirm Booking <i class="fas fa-check"></i></button>
                                                                                </form>
                                                                            </div>
                                                                            @endif
                                                                            @endif
                                                                            @endif
                                                                </td>
                                                                @else
                                                                <td>
                                                                    @if($date>=$today)
                                                                    @if ((DB::table('first_tees')->where('game_id',$globalId)->where('client_id',$clientId)->orWhere('player1',$clientId)->orWhere('player2',$clientId)->orWhere('player3',$clientId)->count())<=0)
                                                                       <i style="cursor: pointer;" onclick="firstEditzBooking('<?php echo $timet->id; ?>')" class="fas fa-plus-circle text-success float-right mt-1" title="Click to book"></i>
                                                                            <div class="form-group mt-4 text-center" style="display: none;" id="firstzBooking{{$timet->id}}">
                                                                                <form class="form-horizontal" action="{{url('viewGame/addz')}}" method="post"> 
                                                                                @csrf                           
                                                                                <input type="hidden" name="client_id" value="{{$clientId}}">
                                                                                <input type="hidden" name="tee_id" value="2">
                                                                                <input type="hidden" name="game_id" value="{{$globalId}}">
                                                                                <input type="hidden" name="time_id" value="{{$timet->id}}">
                                                                                <input type="hidden" name="stat" value="0">
                                                                                <button class="btn btn-success text-center" type="submit" style="cursor: pointer;">Confirm Booking <i class="fas fa-check"></i></button>
                                                                                </form>
                                                                            </div> 
                                                                    @endif
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                                @endif
                                                                @endforeach
                                                               
                                                                                                                                
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
                    </div>
                    <!-- /.card -->
                    </div>
                </div>
            </div>
          <!-- /.row -->
 

        </section>
<script type="text/javascript">
//     if(window.addEventListener){
//   window.addEventListener('load', function(){
//     $("body").addClass('sidebar-collapse');   
//     });
// }
 function showEditBooking(id){
$("#booking"+id).slideToggle();
}
 function showEditzBooking(id){
$("#bookingz"+id).slideToggle();
}
 function showResBooking(id){
$("#res"+id).slideToggle();
}
 function showRes1Booking(id){
$("#resx"+id).slideToggle();
}
 function showRezBooking(id){
$("#rez"+id).slideToggle();
}
 function showRezxBooking(id){
$("#rezx"+id).slideToggle();
}
function firstEditBooking(id){
$("#firstBooking"+id).slideToggle();
}
function firstEditzBooking(id){
$("#firstzBooking"+id).slideToggle();
}
 function showDeleteBooking(id){
$("#cancell"+id).slideToggle();
}
 function showDelete1Booking(id){
$("#cancellx"+id).slideToggle();
}
function printDiv(divName){
// $(".dataTables_filter").css("display","none");

$('#example').dataTable({
    "bProcessing": true,
    "sAutoWidth": false,
    "bDestroy":true,
    "sPaginationType": "bootstrap", // full_numbers
    "iDisplayStart ": 10,
    "iDisplayLength": 10,
    "bPaginate": false, //hide pagination
    "bFilter": false, //hide Search bar
    "bInfo": false, // hide showing entries
})
$('#example8').dataTable({
    "bProcessing": true,
    "sAutoWidth": false,
    "bDestroy":true,
    "sPaginationType": "bootstrap", // full_numbers
    "iDisplayStart ": 10,
    "iDisplayLength": 10,
    "bPaginate": false, //hide pagination
    "bFilter": false, //hide Search bar
    "bInfo": false, // hide showing entries
})
$('#prt').hide();

              var printContents = document.getElementById('divName').innerHTML;
              var originalContents = document.body.innerHTML;
              document.body.innerHTML = printContents;

              window.print();

              document.body.innerHTML = originalContents;

              window.location.reload(true);

           }
</script>


    </div>
    @endsection


