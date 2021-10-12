@extends('layouts.main')

@section('content')
 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-left ml-2">
              <li class="breadcrumb-item"><a href="{{url('/home')}}"><i class="fa fa-home"></i></a></li>
              <li class="breadcrumb-item active"><a href="{{url('/home')}}">Home</a></li>
              <li class="breadcrumb-item active">Payroll Process </li>
            </ol>
          </div><!-- /.col -->
          <div class="col-sm-6" style="display:none;">
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
        <div class="container-fluid px-0">
          <div class="card px-2 py-2">
            <?php
              $co="";
              foreach($getCo as $coc){
                $co=$coc->company;
              }

              $de="";
              foreach($getDe as $coc){
                $de=$coc->department;
              }

            ?>
            <h5 class="text-center">Final Step :Data confirmation({{$co}}, {{$de}})</h5>
            <hr>
            <div class="card shadow px-2 py-2 bg-light">
              <div class="row">
              

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box shadow-sm">
              <span class="info-box-icon bg-success  elevation-1" style="opacity:.6; border-radius: 50%;"><i class="  fas fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Processing Payroll for</span>
                <span class="info-box-number">
                  <h6 id="infoNo" style="font-size: 15px;"><small> 20 </small><strong id="salary">Employees</strong></h6>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box shadow-sm">
              <span class="info-box-icon bg-warning  elevation-1" style="opacity:.6; border-radius: 50%;"><i class="text-white  fas fa-table"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Taxation Scheme</span>
                <span class="info-box-number">
                  <h6 id="infoNo" style="font-size: 15px;"><small> </small><strong id="salary"><?php echo str_replace("_", " ", $taxationschemes);?></strong></h6>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>


          @foreach($getDD as $dd)
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box shadow-sm">
              <span class="info-box-icon bg-info  elevation-1" style="opacity:.6; border-radius: 50%;"><i class="fas fa-chart-area"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">{{$dd->deductions}} Rates</span>
                <span class="info-box-number">
                  <h6 id="infoNo" style="font-size: 15px;"><small> </small><strong id="salary">{{$dd->amount}}%</strong></h6>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          @endforeach

          
        

         
        </div>
        @if(session('successP'))
                <div class="alert alert-success shadow mt-2 w3-content" style="max-width: 60%;" >
                  <i class="fas fa-info"></i> {{session('successP')}}
                </div>
              @endif

              @if(session('failedP'))
                <div class="alert alert-danger shadow mt-2 w3-content" style="max-width: 60%;" >
                  <i class="fas fa-info"></i> {{session('failedP')}}
                </div>
              @endif
        <div class="border-top">
        </div><br>
        
            </div><br>
            <div class="card bg-white float-right shadow-lg " style="min-width: 10%; position: fixed; right:0%; top:20%; z-index: 9999; display: none;" id="successCard">
              <div class="card-body">
              <center>
              <img src="{{asset('images/shots/17.gif')}}" width="40px" height="40px"><br><br>
              <strong class="text-muted" id="textSuccess"></strong>
            </center>
          </div>
            </div>
              @csrf
              <input type="hidden" id="month" name="month" value="{{$month}}">
               <input type="hidden" id="Date" name="Date" value="{{$Date}}">
                <input type="hidden" id="company" name="company" value="{{$company}}">
                 <input type="hidden" id="department" name="department" value="{{$department}}">
                  <input type="hidden" id="taxationschemes" name="taxationschemes" value="{{$taxationschemes}}">
                 <input type="hidden" id="advance" name="advance" value="{{$advance}}">
                  <input type="hidden" id="loans" name="loans" value="{{$loans}}">
                   <input type="hidden" id="email" name="email" value="{{$email}}">
                   
                   <input type="hidden" id="PayrollCode" name="payrollCode" value="{{$payrollCode}}">
            
            <div class="table-responsive">
                <table class="table table-striped table-bordered " id="confirmations" style="overflow-x: auto; width:99%;">
                  <thead>
                  <tr>
                    <th>Employee</th>
                    <th>Salary</th>
                    <th>Earnings</th>
                    <th>Deductions</th>
                    <th>Advances</th>
                    <th>Loans</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($employees as $emp)
                  <tr style="height: 120px !important;">

                      <td >{{$emp->firstname}} {{$emp->lastname}} {{$emp->surname}}
                        <span  class="bg-warning tnSave{{$emp->id}}" onclick="saveD(<?php echo $emp->id;?>,<?php echo $emp->userId;?>)" style=" width:40px; height:40px; position: absolute; left:97%; z-index: 9999; cursor: pointer; border-radius: 50%; margin-top: 5%; "><i class="fas fa-check text-white" style="padding: 14px;"></i></span>
                        <input type="hidden" name="employee[]" value="{{$emp->firstname}} {{$emp->lastname}} {{$emp->surname}}">
                        <input type="hidden" id="employeeId{{$emp->id}}" name="employeeId[]" value="{{$emp->userId}}"></td>
                      <td >
                        <?php
                          $salary=0;
                        ?>
                        @foreach($salaries as $sl)
                          @if($sl->employeeId==$emp->userId)
                            <?php
                              $salary+=$sl->salary;
                            ?>
                             <div class="input-group mb-3"><div class="input-group-prepend"><span class="input-group-text" id="basic-addon1">KSH</span></div><input type="text" id="empSalary{{$emp->id}}" name="salary[]" value="{{$sl->salary}}" class="form-control"></div>

                             <br>
                             <label>Service charge</label>
                             <div class="input-group mb-3"><div class="input-group-prepend"><span class="input-group-text" id="basic-addon1">KSH</span></div><input type="text" id="empService{{$emp->id}}" name="service[]" value="0" class="form-control"></div>

                          @endif
                        @endforeach
                      </td>

                       <td >
                        <table class="table table-bordered">
                        @foreach($earnings as $sl)
                          @if($sl->employeeId==$emp->userId)
                            <tr>
                              <td>{{$sl->earnings}}</td>
                              <td> <span id="fEText{{$sl->id}}{{$emp->id}}"><span class="text-success">Enabled</span></span><div class="input-group mb-3"><div class="input-group-prepend"><span class="input-group-text" id="basic-addon1">%</span></div><input  type="text" id="empEarning{{$sl->id}}{{$emp->id}}" name="normEarnings[]" value="{{$sl->amount}}" class="form-control"><label>
                                         <br>
                                          <input type="checkbox" id="fixedEarning{{$sl->id}}{{$emp->id}}" onclick="saveFixedEarning(<?php echo $emp->id;?>,<?php echo $sl->id;?>,<?php echo $emp->userId;?>,<?php echo "'".$sl->earnings."'";?>,<?php echo $sl->amount;?>)" value="{{$sl->amount}}">&nbsp Toggle Enable/Disable
                                        </label></div><strong> = ksh <?php echo ($sl->amount/100)*$salary;?></strong></td>
                            </tr>
                          @endif
                        @endforeach
                      </table>
                      </td>

                       <td style="width:300px;">
                        <table class="table">
                          <tr>
                            <th>Normal Deduction</th>
                            <th>Custom Deduction</th>
                          </tr>
                          <tr>
                            <td>
                              <table class="table table-bordered">
                        @foreach($deductions as $sl)
                          @if($sl->employeeId==$emp->userId)
                            <tr>
                              <td>{{$sl->deductions}}</td>
                              <td><span id="fDText{{$sl->id}}{{$emp->id}}"><span class="text-success">Enabled</span></span> <div class="input-group mb-3"><div class="input-group-prepend"><span class="input-group-text" id="basic-addon1">%</span></div><input type="text" id="empDeduction{{$sl->id}}{{$emp->id}}" name="normDeductions[]" value="{{$sl->amount}}" class="form-control"> </div>

                                <label>
                                         
                                          <input type="checkbox" id="fixedDeduction{{$sl->id}}{{$emp->id}}" onclick="saveFixedDeduction(<?php echo $emp->id;?>,<?php echo $sl->id;?>,<?php echo $emp->userId;?>,<?php echo "'".$sl->deductions."'";?>,<?php echo $sl->amount;?>)" value="{{$sl->amount}}">&nbsp Toggle Enable/Disable
                                        </label>
                                <strong> = ksh <?php echo ($sl->amount/100)*$salary;?></strong></td>
                            </tr>
                          @endif
                        @endforeach
                      </table>
                            </td>
                            <td>
                              @foreach($deduction_settings as $sl)
                                <div class="form-group mt-1">
                                        <label>
                                         
                                          <input type="checkbox" id="customDeductions{{$emp->id}}{{$sl->id}}" onclick="saveCustom(<?php echo $emp->id;?>,<?php echo $sl->id;?>,<?php echo $emp->userId;?>,<?php echo "'".$sl->deductions."'";?>)" value="{{$sl->amount}}">&nbsp {{$sl->deductions}}
                                        </label>
                                      </div>
                              @endforeach
                            </td>
                          </tr>
                        </table>
                      </td>
                      <td>
                        @foreach($advance_payments as $sl)
                          @if($sl->empId==$emp->userId)
                          <strong>Advance:</strong> <div class="input-group mb-3"><div class="input-group-prepend"><span class="input-group-text" id="basic-addon1">KSH</span></div><input type="text" name="advances[]" id="empAdvance{{$emp->id}}" value="<?php echo $sl->amount-$sl->paidAmount; ?>" class="form-control"></div>
                          @endif
                        @endforeach
                      </td>
                       <td>
                         @foreach($loansettings as $sl)
                          @if($sl->employeeId==$emp->userId)
                          <strong>Loans:</strong> <div class="input-group mb-3"><div class="input-group-prepend"><span class="input-group-text" id="basic-addon1">KSH</span></div><input type="text" name="loanss[]" id="empLoan{{$emp->id}}" value="<?php echo $sl->amount-$sl->paidAmount; ?>" class="form-control"></div>
                          @endif
                        @endforeach
                      </td>
                  </tr>
                  @endforeach
                  </tbody>
                   <tfoot>
                  <tr>
                    <th>Employee</th>
                    <th>Salary</th>
                    <th>Earnings</th>
                    <th>Deductions</th>
                    <th>Advances</th>
                    <th>Loans</th>
                  </tr>
                  </tfoot>
                </table>
            </div>
            <div class="card px-2 py-2">

            <a href="{{url('/hr/processPayroll')}}" onclick="return(confirm('You are about to exit payroll validation. Do you want to proceed and save data?')); "><button class="btn btn-lg btn-warning"><i class="fas fa-save"></i> Save data</button></a>
            </div>
        
          </div>
        </div>
    </section>
  </div>
   <script type="text/javascript">
     window.addEventListener("beforeunload", function (e) {
  var message = "Are you sure you want to leave?.";

  (e || window.event).returnValue = message;     
  return message;                                
});
        if(window.addEventListener){
  window.addEventListener('load', function(){
    $("body").addClass('sidebar-collapse');   
    });
}

