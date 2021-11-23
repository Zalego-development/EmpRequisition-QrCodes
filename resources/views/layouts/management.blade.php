 <!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>{{config('app_name','Optiven | Management')}}</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('assets/dashboard/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="{{asset('assets/dashboard/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{asset('assets/dashboard/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{asset('assets/dashboard/plugins/jqvmap/jqvmap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('assets/dashboard/dist/css/zalegohrstyles.css')}}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{asset('assets/dashboard/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{asset('assets/dashboard/plugins/daterangepicker/daterangepicker.css')}}">

  <!-- summernote -->
  <link rel="stylesheet" href="{{asset('assets/dashboard/plugins/summernote/summernote-bs4.css')}}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

   <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">
  
  

  <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>



    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/w3v3.css')}}">
<script src="{{asset('tinymce/tinymce.min.js')}}"></script>
  <style type="text/css">
  @font-face {
  font-family: Poppins-Regular;
  src: url('../fonts/poppins/Poppins-Regular.ttf'); 
}

@font-face {
  font-family: Poppins-Medium;
  src: url('../fonts/poppins/Poppins-Medium.ttf'); 
}

@font-face {
  font-family: Poppins-Bold;
  src: url('../fonts/poppins/Poppins-Bold.ttf'); 
}

@font-face {
  font-family: Poppins-SemiBold;
  src: url('../fonts/poppins/Poppins-SemiBold.ttf'); 
}

  html,body{
    color: rgb(35, 45, 100);
    font-size: 12px;
    overflow-x: hidden !important;
  font-family: tahoma !important;
}
    .imgWrapper{
      background-color:rgba(255, 155, 68, 0.2);;
      width: 39px;
      height: 39px;
      padding: 7px;
      margin-bottom: -20px;
      margin-top: -20px;
      border-radius: 50%;
    }

    .bs-tooltip-top{
      padding: -10rem 0;
    }

    

    .dropdown-menu{
      border-color: transparent;
    }

    .dropdown-item{
      font-size: 14px;
    }

   
    .breadcrumb{
      font-size: 13px;
    }

    .nav-item{
      font-weight: 429;
      line-height: 25px;
    }


    .nav-link{

      color:  #fff !important;
      font-size: 13px;

    }
    .nav-link2:hover{
     background:rgb(64, 60, 93,.7);
      color: #8e98d7 !important;
      font-size: 13px;
    }


    .logoText{
      font-size: 24px !important;
    margin-top:-9px !important;
    color:  rgb(35, 45, 100) !important;
    }

    .main-sidebar{
        -webkit-box-shadow: 0 1rem 1rem rgba(46, 68, 105, 0.175) !important;
  box-shadow: 0 1rem 1rem rgba(46, 68, 105, 0.175) !important;
    }

    .content-wrapper{
      background-color:#f5f7f8 !important;
    }

    .os-theme-light>.os-scrollbar>.os-scrollbar-track>.os-scrollbar-handle {
    background: #dfe3e8  !important;
}

#infoNo{
  font-size:33px;
  color: #647489;
}

.bg-warning{
  background-color: #F96F34 !important;
}
.bg-info{
  background-color: #668cff !important;
}

.info-box-content{
  position:absolute; right: 0 !important;
}

.info-box-text{
  font-weight: bold;
}

.info-box .info-box-icon {
    border-radius: 0.25rem;
    -ms-flex-align: center;
    align-items: center;
    display: -ms-flexbox;
    display: flex;
    font-size: 1.875rem;
    -ms-flex-pack: center;
    justify-content: center;
    text-align: center;
    width: 65px;
    margin-left:10px;
}

.breadcrumb{
  font-size: 12px;
}

.dropdown-item{
  font-size: 12px;
}

tr th, tr td, label{
  color: #6c757d !important;
}

.pillLink {
 
  color: #333 !important;
}



.nav-pills .nav-item.show .nav-link, .nav-pills .nav-link.active {
 background-color: #f96f34;
  border-color: #f96f34;
  color: #fff !important;
  -webkit-box-shadow: 0 1rem 3rem rgba(172, 56, 6, 0.175) !important;
  box-shadow: 0 1rem 3rem rgba(172, 56, 6, 0.175) !important;
}

.btn-default:focus{
   background-color: #f96f34;
  border-color: #f96f34;
  color: #fff !important;
  -webkit-box-shadow: 0 1rem 3rem rgba(172, 56, 6, 0.175) !important;
  box-shadow: 0 1rem 3rem rgba(172, 56, 6, 0.175) !important;
}

.btn-default:hover{
   background-color: #f96f34;
  border-color: #f96f34;
  color: #fff !important;
  -webkit-box-shadow: 0 1rem 3rem rgba(172, 56, 6, 0.175) !important;
  box-shadow: 0 1rem 3rem rgba(172, 56, 6, 0.175) !important;
}




.files input {
    outline: 2px dashed #92b0b3;
    outline-offset: -10px;
    -webkit-transition: outline-offset .15s ease-in-out, background-color .15s linear;
    transition: outline-offset .15s ease-in-out, background-color .15s linear;
    padding: 120px 0px 85px 35%;
    text-align: center !important;
    margin: 0;
    width: 100% !important;
}
.files input:focus{     outline: 2px dashed #92b0b3;  outline-offset: -10px;
    -webkit-transition: outline-offset .15s ease-in-out, background-color .15s linear;
    transition: outline-offset .15s ease-in-out, background-color .15s linear; border:1px solid #92b0b3;
 }
.files{ position:relative}
.files:after {  pointer-events: none;
    position: absolute;
    top: 60px;
    left: 0;
    width: 50px;
    right: 0;
    height: 56px;
    content: "";
    background-image: url(https://image.flaticon.com/icons/png/128/109/109612.png);
    display: block;
    margin: 0 auto;
    background-size: 100%;
    background-repeat: no-repeat;
}
.color input{ background-color:#f1f1f1;}
.files:before {
    position: absolute;
    bottom: 10px;
    padding-top:30px !important;
    left: 0;  pointer-events: none;
    width: 100%;
    right: 0;
    height: 57px;
    content: "Drag and drop a file here/ Click to select. ";
    display: block;
    margin: 0 auto;
    color: #2ea591;
    font-weight: 600;
    text-transform: capitalize;
    text-align: center;
}




.bg-primary, .btn-primary{
      background-color: #668cff;
    border-color: #668cff;
}

.bg-success,  .alert-success
{
  background-color: #00cc44;
  border-color: #00cc44;
}

.btn-warning,.bg-warning,  .alert-warning
{
  background-color: #F96F34;
  border-color: #F96F34;
  color: #fff;
}
.btn-submit{
  transition: 0.4s;
}

 .alert-danger{
  background-color: rgb(220, 53, 69);
  color: #fff;
  font-size: 10px;
}

.btn-warning1:hover{
  background-color: #f75008;
  border-color: #f75008;
  color: #fff;
}

.btn-primary1.active{
background-color: #f75008;
  border-color: #f75008;
  color: #fff;
}

.btn-submit:hover, .btn-warning:hover,.btn-primary:hover,.btn-danger:hover,.btn-success:hover{
  -webkit-box-shadow: 0 1rem 3rem rgba(0, 0, 0, 0.175) !important;
  box-shadow: 0 1rem 3rem rgba(0, 0, 0, 0.175) !important;
}

.btn-submit:focus, .btn-warning:focus,.btn-primary:focus,.btn-danger:focus,.btn-success:focus{
  -webkit-box-shadow: 0 1rem 3rem rgba(0, 0, 0, 0.175) !important;
  box-shadow: 0 1rem 3rem rgba(0, 0, 0, 0.175) !important;
}

.btn-primary1{
  background-color: transparent;
    border-color: #0033cc;
    color: #0033cc;
}

.btn-success1{
  background-color: transparent;
  border-color: #00cc44;
  color:#00cc44; 
}

.btn-secondary1{
  
  background-color: transparent;
    border-color: #993399;
    color: #993399;
}

.btn-secondary1:focus{
  
  background-color: #993399;
    border-color: #993399;
    color: #fff;
}

.btn-warning1{
  
  background-color: transparent;
    border-color: #F96F34;
    color: #F96F34;
}

.btn-primary1:focus{
      background-color: #0063cc;
    border-color: #0063cc;
    color: #fff;
}

.btn-warning1:focus{
  background-color: #f75008;
    border-color: #f75008;
    color: #fff;
}

.btn-success1:focus{
  background-color:  #00cc44;
    border-color:  #00cc44;
    color: #fff;
 
}


.modal-content {

  -webkit-box-shadow: 0 1rem 3rem rgba(0, 0, 0, 0.175) !important;
  box-shadow: 0 1rem 3rem rgba(0, 0, 0, 0.175) !important;

  background-color: #fff;
  border-color: transparent;

}

.modal-dialog {
  margin-top: 40px !important;
}

.profileHolder{
  border:5px solid #f9f8f8;
}

.modalCardBody{
  background:#eef2f4;
  border-radius:2px;
  margin-top:-3px !important;
  margin:30px 20px;
}

.modal-body {

  padding: 2rem;
  background-color: #fff;
}

.modal-backdrop {
  background-color: #000;
  transition:1.0s linear;
}

.modal-backdrop.fade {
  opacity: 0;
}

.modal-backdrop.show {
  opacity: 0.03;
}



.btn-error{
  position: fixed;
  z-index: 999;
  display: none;
  right:0;
  margin-right: 5px;
}

.errorSheet{
  display: none;
  right: 0;
  z-index: 999;
  position: fixed;
  margin-right: 5px;
  top:200px;
  min-width: 300px;
}

#nameError,#passwordError,#contactError,#cPasswordError,#emailError{
  display: none;
}

.imageHolder{
  width: 97px;
  height: 97px;
  border: 3px solid #d1d3e2 !important;
  border-radius: 4px;
  margin-bottom: 7px;
  position: absolute;
  z-index: 999;
  right: 0;
  margin-right: 30px;
   margin-top: 40px;
}


/**.sidebar, .brand-link{
   background: #2e4469; /* For browsers that do not support gradients 
  background: -webkit-linear-gradient(left,#2e4469,#273959); 
  background: -o-linear-gradient(right,#2e4469,#273959);
  background: -moz-linear-gradient(right,#2e4469,#273959); 
  background: linear-gradient(to right, #2e4469,#273959);  
}
*/

.border-bottom{
  border-bottom: 1px solid #2f456a !important;
}

#progress {   
border-bottom: 5px solid #fff;
width: 0;
position: relative;
margin-top: 0px;
 left: 0;
 border-radius: 3px 3px 0px 0px;
 transition: .7s linear;
}


 hr{
        height: 1px;
        background-color: #d4d7de;
        border: none;
    }

    .infoText{
      font-size: 14px;
    }

.btn-header{
  background: #F96F34;
  border-color: #F96F34;
  font-size: 17px !important;
  font-family: calibri;
  border-radius: 40px;
  -webkit-box-shadow: 0 1rem 3rem rgba(250, 132, 82, 0.175) !important;
  box-shadow: 0 1rem 3rem rgba(250, 132, 82, 0.175) !important;
}

.btn-header:hover{
   background: #F96F34;
  border-color: #F96F34;
}

.btn-header a:hover{
  color: #fff !important;

}

.btn-toggle{
  background: #F96F34;
  border-color: #F96F34;
  -webkit-box-shadow: 0 1rem 3rem rgba(251, 167, 131, 0.475) !important;
  box-shadow: 0 1rem 3rem rgba(251, 167, 131, 0.475) !important;
  position: relative;
  margin-left:-34px;
  z-index:9999 !important;
  border-radius: 30%;
}

.btn-toggle:hover{
  background: #F96F34;
  border-color: #F96F34;
}

.btn-toggle a:hover{
  color: #fff;
  background: #F96F34;
  border-color: #F96F34;
}

.btn-primary{
   background-color: #f96f34;
  border-color: #f96f34;
  color: #fff !important;
  -webkit-box-shadow: 0 1rem 3rem rgba(172, 56, 6, 0.175) !important;
  box-shadow: 0 1rem 3rem rgba(172, 56, 6, 0.175) !important;
}

.btn-primary:active{
   background-color: #f96f34;
  border-color: #f96f34;
  color: #fff !important;
  -webkit-box-shadow: 0 1rem 3rem rgba(172, 56, 6, 0.175) !important;
  box-shadow: 0 1rem 3rem rgba(172, 56, 6, 0.175) !important;
}



.btn-primary:focus{
   background-color: #f96f34;
  border-color: #f96f34;
  color: #fff !important;
  -webkit-box-shadow: 0 1rem 3rem rgba(172, 56, 6, 0.175) !important;
  box-shadow: 0 1rem 3rem rgba(172, 56, 6, 0.175) !important;
}

.loader1 {
  border: 16px solid #f97339;
  border-radius: 50%;
  border-top: 16px solid #f96f34;
  width: 120px;
  height: 120px;
  -webkit-animation: spin 2s linear infinite;
  animation: spin 2s linear infinite;
}

@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}


  </style>


  <!-- Bootstrap 4 -->
<script src="{{asset('assets/dashboard/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script type="text/javascript">
 

 $(document).ready(function() {
  $('#example').DataTable();
});
  // Javascript to enable link to tab
setTimeout(tab,1);
  function tab(){
    $(document).ready(function() {
    if (location.hash) {
        $("a[href='" + location.hash + "']").tab("show");
    }
    $(document.body).on("click", "a[data-toggle='tab']", function(event) {
        location.hash = this.getAttribute("href");
    });
});
$(window).on("popstate", function() {
    var anchor = location.hash || $("a[data-toggle='tab']").first().attr("href");
    $("a[href='" + anchor + "']").tab("show");
});

$('#mydate').datepicker({
    container: ".bdc"
  });
    };


 setInterval(notifications,1000);

 function notifications(){
  //get notifications
   $.ajax({
            url:"http://localhost/hr/public/getNotifications",
            type:'GET',
            data:'_token=<?php echo csrf_token() ;?>',
            success:function(data){
             if(data.success=='1'){
               var output='';
               var count=0;
                for(var x=0;x<data.notifications.length;x++){
                  count+=data.notifications[x]['total'];
                    output+='<div class="dropdown-divider"></div><a href="http://localhost/hr/public'+data.notifications[x]['linkurl']+data.notifications[x]['linkindex']+'" class="dropdown-item"><span class="mr-2">'+data.notifications[x]['linkicon']+'</span>'+data.notifications[x]['total']+' '+data.notifications[x]['notification']+'<span class="float-right text-sm text-muted">Not read</span> </a>';
                } 
                document.getElementById('nHolder').innerHTML=output;  
                document.getElementById('countNot').innerHTML=count;
                document.getElementById('countNot1').innerHTML=count; 
            } else{
               
            }    
            }
        });
 }
  
</script>
 
</head>

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="py-3 main-header navbar fixed-topnav navbar-expand navbar-white navbar-light" style="background:white;">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <button class="btn btn-default btn-toggle">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="ml-3 fas fa-bars" style="margin-top:-6px !important;"></i></a>
      </button>
      <li class="nav-item d-none d-sm-inline-block" id="companyName" style="padding-top: 5px;"><a class="pt-3 nav-link logoText"  href="{{url('/home')}}">Zalego HR </a></li>
      
    </ul>

    

    <!-- Right navbar links -->
    <ul class="ml-auto navbar-nav" >
      <!-- SEARCH FORM -->
    <span class="px-3 ml-5 shadow-sm bg-light" style="margin-top: -6px;">
      <h4 id="clockdisplayDesktop" class="text-muted">00:00:00 AM</h4>
    </span>
      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-comments text-muted"></i>
          <span class="badge badge-danger navbar-badge">0</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="display: none;">
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="dist/img/user1-128x128.jpg" alt="User Avatar" class="mr-3 img-size-50 img-circle">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Brad Diesel
                  <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">Call me whenever you can...</p>
                <p class="text-sm text-muted"><i class="mr-1 far fa-clock"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="dist/img/user8-128x128.jpg" alt="User Avatar" class="mr-3 img-size-50 img-circle">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  John Pierce
                  <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">I got your message bro</p>
                <p class="text-sm text-muted"><i class="mr-1 far fa-clock"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="dist/img/user3-128x128.jpg" alt="User Avatar" class="mr-3 img-size-50 img-circle">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  Nora Silvester
                  <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">The subject goes here</p>
                <p class="text-sm text-muted"><i class="mr-1 far fa-clock"></i> 4 Hours Ago</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
        </div>
      </li>
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fas fa-bell text-muted"></i>&nbsp
          <span class="badge badge-warning navbar-badge"><span id="countNot1"><img src="{{asset('images/loader.gif')}}" style="margin-top: -1px;" width="10px" height="10px"></span></span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="display: nonek;">
          <span class="dropdown-item dropdown-header"><span id="countNot"></span> Notifications &nbsp&nbsp&nbsp<a href="{{url('/home')}}"><i class="fas fa-undo"></i> </a></span>

         <span id="nHolder"></span>
          <div class="dropdown-divider"></div>
          <a href="{{url('/notifications')}}" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li>

        <!-- User Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">

          @if(Auth::user()->image=="")
         <span class="px-3 py-3 text-white img-circle elevation-1 bg-warning">
           <strong style="color: #fff !important;">
             <?php
              $str=Auth::user()->name;
              echo strtoupper($str[0]);
             ?>
           </strong>
         </span>
          @else
           <img src="{{Auth::user()->image}}" width="30px" height="30px" class="img-circle elevation-1" alt="User Image" style="margin-top:-4px; ">
          @endif
          
        </a>
        <div class="dropdown-menu dropdown-menu-md dropdown-menu-right">
          <span class="dropdown-item dropdown-header">  {{Auth::user()->name}}</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="mr-2 fas fa-user"></i> Profile
          </a>
          
          <a href="#" class="dropdown-item">
            <i class="mr-2 fas fa-cog"></i> Settings
          </a>
          <a class="dropdown-item" href="#"
                                       onclick="$('#logoutModal').modal('show');$('#logText').html('You are about to terminate your session');"><i class="fas fa-sign-out-alt "></i>&nbsp&nbspLogout
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
          
          
      </li>
      
      
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar" style="background-image:url('../images/shots/10.jpg'); background-repeat: repeat-y;">
    <!-- Brand Logo -->
    <a href="{{url('/home')}}" class="brand-link" style=" padding-top: 1.4rem !important; padding-bottom: 1.25rem !important; background-color:rgb(75, 71, 109) !important;">

      <span><center><img src="{{asset('images/logo.jpg')}}" width="33px" height="33px" alt="Zalego Smart Hr Logo" 
           class="imgWrapper"></center></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar" style=" background-color:rgb(75, 71, 109) !important; ">
      
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <br><br>
        <li class="nav-header btn btn-primary btn-header"><a href="{{url('/home')}}">Dashboard</a></li><br>
          
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link nav-link2">
              <i class="nav-icon fas fa-users"></i>
              <p>
               HR
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="ml-3 nav-item">
                <a href="{{url('hr/employees')}}" class="nav-link nav-link2">
                  <i class="fas fa-angle-right"></i>
                  <p>Employees</p>
                </a>
              </li>

              <li class="ml-3 nav-item">
                <a href="{{url('hr/contracts')}}" class="nav-link nav-link2">
                  <i class="fas fa-angle-right"></i>
                  <p>Manage contracts</p>
                </a>
              </li>

               <li class="ml-3 nav-item">
                <a href="{{url('hr/terminateEmployment')}}" class="nav-link nav-link2">
                  <i class="fas fa-angle-right"></i>
                  <p>Terminate employment</p>
                </a>
              </li>

            </ul>
          </li>

            <li class="nav-item has-treeview">
            <a href="#" class="nav-link nav-link2">
              <i class="nav-icon fas fa-cog"></i>
              <p>
              HRM settings
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              
               <li class="ml-3 nav-item">
                <a href="{{url('hr/companies')}}" class="nav-link nav-link2">
                  <i class="fas fa-angle-right"></i>
                  <p>Company</p>
                </a>
              </li>

              <li class="ml-3 nav-item">
                <a href="{{url('hr/departments')}}" class="nav-link">
                  <i class="fas fa-angle-right"></i>
                  <p>Departments</p>
                </a>
              </li>

              <li class="ml-3 nav-item">
                <a href="{{url('hr/designations')}}" class="nav-link nav-link2">
                  <i class="fas fa-angle-right"></i>
                  <p>Designations</p>
                </a>
              </li>

               <li class="ml-3 nav-item">
                <a href="{{url('hr/regions')}}" class="nav-link nav-link2">
                  <i class="fas fa-angle-right"></i>
                  <p>Work regions</p>
                </a>
              </li>

               <li class="ml-3 nav-item">
                <a href="{{url('hr/empCategories')}}" class="nav-link nav-link2">
                  <i class="fas fa-angle-right"></i>
                  <p>Employment categories</p>
                </a>
              </li>

            </ul>
          </li>


           <li class="nav-item has-treeview">
            <a href="#" class="nav-link nav-link2">
              <i class="nav-icon fas fa-donate"></i>
              <p>
               Payroll
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="ml-3 nav-item">
                <a href="{{url('hr/advancePay')}}" class="nav-link nav-link2">
                  <i class="fas fa-angle-right"></i>
                  <p>Advance Pay</p>
                </a>
              </li>
              <li class="ml-3 nav-item">
                <a href="{{url('hr/expenseClaims')}}" class="nav-link nav-link2">
                  <i class="fas fa-angle-right"></i>
                  <p>Expense Claims</p>
                </a>
              </li>
              <li class="ml-3 nav-item">
                <a href="{{url('hr/processPayroll')}}" class="nav-link nav-link2">
                  <i class="fas fa-angle-right"></i>
                  <p>Process Payroll</p>
                </a>
              </li>
              <li class="ml-3 nav-item">
                <a href="{{url('hr/employeessalary')}}" class="nav-link nav-link2">
                  <i class="fas fa-angle-right"></i>
                  <p>Employees salary</p>
                </a>
              </li>

              <li class="ml-3 nav-item">
                <a href="{{url('hr/loansettings')}}" class="nav-link nav-link2">
                  <i class="fas fa-angle-right"></i>
                  <p>Loan settings</p>
                </a>
              </li>

              
            </ul>
          </li>

              <li class="nav-item has-treeview">
            <a href="#" class="nav-link nav-link2">
              <i class="nav-icon fas fa-percent"></i>
              <p>
               Perfomance
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="ml-3 nav-item">
                <a href="{{url('hr/perfomanceTracker')}}" class="nav-link nav-link2">
                  <i class="fas fa-angle-right"></i>
                  <p>Perfomance tracker</p>
                </a>
              </li>

               <li class="ml-3 nav-item">
                <a href="{{url('hr/perfomanceIndicator')}}" class="nav-link nav-link2">
                  <i class="fas fa-angle-right"></i>
                   <p>Perfomance indicator</p>
                </a>
              </li>

              <li class="ml-3 nav-item">
                <a href="{{url('hr/tbp')}}" class="nav-link nav-link2">
                  <i class="fas fa-angle-right"></i>
                   <p>Target based perfomance</p>
                </a>
              </li>


              

              
            </ul>
          </li>

          

           <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-file"></i>
              <p>
              Leaves
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="ml-3 nav-item">
                <a href="{{url('hr/leaveApplications')}}" class="nav-link nav-link2">
                  <i class="fas fa-angle-right"></i>
                  <p>View applications</p>
                </a>
              </li>

               <li class="ml-3 nav-item">
                <a href="{{url('hr/applyLeave')}}" class="nav-link nav-link2">
                  <i class="fas fa-angle-right"></i>
                  <p>Apply for leave</p>
                </a>
              </li>

              

              <li class="ml-3 nav-item">
                <a href="{{url('hr/leaveCategories')}}" class="nav-link nav-link2">
                  <i class="fas fa-angle-right"></i>
                  <p>Leave categories</p>
                </a>
              </li>

              

              
            </ul>
          </li>


           <li class="nav-item has-treeview">
            <a href="#" class="nav-link nav-link2">
              <i class="nav-icon fas fa-users"></i>
              <p>
              Attendance
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="ml-3 nav-item">
                <a href="#" class="nav-link nav-link2">
                  <i class="fas fa-angle-right"></i>
                  <p>Overtime</p>
                </a>
              </li>

               <li class="ml-3 nav-item">
                <a href="#" class="nav-link nav-link2">
                  <i class="fas fa-angle-right"></i>
                  <p>Absenteeism</p>
                </a>
              </li>

              

              

              
            </ul>
          </li>
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
 
  </aside>

  @yield('content')


<!--include the loaders-->
    @include('uiassets.loaders')
<!--end loaders-->
  <!-- /.content-wrapper -->
  <footer class="main-footer" id="footer">
    
    <div class="float-right d-none d-sm-inline-block">
     
      <span>Copyright &copy; {{date('Y')}} <a href="https://zalegoinstitute.ac.ke">Zalego</a></span>
      <b>Version</b> 1.0.0
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<script type="text/javascript">
 /** 
$(document).ready(function(){  

//expressions to match with
var name_exp=/^[a-zA-Z ]{3,30}$/;
var contact_exp=/^[0-9]{10,11}$/;
var email_exp=/^[a-zA-Z0-9]+@[a-zA-Z]+\.[a-zA-Z]{2,4}$/;
var password_exp=/^[a-zA-Z0-9@#\_\+\%\$\.\,\^\)\(\!]{8,255}$/;

//validation starts here
var validation_check="true";

$("#firstname").on("keypress keyup keydown", function(){

var firstname=document.getElementById("firstname").value;
if(!firstname.match(name_exp)){
//display the error sheet btn
$(".btn-error").fadeIn('slow');
$("#nameError").fadeIn('slow');
validation_check="false";
}else
{
 //hide the error sheet btn
 $(".btn-error").fadeOut('slow');
 $("#nameError").fadeOut('slow');
  validation_check="true";
}
});

$("#lastname").on("keypress keyup keydown", function(){

var lastname=document.getElementById("lastname").value;
if(!lastname.match(name_exp)){
//display the error sheet btn
$(".btn-error").fadeIn('slow');
$("#nameError").fadeIn('slow');
validation_check="false";
}else
{
 //hide the error sheet btn
 $(".btn-error").fadeOut('slow');
 $("#nameError").fadeOut('slow');
  validation_check="true";
}
});

$("#surname").on("keypress keyup keydown", function(){

var surname=document.getElementById("surname").value;
if(!surname.match(name_exp)){
//display the error sheet btn
$(".btn-error").fadeIn('slow');
$("#nameError").fadeIn('slow');
validation_check="false";
}else
{
 //hide the error sheet btn
 $(".btn-error").fadeOut('slow');
 $("#nameError").fadeOut('slow');
  validation_check="true";
}
});

$("#email").on("keypress keyup keydown", function(){

var email=document.getElementById("email").value;
if(!email.match(email_exp)){
//display the error sheet btn
$(".btn-error").fadeIn('slow');
$("#emailError").fadeIn('slow');
validation_check="false";
}else
{
 //hide the error sheet btn
 $(".btn-error").fadeOut('slow');
 $("#emailError").fadeOut('slow');
  validation_check="true";
}
});

$("#contact").on("keypress keyup keydown", function(){

var contact=document.getElementById("contact").value;
if(!contact.match(contact_exp)){
//display the error sheet btn
$(".btn-error").fadeIn('slow');
$("#contactError").fadeIn('slow');
validation_check="false";
}else
{
 //hide the error sheet btn
 $(".btn-error").fadeOut('slow');
 $("#contactError").fadeOut('slow');
  validation_check="true";
}
});

$("#password").on("keypress keyup keydown", function(){

var password=document.getElementById("password").value;
if(!password.match(password_exp)){
//display the error sheet btn
$(".btn-error").fadeIn('slow');
$("#passwordError").fadeIn('slow');
validation_check="false";
}else
{
 //hide the error sheet btn
 $(".btn-error").fadeOut('slow');
 $("#passwordError").fadeOut('slow');
  validation_check="true";
}
});

$("#cPassword").on("keypress keyup keydown", function(){

var cPassword=document.getElementById("cPassword").value;
var password=document.getElementById("password").value;
if(cPassword!=password){
//display the error sheet btn
$(".btn-error").fadeIn('slow');
$("#cPasswordError").fadeIn('slow');
validation_check="false";
}else
{
 //hide the error sheet btn
 $(".btn-error").fadeOut('slow');
 $("#cPasswordError").fadeOut('slow');
  validation_check="true";
}
});

$(".btn-error").on("click", function(){
  $(".errorSheet").slideToggle();
});

$(".errorSheetCloseBtn").on("click",function(){
   $(".errorSheet").fadeOut("slow");
});


setInterval(checker,1000);
function checker(){
  if(validation_check=="true"){
    document.getElementById("submit").style.display="inline-block";
    document.getElementById("submit1").style.display="none";
  }else{
      document.getElementById("submit1").style.display="inline-block";
    document.getElementById("submit").style.display="none";
  }
}

});**/
</script>
<!-- jQuery UI 1.11.4 -->
<script src="{{asset('assets/dashboard/plugins/jquery-ui/jquery-ui.min.js')}}"></script>

<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $(function () {
  $('[data-toggle="tooltip"]').tooltip()
});

  $.widget.bridge('uibutton', $.ui.button)
</script>

<!-- ChartJS -->
<script src="{{asset('assets/dashboard/plugins/chart.js/Chart.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{asset('assets/dashboard/plugins/sparklines/sparkline.js')}}"></script>
<!-- JQVMap -->
<script src="{{asset('assets/dashboard/plugins/jqvmap/jquery.vmap.min.js')}}"></script>
<script src="{{asset('assets/dashboard/plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script>
<!-- jQuery Knob Chart -->
<script src="{{asset('assets/dashboard/plugins/jquery-knob/jquery.knob.min.js')}}"></script>
<!-- daterangepicker -->
<script src="{{asset('assets/dashboard/plugins/moment/moment.min.js')}}"></script>
<script src="{{asset('assets/dashboard/plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{asset('assets/dashboard/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<!-- Summernote -->
<script src="{{asset('assets/dashboard/plugins/summernote/summernote-bs4.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{asset('assets/dashboard/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>

<!-- AdminLTE App -->
<script src="{{asset('assets/dashboard/dist/js/adminlte.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{asset('assets/dashboard/dist/js/pages/dashboard.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('assets/dashboard/dist/js/demo.js')}}"></script>
  <script src="{{asset('assets/libs/js/Chart.js')}}"></script>

   <script type="text/javascript">

    $(document).click(function(){
        if(typeof timeOutObj != "undefined") {
            clearTimeout(timeOutObj);
        }

        timeOutObj = setTimeout(function(){ 
            localStorage.clear();
            $("#logoutModal").modal('show');
        },300000);   //will expire after twenty minutes

   });

      var ctx = document.getElementById("myChart");
        var ctx2 = document.getElementById("myChart2");

var myChart = new Chart(ctx, {
    type: 'bar',//specify the type of graph you want to deal with
    data: {
        labels: ["Completed", "Inprogress", "Onhold", "Pending", "Review"],//the labels of your graphs
        datasets: [{
            label: '# Tasks',//what the user sees when he/she overs a given label
            data:[12,20,27,13,19], //The data set of your graph
            backgroundColor: [
                'rgba(45, 185, 77, 0.2)', //the colors of your labels
                'rgba(249, 111, 52, 0.2)', //the colors of your labels
                'rgba(220, 53, 69, 0.2)', //the colors of your labels
                'rgba(75, 192, 192, 0.2)', //the colors of your labels
                'rgba(153, 102, 255, 0.2)', //the colors of your labels
                'rgba(255, 159, 64, 0.2)' //the colors of your labels
            ],
            borderColor: [
                'rgba(45, 185, 77,1)', //the color of the label borders 
                'rgba(249, 111, 52, 1)', //the color of the label borders 
                'rgba(220, 53, 69, 1)', //the color of the label borders 
                'rgba(75, 192, 192, 1)', //the color of the label borders 
                'rgba(153, 102, 255, 1)', //the color of the label borders 
                'rgba(255, 159, 64, 1)' //the color of the label borders 
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true // specifies where the ticks will begin at
                },
                gridLines: {
                      color: "rgba(0, 0, 0, 0)",//horizontal grids color
                  }
            }],
            xAxes: [{
               ticks:{
                  beginAtZero:true // specifies where the ticks will begin at
                },

                 gridLines: {
                     color: "rgba(0, 0, 0, 0)", //vertical grids color
                 }
             }]
        }
    }
});

