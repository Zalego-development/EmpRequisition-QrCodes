<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Mail;
use App\Group;
use App\Client;
use App\EmailEvent;
use App\GEmailEvent;
use App\Attachment;
use PDF;

class NewSurveyController extends Controller
{
    public function index(){
    	$surveys=DB::table('survey')->get();
    	return view('survey.index',compact('surveys'));
    }

    public function addSurvey(Request $request){
    	$surveyName=$request->name;
    	$surveyDesciption=$request->description;
    	$questions=$request->question;
    	$replyMode=$request->replyMode;
        $marks=$request->marks;
        $date=$request->date;
        $company=$request->company;
        $email=$request->email;

    	$dropdownReply=3;
    	// $radioReply=$request->radioReply;
      $suffledId=uniqid(time()); 
      $checkIfExist=DB::table('survey')->where('uniqueId',$suffledId)->count();
      if ($checkIfExist>0) {
        $suffledId=md5(uniqid(time())); 
      }
    	$insert_survey=DB::table('survey')->insertGetId([
          'uniqueId'=>$suffledId,
          'survey_name'=>$surveyName,
          'survey_description'=>$surveyDesciption,
          'user_id'=>Auth::user()->id,
          'deadline'=>$date,
          'company'=>$company,
          'email'=>$email
          ]);

    	if ($insert_survey) {
    		foreach ($questions as $key => $value) {

    		$insert_question=DB::table('survey_questions')->insertGetId([
          'survey_id'=>$insert_survey,
          'question'=>$questions[$key],
          'reply_mode'=>$replyMode[$key]
          ]);
    		if ($replyMode[$key]==2) {
                $loopArr='reply'.$key;
                $replies=$request->$loopArr;

                foreach ($replies as $k => $v) {
                DB::table('survey_answers')->insert([
                'survey_id'=>$insert_survey,
              'question_id'=>$insert_question,
              'answer'=>$replies[$k]
              ]);
                }

    		}
    		elseif ($replyMode[$key]==3) {
    			  $loopArr='radioReply'.$key;
                $replies=$request->$loopArr;

                foreach ($replies as $ke => $va) {
                DB::table('survey_answers')->insert([
                'survey_id'=>$insert_survey,
              'question_id'=>$insert_question,
              'answer'=>$replies[$ke]
              ]);
                }

    		}
            elseif ($replyMode[$key]==7) {
            $loopArr='checkReply'.$key;
                $replies=$request->$loopArr;

                foreach ($replies as $k => $va) {
                DB::table('survey_answers')->insert([
                'survey_id'=>$insert_survey,
              'question_id'=>$insert_question,
              'answer'=>$replies[$k]
              ]);
                }

        }
    		elseif ($replyMode[$key]==5) {
    			 DB::table('survey_marks')->insert([
                'survey_id'=>$insert_survey,
              'question_id'=>$insert_question,
              'marks'=>$marks[$key]
              ]);
    		  }
    		}
            Alert::success('Success','Survey successfully created');
            return redirect("viewSurvey/".$insert_survey);
    	}
    	else{
    		   Alert::error('Error','An error occurred, try again later');
            return redirect("newsurvey");
    	}

    }
     public function viewSurvey($id){
        //getTemplates
     $survey=DB::table('survey')
                        ->where('id','=',$id)
                        ->where('archiveStatus','=',0)
                        ->where('user_id','=',Auth::user()->id)
                        ->first();
    $questions=DB::table('survey_questions')
                ->where('survey_id',$id)
                ->get();
    $marks=DB::table('survey_marks')
            ->where('survey_id',$id)
            ->get();
    $answers=DB::table('survey_answers')
            ->where('survey_id',$id)
            ->get();
        $data=array('survey'=>$survey,'marks'=>$marks,'questions'=>$questions,'answers'=>$answers);
        return view('survey.viewSurvey')->with($data); 
    }
         public function editSurvey($id){
        //getTemplates
     $survey=DB::table('survey')
                        ->where('id','=',$id)
                        ->where('archiveStatus','=',0)
                        ->where('user_id','=',Auth::user()->id)
                        ->first();
    $questions=DB::table('survey_questions')
                ->where('survey_id',$id)
                ->get();
    $marks=DB::table('survey_marks')
            ->where('survey_id',$id)
            ->get();
    $answers=DB::table('survey_answers')
            ->where('survey_id',$id)
            ->get();
            if(!$survey){
              return back();
            }
        $data=array('survey'=>$survey,'marks'=>$marks,'questions'=>$questions,'answers'=>$answers);
        return view('survey.editSurvey')->with($data); 
    }
    public function existingSurvey(){
        $survey=DB::table('survey')
                ->where('archiveStatus','=',0)
                ->where('user_id','=',Auth::user()->id)
                ->orderBy('created_at','DESC')
                ->paginate(10);
        $archivedsurvey=DB::table('survey')
                ->where('archiveStatus','=',1)
                ->orderBy('created_at','DESC')
                ->where('user_id','=',Auth::user()->id)
                ->paginate(10);
        return view('survey.existingSurvey',compact('survey','archivedsurvey'));
    }
    public function search(Request $request){
          $search=$request->input('search');
      if($search!=''){
        $survey=DB::table('survey')
                ->where('survey_name','LIKE', '%'.$search.'%')
                ->where('archiveStatus','=',0)
                ->where('user_id','=',Auth::user()->id)
                ->paginate(10);
        $archivedsurvey=DB::table('survey')
                ->where('archiveStatus','=',1)
                ->where('survey_name','LIKE', '%'.$search.'%')
                ->where('user_id','=',Auth::user()->id)
                ->paginate(10);
      if(count($survey)>0){
        $data = array('survey'=>$survey,'archivedsurvey'=>$archivedsurvey);
               return view('survey.existingSurvey')->with($data);
      }
      Alert::info('Info','No results found');
            return redirect("existingSurvey");
    }
    return redirect("/existingSurvey");
}
    public function filterSurveyDates(Request $request){

          $from=$request->input('from');
          $to=$request->input('to');
          
          if($from!=''&&$to!=''){
          $today=today()->format('Y-m-d');
           $survey=DB::table('survey')
                 ->whereBetween('survey.created_at', [$from, $to])
                ->where('archiveStatus','=',0)
                ->where('user_id','=',Auth::user()->id)
                ->paginate(10);
        $archivedsurvey=DB::table('survey')
                 ->whereBetween('survey.created_at', [$from, $to])
                ->where('archiveStatus','=',1)
                ->where('user_id','=',Auth::user()->id)
                ->paginate(10);
          
          if(count($survey)>0||count($archivedsurvey)>0){    
          $data=array('survey'=>$survey,'archivedsurvey'=>$archivedsurvey);       
            return view('survey.existingSurvey')->with($data);
          }          
            Alert::info('Info','No results found');
            return redirect("existingSurvey");
          
          }
          return redirect("/existingSurvey");
          }

