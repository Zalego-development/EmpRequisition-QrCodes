<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Http;
use Auth;
use Mail;
use App\Exports\leadsExport;
use Maatwebsite\Excel\Facades\Excel;
use DB;
use Column;
use App\Imports\offlineImports;
use DataTables;
use Illuminate\Auth\SessionGuard;
use Carbon\Carbon;


class LeadsController extends Controller
{
	private $appointment;
    //return index
    public function student_leads(){
 
 $response = Http::get('https://zalegoacademy.ac.ke/public/api/getApplications/JgqWTt76P4H2BZ3tFtWtE_RH9h4FU6QeHF9rUd6O');
$handleded = Http::get('https://zalegoacademy.ac.ke/public/api/getHandled/JgqWTt76P4H2BZ3tFtWtE_RH9h4FU6QeHF9rUd6O');
/**if($response['response_status']=='0'){
Alert::error('Error','Invalid api authentication');
       return back();
}**/
$applications=$response->json();
$handled=$handleded->json();
$leads=DB::table('leads')
		->orderBy('created_at','DESC')
		->where('handler','=',Auth::user()->userId)
		->paginate(50);

    $success_leads=DB::table('leads')
    ->orderBy('created_at','DESC')
    ->where('handler','=',Auth::user()->userId)
    ->where('completeness','=','1')
    //add where is_achived =0
    ->where('achve_status','=',0)
    ->paginate(500);

    $failed_leads=DB::table('leads')
    ->orderBy('created_at','DESC')
    ->where('handler','=',Auth::user()->userId)
    //add where is_achived =0
    ->where('completeness','=','2')
    ->paginate(500);


    //loged in agent
    $history_log = DB::table('history_log')
    ->where('email_address', Auth::user()->email)
    ->get();
    //->sum('email_addres');



$employees=DB::table('employees')
->where('achve_status','=',0)
->get();
$data=array('applications'=>$applications,'history_log'=>$history_log,'failed_leads'=>$failed_leads,'success_leads'=>$success_leads,'leads'=>$leads,'handled'=>$handled,'employees'=>$employees);
return view('crm.index')->with($data);
    }


public function student_leads2(Request $request){
$curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://zalegoacademy.ac.ke/public/api/getApplications/JgqWTt76P4H2BZ3tFtWtE_RH9h4FU6QeHF9rUd6O",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_TIMEOUT => 30000,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                // Set Here Your Requesred Headers
                'Content-Type: application/json',
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            // dd("cURL Error #:" . $err);
        } else {
            $applications = json_decode($response);
        }


        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://zalegoacademy.ac.ke/public/api/getHandled/JgqWTt76P4H2BZ3tFtWtE_RH9h4FU6QeHF9rUd6O",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_TIMEOUT => 30000,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                // Set Here Your Requesred Headers
                'Content-Type: application/json',
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            // dd("cURL Error #:" . $err);
        } else {
            $handled = json_decode($response);
        }
$leads=DB::table('leads')
        ->orderBy('created_at','DESC')
      ->where('handler','=',Auth::user()->userId)
        ->paginate(90);
$employees=DB::table('employees')
->where('achve_status','=',0)
->get();

$success_leads=DB::table('leads')
    ->orderBy('created_at','DESC')
    ->where('handler','=',Auth::user()->userId)
    ->where('completeness','=','1')
    //add where is_achived =0
    ->where('achve_status','=',0)
    ->paginate(500);

    $failed_leads=DB::table('leads')
    ->orderBy('created_at','DESC')
    ->where('handler','=',Auth::user()->userId)
    ->where('completeness','=','2')
    ->where('achve_status','=',0)
    //add where is_achived =0
    ->paginate(500);
