 <!DOCTYPE html>
 <html>
 <head>
   <meta charset="utf-8">
   <title></title>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
   <style type="text/css">
     h1{
      color: green;
     }
     .footer{
      text-align: center;
      padding-top: 37%;
      font-family: sans-serif;
      color: green;
      font-size: 12px;
     }
     body{
          background-image: url(/assets/images/enroll.png);
          height: auto;
     }
     .lead{
      background-color: #F57E20;
      height: 50px;
     }
 
   </style>
 </head>
 <body>
  <br></br><br></br>
  <div class="jumbotron text-center">
  <h1 class="display-3"><u>Thank You!</u></h1>
  <div class="container">
      <p>
  @if ($message = Session::get('success'))
        <div class="lead">
            <p>{{ $message }}</p>
        </div>
    @endif
  </p>
  </div>

</div>
<div class="container">
  <div class="footer"  >
  @include('includes.footer')
</div>
</div>

 </body>
 </html>
 

