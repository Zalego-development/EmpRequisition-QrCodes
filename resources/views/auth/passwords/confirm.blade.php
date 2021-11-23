@extends('layouts.app')

@section('content')
<div class="wrapper">
            <div class="inner">
                 <form method="POST" action="{{ route('password.confirm') }}">
                        @csrf
                    <center><img src="../assets/lr/images/image-2.png" width="40px" height="40px"></center>
                    <h3 class="mt-2"><strong>Zalego Smart HR <br><small style="font-size: 12px;"><i>({{ __('Please confirm your password before continuing.') }})</i></small></strong></h3>

                    <div class="row">
                      
                        <div class="col-md-6 mt-4">
                            <div class="form-holder">
                                <span class="lnr lnr-lock"></span>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Password">

                                 @error('password')
                                            <span class="invalid-feedback  mt-5" role="alert" >
                                                <span class="text-danger" style="font-size: 12px; "><i><i class="fa fa-times"></i> {{ $message }}</i></span>
                                            </span>
                                        @enderror
                            </div>
                        </div>

                        <div class="col-md-6 mt-4">
                            <div class="form-holder">
                                <span class="lnr lnr-lock"></span>
                                <input type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm Password">
                            </div>
                        </div>
                    </div>
                    
                    
                    
                    
                    
                    <button type="submit">
                        <span>Confirm your password</span>
                    </button>
                    @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                </form>


                
            </div>
            
        </div>
        
@endsection
