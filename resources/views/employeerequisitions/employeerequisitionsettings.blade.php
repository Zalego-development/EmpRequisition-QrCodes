@extends('layouts.main')
@section('content')
<style type="text/css">
    #newStudent .form-control {
        /**padding: 17px !important;**/
        /*border-color: transparent !important;*/
    }

    #successM {
        display: none;
    }

    .btn-default {
        background-color: #fe740b !important;
        color: #fff !important;
    }

    .btn-default:hover {
        color: #fff !important;
        background-color: #60b117 !important;
        -webkit-transition: background-color 1000ms linear;
        -ms-transition: background-color 1000ms linear;
        transition: background-color 1000ms linear;
    }

    .dropdown-menu {
        position: absolute;
        top: 100%;
        left: 0;
        margin-bottom: 20%;
        z-index: 3000;
        display: none;
        float: left;
        min-width: 10rem;
        padding: 0.5rem 0;
        margin: 0.125rem 0 0;
        font-size: 1rem;
        color: #212529;
        text-align: left;
        list-style: none;
        background-color: #ffffff;
        background-clip: padding-box;
        border: 1px solid rgba(0, 0, 0, 0.15);
        border-radius: 0.25rem;
        box-shadow: 0 0.5rem 1rem rgb(0 0 0 / 18%);
    }

    .card {
        border-color: transparent !important;
        border-radius: 0px !important;
        background-color: #fff !important;
    }

    .dropdown-item:focus,
    .dropdown-item:hover {
        background-color: transparent !important;
    }

    #wp-icon:hover {
        border: 1px solid orange !important;
        color: orange !important;
    }
</style>
<script>
    $(function () {
        $('table').dataTable();
    });
</script>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-muted ml-2 mt-2"><strong>Employee Requisition</strong></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <div class="float-right mt-2">
                        <div class="btn-group btn-group-justified">

                        </div>
                    </div>
                </div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <section class="content">
        <!-- /.list of requisitions-fluid -->


         <div class="row">
            <div class="col">        <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalsetting">
 EmployeeRequisition Settings
</button>&nbsp;&nbsp;<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
 Add EmployeeRequisition Settings Users
</button></div>
    <div class="col"></div>  
        </div>
@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<!-- Modal  for settings-->
<div class="modal fade" id="exampleModalsetting" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">EmployeeRequisition settings</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{ url('employeerequisitionsettingsstore') }}">
            @csrf
      <fieldset >
     <div class="form-group">
      <label for="disabledTextInput">Approvals Levels</label>
      <input type="text" class="form-control" id="exampleFormControlTextarea1" name="employeetype" required="">
    </div>
      </fieldset>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Add</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!--- modals for users --->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Approvers Levels</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="{{ url('employeerequisitionusersstore') }}">
            @csrf
      <fieldset >
        <div class="form-group">
      <label for="disabledTextInput">Company</label>

        <select class="form-control" name="company" id="company" class="form-control input-lg dynamic" data-dependent="userId">
            <option>please Select Company</option>
            @php 
            $company=DB::table('companies')
                    ->get();
                    @endphp
           @foreach ($company as $camp)
        <option value="{{ $camp->id }}"> {{ $camp->company }} </option>            
            @endforeach    
      </select>   
    </div>
     <div class="form-group">
      <label for="disabledTextInput">Approver Job Title</label>
        <select class="form-control" name="employeetype">
            <option>please Select Job title</option>
           @foreach ($employeeRequisitionsettings as $setting)
        <option value="{{ $setting->employeetype }}"> {{ $setting->employeetype }} </option>            
            @endforeach    
      </select>   
    </div>
         <div class="form-group">
      <label for="disabledTextInput">Employees</label>

      <input list="brow" value="" class="form-control">
       <datalist id="brow">
        <select name="userId" id="userId" class="form-control input-lg dynamic my-select">
             <option value="">Select users</option>  
      </select> 
      </datalist> 
       {{ csrf_field() }}  
    </div>
      </fieldset>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!--- table for all requisitions -->

        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="mt-2">
                        </div>

                    </div>
                </div>
            </div>
            <hr>
            <div class="col-md-12 mb-3">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
