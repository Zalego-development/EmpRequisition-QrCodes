@extends('crm2.crm_layout')
@section('content')


 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-muted ml-2 mt-4"><strong>CRM </strong></h1>
            <ol class="breadcrumb float-sm-left ml-2">
              <li class="breadcrumb-item"><a href="{{url('/home')}}"><i class="fa fa-home"></i></a></li>
              <li class="breadcrumb-item active"><a href="#">HR</a></li>
              <li class="breadcrumb-item active">Shift Reports</li>
            </ol>
  </div>
<div class="col-sm-6">
   <ol class="breadcrumb float-sm-right ml-2">
            </ol>
          </div><!-- /.col -->
        </div>
      </div>
    </div>

<div class="container">
     
    <br><br>
    @if(session('success1'))
      <div class="alert alert-info">
        <a href="#" class="close" data-dismiss="alert">&times</a>
        {{session('success1')}}
      </div>
    @endif
  <?php
   date_default_timezone_set("Africa/Nairobi");
   $timenow = date("Y-m-d h:i:s",strtotime("+0 HOURS"));
  ?>

     
    <section class="container card px-3 py-3">
    <div class="container">
      <table id="example" class="display nowrap" width="100%">
        <thead>
          <tr>
            <th>Name</th>
            <th>First Login</th>
            <th>Machine</th>
            <th>IP</th>
            <th>Hoursof Shift</th>
            <th>Breaks</th> 
            <th>Occupancy rate</th> 
          </tr>
        </thead>
        <tbody>
        @foreach($filter as $filter)
                    <tr>
                        <td>{{$filter->name}}</td>
                        <td>{{$filter->login_time}}</td>
                        <td>{{$filter->host}}</td>
                        <td>{{$filter->ip}}</td>
                    @endforeach
                    @foreach($filter1 as $filter1)
                        <td>{{round((strtotime($filter->logout_time)-strtotime($filter->login_time))*0.000277778,2)}}</td>
                       <td>{{$filterbreak}}</td>
                       <td>{{(($filterbreak-$totalBreak)/$filterbreak)*100}}%</td>
                       <td> <form method="get" action='{{url("/viewAgentlocation")}}' target="_blank">
                          <input type="hidden" name="agent" id="" value="{{$filter->email_address}}">
                          <input type="hidden" name="time" id="" value="{{$filter->login_time}}">
                        <button  type="submit">
                        view location
                          </button>
                       </form></td>
                        </tr>
                    @endforeach
        </tbody>
      </table>
    </div>
</div>


</section>
 
</div>

 
</div>


<script>
$(function() {
        $('#colorselector').change(function(){
            $('.colors').hide();
            $('#' + $(this).val()).show();
        });
    });
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
@endsection


  