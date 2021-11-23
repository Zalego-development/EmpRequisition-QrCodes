<?php

namespace App\Http\Controllers;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Http\Request;
use DB;
use App\Models\QrCodeEmp;
use Response;
use RealRashid\SweetAlert\Facades\Alert;
use Madnest\Madzipper\Facades\Madzipper;
use Illuminate\Support\Facades\Storage;
class QrCodeController extends Controller
{
   public function index()
    {
   $users=DB::table('employees')
              ->get();
    $qrcode= null;

      return view('qrCode', compact('qrcode'));
    }



     public function employees()
    {
      $users=DB::table('employees')
            ->get();            
    foreach($users  as $user){
        $user->qrcode = QrCode::size(100)
        ->generate($user->contact. '' . $user->email.''.$user->firstname.''.$user->lastname.''.$user->departmentId.''.$user->designationId);
    }
        
      return view('employees', compact('users'));
    }

public function visitor(){
    $qrcode = QrCode::size(300)
        ->format('png')
         ->merge('/public/logos/StepWise.jpg', .5)
         ->errorCorrection('H')
        ->generate('url:'.'https://www.stepwise.net/', public_path("images/staffidqrcode/StepWiseVisitor.png") );
        Alert::success('Success',' Staff QR Code Generated successfully');
 return back();   
      }



    public function generate ($userId)
    { 

     $user=DB::table('employees')
                    ->where('userId', $userId)
                   ->first(); 
                   
    //get company id of the user
    $usercompany_id=$user->companyId;
    $geturl=DB::table('companies')
           ->where('id', $usercompany_id)
           ->first();
    $title=DB::table('titles')
          ->where('id', $user->designationId)
          ->first();
   $departmentId=DB::table('departments')
          ->where('id', $user->departmentId)
          ->first();
//get company name 
$companyname=$geturl->company;
  $qrcode = QrCode::size(300)
        ->format('png')
         ->merge('/public/logos/'.$companyname.'.jpg', .5)
         ->errorCorrection('H')
        ->generate('mailto:'.$user->email. ',tel:' . $user->contact.','.$user->firstname.','.$user->lastname.','.$departmentId->department.','.$title->title.','.$geturl->website, public_path("images/staffidqrcode/".$user->firstname.''.$user->lastname.".png") ); 

        //check user if alreadyu generated with a code 
        $checkuser=DB::table('employees')
                  ->where('id', $userId)
                  ->first();
  if ($checkuser->qrcode =='Yes') {
    $updateqr=DB::table('qrcodes')
            ->where('userId',$userId)
            ->update(['userId' => $userId, 'code' => $user->firstname.''.$user->lastname.".png"]);
     Alert::success('Success',' Staff QR Code  generated successfully');

     return back();
  }

            $storeqrcode=DB::table('qrcodes')
                          ->insert([
                          'userId' => $userId,
                          'code' =>$user->firstname.''.$user->lastname.".png" ,
                                 ]);

     $updateqrcodegenerated=DB::table('employees')
                           ->where('id',$userId)
                           ->update(['qrcode' => "Yes"]);
Alert::success('Success',' Staff QR Code Generated successfully');
 return back();  

     
    }


// exporting qr codes for each company 
     public function export(Request $request)
    {
$date = date('Ymd His');
if ($request->company =='All') {
            $exportqrs=DB::table('employees')
                 ->join('qrcodes', 'qrcodes.userId', '=', 'employees.id')
                  ->where('employees.qrcode', 'Yes')
                  ->get();

        if (count($exportqrs) <=0 ) {
         Alert::success('Warning','No Staff QR Code was generated successfully');
     return back();
          }  
        $images = array();
        foreach ($exportqrs as $user) {
            $filepath = public_path('images/staffidqrcode/').$user->code;
            array_push($images, $filepath);
        }

    Madzipper::make('public/Stepers'.$date.'.zip')->add($images)->close();
    return Response::download('public/Steppers.Staff_QR_Codes'.$date.'.zip');
}
$companyname=DB::table('companies')
            ->where('id',$request->company)
             ->first();

        $exportqrs=DB::table('employees')
                 ->join('qrcodes', 'qrcodes.userId', '=', 'employees.userId')
                  ->where('companyId', $request->company)
                  ->where('employees.qrcode', 'Yes')
                  ->get();

        if (count($exportqrs) <=0 ) {
         Alert::success('Warning','No Staff QR Code From'.' _'.$companyname->company.' '.'Company was generated successfully');
     return back();
          }  
        $images = array();
        foreach ($exportqrs as $user) {
            $filepath = public_path('images/staffidqrcode/').$user->code;
            array_push($images, $filepath);
        }
    Madzipper::make('public/'.$companyname->company.'staff QR Codes'.$date.'.zip')->add($images)->close();
    return Response::download('public/'.$companyname->company.'staff QR Codes'.$date.'.zip');
        
    }

    // exporting qr codes for each depatments 

     public function exportdepartments(Request $request)
    {

$companyname=DB::table('companies')
            ->where('id',$request->department)
             ->first();
        $date = date('Ymd His');
if ($request->department =='All') {
            $exportqrs=DB::table('employees')
                 ->join('qrcodes', 'qrcodes.userId', '=', 'employees.userId')
                  ->where('employees.qrcode', 'Yes')
                  ->get();

        if (count($exportqrs) <=0 ) {
         Alert::success('Failed','No Staff QR Code was generated successfully');
         return back();
          }  
        $images = array();
        foreach ($exportqrs as $user) {
            $filepath = public_path('images/staffidqrcode/').$user->code;
            array_push($images, $filepath);
        }
    Madzipper::make('public/Stepers'.$date.'.zip')->add($images)->close();
    return Response::download('public/Stepers'.$date.'.zip');
}

$departmentname=DB::table('departments')
            ->where('id',$request->userId)
             ->first();

        $exportqrs=DB::table('employees')
                 ->join('qrcodes', 'qrcodes.userId', '=', 'employees.userId')
                  ->where('departmentId', $request->userId)
                  ->where('companyId',$request->department )
                  ->where('employees.qrcode', 'Yes')
                  ->get();

        if (count($exportqrs) <=0 ) {
         Alert::success('Warning','No Staff QR Code From'.' '.$departmentname->department.' '.'Department was generated successfully');
         return back();
          }  
        $images = array();
        foreach ($exportqrs as $user) {
            $filepath = public_path('images/staffidqrcode/').$user->code;
            array_push($images, $filepath);
        }
        
    Madzipper::make('public/'.$companyname->company.'_'.$departmentname->department.'staff QR Codes'.$date.'.zip')->add($images)->close();
    return Response::download('public/'.$companyname->company.'_'.$departmentname->department.'staff QR Codes'.$date.'.zip');
        
    }


// exporting qr code for each user

     public function exportdownload($userId)
    {      

        $userimage=DB::table('qrcodes')
                  ->where('userId',$userId)
                  ->first();
       $filepath = public_path('images/staffidqrcode/').$userimage->code;
        return Response::download($filepath);
    }



    public function fetch2(Request $request)
    {
     $select = $request->get('select');
     $value = $request->get('value');
     $dependent = $request->get('dependent');

     $data =DB::table('departments')
          ->where('companyId', $value)
           ->get();

     $output = '<option disabled>Select Departments</option>';

     foreach($data as $row)
     {
      $output .= '<option value="'.$row->id.'">'.$row->department.'</option>';
     }

     return  response()->json(compact('output'));
    }


}
