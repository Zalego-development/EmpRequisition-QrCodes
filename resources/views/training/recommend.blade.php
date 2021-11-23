@extends('layouts.employee')
@section('content')
  <script src='tinymce/js/tinymce/tinymce.min.js'></script>
  <script>tinymce.init({selector:'textarea'});</script>
<?php
use App\Gsms;
use Illuminate\Support\Str;
?>
   <?php
function humanTiming ($time)
{

    $time = time() - $time; // to get the time since that moment
    $time = ($time<1)? 1 : $time;
    $tokens = array (
        31536000 => 'year',
        2592000 => 'month',
        604800 => 'week',
        86400 => 'day',
        3600 => 'hour',
        60 => 'minute',
        1 => 'second'
    );

    foreach ($tokens as $unit => $text) {
        if ($time < $unit) continue;
        $numberOfUnits = floor($time / $unit);
        return $numberOfUnits.' '.$text.(($numberOfUnits>1)?'s':'');
    }

}
?> 
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                            <h1 class="m-0 text-muted ml-2 mt-4"><strong> Training Need Analysis</strong></h1>
            <ol class="breadcrumb float-sm-left ml-2">
              <li class="breadcrumb-item"><a href="{{url('/home')}}"><i class="fa fa-home"></i></a></li>
              <li class="breadcrumb-item active"><a href="#">Trainings</a></li>
              <li class="breadcrumb-item active"> Training Need Analysis</li>
            </ol>
                        <!-- <h1 class="m-0 text-dark">
                            <a href="#"><span class="badge bg-pink badge-pill float-left"> <i class="nav-icon fa fa-comments-o"></i>My Training Requests </i></a></span>
                        </h1> -->

                        <div  class="float-right">
                            <a href="{{url('/recommendTraining')}}"><button class="btn btn-sm btn-warning">
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
                                <div class="col-md-12 text-left mb-4">
                                   
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" 
                                            data-target="#addNewMessage">
                                        <i class="fa fa-plus"></i> New training need analysis
                                    </button>

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
                                <div class="card card-default">
                                    <div class="card-header" data-card-widget="collapse">
                                        <h3 class="card-title">Recommended Trainings</h3>
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                <i class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body">
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
                                                    <th>Training Title</th>
                                                    <th>Request Status</th>
                                                    <th>Attendees</th>
                                                    <th>Sent On</th>
                                                    <th>Action</th>
                                                    
                                                </tr>
                                                </thead>
                                                <tbody>
                                               @if(isset($trainings))
                                                @foreach($trainings as $key=>$train)
                                                   <tr>
                                                         <td>{{++$key}}</td>
                                                        <td><a class="dropdown-item" data-toggle="modal" data-target="#scheduledInt{{$train->id}}" href="#">{{$train->title}}</a></td>
                                                        <td>
                                                            @if ($train->status == 'pending')
                                                                <span class="badge badge-warning">{{$train->status}}</span>
                                                                @elseif ($train->status == 'revoked')
                                                                <span class="badge badge-danger">{{$train->status}}</span>
                                                            @else
                                                                <span class="badge badge-success">{{$train->status}}</span>
                                                            @endif
                                                        </td>
                                                        <td><a class="dropdown-item" data-toggle="modal" data-target="#infoTraining{{$train->id}}" href="#"> <?php echo(count(json_decode($train->attendees)));?></a></td>
                                                        <td>{{humanTiming(strtotime($train->created_at))}} ago</td>
                                                        <td style="cursor:pointer;">
                                                        <center>
                                                          <div class="dropdown"><i class="fas fa-ellipsis-v" id="dropdownMenu" data-toggle="dropdown" ></i>
                                                             <div class="dropdown-menu" > 
                                                                @if ($train->status == 'pending')
                                                             <a class="dropdown-item" data-toggle="modal" data-target="#editTraining{{$train->id}}" href="#"><i class="fas fa-pencil-alt" ></i> Edit</a>
                                                            <a class="dropdown-item" href="{{url('deleteRecommendedTraining/'.$train->id)}}" onclick="return confirm('You are about to delete this training analysis, Continue?');"><i class="fas fa-trash" ></i> Delete</a>
                                                            @else
                                                             <a class="dropdown-item" data-toggle="modal" data-target="#replyTraining{{$train->id}}" href="#"><i class="fas fa-eye" ></i> View Reply</a>
                                                            @endif
                                                            <a class="dropdown-item" data-toggle="modal" data-target="#infoTraining{{$train->id}}" href="#"><i class="fas fa-info" ></i> View Attendees</a>
                                                            <a class="dropdown-item" data-toggle="modal" data-target="#scheduledInt{{$train->id}}" href="#"><i class="fa fa-eye" ></i> View Training Details</a>
                                                              </div>
                                                          </div>
                                                      </center>
                                                      </td>

                                                   </tr>
                                                @endforeach
                                               @endif
                                                </tbody>
                                                <!-- <tfoot>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Subject</th>
                                                    <th>Request Status</th>
                                                    <th>Attendees</th>
                                                    <th>Sent On</th>
                                                    <th>Action</th>
                                                    
                                                </tr>
                                                </tfoot> -->
                                            </table>
                                           
                                        </div>
                                    </div>
                                    <!-- /.card-body -->

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
  <div class="modal fade" id="infoTraining{{$train->id}}">
              <div class="modal-dialog">
                <div class="modal-content">
                          <div class="modal-header">
                            <h4 class="text-muted"><strong><i class=" fas fa-file"></i> Attendees</strong>
                            </h4>
                            <i class="fas fa-window-close float-right fa-2x mt-3 mr-3 text-muted" data-dismiss="modal" style="cursor:pointer;"></i>
                          </div>
                          <div class="card-body px-2 modalCardBody">
                              <?php $attendees=json_decode($train->attendees);
                    $count=1;
                    $name='';
                    for ($i=0; $i < count($attendees); $i++) { 
                        $name=App\Employee::where('id',$attendees[$i])->first();
                        if($name){
                        echo ($count++.'. <img src="'.$name->profile.'" width="43px" height="43px" class="rounded-circle shadow-lg"> '.$name->firstname." ".$name->lastname." ".$name->surname."<br><br>");
                    }
                    }
                    ?>                
               </div>

               <center style="margin-top: -17px;" class="mb-3">
        
                <button class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
               </center>
            </div>
            </div>
        </div>
