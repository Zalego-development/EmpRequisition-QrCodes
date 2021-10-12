<!DOCTYPE html>
<html>
<head>
  <title>Zalego | ERP</title>
<style type="text/css">
  td, th{
    padding: 6px !important;
  }
</style>
</head>
<body>
 
  <table>
     <thead>
                      <tr>
                        <th colspan="8">LEADS RECORDS - {{date('Y-m-d')}} - {{date('h:i:s A')}}</th>
                        
                      </tr>
                    </thead>
  </table>
              <div class="table-responsive">
               <table class="table table-striped" id="student_leads">
            <thead>
              <tr>
                <th>#</th>
                <th>Lead_id</th>
                <th>Completion_status</th>
                <th>Stage_id</th>
                <th>Fail_id</th>
                <th>Source_Category</th>
                <th>Names</th>
                <th>Email</th>
                <th>Contact</th>
                <th>Gender</th>
                <th>Intake</th>
                <th>Applied on</th>
                <th>Call_stage</th>
                <th>First_call_comments</th>
                <th>Follow_up_call_comments</th>
                <th>Closing_call_comments</th>
                <th>Last_comments</th>
                <th>Next_call_date</th>
              </tr>
            </thead>
            <?php
              $counter=1;
            ?>
             @if(!empty($applications))
            @forelse($applications as $app2)
              <tr>
                <td>{{$counter++}}</td>
                <td>{{$app2->customer}}</td>
                 <td>{{$app2->completion}}</td>
                 <td>{{$app2->call_stage}}</td>
                 <td>0</td>
                 <td>
                  @if($app2->source_category==1)
                     <strong class="text-muted">Walk ins'</strong>
                  @elseif($app2->source_category==2)
                     <strong class="text-warning">CSV Upload</strong>
                  @elseif($app2->source_category==3)
                      <strong class="text-info">Ambassador App</strong>
                  @elseif($app2->source_category==0)
                     <strong class="text-success">Website</strong>
                  @endif
                </td>
                <td>{{$app2->name}}</td>
                <td>{{$app2->email}}</td>
                <td>{{$app2->phonenumber}}</td>
                <td>{{$app2->gender}}</td>
                <td>{{$app2->intake}}</td>
                <td>{{$app2->created_at}}</td>
                <td>
                   @if($app2->call_stage==0)
                                 <strong class="text-secondary"> First call</strong>
                                  @elseif($app2->call_stage==2)
                                  <strong class="text-warning">Follow up call</strong>
                                  @elseif($app2->call_stage==3)
                                  <strong class="text-success">Closing call</strong>
                                  @endif
                </td>
                <td>
                  {{$app2->stage1_comment}}
                </td>
                <td>
                  {{$app2->stage2_comment}}
                </td>
                <td>
                  {{$app2->stage3_comment}}
                </td>
                <td>
                  {{$app2->last_comment}}
                </td>
                 <td>
                  {{$app2->next_date}}
                </td>
              
              </tr>
            @empty
              <tr>
                <td colspan="9">
                    <div class="py-5" id="noneItem">
                                  <center style="color:  #b3cccc !important;">
                                    <i class="fas fa-file fa-5x"></i>
                                    <i class="fas fa-times fa-2x" style="z-index: 9999; color: #fff; margin-left: -25px;"></i>
                                    <br>
                                    <h6>You do not have any applications at the moment</h6>
                                   
                                  </center>
                              </div>
                </td>
              </tr>
            @endforelse
            
            @endif
             
          </table>
              </div>
             
</body>
</html>