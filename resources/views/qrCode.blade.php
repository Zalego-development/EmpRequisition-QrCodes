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
                    <h1 class="m-0 text-muted ml-2 mt-2"><strong>Staff Id QR Codes</strong></h1>
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
         <div class="pull-left">
            <a class="btn btn-primary" href="{{ url('employeesqrcodes') }}"> Back</a>
        </div>
        <br>
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
<div class="container">
    <div class="row">
        <div class="col-md-6">
    <form action="" method="POST">
                @csrf
  <fieldset>
    <legend class="form-control">Personal Details:</legend><br>
    <label for="fname">First name:</label>
    <input type="text" class="form-control" id="fname" value="{{$user->firstname}}" readonly required name="fname"><br>
    <label for="lname">Last name:</label>
    <input type="text" class="form-control" id="lname" value="{{$user->lastname}}" readonly required name="lname"><br>
    <label for="email">Email:</label>
    <input type="email" class="form-control" id="email"value="{{$user->corporateEmail}}" readonly name="email"><br>
     <label for="title">Title:</label>
     @php 
    $title=DB::table('titles')
          ->where('id', $user->designationId)
          ->first();
     @endphp
    <input type="text" class="form-control" id="Title" value="{{$title->title}}" readonly name="Title"><br>
    <label for="number">Phone:</label>
    <input type="number" class="form-control" id="phone" value="{{$user->contact}}" readonly name="phone"><br>
    <label for="email">Url:</label>
    <input type="url" class="form-control" id="email" value="{{$geturl->url}}" readonly name="url"><br>
     <label for="birthday">Department</label>
          @php 
    $departmentId=DB::table('departments')
          ->where('id', $user->departmentId)
          ->first();
     @endphp
    <input type="text" class="form-control" id="Department" readonly value="{{$departmentId->department}}" name="Department"><br>
  </fieldset>
</form>
        </div>
        <div class="col-md-6">  
        <p></p><br><br> 
        <h4 style="text-align: center;">Employee QR Code</h4>  
           <p style="text-align: center;">
 {!! $qr !!}</p><br>
           <a href="{{ route('exportdownload',$user->id) }}"><button class="btn-primary" >Export</button></a> 
           
        </div>
    </div>
</div>
 
</section>
</div>
<script type="text/javascript">
</script>
  
         

@endsection
