<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use DB;
use Auth;
use Carbon;
use App\Employee;

class PerformanceController extends Controller
{

public function empKpiTracker(){
 $user=Auth::user();
 $user_id=$user->userId;
 $kpis=DB::table('perfomance_indicators')
        ->get();
$data=array('kpis'=>$kpis);
  return view('perfomance.empKpiTracker')->with($data);
}

public function empPerformanceTracker(){
 $user=Auth::user();
 $user_id=$user->userId;
 $points=DB::table('employee_perfomances')
            ->join('perfomance_indicators','perfomance_indicators.id','=','employee_perfomances.perfomanceKey')
            ->join('employees','employees.userId','=','employee_perfomances.employee_id')
            ->where('employee_perfomances.employee_id',$user_id)
            ->select('employee_perfomances.id','employee_perfomances.updated_at',
            	     'perfomance_indicators.perfomanceKey','perfomance_indicators.perfomancePoint')
            ->get();
 $deductPoints=DB::table('employee_perfomances')
            ->join('perfomance_indicators','perfomance_indicators.id','=','employee_perfomances.deductPoint')
            ->join('employees','employees.userId','=','employee_perfomances.employee_id')
            ->where('employee_perfomances.employee_id',$user_id)
            ->select('employee_perfomances.id','employee_perfomances.updated_at',
            	     'perfomance_indicators.perfomanceKey','perfomance_indicators.perfomancePoint')
            ->get();
    $employee=DB::table('employees')
                ->join('departments', 'departments.id', '=', 'employees.departmentId')
                ->where('employees.userId',$user_id)
                ->select('employees.employeeNumber', 'employees.firstname',
                'employees.lastname','employees.surname','departments.department')->get();
  return view('perfomance.empPerformanceTracker',compact('points','employee','deductPoints'));
}
public function empOvertime(){
    $user=Auth::user();
    $user_id=$user->userId;
    $employeeNumber=DB::select('select employeeNumber from employees where userId=?',[$user_id]);
    // $employeeNumber=json_encode($employeeNumber);
    $emp=$employeeNumber[0];
     $employees=DB::table('employees')
                    ->join('departments','departments.id','=','employees.departmentId')
                    ->join('companies','companies.id','=','employees.companyId')
                    ->where('employees.employeeNumber',$emp)
                    ->get();
                    // dd('done');
        $overtime=DB::table('overtime')
        ->join('employees','employees.employeeNumber','overtime.employee_id')
        ->where('employees.employeeNumber',$emp)
        ->get();
        dd($overtime);
}
public function empDisciplinary(){
    $user=Auth::user();
    $userId=$user->userId;
        
        $disciplinary=DB::table('disciplinary')
        ->where('employee_id',$userId)
        ->get(['disciplinary.id','disciplinary.status','mailReply_id','invitation_id','action_id','showCauseMail_id']);


         $datas=DB::table('disciplinary')
        ->join('employees','employees.userId','disciplinary.employee_id')
        ->join('show_cause_mail','show_cause_mail.id','disciplinary.showCauseMail_id')
        ->select('disciplinary.id','disciplinary.employee_id','disciplinary.showCauseMail_id','disciplinary.mailReply_id'
            ,'disciplinary.invitation_id','disciplinary.action_id','disciplinary.status','disciplinary.cases','employees.surname',
            'employees.firstname','employees.lastname','show_cause_mail.subject')
            ->where('employees.userId',$userId)
        ->get();

        $caseMail=DB::table('show_cause_mail')
                ->join('disciplinary','show_cause_mail.id','disciplinary.showCauseMail_id')
                ->select('show_cause_mail.id','show_cause_mail.employee_id','show_cause_mail.hr_id','show_cause_mail.subject',
                    'show_cause_mail.message','show_cause_mail.attachment','show_cause_mail.created_at')
                    ->where('show_cause_mail.employee_id',$userId)
                ->get();
                
        $replyMail=DB::table('reply_mail')
                ->join('disciplinary','reply_mail.id','disciplinary.mailReply_id')
                ->select('reply_mail.id','reply_mail.employee_id','reply_mail.subject',
                    'reply_mail.message','reply_mail.attachment','reply_mail.created_at')
                    ->where('reply_mail.employee_id',$userId)
                ->get();
                // dd($replyMail);
        $invitationMail=DB::table('invitation')
                ->join('disciplinary','invitation.id','disciplinary.invitation_id')
                ->select('invitation.id','invitation.hr_id','invitation.employee_id','invitation.subject',
                    'invitation.message','invitation.date','invitation.attachment','invitation.created_at')
                    ->where('invitation.employee_id',$userId)
                ->get();
        $actions=DB::table('action')
                ->join('disciplinary','action.id','disciplinary.action_id')
                ->select('action.id','action.hr_id','action.employee_id','action.action',
                    'action.attachment','action.created_at','action.message')
                    ->where('action.employee_id',$userId)
                ->get();
         $oral=DB::table('disciplinary_oral')
        ->join('employees','employees.userId','disciplinary_oral.employee_id')
        ->select('employees.surname','employees.firstname','employees.lastname','disciplinary_oral.*')->where('disciplinary_oral.employee_id',$userId)->get();
    return view('disciplinary.viewDisciplinary',compact('disciplinary','oral','userId','caseMail','replyMail','invitationMail','actions','datas'));
    }