$data=array('applications'=>$applications,'leads'=>$leads,'handled'=>$handled,'employees'=>$employees,'failed_leads'=>$failed_leads,'success_leads'=>$success_leads);
return view('crm.index2')->with($data);
    }




    public function updateMyLead(){
 ini_set('max_execution_time','1080');
    //do an update on the actual data on zalego academy
    $leads=DB::table('leads')
    ->orderBy('created_at','DESC')
    ->where('handler','=',Auth::user()->userId)
    ->get();





       $response = Http::get('https://zalegoacademy.ac.ke/public/api/getApplications/JgqWTt76P4H2BZ3tFtWtE_RH9h4FU6QeHF9rUd6O');
$handled = Http::get('https://zalegoacademy.ac.ke/public/api/getHandled/JgqWTt76P4H2BZ3tFtWtE_RH9h4FU6QeHF9rUd6O');
/**if($response['response_status']=='0'){
Alert::error('Error','Invalid api authentication');
       return back();
}**/
$applications=$response->json();
$handled=$handled->json();


//add walk in leads
if(!empty($applications)){
foreach($applications as $app){
    if($app['source_category']=='1' && $app['handler']==Auth::user()->userId){
        //add your leads
          //check if we have the same deal taken already
         $check=DB::select('SELECT *FROM leads WHERE customer=?',[$app['id']]);
         if(count($check)>0){
            //do  Http::get('https://zalegoacademy.ac.ke/public/api/updateHandler/'.$app['id'].'/JgqWTt76P4H2BZ3tFtWtE_RH9h4FU6QeHF9rUd6O');
           Http::get('https://zalegoacademy.ac.ke/public/api/updateHandler/'.$app['id'].'/JgqWTt76P4H2BZ3tFtWtE_RH9h4FU6QeHF9rUd6O');
         }else{
            $created_at=date('Y-m-d')." ".date('h:i:s A');
              $insert=DB::insert('INSERT INTO leads(customer,handler,status,created_at) VALUES(?,?,?,?)',[$app['id'],Auth::user()->userId,'Active',$created_at]);
              Http::get('https://zalegoacademy.ac.ke/public/api/updateHandler/'.$app['id'].'/JgqWTt76P4H2BZ3tFtWtE_RH9h4FU6QeHF9rUd6O');
         }
        
      
    }

    if($app['source_category']=='2' && $app['handler']==Auth::user()->userId){
        //add your leads
          //check if we have the same deal taken already
         $check=DB::select('SELECT *FROM leads WHERE customer=?',[$app['id']]);
         if(count($check)>0){
            //do nothing
           Http::get('https://zalegoacademy.ac.ke/public/api/updateHandler/'.$app['id'].'/JgqWTt76P4H2BZ3tFtWtE_RH9h4FU6QeHF9rUd6O');
         }else{
            $created_at=date('Y-m-d')." ".date('h:i:s A');
              $insert=DB::insert('INSERT INTO leads(customer,handler,status,created_at) VALUES(?,?,?,?)',[$app['id'],Auth::user()->userId,'Active',$created_at]);
              Http::get('https://zalegoacademy.ac.ke/public/api/updateHandler/'.$app['id'].'/JgqWTt76P4H2BZ3tFtWtE_RH9h4FU6QeHF9rUd6O');
         }
        
      
    }
}

$success=1;
//return response()->json(array('success'=>$success),200);
Alert::success('Success','Your leads have been updated successfully');
          return back(); 
}else{
  Alert::warning('Warning','The request has timed out, Please retry');
          return back(); 
}

         


    }

    //add lead
    public function addLead($leadId){
    	 $created_at=date('Y-m-d')." ".date('h:i:s A');

         //check if we have the same deal taken already
         $check=DB::select('SELECT *FROM leads WHERE customer=?',[$leadId]);
         if(count($check)>0){
             Alert::warning('Warning','This deal has already been taken by another agent');
                    return back();
         }
    	
    	$insert=DB::insert('INSERT INTO leads(customer,handler,status,created_at) VALUES(?,?,?,?)',[$leadId,Auth::user()->userId,'Active',$created_at]);

    	if($insert){
    		Http::get('https://zalegoacademy.ac.ke/public/api/updateHandler/'.$leadId.'/JgqWTt76P4H2BZ3tFtWtE_RH9h4FU6QeHF9rUd6O');
    			 Alert::success('Success','You have successfully added lead ');
                    return back();
    	}else{
    		  Alert::warning('Warning','Unable to add lead. Try again!');
                    return back();
    	}
    }

    //save appointment
    public function saveAppointment(Request $request){
    	$title=$request->input('title1');
    	$contact=$request->input('contact1');
    	$name=$request->input('name1');
    	$user=strtolower($request->input('email1'));
    	$description=$request->input('description1');
    	$date=$request->input('date1');
    	$time=$request->input('time1');
    	$channel=$request->input('channel1');
    	$customer=$request->input('customer1');
    	$created_at=date('Y-m-d')." ".date('h:i:s A');
    	$_message='Hello '.$name.'\\n'.$title.'\\n'.$description.' \\nDate '.$date.' \\nTime '.$time;
    	$_message2='Hello '.$name.'<br><strong>'.$title.'</strong><br>'.$description.' <br>Date '.$date.' Time '.$time;
    	if($channel=="sms"){
    		$insert=DB::insert('INSERT INTO lead_activities (customer,activity_status,subject,description,time_set,date_set,created_at,updated_at) VALUE(?,?,?,?,?,?,?,?)',[$customer,$channel,$title,$description,$time,$date,$created_at,$created_at]);

    		 DB::delete('DELETE t1 FROM lead_activities t1
                            INNER JOIN lead_activities t2 
                            WHERE 
                                t1.activityId < t2.activityId AND 
                                t1.customer = t2.customer AND t1.subject = t2.subject AND t1.description = t2.description AND t1.time_set = t2.time_set AND t1.date_set = t2.date_set AND t1.activity_status = t2.activity_status');

    		//send the message
    		 $_userName='Zalego'; 

$_recipient=$contact;

$url = 'http://comms.zalego.com:6005/api/v2/SendSMS';
$url = 'https://api.zalego.com/api/v2/SendSMS';
            error_reporting(0);
           $ch = curl_init($url);
           $jsonData = [
           "SenderId" => $_userName,
           "Message" => $_message,
           "MobileNumbers" => $_recipient,
           "ApiKey" =>  "VPEy11QTFO5DSca3gMLfPoBFk0+b7/B6P0Kj1vdUxU4=",
           "ClientId" => "aab4e9f9-5f00-4dd8-9754-d6bae608b542"
           ];
           $jsonDataEncoded = json_encode($jsonData);
       
           curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
           curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 120);
           curl_setopt($ch, CURLOPT_TIMEOUT, 120);
           curl_setopt($ch, CURLOPT_POST, true);
           curl_setopt($handler, CURLOPT_VERBOSE, true);
           curl_setopt($handler, CURLOPT_STDERR, $out);
           curl_setopt($handler, CURLOPT_RETURNTRANSFER, true);
           curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);
           curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
           curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
           $result = curl_exec($ch);
           //print_r($result);
           if (curl_error($ch)) {
               //echo json_encode(array(null, "0", curl_error($ch)));
           }
          
            curl_close($ch);

    		if($insert){
    			$success=1;
    			 return response()->json(array('success'=>$success),200);
    	}else{
    		 $success=0;
    			 return response()->json(array('success'=>$success),200);
    	}

    	}//end sms channel

    	else if ($channel=="email") {
    		$insert=DB::insert('INSERT INTO lead_activities (customer,activity_status,subject,description,time_set,date_set,created_at,updated_at) VALUE(?,?,?,?,?,?,?,?)',[$customer,$channel,$title,$description,$time,$date,$created_at,$created_at]);

    		 DB::delete('DELETE t1 FROM lead_activities t1
                            INNER JOIN lead_activities t2 
                            WHERE 
                                t1.activityId < t2.activityId AND 
                                t1.customer = t2.customer AND t1.subject = t2.subject AND t1.description = t2.description AND t1.time_set = t2.time_set AND t1.date_set = t2.date_set AND t1.activity_status = t2.activity_status');

    		$data=array('_message2'=>$_message2);
    		  //notify them on email
    		$this->appointment=$title;
                        Mail::send('mails.appointment', $data, function ($m) use ($user) {
                        $m->from('comms@zalegoacademy.ac.ke', $this->appointment);

                        $m->to($user)->subject($this->appointment);
                        });

                        	if($insert){
    			$success=1;
    			 return response()->json(array('success'=>$success),200);
    	}else{
    		 $success=0;
    			 return response()->json(array('success'=>$success),200);
    	}
    	}else if($channel=="whatsapp"){
    		$insert=DB::insert('INSERT INTO lead_activities (customer,activity_status,subject,description,time_set,date_set,created_at,updated_at) VALUE(?,?,?,?,?,?,?,?)',[$customer,$channel,$title,$description,$time,$date,$created_at,$created_at]);

    		 DB::delete('DELETE t1 FROM lead_activities t1
                            INNER JOIN lead_activities t2 
                            WHERE 
                                t1.activityId < t2.activityId AND 
                                t1.customer = t2.customer AND t1.subject = t2.subject AND t1.description = t2.description AND t1.time_set = t2.time_set AND t1.date_set = t2.date_set AND t1.activity_status = t2.activity_status');


                        	if($insert){
                        	//return redirect()->to("https://wa.me/".$contact."?text=".$_message)->send();	
    			$success=1;
    			$whatsappCheck=1;
    			$description=htmlspecialchars_decode(stripslashes($description));

    			$_message22='Hello '.$name.' '.$title.' '.$description.' Date '.$date.' Time '.$time;
    			
    			 return response()->json(array('success'=>$success,'whatsappCheck'=>$whatsappCheck,'_message22'=>$_message22),200);
    	}else{
    		 $success=0;
    			 return response()->json(array('success'=>$success),200);
    	}


    	}
    	
    }

    //save task
    public function saveTasks(Request $request)
    {
    	$title=$request->input('title2');
    	$contact=$request->input('contact2');
    	$name=$request->input('name2');
    	$user=strtolower($request->input('email2'));
    	$description=$request->input('description2');
    	$date=$request->input('date2');
    	$time=$request->input('time2');
    	$channel=$request->input('channel2');
    	$customer=$request->input('customer2');
    	$created_at=date('Y-m-d')." ".date('h:i:s A');

    	$insert=DB::insert('INSERT INTO lead_activities (customer,activity_status,subject,description,time_set,date_set,created_at,updated_at) VALUE(?,?,?,?,?,?,?,?)',[$customer,$channel,$title,$description,$time,$date,$created_at,$created_at]);

    		 DB::delete('DELETE t1 FROM lead_activities t1
                            INNER JOIN lead_activities t2 
                            WHERE 
                                t1.activityId < t2.activityId AND 
                                t1.customer = t2.customer AND t1.subject = t2.subject AND t1.description = t2.description AND t1.time_set = t2.time_set AND t1.date_set = t2.date_set AND t1.activity_status = t2.activity_status');

    	if($insert){
    			$success=1;
    			 return response()->json(array('success'=>$success),200);
    	}else{
    		 $success=0;
    			 return response()->json(array('success'=>$success),200);
    	}

    	
    }


    //edit task
       //save task
    public function editTaskLead(Request $request)
    {
        $title=$request->input('title2');
        $id=$request->input('id');
        $contact=$request->input('contact2');
        $name=$request->input('name2');
        $user=strtolower($request->input('email2'));
        $description=$request->input('description2');
        $date=$request->input('date2');
        $time=$request->input('time2');
        $channel=$request->input('channel2');
        $customer=$request->input('customer2');
        $created_at=date('Y-m-d')." ".date('h:i:s A');

        $insert=DB::update('UPDATE lead_activities SET customer=?,activity_status=?,subject=?,description=?,time_set=?,date_set=?,created_at=?,updated_at=? WHERE activityId=?',[$customer,$channel,$title,$description,$time,$date,$created_at,$created_at,$id]);

             /**DB::delete('DELETE t1 FROM lead_activities t1
                            INNER JOIN lead_activities t2 
                            WHERE 
                                t1.activityId < t2.activityId AND 
                                t1.customer = t2.customer AND t1.subject = t2.subject AND t1.description = t2.description AND t1.time_set = t2.time_set AND t1.date_set = t2.date_set AND t1.activity_status = t2.activity_status');**/

        if($insert){
                $success=1;
                 return response()->json(array('success'=>$success),200);
        }else{
             $success=0;
                 return response()->json(array('success'=>$success),200);
        }

        
    }


      //save sms
    public function saveSms(Request $request)
    {
    	$title="";
    	$contact=$request->input('contact3');
    	$name=$request->input('name3');
    	$user=strtolower($request->input('email3'));
    	$description=$request->input('description3');
    	$date="";
    	$time="";
    	$channel=$request->input('channel3');
    	$customer=$request->input('customer3');
    	$created_at=date('Y-m-d')." ".date('h:i:s A');

    	$insert=DB::insert('INSERT INTO lead_activities (customer,activity_status,subject,description,time_set,date_set,created_at,updated_at) VALUE(?,?,?,?,?,?,?,?)',[$customer,$channel,$title,$description,$time,$date,$created_at,$created_at]);

    		 DB::delete('DELETE t1 FROM lead_activities t1
                            INNER JOIN lead_activities t2 
                            WHERE 
                                t1.activityId < t2.activityId AND 
                                t1.customer = t2.customer AND t1.subject = t2.subject AND t1.description = t2.description AND t1.time_set = t2.time_set AND t1.date_set = t2.date_set AND t1.activity_status = t2.activity_status');

    		 //send message
    		 $_message='Hello '.$name.'\\n'.$title.'\\n'.$description;
    		 	//send the message
    		 $_userName='Zalego'; 

$_recipient=$contact;

$url = 'http://comms.zalego.com:6005/api/v2/SendSMS';
$url = 'https://api.zalego.com/api/v2/SendSMS';
            error_reporting(0);
           $ch = curl_init($url);
           $jsonData = [
           "SenderId" => $_userName,
           "Message" => $_message,
           "MobileNumbers" => $_recipient,
           "ApiKey" =>  "VPEy11QTFO5DSca3gMLfPoBFk0+b7/B6P0Kj1vdUxU4=",
           "ClientId" => "aab4e9f9-5f00-4dd8-9754-d6bae608b542"
           ];
           $jsonDataEncoded = json_encode($jsonData);
       
           curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
           curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 120);
           curl_setopt($ch, CURLOPT_TIMEOUT, 120);
           curl_setopt($ch, CURLOPT_POST, true);
           curl_setopt($handler, CURLOPT_VERBOSE, true);
           curl_setopt($handler, CURLOPT_STDERR, $out);
           curl_setopt($handler, CURLOPT_RETURNTRANSFER, true);
           curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);
           curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
           curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
           $result = curl_exec($ch);
           //print_r($result);
           if (curl_error($ch)) {
               //echo json_encode(array(null, "0", curl_error($ch)));
           }
          
            curl_close($ch);


    	if($insert){
    			$success=1;
    			 return response()->json(array('success'=>$success),200);
    	}else{
    		 $success=0;
    			 return response()->json(array('success'=>$success),200);
    	}

    	
    }

       //save task
    public function saveWhatsapp(Request $request)
    {
    	$title="";
    	$contact=$request->input('contact4');
    	$name=$request->input('name4');
    	$user=strtolower($request->input('email4'));
    	$description=$request->input('description4');
    	$date="";
    	$time="";
    	$channel=$request->input('channel4');
    	$customer=$request->input('customer4');
    	$created_at=date('Y-m-d')." ".date('h:i:s A');

    	$insert=DB::insert('INSERT INTO lead_activities (customer,activity_status,subject,description,time_set,date_set,created_at,updated_at) VALUE(?,?,?,?,?,?,?,?)',[$customer,$channel,$title,$description,$time,$date,$created_at,$created_at]);

    		 DB::delete('DELETE t1 FROM lead_activities t1
                            INNER JOIN lead_activities t2 
                            WHERE 
                                t1.activityId < t2.activityId AND 
                                t1.customer = t2.customer AND t1.subject = t2.subject AND t1.description = t2.description AND t1.time_set = t2.time_set AND t1.date_set = t2.date_set AND t1.activity_status = t2.activity_status');

    	if($insert){
    			$success=1;
    			$whatsappCheck=1;
    			$_message22='Hello '.$name.' '.$title.' '.$description;
    			
    			 return response()->json(array('success'=>$success,'whatsappCheck'=>$whatsappCheck,'_message22'=>$_message22),200);
    	}else{
    		 $success=0;
    			 return response()->json(array('success'=>$success),200);
    	}

    	
    }


          //save email
    public function saveEmail(Request $request)
    {
    	$title=$request->input('subject');
    	$contact=$request->input('contact5');
    	$name=$request->input('name5');
    	$user=strtolower($request->input('email5'));
    	$description=$request->input('body');
    	//$attachment=$request->input('attachment');
    	$cms_multiple_images=$request->file("attachment");
    	$date="";
    	$time="";
    	$channel=$request->input('channel5');
    	$customer=$request->input('customer5');
    	$created_at=date('Y-m-d')." ".date('h:i:s A');
    	$_message2='Hello '.$name.'<br><strong>'.$title.'</strong><br>'.$description;

    	 //attachment id
       $code=substr(str_shuffle('123456789'), 0, 12).time();
    	$insert=DB::insert('INSERT INTO lead_activities (customer,activity_status,subject,description,time_set,date_set,docCode,created_at,updated_at) VALUE(?,?,?,?,?,?,?,?,?)',[$customer,$channel,$title,$description,$time,$date,$code,$created_at,$created_at]);

    		 DB::delete('DELETE t1 FROM lead_activities t1
                            INNER JOIN lead_activities t2 
                            WHERE 
                                t1.activityId < t2.activityId AND 
                                t1.customer = t2.customer AND t1.subject = t2.subject AND t1.description = t2.description AND t1.time_set = t2.time_set AND t1.date_set = t2.date_set AND t1.activity_status = t2.activity_status');

    		
$folder="public/hrfiles";
            $cms_page_image_name_to_store="";
    		 //save attachments
    		   if($cms_multiple_images!=""){
                        foreach($cms_multiple_images as $cms_mult_images){

                        
                                        //get file name with extension
                    $cms_page_image_name_with_extension=$cms_mult_images->getClientOriginalName();
                                //get just File name
                                    $cms_page_image_file_name_only=pathinfo($cms_page_image_name_with_extension,PATHINFO_FILENAME);
                                //get just Extension
                                    $cms_page_image_extension_only=$cms_mult_images->getClientOriginalExtension();
                                        //timestamped file name to store
                                        $cms_page_image_name_to_store=str_replace(" ","_",$cms_page_image_file_name_only."_".time().".".$cms_page_image_extension_only);
                                    //upload the image
                                        $cms_page_image_path=$cms_mult_images->move($folder,$cms_page_image_name_to_store);
                           $insert2=DB::insert('INSERT INTO mailattachments(comId,docLink) VALUES(?,?)',[$code,$cms_page_image_name_to_store]);          
                    }
                                
            }

            $attachments2=DB::table('mailattachments')
            				->where('comId','=',$code)
            				->get();

            $data=array('_message2'=>$_message2,'attachments2'=>$attachments2);
    		  //notify them on email
    		$this->appointment=$title;
                        Mail::send('mails.leadMail', $data, function ($m) use ($user) {
                        $m->from('comms@zalegoacademy.ac.ke', $this->appointment);

                        $m->to($user)->subject($this->appointment);
                        });

    	if($insert){
    			$success=1;
    			
    			  Alert::success('Success','You have successfully sent an email');
                    return back();
    	}else{
    		 $success=0;
    			 Alert::warning('Warning','Unable to send email ');
                    return back();
    	}

    	
    }

    //re assign deal
    public function reassignDeal(Request $request){
        $handler=$request->input('handler');
        $customer=$request->input('customer6');
        DB::update('UPDATE leads SET handler=? WHERE customer=?',[$handler,$customer]);
        //send an email to the new agent informing them on the re assigned deal
         /** code here**/
         Alert::success('Success','You have successfully re-assigned your deal to another agent ');
                    return back();
    }

    //view leads
    public function viewLead($id){
        $response = Http::get('https://zalegoacademy.ac.ke/public/api/getApplications/JgqWTt76P4H2BZ3tFtWtE_RH9h4FU6QeHF9rUd6O');
$handled = Http::get('https://zalegoacademy.ac.ke/public/api/getHandled/JgqWTt76P4H2BZ3tFtWtE_RH9h4FU6QeHF9rUd6O');
/**if($response['response_status']=='0'){
Alert::error('Error','Invalid api authentication');
       return back();
}**/
$applications=$response->json();
$handled=$handled->json();
$leads=DB::table('leads')
        ->orderBy('created_at','DESC')
        ->where('handler','=',Auth::user()->userId)
        ->where('customer','=',$id)
        ->get();
$activities=DB::table('lead_activities')
        ->orderBy('created_at','DESC')
        ->where('customer','=',$id)
        ->get();
$lead_reasons=DB::table('lead_reasons') 
        ->get();
$deal_reasons=DB::table('deal_reasons')
        ->get();
$deal_progress_reports=DB::table('deal_progress_option')
         ->where('customer','=',$id)
        ->get();
$lead_progress_reports=DB::table('lead_progress_options')
        ->get();
$employees=DB::table('employees')
->where('achve_status','=',0)
->get();
$data=array('applications'=>$applications,'leads'=>$leads,'handled'=>$handled,'employees'=>$employees,'activities'=>$activities,'lead_reasons'=>$lead_reasons,'deal_reasons'=>$deal_reasons,'deal_progress_reports'=>$deal_progress_reports,'lead_progress_reports'=>$lead_progress_reports);
return view('crm.viewLead')->with($data);
    }

    //view leads
    public function viewLead2($id){
       // $response = Http::get('https://zalegoacademy.ac.ke/public/api/getApplications/JgqWTt76P4H2BZ3tFtWtE_RH9h4FU6QeHF9rUd6O');
//$handled = Http::get('https://zalegoacademy.ac.ke/public/api/getHandled/JgqWTt76P4H2BZ3tFtWtE_RH9h4FU6QeHF9rUd6O');
/**if($response['response_status']=='0'){
Alert::error('Error','Invalid api authentication');
       return back();
}**/
$curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://zalegoacademy.ac.ke/public/api/getApplications/JgqWTt76P4H2BZ3tFtWtE_RH9h4FU6QeHF9rUd6O",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_TIMEOUT => 30000,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                // Set Here Your Requesred Headers
                'Content-Type: application/json',
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            // dd("cURL Error #:" . $err);
        } else {
            $applications = json_decode($response);
        }


        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://zalegoacademy.ac.ke/public/api/getHandled/JgqWTt76P4H2BZ3tFtWtE_RH9h4FU6QeHF9rUd6O",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_TIMEOUT => 30000,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                // Set Here Your Requesred Headers
                'Content-Type: application/json',
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            // dd("cURL Error #:" . $err);
        } else {
            $handled = json_decode($response);
        }

$leads=DB::table('leads')
        ->orderBy('created_at','DESC')
        ->where('handler','=',Auth::user()->userId)
        ->where('customer','=',$id)
        ->get();
$activities=DB::table('lead_activities')
        ->orderBy('created_at','DESC')
        ->where('customer','=',$id)
        ->get();
$lead_reasons=DB::table('lead_reasons') 
        ->get();
$deal_reasons=DB::table('deal_reasons')
        ->get();
$deal_progress_reports=DB::table('deal_progress_option')
         ->where('customer','=',$id)
        ->get();
$lead_progress_reports=DB::table('lead_progress_options')
        ->get();
$employees=DB::table('employees')
->where('achve_status','=',0)
->get();
$data=array('applications'=>$applications,'leads'=>$leads,'handled'=>$handled,'employees'=>$employees,'activities'=>$activities,'lead_reasons'=>$lead_reasons,'deal_reasons'=>$deal_reasons,'deal_progress_reports'=>$deal_progress_reports,'lead_progress_reports'=>$lead_progress_reports);
return view('crm.viewLead2')->with($data);
    }

    //complete task function
    public function completeTaskLead($id){
        DB::update('UPDATE lead_activities SET completeness=? WHERE activityId=?',[1,$id]);
        Alert::success('Success','You have successfully marked this task as complete ');
                    return back();
    }

     //complete task function
    public function uncompleteTaskLead($id){
        DB::update('UPDATE lead_activities SET completeness=? WHERE activityId=?',[0,$id]);
        Alert::success('Success','You have successfully marked this task as incomplete ');
                    return back();
    }

     //delete task function
    public function deleteTaskLead($id){
DB::delete('DELETE FROM lead_activities WHERE activityId=?',[$id]);
        Alert::success('Success','You have successfully deleted the item ');
                    return back();
    }

    //complete deal
    public function completeDeal(Request $request){
        $comment=$request->input('comment');
        $customer=$request->input('customer');
        $created_at=date('Y-m-d')." ".date('h:i:s A');
        DB::update('UPDATE leads SET comment=?, dateComplete=?, completeness=? WHERE leadId=?',[$comment,$created_at,1,$customer]);
         $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://zalegoacademy.ac.ke/public/api/markSuccess/JgqWTt76P4H2BZ3tFtWtE_RH9h4FU6QeHF9rUd6O/".$customer,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_TIMEOUT => 30000,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            // dd("cURL Error #:" . $err);
        } else {
            $applications = json_decode($response);
        }
        //save earned points 0->earned 1->deducted
        $referrer= $applications->referrer;
        if(!empty($referrer)){
            // if (!is_null($referrer)) {
            //     //calculate points
            //     $points=1;
            //     if (DB::table('ambassador_users')->where('uniqueId',$referrer)->value('is_teacher')==1) {
            //         $points=2;
            //     }
            //     $now=\Carbon\Carbon::now()->timezone('Africa/Nairobi');
            //     if (DB::table('ambassador_points')->where('refferer_id',$referrer)->where('created_at',$now)->count()==0) {
            //         DB::table('ambassador_points')->insert([
            //         'refferer_id'=>$referrer,
            //         'points'=>$points,
            //         'status'=>0,
            //         'created_at'=>$now,
            //         'updated_at'=>$now,
            //         ]);
            //     }
            // }
        }
        Alert::success('Success','Hi '.Auth::user()->firstname.' thank you for making this happen. Deal has been successfully completed ');
                    return back();
    }

    //fail deal
    public function failDeal(Request $request){
        $comment=$request->input('comment');
        $reason=$request->input('reason');
        $customer=$request->input('customer');
        $created_at=date('Y-m-d')." ".date('h:i:s A');
         if(count($reason)>0){
            for($x=0;$x<count($reason);$x++){
                DB::insert('INSERT INTO deal_reasons(customer,reasonId,created_at) VALUES(?,?,?)',[$customer,$reason[$x],$created_at]);
            }
         }
         DB::update('UPDATE leads SET comment=?, dateComplete=?, completeness=? WHERE leadId=?',[$comment,$created_at,2,$customer]);
        Alert::success('Success','Hi '.Auth::user()->firstname.' thank you for the effort. Deal is closed');
                    return back();
    }

    
    public function logLeadProgress(Request $request){
        $preports=$request->input('preports');
         $customer=$request->input('customer');
          $moreInfo=$request->input('moreInfo');
          $stage=$request->input('stage');
           $reportingDate=$request->input('reportingDate');
            $whyFail=$request->input('whyFail');
            $reason=$whyFail;
            if($reason=="" && $preports==3){
                Alert::warning('Warning','Hi '.Auth::user()->firstname.' Please select the reasons for a failed deal before proceeding');
                    return back();  
            }
            $created_at=date('Y-m-d')." ".date('h:i:s A');
         if($reason!="" || $preports=='3'){
            for($x=0;$x<count($reason);$x++){
                DB::insert('INSERT INTO deal_reasons(customer,reasonId,created_at) VALUES(?,?,?)',[$customer,$reason[$x],$created_at]);
            }
             DB::update('UPDATE leads SET comment=?, dateComplete=?, completeness=?,level=? WHERE customer=?',[$moreInfo,$created_at,2,3,$customer]);

             Alert::success('Success','Hi '.Auth::user()->firstname.' thank you for the effort. Deal is closed');
                    return back();
         }else{
            if($preports==4){
                 DB::update('UPDATE leads SET comment=?, dateComplete=?, completeness=?,level=? WHERE customer=?',[$moreInfo,$created_at,15,15,$customer]);
            }else{
               DB::update('UPDATE leads SET comment=?, dateComplete=?, completeness=?,level=? WHERE customer=?',[$moreInfo,$created_at,0,$stage,$customer]);  
            }
                

          DB::insert('INSERT INTO deal_progress_option(optionId,stage,customer,comment,nextDate,created_at) VALUES(?,?,?,?,?,?)',[$preports,$stage,$customer,$moreInfo,$reportingDate,$created_at]);

            Alert::success('Success','Hi '.Auth::user()->firstname.' thank you for making this happen. Deal progress has been updated. Please proceed to the next stage ');
                    return back();
         }

        

    }

    //log meeting details
    public function logMeeting(Request $request){
        $meetingId=$request->input('meetingId');
        $meeting=$request->input('meeting');
        DB::update('UPDATE lead_activities SET meeting=? WHERE activityId=?',[$meeting,$meetingId]);
         Alert::success('Success','You have successfully logged meeting details ');
                    return back();
    }

    public function markSuccess($index){
          DB::update('UPDATE leads SET completeness=? WHERE leadId=?',[1,$index]);
              Alert::success('Success','Hi '.Auth::user()->firstname.' thank you for making this happen. Deal progress has marked as a success and closed successfully. Have a great time! ');
                    return back();
    }


    //new crm
    public function crm(){
        
        $curl = curl_init();
                curl_setopt_array($curl, array(
                    CURLOPT_URL => "https://zalegoacademy.ac.ke/public/api/getApplications/JgqWTt76P4H2BZ3tFtWtE_RH9h4FU6QeHF9rUd6O",
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_TIMEOUT => 30000,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "GET",
                    CURLOPT_HTTPHEADER => array(
                        // Set Here Your Requesred Headers
                        'Content-Type: application/json',
                    ),
                ));
                $response = curl_exec($curl);
                $err = curl_error($curl);
                curl_close($curl);

                if ($err) {
                    // dd("cURL Error #:" . $err);
                } else {
                    $applications = json_decode($response);
                }


                $curl = curl_init();
                curl_setopt_array($curl, array(
                    CURLOPT_URL => "https://zalegoacademy.ac.ke/public/api/getHandled/JgqWTt76P4H2BZ3tFtWtE_RH9h4FU6QeHF9rUd6O",
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_TIMEOUT => 30000,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "GET",
                    CURLOPT_HTTPHEADER => array(
                        // Set Here Your Requesred Headers
                        'Content-Type: application/json',
                    ),
                ));
                $response = curl_exec($curl);
                $err = curl_error($curl);
                curl_close($curl);

                if ($err) {
                    // dd("cURL Error #:" . $err);
                } else {
                    $handled = json_decode($response);
                }
        $leads=DB::table('leads')
                ->orderBy('created_at','DESC')
            ->where('handler','=',Auth::user()->userId)
                ->get();

        $leadsActivity=DB::table('lead_activities')
                ->orderBy('created_at','DESC')
            
                ->get();

        $employees=DB::table('employees')
        ->where('achve_status','=',0)
        ->where('userId','=',Auth::user()->userId)
        ->get();

        $leads2=DB::table('leads')
                ->select(DB::raw('handler as hd'))
                ->groupBy(DB::raw('handler'))
                
                ->get();
      //get today
      date_default_timezone_set("Africa/Nairobi");
      $today = date("Y-m-d",strtotime("+0 HOURS"));
        //available agents
        $userID2=auth()->user()->email;
        $testimonial = DB::table('history_log')
        ->select('login_time')
        ->limit(1)
        ->orderBy('login_time', 'asc')
        ->where('email_address',[$userID2])
        //->where('logout_time','=',NULL)
        //->where('login_time','>=',[$today])
        ->where('login_time','>=',Carbon::today())

        ->get();
        //$userID2=auth()->user()->email;
        //agents online
        $test = DB::table('history_log')
        ->join('users', 'history_log.userid', '=', 'users.id')
        ->select('history_log.login_time','history_log.email_address','history_log.latitude','history_log.longitude','history_log.logout_time','users.name','history_log.host','history_log.ip')
        ->groupBy('email_address')
        ->where('logout_time','=',NULL)
        ->orderBy('login_time','asc')
        ->get();
        $nowloged = DB::table('history_log')
        ->join('users', 'history_log.userid', '=', 'users.id')
        ->select('history_log.login_time','history_log.email_address','history_log.latitude','history_log.longitude','history_log.logout_time','users.name','history_log.host','history_log.ip')
        ->groupBy('email_address')
        ->where('login_time','>=',Carbon::today())
        ->orderBy('login_time','ASC')
        ->get();



        //agents on duty today
        $test1 = DB::table('history_log')
        ->join('users', 'history_log.userid', '=', 'users.id')
        ->select('history_log.login_time','history_log.email_address','history_log.host','history_log.logout_time','users.name')
        ->orderBy('login_time', 'asc')
        ->groupBy('email_address')
        ->where('logout_time','!=',NULL)
        ->where('login_time','>=',[$today])
        
        //->where('break','=','0')
        ->get();

        // $test09 = DB::table('history_log')

        
        $AgentSum = DB::table("history_log")
        ->select('email_address')
            ->where('logout_time',NULL)
            ->groupBy('email_address')
            ->where('login_time','>=',[$today])
            ->count();
           
            $AgentSum1 = DB::table("history_log")
            ->select('email_address')
            ->orderBy('login_time', 'DESC')
            ->groupBy(['email_address'])
            ->where('logout_time','!=',NULL)
            ->where('login_time','>=',[$today])
            ->where('break','=','0')
            ->get()
            ->count();
          
            
           
        $AgentBreak = DB::table("history_log")
        ->select('email_address')
         ->where('logout_time','!=',NULL)
         ->where('login_time','>=',[$today])
         ->where('email_address',[$userID2])
        ->count();
            
        $AgentBreak2 = DB::table("history_log")
        ->select('email_address')
         ->where('logout_time','!=',NULL)
         ->where('login_time','>=', Carbon::today())
         //->where('email_address',[$userID2])
        ->count();
        

       date_default_timezone_set("Africa/Nairobi");
       $today = date("Y-m-d 00:00:00",strtotime("+0 HOURS"));
       $totalBreak = DB::table('history_log')
       ->where('email_address',[$userID2])
       ->where('logout_time','>=',Carbon::today())->get()
       ->sum('break_time');
       //agent time on call
       $firstName=Auth::user()->firstname;
       $lastName=Auth::user()->lastname;
       $callerID=$firstName."".$lastName;
      $CallSum = DB::table("call_logs")
      ->select('caller_id','total_time')
       ->where('caller_id',[$callerID])
       ->where('call_time','>=',[$today])
       ->count();
       

        $data=array('CallSum'=>$CallSum,'applications'=>$applications,'nowloged'=>$nowloged,'leads'=>$leads,'handled'=>$handled,'employees'=>$employees,'leads2'=>$leads2,'leadsActivity'=>$leadsActivity, 'testimonials'=>$testimonial,'test'=>$test,'test1'=>$test1,'AgentSum'=>$AgentSum,'AgentSum1'=>$AgentSum1,'AgentBreak'=>$AgentBreak,'AgentBreak2'=>$AgentBreak2,'totalBreak'=>$totalBreak);
        return view('crm2.index')->with($data);
    }

    //logs_leads
    public function logs_leads(){
        $this->updateMyLead2();
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://zalegoacademy.ac.ke/public/api/getApplications/JgqWTt76P4H2BZ3tFtWtE_RH9h4FU6QeHF9rUd6O",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_TIMEOUT => 30000,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                // Set Here Your Requesred Headers
                'Content-Type: application/json',
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            // dd("cURL Error #:" . $err);
        } else {
            $applications = json_decode($response);
        }



        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://zalegoacademy.ac.ke/public/api/getHandled/JgqWTt76P4H2BZ3tFtWtE_RH9h4FU6QeHF9rUd6O",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_TIMEOUT => 30000,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                // Set Here Your Requesred Headers
                'Content-Type: application/json',
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            // dd("cURL Error #:" . $err);
        } else {
            $handled = json_decode($response);
        }
