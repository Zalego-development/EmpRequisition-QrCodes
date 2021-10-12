<nav class="main-header navbar fixed-topnav navbar-expand navbar-white navbar-light py-3" style="background:white;">
<!--================================= Left navbar links=========================== -->
    <ul class="navbar-nav">
        <button class="btn btn-default btn-toggle">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="ml-3 fas fa-bars" style="margin-top:-6px !important;"></i></a>
        </button>
        <li class="nav-item d-none d-sm-inline-block" id="companyName" style="padding-top: 5px;"><a class="nav-link logoText pt-3"  href="{{url('/home')}}">Zalego Template </a></li>
    </ul>
<!-- ==============================Right navbar links===================================== -->
    <ul class="navbar-nav ml-auto" >
        {{-- <span class="ml-5 bg-info px-2 rounded shadow-lg" onclick="window.location.assign('http://localhost/hr/public/zdocs')" title="Manage your documents easily"  style="margin-top: -6px; cursor:pointer;">
            <h6 class="text-white"><i class="fas fa-file"></i> E<i>-docs</i></h6>
        </span>
        <span class="ml-5 bg-info px-2 rounded shadow-lg" data-toggle="modal" data-target="#helpModal" title="Quickly setup things" onclick="document.getElementById('notificationSound').play()" style="margin-top: -6px; cursor:pointer;">
            <h6 class="text-white"><i class="fas fa-question-circle"></i> Z<i>-help</i></h6>
        </span>--}}
        <span class="ml-5 bg-light px-3 shadow-sm" style="margin-top: -6px;">
            <h4 id="clockdisplayDesktop" class="text-muted">00:00:00 AM</h4>
        </span> 
<!--================================end right navLink================================================= -->

<!--==============================================Messages Dropdown Menu========================================================-->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-bell text-primary"></i>
            <span class="badge badge-danger navbar-badge" id="countNot2">0</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <span id="nHolder2"></span>
            </div>
        </li>
<!-- =================================Notifications Dropdown Menu================================================== -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="fas fa-bell text-muted"></i>&nbsp
                <span class="badge badge-warning navbar-badge"><span id="countNot1"><img src="{{asset('images/loader.gif')}}" style="margin-top: -1px;" width="10px" height="10px"></span></span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="display:nonek;">
                <span class="dropdown-item dropdown-header"><span id="countNot"></span> Notifications &nbsp&nbsp&nbsp<a href="{{url('/home')}}"><i class="fas fa-undo"></i> </a>
                </span>

                <span id="nHolder"></span>
                <div class="dropdown-divider"></div>
                <a href="{{url('/notifications')}}" class="dropdown-item dropdown-footer">See All Notifications</a>
            </div>
        </li>
<!--===================================================end Notification dropdown===================================== -->

<!--===================================== User Menu =============================================-->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                @if(Auth::user()->image=="")
                    <span class="img-circle elevation-1 bg-warning text-white px-3 py-3">
                    <strong style="color: #fff !important;">
                        <!--Display first and second letters -->
                        <?php
                        $str=Auth::user()->name;
                        echo strtoupper($str[0]).''.strtoupper($str[1]) ;
                        ?>
                        <!--====================end-================= -->
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
                    <i class="fas fa-user mr-2"></i> Profile
                </a>
                
                <a href="#" class="dropdown-item">
                    <i class="fas fa-cog mr-2"></i> Settings
                </a>
                <a class="dropdown-item" href="#"
                            onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                    <i class="fas fa-power-off mr-2"></i>Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </li>
    </ul>
  </nav>