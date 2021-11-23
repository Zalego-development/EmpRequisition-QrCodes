@extends('layouts.employee')
@section('title','Profile | Zalego')
@section('content')
<style type="text/css">
  #overlay {
  position: relative; /* Sit on top of the page content */
  width: 100%; /* Full width (cover the whole page) */
  height: 100%; /* Full height (cover the whole page) */
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: rgba(82, 82, 122,0.8); /* Black background with opacity */
  z-index: 2; /* Specify a stack order in case you're using a different order for other elements */
  cursor: pointer; /* Add a pointer on hover */
}
.nav-item .nav-link:focus{
  color: #7f8ea2 !important;
}
.nav-item .nav-link.active{
  color: #7f8ea2 !important;
}
.form-control{
  border-color: #dfe3e8 !important;
  padding: 18px !important;
}
#file{
  background-color:white;
  border:1px solid #d4d3d2;
  color: gray;
transition: 0.2s linear;
  padding: 7.5px;
  margin-left: 1px;
  text-align:  center;
  margin-top: 5px;
  border-radius: 3px;
}
#file:hover{
  -webkit-box-shadow: 0 1rem 3rem rgba(102, 102, 153, 0.175) !important;
  box-shadow: 0 1rem 3rem rgba(102, 102, 153, 0.175) !important;
}
input[type="file"]{
  display: none;
}
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">Profile</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{url('/home')}}">Dashboard</a></li>
          <li class="breadcrumb-item active">Profile</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->