var employeeSalary=0;
var empAdvance=0;
var empLoan=0;


function saveD(id,id2){
  var salary=$("#empSalary"+id).val();
  var service=$("#empService"+id).val();
  var Month=$("#month").val();
  var taxationschemes=$("#taxationschemes").val();
  var Datee=$("#Date").val();
  var empEarning=$("#empEarning"+id).val();
  var empDeduction=$("#empDeduction"+id).val();
  var PayrollCode=$("#PayrollCode").val();
   var empAdvance=$("#empAdvance"+id).val();
    var empLoan=$("#empLoan"+id).val();
    var host=id2;
  var path=service+"/"+salary+'/'+Month+'/'+Datee+'/'+PayrollCode+'/'+empAdvance+'/'+empLoan+'/'+host+'/'+empEarning+"/"+empDeduction+'/'+taxationschemes;
  $.ajax({
            url:"http://localhost/hr/public/hr/saveCustomSalary/"+path,
            type:'GET',
            data:'_token=<?php echo csrf_token() ;?>',
            success:function(data){
             if(data.success1=='1'){
              $("#successCard").fadeIn();
              $("#textSuccess").html("Changes saved successfully");
              setTimeout($("#successCard").fadeOut(),5000);
              $(".tnSave"+id).removeClass("bg-warning");
              $(".tnSave"+id).addClass("bg-success");
            } else{
               alert("Unable to add changes");
            }    
            }
        });
}