<!-- </div> -->
  <div class="modal fade" id="editTraining{{$train->id}}">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Training</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                       <form method="post" action="{{url('/recommendTraining/edit')}}" id="form">
                            @csrf
                            <input type="hidden" name="id" value="{{$train->id}}">
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label class="col-form-label" for="title">Training Title</label>
                                    <input type="text" class="form-control is-valid" id="title" name="title" required value="{{$train->title}}">
                                </div>
                                <div class="form-group col-md-12">
                                    <label class="col-form-label" for="trainer">Preferred trainer / Training Institute</label>
                                    <input type="text" class="form-control is-valid" id="trainer" name="trainer" required value="{{$train->trainer}}">
                                </div>
                                <div class="form-group col-md-12">
                                    <label class="col-form-label" for="location">About the training</label>
                                    <textarea title="Specify more about the training..." rows="10" class="form-control"  name="about">{!!$train->message!!}</textarea>
                                </div>
                                <div class="form-group col-md-12">
                                    <label class="col-form-label" for="location">The impact of this training on your performance</label>
                                    <textarea title="Specify more about the impact of this training training..." rows="10" class="form-control"  name="impact">{!!$train->impact!!}</textarea>
                                </div>
                                <br>
                                    @if(count($depts)>0)                         
                             <div class="form-group col-md-12">
                                    <label for="group_id" style="margin-bottom:20px;">Recommend emloyees to attend with</label>
                                    <div class="row">
                                        <?php $attendees=json_decode($train->attendees);
                                        ?>
                                    @foreach($depts as $dept)
                                   
                                    <div class="form-group col-sm-3">
                                         <?php
                                            if (in_array($dept->id,$attendees)) {
                                                $st="checked";
                                                }else{
                                                    $st="";
                                            }
                                    ?>
                                    <label><input type="checkbox" name="employees[]" id="employees" value="{{$dept->id}}" <?php echo$st; ?>>&nbsp;{{$dept->firstname}} {{$dept->lastname}} {{$dept->surname}}</label>
                                    </div>
                                    @endforeach
                                    </div>
                                </div>
                                @endif
                    </div><div>
                                <center>
                                    <label><input type="checkbox" onclick="checkAll()" class="checkAll"> Check All</label>
                                    </center></div>
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

        <div class="modal fade" id="replyTraining{{$train->id}}">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Reply to recommended training</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                       @if($train->reply==null)
                       <center>Training has no reply yet</center>
                       @else
                       {!!$train->reply!!}
                       @endif
                    </div>
                </div>
            </div>
        </div>
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
                           <i class="fas fa-check-double text-info">Preferred trainer / Training Institute</i> 
                          </strong>
                          <br>
                          <strong class="ml-1">{{$train->trainer}} </strong>
                          <br>
                          <strong>
                           <i class="fas fa-check-double text-info">About the training<br></i> 
                          </strong>
                          <strong class="ml-1">{!!$train->message!!} </strong>
                          <br>
                          <strong>
                           <i class="fas fa-check-double text-info">Impact of this training on your performance<br></i> 
                          </strong>
                          <strong class="ml-1">{!!$train->impact!!} </strong>
                          <br>
                          <small class="text-muted"><i class="fas fa-clock"></i> Created on: {{\Carbon\Carbon::parse($train->created_at)->format('d-M-Y')}} Status: <i class="text-info">{{$train->status}}</i></small><br>
                          
                     </div>
                      </div>
                      </a>

                    <hr>
                   
                  </div>
                  </div>
                </div>
              </div>
