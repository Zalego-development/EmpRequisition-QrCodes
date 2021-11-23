@extends('layouts.profile')
@section('title','All Games| Machakos Golf Club')
<style type="text/css">
#btnlink{
  background: none!important;
  border: none;
  padding: 0!important;
  font-family: arial, sans-serif;
  color: #347bff;
  cursor: pointer;
  margin: -10px;
}
#btnlink:hover{
  background: none!important;
  box-shadow: none;
}
</style>
@section('content')

    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h2 class="m-0 text-muted ml-2 mt-4"><strong> Upcoming Games </strong></h2>
                      <ol class="breadcrumb float-sm-left ml-2">
                              <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                              <li class="breadcrumb-item active">Upcoming Games</li>
                            </ol>
                    </div>
                 <div class="col-sm-6">
                          <div class="float-right mt-5">
                          <div class="btn-group btn-group-justified">
                            <a href="{{url('/members/login')}}" class="btn btn-primary btn-sm"><i class="fa fa-power-off"></i> Log Out</a>&nbsp;
                </div>
                </div>
                </div>        
                </div>
            </div>
        </section>

        <section class="content">            
            <div class="row">
            @forelse(\App\Game::whereDate('date_time', '>=',\Carbon\Carbon::now()->format('Y-m-d'))->get() as $bookGame)
             <div class="col-md-4" id="profModal">
              <div class="card" style="border-color: transparent !important; box-shadow: none !important;-webkit-box-shadow: 0 1rem 3rem rgba(102, 102, 153, 0.175) !important;
              box-shadow: 0 1rem 3rem rgba(102, 102, 153, 0.175) !important;">
              <div class="card-body box-profile" style="padding: 0 !important;">
                 <?php
                    $external_link="https://booking.machakosgolfclub.com/mgc/public/".$bookGame->image;
                    if (!@getimagesize($external_link)) {
                      $external_link="http://165.22.0.57/mgc/public/".$bookGame->image;
                    }                
                 ?>
                <div class="text-center image-holder" style="height: 140px; background-image: url({{$external_link}}); background-position: cover; background-size: cover; background-repeat: no-repeat; ">
                 <div id="overlay">
                     <div  class="shadow-lg bg-success" style="margin-top: 115px ; left: 40%; position: absolute; width:50px; height: 50px; border-radius:  50%; color: #fff;">
                            <center>
                              <a href="{{url('/gameList/'.$bookGame->id.'/'.$clientId)}}">
                              <i style="cursor: pointer;" onClick="submit();" class="fas fa-plus-circle fa-4x" id="prt" title="Click to book"></i> 
                              </a>
                            <!-- <strong> <h3 style="margin-top: ; color: #fff; font-size:17px;margin: 3px 0 !important;"><i style="cursor: pointer;" onClick="submit();" class="fas fa-plus-circle" id="prt" title="Click to book"></i> Book</h3></strong></a> -->
                          <!-- <h4 style="margin-top: 15px; color: #fff; font-size:17px;" ><strong id="pointerElement"> uyt</strong></h4> -->
                        </center>
                        </div>
                    <!-- <i style="cursor: pointer;margin-top: 65px ; left: 40%; position: absolute;" class="fas fa-plus-circle text-success fa-2x" id="prt" title="Click to book"></i> -->
                    <!-- width="100px" height="100px" style="margin-top: 65px; left: 30%; position: absolute;" -->
                 </div>
                </div>
                               
                <center>
                  <form mathod="get" action="{{url('viewAGame')}}">
                  @csrf
                  <input type="hidden" name="globalId" value="{{$bookGame->id}}">
                  <input type="hidden" name="phone" value="{{DB::table('clients')->where('id',$clientId)->value('phone')}}">
                  <center><button type="submit" id="btnlink" class="btn btn-success"><i class="fa fa-eye"></i> <h6 class="text-center text-muted mt-5"><strong>{{ucwords(strtolower($bookGame->tournament))}}</strong></h6></button></center>
                 </form>
                <p class="text-muted"><strong><i class="fa fa-clock-o text-success"></i></strong> Game day - {{\Carbon\Carbon::parse($bookGame->date_time)->format('d M, Y')}}<br>
                 <?php $days=Carbon\Carbon::parse(\Carbon\Carbon::now())->diffInDays($bookGame->deadline); ?>
                 @if($days<=0)
                 <i class="fa fa-clock-o text-danger"></i> Today is the deadline<br>
                 @elseif($days==1)
                 <i class="fa fa-clock-o text-danger"></i> {{$days}} day to deadline<br>
                 @else
                 <i class="fa fa-clock-o text-danger"></i> {{$days}} days to deadline<br>
                 @endif
                  <i class="fa fa-golf-ball text-success"></i>
                   <?php $times=json_decode($bookGame->time); 
                        $total=count($times)*4;
                  $slotsA=(\App\FirstTee::whereNotNull('client_id')->where('game_id',$bookGame->id)->count())+(\App\FirstTee::whereNotNull('player1')->where('game_id',$bookGame->id)->count())+(\App\FirstTee::whereNotNull('player2')->where('game_id',$bookGame->id)->count())+(\App\FirstTee::whereNotNull('player3')->where('game_id',$bookGame->id)->count());
                  ?>
                  @if($slotsA>120)
                  0 available slots
                  @else
                  {{120-$slotsA}} available slots
                  @endif
                 <!-- diffInDays -->   <br>
                    <i class="fa fa-golf-ball text-danger"></i>
                  {{((\App\FirstTee::whereNotNull('client_id')->where('game_id',$bookGame->id)->count())+(\App\FirstTee::whereNotNull('player1')->where('game_id',$bookGame->id)->count())+(\App\FirstTee::whereNotNull('player2')->where('game_id',$bookGame->id)->count())+(\App\FirstTee::whereNotNull('player3')->where('game_id',$bookGame->id)->count()))}} booked slots
                 <!-- diffInDays --> <br><br>            
                 <a href="{{url('/gameList/'.$bookGame->id.'/'.$clientId)}}" style="width:95% !important;" class="btn btn-block btn-success">
                    <i class="fa fa-plus fa-lg"></i> Book now
                </a>
                </p>
                </center>
              </div>
            </div>
          </div>
          @empty
          <div class="col-md-12">
            <center><strong><i class="fas fa-info"></i> No upcoming games available, Please come back later</strong></center>
          </div>
          @endforelse
        </div>
      </section>
    </div>
    @endsection
