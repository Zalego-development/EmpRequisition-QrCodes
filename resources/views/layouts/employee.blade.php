 <!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>@yield('title', 'Dashboard | Zalego')</title>
  <link rel="shortcut icon" href="{{asset('assets/back-end/settings/fav-icon.png')}}" type="image/png">
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!--csrf-token-->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- Font Awesome -->
  <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
<!--   <link rel="stylesheet" href="{{asset('assets/dashboard/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}"> -->
  <!-- iCheck -->
  <!-- <link rel="stylesheet" href="{{asset('assets/dashboard/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}"> -->
  <!-- JQVMap -->
  <!-- <link rel="stylesheet" href="{{asset('assets/dashboard/plugins/jqvmap/jqvmap.min.css')}}"> -->
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('assets/dashboard/dist/css/zalegohrstyles.css')}}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{asset('assets/dashboard/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
   <link rel="stylesheet" href="{{asset('assets/dashboard/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Daterange picker -->
  <!-- <link rel="stylesheet" href="{{asset('assets/dashboard/plugins/daterangepicker/daterangepicker.css')}}"> -->
  <link rel="shortcut icon" href="{{asset('assets/back-end/settings/logo.png')}}" type="image/png">

  <!-- <link rel="stylesheet" href="{{asset('select2/bootstrap-colorpicker.min.css')}}">
    <link rel="stylesheet" href="{{asset('select2/select2-bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('select2/css/select2.min.css')}}"> -->
  <!-- summernote -->
<!--   <link rel="stylesheet" href="{{asset('assets/dashboard/plugins/summernote/summernote-bs4.css')}}"> -->
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

<!--   <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css"> -->
    
<!-- 
  <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script> -->



<link rel="stylesheet" type="text/css" href="{{asset('assets/css/w3v3.css')}}">
<script src="{{asset('tinymce/tinymce.min.js')}}"></script>
  <style type="text/css">
@font-face{font-family:Poppins-Regular;src:url(../fonts/poppins/Poppins-Regular.ttf)}@font-face{font-family:Poppins-Medium;src:url(../fonts/poppins/Poppins-Medium.ttf)}@font-face{font-family:Poppins-Bold;src:url(../fonts/poppins/Poppins-Bold.ttf)}@font-face{font-family:Poppins-SemiBold;src:url(../fonts/poppins/Poppins-SemiBold.ttf)}body,html{color:#232d64;font-size:12px;overflow-x:initial!important;font-family:tahoma!important}.imgWrapper{background-color:rgba(255,155,68,.2);width:39px;height:39px;padding:7px;margin-bottom:-20px;margin-top:-20px;border-radius:50%}.dropdown-menu{border-color:transparent}.dropdown-item{font-size:14px}.breadcrumb{font-size:13px}.nav-item{font-weight:429;line-height:25px}.nav-link{color:#fff!important;font-size:13px}.nav-link2:hover{background:rgb(64,60,93,.7);color:#8e98d7!important;font-size:13px}.logoText{font-size:24px!important;margin-top:-9px!important;color:#232d64!important}.main-sidebar{-webkit-box-shadow:0 1rem 1rem rgba(46,68,105,.175)!important;box-shadow:0 1rem 1rem rgba(46,68,105,.175)!important}.content-wrapper{background-color:#f5f7f8!important}.os-theme-light>.os-scrollbar>.os-scrollbar-track>.os-scrollbar-handle{background:#dfe3e8!important}#infoNo{font-size:33px;color:#647489}.bg-warning{background-color:#f96f34!important}.bg-info{background-color:#668cff!important}.info-box-content{position:absolute;right:0!important}.info-box-text{font-weight:700}.info-box .info-box-icon{border-radius:.25rem;-ms-flex-align:center;align-items:center;display:-ms-flexbox;display:flex;font-size:1.875rem;-ms-flex-pack:center;justify-content:center;text-align:center;width:65px;margin-left:10px}.breadcrumb{font-size:12px}.dropdown-item{font-size:12px}label,tr td,tr th{color:#6c757d!important}.pillLink{color:#333!important}.nav-pills .nav-item.show .nav-link,.nav-pills .nav-link.active{background-color:#f96f34;border-color:#f96f34;color:#fff!important;-webkit-box-shadow:0 1rem 3rem rgba(172,56,6,.175)!important;box-shadow:0 1rem 3rem rgba(172,56,6,.175)!important}.btn-default:focus{background-color:#f96f34;border-color:#f96f34;color:#fff!important;-webkit-box-shadow:0 1rem 3rem rgba(172,56,6,.175)!important;box-shadow:0 1rem 3rem rgba(172,56,6,.175)!important}.btn-default:hover{background-color:#f96f34;border-color:#f96f34;color:#fff!important;-webkit-box-shadow:0 1rem 3rem rgba(172,56,6,.175)!important;box-shadow:0 1rem 3rem rgba(172,56,6,.175)!important}.files input{outline:2px dashed #92b0b3;outline-offset:-10px;-webkit-transition:outline-offset .15s ease-in-out,background-color .15s linear;transition:outline-offset .15s ease-in-out,background-color .15s linear;padding:120px 0 85px 35%;text-align:center!important;margin:0;width:100%!important}.files input:focus{outline:2px dashed #92b0b3;outline-offset:-10px;-webkit-transition:outline-offset .15s ease-in-out,background-color .15s linear;transition:outline-offset .15s ease-in-out,background-color .15s linear;border:1px solid #92b0b3}.files{position:relative}.files:after{pointer-events:none;position:absolute;top:60px;left:0;width:50px;right:0;height:56px;content:"";background-image:url(https://image.flaticon.com/icons/png/128/109/109612.png);display:block;margin:0 auto;background-size:100%;background-repeat:no-repeat}.color input{background-color:#f1f1f1}.files:before{position:absolute;bottom:10px;padding-top:30px!important;left:0;pointer-events:none;width:100%;right:0;height:57px;content:"Drag and drop a file here/ Click to select. ";display:block;margin:0 auto;color:#2ea591;font-weight:600;text-transform:capitalize;text-align:center}.bg-primary,.btn-primary{background-color:#668cff;border-color:#668cff}.alert-success,.bg-success{background-color:#0c4;border-color:#0c4}.alert-warning,.bg-warning,.btn-warning{background-color:#f96f34;border-color:#f96f34;color:#fff}.btn-submit{transition:.4s}.alert-danger{background-color:#dc3545;color:#fff;font-size:10px}.btn-warning1:hover{background-color:#f75008;border-color:#f75008;color:#fff}.btn-primary1.active{background-color:#f75008;border-color:#f75008;color:#fff}.btn-danger:hover,.btn-primary:hover,.btn-submit:hover,.btn-success:hover,.btn-warning:hover{-webkit-box-shadow:0 1rem 3rem rgba(0,0,0,.175)!important;box-shadow:0 1rem 3rem rgba(0,0,0,.175)!important}.btn-danger:focus,.btn-primary:focus,.btn-submit:focus,.btn-success:focus,.btn-warning:focus{-webkit-box-shadow:0 1rem 3rem rgba(0,0,0,.175)!important;box-shadow:0 1rem 3rem rgba(0,0,0,.175)!important}.btn-primary1{background-color:transparent;border-color:#03c;color:#03c}.btn-success1{background-color:transparent;border-color:#0c4;color:#0c4}.btn-secondary1{background-color:transparent;border-color:#939;color:#939}.btn-secondary1:focus{background-color:#939;border-color:#939;color:#fff}.btn-warning1{background-color:transparent;border-color:#f96f34;color:#f96f34}.btn-primary1:focus{background-color:#0063cc;border-color:#0063cc;color:#fff}.btn-warning1:focus{background-color:#f75008;border-color:#f75008;color:#fff}.btn-success1:focus{background-color:#0c4;border-color:#0c4;color:#fff}.modal-content{-webkit-box-shadow:0 1rem 3rem rgba(0,0,0,.175)!important;box-shadow:0 1rem 3rem rgba(0,0,0,.175)!important;background-color:#fff;border-color:transparent}.modal-dialog{margin-top:40px!important}.profileHolder{border:5px solid #f9f8f8}.modalCardBody{background:#eef2f4;border-radius:2px;margin-top:-3px!important;margin:30px 20px}.modal-body{padding:2rem;background-color:#fff}.modal-backdrop{background-color:#000;transition:1.7s linear}.modal-backdrop.fade{opacity:0}.modal-backdrop.show{opacity:.03}.btn-error{position:fixed;z-index:999;display:none;right:0;margin-right:5px}.errorSheet{display:none;right:0;z-index:999;position:fixed;margin-right:5px;top:200px;min-width:300px}#cPasswordError,#contactError,#emailError,#nameError,#passwordError{display:none}.imageHolder{width:97px;height:97px;border:3px solid #d1d3e2!important;border-radius:4px;margin-bottom:7px;position:absolute;z-index:999;right:0;margin-right:30px;margin-top:40px}.border-bottom{border-bottom:1px solid #2f456a!important}#progress{border-bottom:5px solid #fff;width:0;position:relative;margin-top:0;left:0;border-radius:3px 3px 0 0;transition:.7s linear}hr{height:1px;background-color:#d4d7de;border:none}.infoText{font-size:14px}.btn-header{background:#f96f34;border-color:#f96f34;font-size:17px!important;font-family:calibri;border-radius:40px;-webkit-box-shadow:0 1rem 3rem rgba(250,132,82,.175)!important;box-shadow:0 1rem 3rem rgba(250,132,82,.175)!important}.btn-header:hover{background:#f96f34;border-color:#f96f34}.btn-header a:hover{color:#fff!important}.btn-toggle{background:#f96f34;border-color:#f96f34;-webkit-box-shadow:0 1rem 3rem rgba(251,167,131,.475)!important;box-shadow:0 1rem 3rem rgba(251,167,131,.475)!important;position:relative;margin-left:-34px;z-index:9999!important;border-radius:30%}.btn-toggle:hover{background:#f96f34;border-color:#f96f34}.btn-toggle a:hover{color:#fff;background:#f96f34;border-color:#f96f34}.btn-primary{background-color:#f96f34;border-color:#f96f34;color:#fff!important;-webkit-box-shadow:0 1rem 3rem rgba(172,56,6,.175)!important;box-shadow:0 1rem 3rem rgba(172,56,6,.175)!important}.btn-primary:active{background-color:#f96f34;border-color:#f96f34;color:#fff!important;-webkit-box-shadow:0 1rem 3rem rgba(172,56,6,.175)!important;box-shadow:0 1rem 3rem rgba(172,56,6,.175)!important}.btn-primary:focus{background-color:#f96f34;border-color:#f96f34;color:#fff!important;-webkit-box-shadow:0 1rem 3rem rgba(172,56,6,.175)!important;box-shadow:0 1rem 3rem rgba(172,56,6,.175)!important}.loader1{border:16px solid #f97339;border-radius:50%;border-top:16px solid #f96f34;width:120px;height:120px;-webkit-animation:spin 2s linear infinite;animation:spin 2s linear infinite}@-webkit-keyframes spin{0%{-webkit-transform:rotate(0)}100%{-webkit-transform:rotate(360deg)}}@keyframes spin{0%{transform:rotate(0)}100%{transform:rotate(360deg)}}.pagination>li{padding:20px 4px}.pagination>li>a{background:#fff;color:gray;border-radius:50%;-webkit-box-shadow:0 1rem 1rem rgba(255,51,0,.175)!important;box-shadow:0 1rem 1rem rgba(255,51,0,.175)!important;border-color:transparent;transition:.4s linear}.pagination>li>a:focus,.pagination>li>a:hover,.pagination>li>span:focus,.pagination>li>span:hover{color:#fff;background-color:#ff5c33;border-color:transparent;border-radius:50%;-webkit-box-shadow:0 1rem 1rem rgba(255,51,0,.175)!important;box-shadow:0 1rem 1rem rgba(255,51,0,.175)!important}.pagination>.active>a{color:#fff!important;background-color:#ff5c33!important;border-color:transparent!important;-webkit-box-shadow:0 1rem 1rem rgba(255,51,0,.175)!important;box-shadow:0 1rem 1rem rgba(255,51,0,.175)!important}.pagination>.active>a:hover{color:#fff!important;background-color:#ff9980!important;border-color:transparent!important;-webkit-box-shadow:0 1rem 1rem rgba(255,51,0,.175)!important;box-shadow:0 1rem 1rem rgba(255,51,0,.175)!important}.page-link{border-radius:50%!important}.page-item.active .page-link{color:#fff!important;background-color:#f30!important;border-color:transparent!important;-webkit-box-shadow:0 1rem 1rem rgba(255,51,0,.175)!important;box-shadow:0 1rem 1rem rgba(255,51,0,.175)!important}.linkBt{border-radius:5%!important;-webkit-box-shadow:0 1rem 1rem rgba(255,51,0,.175)!important;box-shadow:0 1rem 1rem rgba(255,51,0,.175)!important}.nav-link.active{color:#000!important;font-size:13px}
  </style>
<style>
html,body{
overflow-x:hidden !important;
}
/* width */
#notii::-webkit-scrollbar {
  width: 8px;
}

/* Track */
#notii::-webkit-scrollbar-track {
  background: #f1f1f1; 
}
 
/* Handle */
#notii::-webkit-scrollbar-thumb {
  background: #888; 
}