   //view objective
    public function viewObjective($id){

  $getTemplates=DB::table('perfomance_template')
                        ->leftJoin('companies','perfomance_template.companyId','=','companies.id')
                        ->leftJoin('departments','perfomance_template.departmentId','=','departments.id')
                        ->where('templateId','=',$id)
                        ->where('archiveStatus','=',0)
                        ->get();
        $getObjectives=DB::table('perfomance_objectives')
                        ->where('templateId','=',$id)
                        ->get();

         $getSubObjectives=DB::table('sub_objectives')
                        ->where('templateId','=',$id)
                        ->get();
        $getEmployees=DB::table('employees')
                    ->get();
        $getMarks=DB::table('perfomance_marks')
                ->where('templateId','=',$id)
                ->orderBy('created_at','DESC')
                ->get();
         $submissions=DB::table('perfomance_submissions')
                ->where('userId','=',Auth::user()->userId)
                ->get();


                        $data=array('getMarks'=>$getMarks,'getEmployees'=>$getEmployees,'id'=>$id,'getTemplates'=>$getTemplates,'getObjectives'=>$getObjectives,'getSubObjectives'=>$getSubObjectives,'submissions'=>$submissions);
 return view('perfomance.viewObjective')->with($data);

    }

    //post reports
    public function postReports(Request $request){
        $remarks=$request->input('remarks');
         $points=$request->input('points');
         $templateId=$request->input('templateId');
         $objectiveId=$request->input('objectiveId');
         $subId=$request->input('subId');
         $userId=$request->input('userId');
         $folder="public/hrfiles";
         $created_at=date('Y-m-d')." ".date('h:i:s A');
            $cms_multiple_images=$request->file("file");
            $cms_page_image_name_to_store="";
            $objectiveName='';
        $objs=DB::select('SELECT *FROM perfomance_objectives WHERE objectiveId=?',[$objectiveId]);
            foreach($objs as $ob){
                $objectiveName=$ob->objective;
            }
            $tieId=DB::table('perfomance_submissions')->insertGetId([
                                'templateId'=>$templateId,
                                'objectiveId'=>$objectiveId,
                                'userId'=>$userId,
                                'subId'=>$subId,
                                'remarks'=>$remarks,
                                'completion'=>$points,
                                'created_at'=>$created_at,
                                'updated_at'=>$created_at
                            ]);

	$lastid=DB::table('perfomance_marks')->insertGetId([
                                'points'=>$points,
                                'tieId'=>$tieId,
                                'subId'=>$subId,
                                'templateId'=>$templateId,
                                'objectiveId'=>$objectiveId,
				'byy'=>'Self Appraisal',
				'userId'=>Auth::user()->userId,
                                'created_at'=>$created_at
                            ]);
//update due on with the new timeline
               $datee1='';
               $duration='';
               $getDate=DB::select('SELECT *FROM perfomance_objectives WHERE objectiveId=?',[$objectiveId]);
               foreach($getDate as $gd){
                $datee1=$gd->dueOn;
                $duration=$gd->obj_range;
               }


               //get new future date



                        $date = new \DateTime(date('Y-m-d'));
                        $date->modify("+".$duration." days");
                        $dueOn=$date->format("Y-m-d");


                         $d1=date_diff(new \DateTime(date('Y-m-d')),new \DateTime($dueOn));
                         $d2=$d1->format("%R%a");
                         $daysToExpiry=str_replace("+", "", $d2);
	  DB::update('UPDATE perfomance_objectives SET dueBy=?, dueOn=? WHERE objectiveId=?',[$daysToExpiry,$dueOn,$objectiveId]);

            //insert into notifications
            $saveNot=DB::insert('INSERT INTO notifications_modules (linkCategory,linkIcon,linkUrl,linkIndex,notificationCategory,notification,status,requireEmail) VALUES(?,?,?,?,?,?,?,?)',['perfomancereportsCatx123','<i class="fas fa-file"></i>','/appraisal/',$tieId,$objectiveName.' reports','Report submission for '.$objectiveName,0,1]);
            if($cms_multiple_images!=""){
                        foreach($cms_multiple_images as $cms_mult_images){

                        
                                        //get file name with extension
                    $cms_page_image_name_with_extension=$cms_mult_images->getClientOriginalName();
                                //get just File name
                                    $cms_page_image_file_name_only=pathinfo($cms_page_image_name_with_extension,PATHINFO_FILENAME);
                                //get just Extension
                                    $cms_page_image_extension_only=$cms_mult_images->getClientOriginalExtension();
                                        //timestamped file name to store
                                        $cms_page_image_name_to_store=$cms_page_image_file_name_only."_".time().".".$cms_page_image_extension_only;
                                    //upload the image
                                        $cms_page_image_path=$cms_mult_images->move($folder,$cms_page_image_name_to_store);
                            $insert2=DB::insert('INSERT INTO perfomance_attachments(tieId,templateId,userId,objectiveId,subId,docLink,created_at) VALUES(?,?,?,?,?,?,?)',[$tieId,$templateId,$userId,$objectiveId,$subId,$cms_page_image_name_to_store,$created_at]);          
                    }
                                
            }
 Alert::success('Success','You have successfully submitted reports and conducted self appraisal');
                    return back();
	
	
	

    }

    //my submissions
    public function mySubmissions($templateId,$objectiveId,$subId,$userId){
        //get submissions
        $submissions=DB::table('perfomance_submissions')
                    ->where('templateId','=',$templateId)
                    ->where('objectiveId','=',$objectiveId)
                    ->where('subId','=',$subId)
                    ->where('userId','=',$userId)
                    ->get();


        $getTemplates=DB::table('perfomance_template')
                        ->get();
        $getObjectives=DB::table('perfomance_objectives')
                        ->get();

        $attachments=DB::table('perfomance_attachments')
                    ->where('templateId','=',$templateId)
                    ->where('objectiveId','=',$objectiveId)
                    ->where('subId','=',$subId)
                    ->where('userId','=',$userId)
                    ->get();


                $data=array('getTemplates'=>$getTemplates,'getObjectives'=>$getObjectives,'submissions'=>$submissions,'attachments'=>$attachments);
                return view('perfomance.submissions')->with($data);
    }

