@extends('layouts.app')

@section('content')
    </h3>
      </div>
            </div>

            <div class="wrap-login100 p-l-50 p-r-50 p-t-72 p-b-50">
                <form class="login100-form validate-form w3-content" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                    <span class="login100-form-title p-b-20">
                        <h1 class="ml13 p-l-16 p-t-30"><strong>Zalego HR System<hr></strong></h1>
                       
                       Welcome {{Auth::user()->name}}<br><small>One last step to get started!</small>
<br>
 <span class="small">(Verify your email address)</span><br>

<img src="{{asset('assets/images/shots/email.gif')}}" class="rounded" width="155px" height="125px"   alt="..."> </span>
   @if (session('resent'))
                        <div class="alert alert-success w3-content shadow" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif
                    <br><br>
                     {{ __('Before proceeding, please check your email for a verification link.') }}
                    {{ __('If you did not receive the email, click the button below to resend the link') }}.
                 
                    
                    

                    <div class="flex-m w-full p-b-33">
                        

                        
                    </div>

                    <div class="container-login100-form-btn ">
                        <div class="wrap-login100-form-btn">
                            <div class="login100-form-bgbtn"></div>
                            <button type="submit" class="login100-form-btn w3-content">
                                Resend activation link
                            </button>

                        </div>

                        
                    </div>
                     
                </form>
                 

                        
                        <div class="p-t-72" style="margin-top: 70px !important;">
                        &nbsp</div>
            </div>
@endsection
