@extends('layouts.employee')

@section('content')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/mainlrs2.css')}}">
<style type="text/css">
.label-input100 {
font-family: 'Google Sans',Roboto,Arial,sans-serif;
font-size: 15px !important;
line-height: 26px;
color: #1F2D3D !important;
}
.wrap-input100 {
    margin-bottom: 5px !important;
    }

 #glyphicon { margin-right:5px;}
.rating #glyphicon {font-size: 12px;}
.rating-num { margin-top:0px;font-size: 54px; }
.progress { margin-bottom: 5px;height:5px;}
.progress-bar { text-align: left; }
.rating-desc .col-md-3 {padding-right: 0px;}
.sr-only { margin-top: 5px;overflow: visible;clip: auto; color:#f96f34;}
.input100 {
font-size: 13px !important;
  }
</style>
<script src="{{asset('assets/libs/js/Chart.js')}}"></script>
<script src="https://cdn.jsdelivr.net/gh/emn178/chartjs-plugin-labels/src/chartjs-plugin-labels.js"></script>
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
                <a href="{{url('/viewResponse/'.$survey->id)}}"><button class="btn btn-primary">
               <i class="fa fa-cog"></i> Refresh</button></a>
        </div>
                       
          </div><!-- /.col -->
    
        </div><!-- /.row -->

      </div><!-- /.container-fluid -->
    </div>

         <button class="btn btn-default shadow-lg ml-4" onclick='$("#existingTemplate").slideIn();$("#newTemplate").hide();$("#ranking").hide();'><i class="fa fa-area-chart"></i> Survey responses<sup class="text-primary">
          <strong class="badge badge-default shadow-lg">{{$responses}}</strong></sup></button>&nbsp
          <!-- <button class="btn  btn-default shadow-lg ml-2" onclick='$("#newTemplate").slideToggle();$("#existingTemplate").hide();$("#ranking").hide();'><i class="fas fa-list text-success"></i> Detailed responses <sup class="text-success">
          <strong class="badge badge-default bg-white shadow-lg">{{$responses}}</strong></sup></button> -->
<br><br>

    <!-- /.content-header -->
  <section class="container px-3 py-3 ml-2 mr-3">
    <!-- <section class="content"> -->
        <!-- <div class="container-fluid"> -->
           
    <div class="table-responsive" id="">

  <div id="existingTemplate">
        
              <div class="card bg-white px-3 py-3 shadow">
              <div class="card-header">
                <div class="row d-flex justify-content-between align-items-center">
                  <div>
                  <span class="label-input100" style="">About this survey</span>
                </div>
                  <div>
                    <span class="label-input100" style=""> {{$responses}} @if($responses=="0" || $responses=="1")response @else responses @endif</span>&nbsp;&nbsp;
                    <button type="button" class="btn bg-green" onclick="js:window.print()">
                                    <i class="fa fa-print"></i>
                                    Print
                                </button>
                  <a href="{{url('printResponse/'.$survey->id)}}"><button type="button" class="btn btn-primary" id="cmd">
                                    <i class="fa fa-file-pdf-o"></i> Download
                                </button></a>
                 </div>             
              </div></div>
             <div class="card-body bg-white">
                <div class="row">
                  <div class="wrap-input100 validate-input text-center" style="border-bottom: none !important; margin-bottom: 10px !important;">
                        <span class="label-input100">{{$survey->company}}</span>
                        <!-- <input type="name" class="input100 " readonly name="name" value="" readonly autocomplete="name">
                        <span class="focus-input100"></span> -->
                    </div>
                     <div class="wrap-input100 validate-input text-center" style="border-bottom: none !important; margin-bottom: 10px !important;">
                        <span class="label-input100" >Survey Name <span style="color: #1F2D3D !important;">: </span>{{$survey->survey_name}}</span>
                        <!-- <input type="name" class="input100 " readonly name="name" value="" readonly autocomplete="name">
                        <span class="focus-input100"></span> -->
                    </div><br>
                   <!-- <div class="wrap-input100 validate-input">
                        <span class="label-input100">Survey Name</span>
                        <input type="name" class="input100 " readonly name="name" value="{{$survey->survey_name}}" readonly autocomplete="name">
                        <span class="focus-input100"></span>
                    </div> -->
                    @if(!is_null($survey->survey_description))
                   <div class="wrap-input100 validate-input text-center" style="border-bottom: none !important; margin-bottom: 10px !important;">
                        <span class="label-input100" style="margin-bottom: 10px !important; font-size: 16px !important;">Survey Description</span><br>
                          <label style="color: #1F2D3D !important; font-weight:10 !important;font-size: 15px !important;" class="text-center text-muted label-input100">{{$survey->survey_description}}</label>
                        <!-- <input type="description" class="input100" readonly name="description" value="" readonly autocomplete="description" >
                        <span class="focus-input100"></span> -->
                    </div><br>
                    @endif
                </div>
              </div>
            </div>
            <?php $count=1; ?>
              @foreach($questions as $question)
              <div class="card bg-white px-3 py-3" id="initialCard1">
              <div class="card-header">
                <div class="row d-flex justify-content-between align-items-center">
                  <div>
                  <span class="label-input100" style="font-size:16px !importantl;">Question {{$count++}}</span>
                  </div>       
                </div>
              </div>
             <div class="card-body bg-white">
                <div class="row">
                   <div class="col-md-12">
                    <div class="wrap-input100 validate-input" style="border-bottom: none;">
                        <!-- <span class="label-input100">Question</span> -->
                        <input type="question" class="input100" id="select" readonly value="{{$question->question}}" autocomplete="question" >
                        <span class="focus-input100"></span>
                    </div>
                   </div>
               
                  <div class="col-12">
                   <div id="replFeedback0">

                    @if($question->reply_mode==1)
                        <div class="card collapsed-card" style="box-shadow: none !important;">
        <div class="card-header">
          <div class="card-title">
         <span class="ml-2">This question has <b>{{DB::table('reply_written')->where('question_id',$question->id)->count()}}</b> responses</span>
          </div>
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" style="box-shadow: none !important;">
              <i class="fa fa-eye text-default fa-2x" title="View Responses"></i> 
              <span class="text-default"> View responses</span>
            </button>
          </div>
        </div>
        <div class="card-body">
          <div class="modal-body">
          <div class="row">
          <div class="form-group col-md-12">

          <div class="col-md-12">
            <!-- DIRECT CHAT SUCCESS -->
            <div class="card card-sucress cardutline direct-chat direct-chat-success" style="box-shadow: none !important;">
              <!-- /.card-header -->
              <div class="card-body">
                <!-- Conversations are loaded here direct-chat-messages" style="max-height: 350px !important;" style="max-height: 350px !important;"-->
                <div class="direct-chat-messages" style="max-height: 350px !important;">
      
                    @foreach(DB::table('reply_written')->where('question_id',$question->id)->get() as $review)
                    <div class="direct-chat-msg">

                      <div class="direct-chat-infos clearfix">
                        <span class="direct-chat-name float-left">
                          @if(is_null($review->responder_id))
                          Anonymous feedback
                          {{DB::table('responder')->where('id',$review->responder_id)->value('name')}}
                          @else
                           {{DB::table('responder')->where('id',$review->responder_id)->value('name')}}
                           @endif
                        </span>
                        <span class="direct-chat-timestamp float-right">
                          {{date('d M Y h:i a', strtotime($review->created_at))}}
                        </span>
                      </div>
                        @if(is_null($review->responder_id))
                          <span class="direct-chat-img img-circle elevation-1 theme-green text-white px-3 py-3">
                           <strong style="color: #fff !important;">
                             <?php
                              echo "A";
                             ?>
                           </strong>
                         </span>
                        @else
                        <span class="direct-chat-img img-circle elevation-1 theme-green text-white px-3 py-3">
                           <strong style="color: #fff !important;">
                             <?php
                              echo substr(DB::table('responder')->where('id',$review->responder_id)->value('name'), 0, 2);
                             ?>
                           </strong>
                         </span>
                        @endif
                      <div class="direct-chat-text">
                        {!!$review->reply!!}
                        <br>

                      </div>
                      <!-- /.direct-chat-text -->
                    </div>
                    @endforeach
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              </div>  
              </div>
              </div>    
            </div>
                    @endif


                    @if($question->reply_mode==2)
                    <canvas id="myChart{{$question->id}}" style="height: 100px;"></canvas>
                    <script type="text/javascript">
                    var ctx = document.getElementById("myChart{{$question->id}}");
var myChart2 = new Chart(ctx, {
    type: 'doughnut',//specify the type of graph you want to deal with
    data: {
        labels: [
         <?php
            $category=DB::table('survey_answers')->where('question_id',$question->id)->get();
            foreach ($category as $category) {
              echo "'".$category->answer."',";
            }
          ?>
        ],//the labels of your graphs

        datasets: [{
            label: '# Dropdown replies',//what the user sees when he/she overs a given label
            data:[
           <?php
           $category=DB::table('survey_answers')->where('question_id',$question->id)->get();
             foreach ($category as $category) {
              $val=0;
              $val=DB::table('reply_choices')->where('choice_id',$category->id)->count();
             echo $val.",";
            }
          ?>
            ], //The data set of your graph
              backgroundColor: [
                'rgba(45, 185, 77, 0.4)', //the colors of your labels
                 'rgba(249, 111, 52, 0.2)',
                 'rgba(248, 140, 0, 0.2)',
                'rgba(255, 0, 23, 0.2)',
                'rgba(185, 110, 177, 0.2)', 
                'rgba(239, 212, 57, 0,2)',
                'rgba(36, 189, 15, 0.2)',
                'rgba(189, 15, 15, 0.2)',
                'rgba(15, 174, 189, 0.2)',
                'rgba(15, 36, 189, 0.2)',
                'rgba(15, 189, 166, 0.2)',
                'rgba(55, 47, 86, 0.2)',
                 'rgba(75, 192, 192, 0.2)',
                 'rgba(248, 140, 250, 0.2)',
                'rgba(248, 255, 136, 0.2)',
                'rgba(248, 66, 136, 0.2)',
                'rgba(255, 220, 255, 0.2)',
            ],

            borderColor: [
                'rgba(45, 185, 77,1)', //the color of the label borders 
                'rgba(249, 111, 52, 1)',
                 //the color of the label borders 
                'rgba(248, 140, 0, 1)', //the color of the label borders 
                'rgba(255, 0, 23, 1)', //the color of the label borders 
                'rgba(185, 110, 177, 1)', 
                'rgba(239, 212, 57, 1)',
                'rgba(36, 189, 15, 1)',
                'rgba(189, 15, 15, 1)',
                'rgba(15, 174, 189, 1)',
                'rgba(15, 36, 189, 1)',
                'rgba(15, 189, 166, 1)',
                'rgba(55, 47, 86, 1)',
                'rgba(75, 192, 192, 1)',
                 'rgba(248, 140, 250, 1)',
                 'rgba(248, 255, 136, 1)',
                 'rgba(248, 66, 136, 1)',
                 'rgba(255, 220, 255, 1)',
            ], 
          
            borderWidth: 1
        }]
    }, options: {
        responsive: true,
        legend: {
          position: "left",
            align: "middle"
        },
        pieceLabel: {
        mode: 'percentage', 
        precision: 2
    },
        scales: {
            xAxes: [{
              ticks: {
                    display: false, // specifies where the ticks will begin at
                },
            gridLines: {
                 drawBorder: false,
                display: false
            }
        }],
            yAxes: [{
                ticks: {
                    display: false, // specifies where the ticks will begin at
                },
                  gridLines: {
                 drawBorder: false,
                display: false
            },
               
            }],

        }
    }
    
});
                    </script>
                  <div class="card collapsed-card" style="box-shadow: none !important;">
                    <div class="card-header">
                      <div class="card-title">
                     <span class="ml-2">This question has <b>{{DB::table('reply_choices')->where('question_id',$question->id)->count()}}</b> responses</span>
                      </div>
                      <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" style="box-shadow: none !important;">
                          <i class="fa fa-eye text-default fa-2x" title="View Responses"></i> 
                          <span class="text-default"> View responses</span>
                        </button>
                      </div>
                    </div>
                    <div class="card-body">
                      <div class="modal-body">
                      <div class="row">
                      <div class="form-group col-md-12">

                      <div class="col-md-12">
                        <!-- DIRECT CHAT SUCCESS -->
                        <div class="card card-sucress cardutline direct-chat direct-chat-success" style="box-shadow: none !important;">
                          <!-- /.card-header -->
                          <div class="card-body">
                            <!-- Conversations are loaded here -->
                            <div class="direct-chat-messages" style="max-height: 350px !important;">
                  
                                @foreach(DB::table('survey_answers')->where('question_id',$question->id)->get() as $review)
                                <div class="direct-chat-msg">

                                  <div class="direct-chat-text" style="border:none !important">
                                    <?php $rcount2=DB::table('reply_choices')->where('question_id',$question->id)->where('choice_id',$review->id)->count(); ?>
                                    {!!$review->answer!!} <span class="text-success">({{$rcount2}} @if($rcount2>1) responses @else response @endif)</span>
                                    <br>

                                  </div>
                                  <!-- /.direct-chat-text -->
                                </div>
                                @endforeach
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          </div>  
                          </div>
                          </div>    
                        </div>

                      @endif

                      @if($question->reply_mode==3)
                      <canvas id="myCharts{{$question->id}}" height="100px"></canvas>
                    <script type="text/javascript">
                    var ctx = document.getElementById("myCharts{{$question->id}}");
var myChart2 = new Chart(ctx, {
    type: 'pie',//specify the type of graph you want to deal with
    data: {
        labels: [
         <?php
            $category=DB::table('survey_answers')->where('question_id',$question->id)->get();
            foreach ($category as $category) {
              echo "'".$category->answer."',";
            }
          ?>
        ],//the labels of your graphs

        datasets: [{
            label: '# Dropdown replies',//what the user sees when he/she overs a given label
            data:[
           <?php
           $category=DB::table('survey_answers')->where('question_id',$question->id)->get();
             foreach ($category as $category) {
              $val=0;
              $val=DB::table('reply_choices')->where('choice_id',$category->id)->count();
             echo $val.",";
            }
          ?>
            ], //The data set of your graph
              backgroundColor: [
                'rgba(45, 185, 77, 0.4)', //the colors of your labels
                 'rgba(249, 111, 52, 0.2)',
                 'rgba(248, 140, 0, 0.2)',
                'rgba(255, 0, 23, 0.2)',
                'rgba(185, 110, 177, 0.2)', 
                'rgba(239, 212, 57, 0,2)',
                'rgba(36, 189, 15, 0.2)',
                'rgba(189, 15, 15, 0.2)',
                'rgba(15, 174, 189, 0.2)',
                'rgba(15, 36, 189, 0.2)',
                'rgba(15, 189, 166, 0.2)',
                'rgba(55, 47, 86, 0.2)',
                 'rgba(75, 192, 192, 0.2)',
                 'rgba(248, 140, 250, 0.2)',
                'rgba(248, 255, 136, 0.2)',
                'rgba(248, 66, 136, 0.2)',
                'rgba(255, 220, 255, 0.2)',
            ],

            borderColor: [
                'rgba(45, 185, 77,1)', //the color of the label borders 
                'rgba(249, 111, 52, 1)',
                 //the color of the label borders 
                'rgba(248, 140, 0, 1)', //the color of the label borders 
                'rgba(255, 0, 23, 1)', //the color of the label borders 
                'rgba(185, 110, 177, 1)', 
                'rgba(239, 212, 57, 1)',
                'rgba(36, 189, 15, 1)',
                'rgba(189, 15, 15, 1)',
                'rgba(15, 174, 189, 1)',
                'rgba(15, 36, 189, 1)',
                'rgba(15, 189, 166, 1)',
                'rgba(55, 47, 86, 1)',
                'rgba(75, 192, 192, 1)',
                 'rgba(248, 140, 250, 1)',
                 'rgba(248, 255, 136, 1)',
                 'rgba(248, 66, 136, 1)',
                 'rgba(255, 220, 255, 1)',
            ], 
          
            borderWidth: 1
        }]
    }, options: {
        responsive: true,
        legend: {
            position: "left",
            align: "middle"
        },
           pieceLabel: {
        mode: 'percentage', 
        precision: 2
    },
        scales: {
            xAxes: [{
              ticks: {
                    display: false, // specifies where the ticks will begin at
                },
            gridLines: {
                 drawBorder: false,
                display: false
            }
        }],
            yAxes: [{
                ticks: {
                    display: false, // specifies where the ticks will begin at
                },
                  gridLines: {
                 drawBorder: false,
                display: false
            },
               
            }],

        }
    }
    
});
                    </script>
                  <div class="card collapsed-card" style="box-shadow: none !important;">
                    <div class="card-header">
                      <div class="card-title">
                     <span class="ml-2">This question has <b>{{DB::table('reply_choices')->where('question_id',$question->id)->count()}}</b> responses</span>
                      </div>
                      <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" style="box-shadow: none !important;">
                          <i class="fa fa-eye text-default fa-2x" title="View Responses"></i> 
                          <span class="text-default"> View responses</span>
                        </button>
                      </div>
                    </div>
                    <div class="card-body">
                      <div class="modal-body">
                      <div class="row">
                      <div class="form-group col-md-12">

                      <div class="col-md-12">
                        <!-- DIRECT CHAT SUCCESS -->
                        <div class="card card-sucress cardutline direct-chat direct-chat-success" style="box-shadow: none !important;">
                          <!-- /.card-header -->
                          <div class="card-body">
                            <!-- Conversations are loaded here -->
                            <div class="direct-chat-messages" style="max-height: 350px !important;">
                  
                                          <?php $qcount1=1; ?>
                                @foreach(DB::table('survey_answers')->where('question_id',$question->id)->get() as $review)
                                <div class="direct-chat-msg">

                                  <div class="direct-chat-infos clearfix">
                                    
                                  </div>
                                      <span class="direct-chat-img img-circle elevation-1 px-3 py-3" style="height: 1px !important;width: 1px !important;">
                                      <!-- <input type="checkbox" style="margin-top: 20px; margin-left: 15px;" disabled> -->
                                     </span>
                                  <div class="direct-chat-text" style="border:none !important">
                                    <?php $rcount1=DB::table('reply_choices')->where('question_id',$question->id)->where('choice_id',$review->id)->count(); ?>
                                    {!!$review->answer!!} <span class="text-success">({{$rcount1}} @if($rcount1>1) responses @else response @endif)</span>
                                    <br>

                                  </div>
                                  <!-- /.direct-chat-text -->
                                </div>
                                @endforeach
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          </div>  
                          </div>
                          </div>    
                        </div>

                      @endif

                       @if($question->reply_mode==7)
                      <canvas id="myChartx{{$question->id}}" height="100px"></canvas>
                    <script type="text/javascript">
                    var ctx = document.getElementById("myChartx{{$question->id}}");
var myChart2 = new Chart(ctx, {
    type: 'pie',//specify the type of graph you want to deal with
    data: {
        labels: [
         <?php
            $category=DB::table('survey_answers')->where('question_id',$question->id)->get();
            foreach ($category as $category) {
              echo "'".$category->answer."',";
            }
          ?>
        ],//the labels of your graphs

        datasets: [{
            label: '# Checkbox replies',//what the user sees when he/she overs a given label
            data:[
           <?php
           $category=DB::table('survey_answers')->where('question_id',$question->id)->get();
             foreach ($category as $category) {
              $val=0;
              $val=DB::table('reply_choices')->where('choice_id',$category->id)->count();
             echo $val.",";
            }
          ?>
            ], //The data set of your graph
              backgroundColor: [
                'rgba(45, 185, 77, 0.4)', //the colors of your labels
                 'rgba(249, 111, 52, 0.2)',
                 'rgba(248, 140, 0, 0.2)',
                'rgba(255, 0, 23, 0.2)',
                'rgba(185, 110, 177, 0.2)', 
                'rgba(239, 212, 57, 0,2)',
                'rgba(36, 189, 15, 0.2)',
                'rgba(189, 15, 15, 0.2)',
                'rgba(15, 174, 189, 0.2)',
                'rgba(15, 36, 189, 0.2)',
                'rgba(15, 189, 166, 0.2)',
                'rgba(55, 47, 86, 0.2)',
                 'rgba(75, 192, 192, 0.2)',
                 'rgba(248, 140, 250, 0.2)',
                'rgba(248, 255, 136, 0.2)',
                'rgba(248, 66, 136, 0.2)',
                'rgba(255, 220, 255, 0.2)',
            ],

            borderColor: [
                'rgba(45, 185, 77,1)', //the color of the label borders 
                'rgba(249, 111, 52, 1)',
                 //the color of the label borders 
                'rgba(248, 140, 0, 1)', //the color of the label borders 
                'rgba(255, 0, 23, 1)', //the color of the label borders 
                'rgba(185, 110, 177, 1)', 
                'rgba(239, 212, 57, 1)',
                'rgba(36, 189, 15, 1)',
                'rgba(189, 15, 15, 1)',
                'rgba(15, 174, 189, 1)',
                'rgba(15, 36, 189, 1)',
                'rgba(15, 189, 166, 1)',
                'rgba(55, 47, 86, 1)',
                'rgba(75, 192, 192, 1)',
                 'rgba(248, 140, 250, 1)',
                 'rgba(248, 255, 136, 1)',
                 'rgba(248, 66, 136, 1)',
                 'rgba(255, 220, 255, 1)',
            ],           
            borderWidth: 1
        }]
    }, options: {
        responsive: true,
        legend: {
            position: "left",
            align: "middle"
        },
           pieceLabel: {
        mode: 'percentage', 
        precision: 2
    },
        scales: {
            xAxes: [{
              ticks: {
                    display: false, // specifies where the ticks will begin at
                },
            gridLines: {
                 drawBorder: false,
                display: false
            }
        }],
            yAxes: [{
                ticks: {
                    display: false, // specifies where the ticks will begin at
                },
                  gridLines: {
                 drawBorder: false,
                display: false
            },
               
            }],

        }
    }
    
});
                    </script>
                  <div class="card collapsed-card" style="box-shadow: none !important;">
                    <div class="card-header">
                      <div class="card-title">
                     <span class="ml-2">This question has <b>{{DB::table('reply_choices')->where('question_id',$question->id)->groupBy('responder_id')->count()}}</b> responses</span>
                      </div>
                      <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" style="box-shadow: none !important;">
                          <i class="fa fa-eye text-default fa-2x" title="View Responses"></i> 
                          <span class="text-default"> View responses</span>
                        </button>
                      </div>
                    </div>
                    <div class="card-body">
                      <div class="modal-body">
                      <div class="row">
                      <div class="form-group col-md-12">

                      <div class="col-md-12">
                        <!-- DIRECT CHAT SUCCESS -->
                        <div class="card card-sucress cardutline direct-chat direct-chat-success" style="box-shadow: none !important;">
                          <!-- /.card-header -->
                          <div class="card-body">
                            <!-- Conversations are loaded here -->
                            <div class="direct-chat-messages" style="max-height: 350px !important;">
                                <?php $qcount=1; ?>
                                @foreach(DB::table('survey_answers')->where('question_id',$question->id)->get() as $review)
                                <div class="direct-chat-msg">

                                  <div class="direct-chat-infos clearfix">
                                    
                                  </div>
                                      <span class="direct-chat-img img-circle elevation-1 px-3 py-3" style="height: 1px !important;width: 1px !important;border-radius: 1% !important;">
                                      <!-- <input type="checkbox" style="margin-top: 20px; margin-left: 15px;" disabled> -->
                                     </span>
                                  <div class="direct-chat-text" style="border:none !important">
                                    <?php $rcount=DB::table('reply_choices')->where('question_id',$question->id)->where('choice_id',$review->id)->count(); ?>
                                    {!!$review->answer!!} <span class="text-success">({{$rcount}} @if($rcount>1) responses @else response @endif)</span>
                                    <br>

                                  </div>
                                  <!-- /.direct-chat-text -->
                                </div>
                                @endforeach
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          </div>  
                          </div>
                          </div>    
                        </div>

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
                          <?php  } ?> &nbsp; <span>({{$mrsToShow}} stars)</span>

                          <div class="card collapsed-card" style="box-shadow: none !important;">
                    <div class="card-header">
                      <div class="card-title">
                     <span class="">This question has <b>{{DB::table('reply_points')->where('question_id',$question->id)->count()}}</b> responses</span>
                      </div>
                      <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" style="box-shadow: none !important;">
                          <i class="fa fa-eye text-default fa-2x" title="View Responses"></i> 
                          <span class="text-default"> View responses</span>
                        </button>
                      </div>
                    </div>
                    <div class="card-body">
                      <div class="modal-body">
                      <div class="row">
                      <div class="form-group col-md-12">

                      <div class="col-md-12">
                        <!-- DIRECT CHAT SUCCESS -->
                        <div class="card card-sucress cardutline direct-chat direct-chat-success" style="box-shadow: none !important;">
                          <!-- /.card-header -->
                          <div class="card-body">
                            <!-- Conversations are loaded here -->
                            <div class="direct-chat-messages" style="max-height: 350px !important;">
                  
                                @foreach(DB::table('reply_points')->where('reply_points.question_id',$question->id)->get() as $review)
                                <div class="direct-chat-msg">

                                  <div class="direct-chat-infos clearfix">
                                    <span class="direct-chat-name float-left">
                                      @if(is_null($review->responder_id))
                                      Anonymous feedback
                                      @else
                                       {{DB::table('responder')->where('id',$review->responder_id)->value('name')}}
                                       @endif
                                    </span>
                                    <span class="direct-chat-timestamp float-right">
                                      {{date('d M Y h:i a', strtotime($review->created_at))}}
                                    </span>
                                  </div>
                                    @if(is_null($review->responder_id))
                                      <span class="direct-chat-img img-circle elevation-1 theme-green text-white px-3 py-3">
                                       <strong style="color: #fff !important;">
                                         <?php
                                          echo "A";
                                         ?>
                                       </strong>
                                     </span>
                                    @else
                                    <span class="direct-chat-img img-circle elevation-1 theme-green text-white px-3 py-3">
                                       <strong style="color: #fff !important;">
                                         <?php
                                          echo substr(DB::table('responder')->where('id',$review->responder_id)->value('name'), 0, 2);
                                         ?>
                                       </strong>
                                     </span>
                                    @endif
                                  <div class="direct-chat-text">
                                    <div class="rating">
                                    <?php 
                                    $rates=$review->marks;
                                    $empty=5-$rates;
                                   for ($i=1; $i <= $rates; $i++) { 
                                    ?>
                                      <span class="fas fa-star fa-sm" style="color:#f96f34 !important;" id="glyphicon"></span>
                                    <?php  } ?>
                                    <?php 
                                    for ($i=1; $i <= $empty; $i++) { 
                                    ?>
                                      <span class="fas fa-star fa-sm" id="glyphicon"></span>
                                    <?php  } ?>  
                                  </div> 
                                  </div>
                                  <!-- /.direct-chat-text -->
                                </div>
                                @endforeach
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          </div>  
                          </div>
                          </div>    
                        </div>

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

                          <div class="card collapsed-card" style="box-shadow: none !important;">
                    <div class="card-header">
                      <div class="card-title">
                     <span class="">This question has <b>{{DB::table('reply_points')->where('question_id',$question->id)->count()}}</b> responses</span>
                      </div>
                      <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="View Responses" style="box-shadow: none !important;">
                          <i class="fa fa-eye text-default fa-2x" title="View Responses"></i> 
                          <span class="text-default"> View responses</span>
                        </button>
                      </div>
                    </div>
                    <div class="card-body">
                      <div class="modal-body">
                      <div class="row">
                      <div class="form-group col-md-12">

                      <div class="col-md-12">
                        <!-- DIRECT CHAT SUCCESS -->
                        <div class="card card-sucress cardutline direct-chat direct-chat-success" style="box-shadow: none !important;">
                          <!-- /.card-header -->
                          <div class="card-body">
                            <!-- Conversations are loaded here -->
                            <div class="direct-chat-messages" style="max-height: 350px !important;">
                  
                                @foreach(DB::table('reply_points')->where('reply_points.question_id',$question->id)->get() as $review)
                                <div class="direct-chat-msg">

                                  <div class="direct-chat-infos clearfix">
                                    <span class="direct-chat-name float-left">
                                      @if(is_null($review->responder_id))
                                      Anonymous feedback
                                      @else
                                       {{DB::table('responder')->where('id',$review->responder_id)->value('name')}}
                                       @endif
                                    </span>
                                    <span class="direct-chat-timestamp float-right">
                                      {{date('d M Y h:i a', strtotime($review->created_at))}}
                                    </span>
                                  </div>
                                    @if(is_null($review->responder_id))
                                      <span class="direct-chat-img img-circle elevation-1 theme-green text-white px-3 py-3">
                                       <strong style="color: #fff !important;">
                                         <?php
                                          echo "A";
                                         ?>
                                       </strong>
                                     </span>
                                    @else
                                    <span class="direct-chat-img img-circle elevation-1 theme-green text-white px-3 py-3">
                                       <strong style="color: #fff !important;">
                                         <?php
                                          echo substr(DB::table('responder')->where('id',$review->responder_id)->value('name'), 0, 2);
                                         ?>
                                       </strong>
                                     </span>
                                    @endif
                                  <div class="direct-chat-text">
                                    <span class="text-success">({{$review->marks}} of {{DB::table('survey_marks')->where('survey_id',$survey->id)->where('question_id',$question->id)->value('marks')}} marks)</span>

                                  </div>
                                  <!-- /.direct-chat-text -->
                                </div>
                                @endforeach
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          </div>  
                          </div>
                          </div>    
                        </div>
                     @endif


                     @if($question->reply_mode==6)
              
                          <div class="card collapsed-card" style="box-shadow: none !important;">
        <div class="card-header">
          <div class="card-title">
         <span class="ml-2">This question has <b>{{DB::table('reply_date')->where('question_id',$question->id)->count()}}</b> responses</span>
          </div>
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" style="box-shadow: none !important;">
              <i class="fa fa-eye text-default fa-2x" title="View Responses"></i> 
              <span class="text-default"> View responses</span>
            </button>
          </div>
        </div>
        <div class="card-body">
          <div class="modal-body">
          <div class="row">
          <div class="form-group col-md-12">

          <div class="col-md-12">
            <!-- DIRECT CHAT SUCCESS -->
            <div class="card card-sucress cardutline direct-chat direct-chat-success" style="box-shadow: none !important;">
              <!-- /.card-header -->
              <div class="card-body">
                <!-- Conversations are loaded here -->
                <div class="direct-chat-messages" style="max-height: 350px !important;">
      
                    @foreach(DB::table('reply_date')->where('question_id',$question->id)->get() as $review)
                    <div class="direct-chat-msg">

                      <div class="direct-chat-infos clearfix">
                        <span class="direct-chat-name float-left">
                          @if(is_null($review->responder_id))
                          Anonymous feedback
                          @else
                           {{DB::table('responder')->where('id',$review->responder_id)->value('name')}}
                           @endif
                        </span>
                        <span class="direct-chat-timestamp float-right">
                          {{date('d M Y h:i a', strtotime($review->created_at))}}
                        </span>
                      </div>
                        @if(is_null($review->responder_id))
                          <span class="direct-chat-img img-circle elevation-1 theme-green text-white px-3 py-3">
                           <strong style="color: #fff !important;">
                             <?php
                              echo "A";
                             ?>
                           </strong>
                         </span>
                        @else
                        <span class="direct-chat-img img-circle elevation-1 theme-green text-white px-3 py-3">
                           <strong style="color: #fff !important;">
                             <?php
                              echo substr(DB::table('responder')->where('id',$review->responder_id)->value('name'), 0, 2);
                             ?>
                           </strong>
                         </span>
                        @endif
                      <div class="direct-chat-text">
                        {{date('d M Y', strtotime($review->date))}}
                        <br>

                      </div>
                      <!-- /.direct-chat-text -->
                    </div>
                    @endforeach
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              </div>  
              </div>
              </div>    
            </div>

                     @endif
                    </div>
                  </div>
                </div>
              </div>

            </div>
              @endforeach
        </div>
<div id="editor"></div>
<div id="newTemplate" style="display:none">
  


</div>
            </div>

        <br>
    </section>
     


</div>
<script type="text/javascript">

    var doc = new jsPDF();
    var specialElementHandlers = {
        '#editor': function (element, renderer) {
            return true;
        }
    };

    $('#cmd').click(function () {
        doc.fromHTML($('#existingTemplate').html(), 15, 15, {
            'width': 170,
                'elementHandlers': specialElementHandlers
        });
        doc.save('sample-file.pdf');
    });

</script>
@endsection

