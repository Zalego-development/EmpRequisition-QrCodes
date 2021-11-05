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
        ->generate($user->contact. '' . $user->corporateEmail.''.$user->firstname.''.$user->lastname.''.$user->departmentId.''.$user->designationId);
    }
        
      return view('employees', compact('users'));
    }





    public function generate ($id)
    { 
        //check user if alreadyu generated with a code 
        $checkuser=DB::table('employees')
                  ->where('id', $id)
                  ->first();
  if ($checkuser->qrcode =='Yes') {
     Alert::success('Success',' Staff QR Code Already generated successfully');
     return back();
  }
     $user=DB::table('employees')
                    ->where('id', $id)
                   ->first();  
    //get company id of the user
    $usercompany_id=$user->companyId;
    $geturl=DB::table('companies')
           ->where('id', $usercompany_id)
           ->first();
$qrcode = QrCode::size(300)
        ->format('png')
        ->generate($user->corporateEmail. '/n' . $user->contact.''.$user->firstname.''.$user->lastname.''.$user->departmentId.''.$user->designationId.''.$geturl->website, public_path("images/staffidqrcode/".$user->firstname.''.$user->lastname.".png") );
Alert::success('Success',' Staff QR Code Generated successfully');
$user->qrcode = QrCode::size(300)
        ->generate($user->contact. '/n' . $user->corporateEmail.''.$user->firstname.''.$user->lastname.''.$user->departmentId.''.$user->designationId.''.$geturl->website);
            $storeqrcode=DB::table('qrcodes')
                          ->insert([
                          'userId' => $id,
                          'code' =>$user->firstname.''.$user->lastname.".png" ,
                                 ]);

     $updateqrcodegenerated=DB::table('employees')
                           ->where('id',$id)
                           ->update(['qrcode' => "Yes"]);

 return view('qrCode', compact('user','geturl'));  

     
    }


// exporting qr codes for each company 
     public function export(Request $request)
    {

if ($request->company =='All') {
            $exportqrs=DB::table('employees')
                 ->join('qrcodes', 'qrcodes.userId', '=', 'employees.id')
                  ->where('employees.qrcode', 'Yes')
                  ->get();

        if (count($exportqrs) <=0 ) {
         Alert::success('Success','No Staff QR Code was generated successfully');
     return back();
          }  
        $images = array();
        foreach ($exportqrs as $user) {
            $filepath = public_path('images/staffidqrcode/').$user->code;
            array_push($images, $filepath);
        }

 $number = mt_rand(1000000000, 9999999999);
    Madzipper::make('public/Stepers'.$number.'.zip')->add($images)->close();
    return Response::download('public/Stepers'.$number.'.zip');
}
$companyname=DB::table('companies')
            ->where('id',$request->company)
             ->first();

        $exportqrs=DB::table('employees')
                 ->join('qrcodes', 'qrcodes.userId', '=', 'employees.id')
                  ->where('companyId', $request->company)
                  ->where('employees.qrcode', 'Yes')
                  ->get();

        if (count($exportqrs) <=0 ) {
         Alert::success('Success','No Staff QR Code From'.' '.$companyname->company.' '.'Company was generated successfully');
     return back();
          }  
        $images = array();
        foreach ($exportqrs as $user) {
            $filepath = public_path('images/staffidqrcode/').$user->code;
            array_push($images, $filepath);
        }

 $number = mt_rand(1000000000, 9999999999);
    Madzipper::make('public/'.$companyname->company.''.$number.'.zip')->add($images)->close();
    return Response::download('public/'.$companyname->company.''.$number.'.zip');
        
    }

    // exporting qr codes for each depatments 

     public function exportdepartments(Request $request)
    {

if ($request->department =='All') {
            $exportqrs=DB::table('employees')
                 ->join('qrcodes', 'qrcodes.userId', '=', 'employees.id')
                  ->where('employees.qrcode', 'Yes')
                  ->get();

        if (count($exportqrs) <=0 ) {
         Alert::success('Success','No Staff QR Code was generated successfully');
         return back();
          }  
        $images = array();
        foreach ($exportqrs as $user) {
            $filepath = public_path('images/staffidqrcode/').$user->code;
            array_push($images, $filepath);
        }

 $number = mt_rand(1000000000, 9999999999);
    Madzipper::make('public/Stepers'.$number.'.zip')->add($images)->close();
    return Response::download('public/Stepers'.$number.'.zip');
}

$departmentname=DB::table('departments')
            ->where('id',$request->department)
             ->first();

        $exportqrs=DB::table('employees')
                 ->join('qrcodes', 'qrcodes.userId', '=', 'employees.id')
                  ->where('departmentId', $request->department)
                  ->where('employees.qrcode', 'Yes')
                  ->get();

        if (count($exportqrs) <=0 ) {
         Alert::success('Success','No Staff QR Code From'.' '.$departmentname->department.' '.'Department was generated successfully');
         return back();
          }  
        $images = array();
        foreach ($exportqrs as $user) {
            $filepath = public_path('images/staffidqrcode/').$user->code;
            array_push($images, $filepath);
        }

 $number = mt_rand(1000000000, 9999999999);
    Madzipper::make('public/'.$departmentname->department.''.$number.'.zip')->add($images)->close();
    return Response::download('public/'.$departmentname->department.''.$number.'.zip');
        
    }


// exporting qr code for each user

     public function exportdownload($id)
    {      

        $userimage=DB::table('qrcodes')
                  ->where('userId',$id)
                  ->first();
     //    if (count($userimage)<=0 ) {
     //              Alert::success('Success','Please Generate Qr Code For the staff First');
     // return back();
     //    }
       $filepath = public_path('images/staffidqrcode/').$userimage->code;
        return Response::download($filepath);
    }



    public function fetch(Request $request)
    {
     $select = $request->get('select');
     $value = $request->get('value');
     $dependent = $request->get('dependent');

     $data = DB::table('employees')
       ->where('company_id', $value)
       ->get();

     $output = '<option disabled>Select user</option>';

     foreach($data as $row)
     {
      $output .= '<option value="'.$row->id.'">'.$row->name.'</option>';
     }

     return  response()->json(compact('output'));
    }


}