var myChart2 = new Chart(ctx2, {
    type: 'pie',//specify the type of graph you want to deal with
    data: {
        labels: ["Active", "Onleave"],//the labels of your graphs
        datasets: [{
            label: '# Employees',//what the user sees when he/she overs a given label
            data:[56,20], //The data set of your graph
            backgroundColor: [
                'rgba(45, 185, 77, 0.4)', //the colors of your labels
                
                'rgba(220, 53, 69, 0.4)', //the colors of your labels
                
            ],
          
            borderWidth: 1
        }]
    },
    
});


function getUser(){
        var name=$("#firstname").val();
      document.getElementById("empName").innerHTML=name;
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

    

    

    function addBankFunction(id){
     document.getElementById('addBankForm'+id).style.display="block";
      document.getElementById('editBankForm'+id).style.display="none";
    }

    function editBankFunction(id){
      document.getElementById('addBankForm'+id).style.display="none";
      document.getElementById('editBankForm'+id).style.display="block";
    }

    function addEarningFunction(){
     document.getElementById('addEarningForm').style.display="block";
      document.getElementById('viewEarningForm').style.display="none";
    }

    function viewEarningFunction(){
      document.getElementById('addEarningForm').style.display="none";
      document.getElementById('viewEarningForm').style.display="block";
    }

     function addDeductionFunction(){
     document.getElementById('addDeductionForm').style.display="block";
      document.getElementById('viewDeductionForm').style.display="none";
    }

    function viewDeductionFunction(){
      document.getElementById('addDeductionForm').style.display="none";
      document.getElementById('viewDeductionForm').style.display="block";
    }

   </script>

   <script>
  var editor_config = {
    path_absolute : "",
    selector: "textarea.my-editor",
    setup : function(ed){
      ed.on('init',function(){
        this.getDoc().body.style.fontFamily='Tw Cen MT';
        this.getDoc().body.style.fontSize='44';
      });
    },
    plugins: [
      "advlist autolink lists link image charmap print preview hr anchor pagebreak",
      "searchreplace wordcount visualblocks visualchars code fullscreen",
      "insertdatetime media nonbreaking save table contextmenu directionality",
      "emoticons template paste textcolor colorpicker textpattern"
    ],
    toolbar: "insertfile undo redo | styleselect fontselect fontsizeselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media | forecolor backcolot",
    relative_urls: false,
    file_browser_callback : function(field_name, url, type, win) {
      var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
      var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

      var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
      if (type == 'image') {
        cmsURL = cmsURL + "&type=Images";
      } else {
        cmsURL = cmsURL + "&type=Files";
      }

      tinyMCE.activeEditor.windowManager.open({
        file : cmsURL,
        title : 'Filemanager',
        width : x * 0.8,
        height : y * 0.8,
        resizable : "yes",
        close_previous : "no"
      });
    }
  };

  tinymce.init(editor_config);
</script>


   
<!-- DataTables -->
<script src="{{asset('assets/dashboard/plugins/datatables/jquery.dataTables.js')}}"></script>
<script src="{{asset('assets/dashboard/plugins/datatables-bs4/js/dataTables.bootstrap4.js')}}"></script>

<script>

  $(function () {
    $("#employees").DataTable();
    $("#departments").DataTable();
    $("#companies").DataTable();
    $("#designations").DataTable();
    $('#employeesalarys').DataTable();
    $('#loanedd').DataTable();
     $('#perfomanceTracker').DataTable();
     $('#advancePay').DataTable();
     $('#approvedExpense').DataTable();
     $('#pendingExpense').DataTable();
     $('#disExpense').DataTable();
     $('#contract').DataTable();
     $('#contracts').DataTable();
     $('#leaves').DataTable();
     $('#leaves2').DataTable();
     $('#confirmations').DataTable();
     $('#pyrolls').DataTable();
     $('.musters').DataTable();
  });

  function pint(){
    document.getElementById('footer').style.display='none';
    document.getElementById('address').style.display='block';
    window.print();
  }


  function reloaderr(){
    var pathh=window.location.href;
            window.location.assign(pathh);
  }


  //time renderer
  function renderTimeDesktop() {

                      var currentTime= new Date();
                      var diem = "AM"
                      var h = currentTime.getHours();
                      var m = currentTime.getMinutes();
                      var s = currentTime.getSeconds();


                      if (h ==0){
                          h = 12
                      }   else if (h>12) {
                          h = h - 12;
                          diem = "PM";

                      }

                      if (h<10){
                          h = "0" + h;

                      }

                      if (m<10){
                          m = "0" + m;

                      }

                      if (s<10){
                          s = "0" + s;

                      }


                      var myClock = document.getElementById('clockdisplayDesktop')
                      //myClock.textContent = h + ":" + m + ":" + s + " " +diem;
                      myClock.innerHTML = h + ":" + m + ":" + s + " " + "<sup style='font-size:12px;'>"+diem+"</sup>";
                      setTimeout(renderTimeDesktop,1000);
                      }


                      renderTimeDesktop();


 
</script>


  </body>
  </html>