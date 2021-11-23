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

<form method="get" action='{{url("/filterbydate")}}' class="form-inline ml-3 nav-linkk mt-2 float-right" onsubmit="submissionLoader()">
                  @csrf
                  <div class="input-group input-group-sm">
                      <div class="input-group" title="Search by Date">
                          <input type="date" class="form-control" name="shiftdate" placeholder="date" id="" required>
                          <script>
                        </script>
                      </div>
                      <div class="input-group" title="Search by Date">
                     
                      <Select name="shiftuser" style="background-color:lightgreen;width:150%" required>
                      <option value="" disabled="disabled" selected="selected">select Name</option>
                      @foreach($filteruser as $filteruser)
                     <option value="{{$filteruser->email}}">{{$filteruser->name}}</option>
                     @endforeach
                   </Select> 
                  </div>
                      <div class="input-group-append">
                          <button class="btn btn-navbar theme-purple text-white" type="submit">
                              <i class="fa fa-search "></i> Filter Report
                          </button>
                      </div>
                  </div>
</form>



<Select id="colorselector" style="background-color:lightgreen;width:50%;height:30px">
  <option>---select filter option</option>
   <option value="red">Agent total shift hours/month</option>
   <option value="yellow">Daily Shift</option>
   <option value="green">weekly Shift</option>
   <option value="blue">General Reports</option>
</Select>
     
    <section class="container card px-3 py-3">
    <div id="red" class="colors" style="display:none">
    <div class="container">
      <table id="example" class="display nowrap" width="100%">
        <thead>
          <tr>
            <th>Name</th>
            <th>Hoursof Shift</th> 
          </tr>
        </thead>
        <tfoot>
          <tr>
            
            <th id="position"></th>
            <th></th>
            <th id="office"></th>
            
          </tr>
        </tfoot>

        <tbody>
        @foreach($shift as $shift)
                    <tr>
                        <td>{{$shift->name}}</td>
                      
                        <td>{{round((strtotime($shift->logout_time)-strtotime($shift->login_time))*0.000277778,2)}}</td>
                    </tr>
                    @endforeach
        </tbody>
      </table>
    </div>
</div>



<div id="green" class="colors" style="display:none">
    <div class="container">
      <table id="example3" class="display nowrap" width="100%">
        <thead>
          <tr>
            <th>Name</th>
            <th>First Login</th>
            <th>Machine</th>
            <th>IP</th>
            <th>Last Logout</th>
            <th>Hoursof Shift</th> 
          </tr>
        </thead>

        <tfoot>
          <tr>
            <th></th>
            <th id="position1"></th>
            <th id="office1"></th>
            
          </tr>
        </tfoot>

        <tbody>
        @foreach($shift3 as $shift3)
                    <tr>
                        <td>{{$shift3->name}}</td>
                        <td>{{$shift3->login_time}}</td>
                        <td>{{$shift3->host}}</td>
                        <td>{{$shift3->ip}}</td>
                        <td>{{$shift3->logout_time}}</td>
                        <td>{{round((strtotime($shift3->logout_time)-strtotime($shift3->login_time))*0.000277778,2)}}</td>
                    </tr>
                    @endforeach
        </tbody>
      </table>
    </div>
</div>




<div id="yellow" class="colors" style="display:none">
    <div class="container" >
    <table id="example1" class="display nowrap" width="100%">
        <thead>
          <tr>
            <th>Name</th>
            <th>First Login</th>
            <th>Machine</th>
            <th>IP</th>
            <th>Last Logout</th>
            <th>Hours of Shift</th>
          </tr>
        </thead>

        <tfoot>
          <tr>
            <th>Name</th>
            <th id="position2"></th>
            <th id="office2"></th>
          
          </tr>
        </tfoot>

        <tbody>
        @foreach($shift1 as $shift1)
                    <tr>
                        <td>{{$shift1->name}}</td>
                        <td>{{$shift1->login_time}}</td>
                        <td>{{$shift1->host}}</td>
                        <td>{{$shift1->ip}}</td>
                        <td>{{$shift1->logout_time}}</td>
                        <td>{{round((strtotime($shift1->logout_time)-strtotime($shift1->login_time))*0.000277778,2)}}</td>
                        <td><form method="get" action='{{url("/viewAgentlocation")}}' target="_blank">
                          <input type="hidden" name="agent" id="" value="{{$shift1->email_address}}">
                          <input type="hidden" name="time" id="" value="{{$shift1->login_time}}">
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





<div id="blue" class="colors" style="display:none">
    <div class="container" >
    <table id="example2" class="display nowrap" width="100%">
        <thead>
          <tr>
            <th>First Login</th>
            <th>Name</th>
            <th>Machine</th>
            <th>IP</th>
            <th>Last Logout</th>
            <th>Breaks</th>
          </tr>
        </thead>
        <tfoot>
          <tr>
            <th></th>
            <th id="position3"></th>
            <th id="office3"></th>
          </tr>
        </tfoot>
        <tbody>
        @foreach($shift2 as $shift2)
                    <tr>
                        <td>{{$shift2->login_time}}</td>
                        <td>{{$shift2->name}}</td>
                        <td>{{$shift2->host}}</td>
                        <td>{{$shift2->ip}}</td>
                        <td>{{$shift2->logout_time}}</td>
                        <td>{{$shift2->break_time}}</td>
                    </tr>
        @endforeach
        </tbody>
      </table>
    </div>
