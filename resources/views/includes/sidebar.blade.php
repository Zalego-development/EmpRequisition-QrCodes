<aside class="main-sidebar" style="background-image:url('../images/shots/10.jpg'); background-repeat: repeat-y;">
    <!-- Brand Logo -->
    <a href="{{url('/home')}}" class="brand-link" style=" padding-top: 1.4rem !important; padding-bottom: 1.25rem !important; background-color:rgb(75, 71, 109) !important;">
        <span><center><img src="{{asset('images/logo.png')}}" width="33px" height="33px" alt="Zalego Smart Hr Logo" 
           class="imgWrapper"></center>
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
        <li class="nav-header btn btn-primary btn-header"><a href="{{url('/home')}}">Dashboard</a></li><br>

            <li class="nav-item has-treeview">
            <a href="{{url('/employeesqrcodes')}}" class="nav-link nav-link2">
              <i class="nav-icon fas fa-eye"></i>
              <p>
               Employee QR Codes
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
          </li>

        </ul>
      </nav>
    </div>
</aside>