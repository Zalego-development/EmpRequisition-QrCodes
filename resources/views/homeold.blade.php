@extends('layouts.main')

@section('content')
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
              <span class="info-box-icon bg-info elevation-1" style="border-radius: 50%;"><i class="  fas fa-boxes"></i></span>

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
              <span class="info-box-icon bg-danger elevation-1" style="border-radius: 50%;"><i class="fas fa-users"></i></span>

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
              <span class="info-box-icon bg-success elevation-1" style="border-radius: 50%;"><i class="fas fa-file"></i></span>

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
              <span class="info-box-icon  bg-warning elevation-1" style="border-radius: 50%;"><i class="fas fa-school  text-white"></i></span>

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
          <div class="col-sm-4">
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

        <div class="col-sm-4">
           <div class="card shadow-sm">
           
            <div class="card-body">
              <h5 class="text-muted"><strong>Task Statistics</strong> &nbsp<a data-toggle="tooltip" data-placement="top" title="Refresh" class="float-right refreshBtn" href="{{url('/home')}}"><small class="text-muted"><i class="fa fa-undo"></i></small></a></h5><br>
            <canvas id="myChart" height="240px"></canvas>


            </div>
        </div>
        </div>

         <div class="col-sm-4">
           <div class="card shadow-sm">
           
            <div class="card-body">
              <h5 class="text-muted"><strong>Employee Leave Statistics</strong> &nbsp<a class="float-right refreshBtn" data-toggle="tooltip" data-placement="top" title="Refresh" href="{{url('/home')}}"><small class="text-muted"><i class="fa fa-undo"></i></small></a></h5><br>
            <canvas id="myChart2" height="240px"></canvas>



            </div>
        </div>
        </div>
      </div>
      
    </div>
     
   </section> 
   
    <!--section 1-->

    <!--section 2-->
    <section class="content mt-5">
      <div class="row">
        <div class="col-sm-6">
          <div class="card shadow-sm">
            <div class="card-header">
              <h5 class="text-muted"><strong>Projects</strong></h5>
            </div>

            <div class="card-body">
              <div class="table-responsived">
                <table class="table table-striped">
                  <tr>
                    <th>Project name</th>
                    <th>Progress</th>
                    <th><center>Action</center></th>
                  </tr>
                  <tr>
                    <td>Project 1</td>
                    <td>
                        <div class="progress mt-2" style="height:3px;">
          <div data-toggle="tooltip" data-placement="top" title="30%"  class="progress-bar bg-info" role="progressbar" style="width:15%; " aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
                    </td>
                    <td>
                      <center>
                      <div class="dropdown dropleft"><i class="fas fa-ellipsis-v" id="dropdownMenu" data-toggle="dropdown" ></i>
                         <div class="dropdown-menu" >
        <a class="dropdown-item" href="#"><i class="fa fa-eye"></i> View</a>
    <a class="dropdown-item" href="#"><i class="fa fa-edit"></i> Edit</a>
     <a class="dropdown-item" href="#"><i class="fa fa-trash"></i> Delete</a>
    
  </div>
                      </div>
                    </center></td>
                  </tr>


                   <tr>
                    <td>Project 22</td>
                    <td>
                        <div class="progress mt-2" style="height:3px;">
          <div data-toggle="tooltip" data-placement="top" title="30%"  class="progress-bar bg-info" role="progressbar" style="width:30%; " aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
                    </td>
                    <td>
                      <center>
                      <div class="dropdown dropleft"><i class="fas fa-ellipsis-v" id="dropdownMenu" data-toggle="dropdown" ></i>
                         <div class="dropdown-menu" >
        <a class="dropdown-item" href="#"><i class="fa fa-eye"></i> View</a>
    <a class="dropdown-item" href="#"><i class="fa fa-edit"></i> Edit</a>
     <a class="dropdown-item" href="#"><i class="fa fa-trash"></i> Delete</a>
    
  </div>
                      </div>
                    </center></td>
                  </tr>

                   <tr>
                    <td>Project 2</td>
                    <td>
                        <div class="progress mt-2" style="height:3px;">
          <div data-toggle="tooltip" data-placement="top" title="30%"  class="progress-bar bg-info" role="progressbar" style="width:30%; " aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
                    </td>
                    <td>
                      <center>
                      <div class="dropdown dropleft"><i class="fas fa-ellipsis-v" id="dropdownMenu" data-toggle="dropdown" ></i>
                         <div class="dropdown-menu" >
        <a class="dropdown-item" href="#"><i class="fa fa-eye"></i> View</a>
    <a class="dropdown-item" href="#"><i class="fa fa-edit"></i> Edit</a>
     <a class="dropdown-item" href="#"><i class="fa fa-trash"></i> Delete</a>
    
  </div>
                      </div>
                    </center></td>
                  </tr>
                  <tr>
                    <td colspan="3"><center><a href="#" class="text-muted"><strong>View projects</strong></a></center></td>
                  </tr>
                </table>
              </div>
            </div>
          </div>
        </div>

          <div class="col-sm-6">
          <div class="card shadow-sm">
            <div class="card-header">
              <h5 class="text-muted"><strong>Payments</strong></h5>
            </div>

            <div class="card-body">
              <div class="table-responsived">
                <table class="table table-striped">
                  <tr>
                    <th>Invoice Id</th>
                    <th>Client</th>
                    <th>Payment Mode</th>
                    <th>Amount</th>
                    <th>Date</th>
                  </tr>
                  <tr>
                    <td>#212</td>
                    <td>
                     Zalego Academy
                    </td>
                    <td>
                      Mpesa
                      </td>
                      <td>
                      Ksh 20000
                      </td>
                      <td>
                        12/12/2019
                      </td>
                  </tr>

                  <tr>
                    <td>#212</td>
                    <td>
                     Zalego Academy
                    </td>
                    <td>
                      Mpesa
                      </td>
                      <td>
                      Ksh 20000
                      </td>
                      <td>
                        12/12/2019
                      </td>
                  </tr>

                  <tr>
                    <td>#212</td>
                    <td>
                     Zalego Academy
                    </td>
                    <td>
                      Mpesa
                      </td>
                      <td>
                      Ksh 20000
                      </td>
                      <td>
                        12/12/2019
                      </td>
                  </tr>

                  <tr>
                    <td colspan="5"><center><a href="#" class="text-muted"><strong>View payments</strong></a></center></td>
                  </tr>

                
                </table>
              </div>
            </div>
          </div>
        </div>


      </div>
    </section>
    <!--section 2-->

</div>
@endsection
