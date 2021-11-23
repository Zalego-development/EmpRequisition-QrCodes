<!DOCTYPE html>
<html>
<head>
    <title>Zalego Academy Hiring Manager</title>
     <style type="text/css">
        /* BTW alt-shift will pop a color picker 
  example color: followed  by alt shift will pop it
*/
/*
Hide the label if placeholder is supported
*/

body{
  background:#b4b4b4;
}

#registration-form {
  font-family:'Open Sans Condensed', sans-serif;
  width: 800px;
  min-width:450px;
  margin: 20px auto;
  position: relative;
}

#registration-form .fieldset {
  background-color:#d5d5d5;

  border-radius: 0px;
  
}

 #registration-form legend {
  text-align: center;
  background: orange;
  width: 100%;
  padding: 30px 0;
  border-radius: 3px 3px 0 0;
  color: white;
font-size:2em;
}

.fieldset form{
  border:0px solid #2f2f2f;
  margin:0 auto;
  display:block;
  width:100%;
  padding:30px 20px;
  box-sizing:border-box;
  border-radius:0 0 3px 3px;
}
.placeholder #registration-form label {
  display: none;
}
 .no-placeholder #registration-form label{
margin-left:5px;
  position:relative;
  display:block;
  color:orange;
  font-size: 22px;
  text-shadow:0 1px white;
  font-weight:bold;
}
/* all */
::-webkit-input-placeholder { text-shadow:1px 1px 1px white; font-weight:bold; }
::-moz-placeholder { text-shadow:0 1px 1px white; font-weight:bold; } /* firefox 19+ */
:-ms-input-placeholder { text-shadow:0 1px 1px white; font-weight:bold; } /* ie */
#registration-form input[type=text] {
  padding: 15px 20px;
  border-radius: 1px;
  margin:5px auto;
  background-color:#f7f7f7;
  border: 1px solid silver;

  -webkit-box-shadow: inset 0 1px 5px rgba(0,0,0,0.2);
  box-shadow: inset 0 1px 5px rgba(0,0,0,0.2), 0 1px rgba(255,255,255,.8);
  width: 100%;

  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  -ms-box-sizing: border-box;
  box-sizing: border-box;
  -webkit-transition:background-color .5s ease;
-moz-transition:background-color .5s ease;
-o-transition:background-color .5s ease;
-ms-transition:background-color .5s ease;
transition:background-color .5s ease;
}
.no-placeholder #registration-form input[type=text] {
  padding: 10px 20px;
}

#registration-form input[type=text]:active, .placeholder #registration-form input[type=text]:focus {
  outline: none;
  border-color: silver;
  background-color:white;
}

#registration-form input[type=submit] {
  font-family:'Open Sans Condensed', sans-serif;
  text-transform:uppercase;
  outline:none;
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  -ms-box-sizing: border-box;
  box-sizing: border-box;
  width: 100%;
  background-color: #5C8CA7;
  padding: 10px;
  color: white;
  border: 1px solid #3498db;
  border-radius: 3px;
  font-size: 1.5em;
  font-weight: bold;
  margin-top: 5px;
  cursor: pointer;
  position:relative;
  top:0;
}

#registration-form input[type=submit]:hover {
  background-color: #2980b9;
}

#registration-form input[type=submit]:active {
background:#5C8CA7;
}


.parsley-error-list{
background-color:#C34343;
padding: 5px 11px;
margin: 0;
list-style: none;
border-radius: 0 0 3px 3px;
margin-top:-5px;
  margin-bottom:5px;
  color:white;
  border:1px solid #870d0d;
  border-top:none;
    -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  box-sizing: border-box;
  position:relative;
  top:-1px;
  text-shadow:0px 1px 1px #460909;
    font-weight:700;
  font-size:12px;
}
.parsley-error{
  border-color:#870d0d!important;
  border-bottom:none;
}
#registration-form select{
  width:100%;
  padding:5px;
}
::-moz-focus-inner {
  border: 0;
}
    </style>
</head>
<body>
    <div id="registration-form">
  <div class='fieldset'>
    <legend>Employee Requisition Approved By Lead Executive<br> 
     <p>Hi?, Hope this find you well, Please Go through the requisition form for Approvals</p></legend>
    <form action="#" method="post" data-validate="parsley">
      <div class='row'>
        <h4 for='firstname'>Requisition Tittle</h4>
        <p>{{ $data['jobtittle'] }}</p>
      </div>
      <div class='row'>
        <h4 for="email">Job Discription</h4>
        <p>{!! $data['jobdescription'] !!}</p>
      </div>
      <div class='row'>
        <h4 for="cemail">Key Responsibilities</h4>
       <p>{!! $data['responsibilities'] !!}</p>
      </div>
            <div class='row'>
        <h4 for="cemail">Budgeted Salary</h4>
         <p>{{ $data['salary'] }}</p>
      </div>
     <div class='row'>
        <h4 for="cemail">No of Positions</h4>
         <p>{{ $data['positions'] }}</p>
      </div>
     <p>Thank you</p>
      HR Manager Approved<br>
      Group CEO pending
    </form>
  </div>
</div>
</body>
</html>