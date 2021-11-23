@extends('layouts.employee')
@section('content')
 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
              <h1 class="m-0 text-muted ml-2 mt-4"><strong>Training Survey</strong></h1>
            <ol class="breadcrumb float-sm-left ml-2">
              <li class="breadcrumb-item"><a href="{{url('/home')}}"><i class="fa fa-home"></i></a></li>
              <li class="breadcrumb-item active">Trainings</li>
              <li class="breadcrumb-item active">Survey</li>
            </ol>
          </div><!-- /.col -->

        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
<section class="container card px-3 py-3">
  <div class="card-header">
    <i class="fas fa-window-close float-right fa-2x" style="margin-top: -10px; cursor: pointer;" onclick="history.back()"></i>
  </div>
  <div class="table-responsive">
    <table class="table table-bordered">
      <tr>
      <th>#</th>
      <th>Traninig Name</th>
      <th>Created On</th>
      <th>Due On</th>
      <th>Actions</th>
    </tr>
    <?php
    $y=1;
    ?>
    @if(count($survey)>0)
    @foreach($survey as $tb)
      <tr>
        <td>{{$y++}}</td>
        <td>{{ucwords(strtolower(DB::table($tb->trainingCategory)->where('id',$tb->training_id)->value('title')))}}</td>
        <td>{{Carbon\Carbon::parse($tb->created_at)->format('d-M-Y')}}</td>
        <td>{{Carbon\Carbon::parse($tb->due_on)->format('d-M-Y')}}</td>
        <td><a href="{{url('/viewSurvey/'.$tb->id)}}"><button class="btn btn-sm btn-warning shadow-lg"><i class="fas fa-eye"></i> View survey</button></td>
      </tr>
    @endforeach
    @else
    <tr>
      <td colspan="5">No records present</td>
    </tr>
    @endif
    </table>
  </div>
</section>
</div>
@endsection