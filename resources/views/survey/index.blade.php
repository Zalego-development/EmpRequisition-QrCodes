
@extends('layouts.employee')

@section('content')
  <link rel="stylesheet" type="text/css" href="{{asset('assets/css/mainlrs2.css')}}">
 <!-- Content Wrapper. Contains page content -->
 <style type="text/css">
   .notCard{
    color:#d6e0f5 !important;

  background: red; /* For browsers that do not support gradients */
  background: -webkit-linear-gradient(left,  #4775d1,#5c85d6,#7094db,#99b3e6); /* For Safari 5.1 to 6.0 */
  background: -o-linear-gradient(right,  #4775d1,#5c85d6,#7094db,#99b3e6); /* For Opera 11.1 to 12.0 */
  background: -moz-linear-gradient(right,  #4775d1,#5c85d6,#7094db,#99b3e6); /* For Firefox 3.6 to 15 */
  background: linear-gradient(to right,  #4775d1,#5c85d6,#7094db,#99b3e6); /* Standard syntax */
}

#taskTitle{
   font-size: 22px;
}

@media screen and (max-width: 480px) {
    #pImage {
        display: none;
    }
}

.btn-warning{
  background: 
}
#infoNo{
  font-size: 18px !important;
}
.alert{
border-color:transparent !important;
}
 .card-1,.card{
    transition: 0.5s linear;
    border-color: transparent !important; 
    /*box-shadow: none !important;*/

   }
   .card-1:hover{
    border-top: 2px solid rgba(250, 132, 82) !important;
    -webkit-box-shadow: 0 1rem 3rem rgba(250, 132, 82, 0.135) !important;
  box-shadow: 0 1rem 3rem rgba(250, 132, 82, 0.135) !important;
overflow-y:auto !important;
   }
.card:hover{
    -webkit-box-shadow: 0 1rem 3rem rgba(250, 132, 82, 0.135) !important;
  box-shadow: 0 1rem 3rem rgba(250, 132, 82, 0.135) !important;
   }
.card-1{
overflow:hidden !important;
}
.reviewCards{
padding:0 !important;
color:#fff !important;
}
#overlay {
  position: relative; /* Sit on top of the page content */
  width: 100%; /* Full width (cover the whole page) */
  height: 100%; /* Full height (cover the whole page) */
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: rgba(13, 17, 38,0.5); /* Black background with opacity */
  z-index: 2; /* Specify a stack order in case you're using a different order for other elements */
  cursor: pointer; /* Add a pointer on hover */
}
.modal-body{
padding:0 !important;
}
   