    //tbp
    public function tbp(){
$tbp="";
if(Auth::user()->departmentId==5){
$tbp=DB::table('perfomance_template')
	->leftJoin('sub_objectives','sub_objectives.templateId','=','perfomance_template.templateId')
        ->where('departmentId','=',Auth::user()->departmentId)
	->where('sub_objectives.who','=',Auth::user()->userId)
	 ->where('perfomance_template.archiveStatus','=',0)
	->get();
}else{
$tbp=DB::table('perfomance_template')
            ->where('departmentId','=',Auth::user()->departmentId)
            ->where('archiveStatus','=',0)
                ->get();
}
        
                $data=array('tbp'=>$tbp);
        return view('perfomance.tbp')->with($data);
    }

    //view points
    public function viewPoints($objectiveId){
$tId='';
$getD=DB::select('SELECT *FROM perfomance_objectives WHERE objectiveId=?',[$objectiveId]);
foreach($getD as $g){
$tId=$g->templateId;
}
$id=$tId;
$userId=Auth::user()->userId;
 //get the department
        $dep=DB::select('SELECT *FROM perfomance_template WHERE templateId=?',[$id]);
        $dState='';
        $tempId=$id;
        foreach($dep as $dp){
            if($dp->departmentId==5){
                $dState="sales";
            }
        }                    
  if($dState=="sales"){ 
        $getTemplates=DB::table('perfomance_template')
                        ->leftJoin('companies','perfomance_template.companyId','=','companies.id')
                        ->leftJoin('departments','perfomance_template.departmentId','=','departments.id')
                        ->where('templateId','=',$id)
                        ->where('perfomance_template.created_at','LIKE', '%'.Carbon\Carbon::parse(date('Y-m-d'))->format('Y').'%')
                        ->where('archiveStatus','=',0)
                        ->get();
        $getObjectives=DB::table('perfomance_objectives')
			->leftJoin('sub_objectives','sub_objectives.objectiveId','=','perfomance_objectives.objectiveId')
                        ->where('perfomance_objectives.templateId','=',$id)
			->where('sub_objectives.who','=',$userId)
                        ->where('perfomance_objectives.created_at','LIKE', '%'.Carbon\Carbon::parse(date('Y-m-d'))->format('Y').'%')
                        ->get();

        
        $getEmployees=DB::table('employees')
			->where('userId','=',$userId)
                    ->get();
	$getEmp=DB::table('employees')
                    ->get();
        $getMarks=DB::table('perfomance_marks')
                    ->where('templateId','=',$id)
		->where('userId','=',$userId)
                    ->where('created_at','LIKE', '%'.Carbon\Carbon::parse(date('Y-m-d'))->format('Y').'%')
                    ->get();
        $getDepartment=DB::table('departments')
                    ->get();
                    $getDesignation=DB::table('designations')
                    ->get();
	   $getPtPoints=DB::select('SELECT *FROM pt_appraisals WHERE templateId=?',[$id]);

 $getSubObjectives=DB::table('sub_objectives')
                        ->where('templateId','=',$id)
                        ->where('created_at','LIKE', '%'.Carbon\Carbon::parse(date('Y-m-d'))->format('Y').'%')
                        ->get();
 $data=array('getPtPoints'=>$getPtPoints,'tempId'=>$tempId,'getEmp'=>$getEmp,'getMarks'=>$getMarks,'getDesignation'=>$getDesignation,'getDepartment'=>$getDepartment,'getMarks'=>$getMarks,'getEmployees'=>$getEmployees,'id'=>$id,'getTemplates'=>$getTemplates,'getObjectives'=>$getObjectives,'getSubObjectives'=>$getSubObjectives);
                            return view('perfomance.pt')->with($data);
}else{
$getPoints=DB::table('perfomance_marks')

                    ->where('objectiveId','=',$objectiveId)
                    ->orderBy('created_at','DESC')
                    ->get();
        $getObjectives=DB::table('perfomance_objectives')
                    ->where('objectiveId','=',$objectiveId)
                    ->get();


        $data=array('getObjectives'=>$getObjectives,'getPoints'=>$getPoints);
        return view('perfomance.points')->with($data);

}

       
    }

//tbp
    public function viewAssigned($id){
        $tbp=DB::table('perfomance_objectives')
            ->where('templateId','=',$id)
		 ->where('byy','=',Auth::user()->userId)
                ->get();
	$submissions=DB::table('perfomance_submissions')
		->where('templateId','=',$id)
		->orderBy('created_at','DESC')
		->get();
	$employees=DB::table('employees')
			->get();
	$getMarks=DB::table('perfomance_marks')
			->where('templateId','=',$id)
		->get();
        $data=array('getMarks'=>$getMarks,'employees'=>$employees,'tbp'=>$tbp,'submissions'=>$submissions);
        return view('perfomance.viewAssigned')->with($data);
    }

 //appraisals
    public function appraisals($id,$userIdd){
        $tempId=0;
        $objectiveId=0;
        $subId=0;
        $departmentId=0;
        $teamLeader=0;

        $getSubmissions=DB::table('perfomance_submissions')
                        ->where('tieId','=',$id)
                        ->get();

        foreach($getSubmissions as $getSub){
            $tempId=$getSub->templateId;
            $objectiveId=$getSub->objectiveId;
            $subId=$getSub->subId;
        }

        $getTemplates=DB::table('perfomance_template')
                        ->where('templateId','=',$tempId)
                        ->get();

        $getObjectives=DB::table('perfomance_objectives')
                        ->where('objectiveId','=',$objectiveId)
                        ->get();

        $getSubObjectives=DB::table('sub_objectives')
                        ->where('subId','=',$subId)
                        ->get();

        $getAttachments=DB::table('perfomance_attachments')
                        ->where('tieId','=',$id)
                        ->get();
        $tieId=$id;
        $templateId=$tempId;


        foreach($getTemplates as $getTemp){
            $departmentId=$getTemp->departmentId;
        }

        $getEmployees=DB::table('employees')
                        ->where('departmentId','=',$departmentId)
                        ->get();

        foreach($getSubObjectives as $getSub){
            $teamLeader=$getSub->who;
        }

        $getTeamLeader=DB::table('employees')
                        ->where('userId','=',$teamLeader)
                        ->get();
        $getMarks=DB::table('perfomance_marks')
                    ->where('tieId','=',$id)
                        ->get();

            $data=array('userIdd'=>$userIdd,'getMarks'=>$getMarks,'tieId'=>$tieId,'subId'=>$subId,'objectiveId'=>$objectiveId,'templateId'=>$templateId,'getSubmissions'=>$getSubmissions,'getAttachments'=>$getAttachments,'getSubObjectives'=>$getSubObjectives,'getObjectives'=>$getObjectives,'getTemplates'=>$getTemplates,'getEmployees'=>$getEmployees,'getTeamLeader'=>$getTeamLeader);


        return view("perfomance.appraisals")->with($data);
    }

