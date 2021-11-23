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
</head>
<body style="margin:0;padding:0;">
  <table role="presentation" style="width:100%;border-collapse:collapse;border:0;border-spacing:0;background:#ffffff;">
    <tr>
      <td align="center" style="padding:0;">
        <table role="presentation" style="width:602px;border-collapse:collapse;border:1px solid #cccccc;border-spacing:0;text-align:left;">
                    <td align="center" style="padding:20px 0 15px 0;background:orange;">
              <h2 style="color: #ffffff">Employee Request</h2>
            </td>
          <tr>
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
                          <p style="margin:0 0 12px 0;font-size:12px;line-height:14px;font-family:Arial,sans-serif;">Budgeted salary:{{ $data['salary'] }} - .{{ $data['salaryto'] }}</p>
                          <p style="margin:0 0 12px 0;font-size:12px;line-height:14px;font-family:Arial,sans-serif;">No of Positions::{{ $data['positions'] }}</p>
                          <p style="margin:0 0 12px 0;font-size:12px;line-height:14px;font-family:Arial,sans-serif;">Location:{{ $data['location'] }}</p>
                          <p style="margin:0 0 12px 0;font-size:12px;line-height:14px;font-family:Arial,sans-serif;">Position Type::{{ $data['employementtype'] }}</p>
                           <p style="margin:0 0 12px 0;font-size:12px;line-height:14px;font-family:Arial,sans-serif;">No. of Interviews::{{ $data['interviews'] }}</p>
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
                            $manager = App\Models\User::find($data['manager'])->first();
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
                       <tr>
                        <th style=" font-size: 10px; margin-left:-50px;">Name</th>
                        <th style=" font-size: 10px; margin-left:-50px;">Role</th>
                        <th style=" font-size: 10px; margin-left:-50px;">Action &nbsp;&nbsp;  &nbsp; &nbsp; &nbsp;</th>
                        <th style=" font-size: 10px; margin-left:-50px;">Date</th>
                      </tr>
                     
                        @php
                        $approvers=DB::table('employeerequisitionusers')
                                  ->join('users', 'users.id', '=', 'employeerequisitionusers.userId')
                                   ->where('employeerequisitionusers.employeetype', '!=', 'HR Recruitment Team')
                                    ->where('employeerequisitionusers.employeetype', '!=', 'Group CEO')
                                    ->where('employeerequisitionusers.employeetype', '!=', 'Executive Lead')
                                   ->get()
                                   ->toArray();
                     // dd($approvers);
                      #get the user id
                      #get the roles 
                      #get all users with identical roles
                      #manipulate the output
                        $recruitemntapprover=DB::table('requsitionsapprovals')
                                            ->join('employeerequisitionusers', 'employeerequisitionusers.userId', '=', 'requsitionsapprovals.userId')
                                            ->select('requsitionsapprovals.userId','employeerequisitionusers.employeetype', 'requsitionsapprovals.jobid','requsitionsapprovals.date')
                                            ->where('requsitionsapprovals.jobid', $data['id'])
                                            ->where('employeerequisitionusers.employeetype', 'HR Recruitment Team')
                                            ->first();
                          $hrapprover=DB::table('requsitionsapprovals')
                                            ->join('employeerequisitionusers', 'employeerequisitionusers.userId', '=', 'requsitionsapprovals.userId')
                                            ->select('requsitionsapprovals.userId','employeerequisitionusers.employeetype', 'requsitionsapprovals.jobid', 'requsitionsapprovals.date')
                                            ->where('requsitionsapprovals.jobid', $data['id'])
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
                          //dd($recruitemntapprover);
                  $gettheinitator=DB::table('requsitionsapprovals') 
                                        ->join('users' , 'users.id', '=', 'requsitionsapprovals.userId') 
                                        ->where('requsitionsapprovals.jobid', $data['id'])
                                        ->where('requsitionsapprovals.initiator' ,'initiator')
                                        ->first();
                                       
                            $ininame=$gettheinitator->name;
                            $action='submit';
                            $emplyeetype='Group CEO';
                            $idini=$gettheinitator->id;
                            $date=$gettheinitator->date;
                           $pushdata=(object) ['id'=> $idini,'name'=>$ininame, 'employeetype'=>$emplyeetype ,'action'=>"submit", 'date'=>$date]; 
                          array_unshift($approvers, $pushdata);
                              $stages1 = $data['stages']
                        @endphp
                        @foreach ($approvers as $approver) 
                         <tr>
                          <td style=" font-size: 10px; margin-left:-50px;">{{$approver -> name}}</td>
                          <td style=" font-size: 10px; margin-left:-50px;">{{$approver -> employeetype}}</td>
                          <td style=" font-size: 10px; margin-left:-50px;">
                            @php

                            if(isset($approver->action) && $approver->action == 'submit')
                              echo "Approved";
                            else{
                              echo "pending";
                            } 
                            @endphp
                          </td>
                          <td style=" font-size: 10px; margin-left:-50px;">
                          @if($approver->id == $hrapprover->userId)
                           <p>  {{$hrapprover->date}}</p>
                          
                          @endif
                          </td>
                        </tr> 
                        @endforeach
                      <p style="margin:0;font-size:12px;line-height:14px;font-family:Arial,sans-serif;">  <a href="{{route ('calltoaction3')}}"> click here for an action</a><br><br></p>
                      <p style="margin:0;font-size:12px;line-height:14px;font-family:Arial,sans-serif;"> <a href="{{ url('groupceotoexec/'. $data['id'])}}"> Approve</a><br></p>
                       <p style="margin:0;font-size:12px;line-height:14px;font-family:Arial,sans-serif;"> <a href="{{ url('decline/' . $data['id'])}}"> Decline</a><br></p>
                        <p style="margin:0;font-size:12px;line-height:14px;font-family:Arial,sans-serif;"> <a href="{{ url('returnforcorrections/' . $data['id'].'/'.$data['user'])}}" id="{{$data['id']}}"> Return For Corrections</a><br></p>
                    </table>
                  </td>
                </tr>
              </table>
            </td>
          </tr>
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