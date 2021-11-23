@extends('layouts.employee')
@section('title','Enquiries | Zalego')
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
            <h1 class="m-0 text-muted ml-2 mt-4"><strong>Enquiries </strong></h1>
            <ol class="breadcrumb float-sm-left ml-2">
              <li class="breadcrumb-item"><a href="{{url('/home')}}"><i class="fa fa-home"></i></a></li>
              <li class="breadcrumb-item active"><a href="#">CRM</a></li>
              <li class="breadcrumb-item active">Enquiries</li>
            </ol>
  </div>
<div class="col-sm-6">
   <ol class="breadcrumb float-sm-right ml-2  mt-4" >
    <a href="{{url('/enquiries/all')}}" ><button class="btn btn-flat btn-primary"><i class="fas fa-cog"></i> Refresh</button></a>&nbsp 
            </ol>
          </div><!-- /.col -->
        </div>
      </div>
    </div>

<div class="container">
    <!-- <a href="#" data-toggle="modal" data-target="#addModal"><button class="btn btn-flat btn-success"><i class="fas fa-plus"></i> Add new lead</button></a>&nbsp -->
  <br>
    @if(session('success1'))
      <div class="alert alert-info">
        <a href="#" class="close" data-dismiss="alert">&times</a>
        {{session('success1')}}
      </div>
    @endif

    <section class="container card px-3 py-3">
       
         <div class="table-responsive">
          <table class="table table-striped" id="student_leads">
            <thead>
              <tr>
                <th>#</th>
                <th>Category</th>
                <th>Name</th>
                <th>Email</th>
                <th>Contact</th>
                <th>Message</th>
                <th>Sent On</th>
                <th>Actions</th>
              </tr>
            </thead>
            <?php
              $counter=1;
            ?>
             @if(!empty($applications))
            @forelse($applications as $app2)
              <tr>
               
                <td>{{$counter++}}</td>
                 <td>
                  @if($app2->category=='Enquiry')
                     <strong class="text-muted">Enquiry Section</strong>
                  @elseif($app2->category=='Contact')
                     <strong class="text-warning">Contact Us</strong>
                  @endif
                </td>
                <td>{{$app2->name}}</td>
                <td>{{$app2->email}}</td>
                <td>{{$app2->phone}}</td>
                <td>
                    <?php $say=substr(strip_tags($app2->message),0,200);
                    echo strip_tags($say)?>... &nbsp;&nbsp;
                </td>
                <td>{{\Carbon\Carbon::parse($app2->created_at)->format('d-m-Y h:i')}}</td>
                <td>
                  <div class="dropdown">
                  <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                   <i class="fas fa-ellipsis-v"></i> Actions
                  </button>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#readMessage{{$app2->id}}"><i class="fas fa-envelope"></i> Read Message</a>
                     <a class="dropdown-item" href="#" data-toggle="modal" data-target="#addModal{{$app2->id}}"><i class="fas fa-plus-circle"></i> Mark as Lead</a>
                     <a class="dropdown-item" href="#" data-toggle="modal" data-target="#enquiry{{$app2->id}}"><i class="fas fa-question-circle"></i> Mark as Enquiry</a>
                  </div>
                </div>
              </td>
              </tr>
            @empty
              <tr>
                <td colspan="8">
                    <div class="py-5" id="noneItem">
                                  <center style="color:  #b3cccc !important;">
                                    <i class="fas fa-file fa-5x"></i>
                                    <i class="fas fa-times fa-2x" style="z-index: 9999; color: #fff; margin-left: -25px;"></i>
                                    <br>
                                    <h6>Hurray! You do not have any enquiries at the moment</h6>
                                   
                                  </center>
                              </div>
                </td>
              </tr>
            @endforelse
            
            @endif
             
          </table>
      </div>
      
    </section>
  </div>
