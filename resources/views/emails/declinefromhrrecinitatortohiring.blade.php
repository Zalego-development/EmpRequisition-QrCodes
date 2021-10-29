<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <meta name="x-apple-disable-message-reformatting">
  <title></title>
  <!--[if mso]>
  <noscript>
    <xml>
      <o:OfficeDocumentSettings>
        <o:PixelsPerInch>96</o:PixelsPerInch>
      </o:OfficeDocumentSettings>
    </xml>
  </noscript>
  <![endif]-->
  <style>
    table, td, div, h1, p {font-family: Arial, sans-serif;}
  </style>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
<body style="margin:0;padding:0;">
  <table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;background:#ffffff;">
    <tr>
      <td align="center" style="padding:0;">
        <table role="presentation" style="width:602px;border-collapse:collapse;border:1px solid #cccccc;border-spacing:0;text-align:left;">
          <tr>
            <td align="center" style="padding:20px 0 15px 0;background:orange;">
              <h2 style="color: #ffffff">Recruitment Request</h2>
              <h4 style="color: #ffffff">Recruitment Team</h4>
            </td>
          </tr>
          <tr>
            <td style="padding:36px 30px 42px 30px;">
              <table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;">
                <tr>
                  <td style="padding:0 0 36px 0;color:#153643;">
                    <p style="margin:0 0 12px 0;font-size:12px;line-height:16px;font-family:Arial,sans-serif;">An Employee Requisition request with the following details has been sent to your review and action</p>
                    <h6 style="font-size:24px;margin:0 0 20px 0;font-family:Arial,sans-serif;">Job Tittle::{{ $data['jobtittle'] }}</h6>
                    <p style="margin:0 0 12px 0;font-size:12px;line-height:24px;font-family:Arial,sans-serif;">Job Description::{!! $data['jobdescription'] !!}</p>
                    <p style="margin:0;font-size:12px;line-height:24px;font-family:Arial,sans-serif;">Key Responsbilities:{!! $data['responsibilities'] !!}</p>
                  </td>
                </tr>
                <tr>
                  <td style="padding:0;">
                    <table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;">
                      <tr>
                        
                          <td style="width:260px;padding:0;vertical-align:top;color:#153643;">
                          <p style="margin:0 0 12px 0;font-size:12px;line-height:14px;font-family:Arial,sans-serif;">Budgeted salary:{{ $data['salary'] }}</p>
                          <p style="margin:0 0 12px 0;font-size:12px;line-height:14px;font-family:Arial,sans-serif;">No of Positions::{{ $data['positions'] }}</p>
                          <p style="margin:0 0 12px 0;font-size:12px;line-height:14px;font-family:Arial,sans-serif;">Location:{{ $data['location'] }}</p>
                          <p style="margin:0 0 12px 0;font-size:12px;line-height:14px;font-family:Arial,sans-serif;">Position Type::{{ $data['employementtype'] }}</p>
                          <p style="margin:0 0 12px 0;font-size:12px;line-height:14px;font-family:Arial,sans-serif;">Levels. of Interviews:: @foreach( $data['interviews']  as $intent)
                                      <ul><li>{{ $intent }}</li></ul>
                                       
                                      
                                        @endforeach</p>
                           <p style="margin:0 0 12px 0;font-size:12px;line-height:14px;font-family:Arial,sans-serif;">Job Category::{{ $data['jobcategory'] }}</p>
                        </td>
                        <td style="width:20px;padding:0;font-size:0;line-height:0;">&nbsp;</td>
                        <td style="width:260px;padding:0;vertical-align:top;color:#153643;">         
                      <p style="margin:0 0 12px 0;font-size:12px;line-height:14px;font-family:Arial,sans-serif;">Target People::
                                  
                                    @foreach( $data['intenting']  as $intent)
                                      {{ $intent }}
                                        @endforeach
                                      </p>
                          <p style="margin:0 0 12px 0;font-size:12px;line-height:14px;font-family:Arial,sans-serif;">Projecetd Starting date::{{ $data['startdate'] }}</p>
                          <p style="margin:0 0 12px 0;font-size:12px;line-height:14px;font-family:Arial,sans-serif;">Can PWD apply?:: {{ $data['pwd'] }}</p>
                            @php
                                                        $manager1=DB::table('employeerequisitions')

                                    ->where('id', $data['id'] )
                                    ->first();
                              $manager=DB::table('users')
                                          ->where('id', $manager1->manager)
                                          ->first();
                             @endphp
                           <p style="margin:0 0 12px 0;font-size:12px;line-height:14px;font-family:Arial,sans-serif;">Manager To Report to:: {{ $manager->name }}</p>
                             @php
                             $company=DB::table('requsitionsapprovals')
                                      ->join('companies', 'companies.id' ,'=' , 'requsitionsapprovals.company_id')
                                      ->where('requsitionsapprovals.company_id', $data['company_id'])
                                      ->first();
                             @endphp
                           <p style="margin:0 0 12px 0;font-size:12px;line-height:14px;font-family:Arial,sans-serif;">Company Name:: {{ $company->company }}</p>
                       
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>
              </table>
            </td>
          </tr>
           <table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;background:#ffffff;">
        <tr>
            <td align="center" style="padding:0; background: black; color: white;" >
               Action History
            </td>
        </tr>
    </table>
    <table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;background:#ffffff;">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">&nbsp;</th>
       <th scope="col">&nbsp;</th>
      <th scope="col">Name</th>
      <th scope="col"></th>
       <th scope="col"></th>
      <th scope="col">Role</th>
      <th scope="col">&nbsp;</th>
       <th scope="col">&nbsp;</th>
        <th scope="col">&nbsp;</th>
       <th scope="col">&nbsp;</th>
      <th scope="col">Action</th>
      <th scope="col">&nbsp;</th>
       <th scope="col">&nbsp;</th>
        <th scope="col">&nbsp;</th>
       <th scope="col">&nbsp;</th>
      <th scope="col">Date</th>
    </tr>
  </thead>
  <tbody>
    <tr>
                              @php
                               $count = 1;
                        $approvers=DB::table('employeerequisitionusers')
                                  ->join('users', 'users.id', '=', 'employeerequisitionusers.userId')
                                  ->where('employeerequisitionusers.employeetype', '!=', 'HR Recruitment Team')
                                  ->orderBy('employeerequisitionusers.created_at', 'asc')
                                   ->get()
                                   ->toArray();
                        $recruitemntapprover=DB::table('requsitionsapprovals')
                                            ->join('employeerequisitionusers', 'employeerequisitionusers.userId', '=', 'requsitionsapprovals.userId')
                                            ->select('requsitionsapprovals.userId','employeerequisitionusers.employeetype', 'requsitionsapprovals.jobid', 'requsitionsapprovals.date','requsitionsapprovals.userId')
                                            ->where('requsitionsapprovals.jobid', $data['id'])
                                            ->where('employeerequisitionusers.employeetype', 'HR Recruitment Team')
                                            ->first();
                          $hrapprover=DB::table('requisitionsdeclines')
                                            ->join('employeerequisitionusers', 'employeerequisitionusers.userId', '=', 'requisitionsdeclines.userId')
                                            ->select('requisitionsdeclines.userId','employeerequisitionusers.employeetype', 'requisitionsdeclines.jobid', 'requisitionsdeclines.date')
                                            ->where('requisitionsdeclines.jobid', $data['id'])
                                            ->where('employeerequisitionusers.employeetype', 'HR Manager')
                                            ->first();
                   $leadapprover=DB::table('requsitionsapprovals')
                                            ->join('employeerequisitionusers', 'employeerequisitionusers.userId', '=', 'requsitionsapprovals.userId')
                                            ->select('requsitionsapprovals.userId','employeerequisitionusers.employeetype', 'requsitionsapprovals.jobid','requsitionsapprovals.date')
                                            ->where('requsitionsapprovals.jobid', $data['id'])
                                            ->where('employeerequisitionusers.employeetype', 'Executive Lead')
                                            ->first();
                   $ceoapprover=DB::table('requsitionsapprovals')
                                            ->join('employeerequisitionusers', 'employeerequisitionusers.userId', '=', 'requsitionsapprovals.userId')
                                            ->select('requsitionsapprovals.userId','employeerequisitionusers.employeetype', 'requsitionsapprovals.jobid','requsitionsapprovals.date')
                                            ->where('requsitionsapprovals.jobid', $data['id'])
                                            ->where('employeerequisitionusers.employeetype', 'Group CEO')
                                            ->first();
                
                        $getmanager=DB::table('employeerequisitions')
                                   ->where('id',$data['id'])
                                   ->first();
                                   //get the manager name 
                        $managername=DB::table('users')
                                    ->where('id',$getmanager->manager)
                                    ->first();


                        $manname=$managername->name;
                        $id=$managername->id;
                        $employeetype="Hiring Manager";
                        $action="Pending";
                        $pushdata=(object) ['id'=> $id,'name'=>$manname, 'employeetype'=>$employeetype ,'action'=>$action]; 
                         array_unshift($approvers, $pushdata);
                          
                          $getdateofmanagerapprovals=DB::table('requsitionsapprovals')
                                                     ->where('requsitionsapprovals.jobid', $data['id'])
                                                     ->where('userId',$managername->id )
                                                     ->first();

                      $gettheinitator=DB::table('requsitionsapprovals') 
                                        ->join('users' , 'users.id', '=', 'requsitionsapprovals.userId') 
                                        ->where('requsitionsapprovals.jobid', $data['id'])
                                        ->where('requsitionsapprovals.initiator' ,'initiator')
                                        ->first();
                                       
                            $ininame=$gettheinitator->name;
                            $action='submit';
                            $emplyeetype='HR Recruitement Manager';
                            $idini=$gettheinitator->id;
                            $date=$gettheinitator->date;
                           $pushdata=(object) ['id'=> $idini,'name'=>$ininame, 'employeetype'=>$emplyeetype ,'action'=>"submit", 'date'=>$date]; 
                            array_unshift($approvers, $pushdata);
                        @endphp
                        @foreach ($approvers as $approver) 
                         <tr>
                          <td>{{ $count++ }}</td>
                            <td>&nbsp;</td>
                          <td>&nbsp;</td>  
                          <td >{{$approver -> name}}</td>
                          <td></td>
                          <td></td>
                          <td >{{$approver -> employeetype}}</td>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                          <td>
                            @php
                            if(isset($approver->action) && $approver->action == 'submit')
                              echo "submitted";
                            elseif(isset($approver->action) && $approver->action == 'Pending')
                              echo "Approved";
                            elseif($approver->employeetype == "HR Manager"){
                              if($approver->userId == $hrapprover->userId){
                                echo "Declined";
                              }
                              else{
                              echo "Beaten";
                              }
                            }
                            else{
                              echo "Beaten";
                            } 
                            @endphp
                          </td>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>

                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                          <td >
                           @if($approver->id == $recruitemntapprover->userId)
                           <p>  {{$recruitemntapprover->date}}</p>
                          
                          @endif
                         @if($approver->id == $getdateofmanagerapprovals->userId)
                           <p>  {{$getdateofmanagerapprovals->date}}</p>
                          
                          @endif
                           @if($approver->id == $hrapprover->userId)
                           <p>  {{$hrapprover->date}}</p>
                          
                          @endif
                                            
                          </td>
                        </tr> 
                        @endforeach

  </tbody>
</table>
          <tr>
            <td style="padding:30px;background:orange;">
              <table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;font-size:9px;font-family:Arial,sans-serif;">
                <tr>
                  <td style="padding:0;width:50%;" align="left">
                  </td>
                  <td style="padding:0;width:50%;" align="right">
                    <table role="presentation" style="border-collapse:collapse;border:0;border-spacing:0;">
                      <tr>
                      </tr>
                    </table>
                  </td>
                </tr>
              </table>
            </td>
          </tr>
        </table>
      </td>
    </tr>

  </table>
 
</body>
</html>