.label-input100 {
    font-family: inherit !important;
    font-size: 15px !important;
    color: inherit !important; 
  }

 </style>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1 class="m-0 text-muted ml-2 mt-4"><strong>New Survey</strong></h1>
            <ol class="breadcrumb float-sm-left ml-2">
              <li class="breadcrumb-item"><a href="{{url('/home')}}"><i class="fa fa-home"></i></a></li>
              <li class="breadcrumb-item active">New Survey</li>
            </ol>
             <div  class="float-right">
                            <a href="{{url('/newsurvey')}}"><button class="btn btn-warning">
                                <i class="fa fa-cog"></i> Refresh</button></a>
                        </div>
                       
          </div><!-- /.col -->
    
        </div><!-- /.row -->

      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <br>
  
  <form id="myForm" method="POST" action="{{url('/addSurvey')}}" enctype="multipart/form-data">
                @csrf
    <section class="content">
        <div class="container-fluid">
            <div class="card bg-wite px-3 py-3 shadow">
              <div class="card-header">
                <div class="row">
                  <span class="label-input100" style="font-size:16px !importantl;">About this survey</span>
                </div>
              </div>
             <div class="card-body bg-white">
                <div class="row">
                   <div class="wrap-input100 validate-input">
                        <span class="label-input100">Survey Name <i class="text-danger">*</i></span>
                        <input type="text" class="input100
                         @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" placeholder="Survey name">
                        <span class="focus-input100"></span>
                    </div>
                   <div class="wrap-input100 validate-input">
                        <span class="label-input100">Survey Description</span>
                        <input type="text" class="input100
                         @error('description') is-invalid @enderror" name="description" value="{{ old('description') }}" autocomplete="description" placeholder="Survey description">
                        <span class="focus-input100"></span>
                    </div>
                   <div class="col-6">
                     <div class="wrap-input100 validate-input">
                        <span class="label-input100">Survey Submission Deadline <i class="text-danger">*</i></span>
                        <input type="date" class="input100
                         @error('date') is-invalid @enderror" name="date" value="{{ old('date') }}" autocomplete="date" required style="line-height: 1 !important;">
                        <span class="focus-input100"></span>
                    </div>
                   </div>
                    <div class="col-6">
                     <div class="wrap-input100 validate-input">
                        <span class="label-input100">Company Name <i class="text-danger">*</i></span>
                        <input type="text" class="input100
                         @error('company') is-invalid @enderror" name="company" value="{{ old('company') ?? 'Atarah Solutions'}}" autocomplete="company" required placeholder="Company Name">
                        <span class="focus-input100"></span>
                    </div>
                   </div>
                  <!--  <div class="col-4">
                     <div class="wrap-input100 validate-input">
                        <span class="label-input100">Company Email </span>
                        <input type="email" class="input100
                         @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" placeholder="Company Email">
                        <span class="focus-input100"></span>
                    </div>
                   </div> -->
                </div>
              </div>
            </div>
              <div class="card bg-wite px-3 py-3 shadow-lg" id="initialCard1">
              <div class="card-header">
                <div class="row d-flex justify-content-between align-items-center">
                  <div>
                  <span class="label-input100" style="font-size:16px !importantl;">Question</span>
                  </div>
                  <div>
                     <button type="button" class="btn btn-primary shadow-sm addbtns" onclick="addQuestion(1,0);"  title="Add Survey Question" style="width: 30px; height: 30px; border-radius: 50%;" id="hideadd1"><i class="fas fa-plus fa-1x"></i></button>&nbsp;&nbsp;
            
                     <!-- <button type="button" class="btn btn-danger shadow-sm addbtns" onclick="removeQuestion(1);" title="Remove Survey Question"  style="width: 30px; height: 30px; border-radius: 50%;" id="removebtn1"><i class="fas fa-minus fa-1x"></i></button> -->
                  </div>
       
                </div>
              </div>
             <div class="card-body bg-white">
                <div class="row">
                   <div class="col-md-8">
                    <div class="wrap-input100 validate-input">
                        <span class="label-input100">Question <i class="text-danger">*</i></span>
                        <input type="question" class="input100
                         @error('question') is-invalid @enderror" id="select" name="question[0]" value="{{ old('question') }}" required autocomplete="question" placeholder="Survey question">
                        <span class="focus-input100"></span>
                    </div>
                   </div>
                   <div class="col-md-4">
                     <div class="form-group">
                      <label>Reply mode <i class="fas fa-question-circle text-primary" onclick="openModal(1)" style="cursor: pointer;"></i></label>
                    <div class="card bg-light shadow-lg" id="Feed1" style="display:none; position: absolute; left:11%; margin-top: -20px; z-index: 9999;">
                      <div class="card-body text-muted">
                        <i onclick="closemodal(1)" class=" fas fa-window-close float-right" style="cursor:pointer"></i>
                        <strong>Reply mode</strong><br>
                        This option gives you freedom to select the mode of feedback for each question
                      </div>
                      </div>
                      <select name="replyMode[0]" id="replyMode1" class="form-control" onclick="changeReply(1)" required style="height: calc(3.25rem + 8px) !important;border: 2px solid #ced4da !important;">
                        <option value="1" selected> Written feedback</option>
                        <option value="2"> Dropdown list</option>
                        <option value="3"> Radio buttons</option>
                        <option value="7"> Checkboxes</option>
                        <option value="4"> Star rating</option>
                        <option value="5"> Scale rating</option>
                        <option value="6"> Date</option>
                      </select>
                    </div>
                   </div>
                  <div class="col-12">
                   <div id="replFeedback0">
                    <span class="text-muted ml-3" id="option1"> This question will have a written feedback</span>

                    <div id="anotheroption1" style="display:none;"><div class="row"><div class="col-10"><div class="wrap-input100 validate-input">
                      <input type="text" class="input100" name="reply0[]"  autocomplete="reply" placeholder="Option">
                      <span class="focus-input100"></span></div></div><div class="col-2">
                      <i class="fa fa-plus-circle fa-2x mt-3 text-muted" id="removecontrol1" style="cursor:pointer" onclick="addoption(1,0)"></i></div></div></div>

                       <div id="radiooption1" style="display:none;"><div class="row"><div class="col-1"><input type="radio" style="margin-top: 20px; margin-left: 15px;" disabled></div><div class="col-9"><div class="wrap-input100 validate-input">
                     <input type="text" class="input100" name="radioReply0[]"  autocomplete="reply" placeholder="Option">
                      <span class="focus-input100"></span></div></div><div class="col-2">
                      <i class="fa fa-plus-circle fa-2x mt-3 text-muted" id="removeradiocontrol1" style="cursor:pointer" onclick="addradiooption(1,0)"></i></div></div></div>

                      <div id="checkoption1" style="display:none;"><div class="row"><div class="col-1"><input type="checkbox" style="margin-top: 20px; margin-left: 15px;" disabled></div><div class="col-9"><div class="wrap-input100 validate-input">
                     <input type="text" class="input100" name="checkReply0[]"  autocomplete="reply" placeholder="Option">
                      <span class="focus-input100"></span></div></div><div class="col-2">
                      <i class="fa fa-plus-circle fa-2x mt-3 text-muted" id="removecheckcontrol1" style="cursor:pointer" onclick="addcheckoption(1,0)"></i></div></div></div>

                      <span class="text-muted ml-3" id="stars1" style="display:none"> This question will have a star rating feedback</span>

                      <div  id="scale1" style="display:none;"><div class="row">
                       <div class="col-sm-4">
                        <div class="form-group">
                          <label>Marks for this scale</span></label>
                          <div class="wrap-input100 validate-input">
                          <input type="text" class="input100" name="marks[0]" id="phn"  autocomplete="marks" placeholder="Marks">
                          <span class="focus-input100"></span></div>
                         </div>
                        </div>
                       </div>
                     </div>

                     <span class="text-muted ml-3" id="dateReply1" style="display:none"> This question will have a date feedback</span>

                    </div>
                  </div>
                </div>
              </div>

            </div>
              
              <span id="questionHolder"></span>
              <button class="btn bnt-lg btn-success float-left" type="submit" onclick="return confirm('You are about to save this survey, continue?');"><i class="fa fa-paper-plane"></i> Save survey</button>
              <br><br>
        </div>

        <br>
    </section>
            </form>
     

