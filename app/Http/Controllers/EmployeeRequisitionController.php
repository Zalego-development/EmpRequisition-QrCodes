<?php

namespace App\Http\Controllers;

use App\Models\EmployeeRequisition;
use App\Models\user;
use App\Models\JobApproval;
use App\Models\Employeerequistionsettings;
use App\Models\Employeerequistionusers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use DB;
use RealRashid\SweetAlert\Facades\Alert;
class EmployeeRequisitionController extends Controller
{
    // public function __construct (){
    //     $this->middleware('auth');
    // }
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {         
        $users=User::all();
        $user_id=Auth::user()->id;
        $employeeRequisitions=EmployeeRequisition::where('posskills', $user_id)->where('approved_status', 0)->orderBy('created_at', 'DESC')->get();
        return view('employeerequisitions.index', compact('employeeRequisitions', 'users'));
    }
    /**
     * call to action when the initiator is executive lead
     * */
 public function calltoactionceoexecinitiator()
    {         
        $users=User::all();
         $employeeRequisitions=EmployeeRequisition::where('approved_status', '0')->Where('status', 'initiated')->where('role', 'Executive Lead')->where('stage1', 1)->where('stages', 1)->where('stage2', 1)->get();
        return view('employeerequisitions.calltoactionceoexecinitiator', compact('employeeRequisitions', 'users'));
    }
    /**
     * call to action when the hr is the initiator calltoactionexechrinitiator
     * */
   public function calltoactionexechrinitiator()
    {         
        $users=User::all();
        $employeeRequisitions=EmployeeRequisition::where('approved_status', '0')->Where('status', 'initiated')->where('role', 'HR Manager')->where('stage1', 1)->where('stages', 1)->get();
        return view('employeerequisitions.calltoactionexechrinitiator', compact('employeeRequisitions', 'users'));
    }
    /**
     * cal to action to ceo when the hr is the initiatot calltoactionceochrinitiator  
     * */
       public function calltoactionceochrinitiator() 
    {         
        $users=User::all();
        $employeeRequisitions=EmployeeRequisition::where('approved_status', '0')->Where('status', 'initiated')->where('role', 'HR Manager')->where('stage1', 1)->where('stages', 1)->where('stage2', 1)->get();
        return view('employeerequisitions.calltoactionceochrinitiator', compact('employeeRequisitions', 'users'));
    }
    /**
     * call to action hr manager when the initiator is the recruiter
     * */
    public function calltoactionhrrecrurinitiator()
    {         
        $users=User::all();
        $employeeRequisitions=EmployeeRequisition::where('approved_status', '0')->Where('status', 'initiated')->where('stages', '1')->where('role', "HR Recruitment Team")->get();
        return view('employeerequisitions.calltoactionhrrecrurinitiator', compact('employeeRequisitions', 'users'));
    }
    /**
     * call to action when the recruiter is the intiator exec now approving calltoactionexecrecrurinitiator
     * */
       public function calltoactionexecrecrurinitiator()
    {         
        $users=User::all();
        $employeeRequisitions=EmployeeRequisition::where('approved_status', '0')->Where('status', 'initiated')->where('stages', '1')->where('stage1', '1')->where('role',"HR Recruitment Team")->get();
        return view('employeerequisitions.calltoactionexecrecrurinitiator', compact('employeeRequisitions', 'users'));
    } 
    /**
     * cal to action when the recru is the initiator to ceo
     * */
        public function calltoactionceorecruinitiator()
    {         
        $users=User::all();
         $employeeRequisitions=EmployeeRequisition::where('approved_status', '0')->Where('status', 'initiated')->where('stages', '1')->where('stage1', '1')->where('stage2', '1')->where('role',"HR Recruitment Team")->get();
        return view('employeerequisitions.calltoactionceorecruinitiator', compact('employeeRequisitions', 'users'));
    }    
 public function calltoaction()
    {         
        $users=User::all();
        $employeeRequisitions=EmployeeRequisition::where('approved_status', '0')->Where('status', 'initiated')->where('role', "")->get();
        return view('employeerequisitions.calltoaction', compact('employeeRequisitions', 'users'));
    }
     public function calltoaction1()
    {         
        $users=User::all();
         $employeeRequisitions=EmployeeRequisition::where('approved_status', '0')->Where('status', 'initiated')->where('stages', '1')->where('role', "")->get();
        return view('employeerequisitions.calltoaction1', compact('employeeRequisitions', 'users'));
    }
     public function calltoaction2()
    {         
        $users=User::all();
        $employeeRequisitions=EmployeeRequisition::where('approved_status', '0')->where('stages', '1')->where('stage1', '1')->Where('status', 'initiated')->where('role', "")->get();
        return view('employeerequisitions.calltoaction2', compact('employeeRequisitions', 'users'));
    }

     public function calltoaction3()
    {         
        $users=User::all();
         $employeeRequisitions=EmployeeRequisition::where('approved_status', '0')->Where('status', 'initiated')->where('stages', '1')->where('stage1', '1')->where('stage2', '1')->where('role', "")->get();
        return view('employeerequisitions.calltoaction3', compact('employeeRequisitions', 'users'));
    }

    // view approved jobs

