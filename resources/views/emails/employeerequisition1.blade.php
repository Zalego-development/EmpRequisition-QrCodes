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
          <tr>
          <td align="center" style="padding:20px 0 15px 0;background:orange;">
              <h2 style="color: #ffffff">Employee Request</h2>
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
                          <p style="margin:0;font-size:12px;line-height:14px;font-family:Arial,sans-serif;"> <a href="{{route ('calltoaction1')}}"> click here for an action</a><br><br></p>
                        </td>
                      </tr>
                       <tr>
                        <th style=" font-size: 10px; margin-left:-50px;">Name</th>
                        <th style=" font-size: 10px; margin-left:-50px;">Role</th>
                        <th style=" font-size: 10px; margin-left:-50px;">Action&nbsp;  &nbsp; &nbsp; &nbsp;</th>
                      </tr>
                     
                        @php
                        $approvers=DB::table('employeerequisitionusers')
                                  ->join('users', 'users.id', '=', 'employeerequisitionusers.userId')
                                   ->get();
                        $stages = $data['stages']
                        @endphp
                        @foreach ($approvers as $approver) 
                         <tr>
                          <td style="margin:0 0 12px 0;font-size:12px;line-height:14px;font-family:Arial,sans-serif;">{{$approver -> name}}</td>
                          <td style="margin:0 0 12px 0;font-size:12px;line-height:14px;font-family:Arial,sans-serif;">{{$approver -> employeetype}}</td>
                          <td style="margin:0 0 12px 0;font-size:12px;line-height:14px;font-family:Arial,sans-serif;">{{$stages[$approver->employeetype]==0 ? "Pending" : "Approved"}}</td>
                        </tr> 
                        @endforeach
                      
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
                    <p style="margin:0;font-size:14px;line-height:16px;font-family:Arial,sans-serif;color:#ffffff;">
                      &reg;2021<br/><a href="http://www.example.com" style="color:#ffffff;text-decoration:underline;">Zalego Academy</a>
                    </p>
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