function saveCustom(dId,id,id2,id3){
  var val=$("#customDeductions"+dId+id).val();
  var salary=$("#empSalary"+dId).val();
  var Month=$("#month").val();
  var Datee=$("#Date").val();
  var PayrollCode=$("#PayrollCode").val();
  var path=val+'/'+Month+'/'+Datee+'/'+PayrollCode+'/'+id2+'/'+id3+"/"+salary;

  if(document.getElementById('customDeductions'+dId+id).checked){
     $.ajax({
            url:"http://localhost/hr/public/hr/saveCustomDo/"+path,
            type:'GET',
            data:'_token=<?php echo csrf_token() ;?>',
            success:function(data){
             if(data.success=='1'){
              $("#successCard").fadeIn();
              $("#textSuccess").html("Custom deduction added successfully");
              setTimeout($("#successCard").fadeOut(),5000);
            } else{
               alert("Unable to add custom deduction");
            }    
            }
        });
  }else{
     $.ajax({
            url:"http://localhost/hr/public/hr/saveCustomUndo/"+path,
            type:'GET',
            data:'_token=<?php echo csrf_token() ;?>',
            success:function(data){
             if(data.success=='1'){
              $("#successCard").fadeIn();
              $("#textSuccess").html("Custom deduction removed successfully");
              setTimeout($("#successCard").fadeOut(),5000);
            } else{
               alert("Unable to remove custom deduction");
            }    
            }
        });
  }
}