<script type="text/javascript">
function changeReply(id){
   event.preventDefault();
      var randNo=id+1;
var path=document.getElementById('replyMode'+id).value;
if (path==1) {
  $("#option"+id).fadeIn();
  $("#anotheroption"+id).hide();
  $("#radiooption"+id).hide();
  $("#checkoption"+id).hide();
  $("#stars"+id).hide();
$("#scale"+id).hide();
$("#dateReply"+id).hide();
}
else if(path==2){
$("#anotheroption"+id).fadeIn();
$("#option"+id).hide();
$("#radiooption"+id).hide();
$("#stars"+id).hide();
$("#checkoption"+id).hide();
$("#scale"+id).hide();
$("#dateReply"+id).hide();
}
else if(path==3)
{
  $("#radiooption"+id).fadeIn();
  $("#anotheroption"+id).hide();
$("#option"+id).hide();
$("#checkoption"+id).hide();
$("#stars"+id).hide();
$("#scale"+id).hide();
$("#dateReply"+id).hide();
}
else if(path==4){
  $("#stars"+id).fadeIn();
  $("#radiooption"+id).hide();
  $("#anotheroption"+id).hide();
$("#option"+id).hide();
$("#checkoption"+id).hide();
$("#scale"+id).hide();
$("#dateReply"+id).hide();
}
else if(path==5){
  $("#scale"+id).fadeIn();
  $("#radiooption"+id).hide();
  $("#anotheroption"+id).hide();
$("#option"+id).hide();
$("#checkoption"+id).hide();
$("#stars"+id).hide();
$("#dateReply"+id).hide();
}
else if(path==6){
  $("#dateReply"+id).fadeIn();
  $("#scale"+id).hide();
  $("#checkoption"+id).hide();
  $("#radiooption"+id).hide();
  $("#anotheroption"+id).hide();
$("#option"+id).hide();
$("#stars"+id).hide();
}
else if(path==7){
  $("#dateReply"+id).hide();
  $("#scale"+id).hide();
  $("#checkoption"+id).fadeIn();
  $("#radiooption"+id).hide();
  $("#anotheroption"+id).hide();
$("#option"+id).hide();
$("#stars"+id).hide();
}
}