  //save marks
        public function saveMarks($points,$tieId,$subId,$templateId,$objectiveId,$remarks,$userId){
    $remarks=str_replace("`", "/", $remarks);
               $created_at=date('Y-m-d')." ".date('h:i:s A');
               //update due on with the new timeline
               $datee1='';
               $duration='';
               $getDate=DB::select('SELECT *FROM perfomance_objectives WHERE objectiveId=?',[$objectiveId]);
               foreach($getDate as $gd){
                $datee1=$gd->dueOn;
                $duration=$gd->obj_range;
               }
    $activeUser="";
    $userr=DB::select('SELECT *FROM employees WHERE email=?',[Auth::user()->email]);
    foreach($userr as $userrr){
    $activeUser=$userrr->userId;
}


               //get new future date



                        $date = new \DateTime(date('Y-m-d'));
                        $date->modify("+".$duration." days");
                        $dueOn=$date->format("Y-m-d");


                         $d1=date_diff(new \DateTime(date('Y-m-d')),new \DateTime($dueOn));
                         $d2=$d1->format("%R%a");
                         $daysToExpiry=str_replace("+", "", $d2);

            $lastid=DB::table('perfomance_marks')->insertGetId([
                                'points'=>$points,
                                'tieId'=>$tieId,
                                'subId'=>$subId,
                                'templateId'=>$templateId,
                                'objectiveId'=>$objectiveId,
        'remarks'=>$remarks,
        'byy'=>$activeUser,
        'userId'=>$userId,
                                'created_at'=>$created_at
                            ]);
            DB::update('UPDATE perfomance_objectives SET dueBy=?, dueOn=? WHERE objectiveId=?',[$daysToExpiry,$dueOn,$objectiveId]);
        $success=1;
        $marks=$points;
            return response()->json(array('marks'=>$marks,'lastid'=>$lastid,'success'=>$success),200);
        }

        //revoke points'
        public function revokePpoints($id,$userId){
            DB::delete('DELETE FROM perfomance_marks WHERE tieId=? AND userId=?',[$id,$userId]);
            return back()->with('success','Successfully revoked points');
        }


//marks audti
    public function marksAudit($id){
        $getTemplates=DB::table('perfomance_template')
                        ->leftJoin('companies','perfomance_template.companyId','=','companies.id')
                        ->leftJoin('departments','perfomance_template.departmentId','=','departments.id')
                        ->where('templateId','=',$id)
                        ->where('archiveStatus','=',0)
                        ->get();
        $getObjectives=DB::table('perfomance_objectives')
                        ->where('templateId','=',$id)
                        ->get();

         $getSubObjectives=DB::table('sub_objectives')
                        ->where('templateId','=',$id)
                        ->get();
        $getMarks=DB::table('perfomance_marks')
                         ->where('templateId','=',$id)
                        ->get();
        $getEmployees=DB::table('employees')
                    ->get();

                        $data=array('getMarks'=>$getMarks,'getEmployees'=>$getEmployees,'id'=>$id,'getTemplates'=>$getTemplates,'getObjectives'=>$getObjectives,'getSubObjectives'=>$getSubObjectives);
 return view('perfomance.marksAudit')->with($data);
    }
//review
   public function review(){
    $user=Auth::user();
    $today=today()->format('Y-m-d');
    $ids=DB::table('reviews')
            ->join('review_questions','reviews.reviewId','review_questions.review_id')
            ->join('review_replies','reviews.reviewId','review_replies.review_id')
            ->leftJoin('companies','reviews.company_id','=','companies.id')
            ->where('review_replies.user_id',$user->userId)
            ->where('companies.id',$user->companyId)
            ->where('review_questions.dueOn','>=',$today)
            ->where('reviews.archiveStatus',0)
            ->get('reviewId');
            $items=array();
            foreach ($ids as $id) {
                array_push($items,$id->reviewId);
            }
     $idz=DB::table('reviews')
            ->join('review_questions','reviews.reviewId','review_questions.review_id')
            ->join('review_replies','reviews.reviewId','review_replies.review_id')
            ->leftJoin('companies','reviews.company_id','=','companies.id')
            ->whereNotIn('reviewId',$items)       
            ->where('companies.id',$user->companyId)
            ->where('review_questions.dueOn','>=',$today)
            ->where('reviews.archiveStatus',0)
             ->groupBy('reviewId')
            ->get('reviewId');
             $itemz=array();
            foreach ($idz as $id) {
                array_push($itemz,$id->reviewId);
            }

   
    $reviews=DB::table('reviews')
                ->join('review_questions','reviews.reviewId','review_questions.review_id')
                 ->join('review_categories','review_questions.category_id','review_categories.categoryId')
                 ->leftJoin('departments','reviews.department_id','=','departments.id')
                 ->leftJoin('companies','reviews.company_id','=','companies.id')
                 ->where('review_questions.dueOn','>=',$today)
                 ->whereNotIn('reviewId',$items)  
                 ->where('reviews.archiveStatus',0)
                 ->where('companies.id',$user->companyId)
                 ->orderBy('dueOn','DESC')
                ->get();

    $replied=DB::table('reviews')
                ->join('review_questions','reviews.reviewId','review_questions.review_id')
                ->leftJoin('departments','reviews.department_id','=','departments.id')
                 ->join('review_categories','review_questions.category_id','review_categories.categoryId')
                 ->whereIn('reviewId',$items)
                 ->orderBy('dueOn')
                ->get();
    // $reviews=DB::table('reviews')
    //             ->join('review_questions','reviews.reviewId','review_questions.review_id')
    //              ->leftJoin('departments','reviews.department_id','=','departments.id')
    //              ->join('review_categories','review_questions.category_id','review_categories.categoryId')
    //              ->whereIn('reviewId',$itemz)
    //              ->orderBy('dueOn')
    //             ->get();
    $data=array('reviews'=>$reviews,'replied'=>$replied);
        return view('perfomance.review')->with($data);
    }

