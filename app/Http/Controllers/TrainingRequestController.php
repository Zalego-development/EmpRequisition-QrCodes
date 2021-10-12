<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\TrainingRequest;
use Illuminate\Support\Facades\Auth;
use App\RecommendTraining;
use RealRashid\SweetAlert\Facades\Alert;

class TrainingRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        // get id of logged in user
        $id = Auth::user()->userId;
        // return $id;
         //

         $trainings=DB::table('training_requests')
         ->join('companies','companies.id','=','training_requests.subject_company')
        ->join('departments','departments.id','=','training_requests.subject_department')
        ->join('employees','employees.userId','=','training_requests.subject')
        ->select('training_requests.id','training_requests.title','training_requests.revoke_reason','training_requests.time','training_requests.attendees','training_requests.date','training_requests.request_status','training_requests.duration','training_requests.location','training_requests.created_at',
                    'companies.company','departments.department','training_requests.toAttend',
                    'employees.firstname','employees.lastname','employees.surname','employees.contact','employees.corporateEmail')
        ->where('training_requests.subject','=',$id)
         ->orderBy('training_requests.created_at', 'desc')
         ->get();
        //  ->get();
         // dd($trainings);
         $companies=DB::select('SELECT * FROM companies');
         // $cDepartment=Department::all();
         $data = array('trainings'=>$trainings,'companies'=>$companies);
        //  return $data;
         return view('training.employee')->with($data);
    }

    public function searchRequests(Request $request){
      $search=$request->input('search');
      $id = Auth::user()->userId;
      if($search!=''){

      $trainings=DB::table('training_requests')
                     ->join('companies','companies.id','=','training_requests.subject_company')
                    ->join('departments','departments.id','=','training_requests.subject_department')
                    ->join('employees','employees.userId','=','training_requests.subject')
                    ->select('training_requests.id','training_requests.title','training_requests.revoke_reason','training_requests.time','training_requests.attendees','training_requests.date','training_requests.request_status','training_requests.duration','training_requests.location','training_requests.created_at',
                                'companies.company','departments.department','training_requests.toAttend',
                                'employees.firstname','employees.lastname','employees.surname','employees.contact','employees.corporateEmail')
                    ->where('training_requests.subject','=',$id)
                    ->where('training_requests.title','LIKE', '%'.$search.'%')
                     ->orderBy('training_requests.created_at', 'desc')
                     ->get();
      
      if(count($trainings)>0){
        $companies=DB::select('SELECT * FROM companies');
        $data = array('trainings'=>$trainings,'companies'=>$companies);
               return view('training.employee')->with($data);
      }
       return redirect('/trainingsrequests')->with('modeError',"No results found");
      }
      return redirect('/trainingsrequests');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    
        $data=request()->validate([
            'title'=>'required',
            'time'=>'required',
            'date'=>'required',
            'location'=>'required',
            'duration'=>'required',
            // 'receipient'=>'required',
            // 'company'=>'required',
            // 'department'=>'required',
        ]    
    );
    $id = Auth::user()->userId;

   $userdata=DB::table('employees')
        ->select('companyId','departmentId')
        ->where('employees.userId','=',$id)
        ->first();
        
     //insert data
     $insert= TrainingRequest::create([
        //receipient
        'title'=>$data['title'],
        //company
        'time'=>$data['time'],
        'date'=>$data['date'],
        'toAttend'=>json_encode($id),
        'location'=>$data['location'],
        'duration'=>$data['duration'],
        'subject_company'=>$userdata->companyId,
        'subject_department'=>$userdata->departmentId,
        'subject'=>$id
    ]);

    if($insert){
        return redirect('/trainingsrequests')->with('recordAdd','Training Request sent successfully');
    }else{
        return redirect('/trainingsrequests')->with('recordFail','Failed to send trainining request');
    }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function recommentTraining()
    {
     $id = Auth::user()->userId;
     $deptId = Auth::user()->departmentId;

         $trainings=DB::table('recommend_trainings')
        ->join('employees','employees.userId','=','recommend_trainings.employee_id')
         ->join('companies','companies.id','=','employees.companyId')
        ->join('departments','departments.id','=','employees.departmentId')
        ->select('recommend_trainings.id','recommend_trainings.reply','recommend_trainings.impact','recommend_trainings.title','recommend_trainings.message','recommend_trainings.attendees','recommend_trainings.status','recommend_trainings.created_at',
                    'recommend_trainings.trainer','companies.company','departments.department','employees.firstname','employees.lastname','employees.surname','employees.contact','employees.corporateEmail')
        ->where('recommend_trainings.employee_id','=',$id)
         ->orderBy('recommend_trainings.created_at', 'desc')
         ->get();
        $depts=DB::table('employees')->where('departmentId',$deptId)->get(['employees.id','employees.firstname','employees.lastname','employees.surname']);
         
         $data = array('trainings'=>$trainings,'depts'=>$depts);
         return view('training.recommend')->with($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function addRecommentTraining(Request $request)
    {
        
        $data=request()->validate([
            'title'=>'required',
            'about'=>'required',
            'impact'=>'required',
            'trainer'=>'required'
        ]    
    );
    $id = Auth::user()->userId;
    // $attendees=json_encode($request->employees);
        if (is_null($request->employees)) {
             $attendees='[]';
         }else{
    $attendees=json_encode($request->employees);
    }
    
     //insert data
     $insert= RecommendTraining::create([
        'title'=>$data['title'],
        'message'=>$data['about'],
        'impact'=>$data['impact'],
        'trainer'=>$data['trainer'],
        'attendees'=>$attendees,
         'toAttend'=>$attendees,
        'employee_id'=>$id
    ]);

    if($insert){
        return redirect('/recommendTraining')->with('recordAdd','Training Request sent successfully');
    }else{
        return redirect('/recommendTraining')->with('recordFail','Failed to send trainining request');
    }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
         
        $data=request()->validate([
            'title'=>'required',
            'time'=>'required',
            'date'=>'required',
            'location'=>'required',
            'duration'=>'required',

            // 'receipient'=>'required',
            // 'company'=>'required',
            // 'department'=>'required',
        ]    
    );
        $trainingId=$request->input('id');
    $id = Auth::user()->userId;
   $userdata=DB::table('employees')
        ->select('companyId','departmentId')
        ->where('employees.userId','=',$id)
        ->first();
        
     //insert data
     $insert= TrainingRequest::findOrFail($trainingId)->update([
        //receipient
        'title'=>$data['title'],
        //company
        'time'=>$data['time'],
        'date'=>$data['date'],
        'toAttend'=>json_encode($id),
        'location'=>$data['location'],
        'duration'=>$data['duration'],
        'subject_company'=>$userdata->companyId,
        'subject_department'=>$userdata->departmentId,
        'subject'=>$id
    ]);

    if($insert){
        return redirect('/trainingsrequests')->with('recordAdd','Training Request updated successfully');
    }else{
        return redirect('/trainingsrequests')->with('recordFail','Failed to update trainining request');
    }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteRecommendedTraining($id)
    {
     
        $delete=RecommendTraining::where('id',$id)->where('status','pending')->delete();
          if($delete){
        return redirect('/recommendTraining')->with('recordAdd','Training Request successfully deleted');
    }else{
        return redirect('/recommendTraining')->with('recordFail','Failed to delete trainining request');
    }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editRecommendTraining(Request $request)
    {
            $data=request()->validate([
            'title'=>'required',
            'about'=>'required',
            'impact'=>'required',
            'trainer'=>'required'
        ]    
    );
    $id = Auth::user()->userId;
        if (is_null($request->employees)) {
             $attendees='[]';
         }else{
    $attendees=json_encode($request->employees);
    }
    
     //insert data
    $trainingId=$request->input('id');
        $insert= RecommendTraining::findOrFail($trainingId)->update([
        'title'=>$data['title'],
        'message'=>$data['about'],
        'impact'=>$data['impact'],
        'trainer'=>$data['trainer'],
         'toAttend'=>$attendees,
        'attendees'=>$attendees,
        'employee_id'=>$id
    ]);

    if($insert){
        return redirect('/recommendTraining')->with('recordAdd','Training Request edited successfully');
    }else{
        return redirect('/recommendTraining')->with('recordFail','Failed to edit trainining request');
    }
    }

    public function approverequest(Request $request,$id)
    {

        $data = TrainingRequest::find($id);
        $data->request_status = "Approved";
        $data->save();

        return redirect('/trainingsrequests')->with('recordAdd','Training call sent successfully');

        

        // Send a notification

        
    }

    public function confirmAttenance($id){
         $emp_id=Auth::user()->id;
         $select=DB::table('training_requests')->where('id',$id)->value('attendees');
         if (is_null($select)) {
             $encoded_id=json_encode(array($emp_id));
         }
         else{
            $old_Ids=json_decode($select);
            $old_Ids[]=$emp_id;
            $encoded_id=json_encode($old_Ids);
            // $encoded_id=json_encode(array_push($old_Ids, $emp_id));
         }

          $insert= TrainingRequest::findOrFail($id)->update([
            'attendees'=>$encoded_id
            ]);
          if ($insert) {
          return redirect('/trainingsrequests')->with('recordAdd','Training attedance confirmed successfully');
          }
          return redirect('/trainingsrequests')->with('recordFail','Training attedance confirmation failed!');
          
    }
    public function confirmNewTraining($id){
        
                $emp_id=Auth::user()->id;
         $select=DB::table('trainings')->where('id',$id)->value('attendees');

         if (is_null($select)) {
             $encoded_id=json_encode(array($emp_id));
         }
         else{
            $old_Ids=json_decode($select);
            $old_Ids[]=$emp_id;
            $encoded_id=json_encode($old_Ids);
         }

          $insert= DB::table('trainings')->where('id',$id)->update([
            'attendees'=>$encoded_id
            ]);
          if ($insert) {
        Alert::success('Success','Training attedance confirmed successfully');
        return back();
          }

        Alert::error('Error','Training attedance confirmation failed, Try again later');
        return back();
    }
}