     public function approvedrequisitions()
    {     

        //get the role     
        $user=Auth::user()->id;
        $users=User::all();
        $employeeRequisitions=EmployeeRequisition::where('approved_status', '1')->Where('posskills',$user)->get();
        return view('employeerequisitions.approvedrequisitions', compact('employeeRequisitions', 'users'));
    }
    ///declined requisitions
         public function declinedrequisitions()
    {         
        $user_id=Auth::user()->id;
        $users=User::all();
        $employeeRequisitions=EmployeeRequisition::where('approved_status', '2')->where('posskills', $user_id)->get();
        return view('employeerequisitions.declinedrequisitions', compact('employeeRequisitions', 'users'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $user=Auth::user()->id;
        //get the role if any
        $getrole=DB::table('employeerequisitionusers')
                ->where('userId', $user)
                ->first();
                $role=$getrole->employeetype ?? null;
     $validated = $request->validate([
            'jobdescription' => 'required',
            'positions' => 'required|numeric',
            'location'=>'required',
            'jobcategory'=>'required',
            'startdate'=>'required',
            'intenting.*'=>'required',
            'manager'=>'required',
            'pwd'=>'required',
            'salarybudget'=>'required',
            'interviews.*'=>'required',
            'employementtype' => 'required|string',
            'posrequirements' => 'required',
            'salary' => 'required|not_in:0|numeric',
            // 'salaryto' => 'required|not_in:0|numeric',
            'responsibilities' => 'required',
           

            ]);
       
            $validated['intenting'] = serialize($validated['intenting']);
             $validated['interviews'] = serialize($validated['interviews']);
            $jobtitle = $request->jobtittle_input ? $request->jobtittle_input : $request->jobtittle;
            $job = EmployeeRequisition::create(array_merge($validated, ['posskills' => $user], ['jobtittle' => $jobtitle]));
// if the initiator is the HR Recruiter
        if ($role=='HR Recruitment Team') {

            // get the manager to report to 
            $getmanager=DB::table('employeerequisitions')
                       ->where('id', $job->id)
                       ->first();
                    
            $usercompany_id = Auth::user()->company_id;
            $user_id = Auth::user()->id;
            if ($getmanager->manager !== $user_id) {

                //getrole of manager to report
                $getrole=DB::table('employeerequisitionusers')
                ->where('userId', $getmanager->manager)
                ->first();
                $role=$getrole->employeetype ?? null;
                // if ($role=="Group CEO" || $role=="Executive Lead") {
                //    dd('please dont select Group CEO and Executive Lead as managers to report to');
                // }
                if ($role=="HR Recruitment Team" || $role=="HR Manager"||$role=="Group CEO" ||$role =="Executive Lead") {
                   $company=DB::table('companies')
                      ->where('id', $usercompany_id)
                    ->first();
              $company_id=$company->id;
            $companybossid=DB::table('employeerequisitionusers')
                       ->where('company_id' , $company_id)
                       ->first();
            // $boos_id =$companybossid->userId;
            $headofcompany=DB::table('employeerequisitionusers')
                    ->join('users', 'users.id', '=' , 'employeerequisitionusers.userId')
                    ->where('employeerequisitionusers.userId' ,$user_id)
                    ->get();
            $ldate = date('Y-m-d H:i:s');
                 // dd($ldate);
            $storeapprove1=DB::table('requsitionsapprovals')
                          ->insert([
                          'jobid' => $job->id,
                          'userId' => Auth::user()->id,
                          'initiator' => "initiator",
                          'company_id'=>$usercompany_id,
                          'date'=>$ldate,
                                 ]);
            // $job = EmployeeRequisition::find($id)->first();   
                         //proceed to send email to the HR 
            $sendmailtohr=DB::table('employeerequisitionusers')
                               ->join('users', 'users.id','=', 'employeerequisitionusers.userId')
                               ->where('employeerequisitionusers.employeetype', 'HR Manager')   
                               ->get();
                               //dd($sendmailtogroupceo);
     

                      foreach($sendmailtohr as $usersemails)
            { 
                //dd($usersemails->email);

            $data = array(    
                'user'=>Auth::user()->id, 
                'username'=>Auth::user()->name, 
                'company_id'=> Auth::user()->company_id, 
                'id'=> $job->id,
                'stages'=>$job->stages,
                'stages1'=> [
                                'HR Recruitment Team'=>$job->stages,
                                'HR Manager'=>$job->stage1,'Executive Lead'=>$job->stage2,
                                'Group CEO'=>$job->stage3
                        ],

                'jobtittle'      =>  $job->jobtittle,
                'positions'      =>  $job->positions,
                'employementtype'      =>  $job->employementtype,
                'salary'      =>  $job->salary,
                'salarybudget'      =>  $job->salarybudget,
                // 'salaryto'      =>  $job->salaryto,
                'responsibilities'      =>  $job->responsibilities,
                'posrequirements'      =>  $job->posrequirements,
                'posskills'      =>  $job->posskills,
                'location'   =>   $job->location,
                'jobcategory'   =>   $job->jobcategory,
                'intenting'   =>   unserialize($job->intenting),
                'startdate'   =>   $job->startdate,
                'manager'   =>   $job->manager,
                'pwd'   =>   $job->pwd,
                'interviews'   => unserialize( $job->interviews),
                'rec'=>$usersemails->id,
                'jobdescription'   =>   $job->jobdescription
            );
              \Mail::to($usersemails->email)->send(new \App\Mail\recrutohr($data));
            } 

            $updateinitiatecollumn=DB::table('employeerequisitions')
                                    ->where('id',$job->id)
                                    ->update(['status' => "initiated", 'stages' => '1', 'role'=>'HR Recruitment Team']);
                                    Alert::success('Success',' Requisition has been made successfully');
                                    return redirect()->route('tabspage');
                }
                // get the manager email 
                $emailmanager=DB::table('users')
                             ->where('id', $getmanager->manager)
                             ->first();

                                 $company=DB::table('companies')
                      ->where('id', $usercompany_id)
                    ->first();
              $company_id=$company->id;
            $companybossid=DB::table('employeerequisitionusers')
                       ->where('company_id' , $company_id)
                       ->first();
            $boos_id =$companybossid->userId;
            $headofcompany=DB::table('employeerequisitionusers')
                    ->join('users', 'users.id', '=' , 'employeerequisitionusers.userId')
                    ->where('employeerequisitionusers.userId' ,$user_id)
                    ->get();
            $ldate = date('Y-m-d H:i:s');
                 // dd($ldate);
           $storeapprove1=DB::table('requsitionsapprovals')
                          ->insert([
                          'jobid' => $job->id,
                          'userId' => Auth::user()->id,
                          'initiator' => "initiator",
                          'company_id'=>$usercompany_id,
                          'date'=>$ldate,
                                 ]); 
            // $job = EmployeeRequisition::find($id)->first();     
                 $data = array(    
                'user'=>Auth::user()->id, 
                'username'=>Auth::user()->name, 
                'company_id'=> Auth::user()->company_id, 
                'id'=> $job->id,
                'stages'=>$job->stages,
                'stages1'=> [
                                'HR Recruitment Team'=>$job->stages,
                                'HR Manager'=>$job->stage1,'Executive Lead'=>$job->stage2,
                                'Group CEO'=>$job->stage3
                        ],

                'jobtittle'      =>  $job->jobtittle,
                'positions'      =>  $job->positions,
                'employementtype'      =>  $job->employementtype,
                'salary'      =>  $job->salary,
                'salarybudget'      =>  $job->salarybudget,
                // 'salaryto'      =>  $job->salaryto,
                'responsibilities'      =>  $job->responsibilities,
                'posrequirements'      =>  $job->posrequirements,
                'posskills'      =>  $job->posskills,
                'location'   =>   $job->location,
                'jobcategory'   =>   $job->jobcategory,
                'intenting'   =>   unserialize($job->intenting),
                'startdate'   =>   $job->startdate,
                'manager'   =>   $job->manager,
                'pwd'   =>   $job->pwd,
                'rec'=>$emailmanager->id,
                'interviews'   => unserialize( $job->interviews),
                'jobdescription'   =>   $job->jobdescription
            );
             
             \Mail::to($emailmanager->email)->send(new \App\Mail\recrutohiringmanager($data));
            $updateinitiatecollumn=DB::table('employeerequisitions')
                                    ->where('id',$job->id)
                                    ->update(['status' => "initiated", 'stages' => '1', 'role'=>'HR Team']);
                                    Alert::success('Success',' Requisition has been made successfully');
                                    return redirect()->route('tabspage');
             }




            $company=DB::table('companies')
                      ->where('id', $usercompany_id)
                    ->first();
              $company_id=$company->id;
            $companybossid=DB::table('employeerequisitionusers')
                       ->where('company_id' , $company_id)
                       ->first();
            // $boos_id =$companybossid->userId;
            $headofcompany=DB::table('employeerequisitionusers')
                    ->join('users', 'users.id', '=' , 'employeerequisitionusers.userId')
                    ->where('employeerequisitionusers.userId' ,$user_id)
                    ->get();
            $ldate = date('Y-m-d H:i:s');
                 // dd($ldate);
            $storeapprove1=DB::table('requsitionsapprovals')
                          ->insert([
                          'jobid' => $job->id,
                          'userId' => Auth::user()->id,
                          'initiator' => "initiator",
                          'company_id'=>$usercompany_id,
                          'date'=>$ldate,
                                 ]);
            // $job = EmployeeRequisition::find($id)->first();     

          
             //proceed to send email to the HR 
            $sendmailtohr=DB::table('employeerequisitionusers')
                               ->join('users', 'users.id','=', 'employeerequisitionusers.userId')
                               ->where('employeerequisitionusers.employeetype', 'HR Manager')   
                               ->get();
                               //dd($sendmailtogroupceo);
            foreach($sendmailtohr as $usersemails)
            { 
                $data = array(    
                'user'=>Auth::user()->id, 
                'username'=>Auth::user()->name, 
                'company_id'=> Auth::user()->company_id, 
                'id'=> $job->id,
                'stages'=>$job->stages,
                'stages1'=> [
                                'HR Recruitment Team'=>$job->stages,
                                'HR Manager'=>$job->stage1,'Executive Lead'=>$job->stage2,
                                'Group CEO'=>$job->stage3
                        ],

                'jobtittle'      =>  $job->jobtittle,
                'positions'      =>  $job->positions,
                'employementtype'      =>  $job->employementtype,
                'salary'      =>  $job->salary,
                'salarybudget'      =>  $job->salarybudget,
                // 'salaryto'      =>  $job->salaryto,
                'responsibilities'      =>  $job->responsibilities,
                'posrequirements'      =>  $job->posrequirements,
                'posskills'      =>  $job->posskills,
                'location'   =>   $job->location,
                'jobcategory'   =>   $job->jobcategory,
                'intenting'   =>   unserialize($job->intenting),
                'startdate'   =>   $job->startdate,
                'manager'   =>   $job->manager,
                'pwd'   =>   $job->pwd,
                'rec'=>$usersemails->id,
                'interviews'   => unserialize( $job->interviews),
                'jobdescription'   =>   $job->jobdescription
            );
                //dd($usersemails->email);
              \Mail::to($usersemails->email)->send(new \App\Mail\recrutohr($data));
            }      

            $updateinitiatecollumn=DB::table('employeerequisitions')
                                    ->where('id',$job->id)
                                    ->update(['status' => "initiated", 'stages' => '1', 'role'=>'HR Recruitment Team']);
                                    Alert::success('Success',' Requisition has been made successfully');
                                return redirect()->route('tabspage');

        } 

    // if the initiator is HR Manager
    //initiator is the hr manar

    if ($role =="HR Manager") {             
        $usercompany_id = Auth::user()->company_id;
        $user_id = Auth::user()->id;
                       //$head=$headofcompany->
        $company=DB::table('companies')
                ->where('id', $usercompany_id)
                ->first();
        $company_id=$company->id;

         $companybossid=DB::table('employeerequisitionusers')
                       ->where('company_id' , $company_id)
                       ->first();
        $boos_id =$companybossid->userId;

        $headofcompany=DB::table('employeerequisitionusers')
                    ->join('users', 'users.id', '=' , 'employeerequisitionusers.userId')
                    ->where('employeerequisitionusers.userId' ,$user_id)
                    ->get();
        $ldate = date('Y-m-d H:i:s');
         // dd($ldate);
        $storeapprove1=DB::table('requsitionsapprovals')
                          ->insert([
                          'jobid' => $job->id,
                          'userId' => Auth::user()->id,
                          'initiator' => "initiator",
                          'company_id'=>$usercompany_id,
                          'date'=>$ldate,
                                 ]); 
        $data = array(    
                'user'=>Auth::user()->id, 
                'username'=>Auth::user()->name, 
                'company_id'=> Auth::user()->company_id, 
                'id'=> $job->id,
                'stages'=>$job->stages,
                'stages1'=> [
                                'HR Recruitment Team'=>$job->stages,
                                'HR Manager'=>$job->stage1,'Executive Lead'=>$job->stage2,
                                'Group CEO'=>$job->stage3
                        ],

                'jobtittle'      =>  $job->jobtittle,
                'positions'      =>  $job->positions,
                'employementtype'      =>  $job->employementtype,
                'salary'      =>  $job->salary,
                'salarybudget'      =>  $job->salarybudget,
                // 'salaryto'      =>  $job->salaryto,
                'responsibilities'      =>  $job->responsibilities,
                'posrequirements'      =>  $job->posrequirements,
                'posskills'      =>  $job->posskills,
                'location'   =>   $job->location,
                'jobcategory'   =>   $job->jobcategory,
                'intenting'   =>   unserialize($job->intenting),
                'startdate'   =>   $job->startdate,
                'manager'   =>   $job->manager,
                'pwd'   =>   $job->pwd,
                'interviews'   =>  unserialize( $job->interviews),
                'jobdescription'   =>   $job->jobdescription
        );
          
        $initiatorcompany=DB::table('requsitionsapprovals')
                                 ->join('users', 'users.id','=' ,'requsitionsapprovals.userId')
                                 ->join('companies', 'companies.id', '=', 'users.company_id')
                                 ->where('requsitionsapprovals.jobid', $job->id)
                                 ->where('requsitionsapprovals.initiator', 'initiator')
                                 ->first()->company_id;
                                 // dd($initiatorcompany);


        $bossId = DB::table("employeerequisitionusers")->where("company_id","=",$initiatorcompany)->where("employeetype","=","Executive Lead")->first()->userId;
                $data = array(    
                'user'=>Auth::user()->id, 
                'username'=>Auth::user()->name, 
                'company_id'=> Auth::user()->company_id, 
                'id'=> $job->id,
                'stages'=>$job->stages,
                'stages1'=> [
                                'HR Recruitment Team'=>$job->stages,
                                'HR Manager'=>$job->stage1,'Executive Lead'=>$job->stage2,
                                'Group CEO'=>$job->stage3
                        ],

                'jobtittle'      =>  $job->jobtittle,
                'positions'      =>  $job->positions,
                'employementtype'      =>  $job->employementtype,
                'salary'      =>  $job->salary,
                'salarybudget'      =>  $job->salarybudget,
                // 'salaryto'      =>  $job->salaryto,
                'responsibilities'      =>  $job->responsibilities,
                'posrequirements'      =>  $job->posrequirements,
                'posskills'      =>  $job->posskills,
                'location'   =>   $job->location,
                'jobcategory'   =>   $job->jobcategory,
                'intenting'   =>   unserialize($job->intenting),
                'startdate'   =>   $job->startdate,
                'manager'   =>   $job->manager,
                'pwd'   =>   $job->pwd,
                'interviews'   => unserialize( $job->interviews),
                'rec'=>$bossId,
                'jobdescription'   =>   $job->jobdescription
            );
        $bossEmail = DB::table("users")->where("id","=",$bossId)->first()->email;
         \Mail::to($bossEmail)->send(new \App\Mail\hrtoexec($data));


        $updateinitiatecollumn=DB::table('employeerequisitions')
                                    ->where('id',$job->id)
                                   ->update(['status' => "initiated", 'stages' => '1', 'stage1'=>'1', 'role'=>'HR Manager']);
                  Alert::success('Success','You  have made approvals  successfully');
                 return redirect()->route('tabspage'); 
                     // return redirect()->route('employeerequisitions.approvesmessage')
                     //    ->with('success','Requisition  have been made  successfully.');  
    }


 
    // role is executive lead
    if ($role =="Executive Lead") {
        $usercompany_id = Auth::user()->company_id;
        $user_id = Auth::user()->id;
                   //$head=$headofcompany->
        $company=DB::table('companies')
            ->where('id', $usercompany_id)
            ->first();
            $company_id=$company->id;
        $companybossid=DB::table('employeerequisitionusers')
                       ->where('company_id' , $company_id)
                       ->first();
        // $boos_id =$companybossid->userId;
        // $headofcompany=DB::table('employeerequisitionusers')
        //             ->join('users', 'users.id', '=' , 'employeerequisitionusers.userId')
        //             ->where('employeerequisitionusers.userId' ,$user_id)
        //             ->get();
        $ldate = date('Y-m-d H:i:s');
         // dd($ldate);
        $storeapprove1=DB::table('requsitionsapprovals')
                          ->insert([
                          'jobid' => $job->id,
                          'userId' => Auth::user()->id,
                          'initiator' => "initiator",
                          'company_id'=>$usercompany_id,
                          'date'=>$ldate,
                                 ]);    
        $data = array(    
                'user'=>Auth::user()->id, 
                'username'=>Auth::user()->name, 
                'company_id'=> Auth::user()->company_id, 
                'id'=> $job->id,
                'stages'=>$job->stages,
                'stages1'=> [
                                'HR Recruitment Team'=>$job->stages,
                                'HR Manager'=>$job->stage1,'Executive Lead'=>$job->stage2,
                                'Group CEO'=>$job->stage3
                        ],

                'jobtittle'      =>  $job->jobtittle,
                'positions'      =>  $job->positions,
                'employementtype'      =>  $job->employementtype,
                'salary'      =>  $job->salary,
                'salarybudget'      =>  $job->salarybudget,
                // 'salaryto'      =>  $job->salaryto,
                'responsibilities'      =>  $job->responsibilities,
                'posrequirements'      =>  $job->posrequirements,
                'posskills'      =>  $job->posskills,
                'location'   =>   $job->location,
                'jobcategory'   =>   $job->jobcategory,
                'intenting'   =>   unserialize($job->intenting),
                'startdate'   =>   $job->startdate,
                'manager'   =>   $job->manager,
                'pwd'   =>   $job->pwd,
                'interviews'   => unserialize($job->interviews),
                'jobdescription'   =>   $job->jobdescription
        );
               $user_id = Auth::user()->id;
       $getcompanyofexec=DB::table('users')
                          ->join('companies', 'companies.id', '=', 'users.company_id')
                          ->where('users.id', $user_id) 
                          ->first();
                         
        if ($getcompanyofexec->company =="StepWise") {
                                     $sendmailtogroupceo=DB::table('employeerequisitionusers')
                               ->join('users', 'users.id','=', 'employeerequisitionusers.userId')
                               ->where('employeerequisitionusers.employeetype', 'HR Manager')   
                               ->first();
                               //dd($sendmailtogroupceo);    
        \Mail::to($sendmailtogroupceo->email)->send(new \App\Mail\ceotohr($data));      

        $updateinitiatecollumn=DB::table('employeerequisitions')
                             ->where('id',$job->id)
                              ->update(['status' => "initiated", 'stages' => '1', 'stage1'=>'1', 'role'=>'Executive Lead', 'stage2'=> 1]);
                                    Alert::success('Success','Your Requisition has been made successfully');
                                    return redirect()->route('tabspage');
                          }
          
             //proceed to send email to the HR 
                     //proceed to send email to the group CEO client 
        $sendmailtogroupceo=DB::table('employeerequisitionusers')
                               ->join('users', 'users.id','=', 'employeerequisitionusers.userId')
                               ->where('employeerequisitionusers.employeetype', 'Group CEO')   
                               ->first();
                               //dd($sendmailtogroupceo);    
        \Mail::to($sendmailtogroupceo->email)->send(new \App\Mail\exectoceo($data));      

        $updateinitiatecollumn=DB::table('employeerequisitions')
                                    ->where('id',$job->id)
                                     ->update(['status' => "initiated", 'stages' => '1', 'stage1'=>'1', 'role'=>'Executive Lead', 'stage2'=> 1]);
                                    Alert::success('Success','Your Requisition has been made successfully');
                                  return redirect()->route('tabspage');
    }




    // if the Group CEO is the initiator
    if ($role =="Group CEO") {
        $usercompany_id = Auth::user()->company_id;
        $user_id = Auth::user()->id;
        $company=DB::table('companies')
            ->where('id', $usercompany_id)
            ->first();
            $company_id=$company->id;
        $companybossid=DB::table('employeerequisitionusers')
                       ->where('company_id' , $company_id)
                       ->first();
        $boos_id =$companybossid->userId;
                     $headofcompany=DB::table('employeerequisitionusers')
                    ->join('users', 'users.id', '=' , 'employeerequisitionusers.userId')
                    ->where('employeerequisitionusers.userId' ,$user_id)
                    ->get();
        $ldate = date('Y-m-d H:i:s');
         // dd($ldate);
        $storeapprove1=DB::table('requsitionsapprovals')
                          ->insert([
                          'jobid' => $job->id,
                          'userId' => Auth::user()->id,
                          'initiator' => "initiator",
                          'company_id'=>$usercompany_id,
                          'date'=>$ldate,
                                 ]);   
        $data = array(    
                'user'=>Auth::user()->id, 
                'username'=>Auth::user()->name, 
                'company_id'=> Auth::user()->company_id, 
                'id'=> $job->id,
                'stages'=>$job->stages,
                'stages1'=> [
                                'HR Recruitment Team'=>$job->stages,
                                'HR Manager'=>$job->stage1,'Executive Lead'=>$job->stage2,
                                'Group CEO'=>$job->stage3
                        ],

                'jobtittle'      =>  $job->jobtittle,
                'positions'      =>  $job->positions,
                'employementtype'      =>  $job->employementtype,
                'salary'      =>  $job->salary,
                'salarybudget'      =>  $job->salarybudget,
                // 'salaryto'      =>  $job->salaryto,
                'responsibilities'      =>  $job->responsibilities,
                'posrequirements'      =>  $job->posrequirements,
                'posskills'      =>  $job->posskills,
                'location'   =>   $job->location,
                'jobcategory'   =>   $job->jobcategory,
                'intenting'   =>   unserialize($job->intenting),
                'startdate'   =>   $job->startdate,
                'manager'   =>   $job->manager,
                'pwd'   =>   $job->pwd,
                'interviews'   => unserialize(  $job->interviews),
                'jobdescription'   =>   $job->jobdescription
        );
          
          
        //proceed to send email to the HR 
                     //proceed to send email to the group CEO client 
        $sendemailtohr=DB::table('employeerequisitionusers')
                               ->join('users', 'users.id','=', 'employeerequisitionusers.userId')
                               ->where('employeerequisitionusers.employeetype', 'HR Manager')   
                               ->first();
                               //dd($sendmailtogroupceo);    
        \Mail::to($sendemailtohr->email)->send(new \App\Mail\ceotohr($data));      

        $updateinitiatecollumn=DB::table('employeerequisitions')
                                    ->where('id',$job->id)
                                     ->update(['status' => "initiated", 'stages' => '1', 'stage1'=>'1', 'stage2'=>'1', 'stage3'=>'1', 'role'=>'Group CEO']);
                                    Alert::success('Success','Your Requisition has been made successfully');
                                   return redirect()->route('tabspage');
              }

        //send the normal user is the initiator    
    else{
            $usercompany_id = Auth::user()->company_id;
            $user_id = Auth::user()->id;
                   //$head=$headofcompany->
            $company=DB::table('companies')
            ->where('id', $usercompany_id)
            ->first();
            $company_id=$company->id;
            $companybossid=DB::table('employeerequisitionusers')
                       ->where('company_id' , $company_id)
                       ->first();
            $boos_id =$companybossid->userId;
            $headofcompany=DB::table('employeerequisitionusers')
                          ->join('users', 'users.id', '=' , 'employeerequisitionusers.userId')
                          ->where('employeerequisitionusers.userId' ,$user_id)
                          ->get();
            $ldate = date('Y-m-d H:i:s');
            // dd($ldate);
            $storeapprove1=DB::table('requsitionsapprovals')
                          ->insert([
                          'jobid' => $job->id,
                          'userId' => Auth::user()->id,
                          'initiator' => "initiator",
                          'company_id'=>$usercompany_id,
                          'date'=>$ldate,
                                 ]);    

          
                $whomtosendemail=DB::table('employeerequisitionusers')
                           ->join('users','users.id', '=', 'employeerequisitionusers.userId' )
                           ->where('employeerequisitionusers.employeetype', 'HR Recruitment Team')
                           ->get();
               foreach($whomtosendemail as $Hremails)
               { 
                 $data = array(    
                'user'=>Auth::user()->id, 
                'username'=>Auth::user()->name, 
                'company_id'=> Auth::user()->company_id, 
                'id'=> $job->id,
                'stages'=>$job->stages,
                'stages1'=> [
                                'HR Recruitment Team'=>$job->stages,
                                'HR Manager'=>$job->stage1,'Executive Lead'=>$job->stage2,
                                'Group CEO'=>$job->stage3
                        ],

                'jobtittle'      =>  $job->jobtittle,
                'positions'      =>  $job->positions,
                'employementtype'      =>  $job->employementtype,
                'salary'      =>  $job->salary,
                'salarybudget'      =>  $job->salarybudget,
                // 'salaryto'      =>  $ob->salaryto,
                'responsibilities'      =>  $job->responsibilities,
                'posrequirements'      =>  $job->posrequirements,
                'posskills'      =>  $job->posskills,
                'location'   =>   $job->location,
                'jobcategory'   =>   $job->jobcategory,
                'intenting'   =>   unserialize($job->intenting),
                'startdate'   =>   $job->startdate,
                'manager'   =>   $job->manager,
                'pwd'   =>   $job->pwd,
                'rec'=>$Hremails->id,
                 'interviews'   => unserialize( $job->interviews),
                'jobdescription'   =>   $job->jobdescription
                 );
               \Mail::to($Hremails->email)->send(new \App\Mail\employeerequesition($data));
                }      

                $updateinitiatecollumn=DB::table('employeerequisitions')
                                    ->where('id',$job->id)
                                    ->update(['status' => "initiated"]);
                                    Alert::success('Success','Your Requisition has been made successfully');
      }                              return redirect()->route('tabspage');

    }

    /**
     * initiate arequisition
     **/
    public function initiate(EmployeeRequisition $id)
    {
    $job=$id;
// dd($job);
    $usercompany_id = Auth::user()->company_id;
    $user_id = Auth::user()->id;
                   //$head=$headofcompany->
    $company=DB::table('companies')
            ->where('id', $usercompany_id)
            ->first();
            $company_id=$company->id;
         $companybossid=DB::table('employeerequisitionusers')
                       ->where('company_id' , $company_id)
                       ->first();
                  $boos_id =$companybossid->userId;
                     $headofcompany=DB::table('employeerequisitionusers')
                    ->join('users', 'users.id', '=' , 'employeerequisitionusers.userId')
                    ->where('employeerequisitionusers.userId' ,$user_id)
                    ->get();
   
      // dd($job);
          // $whomtosendemail=DB::table('job_approvals')
          //                ->join('users','users.id', '=', 'job_approvals.userId' )
          //                ->where('job_approvals.jobid', $job->id)
          //                ->first();
            // get the role of the authictated
        $user=Auth::user()->id;
        //get the role if any
        $getrole=DB::table('employeerequisitionusers')
                ->where('userId', $user)
                ->first();
        $role=$getrole->employeetype ?? null;   

        // if the initiator is the HR Recruiter
        if ($role=='HR Recruitment Team') {

                        //delete all approvers 
            $delete=DB::table('requsitionsapprovals')
                   ->where('jobid',$job->id)
                   ->where('initiator', '!=', 'initiator')
                   ->delete();

            // get the manager to report to 
            $getmanager=DB::table('employeerequisitions')
                       ->where('id', $job->id)
                       ->first();
                
            $usercompany_id = Auth::user()->company_id;
            $user_id = Auth::user()->id;
            if ($getmanager->manager !== $user_id) {
                 
                //getrole of manager to report
                $getrole=DB::table('employeerequisitionusers')
                ->where('userId', $getmanager->manager)
                ->first();
                $role=$getrole->employeetype ?? null;
                if ($role=="HR Recruitment Team" || $role=="HR Manager"||$role=="Group CEO" ||$role =="Executive Lead") {
                   $company=DB::table('companies')
                      ->where('id', $usercompany_id)
                    ->first();

              $company_id=$company->id;
            $companybossid=DB::table('employeerequisitionusers')
                       ->where('company_id' , $company_id)
                       ->first();
            // $boos_id =$companybossid->userId;
            $headofcompany=DB::table('employeerequisitionusers')
                    ->join('users', 'users.id', '=' , 'employeerequisitionusers.userId')
                    ->where('employeerequisitionusers.userId' ,$user_id)
                    ->get();
            $ldate = date('Y-m-d H:i:s');
                 // dd($ldate);
            // $job = EmployeeRequisition::find($id)->first();   
                         //proceed to send email to the HR 
            $sendmailtohr=DB::table('employeerequisitionusers')
                               ->join('users', 'users.id','=', 'employeerequisitionusers.userId')
                               ->where('employeerequisitionusers.employeetype', 'HR Manager')   
                               ->get();
                               // dd($sendmailtohr);
     

        foreach($sendmailtohr as $usersemails)
            { 
                // dd($usersemails->email);

            $data = array(    
                'user'=>Auth::user()->id, 
                'username'=>Auth::user()->name, 
                'company_id'=> Auth::user()->company_id, 
                'id'=> $job->id,
                'stages'=>$job->stages,
                'stages1'=> [
                                'HR Recruitment Team'=>$job->stages,
                                'HR Manager'=>$job->stage1,'Executive Lead'=>$job->stage2,
                                'Group CEO'=>$job->stage3
                        ],

                'jobtittle'      =>  $job->jobtittle,
                'positions'      =>  $job->positions,
                'employementtype'      =>  $job->employementtype,
                'salary'      =>  $job->salary,
                'salarybudget'      =>  $job->salarybudget,
                // 'salaryto'      =>  $job->salaryto,
                'responsibilities'      =>  $job->responsibilities,
                'posrequirements'      =>  $job->posrequirements,
                'posskills'      =>  $job->posskills,
                'location'   =>   $job->location,
                'jobcategory'   =>   $job->jobcategory,
                'intenting'   =>   unserialize($job->intenting),
                'startdate'   =>   $job->startdate,
                'manager'   =>   $job->manager,
                'pwd'   =>   $job->pwd,
                'interviews'   => unserialize( $job->interviews),
                'rec'=>$usersemails->id,
                'jobdescription'   =>   $job->jobdescription
            );
              \Mail::to($usersemails->email)->send(new \App\Mail\recrutohr($data));
            } 

            $updateinitiatecollumn=DB::table('employeerequisitions')
                                    ->where('id',$job->id)
                                     ->update(['status' => "initiated", 'stages'=> 1, 'stage1'=>0, 'stage2'=>0, 'stage3'=>0, 'action'=>0]);
                                    Alert::success('Success',' Requisition has been made successfully');
                                    return back();
                }
                // get the manager email 
                $emailmanager=DB::table('users')
                             ->where('id', $getmanager->manager)
                             ->first();

                                 $company=DB::table('companies')
                      ->where('id', $usercompany_id)
                    ->first();
              $company_id=$company->id;
            $companybossid=DB::table('employeerequisitionusers')
                       ->where('company_id' , $company_id)
                       ->first();
            $boos_id =$companybossid->userId;
            $headofcompany=DB::table('employeerequisitionusers')
                    ->join('users', 'users.id', '=' , 'employeerequisitionusers.userId')
                    ->where('employeerequisitionusers.userId' ,$user_id)
                    ->get();
            $ldate = date('Y-m-d H:i:s');
           //       // dd($ldate);
           // $storeapprove1=DB::table('requsitionsapprovals')
           //                ->insert([
           //                'jobid' => $job->id,
           //                'userId' => Auth::user()->id,
           //                'initiator' => "initiator",
           //                'company_id'=>$usercompany_id,
           //                'date'=>$ldate,
           //                       ]); 
            // $job = EmployeeRequisition::find($id)->first();     
                 $data = array(    
                'user'=>Auth::user()->id, 
                'username'=>Auth::user()->name, 
                'company_id'=> Auth::user()->company_id, 
                'id'=> $job->id,
                'stages'=>$job->stages,
                'stages1'=> [
                                'HR Recruitment Team'=>$job->stages,
                                'HR Manager'=>$job->stage1,'Executive Lead'=>$job->stage2,
                                'Group CEO'=>$job->stage3
                        ],

                'jobtittle'      =>  $job->jobtittle,
                'positions'      =>  $job->positions,
                'employementtype'      =>  $job->employementtype,
                'salary'      =>  $job->salary,
                'salarybudget'      =>  $job->salarybudget,
                // 'salaryto'      =>  $job->salaryto,
                'responsibilities'      =>  $job->responsibilities,
                'posrequirements'      =>  $job->posrequirements,
                'posskills'      =>  $job->posskills,
                'location'   =>   $job->location,
                'jobcategory'   =>   $job->jobcategory,
                'intenting'   =>   unserialize($job->intenting),
                'startdate'   =>   $job->startdate,
                'manager'   =>   $job->manager,
                'pwd'   =>   $job->pwd,
                'rec'=>$emailmanager->id,
                'interviews'   => unserialize( $job->interviews),
                'jobdescription'   =>   $job->jobdescription
            );
             
             \Mail::to($emailmanager->email)->send(new \App\Mail\recrutohiringmanager($data));
            $updateinitiatecollumn=DB::table('employeerequisitions')
                                    ->where('id',$job->id)
                                    ->update(['status' => "initiated", 'stages' => '1', 'role'=>'HR Team']);
                                    Alert::success('Success',' Requisition has been made successfully');
                                    return back();
             }




            $company=DB::table('companies')
                      ->where('id', $usercompany_id)
                    ->first();
              $company_id=$company->id;
            $companybossid=DB::table('employeerequisitionusers')
                       ->where('company_id' , $company_id)
                       ->first();
            // $boos_id =$companybossid->userId;
            $headofcompany=DB::table('employeerequisitionusers')
                    ->join('users', 'users.id', '=' , 'employeerequisitionusers.userId')
                    ->where('employeerequisitionusers.userId' ,$user_id)
                    ->get();
            $ldate = date('Y-m-d H:i:s');
                 // dd($ldate);
            // $storeapprove1=DB::table('requsitionsapprovals')
            //               ->insert([
            //               'jobid' => $job->id,
            //               'userId' => Auth::user()->id,
            //               'initiator' => "initiator",
            //               'company_id'=>$usercompany_id,
            //               'date'=>$ldate,
            //                      ]);
            // $job = EmployeeRequisition::find($id)->first();     

          
             //proceed to send email to the HR 
            $sendmailtohr=DB::table('employeerequisitionusers')
                               ->join('users', 'users.id','=', 'employeerequisitionusers.userId')
                               ->where('employeerequisitionusers.employeetype', 'HR Manager')   
                               ->get();
                               //dd($sendmailtogroupceo);
            foreach($sendmailtohr as $usersemails)
            { 
                            $data = array(    
                'user'=>Auth::user()->id, 
                'username'=>Auth::user()->name, 
                'company_id'=> Auth::user()->company_id, 
                'id'=> $job->id,
                'stages'=>$job->stages,
                'stages1'=> [
                                'HR Recruitment Team'=>$job->stages,
                                'HR Manager'=>$job->stage1,'Executive Lead'=>$job->stage2,
                                'Group CEO'=>$job->stage3
                        ],

                'jobtittle'      =>  $job->jobtittle,
                'positions'      =>  $job->positions,
                'employementtype'      =>  $job->employementtype,
                'salary'      =>  $job->salary,
                'salarybudget'      =>  $job->salarybudget,
                // 'salaryto'      =>  $job->salaryto,
                'responsibilities'      =>  $job->responsibilities,
                'posrequirements'      =>  $job->posrequirements,
                'posskills'      =>  $job->posskills,
                'location'   =>   $job->location,
                'jobcategory'   =>   $job->jobcategory,
                'intenting'   =>   unserialize($job->intenting),
                'startdate'   =>   $job->startdate,
                'manager'   =>   $job->manager,
                'pwd'   =>   $job->pwd,
                'rec'=>$usersemails->id,
                'interviews'   => unserialize( $job->interviews),
                'jobdescription'   =>   $job->jobdescription
            );
                //dd($usersemails->email);
              \Mail::to($usersemails->email)->send(new \App\Mail\recrutohr($data));
            }      

            $updateinitiatecollumn=DB::table('employeerequisitions')
                                    ->where('id',$job->id)
                                    ->update(['status' => "initiated", 'stages'=> 1, 'stage1'=>0, 'stage2'=>0, 'stage3'=>0, 'action'=>0]);
                                    Alert::success('Success',' Requisition has been made successfully');
                                    return back();

        }          

            if ($role== "HR Manager") {
                           //delete all approvers 
            $delete=DB::table('requsitionsapprovals')
                   ->where('jobid',$job->id)
                   ->where('initiator', '!=', 'initiator')
                   ->delete();
                       //proceed to send email to the HR 
            $sendmailtoexec=DB::table('employeerequisitionusers')
                               ->join('users', 'users.id','=', 'employeerequisitionusers.userId')
                               ->where('employeerequisitionusers.employeetype', 'Executive Lead')   
                               ->get();
                               //dd($sendmailtogroupceo);
            foreach($sendmailtoexec as $usersemails)
            { 
                $data = array(    
                'user'=>Auth::user()->id, 
                'username'=>Auth::user()->name, 
                'company_id'=> Auth::user()->company_id, 
                'id'=> $job->id,
                'jobtittle'      =>  $job->jobtittle,
                'positions'      =>  $job->positions,
                'employementtype'      =>  $job->employementtype,
                'salary'      =>  $job->salary,
                'salarybudget'      =>  $job->salarybudget,
                // 'salaryto'      =>  $job->salaryto,
                'responsibilities'      =>  $job->responsibilities,
                'posrequirements'      =>  $job->posrequirements,
                'posskills'      =>  $job->posskills,
                'location'   =>   $job->location,
                'jobcategory'   =>   $job->jobcategory,
               'intenting'   =>   unserialize($job->intenting),
                'startdate'   =>   $job->startdate,
                'manager'   =>   $job->manager,
                'pwd'   =>   $job->pwd,
                'rec'=>$usersemails->id,
                 'interviews'   => unserialize( $job->interviews),
                'jobdescription'   =>   $job->jobdescription
            );
                //dd($usersemails->email);
              \Mail::to($usersemails->email)->send(new \App\Mail\hrtoexec($data));
            }      

            $updateinitiatecollumn=DB::table('employeerequisitions')
                                    ->where('id',$job->id)
                                    ->update(['status' => "initiated", 'stages'=> 1, 'stage1'=>1, 'stage2'=>0, 'stage3'=>0, 'action'=>0]);
                                    Alert::success('Success','Your Requisition has been made successfully');
                                    return back();  
                  } 
             if ($role =="Executive Lead") {
                           //delete all approvers 
            $delete=DB::table('requsitionsapprovals')
                   ->where('jobid',$job->id)
                   ->where('initiator', '!=', 'initiator')
                   ->delete();
                           //proceed to send email to the HR 
                     //proceed to send email to the group CEO client 
               $sendmailtogroupceo=DB::table('employeerequisitionusers')
                               ->join('users', 'users.id','=', 'employeerequisitionusers.userId')
                               ->where('employeerequisitionusers.employeetype', 'Group CEO')   
                               ->first();
                $data = array(    
                'user'=>Auth::user()->id, 
                'username'=>Auth::user()->name, 
                'company_id'=> Auth::user()->company_id, 
                'id'=> $job->id,
                'jobtittle'      =>  $job->jobtittle,
                'positions'      =>  $job->positions,
                'employementtype'      =>  $job->employementtype,
                'salary'      =>  $job->salary,
                'salarybudget'      =>  $job->salarybudget,
                // 'salaryto'      =>  $job->salaryto,
                'responsibilities'      =>  $job->responsibilities,
                'posrequirements'      =>  $job->posrequirements,
                'posskills'      =>  $job->posskills,
                'location'   =>   $job->location,
                'jobcategory'   =>   $job->jobcategory,
               'intenting'   =>   unserialize($job->intenting),
                'startdate'   =>   $job->startdate,
                'manager'   =>   $job->manager,
                'pwd'   =>   $job->pwd,
                'rec'=>$sendmailtogroupceo->id,
                 'interviews'   => unserialize( $job->interviews),
                'jobdescription'   =>   $job->jobdescription
            );
                               //dd($sendmailtogroupceo);    
        \Mail::to($sendmailtogroupceo->email)->send(new \App\Mail\exectoceo($data));      

        $updateinitiatecollumn=DB::table('employeerequisitions')
                                    ->where('id',$job->id)
                                    ->update(['status' => "initiated", 'stages'=> 1, 'stage1'=>1, 'stage2'=>1, 'stage3'=>0, 'action'=>0]);
                                    Alert::success('Success','Your Requisition has been made successfully');
                                    return back();
                       }  
              if ($role =="Group CEO") {
                           //delete all approvers 
            $delete=DB::table('requsitionsapprovals')
                   ->where('jobid',$job->id)
                   ->where('initiator', '!=', 'initiator')
                   ->delete();
                                  //proceed to send email to the HR 
                     //proceed to send email to the group CEO client 
        $sendemailtohr=DB::table('employeerequisitionusers')
                               ->join('users', 'users.id','=', 'employeerequisitionusers.userId')
                               ->where('employeerequisitionusers.employeetype', 'HR Manager')   
                               ->first();
                               //dd($sendmailtogroupceo); 
            $sendmailtogroupceo=DB::table('employeerequisitionusers')
                               ->join('users', 'users.id','=', 'employeerequisitionusers.userId')
                               ->where('employeerequisitionusers.employeetype', 'Group CEO')   
                               ->first();
                $data = array(    
                'user'=>Auth::user()->id, 
                'username'=>Auth::user()->name, 
                'company_id'=> Auth::user()->company_id, 
                'id'=> $job->id,
                'jobtittle'      =>  $job->jobtittle,
                'positions'      =>  $job->positions,
                'employementtype'      =>  $job->employementtype,
                'salary'      =>  $job->salary,
                'salarybudget'      =>  $job->salarybudget,
                // 'salaryto'      =>  $job->salaryto,
                'responsibilities'      =>  $job->responsibilities,
                'posrequirements'      =>  $job->posrequirements,
                'posskills'      =>  $job->posskills,
                'location'   =>   $job->location,
                'jobcategory'   =>   $job->jobcategory,
               'intenting'   =>   unserialize($job->intenting),
                'startdate'   =>   $job->startdate,
                'manager'   =>   $job->manager,
                'pwd'   =>   $job->pwd,
                'rec'=>$sendmailtogroupceo->id,
                 'interviews'   => unserialize( $job->interviews),
                'jobdescription'   =>   $job->jobdescription
            );   
        \Mail::to($sendemailtohr->email)->send(new \App\Mail\ceotohr($data));      

        $updateinitiatecollumn=DB::table('employeerequisitions')
                                    ->where('id',$job->id)
                                    ->update(['status' => "initiated"]);
                                    Alert::success('Success','Your Requisition has been made successfully');
                                    return back();
                               }   

                  else{
                               //delete all approvers 
            $delete=DB::table('requsitionsapprovals')
                   ->where('jobid',$job->id)
                   ->where('initiator', '!=', 'initiator')
                   ->delete();

                     $whomtosendemail=DB::table('employeerequisitionusers')
                           ->join('users','users.id', '=', 'employeerequisitionusers.userId' )
                           ->where('employeerequisitionusers.employeetype', 'HR Recruitment Team')
                           ->get();

              foreach($whomtosendemail as $recemails){
                $data = array(    
                'user'=>Auth::user()->id, 
                'username'=>Auth::user()->name, 
                'company_id'=> Auth::user()->company_id, 
                'id'=> $job->id,
                'jobtittle'      =>  $job->jobtittle,
                'positions'      =>  $job->positions,
                'employementtype'      =>  $job->employementtype,
                'salary'      =>  $job->salary,
                'salarybudget'      =>  $job->salarybudget,
                // 'salaryto'      =>  $job->salaryto,
                'responsibilities'      =>  $job->responsibilities,
                'posrequirements'      =>  $job->posrequirements,
                'posskills'      =>  $job->posskills,
                'location'   =>   $job->location,
                'jobcategory'   =>   $job->jobcategory,
               'intenting'   =>   unserialize($job->intenting),
                'startdate'   =>   $job->startdate,
                'manager'   =>   $job->manager,
                'pwd'   =>   $job->pwd,
                'rec'=>$recemails->id,
                 'interviews'   => unserialize( $job->interviews),
                'jobdescription'   =>   $job->jobdescription
            );   
                  \Mail::to($recemails->email)->send(new \App\Mail\employeerequesition($data));
              }
              
  


              $updateinitiatecollumn=DB::table('employeerequisitions')
                                    ->where('id',$id["id"])
                                   ->update(['status' => "initiated", 'stages'=> 1, 'stage1'=>1, 'stage2'=>1, 'stage3'=>1, 'action'=>0]);
                                    Alert::success('Success','Your Requisition has been made successfully');
                                    return back();
                  }


          
                                     
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EmployeeRequisition  $employeeRequisition
     * @return \Illuminate\Http\Response
     */
    public function show($employeeRequisition)
    {
        $employeeRequisition=EmployeeRequisition::find($employeeRequisition);
         return view('employeerequisitions.show', compact('employeeRequisition'));
    }
    /** show approvers
     * */
        public function viewapprovers($employeeRequisition)
    {
        $employeeRequisition=EmployeeRequisition::find($employeeRequisition);
         return view('employeerequisitions.viewapprovers', compact('employeeRequisition'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EmployeeRequisition  $employeeRequisition
     * @return \Illuminate\Http\Response
     */
    public function edit($employeeRequisition)
    {
       $employeeRequisition = EmployeeRequisition::find($employeeRequisition);
         return view('employeerequisitions.edit',compact('employeeRequisition'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EmployeeRequisition  $employeeRequisition
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$employeeRequisition)
    {

 
    $employeeRequisition = EmployeeRequisition::find($employeeRequisition); 
    
      // $request->validate([
      //       'jobtittle' => 'required|string',
      //       'jobdescription' => 'required',
      //       'positions' => 'required|numeric',
      //       'location'=>'required',
      //       'jobcategory'=>'required',
      //       'intenting.*'=>'required',
      //       'startdate'=>'required',
      //       'manager'=>'required',
      //       'pwd'=>'required',
      //       'interviews.*'=>'required',
      //       'employementtype' => 'required|string',
      //       'posrequirements' => 'required',
      //       'salary' => 'required|numeric',
      //        'salaryto' => 'required|numeric',
      //       'responsibilities' => 'required',
      //   ]);

      //   $employeeRequisition->update($request->all());
      //   Alert::success('Success','Your Requisition changes has been saved successfully');
      //    return redirect()->route('employeerequisitions.index');

            $validated = $request->validate([
            'jobdescription' => 'required',
            'positions' => 'required|numeric',
            'location'=>'required',
            'jobcategory'=>'required',
            'startdate'=>'required',
            'intenting.*'=>'required',
            'manager'=>'required',
            'pwd'=>'required',
             'salarybudget'=>'required',
            'interviews.*'=>'required',
            'employementtype' => 'required|string',
            'posrequirements' => 'required',
            'salary' => 'required|not_in:0|numeric',
            // 'salaryto' => 'required|not_in:0|numeric',
            'responsibilities' => 'required',
           

            ]);
              $user=Auth::user()->id;
            $validated['intenting'] = serialize($validated['intenting']);
             $validated['interviews'] = serialize($validated['interviews']);
            $jobtitle = $request->jobtittle_input ? $request->jobtittle_input : $request->jobtittle;
            $employeeRequisition->update(array_merge($validated, ['posskills' => $user], ['jobtittle' => $jobtitle]));
            // dd($employeeRequisition);


            $job=$employeeRequisition;
            // dd($job);
// dd($job);
    $usercompany_id = Auth::user()->company_id;
    $user_id = Auth::user()->id;
                   //$head=$headofcompany->
    $company=DB::table('companies')
            ->where('id', $usercompany_id)
            ->first();
            $company_id=$company->id;
         $companybossid=DB::table('employeerequisitionusers')
                       ->where('company_id' , $company_id)
                       ->first();
                  $boos_id =$companybossid->userId;
                     $headofcompany=DB::table('employeerequisitionusers')
                    ->join('users', 'users.id', '=' , 'employeerequisitionusers.userId')
                    ->where('employeerequisitionusers.userId' ,$user_id)
                    ->get();
   
      // dd($job);
          // $whomtosendemail=DB::table('job_approvals')
          //                ->join('users','users.id', '=', 'job_approvals.userId' )
          //                ->where('job_approvals.jobid', $job->id)
          //                ->first();
            // get the role of the authictated
        $user=Auth::user()->id;
        //get the role if any
        $getrole=DB::table('employeerequisitionusers')
                ->where('userId', $user)
                ->first();
        $role=$getrole->employeetype ?? null;   

        // if the initiator is the HR Recruiter
        if ($role=='HR Recruitment Team') {

                        //delete all approvers 
            $delete=DB::table('requsitionsapprovals')
                   ->where('jobid',$job->id)
                   ->where('initiator', '!=', 'initiator')
                   ->delete();

            // get the manager to report to 
            $getmanager=DB::table('employeerequisitions')
                       ->where('id', $job->id)
                       ->first();
                
            $usercompany_id = Auth::user()->company_id;
            $user_id = Auth::user()->id;
            if ($getmanager->manager !== $user_id) {
                 
                //getrole of manager to report
                $getrole=DB::table('employeerequisitionusers')
                ->where('userId', $getmanager->manager)
                ->first();
                $role=$getrole->employeetype ?? null;
                if ($role=="HR Recruitment Team" || $role=="HR Manager"||$role=="Group CEO" ||$role =="Executive Lead") {
                   $company=DB::table('companies')
                      ->where('id', $usercompany_id)
                    ->first();

              $company_id=$company->id;
            $companybossid=DB::table('employeerequisitionusers')
                       ->where('company_id' , $company_id)
                       ->first();
            // $boos_id =$companybossid->userId;
            $headofcompany=DB::table('employeerequisitionusers')
                    ->join('users', 'users.id', '=' , 'employeerequisitionusers.userId')
                    ->where('employeerequisitionusers.userId' ,$user_id)
                    ->get();
            $ldate = date('Y-m-d H:i:s');
                 // dd($ldate);
            // $job = EmployeeRequisition::find($id)->first();   
                         //proceed to send email to the HR 
            $sendmailtohr=DB::table('employeerequisitionusers')
                               ->join('users', 'users.id','=', 'employeerequisitionusers.userId')
                               ->where('employeerequisitionusers.employeetype', 'HR Manager')   
                               ->get();
                               // dd($sendmailtohr);
     

        foreach($sendmailtohr as $usersemails)
            { 
                // dd($usersemails->email);

            $data = array(    
                'user'=>Auth::user()->id, 
                'username'=>Auth::user()->name, 
                'company_id'=> Auth::user()->company_id, 
                'id'=> $job->id,
                'stages'=>$job->stages,
                'stages1'=> [
                                'HR Recruitment Team'=>$job->stages,
                                'HR Manager'=>$job->stage1,'Executive Lead'=>$job->stage2,
                                'Group CEO'=>$job->stage3
                        ],

                'jobtittle'      =>  $job->jobtittle,
                'positions'      =>  $job->positions,
                'employementtype'      =>  $job->employementtype,
                'salary'      =>  $job->salary,
                'salarybudget'      =>  $job->salarybudget,
                // 'salaryto'      =>  $job->salaryto,
                'responsibilities'      =>  $job->responsibilities,
                'posrequirements'      =>  $job->posrequirements,
                'posskills'      =>  $job->posskills,
                'location'   =>   $job->location,
                'jobcategory'   =>   $job->jobcategory,
                'intenting'   =>   unserialize($job->intenting),
                'startdate'   =>   $job->startdate,
                'manager'   =>   $job->manager,
                'pwd'   =>   $job->pwd,
                'interviews'   => unserialize( $job->interviews),
                'rec'=>$usersemails->id,
                'jobdescription'   =>   $job->jobdescription
            );
              \Mail::to($usersemails->email)->send(new \App\Mail\recrutohr($data));
            } 

            $updateinitiatecollumn=DB::table('employeerequisitions')
                                    ->where('id',$job->id)
                                     ->update(['status' => "initiated", 'stages'=> 1, 'stage1'=>0, 'stage2'=>0, 'stage3'=>0, 'action'=>0]);
                                    Alert::success('Success',' Requisition has been made successfully');
                                   return redirect()->route('tabspage');
                }
                // get the manager email 
                $emailmanager=DB::table('users')
                             ->where('id', $getmanager->manager)
                             ->first();

                                 $company=DB::table('companies')
                      ->where('id', $usercompany_id)
                    ->first();
              $company_id=$company->id;
            $companybossid=DB::table('employeerequisitionusers')
                       ->where('company_id' , $company_id)
                       ->first();
            $boos_id =$companybossid->userId;
            $headofcompany=DB::table('employeerequisitionusers')
                    ->join('users', 'users.id', '=' , 'employeerequisitionusers.userId')
                    ->where('employeerequisitionusers.userId' ,$user_id)
                    ->get();
            $ldate = date('Y-m-d H:i:s');
           //       // dd($ldate);
           // $storeapprove1=DB::table('requsitionsapprovals')
           //                ->insert([
           //                'jobid' => $job->id,
           //                'userId' => Auth::user()->id,
           //                'initiator' => "initiator",
           //                'company_id'=>$usercompany_id,
           //                'date'=>$ldate,
           //                       ]); 
            // $job = EmployeeRequisition::find($id)->first();     
                 $data = array(    
                'user'=>Auth::user()->id, 
                'username'=>Auth::user()->name, 
                'company_id'=> Auth::user()->company_id, 
                'id'=> $job->id,
                'stages'=>$job->stages,
                'stages1'=> [
                                'HR Recruitment Team'=>$job->stages,
                                'HR Manager'=>$job->stage1,'Executive Lead'=>$job->stage2,
                                'Group CEO'=>$job->stage3
                        ],

                'jobtittle'      =>  $job->jobtittle,
                'positions'      =>  $job->positions,
                'employementtype'      =>  $job->employementtype,
                'salary'      =>  $job->salary,
                'salarybudget'      =>  $job->salarybudget,
                // 'salaryto'      =>  $job->salaryto,
                'responsibilities'      =>  $job->responsibilities,
                'posrequirements'      =>  $job->posrequirements,
                'posskills'      =>  $job->posskills,
                'location'   =>   $job->location,
                'jobcategory'   =>   $job->jobcategory,
                'intenting'   =>   unserialize($job->intenting),
                'startdate'   =>   $job->startdate,
                'manager'   =>   $job->manager,
                'pwd'   =>   $job->pwd,
                'rec'=>$emailmanager->id,
                'interviews'   => unserialize( $job->interviews),
                'jobdescription'   =>   $job->jobdescription
            );
             
             \Mail::to($emailmanager->email)->send(new \App\Mail\recrutohiringmanager($data));
            $updateinitiatecollumn=DB::table('employeerequisitions')
                                    ->where('id',$job->id)
                                    ->update(['status' => "initiated", 'stages' => '1', 'role'=>'HR Team']);
                                    Alert::success('Success',' Requisition has been made successfully');
                                 return redirect()->route('tabspage');
             }




            $company=DB::table('companies')
                      ->where('id', $usercompany_id)
                    ->first();
              $company_id=$company->id;
            $companybossid=DB::table('employeerequisitionusers')
                       ->where('company_id' , $company_id)
                       ->first();
            // $boos_id =$companybossid->userId;
            $headofcompany=DB::table('employeerequisitionusers')
                    ->join('users', 'users.id', '=' , 'employeerequisitionusers.userId')
                    ->where('employeerequisitionusers.userId' ,$user_id)
                    ->get();
            $ldate = date('Y-m-d H:i:s');
                 // dd($ldate);
            // $storeapprove1=DB::table('requsitionsapprovals')
            //               ->insert([
            //               'jobid' => $job->id,
            //               'userId' => Auth::user()->id,
            //               'initiator' => "initiator",
            //               'company_id'=>$usercompany_id,
            //               'date'=>$ldate,
            //                      ]);
            // $job = EmployeeRequisition::find($id)->first();     

          
             //proceed to send email to the HR 
            $sendmailtohr=DB::table('employeerequisitionusers')
                               ->join('users', 'users.id','=', 'employeerequisitionusers.userId')
                               ->where('employeerequisitionusers.employeetype', 'HR Manager')   
                               ->get();
                               //dd($sendmailtogroupceo);
            foreach($sendmailtohr as $usersemails)
            { 
                            $data = array(    
                'user'=>Auth::user()->id, 
                'username'=>Auth::user()->name, 
                'company_id'=> Auth::user()->company_id, 
                'id'=> $job->id,
                'stages'=>$job->stages,
                'stages1'=> [
                                'HR Recruitment Team'=>$job->stages,
                                'HR Manager'=>$job->stage1,'Executive Lead'=>$job->stage2,
                                'Group CEO'=>$job->stage3
                        ],

                'jobtittle'      =>  $job->jobtittle,
                'positions'      =>  $job->positions,
                'employementtype'      =>  $job->employementtype,
                'salary'      =>  $job->salary,
                'salarybudget'      =>  $job->salarybudget,
                // 'salaryto'      =>  $job->salaryto,
                'responsibilities'      =>  $job->responsibilities,
                'posrequirements'      =>  $job->posrequirements,
                'posskills'      =>  $job->posskills,
                'location'   =>   $job->location,
                'jobcategory'   =>   $job->jobcategory,
                'intenting'   =>   unserialize($job->intenting),
                'startdate'   =>   $job->startdate,
                'manager'   =>   $job->manager,
                'pwd'   =>   $job->pwd,
                'rec'=>$usersemails->id,
                'interviews'   => unserialize( $job->interviews),
                'jobdescription'   =>   $job->jobdescription
            );
                //dd($usersemails->email);
              \Mail::to($usersemails->email)->send(new \App\Mail\recrutohr($data));
            }      

            $updateinitiatecollumn=DB::table('employeerequisitions')
                                    ->where('id',$job->id)
                                    ->update(['status' => "initiated", 'stages'=> 1, 'stage1'=>0, 'stage2'=>0, 'stage3'=>0, 'action'=>0]);
                                    Alert::success('Success',' Requisition has been made successfully');
                                   return redirect()->route('tabspage');

        }          

            if ($role== "HR Manager") {
                           //delete all approvers 
            $delete=DB::table('requsitionsapprovals')
                   ->where('jobid',$job->id)
                   ->where('initiator', '!=', 'initiator')
                   ->delete();
                       //proceed to send email to the HR 
            $sendmailtoexec=DB::table('employeerequisitionusers')
                               ->join('users', 'users.id','=', 'employeerequisitionusers.userId')
                               ->where('employeerequisitionusers.employeetype', 'Executive Lead')   
                               ->get();
                               //dd($sendmailtogroupceo);
            foreach($sendmailtoexec as $usersemails)
            { 
                $data = array(    
                'user'=>Auth::user()->id, 
                'username'=>Auth::user()->name, 
                'company_id'=> Auth::user()->company_id, 
                'id'=> $job->id,
                'jobtittle'      =>  $job->jobtittle,
                'positions'      =>  $job->positions,
                'employementtype'      =>  $job->employementtype,
                'salary'      =>  $job->salary,
                'salarybudget'      =>  $job->salarybudget,
                // 'salaryto'      =>  $job->salaryto,
                'responsibilities'      =>  $job->responsibilities,
                'posrequirements'      =>  $job->posrequirements,
                'posskills'      =>  $job->posskills,
                'location'   =>   $job->location,
                'jobcategory'   =>   $job->jobcategory,
               'intenting'   =>   unserialize($job->intenting),
                'startdate'   =>   $job->startdate,
                'manager'   =>   $job->manager,
                'pwd'   =>   $job->pwd,
                'rec'=>$usersemails->id,
                 'interviews'   => unserialize( $job->interviews),
                'jobdescription'   =>   $job->jobdescription
            );
                //dd($usersemails->email);
              \Mail::to($usersemails->email)->send(new \App\Mail\hrtoexec($data));
            }      

            $updateinitiatecollumn=DB::table('employeerequisitions')
                                    ->where('id',$job->id)
                                    ->update(['status' => "initiated", 'stages'=> 1, 'stage1'=>1, 'stage2'=>0, 'stage3'=>0, 'action'=>0]);
                                    Alert::success('Success','Your Requisition has been made successfully');
                                    return redirect()->route('tabspage'); 
                  } 
             if ($role =="Executive Lead") {
                           //delete all approvers 
            $delete=DB::table('requsitionsapprovals')
                   ->where('jobid',$job->id)
                   ->where('initiator', '!=', 'initiator')
                   ->delete();
                           //proceed to send email to the HR 
                     //proceed to send email to the group CEO client 
               $sendmailtogroupceo=DB::table('employeerequisitionusers')
                               ->join('users', 'users.id','=', 'employeerequisitionusers.userId')
                               ->where('employeerequisitionusers.employeetype', 'Group CEO')   
                               ->first();
                $data = array(    
                'user'=>Auth::user()->id, 
                'username'=>Auth::user()->name, 
                'company_id'=> Auth::user()->company_id, 
                'id'=> $job->id,
                'jobtittle'      =>  $job->jobtittle,
                'positions'      =>  $job->positions,
                'employementtype'      =>  $job->employementtype,
                'salary'      =>  $job->salary,
                'salarybudget'      =>  $job->salarybudget,
                // 'salaryto'      =>  $job->salaryto,
                'responsibilities'      =>  $job->responsibilities,
                'posrequirements'      =>  $job->posrequirements,
                'posskills'      =>  $job->posskills,
                'location'   =>   $job->location,
                'jobcategory'   =>   $job->jobcategory,
               'intenting'   =>   unserialize($job->intenting),
                'startdate'   =>   $job->startdate,
                'manager'   =>   $job->manager,
                'pwd'   =>   $job->pwd,
                'rec'=>$sendmailtogroupceo->id,
                 'interviews'   => unserialize( $job->interviews),
                'jobdescription'   =>   $job->jobdescription
            );
                               //dd($sendmailtogroupceo);    
        \Mail::to($sendmailtogroupceo->email)->send(new \App\Mail\exectoceo($data));      

        $updateinitiatecollumn=DB::table('employeerequisitions')
                                    ->where('id',$job->id)
                                    ->update(['status' => "initiated", 'stages'=> 1, 'stage1'=>1, 'stage2'=>1, 'stage3'=>0, 'action'=>0]);
                                    Alert::success('Success','Your Requisition has been made successfully');
                                    return redirect()->route('tabspage');
                       }  
              if ($role =="Group CEO") {
                           //delete all approvers 
            $delete=DB::table('requsitionsapprovals')
                   ->where('jobid',$job->id)
                   ->where('initiator', '!=', 'initiator')
                   ->delete();
                                  //proceed to send email to the HR 
                     //proceed to send email to the group CEO client 
        $sendemailtohr=DB::table('employeerequisitionusers')
                               ->join('users', 'users.id','=', 'employeerequisitionusers.userId')
                               ->where('employeerequisitionusers.employeetype', 'HR Manager')   
                               ->first();
                               //dd($sendmailtogroupceo); 
            $sendmailtogroupceo=DB::table('employeerequisitionusers')
                               ->join('users', 'users.id','=', 'employeerequisitionusers.userId')
                               ->where('employeerequisitionusers.employeetype', 'Group CEO')   
                               ->first();
                $data = array(    
                'user'=>Auth::user()->id, 
                'username'=>Auth::user()->name, 
                'company_id'=> Auth::user()->company_id, 
                'id'=> $job->id,
                'jobtittle'      =>  $job->jobtittle,
                'positions'      =>  $job->positions,
                'employementtype'      =>  $job->employementtype,
                'salary'      =>  $job->salary,
                'salarybudget'      =>  $job->salarybudget,
                // 'salaryto'      =>  $job->salaryto,
                'responsibilities'      =>  $job->responsibilities,
                'posrequirements'      =>  $job->posrequirements,
                'posskills'      =>  $job->posskills,
                'location'   =>   $job->location,
                'jobcategory'   =>   $job->jobcategory,
               'intenting'   =>   unserialize($job->intenting),
                'startdate'   =>   $job->startdate,
                'manager'   =>   $job->manager,
                'pwd'   =>   $job->pwd,
                'rec'=>$sendmailtogroupceo->id,
                 'interviews'   => unserialize( $job->interviews),
                'jobdescription'   =>   $job->jobdescription
            );   
        \Mail::to($sendemailtohr->email)->send(new \App\Mail\ceotohr($data));      

        $updateinitiatecollumn=DB::table('employeerequisitions')
                                    ->where('id',$job->id)
                                    ->update(['status' => "initiated"]);
                                    Alert::success('Success','Your Requisition has been made successfully');
                                 return redirect()->route('tabspage');
                               }   

                  else{
                               //delete all approvers 
            $delete=DB::table('requsitionsapprovals')
                   ->where('jobid',$job->id)
                   ->where('initiator', '!=', 'initiator')
                   ->delete();

                     $whomtosendemail=DB::table('employeerequisitionusers')
                           ->join('users','users.id', '=', 'employeerequisitionusers.userId' )
                           ->where('employeerequisitionusers.employeetype', 'HR Recruitment Team')
                           ->get();

              foreach($whomtosendemail as $recemails){
                $data = array(    
                'user'=>Auth::user()->id, 
                'username'=>Auth::user()->name, 
                'company_id'=> Auth::user()->company_id, 
                'id'=> $job->id,
                'jobtittle'      =>  $job->jobtittle,
                'positions'      =>  $job->positions,
                'employementtype'      =>  $job->employementtype,
                'salary'      =>  $job->salary,
                'salarybudget'      =>  $job->salarybudget,
                // 'salaryto'      =>  $job->salaryto,
                'responsibilities'      =>  $job->responsibilities,
                'posrequirements'      =>  $job->posrequirements,
                'posskills'      =>  $job->posskills,
                'location'   =>   $job->location,
                'jobcategory'   =>   $job->jobcategory,
               'intenting'   =>   unserialize($job->intenting),
                'startdate'   =>   $job->startdate,
                'manager'   =>   $job->manager,
                'pwd'   =>   $job->pwd,
                'rec'=>$recemails->id,
                 'interviews'   => unserialize( $job->interviews),
                'jobdescription'   =>   $job->jobdescription
            );   
                  \Mail::to($recemails->email)->send(new \App\Mail\employeerequesition($data));
              }
              
  


              $updateinitiatecollumn=DB::table('employeerequisitions')
                                    ->where('id',$job->id)
                                   ->update(['status' => "initiated", 'stages'=> 0, 'stage1'=>0, 'stage2'=>0, 'stage3'=>0, 'action'=>0]);
                                    Alert::success('Success','Your Requisition has been made successfully');
                                   return redirect()->route('tabspage');
                  }


                    Alert::success('Success','Your Requisition changes has been saved successfully');
return redirect()->route('tabspage');
    }


/**
 * storing comments after click button from executive lead
 * 
 * */
    public function commentsapprovalstore(Request $request)
    {
            $jobid=$request->jobid;
              $job=EmployeeRequisition::find($jobid);  
        $user=Auth::user()->id;
        $getrole=DB::table('employeerequisitionusers')
                ->where('userId', $user)
                ->first();
    $role=$getrole->employeetype ?? null;
        
        $checkaction=DB::table('employeerequisitions')
            ->where('id', $request->jobid)
            ->first();
    if ($job->role =='HR Team' && $role =='') {
         if ($checkaction->action ==1||$checkaction->action ==2||$checkaction->action ==3||$checkaction->action ==4||$checkaction->action ==5 ) {
                          Alert::success('Success',' Requisition  Action has already occured!!');
                   return redirect()->route('tabspage');
            }
              $request->validate([
            'comment'=>'required',
        ]);
     
        $user_id = Auth::user()->id;
         $senderemail = JobApproval::create($request->all());
         $insertcommentby=DB::table('job_approvals')
                        ->where('jobid', $request->jobid)
                        ->update(['commentby' => $user_id]);

    $usercompany_id = Auth::user()->company_id;
    $user_id = Auth::user()->id;
    $company=DB::table('companies')
            ->where('id', $usercompany_id)
            ->first();
            $company_id=$company->id;
         $companybossid=DB::table('employeerequisitionusers')
                       ->where('company_id' , $company_id)
                       ->first();
                  $boos_id =$companybossid->userId;
  
            $data = array(    
                'user'=>Auth::user()->id, 
                'username'=>Auth::user()->name, 
                'company_id'=> Auth::user()->company_id, 
                'id'=> $job->id,
                'comment'=>$request->comment,
                'stages'=> [
                'HR Recruitment Team'=>$job->stages,
                'HR Manager'=>$job->stage1,'Executive Lead'=>$job->stage2,
                 'Group CEO'=>$job->stage3
                        ],
                'jobtittle'      =>  $job->jobtittle,
                'positions'      =>  $job->positions,
                'employementtype'      =>  $job->employementtype,
                'salary'      =>  $job->salary,
                'salarybudget'      =>  $job->salarybudget,
                // 'salaryto'      =>  $job->salaryto,
                'responsibilities'      =>  $job->responsibilities,
                'posrequirements'      =>  $job->posrequirements,
                'posskills'      =>  $job->posskills,
                'location'   =>   $job->location,
                'jobcategory'   =>   $job->jobcategory,
                'intenting'   =>   unserialize($job->intenting),
                'startdate'   =>   $job->startdate,
                'manager'   =>   $job->manager,
                'pwd'   =>   $job->pwd,
                 'interviews'   => unserialize( $job->interviews),
                'jobdescription'   =>   $job->jobdescription
            );
               

        $towhomtosendemail=DB::table('requsitionsapprovals')
                         ->join('users', 'users.id', '=', 'requsitionsapprovals.userId')
                         // ->join('job_approvals', 'job_approvals.userId', '=', 'users.id')
                         ->where('requsitionsapprovals.jobid', $request->jobid)
                         ->get();


        foreach($towhomtosendemail as $usersemails)
             { 
           
        \Mail::to($usersemails->email)->send(new \App\Mail\returnforcorrectionshiringmanagertorec($data));
             
            }

                   $updateinitiatecollumn=DB::table('employeerequisitions')
                                    ->where('id',$request->jobid)
                                    ->update(['status' => "",'action'=>'1', 'stages'=>1, 'stage1'=>0, 'stage2'=>0, 'stage3'=>0]);

                                    // ->update(['status' => "",'action'=>'4']);
             Alert::success('Success','Your comments have been send successfully'); 
             return back();
    }
    if ($job->role =='HR Team' && $role =='') {
        dd('here ');
    }
     if ($job->role =='HR Team' && $role =='HR Manager') {
         if ($checkaction->action ==2||$checkaction->action ==3||$checkaction->action ==4||$checkaction->action ==5 ) {
                          Alert::success('Success',' Requisition  Action has already occured!!');
                         return redirect()->route('tabspage');
            }
              $request->validate([
            'comment'=>'required',
        ]);
     
        $user_id = Auth::user()->id;
         $senderemail = JobApproval::create($request->all());
         $insertcommentby=DB::table('job_approvals')
                        ->where('jobid', $request->jobid)
                        ->update(['commentby' => $user_id]);

    $usercompany_id = Auth::user()->company_id;
    $user_id = Auth::user()->id;
    $company=DB::table('companies')
            ->where('id', $usercompany_id)
            ->first();
            $company_id=$company->id;
         $companybossid=DB::table('employeerequisitionusers')
                       ->where('company_id' , $company_id)
                       ->first();
                  $boos_id =$companybossid->userId;
  
            $data = array(    
                'user'=>Auth::user()->id, 
                'username'=>Auth::user()->name, 
                'company_id'=> Auth::user()->company_id, 
                'id'=> $job->id,
                'comment'=>$request->comment,
                'stages'=> [
                'HR Recruitment Team'=>$job->stages,
                'HR Manager'=>$job->stage1,'Executive Lead'=>$job->stage2,
                 'Group CEO'=>$job->stage3
                        ],
                'jobtittle'      =>  $job->jobtittle,
                'positions'      =>  $job->positions,
                'employementtype'      =>  $job->employementtype,
                'salary'      =>  $job->salary,
                'salarybudget'      =>  $job->salarybudget,
                // 'salaryto'      =>  $job->salaryto,
                'responsibilities'      =>  $job->responsibilities,
                'posrequirements'      =>  $job->posrequirements,
                'posskills'      =>  $job->posskills,
                'location'   =>   $job->location,
                'jobcategory'   =>   $job->jobcategory,
                'intenting'   =>   unserialize($job->intenting),
                'startdate'   =>   $job->startdate,
                'manager'   =>   $job->manager,
                'pwd'   =>   $job->pwd,
                 'interviews'   => unserialize( $job->interviews),
                'jobdescription'   =>   $job->jobdescription
            );
               

        $towhomtosendemail=DB::table('requsitionsapprovals')
                         ->join('users', 'users.id', '=', 'requsitionsapprovals.userId')
                         // ->join('job_approvals', 'job_approvals.userId', '=', 'users.id')
                         ->where('requsitionsapprovals.jobid', $request->jobid)
                         ->get();


        foreach($towhomtosendemail as $usersemails)
             { 
                            $data = array(    
                'user'=>Auth::user()->id, 
                'username'=>Auth::user()->name, 
                'company_id'=> Auth::user()->company_id, 
                'id'=> $job->id,
                'comment'=>$request->comment,
                'stages'=> [
                'HR Recruitment Team'=>$job->stages,
                'HR Manager'=>$job->stage1,'Executive Lead'=>$job->stage2,
                 'Group CEO'=>$job->stage3
                        ],
                'jobtittle'      =>  $job->jobtittle,
                'positions'      =>  $job->positions,
                'employementtype'      =>  $job->employementtype,
                'salary'      =>  $job->salary,
                'salarybudget'      =>  $job->salarybudget,
                // 'salaryto'      =>  $job->salaryto,
                'responsibilities'      =>  $job->responsibilities,
                'posrequirements'      =>  $job->posrequirements,
                'posskills'      =>  $job->posskills,
                'location'   =>   $job->location,
                'jobcategory'   =>   $job->jobcategory,
                'intenting'   =>   unserialize($job->intenting),
                'startdate'   =>   $job->startdate,
                'manager'   =>   $job->manager,
                'pwd'   =>   $job->pwd,
                'rec'=>$usersemails->id,
                 'interviews'   => unserialize( $job->interviews),
                'jobdescription'   =>   $job->jobdescription
            );
               
           
        \Mail::to($usersemails->email)->send(new \App\Mail\returnforcorrectionhiringmanager($data));
             
            }

                   $updateinitiatecollumn=DB::table('employeerequisitions')
                                    ->where('id',$request->jobid)
                                    ->update(['status' => "",'action'=>'2', 'stages'=>1, 'stage1'=>0, 'stage2'=>0, 'stage3'=>0]);
             Alert::success('Success','Your comments have been send successfully'); 
             return redirect()->route('tabspage');
    }
     if ($job->role =='HR Team' && $role =='Executive Lead') {
         if ($checkaction->action ==3||$checkaction->action ==4||$checkaction->action ==5 ) {
                          Alert::success('Success',' Requisition  Action has already occured!!');
return redirect()->route('tabspage');
            }
              $request->validate([
            'comment'=>'required',
        ]);
     
        $user_id = Auth::user()->id;
         $senderemail = JobApproval::create($request->all());
         $insertcommentby=DB::table('job_approvals')
                        ->where('jobid', $request->jobid)
                        ->update(['commentby' => $user_id]);

    $usercompany_id = Auth::user()->company_id;
    $user_id = Auth::user()->id;
    $company=DB::table('companies')
            ->where('id', $usercompany_id)
            ->first();
            $company_id=$company->id;
         $companybossid=DB::table('employeerequisitionusers')
                       ->where('company_id' , $company_id)
                       ->first();
                  $boos_id =$companybossid->userId;
  
            $data = array(    
                'user'=>Auth::user()->id, 
                'username'=>Auth::user()->name, 
                'company_id'=> Auth::user()->company_id, 
                'id'=> $job->id,
                'comment'=>$request->comment,
                'stages'=> [
                'HR Recruitment Team'=>$job->stages,
                'HR Manager'=>$job->stage1,'Executive Lead'=>$job->stage2,
                 'Group CEO'=>$job->stage3
                        ],
                'jobtittle'      =>  $job->jobtittle,
                'positions'      =>  $job->positions,
                'employementtype'      =>  $job->employementtype,
                'salary'      =>  $job->salary,
                'salarybudget'      =>  $job->salarybudget,
                // 'salaryto'      =>  $job->salaryto,
                'responsibilities'      =>  $job->responsibilities,
                'posrequirements'      =>  $job->posrequirements,
                'posskills'      =>  $job->posskills,
                'location'   =>   $job->location,
                'jobcategory'   =>   $job->jobcategory,
                'intenting'   =>   unserialize($job->intenting),
                'startdate'   =>   $job->startdate,
                'manager'   =>   $job->manager,
                'pwd'   =>   $job->pwd,
                 'interviews'   => unserialize( $job->interviews),
                'jobdescription'   =>   $job->jobdescription
            );
               

        $towhomtosendemail=DB::table('requsitionsapprovals')
                         ->join('users', 'users.id', '=', 'requsitionsapprovals.userId')
                         // ->join('job_approvals', 'job_approvals.userId', '=', 'users.id')
                         ->where('requsitionsapprovals.jobid', $request->jobid)
                         ->get();


        foreach($towhomtosendemail as $usersemails)
             { 
           
        \Mail::to($usersemails->email)->send(new \App\Mail\returnforcorrectionhiringmanager($data));
             
            }

                   $updateinitiatecollumn=DB::table('employeerequisitions')
                                    ->where('id',$request->jobid)
                                    ->update(['status' => "",'action'=>'3', 'stages'=>1, 'stage1'=>0, 'stage2'=>0, 'stage3'=>0]);

                                    // ->update(['status' => "",'action'=>'4']);
             Alert::success('Success','Your comments have been send successfully'); 
             return back();
    }
     if ($job->role =='HR Team' && $role =='Group CEO') {
         if ($checkaction->action ==4||$checkaction->action ==5 ) {
                          Alert::success('Success',' Requisition  Action has already occured!!');
                         return redirect()->route('tabspage');
            }
              $request->validate([
            'comment'=>'required',
        ]);
     
        $user_id = Auth::user()->id;
         $senderemail = JobApproval::create($request->all());
         $insertcommentby=DB::table('job_approvals')
                        ->where('jobid', $request->jobid)
                        ->update(['commentby' => $user_id]);

    $usercompany_id = Auth::user()->company_id;
    $user_id = Auth::user()->id;
    $company=DB::table('companies')
            ->where('id', $usercompany_id)
            ->first();
            $company_id=$company->id;
         $companybossid=DB::table('employeerequisitionusers')
                       ->where('company_id' , $company_id)
                       ->first();
                  $boos_id =$companybossid->userId;
  
            $data = array(    
                'user'=>Auth::user()->id, 
                'username'=>Auth::user()->name, 
                'company_id'=> Auth::user()->company_id, 
                'id'=> $job->id,
                'comment'=>$request->comment,
                'stages'=> [
                'HR Recruitment Team'=>$job->stages,
                'HR Manager'=>$job->stage1,'Executive Lead'=>$job->stage2,
                 'Group CEO'=>$job->stage3
                        ],
                'jobtittle'      =>  $job->jobtittle,
                'positions'      =>  $job->positions,
                'employementtype'      =>  $job->employementtype,
                'salary'      =>  $job->salary,
                'salarybudget'      =>  $job->salarybudget,
                // 'salaryto'      =>  $job->salaryto,
                'responsibilities'      =>  $job->responsibilities,
                'posrequirements'      =>  $job->posrequirements,
                'posskills'      =>  $job->posskills,
                'location'   =>   $job->location,
                'jobcategory'   =>   $job->jobcategory,
                'intenting'   =>   unserialize($job->intenting),
                'startdate'   =>   $job->startdate,
                'manager'   =>   $job->manager,
                'pwd'   =>   $job->pwd,
                 'interviews'   => unserialize( $job->interviews),
                'jobdescription'   =>   $job->jobdescription
            );
               

        $towhomtosendemail=DB::table('requsitionsapprovals')
                         ->join('users', 'users.id', '=', 'requsitionsapprovals.userId')
                         // ->join('job_approvals', 'job_approvals.userId', '=', 'users.id')
                         ->where('requsitionsapprovals.jobid', $request->jobid)
                         ->get();


        foreach($towhomtosendemail as $usersemails)
             { 
                            $data = array(    
                'user'=>Auth::user()->id, 
                'username'=>Auth::user()->name, 
                'company_id'=> Auth::user()->company_id, 
                'id'=> $job->id,
                'comment'=>$request->comment,
                'stages'=> [
                'HR Recruitment Team'=>$job->stages,
                'HR Manager'=>$job->stage1,'Executive Lead'=>$job->stage2,
                 'Group CEO'=>$job->stage3
                        ],
                'jobtittle'      =>  $job->jobtittle,
                'positions'      =>  $job->positions,
                'employementtype'      =>  $job->employementtype,
                'salary'      =>  $job->salary,
                'salarybudget'      =>  $job->salarybudget,
                // 'salaryto'      =>  $job->salaryto,
                'responsibilities'      =>  $job->responsibilities,
                'posrequirements'      =>  $job->posrequirements,
                'posskills'      =>  $job->posskills,
                'location'   =>   $job->location,
                'jobcategory'   =>   $job->jobcategory,
                'intenting'   =>   unserialize($job->intenting),
                'startdate'   =>   $job->startdate,
                'manager'   =>   $job->manager,
                'pwd'   =>   $job->pwd,
                'rec'=>$usersemails->id,
                 'interviews'   => unserialize( $job->interviews),
                'jobdescription'   =>   $job->jobdescription
            );
           
        \Mail::to($usersemails->email)->send(new \App\Mail\returnforcorrectionhiringmanager($data));
             
            }

                   $updateinitiatecollumn=DB::table('employeerequisitions')
                                    ->where('id',$request->jobid)
                                    ->update(['status' => "",'action'=>'4', 'stages'=>1, 'stage1'=>0, 'stage2'=>0, 'stage3'=>0]);

                                    // ->update(['status' => "",'action'=>'4']);
             Alert::success('Success','Your comments have been send successfully'); 
             return back();
    }
  if ($job->role =="" && $getrole->employeetype =='Group CEO') {
                    if ($checkaction->action ==4 ) {
                          Alert::success('Success',' Requisition  Action has already occured!!');
                         return redirect()->route('tabspage');
            }
              $request->validate([
            'comment'=>'required',
        ]);
     
        $user_id = Auth::user()->id;
         $senderemail = JobApproval::create($request->all());
         $insertcommentby=DB::table('job_approvals')
                        ->where('jobid', $request->jobid)
                        ->update(['commentby' => $user_id]);

    $usercompany_id = Auth::user()->company_id;
    $user_id = Auth::user()->id;
    $company=DB::table('companies')
            ->where('id', $usercompany_id)
            ->first();
            $company_id=$company->id;
         $companybossid=DB::table('employeerequisitionusers')
                       ->where('company_id' , $company_id)
                       ->first();
                  $boos_id =$companybossid->userId;
  
            $data = array(    
                'user'=>Auth::user()->id, 
                'username'=>Auth::user()->name, 
                'company_id'=> Auth::user()->company_id, 
                'id'=> $job->id,
                'comment'=>$request->comment,
                'stages'=> [
                'HR Recruitment Team'=>$job->stages,
                'HR Manager'=>$job->stage1,'Executive Lead'=>$job->stage2,
                 'Group CEO'=>$job->stage3
                        ],
                'jobtittle'      =>  $job->jobtittle,
                'positions'      =>  $job->positions,
                'employementtype'      =>  $job->employementtype,
                'salary'      =>  $job->salary,
                'salarybudget'      =>  $job->salarybudget,
                // 'salaryto'      =>  $job->salaryto,
                'responsibilities'      =>  $job->responsibilities,
                'posrequirements'      =>  $job->posrequirements,
                'posskills'      =>  $job->posskills,
                'location'   =>   $job->location,
                'jobcategory'   =>   $job->jobcategory,
                'intenting'   =>   unserialize($job->intenting),
                'startdate'   =>   $job->startdate,
                'manager'   =>   $job->manager,
                'pwd'   =>   $job->pwd,
                 'interviews'   => unserialize( $job->interviews),
                'jobdescription'   =>   $job->jobdescription
            );
               

        $towhomtosendemail=DB::table('requsitionsapprovals')
                         ->join('users', 'users.id', '=', 'requsitionsapprovals.userId')
                         // ->join('job_approvals', 'job_approvals.userId', '=', 'users.id')
                         ->where('requsitionsapprovals.jobid', $request->jobid)
                         ->get();


        foreach($towhomtosendemail as $usersemails)
             { 
           
        \Mail::to($usersemails->email)->send(new \App\Mail\returnforcorrectiontohiringmanager($data));
             
            }

                   $updateinitiatecollumn=DB::table('employeerequisitions')
                                    ->where('id',$request->jobid)
                                    ->update(['status' => "",'action'=>'4', 'stages'=>0, 'stage1'=>0, 'stage2'=>0, 'stage3'=>0]);

                                    // ->update(['status' => "",'action'=>'4']);
             Alert::success('Success','Your comments have been send successfully'); 
            return redirect()->route('tabspage');
        }



             if ($job->role =="" && $getrole->employeetype =='Executive Lead') {
                    if ($checkaction->action ==3 ||$checkaction->action ==4 ) {
                          Alert::success('Success',' Requisition  Action has already occured!!');
return redirect()->route('tabspage');
            }
              $request->validate([
            'comment'=>'required',
        ]);
     
        $user_id = Auth::user()->id;
         $senderemail = JobApproval::create($request->all());
         $insertcommentby=DB::table('job_approvals')
                        ->where('jobid', $request->jobid)
                        ->update(['commentby' => $user_id]);
    $usercompany_id = Auth::user()->company_id;
    $user_id = Auth::user()->id;
    $company=DB::table('companies')
            ->where('id', $usercompany_id)
            ->first();
            $company_id=$company->id;
         $companybossid=DB::table('employeerequisitionusers')
                       ->where('company_id' , $company_id)
                       ->first();
                  $boos_id =$companybossid->userId;
  
            $data = array(    
                'user'=>Auth::user()->id, 
                'username'=>Auth::user()->name, 
                'company_id'=> Auth::user()->company_id, 
                'id'=> $job->id,
                'comment'=>$request->comment,
                'stages'=> [
                'HR Recruitment Team'=>$job->stages,
                'HR Manager'=>$job->stage1,'Executive Lead'=>$job->stage2,
                 'Group CEO'=>$job->stage3
                        ],
                'jobtittle'      =>  $job->jobtittle,
                'positions'      =>  $job->positions,
                'employementtype'      =>  $job->employementtype,
                'salary'      =>  $job->salary,
                'salarybudget'      =>  $job->salarybudget,
                // 'salaryto'      =>  $job->salaryto,
                'responsibilities'      =>  $job->responsibilities,
                'posrequirements'      =>  $job->posrequirements,
                'posskills'      =>  $job->posskills,
                'location'   =>   $job->location,
                'jobcategory'   =>   $job->jobcategory,
                'intenting'   =>   unserialize($job->intenting),
                'startdate'   =>   $job->startdate,
                'manager'   =>   $job->manager,
                'pwd'   =>   $job->pwd,
                 'interviews'   => unserialize( $job->interviews),
                'jobdescription'   =>   $job->jobdescription
            );
               

        $towhomtosendemail=DB::table('requsitionsapprovals')
                         ->join('users', 'users.id', '=', 'requsitionsapprovals.userId')
                         // ->join('job_approvals', 'job_approvals.userId', '=', 'users.id')
                         ->where('requsitionsapprovals.jobid', $request->jobid)
                         ->get();

        foreach($towhomtosendemail as $usersemails)
             { 
           
        \Mail::to($usersemails->email)->send(new \App\Mail\returnforcorrectiontohiringmanager($data));
             
            }

                   $updateinitiatecollumn=DB::table('employeerequisitions')
                                    ->where('id',$request->jobid)
                            ->update(['status' => "",'action'=>'3', 'stages'=>0, 'stage1'=>0, 'stage2'=>0, 'stage3'=>0]);

                                    // ->update(['status' => "",'action'=>'3']);
             Alert::success('Success','Your comments have been send successfully'); 
             return redirect()->route('tabspage');
        }





      if ($job->role =="" && $getrole->employeetype =='HR Manager') {
                    if ($checkaction->action ==2 || $checkaction->action ==3 ||$checkaction->action ==4 ) {
                          Alert::success('Success',' Requisition  Action has already occured!!');
                         return redirect()->route('tabspage');
            }
              $request->validate([
            'comment'=>'required',
        ]);
     
        $user_id = Auth::user()->id;
         $senderemail = JobApproval::create($request->all());
         $insertcommentby=DB::table('job_approvals')
                        ->where('jobid', $request->jobid)
                        ->update(['commentby' => $user_id]);

    $usercompany_id = Auth::user()->company_id;
    $user_id = Auth::user()->id;
    $company=DB::table('companies')
            ->where('id', $usercompany_id)
            ->first();
            $company_id=$company->id;
         $companybossid=DB::table('employeerequisitionusers')
                       ->where('company_id' , $company_id)
                       ->first();
                  $boos_id =$companybossid->userId;
  
            $data = array(    
                'user'=>Auth::user()->id, 
                'username'=>Auth::user()->name, 
                'company_id'=> Auth::user()->company_id, 
                'id'=> $job->id,
                'comment'=>$request->comment,
                'stages'=> [
                'HR Recruitment Team'=>$job->stages,
                'HR Manager'=>$job->stage1,'Executive Lead'=>$job->stage2,
                 'Group CEO'=>$job->stage3
                        ],
                'jobtittle'      =>  $job->jobtittle,
                'positions'      =>  $job->positions,
                'employementtype'      =>  $job->employementtype,
                'salary'      =>  $job->salary,
                'salarybudget'      =>  $job->salarybudget,
                // 'salaryto'      =>  $job->salaryto,
                'responsibilities'      =>  $job->responsibilities,
                'posrequirements'      =>  $job->posrequirements,
                'posskills'      =>  $job->posskills,
                'location'   =>   $job->location,
                'jobcategory'   =>   $job->jobcategory,
                'intenting'   =>   unserialize($job->intenting),
                'startdate'   =>   $job->startdate,
                'manager'   =>   $job->manager,
                'pwd'   =>   $job->pwd,
                 'interviews'   => unserialize( $job->interviews),
                'jobdescription'   =>   $job->jobdescription
            );
               

        $towhomtosendemail=DB::table('requsitionsapprovals')
                         ->join('users', 'users.id', '=', 'requsitionsapprovals.userId')
                         // ->join('job_approvals', 'job_approvals.userId', '=', 'users.id')
                         ->where('requsitionsapprovals.jobid', $request->jobid)
                         ->get();

        foreach($towhomtosendemail as $usersemails)
             { 
           
        \Mail::to($usersemails->email)->send(new \App\Mail\returnforcorrectiontohiringmanager($data));
             
            }

                   $updateinitiatecollumn=DB::table('employeerequisitions')
                                    ->where('id',$request->jobid)
                                    ->update(['status' => "",'action'=>'2', 'stages'=>0, 'stage1'=>0, 'stage2'=>0, 'stage3'=>0]);

                                    // ->update(['status' => "",'action'=>'2']);
             Alert::success('Success','Your comments have been send successfully'); 
             return redirect()->route('tabspage');
        }



                 if ($job->role =="" && $getrole->employeetype =='HR Recruitment Team') {
                    if ($checkaction->action ==1 || $checkaction->action ==2 || $checkaction->action ==3 ||$checkaction->action ==4 ) {
                          Alert::success('Success',' Requisition  Action has already occured!!');
                        return redirect()->route('tabspage');
            }
              $request->validate([
            'comment'=>'required',
        ]);
     
        $user_id = Auth::user()->id;
         $senderemail = JobApproval::create($request->all());
         $insertcommentby=DB::table('job_approvals')
                        ->where('jobid', $request->jobid)
                        ->update(['commentby' => $user_id]);

    $usercompany_id = Auth::user()->company_id;

    $company=DB::table('companies')
            ->where('id', $usercompany_id)
            ->first();
            $company_id=$company->id;
         $companybossid=DB::table('employeerequisitionusers')
                       ->where('company_id' , $company_id)
                       ->first();
                  $boos_id =$companybossid->userId;
  
            $data = array(    
                'user'=>Auth::user()->id, 
                'username'=>Auth::user()->name, 
                'company_id'=> Auth::user()->company_id, 
                'id'=> $job->id,
                'comment'=>$request->comment,
                'stages'=> [
                'HR Recruitment Team'=>$job->stages,
                'HR Manager'=>$job->stage1,'Executive Lead'=>$job->stage2,
                 'Group CEO'=>$job->stage3
                        ],
                'jobtittle'      =>  $job->jobtittle,
                'positions'      =>  $job->positions,
                'employementtype'      =>  $job->employementtype,
                'salary'      =>  $job->salary,
                'salarybudget'      =>  $job->salarybudget,
                // 'salaryto'      =>  $job->salaryto,
                'responsibilities'      =>  $job->responsibilities,
                'posrequirements'      =>  $job->posrequirements,
                'posskills'      =>  $job->posskills,
                'location'   =>   $job->location,
                'jobcategory'   =>   $job->jobcategory,
                'intenting'   =>   unserialize($job->intenting),
                'startdate'   =>   $job->startdate,
                'manager'   =>   $job->manager,
                'pwd'   =>   $job->pwd,
                'interviews'   => unserialize( $job->interviews),
                'jobdescription'   =>   $job->jobdescription
            );
               

        $towhomtosendemail=DB::table('requsitionsapprovals')
                         ->join('users', 'users.id', '=', 'requsitionsapprovals.userId')
                         // ->join('job_approvals', 'job_approvals.userId', '=', 'users.id')
                         ->where('requsitionsapprovals.jobid', $request->jobid)
                         ->get();

        foreach($towhomtosendemail as $usersemails)
             { 
           
        \Mail::to($usersemails->email)->send(new \App\Mail\returnforcorrectiontohiringmanager($data));
             
            }

                   $updateinitiatecollumn=DB::table('employeerequisitions')
                                    ->where('id',$request->jobid)
                                    ->update(['status' => "",'action'=>'1', 'stages'=>0, 'stage1'=>0, 'stage2'=>0, 'stage3'=>0]);

                                    // ->update(['status' => "",'action'=>'1']);
             Alert::success('Success','Your comments have been send successfully'); 
             return redirect()->route('tabspage');
        }


     if ($job->role =="Executive Lead" && $getrole->employeetype =='Group CEO') {
                    if ($checkaction->action ==1) {
                          Alert::success('Success',' Requisition  Action has already occured!!');
                        return redirect()->route('tabspage');
            }
              $request->validate([
            'comment'=>'required',
        ]);
        $user_id = Auth::user()->id;
         $senderemail = JobApproval::create($request->all());
         $insertcommentby=DB::table('job_approvals')
                        ->where('jobid', $request->jobid)
                        ->update(['commentby' => $user_id]);
         $emailtosend=$senderemail->userId;

    $usercompany_id = Auth::user()->company_id;
    
    $company=DB::table('companies')
            ->where('id', $usercompany_id)
            ->first();
            $company_id=$company->id;
         $companybossid=DB::table('employeerequisitionusers')
                       ->where('company_id' , $company_id)
                       ->first();
                  $boos_id =$companybossid->userId;
  
            $data = array(    
                'user'=>Auth::user()->id, 
                'username'=>Auth::user()->name, 
                'company_id'=> Auth::user()->company_id, 
                'id'=> $job->id,
                'comment'=>$request->comment,
                'stages'=> [
                'HR Recruitment Team'=>$job->stages,
                'HR Manager'=>$job->stage1,'Executive Lead'=>$job->stage2,
                 'Group CEO'=>$job->stage3
                        ],
                'jobtittle'      =>  $job->jobtittle,
                'positions'      =>  $job->positions,
                'employementtype'      =>  $job->employementtype,
                'salary'      =>  $job->salary,
                'salarybudget'      =>  $job->salarybudget,
                // 'salaryto'      =>  $job->salaryto,
                'responsibilities'      =>  $job->responsibilities,
                'posrequirements'      =>  $job->posrequirements,
                'posskills'      =>  $job->posskills,
                'location'   =>   $job->location,
                'jobcategory'   =>   $job->jobcategory,
                'intenting'   =>   unserialize($job->intenting),
                'startdate'   =>   $job->startdate,
                'manager'   =>   $job->manager,
                'pwd'   =>   $job->pwd,
                 'interviews'   => unserialize( $job->interviews),
                'jobdescription'   =>   $job->jobdescription
            );
               

        $towhomtosendemail=DB::table('requsitionsapprovals')
                         ->join('users', 'users.id', '=', 'requsitionsapprovals.userId')
                         // ->join('job_approvals', 'job_approvals.userId', '=', 'users.id')
                         ->where('requsitionsapprovals.jobid', $request->jobid)
                         ->get();

        foreach($towhomtosendemail as $usersemails)
             { 
           
        \Mail::to($usersemails->email)->send(new \App\Mail\returnforcorrectiontohiringmanager($data));
             
            }

                   $updateinitiatecollumn=DB::table('employeerequisitions')
                                    ->where('id',$request->jobid)
                                    ->update(['status' => "",'action'=>'1']);
             Alert::success('Success','Your comments have been send successfully'); 
            return redirect()->route('tabspage');
        }

         if ($job->role =="HR Manager" && $getrole->employeetype =='Executive Lead') {
                    if ($checkaction->action ==1 || $checkaction->action ==2) {
                          Alert::success('Success',' Requisition  Action has already occured!!');
                        return redirect()->route('tabspage');
            }
              $request->validate([
            'comment'=>'required',
        ]);
     
        $user_id = Auth::user()->id;
         $senderemail = JobApproval::create($request->all());
         $insertcommentby=DB::table('job_approvals')
                        ->where('jobid', $request->jobid)
                        ->update(['commentby' => $user_id]);
    $usercompany_id = Auth::user()->company_id;
    $user_id = Auth::user()->id;
    $company=DB::table('companies')
            ->where('id', $usercompany_id)
            ->first();
            $company_id=$company->id;
         $companybossid=DB::table('employeerequisitionusers')
                       ->where('company_id' , $company_id)
                       ->first();
                  $boos_id =$companybossid->userId;
  
            $data = array(    
                'user'=>Auth::user()->id, 
                'username'=>Auth::user()->name, 
                'company_id'=> Auth::user()->company_id, 
                'id'=> $job->id,
                'comment'=>$request->comment,
                'stages'=> [
                'HR Recruitment Team'=>$job->stages,
                'HR Manager'=>$job->stage1,'Executive Lead'=>$job->stage2,
                 'Group CEO'=>$job->stage3
                        ],
                'jobtittle'      =>  $job->jobtittle,
                'positions'      =>  $job->positions,
                'employementtype'      =>  $job->employementtype,
                'salary'      =>  $job->salary,
                'salarybudget'      =>  $job->salarybudget,
                // 'salaryto'      =>  $job->salaryto,
                'responsibilities'      =>  $job->responsibilities,
                'posrequirements'      =>  $job->posrequirements,
                'posskills'      =>  $job->posskills,
                'location'   =>   $job->location,
                'jobcategory'   =>   $job->jobcategory,
                'intenting'   =>   unserialize($job->intenting),
                'startdate'   =>   $job->startdate,
                'manager'   =>   $job->manager,
                'pwd'   =>   $job->pwd,
                 'interviews'   => unserialize( $job->interviews),
                'jobdescription'   =>   $job->jobdescription
            );
               

        $towhomtosendemail=DB::table('requsitionsapprovals')
                         ->join('users', 'users.id', '=', 'requsitionsapprovals.userId')
                         // ->join('job_approvals', 'job_approvals.userId', '=', 'users.id')
                         ->where('requsitionsapprovals.jobid', $request->jobid)
                         ->get();

        foreach($towhomtosendemail as $usersemails)
             { 
           
        \Mail::to($usersemails->email)->send(new \App\Mail\returnforcorrectiontohiringmanager($data));
             
            }

                   $updateinitiatecollumn=DB::table('employeerequisitions')
                                    ->where('id',$request->jobid)
                                    ->update(['status' => "",'action'=>'1', 'stages'=>1, 'stage1'=>1, 'stage2'=>0, 'stage3'=>0]);

                                    // ->update(['status' => "",'action'=>'1']);
             Alert::success('Success','Your comments have been send successfully'); 
             return redirect()->route('tabspage');
        }

    if ($job->role =="HR Manager" && $getrole->employeetype =='Group CEO') {
                    if ($checkaction->action ==2) {
                          Alert::success('Success',' Requisition  Action has already occured!!');
                        return redirect()->route('tabspage');
            }
              $request->validate([
            'comment'=>'required',
        ]);
        $user_id = Auth::user()->id;
         $senderemail = JobApproval::create($request->all());
         $insertcommentby=DB::table('job_approvals')
                        ->where('jobid', $request->jobid)
                        ->update(['commentby' => $user_id]);

    $usercompany_id = Auth::user()->company_id;
    $user_id = Auth::user()->id;
    $company=DB::table('companies')
            ->where('id', $usercompany_id)
            ->first();
            $company_id=$company->id;
         $companybossid=DB::table('employeerequisitionusers')
                       ->where('company_id' , $company_id)
                       ->first();
                  $boos_id =$companybossid->userId;
  
            $data = array(    
                'user'=>Auth::user()->id, 
                'username'=>Auth::user()->name, 
                'company_id'=> Auth::user()->company_id, 
                'id'=> $job->id,
                'comment'=>$request->comment,
                'stages'=> [
                'HR Recruitment Team'=>$job->stages,
                'HR Manager'=>$job->stage1,'Executive Lead'=>$job->stage2,
                 'Group CEO'=>$job->stage3
                        ],
                'jobtittle'      =>  $job->jobtittle,
                'positions'      =>  $job->positions,
                'employementtype'      =>  $job->employementtype,
                'salary'      =>  $job->salary,
                'salarybudget'      =>  $job->salarybudget,
                // 'salaryto'      =>  $job->salaryto,
                'responsibilities'      =>  $job->responsibilities,
                'posrequirements'      =>  $job->posrequirements,
                'posskills'      =>  $job->posskills,
                'location'   =>   $job->location,
                'jobcategory'   =>   $job->jobcategory,
                'intenting'   =>   unserialize($job->intenting),
                'startdate'   =>   $job->startdate,
                'manager'   =>   $job->manager,
                'pwd'   =>   $job->pwd,
                 'interviews'   => unserialize( $job->interviews),
                'jobdescription'   =>   $job->jobdescription
            );
               

        $towhomtosendemail=DB::table('requsitionsapprovals')
                         ->join('users', 'users.id', '=', 'requsitionsapprovals.userId')
                         // ->join('job_approvals', 'job_approvals.userId', '=', 'users.id')
                         ->where('requsitionsapprovals.jobid', $request->jobid)
                         ->get();

        foreach($towhomtosendemail as $usersemails)
             { 
           
        \Mail::to($usersemails->email)->send(new \App\Mail\returnforcorrectiontohiringmanager($data));
             
            }

                   $updateinitiatecollumn=DB::table('employeerequisitions')
                                    ->where('id',$request->jobid)
                                    ->update(['status' => "",'action'=>'2', 'stages'=>1, 'stage1'=>0, 'stage2'=>0, 'stage3'=>0]);
                                    // ->update(['status' => "",'action'=>'2']);
             Alert::success('Success','Your comments have been send successfully'); 
            return redirect()->route('tabspage');
        }


     if ($job->role =="HR Recruitment Team" && $getrole->employeetype =='Executive Lead') {

        
                    if ($checkaction->action ==2 || $checkaction->action ==3) {
                          Alert::success('Success',' Requisition  Action has already occured!!');
                        return redirect()->route('tabspage');
            }
              $request->validate([
            'comment'=>'required',
        ]);
     
        $user_id = Auth::user()->id;
         $senderemail = JobApproval::create($request->all());
         $insertcommentby=DB::table('job_approvals')
                        ->where('jobid', $request->jobid)
                        ->update(['commentby' => $user_id]);

    $usercompany_id = Auth::user()->company_id;
    $user_id = Auth::user()->id;
    $company=DB::table('companies')
            ->where('id', $usercompany_id)
            ->first();
            $company_id=$company->id;
         $companybossid=DB::table('employeerequisitionusers')
                       ->where('company_id' , $company_id)
                       ->first();
                  $boos_id =$companybossid->userId;
  
            $data = array(    
                'user'=>Auth::user()->id, 
                'username'=>Auth::user()->name, 
                'company_id'=> Auth::user()->company_id, 
                'id'=> $job->id,
                'comment'=>$request->comment,
                'stages'=> [
                'HR Recruitment Team'=>$job->stages,
                'HR Manager'=>$job->stage1,'Executive Lead'=>$job->stage2,
                 'Group CEO'=>$job->stage3
                        ],
                'jobtittle'      =>  $job->jobtittle,
                'positions'      =>  $job->positions,
                'employementtype'      =>  $job->employementtype,
                'salary'      =>  $job->salary,
                'salarybudget'      =>  $job->salarybudget,
                // 'salaryto'      =>  $job->salaryto,
                'responsibilities'      =>  $job->responsibilities,
                'posrequirements'      =>  $job->posrequirements,
                'posskills'      =>  $job->posskills,
                'location'   =>   $job->location,
                'jobcategory'   =>   $job->jobcategory,
                'intenting'   =>   unserialize($job->intenting),
                'startdate'   =>   $job->startdate,
                'manager'   =>   $job->manager,
                'pwd'   =>   $job->pwd,
                 'interviews'   => unserialize( $job->interviews),
                'jobdescription'   =>   $job->jobdescription
            );
               

        $towhomtosendemail=DB::table('requsitionsapprovals')
                         ->join('users', 'users.id', '=', 'requsitionsapprovals.userId')
                         // ->join('job_approvals', 'job_approvals.userId', '=', 'users.id')
                         ->where('requsitionsapprovals.jobid', $request->jobid)
                         ->get();

        foreach($towhomtosendemail as $usersemails)
             { 
           
        \Mail::to($usersemails->email)->send(new \App\Mail\returnforcorrectiontohiringmanager($data));
             
            }

                   $updateinitiatecollumn=DB::table('employeerequisitions')
                                    ->where('id',$request->jobid)
                                    ->update(['status' => "",'action'=>'2', 'stage1'=>0, 'stage2'=>0, 'stage3'=>0]);
             Alert::success('Success','Your comments have been send successfully'); 
             return redirect()->route('tabspage');
        }
        if ($job->role =="HR Recruitment Team" && $getrole->employeetype =='HR Manager') {
                    if ($checkaction->action ==1 || $checkaction->action ==2 ||$checkaction->action ==3) {
                          Alert::success('Success',' Requisition  Action has already occured!!');
                         return redirect()->route('tabspage');
            }
              $request->validate([
            'comment'=>'required',
        ]);
     
        $user_id = Auth::user()->id;
         $senderemail = JobApproval::create($request->all());
         $insertcommentby=DB::table('job_approvals')
                        ->where('jobid', $request->jobid)
                        ->update(['commentby' => $user_id]);

    $usercompany_id = Auth::user()->company_id;
    $user_id = Auth::user()->id;
    $company=DB::table('companies')
            ->where('id', $usercompany_id)
            ->first();
            $company_id=$company->id;
         $companybossid=DB::table('employeerequisitionusers')
                       ->where('company_id' , $company_id)
                       ->first();
                  $boos_id =$companybossid->userId;
  
            $data = array(    
                'user'=>Auth::user()->id, 
                'username'=>Auth::user()->name, 
                'company_id'=> Auth::user()->company_id, 
                'id'=> $job->id,
                'comment'=>$request->comment,
                'stages'=> [
                'HR Recruitment Team'=>$job->stages,
                'HR Manager'=>$job->stage1,'Executive Lead'=>$job->stage2,
                 'Group CEO'=>$job->stage3
                        ],
                'jobtittle'      =>  $job->jobtittle,
                'positions'      =>  $job->positions,
                'employementtype'      =>  $job->employementtype,
                'salary'      =>  $job->salary,
                'salarybudget'      =>  $job->salarybudget,
                // 'salaryto'      =>  $job->salaryto,
                'responsibilities'      =>  $job->responsibilities,
                'posrequirements'      =>  $job->posrequirements,
                'posskills'      =>  $job->posskills,
                'location'   =>   $job->location,
                'jobcategory'   =>   $job->jobcategory,
                'intenting'   =>   unserialize($job->intenting),
                'startdate'   =>   $job->startdate,
                'manager'   =>   $job->manager,
                'pwd'   =>   $job->pwd,
                'interviews'   => unserialize( $job->interviews),
                'jobdescription'   =>   $job->jobdescription
            );
               

        $towhomtosendemail=DB::table('requsitionsapprovals')
                         ->join('users', 'users.id', '=', 'requsitionsapprovals.userId')
                         // ->join('job_approvals', 'job_approvals.userId', '=', 'users.id')
                         ->where('requsitionsapprovals.jobid', $request->jobid)
                         ->get();

        foreach($towhomtosendemail as $usersemails)
             { 
           
        \Mail::to($usersemails->email)->send(new \App\Mail\returnforcorrectiontohiringmanager($data));
             
            }

                   $updateinitiatecollumn=DB::table('employeerequisitions')
                                    ->where('id',$request->jobid)
                                    ->update(['status' => "",'action'=>'1', 'stage1'=>0, 'stage2'=>0, 'stage3'=>0]);
             Alert::success('Success','Your comments have been send successfully'); 
            return redirect()->route('tabspage');
        }  
        if ($job->role =="HR Recruitment Team" && $getrole->employeetype =='Group CEO') {
                    if ($checkaction->action ==3) {
                          Alert::success('Success',' Requisition  Action has already occured!!');
                         return redirect()->route('tabspage');
            }
              $request->validate([
            'comment'=>'required',
        ]);
     
        $user_id = Auth::user()->id;
         $senderemail = JobApproval::create($request->all());
         $insertcommentby=DB::table('job_approvals')
                        ->where('jobid', $request->jobid)
                        ->update(['commentby' => $user_id]);

    $usercompany_id = Auth::user()->company_id;
    $user_id = Auth::user()->id;
    $company=DB::table('companies')
            ->where('id', $usercompany_id)
            ->first();
            $company_id=$company->id;
         $companybossid=DB::table('employeerequisitionusers')
                       ->where('company_id' , $company_id)
                       ->first();
                  $boos_id =$companybossid->userId;
  
            $data = array(    
                'user'=>Auth::user()->id, 
                'username'=>Auth::user()->name, 
                'company_id'=> Auth::user()->company_id, 
                'id'=> $job->id,
                'comment'=>$request->comment,
                'stages'=> [
                'HR Recruitment Team'=>$job->stages,
                'HR Manager'=>$job->stage1,'Executive Lead'=>$job->stage2,
                 'Group CEO'=>$job->stage3
                        ],
                'jobtittle'      =>  $job->jobtittle,
                'positions'      =>  $job->positions,
                'employementtype'      =>  $job->employementtype,
                'salary'      =>  $job->salary,
                'salarybudget'      =>  $job->salarybudget,
                // 'salaryto'      =>  $job->salaryto,
                'responsibilities'      =>  $job->responsibilities,
                'posrequirements'      =>  $job->posrequirements,
                'posskills'      =>  $job->posskills,
                'location'   =>   $job->location,
                'jobcategory'   =>   $job->jobcategory,
                'intenting'   =>   unserialize($job->intenting),
                'startdate'   =>   $job->startdate,
                'manager'   =>   $job->manager,
                'pwd'   =>   $job->pwd,
                 'interviews'   => unserialize( $job->interviews),
                'jobdescription'   =>   $job->jobdescription
            );
               

        $towhomtosendemail=DB::table('requsitionsapprovals')
                         ->join('users', 'users.id', '=', 'requsitionsapprovals.userId')
                         // ->join('job_approvals', 'job_approvals.userId', '=', 'users.id')
                         ->where('requsitionsapprovals.jobid', $request->jobid)
                         ->get();

        foreach($towhomtosendemail as $usersemails)
             { 
           
        \Mail::to($usersemails->email)->send(new \App\Mail\returnforcorrectiontohiringmanager($data));
             
            }

                   $updateinitiatecollumn=DB::table('employeerequisitions')
                                    ->where('id',$request->jobid)
                                    ->update(['status' => "",'action'=>'3', 'stage1'=>0, 'stage2'=>0, 'stage3'=>0]);
             Alert::success('Success','Your comments have been send successfully'); 
            return redirect()->route('tabspage');
        }   

    }

    /**
     * view comments made from approver 1
     * 
     * */
        public function viewcomments( $id)
    {
       $user=Auth::user()->id;
       $jobapproval=JobApproval::where('jobid', $id)->get();
        return view('employeerequisitions.viewcomments', compact('jobapproval'));
    }
/**
 * returning an approves message
 * 
 * */
public function approvesmessage(){
    return view('employeerequisitions.approvesmessage');
}
/**
 * aprovals by rec team emaqil qapprovqals
 * */
public function approvetoHR1($id, $rec){
    $checkaction=DB::table('employeerequisitions')
            ->where('id', $id)
            ->first();
    if ($checkaction->action ==1 ||$checkaction->action ==2 ||$checkaction->action ==3 || $checkaction->action ==4) {
         Alert::success('Success',' Requisition  Action has already occured!!');
         return redirect()->route('employeerequisitions.approvesmessage')->with('success','Requisition  Action has already occured!!');
            }
    $companyinitator=DB::table('requsitionsapprovals')
                    ->where('requsitionsapprovals.jobid', $id)
                    ->orwhere('requsitionsapprovals.initiator', 'initiator')
                    ->first();
                    //dd($companyinitator);
      $company_id=$companyinitator->company_id;
      //dd($company_id);              
           $job = EmployeeRequisition::find($id);
              //store that it has been approved
   $ldate = date('Y-m-d H:i:s');             
       $storeapprove1=DB::table('requsitionsapprovals')
                              ->insert([
                                     'jobid' => $id,
                                     'userId' => $rec,
                                     'date'=>$ldate,
                                    ]);


            $towhomtosendemail=DB::table('requsitionsapprovals')
                         ->join('users', 'users.id', '=', 'requsitionsapprovals.userId')
                         ->where('requsitionsapprovals.jobid', $id)
                          ->get(); 
             //send email to notify those in the back
             foreach($towhomtosendemail as $usersemails)
             { 
                $data = array(
                'user'=>$rec,  
                'id'=> $job->id,
                 'stages'=> [
                                'HR Recruitment Team'=>$job->stages,
                                'HR Manager'=>$job->stage1,'Executive Lead'=>$job->stage2,
                                'Group CEO'=>$job->stage3
                        ],
                'company_id'=>$company_id,
                'jobtittle'      =>  $job->jobtittle,
                'positions'      =>  $job->positions,
                'employementtype'      =>  $job->employementtype,
                'salary'      =>  $job->salary,
                // 'salaryto'      =>  $job->salaryto,
                'responsibilities'      =>  $job->responsibilities,
                'posrequirements'      =>  $job->posrequirements,
                'posskills'      =>  $job->posskills,
                'location'   =>   $job->location,
                'jobcategory'   =>   $job->jobcategory,
                 'intenting'   =>   unserialize($job->intenting),
                'startdate'   =>   $job->startdate,
                'manager'   =>   $job->manager,
                'pwd'   =>   $job->pwd,
                'rec'=>$usersemails->id,
                'interviews'   => unserialize( $job->interviews),
                'jobdescription'   =>   $job->jobdescription
        );
                //dd($usersemails->email);
                \Mail::to($usersemails->email)->send(new \App\Mail\approvetoHRnotifyemail($data));
            }    
            //proceed to send email to the HR 
            $sendmailtohr=DB::table('employeerequisitionusers')
                               ->join('users', 'users.id','=', 'employeerequisitionusers.userId')
                               ->where('employeerequisitionusers.employeetype', 'HR Manager')   
                               ->get();
                               //dd($sendmailtogroupceo);
             foreach($sendmailtohr as $usersemails)
             { 
            $data = array(
                'user'=>$rec,  
                'id'=> $job->id,
                 'stages'=> [
                                'HR Recruitment Team'=>$job->stages,
                                'HR Manager'=>$job->stage1,'Executive Lead'=>$job->stage2,
                                'Group CEO'=>$job->stage3
                        ],
                'company_id'=>$company_id,
                'jobtittle'      =>  $job->jobtittle,
                'positions'      =>  $job->positions,
                'employementtype'      =>  $job->employementtype,
                'salary'      =>  $job->salary,
                // 'salaryto'      =>  $job->salaryto,
                'responsibilities'      =>  $job->responsibilities,
                'posrequirements'      =>  $job->posrequirements,
                'posskills'      =>  $job->posskills,
                'location'   =>   $job->location,
                'jobcategory'   =>   $job->jobcategory,
                 'intenting'   =>   unserialize($job->intenting),
                'startdate'   =>   $job->startdate,
                'manager'   =>   $job->manager,
                'pwd'   =>   $job->pwd,
                'rec'=>$usersemails->id,
                'interviews'   => unserialize( $job->interviews),
                'jobdescription'   =>   $job->jobdescription
        );
                //dd($usersemails->email);
              \Mail::to($usersemails->email)->send(new \App\Mail\approvetohremail($data));
            }     
               $approve1=DB::table('employeerequisitions')
                           ->where('id',$id)
                           ->update(['stages' => "1", 'action'=>'1']);
        Alert::success('Success',' Requisition  has been approved successfully');
           return redirect()->route('employeerequisitions.approvesmessage')->with('success','Requisition  has been approved successfully');
                 
 }
// aprroving by the recruitment team

public function approvetoHR($id){
    $checkaction=DB::table('employeerequisitions')
            ->where('id', $id)
            ->first();
    if ($checkaction->action ==1 ||$checkaction->action ==2 ||$checkaction->action ==3 || $checkaction->action ==4) {
         Alert::success('Success',' Requisition  Action has already occured!!');
         return redirect()->route('tabspage');
            }
    $companyinitator=DB::table('requsitionsapprovals')
                    ->where('requsitionsapprovals.jobid', $id)
                    ->orwhere('requsitionsapprovals.initiator', 'initiator')
                    ->first();
                    //dd($companyinitator);
      $company_id=$companyinitator->company_id;
      //dd($company_id);              
           $job = EmployeeRequisition::find($id);
              //store that it has been approved
   $ldate = date('Y-m-d H:i:s');             
       $storeapprove1=DB::table('requsitionsapprovals')
                              ->insert([
                                     'jobid' => $id,
                                     'userId' => Auth::user()->id,
                                     'date'=>$ldate,
                                    ]);



            $towhomtosendemail=DB::table('requsitionsapprovals')
                         ->join('users', 'users.id', '=', 'requsitionsapprovals.userId')
                         ->where('requsitionsapprovals.jobid', $id)
                          ->get(); 
             //send email to notify those in the back
             foreach($towhomtosendemail as $usersemails)
             { 
                $data = array(
                'user'=>Auth::user()->id, 
                'username'=>Auth::user()->name,  
                'id'=> $job->id,
                 'stages'=> [
                                'HR Recruitment Team'=>$job->stages,
                                'HR Manager'=>$job->stage1,'Executive Lead'=>$job->stage2,
                                'Group CEO'=>$job->stage3
                        ],
                'company_id'=>$company_id,
                'jobtittle'      =>  $job->jobtittle,
                'positions'      =>  $job->positions,
                'employementtype'      =>  $job->employementtype,
                'salary'      =>  $job->salary,
                // 'salaryto'      =>  $job->salaryto,
                'responsibilities'      =>  $job->responsibilities,
                'posrequirements'      =>  $job->posrequirements,
                'posskills'      =>  $job->posskills,
                'location'   =>   $job->location,
                'jobcategory'   =>   $job->jobcategory,
                 'intenting'   =>   unserialize($job->intenting),
                'startdate'   =>   $job->startdate,
                'manager'   =>   $job->manager,
                'pwd'   =>   $job->pwd,
                'rec'=>$usersemails->id,
                'interviews'   => unserialize( $job->interviews),
                'jobdescription'   =>   $job->jobdescription
        );
                //dd($usersemails->email);
                \Mail::to($usersemails->email)->send(new \App\Mail\approvetoHRnotify($data));
            }    
            //proceed to send email to the HR 
            $sendmailtohr=DB::table('employeerequisitionusers')
                               ->join('users', 'users.id','=', 'employeerequisitionusers.userId')
                               ->where('employeerequisitionusers.employeetype', 'HR Manager')   
                               ->get();
                               //dd($sendmailtogroupceo);
             foreach($sendmailtohr as $usersemails)
             { 
                 $data = array(
                'user'=>Auth::user()->id, 
                'username'=>Auth::user()->name,  
                'id'=> $job->id,
                 'stages'=> [
                                'HR Recruitment Team'=>$job->stages,
                                'HR Manager'=>$job->stage1,'Executive Lead'=>$job->stage2,
                                'Group CEO'=>$job->stage3
                        ],
                'company_id'=>$company_id,
                'jobtittle'      =>  $job->jobtittle,
                'positions'      =>  $job->positions,
                'employementtype'      =>  $job->employementtype,
                'salary'      =>  $job->salary,
                // 'salaryto'      =>  $job->salaryto,
                'responsibilities'      =>  $job->responsibilities,
                'posrequirements'      =>  $job->posrequirements,
                'posskills'      =>  $job->posskills,
                'location'   =>   $job->location,
                'jobcategory'   =>   $job->jobcategory,
                 'intenting'   =>   unserialize($job->intenting),
                'startdate'   =>   $job->startdate,
                'manager'   =>   $job->manager,
                'pwd'   =>   $job->pwd,
                'rec'=>$usersemails->id,
                'interviews'   => unserialize( $job->interviews),
                'jobdescription'   =>   $job->jobdescription
        );
                //dd($usersemails->email);
              \Mail::to($usersemails->email)->send(new \App\Mail\approvetohr($data));
            }     
               $approve1=DB::table('employeerequisitions')
                           ->where('id',$id)
                           ->update(['stages' => "1", 'action'=>'1']);
        Alert::success('Success',' Requisition  has been approved successfully');
       return redirect()->route('tabspage');
         // return redirect()->route('employeerequisitions.index');
                 
 }
 /**
  * approvals from hr to exec via email button
  * */
 public function approve1($id, $rec){
$checkaction=DB::table('employeerequisitions')
            ->where('id', $id)
            ->first();
            if ($checkaction->action ==2 || $checkaction->action ==3 ||$checkaction->action ==4) {
         Alert::success('Success',' Requisition  Action has already occured!!');
         return redirect()->route('employeerequisitions.approvesmessage')->with('success',' Requisition  Action has already occured!!');
            }
 $companyinitator=DB::table('requsitionsapprovals')
                    ->where('requsitionsapprovals.jobid', $id)
                    ->where('requsitionsapprovals.initiator', 'initiator')
                    ->first();
                    // dd($companyinitator);
$company_id=$companyinitator->company_id;   
    $approve1=DB::table('employeerequisitions')
             ->where('id',$id)
             ->update(['stage1' => "1", 'action'=>'2']);

     $job = EmployeeRequisition::find($id);
     $ldate = date('Y-m-d H:i:s');
    $storeapprove1=DB::table('requsitionsapprovals')
                              ->insert([
                                     'jobid' => $id,
                                     'userId' => $rec,
                                     'date'=>$ldate,
                                    ]);


           $towhomtosendemail=DB::table('requsitionsapprovals')
                         ->join('users', 'users.id', '=', 'requsitionsapprovals.userId')
                         ->where('requsitionsapprovals.jobid', $id)
                          ->get(); 
            //send email to notify those in the back
             foreach($towhomtosendemail as $usersemails)
             { 
                $data = array(
                'user'=>$rec, 
  
                'id'=> $job->id,
                 'stages'=> [
                                'HR Recruitment Team'=>$job->stages,
                                'HR Manager'=>$job->stage1,'Executive Lead'=>$job->stage2,
                                'Group CEO'=>$job->stage3
                        ],
                'company_id'=>$company_id,
                'jobtittle'      =>  $job->jobtittle,
                'positions'      =>  $job->positions,
                'employementtype'      =>  $job->employementtype,
                'salary'      =>  $job->salary,
                // 'salaryto'      =>  $job->salaryto,
                'responsibilities'      =>  $job->responsibilities,
                'posrequirements'      =>  $job->posrequirements,
                'posskills'      =>  $job->posskills,
                'location'   =>   $job->location,
                'jobcategory'   =>   $job->jobcategory,
                'intenting'   =>   unserialize($job->intenting),
                'startdate'   =>   $job->startdate,
                'manager'   =>   $job->manager,
                'pwd'   =>   $job->pwd,
                'rec'=>$usersemails->id,
                 'interviews'   => unserialize( $job->interviews),
                'jobdescription'   =>   $job->jobdescription
        );
                //dd($usersemails->email);
                  // mail back to hiring manager 
              \Mail::to($usersemails->email)->send(new \App\Mail\employeerequisitionapprovenotifyemail($data));
            } 
              // check the company of the initiator
         $initiatorcompany=DB::table('requsitionsapprovals')
                                 ->join('users', 'users.id','=' ,'requsitionsapprovals.userId')
                                 ->join('companies', 'companies.id', '=', 'users.company_id')
                                 ->where('requsitionsapprovals.jobid', $id)
                                 ->where('requsitionsapprovals.initiator', 'initiator')
                                 ->first()->company_id;

        $bossId = DB::table("employeerequisitionusers")->where("company_id","=",$initiatorcompany)->where("employeetype","=","Executive Lead")->first()->userId;
        $bossEmail = DB::table("users")->where("id","=",$bossId)->first()->email;
                      $data = array(
                'user'=>$rec, 
  
                'id'=> $job->id,
                 'stages'=> [
                                'HR Recruitment Team'=>$job->stages,
                                'HR Manager'=>$job->stage1,'Executive Lead'=>$job->stage2,
                                'Group CEO'=>$job->stage3
                        ],
                'company_id'=>$company_id,
                'jobtittle'      =>  $job->jobtittle,
                'positions'      =>  $job->positions,
                'employementtype'      =>  $job->employementtype,
                'salary'      =>  $job->salary,
                // 'salaryto'      =>  $job->salaryto,
                'responsibilities'      =>  $job->responsibilities,
                'posrequirements'      =>  $job->posrequirements,
                'posskills'      =>  $job->posskills,
                'location'   =>   $job->location,
                'jobcategory'   =>   $job->jobcategory,
                'intenting'   =>   unserialize($job->intenting),
                'startdate'   =>   $job->startdate,
                'manager'   =>   $job->manager,
                'pwd'   =>   $job->pwd,
                'rec'=>$bossId,
                 'interviews'   => unserialize( $job->interviews),
                'jobdescription'   =>   $job->jobdescription
        );
         \Mail::to($bossEmail)->send(new \App\Mail\employeerequisitionapproveemail($data));
                  // Alert::success('Success','You  have made approvals  successfully');
                  // return back();   
        Alert::success('Success',' Requisition  has been approved successfully');
                 return redirect()->route('employeerequisitions.approvesmessage')->with('success',' Requisition  has been approved successfully');                         
 }
    /**  
     * aproved by approver Hr executive
     * 
     * */
 public function approve($id){
$checkaction=DB::table('employeerequisitions')
            ->where('id', $id)
            ->first();
            if ($checkaction->action ==2 || $checkaction->action ==3 ||$checkaction->action ==4) {
         Alert::success('Success',' Requisition  Action has already occured!!');
         return redirect()->route('tabspage');
            }
 $companyinitator=DB::table('requsitionsapprovals')
                    ->where('requsitionsapprovals.jobid', $id)
                    ->where('requsitionsapprovals.initiator', 'initiator')
                    ->first();
                    // dd($companyinitator);
$company_id=$companyinitator->company_id;   
    $approve1=DB::table('employeerequisitions')
             ->where('id',$id)
             ->update(['stage1' => "1", 'action'=>'2']);

     $job = EmployeeRequisition::find($id);
     $ldate = date('Y-m-d H:i:s');
    $storeapprove1=DB::table('requsitionsapprovals')
                              ->insert([
                                     'jobid' => $id,
                                     'userId' => Auth::user()->id,
                                     'date'=>$ldate,
                                    ]);


           $towhomtosendemail=DB::table('requsitionsapprovals')
                         ->join('users', 'users.id', '=', 'requsitionsapprovals.userId')
                         ->where('requsitionsapprovals.jobid', $id)
                          ->get(); 
            //send email to notify those in the back
             foreach($towhomtosendemail as $usersemails)
             { 
                 $data = array(
                'user'=>Auth::user()->id, 
                'username'=>Auth::user()->name,  
                'id'=> $job->id,
                 'stages'=> [
                                'HR Recruitment Team'=>$job->stages,
                                'HR Manager'=>$job->stage1,'Executive Lead'=>$job->stage2,
                                'Group CEO'=>$job->stage3
                        ],
                'company_id'=>$company_id,
                'jobtittle'      =>  $job->jobtittle,
                'positions'      =>  $job->positions,
                'employementtype'      =>  $job->employementtype,
                'salary'      =>  $job->salary,
                // 'salaryto'      =>  $job->salaryto,
                'responsibilities'      =>  $job->responsibilities,
                'posrequirements'      =>  $job->posrequirements,
                'posskills'      =>  $job->posskills,
                'location'   =>   $job->location,
                'jobcategory'   =>   $job->jobcategory,
                'intenting'   =>   unserialize($job->intenting),
                'startdate'   =>   $job->startdate,
                'manager'   =>   $job->manager,
                'pwd'   =>   $job->pwd,
                'rec'=>$usersemails->id,
                 'interviews'   => unserialize( $job->interviews),
                'jobdescription'   =>   $job->jobdescription
        );
                //dd($usersemails->email);
                  // mail back to hiring manager 
              \Mail::to($usersemails->email)->send(new \App\Mail\employeerequisitionapprovenotify($data));
            } 
              // check the company of the initiator
         $initiatorcompany=DB::table('requsitionsapprovals')
                                 ->join('users', 'users.id','=' ,'requsitionsapprovals.userId')
                                 ->join('companies', 'companies.id', '=', 'users.company_id')
                                 ->where('requsitionsapprovals.jobid', $id)
                                 ->where('requsitionsapprovals.initiator', 'initiator')
                                 ->first()->company_id;

        $bossId = DB::table("employeerequisitionusers")->where("company_id","=",$initiatorcompany)->where("employeetype","=","Executive Lead")->first()->userId;
        $bossEmail = DB::table("users")->where("id","=",$bossId)->first()->email;
                    $data = array(
                'user'=>Auth::user()->id, 
                'username'=>Auth::user()->name,  
                'id'=> $job->id,
                 'stages'=> [
                                'HR Recruitment Team'=>$job->stages,
                                'HR Manager'=>$job->stage1,'Executive Lead'=>$job->stage2,
                                'Group CEO'=>$job->stage3
                        ],
                'company_id'=>$company_id,
                'jobtittle'      =>  $job->jobtittle,
                'positions'      =>  $job->positions,
                'employementtype'      =>  $job->employementtype,
                'salary'      =>  $job->salary,
                // 'salaryto'      =>  $job->salaryto,
                'responsibilities'      =>  $job->responsibilities,
                'posrequirements'      =>  $job->posrequirements,
                'posskills'      =>  $job->posskills,
                'location'   =>   $job->location,
                'jobcategory'   =>   $job->jobcategory,
                'intenting'   =>   unserialize($job->intenting),
                'startdate'   =>   $job->startdate,
                'manager'   =>   $job->manager,
                'pwd'   =>   $job->pwd,
                'rec'=>$bossId,
                 'interviews'   => unserialize( $job->interviews),
                'jobdescription'   =>   $job->jobdescription
        );
         \Mail::to($bossEmail)->send(new \App\Mail\employeerequisitionapprove($data));
                  // Alert::success('Success','You  have made approvals  successfully');
                  // return back();   
        Alert::success('Success',' Requisition  has been approved successfully');
         return redirect()->route('tabspage');                    
 }
  /** ceo approving when the recruiter initiate onbehalf of hiring manager via email
  * 
  * */
  public function ceoapprovingtoexerectohiring1($id, $rec){
 $checkaction=DB::table('employeerequisitions')
            ->where('id', $id)
            ->first();
            if ($checkaction->action ==4) {
         Alert::success('Success',' Requisition  Action has already occured!!');
         return redirect()->route('employeerequisitions.approvesmessage')->with('success','Requisition  Action has already occured!!');
            }
$companyinitator=DB::table('requsitionsapprovals')
                    ->where('requsitionsapprovals.jobid', $id)
                    ->orwhere('requsitionsapprovals.initiator', 'initiator')
                    ->first();
                    //dd($companyinitator);
      $company_id=$companyinitator->company_id;
        $job = EmployeeRequisition::find($id);
        $ldate = date('Y-m-d H:i:s');
               $storeapprove1=DB::table('requsitionsapprovals')
                              ->insert([
                                     'jobid' => $id,
                                     'userId' => $rec,
                                     'date'=>$ldate,
                                    ]);

     //store that it has been approved by the final approver
       $towhomtosendemail=DB::table('requsitionsapprovals')
                         ->join('users', 'users.id', '=', 'requsitionsapprovals.userId')
                         ->where('requsitionsapprovals.jobid', $id)
                          ->get();              
             foreach($towhomtosendemail as $usersemails)
             { 
                            $data = array(
                'user'=>$rec,  
                'id'=> $job->id,
                'stages'=> [
                                'HR Recruitment Team'=>$job->stages,
                                'HR Manager'=>$job->stage1,'Executive Lead'=>$job->stage2,
                                'Group CEO'=>$job->stage3
                        ],
                'company_id'=>$company_id,
                'jobtittle'      =>  $job->jobtittle,
                'positions'      =>  $job->positions,
                'employementtype'      =>  $job->employementtype,
                'salary'      =>  $job->salary,
                // 'salaryto'      =>  $job->salaryto,
                'responsibilities'      =>  $job->responsibilities,
                'posrequirements'      =>  $job->posrequirements,
                'posskills'      =>  $job->posskills,
                'location'   =>   $job->location,
                'jobcategory'   =>   $job->jobcategory,
               'intenting'   =>   unserialize($job->intenting),
                'startdate'   =>   $job->startdate,
                'manager'   =>   $job->manager,
                'pwd'   =>   $job->pwd,
                'rec'=>$usersemails->id,
                 'interviews'   => unserialize( $job->interviews),
                'jobdescription'   =>   $job->jobdescription
        );
                //dd($usersemails->email);
                \Mail::to($usersemails->email)->send(new \App\Mail\ceoapprovingtorechiringemail($data));
            }

        $approve1=DB::table('employeerequisitions')
             ->where('id',$id)
             ->update(['stage3' => "1",
                        'approved_status'=>"1", 'action'=>'4'
              ]);
            // Alert::success('Success','Chief CEO approvals have been made successfully');
            // return back();
        Alert::success('Success',' Requisition  has been approved successfully');
          return redirect()->route('employeerequisitions.approvesmessage')->with('success','Requisition  has been approved successfully');
 }
 /** ceo approving when the recruiter initiate onbehalf of hiring manager
  * 
  * */
  public function ceoapprovingtoexerectohiring($id){
 $checkaction=DB::table('employeerequisitions')
            ->where('id', $id)
            ->first();
            if ($checkaction->action ==4) {
         Alert::success('Success',' Requisition  Action has already occured!!');
         return redirect()->route('tabspage');
            }
    Auth::user()->id;
$companyinitator=DB::table('requsitionsapprovals')
                    ->where('requsitionsapprovals.jobid', $id)
                    ->orwhere('requsitionsapprovals.initiator', 'initiator')
                    ->first();
                    //dd($companyinitator);
      $company_id=$companyinitator->company_id;
        $job = EmployeeRequisition::find($id);
        $ldate = date('Y-m-d H:i:s');
               $storeapprove1=DB::table('requsitionsapprovals')
                              ->insert([
                                     'jobid' => $id,
                                     'userId' => Auth::user()->id,
                                     'date'=>$ldate,
                                    ]);
     //store that it has been approved by the final approver
       $towhomtosendemail=DB::table('requsitionsapprovals')
                         ->join('users', 'users.id', '=', 'requsitionsapprovals.userId')
                         ->where('requsitionsapprovals.jobid', $id)
                          ->get();              
             foreach($towhomtosendemail as $usersemails)
             { 
                 $data = array(
                'user'=>Auth::user()->id, 
                'id'=> $job->id,
                  'stages'=> [
                                'HR Recruitment Team'=>$job->stages,
                                'HR Manager'=>$job->stage1,'Executive Lead'=>$job->stage2,
                                'Group CEO'=>$job->stage3
                        ],
                'company_id'=>$company_id,
                'jobtittle'      =>  $job->jobtittle,
                'positions'      =>  $job->positions,
                'employementtype'      =>  $job->employementtype,
                'salary'      =>  $job->salary,
                // 'salaryto'      =>  $job->salaryto,
                'responsibilities'      =>  $job->responsibilities,
                'posrequirements'      =>  $job->posrequirements,
                'posskills'      =>  $job->posskills,
                'location'   =>   $job->location,
                'jobcategory'   =>   $job->jobcategory,
               'intenting'   =>   unserialize($job->intenting),
                'startdate'   =>   $job->startdate,
                'manager'   =>   $job->manager,
                'pwd'   =>   $job->pwd,
                'rec'=>$usersemails->id,
                'interviews'   => unserialize( $job->interviews),
                'jobdescription'   =>   $job->jobdescription
        );
                //dd($usersemails->email);
                \Mail::to($usersemails->email)->send(new \App\Mail\ceoapprovingtorechiring($data));
            }

        $approve1=DB::table('employeerequisitions')
             ->where('id',$id)
             ->update(['stage3' => "1",
                        'approved_status'=>"1", 'action'=>'4'
              ]);
            // Alert::success('Success','Chief CEO approvals have been made successfully');
            // return back();
        Alert::success('Success',' Requisition  has been approved successfully');
         return redirect()->route('tabspage');
 }
  /**
  * executive approving to ceo when the recruiter is the initiator to hiring first approver vial emails execapprovingtoexerectohiring
  * 
  * */
public function execapprovingtoexerectohiring1($id, $rec){

 $checkaction=DB::table('employeerequisitions')
             ->where('id', $id)
             ->first();
             if ($checkaction->action ==3 ||$checkaction->action ==4||$checkaction->action ==5) {
                 Alert::success('Success',' Requisition Actions Has already occured!!');
            return redirect()->route('employeerequisitions.approvesmessage')->with('success','Requisition Actions Has already occured!!');  
                }   
  
  $companyinitator=DB::table('requsitionsapprovals')
                    ->where('requsitionsapprovals.jobid', $id)
                    ->where('requsitionsapprovals.initiator', 'initiator')
                    ->first();
                    //dd($companyinitator);
      $company_id=$companyinitator->company_id;
    $approve1=DB::table('employeerequisitions')
             ->where('id',$id)
             ->update(['stage2' => "1", 'action'=>'3']);

           $job = EmployeeRequisition::find($id);
    $ldate = date('Y-m-d H:i:s');
    $storeapprove1=DB::table('requsitionsapprovals')
                              ->insert([
                                     'jobid' => $id,
                                     'userId' => $rec,
                                     'date'=>$ldate,
                                    ]);

   //store that it has been approved

        $towhomtosendemail=DB::table('requsitionsapprovals')
                         ->join('users', 'users.id', '=', 'requsitionsapprovals.userId')
                         ->where('requsitionsapprovals.jobid', $id)
                          ->get(); 
             //send email to notify those in the back
             foreach($towhomtosendemail as $usersemails)
             { 
             $data = array(
                'user'=>$rec, 
                'id'=> $job->id,
                  'stages'=> [
                                'HR Recruitment Team'=>$job->stages,
                                'HR Manager'=>$job->stage1,'Executive Lead'=>$job->stage2,
                                'Group CEO'=>$job->stage3
                        ],
                'company_id'=>$company_id,
                'jobtittle'      =>  $job->jobtittle,
                'positions'      =>  $job->positions,
                'employementtype'      =>  $job->employementtype,
                'salary'      =>  $job->salary,
                // 'salaryto'      =>  $job->salaryto,
                'responsibilities'      =>  $job->responsibilities,
                'posrequirements'      =>  $job->posrequirements,
                'posskills'      =>  $job->posskills,
                'location'   =>   $job->location,
                'jobcategory'   =>   $job->jobcategory,
               'intenting'   =>   unserialize($job->intenting),
                'startdate'   =>   $job->startdate,
                'manager'   =>   $job->manager,
                'pwd'   =>   $job->pwd,
                'rec'=>$usersemails->id,
                'interviews'   => unserialize( $job->interviews),
                'jobdescription'   =>   $job->jobdescription
        );
                //dd($usersemails->email);
                \Mail::to($usersemails->email)->send(new \App\Mail\execapprovingtoexerectohiringnotifyemail($data));
            }    
            //proceed to send email to the group CEO client 
            $sendmailtogroupceo=DB::table('employeerequisitionusers')
                               ->join('users', 'users.id','=', 'employeerequisitionusers.userId')
                               ->where('employeerequisitionusers.employeetype', 'Group CEO')   
                               ->first();
                               //dd($sendmailtogroupceo);    
         $data = array(
                'user'=>$rec, 
                'id'=> $job->id,
                  'stages'=> [
                                'HR Recruitment Team'=>$job->stages,
                                'HR Manager'=>$job->stage1,'Executive Lead'=>$job->stage2,
                                'Group CEO'=>$job->stage3
                        ],
                'company_id'=>$company_id,
                'jobtittle'      =>  $job->jobtittle,
                'positions'      =>  $job->positions,
                'employementtype'      =>  $job->employementtype,
                'salary'      =>  $job->salary,
                // 'salaryto'      =>  $job->salaryto,
                'responsibilities'      =>  $job->responsibilities,
                'posrequirements'      =>  $job->posrequirements,
                'posskills'      =>  $job->posskills,
                'location'   =>   $job->location,
                'jobcategory'   =>   $job->jobcategory,
               'intenting'   =>   unserialize($job->intenting),
                'startdate'   =>   $job->startdate,
                'manager'   =>   $job->manager,
                'pwd'   =>   $job->pwd,
                'rec'=>$sendmailtogroupceo->id,
                'interviews'   => unserialize( $job->interviews),
                'jobdescription'   =>   $job->jobdescription
        );
              \Mail::to($sendmailtogroupceo->email)->send(new \App\Mail\execapprovingtoexerectohiringemail($data));
        Alert::success('Success',' Requisition has been approved  successfully');
         return redirect()->route('employeerequisitions.approvesmessage')->with('success','Requisition has been approved  successfully.');
                     // return back();
 }
 /**
  * executive approving to ceo when the recruiter is the initiator to hiring first approver execapprovingtoexerectohiring
  * 
  * */
 public function execapprovingtoexerectohiring($id){

 $checkaction=DB::table('employeerequisitions')
             ->where('id', $id)
             ->first();
             if ($checkaction->action ==3 ||$checkaction->action ==4||$checkaction->action ==5) {
                 Alert::success('Success',' Requisition Actions Has already occured!!');
            return redirect()->route('tabspage');
                }   
  
  $companyinitator=DB::table('requsitionsapprovals')
                    ->where('requsitionsapprovals.jobid', $id)
                    ->where('requsitionsapprovals.initiator', 'initiator')
                    ->first();
                    //dd($companyinitator);
      $company_id=$companyinitator->company_id;
    $approve1=DB::table('employeerequisitions')
             ->where('id',$id)
             ->update(['stage2' => "1", 'action'=>'3']);

           $job = EmployeeRequisition::find($id);
    $ldate = date('Y-m-d H:i:s');
    $storeapprove1=DB::table('requsitionsapprovals')
                              ->insert([
                                     'jobid' => $id,
                                     'userId' => Auth::user()->id,
                                     'date'=>$ldate,
                                    ]);

   //store that it has been approved

        // $towhomtosendemail=DB::table('requsitionsapprovals')
        //                  ->join('users', 'users.id', '=', 'requsitionsapprovals.userId')
        //                  ->where('requsitionsapprovals.jobid', $id)
        //                   ->get(); 
        //      //send email to notify those in the back
        //      foreach($towhomtosendemail as $usersemails)
        //      { 
        //         //dd($usersemails->email);
        //         \Mail::to($usersemails->email)->send(new \App\Mail\execapprovinghrinitiatornotify($data));
        //     }    
            //proceed to send email to the group CEO client 
            $sendmailtogroupceo=DB::table('employeerequisitionusers')
                               ->join('users', 'users.id','=', 'employeerequisitionusers.userId')
                               ->where('employeerequisitionusers.employeetype', 'Group CEO')   
                               ->first();
                               //dd($sendmailtogroupceo);  
                $data = array(
                'user'=>Auth::user()->id, 
                'username'=>Auth::user()->name,  
                'id'=> $job->id,
                  'stages'=> [
                                'HR Recruitment Team'=>$job->stages,
                                'HR Manager'=>$job->stage1,'Executive Lead'=>$job->stage2,
                                'Group CEO'=>$job->stage3
                        ],
                'company_id'=>$company_id,
                'jobtittle'      =>  $job->jobtittle,
                'positions'      =>  $job->positions,
                'employementtype'      =>  $job->employementtype,
                'salary'      =>  $job->salary,
                // 'salaryto'      =>  $job->salaryto,
                'responsibilities'      =>  $job->responsibilities,
                'posrequirements'      =>  $job->posrequirements,
                'posskills'      =>  $job->posskills,
                'location'   =>   $job->location,
                'jobcategory'   =>   $job->jobcategory,
               'intenting'   =>   unserialize($job->intenting),
                'startdate'   =>   $job->startdate,
                'manager'   =>   $job->manager,
                'pwd'   =>   $job->pwd,
                'rec'=>$sendmailtogroupceo->id,
                'interviews'   => unserialize( $job->interviews),
                'jobdescription'   =>   $job->jobdescription
        );  
              \Mail::to($sendmailtogroupceo->email)->send(new \App\Mail\execapprovingtoexerectohiring($data));
        Alert::success('Success',' Requisition has been approved  successfully');
        return redirect()->route('tabspage');
                     // return back();
 }
 /*** hr manager approving to exec when the recruiter is the initiator to hiring manager vial email hrapprovingtoexerectohiring
 * 
 * */
 public function hrapprovingtoexerectohiring1($id, $rec){
$checkaction=DB::table('employeerequisitions')
            ->where('id', $id)
            ->first();
            if ($checkaction->action ==2 || $checkaction->action ==3 ||$checkaction->action ==4||$checkaction->action ==5) {
         Alert::success('Success',' Requisition  Action has already occured!!');
         return redirect()->route('employeerequisitions.approvesmessage')->with('success','Requisition  Action has already occured!!');
            }
 $companyinitator=DB::table('requsitionsapprovals')
                    ->where('requsitionsapprovals.jobid', $id)
                    ->where('requsitionsapprovals.initiator', 'initiator')
                    ->first();
                    // dd($companyinitator);
$company_id=$companyinitator->company_id;   
    $approve1=DB::table('employeerequisitions')
             ->where('id',$id)
             ->update(['stage1' => "2", 'action'=>'2']);

     $job = EmployeeRequisition::find($id);
     $ldate = date('Y-m-d H:i:s');
    $storeapprove1=DB::table('requsitionsapprovals')
                              ->insert([
                                     'jobid' => $id,
                                     'userId' => $rec,
                                     'date'=>$ldate,
                                    ]);


          
              // check the company of the initiator
         $initiatorcompany=DB::table('requsitionsapprovals')
                                 ->join('users', 'users.id','=' ,'requsitionsapprovals.userId')
                                 ->join('companies', 'companies.id', '=', 'users.company_id')
                                 ->where('requsitionsapprovals.jobid', $id)
                                 ->where('requsitionsapprovals.initiator', 'initiator')
                                 ->first()->company_id;

        $bossId = DB::table("employeerequisitionusers")->where("company_id","=",$initiatorcompany)->where("employeetype","=","Executive Lead")->first()->userId;
        $bossEmail = DB::table("users")->where("id","=",$bossId)->first()->email;
                   $data = array(
                'user'=>$rec,  
                'id'=> $job->id,
                 'stages'=> [
                                'HR Recruitment Team'=>$job->stages,
                                'HR Manager'=>$job->stage1,'Executive Lead'=>$job->stage2,
                                'Group CEO'=>$job->stage3
                        ],
                'company_id'=>$company_id,
                'jobtittle'      =>  $job->jobtittle,
                'positions'      =>  $job->positions,
                'employementtype'      =>  $job->employementtype,
                'salary'      =>  $job->salary,
                // 'salaryto'      =>  $job->salaryto,
                'responsibilities'      =>  $job->responsibilities,
                'posrequirements'      =>  $job->posrequirements,
                'posskills'      =>  $job->posskills,
                'location'   =>   $job->location,
                'jobcategory'   =>   $job->jobcategory,
                'intenting'   =>   unserialize($job->intenting),
                'startdate'   =>   $job->startdate,
                'manager'   =>   $job->manager,
                'pwd'   =>   $job->pwd,
                'rec'=>$bossId,
                 'interviews'   => unserialize( $job->interviews),
                'jobdescription'   =>   $job->jobdescription
        );
         \Mail::to($bossEmail)->send(new \App\Mail\hrapprovingtoexerectohiringemail($data));  



          $towhomtosendemail=DB::table('requsitionsapprovals')
                         ->join('users', 'users.id', '=', 'requsitionsapprovals.userId')
                         ->where('requsitionsapprovals.jobid', $id)
                          ->get(); 
            //send email to notify those in the back
             foreach($towhomtosendemail as $usersemails)
             { 
                 $data = array(
                'user'=>$rec,  
                'id'=> $job->id,
                 'stages'=> [
                                'HR Recruitment Team'=>$job->stages,
                                'HR Manager'=>$job->stage1,'Executive Lead'=>$job->stage2,
                                'Group CEO'=>$job->stage3
                        ],
                'company_id'=>$company_id,
                'jobtittle'      =>  $job->jobtittle,
                'positions'      =>  $job->positions,
                'employementtype'      =>  $job->employementtype,
                'salary'      =>  $job->salary,
                // 'salaryto'      =>  $job->salaryto,
                'responsibilities'      =>  $job->responsibilities,
                'posrequirements'      =>  $job->posrequirements,
                'posskills'      =>  $job->posskills,
                'location'   =>   $job->location,
                'jobcategory'   =>   $job->jobcategory,
                'intenting'   =>   unserialize($job->intenting),
                'startdate'   =>   $job->startdate,
                'manager'   =>   $job->manager,
                'pwd'   =>   $job->pwd,
                'rec'=>$usersemails->id,
                 'interviews'   => unserialize( $job->interviews),
                'jobdescription'   =>   $job->jobdescription
        );
                //dd($usersemails->email);
                  // mail back to hiring manager 
              \Mail::to($usersemails->email)->send(new \App\Mail\hrapprovingtoexerectohiringnotifyemail($data));
            } 
        Alert::success('Success',' Requisition  has been approved successfully');
           return redirect()->route('employeerequisitions.approvesmessage')->with('success','Requisition  has been approved successfully');                         
 }
/*** hr manager approving to exec when the recruiter is the initiator to hiring manager hrapprovingtoexerectohiring
 * 
 * */

public function hrapprovingtoexerectohiring($id){
$checkaction=DB::table('employeerequisitions')
            ->where('id', $id)
            ->first();
            if ($checkaction->action ==2 ||$checkaction->action ==3||$checkaction->action ==4||$checkaction->action ==5) {
         Alert::success('Success',' Requisition  Action has already occured!!');
         return redirect()->route('tabspage');
            }
 $companyinitator=DB::table('requsitionsapprovals')
                    ->where('requsitionsapprovals.jobid', $id)
                    ->where('requsitionsapprovals.initiator', 'initiator')
                    ->first();
                    // dd($companyinitator);
$company_id=$companyinitator->company_id;   
    $approve1=DB::table('employeerequisitions')
             ->where('id',$id)
             ->update(['stage1' => "2", 'action'=>'2']);

     $job = EmployeeRequisition::find($id);
     $ldate = date('Y-m-d H:i:s');
    $storeapprove1=DB::table('requsitionsapprovals')
                              ->insert([
                                     'jobid' => $id,
                                     'userId' => Auth::user()->id,
                                     'date'=>$ldate,
                                    ]);

  
         $initiatorcompany=DB::table('requsitionsapprovals')
                                 ->join('users', 'users.id','=' ,'requsitionsapprovals.userId')
                                 ->join('companies', 'companies.id', '=', 'users.company_id')
                                 ->where('requsitionsapprovals.jobid', $id)
                                 ->where('requsitionsapprovals.initiator', 'initiator')
                                 ->first()->company_id;

        $bossId = DB::table("employeerequisitionusers")->where("company_id","=",$initiatorcompany)->where("employeetype","=","Executive Lead")->first()->userId;
                    $data = array(
                'user'=>Auth::user()->id, 
                'username'=>Auth::user()->name,  
                'id'=> $job->id,
                 'stages'=> [
                                'HR Recruitment Team'=>$job->stages,
                                'HR Manager'=>$job->stage1,'Executive Lead'=>$job->stage2,
                                'Group CEO'=>$job->stage3
                        ],
                'company_id'=>$company_id,
                'jobtittle'      =>  $job->jobtittle,
                'positions'      =>  $job->positions,
                'employementtype'      =>  $job->employementtype,
                'salary'      =>  $job->salary,
                // 'salaryto'      =>  $job->salaryto,
                'responsibilities'      =>  $job->responsibilities,
                'posrequirements'      =>  $job->posrequirements,
                'posskills'      =>  $job->posskills,
                'location'   =>   $job->location,
                'jobcategory'   =>   $job->jobcategory,
                'intenting'   =>   unserialize($job->intenting),
                'startdate'   =>   $job->startdate,
                'manager'   =>   $job->manager,
                'pwd'   =>   $job->pwd,
                'rec'=>$bossId,
                 'interviews'   => unserialize( $job->interviews),
                'jobdescription'   =>   $job->jobdescription
        );
        $bossEmail = DB::table("users")->where("id","=",$bossId)->first()->email;
         \Mail::to($bossEmail)->send(new \App\Mail\hrapprovingtoexerectohiring($data));  
        Alert::success('Success',' Requisition  has been approved successfully');
        return redirect()->route('tabspage');                   
 }

 /** hiring manager approving to hr recruiter intiator on behalf of hiringmanager
  * */
 public function hiringapprovingtohr1($id, $rec){
    $checkaction=DB::table('employeerequisitions')
            ->where('id', $id)
            ->first();
            if ($checkaction->action ==1||$checkaction->action ==2 ||$checkaction->action ==3 ||$checkaction->action ==4||$checkaction->action ==5) {
         Alert::success('Success',' Requisition  Action has already occured!!');
         return redirect()->route('employeerequisitions.approvesmessage')->with('success',' Requisition  Action has already occured!!');
            }
 $companyinitator=DB::table('requsitionsapprovals')
                    ->where('requsitionsapprovals.jobid', $id)
                    ->where('requsitionsapprovals.initiator', 'initiator')
                    ->first();
                    // dd($companyinitator);
      $company_id=$companyinitator->company_id;

    $approve1=DB::table('employeerequisitions')
             ->where('id',$id)
             ->update(['stage1' => "1", 'action'=>'1']);

     $job = EmployeeRequisition::find($id);
     $ldate = date('Y-m-d H:i:s');
    $storeapprove1=DB::table('requsitionsapprovals')
                              ->insert([
                                     'jobid' => $id,
                                     'userId' => $rec,
                                     'date'=>$ldate,
                                    ]);

         $initiatorcompany=DB::table('requsitionsapprovals')
                                 ->join('users', 'users.id','=' ,'requsitionsapprovals.userId')
                                 ->join('companies', 'companies.id', '=', 'users.company_id')
                                 ->where('requsitionsapprovals.jobid', $id)
                                 ->where('requsitionsapprovals.initiator', 'initiator')
                                 ->first()->company_id;

        $bossId = DB::table("employeerequisitionusers")->where("employeetype","=","HR Manager")->first()->userId;
        $bossEmail = DB::table("users")->where("id","=",$bossId)->first()->email;
                $data = array(
                'user'=>$rec,  
                'id'=> $job->id,
                 'stages'=> [
                                'HR Recruitment Team'=>$job->stages,
                                'HR Manager'=>$job->stage1,'Executive Lead'=>$job->stage2,
                                'Group CEO'=>$job->stage3
                        ],
                'company_id'=>$company_id,
                'jobtittle'      =>  $job->jobtittle,
                'positions'      =>  $job->positions,
                'employementtype'      =>  $job->employementtype,
                'salary'      =>  $job->salary,
                // 'salaryto'      =>  $job->salaryto,
                'responsibilities'      =>  $job->responsibilities,
                'posrequirements'      =>  $job->posrequirements,
                'posskills'      =>  $job->posskills,
                'location'   =>   $job->location,
                'jobcategory'   =>   $job->jobcategory,
                'intenting'   =>   unserialize($job->intenting),
                'startdate'   =>   $job->startdate,
                'manager'   =>   $job->manager,
                'pwd'   =>   $job->pwd,
                'rec'=>$bossId,
                'interviews'   => unserialize( $job->interviews),
                'jobdescription'   =>   $job->jobdescription
        );
         \Mail::to($bossEmail)->send(new \App\Mail\hiringapprovingtohremail($data));

           $towhomtosendemail=DB::table('requsitionsapprovals')
                         ->join('users', 'users.id', '=', 'requsitionsapprovals.userId')
                         ->where('requsitionsapprovals.jobid', $id)
                          ->get(); 
            //send email to notify those in the back
             foreach($towhomtosendemail as $usersemails)
             { 
             $data = array(
                'user'=>$rec,  
                'id'=> $job->id,
                 'stages'=> [
                                'HR Recruitment Team'=>$job->stages,
                                'HR Manager'=>$job->stage1,'Executive Lead'=>$job->stage2,
                                'Group CEO'=>$job->stage3
                        ],
                'company_id'=>$company_id,
                'jobtittle'      =>  $job->jobtittle,
                'positions'      =>  $job->positions,
                'employementtype'      =>  $job->employementtype,
                'salary'      =>  $job->salary,
                // 'salaryto'      =>  $job->salaryto,
                'responsibilities'      =>  $job->responsibilities,
                'posrequirements'      =>  $job->posrequirements,
                'posskills'      =>  $job->posskills,
                'location'   =>   $job->location,
                'jobcategory'   =>   $job->jobcategory,
                'intenting'   =>   unserialize($job->intenting),
                'startdate'   =>   $job->startdate,
                'manager'   =>   $job->manager,
                'pwd'   =>   $job->pwd,
                'rec'=>$usersemails->id,
                'interviews'   => unserialize( $job->interviews),
                'jobdescription'   =>   $job->jobdescription
        );
                //dd($usersemails->email);
                  // mail back to hiring manager 
              \Mail::to($usersemails->email)->send(new \App\Mail\hiringapprovingtohrnotifyemail($data));
            } 
              
                             Alert::success('Success',' Requisition has been approved successfully');
         return redirect()->route('employeerequisitions.approvesmessage')->with('success','Requisition has been approved successfully');
                           
 }
/** 
 * hiring manager approving to Hr when hr recruiter is the initiator hiringapprovingtohr
 * */
public function hiringapprovingtohr($id){
    $checkaction=DB::table('employeerequisitions')
            ->where('id', $id)
            ->first();
            if ($checkaction->action ==1||$checkaction->action ==2 ||$checkaction->action ==3 ||$checkaction->action ==4||$checkaction->action ==5) {
         Alert::success('Success',' Requisition  Action has already occured!!');
        return redirect()->route('tabspage');
            }
 $companyinitator=DB::table('requsitionsapprovals')
                    ->where('requsitionsapprovals.jobid', $id)
                    ->where('requsitionsapprovals.initiator', 'initiator')
                    ->first();
                    // dd($companyinitator);
      $company_id=$companyinitator->company_id;

    $approve1=DB::table('employeerequisitions')
             ->where('id',$id)
             ->update(['stage1' => "1", 'action'=>'1']);

     $job = EmployeeRequisition::find($id);
     $ldate = date('Y-m-d H:i:s');
    $storeapprove1=DB::table('requsitionsapprovals')
                              ->insert([
                                     'jobid' => $id,
                                     'userId' => Auth::user()->id,
                                     'date'=>$ldate,
                                    ]);
         $initiatorcompany=DB::table('requsitionsapprovals')
                                 ->join('users', 'users.id','=' ,'requsitionsapprovals.userId')
                                 ->join('companies', 'companies.id', '=', 'users.company_id')
                                 ->where('requsitionsapprovals.jobid', $id)
                                 ->where('requsitionsapprovals.initiator', 'initiator')
                                 ->first()->company_id;

        $bossId = DB::table("employeerequisitionusers")->where("company_id","=",$initiatorcompany)->where("employeetype","=","HR Manager")->first()->userId;
        $data = array(
                'user'=>Auth::user()->id, 
                'username'=>Auth::user()->name,  
                'id'=> $job->id,
                 'stages'=> [
                                'HR Recruitment Team'=>$job->stages,
                                'HR Manager'=>$job->stage1,'Executive Lead'=>$job->stage2,
                                'Group CEO'=>$job->stage3
                        ],
                'company_id'=>$company_id,
                'jobtittle'      =>  $job->jobtittle,
                'positions'      =>  $job->positions,
                'employementtype'      =>  $job->employementtype,
                'salary'      =>  $job->salary,
                // 'salaryto'      =>  $job->salaryto,
                'responsibilities'      =>  $job->responsibilities,
                'posrequirements'      =>  $job->posrequirements,
                'posskills'      =>  $job->posskills,
                'location'   =>   $job->location,
                'jobcategory'   =>   $job->jobcategory,
                'intenting'   =>   unserialize($job->intenting),
                'startdate'   =>   $job->startdate,
                'manager'   =>   $job->manager,
                'pwd'   =>   $job->pwd,
                'rec'=>$bossId,
                'interviews'   => unserialize( $job->interviews),
                'jobdescription'   =>   $job->jobdescription
        );
        $bossEmail = DB::table("users")->where("id","=",$bossId)->first()->email;
         \Mail::to($bossEmail)->send(new \App\Mail\hiringapprovingtohr($data));

           // $towhomtosendemail=DB::table('requsitionsapprovals')
           //               ->join('users', 'users.id', '=', 'requsitionsapprovals.userId')
           //               ->where('requsitionsapprovals.jobid', $id)
           //                ->get(); 
           //  //send email to notify those in the back
           //   foreach($towhomtosendemail as $usersemails)
           //   { 
           //      //dd($usersemails->email);
           //        // mail back to hiring manager 
           //    \Mail::to($usersemails->email)->send(new \App\Mail\hrapprovingtoexecnotify($data));
           //  } 
              
                             Alert::success('Success',' Requisition has been approved successfully');
         return redirect()->route('tabspage');
                           
 }
 /* approves from hr to exec if the initiator is the recruiter
 */
  public function hrapprovingtoexec1($id, $rec){
    $checkaction=DB::table('employeerequisitions')
            ->where('id', $id)
            ->first();
            if ($checkaction->action ==1 ||$checkaction->action ==2 ||$checkaction->action ==3) {
         Alert::success('Success',' Requisition  Action has already occured!!');
         return redirect()->route('employeerequisitions.approvesmessage')->with('success','Requisition  Action has already occured!!.');
            }
 $companyinitator=DB::table('requsitionsapprovals')
                    ->where('requsitionsapprovals.jobid', $id)
                    ->where('requsitionsapprovals.initiator', 'initiator')
                    ->first();
                    // dd($companyinitator);
      $company_id=$companyinitator->company_id;

    $approve1=DB::table('employeerequisitions')
             ->where('id',$id)
             ->update(['stage1' => "1", 'action'=>'1']);

     $job = EmployeeRequisition::find($id);
     $ldate = date('Y-m-d H:i:s');
    $storeapprove1=DB::table('requsitionsapprovals')
                              ->insert([
                                     'jobid' => $id,
                                     'userId' => $rec,
                                     'date'=>$ldate,
                                    ]);

         $initiatorcompany=DB::table('requsitionsapprovals')
                                 ->join('users', 'users.id','=' ,'requsitionsapprovals.userId')
                                 ->join('companies', 'companies.id', '=', 'users.company_id')
                                 ->where('requsitionsapprovals.jobid', $id)
                                 ->where('requsitionsapprovals.initiator', 'initiator')
                                 ->first()->company_id;

                                

        $bossId = DB::table("employeerequisitionusers")->where("company_id",$initiatorcompany)->where("employeetype","=","Executive Lead")->first()->userId;
        $bossEmail = DB::table("users")->where("id","=",$bossId)->first();
                    $data = array(
                'user'=>$rec, 
                // 'username'=>Auth::user()->name,  
                'id'=> $job->id,
                 'stages'=> [
                                'HR Recruitment Team'=>$job->stages,
                                'HR Manager'=>$job->stage1,'Executive Lead'=>$job->stage2,
                                'Group CEO'=>$job->stage3
                        ],
                'company_id'=>$company_id,
                'jobtittle'      =>  $job->jobtittle,
                'positions'      =>  $job->positions,
                'employementtype'      =>  $job->employementtype,
                'salary'      =>  $job->salary,
                // 'salaryto'      =>  $job->salaryto,
                'responsibilities'      =>  $job->responsibilities,
                'posrequirements'      =>  $job->posrequirements,
                'posskills'      =>  $job->posskills,
                'location'   =>   $job->location,
                'jobcategory'   =>   $job->jobcategory,
                'intenting'   =>   unserialize($job->intenting),
                'startdate'   =>   $job->startdate,
                'manager'   =>   $job->manager,
                'pwd'   =>   $job->pwd,
                'rec'=>$bossId,
                'interviews'   => unserialize( $job->interviews),
                'jobdescription'   =>   $job->jobdescription

        );
         \Mail::to($bossEmail->email)->send(new \App\Mail\hrapprovingexecemail($data));

           $towhomtosendemail=DB::table('requsitionsapprovals')
                         ->join('users', 'users.id', '=', 'requsitionsapprovals.userId')
                         ->where('requsitionsapprovals.jobid', $id)
                          ->get(); 
            //send email to notify those in the back
             foreach($towhomtosendemail as $usersemails)
             { 
                            $data = array(
                'user'=>$rec, 
                // 'username'=>Auth::user()->name,  
                'id'=> $job->id,
                 'stages'=> [
                                'HR Recruitment Team'=>$job->stages,
                                'HR Manager'=>$job->stage1,'Executive Lead'=>$job->stage2,
                                'Group CEO'=>$job->stage3
                        ],
                'company_id'=>$company_id,
                'jobtittle'      =>  $job->jobtittle,
                'positions'      =>  $job->positions,
                'employementtype'      =>  $job->employementtype,
                'salary'      =>  $job->salary,
                // 'salaryto'      =>  $job->salaryto,
                'responsibilities'      =>  $job->responsibilities,
                'posrequirements'      =>  $job->posrequirements,
                'posskills'      =>  $job->posskills,
                'location'   =>   $job->location,
                'jobcategory'   =>   $job->jobcategory,
                'intenting'   =>   unserialize($job->intenting),
                'startdate'   =>   $job->startdate,
                'manager'   =>   $job->manager,
                'pwd'   =>   $job->pwd,
                'rec'=>$usersemails->id,
                'interviews'   => unserialize( $job->interviews),
                'jobdescription'   =>   $job->jobdescription

        );
                //dd($usersemails->email);
                  // mail back to hiring manager 
              \Mail::to($usersemails->email)->send(new \App\Mail\hrapprovingexecemailnotify($data));
            } 
              
                             Alert::success('Success',' Requisition has been approved successfully');
         return redirect()->route('employeerequisitions.approvesmessage')->with('success','Requisition has been approved successfully');
                           
 }
 /**
  * aprroves from hr to exec if the initiator is the recruiter
  * */
  public function hrapprovingtoexec($id){
    $checkaction=DB::table('employeerequisitions')
            ->where('id', $id)
            ->first();
            if ($checkaction->action ==1 ||$checkaction->action ==2 ||$checkaction->action ==3) {
         Alert::success('Success',' Requisition  Action has already occured!!');
         return redirect()->route('tabspage');
            }
 $companyinitator=DB::table('requsitionsapprovals')
                    ->where('requsitionsapprovals.jobid', $id)
                    ->where('requsitionsapprovals.initiator', 'initiator')
                    ->first();
                    // dd($companyinitator);
      $company_id=$companyinitator->company_id;

    $approve1=DB::table('employeerequisitions')
             ->where('id',$id)
             ->update(['stage1' => "1", 'action'=>'1']);

     $job = EmployeeRequisition::find($id);
     $ldate = date('Y-m-d H:i:s');
    $storeapprove1=DB::table('requsitionsapprovals')
                              ->insert([
                                     'jobid' => $id,
                                     'userId' => Auth::user()->id,
                                     'date'=>$ldate,
                                    ]);

         $initiatorcompany=DB::table('requsitionsapprovals')
                                 ->join('users', 'users.id','=' ,'requsitionsapprovals.userId')
                                 ->join('companies', 'companies.id', '=', 'users.company_id')
                                 ->where('requsitionsapprovals.jobid', $id)
                                 ->where('requsitionsapprovals.initiator', 'initiator')
                                 ->first()->company_id;

                                

        $bossId = DB::table("employeerequisitionusers")->where("company_id",$initiatorcompany)->where("employeetype","=","Executive Lead")->first()->userId;;
        $bossEmail = DB::table("users")->where("id","=",$bossId)->first()->email;
         $data = array(
                'user'=>Auth::user()->id, 
                'username'=>Auth::user()->name,  
                'id'=> $job->id,
                 'stages'=> [
                                'HR Recruitment Team'=>$job->stages,
                                'HR Manager'=>$job->stage1,'Executive Lead'=>$job->stage2,
                                'Group CEO'=>$job->stage3
                        ],
                'company_id'=>$company_id,
                'jobtittle'      =>  $job->jobtittle,
                'positions'      =>  $job->positions,
                'employementtype'      =>  $job->employementtype,
                'salary'      =>  $job->salary,
                // 'salaryto'      =>  $job->salaryto,
                'responsibilities'      =>  $job->responsibilities,
                'posrequirements'      =>  $job->posrequirements,
                'posskills'      =>  $job->posskills,
                'location'   =>   $job->location,
                'jobcategory'   =>   $job->jobcategory,
                'intenting'   =>   unserialize($job->intenting),
                'startdate'   =>   $job->startdate,
                'manager'   =>   $job->manager,
                'pwd'   =>   $job->pwd,
                'rec'=>$bossId,
                'interviews'   => unserialize( $job->interviews),
                'jobdescription'   =>   $job->jobdescription
        );
         \Mail::to($bossEmail)->send(new \App\Mail\hrapprovingtoexec($data));

           $towhomtosendemail=DB::table('requsitionsapprovals')
                         ->join('users', 'users.id', '=', 'requsitionsapprovals.userId')
                         ->where('requsitionsapprovals.jobid', $id)
                          ->get(); 
            //send email to notify those in the back
             foreach($towhomtosendemail as $usersemails)
             { 
                         $data = array(
                'user'=>Auth::user()->id, 
                'username'=>Auth::user()->name,  
                'id'=> $job->id,
                 'stages'=> [
                                'HR Recruitment Team'=>$job->stages,
                                'HR Manager'=>$job->stage1,'Executive Lead'=>$job->stage2,
                                'Group CEO'=>$job->stage3
                        ],
                'company_id'=>$company_id,
                'jobtittle'      =>  $job->jobtittle,
                'positions'      =>  $job->positions,
                'employementtype'      =>  $job->employementtype,
                'salary'      =>  $job->salary,
                // 'salaryto'      =>  $job->salaryto,
                'responsibilities'      =>  $job->responsibilities,
                'posrequirements'      =>  $job->posrequirements,
                'posskills'      =>  $job->posskills,
                'location'   =>   $job->location,
                'jobcategory'   =>   $job->jobcategory,
                'intenting'   =>   unserialize($job->intenting),
                'startdate'   =>   $job->startdate,
                'manager'   =>   $job->manager,
                'pwd'   =>   $job->pwd,
                'rec'=>$usersemails->id,
                'interviews'   => unserialize( $job->interviews),
                'jobdescription'   =>   $job->jobdescription
        );
                //dd($usersemails->email);
                  // mail back to hiring manager 
              \Mail::to($usersemails->email)->send(new \App\Mail\hrapprovingtoexecnotify($data));
            } 
              
                             Alert::success('Success',' Requisition has been approved successfully');
                             return back();
         // return redirect()->route('employeerequisitions.index');; 
                           
 }
 /**
  * approvals to ceo by exec via emails*
  * */
 public function approvetoceo1($id, $rec){
    $checkaction=DB::table('employeerequisitions')
            ->where('id', $id)
            ->first();
            if ($checkaction->action ==3 || $checkaction->action ==4) {
         Alert::success('Success',' Requisition  Action has already occured!!');
         return redirect()->route('employeerequisitions.approvesmessage')->with('success',' Requisition  Action has already occured!!.');
            }
$companyinitator=DB::table('requsitionsapprovals')
                    ->where('requsitionsapprovals.jobid', $id)
                    ->orwhere('requsitionsapprovals.initiator', 'initiator')
                    ->first();
                    //dd($companyinitator);
      $company_id=$companyinitator->company_id;
    $approve1=DB::table('employeerequisitions')
             ->where('id',$id)
             ->update(['stage2' => "1",'action'=>'3']);

           $job = EmployeeRequisition::find($id);
    $ldate = date('Y-m-d H:i:s');
    $storeapprove1=DB::table('requsitionsapprovals')
                              ->insert([
                                     'jobid' => $id,
                                     'userId' => $rec,
                                     'date'=>$ldate,
                                    ]);


                        //getrole the initiator 
        $initiatorcompany=DB::table('requsitionsapprovals')
                                 ->join('users', 'users.id','=' ,'requsitionsapprovals.userId')
                                 ->join('companies', 'companies.id', '=', 'users.company_id')
                                 ->where('requsitionsapprovals.jobid', $id)
                                 ->where('requsitionsapprovals.initiator', 'initiator')
                                 ->first()->company_id;
             //get the auth user role 
            $getreccompany=DB::table('users')
                          ->where('id',$rec)
                          ->first();
             $user_id=$getreccompany->company_id;
            //get the company name of the initiator
             $companyname=DB::table('companies')
                          ->where('id',$initiatorcompany)
                          ->first();
               //get the company name of the auth user 
            $companynameexec=DB::table('companies')
                          ->where('id',$user_id)
                          ->first();            
             if ($companyname->company=="StepWise" && $companynameexec->company=="StepWise") {
                $towhomtosendemail=DB::table('requsitionsapprovals')
                         ->join('users', 'users.id', '=', 'requsitionsapprovals.userId')
                         ->where('requsitionsapprovals.jobid', $id)
                          ->get(); 

             //send email to notify those in the back
             foreach($towhomtosendemail as $usersemails)
             { 
                 $data = array(
                'user'=>$rec,  
                'id'=> $job->id,
                  'stages'=> [
                                'HR Recruitment Team'=>$job->stages,
                                'HR Manager'=>$job->stage1,'Executive Lead'=>$job->stage2,
                                'Group CEO'=>$job->stage3
                        ],
                'company_id'=>$company_id,
                'jobtittle'      =>  $job->jobtittle,
                'positions'      =>  $job->positions,
                'employementtype'      =>  $job->employementtype,
                'salary'      =>  $job->salary,
                // 'salaryto'      =>  $job->salaryto,
                'responsibilities'      =>  $job->responsibilities,
                'posrequirements'      =>  $job->posrequirements,
                'posskills'      =>  $job->posskills,
                'location'   =>   $job->location,
                'jobcategory'   =>   $job->jobcategory,
               'intenting'   =>   unserialize($job->intenting),
                'startdate'   =>   $job->startdate,
                'manager'   =>   $job->manager,
                'pwd'   =>   $job->pwd,
                'rec'=>$usersemails->id,
                 'interviews'   => unserialize( $job->interviews),
                'jobdescription'   =>   $job->jobdescription
        );
                //dd($usersemails->email);
                \Mail::to($usersemails->email)->send(new \App\Mail\groupceoisexechiringinitiatoremail($data));

            }
            $approve1=DB::table('employeerequisitions')
             ->where('id',$id)
             ->update(['stage3' => "1",
                        'approved_status'=>"1", 'action'=>'3'
              ]);
             Alert::success('Success',' Requisition  has been approved successfully');
            return redirect()->route('employeerequisitions.approvesmessage')->with('success',' Requisition  has been approved successfully');
                                 
                } 
   //store that it has been approved

        $towhomtosendemail=DB::table('requsitionsapprovals')
                         ->join('users', 'users.id', '=', 'requsitionsapprovals.userId')
                         ->where('requsitionsapprovals.jobid', $id)
                          ->get(); 
             //send email to notify those in the back
             foreach($towhomtosendemail as $usersemails)
             { 
                 $data = array(
                'user'=>$rec,  
                'id'=> $job->id,
                  'stages'=> [
                                'HR Recruitment Team'=>$job->stages,
                                'HR Manager'=>$job->stage1,'Executive Lead'=>$job->stage2,
                                'Group CEO'=>$job->stage3
                        ],
                'company_id'=>$company_id,
                'jobtittle'      =>  $job->jobtittle,
                'positions'      =>  $job->positions,
                'employementtype'      =>  $job->employementtype,
                'salary'      =>  $job->salary,
                // 'salaryto'      =>  $job->salaryto,
                'responsibilities'      =>  $job->responsibilities,
                'posrequirements'      =>  $job->posrequirements,
                'posskills'      =>  $job->posskills,
                'location'   =>   $job->location,
                'jobcategory'   =>   $job->jobcategory,
               'intenting'   =>   unserialize($job->intenting),
                'startdate'   =>   $job->startdate,
                'manager'   =>   $job->manager,
                'pwd'   =>   $job->pwd,
                'rec'=>$usersemails->id,
                 'interviews'   => unserialize( $job->interviews),
                'jobdescription'   =>   $job->jobdescription
        );
                //dd($usersemails->email);
                \Mail::to($usersemails->email)->send(new \App\Mail\employeerequisitionapprovebyhrnotifyemail($data));
            }    
            //proceed to send email to the group CEO client 
            $sendmailtogroupceo=DB::table('employeerequisitionusers')
                               ->join('users', 'users.id','=', 'employeerequisitionusers.userId')
                               ->where('employeerequisitionusers.employeetype', 'Group CEO')   
                               ->first();
                               //dd($sendmailtogroupceo); 
                 $data = array(
                'user'=>$rec,  
                'id'=> $job->id,
                  'stages'=> [
                                'HR Recruitment Team'=>$job->stages,
                                'HR Manager'=>$job->stage1,'Executive Lead'=>$job->stage2,
                                'Group CEO'=>$job->stage3
                        ],
                'company_id'=>$company_id,
                'jobtittle'      =>  $job->jobtittle,
                'positions'      =>  $job->positions,
                'employementtype'      =>  $job->employementtype,
                'salary'      =>  $job->salary,
                // 'salaryto'      =>  $job->salaryto,
                'responsibilities'      =>  $job->responsibilities,
                'posrequirements'      =>  $job->posrequirements,
                'posskills'      =>  $job->posskills,
                'location'   =>   $job->location,
                'jobcategory'   =>   $job->jobcategory,
               'intenting'   =>   unserialize($job->intenting),
                'startdate'   =>   $job->startdate,
                'manager'   =>   $job->manager,
                'pwd'   =>   $job->pwd,
                'rec'=>$sendmailtogroupceo->id,
                 'interviews'   => unserialize( $job->interviews),
                'jobdescription'   =>   $job->jobdescription
        );   
              \Mail::to($sendmailtogroupceo->email)->send(new \App\Mail\employeerequisitionapprovebyhremail($data));
                         Alert::success('Success',' Requisition  has been approved successfully');
          return redirect()->route('employeerequisitions.approvesmessage')->with('success',' Requisition  has been approved successfully');
                     // return back();
 }
  /**approve from leo
   * 
   * */
                 
public function approvetoceo($id){
    $checkaction=DB::table('employeerequisitions')
            ->where('id', $id)
            ->first();
            if ($checkaction->action ==3 || $checkaction->action ==4) {
         Alert::success('Success',' Requisition  Action has already occured!!');
        return redirect()->route('tabspage');
            }
$companyinitator=DB::table('requsitionsapprovals')
                    ->where('requsitionsapprovals.jobid', $id)
                    ->orwhere('requsitionsapprovals.initiator', 'initiator')
                    ->first();
                    //dd($companyinitator);
      $company_id=$companyinitator->company_id;
    $approve1=DB::table('employeerequisitions')
             ->where('id',$id)
             ->update(['stage2' => "1",'action'=>'3']);

           $job = EmployeeRequisition::find($id);
    $ldate = date('Y-m-d H:i:s');
    $storeapprove1=DB::table('requsitionsapprovals')
                              ->insert([
                                     'jobid' => $id,
                                     'userId' => Auth::user()->id,
                                     'date'=>$ldate,
                                    ]);


                        //getrole the initiator 
        $initiatorcompany=DB::table('requsitionsapprovals')
                                 ->join('users', 'users.id','=' ,'requsitionsapprovals.userId')
                                 ->join('companies', 'companies.id', '=', 'users.company_id')
                                 ->where('requsitionsapprovals.jobid', $id)
                                 ->where('requsitionsapprovals.initiator', 'initiator')
                                 ->first()->company_id;
             //get the auth user role 
             $user_id=Auth::user()->company_id;
            //get the company name of the initiator
             $companyname=DB::table('companies')
                          ->where('id',$initiatorcompany)
                          ->first();
               //get the company name of the auth user 
            $companynameexec=DB::table('companies')
                          ->where('id',$user_id)
                          ->first();            
             if ($companyname->company=="StepWise" && $companynameexec->company=="StepWise") {
                $towhomtosendemail=DB::table('requsitionsapprovals')
                         ->join('users', 'users.id', '=', 'requsitionsapprovals.userId')
                         ->where('requsitionsapprovals.jobid', $id)
                          ->get(); 
             //send email to notify those in the back
             foreach($towhomtosendemail as $usersemails)
             { 
                $data = array(
                'user'=>Auth::user()->id, 
                'username'=>Auth::user()->name,  
                'id'=> $job->id,
                  'stages'=> [
                                'HR Recruitment Team'=>$job->stages,
                                'HR Manager'=>$job->stage1,'Executive Lead'=>$job->stage2,
                                'Group CEO'=>$job->stage3
                        ],
                'company_id'=>$company_id,
                'jobtittle'      =>  $job->jobtittle,
                'positions'      =>  $job->positions,
                'employementtype'      =>  $job->employementtype,
                'salary'      =>  $job->salary,
                // 'salaryto'      =>  $job->salaryto,
                'responsibilities'      =>  $job->responsibilities,
                'posrequirements'      =>  $job->posrequirements,
                'posskills'      =>  $job->posskills,
                'location'   =>   $job->location,
                'jobcategory'   =>   $job->jobcategory,
               'intenting'   =>   unserialize($job->intenting),
                'startdate'   =>   $job->startdate,
                'manager'   =>   $job->manager,
                'pwd'   =>   $job->pwd,
                'rec'=>$usersemails->id,
                 'interviews'   => unserialize( $job->interviews),
                'jobdescription'   =>   $job->jobdescription
        );
                //dd($usersemails->email);
                \Mail::to($usersemails->email)->send(new \App\Mail\groupceoisexechiringinitiator($data));

            }
            $approve1=DB::table('employeerequisitions')
             ->where('id',$id)
             ->update(['stage3' => "1",
                        'approved_status'=>"1", 'action'=>'3'
              ]);
             Alert::success('Success',' Requisition  has been approved successfully');
return back();                                 
                } 
   //store that it has been approved

        $towhomtosendemail=DB::table('requsitionsapprovals')
                         ->join('users', 'users.id', '=', 'requsitionsapprovals.userId')
                         ->where('requsitionsapprovals.jobid', $id)
                          ->get(); 
             //send email to notify those in the back
             foreach($towhomtosendemail as $usersemails)
             { 
                               $data = array(
                'user'=>Auth::user()->id, 
                'username'=>Auth::user()->name,  
                'id'=> $job->id,
                  'stages'=> [
                                'HR Recruitment Team'=>$job->stages,
                                'HR Manager'=>$job->stage1,'Executive Lead'=>$job->stage2,
                                'Group CEO'=>$job->stage3
                        ],
                'company_id'=>$company_id,
                'jobtittle'      =>  $job->jobtittle,
                'positions'      =>  $job->positions,
                'employementtype'      =>  $job->employementtype,
                'salary'      =>  $job->salary,
                // 'salaryto'      =>  $job->salaryto,
                'responsibilities'      =>  $job->responsibilities,
                'posrequirements'      =>  $job->posrequirements,
                'posskills'      =>  $job->posskills,
                'location'   =>   $job->location,
                'jobcategory'   =>   $job->jobcategory,
               'intenting'   =>   unserialize($job->intenting),
                'startdate'   =>   $job->startdate,
                'manager'   =>   $job->manager,
                'pwd'   =>   $job->pwd,
                'rec'=>$usersemails->id,
                 'interviews'   => unserialize( $job->interviews),
                'jobdescription'   =>   $job->jobdescription
        );
                //dd($usersemails->email);
                \Mail::to($usersemails->email)->send(new \App\Mail\employeerequisitionapprovebyhrnotify($data));
            }    
            //proceed to send email to the group CEO client 
            $sendmailtogroupceo=DB::table('employeerequisitionusers')
                               ->join('users', 'users.id','=', 'employeerequisitionusers.userId')
                               ->where('employeerequisitionusers.employeetype', 'Group CEO')   
                               ->first();
                               $data = array(
                'user'=>Auth::user()->id, 
                'username'=>Auth::user()->name,  
                'id'=> $job->id,
                  'stages'=> [
                                'HR Recruitment Team'=>$job->stages,
                                'HR Manager'=>$job->stage1,'Executive Lead'=>$job->stage2,
                                'Group CEO'=>$job->stage3
                        ],
                'company_id'=>$company_id,
                'jobtittle'      =>  $job->jobtittle,
                'positions'      =>  $job->positions,
                'employementtype'      =>  $job->employementtype,
                'salary'      =>  $job->salary,
                // 'salaryto'      =>  $job->salaryto,
                'responsibilities'      =>  $job->responsibilities,
                'posrequirements'      =>  $job->posrequirements,
                'posskills'      =>  $job->posskills,
                'location'   =>   $job->location,
                'jobcategory'   =>   $job->jobcategory,
               'intenting'   =>   unserialize($job->intenting),
                'startdate'   =>   $job->startdate,
                'manager'   =>   $job->manager,
                'pwd'   =>   $job->pwd,
                'rec'=>$sendmailtogroupceo->id,
                 'interviews'   => unserialize( $job->interviews),
                'jobdescription'   =>   $job->jobdescription
        );
                               //dd($sendmailtogroupceo);    
              \Mail::to($sendmailtogroupceo->email)->send(new \App\Mail\employeerequisitionapprovebyhr($data));
                         Alert::success('Success',' Requisition  has been approved successfully');
         // return redirect()->route('employeerequisitions.index');
                     return back();
 }
 /** exce approving to ceo when hr initiates email approvals 
  * */
 public function execapprovinghrinitiator1($id, $rec){

 $checkaction=DB::table('employeerequisitions')
             ->where('id', $id)
             ->first();
             if ($checkaction->action ==1 || $checkaction->action ==2 ) {
                 Alert::success('Success',' Requisition Actions Has already occured!!');
            return redirect()->route('employeerequisitions.approvesmessage')->with('success','Requisition Actions Has already occured!!');  
                }   
  
  $companyinitator=DB::table('requsitionsapprovals')
                    ->where('requsitionsapprovals.jobid', $id)
                    ->where('requsitionsapprovals.initiator', 'initiator')
                    ->first();
                    //dd($companyinitator);
      $company_id=$companyinitator->company_id;
    $approve1=DB::table('employeerequisitions')
             ->where('id',$id)
             ->update(['stage2' => "1", 'action'=>'1']);

           $job = EmployeeRequisition::find($id);
    $ldate = date('Y-m-d H:i:s');
    $storeapprove1=DB::table('requsitionsapprovals')
                              ->insert([
                                     'jobid' => $id,
                                     'userId' => $rec,
                                     'date'=>$ldate,
                                    ]);



                        //getrole the initiator 
        $initiatorcompany=DB::table('requsitionsapprovals')
                                 ->join('users', 'users.id','=' ,'requsitionsapprovals.userId')
                                 ->join('companies', 'companies.id', '=', 'users.company_id')
                                 ->where('requsitionsapprovals.jobid', $id)
                                 ->where('requsitionsapprovals.initiator', 'initiator')
                                 ->first()->company_id;
             //get the auth user role 
              $getreccompany=DB::table('users')
                             ->where('id', $rec)
                             ->first();
             $user_id=$getreccompany->company_id;
            //get the company name of the initiator
             $companyname=DB::table('companies')
                          ->where('id',$initiatorcompany)
                          ->first();
               //get the company name of the auth user 
            $companynameexec=DB::table('companies')
                          ->where('id',$user_id)
                          ->first();            
             if ($companyname->company=="StepWise" && $companynameexec->company=="StepWise") {
                $towhomtosendemail=DB::table('requsitionsapprovals')
                         ->join('users', 'users.id', '=', 'requsitionsapprovals.userId')
                         ->where('requsitionsapprovals.jobid', $id)
                          ->get(); 
             //send email to notify those in the back
             foreach($towhomtosendemail as $usersemails)
             { 
                $data = array(
                'user'=>$rec,  
                'id'=> $job->id,
                  'stages'=> [
                                'HR Recruitment Team'=>$job->stages,
                                'HR Manager'=>$job->stage1,'Executive Lead'=>$job->stage2,
                                'Group CEO'=>$job->stage3
                        ],
                'company_id'=>$company_id,
                'jobtittle'      =>  $job->jobtittle,
                'positions'      =>  $job->positions,
                'employementtype'      =>  $job->employementtype,
                'salary'      =>  $job->salary,
                // 'salaryto'      =>  $job->salaryto,
                'responsibilities'      =>  $job->responsibilities,
                'posrequirements'      =>  $job->posrequirements,
                'posskills'      =>  $job->posskills,
                'location'   =>   $job->location,
                'jobcategory'   =>   $job->jobcategory,
               'intenting'   =>   unserialize($job->intenting),
                'startdate'   =>   $job->startdate,
                'manager'   =>   $job->manager,
                'pwd'   =>   $job->pwd,
                'rec'=>$usersemails->id,
                'interviews'   => unserialize( $job->interviews),
                'jobdescription'   =>   $job->jobdescription
        );
                //dd($usersemails->email);
                \Mail::to($usersemails->email)->send(new \App\Mail\groupceoisexechrinitiatoremail($data));

            }
            $approve1=DB::table('employeerequisitions')
             ->where('id',$id)
             ->update(['stage3' => "1",
                        'approved_status'=>"1", 'action'=>'2'
              ]);
             Alert::success('Success',' Requisition  has been approved successfully');
             return redirect()->route('employeerequisitions.approvesmessage')->with('success','Requisition  has been approved successfully'); 
                                 
                } 
   //store that it has been approved

        $towhomtosendemail=DB::table('requsitionsapprovals')
                         ->join('users', 'users.id', '=', 'requsitionsapprovals.userId')
                         ->where('requsitionsapprovals.jobid', $id)
                          ->get(); 
             //send email to notify those in the back
             foreach($towhomtosendemail as $usersemails)
             { 
            $data = array(
                'user'=>$rec,  
                'id'=> $job->id,
                  'stages'=> [
                                'HR Recruitment Team'=>$job->stages,
                                'HR Manager'=>$job->stage1,'Executive Lead'=>$job->stage2,
                                'Group CEO'=>$job->stage3
                        ],
                'company_id'=>$company_id,
                'jobtittle'      =>  $job->jobtittle,
                'positions'      =>  $job->positions,
                'employementtype'      =>  $job->employementtype,
                'salary'      =>  $job->salary,
                // 'salaryto'      =>  $job->salaryto,
                'responsibilities'      =>  $job->responsibilities,
                'posrequirements'      =>  $job->posrequirements,
                'posskills'      =>  $job->posskills,
                'location'   =>   $job->location,
                'jobcategory'   =>   $job->jobcategory,
               'intenting'   =>   unserialize($job->intenting),
                'startdate'   =>   $job->startdate,
                'manager'   =>   $job->manager,
                'pwd'   =>   $job->pwd,
                'rec'=>$usersemails->id,
                'interviews'   => unserialize( $job->interviews),
                'jobdescription'   =>   $job->jobdescription
        );

                //dd($usersemails->email);
                \Mail::to($usersemails->email)->send(new \App\Mail\execapprovinghrinitiatornotifyemail($data));
            }    
            //proceed to send email to the group CEO client 
            $sendmailtogroupceo=DB::table('employeerequisitionusers')
                               ->join('users', 'users.id','=', 'employeerequisitionusers.userId')
                               ->where('employeerequisitionusers.employeetype', 'Group CEO')   
                               ->first();
                               //dd($sendmailtogroupceo); 
            $data = array(
                'user'=>$rec,  
                'id'=> $job->id,
                  'stages'=> [
                                'HR Recruitment Team'=>$job->stages,
                                'HR Manager'=>$job->stage1,'Executive Lead'=>$job->stage2,
                                'Group CEO'=>$job->stage3
                        ],
                'company_id'=>$company_id,
                'jobtittle'      =>  $job->jobtittle,
                'positions'      =>  $job->positions,
                'employementtype'      =>  $job->employementtype,
                'salary'      =>  $job->salary,
                // 'salaryto'      =>  $job->salaryto,
                'responsibilities'      =>  $job->responsibilities,
                'posrequirements'      =>  $job->posrequirements,
                'posskills'      =>  $job->posskills,
                'location'   =>   $job->location,
                'jobcategory'   =>   $job->jobcategory,
               'intenting'   =>   unserialize($job->intenting),
                'startdate'   =>   $job->startdate,
                'manager'   =>   $job->manager,
                'pwd'   =>   $job->pwd,
                'rec'=>$sendmailtogroupceo->id,
                'interviews'   => unserialize( $job->interviews),
                'jobdescription'   =>   $job->jobdescription
        );   
              \Mail::to($sendmailtogroupceo->email)->send(new \App\Mail\execapprovinghrinitiatoremail($data));
        Alert::success('Success',' Requisition has been approved  successfully');
         return redirect()->route('employeerequisitions.approvesmessage')->with('success','Requisition  has been approved successfully'); 
                     // return back();
 }
 /**
  * exec approving to ceo when the initiator is hr
  * */
 public function execapprovinghrinitiator($id){

 $checkaction=DB::table('employeerequisitions')
             ->where('id', $id)
             ->first();
             if ($checkaction->action ==1 || $checkaction->action ==2 ) {
                 Alert::success('Success',' Requisition Actions Has already occured!!');
            return redirect()->route('tabspage');
                }   
  
  $companyinitator=DB::table('requsitionsapprovals')
                    ->where('requsitionsapprovals.jobid', $id)
                    ->where('requsitionsapprovals.initiator', 'initiator')
                    ->first();
                    //dd($companyinitator);
      $company_id=$companyinitator->company_id;
    $approve1=DB::table('employeerequisitions')
             ->where('id',$id)
             ->update(['stage2' => "1", 'action'=>'1']);

           $job = EmployeeRequisition::find($id);
    $ldate = date('Y-m-d H:i:s');
    $storeapprove1=DB::table('requsitionsapprovals')
                              ->insert([
                                     'jobid' => $id,
                                     'userId' => Auth::user()->id,
                                     'date'=>$ldate,
                                    ]);



                        //getrole the initiator 
        $initiatorcompany=DB::table('requsitionsapprovals')
                                 ->join('users', 'users.id','=' ,'requsitionsapprovals.userId')
                                 ->join('companies', 'companies.id', '=', 'users.company_id')
                                 ->where('requsitionsapprovals.jobid', $id)
                                 ->where('requsitionsapprovals.initiator', 'initiator')
                                 ->first()->company_id;
             //get the auth user role 
             $user_id=Auth::user()->company_id;
            //get the company name of the initiator
             $companyname=DB::table('companies')
                          ->where('id',$initiatorcompany)
                          ->first();
               //get the company name of the auth user 
            $companynameexec=DB::table('companies')
                          ->where('id',$user_id)
                          ->first();            
             if ($companyname->company=="StepWise" && $companynameexec->company=="StepWise") {
                $towhomtosendemail=DB::table('requsitionsapprovals')
                         ->join('users', 'users.id', '=', 'requsitionsapprovals.userId')
                         ->where('requsitionsapprovals.jobid', $id)
                          ->get(); 
             //send email to notify those in the back
             foreach($towhomtosendemail as $usersemails)
             { 
                            $data = array(
                'user'=>Auth::user()->id, 
                'username'=>Auth::user()->name,  
                'id'=> $job->id,
                  'stages'=> [
                                'HR Recruitment Team'=>$job->stages,
                                'HR Manager'=>$job->stage1,'Executive Lead'=>$job->stage2,
                                'Group CEO'=>$job->stage3
                        ],
                'company_id'=>$company_id,
                'jobtittle'      =>  $job->jobtittle,
                'positions'      =>  $job->positions,
                'employementtype'      =>  $job->employementtype,
                'salary'      =>  $job->salary,
                // 'salaryto'      =>  $job->salaryto,
                'responsibilities'      =>  $job->responsibilities,
                'posrequirements'      =>  $job->posrequirements,
                'posskills'      =>  $job->posskills,
                'location'   =>   $job->location,
                'jobcategory'   =>   $job->jobcategory,
               'intenting'   =>   unserialize($job->intenting),
                'startdate'   =>   $job->startdate,
                'manager'   =>   $job->manager,
                'pwd'   =>   $job->pwd,
                'rec'=>$usersemails->id,
                'interviews'   => unserialize( $job->interviews),
                'jobdescription'   =>   $job->jobdescription
        );
                //dd($usersemails->email);
                \Mail::to($usersemails->email)->send(new \App\Mail\groupceoisexechrinitiator($data));

            }
            $approve1=DB::table('employeerequisitions')
             ->where('id',$id)
             ->update(['stage3' => "1",
                        'approved_status'=>"1", 'action'=>'2'
              ]);
             Alert::success('Success',' Requisition  has been approved successfully');
             return back();
            // return redirect()->route('employeerequisitions.index');
                                 
                } 
   //store that it has been approved

        $towhomtosendemail=DB::table('requsitionsapprovals')
                         ->join('users', 'users.id', '=', 'requsitionsapprovals.userId')
                         ->where('requsitionsapprovals.jobid', $id)
                          ->get(); 
             //send email to notify those in the back
             foreach($towhomtosendemail as $usersemails)
             { 
                $data = array(
                'user'=>Auth::user()->id, 
                'username'=>Auth::user()->name,  
                'id'=> $job->id,
                  'stages'=> [
                                'HR Recruitment Team'=>$job->stages,
                                'HR Manager'=>$job->stage1,'Executive Lead'=>$job->stage2,
                                'Group CEO'=>$job->stage3
                        ],
                'company_id'=>$company_id,
                'jobtittle'      =>  $job->jobtittle,
                'positions'      =>  $job->positions,
                'employementtype'      =>  $job->employementtype,
                'salary'      =>  $job->salary,
                // 'salaryto'      =>  $job->salaryto,
                'responsibilities'      =>  $job->responsibilities,
                'posrequirements'      =>  $job->posrequirements,
                'posskills'      =>  $job->posskills,
                'location'   =>   $job->location,
                'jobcategory'   =>   $job->jobcategory,
               'intenting'   =>   unserialize($job->intenting),
                'startdate'   =>   $job->startdate,
                'manager'   =>   $job->manager,
                'pwd'   =>   $job->pwd,
                'rec'=>$usersemails->id,
                'interviews'   => unserialize( $job->interviews),
                'jobdescription'   =>   $job->jobdescription
        );
                //dd($usersemails->email);
                \Mail::to($usersemails->email)->send(new \App\Mail\execapprovinghrinitiatornotify($data));
            }    
            //proceed to send email to the group CEO client 
            $sendmailtogroupceo=DB::table('employeerequisitionusers')
                               ->join('users', 'users.id','=', 'employeerequisitionusers.userId')
                               ->where('employeerequisitionusers.employeetype', 'Group CEO')   
                               ->first();
                               //dd($sendmailtogroupceo);   
                 $data = array(
                'user'=>Auth::user()->id, 
                'username'=>Auth::user()->name,  
                'id'=> $job->id,
                  'stages'=> [
                                'HR Recruitment Team'=>$job->stages,
                                'HR Manager'=>$job->stage1,'Executive Lead'=>$job->stage2,
                                'Group CEO'=>$job->stage3
                        ],
                'company_id'=>$company_id,
                'jobtittle'      =>  $job->jobtittle,
                'positions'      =>  $job->positions,
                'employementtype'      =>  $job->employementtype,
                'salary'      =>  $job->salary,
                // 'salaryto'      =>  $job->salaryto,
                'responsibilities'      =>  $job->responsibilities,
                'posrequirements'      =>  $job->posrequirements,
                'posskills'      =>  $job->posskills,
                'location'   =>   $job->location,
                'jobcategory'   =>   $job->jobcategory,
               'intenting'   =>   unserialize($job->intenting),
                'startdate'   =>   $job->startdate,
                'manager'   =>   $job->manager,
                'pwd'   =>   $job->pwd,
                'rec'=>$sendmailtogroupceo->id,
                'interviews'   => unserialize( $job->interviews),
                'jobdescription'   =>   $job->jobdescription
        ); 
              \Mail::to($sendmailtogroupceo->email)->send(new \App\Mail\execapprovinghrinitiator($data));
        Alert::success('Success',' Requisition has been approved  successfully');
         return redirect()->route('tabspage');
                     // return back();
 }
 /**
  * qapproving from exec to ceo when the intiaqtor is the rec teqam emqail
  * */
 public function execapprovingtoceorecruinitiator1($id, $rec){
    $checkaction=DB::table('employeerequisitions')
            ->where('id', $id)
            ->first();
            if ($checkaction->action ==2 ||$checkaction->action ==3) {
         Alert::success('Success',' Requisition  Action has already occured!!');
         return redirect()->route('employeerequisitions.approvesmessage')->with('success','Requisition  Action has already occured!!');
            }
$companyinitator=DB::table('requsitionsapprovals')
                    ->where('requsitionsapprovals.jobid', $id)
                    ->orwhere('requsitionsapprovals.initiator', 'initiator')
                    ->first();
                    //dd($companyinitator);
      $company_id=$companyinitator->company_id;
    $approve1=DB::table('employeerequisitions')
             ->where('id',$id)
             ->update(['stage2' => "1", 'action'=>'2']);

           $job = EmployeeRequisition::find($id);
    $ldate = date('Y-m-d H:i:s');
    $storeapprove1=DB::table('requsitionsapprovals')
                              ->insert([
                                     'jobid' => $id,
                                     'userId' => $rec,
                                     'date'=>$ldate,
                                    ]);
            $data = array(
                'user'=>$rec,  
                'id'=> $job->id,
                  'stages'=> [
                                'HR Recruitment Team'=>$job->stages,
                                'HR Manager'=>$job->stage1,'Executive Lead'=>$job->stage2,
                                'Group CEO'=>$job->stage3
                        ],
                'company_id'=>$company_id,
                'jobtittle'      =>  $job->jobtittle,
                'positions'      =>  $job->positions,
                'employementtype'      =>  $job->employementtype,
                'salary'      =>  $job->salary,
                // 'salaryto'      =>  $job->salaryto,
                'responsibilities'      =>  $job->responsibilities,
                'posrequirements'      =>  $job->posrequirements,
                'posskills'      =>  $job->posskills,
                'location'   =>   $job->location,
                'jobcategory'   =>   $job->jobcategory,
               'intenting'   =>   unserialize($job->intenting),
                'startdate'   =>   $job->startdate,
                'manager'   =>   $job->manager,
                'pwd'   =>   $job->pwd,
                'interviews'   => unserialize( $job->interviews),
                'jobdescription'   =>   $job->jobdescription
        );
   //store that it has been approved

  
            //proceed to send email to the group CEO client 

            //getrole the initiator 
        $initiatorcompany=DB::table('requsitionsapprovals')
                                 ->join('users', 'users.id','=' ,'requsitionsapprovals.userId')
                                 ->join('companies', 'companies.id', '=', 'users.company_id')
                                 ->where('requsitionsapprovals.jobid', $id)
                                 ->where('requsitionsapprovals.initiator', 'initiator')
                                 ->first()->company_id;
             //get the auth user role 
            $reccompany=DB::table('users')
                       ->where('id', $rec)
                       ->first();
             $user_id=$reccompany->company_id;
            //get the company name of the initiator
             $companyname=DB::table('companies')
                          ->where('id',$initiatorcompany)
                          ->first();
               //get the company name of the auth user 
            $companynameexec=DB::table('companies')
                          ->where('id',$user_id)
                          ->first();            
             if ($companyname->company=="StepWise" && $companynameexec->company=="StepWise") {
                $towhomtosendemail=DB::table('requsitionsapprovals')
                         ->join('users', 'users.id', '=', 'requsitionsapprovals.userId')
                         ->where('requsitionsapprovals.jobid', $id)
                          ->get(); 
             //send email to notify those in the back
             foreach($towhomtosendemail as $usersemails)
             { 
                          $data = array(
                'user'=>$rec,  
                'id'=> $job->id,
                  'stages'=> [
                                'HR Recruitment Team'=>$job->stages,
                                'HR Manager'=>$job->stage1,'Executive Lead'=>$job->stage2,
                                'Group CEO'=>$job->stage3
                        ],
                'company_id'=>$company_id,
                'jobtittle'      =>  $job->jobtittle,
                'positions'      =>  $job->positions,
                'employementtype'      =>  $job->employementtype,
                'salary'      =>  $job->salary,
                // 'salaryto'      =>  $job->salaryto,
                'responsibilities'      =>  $job->responsibilities,
                'posrequirements'      =>  $job->posrequirements,
                'posskills'      =>  $job->posskills,
                'location'   =>   $job->location,
                'jobcategory'   =>   $job->jobcategory,
               'intenting'   =>   unserialize($job->intenting),
                'startdate'   =>   $job->startdate,
                'manager'   =>   $job->manager,
                'pwd'   =>   $job->pwd,
                'rec'=>$usersemails->id,
                'interviews'   => unserialize( $job->interviews),
                'jobdescription'   =>   $job->jobdescription
        );
                //dd($usersemails->email);
                \Mail::to($usersemails->email)->send(new \App\Mail\groupceoisexecemailnotify($data));

            }
            $approve1=DB::table('employeerequisitions')
             ->where('id',$id)
             ->update(['stage3' => "1",
                        'approved_status'=>"1", 'action'=>'3'
              ]);
             Alert::success('Success',' Requisition  has been approved successfully');
            return redirect()->route('employeerequisitions.approvesmessage')->with('success','Requisition  has been approved successfully');
                                 
                }    


                     $towhomtosendemail=DB::table('requsitionsapprovals')
                         ->join('users', 'users.id', '=', 'requsitionsapprovals.userId')
                         ->where('requsitionsapprovals.jobid', $id)
                          ->get(); 
             //send email to notify those in the back
             foreach($towhomtosendemail as $usersemails)
             { 
                $data = array(
                'user'=>$rec,  
                'id'=> $job->id,
                  'stages'=> [
                                'HR Recruitment Team'=>$job->stages,
                                'HR Manager'=>$job->stage1,'Executive Lead'=>$job->stage2,
                                'Group CEO'=>$job->stage3
                        ],
                'company_id'=>$company_id,
                'jobtittle'      =>  $job->jobtittle,
                'positions'      =>  $job->positions,
                'employementtype'      =>  $job->employementtype,
                'salary'      =>  $job->salary,
                // 'salaryto'      =>  $job->salaryto,
                'responsibilities'      =>  $job->responsibilities,
                'posrequirements'      =>  $job->posrequirements,
                'posskills'      =>  $job->posskills,
                'location'   =>   $job->location,
                'jobcategory'   =>   $job->jobcategory,
               'intenting'   =>   unserialize($job->intenting),
                'startdate'   =>   $job->startdate,
                'manager'   =>   $job->manager,
                'pwd'   =>   $job->pwd,
                'rec'=>$usersemails->id,
                'interviews'   => unserialize( $job->interviews),
                'jobdescription'   =>   $job->jobdescription
        );
                //dd($usersemails->email);
                \Mail::to($usersemails->email)->send(new \App\Mail\execapprovingtoceorecruinitiatornotifyemail($data));
            }  

            $sendmailtogroupceo=DB::table('employeerequisitionusers')
                               ->join('users', 'users.id','=', 'employeerequisitionusers.userId')
                               ->where('employeerequisitionusers.employeetype', 'Group CEO')   
                               ->first();
                               //dd($sendmailtogroupceo);  

                                    $data = array(
                'user'=>$rec,  
                'id'=> $job->id,
                  'stages'=> [
                                'HR Recruitment Team'=>$job->stages,
                                'HR Manager'=>$job->stage1,'Executive Lead'=>$job->stage2,
                                'Group CEO'=>$job->stage3
                        ],
                'company_id'=>$company_id,
                'jobtittle'      =>  $job->jobtittle,
                'positions'      =>  $job->positions,
                'employementtype'      =>  $job->employementtype,
                'salary'      =>  $job->salary,
                // 'salaryto'      =>  $job->salaryto,
                'responsibilities'      =>  $job->responsibilities,
                'posrequirements'      =>  $job->posrequirements,
                'posskills'      =>  $job->posskills,
                'location'   =>   $job->location,
                'jobcategory'   =>   $job->jobcategory,
               'intenting'   =>   unserialize($job->intenting),
                'startdate'   =>   $job->startdate,
                'manager'   =>   $job->manager,
                'pwd'   =>   $job->pwd,
                'rec'=>$sendmailtogroupceo->id,
                'interviews'   => unserialize( $job->interviews),
                'jobdescription'   =>   $job->jobdescription
        );
                         
              \Mail::to($sendmailtogroupceo->email)->send(new \App\Mail\execapprovingtoceorecruinitiatoremail($data));
        Alert::success('Success',' Requisition  has been approved successfully');
         return redirect()->route('employeerequisitions.approvesmessage')->with('success','Requisition  has been approved successfully.');
                     // return back();
 }
 /**
  * apprroving from exec to ceo when the initiator is the recruitement team
  * */
 public function execapprovingtoceorecruinitiator($id){
    $checkaction=DB::table('employeerequisitions')
            ->where('id', $id)
            ->first();
            if ($checkaction->action ==2 ||$checkaction->action ==3) {
         Alert::success('Success',' Requisition  Action has already occured!!');
         return redirect()->route('tabspage');
            }
$companyinitator=DB::table('requsitionsapprovals')
                    ->where('requsitionsapprovals.jobid', $id)
                    ->orwhere('requsitionsapprovals.initiator', 'initiator')
                    ->first();
                    //dd($companyinitator);
      $company_id=$companyinitator->company_id;
    $approve1=DB::table('employeerequisitions')
             ->where('id',$id)
             ->update(['stage2' => "1", 'action'=>'2']);

           $job = EmployeeRequisition::find($id);
    $ldate = date('Y-m-d H:i:s');
    $storeapprove1=DB::table('requsitionsapprovals')
                              ->insert([
                                     'jobid' => $id,
                                     'userId' => Auth::user()->id,
                                     'date'=>$ldate,
                                    ]);

   //store that it has been approved

  
            //proceed to send email to the group CEO client 

            //getrole the initiator 
        $initiatorcompany=DB::table('requsitionsapprovals')
                                 ->join('users', 'users.id','=' ,'requsitionsapprovals.userId')
                                 ->join('companies', 'companies.id', '=', 'users.company_id')
                                 ->where('requsitionsapprovals.jobid', $id)
                                 ->where('requsitionsapprovals.initiator', 'initiator')
                                 ->first()->company_id;
             //get the auth user role 
             $user_id=Auth::user()->company_id;
            //get the company name of the initiator
             $companyname=DB::table('companies')
                          ->where('id',$initiatorcompany)
                          ->first();
               //get the company name of the auth user 
            $companynameexec=DB::table('companies')
                          ->where('id',$user_id)
                          ->first();            
             if ($companyname->company=="StepWise" && $companynameexec->company=="StepWise") {
                $towhomtosendemail=DB::table('requsitionsapprovals')
                         ->join('users', 'users.id', '=', 'requsitionsapprovals.userId')
                         ->where('requsitionsapprovals.jobid', $id)
                          ->get(); 
             //send email to notify those in the back
             foreach($towhomtosendemail as $usersemails)
             { 
                            $data = array(
                'user'=>Auth::user()->id, 
                'username'=>Auth::user()->name,  
                'id'=> $job->id,
                  'stages'=> [
                                'HR Recruitment Team'=>$job->stages,
                                'HR Manager'=>$job->stage1,'Executive Lead'=>$job->stage2,
                                'Group CEO'=>$job->stage3
                        ],
                'company_id'=>$company_id,
                'jobtittle'      =>  $job->jobtittle,
                'positions'      =>  $job->positions,
                'employementtype'      =>  $job->employementtype,
                'salary'      =>  $job->salary,
                // 'salaryto'      =>  $job->salaryto,
                'responsibilities'      =>  $job->responsibilities,
                'posrequirements'      =>  $job->posrequirements,
                'posskills'      =>  $job->posskills,
                'location'   =>   $job->location,
                'jobcategory'   =>   $job->jobcategory,
               'intenting'   =>   unserialize($job->intenting),
                'startdate'   =>   $job->startdate,
                'manager'   =>   $job->manager,
                'pwd'   =>   $job->pwd,
                'rec'=>$usersemails->id,
                'interviews'   => unserialize( $job->interviews),
                'jobdescription'   =>   $job->jobdescription
        );
                //dd($usersemails->email);
                \Mail::to($usersemails->email)->send(new \App\Mail\groupceoisexec($data));

            }
            $approve1=DB::table('employeerequisitions')
             ->where('id',$id)
             ->update(['stage3' => "1",
                        'approved_status'=>"1", 'action'=>'3'
              ]);
             Alert::success('Success',' Requisition  has been approved successfully');
             return back();
            // return redirect()->route('employeerequisitions.index');
                                 
                }    


                     $towhomtosendemail=DB::table('requsitionsapprovals')
                         ->join('users', 'users.id', '=', 'requsitionsapprovals.userId')
                         ->where('requsitionsapprovals.jobid', $id)
                          ->get(); 
             //send email to notify those in the back
             foreach($towhomtosendemail as $usersemails)
             { 
                $data = array(
                'user'=>Auth::user()->id, 
                'username'=>Auth::user()->name,  
                'id'=> $job->id,
                  'stages'=> [
                                'HR Recruitment Team'=>$job->stages,
                                'HR Manager'=>$job->stage1,'Executive Lead'=>$job->stage2,
                                'Group CEO'=>$job->stage3
                        ],
                'company_id'=>$company_id,
                'jobtittle'      =>  $job->jobtittle,
                'positions'      =>  $job->positions,
                'employementtype'      =>  $job->employementtype,
                'salary'      =>  $job->salary,
                // 'salaryto'      =>  $job->salaryto,
                'responsibilities'      =>  $job->responsibilities,
                'posrequirements'      =>  $job->posrequirements,
                'posskills'      =>  $job->posskills,
                'location'   =>   $job->location,
                'jobcategory'   =>   $job->jobcategory,
               'intenting'   =>   unserialize($job->intenting),
                'startdate'   =>   $job->startdate,
                'manager'   =>   $job->manager,
                'pwd'   =>   $job->pwd,
                'rec'=>$usersemails->id,
                'interviews'   => unserialize( $job->interviews),
                'jobdescription'   =>   $job->jobdescription
        );
                //dd($usersemails->email);
                \Mail::to($usersemails->email)->send(new \App\Mail\execapprovingtoceorecruinitiatornotify($data));
            }  

            $sendmailtogroupceo=DB::table('employeerequisitionusers')
                               ->join('users', 'users.id','=', 'employeerequisitionusers.userId')
                               ->where('employeerequisitionusers.employeetype', 'Group CEO')   
                               ->first();
                               //dd($sendmailtogroupceo);  
                $data = array(
                'user'=>Auth::user()->id, 
                'username'=>Auth::user()->name,  
                'id'=> $job->id,
                  'stages'=> [
                                'HR Recruitment Team'=>$job->stages,
                                'HR Manager'=>$job->stage1,'Executive Lead'=>$job->stage2,
                                'Group CEO'=>$job->stage3
                        ],
                'company_id'=>$company_id,
                'jobtittle'      =>  $job->jobtittle,
                'positions'      =>  $job->positions,
                'employementtype'      =>  $job->employementtype,
                'salary'      =>  $job->salary,
                // 'salaryto'      =>  $job->salaryto,
                'responsibilities'      =>  $job->responsibilities,
                'posrequirements'      =>  $job->posrequirements,
                'posskills'      =>  $job->posskills,
                'location'   =>   $job->location,
                'jobcategory'   =>   $job->jobcategory,
               'intenting'   =>   unserialize($job->intenting),
                'startdate'   =>   $job->startdate,
                'manager'   =>   $job->manager,
                'pwd'   =>   $job->pwd,
                'rec'=>$sendmailtogroupceo->id,
                'interviews'   => unserialize( $job->interviews),
                'jobdescription'   =>   $job->jobdescription
        );  
              \Mail::to($sendmailtogroupceo->email)->send(new \App\Mail\execapprovingtoceorecruinitiator($data));
        Alert::success('Success',' Requisition  has been approved successfully');
         // return redirect()->route('employeerequisitions.index');
                     return back();
 }
 /**
  * approvals final by the chief ceo when the emails direct
  * */
 public function approvefromchief1($id, $rec){
 $checkaction=DB::table('employeerequisitions')
            ->where('id', $id)
            ->first();
            if ($checkaction->action ==4) {
         Alert::success('Success',' Requisition  Action has already occured!!');
         return redirect()->route('employeerequisitions.approvesmessage')->with('success','Requisition  Action has already occured!!');
            }
$companyinitator=DB::table('requsitionsapprovals')
                    ->where('requsitionsapprovals.jobid', $id)
                    ->orwhere('requsitionsapprovals.initiator', 'initiator')
                    ->first();
                    //dd($companyinitator);
      $company_id=$companyinitator->company_id;
        $job = EmployeeRequisition::find($id);
        $ldate = date('Y-m-d H:i:s');
               $storeapprove1=DB::table('requsitionsapprovals')
                              ->insert([
                                     'jobid' => $id,
                                     'userId' => $rec,
                                     'date'=>$ldate,
                                    ]);

     //store that it has been approved by the final approver
       $towhomtosendemail=DB::table('requsitionsapprovals')
                         ->join('users', 'users.id', '=', 'requsitionsapprovals.userId')
                         ->where('requsitionsapprovals.jobid', $id)
                          ->get();              
             foreach($towhomtosendemail as $usersemails)
             { 
            $data = array(
                'user'=>$rec, 
  
                'id'=> $job->id,
                'stages'=> [
                                'HR Recruitment Team'=>$job->stages,
                                'HR Manager'=>$job->stage1,'Executive Lead'=>$job->stage2,
                                'Group CEO'=>$job->stage3
                        ],
                'company_id'=>$company_id,
                'jobtittle'      =>  $job->jobtittle,
                'positions'      =>  $job->positions,
                'employementtype'      =>  $job->employementtype,
                'salary'      =>  $job->salary,
                // 'salaryto'      =>  $job->salaryto,
                'responsibilities'      =>  $job->responsibilities,
                'posrequirements'      =>  $job->posrequirements,
                'posskills'      =>  $job->posskills,
                'location'   =>   $job->location,
                'jobcategory'   =>   $job->jobcategory,
               'intenting'   =>   unserialize($job->intenting),
                'startdate'   =>   $job->startdate,
                'manager'   =>   $job->manager,
                'pwd'   =>   $job->pwd,
                'rec'=>$usersemails->id,
                 'interviews'   => unserialize( $job->interviews),
                'jobdescription'   =>   $job->jobdescription
        );
                //dd($usersemails->email);
                \Mail::to($usersemails->email)->send(new \App\Mail\approvalsfromchiefceoemail($data));
            }

        $approve1=DB::table('employeerequisitions')
             ->where('id',$id)
             ->update(['stage3' => "1",
                        'approved_status'=>"1", 'action'=>'4'
              ]);
            // Alert::success('Success','Chief CEO approvals have been made successfully');
            // return back();
        Alert::success('Success',' Requisition  has been approved successfully');
        return redirect()->route('employeerequisitions.approvesmessage')->with('success','Requisition  has been approved successfully');
 }
 /**
  * approvals final by the chief ceo
  * approvefromchief
  * */
  public function approvefromchief($id){
 $checkaction=DB::table('employeerequisitions')
            ->where('id', $id)
            ->first();
            if ($checkaction->action ==4) {
         Alert::success('Success',' Requisition  Action has already occured!!');
         return redirect()->route('tabspage');
            }
$companyinitator=DB::table('requsitionsapprovals')
                    ->where('requsitionsapprovals.jobid', $id)
                    ->orwhere('requsitionsapprovals.initiator', 'initiator')
                    ->first();
                    //dd($companyinitator);
      $company_id=$companyinitator->company_id;
        $job = EmployeeRequisition::find($id);
        $ldate = date('Y-m-d H:i:s');
               $storeapprove1=DB::table('requsitionsapprovals')
                              ->insert([
                                     'jobid' => $id,
                                     'userId' => Auth::user()->id,
                                     'date'=>$ldate,
                                    ]);

     //store that it has been approved by the final approver
       $towhomtosendemail=DB::table('requsitionsapprovals')
                         ->join('users', 'users.id', '=', 'requsitionsapprovals.userId')
                         ->where('requsitionsapprovals.jobid', $id)
                          ->get();              
             foreach($towhomtosendemail as $usersemails)
             { 
                $data = array(
                'user'=>Auth::user()->id, 
                'username'=>Auth::user()->name,  
                'id'=> $job->id,
                'stages'=> [
                                'HR Recruitment Team'=>$job->stages,
                                'HR Manager'=>$job->stage1,'Executive Lead'=>$job->stage2,
                                'Group CEO'=>$job->stage3
                        ],
                'company_id'=>$company_id,
                'jobtittle'      =>  $job->jobtittle,
                'positions'      =>  $job->positions,
                'employementtype'      =>  $job->employementtype,
                'salary'      =>  $job->salary,
                // 'salaryto'      =>  $job->salaryto,
                'responsibilities'      =>  $job->responsibilities,
                'posrequirements'      =>  $job->posrequirements,
                'posskills'      =>  $job->posskills,
                'location'   =>   $job->location,
                'jobcategory'   =>   $job->jobcategory,
               'intenting'   =>   unserialize($job->intenting),
                'startdate'   =>   $job->startdate,
                'manager'   =>   $job->manager,
                'pwd'   =>   $job->pwd,
                'rec'=>$usersemails->id,
                 'interviews'   => unserialize( $job->interviews),
                'jobdescription'   =>   $job->jobdescription
        );
                //dd($usersemails->email);
                \Mail::to($usersemails->email)->send(new \App\Mail\approvalsfromchiefceo($data));
            }

        $approve1=DB::table('employeerequisitions')
             ->where('id',$id)
             ->update(['stage3' => "1",
                        'approved_status'=>"1", 'action'=>'4'
              ]);
            // Alert::success('Success','Chief CEO approvals have been made successfully');
            // return back();
        Alert::success('Success',' Requisition  has been approved successfully');
        return back();
         // return redirect()->route('employeerequisitions.index');
 }
 /**
  * chief approving final approvals when the initiator was executive manager
  * 
  * */
 public function groupceotoexec($id){
$checkaction=DB::table('employeerequisitions')
            ->where('id', $id)
            ->first();
            if ($checkaction->action ==1) {
         Alert::success('Success',' Requisition  Action has already occured!!');
         return redirect()->route('tabspage');
            }
    Auth::user()->id;
$companyinitator=DB::table('requsitionsapprovals')
                    ->where('requsitionsapprovals.jobid', $id)
                    ->orwhere('requsitionsapprovals.initiator', 'initiator')
                    ->first();
                    //dd($companyinitator);
      $company_id=$companyinitator->company_id;
        $job = EmployeeRequisition::find($id);
        $ldate = date('Y-m-d H:i:s');
               $storeapprove1=DB::table('requsitionsapprovals')
                              ->insert([
                                     'jobid' => $id,
                                     'userId' => Auth::user()->id,
                                     'date'=>$ldate,
                                    ]);

     //store that it has been approved by the final approver
       $towhomtosendemail=DB::table('requsitionsapprovals')
                         ->join('users', 'users.id', '=', 'requsitionsapprovals.userId')
                         ->where('requsitionsapprovals.jobid', $id)
                          ->get();              
             foreach($towhomtosendemail as $usersemails)
             { 
                 $data = array(
                'user'=>Auth::user()->id, 
                'username'=>Auth::user()->name,  
                'id'=> $job->id,
                'stages'=> [
                                'HR Recruitment Team'=>$job->stages,
                                'HR Manager'=>$job->stage1,'Executive Lead'=>$job->stage2,
                                'Group CEO'=>$job->stage3
                        ],
                'company_id'=>$company_id,
                'jobtittle'      =>  $job->jobtittle,
                'positions'      =>  $job->positions,
                'employementtype'      =>  $job->employementtype,
                'salary'      =>  $job->salary,
                // 'salaryto'      =>  $job->salaryto,
                'responsibilities'      =>  $job->responsibilities,
                'posrequirements'      =>  $job->posrequirements,
                'posskills'      =>  $job->posskills,
                'location'   =>   $job->location,
                'jobcategory'   =>   $job->jobcategory,
               'intenting'   =>   unserialize($job->intenting),
                'startdate'   =>   $job->startdate,
                'manager'   =>   $job->manager,
                'pwd'   =>   $job->pwd,
                'rec'=>$usersemails->id,
                 'interviews'   => unserialize( $job->interviews),
                'jobdescription'   =>   $job->jobdescription
        );
                //dd($usersemails->email);
                \Mail::to($usersemails->email)->send(new \App\Mail\groupceotoexec($data));
            }

        $approve1=DB::table('employeerequisitions')
             ->where('id',$id)
             ->update(['stage3' => "1",
                        'approved_status'=>"1", 'action'=>'1'
              ]);
            // Alert::success('Success','Chief CEO approvals have been made successfully');
            // 
                Alert::success('Success',' Requisition  has been approved successfully');
                return redirect()->route('tabspage');
         // return redirect()->route('employeerequisitions.index');
 }
 /** ceo approving finqal aqpprovals when the initiator is hr maqnager emqail approvals
  * */
 public function approvefromchiefhrinitiator1($id, $rec){
$checkaction=DB::table('employeerequisitions')
            ->where('id', $id)
            ->first();
            if ($checkaction->action ==2) {
         Alert::success('Success',' Requisition  Action has already occured!!');
         return redirect()->route('employeerequisitions.approvesmessage')->with('success','Requisition  Action has already occured!!.');
            }

$companyinitator=DB::table('requsitionsapprovals')
                    ->where('requsitionsapprovals.jobid', $id)
                    ->orwhere('requsitionsapprovals.initiator', 'initiator')
                    ->first();
                    //dd($companyinitator);
      $company_id=$companyinitator->company_id;
        $job = EmployeeRequisition::find($id); 
        $ldate = date('Y-m-d H:i:s');
               $storeapprove1=DB::table('requsitionsapprovals')
                              ->insert([
                                     'jobid' => $id,
                                     'userId' => $rec,
                                     'date'=>$ldate,
                                    ]);

     //store that it has been approved by the final approver
       $towhomtosendemail=DB::table('requsitionsapprovals')
                         ->join('users', 'users.id', '=', 'requsitionsapprovals.userId')
                         ->where('requsitionsapprovals.jobid', $id)
                          ->get();              
             foreach($towhomtosendemail as $usersemails)
             { 
             $data = array(
                'user'=>$rec, 
  
                'id'=> $job->id,
                'stages'=> [
                                'HR Recruitment Team'=>$job->stages,
                                'HR Manager'=>$job->stage1,'Executive Lead'=>$job->stage2,
                                'Group CEO'=>$job->stage3
                        ],
                'company_id'=>$company_id,
                'jobtittle'      =>  $job->jobtittle,
                'positions'      =>  $job->positions,
                'employementtype'      =>  $job->employementtype,
                'salary'      =>  $job->salary,
                // 'salaryto'      =>  $job->salaryto,
                'responsibilities'      =>  $job->responsibilities,
                'posrequirements'      =>  $job->posrequirements,
                'posskills'      =>  $job->posskills,
                'location'   =>   $job->location,
                'jobcategory'   =>   $job->jobcategory,
               'intenting'   =>   unserialize($job->intenting),
                'startdate'   =>   $job->startdate,
                'manager'   =>   $job->manager,
                'pwd'   =>   $job->pwd,
                'rec'=>$usersemails->id,
                'interviews'   => unserialize( $job->interviews),
                'jobdescription'   =>   $job->jobdescription
        );
                //dd($usersemails->email);
                \Mail::to($usersemails->email)->send(new \App\Mail\approvefromchiefhrinitiatoremail($data));
            }

        $approve1=DB::table('employeerequisitions')
             ->where('id',$id)
             ->update(['stage3' => "1",
                        'approved_status'=>"1", 'action'=>2
              ]);
            // Alert::success('Success','Chief CEO approvals have been made successfully');
            // return back();
                                   Alert::success('Success',' Requisition  has been approved successfully');
         return redirect()->route('employeerequisitions.approvesmessage')->with('success','Requisition  has been approved successfully');
 }
 /**
  * cheif ceo approving final approvals when the initator was hr manager
  * */
  public function approvefromchiefhrinitiator($id){
$checkaction=DB::table('employeerequisitions')
            ->where('id', $id)
            ->first();
            if ($checkaction->action ==2) {
         Alert::success('Success',' Requisition  Action has already occured!!');
         return redirect()->route('tabspage');
            }
    
$companyinitator=DB::table('requsitionsapprovals')
                    ->where('requsitionsapprovals.jobid', $id)
                    ->orwhere('requsitionsapprovals.initiator', 'initiator')
                    ->first();
                    //dd($companyinitator);
      $company_id=$companyinitator->company_id;
        $job = EmployeeRequisition::find($id); 
        $ldate = date('Y-m-d H:i:s');
               $storeapprove1=DB::table('requsitionsapprovals')
                              ->insert([
                                     'jobid' => $id,
                                     'userId' => Auth::user()->id,
                                     'date'=>$ldate,
                                    ]);

     //store that it has been approved by the final approver
       $towhomtosendemail=DB::table('requsitionsapprovals')
                         ->join('users', 'users.id', '=', 'requsitionsapprovals.userId')
                         ->where('requsitionsapprovals.jobid', $id)
                          ->get();              
             foreach($towhomtosendemail as $usersemails)
             { 
              $data = array(
                'user'=>Auth::user()->id, 
                'username'=>Auth::user()->name,  
                'id'=> $job->id,
                'stages'=> [
                                'HR Recruitment Team'=>$job->stages,
                                'HR Manager'=>$job->stage1,'Executive Lead'=>$job->stage2,
                                'Group CEO'=>$job->stage3
                        ],
                'company_id'=>$company_id,
                'jobtittle'      =>  $job->jobtittle,
                'positions'      =>  $job->positions,
                'employementtype'      =>  $job->employementtype,
                'salary'      =>  $job->salary,
                // 'salaryto'      =>  $job->salaryto,
                'responsibilities'      =>  $job->responsibilities,
                'posrequirements'      =>  $job->posrequirements,
                'posskills'      =>  $job->posskills,
                'location'   =>   $job->location,
                'jobcategory'   =>   $job->jobcategory,
               'intenting'   =>   unserialize($job->intenting),
                'startdate'   =>   $job->startdate,
                'manager'   =>   $job->manager,
                'pwd'   =>   $job->pwd,
                'rec'=>$usersemails->id,
                'interviews'   => unserialize( $job->interviews),
                'jobdescription'   =>   $job->jobdescription
        );
                //dd($usersemails->email);
                \Mail::to($usersemails->email)->send(new \App\Mail\approvefromchiefhrinitiator($data));
            }

        $approve1=DB::table('employeerequisitions')
             ->where('id',$id)
             ->update(['stage3' => "1",
                        'approved_status'=>"1", 'action'=>2
              ]);
            // Alert::success('Success','Chief CEO approvals have been made successfully');
            // 
            Alert::success('Success',' Requisition  has been approved successfully');
           return redirect()->route('tabspage');
         // return redirect()->route('employeerequisitions.index');
 }
 /*** 
  * chief ceo approving the final approval when the initiator is the rec 
  * via email */
 public function approvefromchiefrecruinitiator1($id, $rec){
 $checkaction=DB::table('employeerequisitions')
            ->where('id', $id)
            ->first();
            if ($checkaction->action ==3) {
         Alert::success('Success',' Requisition  Action has already occured!!');
         return redirect()->route('employeerequisitions.approvesmessage')->with('success','Requisition  Action has already occured!!');
            }
$companyinitator=DB::table('requsitionsapprovals')
                    ->where('requsitionsapprovals.jobid', $id)
                    ->orwhere('requsitionsapprovals.initiator', 'initiator')
                    ->first();
                    //dd($companyinitator);
      $company_id=$companyinitator->company_id;
        $job = EmployeeRequisition::find($id);
 
        $ldate = date('Y-m-d H:i:s');
               $storeapprove1=DB::table('requsitionsapprovals')
                              ->insert([
                                     'jobid' => $id,
                                     'userId' => $rec,
                                     'date'=>$ldate,
                                    ]);
     //store that it has been approved by the final approver
       $towhomtosendemail=DB::table('requsitionsapprovals')
                         ->join('users', 'users.id', '=', 'requsitionsapprovals.userId')
                         ->where('requsitionsapprovals.jobid', $id)
                          ->get();              
             foreach($towhomtosendemail as $usersemails)
             { 
                            $data = array(
                'user'=>$rec, 
                'id'=> $job->id,
                'stages'=> [
                                'HR Recruitment Team'=>$job->stages,
                                'HR Manager'=>$job->stage1,'Executive Lead'=>$job->stage2,
                                'Group CEO'=>$job->stage3
                        ],
                'company_id'=>$company_id,
                'jobtittle'      =>  $job->jobtittle,
                'positions'      =>  $job->positions,
                'employementtype'      =>  $job->employementtype,
                'salary'      =>  $job->salary,
                // 'salaryto'      =>  $job->salaryto,
                'responsibilities'      =>  $job->responsibilities,
                'posrequirements'      =>  $job->posrequirements,
                'posskills'      =>  $job->posskills,
                'location'   =>   $job->location,
                'jobcategory'   =>   $job->jobcategory,
               'intenting'   =>   unserialize($job->intenting),
                'startdate'   =>   $job->startdate,
                'manager'   =>   $job->manager,
                'pwd'   =>   $job->pwd,
                'rec'=>$usersemails->id,
                 'interviews'   => unserialize( $job->interviews),
                'jobdescription'   =>   $job->jobdescription
        );
                //dd($usersemails->email);
                \Mail::to($usersemails->email)->send(new \App\Mail\approvefromchiefrecruinitiatoremail($data));
            }

        $approve1=DB::table('employeerequisitions')
             ->where('id',$id)
             ->update(['stage3' => "1",
                        'approved_status'=>"1", 'action'=>'3'
              ]);
            // Alert::success('Success','Chief CEO approvals have been made successfully');
            // return back();
        Alert::success('Success',' Requisition  has been approved successfully');
          return redirect()->route('employeerequisitions.approvesmessage')->with('success','Requisition  has been approved successfully');
 } 
 /**
  * chief ceo approving the final approaval when the initiator was hr recruter
  * 
  * */
   public function approvefromchiefrecruinitiator($id){
 $checkaction=DB::table('employeerequisitions')
            ->where('id', $id)
            ->first();
            if ($checkaction->action ==3) {
         Alert::success('Success',' Requisition  Action has already occured!!');
         return redirect()->route('tabspage');
            }
    Auth::user()->id;
$companyinitator=DB::table('requsitionsapprovals')
                    ->where('requsitionsapprovals.jobid', $id)
                    ->orwhere('requsitionsapprovals.initiator', 'initiator')
                    ->first();
                    //dd($companyinitator);
      $company_id=$companyinitator->company_id;
        $job = EmployeeRequisition::find($id);
 
        $ldate = date('Y-m-d H:i:s');
               $storeapprove1=DB::table('requsitionsapprovals')
                              ->insert([
                                     'jobid' => $id,
                                     'userId' => Auth::user()->id,
                                     'date'=>$ldate,
                                    ]);

     //store that it has been approved by the final approver
       $towhomtosendemail=DB::table('requsitionsapprovals')
                         ->join('users', 'users.id', '=', 'requsitionsapprovals.userId')
                         ->where('requsitionsapprovals.jobid', $id)
                          ->get();              
             foreach($towhomtosendemail as $usersemails)
             { 
                    $data = array(
                'user'=>Auth::user()->id, 
                'username'=>Auth::user()->name,  
                'id'=> $job->id,
                'stages'=> [
                                'HR Recruitment Team'=>$job->stages,
                                'HR Manager'=>$job->stage1,'Executive Lead'=>$job->stage2,
                                'Group CEO'=>$job->stage3
                        ],
                'company_id'=>$company_id,
                'jobtittle'      =>  $job->jobtittle,
                'positions'      =>  $job->positions,
                'employementtype'      =>  $job->employementtype,
                'salary'      =>  $job->salary,
                // 'salaryto'      =>  $job->salaryto,
                'responsibilities'      =>  $job->responsibilities,
                'posrequirements'      =>  $job->posrequirements,
                'posskills'      =>  $job->posskills,
                'location'   =>   $job->location,
                'jobcategory'   =>   $job->jobcategory,
               'intenting'   =>   unserialize($job->intenting),
                'startdate'   =>   $job->startdate,
                'manager'   =>   $job->manager,
                'pwd'   =>   $job->pwd,
                'rec'=>$usersemails->id,
                 'interviews'   => unserialize( $job->interviews),
                'jobdescription'   =>   $job->jobdescription
        );
                //dd($usersemails->email);
                \Mail::to($usersemails->email)->send(new \App\Mail\approvefromchiefrecruinitiator($data));
            }

        $approve1=DB::table('employeerequisitions')
             ->where('id',$id)
             ->update(['stage3' => "1",
                        'approved_status'=>"1", 'action'=>'3'
              ]);
            // Alert::success('Success','Chief CEO approvals have been made successfully');
            
        Alert::success('Success',' Requisition  has been approved successfully');
        return redirect()->route('tabspage');
         // return redirect()->route('employeerequisitions.index');
 } 


 /** declines from the eexecutive when the initiator is rec to hiring declinefromexecrecinitatortohiring
   * */
public function declinefromexecrecinitatortohiring(Request $request){
 $id=$request->jobid;

   $checkaction=DB::table('employeerequisitions')
            ->where('id', $id)
            ->first();
            if ($checkaction->action ==3 || $checkaction->action ==4) {
         Alert::success('Success',' Requisition  Action has already occured!!');
         return redirect()->route('tabspage');
            }
   $ldate = date('Y-m-d H:i:s');

    $insertdecline=DB::table('requisitionsdeclines')
                ->insert([
                        'jobid' => $id,
                        'userId' => Auth::user()->id,
                        'date'=>$ldate,
                         ]);
    $companyinitator=DB::table('requsitionsapprovals')
                    ->where('requsitionsapprovals.jobid', $id)
                    ->where('requsitionsapprovals.initiator', 'initiator')
                    ->first();
                    //dd($companyinitator);
      $company_id=$companyinitator->company_id;  
        $decline1=DB::table('employeerequisitions')
             ->where('id',$id)
             ->update([
                       'stages'=>1, 'stage1'=>1, 'stage2'=>1, 'approved_status'=>"2", 'action'=>'3', 'comment'=>$request->comment
                      ]);

           $job = EmployeeRequisition::find($id);
            $data = array(
                'user'=>Auth::user()->id, 
                'username'=>Auth::user()->name,  
                'id'=> $job->id,
                'stages'=> [
                                'HR Recruitment Team'=>$job->stages,
                                'HR Manager'=>$job->stage1,'Executive Lead'=>$job->stage2,
                                'Group CEO'=>$job->stage3
                        ],
                'company_id'=>$company_id,
                'jobtittle'      =>  $job->jobtittle,
                'positions'      =>  $job->positions,
                'employementtype'      =>  $job->employementtype,
                'salary'      =>  $job->salary,
                // 'salaryto'      =>  $job->salaryto,
                'responsibilities'      =>  $job->responsibilities,
                'posrequirements'      =>  $job->posrequirements,
                'posskills'      =>  $job->posskills,
                'location'   =>   $job->location,
                'jobcategory'   =>   $job->jobcategory,
                'intenting'   =>   unserialize($job->intenting),
                'startdate'   =>   $job->startdate,
                'manager'   =>   $job->manager,
                'pwd'   =>   $job->pwd,
                 'interviews'   => unserialize( $job->interviews),
                'jobdescription'   =>   $job->jobdescription
        );   
            $declinesemails=DB::table('requisitionsdeclines')
                   ->join('users','users.id', '=', 'requisitionsdeclines.userId')
                    ->where('requisitionsdeclines.jobid', $id)
                   ->first();  
            \Mail::to($declinesemails->email)->send(new \App\Mail\declinefromexecrecinitatortohiring($data));
              // dd($declinesemails);
               $towhomtosendemail=DB::table('requsitionsapprovals')
                         ->join('users', 'requsitionsapprovals.userId', '=', 'users.id')
                         // ->join('requisitionsdeclines', 'users.id', '=', 'requisitionsdeclines.userId')
                          ->where('requsitionsapprovals.jobid', $id)
                         ->get();
                   
             foreach($towhomtosendemail as $usersemails)
             { 
                //dd($usersemails->email);
                \Mail::to($usersemails->email)->send(new \App\Mail\declinefromexecrecinitatortohiring($data));
            }

                           Alert::success('Success',' Requisition  has been decline successfully');
         return redirect()->route('tabspage');



 }
 /**
  * decline from hiring  to recruiter when the rec initiates on the behalf
  * 
  * 
  */
 public function declinefromhiringrecinitiator(Request $request){
 $id=$request->jobid;

   $checkaction=DB::table('employeerequisitions')
            ->where('id', $id)
            ->first();
            if ($checkaction->action ==1||$checkaction->action ==2||$checkaction->action ==3||$checkaction->action ==4||$checkaction->action ==5) {
         Alert::success('Success',' Requisition  Action has already occured!!');
         return redirect()->route('tabspage');
            }
   $ldate = date('Y-m-d H:i:s');

    $insertdecline=DB::table('requisitionsdeclines')
                ->insert([
                        'jobid' => $id,
                        'userId' => Auth::user()->id,
                        'date'=>$ldate,
                         ]);
    $companyinitator=DB::table('requsitionsapprovals')
                    ->where('requsitionsapprovals.jobid', $id)
                    ->where('requsitionsapprovals.initiator', 'initiator')
                    ->first();
                    //dd($companyinitator);
      $company_id=$companyinitator->company_id;  
        $decline1=DB::table('employeerequisitions')
             ->where('id',$id)
             ->update([
                       'stages'=>1, 'stage1'=>1, 'stage2'=>1, 'approved_status'=>"2", 'action'=>'2', 'comment'=>$request->comment
                      ]);

           $job = EmployeeRequisition::find($id);
            $data = array(
                'user'=>Auth::user()->id, 
                'username'=>Auth::user()->name,  
                'id'=> $job->id,
                'stages'=> [
                                'HR Recruitment Team'=>$job->stages,
                                'HR Manager'=>$job->stage1,'Executive Lead'=>$job->stage2,
                                'Group CEO'=>$job->stage3
                        ],
                'company_id'=>$company_id,
                'jobtittle'      =>  $job->jobtittle,
                'positions'      =>  $job->positions,
                'employementtype'      =>  $job->employementtype,
                'salary'      =>  $job->salary,
                // 'salaryto'      =>  $job->salaryto,
                'responsibilities'      =>  $job->responsibilities,
                'posrequirements'      =>  $job->posrequirements,
                'posskills'      =>  $job->posskills,
                'location'   =>   $job->location,
                'jobcategory'   =>   $job->jobcategory,
                'intenting'   =>   unserialize($job->intenting),
                'startdate'   =>   $job->startdate,
                'manager'   =>   $job->manager,
                'pwd'   =>   $job->pwd,
                 'interviews'   => unserialize( $job->interviews),
                'jobdescription'   =>   $job->jobdescription
        );   
            $declinesemails=DB::table('requisitionsdeclines')
                   ->join('users','users.id', '=', 'requisitionsdeclines.userId')
                    ->where('requisitionsdeclines.jobid', $id)
                   ->first();  
            \Mail::to($declinesemails->email)->send(new \App\Mail\declinefromhiringrecinitiator($data));
              // dd($declinesemails);
               $towhomtosendemail=DB::table('requsitionsapprovals')
                         ->join('users', 'requsitionsapprovals.userId', '=', 'users.id')
                         // ->join('requisitionsdeclines', 'users.id', '=', 'requisitionsdeclines.userId')
                          ->where('requsitionsapprovals.jobid', $id)
                         ->get();
                   
             foreach($towhomtosendemail as $usersemails)
             { 
                //dd($usersemails->email);
                \Mail::to($usersemails->email)->send(new \App\Mail\declinefromhiringrecinitiator($data));
            }

                           Alert::success('Success',' Requisition  has been decline successfully');
         return redirect()->route('tabspage');



 }


 /** decline when the exec is the initiator nd ceo is declining declinefromhrrecinitatortohiring
  * */
public function declinefromhrrecinitatortohiring(Request $request){
    $id=$request->jobid;
$checkaction=DB::table('employeerequisitions')
            ->where('id', $id)
            ->first();
            if ($checkaction->action ==2 ||$checkaction->action ==3||$checkaction->action ==4||$checkaction->action ==5) {
         Alert::success('Success',' Requisition  Action has already occured!!');
        return redirect()->route('tabspage');
            }
   $ldate = date('Y-m-d H:i:s');

    $insertdecline=DB::table('requisitionsdeclines')
                ->insert([
                        'jobid' => $id,
                        'userId' => Auth::user()->id,
                        'date'=>$ldate,
                         ]);
    $companyinitator=DB::table('requsitionsapprovals')
                    ->where('requsitionsapprovals.jobid', $id)
                    ->where('requsitionsapprovals.initiator', 'initiator')
                    ->first();
                    //dd($companyinitator);
      $company_id=$companyinitator->company_id;  
      // check if job have been approved at first
         
        $decline1=DB::table('employeerequisitions')
             ->where('id',$id)
             ->update([
                       'stages'=>1, 'stage1'=>1, 'stage2'=>1,'stage3'=>1, 'approved_status'=>"2",'action'=>'2', 'comment'=>$request->comment
                      ]);

           $job = EmployeeRequisition::find($id);
            $data = array(
                'user'=>Auth::user()->id, 
                'username'=>Auth::user()->name,  
                'id'=> $job->id,
                'stages'=> [
                                'HR Recruitment Team'=>$job->stages,
                                'HR Manager'=>$job->stage1,'Executive Lead'=>$job->stage2,
                                'Group CEO'=>$job->stage3
                        ],
                'company_id'=>$company_id,
                'jobtittle'      =>  $job->jobtittle,
                'positions'      =>  $job->positions,
                'employementtype'      =>  $job->employementtype,
                'salary'      =>  $job->salary,
                // 'salaryto'      =>  $job->salaryto,
                'responsibilities'      =>  $job->responsibilities,
                'posrequirements'      =>  $job->posrequirements,
                'posskills'      =>  $job->posskills,
                'location'   =>   $job->location,
                'jobcategory'   =>   $job->jobcategory,
                'intenting'   =>   unserialize($job->intenting),
                'startdate'   =>   $job->startdate,
                'manager'   =>   $job->manager,
                'pwd'   =>   $job->pwd,
                 'interviews'   => unserialize( $job->interviews),
                'jobdescription'   =>   $job->jobdescription
        );   
            $declinesemails=DB::table('requisitionsdeclines')
                   ->join('users','users.id', '=', 'requisitionsdeclines.userId')
                    ->where('requisitionsdeclines.jobid', $id)
                   ->first();  
            \Mail::to($declinesemails->email)->send(new \App\Mail\declinefromhrrecinitatortohiring($data));
              // dd($declinesemails);
               $towhomtosendemail=DB::table('requsitionsapprovals')
                         ->join('users', 'requsitionsapprovals.userId', '=', 'users.id')
                         // ->join('requisitionsdeclines', 'users.id', '=', 'requisitionsdeclines.userId')
                          ->where('requsitionsapprovals.jobid', $id)
                         ->get();
                   
             foreach($towhomtosendemail as $usersemails)
             { 
                //dd($usersemails->email);
                \Mail::to($usersemails->email)->send(new \App\Mail\declinefromhrrecinitatortohiring($data));
            }

                           Alert::success('Success',' Requisition  has been decline successfully');
         return redirect()->route('tabspage');

}

 /** decline from ceo when the emp is the initiator declinefroceoempinitator
  * */
 public function declinefroceoempinitator(Request $request){
$id=$request->jobid;
$checkaction=DB::table('employeerequisitions')
            ->where('id', $id)
            ->first();
            if ($checkaction->action ==4) {
         Alert::success('Success',' Requisition  Action has already occured!!');
return redirect()->route('tabspage');
            }
   $ldate = date('Y-m-d H:i:s');

    $insertdecline=DB::table('requisitionsdeclines')
                ->insert([
                        'jobid' => $id,
                        'userId' => Auth::user()->id,
                        'date'=>$ldate,
                         ]);
    $companyinitator=DB::table('requsitionsapprovals')
                    ->where('requsitionsapprovals.jobid', $id)
                    ->where('requsitionsapprovals.initiator', 'initiator')
                    ->first();
                    //dd($companyinitator);
      $company_id=$companyinitator->company_id;  
        $decline1=DB::table('employeerequisitions')
             ->where('id',$id)
             ->update([
                        'stages'=>1, 'stage1'=>1, 'stage2'=>1,'stage3'=>1,'approved_status'=>"2", 'action'=>'4', 'comment'=>$request->comment
                      ]);

           $job = EmployeeRequisition::find($id);
            $data = array(
                'user'=>Auth::user()->id, 
                'username'=>Auth::user()->name,  
                'id'=> $job->id,
                'stages'=> [
                                'HR Recruitment Team'=>$job->stages,
                                'HR Manager'=>$job->stage1,'Executive Lead'=>$job->stage2,
                                'Group CEO'=>$job->stage3
                        ],
                'company_id'=>$company_id,
                'jobtittle'      =>  $job->jobtittle,
                'positions'      =>  $job->positions,
                'employementtype'      =>  $job->employementtype,
                'salary'      =>  $job->salary,
                // 'salaryto'      =>  $job->salaryto,
                'responsibilities'      =>  $job->responsibilities,
                'posrequirements'      =>  $job->posrequirements,
                'posskills'      =>  $job->posskills,
                'location'   =>   $job->location,
                'jobcategory'   =>   $job->jobcategory,
                'intenting'   =>   unserialize($job->intenting),
                'startdate'   =>   $job->startdate,
                'manager'   =>   $job->manager,
                'pwd'   =>   $job->pwd,
                 'interviews'   => unserialize( $job->interviews),
                'jobdescription'   =>   $job->jobdescription
        );   
            $declinesemails=DB::table('requisitionsdeclines')
                   ->join('users','users.id', '=', 'requisitionsdeclines.userId')
                    ->where('requisitionsdeclines.jobid', $id)
                   ->first();  
            \Mail::to($declinesemails->email)->send(new \App\Mail\declinefroceoempinitator($data));
              // dd($declinesemails);
               $towhomtosendemail=DB::table('requsitionsapprovals')
                         ->join('users', 'requsitionsapprovals.userId', '=', 'users.id')
                         // ->join('requisitionsdeclines', 'users.id', '=', 'requisitionsdeclines.userId')
                          ->where('requsitionsapprovals.jobid', $id)
                         ->get();
                   
             foreach($towhomtosendemail as $usersemails)
             { 
                //dd($usersemails->email);
                \Mail::to($usersemails->email)->send(new \App\Mail\declinefroceoempinitator($data));
            }

                           Alert::success('Success',' Requisition  has been decline successfully');
return redirect()->route('tabspage');



 }
 /** decline from recruiter when the hiring maqnager requests 
  * */
  public function declinefromrechiringinitiator(Request $request){
$id=$request->jobid;
$checkaction=DB::table('employeerequisitions')
            ->where('id', $id)
            ->first();
            if ($checkaction->action ==3 || $checkaction->action ==4 ||$checkaction->action ==1 ||$checkaction->action ==2||$checkaction->action ==5) {
         Alert::success('Success',' Requisition  Action has already occured!!');
return redirect()->route('tabspage');
            }
   $ldate = date('Y-m-d H:i:s');

    $insertdecline=DB::table('requisitionsdeclines')
                ->insert([
                        'jobid' => $id,
                        'userId' => Auth::user()->id,
                        'date'=>$ldate,
                         ]);
    $companyinitator=DB::table('requsitionsapprovals')
                    ->where('requsitionsapprovals.jobid', $id)
                    ->where('requsitionsapprovals.initiator', 'initiator')
                    ->first();
                    //dd($companyinitator);
      $company_id=$companyinitator->company_id;   
        $decline1=DB::table('employeerequisitions')
             ->where('id',$id)
             ->update([
                       'stages'=>1, 'stage1'=>1, 'stage2'=>1,'stage3'=>1, 'approved_status'=>"2" ,'action'=>'1', 'comment'=>$request->comment
                      ]);

           $job = EmployeeRequisition::find($id);
            $data = array(
                'user'=>Auth::user()->id, 
                'username'=>Auth::user()->name,  
                'id'=> $job->id,
                'stages'=> [
                                'HR Recruitment Team'=>$job->stages,
                                'HR Manager'=>$job->stage1,'Executive Lead'=>$job->stage2,
                                'Group CEO'=>$job->stage3
                        ],
                'company_id'=>$company_id,
                'jobtittle'      =>  $job->jobtittle,
                'positions'      =>  $job->positions,
                'employementtype'      =>  $job->employementtype,
                'salary'      =>  $job->salary,
                // 'salaryto'      =>  $job->salaryto,
                'responsibilities'      =>  $job->responsibilities,
                'posrequirements'      =>  $job->posrequirements,
                'posskills'      =>  $job->posskills,
                'location'   =>   $job->location,
                'jobcategory'   =>   $job->jobcategory,
                'intenting'   =>   unserialize($job->intenting),
                'startdate'   =>   $job->startdate,
                'manager'   =>   $job->manager,
                'pwd'   =>   $job->pwd,
                'interviews'   => unserialize( $job->interviews),
                'jobdescription'   =>   $job->jobdescription
        );   
            $declinesemails=DB::table('requisitionsdeclines')
                   ->join('users','users.id', '=', 'requisitionsdeclines.userId')
                    ->where('requisitionsdeclines.jobid', $id)
                   ->first();  
            \Mail::to($declinesemails->email)->send(new \App\Mail\declinefromrechiringinitiator($data));
              // dd($declinesemails);
               $towhomtosendemail=DB::table('requsitionsapprovals')
                         ->join('users', 'requsitionsapprovals.userId', '=', 'users.id')
                         // ->join('requisitionsdeclines', 'users.id', '=', 'requisitionsdeclines.userId')
                          ->where('requsitionsapprovals.jobid', $id)
                         ->get();
                   
             foreach($towhomtosendemail as $usersemails)
             { 
                //dd($usersemails->email);
                \Mail::to($usersemails->email)->send(new \App\Mail\declinefromrechiringinitiator($data));
            }

                           Alert::success('Success',' Requisition  has been decline successfully');
return redirect()->route('tabspage');



 }
 /**
  * decline when the emp is the initiator from exec declinefroexecempinitator
  * */
 public function declinefroexecempinitator(Request $request){
$id=$request->jobid;
$checkaction=DB::table('employeerequisitions')
            ->where('id', $id)
            ->first();
            if ($checkaction->action ==3 || $checkaction->action ==4) {
         Alert::success('Success',' Requisition  Action has already occured!!');
return redirect()->route('tabspage');
            }
   $ldate = date('Y-m-d H:i:s');

    $insertdecline=DB::table('requisitionsdeclines')
                ->insert([
                        'jobid' => $id,
                        'userId' => Auth::user()->id,
                        'date'=>$ldate,
                         ]);
    $companyinitator=DB::table('requsitionsapprovals')
                    ->where('requsitionsapprovals.jobid', $id)
                    ->where('requsitionsapprovals.initiator', 'initiator')
                    ->first();
                    //dd($companyinitator);
      $company_id=$companyinitator->company_id;   
        $decline1=DB::table('employeerequisitions')
             ->where('id',$id)
             ->update([
                       'stages'=>1, 'stage1'=>1, 'stage2'=>1,'stage3'=>1, 'approved_status'=>"2" ,'action'=>'3', 'comment'=>$request->comment
                      ]);

           $job = EmployeeRequisition::find($id);
            $data = array(
                'user'=>Auth::user()->id, 
                'username'=>Auth::user()->name,  
                'id'=> $job->id,
                'stages'=> [
                                'HR Recruitment Team'=>$job->stages,
                                'HR Manager'=>$job->stage1,'Executive Lead'=>$job->stage2,
                                'Group CEO'=>$job->stage3
                        ],
                'company_id'=>$company_id,
                'jobtittle'      =>  $job->jobtittle,
                'positions'      =>  $job->positions,
                'employementtype'      =>  $job->employementtype,
                'salary'      =>  $job->salary,
                // 'salaryto'      =>  $job->salaryto,
                'responsibilities'      =>  $job->responsibilities,
                'posrequirements'      =>  $job->posrequirements,
                'posskills'      =>  $job->posskills,
                'location'   =>   $job->location,
                'jobcategory'   =>   $job->jobcategory,
                'intenting'   =>   unserialize($job->intenting),
                'startdate'   =>   $job->startdate,
                'manager'   =>   $job->manager,
                'pwd'   =>   $job->pwd,
                'interviews'   => unserialize( $job->interviews),
                'jobdescription'   =>   $job->jobdescription
        );   
            $declinesemails=DB::table('requisitionsdeclines')
                   ->join('users','users.id', '=', 'requisitionsdeclines.userId')
                    ->where('requisitionsdeclines.jobid', $id)
                   ->first();  
            \Mail::to($declinesemails->email)->send(new \App\Mail\declinefroexecempinitator($data));
              // dd($declinesemails);
               $towhomtosendemail=DB::table('requsitionsapprovals')
                         ->join('users', 'requsitionsapprovals.userId', '=', 'users.id')
                         // ->join('requisitionsdeclines', 'users.id', '=', 'requisitionsdeclines.userId')
                          ->where('requsitionsapprovals.jobid', $id)
                         ->get();
                   
             foreach($towhomtosendemail as $usersemails)
             { 
                //dd($usersemails->email);
                \Mail::to($usersemails->email)->send(new \App\Mail\declinefroexecempinitator($data));
            }

                           Alert::success('Success',' Requisition  has been decline successfully');
return redirect()->route('tabspage');



 }
 /** decline when the exec is the initiator nd ceo is declining declinefromceoexecinitiator
  * */
public function declinefromceoexecinitiator($id){
$checkaction=DB::table('employeerequisitions')
            ->where('id', $id)
            ->first();
            if ($checkaction->action ==1) {
         Alert::success('Success',' Requisition  Action has already occured!!');
return redirect()->route('tabspage');
            }
   $ldate = date('Y-m-d H:i:s');

    $insertdecline=DB::table('requisitionsdeclines')
                ->insert([
                        'jobid' => $id,
                        'userId' => Auth::user()->id,
                        'date'=>$ldate,
                         ]);
    $companyinitator=DB::table('requsitionsapprovals')
                    ->where('requsitionsapprovals.jobid', $id)
                    ->where('requsitionsapprovals.initiator', 'initiator')
                    ->first();
                    //dd($companyinitator);
      $company_id=$companyinitator->company_id;  
      // check if job have been approved at first
         
      // chcek if the job have already been diclined
     $checkjobapproval=DB::table('employeerequisitions')
                    ->where('id', $id)
                    ->first();
  
        $decline1=DB::table('employeerequisitions')
             ->where('id',$id)
             ->update([
                      'stages'=>1, 'stage1'=>1, 'stage2'=>1,'stage3'=>1,  'approved_status'=>"2",'action'=>'1'
                      ]);

           $job = EmployeeRequisition::find($id);
            $data = array(
                'user'=>Auth::user()->id, 
                'username'=>Auth::user()->name,  
                'id'=> $job->id,
                'stages'=> [
                                'HR Recruitment Team'=>$job->stages,
                                'HR Manager'=>$job->stage1,'Executive Lead'=>$job->stage2,
                                'Group CEO'=>$job->stage3
                        ],
                'company_id'=>$company_id,
                'jobtittle'      =>  $job->jobtittle,
                'positions'      =>  $job->positions,
                'employementtype'      =>  $job->employementtype,
                'salary'      =>  $job->salary,
                // 'salaryto'      =>  $job->salaryto,
                'responsibilities'      =>  $job->responsibilities,
                'posrequirements'      =>  $job->posrequirements,
                'posskills'      =>  $job->posskills,
                'location'   =>   $job->location,
                'jobcategory'   =>   $job->jobcategory,
                'intenting'   =>   unserialize($job->intenting),
                'startdate'   =>   $job->startdate,
                'manager'   =>   $job->manager,
                'pwd'   =>   $job->pwd,
                 'interviews'   => unserialize( $job->interviews),
                'jobdescription'   =>   $job->jobdescription
        );   
            $declinesemails=DB::table('requisitionsdeclines')
                   ->join('users','users.id', '=', 'requisitionsdeclines.userId')
                    ->where('requisitionsdeclines.jobid', $id)
                   ->first();  
            \Mail::to($declinesemails->email)->send(new \App\Mail\declinefromceoexecinitiator($data));
              // dd($declinesemails);
               $towhomtosendemail=DB::table('requsitionsapprovals')
                         ->join('users', 'requsitionsapprovals.userId', '=', 'users.id')
                         // ->join('requisitionsdeclines', 'users.id', '=', 'requisitionsdeclines.userId')
                          ->where('requsitionsapprovals.jobid', $id)
                         ->get();
                   
             foreach($towhomtosendemail as $usersemails)
             { 
                //dd($usersemails->email);
                \Mail::to($usersemails->email)->send(new \App\Mail\declinefromceoexecinitiator($data));
            }

                           Alert::success('Success',' Requisition  has been decline successfully');
return redirect()->route('tabspage');


 }
 /**
  * decline from hr when hiring manager inititaes declinefromhrempinitator
  * */
 public function declinefromhrempinitator(Request $request){
    $id=$request->jobid;
$checkaction=DB::table('employeerequisitions')
            ->where('id', $id)
            ->first();
            if ($checkaction->action ==2 || $checkaction->action ==3 || $checkaction->action ==4) {
         Alert::success('Success',' Requisition  Action has already occured!!');
return redirect()->route('tabspage');
            }
   $ldate = date('Y-m-d H:i:s');

    $insertdecline=DB::table('requisitionsdeclines')
                ->insert([
                        'jobid' => $id,
                        'userId' => Auth::user()->id,
                        'date'=>$ldate,
                         ]);
    $companyinitator=DB::table('requsitionsapprovals')
                    ->where('requsitionsapprovals.jobid', $id)
                    ->where('requsitionsapprovals.initiator', 'initiator')
                    ->first();
                    //dd($companyinitator);
      $company_id=$companyinitator->company_id;   
        $decline1=DB::table('employeerequisitions')
             ->where('id',$id)
             ->update([
                       'stages'=>1, 'stage1'=>1, 'stage2'=>1,'stage3'=>1, 'approved_status'=>"2",'action'=>'2', 'comment'=>$request->comment
                      ]);

           $job = EmployeeRequisition::find($id);
            $data = array(
                'user'=>Auth::user()->id, 
                'username'=>Auth::user()->name,  
                'id'=> $job->id,
                'stages'=> [
                                'HR Recruitment Team'=>$job->stages,
                                'HR Manager'=>$job->stage1,'Executive Lead'=>$job->stage2,
                                'Group CEO'=>$job->stage3
                        ],
                'company_id'=>$company_id,
                'jobtittle'      =>  $job->jobtittle,
                'positions'      =>  $job->positions,
                'employementtype'      =>  $job->employementtype,
                'salary'      =>  $job->salary,
                // 'salaryto'      =>  $job->salaryto,
                'responsibilities'      =>  $job->responsibilities,
                'posrequirements'      =>  $job->posrequirements,
                'posskills'      =>  $job->posskills,
                'location'   =>   $job->location,
                'jobcategory'   =>   $job->jobcategory,
                'intenting'   =>   unserialize($job->intenting),
                'startdate'   =>   $job->startdate,
                'manager'   =>   $job->manager,
                'pwd'   =>   $job->pwd,
                 'interviews'   => unserialize( $job->interviews),
                'jobdescription'   =>   $job->jobdescription
        );   
            $declinesemails=DB::table('requisitionsdeclines')
                   ->join('users','users.id', '=', 'requisitionsdeclines.userId')
                    ->where('requisitionsdeclines.jobid', $id)
                   ->first();  
            \Mail::to($declinesemails->email)->send(new \App\Mail\declinefromhrempinitator($data));
              // dd($declinesemails);
               $towhomtosendemail=DB::table('requsitionsapprovals')
                         ->join('users', 'requsitionsapprovals.userId', '=', 'users.id')
                         // ->join('requisitionsdeclines', 'users.id', '=', 'requisitionsdeclines.userId')
                          ->where('requsitionsapprovals.jobid', $id)
                         ->get();
                   
             foreach($towhomtosendemail as $usersemails)
             { 
                //dd($usersemails->email);
                \Mail::to($usersemails->email)->send(new \App\Mail\declinefromhrempinitator($data));
            }

                           Alert::success('Success','Requisition  has been decline successfully');
return redirect()->route('tabspage');



 }
 /** declines from the eexecutive when the initiator is hr declinefromexechrinitiator
   * */
public function declinefromexechrinitiator(Request $request){
 $id=$request->jobid;

   $checkaction=DB::table('employeerequisitions')
            ->where('id', $id)
            ->first();
            if ($checkaction->action ==1 || $checkaction->action ==2) {
         Alert::success('Success',' Requisition  Action has already occured!!');
return redirect()->route('tabspage');
            }
   $ldate = date('Y-m-d H:i:s');

    $insertdecline=DB::table('requisitionsdeclines')
                ->insert([
                        'jobid' => $id,
                        'userId' => Auth::user()->id,
                        'date'=>$ldate,
                         ]);
    $companyinitator=DB::table('requsitionsapprovals')
                    ->where('requsitionsapprovals.jobid', $id)
                    ->where('requsitionsapprovals.initiator', 'initiator')
                    ->first();
                    //dd($companyinitator);
      $company_id=$companyinitator->company_id;  
        $decline1=DB::table('employeerequisitions')
             ->where('id',$id)
             ->update([
                      'stages'=>1, 'stage1'=>1, 'stage2'=>1,'stage3'=>1, 'approved_status'=>"2", 'action'=>'1', 'comment'=>$request->comment
                      ]);

           $job = EmployeeRequisition::find($id);
            $data = array(
                'user'=>Auth::user()->id, 
                'username'=>Auth::user()->name,  
                'id'=> $job->id,
                'stages'=> [
                                'HR Recruitment Team'=>$job->stages,
                                'HR Manager'=>$job->stage1,'Executive Lead'=>$job->stage2,
                                'Group CEO'=>$job->stage3
                        ],
                'company_id'=>$company_id,
                'jobtittle'      =>  $job->jobtittle,
                'positions'      =>  $job->positions,
                'employementtype'      =>  $job->employementtype,
                'salary'      =>  $job->salary,
                // 'salaryto'      =>  $job->salaryto,
                'responsibilities'      =>  $job->responsibilities,
                'posrequirements'      =>  $job->posrequirements,
                'posskills'      =>  $job->posskills,
                'location'   =>   $job->location,
                'jobcategory'   =>   $job->jobcategory,
                'intenting'   =>   unserialize($job->intenting),
                'startdate'   =>   $job->startdate,
                'manager'   =>   $job->manager,
                'pwd'   =>   $job->pwd,
                 'interviews'   => unserialize( $job->interviews),
                'jobdescription'   =>   $job->jobdescription
        );   
            $declinesemails=DB::table('requisitionsdeclines')
                   ->join('users','users.id', '=', 'requisitionsdeclines.userId')
                    ->where('requisitionsdeclines.jobid', $id)
                   ->first();  
            \Mail::to($declinesemails->email)->send(new \App\Mail\declinefromexechrinitiator($data));
              // dd($declinesemails);
               $towhomtosendemail=DB::table('requsitionsapprovals')
                         ->join('users', 'requsitionsapprovals.userId', '=', 'users.id')
                         // ->join('requisitionsdeclines', 'users.id', '=', 'requisitionsdeclines.userId')
                          ->where('requsitionsapprovals.jobid', $id)
                         ->get();
                   
             foreach($towhomtosendemail as $usersemails)
             { 
                //dd($usersemails->email);
                \Mail::to($usersemails->email)->send(new \App\Mail\declinefromexechrinitiator($data));
            }

                           Alert::success('Success',' Requisition  has been decline successfully');
return redirect()->route('tabspage');



 }

  /** decline from the cheif ceo when the recruiter is the intiator of the request 
   * */
public function declinefromceorecruinitiator(Request $request){
 $id=$request->jobid;
$checkaction=DB::table('employeerequisitions')
            ->where('id', $id)
            ->first();
            if ($checkaction->action ==3||$checkaction->action ==3) {
         Alert::success('Success',' Requisition  Action has already occured!!');
return redirect()->route('tabspage');
            }
   $ldate = date('Y-m-d H:i:s');

    $insertdecline=DB::table('requisitionsdeclines')
                ->insert([
                        'jobid' => $id,
                        'userId' => Auth::user()->id,
                        'date'=>$ldate,
                         ]);
    $companyinitator=DB::table('requsitionsapprovals')
                    ->where('requsitionsapprovals.jobid', $id)
                    ->where('requsitionsapprovals.initiator', 'initiator')
                    ->first();
                    //dd($companyinitator);
      $company_id=$companyinitator->company_id;    
        $decline1=DB::table('employeerequisitions')
             ->where('id',$id)
             ->update([
                       'stages'=>1, 'stage1'=>1, 'stage2'=>1,'stage3'=>1, 'approved_status'=>"2", 'action'=>'3', 'comment'=>$request->comment
                      ]);

           $job = EmployeeRequisition::find($id);
            $data = array(
                'user'=>Auth::user()->id, 
                'username'=>Auth::user()->name,  
                'id'=> $job->id,
                'stages'=> [
                                'HR Recruitment Team'=>$job->stages,
                                'HR Manager'=>$job->stage1,'Executive Lead'=>$job->stage2,
                                'Group CEO'=>$job->stage3
                        ],
                'company_id'=>$company_id,
                'jobtittle'      =>  $job->jobtittle,
                'positions'      =>  $job->positions,
                'employementtype'      =>  $job->employementtype,
                'salary'      =>  $job->salary,
                // 'salaryto'      =>  $job->salaryto,
                'responsibilities'      =>  $job->responsibilities,
                'posrequirements'      =>  $job->posrequirements,
                'posskills'      =>  $job->posskills,
                'location'   =>   $job->location,
                'jobcategory'   =>   $job->jobcategory,
                'intenting'   =>   unserialize($job->intenting),
                'startdate'   =>   $job->startdate,
                'manager'   =>   $job->manager,
                'pwd'   =>   $job->pwd,
                'interviews'   => unserialize( $job->interviews),
                'jobdescription'   =>   $job->jobdescription
        );   
            $declinesemails=DB::table('requisitionsdeclines')
                   ->join('users','users.id', '=', 'requisitionsdeclines.userId')
                    ->where('requisitionsdeclines.jobid', $id)
                   ->first();  
            \Mail::to($declinesemails->email)->send(new \App\Mail\declinefromceorecruinitiator($data));
              // dd($declinesemails);
               $towhomtosendemail=DB::table('requsitionsapprovals')
                         ->join('users', 'requsitionsapprovals.userId', '=', 'users.id')
                         // ->join('requisitionsdeclines', 'users.id', '=', 'requisitionsdeclines.userId')
                          ->where('requsitionsapprovals.jobid', $id)
                         ->get();
                   
             foreach($towhomtosendemail as $usersemails)
             { 
                //dd($usersemails->email);
                \Mail::to($usersemails->email)->send(new \App\Mail\declinefromceorecruinitiator($data));
            }

                           Alert::success('Success',' Requisition  has been decline successfully');
return redirect()->route('tabspage');



 }
 /* decline from the ceo when the hr is the initiator declinefromceohrinitiator
 */
public function declinefromceohrinitiator(Request $request){
$id=$request->jobid;

$checkaction=DB::table('employeerequisitions')
            ->where('id', $id)
            ->first();
            if ($checkaction->action ==2) {
         Alert::success('Success',' Requisition  Action has already occured!!');
return redirect()->route('tabspage');
            }
   $ldate = date('Y-m-d H:i:s');

    $insertdecline=DB::table('requisitionsdeclines')
                ->insert([
                        'jobid' => $id,
                        'userId' => Auth::user()->id,
                        'date'=>$ldate,
                         ]);
    $companyinitator=DB::table('requsitionsapprovals')
                    ->where('requsitionsapprovals.jobid', $id)
                    ->where('requsitionsapprovals.initiator', 'initiator')
                    ->first();
                    //dd($companyinitator);
      $company_id=$companyinitator->company_id;  
      // check if job have been approved at first
          
        $decline1=DB::table('employeerequisitions')
             ->where('id',$id)
             ->update([
                       'stages'=>1, 'stage1'=>1, 'stage2'=>1,'stage3'=>1, 'approved_status'=>"2",  'comment'=>$request->comment
                      ]);

           $job = EmployeeRequisition::find($id);
            $data = array(
                'user'=>Auth::user()->id, 
                'username'=>Auth::user()->name,  
                'id'=> $job->id,
                'stages'=> [
                                'HR Recruitment Team'=>$job->stages,
                                'HR Manager'=>$job->stage1,'Executive Lead'=>$job->stage2,
                                'Group CEO'=>$job->stage3
                        ],
                'company_id'=>$company_id,
                'jobtittle'      =>  $job->jobtittle,
                'positions'      =>  $job->positions,
                'employementtype'      =>  $job->employementtype,
                'salary'      =>  $job->salary,
                // 'salaryto'      =>  $job->salaryto,
                'responsibilities'      =>  $job->responsibilities,
                'posrequirements'      =>  $job->posrequirements,
                'posskills'      =>  $job->posskills,
                'location'   =>   $job->location,
                'jobcategory'   =>   $job->jobcategory,
                'intenting'   =>   unserialize($job->intenting),
                'startdate'   =>   $job->startdate,
                'manager'   =>   $job->manager,
                'pwd'   =>   $job->pwd,
                'interviews'   => unserialize( $job->interviews),
                'jobdescription'   =>   $job->jobdescription
        );   
            $declinesemails=DB::table('requisitionsdeclines')
                   ->join('users','users.id', '=', 'requisitionsdeclines.userId')
                    ->where('requisitionsdeclines.jobid', $id)
                   ->first();  
            \Mail::to($declinesemails->email)->send(new \App\Mail\declinefromceohrinitiator($data));
              // dd($declinesemails);
               $towhomtosendemail=DB::table('requsitionsapprovals')
                         ->join('users', 'requsitionsapprovals.userId', '=', 'users.id')
                         // ->join('requisitionsdeclines', 'users.id', '=', 'requisitionsdeclines.userId')
                          ->where('requsitionsapprovals.jobid', $id)
                         ->get();
                   
             foreach($towhomtosendemail as $usersemails)
             { 
                //dd($usersemails->email);
                \Mail::to($usersemails->email)->send(new \App\Mail\declinefromceohrinitiator($data));
            }

                           Alert::success('Success',' Requisition  has been decline successfully');
return redirect()->route('tabspage');



 }
   /**n decline from eexce when the initiator is the  recruiter declinefromexecrecruinitiator
   * */
public function declinefromexecrecruinitiator(Request $request){
$id=$request->jobid;
$checkaction=DB::table('employeerequisitions')
            ->where('id', $id)
            ->first();
            if ($checkaction->action ==2 || $checkaction->action ==3||$checkaction->action ==4) {
         Alert::success('Success',' Requisition  Action has already occured!!');
return redirect()->route('tabspage');
            }
   $ldate = date('Y-m-d H:i:s');

    $insertdecline=DB::table('requisitionsdeclines')
                ->insert([
                        'jobid' => $id,
                        'userId' => Auth::user()->id,
                        'date'=>$ldate,
                         ]);
    $companyinitator=DB::table('requsitionsapprovals')
                    ->where('requsitionsapprovals.jobid', $id)
                    ->where('requsitionsapprovals.initiator', 'initiator')
                    ->first();
                    //dd($companyinitator);
      $company_id=$companyinitator->company_id;  
  
        $decline1=DB::table('employeerequisitions')
             ->where('id',$id)
             ->update([
                       'stages'=>1, 'stage1'=>1, 'stage2'=>1,'stage3'=>1, 'approved_status'=>"2", 'action'=>'2', 'comment'=>$request->comment
                      ]);

           $job = EmployeeRequisition::find($id);
            $data = array(
                'user'=>Auth::user()->id, 
                'username'=>Auth::user()->name,  
                'id'=> $job->id,
                'stages'=> [
                                'HR Recruitment Team'=>$job->stages,
                                'HR Manager'=>$job->stage1,'Executive Lead'=>$job->stage2,
                                'Group CEO'=>$job->stage3
                        ],
                'company_id'=>$company_id,
                'jobtittle'      =>  $job->jobtittle,
                'positions'      =>  $job->positions,
                'employementtype'      =>  $job->employementtype,
                'salary'      =>  $job->salary,
                // 'salaryto'      =>  $job->salaryto,
                'responsibilities'      =>  $job->responsibilities,
                'posrequirements'      =>  $job->posrequirements,
                'posskills'      =>  $job->posskills,
                'location'   =>   $job->location,
                'jobcategory'   =>   $job->jobcategory,
                'intenting'   =>   unserialize($job->intenting),
                'startdate'   =>   $job->startdate,
                'manager'   =>   $job->manager,
                'pwd'   =>   $job->pwd,
                'interviews'   => unserialize( $job->interviews),
                'jobdescription'   =>   $job->jobdescription
        );   
            $declinesemails=DB::table('requisitionsdeclines')
                   ->join('users','users.id', '=', 'requisitionsdeclines.userId')
                    ->where('requisitionsdeclines.jobid', $id)
                   ->first();  
            \Mail::to($declinesemails->email)->send(new \App\Mail\declinefromexecrecruinitiator($data));
              // dd($declinesemails);
               $towhomtosendemail=DB::table('requsitionsapprovals')
                         ->join('users', 'requsitionsapprovals.userId', '=', 'users.id')
                         // ->join('requisitionsdeclines', 'users.id', '=', 'requisitionsdeclines.userId')
                          ->where('requsitionsapprovals.jobid', $id)
                         ->get();
                   
             foreach($towhomtosendemail as $usersemails)
             { 
                //dd($usersemails->email);
                \Mail::to($usersemails->email)->send(new \App\Mail\declinefromexecrecruinitiator
($data));
            }

                           Alert::success('Success',' Requisition  has been decline successfully');
return redirect()->route('tabspage');



 }
 /** decline from hr when the rec initiator */ 
 public function declinefromhrrecinitiator(Request $request){
  $id=$request->jobid;
  $checkaction=DB::table('employeerequisitions')
            ->where('id', $id)
            ->first();
            if ($checkaction->action == 1||$checkaction->action == 2||$checkaction->action == 3||$checkaction->action == 4) {
         Alert::success('Success',' Requisition  Action has already occured!!');
return redirect()->route('tabspage');
            }

    /// check if job had been approved 
 $ldate = date('Y-m-d H:i:s');
    $insertdecline=DB::table('requisitionsdeclines')
                ->insert([
                        'jobid' => $id,
                        'userId' => Auth::user()->id,
                        'date'=>$ldate,
                         ]);
    $companyinitator=DB::table('requsitionsapprovals')
                    ->where('requsitionsapprovals.jobid', $id)
                    ->where('requsitionsapprovals.initiator', 'initiator')
                    ->first();
                    //dd($companyinitator);
      $company_id=$companyinitator->company_id;  
      // check if job have been approved at first
         
      // chcek if the job have already been diclined
        $decline1=DB::table('employeerequisitions')
             ->where('id',$id)
             ->update([
                        'stages'=>1, 'stage1'=>1, 'stage2'=>1,'stage3'=>1,'approved_status'=>"2", 'comment'=>$request->comment
                      ]);

           $job = EmployeeRequisition::find($id);
            $data = array(
                'user'=>Auth::user()->id, 
                'username'=>Auth::user()->name,  
                'id'=> $job->id,
                'stages'=> [
                                'HR Recruitment Team'=>$job->stages,
                                'HR Manager'=>$job->stage1,'Executive Lead'=>$job->stage2,
                                'Group CEO'=>$job->stage3
                        ],
                'company_id'=>$company_id,
                'jobtittle'      =>  $job->jobtittle,
                'positions'      =>  $job->positions,
                'employementtype'      =>  $job->employementtype,
                'salary'      =>  $job->salary,
                // 'salaryto'      =>  $job->salaryto,
                'responsibilities'      =>  $job->responsibilities,
                'posrequirements'      =>  $job->posrequirements,
                'posskills'      =>  $job->posskills,
                'location'   =>   $job->location,
                'jobcategory'   =>   $job->jobcategory,
                'intenting'   =>   unserialize($job->intenting),
                'startdate'   =>   $job->startdate,
                'manager'   =>   $job->manager,
                'pwd'   =>   $job->pwd,
                 'interviews'   => unserialize( $job->interviews),
                'jobdescription'   =>   $job->jobdescription
        );   
            $declinesemails=DB::table('requisitionsdeclines')
                   ->join('users','users.id', '=', 'requisitionsdeclines.userId')
                    ->where('requisitionsdeclines.jobid', $id)
                   ->first();  

            \Mail::to($declinesemails->email)->send(new \App\Mail\declinefromhrrecinitiator($data));
              // dd($declinesemails);
               $towhomtosendemail=DB::table('requsitionsapprovals')
                         ->join('users', 'requsitionsapprovals.userId', '=', 'users.id')
                         // ->join('requisitionsdeclines', 'users.id', '=', 'requisitionsdeclines.userId')
                          ->where('requsitionsapprovals.jobid', $id)
                         ->get();
                   
             foreach($towhomtosendemail as $usersemails)
             { 
                //dd($usersemails->email);
                \Mail::to($usersemails->email)->send(new \App\Mail\declinefromhrrecinitiator($data));
            }

                           Alert::success('Success',' Requisition  has been decline successfully');
return redirect()->route('tabspage');



 }

   public function decline(Request $request){
  $id=$request->jobid;
  $checkaction=DB::table('employeerequisitions')
            ->where('id', $id)
            ->first();
            if ($checkaction->action == 1) {
         Alert::success('Success',' Requisition  Action has already occured!!');
return redirect()->route('tabspage');
            }

    /// check if job had been approved 

    $insertdecline=DB::table('requisitionsdeclines')
                ->insert([
                        'jobid' => $id,
                        'userId' => Auth::user()->id,
                         ]);
    $companyinitator=DB::table('requsitionsapprovals')
                    ->where('requsitionsapprovals.jobid', $id)
                    ->where('requsitionsapprovals.initiator', 'initiator')
                    ->first();
                    //dd($companyinitator);
      $company_id=$companyinitator->company_id;  
      // check if job have been approved at first
         
      // chcek if the job have already been diclined
        $decline1=DB::table('employeerequisitions')
             ->where('id',$id)
             ->update([
                        'stages'=>1, 'stage1'=>1, 'stage2'=>1,'stage3'=>1,'approved_status'=>"2", 'comment'=>$request->comment
                      ]);

           $job = EmployeeRequisition::find($id);
            $data = array(
                'user'=>Auth::user()->id, 
                'username'=>Auth::user()->name,  
                'id'=> $job->id,
                'stages'=> [
                                'HR Recruitment Team'=>$job->stages,
                                'HR Manager'=>$job->stage1,'Executive Lead'=>$job->stage2,
                                'Group CEO'=>$job->stage3
                        ],
                'company_id'=>$company_id,
                'jobtittle'      =>  $job->jobtittle,
                'positions'      =>  $job->positions,
                'employementtype'      =>  $job->employementtype,
                'salary'      =>  $job->salary,
                // 'salaryto'      =>  $job->salaryto,
                'responsibilities'      =>  $job->responsibilities,
                'posrequirements'      =>  $job->posrequirements,
                'posskills'      =>  $job->posskills,
                'location'   =>   $job->location,
                'jobcategory'   =>   $job->jobcategory,
                'intenting'   =>   unserialize($job->intenting),
                'startdate'   =>   $job->startdate,
                'manager'   =>   $job->manager,
                'pwd'   =>   $job->pwd,
                 'interviews'   => unserialize( $job->interviews),
                'jobdescription'   =>   $job->jobdescription
        );   
            $declinesemails=DB::table('requisitionsdeclines')
                   ->join('users','users.id', '=', 'requisitionsdeclines.userId')
                    ->where('requisitionsdeclines.jobid', $id)
                   ->first();  

            \Mail::to($declinesemails->email)->send(new \App\Mail\employeerequisitiondecline($data));
              // dd($declinesemails);
               $towhomtosendemail=DB::table('requsitionsapprovals')
                         ->join('users', 'requsitionsapprovals.userId', '=', 'users.id')
                         // ->join('requisitionsdeclines', 'users.id', '=', 'requisitionsdeclines.userId')
                          ->where('requsitionsapprovals.jobid', $id)
                         ->get();
                   
             foreach($towhomtosendemail as $usersemails)
             { 
                //dd($usersemails->email);
                \Mail::to($usersemails->email)->send(new \App\Mail\employeerequisitiondecline($data));
            }

                           Alert::success('Success',' Requisition  has been decline successfully');
return redirect()->route('tabspage');



 }
 /**
  * decline from chief ceo when rec to hiring request declinefromceorecinitatortohiring
  * */

public function declinefromceorecinitatortohiring(Request $request){

$id=$request->jobid;
$checkaction=DB::table('employeerequisitions')
            ->where('id', $id)
            ->first();
            if ($checkaction->action == 4) {
         Alert::success('Success',' Requisition  Action has already occured!!');
return redirect()->route('tabspage');
            }
   $ldate = date('Y-m-d H:i:s');

    $insertdecline=DB::table('requisitionsdeclines')
                ->insert([
                        'jobid' => $id,
                        'userId' => Auth::user()->id,
                        'date'=>$ldate,
                         ]);
    $companyinitator=DB::table('requsitionsapprovals')
                    ->where('requsitionsapprovals.jobid', $id)
                    ->where('requsitionsapprovals.initiator', 'initiator')
                    ->first();
                    //dd($companyinitator);
      $company_id=$companyinitator->company_id;  
  
        $decline1=DB::table('employeerequisitions')
             ->where('id',$id)
             ->update([
                       'stages'=>1, 'stage1'=>1, 'stage2'=>1,'stage3'=>1, 'approved_status'=>"2", 'action'=>'4', 'comment'=>$request->comment
                      ]);

           $job = EmployeeRequisition::find($id);
            $data = array(
                'user'=>Auth::user()->id, 
                'username'=>Auth::user()->name,  
                'id'=> $job->id,
                'stages'=> [
                                'HR Recruitment Team'=>$job->stages,
                                'HR Manager'=>$job->stage1,'Executive Lead'=>$job->stage2,
                                'Group CEO'=>$job->stage3
                        ],
                'company_id'=>$company_id,
                'jobtittle'      =>  $job->jobtittle,
                'positions'      =>  $job->positions,
                'employementtype'      =>  $job->employementtype,
                'salary'      =>  $job->salary,
                // 'salaryto'      =>  $job->salaryto,
                'responsibilities'      =>  $job->responsibilities,
                'posrequirements'      =>  $job->posrequirements,
                'posskills'      =>  $job->posskills,
                'location'   =>   $job->location,
                'jobcategory'   =>   $job->jobcategory,
                'intenting'   =>   unserialize($job->intenting),
                'startdate'   =>   $job->startdate,
                'manager'   =>   $job->manager,
                'pwd'   =>   $job->pwd,
                'interviews'   => unserialize( $job->interviews),
                'jobdescription'   =>   $job->jobdescription
        );   
            $declinesemails=DB::table('requisitionsdeclines')
                   ->join('users','users.id', '=', 'requisitionsdeclines.userId')
                    ->where('requisitionsdeclines.jobid', $id)
                   ->first();  
            \Mail::to($declinesemails->email)->send(new \App\Mail\declinefromceorecinitatortohiring($data));
              // dd($declinesemails);
               $towhomtosendemail=DB::table('requsitionsapprovals')
                         ->join('users', 'requsitionsapprovals.userId', '=', 'users.id')
                         // ->join('requisitionsdeclines', 'users.id', '=', 'requisitionsdeclines.userId')
                          ->where('requsitionsapprovals.jobid', $id)
                         ->get();
                   
             foreach($towhomtosendemail as $usersemails)
             { 
                //dd($usersemails->email);
                \Mail::to($usersemails->email)->send(new \App\Mail\declinefromceorecinitatortohiring($data));
            }

                           Alert::success('Success',' Requisition  has been decline successfully');
return redirect()->route('tabspage');



 }
 //* decline from hiring manager when the rec is the initiator on his behalf declinereasonfromhiringtorec
    public function declinereasonfromhiringtorec($id){
            // $useremail=User::find($user);
            $employeeRequisition=EmployeeRequisition::find($id);
            //dd($useremail);
               return view('employeerequisitions.declinereasonfromhiringtorec', compact('employeeRequisition'));
 }
 //** recruiter declining what the hiring manager ha srequested with reason 
    public function declinereasonrechiringinitiator($id){
            // $useremail=User::find($user);
            $employeeRequisition=EmployeeRequisition::find($id);
            //dd($useremail);
               return view('employeerequisitions.declinereasonrechiringinitiator', compact('employeeRequisition'));
 }
 /**
  * exec declines when rec to hiring request declinereasonfromexerectohiring 
  * */
   public function declinereasonfromexerectohiring($id){
            // $useremail=User::find($user);
            $employeeRequisition=EmployeeRequisition::find($id);
            //dd($useremail);
               return view('employeerequisitions.declinereasonfromexerectohiring', compact('employeeRequisition'));
 }
 /**
  * hr declining with reason  when rec to hiring request declinereasonhrtohiringrec
  * */
   public function declinereasonhrtohiringrec($id){
            // $useremail=User::find($user);
            $employeeRequisition=EmployeeRequisition::find($id);
            //dd($useremail);
               return view('employeerequisitions.declinereasonhrtohiringrec', compact('employeeRequisition'));
 }
 /**
  * decline from ceo giving reason when the emp is the initiator 
  * */
   public function declinereasonfroceoempinitator($id){
            // $useremail=User::find($user);
            $employeeRequisition=EmployeeRequisition::find($id);
            //dd($useremail);
               return view('employeerequisitions.declinereasonfroceoempinitator', compact('employeeRequisition'));
 }
 /**
  * decline from executive when emp is the initiator reasons given
  * **/
   public function declinereasonfromexecempinitator($id){
            // $useremail=User::find($user);
            $employeeRequisition=EmployeeRequisition::find($id);
            //dd($useremail);
               return view('employeerequisitions.declinereasonfromexecempinitator', compact('employeeRequisition'));
 }
 /**
  * decline reason from hr when emp is the initiator declinereasonfromhrempinitator
  * *
  * **/
  public function declinereasonfromhrempinitator($id){
            // $useremail=User::find($user);
            $employeeRequisition=EmployeeRequisition::find($id);
            //dd($useremail);
               return view('employeerequisitions.declinereasonfromhrempinitator', compact('employeeRequisition'));
 }

 // decline from ceo when the rec initiates on behalf of hiring manager

  public function declinereasonfromceorectohiring($id){
            // $useremail=User::find($user);
            $employeeRequisition=EmployeeRequisition::find($id);
            //dd($useremail);
               return view('employeerequisitions.declinereasonfromceorectohiring', compact('employeeRequisition'));
 }
 /**
  * decline from the ceo with reason  when the recruiter is the initiator
  * 
  * */
 public function declinereasonfromceorecinitiator($id){
            // $useremail=User::find($user);
            $employeeRequisition=EmployeeRequisition::find($id);
            //dd($useremail);
               return view('employeerequisitions.declinereasonfromceorecinitiator', compact('employeeRequisition'));
 }
 /**
  * exec declining reason when the recruiter is the initiator
  * */
public function declinereasonfromexecrecinitiator($id){
            // $useremail=User::find($user);
            $employeeRequisition=EmployeeRequisition::find($id);
            //dd($useremail);
               return view('employeerequisitions.declinereasonfromexecrecinitiator', compact('employeeRequisition'));
 }
 /**
  * hr declining giving reason when the recruiter is the initiator
  * */
     public function declinereasonfromhrrecinitiator($id){
            // $useremail=User::find($user);
            $employeeRequisition=EmployeeRequisition::find($id);
            //dd($useremail);
               return view('employeerequisitions.declinereasonfromhrrecinitiator', compact('employeeRequisition'));
 }
 /*
 /**
  * giving reson by declines from the ceo when the hr initiator
  * */
    public function declinereasonfromceohrinitiator($id){
            // $useremail=User::find($user);
            $employeeRequisition=EmployeeRequisition::find($id);
            //dd($useremail);
               return view('employeerequisitions.declinereasonfromceohrinitiator', compact('employeeRequisition'));
 }
 /**
  * giving a reason for declining 
  * */
   public function declinereason($id){

            // $useremail=User::find($user);
            $employeeRequisition=EmployeeRequisition::find($id);
            //dd($useremail);
               return view('employeerequisitions.declinereason', compact('employeeRequisition'));
 }
 /**
  * returnning for corrections from the aprrover 1
  * 
  * */
  public function returnforcorrections($id, $user){

            $useremail=User::find($user);
            $employeeRequisition=EmployeeRequisition::find($id);
            //dd($useremail);
               return view('employeerequisitions.commentapproval', compact('employeeRequisition','useremail'));
 }
 /**
  * return for correction in the system 
  * */
   public function returnforcorrections1($id){
    $user=Auth::user()->id;
            $useremail=User::find($user);
            $employeeRequisition=EmployeeRequisition::find($id);
            //dd($useremail);
               return view('employeerequisitions.commentapproval', compact('employeeRequisition','useremail'));
 }
 /**
  * 
  * returning to lead executive for corrections
  * 
  * */
   public function returnforcorrectionstoleadexec($id, $user){
            $useremail=User::find($user);
            $employeeRequisition=EmployeeRequisition::find($id);
               return view('employeerequisitions.commentapproval', compact('employeeRequisition','useremail'));
 }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EmployeeRequisition  $employeeRequisition
     * @return \Illuminate\Http\Response
     */
    public function destroy($employeeRequisition)
    {  
        $employeeRequisition =EmployeeRequisition::find($employeeRequisition);
         $employeeRequisition->delete();
                 Alert::error('Delete',' Requisition has been deleted successfully');
return redirect()->route('tabspage');

    }

    /**
     * employee requistions settings
     * */
    public function employeerequisitionsettings(){
        $users=User::all();
        $employeeRequisitionusers=Employeerequistionusers::all();
        $employeeRequisitionsettings=Employeerequistionsettings::all();
        return view('employeerequisitions.employeerequisitionsettings', compact('employeeRequisitionusers','users','employeeRequisitionsettings'));

    }

        public function tabspage(){
                //get the role if any
        $user=Auth::user()->id;
        
        $getrole=DB::table('employeerequisitionusers')
                ->where('userId', $user)
                ->first();
        $role=$getrole->employeetype ?? null; 

        if ($role == "") {
        $users=User::all();
        $employeeRequisitionall=EmployeeRequisition::where('posskills', $user)->orderBy('id', 'Desc')->get();
        $employeeRequisitionspending=EmployeeRequisition::where('approved_status', '0')->where('status','initiated')->where('posskills', $user)->orderBy('id', 'DESC')->get();
        $employeeRequisitions=EmployeeRequisition::where('approved_status', '1')->where('status','initiated')->Where('posskills', $user)->orderBy('id', 'desc')->get();
        $employeeRequisitionusers=Employeerequistionusers::all();
         $employeeRequisitionsdecline=EmployeeRequisition::where('approved_status', '2')->where('status' ,'initiated')->Where('posskills', $user)->orderBy('id', 'desc')->get();
        $employeeRequisitionsettings=Employeerequistionsettings::all();
        return view('employeerequisitions.tabspage', compact('employeeRequisitionusers','users','employeeRequisitionsettings', 'employeeRequisitions','employeeRequisitionsdecline','employeeRequisitionall', 'employeeRequisitionspending'));
          

        }
        else{
              // dd($role);
        $users=User::all();
        $employeeRequisitionall=EmployeeRequisition::orderBy('id', 'DESC')->get();
        $employeeRequisitionspending=EmployeeRequisition::where('approved_status', '0')->where('status','initiated')->orderBy('id', 'Desc')->get();
        $employeeRequisitions=EmployeeRequisition::where('approved_status', '1')->where('status','initiated')->orderBy('id', 'DESC')->get();
        $employeeRequisitionusers=Employeerequistionusers::all();
         $employeeRequisitionsdecline=EmployeeRequisition::where('approved_status', '2')->where('status','initiated')->orderBy('id', 'DESC')->get();
        $employeeRequisitionsettings=Employeerequistionsettings::all();
        return view('employeerequisitions.tabspage', compact('employeeRequisitionusers','users','employeeRequisitionsettings', 'employeeRequisitions','employeeRequisitionsdecline','employeeRequisitionall', 'employeeRequisitionspending'));

    }

    }
    //store  employeerequisitions settings 
    public function employeerequisitionsettingsstore(Request $request){
        $request->validate([
            'employeetype'=>'required',
        ]);

         $createsetting= Employeerequistionsettings::create($request->all());
        Alert::success('Success','settings have been send successfully');
        return back();
    }

    //update requisitions settings
public function employeerequisitionsettingsupdate(Request $request){
    $employee = Employeerequistionusers::find($request->id); 

           $request->validate([
            'employeetype' => 'required',
              ]);
        $employee->update($request->all());
        Alert::success('Success',' Settings changes has been saved successfully');
         return back();
}

    ///destroy employee settings
        public function destroyrequisitionsetting($id)
    {  
        $employeeRequisition =Employeerequistionsettings::find($id);
         $employeeRequisition->delete();
        Alert::error('Delete',' Requisition has been deleted successfully');
         return back();

    }

    //users of the settings 
      public function employeerequisitionusers(){
        $users=User::all();
        $employeeRequisitionsettings=Employeerequistionsettings::all();
        $employeeRequisitionusers=Employeerequistionusers::all();
        return view('employeerequisitions.employeerequisitionusers', compact('employeeRequisitionusers','users','employeeRequisitionsettings'));

    }  
        
    //store  employeerequisitions settings users
    public function employeerequisitionusersstore(Request $request){

//check if user with same role exists
        $checkuser=DB::table('employeerequisitionusers')
                  ->where('userId', $request->userId)
                  ->first();
             
        if ($checkuser != null) {
           Alert::success('Success',' Employee have been assigned a role already ');
        return back();
        }
    $userid1=DB::table('users')
    ->where('id', $request->userId)
    ->first();
    //dd($userid1);
     $company_id=$userid1->company_id;
     
        $validated=$request->validate([
            'employeetype'=>'required',
            'userId'=>'required',
        ]);
         $createsetting= Employeerequistionusers::create(array_merge($validated, ['company_id'=>$company_id]));
        Alert::success('Success',' Employee have been assigned a role successully');
        return back();
    }
////destroying requsitions users
            public function destroyrequisitionusers($id)
    {  
        $employeeRequisition =Employeerequistionusers::find($id);
         $employeeRequisition->delete();
        Alert::error('Delete',' Requisition has been deleted successfully');
         return back();

    }


 public function fetch(Request $request)
    {
     $select = $request->get('select');
     $value = $request->get('value');
     $dependent = $request->get('dependent');

     $data = DB::table('users')
       ->where('company_id', $value)
       ->get();

     $output = '<option disabled>Select user</option>';

     foreach($data as $row)
     {
      $output .= '<option value="'.$row->id.'">'.$row->name.'</option>';
     }

     return  response()->json(compact('output'));
    }

    // executive approving to ceo

    public function execapprovingtoceo($id){
                    $companyinitator=DB::table('requsitionsapprovals')
                    ->where('requsitionsapprovals.jobid', $id)
                    ->orwhere('requsitionsapprovals.initiator', 'initiator')
                    ->first();
                    //dd($companyinitator);
            $company_id=$companyinitator->company_id;
            $job = EmployeeRequisition::find($id);
            $ldate = date('Y-m-d H:i:s');
            $storeapprove1=DB::table('requsitionsapprovals')
                          ->insert([
                                     'jobid' => $id,
                                     'userId' => $user,
                                     'date'=>$ldate,
                                    ]);
            $data = array(
                'user'=>Auth::user()->id, 
                'username'=>Auth::user()->name,  
                'id'=> $job->id,
                'stages'=> [
                                'HR Recruitment Team'=>$job->stages,
                                'HR Manager'=>$job->stage1,'Executive Lead'=>$job->stage2,
                                'Group CEO'=>$job->stage3
                        ],
                'company_id'=>$company_id,
                'jobtittle'      =>  $job->jobtittle,
                'positions'      =>  $job->positions,
                'employementtype'      =>  $job->employementtype,
                'salary'      =>  $job->salary,
                // 'salaryto'      =>  $job->salaryto,
                'responsibilities'      =>  $job->responsibilities,
                'posrequirements'      =>  $job->posrequirements,
                'posskills'      =>  $job->posskills,
                'location'   =>   $job->location,
                'jobcategory'   =>   $job->jobcategory,
               'intenting'   =>   unserialize($job->intenting),
                'startdate'   =>   $job->startdate,
                'manager'   =>   $job->manager,
                'pwd'   =>   $job->pwd,
                'interviews'   => unserialize($job->interviews),
                'jobdescription'   =>   $job->jobdescription
        );
     //store that it has been approved by the final approver
       $towhomtosendemail=DB::table('requsitionsapprovals')
                         ->join('users', 'users.id', '=', 'requsitionsapprovals.userId')
                         ->where('requsitionsapprovals.jobid', $id)
                          ->get();              
             foreach($towhomtosendemail as $usersemails)
             { 
                //dd($usersemails->email);
                \Mail::to($usersemails->email)->send(new \App\Mail\groupceotoexec($data));
            }

        $approve1=DB::table('employeerequisitions')
             ->where('id',$id)
             ->update(['stage3' => "1",
                        'approved_status'=>"1", 'action'=>'1'
              ]);
            // Alert::success('Success','Chief CEO approvals have been made successfully');
            // return back();
                                 Alert::success('Success',' Requisition  has been approved successfully');
         return redirect()->route('employeerequisitions.tabspage');;
    }
}
