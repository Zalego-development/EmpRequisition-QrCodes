<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\InternalApplicantEducation;
use App\InternalApplicantExperience;
use App\InternalApplicantReference;
use App\InternalApplicantDocuments;
use Auth;

class DetailsController extends Controller
{


public function index(){
     $user=Auth::user();
	return view('details.index',compact('user'));
}




public function addEducation(){
	$data=request()->validate([
		'start_at'=>['required','string'],
		'end_at'=>['required','string'],
		'school'=>['required','string'],
		'course'=>['required','string'],
		'grade'=>['required','string'],
		'description'=>['required','string'],
	]);
	$save=InternalApplicantEducation::create([
		'employee_id'=>Auth::user()->id,
		'start_at'=>$data['start_at'],
		'end_at'=>$data['end_at'],
		'school'=>$data['school'],
		'course'=>$data['course'],
		'grade'=>$data['grade'],
		'description'=>$data['description'],
	]);

	if($save){
		return redirect('/myDetails')->with('response','Education details successfully added');
	}else{
		return redirect('/myDetails')->with('reject','Sorry, something went wrong');
	}
}




public function updateEducation(){
	$data=request()->validate([
		'start_at'=>['required','string'],
		'end_at'=>['required','string'],
		'school'=>['required','string'],
		'course'=>['required','string'],
		'grade'=>['required','string'],
		'description'=>['required','string'],
		'id'=>['required'],
	]);
	$save=InternalApplicantEducation::findOrFail($data['id'])->update([
		'start_at'=>$data['start_at'],
		'end_at'=>$data['end_at'],
		'school'=>$data['school'],
		'course'=>$data['course'],
		'grade'=>$data['grade'],
		'description'=>$data['description'],
	]);

	if($save){
		return redirect('/myDetails')->with('response','Education details successfully updated');
	}else{
		return redirect('/myDetails')->with('reject','Sorry, something went wrong');
	}
}



public function deleteEducation($education){

	$delete=InternalApplicantEducation::findOrFail($education)->delete();

	if($delete){
		return redirect('/myDetails')->with('response','Education details successfully deleted');
	}else{
		return redirect('/myDetails')->with('reject','Sorry, something went wrong');
	}
}



public function addWorkExperience(){
	$data=request()->validate([
		'start_at'=>['required','string'],
		'end_at'=>['required','string'],
		'company'=>['required','string'],
		'role'=>['required','string'],
		'description'=>['required','string'],
	]);
	$save=InternalApplicantExperience::create([
		'employee_id'=>Auth::user()->id,
		'start_at'=>$data['start_at'],
		'end_at'=>$data['end_at'],
		'company'=>$data['company'],
		'role'=>$data['role'],
		'description'=>$data['description'],
	]);

	if($save){
		return redirect('/myDetails')->with('response','Work details successfully added');
	}else{
		return redirect('/myDetails')->with('reject','Sorry, something went wrong');
	}
}




public function updateWorkExperience(){
	$data=request()->validate([
		'start_at'=>['required','string'],
		'end_at'=>['required','string'],
		'company'=>['required','string'],
		'role'=>['required','string'],
		'description'=>['required','string'],
		'id'=>['required'],
	]);
	$save=InternalApplicantExperience::findOrFail($data['id'])->update([
		'start_at'=>$data['start_at'],
		'end_at'=>$data['end_at'],
		'company'=>$data['company'],
		'role'=>$data['role'],
		'description'=>$data['description'],
	]);

	if($save){
		return redirect('/myDetails')->with('response','Work details successfully updated');
	}else{
		return redirect('/myDetails')->with('reject','Sorry, something went wrong');
	}
}


public function deleteExperience($experience){

	$delete=InternalApplicantExperience::findOrFail($experience)->delete();

	if($delete){
		return redirect('/myDetails')->with('response','Work details successfully deleted');
	}else{
		return redirect('/myDetails')->with('reject','Sorry, something went wrong');
	}
}



public function addReference(){
	$data=request()->validate([
		'name'=>['required','string'],
		'organisation'=>['required','string'],
		'phone'=>['required','string'],
	]);
	$save=InternalApplicantReference::create([
		'employee_id'=>Auth::user()->id,
		'name'=>$data['name'],
		'organisation'=>$data['organisation'],
		'phone'=>$data['phone'],
	]);

	if($save){
		return redirect('/myDetails')->with('response','Reference details successfully added');
	}else{
		return redirect('/myDetails')->with('reject','Sorry, something went wrong');
	}
}




public function updateReference(){
	$data=request()->validate([
		'name'=>['required','string'],
		'organisation'=>['required','string'],
		'phone'=>['required','string'],
		'id'=>['required'],
	]);
	$save=InternalApplicantReference::findOrFail($data['id'])->update([
		'name'=>$data['name'],
		'organisation'=>$data['organisation'],
		'phone'=>$data['phone'],
	]);

	if($save){
		return redirect('/myDetails')->with('response','Reference details successfully updated');
	}else{
		return redirect('/myDetails')->with('reject','Sorry, something went wrong');
	}
}



public function deleteReference($reference){

	$delete=InternalApplicantReference::findOrFail($reference)->delete();

	if($delete){
		return redirect('/myDetails')->with('response','Reference details successfully deleted');
	}else{
		return redirect('/myDetails')->with('reject','Sorry, something went wrong');
	}
}




public function addDocument(){
	$data=request()->validate([
		'name'=>['required','string'],
		'document'=>['required','mimes:pdf','max:10000'],
	]);

    $url=request('document')->store('documents','public');
	$save=InternalApplicantDocuments::create([
		'employee_id'=>Auth::user()->id,
		'name'=>$data['name'],
		'url'=>$url,
	]);

	if($save){
		return redirect('/myDetails')->with('response','Document successfully added');
	}else{
		return redirect('/myDetails')->with('reject','Sorry, something went wrong');
	}
}



public function updateDocument(){
$data=request()->validate([
	'name'=>['required','string'],
	'document'=>['mimes:pdf','max:10000'],
	'id'=>['required'],
]);


if(request()->hasFile('document')){

$url=request('document')->store('documents','public');

$update=InternalApplicantDocuments::where('id',$data['id'])
             ->update([
             	'name'=>$data['name'],
             	'url'=>$url,
             ]);
if($update){

 return redirect('/myDetails')->with('response','Document successfully updated');
}else{
 return redirect('/myDetails')->with('reject','Sorry, Something went wrong');
}



}else{

$update=InternalApplicantDocuments::where('id',$data['id'])
             ->update([
             	'name'=>$data['name'],
             ]);
if($update){

return redirect('/myDetails')->with('response','Document successfully updated');
}else{

 return redirect('/myDetails')->with('reject','Sorry, Something went wrong');
}
}
}





public function deleteDocument($document){

	$delete=InternalApplicantDocuments::findOrFail($document)->delete();

	if($delete){
		return redirect('/myDetails')->with('response','Document successfully deleted');
	}else{
		return redirect('/myDetails')->with('reject','Sorry, something went wrong');
	}
}



























}