          public function archiveSurvey($id){
            $archive=DB::table('survey')->where('id',$id)->update(['archiveStatus'=>1]);
            if($archive){
                Alert::success('Success','Survey successfully archived');
            return redirect("existingSurvey");
            }else{
                Alert::error('Error','An error occurred, please try again later');
            return redirect("existingSurvey");
            }
          }

          public function removeFromArchive($id){
            $archive=DB::table('survey')->where('id',$id)->update(['archiveStatus'=>0]);
            if($archive){
                Alert::success('Success','Survey successfully removed from archive');
            return redirect("existingSurvey");
            }else{
                Alert::error('Error','An error occurred, please try again later');
            return redirect("existingSurvey");
            }
          }

            public function deletePermanently($id){
            $archive=DB::table('survey')->where('id',$id)->delete();
            if($archive){
                DB::table('survey_answers')->where('survey_id',$id)->delete();
                DB::table('survey_marks')->where('survey_id',$id)->delete();
                DB::table('survey_questions')->where('survey_id',$id)->delete();
                Alert::success('Success','Survey successfully deleted');
            return redirect("existingSurvey");
            }else{
                Alert::error('Error','An error occurred, please try again later');
            return redirect("existingSurvey");
            }
          }

          public function newSurvey($id){
            $id=DB::table('survey')->where('uniqueId','=',$id)->value('id');
            $day=Date('d');
        $month=Date('m');
        $year=Date('Y');
        $date=$year.'-'.$month.'-'.$day.'';

            $survey=DB::table('survey')
                        ->where('id','=',$id)
                        ->where('archiveStatus','=',0)
                        ->where('deadline', '>=' , $date)
                        ->first();
    $questions=DB::table('survey_questions')
                ->where('survey_id',$id)
                ->get();
    $markx=DB::table('survey_marks')
            ->where('survey_id',$id)
            ->get();
    $answers=DB::table('survey_answers')
            ->where('survey_id',$id)
            ->get();
        $data=array('survey'=>$survey,'markx'=>$markx,'questions'=>$questions,'answers'=>$answers);
        return view('survey.clientSurvey')->with($data); 
          }
    public function rateSurvey(Request $request){
        $responder_id=null;
        $anonymous=$request->anonymous;
        if ($anonymous==0) {
            $responder_id=DB::table('responder')->insertGetId(['name'=>$request->clientName,'survey_id'=>$request->survey_id]);
        }
        $question_id=$request->question_id;
        $reply_mode=$request->reply_mode;
        $reply=$request->reply;
        $insert_answers=1;
        foreach ($reply_mode as $key => $value) {

            if ($reply_mode[$key]==1) {
              if (isset($reply[$key])) {
                $insert_answers=DB::table('reply_written')->insert([
                        'question_id'=>$question_id[$key],
                        'reply'=>$reply[$key],
                        'responder_id'=>$responder_id
                        ]);
              }
            }
            elseif ($reply_mode[$key]==7) {
            $loopArr='reply'.$question_id[$key];
                $replies=$request->$loopArr;
                if (!is_null($replies)) {
                foreach ($replies as $k => $va) {
                $insert_answers=DB::table('reply_choices')->insert([
                'question_id'=>$question_id[$key],
                'choice_id'=>$replies[$k],
                'responder_id'=>$responder_id
              ]);
                }
              }
            }
              elseif ($reply_mode[$key]==2 || $reply_mode[$key]==3) {
                if (isset($reply[$key])) {
                $insert_answers=DB::table('reply_choices')->insert([
                        'question_id'=>$question_id[$key],
                        'choice_id'=>$reply[$key],
                        'responder_id'=>$responder_id
                        ]);
              }
            }
               elseif ($reply_mode[$key]==4 || $reply_mode[$key]==5) {
                if (isset($reply[$key])) {
                $insert_answers=DB::table('reply_points')->insert([
                        'question_id'=>$question_id[$key],
                        'marks'=>$reply[$key],
                        'responder_id'=>$responder_id
                        ]);
              }
            }
               elseif ($reply_mode[$key]==6) {
                if (isset($reply[$key])) {
                $insert_answers=DB::table('reply_date')->insert([
                        'question_id'=>$question_id[$key],
                        'date'=>$reply[$key],
                        'responder_id'=>$responder_id
                        ]);
              }
            }
      }
      if ($insert_answers) {
           Alert::success('Success','Survey successfully submitted');
            return back()->with('submitted','Survey submitted');
      }else{
           Alert::error('Error','An error occurred, please try again later');
            return back();
      }

    }
    public function viewResponse($id){
        $survey=DB::table('survey')
                        ->where('id','=',$id)
                        ->where('archiveStatus','=',0)
                        ->where('user_id','=',Auth::user()->id)
                        ->first();
    $questions=DB::table('survey_questions')
                ->where('survey_id',$id)
                ->get();
    $marks=DB::table('survey_marks')
            ->where('survey_id',$id)
            ->get();
    $answers=DB::table('survey_answers')
            ->where('survey_id',$id)
            ->get();

            $tableName=DB::table('survey_questions')->where('survey_id',$id)->first();
              if ($tableName->reply_mode==1) {
                $table="reply_written";
              }
              elseif ($tableName->reply_mode==7 || $tableName->reply_mode==2 ||$tableName->reply_mode==3) {
                $table="reply_choices";
              }
              elseif ($tableName->reply_mode==4 ||$tableName->reply_mode==5) {
                $table="reply_points";
              }
              elseif ($tableName->reply_mode==6) {
                $table="reply_date";
              }
    $responses=DB::table($table)->where('question_id',$tableName->id)->count();

        $data=array('responses'=>$responses,'survey'=>$survey,'marks'=>$marks,'questions'=>$questions,'answers'=>$answers);
        return view('survey.viewResponse')->with($data); 
    }


public function deleteOption($id){
  $delete=DB::delete('DELETE FROM survey_answers WHERE id=?',[$id]);
return back();
}

public function deleteQuestion($id){
  $delete=DB::delete('DELETE FROM survey_questions WHERE id=?',[$id]);
  $delete=DB::delete('DELETE FROM survey_marks WHERE question_id=?',[$id]);
  $delete=DB::delete('DELETE FROM survey_answers WHERE question_id=?',[$id]);
return back();
}


