	<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    
<script src="{{asset('assets/libs/js/Chart.js')}}"></script>
<script src="https://cdn.jsdelivr.net/gh/emn178/chartjs-plugin-labels/src/chartjs-plugin-labels.js"></script>
    <title>{{config('app_name')}}</title>
    <script type="text/javascript">
        if(window.addEventListener){
  window.addEventListener('load', function(){
    
           


       window.print();
       
    });
}else{
  window.attachEvent('onload', function(){
        
       
       window.print();
       
    });
}

   
</script>
    <style type="text/css">
        body,html{
            overflow-x: hidden;
            color:black !important;
	font-family:calibri;
        }
        
       
    </style>
    
</head>
<body>				
				<!-- <table class="table table-sm table-bordered table-striped">
                </table> -->

                <div id="existingTemplate">
        <center>
                        <span class="text-center">{{$survey->company}}</span><br>
                        <span class="text-center">Survey Name <span style="color: #1F2D3D !important;">: </span>{{$survey->survey_name}}</span>
                      <br></center>
                    @if(!is_null($survey->survey_description))
                        <span >Survey Description</span><br>
                          <label >{{$survey->survey_description}}</label><br>
                    @endif
                    <hr>
            <?php $count=1; ?>
              @foreach($questions as $question)
                 {{$count++}}. {{$question->question}}
                  <br>
                    @if($question->reply_mode==1)
                    <span class="ml-2">This question has <b>{{DB::table('reply_written')->where('question_id',$question->id)->count()}}</b> responses</span>
                    <br><br>
         
                    @endif


                    @if($question->reply_mode==2)
            
                                @foreach(DB::table('survey_answers')->where('question_id',$question->id)->get() as $review)
                                    <?php $rcount2=DB::table('reply_choices')->where('question_id',$question->id)->where('choice_id',$review->id)->count(); ?>
                                    {!!$review->answer!!} <span class="text-success">({{$rcount2}} @if($rcount2>1) responses @else response @endif)</span>
                                    <br>
                                @endforeach
                                <br>

                      @endif

                      @if($question->reply_mode==3)
                         <?php $qcount1=1; ?>
                                @foreach(DB::table('survey_answers')->where('question_id',$question->id)->get() as $review)
                                    <?php $rcount1=DB::table('reply_choices')->where('question_id',$question->id)->where('choice_id',$review->id)->count(); ?>
                                    {!!$review->answer!!} <span class="text-success">({{$rcount1}} @if($rcount1>1) responses @else response @endif)</span>
                                    <br>
                                @endforeach
                                <br>
                      @endif

                       @if($question->reply_mode==7)
                      <?php $qcount=1; ?>
                                @foreach(DB::table('survey_answers')->where('question_id',$question->id)->get() as $review)
                                
                                    <?php $rcount=DB::table('reply_choices')->where('question_id',$question->id)->where('choice_id',$review->id)->count(); ?>
                                    {!!$review->answer!!} <span class="text-success">({{$rcount}} @if($rcount>1) responses @else response @endif)</span>
                                    <br>

                                @endforeach
                                <br>
                      @endif

                      @if($question->reply_mode==4)
                      <?php
                        $mrksSum=DB::table('reply_points')->where('question_id',$question->id)->sum('marks');
                         $mrksCount=DB::table('reply_points')->where('question_id',$question->id)->count();
                       
                         if($mrksCount==0){
                            $mrksCount=1;
                          }
                         $mrsToShow=round($mrksSum/$mrksCount);
                          $empty=5-$mrsToShow;
                         
                         for ($i=1; $i <= $mrsToShow; $i++) { 
                          ?>
                            <span class="fas fa-star" style="color:#ffd700 !important;font-size: 16px;" id="glyphicon"></span>
                          <?php  } ?>
                          <?php 
                          for ($i=1; $i <= $empty; $i++) { 
                          ?>
                            <span class="fas fa-star" style="font-size: 16px;" id="glyphicon"></span>
                          <?php  } ?> &nbsp; <span class="text-success">({{$mrsToShow}} stars)  </span>
<span class=""> This question has <b>{{DB::table('reply_points')->where('question_id',$question->id)->count()}}</b> responses</span>
                      
<br><br>
                      @endif


                      @if($question->reply_mode==5)
                    <?php
                        $mrksSum=DB::table('reply_points')->where('question_id',$question->id)->sum('marks');
                         $mrksCount=DB::table('reply_points')->where('question_id',$question->id)->count();
                       
                       // $mrksss=$review->marks*$mrksCount;

                       if($mrksCount==0){
                        $mrksCount=1;
                      }
                      $mrsToShow=round($mrksSum/$mrksCount); ?>                           
          
                    <span class="text-success">({{$mrsToShow}} of {{DB::table('survey_marks')->where('survey_id',$survey->id)->where('question_id',$question->id)->value('marks')}} marks)</span>
<span class="">This question has <b>{{DB::table('reply_points')->where('question_id',$question->id)->count()}}</b> responses</span>
                    <br><br>
                     @endif


                     @if($question->reply_mode==6)
              <span class="ml-2">This question has <b>{{DB::table('reply_date')->where('question_id',$question->id)->count()}}</b> responses</span>
             
<br><br>
                     @endif
                    </div>
                  </div>
                </div>
              </div>

            </div>
              @endforeach
        </div>
			</div>
		</body>
</html>