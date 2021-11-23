@extends('crm2.crm_layout')
@section('content')
<style type="text/css">
.w3-input{
background-color:white;
}

.card{
  background: #fff !important;
  border-radius: 0px !important;
  box-shadow: rgba(17, 12, 46, 0.15) 0px 48px 100px 0px;
}

 .form2{
      padding: 20px;
    }

@media screen and (max-width: 480px) {
    
    #actionBarHolder {
        display: none;
    }

     .modaledd{
      bottom: 20px;
      z-index:9999 !important;
       position: fixed;
       right: 0px;
          top: 5px;
          width:100%;
    }
}

@media screen and (min-width: 480px) {
    .mobileMenu{
        display: none;
    }

     .modaledd{
      bottom: 20px;
      z-index:9999 !important;
       position: fixed;
       right: 0px;
          top: 5px;
          width: 57%;
    }
}
</style>
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
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
              <li class="breadcrumb-item active">Lead Logs</li>
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
    <a href="#" data-toggle="modal" data-target="#addModal"><button class="btn btn-flat btn-success"><i class="fas fa-plus"></i> Add new lead</button></a>&nbsp
    <span class="dropdown">
  <button class="btn btn-secondary btn-flat dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Actions
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    <a class="dropdown-item" href="#" onClick="takeAction(1)"><i class="fas fa-plus"></i> Add to my leads</a>
     <a class="dropdown-item" href="#" onClick="takeAction(2)"><i class="fas fa-file-export"></i> Export</a>
     <a class="dropdown-item text-warning" href="#" onClick="takeAction(121)"><i class="fas fa-play"></i> achive deals</a>
  </div>
</span>
    <br><br>
    @if(session('success1'))
      <div class="alert alert-info">
        <a href="#" class="close" data-dismiss="alert">&times</a>
        {{session('success1')}}
      </div>
    @endif
    <form method="POST" action="{{url('/leadActions')}}" id="leadForm">
      @csrf
      <input type="hidden" name="action" id="actionH" value="0">
      <input type="hidden" name="exportStatus" id="exportStatus" value="none">
      <input type="hidden" name="mode" value="applications">
    <section class="container card px-3 py-3">
       
     <div class="table-responsive">
     <div class="container">
     <table id="example" class="display nowrap" width="100%">
        <thead>
          <tr>
          <th><input type="checkbox" onclick="toggle(this)"></th>
                <th>#</th>
                <th>LeadSource</th>
                <th>Names</th>
                <th>Email</th>
                <th>Contact</th>
                <th>Gender</th>
                <th>Intake</th>
                <th>Course</th>
                <th>AppliedOn</th>
                <th>Actions</th>
          </tr>
        </thead>
        <tfoot>
          <tr>
            <th></th>
            <th id="position"></th>
            <th id="office"></th>
            
          </tr>
        </tfoot>

        <tbody>
        <?php
              $counter=1;
            ?>
             @if(!empty($applications))
            @forelse($applications as $app2)
              <tr>
                <td><input type="checkbox" name="checks[]" value="{{$app2->id}}" class="sels"></td>
               
                <td>{{$counter++}}</td>
                 <td>
                  @if($app2->source_category==1)
                     <strong class="text-muted">Walk ins'</strong>
                  @elseif($app2->source_category==2)
                     <strong class="text-warning">CSV Upload</strong>
                  @elseif($app2->source_category==3)
                      <strong class="text-info">Ambassador App</strong>
                  @elseif($app2->source_category==0)
                     <strong class="text-success">Website</strong>
                  @endif
                </td>
                <td>{{$app2->name}}</td>
                <td>{{$app2->email}}</td>
                <td>{{$app2->phonenumber}}</td>
                <td>{{$app2->gender}}</td>
                <td>{{$app2->intake}}</td>
                <td>
                  <?php
                    $cat= str_replace(",", '<br>', $app2->category);
                    $cat= str_replace('_', " ", $cat);
                    echo str_replace('"', "", $cat);
                  ?>
               </td>
                <td>{{$app2->created_at}}</td>
                <td><div class="dropdown">
  <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
   <i class="fas fa-ellipsis-v"></i> Actions
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    <a class="dropdown-item" href="{{url('/addLead/'.$app2->id)}}"><i class="fas fa-plus-circle"></i> Add as my lead</a>
  </div>