function addQuestion(id,arrayId){
    event.preventDefault();
      var randNo=Math.random();
      var nameid=arrayId+1;
      randNo=(Math.round((randNo + Number.EPSILON) * 100) / 100)*1000;
      $("#questionHolder").append('<div class="card bg-wite px-3 py-3 shadow-lg" id="initialCard'+randNo+'"><div class="card-header"><div class="row d-flex justify-content-between align-items-center"><div><span class="label-input100" style="font-size:16px !importantl;">Question</span></div><div><button type="button" class="btn btn-primary shadow-sm addbtns" onclick="addQuestion('+randNo+','+nameid+');"  title="Add Survey Question" style="width: 30px; height: 30px; border-radius: 50%;" id="hideadd'+randNo+'" ><i class="fas fa-plus fa-1x"></i></button>&nbsp;&nbsp;<button type="button" class="btn btn-danger shadow-sm addbtns" id="removebtn'+randNo+'" onclick="removeQuestion('+randNo+');" title="Remove Survey Question"  style="width: 30px; height: 30px; border-radius: 50%;"><i class="fas fa-minus fa-1x"></i></button></div></div></div><div class="card-body bg-white"><div class="row"><div class="col-md-8"><div class="wrap-input100 validate-input"><span class="label-input100">Question</span><input type="question" class="input100" id="select" name="question['+nameid+']" required autocomplete="question" placeholder="Survey question"><span class="focus-input100"></span></div></div><div class="col-md-4"><div class="form-group"><label>Reply mode <i class="fas fa-question-circle text-primary" onclick="openModal('+randNo+')" style="cursor: pointer;"></i></label><div class="card bg-light shadow-lg" id="Feed'+randNo+'" style="display:none; position: absolute; left:11%; margin-top: -20px; z-index: 9999;"><div class="card-body text-muted"><i onclick="closemodal('+randNo+')" style="cursor:pointer" class=" fas fa-window-close float-right"></i><br><strong>Reply mode</strong><br>This option gives you freedom to select the mode of feedback for each question</div></div><select name="replyMode['+nameid+']" id="replyMode'+randNo+'" class="form-control" onclick="changeReply('+randNo+')" required style="height: calc(3.25rem + 8px) !important;border: 2px solid #ced4da !important;"><option value="1" selected> Written feedback</option><option value="2"> Dropdown list</option><option value="3"> Radio buttons</option><option value="7"> Checkboxes</option><option value="4"> Star rating</option><option value="5"> Scale rating</option><option value="6"> Date</option></select></div></div><div class="col-12"><div id="replFeedback'+randNo+'"><span class="text-muted ml-3" id="option'+randNo+'"> This question will have a written feedback</span><div id="anotheroption'+randNo+'" style="display:none;"><div class="row"><div class="col-10"><div class="wrap-input100 validate-input"><input type="text" class="input100" name="reply'+nameid+'[]"  autocomplete="reply" placeholder="Option"><span class="focus-input100"></span></div></div><div class="col-2"><i class="fa fa-plus-circle fa-2x mt-3 text-muted" id="removecontrol'+randNo+'" style="cursor:pointer" onclick="addoption('+randNo+','+nameid+')"></i></div></div></div><div id="radiooption'+randNo+'" style="display:none;"><div class="row"><div class="col-1"><input type="radio" style="margin-top: 20px; margin-left: 15px;" disabled></div><div class="col-9"><div class="wrap-input100 validate-input"><input type="text" class="input100" name="radioReply'+nameid+'[]"  autocomplete="reply" placeholder="Option"><span class="focus-input100"></span></div></div><div class="col-2"><i class="fa fa-plus-circle fa-2x mt-3 text-muted" id="removeradiocontrol'+randNo+'" style="cursor:pointer" onclick="addradiooption('+randNo+','+nameid+')"></i></div></div></div><div id="checkoption'+randNo+'" style="display:none;"><div class="row"><div class="col-1"><input type="checkbox" style="margin-top: 20px; margin-left: 15px;" disabled></div><div class="col-9"><div class="wrap-input100 validate-input"><input type="text" class="input100" name="checkReply'+nameid+'[]"  autocomplete="reply" placeholder="Option"><span class="focus-input100"></span></div></div><div class="col-2"><i class="fa fa-plus-circle fa-2x mt-3 text-muted" id="removecheckcontrol'+randNo+'" style="cursor:pointer" onclick="addcheckoption('+randNo+','+nameid+')"></i></div></div></div><span class="text-muted ml-3" id="stars'+randNo+'" style="display:none"> This question will have a star rating feedback</span><div  id="scale'+randNo+'" style="display:none;"><div class="row"><div class="col-sm-4"><div class="form-group"><label>Marks for this scale</span></label><div class="wrap-input100 validate-input"><input type="text" class="input100" name="marks['+nameid+']" id="phn"  autocomplete="marks" placeholder="Marks"><span class="focus-input100"></span></div></div></div></div></div><span class="text-muted ml-3" id="dateReply'+randNo+'" style="display:none"> This question will have a date feedback</span></div></div></div></div>');
      $("#hideadd"+id).hide();
}
function closemodal(id){
  $("#Feed"+id).fadeOut();
}
function openModal(id){
  $("#Feed"+id).slideToggle();
}

