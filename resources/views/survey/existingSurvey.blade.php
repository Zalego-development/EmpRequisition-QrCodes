@extends('layouts.admin')

@section('content')

<style type="text/css">
.bootstrap-select .bs-ok-default::after {
    width: 0.3em;
    height: 0.6em;
    border-width: 0 0.1em 0.1em 0;
    transform: rotate(45deg) translateY(0.5rem);
}

.btn.dropdown-toggle:focus {
    outline: none !important;
}
</style>
<script type="text/javascript">
 $(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('editor1')
    //bootstrap WYSIHTML5 - text editor
    $('.textarea').wysihtml5()
  })
</script>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1 class="m-0 text-muted ml-2 mt-4"><strong>Existing Survey</strong></h1>
            <ol class="breadcrumb float-sm-left ml-2">
              <li class="breadcrumb-item"><a href="{{url('/home')}}"><i class="fa fa-home"></i></a></li>
              <li class="breadcrumb-item active">Existing Survey</li>
            </ol>
             <div  class="float-right">
                <a href="{{url('/existingSurvey')}}"><button class="btn btn-primary">
               <i class="fa fa-cog"></i> Refresh</button></a>
        </div>
                       
          </div><!-- /.col -->
    
        </div><!-- /.row -->

      </div><!-- /.container-fluid -->
    </div>

         <button class="btn btn-default shadow-lg ml-4" onclick='$("#existingTemplate").slideToggle();$("#newTemplate").hide();$("#ranking").hide();'><i class="fas fa-file"></i> Existing Surveys <sup class="text-primary">
          <strong class="badge badge-default shadow-lg">{{count($survey)}}</strong></sup></button>&nbsp
          <button class="btn  btn-default shadow-lg ml-2" onclick='$("#newTemplate").slideToggle();$("#existingTemplate").hide();$("#ranking").hide();'><i class="fas fa-minus-circle text-danger"></i> Archived Surveys <sup class="text-danger">
          <strong class="badge badge-default bg-white shadow-lg">{{count($archivedsurvey)}}</strong></sup></button>
