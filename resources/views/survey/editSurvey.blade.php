@extends('layouts.admin')

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
    /*font-size: 15px !important;*/
    /*color: inherit !important; */
  }

 </style>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1 class="m-0 text-muted ml-2 mt-4"><strong>Edit Survey</strong></h1>
            <ol class="breadcrumb float-sm-left ml-2">
              <li class="breadcrumb-item"><a href="{{url('/home')}}"><i class="fa fa-home"></i></a></li>
              <li class="breadcrumb-item active">Edit Survey</li>
            </ol>
             <div  class="float-right">

              <a href="#" onclick="history.back()"><button class="btn btn-sucess">
              <i class="fa fa-arrow-left"></i> Back</button></a>
            @if(!is_null($survey))
                <a href="{{url('/editSurvey/'.$survey->id)}}"><button class="btn btn-warning">
               <i class="fa fa-cog"></i> Refresh</button></a>
            @endif
        </div>
                       
          </div><!-- /.col -->
    
        </div><!-- /.row -->

      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <br>
  
    <section class="content">
        <div class="container-fluid">
          <form id="myForm" method="POST" action="{{url('/updateSurvey')}}" enctype="multipart/form-data">
                @csrf
            @if(!is_null($survey))
            <div class="card bg-wite px-3 py-3 shadow">
              <div class="card-header">
                <div class="row d-flex justify-content-between align-items-center">
                  <div>
                  <span class="label-input100" style="font-size:16px !important;">About this survey</span>
                </div>
                  <div>
                    <button class="btn btn-sm btn-warning" id="addBtn" type="button" onclick="$('#editView').hide();$('#editView1').hide(); $('#addBtn').hide(); $('#editBtn').fadeIn(); $('#addView').fadeIn();"><i class="fas fa-plus-circle"></i> Add New Questions To This Survey</button>
                    <button class="btn btn-sm btn-warning" id="editBtn" type="button" style="display: none;" onclick="$('#editView').fadeIn(); $('#editView1').fadeIn(); $('#addBtn').fadeIn(); $('#editBtn').hide(); $('#addView').hide();"><i class="fas fa-pencil-alt"></i> Continue Editing</button>
                    <br>
                 
                  <!-- <button class="">click here to copy</button> -->
                  <!-- <a href="https://www.facebook.com/sharer/sharer.php?u=https://hrm.zalegoinstitute.ac.ke/zalegoemp/public/trainingSurvey&display=popup" target="_blank"> share this </a> -->

                  </div>
                </div>
              </div>
             <div class="card-body bg-white" id="editView">
                <div class="row">
                    <input type="hidden" name="SurveyId" value="{{$survey->id}}">
                       <div class="wrap-input100 validate-input">
                        <span class="label-input100">Survey Name <i class="text-danger">*</i></span>
                        <input type="text" class="input100
                         @error('name') is-invalid @enderror" name="name" value="{{ $survey->survey_name ?? old('name') }}" required autocomplete="name" placeholder="Survey name">
                        <span class="focus-input100"></span>
                    </div>
                   <div class="wrap-input100 validate-input">
                        <span class="label-input100">Survey Description</span>
                        <input type="text" class="input100
                         @error('description') is-invalid @enderror" name="description" value="{{ $survey->survey_description ?? old('description') }}" autocomplete="description" placeholder="Survey description">
                        <span class="focus-input100"></span>
                    </div>
                   <div class="col-6">
                     <div class="wrap-input100 validate-input">
                        <span class="label-input100">Survey Submission Deadline <i class="text-danger">*</i></span>
                        <input type="date" class="input100
                         @error('date') is-invalid @enderror" name="date" value="{{ $survey->deadline ?? old('date') }}" autocomplete="date" required style="line-height: 1 !important;">
                        <span class="focus-input100"></span>
                    </div>
                   </div>
                    <div class="col-6">
                     <div class="wrap-input100 validate-input">
                        <span class="label-input100">Company Name <i class="text-danger">*</i></span>
                        <input type="text" class="input100
                         @error('company') is-invalid @enderror" name="company" value="{{ $survey->company ?? old('company') }}" autocomplete="company" required placeholder="Company Name">
                        <span class="focus-input100"></span>
                    </div>
                   </div>
                    <!-- <div class="col-4">
                     <div class="wrap-input100 validate-input">
                        <span class="label-input100">Company Email </span>
                        <input type="email" class="input100
                         @error('email') is-invalid @enderror" name="email" value="{{ $survey->email ?? old('email') }}" autocomplete="email" placeholder="Company Email">
                        <span class="focus-input100"></span>
                    </div>
                   </div> -->
                </div>
              </div>
            </div>
            <div id="editView1">
            <?php $count=1;
              $arrCheck=[];
             ?>
            @foreach($answers as $ans)
            <?php array_push($arrCheck, $ans->question_id); ?>
            @endforeach
            <?php $newArr=array_filter($arrCheck); ?>

              @foreach($questions as $question)
            <input type="hidden" name="question_id[{{$question->id}}]" value="{{$question->id}}">
              <div class="card bg-wite px-3 py-3 shadow-lg" id="editinitialCard1">
              <div class="card-header">
                <div class="row d-flex justify-content-between align-items-center">
                  <div>
                  <span class="label-input100" style="font-size:16px !importantl;">Question {{$count++}}</span>
                  </div>
                  <div>
                     <!-- <button type="button" class="btn btn-primary shadow-sm addbtns" onclick="addQuestion(1,0);"  title="Add Survey Question" style="width: 30px; height: 30px; border-radius: 50%;" id="hideadd1"><i class="fas fa-plus fa-1x"></i></button>&nbsp;&nbsp; -->
            
                     <a onclick="return(confirm('You are about to delete this question. Do you want to proceed?'))" href="{{url('/deleteQuestion/'.$question->id)}}">
                      <button type="button" class="btn btn-danger shadow-sm addbtns" title="Remove Survey Question"  style="width: 30px; height: 30px; border-radius: 50%;" id="editremovebtn1"><i class="fas fa-minus fa-1x"></i></button></a>
                  </div>
       
                </div>
              </div>
             <div class="card-body bg-white">
                <div class="row">
                   <div class="col-md-8">
                    <div class="wrap-input100 validate-input">
                        <span class="label-input100">Question</span>
                        <input type="text" class="input100
                         @error('question') is-invalid @enderror" id="question" name="question[{{$question->id}}]" value="{{ $question->question ?? old('question') }}" required autocomplete="question" placeholder="Survey question">
                        <span class="focus-input100"></span>
                    </div>
                   </div>
                   <div class="col-md-4">
                     <div class="form-group">
                      <label>Reply mode <i class="fas fa-question-circle text-primary" onclick="editopenModal({{$count}})" style="cursor: pointer;"></i>
                        (Current : <span class="text-info">
                         @if($question->reply_mode==1) Written feedback @endif
                         @if($question->reply_mode==2) Dropdown list @endif
                         @if($question->reply_mode==3) Radio buttons @endif
                         @if($question->reply_mode==7) Checkboxes @endif
                         @if($question->reply_mode==4) Star rating @endif
                         @if($question->reply_mode==5) Scale rating @endif
                         @if($question->reply_mode==6) Date @endif
                      </span>)
                      </label>
                    <div class="card bg-light shadow-lg" id="editFeed{{$count}}" style="display:none; position: absolute; left:11%; margin-top: -20px; z-index: 9999;">
                      <div class="card-body text-muted">
                        <i onclick="editclosemodal({{$count}})" class=" fas fa-window-close float-right" style="cursor:pointer"></i>
                        <strong>Reply mode</strong><br>
                        This option gives you freedom to select the mode of feedback for each question
                      </div>
                      </div>
                      <select name="replyMode[{{$question->id}}]" id="editreplyMode{{$question->id}}" class="form-control" onclick="editchangeReply({{$question->id}})" required style="height: calc(3.25rem + 8px) !important;border: 2px solid #ced4da !important;">
                        
                        <option value="1" @if($question->reply_mode==1) selected @endif> Written feedback</option>
                        <option value="2" @if($question->reply_mode==2) selected @endif> Dropdown list</option>
                        <option value="3" @if($question->reply_mode==3) selected @endif> Radio buttons</option>
                        <option value="7" @if($question->reply_mode==7) selected @endif> Checkboxes</option>
                        <option value="4" @if($question->reply_mode==4) selected @endif> Star rating</option>
                        <option value="5" @if($question->reply_mode==5) selected @endif> Scale rating</option>
                        <option value="6" @if($question->reply_mode==6) selected @endif> Date</option>
                      </select>
                    </div>
                   </div>
                  <div class="col-12">
                   <div id="replFeedback0">
                    
                    <span class="text-muted ml-3" id="eoption{{$question->id}}" @if($question->reply_mode!=1) style="display:none;" @endif> This question will have a written feedback</span>
                  <?php $c1=0; ?>
                  <div id="eanotheroptionx{{$question->id}}" @if($question->reply_mode!=2) style="display:none;" @endif>
                    @foreach($answers as $ans)
                    @if($question->id==$ans->question_id)
                    <div id="eanotheroption{{$ans->id}}" >
                    <div class="row erowe{{$ans->id}}"><div class="col-10"><div class="wrap-input100 validate-input">
                      <input type="text" class="input100" name="ereply{{$question->id}}[{{$ans->id}}]" value="{{$ans->answer}}" autocomplete="reply" placeholder="Option">
                      <span class="focus-input100"></span></div></div><div class="col-2" id="eremovecontrol{{$ans->id}}">
                      <a href="{{url('/deleteOption/'.$ans->id)}}" onclick="return confirm('You are about to delete this option, Do you wish to proceed?')">
                        <i class="fa fa-minus-circle fa-lg text-muted" style="cursor:pointer"></i> </a>&nbsp&nbsp&nbsp
                      <i class="fa fa-plus-circle fa-lg mt-3 text-muted" style="cursor:pointer" onclick="eaddoption({{$ans->id}},{{$question->id}})"></i></div></div>
                      </div>
                      <?php $c1++; ?>
                      @endif
                      @endforeach
                      @if($c1==0)
                      <div id="anotheroption{{$question->id}}"><div class="row"><div class="col-10"><div class="wrap-input100 validate-input">
                      <input type="text" class="input100" name="reply{{$question->id}}[]"  autocomplete="reply" placeholder="Option">
                      <span class="focus-input100"></span></div></div><div class="col-2">
                      <i class="fa fa-plus-circle fa-lg mt-3 text-muted" id="removecontrol1" style="cursor:pointer" onclick="addoption({{$question->id}},0)"></i></div></div></div>

                      @endif
                      </div>
                      
                      <?php $c2=0; ?>
                      <div id="eradiooptionx{{$question->id}}" @if($question->reply_mode!=3) style="display:none;" @endif>
                       @foreach($answers as $ans)
                    @if($question->id==$ans->question_id)
                    <div id="eradiooption{{$ans->id}}" >
                    <div class="row erowradio{{$ans->id}}"><div class="col-1"><input type="radio" style="margin-top: 20px; margin-left: 15px;" disabled></div>
                      <div class="col-9"><div class="wrap-input100 validate-input"><input type="text" class="input100" value="{{$ans->answer}}" name="eradioReply{{$question->id}}[{{$ans->id}}]"  autocomplete="reply" placeholder="Option">
                        <span class="focus-input100"></span></div></div><div class="col-2" id="eremoveradiocontrol{{$ans->id}}">
                        <a href="{{url('/deleteOption/'.$ans->id)}}" onclick="return confirm('You are about to delete this option, Do you wish to proceed?')">
                          <i class="fa fa-minus-circle fa-lg text-muted" style="cursor:pointer" ></i></a> &nbsp&nbsp&nbsp
                      <i class="fa fa-plus-circle fa-lg mt-3 text-muted" id="eremoveradiocontrol{{$ans->id}}" style="cursor:pointer" onclick="eaddradiooption({{$ans->id}},{{$question->id}})"></i></div></div>
                      </div>
                      <?php $c2++; ?>
                      @endif
                      @endforeach
                      @if($c1==0)
                      <div id="radiooption{{$question->id}}" ><div class="row"><div class="col-1"><input type="radio" style="margin-top: 20px; margin-left: 15px;" disabled></div><div class="col-9"><div class="wrap-input100 validate-input">
                     <input type="text" class="input100" name="radioReply{{$question->id}}[]"  autocomplete="reply" placeholder="Option">
                      <span class="focus-input100"></span></div></div><div class="col-2">
                      <i class="fa fa-plus-circle fa-lg mt-3 text-muted" id="removeradiocontrol1" style="cursor:pointer" onclick="addradiooption({{$question->id}},0)"></i></div></div></div>

                      @endif
                    </div>
                      
                      <?php $c3=0; ?>
                      <div id="echeckoptionx{{$question->id}}"  @if($question->reply_mode!=7) style="display:none;" @endif>
                       @foreach($answers as $ans)
                    @if($question->id==$ans->question_id)
                    <div id="echeckoption{{$ans->id}}">
                    <div class="row erowcheck{{$ans->id}}"><div class="col-1"><input type="checkbox" style="margin-top: 20px; margin-left: 15px;" disabled></div>
                      <div class="col-9"><div class="wrap-input100 validate-input"><input type="text" class="input100" value="{{$ans->answer}}" name="echeckReply{{$question->id}}[{{$ans->id}}]"  autocomplete="reply" placeholder="Option">
                        <span class="focus-input100"></span></div></div><div class="col-2" id="eremovecheckcontrol{{$ans->id}}">
                        <a href="{{url('/deleteOption/'.$ans->id)}}" onclick="return confirm('You are about to delete this option, Do you wish to proceed?')">
                          <i class="fa fa-minus-circle fa-lg text-muted" style="cursor:pointer" onclick="eremovecheckoption({{$ans->id}})"></i> </a>
                          &nbsp&nbsp&nbsp<i class="fa fa-plus-circle fa-lg mt-3 text-muted" id="eremovecheckcontrol{{$ans->id}}" style="cursor:pointer" onclick="eaddcheckoption({{$ans->id}},{{$question->id}})"></i></div></div>
                      </div>
                      <?php $c3++; ?>
                      @endif
                      @endforeach
                      @if($c3==0)
                       <div id="checkoption{{$question->id}}"><div class="row"><div class="col-1"><input type="checkbox" style="margin-top: 20px; margin-left: 15px;" disabled></div><div class="col-9"><div class="wrap-input100 validate-input">
                     <input type="text" class="input100" name="checkReply{{$question->id}}[]"  autocomplete="reply" placeholder="Option">
                      <span class="focus-input100"></span></div></div><div class="col-2">
                      <i class="fa fa-plus-circle fa-lg mt-3 text-muted" id="removecheckcontrol1" style="cursor:pointer" onclick="addcheckoption({{$question->id}},0)"></i></div></div></div>

                      @endif
                    </div>

                      <span class="text-muted ml-3" id="estars{{$question->id}}" @if($question->reply_mode!=4) style="display:none;" @endif> This question will have a star rating feedback</span>
                      
                      <?php $c4=0; ?>
                      <div  id="escale{{$question->id}}" @if($question->reply_mode!=5) style="display:none;" @endif>
                       @foreach($marks as $mark)
                    @if($question->id==$mark->question_id)
                      <div class="row">
                       <div class="col-sm-4">
                        <div class="form-group">
                          <label>Marks for this scale</span></label>
                          <div class="wrap-input100 validate-input">
                          <input type="text" class="input100" value="{{$mark->marks ?? 0}}" name="emarks{{$question->id}}[{{$mark->id}}]" id="phn" >
                          <span class="focus-input100"></span></div>
                         </div>
                        </div>
                       </div>
                     <?php $c4++; ?>
                      @endif
                      @endforeach
                      @if($c4==0)
                      <div class="row">
                       <div class="col-sm-4">
                        <div class="form-group">
                          <label>Marks for this scale</span></label>
                          <div class="wrap-input100 validate-input">
                          <input type="text" class="input100" name="marks[{{$question->id}}]" id="phn" value="0" autocomplete="marks" placeholder="Marks">
                          <span class="focus-input100"></span></div>
                         </div>
                        </div>
                       </div>
                      @endif
                     </div>

                     <span class="text-muted ml-3" id="edateReply{{$question->id}}" @if($question->reply_mode!=6) style="display:none;" @endif> This question will have a date feedback</span>
                     

                    </div>
                  </div>
                </div>
              </div>

            </div>
              @endforeach
              <span id="questionHolder"></span>
              <button class="btn bnt-lg btn-success float-left" type="submit" onclick="return confirm('You are about to update this survey, continue?');"><i class="fa fa-paper-plane"></i> Update survey</button>
              <br><br>           
            </form>
              </div>
            @endif

            <div id="addView" style="display:none;">
              <form id="nmyForm" method="POST" action="{{url('/addSurveyQuestion')}}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="SurveyId" value="{{$survey->id}}">
              <div class="card bg-wite px-3 py-3 shadow-lg" id="initialCard1">
              <div class="card-header">
                <div class="row d-flex justify-content-between align-items-center">
                  <div>
                  <span class="label-input100" style="font-size:16px !importantl;">Question</span>
                  </div>
                  <div>
                     <button type="button" class="btn btn-primary shadow-sm addbtns" onclick="naddQuestion(1,0);"  title="Add Survey Question" style="width: 30px; height: 30px; border-radius: 50%;" id="nhideadd1"><i class="fas fa-plus fa-1x"></i></button>&nbsp;&nbsp;
            
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
                      <label>Reply mode <i class="fas fa-question-circle text-primary" onclick="nopenModal(1)" style="cursor: pointer;"></i></label>
                    <div class="card bg-light shadow-lg" id="nFeed1" style="display:none; position: absolute; left:11%; margin-top: -20px; z-index: 9999;">
                      <div class="card-body text-muted">
                        <i onclick="nclosemodal(1)" class=" fas fa-window-close float-right" style="cursor:pointer"></i>
                        <strong>Reply mode</strong><br>
                        This option gives you freedom to select the mode of feedback for each question
                      </div>
                      </div>
                      <select name="replyMode[0]" id="nreplyMode1" class="form-control" onclick="nchangeReply(1)" required style="height: calc(3.25rem + 8px) !important;border: 2px solid #ced4da !important;">
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
                   <div id="nreplFeedback0">
                    <span class="text-muted ml-3" id="noption1"> This question will have a written feedback</span>

                    <div id="nanotheroption1" style="display:none;"><div class="row"><div class="col-10"><div class="wrap-input100 validate-input">
                      <input type="text" class="input100" name="reply0[]"  autocomplete="reply" placeholder="Option">
                      <span class="focus-input100"></span></div></div><div class="col-2">
                      <i class="fa fa-plus-circle fa-2x mt-3 text-muted" id="nremovecontrol1" style="cursor:pointer" onclick="naddoption(1,0)"></i></div></div></div>

                       <div id="nradiooption1" style="display:none;"><div class="row"><div class="col-1"><input type="radio" style="margin-top: 20px; margin-left: 15px;" disabled></div><div class="col-9"><div class="wrap-input100 validate-input">
                     <input type="text" class="input100" name="radioReply0[]"  autocomplete="reply" placeholder="Option">
                      <span class="focus-input100"></span></div></div><div class="col-2">
                      <i class="fa fa-plus-circle fa-2x mt-3 text-muted" id="nremoveradiocontrol1" style="cursor:pointer" onclick="naddradiooption(1,0)"></i></div></div></div>

                      <div id="ncheckoption1" style="display:none;"><div class="row"><div class="col-1"><input type="checkbox" style="margin-top: 20px; margin-left: 15px;" disabled></div><div class="col-9"><div class="wrap-input100 validate-input">
                     <input type="text" class="input100" name="checkReply0[]"  autocomplete="reply" placeholder="Option">
                      <span class="focus-input100"></span></div></div><div class="col-2">
                      <i class="fa fa-plus-circle fa-2x mt-3 text-muted" id="nremovecheckcontrol1" style="cursor:pointer" onclick="naddcheckoption(1,0)"></i></div></div></div>

                      <span class="text-muted ml-3" id="nstars1" style="display:none"> This question will have a star rating feedback</span>

                      <div  id="nscale1" style="display:none;"><div class="row">
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

                     <span class="text-muted ml-3" id="ndateReply1" style="display:none"> This question will have a date feedback</span>

                    </div>
                  </div>
                </div>
              </div>

            </div>
              
              <span id="nquestionHolder"></span>
              <button class="btn bnt-lg btn-success float-left" type="submit" onclick="return confirm('You are about to save this survey, continue?');"><i class="fa fa-paper-plane"></i> Save survey</button>
              <br><br>
            </form>
        </div>

            </div>
        </div>

        <br>
    </section>
     


