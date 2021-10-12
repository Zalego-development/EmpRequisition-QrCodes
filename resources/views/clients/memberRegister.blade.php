@extends('layouts.app')

@section('content')
</h3>
      </div>
            </div>

            <div class="wrap-login100 p-l-50 p-r-50 p-t-72 p-b-50">
                <form class="login100-form validate-form w3-content" method="GET" action="{{url($whereTo)}}" onsubmit="loader('email')">
                        @csrf
                    <span class="login100-form-title p-b-20">
                        <!-- <h1 class="ml13 p-l-16 p-t-30"><strong><hr></strong></h1> -->
                       Machakos Golf Club
                     

                        <br>
                    <span class="small">Create an account</span>
                    </span>


                    @if($errors->any())
                        @foreach ($errors->all() as $error)
                      
                        <div class="alert alert-danger shadow w3-content">
                           <strong style="  font-family: Poppins-Regular; "><i class="fa fa-times" class="close" data-dismiss="alert"></i>  {{ $error }}</strong>
                       </div>
                       
                        @endforeach
                    @endif
                    @if(isset($id['id']))
                     <input type="test" name="gameId" value="{{$id->id}}" style="display:none;">
                     @endif
                     <div class="form-group col-md-6" style="display:none;">
                                <label class="col-form-label" for="grpId">Group Id</label>
                                <input type="text" name="group_id" class="form-control is-valid" id="grpId"  value="8">
                            </div>

                    <div class="wrap-input100 validate-input" data-validate = "First name is required">
                        <span class="label-input100">First Name</span>
                        <input type="text" class="input100
                         @error('firstName') is-invalid @enderror" name="firstName" value="{{ old('firstName') }}" required autocomplete="off" placeholder="FirstName">
                        <span class="focus-input100"></span>

                      
                    </div>

                   <!--  <div class="wrap-input100 validate-input" data-validate = "Middle name is required" style="display:none">
                        <span class="label-input100">Middle Name</span>
                        <input type="text" class="input100
                         @error('middleName') is-invalid @enderror" name="middleName" value="{{ old('middleName') }}" autocomplete="middleName" placeholder="MiddleName">
                        <span class="focus-input100"></span>
                    </div> -->
                    <div class="wrap-input100 validate-input" data-validate = "Last name is required">
                        <span class="label-input100">Last Name</span>
                        <input type="text" class="input100
                         @error('lastName') is-invalid @enderror" name="lastName" value="{{ old('lastName') }}" required autocomplete="off" placeholder="LastName">
                        <span class="focus-input100"></span>
                    </div>
                    <div class="wrap-input100 validate-input" data-validate = "Invalid phone; expected 2547XXXXXXXX">
                        <span class="label-input100">Phone Number</span>
                      <input type="text" name="phone" class="input100
                         @error('phone') is-invalid @enderror" value="{{ old('phone') }}" id="phn" height="70px !important" required autocomplete="off" placeholder="2547XXXXXXXX">

                        <span class="focus-input100"></span>

                      
                    </div>


                <!--     <div class="wrap-input100 validate-input" data-validate = "Phone number is required">
                        <span class="label-input100">Phone Number</span>
                        <div class="form-inline well">
                        <div class="form-group col-4">
                            <select name="countryCode" id="" class="form-control text-success">
                            <option data-countryCode="KE" value="254" Selected>Kenya (+254)</option>
                            <option data-countryCode="UG" value="256">Uganda (+256)</option>
                            <option data-countryCode="RW" value="250">Rwanda (+250)</option>
                            </select>
                        </div>
                        <div class="form-group col-8">
                            <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" id="phn" required autocomplete="off" placeholder="eg 2547XXXXXXX">
                        </div>
                    </div>
                        <span class="focus-input100"></span> 
                    </div>  -->

                    <div class="wrap-input100 validate-input">
                        <span class="label-input100">Email Address</span>
                        <input type="email" class="form-control" name="email" value="{{ old('email') }}" autocomplete="off" placeholder="abc@xyz.com">
                        <span class="focus-input100"></span>
                    </div>

                            
                    <div class="wrap-input100 validate-input" data-validate = "Club is required">
                         <span class="label-input100">Club</span>
                                <select name="club" class="form-control select2" data-placeholder="Select Club" data-dropdown-css-class="select2-success" style="width: 100%;" required>
                                    <option value="">select Club</option>
                                    @forelse($clubs as $club)
                                    <option value="{{$club->clubName}}">{{$club->clubName}}</option>
                                    @empty
                                    
                                    @endforelse
                                </select>
                    </div>

                    

                    <div class="flex-m w-full p-b-33">
                        

                        
                    </div>

                    <div class="container-login100-form-btn">
                        <div class="wrap-login100-form-btn">
                            <div class="login100-form-bgbtn"></div>
                            <button type="submit" class="login100-form-btn">
                                Sign up
                            </button> 
                        </div><br><br>
                        <div class="wrap-login100-form-btn mt-3">
                            <div class="login100-form-bgbtn"></div>
                            @if(isset($id['id']))
                            <a href="{{url('members/login/'.$id['id'])}}"><button type="button" class="login100-form-btn">
                                    Have account? sign in
                                </button></a> 
                            @else
                            <a href="{{url('members/login')}}"><button type="button" class="login100-form-btn">
                                    Have account? sign in
                                </button></a> 
                            @endif
                        </div>

                    </div>
                     
                </form>
                <!--include the social login-->
                <!--end social login-->
                        <!-- <br><br> <br><br> <br> -->
                        <div class="p-b-72">

                        &nbsp</div>
            </div>
         <script type="text/javascript">
$('#phn').keyup(function() {
              $(this).val($(this).val().replace(/ +?/g, ''));
              $(this).val($(this).val().replace(/\+/g, ''));
            });
            $("#phn").keypress(function (e) {
                if (String.fromCharCode(e.keyCode).match(/[^0-9]/g)) return false;
            });
        </script>    
<script>
function goBack() {
  window.history.back();
}
</script>
@endsection
