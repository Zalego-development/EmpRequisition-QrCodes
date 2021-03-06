@extends('layouts.app')

@section('content')
    <small> I don't have an account? <a href="{{url('/register')}}">Sign up here</a></small></h3>
      </div>
            </div>

            <div class="wrap-login100 p-l-50 p-r-50 p-t-72 p-b-50">
                <form class="login100-form validate-form w3-content" method="POST" action="{{ route('password.update') }}">
                     @csrf
                     <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                    <span class="login100-form-title p-b-20">
                        <h1 class="ml13 p-l-16 p-t-30"><strong>Zalego HR System<hr></strong></h1>
                       
                        Reset My Password

                        <br>
                    <span class="small">(Password reset form)</span>
                    </span>


                    @if($errors->any())
                        @foreach ($errors->all() as $error)
                      
                        <div class="alert alert-danger shadow w3-content">
                           <strong style="  font-family: Poppins-Regular; "><i class="fa fa-times" class="close" data-dismiss="alert"></i>  {{ $error }}</strong>
                       </div>
                       
                        @endforeach
                    @endif
                    <div class="wrap-input100 validate-input" data-validate = "Invalid email; expected abc@xyz.com">
                        <span class="label-input100">Email</span>
                        <input type="email" class="input100
                         @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                        <span class="focus-input100"></span>

                      
                    </div>




                    <div class="wrap-input100 validate-input" data-validate = "Password is required">
                        <span class="label-input100">Password</span>
                        <input type="password" class="input100 @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="***********">
                        <span class="focus-input100"></span>

                               
                    </div>

                     <div class="wrap-input100 validate-input" data-validate = "Password is required">
                        <span class="label-input100">Password</span>
                        <input type="password" class="input100" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm Password">
                        <span class="focus-input100"></span>

                               
                    </div>

                    

                    <div class="flex-m w-full p-b-33">
                        

                        
                    </div>

                    <div class="container-login100-form-btn">
                        <div class="wrap-login100-form-btn">
                            <div class="login100-form-bgbtn"></div>
                            <button type="submit" class="login100-form-btn">
                                Reset password
                            </button>
                        </div>

                       
                    </div>
                    
                </form>
                 

                        <br><br> <br><br> <br>
                        <div class="p-b-72" style="margin-top: 192px;">
                        &nbsp</div>
            </div>
@endsection