</div>
<script type="text/javascript">
function editclosemodal(id){
  $("#editFeed"+id).fadeOut();
}
function editopenModal(id){
  $("#editFeed"+id).slideToggle();
}
function editchangeReply(id){
   event.preventDefault();
var path=document.getElementById('editreplyMode'+id).value;
if (path==1) {
  $("#eoption"+id).fadeIn();
  $("#eanotheroptionx"+id).hide();
  $("#eradiooptionx"+id).hide();
  $("#echeckoptionx"+id).hide();
  $("#estars"+id).hide();
$("#escale"+id).hide();
$("#edateReply"+id).hide();
}
else if(path==2){
$("#eanotheroptionx"+id).fadeIn();
$("#eoption"+id).hide();
$("#eradiooptionx"+id).hide();
$("#estars"+id).hide();
$("#echeckoptionx"+id).hide();
$("#escale"+id).hide();
$("#edateReply"+id).hide();
}
else if(path==3)
{
  $("#eradiooptionx"+id).fadeIn();
  $("#eanotheroptionx"+id).hide();
$("#eoption"+id).hide();
$("#echeckoptionx"+id).hide();
$("#estars"+id).hide();
$("#escale"+id).hide();
$("#edateReply"+id).hide();
}
else if(path==4){
  $("#estars"+id).fadeIn();
  $("#eradiooptionx"+id).hide();
  $("#eanotheroptionx"+id).hide();
$("#eoption"+id).hide();
$("#echeckoptionx"+id).hide();
$("#escale"+id).hide();
$("#edateReply"+id).hide();
}
else if(path==5){
  $("#escale"+id).fadeIn();
  $("#eradiooptionx"+id).hide();
  $("#eanotheroptionx"+id).hide();
$("#eoption"+id).hide();
$("#echeckoptionx"+id).hide();
$("#estars"+id).hide();
$("#edateReply"+id).hide();
}
else if(path==6){
  $("#edateReply"+id).fadeIn();
  $("#escale"+id).hide();
  $("#echeckoptionx"+id).hide();
  $("#eradiooptionx"+id).hide();
  $("#eanotheroptionx"+id).hide();
$("#eoption"+id).hide();
$("#estars"+id).hide();
}
else if(path==7){
  $("#edateReply"+id).hide();
  $("#escale"+id).hide();
  $("#echeckoptionx"+id).fadeIn();
  $("#eradiooptionx"+id).hide();
  $("#eanotheroptionx"+id).hide();
$("#eoption"+id).hide();
$("#estars"+id).hide();
  }
}