$leads=DB::table('leads')
        ->orderBy('created_at','DESC')
      ->where('handler','=',Auth::user()->userId)
      ->where('achve_status','=',0)
        ->paginate(90);
$employees=DB::table('employees')
->where('achve_status','=',0)
->where('achve_status','=',0)
->get();

$success_leads=DB::table('leads')
    ->orderBy('created_at','DESC')
    ->where('handler','=',Auth::user()->userId)
    ->where('completeness','=','1')
    ->where('achve_status','=',0)
    ->paginate(500);

    $failed_leads=DB::table('leads')
    ->orderBy('created_at','DESC')
    ->where('handler','=',Auth::user()->userId)
    ->where('completeness','=','2')
    ->where('achve_status','=',0)
    ->paginate(500);
$data=array('applications'=>$applications,'leads'=>$leads,'handled'=>$handled,'employees'=>$employees,'failed_leads'=>$failed_leads,'success_leads'=>$success_leads);
return view('crm2.logs')->with($data);
    }

//converted leads


public function Lead_convert(Request $request){
    $fromdate=$request->input('fromdate');
    $todate=$request->input('todate');
  
    if($fromdate==''){
    $applications = DB::table('leads')
    ->join('lead_download', 'leads.customer','=','lead_download.customer')
    ->select('lead_download.school','leads.completeness','lead_download.last_comment','lead_download.name','leads.created_at','lead_download.phonenumber','lead_download.source_category','leads.dateComplete','leads.leadId')
    ->orderBy('created_at','DESC')
    ->get();
    }else{
        $applications = DB::table('leads')
        ->join('lead_download', 'leads.customer','=','lead_download.customer')
        ->select('lead_download.school','leads.completeness','lead_download.last_comment','lead_download.name','leads.created_at','lead_download.phonenumber','lead_download.source_category','leads.dateComplete','leads.leadId')
        ->where('leads.created_at','>',[$fromdate])
        ->where('leads.created_at','<',[$todate])
        ->get(); 

    }
   
    
//dd($applications);
$data=array('applications'=>$applications);
return view('crm2.leadconversion')->with($data);
}
    //lead actions
    public function leadActions(Request $request){
        $checks=$request->input('checks');
        $action=$request->input('action');
         $exportStatus=$request->input('exportStatus');
          $mode=$request->input('mode');
        $created_at=date('Y-m-d')." ".date('h:i:s A');

        if($action==1){
            //add to myleads
            

             if($checks!=""){

                for($x=0;$x<count($checks);$x++){
                        //check if we have the same deal taken already
                        $check=DB::select('SELECT *FROM leads WHERE customer=?',[$checks[$x]]);
                        if(count($check)>0){
                        Alert::warning('Warning','This deal has already been taken by another agent');
                             return back();
                        }
                    
                        $insert=DB::insert('INSERT INTO leads(customer,handler,status,created_at) VALUES(?,?,?,?)',[$checks[$x],Auth::user()->userId,'Active',$created_at]);
                        Http::get('https://zalegoacademy.ac.ke/public/api/updateHandler/'.$checks[$x].'/JgqWTt76P4H2BZ3tFtWtE_RH9h4FU6QeHF9rUd6O');
                }
                    if($insert){
                             Alert::success('Success','You have successfully added lead ');
                                return back();
                    }else{
                          Alert::warning('Warning','Unable to add lead. Try again!');
                                return back();
                    }


                }else{
                    //prompt user to select items
                     Alert::warning('Warning','Please select leads first in order to take action');
                    return back();
                }

            

        }
        elseif($action==2){
            //export
             if($checks!=""){

                      if($mode=="handled"){
                                 $curl = curl_init();
                        curl_setopt_array($curl, array(
                          
                            CURLOPT_URL => "https://zalegoacademy.ac.ke/public/api/getHandled/JgqWTt76P4H2BZ3tFtWtE_RH9h4FU6QeHF9rUd6O",
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_ENCODING => "",
                            CURLOPT_TIMEOUT => 30000,
                            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                            CURLOPT_CUSTOMREQUEST => "GET",
                            CURLOPT_HTTPHEADER => array(
                                // Set Here Your Requesred Headers
                                'Content-Type: application/json',
                            ),
                        ));
                        $response = curl_exec($curl);
                        $err = curl_error($curl);
                        curl_close($curl);

                        if ($err) {
                            // dd("cURL Error #:" . $err);
                        } else {
                            $applications = json_decode($response);
                        }
                           //empty the table first
                        DB::delete('DELETE FROM lead_download');
                        if($exportStatus=="all"){
                            $leads=DB::table('leads')
                                ->orderBy('created_at','DESC')
                              ->where('handler','=',Auth::user()->userId)
                                ->paginate(100000);

                            $deals=DB::table('deal_progress_option')
                                        ->get();
                            foreach($applications as $app){
                           foreach($leads as $ld){
                             if($app->id==$ld->customer){
                                $stage1_comment="";
                                $stage2_comment="";
                                $stage3_comment="";
                                $source_category="";
                                $last_comment="";
                                $call_stage="";
                                foreach($deals as $dl){
                                    if($dl->customer==$ld->customer && $dl->stage==2){
                                            $stage1_comment=$dl->comment;
                                        }
                                        elseif($dl->customer==$ld->customer && $dl->stage==3){
                                            $stage2_comment=$dl->comment;
                                        }
                                         elseif($dl->customer==$ld->customer && $dl->stage==4){
                                            $stage3_comment=$dl->comment;
                                        }
                            }

                            $last_comment=$ld->comment;
                            $source_category=$app->source_category;
                            $call_stage=$ld->level;
                            $customer=$ld->customer;
                            $completion=$ld->completeness;
                                DB::insert('INSERT INTO lead_download (name,email,phonenumber,gender,intake,school,created_at,category,call_stage,last_comment,stage1_comment,stage2_comment,stage3_comment,source_category,customer,completion) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)',[$app->name,$app->email,$app->phonenumber,$app->gender,$app->intake,$app->school,$app->created_at,$app->category,$call_stage,$last_comment,$stage1_comment,$stage2_comment,$stage3_comment,$source_category,$customer,$completion]);
                            
                            }
                           }
                           
                        }
                        }else{
                         $deals=DB::table('deal_progress_option')
                                        ->get();
                            $leads=DB::table('leads')
                                ->orderBy('created_at','DESC')
                              ->where('handler','=',Auth::user()->userId)
                                ->paginate(100000);
                            foreach($applications as $app){
                            for($x=0;$x<count($checks);$x++){
                             if($app->id==$checks[$x]){
                                $stage1_comment="";
                                $stage2_comment="";
                                $stage3_comment="";
                                $source_category="";
                                $last_comment="";
                                $call_stage="";
                                $customer="";
                                $completion="";
                                foreach($deals as $dl){
                                    if($dl->customer==$checks[$x] && $dl->stage==2){
                                            $stage1_comment=$dl->comment;
                                        }
                                        elseif($dl->customer==$checks[$x] && $dl->stage==3){
                                            $stage2_comment=$dl->comment;
                                        }
                                         elseif($dl->customer==$checks[$x] && $dl->stage==4){
                                            $stage3_comment=$dl->comment;
                                        }
                            }

                            foreach($leads as $ls){
                                if($ls->customer==$checks[$x]){
                                     $last_comment=$ls->comment;
                                     $call_stage=$ls->level;
                                     $customer=$ls->customer;
                                     $completion=$ls->completeness;
                                }
                            }
                           
                            $source_category=$app->source_category;
                            
                                DB::insert('INSERT INTO lead_download (name,email,phonenumber,gender,intake,school,created_at,category,call_stage,last_comment,stage1_comment,stage2_comment,stage3_comment,source_category,customer,completion) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)',[$app->name,$app->email,$app->phonenumber,$app->gender,$app->intake,$app->school,$app->created_at,$app->category,$call_stage,$last_comment,$stage1_comment,$stage2_comment,$stage3_comment,$source_category,$customer,$completion]);
                            }
                           }
                        }   
                        }
                            }elseif($mode=="applications"){
                                         $curl = curl_init();
                        curl_setopt_array($curl, array(
                          
                            CURLOPT_URL => "https://zalegoacademy.ac.ke/public/api/getApplications/JgqWTt76P4H2BZ3tFtWtE_RH9h4FU6QeHF9rUd6O",
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_ENCODING => "",
                            CURLOPT_TIMEOUT => 30000,
                            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                            CURLOPT_CUSTOMREQUEST => "GET",
                            CURLOPT_HTTPHEADER => array(
                                // Set Here Your Requesred Headers
                                'Content-Type: application/json',
                            ),
                        ));
                        $response = curl_exec($curl);
                        $err = curl_error($curl);
                        curl_close($curl);

                        if ($err) {
                            // dd("cURL Error #:" . $err);
                        } else {
                            $applications = json_decode($response);
                        }
                           //empty the table first
                        DB::delete('DELETE FROM lead_download');
                        if($exportStatus=="all"){
                              $leads=DB::table('leads')
                                ->orderBy('created_at','DESC')
                              ->where('handler','=',Auth::user()->userId)
                                ->paginate(100000);
                            foreach($applications as $app){
                           
                            
                                DB::insert('INSERT INTO lead_download (name,email,phonenumber,gender,intake,school,created_at,category) VALUES(?,?,?,?,?,?,?,?)',[$app->name,$app->email,$app->phonenumber,$app->gender,$app->intake,$app->school,$app->created_at,$app->category]);
                          
                          
                           
                        }
                        }else{
                            foreach($applications as $app){
                            for($x=0;$x<count($checks);$x++){
                             if($app->id==$checks[$x]){
                                DB::insert('INSERT INTO lead_download (name,email,phonenumber,gender,intake,school,created_at,category) VALUES(?,?,?,?,?,?,?,?)',[$app->name,$app->email,$app->phonenumber,$app->gender,$app->intake,$app->school,$app->created_at,$app->category]);
                            }
                           }
                        }  
                        }
                            }
                     
                        
                        $created_at=date('Y-m-d')." ".date('h:i:s A');
                         return Excel::download(new leadsExport, "Leads Excel-".$created_at.".xlsx");


                 }else{
                    //prompt user to select items
                     Alert::warning('Warning','Please select leads first in order to take action');
                    return back();
                }
        }elseif($action==0){
            //prompt user to select items
            Alert::warning('Warning','Please select leads first in order to take action');
                    return back();
        }elseif($action==12){
            //convert to successful
            if($checks!=""){

                if($exportStatus=="all"){
                            DB::update('UPDATE leads SET completeness=? WHERE completeness=? AND handler=?',[1,0,Auth::user()->userId]);
                        }else{
                              for($x=0;$x<count($checks);$x++){
                        //check if we have the same deal taken already
                        
                        DB::update('UPDATE leads SET completeness=? WHERE customer=?',[1,$checks[$x]]);
                        //$insert=DB::insert('INSERT INTO leads(customer,handler,status,created_at) VALUES(?,?,?,?)',[$checks[$x],Auth::user()->userId,'Active',$created_at]);
                        //Http::get('https://zalegoacademy.ac.ke/public/api/updateHandler/'.$checks[$x].'/JgqWTt76P4H2BZ3tFtWtE_RH9h4FU6QeHF9rUd6O');
                }
                        }

              
                    
                Alert::success('Success','Leads conversion done successfully');
                    return back();

                }else{
                    //prompt user to select items
                     Alert::warning('Warning','Please select leads first in order to take action');
                    return back();
                }
            
        }elseif($action==13){
            //convert to unsuccessful
             if($checks!=""){
                    if($exportStatus=="all"){
                             DB::update('UPDATE leads SET completeness=? WHERE completeness=? AND handler=?',[2,0,Auth::user()->userId]);
                             
                        }else{
                for($x=0;$x<count($checks);$x++){
                        //check if we have the same deal taken already
                        $check=DB::select('SELECT *FROM leads WHERE customer=?',[$checks[$x]]);
                       
                        DB::update('UPDATE leads SET completeness=? WHERE customer=?',[2,$checks[$x]]);
                        //$insert=DB::insert('INSERT INTO leads(customer,handler,status,created_at) VALUES(?,?,?,?)',[$checks[$x],Auth::user()->userId,'Active',$created_at]);
                        //Http::get('https://zalegoacademy.ac.ke/public/api/updateHandler/'.$checks[$x].'/JgqWTt76P4H2BZ3tFtWtE_RH9h4FU6QeHF9rUd6O');
                }
            }
                    
                Alert::success('Success','Leads conversion done successfully');
                    return back();

                }else{
                    //prompt user to select items
                     Alert::warning('Warning','Please select leads first in order to take action');
                    return back();
                }
            Alert::success('Success','Leads conversion done successfully');
                    return back();
        }
        elseif($action==14){
            //convert to active
             if($checks!=""){
                if($exportStatus=="all"){
                            DB::update('UPDATE leads SET completeness=? WHERE completeness=? AND handler=?',[0,0,Auth::user()->userId]);
                        }else{
                for($x=0;$x<count($checks);$x++){
                        //check if we have the same deal taken already
                      
                        DB::update('UPDATE leads SET completeness=? WHERE customer=?',[0,$checks[$x]]);
                        //$insert=DB::insert('INSERT INTO leads(customer,handler,status,created_at) VALUES(?,?,?,?)',[$checks[$x],Auth::user()->userId,'Active',$created_at]);
                        //Http::get('https://zalegoacademy.ac.ke/public/api/updateHandler/'.$checks[$x].'/JgqWTt76P4H2BZ3tFtWtE_RH9h4FU6QeHF9rUd6O');
                }
            }
                    
                Alert::success('Success','Leads conversion done successfully');
                    return back();

                }else{
                    //prompt user to select items
                     Alert::warning('Warning','Please select leads first in order to take action');
                    return back();
                }
            Alert::success('Success','Leads conversion done successfully');
                    return back();
        }elseif($action==24){
             if($checks!=""){

                for($x=0;$x<count($checks);$x++){
                      //delete lead from leads table
                        $delete=DB::delete('DELETE FROM leads WHERE customer=?',[$checks[$x]]);
                        //$insert=DB::insert('INSERT INTO leads(customer,handler,status,created_at) VALUES(?,?,?,?)',[$checks[$x],Auth::user()->userId,'Active',$created_at]);

                        //update applications table in zalegoacademy server
                        
                        Http::get('https://zalegoacademy.ac.ke/public/api/updateHandler2/'.$checks[$x].'/JgqWTt76P4H2BZ3tFtWtE_RH9h4FU6QeHF9rUd6O');
                }
                    if($delete){
                             Alert::success('Success','You have successfully moved leads back to lead logs ');
                                return back();
                    }else{
                          Alert::warning('Warning','Unable to move leads. Try again!');
                                return back();
                    }


                }else{
                    //prompt user to select items
                     Alert::warning('Warning','Please select leads first in order to take action');
                    return back();
                }
        }
        
        
        
        //add archive
        elseif($action==121){
            //convert to active
             if($checks!=""){
                if($exportStatus=="all"){
                            DB::update('UPDATE leads SET achve_status=1 WHERE achve_status=0');
                        }else{
                for($x=0;$x<count($checks);$x++){
                        //check if we have the same deal taken already
                      
                        DB::update('UPDATE leads SET achve_status=? WHERE customer=?',[1,$checks[$x]]);
                        //$insert=DB::insert('INSERT INTO leads(customer,handler,status,created_at) VALUES(?,?,?,?)',[$checks[$x],Auth::user()->userId,'Active',$created_at]);
                        //Http::get('https://zalegoacademy.ac.ke/public/api/updateHandler/'.$checks[$x].'/JgqWTt76P4H2BZ3tFtWtE_RH9h4FU6QeHF9rUd6O');
                }
            }
                    
                Alert::success('Success','Leads conversion done successfully');
                    return back();

                }else{
                    //prompt user to select items
                     Alert::warning('Warning','Please select leads first in order to take action');
                    return back();
                }
            Alert::success('Success','Leads conversion done successfully');
                    return back();
        }
       //end of archive
          elseif($action==20){
            //convert to active
             if($checks!=""){
                      $curl = curl_init();
                        curl_setopt_array($curl, array(
                          
                            CURLOPT_URL => "https://zalegoacademy.ac.ke/public/api/getHandled/JgqWTt76P4H2BZ3tFtWtE_RH9h4FU6QeHF9rUd6O",
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_ENCODING => "",
                            CURLOPT_TIMEOUT => 30000,
                            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                            CURLOPT_CUSTOMREQUEST => "GET",
                            CURLOPT_HTTPHEADER => array(
                                // Set Here Your Requesred Headers
                                'Content-Type: application/json',
                            ),
                        ));
                        $response = curl_exec($curl);
                        $err = curl_error($curl);
                        curl_close($curl);

                        if ($err) {
                            // dd("cURL Error #:" . $err);
                        } else {
                            $applications = json_decode($response);
                        }
                           //empty the table first
                        DB::delete('DELETE FROM lead_download');
                        if($exportStatus=="all"){
                              $leads=DB::table('leads')
                                ->orderBy('created_at','DESC')
                              ->where('handler','=',Auth::user()->userId)
                                ->paginate(100000);

                            $deals=DB::table('deal_progress_option')
                                        ->get();
                            foreach($applications as $app){
                           foreach($leads as $ld){
                             if($app->id==$ld->customer){
                                $stage1_comment="";
                                $stage2_comment="";
                                $stage3_comment="";
                                $source_category="";
                                $last_comment="";
                                $call_stage="";
                                $next_date="";
                                foreach($deals as $dl){
                                    if($dl->customer==$ld->customer && $dl->stage==2){
                                            $stage1_comment=$dl->comment;
                                        }
                                        elseif($dl->customer==$ld->customer && $dl->stage==3){
                                            $stage2_comment=$dl->comment;
                                        }
                                         elseif($dl->customer==$ld->customer && $dl->stage==4){
                                            $stage3_comment=$dl->comment;
                                        }

                                if($dl->stage==$ld->level){
                                    $next_date=$dl->nextDate;
                                }
                            }

                            $last_comment=$ld->comment;
                            $source_category=$app->source_category;
                            $call_stage=$ld->level;
                            $customer=$ld->customer;
                            $completion=$ld->completeness;
                                DB::insert('INSERT INTO lead_download (name,email,phonenumber,gender,intake,school,created_at,category,call_stage,last_comment,stage1_comment,stage2_comment,stage3_comment,source_category,customer,completion,next_date) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)',[$app->name,$app->email,$app->phonenumber,$app->gender,$app->intake,$app->school,$app->created_at,$app->category,$call_stage,$last_comment,$stage1_comment,$stage2_comment,$stage3_comment,$source_category,$customer,$completion,$next_date]);
                            
                            }
                           }
                           
                        }
                        }else{
                            $deals=DB::table('deal_progress_option')
                                        ->get();
                            $leads=DB::table('leads')
                                ->orderBy('created_at','DESC')
                              ->where('handler','=',Auth::user()->userId)
                                ->paginate(100000);
                            foreach($applications as $app){
                            for($x=0;$x<count($checks);$x++){
                             if($app->id==$checks[$x]){
                                $stage1_comment="";
                                $stage2_comment="";
                                $stage3_comment="";
                                $source_category="";
                                $last_comment="";
                                $call_stage="";
                                $customer="";
                                $completion="";
                                $next_date="";
                                $lv="";

                                foreach($leads as $ls){
                                if($ls->customer==$checks[$x]){
                                     $last_comment=$ls->comment;
                                     $call_stage=$ls->level;
                                     $customer=$ls->customer;
                                     $completion=$ls->completeness;
                                     $lv=$ls->level;
                                }
                                 
                            }

                                foreach($deals as $dl){
                                    if($dl->customer==$checks[$x] && $dl->stage==2){
                                            $stage1_comment=$dl->comment;
                                        }
                                        elseif($dl->customer==$checks[$x] && $dl->stage==3){
                                            $stage2_comment=$dl->comment;
                                        }
                                         elseif($dl->customer==$checks[$x] && $dl->stage==4){
                                            $stage3_comment=$dl->comment;
                                        }

                                        if($dl->stage==$lv){
                                    $next_date=$dl->nextDate;
                                }
                            }


                           
                            $source_category=$app->source_category;
                            
                                DB::insert('INSERT INTO lead_download (name,email,phonenumber,gender,intake,school,created_at,category,call_stage,last_comment,stage1_comment,stage2_comment,stage3_comment,source_category,customer,completion,next_date) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)',[$app->name,$app->email,$app->phonenumber,$app->gender,$app->intake,$app->school,$app->created_at,$app->category,$call_stage,$last_comment,$stage1_comment,$stage2_comment,$stage3_comment,$source_category,$customer,$completion,$next_date]);
                            }
                           }
                        }  
                        }
                    
                  $created_at=date('Y-m-d')." ".date('h:i:s A');
                         return Excel::download(new leadsExport, "Leads Excel-".$created_at.".xlsx");

                }else{
                    //prompt user to select items
                     Alert::warning('Warning','Please select leads first in order to take action');
                    return back();
                }
            Alert::success('Success','Leads conversion done successfully');
                    return back();
        }
    }

    //add lead
    public function add_Lead(){
        return view('crm2.add_lead');
    }

    //contacts
    public function contacts(){
         $this->updateMyLead2();
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://zalegoacademy.ac.ke/public/api/getApplications/JgqWTt76P4H2BZ3tFtWtE_RH9h4FU6QeHF9rUd6O",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_TIMEOUT => 30000,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                // Set Here Your Requesred Headers
                'Content-Type: application/json',
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            // dd("cURL Error #:" . $err);
        } else {
            $applications = json_decode($response);
        }


        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://zalegoacademy.ac.ke/public/api/getHandled/JgqWTt76P4H2BZ3tFtWtE_RH9h4FU6QeHF9rUd6O",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_TIMEOUT => 30000,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                // Set Here Your Requesred Headers
                'Content-Type: application/json',
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            // dd("cURL Error #:" . $err);
        } else {
            $handled = json_decode($response);
        }
