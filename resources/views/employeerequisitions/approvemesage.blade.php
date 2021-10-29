 <!DOCTYPE html>
 <html>
 <head>
   <meta charset="utf-8">
   <title></title>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
 </head>
 <body>
 
 </body>
 </html>
 <div class="jumbotron text-center">
  <h1 class="display-3">Thank You!</h1>
  <p class="lead"><strong>Your approvals have been send successfully.</strong></p>
  <hr>
  <p>
   
  @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
  </p>
  <p class="lead">
   <!--  <a class="btn btn-primary btn-sm" href="https://bootstrapcreative.com/" role="button">Continue to homepage</a> -->
  </p>
</div>