function addoption(id,arrayId){
  event.preventDefault();
      var randNo=Math.random();
      randNo=Math.floor(new Date().valueOf() * randNo);
  $('#anotheroption'+id).append('<div id="anotheroption'+randNo+'"><div class="row rowe'+randNo+'"><div class="col-10"><div class="wrap-input100 validate-input"><input type="text" class="input100" name="reply'+id+'[]"  autocomplete="reply" placeholder="Option"><span class="focus-input100"></span></div></div><div class="col-2" id="removecontrol'+randNo+'"><i class="fa fa-minus-circle fa-lg text-muted" style="cursor:pointer" onclick="removeoption('+randNo+')"></i> &nbsp&nbsp&nbsp<i class="fa fa-plus-circle fa-lg mt-3 text-muted" style="cursor:pointer" onclick="addoption('+randNo+','+arrayId+')"></i></div></div></div>');
}
function removeoption(id){
event.preventDefault();
$('.rowe'+id).remove(); 
}

//option2 
function eaddoption(id,arrayId){
  event.preventDefault();
      var randNo=Math.random();
      randNo=Math.floor(new Date().valueOf() * randNo);
      var newR='x'+randNo;
  $('#eanotheroption'+id).append('<div id="eanotheroption'+newR+'"><div class="row xrowe'+newR+'"><div class="col-10"><div class="wrap-input100 validate-input"><input type="text" class="input100" name="reply'+arrayId+'[]"  autocomplete="reply" placeholder="Option"><span class="focus-input100"></span></div></div><div class="col-2" id="eremovecontrol'+newR+'"><i class="fa fa-minus-circle fa-lg text-muted" style="cursor:pointer" onclick="eremoveoption(\''+newR+'\')"></i> &nbsp&nbsp&nbsp<i class="fa fa-plus-circle fa-lg mt-3 text-muted" style="cursor:pointer" onclick="eaddoption(\''+newR+'\','+arrayId+')"></i></div></div></div>');
}
function eremoveoption(id){
event.preventDefault();
$('.xrowe'+id).remove(); 
}