<br><br>

    <!-- /.content-header -->
  <section class="container card px-3 py-3 ml-2 mr-3">
    <!-- <section class="content"> -->
        <!-- <div class="container-fluid"> -->
           
    <div class="table-responsive" id="">
     <nav class="navbar navbar-expand navbar-white float-right mb-2" style="border-radius: 5px;" id="">
      <form method="get" action='{{url("/filterSurveyDates")}}' class="form-inline ml-3">
                  @csrf
                  <div class="input-group input-group-sm">
                      <div class="input-group input-group-sm">
                          <label style="padding-left:5px;"> From&nbsp;</label>
                          <input type="date" class="form-control" name="from" required >
                      </div>

                       <div class="input-group input-group-sm">
                          <label style="padding-left:5px;">To&nbsp;</label>
                          <input type="date" class="form-control" name="to" required>
                      </div>
                      <div class="input-group-append">
                          <button class="btn btn-navbar theme-green text-white" type="submit">
                              <i class="fa fa-filter "></i>
                          </button>
                      </div>
                  </div>
              </form>

              <form method="get" action="{{url('/search/survey')}}" class="form-inline ml-3">
                  @csrf
                  <div class="input-group input-group-sm">
                      <input class="form-control form-control-navbar input-sm" name="search" type="search" placeholder="Search training" aria-label="Name">
                      <div class="input-group-append">
                          <button class="btn theme-green text-white" type="submit">
                              <i class="fa fa-search "></i>
                          </button>
                      </div>
                  </div>
              </form>

          </nav>
  <div id="existingTemplate">
        <table class="table table-striped " >
          <thead>
          <tr class="">
             <th>#</th>
            <th>Survey Name</th>
            <th>Responses</th>
            <th>Survey Status</th>
            <th>Submissions deadline</th>
            <th>Created On</th>
            <th>Actions</th>
          </tr>
          </thead>
          <?php $xx=1; ?>
          @if(count($survey)>0)
              @foreach($survey as $sur)
              <input type="hidden" id="uniqueId{{$sur->id}}" value="{{$sur->uniqueId}}"> 
          <tr>
              <td>{{$xx++}}</td>
              <td><a href="{{url('/viewResponse/'.$sur->id)}}" class="text-primary">{{$sur->survey_name}}</a></td>
             <td>
              <?php 
              $tableName=DB::table('survey_questions')->first();
              if ($tableName->reply_mode==1) {
                $table="reply_written";
              }
              elseif ($tableName->reply_mode==2 ||$tableName->reply_mode==3) {
                $table="reply_choices";
              }
              elseif ($tableName->reply_mode==4 ||$tableName->reply_mode==5) {
                $table="reply_points";
              }
              elseif ($tableName->reply_mode==6) {
                $table="reply_date";
              }
              ?>
              {{DB::table($table)->where('question_id',$tableName->id)->count()}}</td>
                        <td> @if($sur->publish==0)
                        <a href="#" onclick="publishSurvey(<?php echo $sur->id;?>)"><button class="btn btn-sm btn-default mt-1" title="This survey is yet to be published"><i class="fas fa-bell"></i> Not Published</button></a>
                        @else
                        <button class="btn btn-sm btn-success mt-1 " title="Survey has been published"><i class="fa fa-check"></i> Published</button>
                        @endif</td>

              <td>{{\Carbon\Carbon::parse($sur->deadline)->format('d-M-Y')}}</td>
              <td>{{\Carbon\Carbon::parse($sur->created_at)->format('d-M-Y')}}</td>
              <td>
               <center>
                    <div class="dropdown dropleft theme-green shadow-lg mt-2" style="width: 30px; cursor: pointer; height: 30px; border-radius: 50%; color: #fff; " id="dropdownMenu" data-toggle="dropdown"><i class="fas fa-ellipsis-v" style="margin-top: 9px;"  ></i>
                       <div class="dropdown-menu fade">
                         <a class="dropdown-item" onclick="toEditSurvey(<?php echo $sur->id;?>)" href="#"><i class="fas fa-pencil-alt theme-green-text"></i> Edit Survey</a>
                        <a class="dropdown-item" onclick="toViewSurvey(<?php echo $sur->id;?>)" href="#"><i class="fas fa-users theme-green-text"></i> View Survey</a>
                        <a class="dropdown-item" onclick="toViewResponse(<?php echo $sur->id;?>)" href="#"><i class="fas fa-eye theme-green-text"></i> View Responses</a>
                        <a class="dropdown-item" onclick="toViewResponse1(<?php echo $sur->id;?>)" href="#"><i class="fas fa-eye theme-green-text"></i> View Responses Client</a>

                        <a class="dropdown-item" onclick="publishSurvey(<?php echo $sur->id;?>)" href="#"><i class="fa fa-envelope theme-purple-text"></i> Publish Survey to anonymous</a>
                        <!-- endif -->
                        <a class="dropdown-item" onclick="publishSurvey1(<?php echo $sur->id;?>)" href="#"><i class="fa fa-envelope theme-purple-text"></i> Publish Survey to Client</a>
                        <a class="dropdown-item" onclick="tofacebook(<?php echo $sur->id;?>)" href="#"><i class="fab fa-facebook-f text-primary"></i> Post on Facebook</a>
                        <a class="dropdown-item" onclick="toDelete(<?php echo $sur->id;?>)" href="#"><i class="fas fa-trash text-danger"></i> Archive Survey</a>
                     </div>
                    </div>
                </center>
              </td>
            </tr>




            <div class="modal fade" id="addNewMessage{{$sur->id}}">
              <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h4 class="modal-title">&nbsp;&nbsp;<i class="fa fa-envelope"></i>&nbsp;Publish {{$sur->survey_name}}</h4>

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
                                             placeholder="Subject" value="{{old('subject') ?? $sur->survey_name }}">
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

                                  <input type="hidden" name="surveyId" value="{{$sur->id}}">
                                
                                  </div>
                              </div>
                              <center style="margin-top: -17px;" class="mb-3">
                                  <button type="button" class="btn btn-danger" data-dismiss="modal">
                                      <i class="fa fa-times"></i>
                                      Close
                                  </button>
                                  <button type="submit" class="btn btn-primary" id="ajaxSubmit">
                                      <i class="fa fa-send"></i>
                                      Send
                                  </button>
                              </center>
                          </form>
                      </div>
                  </div>
              </div>
          </div>

            
            <div class="modal fade" id="addNewM">
              <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h4 class="modal-title">&nbsp;&nbsp;<i class="fa fa-envelope"></i>&nbsp;Publish {{$sur->survey_name}} to Client</h4>

                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                      </div>
                      <div class="card-body px-2 modalCardBody">
                          <form method="post" action="{{url('/email/publishtoclient')}}" id="form" enctype="multipart/form-data">
                              @csrf
                              <div class="row">
                                  <div class="form-group col-md-6">
                                      <label class="col-form-label" for="subject">Subject</label>
                                      <input type="text" class="form-control is-valid" id="subject" name="subject" id="subject" required
                                             placeholder="Subject" value="{{old('subject') ?? $sur->survey_name }}">
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

                                  <input type="hidden" name="surveyId" value="{{$sur->id}}">
                                
                                  </div>
                              </div>
                              <center style="margin-top: -17px;" class="mb-3">
                                  <button type="button" class="btn btn-danger" data-dismiss="modal">
                                      <i class="fa fa-times"></i>
                                      Close
                                  </button>
                                  <button type="submit" class="btn btn-primary" id="ajaxSubmit">
                                      <i class="fa fa-send"></i>
                                      Send
                                  </button>
                              </center>
                          </form>
                      </div>
                  </div>
              </div>
          </div>

          @endforeach
           @else
          <tr>
            <td colspan="5" class="text-center"> No survey to show</td>
          </tr>
          @endif
        </table>
        <div class="col-md-12 mt-4">
         {{ $survey->links() }}
      </div>
        </div>

