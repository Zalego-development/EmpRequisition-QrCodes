<br><br>
                <div class="w3-content desktopSocial" style="max-width: 60%;">
                  <div class="row">
                    <div class="col-12 text-center">
                        <h4>OR</h4>
                        <span class="small">Sign in / Sign up using</span>
                    </div>
                    
                    <br> <br> <br>
                    <div class="col-4 text-center">
                        <a href="{{ url('/auth/google') }}" onclick="loader('google')"><button class="btn btn-sm shadow-lg btn-danger "><i class="fa fa-google-plus"></i> | Google +</button></a>
                    </div>

                     <div class="col-4 text-center">
                       <a href="{{ url('/auth/facebook') }}" onclick="loader('facebook')"> <button class="btn btn-sm shadow-lg btn-primary "><i class="fa fa-facebook"></i> | Facebook</button></a>
                    </div>

                     <div class="col-4 text-center">
                       <a href="{{ url('/auth/twitter') }}" onclick="loader('twitter')"> <button class="btn btn-sm shadow-lg btn-info "><i class="fa fa-twitter"></i> | Twitter</button></a>
                    </div>

                    </div>
                </div>

                <div class="w3-content mobileSocial" style="max-width: 60%;">
                  <div class="row">
                    <div class="col-12 text-center">
                        <h4>OR</h4>
                        <span class="small">Sign up using</span>
                    </div>
                    <br> <br> <br>
                    <div class="col-4 text-center">
                        <a onclick="loader('google')" href="{{ url('/auth/google') }}"><button class="btn btn-sm shadow-lg btn-danger "><i class="fa fa-google-plus"></i></button></a>
                    </div>

                     <div class="col-4 text-center">
                       <a onclick="loader('facebook')" href="{{ url('/auth/facebook') }}"> <button class="btn btn-sm shadow-lg btn-primary "><i class="fa fa-facebook"></i> </button></a>
                    </div>

                     <div class="col-4 text-center">
                       <a onclick="loader('twitter')" href="{{ url('/auth/twitter') }}"> <button class="btn btn-sm shadow-lg btn-info "><i class="fa fa-twitter"></i></button></a>
                    </div>

                    </div>
                </div>
                 