function addradiooption(id,arrayId){
  event.preventDefault();
      var randNo=Math.random();
      randNo=Math.floor(new Date().valueOf() * randNo);
  $('#radiooption'+id).append('<div id="radiooption'+randNo+'"><div class="row rowradio'+randNo+'"><div class="col-1"><input type="radio" style="margin-top: 20px; margin-left: 15px;" disabled></div><div class="col-9"><div class="wrap-input100 validate-input"><input type="text" class="input100" name="radioReply'+id+'[]"  autocomplete="reply" placeholder="Option"><span class="focus-input100"></span></div></div><div class="col-2" id="removeradiocontrol'+randNo+'"><i class="fa fa-minus-circle fa-lg text-muted" style="cursor:pointer" onclick="removeradiooption('+randNo+')"></i> &nbsp&nbsp&nbsp<i class="fa fa-plus-circle fa-lg mt-3 text-muted" id="removeradiocontrol'+randNo+'" style="cursor:pointer" onclick="addradiooption('+randNo+','+arrayId+')"></i></div></div></div>');
 }
function removeradiooption(id){
event.preventDefault();
$('.rowradio'+id).remove(); 
}

//option2
function eaddradiooption(id,arrayId){
  event.preventDefault();
      var randNo=Math.random();
      randNo=Math.floor(new Date().valueOf() * randNo);
      var newR='x'+randNo;
  $('#eradiooption'+id).append('<div id="eradiooption'+newR+'"><div class="row xrowradio'+newR+'"><div class="col-1"><input type="radio" style="margin-top: 20px; margin-left: 15px;" disabled></div><div class="col-9"><div class="wrap-input100 validate-input"><input type="text" class="input100" name="radioReply'+arrayId+'[]"  autocomplete="reply" placeholder="Option"><span class="focus-input100"></span></div></div><div class="col-2" id="eremoveradiocontrol'+newR+'"><i class="fa fa-minus-circle fa-lg text-muted" style="cursor:pointer" onclick="eremoveradiooption(\''+newR+'\')"></i> &nbsp&nbsp&nbsp<i class="fa fa-plus-circle fa-lg mt-3 text-muted" id="eremoveradiocontrol'+newR+'" style="cursor:pointer" onclick="eaddradiooption(\''+newR+'\','+arrayId+')"></i></div></div></div>');
 }
