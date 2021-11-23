<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Controllers\Auth\Request;
use DB;
use ActivityLog;
use Carbon\Carbon;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    //protected $redirectTo = RouteServiceProvider::HOME;
    //protected $redirectTo = '/crm2';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

  
    
    public function sendLoginResponse(){
        $longi = request('longi');
        $lati=request('lati');
        $userid=auth()->user()->id;
        $userID2=auth()->user()->email;
        $action ="Has loged in";
        $ip = $_SERVER["REMOTE_ADDR"];
        $host = gethostname();
       date_default_timezone_set("Africa/Nairobi");
       $loginTime = date("Y-m-d H:i:s",strtotime("+0 HOURS"));
       date_default_timezone_set("Africa/Nairobi");
       $today = date("Y-m-d",strtotime("+0 HOURS"));
       
      
      
       //check if record exists in activity_logs table
       $activitylog = DB::table('activity_logs')
       ->where('employee_id',[$userid])
       ->where('created_at','>=',[$today])
       ->get()->last();
     
    
        if($activitylog==null){
        //add record if not exist
        $activity="logedIn";
        $insertcreated=DB::insert('INSERT INTO activity_logs(employee_id,activity,created_at) VALUES(?,?,?)',[$userid,$activity,$loginTime]);

        }else{
          //update record if exists
          $createdTime=$activitylog->created_at;
          $updatecreated=DB::update("UPDATE activity_logs SET updated_at='$loginTime' Where created_at='$createdTime'");
        }
       //end ofactivity logs
       
       //check if record exist in history_logs
        $log = DB::table('history_log')
        ->where('email_address',[$userID2])
        ->get()->last();
       
      //past record present in history logs
        if($log!=null){
            $estates = DB::table('history_log')
            ->where('email_address',[$userID2])
            ->orderBy('login_time','asc')
            ->get()->last();
             $endTime = $estates->login_time;
             $shiftTime = $estates->logout_time;
             $date = $endTime;
             $todaylogin = date('Y:m:d', strtotime($date));
             
          //check if login is today and  logout is null
            if($todaylogin==$today && $shiftTime!=null){
              
                $breaktime1=(strtotime($loginTime) - strtotime($endTime)) / 3600;
                $breaktime=round($breaktime1,3);
                $breaktime2 = round(($breaktime)/60,3);
             
                $insert=DB::update("UPDATE history_log SET break='1',break_time='$breaktime' Where login_time='$endTime'");
                $insert1=DB::insert('INSERT INTO history_log(email_address,userid,action,ip,host,login_time,latitude,longitude) VALUES(?,?,?,?,?,?,?,?)',[$userID2,$userid,$action,$ip,$host,$loginTime,$lati,$longi]);
                     
            }else{
             
                   //check if user had not logedout within any day's record 
                   $checklastlogout = DB::table('history_log')
                   ->where('email_address',[$userID2])
                   ->where('logout_time','=',NULL)
                   ->orderBy('login_time','asc')
                   ->get()->last();
                 
                  if($checklastlogout==null){
                    $breaktime1=(strtotime($loginTime) - strtotime($endTime)) / 3600;
                    $breaktime=round($breaktime1,3);
                    $breaktime2 = round(($breaktime)/60,3);
                    

                    $insert6=DB::update("UPDATE history_log SET break='1',break_time='$breaktime' Where login_time='$endTime' And email_address='$userID2'");
                    $insert1=DB::insert('INSERT INTO history_log(email_address,userid,action,ip,host,login_time,latitude,longitude) VALUES(?,?,?,?,?,?,?,?)',[$userID2,$userid,$action,$ip,$host,$loginTime,$lati,$longi]);
                  }else{
                    $checkloginlast = DB::table('history_log')
                    ->where('email_address',[$userID2])
                    ->orderBy('login_time','asc')
                    ->get()->last();
                     $logintyme=$checkloginlast->login_time;
                   
                   
                    if($logintyme>=$today){
                      $lastactivity=$activitylog->updated_at;
                     //dd($lastactivity);
                    //get break when user logout forcefuly
                    $breakt1=(strtotime($loginTime) - strtotime($lastactivity)) / 3600;
                    $breakt=round($breakt1,3);
                    $breakt2 = round(($breakt)/60,3);
                    
                   $insert=DB::update("UPDATE history_log SET break='1',actions='Forced logout within today',break_time='$breakt',logout_time='$lastactivity' Where login_time='$logintyme'");
                    $insert1=DB::insert('INSERT INTO history_log(email_address,userid,action,ip,host,login_time,latitude,longitude) VALUES(?,?,?,?,?,?,?,?)',[$userID2,$userid,$action,$ip,$host,$loginTime,$lati,$longi]);

                    }else{

                      $activitylog1 = DB::table('activity_logs')
                      ->where('employee_id',[$userid])
                      ->where('updated_at','!=',NULL)
                      ->get()->last();
                      $lastactivity=$activitylog1->updated_at;
                      //dd($lastactivity);
                      $insert=DB::update("UPDATE history_log SET break='0',actions='Forced logout',logout_time='$lastactivity' Where login_time='$logintyme'");
                      $insert1=DB::insert('INSERT INTO history_log(email_address,userid,action,ip,host,login_time,latitude,longitude) VALUES(?,?,?,?,?,?,?,?)',[$userID2,$userid,$action,$ip,$host,$loginTime,$lati,$longi]);
                      
                    }
                  }
                 
               }
               return redirect()->intended('/employeerequest');
        }else{
           
        $insert1=DB::insert('INSERT INTO history_log(email_address,userid,action,ip,host,login_time,latitude,longitude) VALUES(?,?,?,?,?,?,?,?)',[$userID2,$userid,$action,$ip,$host,$loginTime,$lati,$longi]);
        return redirect()->intended('/employeerequest');  
      }
      return back();
     }    
    
}
