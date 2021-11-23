 <!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>@yield('title', 'Zalego Survey')</title>
  <link rel="shortcut icon" href="{{asset('assets/back-end/settings/fav-icon.png')}}" type="image/png">
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!--csrf-token-->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- Font Awesome -->
  <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('assets/dashboard/dist/css/zalegohrstyles.css')}}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{asset('assets/dashboard/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
   <link rel="stylesheet" href="{{asset('assets/dashboard/plugins/fontawesome-free/css/all.min.css')}}">
  <link rel="shortcut icon" href="{{asset('assets/back-end/settings/logo.png')}}" type="image/png">
  

<link rel="stylesheet" type="text/css" href="{{asset('assets/css/w3v3.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/mainlrs2.css')}}">
<!-- <script src="{{asset('tinymce/tinymce.min.js')}}"></script> -->
  <style type="text/css">
@font-face{font-family:Poppins-Regular;src:url(../fonts/poppins/Poppins-Regular.ttf)}@font-face{font-family:Poppins-Medium;src:url(../fonts/poppins/Poppins-Medium.ttf)}@font-face{font-family:Poppins-Bold;src:url(../fonts/poppins/Poppins-Bold.ttf)}@font-face{font-family:Poppins-SemiBold;src:url(../fonts/poppins/Poppins-SemiBold.ttf)}body,html{color:#232d64;font-size:12px;overflow-x:initial!important;font-family:tahoma!important}.imgWrapper{background-color:rgba(255,155,68,.2);width:39px;height:39px;padding:7px;margin-bottom:-20px;margin-top:-20px;border-radius:50%}.dropdown-menu{border-color:transparent}.dropdown-item{font-size:14px}.breadcrumb{font-size:13px}.nav-item{font-weight:429;line-height:25px}.nav-link{color:#fff!important;font-size:13px}.nav-link2:hover{background:rgb(64,60,93,.7);color:#8e98d7!important;font-size:13px}.logoText{font-size:24px!important;margin-top:-9px!important;color:#232d64!important}.main-sidebar{-webkit-box-shadow:0 1rem 1rem rgba(46,68,105,.175)!important;box-shadow:0 1rem 1rem rgba(46,68,105,.175)!important}.content-wrapper{background-color:#f5f7f8!important}.os-theme-light>.os-scrollbar>.os-scrollbar-track>.os-scrollbar-handle{background:#dfe3e8!important}#infoNo{font-size:33px;color:#647489}.bg-warning{background-color:#f96f34!important}.bg-info{background-color:#668cff!important}.info-box-content{position:absolute;right:0!important}.info-box-text{font-weight:700}.info-box .info-box-icon{border-radius:.25rem;-ms-flex-align:center;align-items:center;display:-ms-flexbox;display:flex;font-size:1.875rem;-ms-flex-pack:center;justify-content:center;text-align:center;width:65px;margin-left:10px}.breadcrumb{font-size:12px}.dropdown-item{font-size:12px}label,tr td,tr th{color:#6c757d!important}.pillLink{color:#333!important}.nav-pills .nav-item.show .nav-link,.nav-pills .nav-link.active{background-color:#f96f34;border-color:#f96f34;color:#fff!important;-webkit-box-shadow:0 1rem 3rem rgba(172,56,6,.175)!important;box-shadow:0 1rem 3rem rgba(172,56,6,.175)!important}.btn-default:focus{background-color:#f96f34;border-color:#f96f34;color:#fff!important;-webkit-box-shadow:0 1rem 3rem rgba(172,56,6,.175)!important;box-shadow:0 1rem 3rem rgba(172,56,6,.175)!important}.btn-default:hover{background-color:#f96f34;border-color:#f96f34;color:#fff!important;-webkit-box-shadow:0 1rem 3rem rgba(172,56,6,.175)!important;box-shadow:0 1rem 3rem rgba(172,56,6,.175)!important}.files input{outline:2px dashed #92b0b3;outline-offset:-10px;-webkit-transition:outline-offset .15s ease-in-out,background-color .15s linear;transition:outline-offset .15s ease-in-out,background-color .15s linear;padding:120px 0 85px 35%;text-align:center!important;margin:0;width:100%!important}.files input:focus{outline:2px dashed #92b0b3;outline-offset:-10px;-webkit-transition:outline-offset .15s ease-in-out,background-color .15s linear;transition:outline-offset .15s ease-in-out,background-color .15s linear;border:1px solid #92b0b3}.files{position:relative}.files:after{pointer-events:none;position:absolute;top:60px;left:0;width:50px;right:0;height:56px;content:"";background-image:url(https://image.flaticon.com/icons/png/128/109/109612.png);display:block;margin:0 auto;background-size:100%;background-repeat:no-repeat}.color input{background-color:#f1f1f1}.files:before{position:absolute;bottom:10px;padding-top:30px!important;left:0;pointer-events:none;width:100%;right:0;height:57px;content:"Drag and drop a file here/ Click to select. ";display:block;margin:0 auto;color:#2ea591;font-weight:600;text-transform:capitalize;text-align:center}.bg-primary,.btn-primary{background-color:#668cff;border-color:#668cff}.alert-success,.bg-success{background-color:#0c4;border-color:#0c4}.alert-warning,.bg-warning,.btn-warning{background-color:#f96f34;border-color:#f96f34;color:#fff}.btn-submit{transition:.4s}.alert-danger{background-color:#dc3545;color:#fff;font-size:10px}.btn-warning1:hover{background-color:#f75008;border-color:#f75008;color:#fff}.btn-primary1.active{background-color:#f75008;border-color:#f75008;color:#fff}.btn-danger:hover,.btn-primary:hover,.btn-submit:hover,.btn-success:hover,.btn-warning:hover{-webkit-box-shadow:0 1rem 3rem rgba(0,0,0,.175)!important;box-shadow:0 1rem 3rem rgba(0,0,0,.175)!important}.btn-danger:focus,.btn-primary:focus,.btn-submit:focus,.btn-success:focus,.btn-warning:focus{-webkit-box-shadow:0 1rem 3rem rgba(0,0,0,.175)!important;box-shadow:0 1rem 3rem rgba(0,0,0,.175)!important}.btn-primary1{background-color:transparent;border-color:#03c;color:#03c}.btn-success1{background-color:transparent;border-color:#0c4;color:#0c4}.btn-secondary1{background-color:transparent;border-color:#939;color:#939}.btn-secondary1:focus{background-color:#939;border-color:#939;color:#fff}.btn-warning1{background-color:transparent;border-color:#f96f34;color:#f96f34}.btn-primary1:focus{background-color:#0063cc;border-color:#0063cc;color:#fff}.btn-warning1:focus{background-color:#f75008;border-color:#f75008;color:#fff}.btn-success1:focus{background-color:#0c4;border-color:#0c4;color:#fff}.modal-content{-webkit-box-shadow:0 1rem 3rem rgba(0,0,0,.175)!important;box-shadow:0 1rem 3rem rgba(0,0,0,.175)!important;background-color:#fff;border-color:transparent}.modal-dialog{margin-top:40px!important}.profileHolder{border:5px solid #f9f8f8}.modalCardBody{background:#eef2f4;border-radius:2px;margin-top:-3px!important;margin:30px 20px}.modal-body{padding:2rem;background-color:#fff}.modal-backdrop{background-color:#000;transition:1.7s linear}.modal-backdrop.fade{opacity:0}.modal-backdrop.show{opacity:.03}.btn-error{position:fixed;z-index:999;display:none;right:0;margin-right:5px}.errorSheet{display:none;right:0;z-index:999;position:fixed;margin-right:5px;top:200px;min-width:300px}#cPasswordError,#contactError,#emailError,#nameError,#passwordError{display:none}.imageHolder{width:97px;height:97px;border:3px solid #d1d3e2!important;border-radius:4px;margin-bottom:7px;position:absolute;z-index:999;right:0;margin-right:30px;margin-top:40px}.border-bottom{border-bottom:1px solid #2f456a!important}#progress{border-bottom:5px solid #fff;width:0;position:relative;margin-top:0;left:0;border-radius:3px 3px 0 0;transition:.7s linear}hr{height:1px;background-color:#d4d7de;border:none}.infoText{font-size:14px}.btn-header{background:#f96f34;border-color:#f96f34;font-size:17px!important;font-family:calibri;border-radius:40px;-webkit-box-shadow:0 1rem 3rem rgba(250,132,82,.175)!important;box-shadow:0 1rem 3rem rgba(250,132,82,.175)!important}.btn-header:hover{background:#f96f34;border-color:#f96f34}.btn-header a:hover{color:#fff!important}.btn-toggle{background:#f96f34;border-color:#f96f34;-webkit-box-shadow:0 1rem 3rem rgba(251,167,131,.475)!important;box-shadow:0 1rem 3rem rgba(251,167,131,.475)!important;position:relative;margin-left:-34px;z-index:9999!important;border-radius:30%}.btn-toggle:hover{background:#f96f34;border-color:#f96f34}.btn-toggle a:hover{color:#fff;background:#f96f34;border-color:#f96f34}.btn-primary{background-color:#f96f34;border-color:#f96f34;color:#fff!important;-webkit-box-shadow:0 1rem 3rem rgba(172,56,6,.175)!important;box-shadow:0 1rem 3rem rgba(172,56,6,.175)!important}.btn-primary:active{background-color:#f96f34;border-color:#f96f34;color:#fff!important;-webkit-box-shadow:0 1rem 3rem rgba(172,56,6,.175)!important;box-shadow:0 1rem 3rem rgba(172,56,6,.175)!important}.btn-primary:focus{background-color:#f96f34;border-color:#f96f34;color:#fff!important;-webkit-box-shadow:0 1rem 3rem rgba(172,56,6,.175)!important;box-shadow:0 1rem 3rem rgba(172,56,6,.175)!important}.loader1{border:16px solid #f97339;border-radius:50%;border-top:16px solid #f96f34;width:120px;height:120px;-webkit-animation:spin 2s linear infinite;animation:spin 2s linear infinite}@-webkit-keyframes spin{0%{-webkit-transform:rotate(0)}100%{-webkit-transform:rotate(360deg)}}@keyframes spin{0%{transform:rotate(0)}100%{transform:rotate(360deg)}}.pagination>li{padding:20px 4px}.pagination>li>a{background:#fff;color:gray;border-radius:50%;-webkit-box-shadow:0 1rem 1rem rgba(255,51,0,.175)!important;box-shadow:0 1rem 1rem rgba(255,51,0,.175)!important;border-color:transparent;transition:.4s linear}.pagination>li>a:focus,.pagination>li>a:hover,.pagination>li>span:focus,.pagination>li>span:hover{color:#fff;background-color:#ff5c33;border-color:transparent;border-radius:50%;-webkit-box-shadow:0 1rem 1rem rgba(255,51,0,.175)!important;box-shadow:0 1rem 1rem rgba(255,51,0,.175)!important}.pagination>.active>a{color:#fff!important;background-color:#ff5c33!important;border-color:transparent!important;-webkit-box-shadow:0 1rem 1rem rgba(255,51,0,.175)!important;box-shadow:0 1rem 1rem rgba(255,51,0,.175)!important}.pagination>.active>a:hover{color:#fff!important;background-color:#ff9980!important;border-color:transparent!important;-webkit-box-shadow:0 1rem 1rem rgba(255,51,0,.175)!important;box-shadow:0 1rem 1rem rgba(255,51,0,.175)!important}.page-link{border-radius:50%!important}.page-item.active .page-link{color:#fff!important;background-color:#f30!important;border-color:transparent!important;-webkit-box-shadow:0 1rem 1rem rgba(255,51,0,.175)!important;box-shadow:0 1rem 1rem rgba(255,51,0,.175)!important}.linkBt{border-radius:5%!important;-webkit-box-shadow:0 1rem 1rem rgba(255,51,0,.175)!important;box-shadow:0 1rem 1rem rgba(255,51,0,.175)!important}.nav-link.active{color:#000!important;font-size:13px}
  </style>
<style>
html,body{
overflow-x:hidden !important;
font-family: 'Google Sans',Roboto,Arial,sans-serif;
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
    .label-input100 {
    font-family: 'Google Sans',Roboto,Arial,sans-serif !important;
    font-size: 20px !important;
    color: #ff6600 !important;
  }
  .input100 {
    font-size: 14px !important;
    line-height: 1 !important;
  }
  .wrap-input100 {
    border-bottom: 1px solid #dbdbdb;
    margin-bottom: 10px !important;
  }
  input.star { display: none; }

label.star {
  float: right;
  padding: 5px;
  font-size: 20px;
  color: #444;
  transition: all .2s;
}

input.star:checked ~ label.star:before {
  content: '\f005';
  color: #FD4;
  transition: all .25s;
}

input.star-5:checked ~ label.star:before {
  color: #FE7;
  text-shadow: 0 0 20px #952;
}

input.star-1:checked ~ label.star:before { color: #F62; }

label.star:hover { transform: rotate(-15deg) scale(1.3); }

label.star:before {
  content: '\f006';
  font-family: FontAwesome;
}
#glyphicon { margin-right:5px;}
.rating #glyphicon {font-size: 10px;}
.rating-num { margin-top:0px;font-size: 15px; }
.progress { margin-bottom: 5px;height:5px;}
.progress-bar { text-align: left; }
.rating-desc .col-md-3 {padding-right: 0px;}
.sr-only { margin-top: 5px;overflow: visible;clip: auto; color:#f96f34;}
#ratingz{color: #6c757d !important;}
</style>
</head>
  <body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">

  <div class="site-wrap">

   <!--  <div class="site-mobile-menu site-navbar-target">
      <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close mt-3">
          <span class="icon-close2 js-menu-toggle"></span>
        </div>
      </div>
      <div class="site-mobile-menu-body"></div>
    </div> -->
   


    <div class="site-blocks-cover overlay bg-light" style="box-shadow: inset 0 0 0 2000px rgba(255,255,255,0.4); background-image: url('https://hrmis.zalegoenterprise.com/zalegosurvey/public/imgsurv.png'); background-repeat: no-repeat;background-attachment: fixed;background-size: cover;" id="home-section">

      <div class="container" style="z-index:9999">
        <div class="row justify-content-left">
          @if(session('submitted'))
          <div class="col-12 text-center align-self-center text-intro" style="margin-top:200px;margin-bottom:250px;">
            <div class="row justify-content-center">
              <div class="col-lg-8">
                <h1 class="text-default" data-aos="fade-up" data-aos-delay="" style="font-size: 120px; font-family: Tw Cen MT; font-weight: bold;">Success</h1>
                <p class="lead text-default" data-aos="fade-up" data-aos-delay="100" style="font-size: 20px;">Thank you for submitting your feedback!<br><br>
                <p data-aos="fade-up" data-aos-delay="200"><a href="https://zalegoinstitute.ac.ke/public/" class="btn smoothscroll btn-primary shadow-lg">Visit our website</a></p>

              </div>
            </div>
          </div>
          @else
          <div class="col-12 text-center align-self-center text-intro">
            <div class="row justify-content-center">
              <div class="col-lg-8">
                @if(is_null($survey))
                <div class="col-12 text-center align-self-center text-intro" style="margin-top:200px;margin-bottom:250px;">
            <div class="row justify-content-center">
              <div class="col-lg-8">
                <h1 class="text-default" data-aos="fade-up" data-aos-delay="" style="font-size: 120px; font-family: Tw Cen MT; font-weight: bold;">404</h1>
                <p class="lead text-default" data-aos="fade-up" data-aos-delay="100" style="font-size: 20px;">We did not find the survey you requested!<br><br>
                <p data-aos="fade-up" data-aos-delay="200"><a href="https://zalegoinstitute.ac.ke/public/" class="btn smoothscroll btn-primary shadow-lg">Visit our website</a></p>

              </div>
            </div>
          </div>
          @endif
                @if(!is_null($survey))
                <br><br><br>
            <div class="card px-3 py-3 shadow"  style="background:rgba(255,255,255,.9) !important">
              <!-- margin-top: -65px; -->
              <div class="card-header" style="border-bottom:none !important;">
                <div class="d-flex justify-content-between">
                      <a href="https://zalegoacademy.ac.ke/public"><img src="https://zalegoacademy.ac.ke/public/asset/img/newLogo.png" class="img-responsive" style="height:90px; max-width:100px;"></a>
                      <a href="https://www.ihrm.or.ke/"><img src="https://hrmis.zalegoenterprise.com/zalegosurvey/public/assets/images/newihrm.jpg" class="img-responsive" style="height:90px; max-width:100px;"></a>
                      <a href="https://atarahsolutions.co.ke/"><img src="https://hrmis.zalegoenterprise.com/zalegosurvey/public/assets/images/atarah.jpg" class="img-responsive" style="height:90px; max-width:100px;"></a>
                </div>
                
               <!-- https://hrmis.zalegoenterprise.com/zalegosurvey/public/newicon.png -->
              </div>
             <div class="card-body" style="background:rgba(255,255,255,.1) !important">
                <div class="row">
                  <div class="wrap-input100 validate-input" style="border-bottom: none !important; margin-bottom: 30px !important;">
                        <span class="label-input100">{{$survey->company}}</span>
                        <!-- <input type="name" class="input100 " readonly name="name" value="" readonly autocomplete="name">
                        <span class="focus-input100"></span> -->
                    </div>
                   <div class="wrap-input100 validate-input" style="border-bottom: none !important; margin-bottom: 30px !important;">
                        <span class="label-input100">Survey Name <span style="color: #1F2D3D !important;">: </span>{{$survey->survey_name}}</span>
                        <!-- <input type="name" class="input100 " readonly name="name" value="" readonly autocomplete="name">
                        <span class="focus-input100"></span> -->
                    </div>
                    @if(!is_null($survey->survey_description))
                   <div class="wrap-input100 validate-input" style="border-bottom: none !important;">
                        <span class="label-input100" style="margin-bottom: 10px !important;">Survey Description</span><br><br>
                          <label style="color: #1F2D3D !important; font-weight:10 !important;font-size: 17px !important; line-height: inherit !important;" class="text-center label-input100">{{$survey->survey_description}}</label>
                        <!-- <input type="description" class="input100" readonly name="description" value="" readonly autocomplete="description" >
                        <span class="focus-input100"></span> -->
                    </div>
                    @endif
                </div>
              </div>
            </div>
            <?php $count=1; ?>
            <form action="{{url('/rateSurvey')}}" method="post">
              @csrf
            <input type="hidden" name="survey_id" value="{{$survey->id}}">
              @foreach($questions as $question)
              
              <input type="hidden" name="question_id[{{$question->id}}]" value="{{$question->id}}">
              <input type="hidden" name="reply_mode[{{$question->id}}]" value="{{$question->reply_mode}}">

              <div class="card px-3 py-3 shadow-lg" id="initialCard1" style="border-radius: 15px;background:rgba(255,255,255,.9) !important">
              <div class="card-header">
                <div class="row d-flex justify-content-between align-items-center">
                  <div>
                  <span class="label-input100" style="font-size:16px !importantl;">Question {{$count++}}</span>
                  </div>
                  <div>
                     <!-- <button type="button" class="btn btn-primary shadow-sm addbtns" onclick="addQuestion(1,0);"  title="Add Survey Question" style="width: 30px; height: 30px; border-radius: 50%;" id="hideadd1"><i class="fas fa-plus fa-1x"></i></button>&nbsp;&nbsp; -->
            
                     <!-- <button type="button" class="btn btn-danger shadow-sm addbtns" onclick="removeQuestion(1);" title="Remove Survey Question"  style="width: 30px; height: 30px; border-radius: 50%;" id="removebtn1"><i class="fas fa-minus fa-1x"></i></button> -->
                  </div>
       
                </div>
              </div>
             <div class="card-body"style="background:rgba(255,255,255,.1) !important">
                <div class="row">
                   <div class="col-md-12">
                    <div class="wrap-input100 validate-input" style="border-bottom: none !important;">
                          <label style="color: #1F2D3D !important; font-weight:10 !important;font-size: 16px !important;display:block !important; line-height: inherit !important;" class="text-left label-input100">{{$question->question}}</label>
                        <!-- <input type="description" class="input100" readonly name="description" value="" readonly autocomplete="description" >
                        <span class="focus-input100"></span> -->
                    </div>
                    <!-- <div class="wrap-input100 validate-input" style="border-bottom: none;"> -->
                        <!-- <span class="label-input100">Question</span> -->
                        <!-- <label style="color: #1F2D3D !important; font-weight:10 !important;font-size: 17px !important; line-height: inherit !important;" class="text-left label-input100">{{$question->question}}</label> -->
                        <!-- <input type="question" class="input100" id="select" readonly value="{{$question->question}}" autocomplete="question" > -->
                        <!-- <span class="focus-input100"></span> -->
                    <!-- </div> -->
                   </div>
               
                  <div class="col-12">
                   <div id="replFeedback0ss" style="text-align: start !important;">
                    @if($question->reply_mode==1)
                    <div class="wrap-input100 validate-input">
                      <input type="text" class="input100" name="reply[{{$question->id}}]" value="{{old('reply')}}" autocomplete="reply" placeholder="Your feedback here">
                      <span class="focus-input100"></span></div>

                    @endif
                    @if($question->reply_mode==2)
                      <div class="form-group">
                      <span style="float:left; margin-left:5px;">Select feedback </span><br>
                      <select name="reply[{{$question->id}}]" id="replyMode1" class="form-control" style="height: calc(3.25rem + 8px) !important;border: 2px solid #ced4da !important;">
                      <option selected disabled>Select feedback</option>
                    @foreach($answers as $ans)
                    @if($question->id==$ans->question_id)
                    <option value="{{$ans->id}}">{{$ans->answer}}</option>
                      @endif
                      @endforeach
                      </select>
                    </div>
                      @endif

                      @if($question->reply_mode==3)
                      <div class="">
                       @foreach($answers as $ans)
                    @if($question->id==$ans->question_id)
                    &nbsp;<label style="text-align: start !important;"><input type="radio" name="reply[{{$question->id}}]" value="{{$ans->id}}" style="vertical-align:top;"> {{$ans->answer}}</label><br><br>
                    
                      @endif
                      @endforeach
                      </div>
                      @endif
                      @if($question->reply_mode==7)
                      <div class="">
                       @foreach($answers as $ans)
                    @if($question->id==$ans->question_id)
                    &nbsp;<label style="text-align: start !important;"><input type="checkbox" name="reply{{$question->id}}[]" value="{{$ans->id}}" style="vertical-align:top;"> &nbsp;{{$ans->answer}}</label><br><br>
                    
                      @endif
                      @endforeach
                      </div>
                      @endif
                      @if($question->reply_mode==4)
                      <div class="form-group ">
                         <div class="stars">
                      <div class="row ">
                      <center>
                        <!-- <p style="margin:0;display:inline:float:right"></p> -->
                      <span style="font-size: 14px; margin-left:15px;">Give a rating to this question</span><br><br>
                        <h6 id="status{{$question->id}}" style="margin: 0 -3px !important;"></h6>
                      <input class="star star-5" id="star-5x{{$question->id}}" type="radio" onclick="showValues(5,{{$question->id}})" name="reply[{{$question->id}}]" value="5"/>
                      <label class="star star-5" for="star-5x{{$question->id}}"></label>
                      <input class="star star-4" id="star-4x{{$question->id}}" type="radio" onclick="showValues(4,{{$question->id}})" name="reply[{{$question->id}}]" value="4"/>
                      <label class="star star-4" for="star-4x{{$question->id}}"></label>
                      <input class="star star-3" id="star-3x{{$question->id}}" type="radio" onclick="showValues(3,{{$question->id}})" name="reply[{{$question->id}}]" value="3"/>
                      <label class="star star-3" for="star-3x{{$question->id}}"></label>
                      <input class="star star-2" id="star-2x{{$question->id}}" type="radio" onclick="showValues(2,{{$question->id}})" name="reply[{{$question->id}}]" value="2"/>
                      <label class="star star-2" for="star-2x{{$question->id}}"></label>
                      <input class="star star-1" id="star-1x{{$question->id}}" type="radio" onclick="showValues(1,{{$question->id}})" name="reply[{{$question->id}}]" value="1"/>
                      <label class="star star-1" for="star-1x{{$question->id}}"></label>
                      </center>
                      </div> </div> </div>
                      @endif
                      @if($question->reply_mode==5)
                       @foreach($markx as $mark)
                    @if($question->id==$mark->question_id)
                      <div class="row">
              <div class="form-group col-sm-8">
                <?php $marks=$mark->marks; ?>
                <p style=" float:left;"> Scroll the bar to award points to this question in a scale of <strong>{{$marks}}</strong>.</p>
                    
                     <input type="range" name="reply[{{$question->id}}]" id="pointsx{{$question->id}}" onchange="pointsGetx(<?php echo $mark->marks;?>,{{$question->id}})" min="0" class="form-control" max="{{$marks}}" >
                  </div> 
                   <div class="col-sm-4">
                    <center>
                       <div  class="shadow bg-warning" style=" background:#ff6600 !important; border:1px solid transparent; width:60px; height: 60px; border-radius:  50%; color: #fff;">
                          <center>
                        <h4 style="margin-top: 15px; color: #fff;" ><strong id="pointerElement{{$question->id}}"></strong></h4>
                      </center>
                      </div>
                      </center>
                    </div>
                  </div>
                      @endif
                      @endforeach
                     @endif
                     @if($question->reply_mode==6)
                     <div class="wrap-input100 validate-input">
                      <input type="date" class="input100" name="reply[{{$question->id}}]" autocomplete="reply" placeholder="Your feedback here">
                      <span class="focus-input100"></span></div>
                     @endif
                     @if($loop->last)
                        <div class="form-group col-sm-12 text-center" style="margin-top:30px;">
                    <label>
                      <input type="radio" id="chk" checked="true" name="anonymous" value="1"> Be anonymous<label>
                        
                      </label>
                      &nbsp;&nbsp; &nbsp; &nbsp;
                   <label>
                        <input type="radio" name="anonymous" id="chk" value="0"> Show my identity
                      </label>
                  </div>
                    <div  id="name" style="display:none;"><div class="row">
                       <div class="col-6">
                        <div class="form-group">
                          <label style="float:left;">Enter your name</span></label>
                          <div class="wrap-input100 validate-input">
                          <input type="text" class="input100" name="clientName" id="tys"  autocomplete="clientName" placeholder="FullName">
                          <span class="focus-input100"></span></div>
                         </div>
                        </div>
                         <div class="col-6">
                        <div class="form-group">
                          <label style="float:left;">Your email address</span></label>
                          <div class="wrap-input100 validate-input">
                          <input type="email" class="input100" name="email" id="tyss"  autocomplete="email" placeholder="Your email address">
                          <span class="focus-input100"></span></div>
                         </div>
                        </div>

                       </div>
                     </div>
                     @endif
                    </div>
                  </div>
                </div>
              </div>

            </div>
              @endforeach
              
              <span id="questionHolder"></span>
              <div class="row">
                <br>
                <div class="col-12">
                  <button class="btn btn-block btn-primary " style="" type="submit"><i class="fa fa-paper-plane"></i> Submit survey</button>
                </div>
              </div>
              <br><br>
              <br>
            @endif
          </form>
          <p style="color:#000 !important; font-size:15px;">All rights reserved <span>Copyright &copy; {{date('Y')}}, Powered by <a href="https://zalegoinstitute.ac.ke" class="text-primary">Zalego Academy</a></span></p>
             <br><br>
              <br>
              </div>
            </div>
          </div>
            @endif
        </div>
      </div>

    </div>  


  </div> <!-- .site-wrap -->
<script type="text/javascript" src="{{asset('/js/app.js')}}"></script>

<!-- AdminLTE App -->
<script src="{{asset('assets/dashboard/dist/js/adminlte.js')}}"></script>
@include('sweetalert::alert')
<script type="text/javascript">
function showValues(id,quizId){
  if(id==1){
document.getElementById('status'+quizId).innerHTML="Poor";
    }
    if(id==2){
document.getElementById('status'+quizId).innerHTML="Fair";
    }
    if(id==3){
document.getElementById('status'+quizId).innerHTML="Average";
    }
  if(id==4){
document.getElementById('status'+quizId).innerHTML="Good";
    } 
    if(id==5){
document.getElementById('status'+quizId).innerHTML="Excellent";
    }  
}
function pointsGetx(id,quizId){
var point=$("#pointsx"+quizId).val();
    document.getElementById('pointerElement'+quizId).innerHTML=point;
}
$(document).ready(function(){
$("input[name='anonymous']").change(function(){
if($(this).val()=="0")
{
$("#name").slideDown();
$("#tys").prop('required',true);
$("#tyss").prop('required',true);
}
else
{
$("#name").fadeOut(); 
$("#tys").prop('required',false);
$("#tyss").prop('required',false);
}
});
});

</script>
  </body>
</html>