function eremoveradiooption(id){
event.preventDefault();
$('.xrowradio'+id).remove(); 
}


function addcheckoption(id,arrayId){
  event.preventDefault();
      // var randNo=id+1;
      var randNo=Math.random();
      randNo=Math.floor(new Date().valueOf() * randNo);
  $('#checkoption'+id).append('<div id="checkoption'+randNo+'"><div class="row rowcheck'+randNo+'"><div class="col-1"><input type="checkbox" style="margin-top: 20px; margin-left: 15px;" disabled></div><div class="col-9"><div class="wrap-input100 validate-input"><input type="text" class="input100" name="checkReply'+id+'[]"  autocomplete="reply" placeholder="Option"><span class="focus-input100"></span></div></div><div class="col-2" id="removecheckcontrol'+randNo+'"><i class="fa fa-minus-circle fa-lg text-muted" style="cursor:pointer" onclick="removecheckoption('+randNo+')"></i> &nbsp&nbsp&nbsp<i class="fa fa-plus-circle fa-lg mt-3 text-muted" id="removecheckcontrol'+randNo+'" style="cursor:pointer" onclick="addcheckoption('+randNo+','+arrayId+')"></i></div></div></div>');
   // $('#removecheckcontrol'+id).hide();
 }
function removecheckoption(id){
event.preventDefault();
// var idtoshow=id-1;
// $('#removecheckcontrol'+idtoshow).fadeIn();
$('.rowcheck'+id).remove(); 
}