    public function addSurveyQuestion(Request $request){
      $insert_survey=$request->SurveyId;
      $questions=$request->question;
      $replyMode=$request->replyMode;
        $marks=$request->marks;
        $date=$request->date;

      $dropdownReply=3;

      if ($insert_survey) {
        foreach ($questions as $key => $value) {
        $insert_question=DB::table('survey_questions')->insertGetId([
          'survey_id'=>$insert_survey,
          'question'=>$questions[$key],
          'reply_mode'=>$replyMode[$key]
          ]);
        if ($replyMode[$key]==2) {
                $loopArr='reply'.$key;
                $replies=$request->$loopArr;

                foreach ($replies as $k => $v) {
                DB::table('survey_answers')->insert([
                'survey_id'=>$insert_survey,
              'question_id'=>$insert_question,
              'answer'=>$replies[$k]
              ]);
                }

        }
        elseif ($replyMode[$key]==3) {
            $loopArr='radioReply'.$key;
                $replies=$request->$loopArr;

                foreach ($replies as $ke => $va) {
                DB::table('survey_answers')->insert([
                'survey_id'=>$insert_survey,
              'question_id'=>$insert_question,
              'answer'=>$replies[$ke]
              ]);
                }

        }
            elseif ($replyMode[$key]==7) {
            $loopArr='checkReply'.$key;
                $replies=$request->$loopArr;

                foreach ($replies as $k => $va) {
                DB::table('survey_answers')->insert([
                'survey_id'=>$insert_survey,
              'question_id'=>$insert_question,
              'answer'=>$replies[$k]
              ]);
                }

        }
        elseif ($replyMode[$key]==5) {
           DB::table('survey_marks')->insert([
                'survey_id'=>$insert_survey,
              'question_id'=>$insert_question,
              'marks'=>$marks[$key]
              ]);
          }
        }
            // Alert::success('Success','Survey successfully created');
            return back();
      }
      else{
           Alert::error('Error','An error occurred, try again later');
            return back();
      }

    }