</div></td>
              </tr>
            @empty
              <tr>
                <td colspan="9">
                    <div class="py-5" id="noneItem">
                                  <center style="color:  #b3cccc !important;">
                                    <i class="fas fa-file fa-5x"></i>
                                    <i class="fas fa-times fa-2x" style="z-index: 9999; color: #fff; margin-left: -25px;"></i>
                                    <br>
                                    <h6>You do not have any applications at the moment</h6>
                                   
                                  </center>
                              </div>
                </td>
              </tr>
            @endforelse
            
            @endif
        </tbody>
      </table>


      </div>
      
    </section>
  </form>
  </div>

  <!--add modal-->
    <div class="modal" id="addModal">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header bg-light">
            <h6><strong><i class="fas fa-plus"></i> Add</strong></h6>
            <i class="fas fa-window-close text-danger float-right fa-2x" data-dismiss="modal" style="cursor: pointer"></i>
          </div>
          <div class="modal-body">
               <form method="POST" action="https://zalegoacademy.ac.ke/public/api/walkins">
                  @csrf
                  <input type="hidden" name="route" value="{{url('/')}}/logs_leads">
                  <div class="row">
                      <div class="form-group col-sm-6">
                    <label>Names</label>
                    <input type="text" name="name" class="form-control py-4" required="">
                  </div>
                   <div class="form-group col-sm-6">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control py-4" required="">
                  </div>
                  
                  <input type="hidden" name="poster" value="{{Auth::user()->userId}}">
                  
                   <div class="form-group col-sm-6">
                    <label>Contact</label>
                    <input type="number" name="contact" class="form-control py-4" required="">
                  </div>
                  <div class="form-group col-sm-6">
                    <label>School</label>
                    <input type="text" name="school" class="form-control py-4" required="">
                  </div>
                   <div class="form-group col-sm-12">
                    <label>Gender</label><br>

                    <label><input type="radio" name="gender" value="Male"> Male</label>&nbsp
                    <label><input type="radio" name="gender" value="Female"> Male</label>&nbsp
                   
                  </div>
                   <div class="form-group col-sm-6">
                    <label>Intake</label>
                     <select class="form-control" name="intake" required="">
                      <option>January</option>
                      <option>February</option>
                      <option>March</option>
                      <option>April</option>
                      <option>May</option>
                      <option>June</option>
                       <option>July</option>
                        <option>August</option>
                        <option>September</option>
                        <option>October</option>
                        <option>November</option>
                        <option>December</option>
                    </select>
                  </div>
                  
                   <div class="form-group col-sm-6">
                    <label>Form</label>
                     <select class="form-control" name="form" required="">
                      <option>One</option>
                      <option>Two</option>
                       <option>Three</option>
                        <option>Four</option>
                        <option>Completed School</option>
                    </select>
                  </div>
                   <div class="form-group col-sm-12">
                    <label>Category</label>
                    <textarea name="category" class="form-control" required=""></textarea>
                  </div>
                     <div class="form-group col-sm-12">
                    <label>Comments</label>
                    <textarea name="comments" class="form-control" required=""></textarea>
                  </div>
                  </div>
                  <button class="btn btn-success" type="submit"><i class="fas fa-save"></i> Save Lead</button>
                </form>
          </div>
        </div>
      </div>
    </div>
  <!--add modal-->
</div>



   <script type="text/javascript">
      //var table= $('#studentLeadss').dataTable( { "lengthMenu": [[10, 25, 50,-1], [10, 25, 50, "All"]] } );
     function toggle(source) {
            checkboxes = document.getElementsByClassName('sels');
            for (var i = 0, n = checkboxes.length; i < n; i++) {
                checkboxes[i].checked = source.checked;
            }
            document.getElementById('exportStatus').value="all";
        }

    function takeAction(index){
      document.getElementById('actionH').value=index;
      document.getElementById('leadForm').submit();
    }
</script>



<script type="text/javascript">
//
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
 
      if (office !== searchData[4]) {
        hasOffice = false; //Doesn't match - don't display
      }

      // If either position or office matched then display the row        
      return true ? hasPosition || hasOffice : false;
    });

  $('#example').DataTable( {
        initComplete: function () {
            this.api().columns([2,4]).every( function () {
                var column = this;
                var select = $('<select><option value="">filter by lead source</option></select>')
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
@endsection