$leads=DB::table('leads')
        ->orderBy('created_at','DESC')
      ->where('handler','=',Auth::user()->userId)
        ->paginate(10);
$employees=DB::table('employees')
->where('achve_status','=',0)
->get();

$success_leads=DB::table('leads')
    ->orderBy('created_at','DESC')
    ->where('handler','=',Auth::user()->userId)
    ->where('completeness','=','1')
    ->paginate(500);

    $failed_leads=DB::table('leads')
    ->orderBy('created_at','DESC')
    ->where('handler','=',Auth::user()->userId)
    ->where('completeness','=','2')
    ->paginate(500);
$data=array('applications'=>$applications,'leads'=>$leads,'handled'=>$handled,'employees'=>$employees,'failed_leads'=>$failed_leads,'success_leads'=>$success_leads);
return view('crm2.contacts')->with($data);
    }


       //filter leads
    public function filterLeads(Request $request){
        $indexx=$request->input('from');
        $page=$request->input('page');
          $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://zalegoacademy.ac.ke/public/api/filterLeads/JgqWTt76P4H2BZ3tFtWtE_RH9h4FU6QeHF9rUd6O/".$indexx,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_TIMEOUT => 30000,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                // Set Here Your Requesred Headers
                'Content-Type: application/json',
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            // dd("cURL Error #:" . $err);
        } else {
            $handled = json_decode($response);
        }

        $leads=DB::table('leads')
        ->orderBy('created_at','DESC')
      ->where('handler','=',Auth::user()->userId)
        ->paginate(10000);

        $leads2=DB::table('leads')
           ->leftJoin('deal_progress_option','deal_progress_option.customer','=','leads.customer')
       ->orderBy('leads.created_at','DESC')
     ->where('handler','=',Auth::user()->userId)
        ->get();

        // $leads2=DB::table('deal_progress_option')
          //  ->leftJoin('deal_progress_option','deal_progress_option.customer','=','leads.customer')
       // ->orderBy('leads.created_at','DESC')
      //->where('handler','=',Auth::user()->userId)
        // ->get();