    public function updateSurvey(Request $request){
      $insert_survey=$request->SurveyId;
          $surveyName=$request->name;
      $surveyDesciption=$request->description;
      $questions=$request->question;
      $replyMode=$request->replyMode;
        $marks=$request->marks;
        $date=$request->date;
        $company=$request->company;
        // $email=$request->email;

      $dropdownReply=3;
      // $radioReply=$request->radioReply;

      DB::table('survey')->where('id',$insert_survey)->update([
          'survey_name'=>$surveyName,
          'survey_description'=>$surveyDesciption,
          'user_id'=>Auth::user()->id,
          'deadline'=>$date,
          'company'=>$company,
          // 'email'=>$email
          ]);

      // if (1) {
        foreach ($questions as $key => $value) {

        $insert_question=DB::table('survey_questions')->where('id',$key)->where('survey_id',$insert_survey)->update([
          'question'=>$questions[$key],
          'reply_mode'=>$replyMode[$key]
          ]);

        if ($replyMode[$key]==2) {
                $loopArr='ereply'.$key;
                $replies=$request->$loopArr;
                if (!is_null($replies)) {
                foreach ($replies as $k => $v) {
                  if (isset($replies[$k])) {
                    DB::table('survey_answers')->where('id',$k)->update([
              'answer'=>$replies[$k]
              ]);
                  }
                
                }
              }

                $newloopArr='reply'.$key;
                $newreplies=$request->$newloopArr;
                if (!is_null($newreplies)) {
                foreach ($newreplies as $newk => $newv) {
                  if (isset($newreplies[$newk])) {
                DB::table('survey_answers')->insert([
                  'survey_id'=>$insert_survey,
              'question_id'=>$key,
              'answer'=>$newreplies[$newk]
              ]);
                }
              }
            }
        }
        elseif ($replyMode[$key]==3) {
            $loopArr='eradioReply'.$key;
                $replies=$request->$loopArr;
                if (!is_null($replies)) {
                foreach ($replies as $ke => $va) {
                  if (isset($replies[$ke])) {
                DB::table('survey_answers')->where('id',$ke)->update([
              'answer'=>$replies[$ke]
              ]);
                }
              }
            }
              $newloopArr='radioReply'.$key;
                $newreplies=$request->$newloopArr;
                if (!is_null($newreplies)) {
                foreach ($newreplies as $newke => $newva) {
                  if (isset($newreplies[$newke])) {
                DB::table('survey_answers')->insert([
                  'survey_id'=>$insert_survey,
              'question_id'=>$key,
              'answer'=>$newreplies[$newke]
              ]);
                }
              }
            }
        }
            elseif ($replyMode[$key]==7) {
            $loopArr='echeckReply'.$key;
                $replies=$request->$loopArr;
                if (!is_null($replies)) {
                foreach ($replies as $ky => $val) {
                  if (isset($replies[$ky])) {
                DB::table('survey_answers')->where('id',$ky)->update([
              'answer'=>$replies[$ky]
              ]);
                }
              }
            }
              $newloopArr='checkReply'.$key;
                $newreplies=$request->$newloopArr;
                if (!is_null($newreplies)) {
                foreach ($newreplies as $newky => $newval) {
                  if (isset($newreplies[$newky])) {
                DB::table('survey_answers')->insert([
                  'survey_id'=>$insert_survey,
              'question_id'=>$key,
              'answer'=>$newreplies[$newky]
              ]);
                }
              }
            }
        }
        elseif ($replyMode[$key]==5) {
           $loopArr='emarks'.$key;
                $reply=$request->$loopArr;
                if (!is_null($reply)) {
              foreach ($reply as $kz => $vz) {
                if (isset($reply[$kz])) {
           DB::table('survey_marks')->where('id',$kz)->update([
              'marks'=>$reply[$kz]
              ]);
              }
            }
          }
          if (isset($marks[$key])) {
             DB::table('survey_marks')->insert([
                'survey_id'=>$insert_survey,
              'question_id'=>$key,
              'marks'=>$marks[$key]
              ]);
            }        
          }


        }
            Alert::success('Success','Survey successfully updated');
            return redirect("editSurvey/".$insert_survey);
      // }
      // else{
      //      Alert::error('Error','An error occurred, try again later');
      //       return redirect("editSurvey/".$insert_survey);
      // }
    }