    public function viewReview($id){
        //getTemplates
     $reviews=DB::table('reviews')
                        ->leftJoin('companies','reviews.company_id','=','companies.id')
                        ->leftJoin('departments','reviews.department_id','=','departments.id')
                        ->leftJoin('review_questions','reviews.reviewId','review_questions.review_id')
                        ->leftJoin('review_categories','review_questions.category_id','review_categories.categoryId')
                        ->where('reviewId','=',$id)
                        ->where('archiveStatus','=',0)
                        ->get();
        //getObjectives
        $questions=DB::table('review_questions')
                        ->where('review_id','=',$id)
                        ->get();
//submissions
         $replies=DB::table('review_replies')
                ->where('user_id','=',Auth::user()->userId)
                ->where('review_id','=',$id)
                ->get();

    $data=array('id'=>$id,'reviews'=>$reviews,'questions'=>$questions,'replies'=>$replies);
 return view('perfomance.viewReviews')->with($data);   
    }

    public function rateReview(Request $request)
    {
        $reviewId=$request->input('reviewId');
        $redirectPath="viewReview/".$reviewId;
        $remarks=$request->input('remarks');
        $star=$request->input('star');
        $anonymous=$request->input('anonymous');
        $question_id=$request->input('question_id');
        $insert=DB::table('review_replies')->insert([
                                'review_id'=>$reviewId,
                                'question_id'=>$question_id,
                                'user_id'=>Auth::user()->userId,
                                'remarks'=>$remarks,
                                'points'=>$star,
                                'anonymous'=>$anonymous
            ]);
        if ($insert) {
          return redirect($redirectPath)->with('success','Review successfully submitted');
        }else{
            return redirect($redirectPath)->with('error','An error occurred, please try again later');
        }
    }
    public function rateReviews(Request $request)
    {
        $reviewId=$request->input('reviewId');
        $redirectPath="viewReview/".$reviewId;
        $remarks=$request->input('remarks');
        $anonymous=$request->input('anonymous');
        $points=$request->input('points');
        $question_id=$request->input('question_id');

        if (!empty($points)) {
             $insert=DB::table('review_replies')->insert([
                                'review_id'=>$reviewId,
                                'question_id'=>$question_id,
                                'user_id'=>Auth::user()->userId,
                                'remarks'=>$remarks,
                                'marks'=>$points,
                                'anonymous'=>$anonymous
            ]);
        if ($insert) {
          return redirect($redirectPath)->with('success','Review successfully submitted');
        }else{
            return redirect($redirectPath)->with('error','An error occurred, please try again later');
        }
        }else{
            return redirect($redirectPath)->with('error','Points field cannot be empty');
        }
       
    }

public function survey(){
    $today=today()->format('Y-m-d');
    $survey=DB::table('survey')
                 ->where('due_on','>=',$today)
                 ->where('archiveStatus',0)
                 ->orderBy('due_on','DESC')
                ->get();

    $data=array('survey'=>$survey);
        return view('training.survey')->with($data);
}
    public function viewSurvey($id){
        //getTemplates
     $reviews=DB::table('survey')
                        // ->leftJoin('survey_questions','survey_questions.survey_id','survey.id')
                        ->where('survey.id','=',$id)
                        ->where('archiveStatus','=',0)
                        ->get();
        //getObjectives
        $questions=DB::table('survey_questions')
                        ->where('survey_id','=',$id)
                        ->get();
//submissions
         $replies=DB::table('survey_answers')
                ->where('employee_id','=',Auth::user()->userId)
                ->where('survey_id','=',$id)
                ->get();

        $mrks=DB::table('survey_marks')
                ->where('employee_id','=',Auth::user()->userId)
                ->where('survey_id','=',$id)
                ->get();
    $data=array('id'=>$id,'reviews'=>$reviews,'questions'=>$questions,'mrks'=>$mrks,'replies'=>$replies);
 return view('perfomance.viewSurvey')->with($data);   
    }

