<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\User;
use Auth;
use DB;

class ProfileController extends Controller
{

public function __construct(){
    $this->middleware('auth');
}    


public function profile(){
 $id=Auth::user()->userId;
   
        $user=Auth::user();
        $data=array('user'=>$user);
    
    return view('profile.index')->with($data);
}



public function update(Request $request){
    
    $userID=Auth::user()->id;
    $data=request()->validate([
         'name'=>['required','string','min:2'],
         'email'=>['required','email','max:50','unique:users,email,'.$userID],
         'contact'=>['required','string','min:10','max:12','unique:users,contact,'.$userID]
    ]);
    
    $update=User::findOrFail($userID)->update($data);
    
       $activity="Updated profile";
       ActivityController::activity($userID,$activity);
    if($update){
       
       Alert::success('Success','Profile successfully updated');
       return redirect('/profile');
    }else{
       
        Alert::error('Error','Sorry something went wrong');
        return redirect('/profile');
    }

}



public function changePassword(Request $request){

    $validatedData = $request->validate([
	    'oldpass' => 'required|min:6',
	    'password' => 'required|string|min:6',
	    'password_confirmation' => 'required|same:password',
	],[
	    'oldpass.required' => 'Old password is required',
	    'oldpass.min' => 'Old password needs to have at least 6 characters',
	    'password.required' => 'Password is required',
	    'password.min' => 'Password needs to have at least 6 characters',
	    'password_confirmation.required' => 'Password confirmation did not match.'
	]);

	$current_password = \Auth::User()->password;           
	if(\Hash::check($request->input('oldpass'), $current_password))
	{          
	  $user_id = \Auth::User()->id;                       
	  $obj_user = User::find($user_id);
	  $obj_user->password = \Hash::make($request->input('password'));
	  $obj_user->save(); 
      
      $activity="Changed password";
      ActivityController::activity($user_id,$activity);
      Alert::success('Success','Password successfully changed');  
	 return redirect('/profile');  
	}
	else{           
	  return redirect('/profile')->with('reject','Incorrect old Password.');  
	} 
   

}


public function updateProfilePicture(){

  $data=request()->validate(['picture'=>['required','image','mimes:jpeg,png,jpg,gif,svg','max:2048']]);


$userID=Auth::user()->id;
$url=request('picture')->store('users','public');
$newURL="http://hrm.zalegoinstitute.ac.ke/zalegosurvey/public/storage/".$url;

$update=User::findOrFail($userID)
        ->update([
             'image'=>$newURL,
        ]);

if($update){

  $activity="Updated profile picture";
  ActivityController::activity($userID,$activity);
  Alert::success('Success','Profile picture successfully updated');
  return redirect('/profile');

}else{

  Alert::error('Error','Sorry something went wrong');
  return redirect('/profile');
}

}





















}