$employees=DB::table('employees')
->where('achve_status','=',0)
->get();

$success_leads=DB::table('leads')
    ->orderBy('created_at','DESC')
    ->where('handler','=',Auth::user()->userId)
    ->where('completeness','=','1')
    ->paginate(500);

    $failed_leads=DB::table('leads')
    ->orderBy('created_at','DESC')
    ->where('handler','=',Auth::user()->userId)
    ->where('completeness','=','2')
    ->paginate(500);

    $lead_reasons=DB::table('lead_reasons') 
        ->get();
$deal_reasons=DB::table('deal_reasons')
        ->get();
$deal_progress_reports=DB::table('deal_progress_option')
        ->get();
$lead_progress_reports=DB::table('lead_progress_options')
        ->get();
        
$data=array('leads'=>$leads,'leads2'=>$leads2,'handled'=>$handled,'employees'=>$employees,'failed_leads'=>$failed_leads,'success_leads'=>$success_leads,'lead_reasons'=>$lead_reasons,'deal_reasons'=>$deal_reasons,'deal_progress_reports'=>$deal_progress_reports,'lead_progress_reports'=>$lead_progress_reports);
if($page=="leads"){
    return view('crm2.leads')->with($data);
}elseif($page=="contact"){
 return view('crm2.contacts')->with($data);  
}

    }


    public function leads($index){
        $this->updateMyLead2();
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://zalegoacademy.ac.ke/public/api/getApplications/JgqWTt76P4H2BZ3tFtWtE_RH9h4FU6QeHF9rUd6O",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_TIMEOUT => 30000,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                // Set Here Your Requesred Headers
                'Content-Type: application/json',
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            // dd("cURL Error #:" . $err);
        } else {
            $applications = json_decode($response);
        }


        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://zalegoacademy.ac.ke/public/api/getHandled/JgqWTt76P4H2BZ3tFtWtE_RH9h4FU6QeHF9rUd6O",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_TIMEOUT => 30000,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                // Set Here Your Requesred Headers
                'Content-Type: application/json',
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            // dd("cURL Error #:" . $err);
        } else {
            $handled = json_decode($response);
        }
