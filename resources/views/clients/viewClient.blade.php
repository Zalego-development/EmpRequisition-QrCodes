@extends('layouts.admin')
@section('title','View Client | Machakos Golf Club')
@section('content')

    <div class="content-wrapper">
        <div class="container-fluid">
            <div class="content-header">
                <div class="row mb-2">
                    <div class="col-sm-6">
                       <h2 class="m-0 text-muted ml-2 mt-4"><strong>View Member </strong></h2>
                             <ol class="breadcrumb float-sm-left ml-2">
                              <li class="breadcrumb-item"><a href="{{url('/home')}}">Dashboard</a></li>
                              <li class="breadcrumb-item active">Members</li>
                              <li class="breadcrumb-item active">View Member</li></ol>
                              
                    </div>
                    <div class="col-sm-6">
                        <div class="float-right mt-5">
                          <div class="btn-group btn-group-justified">
                        <a href="{{url('/members')}}" class="btn btn-primary btn-sm"><i class="fa fa-backward"></i> Go Back</a>
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
                <div class="row">
                    <div class="col-md-3">
                        <div class="card card-orange card-outline">
                            <div class="card-body box-profile">
                                <div class="text-center">
                                    <img class="profile-user-img img-fluid img-circle"
                                         src="{{asset('resources/settings/admin.png')}}"
                                         alt="User">
                                </div>
                                <h3 class="profile-username text-center">{{$client->firstName}} {{$client->middleName}} {{$client->lastName}}</h3>
                                <p class="text-center">{{$client->group->name}}</p>
                            </div>
                        </div>
                        <div class="card card-success">
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
                    <div class="col-md-9">
                        <div class="card card-success card-tabs">
                            <div class="card-header p-0 pt-0">
                                <ul class="nav nav-pills">

                                    <li class="nav-item">
                                        <a class="nav-link active" href="#update" data-toggle="tab">Update Member</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#sendMessage" data-toggle="tab">Send Message</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#sendEmail" data-toggle="tab">Send Email</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#invoice" data-toggle="tab">Games Played</a>
                                    </li>
                                  
                                    <li class="nav-item">
                                        <a class="nav-link" href="#games" data-toggle="tab">Sponserd Games</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="active tab-pane" id="update">
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
                                                    <button class="btn btn-primary btn-sm" type="submit">
                                                        <i class="fa fa-edit"></i>Update
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="tab-pane" id="sendMessage">
                                        <form method="post" class="form-horizontal" action="{{url('/sms/addSingleMessage')}}">
                                            @csrf
                            

                                            <div class="form-group" style="display:none;">
                                                <label for="phone" class="col-form-label">Subject</label>
                                                <input type="text" name="subject" class="form-control" id="subject"  >
                                            </div>


                                            <div class="form-group">
                                                <label for="message" class="col-form-label">Message</label>
                                                <textarea class="form-control" placeholder="Place some text here" name="message" required></textarea>
                                            </div>

                                            <div class="form-group" style="display:none;">
                                                <label for="phone" class="col-form-label">Client Id</label>
                                                <input type="text" name="client_id" class="form-control"  value="{{$client->id}}" readonly>
                                            </div>

                                            <div class="form-group" style="display:none;">
                                                <label for="phone" class="col-form-label">Group</label>
                                                <input type="text" name="groups[]" class="form-control"  value="{{$client->group->id}}" required>
                                            </div>


                                            <div class="form-group">
                                                <div class="col-sm-12 text-right">
                                                    <button type="submit" class="btn btn-primary btn-sm">
                                                        <i class="fa fa-send"></i>Send
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                        <div class="card direct-chat direct-chat-primary">
                                            <div class="card-header bg-white">
                                                <h3 class="card-title">Sent SMS</h3>
                                               
                                            </div>
                                            <div class="card-body">
                                                <div class="table table-responsive">
                                                  <table class="table table-stripped table-bordered" id="example1">
                                                    <thead>
                                                      <tr>
                                                        <th>#</th>
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
                                                                 <td><?php echo$message->sms->message?></td>
                                                                 <td>{{$message->sms->created_at}}</td>
                                                                 <?php $sts=DB::table('gsms')->where('sms_id',$message->sms->id)->value('status'); ?>
                                                                 @if(!empty($sts))
                                                                 <td>Failed - {{$sts}}</td>
                                                                 @else
                                                                 <td>Sent</td>
                                                                 @endif
                                                              </tr>
                                                          @endforeach
                                                         @endif
                                                    </tbody>
                                                  </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="tab-pane" id="sendEmail">
                                        <form method="post" class="form-horizontal" action="{{url('/email/addSingleEmail')}}">
                                            @csrf
                            

                                            <div class="form-group">
                                                <label for="phone" class="col-form-label">Subject</label>
                                                <input type="text" name="subject" class="form-control" id="subject"  required>
                                            </div>


                                            <div class="form-group">
                                                <label for="message" class="col-form-label">Message</label>
                                                <textarea class="textarea" placeholder="Place some text here" name="message" required></textarea>
                                            </div>

                                            <div class="form-group" style="display:none;">
                                                <label for="phone" class="col-form-label">Client Id</label>
                                                <input type="text" name="client_id" class="form-control"  value="{{$client->id}}" readonly>
                                            </div>

                                            <div class="form-group" style="display:none;">
                                                <label for="phone" class="col-form-label">Group</label>
                                                <input type="text" name="groups[]" class="form-control"  value="{{$client->group->id}}" required>
                                            </div>


                                            <div class="form-group">
                                                <div class="col-sm-12 text-right">
                                                    <button type="submit" class="btn btn-primary btn-sm">
                                                        <i class="fa fa-send"></i>Send
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                        <div class="card direct-chat direct-chat-primary">
                                            <div class="card-header bg-white">
                                                <h3 class="card-title">Sent Emails</h3>
                                               
                                            </div>
                                            <div class="card-body">
                                                <div class="table table-responsive">
                                                  <table class="table table-stripped table-bordered" id="example3">
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

                                    <div class="tab-pane" id="invoice">
                                      
                                        <div class="card">
                                            <div class="card-header">
                                                <h3 class="card-title">Click Game to view more info</h3>
                                            </div>
                                            <!-- /.card-header -->
                                            <div class="card-body">
                                                <div id="accordion">
                                                  @if(isset($tees))
                                                   @foreach($tees as $tee)
                                                    <div class="card card-success">
                                                        <div class="card-header">
                                                        <h4 class="card-title">
                                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree{{$tee->id}}">
                                                            {{$tee->game->tournament}}
                                                            </a>
                                                        </h4>
                                                        </div>
                                                        <div id="collapseThree{{$tee->id}}" class="panel-collapse collapse">
                                                        <div class="card-body">
                                                        <div class="timeline">
                                                        <div class="time-label">
                                                            <span class="bg-success">Tournament</span>
                                                        </div>
                                                        <div>
                                                            <i class="fa fa-soccer-ball-o bg-success"></i>
                                                            <div class="timeline-item">
                                                                <span class="time">{{$tee->game->date_time}} {{$tee->time->name}}</span>
                                                                <h3 class="timeline-header">{{$tee->game->tournament}}</h3>
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <i class="fa fa-star bg-info"></i>
                                                            <div class="timeline-item">
                                                                <h3 class="timeline-header">{{$tee->tee->tee}}</h3>
                                                            </div>
                                                        </div>
                                                        
                                                        <div>
                                                            <i class="fa fa-users bg-purple"></i>
                                                            <div class="timeline-item">
                                                                <h3 class="timeline-header">
                                                                    {{DB::table('clients')->where('id',$tee->client_id)->value('firstName')}}<br>
                                                                    {{DB::table('clients')->where('id',$tee->player1)->value('firstName')}}<br>
                                                                    {{DB::table('clients')->where('id',$tee->player2)->value('firstName')}}<br>
                                                                    {{DB::table('clients')->where('id',$tee->player3)->value('firstName')}}
                                                                </h3>
                                                            </div>
                                                        </div>
                                                    </div>

                                                        </div>
                                                        </div>
                                                    </div>
                                                   @endforeach
                                                   @endif
                                                </div>
                                            </div>
                                            <!-- /.card-body -->
                                        </div>
                                    </div>

                                    <div class="tab-pane" id="games">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-12 col-12 mb-4">
                                                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#game">
                                                            <i class="fa fa-plus"></i>Add Tournament
                                                        </button>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-12 col-12 mb-4">
                                                       <table class="table table-stripped table-bordered" id="example4">
                                                         <thead>
                                                           <tr >
                                                             <th>#</th>
                                                              <th>Game</th>
                                                              <th>Date Sponserd</th>
                                                              <th>Action</th>
                                                           </tr>
                                                         </thead>
                                                         <tbody>
                                                         @if(isset($sponserdGames))
                                                         @foreach($sponserdGames as $key=>$Sgame)
                                                           <tr>
                                                             <td>{{++$key}}</td>
                                                             <td>{{$Sgame->game->tournament}}</td>
                                                             <td>{{$Sgame->dateSponsered}}</td>
                                                             <td>
                                                                <div class="btn-group">
                                                                    <button type="button" class="btn btn-default btn-sm" id="l1">
                                                                        <i class="fa fa-cog"></i>Action
                                                                    </button>
                                                                    <div class="btn-group text-left">
                                                                        <button type="button" class="btn btn-default dropdown-toggle dropdown-icon" data-toggle="dropdown" id="l1"></button>
                                                                        <div class="dropdown-menu dropdown-menu-right">
                                                                            <a class="dropdown-item" data-toggle="modal" data-target="#editGame{{$Sgame->id}}" id="l1">
                                                                                <i class="fa fa-edit"></i>
                                                                                Edit
                                                                            </a>
                                                                            <a class="dropdown-item" href='{{url("/members/deleteSponsedGame/$Sgame->id")}}'
                                                                                onclick='return confirm("Are you sure you want to delete this record")' id="l1">
                                                                                <i class="fa fa-trash"></i>
                                                                                Delete
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>

                                                           </tr>

                                                                <div class="modal fade" id="editGame{{$Sgame->id}}">
                                                                    <div class="modal-dialog modal-xs">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                            <h2 class="modal-title"><i class="fa fa-user"></i>Add Tournament</h2>
                                                                                <button class="close" type="button" data-dismiss="modal" aria-label="close">
                                                                                    <span aria-hidden="true">X</span>
                                                                                </button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                            <form class="form-horizontal" action="{{url('/members/deleteSponsedGame')}}" method="post">
                                                                                @csrf
                                                                                <div class="row">
                                                                                    <div class="form-group col-md-12">
                                                                                        <label for="group_id">Tournament</label>
                                                                                        <select class="form-control"  data-placeholder="Select Game" data-dropdown-css-class="select2-success" style="width: 100%;" name='game_id' id="groups" required>
                                                                                           @if(isset($Sgame))
                                                                                           <option value="{{$Sgame->game_id}}">{{$Sgame->game->tournament}}</option>
                                                                                           @endif

                                                                                            @if(isset($games))
                                                                                            @foreach($games as $key=>$game)
                                                                                                <option value="{{$game->id}}">{{$game->tournament}}</option>
                                                                                            @endforeach
                                                                                            @endif
                                                                                        </select>
                                                                                    </div>

                                                                                    <div class="form-group col-md-12">
                                                                                        <label for="group_id">Date Sponserd</label>
                                                                                        <input type="date" name="dateSponsered" class="form-control" value="{{$Sgame->dateSponsered}}" required>
                                                                                    </div>

                                                                                    <div class="form-group col-md-12" style="display:none;">
                                                                                        <input type="text" name="client_id" value="{{$Sgame->client->id}}" class="form-control">
                                                                                    </div>


                                                                                    <div class="form-group col-md-12" style="display:none;">
                                                                                    
                                                                                        <input type="text" name="id" value="{{$Sgame->id}}" class="form-control">
                                                                                    </div>
                                                                                

                                                                                </div>

                                                                                <div class="modal-footer">
                                                                                    <button class="btn btn-danger" type="button" data-dismiss="modal">
                                                                                        <i class="fa fa-close"></i>Close
                                                                                    </button>
                                                                                    <button type="submit" class="btn btn-primary">
                                                                                        <i class="fa fa-plus-circle"></i>Update
                                                                                    </button>
                                                                                </div>

                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>



                                                         @endforeach
                                                         @endif
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
                </div>
            </div>
        </section>
    </div>

    <div class="modal fade" id="game">
        <div class="modal-dialog modal-xs">
            <div class="modal-content">
                <div class="modal-header">
                <h2 class="modal-title"><i class="fa fa-user"></i> Add Tournament</h2>
                    <button class="close" type="button" data-dismiss="modal" aria-label="close">
                        <span aria-hidden="true">X</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" action="{{url('/members/addSponsedGame')}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="group_id">Tournament</label>
                                <select class="select2"  data-placeholder="Select Game" data-dropdown-css-class="select2-success" style="width: 100%;" name='game_id' id="groups" required>
                                    @if(isset($games))
                                    @foreach($games as $key=>$game)
                                        <option value="{{$game->id}}">{{$game->tournament}}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>

                            <div class="form-group col-md-12">
                                <label for="group_id">Date Sponserd</label>
                                <input type="date" name="dateSponsered" class="form-control" required>
                            </div>

                            <div class="form-group col-md-12" style="display:none;">
                               
                                <input type="text" name="client_id" value="{{$client->id}}" class="form-control">
                            </div>
                        

                        </div>

                        <div class="modal-footer">
                            <button class="btn btn-danger" type="button" data-dismiss="modal">
                                <i class="fa fa-close"></i>Close
                            </button>
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-plus-circle"></i>Update
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

   
@endsection
