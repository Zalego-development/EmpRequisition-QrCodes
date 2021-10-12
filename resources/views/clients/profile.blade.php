@extends('layouts.master')
@section('title','Profile | Machakos Golf Club')
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
                <a href="{{url('/logout')}}" class="btn btn-primary btn-sm"><i class="fa fa-arrow-left"></i> Logout</a>

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
                        <div class="card card-success card-outline">
                            <div class="card-body box-profile">
                                <div class="text-center">
                                    <img class="profile-user-img img-fluid img-circle"
                                         src="{{asset('/profile/pic.png')}}"
                                         alt="User">
                                         

                                </div>
                                <h3 class="profile-username text-center">{{$client->firstName}} {{$client->middleName}} {{$client->lastName}}</h3>
                                <p class="text-center">{{$client->group->name}}</p>
                                <p class="text-center">
                                    <a href="#" class="btn btn-link" data-toggle="modal" data-target="#clientImage">
                                        Update
                                    </a>
                                </p>    
                            </div>
                        </div>
                        <div class="card card-success">
                            <div class="card-header">
                                <h3 class="card-title"><i class="fa fa-user-o"></i> About {{$client->firstName}}.</h3>
                            </div>
                            <div class="card-body">
                                <strong><i class="fa fa-envelope-o text-info"></i> Email</strong>
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
                                        <a class="nav-link" href="#company" data-toggle="tab">Company Information</a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" href="#invoice" data-toggle="tab">Games Booked</a>
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


                                    <div class="tab-pane" id="company">
                                       @if(empty($profile))
                                        <form method="post" action='{{url("/members/addProfile")}}' class="form-horizontal" enctype="multipart/form-data">
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
                                                    <input type="text" name="companyName" class="form-control" >
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="middleName" class="col-form-label col-sm-2">Company Location</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="companyLocation" class="form-control" >
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="middleName" class="col-form-label col-sm-2">Company Profile Pic</label>
                                                <div class="col-sm-10">
                                                    <input type="file" name="companyPic" class="form-control" >
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-form-label col-sm-2" for="lastName">Company Website</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="companyWebsite"  class="form-control"  >
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
                                                <label for="group_id" class="col-form-label col-sm-2">More information about the company</label>
                                                <div class="col-sm-10">
                                                    <textarea name="companyDesc" class="form-control"></textarea>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <div class="col-sm-12 text-right">
                                                    <button class="btn btn-primary btn-sm" type="submit">
                                                        <i class="fa fa-edit"></i>Add
                                                    </button>
                                                </div>
                                            </div>

                                           
                                        </form>
                                       @else
                                        
                                        <form method="post" action='{{url("/members/updateProfile")}}' class="form-horizontal">
                                            @csrf
                                           
                                            <div class="form-group row">
                                                <label class="col-form-label col-sm-8" for="firstName">Company Image</label>
                                                <div class="col-sm-4">
                                                   <img src="{{asset('/'.$profile->companyPic)}}" style="width:50%">
                                                </div>
                                            </div>

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
                                                <label for="group_id" class="col-form-label col-sm-2">More information about the company</label>
                                                <div class="col-sm-10">
                                                    <textarea name="companyDesc" class="form-control">{{$profile->companyDesc}}</textarea>
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
                                       @endif
                                    </div>

                                   
                                    
                                    <div class="tab-pane" id="invoice">
                                        <div class="card">
                                            <div class="card-body">
                                                @foreach($tees as $tee)
                                                    <div class="timeline">
                                                        <div class="time-label">
                                                            <span class="bg-success">Tournament</span>
                                                        </div>
                                                        <div>
                                                            <i class="fa fa-soccer-ball-o bg-success"></i>
                                                            <div class="timeline-item">
                                                                <span class="time"><i class="fa fa-clock-o"></i>{{$tee->time->name}}</span>
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
                                                            <i class="fa fa-phone bg-pink"></i>
                                                            <div class="timeline-item">
                                                                <h3 class="timeline-header">{{$tee->phone}}</h3>
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <i class="fa fa-users bg-purple"></i>
                                                            <div class="timeline-item">
                                                                <h3 class="timeline-header">
                                                                    {{$tee->player1}}
                                                                    {{$tee->player2}}
                                                                    {{$tee->player3}}
                                                                </h3>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
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
        <div class="modal-dialog modal-xs">
            <div class="modal-content">
                <div class="modal-header">
                <h2 class="modal-title"><span class="badge badge-info badge-pill"><i class="fa fa-user"></i>Update Image</span></h2>
                    <button class="close" type="button" data-dismiss="modal" aria-label="close">
                        <span aria-hidden="true">X</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" action="#" method="">
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="name" class="col-form-label">Choose Profile Pic</label>
                                <input type="file" class="form-control"  name="clientImage">  
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

    <div class="modal fade" id="companyImage">
        <div class="modal-dialog modal-xs">
            <div class="modal-content">
                <div class="modal-header">
                <h2 class="modal-title"><span class="badge badge-info badge-pill"><i class="fa fa-user"></i>Update Image</span></h2>
                    <button class="close" type="button" data-dismiss="modal" aria-label="close">
                        <span aria-hidden="true">X</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" action="#" method="">
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="name" class="col-form-label">Choose Profile Pic</label>
                                <input type="file" class="form-control"  name="clientImage">  
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



@endsection
