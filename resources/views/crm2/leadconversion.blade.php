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

<<form method="get" action='{{url("/Lead_convert")}}' class="form-inline ml-3 nav-linkk mt-2 float-right" onsubmit="submissionLoader()">
                  @csrf
                  <div class="input-group input-group-sm">
                      <div class="input-group" title="Search by Date">
                          <label>from Date</label>
                          <input type="date" class="form-control" name="fromdate" placeholder="date" id="" required>
                         
                    
                          <label>To Date</label>
                          <input type="date" class="form-control" name="todate" placeholder="date" id="" required>
                          <script>
                        </script>
                      </div>
                
                      <div class="input-group-append">
                          <button class="btn btn-navbar theme-purple text-white" type="submit">
                              <i class="fa fa-search "></i> Filter Report
                          </button>
                      </div>
                  </div>
</form>

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
                <th>Names</th>
                <th>LeadSource</th>
                <th>Contact</th>
                <th>AppliedOn</th>
                <th>Completeness</th>
                <th>Last Comment</th>
              
          </tr>
        </thead>
        <tfoot>
          <tr>
            <th></th>
            <th></th>
            <th></th>
            <th id="position"></th>
            <th id="source"></th>
            <th id="office"></th>
            <th></th>
          </tr>
        </tfoot>

        <tbody>
        <?php
              $counter=1;
            ?>
             @if(!empty($applications))
            @forelse($applications as $app2)
              <tr>
                <td><input type="checkbox" name="checks[]" value="{{$app2->leadId}}" class="sels"></td>
                <td>{{$counter++}}</td>
                <td>{{$app2->name}}</td>
                 <td>
                  @if($app2->source_category==1)
                     Walk ins
                  @elseif($app2->source_category==2)
                     CSV Upload
                  @elseif($app2->source_category==3)
                      Ambassador App
                  @elseif($app2->source_category==0)
                     Website
                  @endif
                </td>
                <td>{{$app2->phonenumber}}</td>
                <td>{{$app2->created_at}}</td>
                <td> @if($app2->completeness==1)
                     unknown
                  @elseif($app2->completeness==2)
                     Complete
                  @elseif($app2->completeness==3)
                      Ambassador App
                  @elseif($app2->completeness==0)
                     Incomplete
                  @endif</td>
                <td>{{$app2->last_comment}}</td>
              
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
      
      if (position !== searchData[3]) {
        hasPosition = false; //Doesn't match - don't display
      }
      
      // Display the row if office matches the office selection
      hasOffice = true;
 
      if (office !== searchData[5]) {
        hasOffice = false; //Doesn't match - don't display
      }

      // If either position or office matched then display the row        
      return true ? hasPosition || hasOffice : false;
    });
  $('#example').DataTable( {
        initComplete: function () {
            this.api().columns([3,5]).every( function () {
                var column = this;
                var select = $('<select><option value="">------</option></select>')
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