if($index=="active"){
    $leads=DB::table('leads')
        ->orderBy('leads.created_at','DESC')
      ->where('handler','=',Auth::user()->userId)
      ->where('leads.completeness','=',0)
       ->where('leads.level','!=',15)
        ->paginate(10);
}elseif($index=="success")
{
  $leads=DB::table('leads')
        ->orderBy('leads.created_at','DESC')
      ->where('handler','=',Auth::user()->userId)
      ->where('leads.completeness','=',1)
      ->where('leads.level','!=',15)
        ->paginate(10);
}elseif($index=="failed")
{
      $leads=DB::table('leads')
        ->orderBy('leads.created_at','DESC')
      ->where('handler','=',Auth::user()->userId)
      ->where('leads.completeness','=',2)
      ->where('leads.level','!=',15)
        ->paginate(10);
}
elseif($index=="waiting")
{
      $leads=DB::table('leads')
        ->orderBy('leads.created_at','DESC')
      ->where('handler','=',Auth::user()->userId)
      ->where('leads.completeness','=',15)
      ->where('leads.level','=',15)
        ->paginate(10);
}
elseif($index=="calls")
{
     $leads=DB::table('leads')
       ->leftJoin('deal_progress_option','deal_progress_option.customer','=','leads.customer')
        ->orderBy('leads.created_at','DESC')
      ->where('handler','=',Auth::user()->userId)
      ->where('leads.completeness','=',0)
      ->where('leads.level','!=',15)
      ->where('deal_progress_option.nextDate','=',date('Y-m-d'))
        ->paginate(10); 
}



        $leads2=DB::table('leads')
           ->leftJoin('deal_progress_option','deal_progress_option.customer','=','leads.customer')
       ->orderBy('leads.created_at','DESC')
     ->where('handler','=',Auth::user()->userId)
        ->get();

