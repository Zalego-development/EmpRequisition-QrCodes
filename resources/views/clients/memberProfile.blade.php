@extends('layouts.profile')
@section('title','Profile | Machakos Golf Club')
<style type="text/css">
@media (max-width: 767px) {
    #about{
        display:none !important;
    }
}</style>
@section('content')
    <div class="content-wrapper">
        <div class="container-fluid">
            <div class="content-header">
                <div class="row mb-2">
                    <div class="col-sm-6">
                       <h2 class="m-0 text-muted ml-2 mt-4"><strong>Member Profile </strong></h2>
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
        </div>
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
            <div class="container-fluid">
                <div class="row flex-column-reverse flex-md-row">
                    <div class="col-md-3">
                         <div class="card card-widget widget-user-2 card-success card-outline">
      <!-- Add the bg color to the header using any of the bg-* classes -->
      <div class="widget-user-header bg-default">
        <div class="widget-user-image">
                        <!-- <div class="card card-orange card-outline">
                            <div class="card-body box-profile"> -->
                                <div class="text-center">
                                    <img class="profile-user-img img-fluid img-circle"
                                         src="{{asset('/profile/pic.png')}}"
                                         alt="User">
                                         

                                </div>
                                </div>
                                <h3 class="profile-username text-center">{{$client->firstName}} {{$client->middleName}} {{$client->lastName}}</h3>
                                <p class="text-center">{{$client->club}}</p>
                                <p class="text-center">
                                    <a href="#" class="btn btn-link" data-toggle="modal" data-target="#clientImage">
                                        Update
                                    </a>
                                </p> 
                                </div>
                                      <div class="card-footer p-0">
        <ul class="nav flex-column">
            <li class="nav-item">
            <a  href="#showMore" class="nav-link text-center" onclick="$('#showMore').slideToggle();" style="color:#007bff !important;">
              View More Details <span class="fa fa-plus text-success">
          </span>
            </a>
          </li>
          <div id="showMore" style="display:none">
          <li class="nav-item">
            <a  href="#" class="nav-link" data-toggle="modal" data-target="#bookedGames" style="color:#007bff !important;">
              Booked Games <span class="float-right badge bg-success">@if(isset($tees))
              {{count($tees)}}
              @endif
          </span>
            </a>
          </li>

          <li class="nav-item">
            <a  href="#" class="nav-link" data-toggle="modal" data-target="#playedGames" style="color:#007bff !important;">
              Played Games 
              <span class="float-right badge bg-primary">
                @if(isset($playedtees))
              {{count($playedtees)}}
              @endif
                </span>
            </a>
          </li>

          <li class="nav-item">
            <a  href="#" class="nav-link" data-toggle="modal" data-target="#upcomingGames" style="color:#007bff !important;">
              Upcoming Games <span class="float-right badge bg-orange" style="color:#fff !important;">@if(isset($games))
              {{count($games)}}
              @endif</span>
            </a>
          </li>



          <li class="nav-item">
            <a  href="#" class="nav-link" data-toggle="modal" data-target="#sendEmail" style="color:#007bff !important;">
              Mails Box <span class="float-right badge bg-teal">
                 @if(isset($emails))
              {{count($emails)}}
              @endif
              </span>
            </a>
          </li>

          <li class="nav-item">
            <a  href="#" class="nav-link" data-toggle="modal" data-target="#sendMessage" style="color:#007bff !important;">
              SMS Box <span class="float-right badge bg-info">
                 @if(isset($sms))
              {{count($sms)}}
              @endif
              </span>
            </a>
          </li>
   <li class="nav-item">
            <a  href="{{url('/gameList/'.$globalId.'/'.$clientId)}}" class="nav-link" style="color:#007bff !important;">
              Game List 
            </a>
          </li>
          </div>
        </ul>
      </div>   
                            </div>
                        <div class="card card-success" id="about">
                            <div class="card-header">
                                <h3 class="card-title"><i class="fa fa-user"></i> About {{$client->firstName}}.</h3>
                            </div>
                            <div class="card-body">
                                <strong><i class="fa fa-envelope text-info"></i> Email</strong>
                                <p class="text-muted">
                                    {{$client->email}}
                                </p>
                                <hr/>
                                <strong><i class="fa fa-phone text-info"></i> Contact</strong>
                                <p class="text-muted">
                                    {{$client->phone}}
                                </p>
                                <hr/>
                                <strong><i class="fa fa-map-marker mr-1 text-info"></i>Location</strong>
                                <p class="text-muted">
                                    {{$client->location}}
                                </p>
                                <hr/>
                                <strong><i class="fa fa-anchor text-info"></i> Profession</strong>
                                <p class="text-muted">
                                    {{$client->workPlace}}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9" id="xxx">
                        <div class="card card-success card-tabs">
                            <div class="card-header p-0 pt-0">
                                <ul class="nav nav-pills">
                                
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#bookGame" data-toggle="tab">Book A Game</a>
                                    </li>

                                 <!--    <li class="nav-item">
                                        <a class="nav-link" href="#invoice" data-toggle="tab" style="color:blue !important">Booked Games</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#invoice" data-toggle="tab" style="color:blue !important">Played Games</a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" href="#test" data-toggle="tab" style="color:blue !important">Upcoming Games</a>
                                    </li>
                                    
                                    <li class="nav-item">
                                        <a class="nav-link" href="#sendEmail" data-toggle="tab" style="color:blue !important">Mails box</a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" href="#sendMessage" data-toggle="tab" style="color:blue !important">Sms box</a>
                                    </li> -->

                                    <li class="nav-item">
                                        <a class="nav-link" href="#company" data-toggle="tab">Business Profile</a>
                                    </li>
                                   
                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="active tab-pane" id="bookGame">
                                       @if(isset($bookGame))
                                      
                                            <div class="card-body pt-0"> 
                                            

                                                <div class="row">
                                                    <div class="col-sm-7">
                                                        <h2 class="lead"><b>{{$bookGame->tournament}}</b></h2>
                                                        <p class="text-muted text-sm"><b>Description: </b> {!!$bookGame->description!!}</p>
                                                        <ul class="ml-4 mb-0 fa-ul text-muted">
                                                            <li class=""><span class="fa-li"><i class="fa fa-lg fa-comment"></i></span>Email: info@machakosgolfclub.com</li>
                                                            <li class=""><span class="fa-li"><i class="fa fa-lg fa-phone"></i></span> Phone #: +254 735 939 715</li>
                                                            <li class=""><span class="fa-li"><i class="fa fa-lg fa-clock-o"></i></span> Scheduled On: {{$bookGame->date_time}}</li>
                                                        </ul>
                                                         <!-- <p class="text-muted text-sm" style="padding-top:10px;"><b>Available Slots: </b></p>
                                                        <ul class="ml-4 mb-0 fa-ul text-muted">
                                                            <li class=""><span class="fa-li"><i class="fa fa-lg fa-golf-ball"></i></span> 1st Tee: <b>{{count($times1)}}</b></li>
                                                            <li class=""><span class="fa-li"><i class="fa fa-lg fa-golf-ball"></i></span> 10th Tee: <b>{{count($times2)}}</b></li>
                                                        </ul> -->
                                                    </div>
                                                    <div class="col-sm-5 text-center">
                                                      <?php
                                                        $external_link="https://booking.machakosgolfclub.com/mgc/public/".$bookGame->image;
                                                        if (!@getimagesize($external_link)) {
                                                          $external_link="http://165.22.0.57/mgc/public/".$bookGame->image;
                                                        }                
                                                     ?>
                                                      <img src="{{$external_link}}" style="max-width:200px; max-height:200px;">
                                                        <!-- <img src="http://165.22.0.57/mgc/public/{{$bookGame->image}}" style="max-width:200px; max-height:200px;"> -->
                                                        <!--  height="100" width="200" -->
                                                    </div>
                                                </div>

                                                <label style="padding-top:10px;">Book Game</label><br>
                                                

                                                <a href="{{url('/gameList/'.$globalId.'/'.$clientId)}}" class="btn btn-block btn-success">
                                                    <i class="fa fa-plus fa-lg"></i> Book now
                                                </a>


                                                <div class="modal fade" id="firstTee{{$bookGame->id}}">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content modal-lg">
                                                            <div class="modal-header">
                                                                <h3 class="modal-title">Place Your 1st Tee</h3>
                                                                <button class="close" type="button" data-dismiss="modal" aria-label="close">
                                                                    <span aria-hidden="true">X</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form class="form-horizontal" action="{{url('viewGame/add')}}" method="post">
                                                                    @csrf
                                                                    <div class="row">
                                                                        <div class="form-group col-md-6">
                                                                            <label for="client_id" class="col-form-label">Name</label>
                                                                            <select name="client_id" class="form-control select2" data-placeholder="Select Player" data-dropdown-css-class="select2-success" style="width: 100%;">
                                                                                
                                                                            
                                                                                    <option value="{{$member->id}}">{{$member->firstName}} {{$member->middleName}} {{$member->lastName}}</option>
                                                                                
                                                                                </optgroup>
                                                                            </select>
                                                                        </div>
                                                                        <div class="col-md-6 form-group">
                                                                            <label for="tee_id" class="col-form-label">Tee</label>
                                                                            <select name="tee_id" class="form-control select2" data-placeholder="Select Tee" data-dropdown-css-class="select2-success" style="width: 100%;">
                                                                                <optgroup label="Tee">
                                                                                        @if(!empty($firstTee->id))
                                                                                        <option value="{{$firstTee->id}}">{{$firstTee->tee}}</option>
                                                                                        @endif
                                                                                </optgroup>
                                                                            </select>
                                                                        </div>

                                                                        <div class="col-md-6 form-group">
                                                                            <label for="game_id" class="col-form-label">Tournament</label>
                                                                            <select name="game_id" class="form-control">
                                                                                <option value="{{$bookGame->id}}">{{$bookGame->tournament}}</option>
                                                                            </select>
                                                                        </div>

                                                                        <div class="form-group col-md-6">
                                                                            <label for="time_id" class="col-form-label">Time</label>
                                                                            <select name="time_id" class="form-control select2" id="time_id" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                                                                <optgroup label="Time">
                                                                                    @foreach($times1 as $time)
                                                                                        <option value="{{$time->id}}">{{$time->name}}</option>
                                                                                        @endforeach
                                                                                </optgroup>
                                                                            </select>
                                                                        </div>

                                                                        <div class="form-group col-md-6" style="display:none;">
                                                                            <label for="club_id" class="col-form-label">Club</label>
                                                                            <select name="club_id" class="form-control select2" data-placeholder="Select Club" data-dropdown-css-class="select2-success" style="width: 100%;">
                                                                                @forelse($clubs as $club)
                                                                                <option value="{{$club->id}}">{{$club->clubName}}</option>
                                                                                @empty
                                                                                <option value="">select Club</option>
                                                                                @endforelse
                                                                            </select>
                                                                        </div>


                                                                        <div class="form-group col-md-6">
                                                                            <label for="club_id" class="col-form-label">Club</label>
                                                                            <select name="club" class="form-control select2" data-placeholder="Select Club" data-dropdown-css-class="select2-success" style="width: 100%;" required>
                                                                                <option value="{{$member->club}}">{{$member->club}}</option>
                                                                            </select>
                                                                        </div>



                                                                        <div class="form-group col-md-6">
                                                                            <label for="name" class="col-form-label">First Player</label>
                                                                            <input type="text" class="form-control" id="player1" name="player1">

                                                                            
                                                                        </div>
                                                                        
                                                                        <div class="form-group col-md-6">
                                                                            <label for="name" class="col-form-label">Second Player</label>
                                                                            <input type="text" class="form-control" id="player2" name="player2">
                                                                            
                                                                        </div>
                                                                        
                                                                        <div class="form-group col-md-6" style="display:none;">
                                                                            <label for="name" class="col-form-label">Phonenumber</label>
                                                                            <input type="text" class="form-control" id="phone" name="phone" value="{{$member->phone}}">
                                                                            
                                                                        </div>
                                                                        
                                                                        
                                                                        <div class="form-group col-md-6">
                                                                            <label for="name" class="col-form-label">Third Player</label>
                                                                            <input type="text" class="form-control" id="player1" name="player3">
                                                                            
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">
                                                                            <i class="fa fa-close"></i> Close
                                                                        </button>
                                                                        <button type="submit" class="bt btn-primary btn-sm">
                                                                            <i class="fa fa-save"></i> Book Game
                                                                        </button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="modal fade" id="tenTee{{$bookGame->id}}">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content modal-lg">
                                                            <div class="modal-header">
                                                                <h3 class="modal-title">Place Your 10th Tee</h3>
                                                                <button class="close" type="button" data-dismiss="modal" aria-label="close">
                                                                    <span aria-hidden="true">X</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form class="form-horizontal" action="{{url('viewGame/add')}}" method="post">
                                                                    @csrf
                                                                    <div class="row">
                                                                        <div class="form-group col-md-6">
                                                                            <label for="client_id" class="col-form-label">Name</label>
                                                                            <select name="client_id" class="form-control select2" data-placeholder="Select Player" data-dropdown-css-class="select2-success" style="width: 100%;">
                                                                                
                                                                            
                                                                                    <option value="{{$member->id}}">{{$member->firstName}} {{$member->middleName}} {{$member->lastName}}</option>
                                                                                
                                                                                </optgroup>
                                                                            </select>
                                                                        </div>
                                                                        <div class="col-md-6 form-group">
                                                                            <label for="tee_id" class="col-form-label">Tee</label>
                                                                            <select name="tee_id" class="form-control select2" data-placeholder="Select Tee" data-dropdown-css-class="select2-success" style="width: 100%;">
                                                                                <optgroup label="Tee">
                                                                                
                                                                                    @if(!empty($tenthTee->id))
                                                                                        <option value="{{$tenthTee->id}}">{{$tenthTee->tee}}</option>
                                                                                        @endif
                                                                                    
                                                                                </optgroup>
                                                                            </select>
                                                                        </div>
                                                                        <div class="col-md-6 form-group">
                                                                            <label for="game_id" class="col-form-label">Tournament</label>
                                                                            <select name="game_id" class="form-control">
                                                                                <option value="{{$bookGame->id}}">{{$bookGame->tournament}}</option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="form-group col-md-6">
                                                                            <label for="time_id" class="col-form-label">Time</label>
                                                                            <select name="time_id" class="form-control select2" id="time_id" data-dropdown-css-class="select2-danger" style="width: 100%;">
                                                                                <optgroup label="Time">
                                                                                    @foreach($times2 as $time)
                                                                                        <option value="{{$time->id}}">{{$time->name}}</option>
                                                                                        @endforeach
                                                                                </optgroup>
                                                                            </select>
                                                                        </div>

                                                                        <div class="form-group col-md-6" style="display:none;">
                                                                            <label for="club_id" class="col-form-label">Club</label>
                                                                            <select name="club_id" class="form-control select2" data-placeholder="Select Club" data-dropdown-css-class="select2-success" style="width: 100%;">
                                                                                @forelse($clubs as $club)
                                                                                <option value="{{$club->id}}">{{$club->clubName}}</option>
                                                                                @empty
                                                                                <option value="">select Club</option>
                                                                                @endforelse
                                                                            </select>
                                                                        </div>


                                                                        <div class="form-group col-md-6">
                                                                            <label for="club_id" class="col-form-label">Club</label>
                                                                            <select name="club" class="form-control select2" data-placeholder="Select Club" data-dropdown-css-class="select2-success" style="width: 100%;" required>
                                                                                <option value="{{$member->club}}">{{$member->club}}</option>
                                                                            </select>
                                                                        </div>



                                                                        <div class="form-group col-md-6">
                                                                            <label for="name" class="col-form-label">First Player</label>
                                                                            <input type="text" class="form-control" id="player1" name="player1">

                                                                            
                                                                        </div>
                                                                        
                                                                        <div class="form-group col-md-6">
                                                                            <label for="name" class="col-form-label">Second Player</label>
                                                                            <input type="text" class="form-control" id="player2" name="player2">
                                                                            
                                                                        </div>
                                                                        
                                                                        <div class="form-group col-md-6" style="display:none;">
                                                                            <label for="name" class="col-form-label">Phonenumber</label>
                                                                            <input type="text" class="form-control" id="phone" name="phone" value="{{$member->phone}}">
                                                                            
                                                                        </div>
                                                                        
                                                                        
                                                                        <div class="form-group col-md-6">
                                                                            <label for="name" class="col-form-label">Third Player</label>
                                                                            <input type="text" class="form-control" id="player1" name="player3">
                                                                            
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">
                                                                            <i class="fa fa-close"></i> Close
                                                                        </button>
                                                                        <button type="submit" class="bt btn-primary btn-sm">
                                                                            <i class="fa fa-save"></i> Book Game
                                                                        </button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                            </div>
                                      
                                       @endif
                                    </div>

                                    <div class="tab-pane" id="update">
                                        <form method="post" action='{{url("/member/{$client->id}")}}' class="form-horizontal">
                                            @csrf
                                            @method('patch')
                                            <div class="form-group row">
                                                <label class="col-form-label col-sm-2" for="firstName">First Name</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="name" class="form-control" value="{{$client->firstName}}" id="firstName" readonly>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="middleName" class="col-form-label col-sm-2">Middle Name</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="middleName" class="form-control" value="{{$client->middleName}}" id="middleName" readonly>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-form-label col-sm-2" for="lastName">Last Name</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="lastName" id="lastName" class="form-control" value="{{$client->lastName}}" readonly>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="phone" class="col-form-label col-sm-2">Contact</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="phone" class="form-control" value="{{$client->phone}}" id="phone">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="email" class="col-form-label col-sm-2">Email</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="email" class="form-control" value="{{$client->email}}" id="email">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-form-label col-sm-2" for="location">Location</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="location" id="location" class="form-control" value="{{$client->location}}" readonly>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="workPlace" class="col-form-label col-sm-2">Profession</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="workPlace" id="workPlace" class="form-control" value="{{$client->workPlace}}">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="group_id" class="col-form-label col-sm-2">Group</label>
                                                <div class="col-sm-10">
                                                    <select name="group_id" class="form-control" id="group_id">
                                                        <option value="{{$client->group->id}}">{{$client->group->name}}</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-12 text-right">
                                                    <button class="btn btn-success btn-sm" type="submit">
                                                        <i class="fa fa-edit"></i>Update
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>


                                    <div class="tab-pane" id="company">
                                       @if(isset($profile))
                                        <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#myProfileUpdate" style="float:right;">
                                            <i class="fa fa-edit">Update Business Profile</i> 
                                        </button>
                                        
                                       @else
                                        <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#myProfile">
                                            <i class="fa fa-plus">Add Business Profile</i> 
                                        </button>

                                       @endif
                                       <br>
                                        <table class="table table-bordered">
                                          @if(isset($profile))
                                           <tbody>
                                              <tr>
                                                 <td>Company Name</td>
                                                 <td>{{$profile->companyName}}</td>
                                              </tr>

                                              <tr>
                                                 <td>Company Location</td>
                                                 <td>{{$profile->companyLocation}}</td>
                                              </tr>

                                              <tr>
                                                 <td>Company Website Link</td>
                                                 <td>{{$profile->companyWebsite}}</td>
                                              </tr>

                                              <tr>
                                                 <td>Company Facebook Link</td>
                                                 <td>{{$profile->companyFacebook}}</td>
                                              </tr>

                                              <tr>
                                                 <td>Company Instagram Link</td>
                                                 <td>{{$profile->companyInstagram}}</td>
                                              </tr>

                                              <tr>
                                                 <td>Company Youtube Link</td>
                                                 <td>{{$profile->companyYoutube}}</td>
                                              </tr>

                                              <tr>
                                                 <td>Brief Information about the company</td>
                                                 <td><?php echo$profile->companyDesc?></td>
                                              </tr>
                                              

                                           </tbody>
                                           @else
                                           <tbody>
                                             <tr>
                                                 <td colspan="2">
                                                   <center>No record found</center>
                                                 </td>
                                             </tr>
                                           </tbody>
                                           @endif
                                        </table>

                                    </div>
                                    <div class="modal fade" id="bookedGames">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content modal-lg">
                                                            <div class="modal-header">
                                                                <h3 class="modal-title">Booked Games</h3>
                                                                <button class="close" type="button" data-dismiss="modal" aria-label="close">
                                                                    <span aria-hidden="true">X</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                    <div class=" tab-pane" id="invoice">
                                        <div class="card card-success collapsed-card">
                                            <div class="card-header">
                                                <h3 class="card-title">Toggle</h3>

                                                <div class="card-tools">
                                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fa fa-plus" style="color:#fff"></i>
                                                    </button>
                                                </div>
                                                <!-- /.card-tools -->
                                            </div>
                                            <!-- /.card-header -->
                                            <div class="card-body">
                                              <table class="table  table-bordered" id="example8">
                                                <thead>
                                                  <tr>
                                                     <th>Game</th>
                                                     <th>Tee</th>
                                                     <th>Other Players</th>
                                                  </tr>
                                                </thead>
                                                <tbody>
                                                   @if(isset($tees))
                                                   @foreach($tees as $tee)
                                                   <tr>
                                                         <td>{{$tee->tournament}}</td>
                                                        <td><?php 
                                                        if (($tee->tee_id)==1) {
                                                            echo "1st Tee";
                                                        }
                                                        else{
                                                            echo "10th Tee";
                                                        }
                                                        ?></td>
                                                        <td>
                                                          <li>{{DB::table('clients')->where('id',$tee->player1)->value('firstName')}}</li>
                                                            <li>{{DB::table('clients')->where('id',$tee->player2)->value('firstName')}}</li>
                                                            <li>{{DB::table('clients')->where('id',$tee->player3)->value('firstName')}}</li>
                                                        </td>
                                                   </tr>
                                                   @endforeach
                                                   @endif
                                                </tbody>
                                              </table>
                                            </div>
                                            <!-- /.card-body -->
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">
                                                                            <i class="fa fa-close"></i> Close
                                                                        </button>
                                                                    </div>
                                    </div>
                                    </div>
                                    </div>
                                    </div>
                                    <div class="modal fade" id="playedGames">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content modal-lg">
                                                            <div class="modal-header">
                                                                <h3 class="modal-title">Played Games</h3>
                                                                <button class="close" type="button" data-dismiss="modal" aria-label="close">
                                                                    <span aria-hidden="true">X</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                    <div class=" tab-pane" id="invoice">
                                        <div class="card card-success collapsed-card">
                                            <div class="card-header">
                                                <h3 class="card-title">Toggle</h3>

                                                <div class="card-tools">
                                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fa fa-plus" style="color:#fff"></i>
                                                    </button>
                                                </div>
                                                <!-- /.card-tools -->
                                            </div>
                                            <!-- /.card-header -->
                                            <div class="card-body">
                                              <table class="table  table-bordered" id="example8">
                                                <thead>
                                                  <tr>
                                                     <th>Game</th>
                                                     <th>Tee</th>
                                                     <th>Other Players</th>
                                                  </tr>
                                                </thead>
                                                <tbody>
                                                   @if(isset($playedtees))
                                                   @foreach($playedtees as $ptees)
                                                   <tr>
                                                        <td>{{$ptees->tournament}}</td>
                                                        <td><?php 
                                                        if (($ptees->tee_id)==1) {
                                                            echo "1st Tee";
                                                        }
                                                        else{
                                                            echo "10th Tee";
                                                        }
                                                        ?></td>
                                                        <td>
                                                          <li>{{DB::table('clients')->where('id',$ptees->player1)->value('firstName')}}</li>
                                                            <li>{{DB::table('clients')->where('id',$ptees->player2)->value('firstName')}}</li>
                                                            <li>{{DB::table('clients')->where('id',$ptees->player3)->value('firstName')}}</li>
                                                        </td>
                                                   </tr>
                                                   @endforeach
                                                   @endif
                                                </tbody>
                                              </table>
                                            </div>
                                            <!-- /.card-body -->
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">
                                                                            <i class="fa fa-close"></i> Close
                                                                        </button>
                                                                    </div>
                                    </div>
                                    </div>
                                    </div>
                                    </div>


                                    <div class=" tab-pane" id="upComingGame">
                                        <div class="card card-green collapsed-card">
                                            <div class="card-header">
                                                <h3 class="card-title">Toggle</h3>

                                                <div class="card-tools">
                                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fa fa-plus" style="color:black"></i>
                                                    </button>
                                                </div>
                                                <!-- /.card-tools -->
                                            </div>
                                            <!-- /.card-header -->
                                            <div class="card-body">
                                               

                                                <div class="card-body pt-0"> 
                                                @if(isset($games))
                                                    @foreach($games as $game)
                                                        <div class="row">
                                                            <div class="col-sm-7">
                                                                <h2 class="lead"><b>{{$game->tournament}}</b></h2>
                                                                <p class="text-muted text-sm"><b>Description: </b> {!!$game->description!!}</p>
                                                                <ul class="ml-4 mb-0 fa-ul text-muted">
                                                                    <li class=""><span class="fa-li"><i class="fa fa-lg fa-comment"></i></span>Email: info@machakosgolfclub.com</li>
                                                                    <li class=""><span class="fa-li"><i class="fa fa-lg fa-phone"></i></span> Phone #: +254 735 939 715</li>
                                                                    <li class=""><span class="fa-li"><i class="fa fa-lg fa-clock-o"></i></span> Scheduled On: {{$game->date_time}}</li>
                                                                </ul>
                                                            </div>
                                                            <div class="col-sm-5 text-center">
                                                                <img src="{{asset('/'.$game->image)}}" height="150" width="150" class="img-circle img-fluid">
                                                            
                                                            </div>
                                                        </div>
                                                        <br>
                                                    @endforeach
                                                @endif
                                                </div>   


                                            </div>
                                            <!-- /.card-body -->
                                        </div>
                                    </div>
                                        <div class="modal fade" id="sendMessage">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h3 class="modal-title"><i class="fa fa-lg fa-comment"></i> Sent SMS</h3>
                                                                <button class="close" type="button" data-dismiss="modal" aria-label="close">
                                                                    <span aria-hidden="true">X</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                    <div class="tab-pane" id="sendMessage">
                                       
                                        <div class="card direct-chat direct-chat-primary">
                                            <!-- <div class="card-header bg-white">
                                                <h3 class="card-title">Sent SMS</h3>
                                               
                                            </div> -->
                                            <div class="card-body">
                                                <div class="table table-responsive">
                                                  <table class="table table-stripped table-bordered" id="example10">
                                                    <thead>
                                                      <tr>
                                                        <th>#</th>
                                                        <th>Subject</th>
                                                        <th>Message</th>
                                                        <th>Date Sent</th>
                                                        <th>Status</th>
                                                      </tr>
                                                    </thead>
                                                    <tbody>
                                                         @if(isset($sms))
                                                          @foreach($sms as $key=>$message)
                                                              <tr>
                                                                 <td>{{++$key}}</td>
                                                                 <td>{{$message->sms->subject}}</td>
                                                                 <td><?php echo$message->sms->message?></td>
                                                                 <td>{{$message->sms->created_at}}</td>
                                                                 <td>Sent</td>
                                                              </tr>
                                                          @endforeach
                                                         @endif
                                                    </tbody>
                                                  </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">
                                                                            <i class="fa fa-close"></i> Close
                                                                        </button>
                                                                    </div>
                                    </div>
                                    </div>
                                    </div>
                                    </div>
                                     <div class="modal fade" id="sendEmail">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content modal-lg">
                                                            <div class="modal-header">
                                                                <h3 class="modal-title"><i class="fa fa-lg fa-envelope"></i> Sent Email</h3>
                                                                <button class="close" type="button" data-dismiss="modal" aria-label="close">
                                                                    <span aria-hidden="true">X</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">

                                    <div class="tab-pane" id="sendEmail">
                                       
                                        <div class="card direct-chat direct-chat-primary">
                                         <!--    <div class="card-header bg-white">
                                                <h3 class="card-title">Sent Emails</h3>
                                               
                                            </div> -->
                                            <div class="card-body">
                                                <div class="table table-responsive">
                                                  <table class="table table-stripped table-bordered" id="example9">
                                                    <thead class="green white-text">
                                                      <tr>
                                                        <th>#</th>
                                                        <th>Subject</th>
                                                        <th>Message</th>
                                                        <th>Date Sent</th>
                                                        <th>Status</th>
                                                      </tr>
                                                    </thead>
                                                    <tbody>
                                                         @if(isset($emails))
                                                          @foreach($emails as $key=>$message)
                                                              <tr>
                                                                 <td>{{++$key}}</td>
                                                                 <td>{{$message->email->subject}}</td>
                                                                 <td><?php echo$message->email->message?></td>
                                                                 <td>{{$message->email->created_at}}</td>
                                                                 <td>Sent</td>
                                                              </tr>
                                                          @endforeach
                                                         @endif
                                                    </tbody>
                                                  </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">
                                                                            <i class="fa fa-close"></i> Close
                                                                        </button>
                                                                    </div>
                                    </div>
                                    </div>
                                    </div>
                                    </div>

                                    <div class="modal fade" id="upcomingGames">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content modal-lg">
                                                            <div class="modal-header">
                                                                <h3 class="modal-title">Upcoming Games</h3>
                                                                <button class="close" type="button" data-dismiss="modal" aria-label="close">
                                                                    <span aria-hidden="true">X</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">

                                    <div class="tab-pane" id="test">
                                      
                                      

                                        <div id="accordion">
                                        
                                            @if(isset($games))
                                                @foreach($games as $game)
                                            <div class="card card-success">
                                                <div class="card-header">
                                                <h4 class="card-title">
                                                    <div class="card-tools">
                                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo{{$game->id}}">
                                                    {{$game->tournament}}
                                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fa fa-plus" style="color:#fff; right:0;"></i>
                                                    </button>
                                                    </a>
                                                </div>
                                                </h4>
                                                </div>
                                                <div id="collapseTwo{{$game->id}}" class="panel-collapse collapse">
                                                <div class="card-body">
                                                    
                                                        <div class="row">
                                                            <div class="col-sm-7">
                                                                <h2 class="lead"><b>{{$game->tournament}}</b></h2>
                                                                <p class="text-muted text-sm"><b>Description: </b> {!!$game->description!!}</p>
                                                                <ul class="ml-4 mb-0 fa-ul text-muted">
                                                                    <li class=""><span class="fa-li"><i class="fa fa-lg fa-comment"></i></span>Email: info@machakosgolfclub.com</li>
                                                                    <li class=""><span class="fa-li"><i class="fa fa-lg fa-phone"></i></span> Phone #: +254 735 939 715</li>
                                                                    <li class=""><span class="fa-li"><i class="fa fa-lg fa-clock-o"></i></span> Scheduled On: {{$game->date_time}}</li>
                                                                </ul>
                                                            </div>
                                                            <div class="col-sm-5 text-center">
                                                                <img src="{{asset('/'.$game->image)}}" height="150" width="150" >
                                                            
                                                            </div>
                                                        </div>
                                                </div>
                                                </div>
                                            </div>
                                                @endforeach
                                            @endif

                                            
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">
                                                                            <i class="fa fa-close"></i> Close
                                                                        </button>
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
    
    <div class="modal fade" id="clientImage">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h2 class="modal-title"></i>Update Image</h2>
                    <button class="close" type="button" data-dismiss="modal" aria-label="close">
                        <span aria-hidden="true">X</span>
                    </button>
                </div>
                <div class="card-body px-2 modalCardBody">
                    <form class="form-horizontal" action="#" method="">
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="name" class="col-form-label">Choose Profile Pic</label>
                                <input type="file" class="form-control"  name="clientImage">  
                            </div>
                        </div>
                        </div>
                        <center style="margin-top: -17px;" class="mb-3">
                            <button class="btn btn-danger" type="button" data-dismiss="modal">
                                <i class="fa fa-close"></i> Close
                            </button>
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-plus-circle"></i> Update
                            </button>
                        </center>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="companyImage">
        <div class="modal-dialog modal-xs">
            <div class="modal-content">
                <div class="modal-header">
                <h2 class="modal-title"><i class="fa fa-user"></i> Update Image</h2>
                    <button class="close" type="button" data-dismiss="modal" aria-label="close">
                        <span aria-hidden="true">X</span>
                    </button>
                </div>
                <div class="card-body px-2 modalCardBody">
                    <form class="form-horizontal" action="#" method="">
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="name" class="col-form-label">Choose Profile Pic</label>
                                <input type="file" class="form-control"  name="clientImage">  
                            </div>
                        </div>
                        </div>
                        <center style="margin-top: -17px;" class="mb-3">
                            <button class="btn btn-danger" type="button" data-dismiss="modal">
                                <i class="fa fa-close"></i>Close
                            </button>
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-plus-circle"></i>Update
                            </button>
                        </center>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="myProfile">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                <h2 class="modal-title"><i class="fa fa-user"></i> Add Busines Profile</h2>
                    <button class="close" type="button" data-dismiss="modal" aria-label="close">
                        <span aria-hidden="true">X</span>
                    </button>
                </div>
                <div class="card-body px-2 modalCardBody">
                  
                <form method="post" action='{{url("/members/add/Profile")}}' class="form-horizontal" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="form-group row" style="display:none;">
                        <label class="col-form-label col-sm-2" for="firstName">Client Id</label>
                        <div class="col-sm-10">
                            <input type="text" name="client_id" class="form-control" value="{{$client->id}}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-sm-2" for="firstName">Company Name</label>
                        <div class="col-sm-10">
                            <input type="text" name="companyName" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="middleName" class="col-form-label col-sm-2">Company Location</label>
                        <div class="col-sm-10">
                            <input type="text" name="companyLocation" class="form-control" >
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="middleName" class="col-form-label col-sm-2">Company Profile Pic/logo</label>
                        <div class="col-sm-10">
                            <input type="file" name="companyPic" class="form-control" >
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-sm-2" for="lastName">Company Website</label>
                        <div class="col-sm-10">
                            <input type="text" name="companyWebsite"  class="form-control" >
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="phone" class="col-form-label col-sm-2">Company Facebook Link</label>
                        <div class="col-sm-10">
                            <input type="text" name="companyFacebook" class="form-control" >
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-form-label col-sm-2">Company Instagram Link</label>
                        <div class="col-sm-10">
                            <input type="text" name="companyInstagram" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-sm-2" for="location">Company Twitter Link</label>
                        <div class="col-sm-10">
                            <input type="text" name="companyTwiter" id="location" class="form-control" >
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="workPlace" class="col-form-label col-sm-2">Company Youtube Link</label>
                        <div class="col-sm-10">
                            <input type="text" name="companyYoutube"  class="form-control" >
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="group_id" class="col-form-label col-sm-2">Brief information about the company</label>
                        <div class="col-sm-10">
                            <textarea name="companyDesc" class="textarea"></textarea>
                        </div>
                    </div></div>

                    <center style="margin-top: -17px;" class="mb-3">
                        <button class="btn btn-danger" type="button" data-dismiss="modal">
                            <i class="fa fa-close"></i> Close
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-plus-circle"></i> Add
                        </button>
                    </center>
                    
                </form>

                </div>
            </div>
        </div>
    </div>
    
    @if(isset($profile))
    <div class="modal fade" id="myProfileUpdate">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                <h2 class="modal-title"><i class="fa fa-user"></i> Update Busines Profile</h2>
                    <button class="close" type="button" data-dismiss="modal" aria-label="close">
                        <span aria-hidden="true">X</span>
                    </button>
                </div>
                <div class="card-body px-2 modalCardBody">
                  
                <form method="post" action='{{url("/members/updateProfile")}}' class="form-horizontal" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group row" style="display:none;">
                        <label class="col-form-label col-sm-2" for="firstName">Client Id</label>
                        <div class="col-sm-10">
                            <input type="text" name="client_id" class="form-control" value="{{$client->id}}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-sm-2" for="firstName">Company Name</label>
                        <div class="col-sm-10">
                            <input type="text" name="companyName" class="form-control" value="{{$profile->companyName}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="middleName" class="col-form-label col-sm-2">Company Location</label>
                        <div class="col-sm-10">
                            <input type="text" name="companyLocation" class="form-control" value="{{$profile->companyLocation}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-sm-2" for="lastName">Company Website</label>
                        <div class="col-sm-10">
                            <input type="text" name="companyWebsite"  class="form-control" value="{{$profile->companyWebsite}}" >
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="phone" class="col-form-label col-sm-2">Company Facebook Link</label>
                        <div class="col-sm-10">
                            <input type="text" name="companyFacebook" class="form-control" value="{{$profile->companyFacebook}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-form-label col-sm-2">Company Instagram Link</label>
                        <div class="col-sm-10">
                            <input type="text" name="companyInstagram" class="form-control" value="{{$profile->companyInstagram}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-sm-2" for="location">Company Twitter Link</label>
                        <div class="col-sm-10">
                            <input type="text" name="companyTwiter" id="location" class="form-control" value="{{$profile->companyTwiter}}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="workPlace" class="col-form-label col-sm-2">Company Youtube Link</label>
                        <div class="col-sm-10">
                            <input type="text" name="companyYoutube"  class="form-control" value="{{$profile->companyYoutube}}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="group_id" class="col-form-label col-sm-2">Brief information about the company</label>
                        <div class="col-sm-10">
                            <textarea name="companyDesc" class="form-control">{{$profile->companyDesc}}</textarea>
                        </div>
                    </div>


                    <center style="margin-top: -17px;" class="mb-3">
                        <button class="btn btn-danger" type="button" data-dismiss="modal">
                            <i class="fa fa-close"></i> Close
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-plus-circle"></i> Update
                        </button>
                    </center>
                    
                </form>

                </div>
            </div>
        </div>
    </div>
    @endif


    <script>
    $(document).ready(function(){
    document.getElementById('xxx').scrollIntoView()
});
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



@endsection
