<section class="container card px-3 py-3">
<div class="table-responsive">
<table class="table table-striped" id="student_leads">
            <thead>
              <tr>
                <th><input type="checkbox" onclick="toggle(this)"></th>
                <th>#</th>
                <th>LeadSource</th>
                <th>Names</th>
                <th>Email</th>
                <th>Contact</th>
                <th>Gender</th>
                <th>Intake</th>
                <th>Course</th>
                <th>AppliedOn</th>
                <th>Actions</th>
              </tr>
            </thead>
           
            
              <tr>
                <td><input type="checkbox" name="checks[]" value="{{$app2->id}}" class="sels"></td>
               
                <td>{{$counter++}}</td>
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
                <td>
                  <?php
                    $cat= str_replace(",", '<br>', $app2->category);
                    $cat= str_replace('_', " ", $cat);
                    echo str_replace('"', "", $cat);
                  ?>
               </td>
                <td>{{$app2->created_at}}</td>
                <td><div class="dropdown">
  <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
   <i class="fas fa-ellipsis-v"></i> Actions
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
    <a class="dropdown-item" href="{{url('/addLead/'.$app2->id)}}"><i class="fas fa-plus-circle"></i> Add as my lead</a>
  </div>
</div></td>
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
      
      </section>