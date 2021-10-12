@extends('layouts.main')

@section('content')
 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-left ml-2">
              <li class="breadcrumb-item"><a href="{{url('/home')}}"><i class="fa fa-home"></i></a></li>
              <li class="breadcrumb-item active"><a href="{{url('/home')}}">Home</a></li>
              <li class="breadcrumb-item active">Leave Notifications</li>
            </ol>
          </div><!-- /.col -->
          <div class="col-sm-6" style="display:none;">
            <div class="float-right mt-5">
              <button class="btn btn-sm btn-primary"><i class="fa fa-download"></i> Reports</button>&nbsp<button class="btn btn-sm btn-success"><i class="fa fa-cog"></i> Settings</button>
            </div>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <br>
    <section class="content">
        <div class="container">
          @if(session('authError'))
            <div class="alert alert-danger">
              <a href="#" class="close" data-dismiss="alert">&times</a>
              {{session('authError')}}
            </div>
          @endif

          @if(session('approveSuccess'))
            <div class="alert alert-success">
              <a href="#" class="close" data-dismiss="alert">&times</a>
              {{session('approveSuccess')}}
            </div>
          @endif
          <div class="row">
            <div class="col-sm-3">
              <div class="card">
                <center>
                <img src="{{asset('images/notification.gif')}}" style="margin-top: -1px;" width="150px" height="150px">
                <h6 class="text-muted" style="margin-top: -20px;"><strong>Leave Notifications</strong></h6>
                <div  style="background: #ddd; border:1px solid #ddd; width:50px; height: 50px; border-radius:  50%;">
                <h3 style="margin-top: 7px;">{{count($leaveNotifications)}}</h3>
              </div><br>
                </center>
              </div>
            </div>
            <div class="col-sm-9">
              <div class="card">
                <div class="card-header">
                  <strong>Leave Applications</strong>
                </div>
                <div class="card-body">

                <div class="row" id="unread" style="margin-top: -30px;">
                  <div class="col-sm-2">
                    <br><br><br><br><br>
                    <center>
                    <div  style="background: #ddd; border:1px solid #ddd; width:50px; height: 50px; border-radius:  50%;">
                     
                      <h3 style="margin-top: 7px;">{{count($leaveNotifications)}}</h3>
                    
                    </div>
                    </center>
                  </div>
                  <div class="col-sm-10"><br><br>
                      <table class="table table-striped">
                        @if(count($leaveNotifications)>0)
                          @foreach($leaveNotifications as $lT)
                            @if($lT->status==0)
                            <tr>
                              <td>
                                {{$lT->notification}}<br>
                                  <span class="float-left mt-2" style="font-size:12px; cursor: pointer;"><span class="text-warning"><i class="fas fa-times"></i> Pending</span>&nbsp&nbsp<a href="{{url('/approveLeave/'.$lT->linkIndex.'/'.Auth::user()->id)}}"><span class="text-success"><i class="fas fa-check"></i> Approve Leave</span></a>
                                  </span>
                                  <span class="text-gray float-right" style="font-size:11px;"><i class="fas fa-clock"></i> {{$lT->created_at}}</span>
                              </td>
                            </tr>
                            @endif
                          @endforeach
                        @else
                          <h4 class="text-center">0 unread notifications present</h4>
                        @endif
                      </table>
                  </div>
                </div>
                </div>
             </div>
            </div>
          </div>
        </div>
      </section>
  </div>

@endsection