    public function rateSurvey(Request $request)
    {
        $reviewId=$request->input('survey_id');
        $redirectPath="viewSurvey/".$reviewId;
        $remarks=$request->remarks;
        // $star=$request->input('star');
        $anonymous=$request->input('anonymous');
        $question_id=$request->question_id;
// dd($question_id);
          foreach ($remarks as $key => $answer) {
        $insert_answers=DB::table('survey_answers')->insert([
          'survey_id'=>$reviewId,
          'survey_question_id'=>$question_id[$key],
          'employee_id'=>Auth::user()->userId,
          'answer'=>$remarks[$key],
          'anonymous'=>$anonymous
          ]);
      }
      if ($insert_answers) {
            DB::table('survey_marks')->insert([
                'survey_id'=>$reviewId,
                'employee_id'=>Auth::user()->userId,
                'marks'=>$request->points,
                'anonymous'=>$anonymous
                ]);
          return redirect($redirectPath)->with('success','Survey feedback successfully submitted');
        }else{
            return redirect($redirectPath)->with('error','An error occurred, please try again later');
        }
    }
        public function rateSurveyStar(Request $request)
    {
        $reviewId=$request->input('survey_id');
        $redirectPath="viewSurvey/".$reviewId;
        $remarks=$request->remk;
        $star=$request->input('star');
        $anonymous=$request->input('anonymous');
        $question_id=$request->questionId;
        if (is_null($star)) {
            $star=1;
        }
          foreach ($remarks as $key => $answer) {
        $insert_answers=DB::table('survey_answers')->insert([
          'survey_id'=>$reviewId,
          'survey_question_id'=>$question_id[$key],
          'employee_id'=>Auth::user()->userId,
          'answer'=>$remarks[$key],
          'anonymous'=>$anonymous
          ]);
      }
      if ($insert_answers) {
            DB::table('survey_marks')->insert([
                'survey_id'=>$reviewId,
                'employee_id'=>Auth::user()->userId,
                'marks'=>$star,
                'anonymous'=>$anonymous
                ]);
          return redirect($redirectPath)->with('success','Survey feedback successfully submitted');
        }else{
            return redirect($redirectPath)->with('error','An error occurred, please try again later');
        }
    }
 //poll
    public function poll($id){
         $user=Auth::user();
         $user_id=$user->userId;
         $kpis=DB::table('perfomance_indicators')
                ->where('id','=',$id)
                ->get();
        $data=array('kpis'=>$kpis);
          return view('perfomance.poll')->with($data);
    }

    //search emp
    public function searchEmpp($id){
         $employees=DB::table('employees')
                    ->where('employees.firstname','LIKE', '%'.$id.'%')
                     ->orwhere('employees.lastname','LIKE', '%'.$id.'%')
                      ->orwhere('employees.surname','LIKE', '%'.$id.'%')
                    ->get();
         $success=1;
                return response()->json(array('success'=>$success,'employees'=>$employees),200);
    }

    //save poll
    public function savePoll(Request $request){
        $who=$request->input('who');
        $points=$request->input('points');
        $poll=$request->input('poll');
        $by=Auth::user()->userId;
        $time=date('Y-m');
        $created_at=date('Y-m-d')." ".date('h:i:s A');

        //check if user has voted already
        $check=DB::select('SELECT *FROM polls WHERE  byy=? AND timee=? AND poll=?',[$by,$time,$poll]);

        if(count($check)>0){
            return back()->with('voted','You cannot vote the same objective twice');
        }else{
            $save=DB::insert('INSERT INTO polls(byy,who,timee,points,poll,created_at) VALUES(?,?,?,?,?,?)',[$by,$who,$time,$points,$poll,$created_at]);

            if($save){
                return back()->with('voted','You have successfully voted. Thank you!');
            }else{
                return back()->with('voted','Unable to submit your vote,please try again');
            }
        }
    }

public function viewPpoints($id){

$id=$id;
$userId="";
$getE=DB::select('SELECT *FROM doc_share WHERE itemId=?',[$id]);
foreach($getE as $e){
$userId=$e->indexx;
}

//$userId=Auth::user()->userId;
 //get the department
        $dep=DB::select('SELECT *FROM perfomance_template WHERE templateId=?',[$id]);
        $dState='';
        $tempId=$id;
        foreach($dep as $dp){
            if($dp->departmentId==5){
                $dState="sales";
            }
        }

 if($dState=="sales"){ 
        $getTemplates=DB::table('perfomance_template')
                        ->leftJoin('companies','perfomance_template.companyId','=','companies.id')
                        ->leftJoin('departments','perfomance_template.departmentId','=','departments.id')
                        ->where('templateId','=',$id)
                        ->where('perfomance_template.created_at','LIKE', '%'.Carbon\Carbon::parse(date('Y-m-d'))->format('Y').'%')
                        ->where('archiveStatus','=',0)
                        ->get();
        $getObjectives=DB::table('perfomance_objectives')
			->leftJoin('sub_objectives','sub_objectives.objectiveId','=','perfomance_objectives.objectiveId')
                        ->where('perfomance_objectives.templateId','=',$id)
			->where('sub_objectives.who','=',$userId)
                        ->where('perfomance_objectives.created_at','LIKE', '%'.Carbon\Carbon::parse(date('Y-m-d'))->format('Y').'%')
                        ->get();

        
        $getEmployees=DB::table('employees')
			->where('userId','=',$userId)
                    ->get();
	$getEmp=DB::table('employees')
                    ->get();
        $getMarks=DB::table('perfomance_marks')
                    ->where('templateId','=',$id)
		->where('userId','=',$userId)
                    ->where('created_at','LIKE', '%'.Carbon\Carbon::parse(date('Y-m-d'))->format('Y').'%')
                    ->get();
        $getDepartment=DB::table('departments')
                    ->get();
                    $getDesignation=DB::table('designations')
                    ->get();
	   $getPtPoints=DB::select('SELECT *FROM pt_appraisals WHERE templateId=?',[$id]);

 $getSubObjectives=DB::table('sub_objectives')
                        ->where('templateId','=',$id)
                        ->where('created_at','LIKE', '%'.Carbon\Carbon::parse(date('Y-m-d'))->format('Y').'%')
                        ->get();
 $data=array('getPtPoints'=>$getPtPoints,'tempId'=>$tempId,'getEmp'=>$getEmp,'getMarks'=>$getMarks,'getDesignation'=>$getDesignation,'getDepartment'=>$getDepartment,'getMarks'=>$getMarks,'getEmployees'=>$getEmployees,'id'=>$id,'getTemplates'=>$getTemplates,'getObjectives'=>$getObjectives,'getSubObjectives'=>$getSubObjectives);
                            return view('perfomance.pt')->with($data);
}else{

 $getTemplates=DB::table('perfomance_template')
                        ->leftJoin('companies','perfomance_template.companyId','=','companies.id')
                        ->leftJoin('departments','perfomance_template.departmentId','=','departments.id')
                        ->where('templateId','=',$id)
                        ->where('perfomance_template.created_at','LIKE', '%'.Carbon\Carbon::parse(date('Y-m-d'))->format('Y').'%')
                        ->where('archiveStatus','=',0)
                        ->get();
        $getObjectives=DB::table('perfomance_objectives')
                        ->where('templateId','=',$id)
                        ->where('created_at','LIKE', '%'.Carbon\Carbon::parse(date('Y-m-d'))->format('Y').'%')
                        ->get();

        
        $getEmployees=DB::table('employees')
			->where('userId','=',$userId)
                    ->get();
	$getEmployee=DB::table('employees')
                    ->get();
	$getEmp=DB::table('employees')
                    ->get();
        $getMarks=DB::table('perfomance_marks')
                    ->where('templateId','=',$id)
		->where('userId','=',$userId)
                    ->where('created_at','LIKE', '%'.Carbon\Carbon::parse(date('Y-m-d'))->format('Y').'%')
                    ->get();
        $getDepartment=DB::table('departments')
                    ->get();
                    $getDesignation=DB::table('designations')
                    ->get();
	   $getPtPoints=DB::select('SELECT *FROM pt_appraisals WHERE templateId=?',[$id]);

 $getSubObjectives=DB::table('sub_objectives')
                        ->where('templateId','=',$id)
                        ->where('created_at','LIKE', '%'.Carbon\Carbon::parse(date('Y-m-d'))->format('Y').'%')
                        ->get();
 $data=array('getPtPoints'=>$getPtPoints,'userId'=>$userId,'tempId'=>$tempId,'getEmp'=>$getEmp,'getEmployee'=>$getEmployee,'getMarks'=>$getMarks,'getDesignation'=>$getDesignation,'getDepartment'=>$getDepartment,'getMarks'=>$getMarks,'getEmployees'=>$getEmployees,'id'=>$id,'getTemplates'=>$getTemplates,'getObjectives'=>$getObjectives,'getSubObjectives'=>$getSubObjectives);
                            return view('perfomance.perfomanceTemplate')->with($data);
}
}