$employees=DB::table('employees')
->where('achve_status','=',0)
->get();

$success_leads=DB::table('leads')
    ->orderBy('created_at','DESC')
    ->where('handler','=',Auth::user()->userId)
    ->where('completeness','=','1')
    ->paginate(500);

    $failed_leads=DB::table('leads')
    ->orderBy('created_at','DESC')
    ->where('handler','=',Auth::user()->userId)
    ->where('completeness','=','2')
    ->paginate(500);

$lead_reasons=DB::table('lead_reasons') 
        ->get();
$deal_reasons=DB::table('deal_reasons')
        ->get();
$deal_progress_reports=DB::table('deal_progress_option')
        ->get();
$lead_progress_reports=DB::table('lead_progress_options')
        ->get();

$data=array('applications'=>$applications,'leads'=>$leads,'handled'=>$handled,'employees'=>$employees,'failed_leads'=>$failed_leads,'success_leads'=>$success_leads,'lead_reasons'=>$lead_reasons,'deal_reasons'=>$deal_reasons,'deal_progress_reports'=>$deal_progress_reports,'lead_progress_reports'=>$lead_progress_reports,'leads2'=>$leads2);
return view('crm2.leads')->with($data);
    }

    public function updateMyLead2(){


 ini_set('max_execution_time','1080');
    //do an update on the actual data on zalego academy
    $leads=DB::table('leads')
    ->orderBy('created_at','DESC')
    ->where('handler','=',Auth::user()->userId)
    ->get();

       $response = Http::get('https://zalegoacademy.ac.ke/public/api/getApplications/JgqWTt76P4H2BZ3tFtWtE_RH9h4FU6QeHF9rUd6O');
$handled = Http::get('https://zalegoacademy.ac.ke/public/api/getHandled/JgqWTt76P4H2BZ3tFtWtE_RH9h4FU6QeHF9rUd6O');
/**if($response['response_status']=='0'){
Alert::error('Error','Invalid api authentication');
       return back();
}**/
$applications=$response->json();
$handled=$handled->json();


//add walk in leads
if(!empty($applications)){
foreach($applications as $app){
    if($app['source_category']=='1' && $app['handler']==Auth::user()->userId){
        //add your leads
          //check if we have the same deal taken already
         $check=DB::select('SELECT *FROM leads WHERE customer=?',[$app['id']]);
         if(count($check)>0){
            //do  Http::get('https://zalegoacademy.ac.ke/public/api/updateHandler/'.$app['id'].'/JgqWTt76P4H2BZ3tFtWtE_RH9h4FU6QeHF9rUd6O');
           Http::get('https://zalegoacademy.ac.ke/public/api/updateHandler/'.$app['id'].'/JgqWTt76P4H2BZ3tFtWtE_RH9h4FU6QeHF9rUd6O');
         }else{
            $created_at=date('Y-m-d')." ".date('h:i:s A');
              $insert=DB::insert('INSERT INTO leads(customer,handler,status,created_at) VALUES(?,?,?,?)',[$app['id'],Auth::user()->userId,'Active',$created_at]);
              Http::get('https://zalegoacademy.ac.ke/public/api/updateHandler/'.$app['id'].'/JgqWTt76P4H2BZ3tFtWtE_RH9h4FU6QeHF9rUd6O');
         }
        
      
    }
}

$success=1;
//return response()->json(array('success'=>$success),200);
          return back(); 
}else{
  Alert::warning('Warning','The request has timed out, Please retry');
          return back(); 
}

    }



    //upload offline work
    public function uploadOffline(Request $request){
        
          try{

            Excel::import(new offlineImports,request()->file('filed'));
     Alert::success('Success','Uploaded offline work successfully');
          return back(); 
        }catch(\Exception $ex){

            Alert::warning('Warning','Something has gone wrong with the upload. Please confirm if your columns match the expected format');
          return back(); 
        }
    }



    public function text(){
        $nextDate="16/01/2024";
        $dNext="";
         if(substr($nextDate, 0, 2)>=12){
                            $dNext=substr($nextDate, 2,1);
                          }
        echo $dNext;
    }

    
    





    //login logout log
    public static function GetLogs() {
        $userID2=auth()->user()->email;
        $testimonial1 = DB::table('history_log')
        ->join('users', 'history_log.userid', '=', 'users.id')
        ->select('history_log.login_time','history_log.email_address','history_log.logout_time','users.name')
        ->orderBy('login_time', 'DESC')
        ->where('email_address',[$userID2])
        ->where('logout_time','=',NULL)
        ->get();
        //->sum('email_address');
        //->get(['email_address', DB::raw('SUM(email_address)')]);
        

        return $testimonial1;

        }
      

        public static function logs()
        {
           
            $userID2=auth()->user()->email;
            $testimonial = DB::table('history_log')
            ->select('login_time')
            ->limit(1)
            ->orderBy('login_time', 'DESC')
            ->where('email_address',[$userID2])
            ->where('logout_time','=',NULL)
            ->get();
            
            return $testimonial1;
        }
    //end
    //agent take a break    
      public function takeBreak(Request $request){

        $break = $request->break;
        $userID2=auth()->user()->email;
        $actions ="Has taken a break ";
       // $logout_time = date("Y-m-d H:i:s",strtotime("+0 HOURS"));
        date_default_timezone_set("Africa/Nairobi");
        $logout_time = date("Y-m-d 00:00:00",strtotime("+0 HOURS"));
        $insert=DB::update("UPDATE history_log SET break_time='$break',logout_time='$logout_time',actions='$actions',break=2 Where email_address=? AND logout_time='NULL'",[$userID2]);
        Alert::success('Success','You have successfully taken a break');
                    //return back();
                    Auth::logout();
                    return redirect('/login'); 
     }
      public function callagentBreak(Request $request) {


         $estates = DB::table('history_log')
         ->join('users', 'history_log.userid', '=', 'users.id')
         ->select('history_log.logout_time','history_log.login_time','history_log.email_address','history_log.break_time','users.name','users.email')
         ->orderBy('login_time', 'DESC')
         ->where('break',[1])
         ->where('actions','=','Has taken a break')
         ->where('break_time','!=',['NULL'])
         ->get();

        $persons = json_decode($estates);
        date_default_timezone_set("Africa/Nairobi");
        $timenow = date("Y-m-d H:i:s",strtotime("+0 HOURS")); 
        dd($persons);
        
     foreach ($persons as $person) {
        $email= $person->email_address; 
        $name=$person->name; 
        $break =$person->break_time;
        $logout=$person->logout_time;
       // dd($break);
       $email2=$person->email;


        if($break>=1){
            $minut="Hours";
            $break1=$break ." ".$minut;
            $dateline1=date('Y-m-d H:i:s',strtotime($break1,strtotime($logout)));
           //excecute email here
         // dd($dateline1);
           if($dateline1==$timenow){
            $email1=$email;
            $data = array('name'=>"CRM Reminder");
            Mail::send(['text'=>'mail'],$data, function($message) use ($email1) {
              $email2=$email1;
              $reciever=$email2;
              //dd($email1);
               $message->to($reciever, 'Please Login Back to the system')->subject
                  ('Break Is Over');
              $message->from('test@zalegoinstitute.ac.ke','CRM Reminder');
            });
           }

           //end of email
           }
           if($break<1){
            $break3 =round($break*60,1);
            $break4 =round($break3,0);
            $break5 = (int)$break4; 
            $break2="+".$break5." "."Minutes";
            $dateline2=date('Y-m-d H:i:s',strtotime($break2,strtotime($logout)));
          

            //execute email here
            if($dateline2==$timenow){
             $email1="patrick@zalda.net";
              $data = array('name'=>"CRM Reminder");
              Mail::send(['text'=>'mail'],$data, function($message) use ($email1) {
                $email2=$email1;
                $reciever=$email2;
                //dd($email1);
                 $message->to($reciever, 'Please Login Back to the system')->subject
                    ('Break Is Over');
                $message->from('test@zalegoinstitute.ac.ke','CRM Reminder');
              });
                 
            }

           }  
        }
       return 200;
      }

      
        public function subscribe() {
           
        setInterval('callagentBreak()' ,450);

        }



        //agent total shift reports
        public function agentReports(Request $request){
            $shift = DB::table('history_log')
            ->join('users', 'history_log.userid', '=', 'users.id')
            ->select('history_log.login_time','history_log.email_address','history_log.host','history_log.logout_time','history_log.ip','users.name')
            ->orderBy('login_time', 'DESC')
            ->groupBy('email_address')
            ->groupBy('host')
            ->where('logout_time','!=',NULL)
            ->where('login_time', '>=', Carbon::now()->subMonth())
            ->get();

            
         //agent todays shift reports
            $shift1 = DB::table('history_log')
            ->join('users', 'history_log.userid', '=', 'users.id')
            ->select('history_log.login_time','history_log.email_address','history_log.host','history_log.logout_time','history_log.ip','users.name')
            ->orderBy('login_time', 'desc')
            ->groupBy('email_address')
            ->groupBy('host')
            ->where('logout_time','!=',NULL)
            ->where('login_time','>=',Carbon::today())
            ->get();
            






            //general shift reports
            $shift2 = DB::table('history_log')
            ->join('users', 'history_log.userid', '=', 'users.id')
            ->select('history_log.login_time','history_log.email_address','history_log.host','history_log.logout_time','history_log.ip','history_log.break_time','users.name')
            ->orderBy('login_time','DESC')
            //->groupBy('email_address')
            //->groupBy('host')
            ->where('logout_time','!=',NULL)
            //->where('login_time','>=',Carbon::today())
            ->get();
            //general weekly shift
            $shift3 = DB::table('history_log')
            ->join('users', 'history_log.userid', '=', 'users.id')
            ->select('history_log.login_time','history_log.email_address','history_log.host','history_log.logout_time','history_log.ip','users.name')
            ->orderBy('login_time', 'DESC')
            ->groupBy('email_address')
            ->groupBy('host')
            ->where('logout_time','!=',NULL)
            ->where('login_time', '>=', Carbon::now()->subWeek())
            ->get();
            //filter users
        $filteruser = DB::table('users')
        //->select('name','id','email_address')
        //->orderBy('id','DESC')
        ->get();
    $data=array('shift'=>$shift,'shift1'=>$shift1,'shift2'=>$shift2,'shift3'=>$shift3,'filteruser'=>$filteruser);
   
     return view('crm2.shiftReport')->with($data);  
        }




    public function filterbydate(Request $request)
    {
        $userID2=auth()->user()->email;
        $filter_user=$request->input('shiftuser');
        $filter_date=$request->input('shiftdate');
        
        //dd($filter_date);
        $filetr= $request->input('shiftdate');
        $filterdate1=date('Y-m-d 00:00:00', strtotime('0 hours', strtotime($filter_date)));
        $filterdate2=date('Y-m-d 00:00:00', strtotime('24 hours', strtotime($filter_date)));
       
        //first login
        $filter = DB::table('history_log')
        ->join('users', 'history_log.userid', '=', 'users.id')
        ->select('history_log.login_time','history_log.email_address','history_log.host','history_log.logout_time','history_log.ip','users.name')
        ->where('login_time', '>=', [$filterdate1])
        ->where('login_time', '<=', [$filterdate2])
        ->orderBy('login_time','ASC')
        ->where('email_address', '=', [$filter_user])
        ->limit(1)
        ->get();
        //dd($filter);


        //last login
        $filter1 = DB::table('history_log')
        ->join('users', 'history_log.userid', '=', 'users.id')
        ->select('history_log.login_time','history_log.email_address','history_log.host','history_log.logout_time','history_log.ip','users.name')
        ->where('login_time', '>=', [$filterdate1])
        ->where('login_time', '<=', [$filterdate2])
        ->orderBy('login_time','DESC')
        ->where('email_address', '=', [$filter_user])
        ->limit(1)
        ->get();
        // dd($filter1);
        $filterbreak=DB::table('history_log')
        ->join('users', 'history_log.userid', '=', 'users.id')
        ->select('history_log.login_time','history_log.email_address','history_log.host','history_log.logout_time','history_log.ip','users.name')
        ->where('login_time', '>=', [$filterdate1])
        ->where('login_time', '<=', [$filterdate2])
        ->where('logout_time', '!=', NULL)
        ->where('email_address', '=', [$filter_user])
        ->count();
        //dd($filterbreak);
        $totalBreak = DB::table('history_log')
        ->where('login_time', '>=', [$filterdate1])
        ->where('login_time', '<=', [$filterdate2])
        ->where('logout_time', '!=', NULL)
        ->where('email_address', '=', [$filter_user])
        ->get()
        ->sum('break_time');
        //dd($totalBreak);

         

        $data=array('filter'=>$filter,'filter1'=>$filter1,'filterbreak'=>$filterbreak,'totalBreak'=>$totalBreak);
        return view('crm2.dailyshift')->with($data);
    }
    public function viewAgentlocation(Request $request)
    {
        $agent=$request->input('agent');
        $time=$request->input('time');
        
        $location = DB::table('history_log')
        ->select('login_time','email_address','latitude','longitude','logout_time','ip')
        ->where('login_time','=',[$time])
        ->where('email_address',[$agent])
       // ->orderBy('login_time','asc')
        ->get();
       // dd($location->longitude);
    //    $lat = YOUR_CURRENT_LATTITUDE;
    //   $lon = YOUR_CURRENT_LONGITUDE;
          
    //    DB::table("posts")
    //        ->select("posts.id"
    //           ,DB::raw("6371 * acos(cos(radians(".$lat.")) 
    //           * cos(radians(posts.lat)) 
    //           * cos(radians(posts.lon) - radians(".$lon.")) 
    //           + sin(radians(".$lat.")) 
    //           * sin(radians(posts.lat))) AS distance"))
    //           ->groupBy("posts.id")
    //           ->get();


      
        $data=array('location'=>$location);
        return view('crm2.agentlocation')->with($data);  
    }

       
