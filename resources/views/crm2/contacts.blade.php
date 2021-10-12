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
              <li class="breadcrumb-item active">Leads Contacts</li>
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
 
    <br><br>
    @if(session('success1'))
      <div class="alert alert-info">
        <a href="#" class="close" data-dismiss="alert">&times</a>
        {{session('success1')}}
      </div>
    @endif
     
   
      <input type="hidden" name="action" id="actionH" value="0">
     
    <section class="container card px-3 py-3">

      <div class="card-header">
        <a href="{{url('/contacts')}}"><button class="btn btn-flat btn-primary"><i class="fas fa-undo"></i> Back</button></a>
        <form method="POST" action='{{url("/filterLeads")}}' class="form-inline ml-3 nav-linkk mt-2 float-right" onsubmit="submissionLoader()">
                  @csrf
                  <div class="input-group input-group-sm">
                      <div class="input-group" title="Search by Firstname / lastname /surname / phone / email / course / intake /school">
                          <input type="searcg" class="form-control" name="from" placeholder="Firstname / lastname /surname / phone / email / course / intake" >
                          <input type="hidden" name="page" value="contact">
                      </div>
                      <div class="input-group-append">
                          <button class="btn btn-navbar theme-purple text-white" type="submit">
                              <i class="fa fa-search "></i> Search
                          </button>
                      </div>
                  </div>
              </form>
            </div>
         <div class="table-responsive">
           <form method="POST" action="{{url('/leadActions')}}" id="leadForm">
      @csrf
      <input type="hidden" name="action" id="actionH" value="0">
          <table class="table">
            <thead>
              <tr>
                <th>#</th>
                <th>Names</th>
                <th>Course applied</th>
                <th>Contact Information</th>
              </tr>
            </thead>
            <?php
              $counter=1;
            ?>
             @if(!empty($handled))
            @forelse($handled as $app2)
            @foreach($leads as $ld)
              @if($ld->customer==$app2->id)
              <tr class="py-5">
                <td>{{$counter++}}</td><td>{{$app2->name}}</td>
                <td>
                 <i class="fas fa-graduation-cap"></i>
                  <?php
                    $cat= str_replace(",", '<br>', $app2->category);
                    $cat= str_replace('_', " ", $cat);
                    $course=str_replace('"', "", $cat);
                  ?>

                  @if($course=="")
                    <i>No course found</i>
                  @else
                    <?php echo htmlspecialchars_decode(stripslashes($course));?>
                  @endif
               
                </td>
                <td class="text-info"><i class="fas fa-envelope"></i> Email:: {{$app2->email}}<br>
                  <i class="fas fa-mobile-alt"></i> Phone:: {{$app2->phonenumber}}</td>
              
              </tr>
              @endif
              @endforeach
             
            @empty
              <tr>
                <td colspan="4">
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
            
            @else
              <tr>
                <td colspan="4">
                    <div class="py-5" id="noneItem">
                                  <center style="color:  #b3cccc !important;">
                                    <i class="fas fa-file fa-5x"></i>
                                    <i class="fas fa-times fa-2x" style="z-index: 9999; color: #fff; margin-left: -25px;"></i>
                                    <br>
                                    <h6>Cannot find similar results</h6>
                                   
                                  </center>
                              </div>
                </td>
              </tr>
            @endif
              <tr>
                <td colspan="4">
                  {{$leads->links()}}
                </td>
              </tr>
          </table>
        </form>
      </div>
      
    </section>
 
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
                      <option>May</option>
                       <option>July</option>
                        <option>August</option>
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
        }

    function takeAction(index){
      document.getElementById('actionH').value=index;
      document.getElementById('leadForm').submit();
    }
</script>
@endsection