//option2
function eaddcheckoption(id,arrayId){
  event.preventDefault();
      var randNo=Math.random();
      randNo=Math.floor(new Date().valueOf() * randNo);
      var newR='x'+randNo;
  $('#echeckoption'+id).append('<div id="echeckoption'+newR+'"><div class="row xrowcheck'+newR+'"><div class="col-1"><input type="checkbox" style="margin-top: 20px; margin-left: 15px;" disabled></div><div class="col-9"><div class="wrap-input100 validate-input"><input type="text" class="input100" name="checkReply'+arrayId+'[]"  autocomplete="reply" placeholder="Option"><span class="focus-input100"></span></div></div><div class="col-2" id="eremovecheckcontrol'+newR+'"><i class="fa fa-minus-circle fa-lg text-muted" style="cursor:pointer" onclick="eremovecheckoption(\''+newR+'\')"></i> &nbsp&nbsp&nbsp<i class="fa fa-plus-circle fa-lg mt-3 text-muted" id="eremovecheckcontrol'+newR+'" style="cursor:pointer" onclick="eaddcheckoption(\''+newR+'\','+arrayId+')"></i></div></div></div>');
    }
function eremovecheckoption(id){
event.preventDefault();
$('.xrowcheck'+id).remove(); 
}

function nchangeReply(id){
   event.preventDefault();
      var randNo=id+1;
var path=document.getElementById('nreplyMode'+id).value;
if (path==1) {
  $("#noption"+id).fadeIn();
  $("#nanotheroption"+id).hide();
  $("#nradiooption"+id).hide();
  $("#ncheckoption"+id).hide();
  $("#nstars"+id).hide();
$("#nscale"+id).hide();
$("#ndateReply"+id).hide();
}
else if(path==2){
$("#nanotheroption"+id).fadeIn();
$("#noption"+id).hide();
$("#nradiooption"+id).hide();
$("#nstars"+id).hide();
$("#ncheckoption"+id).hide();
$("#nscale"+id).hide();
$("#ndateReply"+id).hide();
}
else if(path==3)
{
  $("#nradiooption"+id).fadeIn();
  $("#nanotheroption"+id).hide();
$("#noption"+id).hide();
$("#ncheckoption"+id).hide();
$("#nstars"+id).hide();
$("#nscale"+id).hide();
$("#ndateReply"+id).hide();
}
else if(path==4){
  $("#nstars"+id).fadeIn();
  $("#nradiooption"+id).hide();
  $("#nanotheroption"+id).hide();
$("#noption"+id).hide();
$("#ncheckoption"+id).hide();
$("#nscale"+id).hide();
$("#ndateReply"+id).hide();
}
else if(path==5){
  $("#nscale"+id).fadeIn();
  $("#nradiooption"+id).hide();
  $("#nanotheroption"+id).hide();
$("#noption"+id).hide();
$("#ncheckoption"+id).hide();
$("#nstars"+id).hide();
$("#ndateReply"+id).hide();
}
else if(path==6){
  $("#ndateReply"+id).fadeIn();
  $("#nscale"+id).hide();
  $("#ncheckoption"+id).hide();
  $("#nradiooption"+id).hide();
  $("#nanotheroption"+id).hide();
$("#noption"+id).hide();
$("#nstars"+id).hide();
}
else if(path==7){
  $("#ndateReply"+id).hide();
  $("#nscale"+id).hide();
  $("#ncheckoption"+id).fadeIn();
  $("#nradiooption"+id).hide();
  $("#nanotheroption"+id).hide();
$("#noption"+id).hide();
$("#nstars"+id).hide();
}
}

