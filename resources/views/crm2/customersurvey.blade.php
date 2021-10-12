
<style type="text/css">
body {
    background: #eee
}

#regForm {
    background-color: #ffffff;
    margin: 0px auto;
    font-family: Raleway;
    padding: 40px;
    border-radius: 10px
}

#register {
    color: #6A1B9A
}

h1 {
    text-align: center
}

input {
    padding: 10px;
    width: 100%;
    font-size: 17px;
    font-family: Raleway;
    border: 1px solid #aaaaaa;
    border-radius: 10px;
    -webkit-appearance: none
}

.tab input:focus {
    border: 1px solid #6a1b9a !important;
    outline: none
}

input.invalid {
    border: 1px solid #e03a0666
}

.tab {
    display: none
}

button {
    background-color: #6A1B9A;
    color: #ffffff;
    border: none;
    border-radius: 50%;
    padding: 10px 20px;
    font-size: 17px;
    font-family: Raleway;
    cursor: pointer
}

button:hover {
    opacity: 0.8
}

button:focus {
    outline: none !important
}

#prevBtn {
    background-color: #bbbbbb
}

.all-steps {
    text-align: center;
    margin-top: 30px;
    margin-bottom: 30px;
    width: 100%;
    display: inline-flex;
    justify-content: center
}

.step {
    height: 40px;
    width: 40px;
    margin: 0 2px;
    background-color: #bbbbbb;
    border: none;
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 15px;
    color: #6a1b9a;
    opacity: 0.5
}

.step.active {
    opacity: 1
}

.step.finish {
    color: #fff;
    background: #6a1b9a;
    opacity: 1
}

.all-steps {
    text-align: center;
    margin-top: 30px;
    margin-bottom: 30px
}

.thanks-message {
    display: none
}
</style>
 <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
 <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>




<div class="container mt-5">
    <div class="row d-flex justify-content-center align-items-center">
        <div class="col-md-8">
            <form id="regForm" action="" method="get">
                <h1 id="register">Survey Form</h1>
                <div class="all-steps" id="all-steps"> <span class="step"><i class="fa fa-user"></i></span> <span class="step"><i class="fa fa-map-marker"></i></span> <span class="step"><i class="fa fa-shopping-bag"></i></span> <span class="step"><i class="fa fa-car"></i></span> <span class="step"><i class="fa fa-spotify"></i></span> <span class="step"><i class="fa fa-mobile-phone"></i></span> </div>
                <div class="tab">
                @foreach($survey1 as $survey1)
                    <h6>{{$survey1->question}}</h6>
                    <p> <input placeholder="Name..." oninput="this.className = ''" name="quiz1"></p>
                    <p> <input type="hidden"  name="fname" value="{{$survey1->id}}"></p>
                    @endforeach
                   
                </div>
                <div class="tab">
                @foreach($survey2 as $survey2)
                    <h6>{{$survey2->question}}</h6>
                    <p> <input placeholder="Name..." oninput="this.className = ''" name="quiz2"></p>
                    <p> <input type="hidden"  name="fname" value="{{$survey2->id}}"></p>
                    @endforeach
                </div>
                <div class="tab">
                @foreach($survey3 as $survey3)
                    <h6>{{$survey3->question}}</h6>
                    <p> <input placeholder="Name..." oninput="this.className = ''" name="quiz3"></p>
                    <p> <input type="hidden"  name="fname" value="{{$survey3->id}}"></p>
                    @endforeach
                </div>
                <div class="tab">
                @foreach($survey4 as $survey4)
                    <h6>{{$survey4->question}}</h6>
                    <p> <input placeholder="Name..." oninput="this.className = ''" name="quiz4"></p>
                    <p> <input type="hidden"  name="fname" value="{{$survey4->id}}"></p>
                    @endforeach
                </div>
                <div class="tab">
                @foreach($survey5 as $survey5)
                    <h6>{{$survey5->question}}</h6>
                    <p> <input placeholder="Name..." oninput="this.className = ''" name="quiz5"></p>
                    <p> <input type="hidden"  name="fname" value="{{$survey5->id}}"></p>
                    @endforeach
                </div>
                <div class="tab">
                @foreach($survey6 as $survey6)
                    <h6>{{$survey6->question}}</h6>
                    <p> <input placeholder="Name..." oninput="this.className = ''" name="quiz6"></p>
                    <p> <input type="hidden"  name="fname" value="{{$survey6->id}}"></p>
                    @endforeach
                </div>
                <div class="thanks-message text-center" id="text-message"> <img src="https://i.imgur.com/O18mJ1K.png" width="100" class="mb-4">
                    <h3>Thankyou for your feedback!</h3> <span>Thanks for your valuable information. It helps us to improve our services!</span>
                </div>
                <div style="overflow:auto;" id="nextprevious">
                    <div style="float:right;"> <button type="button" id="prevBtn" onclick="nextPrev(-1)"><i class="fa fa-angle-double-left"></i></button> <button type="button" id="nextBtn" onclick="nextPrev(1)"><i class="fa fa-angle-double-right"></i></button> </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
var currentTab = 0;
document.addEventListener("DOMContentLoaded", function(event) {


showTab(currentTab);

});

function showTab(n) {
var x = document.getElementsByClassName("tab");
x[n].style.display = "block";
if (n == 0) {
document.getElementById("prevBtn").style.display = "none";
} else {
document.getElementById("prevBtn").style.display = "inline";
}
if (n == (x.length - 1)) {
document.getElementById("nextBtn").innerHTML = '<i class="fa fa-angle-double-right"></i>';
} else {
document.getElementById("nextBtn").innerHTML = '<i class="fa fa-angle-double-right"></i>';
}
fixStepIndicator(n)
}

function nextPrev(n) {
var x = document.getElementsByClassName("tab");
if (n == 1 && !validateForm()) return false;
x[currentTab].style.display = "none";
currentTab = currentTab + n;
if (currentTab >= x.length) {

document.getElementById("nextprevious").style.display = "none";
document.getElementById("all-steps").style.display = "none";
document.getElementById("register").style.display = "none";
document.getElementById("text-message").style.display = "block";




}
showTab(currentTab);
}

function validateForm() {
var x, y, i, valid = true;
x = document.getElementsByClassName("tab");
y = x[currentTab].getElementsByTagName("input");
for (i = 0; i < y.length; i++) { if (y[i].value=="" ) { y[i].className +=" invalid" ; valid=false; } } if (valid) { document.getElementsByClassName("step")[currentTab].className +=" finish" ; } return valid; } function fixStepIndicator(n) { var i, x=document.getElementsByClassName("step"); for (i=0; i < x.length; i++) { x[i].className=x[i].className.replace(" active", "" ); } x[n].className +=" active" ; }
</script>