public function callLogs(Request $request)
{
       
     
    return 200;
}
    public function callDashboard(Request $request){
       //data population
       //get first and last name
       date_default_timezone_set("Africa/Nairobi");
       $today = date("Y-m-d",strtotime("+0 HOURS"));
       $firstName=Auth::user()->firstname;
       $lastName=Auth::user()->lastname;
       $callerID=$firstName."".$lastName;
       //total call per day
          $CallSum = DB::table("call_logs")
          ->select('caller_id')
           ->where('caller_id',[$callerID])
           ->where('call_time','>=',[$today])
           ->count();
        //sucessful calls
           $CallSum1 = DB::table("call_logs")
           ->select('caller_id')
               ->where('caller_id',[$callerID])
               ->where('call_time','>=',[$today])
               ->where('reasons','!=','Failed')
               ->count();
         //failed calls
           $CallSum2 = DB::table("call_logs")
           ->select('caller_id')
              ->where('caller_id',[$callerID])
              ->where('call_time','>=',[$today])
             ->where('reasons','=','Failed')
             ->count();
         //my daily calls
         $mycalls=DB::table('call_logs')
        ->where('call_time','=',[$today])
        ->where('caller_id','=',[$callerID])
         ->get();
         //all daily calls
         $allcalls=DB::table('call_logs')
         ->where('call_time','=',[$today])
         ->get();

       
         $data=array('CallSum'=>$CallSum,'CallSum1'=>$CallSum1,'CallSum2'=>$CallSum2,'mycalls'=>$mycalls,'allcalls'=>$allcalls);
         return view('crm2.calldashboard')->with($data);  
    } 
    
    //call reports in details

    public function callReports(Request $request)
    {
        $userID2=auth()->user()->email;
        $filter_user=$request->input('shiftuser');
        $filter_date=$request->input('shiftdate');

        //filter by date
        $filterbydate = DB::table('call_logs')
        ->where('call_time', '>=', [$filterdate1])
        ->where('date_created', '<=', [$filterdate2])
        ->orderBy('date_created','DESC')
        ->where('call_id', '=', [$callerID])
        ->get();

        //filter by individual
        $filterbyagent = DB::table('call_logs')
        ->where('call_time', '>=', [$filterdate1])
        ->where('date_created', '<=', [$filterdate2])
        ->orderBy('login_time','DESC')
        ->where('caller_id', '=', [$filter_user])
        ->get();

        //filter by day/daily report
        $filterday = DB::table('call_logs')
        ->where('call_time', '>=', Carbon::now()->today())
        ->orderBy('date_created','DESC')
        ->get();

        //weekly report
        $filterbyweek = DB::table('call_logs')
        ->where('call_time', '<=', Carbon::now()->subWeek())
        ->orderBy('date_created','DESC')
        ->get();

        //monthly report
        $filterbymonth = DB::table('call_logs')
        ->where('call_time', '<=', Carbon::now()->month())
        ->orderBy('date_created','DESC')
        ->get();

        $data=array('filterbydate'=>$filterbydate,'filterbyagent'=>$filterbyagent,'filterday'=>$filterday,'filterbyweek'=>$filterbyweek,'filterbymonth'=>$filterbymonth);
        return view('crm2.callreports')->with($data); 
    }
    
    public function makecall(Request $request){
        $userID2=auth()->user()->email;
        $subject=$request->input('shiftuser');
        $description=$request->input('shiftdate');
     //add call script
     
     


     //end

     //view call script




     //

     




          return view('crm2.makecall');  
     } 
}