function saveFixedEarning(dId,nId,userId,name,amount){
   var PayrollCode=$("#PayrollCode").val();
   var taxationschemes=$("#taxationschemes").val();
   amount=$('#empEarning'+nId+dId).val();
   var path=nId+'/'+userId+'/'+name+"/"+amount+'/'+PayrollCode+'/'+taxationschemes;
 
  if(document.getElementById('fixedEarning'+nId+dId).checked){
    
  document.getElementById('empEarning'+nId+dId).disabled=true;
  $("#fEText"+nId+dId).html('<span class="text-danger">Disabled</span>');
 
     $.ajax({
            url:"http://localhost/hr/public/hr/saveFixedEarningUndo/"+path,
            type:'GET',
            data:'_token=<?php echo csrf_token() ;?>',
            success:function(data){
             if(data.success=='1'){
              $("#successCard").fadeIn();
              $("#textSuccess").html("Custom deduction added successfully");
              setTimeout($("#successCard").fadeOut(),5000);
            } else{
               alert("Unable to add custom deduction");
            }    
            }
        });
  }else{
   document.getElementById('empEarning'+nId+dId).disabled=false;
  $("#fEText"+nId+dId).html('<span class="text-success">Enabled</span>');

     $.ajax({
            url:"http://localhost/hr/public/hr/saveFixedEarning/"+path,
            type:'GET',
            data:'_token=<?php echo csrf_token() ;?>',
            success:function(data){
             if(data.success=='1'){
              $("#successCard").fadeIn();
              $("#textSuccess").html("Change made successfully");
              setTimeout($("#successCard").fadeOut(),5000);
            } else{
               alert("Unable to make change deduction");
            }    
            }
        });
  }
}

function saveFixedDeduction(dId,nId,userId,name,amount){
   var PayrollCode=$("#PayrollCode").val();
   var taxationschemes=$("#taxationschemes").val();
   var path=nId+'/'+userId+'/'+name+"/"+amount+'/'+PayrollCode+'/'+taxationschemes;
 
  if(document.getElementById('fixedDeduction'+nId+dId).checked){
    
  document.getElementById('empDeduction'+nId+dId).disabled=true;
  $("#fDText"+nId+dId).html('<span class="text-danger">Disabled</span>');
 
     $.ajax({
            url:"http://localhost/hr/public/hr/saveFixedDeductionUndo/"+path,
            type:'GET',
            data:'_token=<?php echo csrf_token() ;?>',
            success:function(data){
             if(data.success=='1'){
              $("#successCard").fadeIn();
              $("#textSuccess").html("Custom deduction added successfully");
              setTimeout($("#successCard").fadeOut(),5000);
            } else{
               alert("Unable to add custom deduction");
            }    
            }
        });
  }else{
   document.getElementById('empDeduction'+nId+dId).disabled=false;
  $("#fDText"+nId+dId).html('<span class="text-success">Enabled</span>');

     $.ajax({
            url:"http://localhost/hr/public/hr/saveFixedDeduction/"+path,
            type:'GET',
            data:'_token=<?php echo csrf_token() ;?>',
            success:function(data){
             if(data.success=='1'){
              $("#successCard").fadeIn();
              $("#textSuccess").html("Custom deduction removed successfully");
              setTimeout($("#successCard").fadeOut(),5000);
            } else{
               alert("Unable to remove custom deduction");
            }    
            }
        });
  }
}


    
  </script>
  @endsection
