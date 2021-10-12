@extends('layouts.main')
@section('content')
<div class="content-wrapper">
 <section class="content">
     <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
             <br>
                <h2>Applicants</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('applicants.index') }}"> Back</a>
            </div>
        </div>
    </div>
    <form method="POST" action="{{ route('applicants.update',$applicant->id) }}">
      @csrf
        @method('PUT')
  <div class="form-row">
    <div class="col-md-4 mb-3">
      <label for="validationCustom01">First name</label>
      <input type="text" class="form-control" id="validationCustom01" readonly="" value=" {{ $applicant->fname }}" required>
      <div class="valid-feedback">
        Looks good!
      </div>
    </div>
    <div class="col-md-4 mb-3">
      <label for="validationCustom02">Last name</label>
      <input type="text" class="form-control" id="validationCustom02" readonly="" value="{{ $applicant->lname }}"  required>
      <div class="valid-feedback">
        Looks good!
      </div>
    </div>
    <div class="col-md-4 mb-3">
      <label for="validationCustomUsername">Email</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text" id="inputGroupPrepend">@</span>
        </div>
        <input type="text" class="form-control" readonly="" id="validationCustomUsername" value="{{ $applicant->email }}" aria-describedby="inputGroupPrepend" required>
        <div class="invalid-feedback">
          Please choose a username.
        </div>
      </div>
    </div>
  </div>
  <div class="form-row">
    <div class="col-md-6 mb-3">
      <label for="validationCustom03">City</label>
      <input type="text" class="form-control" id="validationCustom03" placeholder="City" required>
      <div class="invalid-feedback">
        Please provide a valid city.
      </div>
    </div>
    <div class="col-md-3 mb-3">
      <label for="validationCustom04">State</label>
      <input type="text" class="form-control" id="validationCustom04" placeholder="State" required>
      <div class="invalid-feedback">
        Please provide a valid state.
      </div>
    </div>
    <div class="col-md-3 mb-3">
      <label for="validationCustom05">Zip</label>
      <input type="text" class="form-control" id="validationCustom05" placeholder="Zip" required>
      <div class="invalid-feedback">
        Please provide a valid zip.
      </div>
    </div>
  </div>
   <div class="form-group col-sm-9">
    <label for="exampleFormControlTextarea1">Description</label>
    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
        <div class="form-group col-md-4">
      <label for="inputState">Action</label>
      <select id="inputState" class="form-control" name="action">
        <option selected>Choose...</option>
        <option value="approved">Approve</option>
        <option value="declined">Decline</option>
      </select>
    </div>
  </div> 
  <button class="btn btn-primary" type="submit">Submit</button>
</form>
 </section>   
</div>
    
@endsection