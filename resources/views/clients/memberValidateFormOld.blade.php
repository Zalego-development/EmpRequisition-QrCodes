@extends('layouts.master')
@section('content')
 
 
 <div class="container">


 <div class="col-md-12 mb-4">
          @if(count($errors)>0)
              @foreach($errors->all() as $error)
                  <div class="alert alert-warning alert-dismissible fade show" role="alert">
                      {{$error}}
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
              @endforeach
          @endif
      </div>


   <br><br>
   
    <div class="row">
      
       <div class="col-sm-2"></div>
       <div class="col-sm-8">
       
           <div class="card">
                <div class="card-header">
                    Enter Your phonenumber to proceed
                </div>
                <div class="card-body">
                   <form method="GET" action="{{url('members/valiadatePhone')}}">
                       <div class="form-group">
                      <label>Phonenumber:</label>
                      <input type="text" name="phone" class="form-control" required placeholder="2547XXXXXXXX"><br><br>

                      <input type="test" name="gameId" value="{{$id->id}}" style="display:none;">
                      </div>
                      <button type="submit" class="btn btn-primary">Login</button>
                    
                      Not Amember <a href="#" data-toggle="modal" data-target="#modal-default">Register</a>
                   </form>
                   
                </div>
            </div>

       </div>
       <div class="col-sm-2"></div>

        <div class="modal fade" id="modal-default">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        
                        <span style="font-size: 3rem;">
                            <span style="color: Mediumslateblue;">
                            <h4 class="modal-title"><i class="fa fa-user-plus"> Register</i></h4>
                            </span>
                        </span>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" style="color: Mediumslateblue;">&times;</span>
                    </button>
                    </div>
                    <form method="GET" action="{{url('/Booking/Register')}}">
                    <div class="modal-body">

                        <div class="row">

                            <input type="test" name="gameId" value="{{$id->id}}" style="display:none;">

                            <div class="form-group col-md-6" style="display:none;">
                                <label class="col-form-label" for="middleName">Group Id</label>
                                <input type="text" name="group_id" class="form-control is-valid" id="middleName"  value="1">
                            </div>

                            <div class="form-group col-md-6">
                                <label class="col-form-label" for="middleName">First Name</label>
                                <input type="text" name="firstName" class="form-control is-valid" id="middleName" placeholder="First Name" required>
                            </div>

                            <div class="form-group col-md-6">
                                <label class="col-form-label" for="middleName">Middle Name</label>
                                <input type="text" name="middleName" class="form-control is-valid" id="middleName" placeholder="Middle Name" >
                            </div>

                            <div class="form-group col-md-6">
                                <label class="col-form-label" for="middleName">Last Name</label>
                                <input type="text" name="lastName" class="form-control is-valid" id="middleName" placeholder="Last Name" required>
                            </div>

                            <div class="form-group col-md-6">
                                <label class="col-form-label" for="middleName">Email Address</label>
                                <input type="text" name="email" class="form-control is-valid" id="middleName" placeholder="Email Address" required>
                            </div>

                            <div class="form-group col-md-6">
                                <label class="col-form-label" for="middleName">Phonenumber</label>
                                <input type="text" name="phone" class="form-control is-valid" id="middleName" placeholder="eg 2547XXXXXXX" required>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="club_id" class="col-form-label">Club</label>
                                <select name="club" class="form-control is-valid select2" data-placeholder="Select Club" data-dropdown-css-class="select2-success" style="width: 100%;" required>
                                    <option value="">select Club</option>
                                    @forelse($clubs as $club)
                                    <option value="{{$club->clubName}}">{{$club->clubName}}</option>
                                    @empty
                                    
                                    @endforelse
                                </select>
                            </div>


                            

                
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Register</button>
                    </div>
                    </form>
                </div>
            <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>

    </div>
 </div>


@endsection