<!--                     <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#enrolled" role="tab"
                            aria-controls="home" aria-selected="true"
                            style="color: gray !important; font-family: calibri;">
                            <i class="fa fa-clipboard text-primary"></i>
                            <strong> Approvals Levels<sup class="badge bg-white shadow-lg text-muted"></sup></strong>
                        </a>
                    </li> -->
                    <li class="nav-item">
                        <a class="nav-link active" id="reenabled-tests" data-toggle="tab" href="#reenabledTests" role="tab"
                            aria-controls="recurring" aria-selected="false"
                            style="color: gray !important; font-family: calibri;"><i
                                class="fa fa-users text-primary"></i><strong>
                                &nbsp; Approvers Users </strong></a>
                    </li>
                </ul>
                <div class="tab-content " id="myTabContent">
                    <div class="tab-pane fade show active" id="enrolled" role="tabpanel" aria-labelledby="home-tab">
                        <div class="card" style="border-shadow:none !important">
                            <div class="card-body">
                                <div class="table-responsive mt-3 mb-5">
                                    <table id="example1" class="table table-hover ">
                                       <thead>
                                            <tr class="bg-light">
                                               <th>#</th>
                                               <th>Company</th>
                                               <th>Approval Level</th> 
                                               <th>Approver Name</th>  
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                            $count = 1;
                                            @endphp
                                            @forelse ($employeeRequisitionusers as $emprequest)
                                            <tr>
                                                <td>{{ $count++ }}</td>
                                                @php
                                                $manager=DB::table('users')
                                                         ->join('employeerequisitionusers', 'employeerequisitionusers.userId', '=', 'users.id')
                                                         ->where('employeerequisitionusers.userId',$emprequest->userId)
                                                         ->first();
                                                @endphp

                                                 @php
                                                $managercompany=DB::table('users')
                                                         ->join('employeerequisitionusers', 'employeerequisitionusers.userId', '=', 'users.id')
                                                         ->join('companies' ,'companies.id' ,'=', 'users.company_id')
                                                         ->where('employeerequisitionusers.userId',$emprequest->userId)
                                                         ->first();
                                                @endphp
                                                <td> {{ $managercompany->company }}</td>
                                                <td>{{ $emprequest->employeetype }}</td>
                                                <td> {{ $manager->name }}</td>
                                                

                                                
                                                     <td>
                                                        <span class="dropdown">
                                                        <a title="Action tab" id="wp-icon" class="btn btn-secondary "
                                                            style="border: 1px dashed gray; border-radius:50%; box-shadow:none !important"
                                                            href="#" id="dropdownMenuButton" data-toggle="dropdown"
                                                            aria-haspopup="true" aria-expanded="false"
                                                            style="cursor: pointer;">
                                                            <i class="fa fa-ellipsis-h"
                                                                style="margin-top: -9px !important;"></i></a>
                                                        <div style="margin-left:-120px !important;"
                                                            class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                            <div style="text-align: center">
                                                                <form action="{{route('employeerequisitionsusers.destroy',$emprequest->id) }}" method="POST">
                                                                   <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModaledita{{$emprequest->id}}">Edit
                                                                   </button>
                                                                      @csrf
                                                                       @method('DELETE')

                                                                    <button type="submit" id="{{$emprequest->id}}" class="btn btn-danger btn-sm"
                                                                        title="Delete" onclick="return confirm(&quot;Confirm delete?&quot;")> Delete
                                                                    </button>
                                                                     
                                                                </form>
                                                            </div>
                                                        </div><br>
                                                    </span>
                                             </td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <td colspan="11" clas="text-center">
                                                    <div class="text-center py-5 " style="color:#b3cccc !important">
                                                        <i class="fa fa-file fa-5x"></i>
                                                        <i class="fa fa-times fa-2x"
                                                            style="z-index: 9999; color: #fff; margin-left: -25px;"></i>
                                                        <br>
                                                        <h6>No Applicants available</h6>
                                                    </div>
                                                </td>
                                            </tr>
                                   @endforelse
                                        </tbody>
                                    </table>
                                   
                            @forelse ($employeeRequisitionusers as $emprequest)

                                <!-- Modal -->
                               <div class="modal fade" id="exampleModaledita{{$emprequest->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabeledit"aria-hidden="true">
                                 <div class="modal-dialog" role="document">
                                   <div class="modal-content">
                                     <div class="modal-header">
                                       <h5 class="modal-title" id="exampleModalLabel">Employee Requisition settings</h5>
                                       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                         <span aria-hidden="true">&times;</span>
                                       </button>
                                     </div>
                                     <div class="modal-body">
                                       <form action="{{route ('employeerequisitionsettingsupdate')}}" method="POST">
                                       @csrf

                                       <fieldset class="col-md-12" >
                                        <div class="form-group">
                                                @php
                                                $manager=DB::table('users')
                                                         ->join('employeerequisitionusers', 'employeerequisitionusers.userId', '=', 'users.id')
                                                         ->where('employeerequisitionusers.userId',$emprequest->userId)
                                                         ->first();
                                                @endphp
                                       <input type="text" class="form-control"  value="{{$emprequest->id}}" name="id" hidden="" required="">
                                     </div>
                                          <div class="form-group">
                                          <select class="form-control" name="employeetype">
                                            <option value="{{$emprequest->employeetype}}">{{$emprequest->employeetype}}</option>
                                         @foreach ($employeeRequisitionsettings as $setting)
                                         <option value="{{ $setting->employeetype }}"> {{ $setting->employeetype }} </option>            
                                        @endforeach    
                                       </select> 
                                   </div>
                                         <div class="form-group">
                                       <label for="disabledTextInput">Employee Type</label>
                                               <select class="form-control" name="userId">
                                                <option value="{{$manager->userId}}">{{$manager->name}}&nbsp; </option>
                                                    @foreach ($users as $user)
                                                 <option value="{{ $user->id }}"> {{ $user->name }} </option>            
                                                     @endforeach    
                                               </select> 

                                               </div>
                                       </fieldset>
                                       <br>
                                       
                                       
                                     </div>
                                     <div class="modal-footer">
                                       <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                         <button type="submit" class="btn btn-primary">Save changes</button>
                                     </div>
                                       </form>
                                   </div>
                                 </div>
                               </div>
                               @empty

                               @endforelse                                    <!-- Button trigger modal -->

                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- users tabs ---->
                <div class="tab-pane fade" id="reenabledTests" role="tabpanel" aria-labelledby="reenabled-tests">
                        <div class="card" style="border-shadow:none !important">

                            <div class="card-body">
                                <div class="table-responsive mt-3 mb-5">
                                    <table id="example1" class="table table-hover ">
                                        <thead>
                                            <tr class="bg-light">
                                               <th>#</th>
                                               <th>Company</th>
                                               <th>Approval Level</th> 
                                               <th>Approver Name</th>  
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                            $count = 1;
                                            @endphp
                                            @forelse ($employeeRequisitionusers as $emprequest)
                                            <tr>
                                                <td>{{ $count++ }}</td>
                                                @php
                                                $manager=DB::table('users')
                                                         ->join('employeerequisitionusers', 'employeerequisitionusers.userId', '=', 'users.id')
                                                         ->where('employeerequisitionusers.userId',$emprequest->userId)
                                                         ->first();
                                                @endphp

                                                 @php
                                                $managercompany=DB::table('users')
                                                         ->join('employeerequisitionusers', 'employeerequisitionusers.userId', '=', 'users.id')
                                                         ->join('companies' ,'companies.id' ,'=', 'users.company_id')
                                                         ->where('employeerequisitionusers.userId',$emprequest->userId)
                                                         ->first();
                                                @endphp
                                                <td> {{ $managercompany->company }}</td>
                                                <td>{{ $emprequest->employeetype }}</td>
                                                <td> {{ $manager->name }}</td>
                                                

                                                
                                                     <td>
                                                        <span class="dropdown">
                                                        <a title="Action tab" id="wp-icon" class="btn btn-secondary "
                                                            style="border: 1px dashed gray; border-radius:50%; box-shadow:none !important"
                                                            href="#" id="dropdownMenuButton" data-toggle="dropdown"
                                                            aria-haspopup="true" aria-expanded="false"
                                                            style="cursor: pointer;">
                                                            <i class="fa fa-ellipsis-h"
                                                                style="margin-top: -9px !important;"></i></a>
                                                        <div style="margin-left:-120px !important;"
                                                            class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                            <div style="text-align: center">
                                                                <form action="{{route('employeerequisitionsusers.destroy',$emprequest->id) }}" method="POST">
                                                                   <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModaledita{{$emprequest->id}}">Edit
                                                                   </button>
                                                                      @csrf
                                                                       @method('DELETE')

                                                                    <button type="submit" id="{{$emprequest->id}}" class="btn btn-danger btn-sm"
                                                                        title="Delete" onclick="return confirm(&quot;Confirm delete?&quot;")> Delete
                                                                    </button>
                                                                     
                                                                </form>
                                                            </div>
                                                        </div><br>
                                                    </span>
                                             </td>
                                            </tr>
                                            @empty
                                            <tr>
                                                <td colspan="11" clas="text-center">
                                                    <div class="text-center py-5 " style="color:#b3cccc !important">
                                                        <i class="fa fa-file fa-5x"></i>
                                                        <i class="fa fa-times fa-2x"
                                                            style="z-index: 9999; color: #fff; margin-left: -25px;"></i>
                                                        <br>
                                                        <h6>No Applicants available</h6>
                                                    </div>
                                                </td>
                                            </tr>
                                   @endforelse
                                        </tbody>
                                    </table>
                                   
                            @forelse ($employeeRequisitionusers as $emprequest)

                                <!-- Modal -->
                               <div class="modal fade" id="exampleModaledita{{$emprequest->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabeledit"aria-hidden="true">
                                 <div class="modal-dialog" role="document">
                                   <div class="modal-content">
                                     <div class="modal-header">
                                       <h5 class="modal-title" id="exampleModalLabel">Employee Requisition settings</h5>
                                       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                         <span aria-hidden="true">&times;</span>
                                       </button>
                                     </div>
                                     <div class="modal-body">
                                       <form action="{{route ('employeerequisitionsettingsupdate')}}" method="POST">
                                       @csrf

                                       <fieldset class="col-md-12" >
                                        <div class="form-group">
                                                @php
                                                $manager=DB::table('users')
                                                         ->join('employeerequisitionusers', 'employeerequisitionusers.userId', '=', 'users.id')
                                                         ->where('employeerequisitionusers.userId',$emprequest->userId)
                                                         ->first();
                                                @endphp
                                       <input type="text" class="form-control"  value="{{$emprequest->id}}" name="id" hidden="" required="">
                                     </div>
                                          <div class="form-group">
                                          <select class="form-control" name="employeetype">
                                            <option value="{{$emprequest->employeetype}}">{{$emprequest->employeetype}}</option>
                                         @foreach ($employeeRequisitionsettings as $setting)
                                         <option value="{{ $setting->employeetype }}"> {{ $setting->employeetype }} </option>            
                                        @endforeach    
                                       </select> 
                                   </div>
                                         <div class="form-group">
                                       <label for="disabledTextInput">Employee Type</label>
                                               <select class="form-control" name="userId">
                                                <option value="{{$manager->userId}}">{{$manager->name}}&nbsp; </option>
                                                    @foreach ($users as $user)
                                                 <option value="{{ $user->id }}"> {{ $user->name }} </option>            
                                                     @endforeach    
                                               </select> 

                                               </div>
                                       </fieldset>
                                       <br>
                                       
                                       
                                     </div>
                                     <div class="modal-footer">
                                       <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                         <button type="submit" class="btn btn-primary">Save changes</button>
                                     </div>
                                       </form>
                                   </div>
                                 </div>
                               </div>
                               @empty

                               @endforelse                                    <!-- Button trigger modal -->


                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

</section>
</div>
<script type="text/javascript">
    function buttonToggler(id){
        $('#'+id).slideUp()
    }
</script>


  <script>
$(document).ready(function(){
 $('#company').change(function(){
  if($(this).val() != '')
  {
   var select = $(this).attr("id");
   var value = $(this).val();
   var dependent = $(this).data('dependent');
   var _token = $('input[name="_token"]').val();
   $.ajax({
    url:"{{ route('dynamicdependent.fetch') }}",
    method:"POST",
    data:{select:select, value:value, _token:_token, dependent:dependent},
    success:function(result)
    {
     $('#'+dependent).html(result.output);
    }

   })
  }
 });
 
// $('.my-select').selectpicker();
});
</script>
         

@endsection