    public function printResponse($id){
              $survey=DB::table('survey')
                        ->where('id','=',$id)
                        ->where('archiveStatus','=',0)
                        ->where('user_id','=',Auth::user()->id)
                        ->first();
    $questions=DB::table('survey_questions')
                ->where('survey_id',$id)
                ->get();
    $marks=DB::table('survey_marks')
            ->where('survey_id',$id)
            ->get();
    $answers=DB::table('survey_answers')
            ->where('survey_id',$id)
            ->get();

            $tableName=DB::table('survey_questions')->where('survey_id',$id)->first();
              if ($tableName->reply_mode==1) {
                $table="reply_written";
              }
              elseif ($tableName->reply_mode==7 || $tableName->reply_mode==2 ||$tableName->reply_mode==3) {
                $table="reply_choices";
              }
              elseif ($tableName->reply_mode==4 ||$tableName->reply_mode==5) {
                $table="reply_points";
              }
              elseif ($tableName->reply_mode==6) {
                $table="reply_date";
              }
    $responses=DB::table($table)->where('question_id',$tableName->id)->count();

        $data=array('responses'=>$responses,'survey'=>$survey,'marks'=>$marks,'questions'=>$questions,'answers'=>$answers);

        $pdf = PDF::loadView('survey.downloadSurvey', $data);
 return $pdf->download($survey->survey_name.' responses.pdf'); 
    }
    // public function publishSurvey($id){

    //   $users=DB::table('users')->get();

    //     if (!empty($users)) {
    //       $survey=DB::table('survey')->where('id',$id)->first();
    //     foreach($users as $em){
    //       $email=$em->email;
    //       $firstname=$em->name;
    //       if (!empty($email)) {
    //           $to=$email;
    //           $name=$firstname;
    //           $subject ="RE: ".$survey->survey_name;

    //           $from ="zalegosurveys@zalegoenterprise.com";
    //           $messagedd="You are invited to fill a survey using the link below. The survey will take a few minutes to complete.
    //           We would be delighted to hear from you and incorporate your feedback. Thanks. <br>https://hrm.zalegoinstitute.ac.ke/zalegosurvey/public/surveys/".$survey->uniqueId;