/* Handle on hover */
#notii::-webkit-scrollbar-thumb:hover {
  background: #555; 
}

.btn-warning{
  -webkit-box-shadow: 0 1rem 3rem rgba(250, 132, 82, 0.175) !important;
  box-shadow: 0 1rem 3rem rgba(250, 132, 82, 0.175) !important;
}
.outer::-webkit-scrollbar {
      width: 7px;

    }

    /* Track */
    .outer::-webkit-scrollbar-track {
      box-shadow: inset 0 0 5px #bfbfbf; 
      border-radius: 1px;
    }
     
    /* Handle */
    .outer::-webkit-scrollbar-thumb {
           background: #cccccc;
            border-radius: 20px;
    }

    /* Handle on hover */
    .outer::-webkit-scrollbar-thumb:hover {
      background:  #a6a6a6; 
    }

    .outer2 a{
      transition: 0.5s linear;

    }
    .outer2{
      overflow-x: hidden !important;

    }
    .outer2 a:hover{
      background-color: #f8f9fa !important;
    }
    .theme-purple{
  background: linear-gradient(-135deg,#899FD4 0%,#A389D4 100%);
}
.theme-green{
      background: linear-gradient(-135deg,#1de9b6 0%,#1dc4e9 100%);
}

.theme-green-text{
  color: #1dc4e9;
}
.theme-orange{
background: linear-gradient(-135deg,#de6262 0%,#ffb88c 100%);
}
.theme-pink{
background: linear-gradient(-135deg,#02aab0 0%,#00cdac 100%);
}
.theme-bourbon{
background: linear-gradient(-135deg,#ec6f66 0%,#f3a183 100%);
}
.badge-success{
background: linear-gradient(-135deg,#1de9b6 0%,#1dc4e9 100%);
}
 .btn{
      position: relative; 
            overflow: hidden; 
            box-shadow: 6px 7px 40px -4px  
                     rgba(0, 0, 0, 0.2); 
                     outline: none;
                     border: none;
    }
    .btn span { 
        position: absolute; 
        border-radius: 50%; 
        /* To make it round */
        background-color: rgba(0, 0, 0, 0.3); 
  
        width: 100px; 
        height: 100px; 
        margin-top: -50px; 
        /* for positioning */
        margin-left: -50px; 
  
        animation: ripple 1s; 
        opacity: 0; 
    } 
  
    /* Add animation */
    @keyframes ripple { 
        from { 
            opacity: 1; 
            transform: scale(0); 
        } 
  
        to { 
            opacity: 0; 
            transform: scale(10); 
        } 
    } 
</style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar fixed-topnav navbar-expand navbar-white navbar-light py-3" style="background:white;">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <button class="btn btn-default btn-toggle">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="ml-3 fa fa-bars" style="margin-top:-6px !important;"></i></a>
      </button>
       <li class="nav-item d-none d-sm-inline-block" id="companyName" style="padding-top: 5px;"><a class="nav-link logoText pt-3"  href="{{url('/home')}}">Survey System</a></li>
    </ul>

    

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto" >
	

 <span class="ml-5 bg-light px-3 shadow-sm" style="margin-top: -6px;">
      <h4 id="clockdisplayDesktop" class="text-muted">00:00:00 AM</h4>
    </span>
        <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-comments"></i>
          <span class="badge badge-primary navbar-badge ml-5">
             <i class="fa fa-envelope" aria-hidden="true"></i>
             {{DB::table('g_email_events')->where('status','Pending')->count()}}
          </span>
        </a>
      </li>
        <!-- User Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">

           @if(!empty(Auth::user()->image))
            <img class="profile-user-img img-fluid img-circle"
                 src="{{Auth::user()->image}}"
                 alt="User" style="margin-top:-4px;height: 30px;width: 30px;">
           @else
            <img class="profile-user-img img-fluid img-circle"
                 src="{{asset('assets/back-end/settings/admin.png')}}"
                 alt="User" style="margin-top:-4px;height: 30px;width: 30px;">
           @endif


        </a>
        <div class="dropdown-menu dropdown-menu-md dropdown-menu-right">
          <span class="dropdown-item dropdown-header">  
            {{Auth::user()->name}}
          </span>
          <div class="dropdown-divider"></div>
          <a href="{{url('/profile')}}" class="dropdown-item" >
            <i class="fas fa-user"></i>
            Profile
          </a>
          <a class="dropdown-item" href="{{ route('logout') }}"
           onclick="event.preventDefault();
                         document.getElementById('logout-form').submit();">
                         <i class="fa fa-power-off "></i>&nbsp&nbsp&nbsp&nbspLogout
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

      <span>
        <center>
          <img src="{{asset('assets/images/logo.png')}}" width="33px" height="33px" alt="Hr Logo" 
           class="imgWrapper">
         </center>
       </span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar" style=" background-color:rgb(75, 71, 109) !important; ">
      
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <br><br>
        <li class="nav-header btn btn-primary btn-header"><a href="{{url('/home')}}" style="color:#fff !important; font-family: initial !important;">Dashboard</a></li><br>
          

          <li class="nav-item">
            <a href="{{url('/profile')}}" class="nav-link">
              <i class="nav-icon fa fa-user"></i>
              <p style="color:#fff !important; font-family: initial !important;">
                Profile
              </p>
            </a>
          </li>
            <li class="nav-item {{Request::path() ==='members' ? 'current_page_item' : ''}}">
            <a href="{{url('/members')}}" class="nav-link">
              <i class="nav-icon nav-icon fa fa-users"></i>
              <p style="color:#fff !important; font-family: initial !important;">
                Members
              </p>
            </a>
          </li>

            <li class="nav-item has-treeview">
            <a href="#" class="nav-link nav-link2">
              <i class="nav-icon fas fa-envelope"></i>
              <p style="color:#fff !important; font-family: initial !important;">Communication
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item ml-3">
                <a href="{{url('/z_mails')}}" class="nav-link nav-link2">
                  <i class="fas fa-angle-right"></i>
                  <p style="color:#fff !important; font-family: initial !important;">Mailbox</p>
                </a>
              </li>
              
            </ul>
          </li>


            <li class="nav-item has-treeview">
            <a href="#" class="nav-link nav-link2">
              <i class="nav-icon fa fa-area-chart"></i>
              <p style="color:#fff !important; font-family: initial !important;">Surveys
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item ml-3">
                <a href="{{url('/newsurvey')}}" class="nav-link nav-link2">
                  <i class="fas fa-angle-right"></i>
                  <p style="color:#fff !important; font-family: initial !important;">New Survey</p>
                </a>
              </li>
              <li class="nav-item ml-3">
                <a href="{{url('/existingSurvey')}}" class="nav-link nav-link2">
                  <i class="fas fa-angle-right"></i>
                  <p style="color:#fff !important; font-family: initial !important;">Existing Surveys</p>
                </a>
              </li>
            </ul>
          </li>


          <!-- <li class="nav-item">
            <a href="{{url('/newsurvey')}}" class="nav-link">
              <i class="nav-icon fa fa-clipboard"></i>
              <p style="color:#fff !important; font-family: initial !important;">
                New Survey
              </p>
            </a>
          </li>
          
            <li class="nav-item has-treeview">
            <a href="{{url('/existingSurvey')}}" class="nav-link">
              <i class="nav-icon fa fa-bar-chart"></i>
              <p style="color:#fff !important;font-family: initial !important;">
                Existing Surveys
              </p>
            </a>

          </li> -->

          <!-- <li class="nav-item has-treeview">
            <a href="{{url('/Surveyresponse')}}" class="nav-link">
              <i class="nav-icon fa fa-line-chart"></i>
              <p style="color:#fff !important; font-family: initial !important;">
                Survey Responses
              </p>
            </a>

          </li> -->

          <li class="nav-item">

           <!--  <a href="{{url('/logout')}}" class="nav-link">
              <i class="nav-icon fa fa-power-off"></i>
              <p style="color:#fff !important; font-family: initial !important;">
                Logout
              </p>
            </a> -->
              <a class="nav-link" href="{{ route('logout') }}"
           onclick="event.preventDefault();
                         document.getElementById('logout-form').submit();">
                         <i class="nav-icon fa fa-power-off "></i>
                         <p style="color:#fff !important; font-family: initial !important;">
                Logout
              </p>
        </a>

          </li>






        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
 
  </aside>

  @yield('content')
 
</div>
<!--include the loaders-->
    @include('uiassets.loaders')
<!--end loaders-->
  <!-- /.content-wrapper -->
  <footer class="main-footer" id="footer">
    
    <div class="float-right d-none d-sm-inline-block">
     
      <span>Copyright &copy; {{date('Y')}} <a href="https://zalegoinstitute.ac.ke">Zalego Academy</a></span>
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



<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->


  <!-- Bootstrap 4 -->
<!-- <script src="{{asset('assets/dashboard/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script> -->
<!-- vue js script -->
<script type="text/javascript" src="{{asset('/js/app.js')}}"></script>

<!-- AdminLTE App -->
<script src="{{asset('assets/dashboard/dist/js/adminlte.js')}}"></script>
 @include('sweetalert::alert')  
<script>
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

 const btn = document.querySelector(".btn"); 
  
    // Listen for click event 
    btn.onclick = function (e) { 
  
        // Create span element 
        let ripple = document.createElement("span"); 
  
        // Add ripple class to span 
        ripple.classList.add("ripple"); 
  
        // Add span to the button  
        this.appendChild(ripple); 
  
        // Get position of X 
        let x = e.clientX - e.target.offsetLeft; 
  
        // Get position of Y  
        let y = e.clientY - e.target.offsetTop; 
  
        // Position the span element 
        ripple.style.left = `${x}px`; 
        ripple.style.top = `${y}px`; 
  
        // Remove span after 0.3s 
        setTimeout(() => { 
            ripple.remove(); 
        }, 300); 
  
    }; 
</script>
</body>
</html>