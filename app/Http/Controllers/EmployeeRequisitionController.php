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
    public function __construct (){
        $this->middleware('auth');
    }
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {         
        $users=User::all();
        $user_id=Auth::user()->id;
        $employeeRequisitions=EmployeeRequisition::where('posskills', $user_id)->where('approved_status', 0)->orderBy('created_at', 'DESC')->get();;
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

// if the initiator is the HR Recruiter
        if ($role=='HR Recruitment Team') {
                    
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
            'interviews'=>'required',
            'employementtype' => 'required|string',
            'posrequirements' => 'required',
            'salary' => 'required|not_in:0|numeric',
            'salaryto' => 'required|not_in:0|numeric',
            'responsibilities' => 'required',
           

            ]);
       
            $validated['intenting'] = serialize($validated['intenting']);
            $jobtitle = $request->jobtittle_input ? $request->jobtittle_input : $request->jobtittle;
            $job = EmployeeRequisition::create(array_merge($validated, ['posskills' => $user], ['jobtittle' => $jobtitle]));
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
                'salaryto'      =>  $job->salaryto,
                'responsibilities'      =>  $job->responsibilities,
                'posrequirements'      =>  $job->posrequirements,
                'posskills'      =>  $job->posskills,
                'location'   =>   $job->location,
                'jobcategory'   =>   $job->jobcategory,
                'intenting'   =>   unserialize($job->intenting),
                'startdate'   =>   $job->startdate,
                'manager'   =>   $job->manager,
                'pwd'   =>   $job->pwd,
                'interviews'   =>   $job->interviews,
                'jobdescription'   =>   $job->jobdescription
            );
          
             //proceed to send email to the HR 
            $sendmailtohr=DB::table('employeerequisitionusers')
                               ->join('users', 'users.id','=', 'employeerequisitionusers.userId')
                               ->where('employeerequisitionusers.employeetype', 'HR Manager')   
                               ->get();
                               //dd($sendmailtogroupceo);
            foreach($sendmailtohr as $usersemails)
            { 
                //dd($usersemails->email);
              \Mail::to($usersemails->email)->send(new \App\Mail\recrutohr($data));
            }      

            $updateinitiatecollumn=DB::table('employeerequisitions')
                                    ->where('id',$job->id)
                                    ->update(['status' => "initiated", 'stages' => '1', 'role'=>'HR Recruitment Team']);
                                    Alert::success('Success',' Requisition has been made successfully');
                                    return back();

        } 

    // if the initiator is HR Manager
    //initiator is the hr manar

    if ($role =="HR Manager") {             
        $validated = $request->validate([
            // 'jobtittle' => 'required|string',
            'jobdescription' => 'required',
            'positions' => 'required|numeric',
            'location'=>'required',
            'jobcategory'=>'required',
            'startdate'=>'required',
            'intenting.*'=>'required',
            'manager'=>'required',
            'pwd'=>'required',
            'salarybudget'=>'required',
            'interviews'=>'required',
            'employementtype' => 'required|string',
            'posrequirements' => 'required',
            'salary' => 'required|not_in:0|numeric',
            'salaryto' => 'required|not_in:0|numeric',
            'responsibilities' => 'required',

        ]);
        
        $validated['intenting'] = serialize($validated['intenting']);
           $jobtitle = $request->jobtittle_input ? $request->jobtittle_input : $request->jobtittle;
        $job = EmployeeRequisition::create(array_merge($validated, ['posskills' => $user], ['jobtittle' => $jobtitle]));
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
                'salaryto'      =>  $job->salaryto,
                'responsibilities'      =>  $job->responsibilities,
                'posrequirements'      =>  $job->posrequirements,
                'posskills'      =>  $job->posskills,
                'location'   =>   $job->location,
                'jobcategory'   =>   $job->jobcategory,
                'intenting'   =>   unserialize($job->intenting),
                'startdate'   =>   $job->startdate,
                'manager'   =>   $job->manager,
                'pwd'   =>   $job->pwd,
                'interviews'   =>   $job->interviews,
                'jobdescription'   =>   $job->jobdescription
        );
          
        $initiatorcompany=DB::table('requsitionsapprovals')
                                 ->join('users', 'users.id','=' ,'requsitionsapprovals.userId')
                                 ->join('companies', 'companies.id', '=', 'users.company_id')
                                 ->where('requsitionsapprovals.jobid', $job->id)
                                 ->where('requsitionsapprovals.initiator', 'initiator')
                                 ->first()->company_id;
        $bossId = DB::table("employeerequisitionusers")->where("company_id","=",$initiatorcompany)->where("employeetype","=","Executive Lead")->first()->userId;
        $bossEmail = DB::table("users")->where("id","=",$bossId)->first()->email;
         \Mail::to($bossEmail)->send(new \App\Mail\hrtoexec($data));

        $updateinitiatecollumn=DB::table('employeerequisitions')
                                    ->where('id',$job->id)
                                   ->update(['status' => "initiated", 'stages' => '1', 'stage1'=>'1', 'role'=>'HR Manager']);
                  Alert::success('Success','You  have made approvals  successfully');
                  return back();   
                     // return redirect()->route('employeerequisitions.approvesmessage')
                     //    ->with('success','Requisition  have been made  successfully.');  
    }


 
    // role is executive lead
    if ($role =="Executive Lead") {

        $validated = $request->validate([
            // 'jobtittle' => 'required|string',
            'jobdescription' => 'required',
            'positions' => 'required|numeric',
            'location'=>'required',
            'jobcategory'=>'required',
            'startdate'=>'required',
            'intenting.*'=>'required',
            'manager'=>'required',
            'pwd'=>'required',
            'salarybudget'=>'required',
            'interviews'=>'required',
            'employementtype' => 'required|string',
            'posrequirements' => 'required',
            'salary' => 'required|not_in:0|numeric',
            'salaryto' => 'required|not_in:0|numeric',
            'responsibilities' => 'required',

        ]);
        
        $validated['intenting'] = serialize($validated['intenting']);
        $jobtitle = $request->jobtittle_input ? $request->jobtittle_input : $request->jobtittle;
        $job = EmployeeRequisition::create(array_merge($validated, ['posskills' => $user], ['jobtittle' => $jobtitle]));
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
                'salaryto'      =>  $job->salaryto,
                'responsibilities'      =>  $job->responsibilities,
                'posrequirements'      =>  $job->posrequirements,
                'posskills'      =>  $job->posskills,
                'location'   =>   $job->location,
                'jobcategory'   =>   $job->jobcategory,
                'intenting'   =>   unserialize($job->intenting),
                'startdate'   =>   $job->startdate,
                'manager'   =>   $job->manager,
                'pwd'   =>   $job->pwd,
                'interviews'   =>   $job->interviews,
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
                                    return back();
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
                                    return back();
    }




    // if the Group CEO is the initiator
    if ($role =="Group CEO") {
       $validated = $request->validate([
            // 'jobtittle' => 'required|string',
            'jobdescription' => 'required',
            'positions' => 'required|numeric',
            'location'=>'required',
            'jobcategory'=>'required',
            'startdate'=>'required',
            'intenting.*'=>'required',
            'manager'=>'required',
            'pwd'=>'required',
            'salarybudget'=>'required',
            'interviews'=>'required',
            'employementtype' => 'required|string',
            'posrequirements' => 'required',
            'salary' => 'required|not_in:0|numeric',
            'salaryto' => 'required|not_in:0|numeric',
            'responsibilities' => 'required',

        ]);
        
        $validated['intenting'] = serialize($validated['intenting']);
        $jobtitle = $request->jobtittle_input ? $request->jobtittle_input : $request->jobtittle;
        $job = EmployeeRequisition::create(array_merge($validated, ['posskills' => $user], ['jobtittle' => $jobtitle]));
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
                'salaryto'      =>  $job->salaryto,
                'responsibilities'      =>  $job->responsibilities,
                'posrequirements'      =>  $job->posrequirements,
                'posskills'      =>  $job->posskills,
                'location'   =>   $job->location,
                'jobcategory'   =>   $job->jobcategory,
                'intenting'   =>   unserialize($job->intenting),
                'startdate'   =>   $job->startdate,
                'manager'   =>   $job->manager,
                'pwd'   =>   $job->pwd,
                'interviews'   =>   $job->interviews,
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
                                    return back();
              }

        //send the normal user is the initiator    
    else{
      $validated = $request->validate([
            // 'jobtittle' => 'required|string',
            'jobdescription' => 'required',
            'positions' => 'required|numeric',
            'location'=>'required',
            'jobcategory'=>'required',
            'startdate'=>'required',
            'intenting.*'=>'required',
            'manager'=>'required',
            'pwd'=>'required',
            'salarybudget'=>'required',
            'interviews'=>'required',
            'employementtype' => 'required|string',
            'posrequirements' => 'required',
            'salary' => 'required|not_in:0|numeric',
            'salaryto' => 'required|not_in:0|numeric',
            'responsibilities' => 'required',

            ]);
        
            $validated['intenting'] = serialize($validated['intenting']);
            $jobtitle = $request->jobtittle_input ? $request->jobtittle_input : $request->jobtittle;
            $job = EmployeeRequisition::create(array_merge($validated, ['posskills' => $user], ['jobtittle' => $jobtitle]));

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
                'salaryto'      =>  $job->salaryto,
                'responsibilities'      =>  $job->responsibilities,
                'posrequirements'      =>  $job->posrequirements,
                'posskills'      =>  $job->posskills,
                'location'   =>   $job->location,
                'jobcategory'   =>   $job->jobcategory,
                'intenting'   =>   unserialize($job->intenting),
                'startdate'   =>   $job->startdate,
                'manager'   =>   $job->manager,
                'pwd'   =>   $job->pwd,
                'interviews'   =>   $job->interviews,
                'jobdescription'   =>   $job->jobdescription
                 );
          
                $whomtosendemail=DB::table('employeerequisitionusers')
                           ->join('users','users.id', '=', 'employeerequisitionusers.userId' )
                           ->where('employeerequisitionusers.employeetype', 'HR Recruitment Team')
                           ->get();
               foreach($whomtosendemail as $Hremails)
               { 
               \Mail::to($Hremails->email)->send(new \App\Mail\employeerequesition($data));
                }      

                $updateinitiatecollumn=DB::table('employeerequisitions')
                                    ->where('id',$job->id)
                                    ->update(['status' => "initiated"]);
                                    Alert::success('Success','Your Requisition has been made successfully');
      }                              return back();

    }

    /**
     * initiate arequisition
     **/
    public function initiate(EmployeeRequisition $id)
    {
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
            $job = EmployeeRequisition::find($id)->first();     
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
                'salaryto'      =>  $job->salaryto,
                'responsibilities'      =>  $job->responsibilities,
                'posrequirements'      =>  $job->posrequirements,
                'posskills'      =>  $job->posskills,
                'location'   =>   $job->location,
                'jobcategory'   =>   $job->jobcategory,
               'intenting'   =>   unserialize($job->intenting),
                'startdate'   =>   $job->startdate,
                'manager'   =>   $job->manager,
                'pwd'   =>   $job->pwd,
                'interviews'   =>   $job->interviews,
                'jobdescription'   =>   $job->jobdescription
            );
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

        if ($role =='HR Recruitment Team') {
                      //proceed to send email to the HR 
            $sendmailtohr=DB::table('employeerequisitionusers')
                               ->join('users', 'users.id','=', 'employeerequisitionusers.userId')
                               ->where('employeerequisitionusers.employeetype', 'HR Manager')   
                               ->get();
                               //dd($sendmailtogroupceo);
            foreach($sendmailtohr as $usersemails)
            { 
                //dd($usersemails->email);
              \Mail::to($usersemails->email)->send(new \App\Mail\recrutohr($data));
            }      

            $updateinitiatecollumn=DB::table('employeerequisitions')
                                    ->where('id',$job->id)
                                    ->update(['status' => "initiated"]);
                                    Alert::success('Success',' Requisition has been made successfully');
                                    return back();
                  }          

            if ($role== "HR Manager") {
                       //proceed to send email to the HR 
            $sendmailtohr=DB::table('employeerequisitionusers')
                               ->join('users', 'users.id','=', 'employeerequisitionusers.userId')
                               ->where('employeerequisitionusers.employeetype', 'HR Manager')   
                               ->get();
                               //dd($sendmailtogroupceo);
            foreach($sendmailtohr as $usersemails)
            { 
                //dd($usersemails->email);
              \Mail::to($usersemails->email)->send(new \App\Mail\recrutohr($data));
            }      

            $updateinitiatecollumn=DB::table('employeerequisitions')
                                    ->where('id',$job->id)
                                    ->update(['status' => "initiated"]);
                                    Alert::success('Success','Your Requisition has been made successfully');
                                    return back();  
                  } 
             if ($role =="Executive Lead") {
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
                                    ->update(['status' => "initiated"]);
                                    Alert::success('Success','Your Requisition has been made successfully');
                                    return back();
                       }  
              if ($role =="Group CEO") {
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
                                    ->update(['status' => "initiated"]);
                                    Alert::success('Success','Your Requisition has been made successfully');
                                    return back();
                               }   

                  else{

                     $whomtosendemail=DB::table('employeerequisitionusers')
                           ->join('users','users.id', '=', 'employeerequisitionusers.userId' )
                           ->where('employeerequisitionusers.employeetype', 'HR Recruitment Team')
                           ->get();

              foreach($whomtosendemail as $recemails){
                  \Mail::to($recemails->email)->send(new \App\Mail\employeerequesition($data));
              }
              
  


              $updateinitiatecollumn=DB::table('employeerequisitions')
                                    ->where('id',$id["id"])
                                    ->update(['status' => "initiated"]);
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
      $request->validate([
            'jobtittle' => 'required|string',
            'jobdescription' => 'required',
            'positions' => 'required|numeric',
            'location'=>'required',
            'jobcategory'=>'required',
            'intenting'=>'required',
            'startdate'=>'required',
            'manager'=>'required',
            'pwd'=>'required',
            'interviews'=>'required',
            'employementtype' => 'required|string',
            'posrequirements' => 'required',
            'salary' => 'required|numeric',
             'salaryto' => 'required|numeric',
            'responsibilities' => 'required',
        ]);

        $employeeRequisition->update($request->all());
        Alert::success('Success','Your Requisition changes has been saved successfully');
         return redirect()->route('employeerequisitions.index');
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
        
        $checkaction=DB::table('employeerequisitions')
            ->where('id', $request->jobid)
            ->first();
  if ($job->role =="" && $getrole->employeetype =='Group CEO') {
                    if ($checkaction->action ==4 ) {
                          Alert::success('Success',' Requisition  Action has already occured!!');
                         return redirect()->route('employeerequisitions.index');
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
                'salaryto'      =>  $job->salaryto,
                'responsibilities'      =>  $job->responsibilities,
                'posrequirements'      =>  $job->posrequirements,
                'posskills'      =>  $job->posskills,
                'location'   =>   $job->location,
                'jobcategory'   =>   $job->jobcategory,
                'intenting'   =>   unserialize($job->intenting),
                'startdate'   =>   $job->startdate,
                'manager'   =>   $job->manager,
                'pwd'   =>   $job->pwd,
                'interviews'   =>   $job->interviews,
                'jobdescription'   =>   $job->jobdescription
            );
               

        $towhomtosendemail=DB::table('requsitionsapprovals')
                         ->join('users', 'users.id', '=', 'requsitionsapprovals.userId')
                         ->join('job_approvals', 'job_approvals.userId', '=', 'users.id')
                         ->where('requsitionsapprovals.jobid', $request->jobid)
                         ->get();

        foreach($towhomtosendemail as $usersemails)
             { 
           
        \Mail::to($usersemails->email)->send(new \App\Mail\returnforcorrectiontohiringmanager($data));
             
            }

                   $updateinitiatecollumn=DB::table('employeerequisitions')
                                    ->where('id',$request->jobid)
                                    ->update(['status' => "",'action'=>'4']);
             Alert::success('Success','Your comments have been send successfully'); 
             return back();
        }



             if ($job->role =="" && $getrole->employeetype =='Executive Lead') {
                    if ($checkaction->action ==3 ||$checkaction->action ==4 ) {
                          Alert::success('Success',' Requisition  Action has already occured!!');
                         return redirect()->route('employeerequisitions.index');
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
                'salaryto'      =>  $job->salaryto,
                'responsibilities'      =>  $job->responsibilities,
                'posrequirements'      =>  $job->posrequirements,
                'posskills'      =>  $job->posskills,
                'location'   =>   $job->location,
                'jobcategory'   =>   $job->jobcategory,
                'intenting'   =>   unserialize($job->intenting),
                'startdate'   =>   $job->startdate,
                'manager'   =>   $job->manager,
                'pwd'   =>   $job->pwd,
                'interviews'   =>   $job->interviews,
                'jobdescription'   =>   $job->jobdescription
            );
               

        $towhomtosendemail=DB::table('requsitionsapprovals')
                         ->join('users', 'users.id', '=', 'requsitionsapprovals.userId')
                         ->join('job_approvals', 'job_approvals.userId', '=', 'users.id')
                         ->where('requsitionsapprovals.jobid', $request->jobid)
                         ->get();

        foreach($towhomtosendemail as $usersemails)
             { 
           
        \Mail::to($usersemails->email)->send(new \App\Mail\returnforcorrectiontohiringmanager($data));
             
            }

                   $updateinitiatecollumn=DB::table('employeerequisitions')
                                    ->where('id',$request->jobid)
                                    ->update(['status' => "",'action'=>'3']);
             Alert::success('Success','Your comments have been send successfully'); 
             return back();
        }





      if ($job->role =="" && $getrole->employeetype =='HR Manager') {
                    if ($checkaction->action ==2 || $checkaction->action ==3 ||$checkaction->action ==4 ) {
                          Alert::success('Success',' Requisition  Action has already occured!!');
                         return redirect()->route('employeerequisitions.index');
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
                'salaryto'      =>  $job->salaryto,
                'responsibilities'      =>  $job->responsibilities,
                'posrequirements'      =>  $job->posrequirements,
                'posskills'      =>  $job->posskills,
                'location'   =>   $job->location,
                'jobcategory'   =>   $job->jobcategory,
                'intenting'   =>   unserialize($job->intenting),
                'startdate'   =>   $job->startdate,
                'manager'   =>   $job->manager,
                'pwd'   =>   $job->pwd,
                'interviews'   =>   $job->interviews,
                'jobdescription'   =>   $job->jobdescription
            );
               

        $towhomtosendemail=DB::table('requsitionsapprovals')
                         ->join('users', 'users.id', '=', 'requsitionsapprovals.userId')
                         ->join('job_approvals', 'job_approvals.userId', '=', 'users.id')
                         ->where('requsitionsapprovals.jobid', $request->jobid)
                         ->get();

        foreach($towhomtosendemail as $usersemails)
             { 
           
        \Mail::to($usersemails->email)->send(new \App\Mail\returnforcorrectiontohiringmanager($data));
             
            }

                   $updateinitiatecollumn=DB::table('employeerequisitions')
                                    ->where('id',$request->jobid)
                                    ->update(['status' => "",'action'=>'2']);
             Alert::success('Success','Your comments have been send successfully'); 
             return back();
        }



                 if ($job->role =="" && $getrole->employeetype =='HR Recruitment Team') {
                    if ($checkaction->action ==1 || $checkaction->action ==2 || $checkaction->action ==3 ||$checkaction->action ==4 ) {
                          Alert::success('Success',' Requisition  Action has already occured!!');
                         return redirect()->route('employeerequisitions.index');
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
                'salaryto'      =>  $job->salaryto,
                'responsibilities'      =>  $job->responsibilities,
                'posrequirements'      =>  $job->posrequirements,
                'posskills'      =>  $job->posskills,
                'location'   =>   $job->location,
                'jobcategory'   =>   $job->jobcategory,
                'intenting'   =>   unserialize($job->intenting),
                'startdate'   =>   $job->startdate,
                'manager'   =>   $job->manager,
                'pwd'   =>   $job->pwd,
                'interviews'   =>   $job->interviews,
                'jobdescription'   =>   $job->jobdescription
            );
               

        $towhomtosendemail=DB::table('requsitionsapprovals')
                         ->join('users', 'users.id', '=', 'requsitionsapprovals.userId')
                         ->join('job_approvals', 'job_approvals.userId', '=', 'users.id')
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
             return back();
        }


     if ($job->role =="Executive Lead" && $getrole->employeetype =='Group CEO') {
                    if ($checkaction->action ==1) {
                          Alert::success('Success',' Requisition  Action has already occured!!');
                         return redirect()->route('employeerequisitions.index');
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
                'salaryto'      =>  $job->salaryto,
                'responsibilities'      =>  $job->responsibilities,
                'posrequirements'      =>  $job->posrequirements,
                'posskills'      =>  $job->posskills,
                'location'   =>   $job->location,
                'jobcategory'   =>   $job->jobcategory,
                'intenting'   =>   unserialize($job->intenting),
                'startdate'   =>   $job->startdate,
                'manager'   =>   $job->manager,
                'pwd'   =>   $job->pwd,
                'interviews'   =>   $job->interviews,
                'jobdescription'   =>   $job->jobdescription
            );
               

        $towhomtosendemail=DB::table('requsitionsapprovals')
                         ->join('users', 'users.id', '=', 'requsitionsapprovals.userId')
                         ->join('job_approvals', 'job_approvals.userId', '=', 'users.id')
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
             return back();
        }

         if ($job->role =="HR Manager" && $getrole->employeetype =='Executive Lead') {
                    if ($checkaction->action ==1 || $checkaction->action ==2) {
                          Alert::success('Success',' Requisition  Action has already occured!!');
                         return redirect()->route('employeerequisitions.index');
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
                'salaryto'      =>  $job->salaryto,
                'responsibilities'      =>  $job->responsibilities,
                'posrequirements'      =>  $job->posrequirements,
                'posskills'      =>  $job->posskills,
                'location'   =>   $job->location,
                'jobcategory'   =>   $job->jobcategory,
                'intenting'   =>   unserialize($job->intenting),
                'startdate'   =>   $job->startdate,
                'manager'   =>   $job->manager,
                'pwd'   =>   $job->pwd,
                'interviews'   =>   $job->interviews,
                'jobdescription'   =>   $job->jobdescription
            );
               

        $towhomtosendemail=DB::table('requsitionsapprovals')
                         ->join('users', 'users.id', '=', 'requsitionsapprovals.userId')
                         ->join('job_approvals', 'job_approvals.userId', '=', 'users.id')
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
             return back();
        }

    if ($job->role =="HR Manager" && $getrole->employeetype =='Group CEO') {
                    if ($checkaction->action ==2) {
                          Alert::success('Success',' Requisition  Action has already occured!!');
                         return redirect()->route('employeerequisitions.index');
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
                'salaryto'      =>  $job->salaryto,
                'responsibilities'      =>  $job->responsibilities,
                'posrequirements'      =>  $job->posrequirements,
                'posskills'      =>  $job->posskills,
                'location'   =>   $job->location,
                'jobcategory'   =>   $job->jobcategory,
                'intenting'   =>   unserialize($job->intenting),
                'startdate'   =>   $job->startdate,
                'manager'   =>   $job->manager,
                'pwd'   =>   $job->pwd,
                'interviews'   =>   $job->interviews,
                'jobdescription'   =>   $job->jobdescription
            );
               

        $towhomtosendemail=DB::table('requsitionsapprovals')
                         ->join('users', 'users.id', '=', 'requsitionsapprovals.userId')
                         ->join('job_approvals', 'job_approvals.userId', '=', 'users.id')
                         ->where('requsitionsapprovals.jobid', $request->jobid)
                         ->get();

        foreach($towhomtosendemail as $usersemails)
             { 
           
        \Mail::to($usersemails->email)->send(new \App\Mail\returnforcorrectiontohiringmanager($data));
             
            }

                   $updateinitiatecollumn=DB::table('employeerequisitions')
                                    ->where('id',$request->jobid)
                                    ->update(['status' => "",'action'=>'2']);
             Alert::success('Success','Your comments have been send successfully'); 
             return back();
        }


     if ($job->role =="HR Recruitment Team" && $getrole->employeetype =='Executive Lead') {
                    if ($checkaction->action ==2 || $checkaction->action ==3) {
                          Alert::success('Success',' Requisition  Action has already occured!!');
                         return redirect()->route('employeerequisitions.index');
            }
              $request->validate([
            'comment'=>'required',
        ]);
     
        $user_id = Auth::user()->id;
         $senderemail = JobApproval::create($request->all());
         $insertcommentby=DB::table('job_approvals')
                        ->where('jobid', $request->jobid)
                        ->update(['commentby' => $user_id]);Id;

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
                'salaryto'      =>  $job->salaryto,
                'responsibilities'      =>  $job->responsibilities,
                'posrequirements'      =>  $job->posrequirements,
                'posskills'      =>  $job->posskills,
                'location'   =>   $job->location,
                'jobcategory'   =>   $job->jobcategory,
                'intenting'   =>   unserialize($job->intenting),
                'startdate'   =>   $job->startdate,
                'manager'   =>   $job->manager,
                'pwd'   =>   $job->pwd,
                'interviews'   =>   $job->interviews,
                'jobdescription'   =>   $job->jobdescription
            );
               

        $towhomtosendemail=DB::table('requsitionsapprovals')
                         ->join('users', 'users.id', '=', 'requsitionsapprovals.userId')
                         ->join('job_approvals', 'job_approvals.userId', '=', 'users.id')
                         ->where('requsitionsapprovals.jobid', $request->jobid)
                         ->get();

        foreach($towhomtosendemail as $usersemails)
             { 
           
        \Mail::to($usersemails->email)->send(new \App\Mail\returnforcorrectiontohiringmanager($data));
             
            }

                   $updateinitiatecollumn=DB::table('employeerequisitions')
                                    ->where('id',$request->jobid)
                                    ->update(['status' => "",'action'=>'2']);
             Alert::success('Success','Your comments have been send successfully'); 
             return back();
        }
        if ($job->role =="HR Recruitment Team" && $getrole->employeetype =='HR Manager') {
                    if ($checkaction->action ==1 || $checkaction->action ==2 ||$checkaction->action ==3) {
                          Alert::success('Success',' Requisition  Action has already occured!!');
                         return redirect()->route('employeerequisitions.index');
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
                'salaryto'      =>  $job->salaryto,
                'responsibilities'      =>  $job->responsibilities,
                'posrequirements'      =>  $job->posrequirements,
                'posskills'      =>  $job->posskills,
                'location'   =>   $job->location,
                'jobcategory'   =>   $job->jobcategory,
                'intenting'   =>   unserialize($job->intenting),
                'startdate'   =>   $job->startdate,
                'manager'   =>   $job->manager,
                'pwd'   =>   $job->pwd,
                'interviews'   =>   $job->interviews,
                'jobdescription'   =>   $job->jobdescription
            );
               

        $towhomtosendemail=DB::table('requsitionsapprovals')
                         ->join('users', 'users.id', '=', 'requsitionsapprovals.userId')
                         ->join('job_approvals', 'job_approvals.userId', '=', 'users.id')
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
             return back();
        }  
        if ($job->role =="HR Recruitment Team" && $getrole->employeetype =='Group CEO') {
                    if ($checkaction->action ==3) {
                          Alert::success('Success',' Requisition  Action has already occured!!');
                         return redirect()->route('employeerequisitions.index');
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
                'salaryto'      =>  $job->salaryto,
                'responsibilities'      =>  $job->responsibilities,
                'posrequirements'      =>  $job->posrequirements,
                'posskills'      =>  $job->posskills,
                'location'   =>   $job->location,
                'jobcategory'   =>   $job->jobcategory,
                'intenting'   =>   unserialize($job->intenting),
                'startdate'   =>   $job->startdate,
                'manager'   =>   $job->manager,
                'pwd'   =>   $job->pwd,
                'interviews'   =>   $job->interviews,
                'jobdescription'   =>   $job->jobdescription
            );
               

        $towhomtosendemail=DB::table('requsitionsapprovals')
                         ->join('users', 'users.id', '=', 'requsitionsapprovals.userId')
                         ->join('job_approvals', 'job_approvals.userId', '=', 'users.id')
                         ->where('requsitionsapprovals.jobid', $request->jobid)
                         ->get();

        foreach($towhomtosendemail as $usersemails)
             { 
           
        \Mail::to($usersemails->email)->send(new \App\Mail\returnforcorrectiontohiringmanager($data));
             
            }

                   $updateinitiatecollumn=DB::table('employeerequisitions')
                                    ->where('id',$request->jobid)
                                    ->update(['status' => "",'action'=>'3']);
             Alert::success('Success','Your comments have been send successfully'); 
             return back();
        }   

    }

    /**
     * view comments made from approver 1
     * 
     * */
        public function viewcomments()
    {
       $user=Auth::user()->id;
       $jobapproval=JobApproval::where('userId', $user)->get();
        return view('employeerequisitions.viewcomments', compact('jobapproval'));
    }