@forelse($applications as $apps)
<div class="modal" id="readMessage{{$apps->id}}">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header bg-light">
            <h6><strong><i class="fas fa-plus"></i> Message from {{$apps->name}}</strong></h6>
            <i class="fas fa-window-close text-danger float-right fa-2x" data-dismiss="modal" style="cursor: pointer"></i>
          </div>
            <div class="modal-body">
              <div class="form-group col-sm-12">
                  {!! $apps->message !!}
              </div>
            </div>
          </div>
        </div>
      </div>


<div class="modal" id="enquiry{{$apps->id}}">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header bg-light">
            <h6><strong><i class="fas fa-plus"></i> Mark as an enquiry</strong></h6>
            <i class="fas fa-window-close text-danger float-right fa-2x" data-dismiss="modal" style="cursor: pointer"></i>
          </div>
            <div class="modal-body">
              <form method="POST" action="https://zalegoacademy.ac.ke/public/api/completeEnquiry">
                  @csrf
                  <input type="hidden" name="control_id" value="{{$apps->id}}">
                  <input type="hidden" name="poster" value="{{Auth::user()->userId}}">
                  <input type="hidden" name="route" value="{{url('/')}}/enquiries">
                  <div class="row">
                   <div class="form-group col-sm-12">
                      <label>Enquiry Category</label>
                       <select class="form-control" name="category" required="">
                        <option value="Jobs / Placements">Jobs / Placements</option>
                        <option value="School Fees / Fees Structure">School Fees / Fees Structure</option>
                         <option value="Others">Others</option>
                      </select>
                    </div>
                    <div class="form-group col-sm-12">
                      <label>Comments / Status of the enquiry</label>
                      <textarea name="comments" class="form-control" required=""></textarea>
                    </div>
                    </div>
                    <button class="btn btn-success" type="submit" onclick="this.disabled=true;this.form.submit();"><i class="fas fa-save"></i> Save</button>
                </form>
            </div>
          </div>
        </div>
      </div>


  <!--add modal-->
    <div class="modal" id="addModal{{$apps->id}}">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header bg-light">
            <h6><strong><i class="fas fa-plus"></i> Add {{$apps->name}} to leads</strong></h6>
            <i class="fas fa-window-close text-danger float-right fa-2x" data-dismiss="modal" style="cursor: pointer"></i>
          </div>
          <div class="modal-body">
               <form method="POST" action="https://zalegoacademy.ac.ke/public/api/walkinsFromEquiries">
                  @csrf
                  <input type="hidden" name="route" value="{{url('/')}}/enquiries">
                  <input type="hidden" name="control_id" value="{{$apps->id}}">
                  <div class="row">
                      <div class="form-group col-sm-6">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control py-4" required="" value="{{$apps->name}}">
                  </div>
                   <div class="form-group col-sm-6">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control py-4" required="" value="{{$apps->email}}">
                  </div>
                  
                  <input type="hidden" name="poster" value="{{Auth::user()->userId}}">
                  
                   <div class="form-group col-sm-6">
                    <label>Contact</label>
                    <input type="number" name="contact" class="form-control py-4" required="" value="{{$apps->phone}}">
                  </div>
                  <div class="form-group col-sm-6">
                    <label>School</label>
                    <input type="text" name="school" class="form-control py-4" required="">
                  </div>
                   <div class="form-group col-sm-12">
                    <label>Gender</label><br>

                    <label><input type="radio" name="gender" value="Male"> Male</label>&nbsp
                    <label><input type="radio" name="gender" value="Female"> Female</label>&nbsp
                   
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
                    <label>Course Category / Course Enquired</label>
                    <textarea name="category" class="form-control" required=""></textarea>
                  </div>
                    <div class="form-group col-sm-12">
                    <label>Comments</label>
                    <textarea name="comments" class="form-control" required=""></textarea>
                  </div>
                  </div>
                  <button class="btn btn-success" type="submit" onclick="this.disabled=true;this.form.submit();"><i class="fas fa-save"></i> Save Lead</button>
                </form>
          </div>
        </div>
      </div>
    </div>
  <!--add modal-->

    @empty
    @endforelse

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
@endsection