function naddQuestion(id,arrayId){
    event.preventDefault();
      var randNo=Math.random();
      var nameid=arrayId+1;
      randNo=Math.floor(new Date().valueOf() * randNo);
      $("#nquestionHolder").append('<div class="card bg-wite px-3 py-3 shadow-lg" id="initialCard'+randNo+'"><div class="card-header"><div class="row d-flex justify-content-between align-items-center"><div><span class="label-input100" style="font-size:16px !importantl;">Question</span></div><div><button type="button" class="btn btn-primary shadow-sm addbtns" onclick="naddQuestion('+randNo+','+nameid+');"  title="Add Survey Question" style="width: 30px; height: 30px; border-radius: 50%;" id="nhideadd'+randNo+'" ><i class="fas fa-plus fa-1x"></i></button>&nbsp;&nbsp;<button type="button" class="btn btn-danger shadow-sm addbtns" id="nremovebtn'+randNo+'" onclick="nremoveQuestion('+randNo+');" title="Remove Survey Question"  style="width: 30px; height: 30px; border-radius: 50%;"><i class="fas fa-minus fa-1x"></i></button></div></div></div><div class="card-body bg-white"><div class="row"><div class="col-md-8"><div class="wrap-input100 validate-input"><span class="label-input100">Question</span><input type="question" class="input100" id="select" name="question['+nameid+']" required autocomplete="question" placeholder="Survey question"><span class="focus-input100"></span></div></div><div class="col-md-4"><div class="form-group"><label>Reply mode <i class="fas fa-question-circle text-primary" onclick="nopenModal('+randNo+')" style="cursor: pointer;"></i></label><div class="card bg-light shadow-lg" id="nFeed'+randNo+'" style="display:none; position: absolute; left:11%; margin-top: -20px; z-index: 9999;"><div class="card-body text-muted"><i onclick="nclosemodal('+randNo+')" style="cursor:pointer" class=" fas fa-window-close float-right"></i><br><strong>Reply mode</strong><br>This option gives you freedom to select the mode of feedback for each question</div></div><select name="replyMode['+nameid+']" id="nreplyMode'+randNo+'" class="form-control" onclick="nchangeReply('+randNo+')" required style="height: calc(3.25rem + 8px) !important;border: 2px solid #ced4da !important;"><option value="1" selected> Written feedback</option><option value="2"> Dropdown list</option><option value="3"> Radio buttons</option><option value="7"> Checkboxes</option><option value="4"> Star rating</option><option value="5"> Scale rating</option><option value="6"> Date</option></select></div></div><div class="col-12"><div id="nreplFeedback'+randNo+'"><span class="text-muted ml-3" id="option'+randNo+'"> This question will have a written feedback</span><div id="nanotheroption'+randNo+'" style="display:none;"><div class="row"><div class="col-10"><div class="wrap-input100 validate-input"><input type="text" class="input100" name="reply'+nameid+'[]"  autocomplete="reply" placeholder="Option"><span class="focus-input100"></span></div></div><div class="col-2"><i class="fa fa-plus-circle fa-2x mt-3 text-muted" id="nremovecontrol'+randNo+'" style="cursor:pointer" onclick="naddoption('+randNo+','+nameid+')"></i></div></div></div><div id="nradiooption'+randNo+'" style="display:none;"><div class="row"><div class="col-1"><input type="radio" style="margin-top: 20px; margin-left: 15px;" disabled></div><div class="col-9"><div class="wrap-input100 validate-input"><input type="text" class="input100" name="nradioReply'+nameid+'[]"  autocomplete="reply" placeholder="Option"><span class="focus-input100"></span></div></div><div class="col-2"><i class="fa fa-plus-circle fa-2x mt-3 text-muted" id="nremoveradiocontrol'+randNo+'" style="cursor:pointer" onclick="naddradiooption('+randNo+','+nameid+')"></i></div></div></div><div id="ncheckoption'+randNo+'" style="display:none;"><div class="row"><div class="col-1"><input type="checkbox" style="margin-top: 20px; margin-left: 15px;" disabled></div><div class="col-9"><div class="wrap-input100 validate-input"><input type="text" class="input100" name="checkReply'+nameid+'[]"  autocomplete="reply" placeholder="Option"><span class="focus-input100"></span></div></div><div class="col-2"><i class="fa fa-plus-circle fa-2x mt-3 text-muted" id="nremovecheckcontrol'+randNo+'" style="cursor:pointer" onclick="naddcheckoption('+randNo+','+nameid+')"></i></div></div></div><span class="text-muted ml-3" id="nstars'+randNo+'" style="display:none"> This question will have a star rating feedback</span><div  id="nscale'+randNo+'" style="display:none;"><div class="row"><div class="col-sm-4"><div class="form-group"><label>Marks for this scale</span></label><div class="wrap-input100 validate-input"><input type="text" class="input100" name="marks['+nameid+']" id="phn"  autocomplete="marks" placeholder="Marks"><span class="focus-input100"></span></div></div></div></div></div><span class="text-muted ml-3" id="ndateReply'+randNo+'" style="display:none"> This question will have a date feedback</span></div></div></div></div>');
      $("#nhideadd"+id).hide();
}
function nclosemodal(id){
  $("#nFeed"+id).fadeOut();
}
function nopenModal(id){
  $("#nFeed"+id).slideToggle();
}