/**
 * returning an approves message
 * 
 * */
public function approvesmessage(){
    return view('employeerequisitions.approvesmessage');
}
// aprroving by the recruitment team

public function approvetoHR($id){
    $checkaction=DB::table('employeerequisitions')
            ->where('id', $id)
            ->first();
    if ($checkaction->action ==1 ||$checkaction->action ==2 ||$checkaction->action ==3 || $checkaction->action ==4) {
         Alert::success('Success',' Requisition  Action has already occured!!');
         return redirect()->route('employeerequisitions.index');
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
                'salaryto'      =>  $job->salaryto,
                'responsibilities'      =>  $job->responsibilities,
                'posrequirements'      =>  $job->posrequirements,
                'posskills'      =>  $job->posskills,
                'location'   =>   $job->location,
                'jobcategory'   =>   $job->jobcategory,
                 'intenting'   =>   unserialize($job->intenting),
                'startdate'   =>   $job->startdate,
                'manager'   =>   $job->manager,
                'pwd'   =>   $job->pwd,
                'interviews'   =>   $job->interviews,
                'jobdescription'   =>   $job->jobdescription
        );


            $towhomtosendemail=DB::table('requsitionsapprovals')
                         ->join('users', 'users.id', '=', 'requsitionsapprovals.userId')
                         ->where('requsitionsapprovals.jobid', $id)
                          ->get(); 
             //send email to notify those in the back
             foreach($towhomtosendemail as $usersemails)
             { 
                //dd($usersemails->email);
                \Mail::to($usersemails->email)->queue(new \App\Mail\returnnotificationtohiringmanager($data));
            }    
            //proceed to send email to the HR 
            $sendmailtohr=DB::table('employeerequisitionusers')
                               ->join('users', 'users.id','=', 'employeerequisitionusers.userId')
                               ->where('employeerequisitionusers.employeetype', 'HR Manager')   
                               ->get();
                               //dd($sendmailtogroupceo);
             foreach($sendmailtohr as $usersemails)
             { 
                //dd($usersemails->email);
              \Mail::to($usersemails->email)->send(new \App\Mail\approvetohr($data));
            }     
               $approve1=DB::table('employeerequisitions')
                           ->where('id',$id)
                           ->update(['stages' => "1", 'action'=>'1']);
        Alert::success('Success',' Requisition  has been approved successfully');
         return redirect()->route('employeerequisitions.index');
                 
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
         return redirect()->route('employeerequisitions.index');
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
                'salaryto'      =>  $job->salaryto,
                'responsibilities'      =>  $job->responsibilities,
                'posrequirements'      =>  $job->posrequirements,
                'posskills'      =>  $job->posskills,
                'location'   =>   $job->location,
                'jobcategory'   =>   $job->jobcategory,
                'intenting'   =>   unserialize($job->intenting),
                'startdate'   =>   $job->startdate,
                'manager'   =>   $job->manager,
                'pwd'   =>   $job->pwd,
                'interviews'   =>   $job->interviews,
                'jobdescription'   =>   $job->jobdescription
        );

           $towhomtosendemail=DB::table('requsitionsapprovals')
                         ->join('users', 'users.id', '=', 'requsitionsapprovals.userId')
                         ->where('requsitionsapprovals.jobid', $id)
                          ->get(); 
            //send email to notify those in the back
             foreach($towhomtosendemail as $usersemails)
             { 
                //dd($usersemails->email);
                  // mail back to hiring manager 
              \Mail::to($usersemails->email)->queue(new \App\Mail\returnnotificationtohiringmanager($data));
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
         \Mail::to($bossEmail)->send(new \App\Mail\employeerequisitionapprove($data));
                  // Alert::success('Success','You  have made approvals  successfully');
                  // return back();   
        Alert::success('Success',' Requisition  has been approved successfully');
         return redirect()->route('employeerequisitions.index');                          
 }

 /**
  * aprroves from hr to exec if the initiator is the hr recruiter
  * */
  public function hrapprovingtoexec($id){
    $checkaction=DB::table('employeerequisitions')
            ->where('id', $id)
            ->first();
            if ($checkaction->action ==1 ||$checkaction->action ==2 ||$checkaction->action ==3) {
         Alert::success('Success',' Requisition  Action has already occured!!');
         return redirect()->route('employeerequisitions.index');
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
                'salaryto'      =>  $job->salaryto,
                'responsibilities'      =>  $job->responsibilities,
                'posrequirements'      =>  $job->posrequirements,
                'posskills'      =>  $job->posskills,
                'location'   =>   $job->location,
                'jobcategory'   =>   $job->jobcategory,
                'intenting'   =>   unserialize($job->intenting),
                'startdate'   =>   $job->startdate,
                'manager'   =>   $job->manager,
                'pwd'   =>   $job->pwd,
                'interviews'   =>   $job->interviews,
                'jobdescription'   =>   $job->jobdescription
        );
         $initiatorcompany=DB::table('requsitionsapprovals')
                                 ->join('users', 'users.id','=' ,'requsitionsapprovals.userId')
                                 ->join('companies', 'companies.id', '=', 'users.company_id')
                                 ->where('requsitionsapprovals.jobid', $id)
                                 ->where('requsitionsapprovals.initiator', 'initiator')
                                 ->first()->company_id;

        $bossId = DB::table("employeerequisitionusers")->where("company_id","=",$initiatorcompany)->where("employeetype","=","Executive Lead")->first()->userId;
        $bossEmail = DB::table("users")->where("id","=",$bossId)->first()->email;
         \Mail::to($bossEmail)->send(new \App\Mail\hrapprovingtoexec($data));

           $towhomtosendemail=DB::table('requsitionsapprovals')
                         ->join('users', 'users.id', '=', 'requsitionsapprovals.userId')
                         ->where('requsitionsapprovals.jobid', $id)
                          ->get(); 
            //send email to notify those in the back
            //  foreach($towhomtosendemail as $usersemails)
            //  { 
            //     //dd($usersemails->email);
            //       // mail back to hiring manager 
            //   \Mail::to($usersemails->email)->queue(new \App\Mail\returnnotificationtohiringmanager($data));
            // } 
              
                             Alert::success('Success',' Requisition has been approved successfully');
         return redirect()->route('employeerequisitions.index');; 
                           
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
         return redirect()->route('employeerequisitions.index');
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
                'salaryto'      =>  $job->salaryto,
                'responsibilities'      =>  $job->responsibilities,
                'posrequirements'      =>  $job->posrequirements,
                'posskills'      =>  $job->posskills,
                'location'   =>   $job->location,
                'jobcategory'   =>   $job->jobcategory,
               'intenting'   =>   unserialize($job->intenting),
                'startdate'   =>   $job->startdate,
                'manager'   =>   $job->manager,
                'pwd'   =>   $job->pwd,
                'interviews'   =>   $job->interviews,
                'jobdescription'   =>   $job->jobdescription
        );
   //store that it has been approved

        $towhomtosendemail=DB::table('requsitionsapprovals')
                         ->join('users', 'users.id', '=', 'requsitionsapprovals.userId')
                         ->where('requsitionsapprovals.jobid', $id)
                          ->get(); 
             //send email to notify those in the back
             foreach($towhomtosendemail as $usersemails)
             { 
                //dd($usersemails->email);
                \Mail::to($usersemails->email)->queue(new \App\Mail\returnnotificationtoleadexecutive($data));
            }    
            //proceed to send email to the group CEO client 
            $sendmailtogroupceo=DB::table('employeerequisitionusers')
                               ->join('users', 'users.id','=', 'employeerequisitionusers.userId')
                               ->where('employeerequisitionusers.employeetype', 'Group CEO')   
                               ->first();
                               //dd($sendmailtogroupceo);    
              \Mail::to($sendmailtogroupceo->email)->send(new \App\Mail\employeerequisitionapprovebyhr($data));
                         Alert::success('Success',' Requisition  has been approved successfully');
         return redirect()->route('employeerequisitions.index');
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
            return redirect()->route('employeerequisitions.index');  
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
                'salaryto'      =>  $job->salaryto,
                'responsibilities'      =>  $job->responsibilities,
                'posrequirements'      =>  $job->posrequirements,
                'posskills'      =>  $job->posskills,
                'location'   =>   $job->location,
                'jobcategory'   =>   $job->jobcategory,
               'intenting'   =>   unserialize($job->intenting),
                'startdate'   =>   $job->startdate,
                'manager'   =>   $job->manager,
                'pwd'   =>   $job->pwd,
                'interviews'   =>   $job->interviews,
                'jobdescription'   =>   $job->jobdescription
        );
   //store that it has been approved

        $towhomtosendemail=DB::table('requsitionsapprovals')
                         ->join('users', 'users.id', '=', 'requsitionsapprovals.userId')
                         ->where('requsitionsapprovals.jobid', $id)
                          ->get(); 
             //send email to notify those in the back
            //  foreach($towhomtosendemail as $usersemails)
            //  { 
            //     //dd($usersemails->email);
            //     \Mail::to($usersemails->email)->queue(new \App\Mail\returnnotificationtoleadexecutive($data));
            // }    
            //proceed to send email to the group CEO client 
            $sendmailtogroupceo=DB::table('employeerequisitionusers')
                               ->join('users', 'users.id','=', 'employeerequisitionusers.userId')
                               ->where('employeerequisitionusers.employeetype', 'Group CEO')   
                               ->first();
                               //dd($sendmailtogroupceo);    
              \Mail::to($sendmailtogroupceo->email)->send(new \App\Mail\execapprovinghrinitiator($data));
        Alert::success('Success',' Requisition has been approved  successfully');
         return redirect()->route('employeerequisitions.index');
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
         return redirect()->route('employeerequisitions.index');
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
                'salaryto'      =>  $job->salaryto,
                'responsibilities'      =>  $job->responsibilities,
                'posrequirements'      =>  $job->posrequirements,
                'posskills'      =>  $job->posskills,
                'location'   =>   $job->location,
                'jobcategory'   =>   $job->jobcategory,
               'intenting'   =>   unserialize($job->intenting),
                'startdate'   =>   $job->startdate,
                'manager'   =>   $job->manager,
                'pwd'   =>   $job->pwd,
                'interviews'   =>   $job->interviews,
                'jobdescription'   =>   $job->jobdescription
        );
   //store that it has been approved

        $towhomtosendemail=DB::table('requsitionsapprovals')
                         ->join('users', 'users.id', '=', 'requsitionsapprovals.userId')
                         ->where('requsitionsapprovals.jobid', $id)
                          ->get(); 
             //send email to notify those in the back
             foreach($towhomtosendemail as $usersemails)
             { 
                //dd($usersemails->email);
                \Mail::to($usersemails->email)->queue(new \App\Mail\returnnotificationtoleadexecutive($data));
            }    
            //proceed to send email to the group CEO client 
            $sendmailtogroupceo=DB::table('employeerequisitionusers')
                               ->join('users', 'users.id','=', 'employeerequisitionusers.userId')
                               ->where('employeerequisitionusers.employeetype', 'Group CEO')   
                               ->first();
                               //dd($sendmailtogroupceo);    
              \Mail::to($sendmailtogroupceo->email)->send(new \App\Mail\execapprovingtoceorecruinitiator($data));
        Alert::success('Success',' Requisition  has been approved successfully');
         return redirect()->route('employeerequisitions.index');
                     // return back();
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
         return redirect()->route('employeerequisitions.index');
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
                'salaryto'      =>  $job->salaryto,
                'responsibilities'      =>  $job->responsibilities,
                'posrequirements'      =>  $job->posrequirements,
                'posskills'      =>  $job->posskills,
                'location'   =>   $job->location,
                'jobcategory'   =>   $job->jobcategory,
               'intenting'   =>   unserialize($job->intenting),
                'startdate'   =>   $job->startdate,
                'manager'   =>   $job->manager,
                'pwd'   =>   $job->pwd,
                'interviews'   =>   $job->interviews,
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
         return redirect()->route('employeerequisitions.index');
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
         return redirect()->route('employeerequisitions.index');
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
                'salaryto'      =>  $job->salaryto,
                'responsibilities'      =>  $job->responsibilities,
                'posrequirements'      =>  $job->posrequirements,
                'posskills'      =>  $job->posskills,
                'location'   =>   $job->location,
                'jobcategory'   =>   $job->jobcategory,
               'intenting'   =>   unserialize($job->intenting),
                'startdate'   =>   $job->startdate,
                'manager'   =>   $job->manager,
                'pwd'   =>   $job->pwd,
                'interviews'   =>   $job->interviews,
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
         return redirect()->route('employeerequisitions.index');
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
         return redirect()->route('employeerequisitions.index');
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
                'salaryto'      =>  $job->salaryto,
                'responsibilities'      =>  $job->responsibilities,
                'posrequirements'      =>  $job->posrequirements,
                'posskills'      =>  $job->posskills,
                'location'   =>   $job->location,
                'jobcategory'   =>   $job->jobcategory,
               'intenting'   =>   unserialize($job->intenting),
                'startdate'   =>   $job->startdate,
                'manager'   =>   $job->manager,
                'pwd'   =>   $job->pwd,
                'interviews'   =>   $job->interviews,
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
                \Mail::to($usersemails->email)->send(new \App\Mail\approvefromchiefhrinitiator($data));
            }

        $approve1=DB::table('employeerequisitions')
             ->where('id',$id)
             ->update(['stage3' => "1",
                        'approved_status'=>"1", 'action'=>2
              ]);
            // Alert::success('Success','Chief CEO approvals have been made successfully');
            // return back();
                                   Alert::success('Success',' Requisition  has been approved successfully');
         return redirect()->route('employeerequisitions.index');
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
         return redirect()->route('employeerequisitions.index');
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
                'salaryto'      =>  $job->salaryto,
                'responsibilities'      =>  $job->responsibilities,
                'posrequirements'      =>  $job->posrequirements,
                'posskills'      =>  $job->posskills,
                'location'   =>   $job->location,
                'jobcategory'   =>   $job->jobcategory,
               'intenting'   =>   unserialize($job->intenting),
                'startdate'   =>   $job->startdate,
                'manager'   =>   $job->manager,
                'pwd'   =>   $job->pwd,
                'interviews'   =>   $job->interviews,
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
                \Mail::to($usersemails->email)->send(new \App\Mail\approvefromchiefrecruinitiator($data));
            }

        $approve1=DB::table('employeerequisitions')
             ->where('id',$id)
             ->update(['stage3' => "1",
                        'approved_status'=>"1", 'action'=>'3'
              ]);
            // Alert::success('Success','Chief CEO approvals have been made successfully');
            // return back();
        Alert::success('Success',' Requisition  has been approved successfully');
         return redirect()->route('employeerequisitions.index');
 } 
 /** decline from ceo when the emp is the initiator declinefroceoempinitator
  * */
 public function declinefroceoempinitator($id){
$checkaction=DB::table('employeerequisitions')
            ->where('id', $id)
            ->first();
            if ($checkaction->action ==4) {
         Alert::success('Success',' Requisition  Action has already occured!!');
         return redirect()->route('employeerequisitions.index');
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
                        'approved_status'=>"2", 'action'=>'4'
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
                'salaryto'      =>  $job->salaryto,
                'responsibilities'      =>  $job->responsibilities,
                'posrequirements'      =>  $job->posrequirements,
                'posskills'      =>  $job->posskills,
                'location'   =>   $job->location,
                'jobcategory'   =>   $job->jobcategory,
                'intenting'   =>   unserialize($job->intenting),
                'startdate'   =>   $job->startdate,
                'manager'   =>   $job->manager,
                'pwd'   =>   $job->pwd,
                'interviews'   =>   $job->interviews,
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
         return redirect()->route('employeerequisitions.index');



 }
 /**
  * decline when the emp is the initiator from exec declinefroexecempinitator
  * */
 public function declinefroexecempinitator($id){

$checkaction=DB::table('employeerequisitions')
            ->where('id', $id)
            ->first();
            if ($checkaction->action ==3 || $checkaction->action ==4) {
         Alert::success('Success',' Requisition  Action has already occured!!');
         return redirect()->route('employeerequisitions.index');
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
                        'approved_status'=>"2" ,'áction'=>'3'
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
                'salaryto'      =>  $job->salaryto,
                'responsibilities'      =>  $job->responsibilities,
                'posrequirements'      =>  $job->posrequirements,
                'posskills'      =>  $job->posskills,
                'location'   =>   $job->location,
                'jobcategory'   =>   $job->jobcategory,
                'intenting'   =>   unserialize($job->intenting),
                'startdate'   =>   $job->startdate,
                'manager'   =>   $job->manager,
                'pwd'   =>   $job->pwd,
                'interviews'   =>   $job->interviews,
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
         return redirect()->route('employeerequisitions.index');



 }
 /** decline when the exec is the initiator nd ceo is declining declinefromceoexecinitiator
  * */
public function declinefromceoexecinitiator($id){
$checkaction=DB::table('employeerequisitions')
            ->where('id', $id)
            ->first();
            if ($checkaction->action ==1) {
         Alert::success('Success',' Requisition  Action has already occured!!');
         return redirect()->route('employeerequisitions.index');
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
      // if ($checkjobapproval->approved_status ==2) {
      //       return redirect()->route('employeerequisitions.approvesmessage')
      //                   ->with('success','Requisition cannot be decline More than Once!!.');
      //   }  
        $decline1=DB::table('employeerequisitions')
             ->where('id',$id)
             ->update([
                        'approved_status'=>"2",'action'=>'1'
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
                'salaryto'      =>  $job->salaryto,
                'responsibilities'      =>  $job->responsibilities,
                'posrequirements'      =>  $job->posrequirements,
                'posskills'      =>  $job->posskills,
                'location'   =>   $job->location,
                'jobcategory'   =>   $job->jobcategory,
                'intenting'   =>   unserialize($job->intenting),
                'startdate'   =>   $job->startdate,
                'manager'   =>   $job->manager,
                'pwd'   =>   $job->pwd,
                'interviews'   =>   $job->interviews,
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
         return redirect()->route('employeerequisitions.index');



 }
 /**
  * decline from hr when hiring manager inititaes declinefromhrempinitator
  * */
 public function declinefromhrempinitator($id){
$checkaction=DB::table('employeerequisitions')
            ->where('id', $id)
            ->first();
            if ($checkaction->action ==2 || $checkaction->action ==3 || $checkaction->action ==4) {
         Alert::success('Success',' Requisition  Action has already occured!!');
         return redirect()->route('employeerequisitions.index');
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
                        'approved_status'=>"2",'action'=>'2'
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
                'salaryto'      =>  $job->salaryto,
                'responsibilities'      =>  $job->responsibilities,
                'posrequirements'      =>  $job->posrequirements,
                'posskills'      =>  $job->posskills,
                'location'   =>   $job->location,
                'jobcategory'   =>   $job->jobcategory,
                'intenting'   =>   unserialize($job->intenting),
                'startdate'   =>   $job->startdate,
                'manager'   =>   $job->manager,
                'pwd'   =>   $job->pwd,
                'interviews'   =>   $job->interviews,
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
         return redirect()->route('employeerequisitions.index');



 }
 /** declines from the eexecutive when the initiator is hr declinefromexechrinitiator
   * */
public function declinefromexechrinitiator($id){
   $checkaction=DB::table('employeerequisitions')
            ->where('id', $id)
            ->first();
            if ($checkaction->action ==1 || $checkaction->action ==2) {
         Alert::success('Success',' Requisition  Action has already occured!!');
         return redirect()->route('employeerequisitions.index');
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
                        'approved_status'=>"2", 'action'=>'1'
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
                'salaryto'      =>  $job->salaryto,
                'responsibilities'      =>  $job->responsibilities,
                'posrequirements'      =>  $job->posrequirements,
                'posskills'      =>  $job->posskills,
                'location'   =>   $job->location,
                'jobcategory'   =>   $job->jobcategory,
                'intenting'   =>   unserialize($job->intenting),
                'startdate'   =>   $job->startdate,
                'manager'   =>   $job->manager,
                'pwd'   =>   $job->pwd,
                'interviews'   =>   $job->interviews,
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
         return redirect()->route('employeerequisitions.index');



 }

  /** decline from the cheif ceo when the recruiter is the intiator of the request 
   * */
public function declinefromceorecruinitiator($id){

$checkaction=DB::table('employeerequisitions')
            ->where('id', $id)
            ->first();
            if ($checkaction->action ==3) {
         Alert::success('Success',' Requisition  Action has already occured!!');
         return redirect()->route('employeerequisitions.index');
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
                        'approved_status'=>"2", 'action'=>'3'
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
                'salaryto'      =>  $job->salaryto,
                'responsibilities'      =>  $job->responsibilities,
                'posrequirements'      =>  $job->posrequirements,
                'posskills'      =>  $job->posskills,
                'location'   =>   $job->location,
                'jobcategory'   =>   $job->jobcategory,
                'intenting'   =>   unserialize($job->intenting),
                'startdate'   =>   $job->startdate,
                'manager'   =>   $job->manager,
                'pwd'   =>   $job->pwd,
                'interviews'   =>   $job->interviews,
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
         return redirect()->route('employeerequisitions.index');



 }
 /* decline from the ceo when the hr is the initiator declinefromceohrinitiator
 */
public function declinefromceohrinitiator($id){

$checkaction=DB::table('employeerequisitions')
            ->where('id', $id)
            ->first();
            if ($checkaction->action ==2) {
         Alert::success('Success',' Requisition  Action has already occured!!');
         return redirect()->route('employeerequisitions.index');
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
                        'approved_status'=>"2"
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
                'salaryto'      =>  $job->salaryto,
                'responsibilities'      =>  $job->responsibilities,
                'posrequirements'      =>  $job->posrequirements,
                'posskills'      =>  $job->posskills,
                'location'   =>   $job->location,
                'jobcategory'   =>   $job->jobcategory,
                'intenting'   =>   unserialize($job->intenting),
                'startdate'   =>   $job->startdate,
                'manager'   =>   $job->manager,
                'pwd'   =>   $job->pwd,
                'interviews'   =>   $job->interviews,
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
         return redirect()->route('employeerequisitions.index');



 }
   /**n decline from eexce when the initiator is the  recruiter declinefromexecrecruinitiator
   * */
public function declinefromexecrecruinitiator($id){

$checkaction=DB::table('employeerequisitions')
            ->where('id', $id)
            ->first();
            if ($checkaction->action ==2 || $checkaction->action ==3) {
         Alert::success('Success',' Requisition  Action has already occured!!');
         return redirect()->route('employeerequisitions.index');
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
                        'approved_status'=>"2", 'action'=>'2'
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
                'salaryto'      =>  $job->salaryto,
                'responsibilities'      =>  $job->responsibilities,
                'posrequirements'      =>  $job->posrequirements,
                'posskills'      =>  $job->posskills,
                'location'   =>   $job->location,
                'jobcategory'   =>   $job->jobcategory,
                'intenting'   =>   unserialize($job->intenting),
                'startdate'   =>   $job->startdate,
                'manager'   =>   $job->manager,
                'pwd'   =>   $job->pwd,
                'interviews'   =>   $job->interviews,
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
                \Mail::to($usersemails->email)->send(new \App\Mail\employeerequisitiondecline($data));
            }

                           Alert::success('Success',' Requisition  has been decline successfully');
         return redirect()->route('employeerequisitions.index');



 }

   public function decline($id){

    /// check if job had been approved 
    $checkstage1=DB::table('employeerequisitions')
                ->where('id', $id)
                ->where('stage1', 1)
                ->first();
        if ($checkstage1->stage1 ==1) {
                     return redirect()->route('employeerequisitions.approvesmessage')
                        ->with('success','Requisition have already been aprroved!!.');
        }

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
     $checkjobapproval=DB::table('employeerequisitions')
                    ->where('id', $id)
                    ->first();
      if ($checkjobapproval->approved_status ==2) {
            return redirect()->route('employeerequisitions.approvesmessage')
                        ->with('success','Requisition cannot be decline More than Once!!.');
        }  
        $decline1=DB::table('employeerequisitions')
             ->where('id',$id)
             ->update([
                        'approved_status'=>"2"
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
                'salaryto'      =>  $job->salaryto,
                'responsibilities'      =>  $job->responsibilities,
                'posrequirements'      =>  $job->posrequirements,
                'posskills'      =>  $job->posskills,
                'location'   =>   $job->location,
                'jobcategory'   =>   $job->jobcategory,
                'intenting'   =>   unserialize($job->intenting),
                'startdate'   =>   $job->startdate,
                'manager'   =>   $job->manager,
                'pwd'   =>   $job->pwd,
                'interviews'   =>   $job->interviews,
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
         return redirect()->route('employeerequisitions.index');



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
         return redirect()->route('employeerequisitions.index');

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
      $output .= '<option value="'.$row->id.' '.$row->name.'">'.$row->name.'</option>';
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
                'salaryto'      =>  $job->salaryto,
                'responsibilities'      =>  $job->responsibilities,
                'posrequirements'      =>  $job->posrequirements,
                'posskills'      =>  $job->posskills,
                'location'   =>   $job->location,
                'jobcategory'   =>   $job->jobcategory,
               'intenting'   =>   unserialize($job->intenting),
                'startdate'   =>   $job->startdate,
                'manager'   =>   $job->manager,
                'pwd'   =>   $job->pwd,
                'interviews'   =>   $job->interviews,
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
         return redirect()->route('employeerequisitions.index');;
    }
}
