@extends('layouts.main')

@section('content')
<style type="text/css">
 .outer {
    width: 100%;
    height: 100px;
    white-space: nowrap;
    position: relative;
    overflow-x: scroll;
    overflow-y: hidden;
    -webkit-overflow-scrolling: touch;
}

.outer div {
    width: 24.5%;
    background-color: #eee;
    float: none;
    height: 90%;
    margin: 0 0.25%;
    display: inline-block;
    zoom: 1;
}

.outer::-webkit-scrollbar {
      height: 9px;

    }

    /* Track */
    .outer::-webkit-scrollbar-track {
      box-shadow: inset 0 0 5px grey; 
      border-radius: 1px;
    }
     
    /* Handle */
    .outer::-webkit-scrollbar-thumb {
           background: #85adad;
            border-radius: 20px;
    }

    /* Handle on hover */
    .outer::-webkit-scrollbar-thumb:hover {
      background:  #476b6b; 
    }
</style>
 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-muted ml-2 mt-4"><strong>Welcome</strong>, {{Auth::user()->name}}!</h1>
            <ol class="breadcrumb float-sm-left ml-2">
              <li class="breadcrumb-item"><a href="{{url('/home')}}"><i class="fa fa-home"></i></a></li>
              <li class="breadcrumb-item active"><a href="{{url('/home')}}">Home</a></li>
              <li class="breadcrumb-item active">My Dashboard</li>
            </ol>
          </div><!-- /.col -->
          <div class="col-sm-6">
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
        <div class="container-fluid">
              <!-- Info boxes -->
        <div class="row">
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box shadow-sm">
              <span class="info-box-icon bg-info  elevation-1" style="opacity:.6; border-radius: 50%;"><i class="  fas fa-boxes"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Projects</span>
                <span class="info-box-number">
                  <h4 id="infoNo"><strong>10</strong></h4>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3 shadow-sm">
              <span class="info-box-icon bg-danger elevation-1" style="opacity:.6; border-radius: 50%;"><i class="fas fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Clients</span>
                <h4 id="infoNo"><strong>14</strong></h4>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3 shadow-sm">
              <span class="info-box-icon bg-success elevation-1" style="opacity:.6; border-radius: 50%;"><i class="fas fa-file"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Tasks</span>
                <h4 id="infoNo"><strong>19</strong></h4>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3 shadow-sm">
              <span class="info-box-icon  bg-warning elevation-1" style="opacity:.6; border-radius: 50%;"><i class="fas fa-school  text-white"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Employees</span>
                <h4 id="infoNo"><strong>170</strong></h4>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
        </div>
    </section>

    <!--section 1-->
   <section class="content mt-5">

    <div class="container-fluid">
      

      <div class="row">
          <div class="col-sm-4" style="display: none;">
           <div class="card shadow-sm">
           
            <div class="card-body">
              <h5 class="text-muted"><strong>Statistics</strong></h5><br>

      <div class="card py-4 px-2">
        <span class="mb-1 text-muted">Completed Projects<strong class="float-right">25%</strong></span>

        <div class="progress" style="height:4px;">
          <div class="progress-bar bg-success" role="progressbar" style="width:25%; " aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
      </div>
      <div class="card py-4 px-2">
        <span class="mb-1 text-muted">Overdue Tasks<strong class="float-right">55%</strong></span>
        
        <div class="progress" style="height:4px;">
          <div class="progress-bar bg-danger" role="progressbar" style="width:55%; " aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
      </div>

      <div class="card py-4 px-2">
        <span class="mb-1 text-muted">New members<strong class="float-right">15%</strong></span>
        
        <div class="progress" style="height:4px;">
          <div class="progress-bar bg-info" role="progressbar" style="width:15%; " aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
      </div>
        <br><br>
        

                    </div>
          </div>
        </div>

       
      </div>
      
    </div>
     
   </section> 
   
    <!--section 1-->

  
</div>

@endsection