 //perfomance
    public function perfomanceReport($id,$userId){  
 //get the department
        $dep=DB::select('SELECT *FROM perfomance_template WHERE templateId=?',[$id]);
        $dState='';
        $tempId=$id;
        foreach($dep as $dp){
            if($dp->departmentId==5){
                $dState="sales";
            }
        }                    
  if($dState=="sales"){ 
        $getTemplates=DB::table('perfomance_template')
                        ->leftJoin('companies','perfomance_template.companyId','=','companies.id')
                        ->leftJoin('departments','perfomance_template.departmentId','=','departments.id')
                        ->where('templateId','=',$id)
                        ->where('perfomance_template.created_at','LIKE', '%'.Carbon\Carbon::parse(date('Y-m-d'))->format('Y').'%')
                        ->where('archiveStatus','=',0)
                        ->get();
        $getObjectives=DB::table('perfomance_objectives')
			->leftJoin('sub_objectives','sub_objectives.objectiveId','=','perfomance_objectives.objectiveId')
                        ->where('perfomance_objectives.templateId','=',$id)
			->where('sub_objectives.who','=',$userId)
                        ->where('perfomance_objectives.created_at','LIKE', '%'.Carbon\Carbon::parse(date('Y-m-d'))->format('Y').'%')
                        ->get();

        
        $getEmployees=DB::table('employees')
			->where('userId','=',$userId)
                    ->get();
	$getEmployee=DB::table('employees')
                    ->get();
	$getEmp=DB::table('employees')
                    ->get();
        $getMarks=DB::table('perfomance_marks')
                    ->where('templateId','=',$id)
		->where('userId','=',$userId)
                    ->where('created_at','LIKE', '%'.Carbon\Carbon::parse(date('Y-m-d'))->format('Y').'%')
                    ->get();
        $getDepartment=DB::table('departments')
                    ->get();
                    $getDesignation=DB::table('designations')
                    ->get();
	   $getPtPoints=DB::select('SELECT *FROM pt_appraisals WHERE templateId=?',[$id]);

 $getSubObjectives=DB::table('sub_objectives')
                        ->where('templateId','=',$id)
                        ->where('created_at','LIKE', '%'.Carbon\Carbon::parse(date('Y-m-d'))->format('Y').'%')
                        ->get();
 $data=array('getPtPoints'=>$getPtPoints,'tempId'=>$tempId,'userId'=>$userId,'getEmp'=>$getEmp,'getMarks'=>$getMarks,'getDesignation'=>$getDesignation,'getDepartment'=>$getDepartment,'getMarks'=>$getMarks,'getEmployee'=>$getEmployee,'getEmployees'=>$getEmployees,'id'=>$id,'getTemplates'=>$getTemplates,'getObjectives'=>$getObjectives,'getSubObjectives'=>$getSubObjectives);
                            return view('perfomance.appraisalPt')->with($data);
                        }else{
	
        
        $getTemplates=DB::table('perfomance_template')
                        ->leftJoin('companies','perfomance_template.companyId','=','companies.id')
                        ->leftJoin('departments','perfomance_template.departmentId','=','departments.id')
                        ->where('templateId','=',$id)
                        ->where('perfomance_template.created_at','LIKE', '%'.Carbon\Carbon::parse(date('Y-m-d'))->format('Y').'%')
                        ->where('archiveStatus','=',0)
                        ->get();
        $getObjectives=DB::table('perfomance_objectives')
                        ->where('templateId','=',$id)
                        ->where('created_at','LIKE', '%'.Carbon\Carbon::parse(date('Y-m-d'))->format('Y').'%')
                        ->get();

        
        $getEmployees=DB::table('employees')
			->where('userId','=',$userId)
                    ->get();
	$getEmployee=DB::table('employees')
                    ->get();
	$getEmp=DB::table('employees')
                    ->get();
        $getMarks=DB::table('perfomance_marks')
                    ->where('templateId','=',$id)
		->where('userId','=',$userId)
                    ->where('created_at','LIKE', '%'.Carbon\Carbon::parse(date('Y-m-d'))->format('Y').'%')
                    ->get();
        $getDepartment=DB::table('departments')
                    ->get();
                    $getDesignation=DB::table('designations')
                    ->get();
	   $getPtPoints=DB::select('SELECT *FROM pt_appraisals WHERE templateId=?',[$id]);

 $getSubObjectives=DB::table('sub_objectives')
                        ->where('templateId','=',$id)
                        ->where('created_at','LIKE', '%'.Carbon\Carbon::parse(date('Y-m-d'))->format('Y').'%')
                        ->get();
 $data=array('getPtPoints'=>$getPtPoints,'userId'=>$userId,'tempId'=>$tempId,'getEmp'=>$getEmp,'getEmployee'=>$getEmployee,'getMarks'=>$getMarks,'getDesignation'=>$getDesignation,'getDepartment'=>$getDepartment,'getMarks'=>$getMarks,'getEmployees'=>$getEmployees,'id'=>$id,'getTemplates'=>$getTemplates,'getObjectives'=>$getObjectives,'getSubObjectives'=>$getSubObjectives);
                            return view('perfomance.perfomanceTemplate')->with($data);
                        }
    }