function nremoveQuestion(id){
event.preventDefault();
var idx = $('.card :last').attr('id').replace(/dateReply/, '');
$('#initialCard'+id).remove();
if (id==idx) {
  var newidx = $('.card :last').attr('id').replace(/dateReply/, '');
$('#nhideadd'+newidx).show();
}
 

}

function naddoption(id,arrayId){
  event.preventDefault();
      var randNo=id+1;
  $('#nanotheroption'+id).append('<div id="nanotheroption'+randNo+'"><div class="row nrowe'+randNo+'"><div class="col-10"><div class="wrap-input100 validate-input"><input type="text" class="input100" name="reply'+arrayId+'[]"  autocomplete="reply" placeholder="Option"><span class="focus-input100"></span></div></div><div class="col-2" id="nremovecontrol'+randNo+'"><i class="fa fa-minus-circle fa-2x text-muted" style="cursor:pointer" onclick="nremoveoption('+randNo+')"></i> &nbsp&nbsp&nbsp<i class="fa fa-plus-circle fa-2x mt-3 text-muted" style="cursor:pointer" onclick="naddoption('+randNo+','+arrayId+')"></i></div></div></div>');
  $('#nremovecontrol'+id).hide();
}
function nremoveoption(id){
event.preventDefault();
var idtoshow=id-1;
$('#nremovecontrol'+idtoshow).fadeIn();
$('#nanotheroption'+id).remove(); 
}


function naddradiooption(id,arrayId){
  event.preventDefault();
      var randNo=id+1;
  $('#nradiooption'+id).append('<div id="nradiooption'+randNo+'"><div class="row nrowradio'+randNo+'"><div class="col-1"><input type="radio" style="margin-top: 20px; margin-left: 15px;" disabled></div><div class="col-9"><div class="wrap-input100 validate-input"><input type="text" class="input100" name="radioReply'+arrayId+'[]"  autocomplete="reply" placeholder="Option"><span class="focus-input100"></span></div></div><div class="col-2" id="nremoveradiocontrol'+randNo+'"><i class="fa fa-minus-circle fa-2x text-muted" style="cursor:pointer" onclick="nremoveradiooption('+randNo+')"></i> &nbsp&nbsp&nbsp<i class="fa fa-plus-circle fa-2x mt-3 text-muted" id="nremoveradiocontrol'+randNo+'" style="cursor:pointer" onclick="naddradiooption('+randNo+','+arrayId+')"></i></div></div></div>');
   $('#nremoveradiocontrol'+id).hide();
 }
function nremoveradiooption(id){
event.preventDefault();
var idtoshow=id-1;
$('#nremoveradiocontrol'+idtoshow).fadeIn();
$('#nradiooption'+id).remove(); 
}
function naddcheckoption(id,arrayId){
  event.preventDefault();
      var randNo=id+1;
  $('#ncheckoption'+id).append('<div id="ncheckoption'+randNo+'"><div class="row nrowcheck'+randNo+'"><div class="col-1"><input type="checkbox" style="margin-top: 20px; margin-left: 15px;" disabled></div><div class="col-9"><div class="wrap-input100 validate-input"><input type="text" class="input100" name="checkReply'+arrayId+'[]"  autocomplete="reply" placeholder="Option"><span class="focus-input100"></span></div></div><div class="col-2" id="nremovecheckcontrol'+randNo+'"><i class="fa fa-minus-circle fa-2x text-muted" style="cursor:pointer" onclick="nremovecheckoption('+randNo+')"></i> &nbsp&nbsp&nbsp<i class="fa fa-plus-circle fa-2x mt-3 text-muted" id="nremovecheckcontrol'+randNo+'" style="cursor:pointer" onclick="naddcheckoption('+randNo+','+arrayId+')"></i></div></div></div>');
   $('#nremovecheckcontrol'+id).hide();
 }
function nremovecheckoption(id){
event.preventDefault();
var idtoshow=id-1;
$('#nremovecheckcontrol'+idtoshow).fadeIn();
$('#ncheckoption'+id).remove(); 
}

  $("#phn").keypress(function (e) {
       if (String.fromCharCode(e.keyCode).match(/[^0-9]/g)) return false;
   });
</script>
@endsection

