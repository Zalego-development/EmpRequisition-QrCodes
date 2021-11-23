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
            <h1 class="m-0 text-muted ml-2 mt-4"><strong>View Survey</strong></h1>
            <ol class="breadcrumb float-sm-left ml-2">
              <li class="breadcrumb-item"><a href="{{url('/home')}}"><i class="fa fa-home"></i></a></li>
              <li class="breadcrumb-item active">View Survey</li>
            </ol>
             <div  class="float-right">

              <a href="#" onclick="history.back()"><button class="btn btn-sucess">
              <i class="fa fa-arrow-left"></i> Back</button></a>
            @if(!is_null($survey))
                <a href="{{url('/viewSurvey/'.$survey->id)}}"><button class="btn btn-warning">
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
          <div class="modal fade" id="addNewMessage">
              <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h4 class="modal-title">&nbsp;&nbsp;<i class="fa fa-envelope"></i>&nbsp;Publish {{$survey->survey_name}}</h4>

                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                      </div>
                      <div class="card-body px-2 modalCardBody">
                          <form method="post" action="{{url('/email/publish')}}" id="form" enctype="multipart/form-data">
                              @csrf
                              <div class="row">
                                  <div class="form-group col-md-6">
                                      <label class="col-form-label" for="subject">Subject</label>
                                      <input type="text" class="form-control is-valid" id="subject" name="subject" id="subject" required
                                             placeholder="Subject" value="{{old('subject') ?? $survey->survey_name }}">
                                  </div>

                                  <div class="form-group col-md-6">
                                      <label for="group_id">Group</label>
                                      <select class="form-control" style="width: 100%;" name='groups' id="groups" required>
                                          
                                              @foreach(DB::table('groups')->get() as $cg)
                                                  <option value="{{$cg->id}}" @if($cg->id==1)selected @endif>{{$cg->name}}</option>
                                              @endforeach
                                          
                                      </select>
                                  </div>
                                  
                                  <div class="form-group col-md-12">
                                      <label class="col-form-label" for="message">Message</label>
                                      <textarea class="textarea" id="message" rows="7"
                                      name="message" id="message" required> {{old('message') ?? 'You are invited to fill a survey using the link below. The survey will take a few minutes to complete.
                                      We would be delighted to hear from you and incorporate your feedback. Thanks.' }} </textarea>
                   
                                  </div>

                                  <input type="hidden" name="surveyId" value="{{$survey->id}}">
                                
                                  </div>
                              </div>
                              <center style="margin-top: -17px;" class="mb-3">
                                  <button type="button" class="btn btn-danger" data-dismiss="modal">
                                      <i class="fa fa-times"></i>
                                      Close
                                  </button>
                                  <button type="submit" class="btn btn-primary" id="ajaxSubmit" @if($survey->publish==1) onclick="return confirm('You had already shared this survey to emails, Do you wish to reshare?');" @endif>
                                      <i class="fa fa-send"></i>
                                      Send
                                  </button>
                              </center>
                          </form>
                      </div>
                  </div>
              </div>
          </div>

            @if(!is_null($survey))
            <div class="card bg-wite px-3 py-3 shadow">
              <div class="card-header">
                <div class="row d-flex justify-content-between align-items-center">
                  <div>
                  <span class="label-input100" style="font-size:16px !important; font-family: inherit !important;">About this survey</span>
                </div>
                  <div>
                    <span class="label-input100" style="font-family: inherit !important;"> Edit Survey: <a href="{{url('/editSurvey/'.$survey->id)}}">
                     <button type="button" class="btn bg-green shadow-sm addbtns" title="Share this survey to facebook" style="width: 30px; height: 30px; border-radius: 50%; margin-top:-5px;" id="hideadd1"><i class="fas fa-pencil-alt fa-1x"></i></button></a>&nbsp;
                    </span>&nbsp;&nbsp;&nbsp;
                 
                  <!-- <button class="">click here to copy</button> -->
                  <!-- <a href="https://www.facebook.com/sharer/sharer.php?u=https://hrm.zalegoinstitute.ac.ke/zalegoemp/public/trainingSurvey&display=popup" target="_blank"> share this </a> -->

                  </div>
                </div>
              </div>
             <div class="card-body bg-white">
                <div class="row">
                   <div class="wrap-input100 validate-input text-center" style="border-bottom: none !important; margin-bottom: 10px !important;">
                        <span class="label-input100">{{$survey->company}} </span>
                        <!-- <input type="name" class="input100 " readonly name="name" value="" readonly autocomplete="name">
                        <span class="focus-input100"></span> -->
                    </div>
                     <div class="wrap-input100 validate-input text-center" style="border-bottom: none !important; margin-bottom: 10px !important;">
                        <span class="label-input100" >Survey Name <span style="color: #1F2D3D !important;">: </span>{{$survey->survey_name}}</span>
                        <!-- <input type="name" class="input100 " readonly name="name" value="" readonly autocomplete="name">
                        <span class="focus-input100"></span> -->
                    </div><br>

                    @if(!is_null($survey->survey_description))
                     <div class="wrap-input100 validate-input text-center" style="border-bottom: none !important; margin-bottom: 10px !important;">
                        <span class="label-input100" style="margin-bottom: 10px !important; ">Survey Description:</span><br>
                          <label style="color: #1F2D3D !important; font-weight:10 !important;" class="text-center text-muted label-input100">{{$survey->survey_description}}</label>
                        <!-- <input type="description" class="input100" readonly name="description" value="" readonly autocomplete="description" >
                        <span class="focus-input100"></span> -->
                    </div><br>
                   <!-- <div class="wrap-input100 validate-input">
                        <span class="label-input100">Survey Description</span>
                        <input type="description" class="input100" readonly name="description" value="{{$survey->survey_description}}" autocomplete="description" >
                        <span class="focus-input100"></span>
                    </div> -->
                    @endif
                     <div class="wrap-input100 validate-input text-center" style="border-bottom: none !important; margin-bottom: 10px !important;">
                        <span class="label-input100" style="margin-bottom: 10px !important; ">Submissions Deadline: </span><br>
                          <label style="color: #1F2D3D !important; font-weight:10 !important;" class="text-center text-muted label-input100">{{date('d M Y', strtotime($survey->deadline))}}</label>
                        <!-- <input type="description" class="input100" readonly name="description" value="" readonly autocomplete="description" >
                        <span class="focus-input100"></span> -->
                    </div><br>

                    <div class="wrap-input100 validate-input text-center" style="border-bottom: none !important; margin-bottom: 10px !important;">
                        <span class="label-input100" style="">Share this survey</span><br><br>
                  <a href="https://www.facebook.com/sharer/sharer.php?u={{url('/surveys/'.$survey->uniqueId)}}&display=popup" target="_blank">
                     <button type="button" class="btn bg-blue shadow-sm addbtns" onclick=""  title="Share this survey to facebook" style="width: 30px; height: 30px; border-radius: 50%; margin-top:-5px;" id="hideadd1"><i class="fab fa-facebook-f fa-1x"></i></button></a>&nbsp;
                    <button type="button" class="btn btn-primary shadow-sm addbtns copyButton" onclick=""  title="Copy link to clipboard" style="width: 30px; height: 30px; border-radius: 50%; margin-top:-5px;" id="copybtn"><i class="fas fa-copy fa-1x"></i></button>&nbsp;
                          <input class="linkToCopy" value="{{url('/surveys/'.$survey->uniqueId)}}" style="position: absolute; z-index: -999; opacity: 0;" />
                          <!-- if($survey->publish==0) -->
                          <!-- <a href="{{url('/publishSurvey/'.$survey->id)}}" > -->
                          <button type="button" class="btn theme-green shadow-sm addbtns" data-toggle="modal" data-target="#addNewMessage"  title="Share this survey to email" style="width: 30px; height: 30px; border-radius: 50%; margin-top:-5px;" id=""><i class="fa fa-envelope fa-1x text-white"></i></button>
                        <!-- </a> -->
                          <!-- else -->
                          <!-- <a href="{{url('/publishSurvey/'.$survey->id)}}" onclick="return confirm('You have already shared this survey to emails, Do you wish to reshare?');"> -->
                          <!-- <button type="button" class="btn theme-green shadow-sm addbtns" onclick=""  title="Share this survey to email" style="width: 30px; height: 30px; border-radius: 50%; margin-top:-5px;" id=""><i class="fa fa-envelope fa-1x text-white"></i></button></a> -->
                          <!-- endif -->
                    </div>
                </div>
              </div>
            </div>
            <?php $count=1; ?>
              @foreach($questions as $question)
              <div class="card bg-wite px-3 py-3 shadow-lg" id="initialCard1">
              <div class="card-header">
                <div class="row d-flex justify-content-between align-items-center">
                  <div>
                  <span class="label-input100" style="font-family: inherit !important;">Question {{$count++}}</span>
                  </div>
                  <div>
                     <!-- <button type="button" class="btn btn-primary shadow-sm addbtns" onclick="addQuestion(1,0);"  title="Add Survey Question" style="width: 30px; height: 30px; border-radius: 50%;" id="hideadd1"><i class="fas fa-plus fa-1x"></i></button>&nbsp;&nbsp; -->
            
                     <!-- <button type="button" class="btn btn-danger shadow-sm addbtns" onclick="removeQuestion(1);" title="Remove Survey Question"  style="width: 30px; height: 30px; border-radius: 50%;" id="removebtn1"><i class="fas fa-minus fa-1x"></i></button> -->
                  </div>
       
                </div>
              </div>
             <div class="card-body bg-white">
                <div class="row">
                   <div class="col-md-8">
                    <div class="wrap-input100 validate-input">
                        <span class="label-input100" style="font-family: inherit !important;">Question</span>
                        <input type="question" class="input100" id="select" readonly value="{{$question->question}}" autocomplete="question" >
                        <span class="focus-input100"></span>
                    </div>
                   </div>
                   <div class="col-md-4">
                     <div class="form-group">
                      <label>Reply mode <i class="fas fa-question-circle text-primary" onclick="openModal({{$count}})" style="cursor: pointer;"></i></label>
                    <div class="card bg-light shadow-lg" id="Feed{{$count}}" style="display:none; position: absolute; left:11%; margin-top: -20px; z-index: 9999;">
                      <div class="card-body text-muted">
                        <i onclick="closemodal({{$count}})" class=" fas fa-window-close float-right" style="cursor:pointer"></i>
                        <strong>Reply mode</strong><br>
                        This option gives you freedom to select the mode of feedback for each question
                      </div>
                      </div>
                      <select id="replyMode1" class="form-control" required style="height: calc(3.25rem + 8px) !important;border: 2px solid #ced4da !important;">
                        @if($question->reply_mode==1)
                        <option value="1"> Written feedback</option>
                        @endif
                        @if($question->reply_mode==2)
                        <option value="2"> Dropdown list</option>
                        @endif
                        @if($question->reply_mode==3)
                        <option value="3"> Radio buttons</option>
                        @endif
                        @if($question->reply_mode==4)
                        <option value="4"> Star rating</option>
                        @endif
                        @if($question->reply_mode==5)
                        <option value="5"> Scale rating</option>
                        @endif
                        @if($question->reply_mode==6)
                        <option value="6"> Date</option>
                        @endif
                        @if($question->reply_mode==7)
                        <option value="7"> Checkboxes</option>
                        @endif
                      </select>
                    </div>
                   </div>
                  <div class="col-12">
                   <div id="replFeedback0">
                    @if($question->reply_mode==1)
                    <span class="text-muted ml-3" id="option1"> This question will have a written feedback</span>
                    @endif
                    @if($question->reply_mode==2)
                    @foreach($answers as $ans)
                    @if($question->id==$ans->question_id)
                    <div id="anotheroption1"><div class="row"><div class="col-10"><div class="wrap-input100 validate-input">
                      <input type="text" class="input100" value="{{$ans->answer}}"  autocomplete="reply" readonly>
                      <span class="focus-input100"></span></div></div><div class="col-2"></div></div></div>
                      @endif
                      @endforeach
                      @endif
                      @if($question->reply_mode==3)
                       @foreach($answers as $ans)
                    @if($question->id==$ans->question_id)
                     <div id="radiooption1"><div class="row"><div class="col-1"><input type="radio" style="margin-top: 20px; margin-left: 15px;" disabled></div><div class="col-9"><div class="wrap-input100 validate-input">
                     <input type="text" class="input100" value="{{$ans->answer}}" autocomplete="reply" readonly>
                      <span class="focus-input100"></span></div></div><div class="col-2"></div></div></div>

                      @endif
                      @endforeach
                      @endif
                         @if($question->reply_mode==7)
                       @foreach($answers as $ans)
                    @if($question->id==$ans->question_id)
                     <div id="checkoption1"><div class="row"><div class="col-1"><input type="checkbox" style="margin-top: 20px; margin-left: 15px;" disabled></div><div class="col-9"><div class="wrap-input100 validate-input">
                     <input type="text" class="input100" value="{{$ans->answer}}" autocomplete="reply" readonly>
                      <span class="focus-input100"></span></div></div><div class="col-2"></div></div></div>

                      @endif
                      @endforeach
                      @endif
                      @if($question->reply_mode==4)
                      <span class="text-muted ml-3" id="stars1"> This question will have a star rating feedback</span>
                      @endif
                      @if($question->reply_mode==5)
                       @foreach($marks as $mark)
                    @if($question->id==$mark->question_id)
                      <div  id="scale1"><div class="row">
                       <div class="col-sm-4">
                        <div class="form-group">
                          <label>Marks for this scale</span></label>
                          <div class="wrap-input100 validate-input">
                          <input type="text" class="input100" value="{{$mark->marks}}" id="phn" readonly>
                          <span class="focus-input100"></span></div>
                         </div>
                        </div>
                       </div>
                     </div>
                      @endif
                      @endforeach
                     @endif
                     @if($question->reply_mode==6)
                     <span class="text-muted ml-3" id="dateReply1"> This question will have a date feedback</span>
                     @endif

                    </div>
                  </div>
                </div>
              </div>

            </div>
              @endforeach
              
              <span id="questionHolder"></span>
              <br><br>
            @endif
        </div>

        <br>
    </section>
     


</div>
<script type="text/javascript">
function closemodal(id){
  $("#Feed"+id).fadeOut();
}
function openModal(id){
  $("#Feed"+id).slideToggle();
}
$('button.copyButton').click(function(){
    $(this).siblings('input.linkToCopy').select();      
    document.execCommand("copy");
    alert("link has been copied to clipboard")
});

</script>
@endsection