  //save pt marks
        public function savePtMarks($appraisalId,$objectiveId,$templateId,$subId,$userId,$marks,$remarks){
            $remarks=str_replace("`", "/", $remarks);
            $created_at=date('Y-m-d')." ".date('h:i:s A');
            //check if marks saved already
            $select=DB::select('SELECT *FROM pt_appraisals WHERE appraisalId=? AND objectiveId=? AND templateId=? AND subId=? AND userId=?',[$appraisalId,$objectiveId,$templateId,$subId,$userId]);
            if(count($select)>0){
                $success=2;
                return response()->json(array('success'=>$success),200);
            }else{
              $insert=DB::insert('INSERT INTO pt_appraisals(templateId,objectiveId,subId,userId,appraisalId,points,remarks,created_at) VALUES(?,?,?,?,?,?,?,?)',[$templateId,$objectiveId,$subId,$userId,$appraisalId,$marks,$remarks,$created_at]);
              if($insert){
                $success=1;
                return response()->json(array('success'=>$success),200);
              }  else{
                $success=0;
                return response()->json(array('success'=>$success),200);
              }
            }
            
        }

        //revoke pt marks
        public function revokePtMarks($id){
            $delete=DB::delete('DELETE FROM pt_appraisals WHERE id=?',[$id]);
            if($delete){
Alert::success('Success','Points revoked successfully');
            return back();
            }else{
                Alert::error('Error','Unable to revoke points');
            return back();
            }
        }

//savedocs
public function shareDocs(Request $request){
$userId=$request->input('userId');
$recipient=$request->input('recipient');
$recipients2=$request->input('recipients2');
$tempId=$request->input('tempId');
$type=$request->input('type');
$sender="";
$sender=Auth::user()->email;
//get sender
$se=DB::select('SELECT *FROM employees WHERE email=?',[$sender]);
foreach($se as $ss){
$sender=$ss->userId;
}

$remarks=$request->input('remarks');
$created_at=date('Y-m-d')." ".date('h:i:s A');
$folder="public/hrfiles";
if($recipients2!=""){
for($x=0;$x<sizeof($recipients2);$x++){
$lastid=DB::table('doc_share')->insertGetId([
                                'itemId'=>$tempId,
				'indexx'=>$userId,
				'recipient'=>$recipients2[$x],
				'remarks'=>$remarks,
				'created_at'=>$created_at,
				'type'=>$type,
                                'sender'=>$sender
                                
              ]);
}

}
$lastid=DB::table('doc_share')->insertGetId([
                                'itemId'=>$tempId,
				'indexx'=>$userId,
				'recipient'=>$recipient,
				'remarks'=>$remarks,
				'created_at'=>$created_at,
				'type'=>$type,
                                'sender'=>$sender
                                
              ]);
        $cms_multiple_images=$request->file("file");

                    if($cms_multiple_images!=""){
                        foreach($cms_multiple_images as $cms_mult_images){
                        
                                        //get file name with extension
                    $cms_page_image_name_with_extension=$cms_mult_images->getClientOriginalName();
                                //get just File name
                                    $cms_page_image_file_name_only=pathinfo($cms_page_image_name_with_extension,PATHINFO_FILENAME);
                                //get just Extension
                                    $cms_page_image_extension_only=$cms_mult_images->getClientOriginalExtension();
                                    
                                        //timestamped file name to store
                                        $cms_page_image_name_to_store=$cms_page_image_file_name_only.".".$cms_page_image_extension_only;
                                    //upload the image
                                        $cms_page_image_path=$cms_mult_images->move($folder,$cms_page_image_name_to_store);
 $insert2=DB::insert('INSERT INTO share_docs (labelId,docLink) VALUES(?,?)',[$lastid,"https://management.optiven.co.ke/optivenhrms/public/public/hrfiles/".$cms_page_image_name_to_store]);
                                        
                                          
                    }
                }
if($lastid){
Alert::success('Success','Report shared successfully');
            return back();
}else{
Alert::error('Error','Unable to share report. Try again');
            return back();
}
}

 public function addRecipients($id){
         $recipients=DB::table('employees')
                        ->where('employees.userId','=',$id)
                       // ->where('employees.departmentId','=',$id2)
                        ->get();
         $success=1;
                return response()->json(array('success'=>$success,'recipients'=>$recipients),200);
    }



}
