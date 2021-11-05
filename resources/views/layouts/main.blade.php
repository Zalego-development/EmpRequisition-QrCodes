<!DOCTYPE html>
<html>
<head>
   <meta name="csrf-token" content="{{ csrf_token() }}">
 @include('includes.header-links')
 <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">

  <!-- ========Navbar-============== -->
  @include('includes.navbar')
  <!-- -=================end navbar===================== -->

  <!-- Main Sidebar Container -->
  @include('includes.sidebar')

 <!-- all content  -->
  @yield('content')
  <!--====end yield==== -->
<script type="text/javascript">
      $(function () {
        $('table').dataTable();
        $('#example1').dataTable();
        $('#example2').dataTable();
        $('#example3').dataTable();
    });
</script>
</script>

<!--include the loaders-->
    @include('uiassets.loaders')
<!--end loaders-->
@include('sweetalert::alert')

<!--====================help modal=================================-->
<div class="modal" id="helpModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="row">
        <div class="col-sm-4" style="background-image:url('images/zhelp2.gif');background-repeat: no-repeat; background-size: cover; background-position: center;">

        </div>
        <div class="col-sm-8">
          <h5 class="mt-3"><strong>Hello {{Auth::user()->name}}
          !</strong></h5> <span class="text-muted"> This is Z<i>-help</i>, how can i help you? Choose from the list below</span>
          <ol>
            <li> <a href="#" onclick="window.location.assign('./zhelp_hrsettings')">I would like some assistance in spinning up the HR settings</a></li>
            <li> <a href="#">Guide me through payroll processing</a></li>
            <li> <a href="#">Help set up a perfomance template</a></li>
             <li> <a href="#">I am unable to post a new job in recruitment</a></li>
          </ol>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- ============================End HELP MODAL=============================-->

<audio style="display: block;" id="notificationSound">
  <source src="{{asset('images/notification.mp3')}}" type="audio/mpeg">
</audio>
<!--help modal-->



  <!-- INCLUDE FOOTER -->
  @include('includes.footer')

</div>
@include('includes.script')
<!-- Latest compiled and minified JavaScript -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- (Optional) Latest compiled and minified JavaScript translation files -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/i18n/defaults-*.min.js"></script>
<script type="text/javascript">
  
  </body>
  </html>


 