<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <!-- Small boxes (Stat box) -->
    <div class="row">

          <div class="col-md-3" id="profModal">

            <!-- Profile Image -->
            <div class="card" style="border-color: transparent !important; box-shadow: none !important;-webkit-box-shadow: 0 1rem 3rem rgba(102, 102, 153, 0.175) !important;
  box-shadow: 0 1rem 3rem rgba(102, 102, 153, 0.175) !important;">
              <div class="card-body box-profile" style="padding: 0 !important;">
                <div class="text-center image-holder" style="height: 120px; background-image: url(<?php echo Auth::user()->image;?>); background-position: cover; background-size: cover; background-repeat: no-repeat; ">
                  <div id="overlay">
                   @if(!empty(Auth::user()->image))
                    <img class=" rounded-circle"
                         src="{{Auth::user()->image}}"
                         alt="User" width="100px" height="100px" style="margin-top: 65px; left: 30%; position: absolute;">
                   @else
                    <img class=" rounded-circle"
                         src="{{asset('assets/back-end/settings/admin.png')}}"
                         alt="User" width="100px" height="100px" style="margin-top: 65px; left: 30%; position: absolute;">
                   @endif
                 </div>
                </div>
                <br>
            <h6 class="text-center text-muted mt-5"><strong>{{Auth::user()->name}}</strong></h6>
                
                <center>
                <p class="text-muted">

                 <strong><i class="fa fa-mobile-alt text-success"></i></strong> +{{Auth::user()->contact}}<br>
                  <i class="fas fa-envelope text-success"></i> {{Auth::user()->email}}<br>
                                  
                <br>
                </p>
                </center>
              
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- About Me Box -->
            
          </div>


    <div class="col-md-9" id="mainModal">
      

          <div class="col-md-12">
            <div class="card  card-tabs" style="box-shadow: none !important; border-color: transparent !important; box-shadow: none !important;-webkit-box-shadow: 0 1rem 3rem rgba(102, 102, 153, 0.175) !important;
  box-shadow: 0 1rem 3rem rgba(102, 102, 153, 0.175) !important;">
              <div class="card-header theme-purple p-0">
                <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true"><i class="fas fa-file"></i> Edit Profile</a>
                  </li>
                 <!--  <li class="nav-item">
                    <a class="nav-link act" id="custom-tabs-one-home-tab2" data-toggle="pill" href="#custom-tabs-one-home2" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true"><i class="fas fa-user"></i></a>
                  </li> -->
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false"><i class="fas fa-lock"></i> Change Password</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-one-messages-tab" data-toggle="pill" href="#custom-tabs-one-messages" role="tab" aria-controls="custom-tabs-one-messages" aria-selected="false"><i class="fas fa-image"></i> Change Profile Picture</a>
                  </li>

                </ul>
              </div>
              <div class="card-body">
                <div class="tab-content" id="custom-tabs-one-tabContent">
                    <div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">


                <div class="">


                  @if(session('reject'))
                  <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    {{session('reject')}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  @endif


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


                  @if(session('response'))
                  <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{session('response')}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  @endif
                  <!--employee view modals-->
                <form method="post" action="{{url('/updateProfile')}}">
                     @csrf
                    <div >
                  
                      <div class="form-group">
                        <label class="col-form-label" for="firstname"> Name:</label>
                        <input type="text" class="form-control is-valid" id="firstname" name="name"
                               placeholder="First Name" value="{{Auth::user()->name}}" required>
                      </div>

                      <!-- <div class="form-group">
                        <label class="col-form-label" for="lastname"> Last Name:</label>
                        <input type="text" class="form-control is-valid" id="lastname" name="lastname"
                               placeholder="Last Name" value="{{Auth::user()->lastname}}" required>
                      </div>

                      <div class="form-group">
                        <label class="col-form-label" for="surname"> Surname:</label>
                        <input type="text" class="form-control is-valid" id="surname" name="surname"
                               placeholder="Last Name" value="{{Auth::user()->surname}}" required>
                      </div> -->

                      <div class="form-group">
                        <label class="col-form-label" for="name">Email</label>
                        <input type="email" class="form-control is-valid" id="email" name="email"
                               placeholder="Email" value="{{Auth::user()->email}}" required>
                      </div>

                      <div class="form-group">
                        <label class="col-form-label" for="contact">Phone No [2547xxxxxxxx]</label>
                        <input type="phone" class="form-control is-valid" id="contact" name="contact"
                               placeholder="Phone No" value="{{Auth::user()->contact}}" pattern="^\d{12}$" required>
                      </div>

                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer text-right">
                      <button type="submit" class="btn btn-success">
                         <i class="fa fa-save"></i>
                           Update
                      </button>
                    </div>
                  </form>

                </div>

                  </div>
                  <div class="tab-pane fade" id="custom-tabs-one-home2">


                <div class="">


                  @if(session('reject'))
                  <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    {{session('reject')}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  @endif


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


                  @if(session('response'))
                  <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{session('response')}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  @endif

                  
                </div>

                  </div>
                  <div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">


                  <form method="post" action="{{url('/changePassword')}}">
                    @csrf
                    <div class="card-body">
                  
                      <div class="form-group">
                        <label class="col-form-label" for="oldpass">Old Password</label>
                        <input type="password" class="form-control is-valid" id="oldpass" name="oldpass"
                               required>
                      </div>

                      <div class="form-group">
                        <label class="col-form-label" for="name">New Password</label>
                        <input type="password" class="form-control is-valid" id="name" name="password"
                               required>
                      </div>

                      <div class="form-group">
                        <label class="col-form-label" for="name">Confirm Password</label>
                        <input type="password" class="form-control is-valid" id="name" 
                               name="password_confirmation"
                               required>
                      </div>


                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer text-right">
                      <button type="submit" class="btn btn-success">
                         <i class="fa fa-save"></i>
                           Update
                      </button>
                    </div>
                  </form>




                  </div>
                  <div class="tab-pane fade" id="custom-tabs-one-messages" role="tabpanel" aria-labelledby="custom-tabs-one-messages-tab">
                  <form method="post" action="{{url('/updateProfilePicture')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                  
                        <div class="form-group">
                          <label>Picture (less than 2Mbs)<br><input type="file" id="file_selected" name="picture"  required onchange="getImage(this)" /><p id="file" class="file1" >
                            <img src="{{asset('images/cloudUpload.gif')}}" width="20px" height="20px" style="margin-top:-7px;">&nbspSelect profile picture</p>
                            <p id="file" class="file2" style="display: none;" ><img src="{{asset('images/successLoader.gif')}}" width="20px" height="20px" style="margin-top:-9px;">&nbspFile has been selected</p></label>

                        </div>

                        <div class="imageHolder" style="margin-top: -95px;">
                          <img src="{{asset('images/defaultPic.png')}}" id="default" width="90px" height="90px">
                          </div>

                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer text-right">
                      <button type="submit" class="btn btn-success">
                         <i class="fa fa-save"></i>
                           Update
                      </button>
                    </div>
                  </form>
 
                  </div>

                </div>
              </div>
              <!-- /.card -->
            </div>
          </div>


    </div>


    </div>
  </div>
</section>      


</div> 
<script type="text/javascript">
  setInterval(check,1000);
function check(){
  var uploaded_file=document.getElementById('file_selected').files.length;
  if(uploaded_file==0){
    $('.file1').get(0).style.display='block';
    $('.file2').get(0).style.display='none';
  }else{
    $('.file1').get(0).style.display='none';
    $('.file2').get(0).style.display='block';
  }
}
 function getImage(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#default')
                    .attr('src', e.target.result)
                    .width(90)
                    .height(90);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

      function pinttt(){
      $("#profModal").hide();
      $("#mainModal").removeClass('col-md-9');
      $("#bioText").hide();
      $("#bioImage").show();
      $(".nav-tabs").hide();
      javascript:window.print();
      $("#profModal").show();
       $("#mainModal").addClass('col-md-9');
       $("#bioText").fadeIn();
      $("#bioImage").hide();
       $(".nav-tabs").show();
    }

</script>
@endsection