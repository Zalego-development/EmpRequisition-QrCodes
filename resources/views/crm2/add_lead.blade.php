@extends('crm2.crm_layout')
@section('content')
<style type="text/css">
.w3-input{
background-color:white;
}

.card{
  background: #fff !important;
  border-radius: 0px !important;
  border-color: transparent !important;
  box-shadow: none !important;
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
              <li class="breadcrumb-item active">Add Lead</li>
            </ol>
  </div>
<div class="col-sm-6">
   <ol class="breadcrumb float-sm-right ml-2">
            </ol>
          </div><!-- /.col -->
        </div>
      </div>
    </div>
<hr>
<div class="container">
   
    <section class="w3-content card px-3 py-3" style="max-width: 85%;">
      <h6><strong>Add Lead</strong></h6>
      <hr>
        <form method="GET" action="https://zalegoacademy.ac.ke/public/walkins">
                  @csrf
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
    </section>

  </div>
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