function removeQuestion(id){
event.preventDefault();
var idx = $('.card :last').attr('id').replace(/dateReply/, '');
$('#initialCard'+id).remove();
if (id==idx) {
  var newidx = $('.card :last').attr('id').replace(/dateReply/, '');
$('#hideadd'+newidx).show();
}
 

}

// function addQuestion(id){
  // alert('kjhg');
   // event.preventDefault();
      // var randNo=id+1;
      // $("#initialCard").clone().appendTo("#questionHolder");
    //get length of selections
      // var length = $(".card-body").length,
      // //create new id
      // var newId = "selection-" + length++,
      // var clone = $("#initialCard"+id).clone();
      // clone.attr("id", newId);
      // clone.find("#select").attr("id","select-"+length);
      // //append clone on the end
      // $("#card-body").append(clone); 
// }

function addoption(id,arrayId){
  event.preventDefault();
      var randNo=id+1;
  $('#anotheroption'+id).append('<div id="anotheroption'+randNo+'"><div class="row rowe'+randNo+'"><div class="col-10"><div class="wrap-input100 validate-input"><input type="text" class="input100" name="reply'+arrayId+'[]"  autocomplete="reply" placeholder="Option"><span class="focus-input100"></span></div></div><div class="col-2" id="removecontrol'+randNo+'"><i class="fa fa-minus-circle fa-2x text-muted" style="cursor:pointer" onclick="removeoption('+randNo+')"></i> &nbsp&nbsp&nbsp<i class="fa fa-plus-circle fa-2x mt-3 text-muted" style="cursor:pointer" onclick="addoption('+randNo+','+arrayId+')"></i></div></div></div>');
  $('#removecontrol'+id).hide();
}
function removeoption(id){
event.preventDefault();
var idtoshow=id-1;
$('#removecontrol'+idtoshow).fadeIn();
$('#anotheroption'+id).remove(); 
}


function addradiooption(id,arrayId){
  event.preventDefault();
      var randNo=id+1;
  $('#radiooption'+id).append('<div id="radiooption'+randNo+'"><div class="row rowradio'+randNo+'"><div class="col-1"><input type="radio" style="margin-top: 20px; margin-left: 15px;" disabled></div><div class="col-9"><div class="wrap-input100 validate-input"><input type="text" class="input100" name="radioReply'+arrayId+'[]"  autocomplete="reply" placeholder="Option"><span class="focus-input100"></span></div></div><div class="col-2" id="removeradiocontrol'+randNo+'"><i class="fa fa-minus-circle fa-2x text-muted" style="cursor:pointer" onclick="removeradiooption('+randNo+')"></i> &nbsp&nbsp&nbsp<i class="fa fa-plus-circle fa-2x mt-3 text-muted" id="removeradiocontrol'+randNo+'" style="cursor:pointer" onclick="addradiooption('+randNo+','+arrayId+')"></i></div></div></div>');
   $('#removeradiocontrol'+id).hide();
 }
function removeradiooption(id){
event.preventDefault();
var idtoshow=id-1;
$('#removeradiocontrol'+idtoshow).fadeIn();
$('#radiooption'+id).remove(); 
}
function addcheckoption(id,arrayId){
  event.preventDefault();
      var randNo=id+1;
  $('#checkoption'+id).append('<div id="checkoption'+randNo+'"><div class="row rowcheck'+randNo+'"><div class="col-1"><input type="checkbox" style="margin-top: 20px; margin-left: 15px;" disabled></div><div class="col-9"><div class="wrap-input100 validate-input"><input type="text" class="input100" name="checkReply'+arrayId+'[]"  autocomplete="reply" placeholder="Option"><span class="focus-input100"></span></div></div><div class="col-2" id="removecheckcontrol'+randNo+'"><i class="fa fa-minus-circle fa-2x text-muted" style="cursor:pointer" onclick="removecheckoption('+randNo+')"></i> &nbsp&nbsp&nbsp<i class="fa fa-plus-circle fa-2x mt-3 text-muted" id="removecheckcontrol'+randNo+'" style="cursor:pointer" onclick="addcheckoption('+randNo+','+arrayId+')"></i></div></div></div>');
   $('#removecheckcontrol'+id).hide();
 }
function removecheckoption(id){
event.preventDefault();
var idtoshow=id-1;
$('#removecheckcontrol'+idtoshow).fadeIn();
$('#checkoption'+id).remove(); 
}

  $("#phn").keypress(function (e) {
       if (String.fromCharCode(e.keyCode).match(/[^0-9]/g)) return false;
   });

</script>


</div>

@endsection