    //           $data = array('name'=>$name,'subject'=>$subject,'to'=>$to,'from'=>$from,'messagedd'=>$messagedd);
    //           // return $data;
    //           Mail::send('mails.perfomanceMails', $data, function($message) use($data){
    //            $message->to($data['to'])
    //            ->subject($data['subject']);
    //            $message->from($data['from'],'Zalego Surveys');
    //         });
    //       }
    //     }
    //     DB::table('survey')->where('id',$id)->update(['publish'=>1]);
    //     Alert::success('Success','Survey successfully published');
    //         return back();

    //   }else{
    //      Alert::info('Info','There are no clients to publish survey to');
    //         return back();
    //   }

    // }
     public function publishSurvey(Request $request){
        $data=request()->validate([
            'subject'=>'required',
            'message'=>'required',
            'groups'=>'required',
            'surveyId'=>''
        ]   
    );

    
    $selectedGroups=[];
    $grps[]=$data['groups'];
    foreach($grps as $group){
        //getting the group names
        array_push($selectedGroups,Group::find($group)->name);
    }
    
$countz=0;
// dd($selectedGroups);
        //Getting all clients
        foreach($grps as $group){
            foreach(Client::where('group_id',$group)->get(['id']) as $client){
                $countz++;
                }
            }
    if ($countz>0) {
    // dd('not empty'.$countz);
      $links=DB::table('survey')->where('id',$data['surveyId'])->value('uniqueId');
//send unique id to user with email



    $insert= EmailEvent::create([
        'subject'=>"RE: ".$data['subject'],
        'message'=>$data['message']."<br><a href=\"https://hrmis.zalegoenterprise.com/zalegosurvey/public/surveys/$links\""."><button style=\"border: none;color: white;padding:
 15px 42px;text-align: center;text-decoration: none;display: block;font-size: 16px;margin-left:auto;margin-right:auto;cursor: pointer;border-radius:
  5px;background-color: #F96F34;\">Submit here</button></a><br><center><a href=\"https://hrmis.zalegoenterprise.com/zalegosurvey/public/surveys/$links\"".">Or click here to submit feedback</a></center>",
        'group'=>json_encode($selectedGroups),
    ]);

    if($insert){

        $smsID=$insert->id;

        $count=0;
        foreach($grps as $group){
          
            foreach(Client::where('group_id',$group)->get(['id']) as $client){

                //Saving the event to emails table
                GEmailEvent::create([
                    'email_id'=>$smsID,
                    'client_id'=>$client->id,
                    'game'=>$data['surveyId'],
                    'status'=>'Pending'
                ]);

                //Increment after every loop
                $count++;

            }
        }
       
        //Update the events table
        EmailEvent::find($smsID)->update([
            'total'=>$count,
        ]);

        DB::table('survey')->where('id',$data['surveyId'])->update(['publish'=>1]);
        // }
        //check if file is selectted
        // if(isset($data['a_file'])){
            // foreach($data['a_file'] as $file){

            //     $extension=$file->getClientOriginalExtension();
            //     $name=rand().'.'. $extension;
            //     $name=$file->getClientOriginalName();
            //     $file->move('attachments',$name);

                // $insert=Attachment::create(
                //    ['email_id'=>$smsID,
                //     'file'=> $data['a_file']]
                // );

            // }

        // }
    Alert::success('Success','Email(s) successfully sent');
        return back();

     }else{
        //redirect back with an error message
        Alert::error('Error','Sorry, something went wrong');
        return back();
        }
     }
    else{
        Alert::error('Error','Group selected has 0 clients');
        return back();
    }

}

//publish to client

public function publishSurvey1(Request $request){
  $data=request()->validate([
      'subject'=>'required',
      'message'=>'required',
      'groups'=>'required',
      'surveyId'=>''
  ]   
);


$selectedGroups=[];
$grps[]=$data['groups'];
foreach($grps as $group){
  //getting the group names
  array_push($selectedGroups,Group::find($group)->name);
}

$countz=0;
// dd($selectedGroups);
  //Getting all clients
  foreach($grps as $group){
      foreach(Client::where('group_id',$group)->get() as $client){
       //dd($client->email);
          $countz++;
          }
      }
if ($countz>0) {
// dd('not empty'.$countz);
$links=DB::table('survey')->where('id',$data['surveyId'])->value('uniqueId');
//send unique id to user with email
$linkid=$client->id;
//dd($linkid);

$insert= EmailEvent::create([
  'subject'=>"RE: ".$data['subject'],
  'message'=>$data['message']."<br><a href=\"https://hrmis.zalegoenterprise.com/zalegosurvey/public/surveys/id=$linkid/$links\""."><button style=\"border: none;color: white;padding:
15px 42px;text-align: center;text-decoration: none;display: block;font-size: 16px;margin-left:auto;margin-right:auto;cursor: pointer;border-radius:
5px;background-color: #F96F34;\">Submit here</button></a><br><center><a href=\"https://hrmis.zalegoenterprise.com/zalegosurvey/public/surveys/id=$linkid/$links\"".">Or click here to submit feedback</a></center>",
  'group'=>json_encode($selectedGroups),
]);

dd($insert);
if($insert){

  $smsID=$insert->id;

  $count=0;
  foreach($grps as $group){
    
      foreach(Client::where('group_id',$group)->get(['id']) as $client){

          //Saving the event to emails table
          GEmailEvent::create([
              'email_id'=>$smsID,
              'client_id'=>$client->id,
              'game'=>$data['surveyId'],
              'status'=>'Pending'
          ]);
          //dd($client->email);
          //Increment after every loop
          $count++;

      }
  }
 
  //Update the events table
  EmailEvent::find($smsID)->update([
      'total'=>$count,
  ]);

  DB::table('survey')->where('id',$data['surveyId'])->update(['publish'=>1]);

Alert::success('Success','Email(s) successfully sent');
  return back();

}else{
  //redirect back with an error message
  Alert::error('Error','Sorry, something went wrong');
  return back();
  }
}
else{
  Alert::error('Error','Group selected has 0 clients');
  return back();
}

}
public function send(){
    //Increasing server execution time
    ini_set('max_execution_time', 600);
    //get sms from table
    $emailList=GEmailEvent::where(['status'=>'Pending'])->paginate(2); //-------->15
    if(count($emailList)>0){
        foreach ($emailList as $email) {
            $emailData=[
                'id'=>$email['id'],
                'email_id'=>$email['email_id'],
                'phone'=>$email->client->phone,
                'email'=>$email->client->email,
                'name'=>$email->client->firstName,
                'gameID'=>$email['game'],
            ]; 
              NewSurveyController::sendWithoutLink($emailData);
        }
    }
}

public function sendWithoutLink($emailData){
    $event=EmailEvent::where('id',$emailData['email_id'])->first();
    $company=DB::table('survey')->where('id',$emailData['gameID'])->value('company');
    $fEmail=DB::table('survey')->where('id',$emailData['gameID'])->value('email');

    if (is_null($fEmail)) {
      $fEmail=env('MAIL_USERNAME');
    }

    $data=array('subject'=>$event->subject, 'company'=>$company,'fromEmail'=>$fEmail,'messagedd'=>$event->message,'name'=>$emailData['name'],'email'=>$emailData['email'],'email_id'=>$emailData['email_id']);
    if (is_null($data['email'])) {
        GEmailEvent::where('id',$emailData['id'])->delete();
        // EmailEvent::where('id',$emailData['email_id'])->delete();
        return back();
    }
    $sendMail= Mail::send('mails.perfomanceMails', $data, function($message) use($data){
                $files=Attachment::where('email_id',$data['email_id'])->get();
                $message->to($data['email']);
                $message->subject($data['subject']);
                // $message->from(env('MAIL_USERNAME'));
                $message->from($data['fromEmail'],$data['company']);

                //send 
                // if(isset($files)){
                //     foreach($files as $file){
                //          if (is_null($file->type)) {
                //     $path=public_path() . '/' . $file->file;
                //     }else{
                //     // storage_path("$file->file");
                //     // $path=" http://165.22.0.57/mgc/public/".$file->file;
                //     $path="http://165.22.0.57/mgc/public//attachments/".$file->file;
                //         }
                //         // $path=public_path() . '/' . $file->file;
                //         // $path=" http://165.22.0.57/mgc/public/".$file->file;
                //         // $path=" http://165.22.0.57/mgc/public//attachments/".$file->file;
                //         $message->attach($path);
                       
                //     }
                //  }
    });

    $update=GEmailEvent::where('id',$emailData['id'])->update(['status'=>'Sent']);
    Alert::success('success','Email sent successfully');
    return back();
}
}