<!-- </div> -->
                                                @endforeach
                                        @endif
                                    <!--View Sms Modal-->


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
                        <form method="post" action="{{url('/recommendTraining/add')}}" id="form">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label class="col-form-label" for="title">Training Title</label>
                                    <input type="text" class="form-control is-valid" id="title" name="title" required
                                           placeholder="Training Title">
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="col-form-label" for="trainer">Preferred trainer / Training Institute</label>
                                    <input type="text" class="form-control is-valid" id="trainer" name="trainer" required
                                           placeholder="Preferred trainer / Training Institute">
                                </div>
                                <div class="form-group col-md-12">
                                    <label class="col-form-label" for="location">About the training</label>
                                    <textarea title="Specify more about the training..." rows="10" class="form-control"  name="about"></textarea>
                                </div>
                                <div class="form-group col-md-12">
                                    <label class="col-form-label" for="location">The impact of this training on your performance</label>
                                    <textarea title="Specify more about the impact of this training training..." rows="10" class="form-control"  name="impact"></textarea>
                                </div>
                                <br>
                                    @if(count($depts)>0)                         
                             <div class="form-group col-md-12">
                                    <label for="group_id" style="margin-bottom:20px;">Recommend emloyees to attend with</label>
                                    <div class="row">
                                    @foreach($depts as $dept)
                                    <div class="form-group col-sm-3">
                                    <label><input type="checkbox" name="employees[]" id="employees" value="{{$dept->id}}">&nbsp;{{$dept->firstname}} {{$dept->lastname}} {{$dept->surname}}
                                    </label>
                                    </div>
                                    @endforeach
                                    </div>
                                </div>
                                @endif
                    </div><div>
                                <center>
                                    <label><input type="checkbox" onclick="checkAll()" class="checkAll"> Check All</label>
                                    </center></div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-warning" data-dismiss="modal">
                                    <i class="fa fa-times"></i>
                                    Close
                                </button>
                                <button type="submit" class="btn btn-primary" id="ajaxSubmit">
                                    <i class="fa fa-send"></i>
                                    Save
                                </button>
                            </div>
                        </form>
                </div>
            </div>
        </div></div>
        <!-- End Add Client Modal -->

      

    </div>
    <script type="text/javascript">
  function checkAll(){
   $(".checkAll").change(function (e) {
  $('input[name="employees[]"]').not(this).prop('checked', this.checked);
});
}
        
      </script>
@endsection
