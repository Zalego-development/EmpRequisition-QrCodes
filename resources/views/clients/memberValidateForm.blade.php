@extends('layouts.app')

@section('content')
<style type="text/css">
.input100 {
    height: 60px !important;
    font-size: 15px !important;
}
</style>
@if(isset($id['id']))
    <small> I don't have an account? <a href="{{url('memberRegister/'.$id['id'])}}">Sign up here</a></small></h3>
    @endif
      </div>
            </div>

            <div class="wrap-login100 p-l-50 p-r-50 p-t-72 p-b-50">
                <form class="login100-form validate-form w3-content" method="GET" action="{{url($whereTo)}}" onsubmit="loader('phone')">
                        @csrf
                        <span class="login100-form-title p-b-20"><img src="{{asset('image/machakos.png')}}" class="img-fluid"></span>
                    <span class="login100-form-title p-b-20">

                        <!-- <h1 class="ml13 p-l-16 p-t-30"><strong>Machakos Golf Club<hr></strong></h1> -->
                       Machakos Golf Club

                        <br>
                    <span class="small">For Machakos Golf member enter Your phone number to proceed</span>
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
                  <!--       <div class="form-group col-4" style="margin-left:-17px;">
                        <span class="label-input100">Country</span>
                        <select name="country" class="form-control">
                            <option data-code="+254" value="254" selected>KE +254</option>
                            <option data-code="+256" value="256">UG +256</option>
                            <option data-code="+250" value="250">RW +250</option>
                            <option data-code="+255" value="255">TZ +255</option>
                            <option data-code="+257" value="257">BI +257</option>
                        </select>
                    </div>
                    <div class="form-group col-8" style="margin-left:-17px;">
                        <span class="label-input100">Phone Number</span>
                        <input type="text" name="phone" value="{{ old('phone') }}" maxlength="9" id="phn" height="70px !important" required autocomplete="off" class="form-control @error('phone') is-invalid @enderror" placeholder="ie 701020344">
                    </div> -->
                    <div class="wrap-input100 validate-input" data-validate = "Invalid phone; expected 2547XXXXXXXX">
                        <span class="label-input100">Phone Number</span>
                      <input type="text" name="phone" class="input100
                         @error('phone') is-invalid @enderror" value="{{ old('phone') }}" id="phn" autocomplete="on" height="70px !important" required placeholder="2547XXXXXXXX">

                        <span class="focus-input100"></span>

                      
                    </div>


                    <div class="flex-m w-full p-b-33">
                        

                        
                    </div>

                    <div class="container-login100-form-btn">


                        <div class="wrap-login100-form-btn">
                            <div class="login100-form-bgbtn"></div>
                            <button type="submit" class="login100-form-btn">
                                Sign in
                            </button>
                        </div><br><br>
                        <div class="wrap-login100-form-btn mt-3">
                            <div class="login100-form-bgbtn"></div>
                            @if(isset($id['id']))
                            <a href="{{url('memberRegister/'.$id['id'])}}"><button type="button" class="login100-form-btn">
                                    Guest? sign up
                                </button></a> 
                            @else
                            <a href="{{url('memberRegister')}}"><button type="button" class="login100-form-btn">
                                    Guest? sign up
                                </button></a> 
                            @endif
                        </div>
                            <!-- " class="login100-form-btn">
                                
                                <i class="fa fa-long-arrow-right m-l-5"></i>
                             -->

                    </div>
                                    <!-- <a class="btn btn-link mt-4 p-l-30" href="http://www.machakosgolfclub.com/">
                                        {{ __('Visit home website?') }}
                                    </a> -->
                </form>
                <!--include the social login-->
                   
                <!--end social login-->
                <br><br>
                        <!-- <br><br> <br><br> <br>  -->
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
            
            $(document).ready(function() {
            var phn = localStorage.getItem('phn');
            document.getElementById("phn").value=phn;
            });
            </script>
@endsection