</div>

    </section>
 
  </div>

 
</div>
<script type="text/javascript">
//monthly table
$(document).ready( function () {
  $.fn.dataTable.ext.search.push(
    function( settings, searchData, index, rowData, counter ) {
      var position = $( "#position option:selected" ).text();
      var office = $( "#office option:selected" ).text();
      // Display the row if both inputs are empty
      if (position.length ===0 && office.length === 0) {
        return true;
      }
      
      // Display row if position matches position selection
      hasPosition = true;
      
      if (position !== searchData[1]) {
        hasPosition = false; //Doesn't match - don't display
      }
      
      // Display the row if office matches the office selection
      hasOffice = true;
 
      if (office !== searchData[2]) {
        hasOffice = false; //Doesn't match - don't display
      }

      // If either position or office matched then display the row        
      return true ? hasPosition || hasOffice : false;
    });

  $('#example').DataTable( {
        initComplete: function () {
            this.api().columns([1,2]).every( function () {
                var column = this;
                var select = $('<select><option value=""></option></select>')
                    .appendTo( $(column.footer()).empty() )
                    .on( 'change', function () {
                      $('#example').DataTable().draw();
                    } );
 
                column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
            } );
        }
    } );} );
  </script>
<script type="text/javascript">
//
$(document).ready( function () {
  $.fn.dataTable.ext.search.push(
    function( settings, searchData, index, rowData, counter ) {
      var position1 = $( "#position1 option:selected" ).text();
      var office1 = $( "#office1 option:selected" ).text();

      // Display the row if both inputs are empty
      if (position1.length ===0 && office1.length === 0) {
        return true;
      }
      
      // Display row if position matches position selection
      hasPosition = true;
      
      if (position1 !== searchData[1]) {
        hasPosition = false; //Doesn't match - don't display
      }
      
      // Display the row if office matches the office selection
      hasOffice = true;
 
      if (office1 !== searchData[2]) {
        hasOffice = false; //Doesn't match - don't display
      }

      // If either position or office matched then display the row        
      return true ? hasPosition || hasOffice : false;
    });

  $('#example1').DataTable( {
        initComplete: function () {
            this.api().columns([1,2]).every( function () {
                var column = this;
                var select = $('<select><option value=""></option></select>')
                    .appendTo( $(column.footer()).empty() )
                    .on( 'change', function () {
                      $('#example1').DataTable().draw();
                    } );
 
                column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
            } );
        }
    } );} );

  </script>
<script type="text/javascript">
$(document).ready( function () {
  $.fn.dataTable.ext.search.push(
    function( settings, searchData, index, rowData, counter ) {
      var position2 = $( "#position2 option:selected" ).text();
      var office2 = $( "#office2 option:selected" ).text();

      // Display the row if both inputs are empty
      if (position2.length ===0 && office2.length === 0) {
        return true;
      }
      
      // Display row if position matches position selection
      hasPosition = true;
      
      if (position2 !== searchData[1]) {
        hasPosition = false; //Doesn't match - don't display
      }
      
      // Display the row if office matches the office selection
      hasOffice = true;
 
      if (office2 !== searchData[2]) {
        hasOffice = false; //Doesn't match - don't display
      }

      // If either position or office matched then display the row        
      return true ? hasPosition || hasOffice : false;
    });

  $('#example2').DataTable( {
        initComplete: function () {
            this.api().columns([1,2]).every( function () {
                var column = this;
                var select = $('<select><option value=""></option></select>')
                    .appendTo( $(column.footer()).empty() )
                    .on( 'change', function () {
                      $('#example2').DataTable().draw();
                    } );
 
                column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
            } );
        }
    } );} );

  </script>
<script type="text/javascript">
$(document).ready( function () {
  $.fn.dataTable.ext.search.push(
    function( settings, searchData, index, rowData, counter ) {
      var position3 = $( "#position3 option:selected" ).text();
      var office3 = $( "#office3 option:selected" ).text();

      // Display the row if both inputs are empty
      if (position3.length ===0 && office3.length === 0) {
        return true;
      }
      
      // Display row if position matches position selection
      hasPosition = true;
      
      if (position3 !== searchData[1]) {
        hasPosition = false; //Doesn't match - don't display
      }
      
      // Display the row if office matches the office selection
      hasOffice = true;
 
      if (office3 !== searchData[2]) {
        hasOffice = false; //Doesn't match - don't display
      }

      // If either position or office matched then display the row        
      return true ? hasPosition || hasOffice : false;
    });

  $('#example3').DataTable( {
        initComplete: function () {
            this.api().columns([1,2]).every( function () {
                var column = this;
                var select = $('<select><option value=""></option></select>')
                    .appendTo( $(column.footer()).empty() )
                    .on( 'change', function () {
                      $('#example3').DataTable().draw();
                    } );
 
                column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
            } );
        }
    } );} );

  </script>


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


  