<div id="newTemplate" style="display:none">
         <table class="table table-striped " >
          <thead>
          <tr class="">
             <th>#</th>
            <th>Survey Name</th>
            <th>Created On</th>
            <th>Actions</th>
          </tr>
          </thead>
          <?php $xx=1; ?>
          @if(count($archivedsurvey)>0)
              @foreach($archivedsurvey as $survey)
          <tr>
              <td>{{$xx++}}</td>
              <td>{{$survey->survey_name}}</a></td>
              <td>{{\Carbon\Carbon::parse($survey->created_at)->format('d-M-Y')}}</td>
              <td>
               <center>
                    <div class="dropdown dropleft theme-purple shadow-lg mt-2" style="width: 30px; cursor: pointer; height: 30px; border-radius: 50%; color: #fff; " id="dropdownMenu" data-toggle="dropdown"><i class="fas fa-ellipsis-v" style="margin-top: 9px;"  ></i>
                       <div class="dropdown-menu fade">
                         <!-- <a class="dropdown-item" href="#"><i class="fas fa-pencil-alt theme-green-text"></i> Edit Survey</a> -->
                        <a class="dropdown-item" onclick="removeFromArchive(<?php echo $survey->id;?>)" href="#"><i class="fas fa-undo text-danger"></i> Remove from archive</a>
                        <a class="dropdown-item" onclick="deletePermanently(<?php echo $survey->id;?>)" href="#"><i class="fas fa-trash text-danger"></i> Delete Permanently</a>
                     </div>
                    </div>
                </center>
              </td>
            </tr>
          @endforeach
          @else
          <tr>
            <td colspan="4" class="text-center"> No survey to show</td>
          </tr>
          @endif
        </table>
        <div class="col-md-12 mt-4">
         {{ $archivedsurvey->links() }}
      </div>
</div>
            </div>

        <br>
    </section>
     


</div>
<script type="text/javascript">
function closemodal(id){
  $("#Feed"+id).fadeOut();
}
function toDelete(id){
  var result=confirm('You are about to archive this survey. Do you wish to proceed?');
  if(result){
  window.location.assign('./archiveSurvey/'+id);
  }
}
function removeFromArchive(id){
  var result=confirm('You are about to remove this survey from archive. Do you wish to proceed?');
  if(result){
  window.location.assign('./removeFromArchive/'+id);
  }
}
function deletePermanently(id){
  var result=confirm('You are about to delete this survey permanently. Do you wish to proceed?');
  if(result){
  window.location.assign('./deletePermanently/'+id);
  }
}
function toViewSurvey(id){
  window.location.assign('./viewSurvey/'+id);
}
function toViewResponse(id){
  window.location.assign('./viewResponse/'+id);
}
function toEditSurvey(id){
  window.location.assign('./editSurvey/'+id);
}
function publishSurvey(id){
  // window.location.assign('./publishSurvey/'+id);
  $("#addNewMessage"+id).modal('show');
}
function publishSurvey1(id){
  // window.location.assign('./publishSurvey/'+id);
  $("#addNewM").modal('show');
}
function tofacebook(id){
  var newid=document.getElementById('uniqueId'+id).value;
  window.open('https://www.facebook.com/sharer/sharer.php?u=https://hrm.zalegoinstitute.ac.ke/zalegosurvey/public/surveys/'+newid+'&display=popup', '_blank');
}
    // $(document).ready(function() {
    //     $('#example-getting-started').multiselect();
    // });

// $(document).ready(function() {
//   $('#months').multiselect();
// });
</script>

   <script>
  var editor_config = {
    path_absolute : "",
    selector: "textarea.my-editor",
    setup : function(ed){
      ed.on('init',function(){
        this.getDoc().body.style.fontFamily='Tw Cen MT';
        this.getDoc().body.style.fontSize='44';
      });
    },
    plugins: [
      "advlist autolink lists link image charmap print preview hr anchor pagebreak",
      "searchreplace wordcount visualblocks visualchars code fullscreen",
      "insertdatetime media nonbreaking save table contextmenu directionality",
      "emoticons template paste textcolor colorpicker textpattern"
    ],
    toolbar: "insertfile undo redo | styleselect fontselect fontsizeselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media | forecolor backcolot",
    relative_urls: false,
    file_browser_callback : function(field_name, url, type, win) {
      var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
      var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

      var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
      if (type == 'image') {
        cmsURL = cmsURL + "&type=Images";
      } else {
        cmsURL = cmsURL + "&type=Files";
      }

      tinyMCE.activeEditor.windowManager.open({
        file : cmsURL,
        title : 'Filemanager',
        width : x * 0.8,
        height : y * 0.8,
        resizable : "yes",
        close_previous : "no"
      });
    }
  };

  tinymce.init(editor_config);
</script>
@endsection

