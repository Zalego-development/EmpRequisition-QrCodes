<?php

use Illuminate\Support\Facades\Route;
//use App\Http\Controllers\LeadsController;
use App\Http\Controllers\NewSurveyController;
use App\Http\Controllers\MembersController;
use App\Http\Controllers\ApplicantsController;
use App\Http\Controllers\EmployeeRequisitionController;
use App\Http\Controllers\JobsControlller;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Auth::routes();



Route::get('/', function () {
    return view('auth.login');
});
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::group(['middleware'=>['web','auth']],function(){
    //Route::get('/home', 'HomeController@index')->name('home');
	// ->middleware('password.confirm');
     Route::get('/home', [App\Http\Controllers\HomeController::class,'index'])->name('crm');
});

//students crm
// Route::get('/student_leads','LeadsController@student_leads2');
// Route::get('/student_leads2','LeadsController@student_leads2')->name('render_leads');
// Route::get('/addLead/{leadId}','LeadsController@addLead');
// Route::get('/saveAppointment','LeadsController@saveAppointment');
// Route::get('/saveTasks','LeadsController@saveTasks');
// Route::get('/editTaskLead','LeadsController@editTaskLead');
// Route::get('/saveSms','LeadsController@saveSms');
// Route::get('/saveWhatsapp','LeadsController@saveWhatsapp');
// Route::post('/saveEmail','LeadsController@saveEmail');
// Route::post('/reassignDeal','LeadsController@reassignDeal');
// Route::get('/viewLead/{id}','LeadsController@viewLead2');
// Route::get('/viewLead2/{id}','LeadsController@viewLead2');
// Route::get('/completeTaskLead/{id}','LeadsController@completeTaskLead');
// Route::get('/uncompleteTaskLead/{id}','LeadsController@uncompleteTaskLead');
// Route::get('/deleteTaskLead/{id}','LeadsController@deleteTaskLead');
// Route::post('/completeDeal','LeadsController@completeDeal');
// Route::post('/failDeal','LeadsController@failDeal');
// Route::post('/logMeeting','LeadsController@logMeeting');
// Route::post('/logLeadProgress','LeadsController@logLeadProgress');
// Route::get('/markSuccess/{id}','LeadsController@markSuccess');
// Route::get('/updateMyLead','LeadsController@updateMyLead');
//students crm

	//new crm
	// Route::get('/crm',[LeadsController::class,'crm'])->name('crm2');
	// Route::get('/logs_leads',[LeadsController::class,'logs_leads']);
	// Route::get('/Lead_convert',[LeadsController::class,'Lead_convert']);
	// Route::get('/leads/{index}',[LeadsController::class,'leads']);
	// Route::get('/contacts',[LeadsController::class,'contacts']);
	// Route::get('/add_Lead',[LeadsController::class,'add_Lead']);
	// Route::post('/leadActions',[LeadsController::class,'leadActions']);
    
    // employees requisitision approvefromleadexec employeerequisitionsettingsemployeerequisitionsettingsstore employeerequisitions.destroyrequisitionsetting
	Route::resource('employeerequisitions', EmployeeRequisitionController::class)->middleware('auth');
	Route::get('/approve/{id}', [EmployeeRequisitionController::class, 'approve']);
	Route::get('/approve/{id}/{rec}', [EmployeeRequisitionController::class, 'approve1']);
	Route::get('/approvetoHR/{id}', [EmployeeRequisitionController::class, 'approvetoHR']);
	Route::get('/approvetoHR/{id}/{rec}', [EmployeeRequisitionController::class, 'approvetoHR1']);
	Route::get('/approvefromleadexec/{id}', [EmployeeRequisitionController::class, 'approvefromleadexec']);
	Route::get('/approvefromhr/{id}', [EmployeeRequisitionController::class, 'approvefromhr']);
	Route::get('/approvetoceo/{id}', [EmployeeRequisitionController::class, 'approvetoceo']);
	Route::get('/approvetoceo/{id}/{rec}', [EmployeeRequisitionController::class, 'approvetoceo1']);
	Route::get('/approvefromchief/{id}/{rec}', [EmployeeRequisitionController::class, 'approvefromchief1']);
	Route::get('/approvefromchief/{id}', [EmployeeRequisitionController::class, 'approvefromchief']);
	Route::get('/decline/{id}/', [EmployeeRequisitionController::class, 'decline']); 
	Route::get('/declinefromceoexecinitiator/{id}/', [EmployeeRequisitionController::class, 'declinefromceoexecinitiator']); 
	Route::get('/declinefromceohrinitiator/{id}/', [EmployeeRequisitionController::class, 'declinefromceohrinitiator']); 
    Route::get('/declinereason/{id}', [EmployeeRequisitionController::class, 'declinereason'])->middleware('auth');
     Route::get('/declinereasonfromceohrinitiator/{id}', [EmployeeRequisitionController::class, 'declinereasonfromceohrinitiator'])->middleware('auth');

	Route::POST('/declinefromexechrinitiator', [EmployeeRequisitionController::class, 'declinefromexechrinitiator']);
	Route::get('/declinefromexecrecruinitiator/{id}/', [EmployeeRequisitionController::class, 'declinefromexecrecruinitiator']);
	Route::POST('/declinefromceohrinitiator', [EmployeeRequisitionController::class, 'declinefromceohrinitiator']);

Route::get('/declinereasonfromhrrecinitiator/{id}', [EmployeeRequisitionController::class, 'declinereasonfromhrrecinitiator'])->middleware('auth');
Route::POST('/decline', [EmployeeRequisitionController::class, 'decline']); 
Route::POST('/declinefromhrrecinitiator', [EmployeeRequisitionController::class, 'declinefromhrrecinitiator']);

Route::get('/declinereasonfromexecrecinitiator/{id}', [EmployeeRequisitionController::class, 'declinereasonfromexecrecinitiator'])->middleware('auth');
Route::Post('/declinefromexecrecruinitiator', [EmployeeRequisitionController::class, 'declinefromexecrecruinitiator']); 

Route::get('/declinereasonfromceorecinitiator/{id}', [EmployeeRequisitionController::class, 'declinereasonfromceorecinitiator'])->middleware('auth');
Route::Post('/declinefromceorecruinitiator', [EmployeeRequisitionController::class, 'declinefromceorecruinitiator']); 

Route::get('/declinereasonrechiringinitiator/{id}', [EmployeeRequisitionController::class, 'declinereasonrechiringinitiator'])->middleware('auth');
Route::Post('/declinefromrechiringinitiator', [EmployeeRequisitionController::class, 'declinefromrechiringinitiator']); 
 
Route::get('/declinereasonfromhrempinitator/{id}', [EmployeeRequisitionController::class, 'declinereasonfromhrempinitator'])->middleware('auth');
Route::Post('/declinefromhrempinitator', [EmployeeRequisitionController::class, 'declinefromhrempinitator']); 
Route::get('/declinereasonfromhiringtorec/{id}', [EmployeeRequisitionController::class, 'declinereasonfromhiringtorec'])->middleware('auth');
Route::Post('/declinefromhiringrecinitiator', [EmployeeRequisitionController::class, 'declinefromhiringrecinitiator']); 

Route::get('/declinereasonfromexecempinitator/{id}', [EmployeeRequisitionController::class, 'declinereasonfromexecempinitator'])->middleware('auth');
Route::Post('/declinefroexecempinitator', [EmployeeRequisitionController::class, 'declinefroexecempinitator']); 

Route::get('/declinereasonfroceoempinitator/{id}', [EmployeeRequisitionController::class, 'declinereasonfroceoempinitator'])->middleware('auth');
Route::Post('/declinefroceoempinitator', [EmployeeRequisitionController::class, 'declinefroceoempinitator']); 

Route::get('/declinereasonhrtohiringrec/{id}', [EmployeeRequisitionController::class, 'declinereasonhrtohiringrec'])->middleware('auth');
Route::Post('/declinefromhrrecinitatortohiring', [EmployeeRequisitionController::class, 'declinefromhrrecinitatortohiring']); 

Route::get('/declinereasonfromexerectohiring/{id}', [EmployeeRequisitionController::class, 'declinereasonfromexerectohiring'])->middleware('auth');
Route::Post('/declinefromexecrecinitatortohiring', [EmployeeRequisitionController::class, 'declinefromexecrecinitatortohiring']);

Route::get('/declinereasonfromceorectohiring/{id}', [EmployeeRequisitionController::class, 'declinereasonfromceorectohiring'])->middleware('auth');
Route::Post('/declinefromceorecinitatortohiring', [EmployeeRequisitionController::class, 'declinefromceorecinitatortohiring']);

	Route::get('/returnforcorrections/{id}/{user}', [EmployeeRequisitionController::class, 'returnforcorrections'])->middleware('auth');

Route::get('/returnforcorrections/{id}', [EmployeeRequisitionController::class, 'returnforcorrections1']);

	Route::get('/returnforcorrectionstoleadexec/{id}/{user}', [EmployeeRequisitionController::class, 'returnforcorrectionstoleadexec'])->middleware('auth');
	Route::get('approvesmessage', [EmployeeRequisitionController::class, 'approvesmessage'])->name('employeerequisitions.approvesmessage');
    Route::POST('/dynamic_dependent/fetch', [EmployeeRequisitionController::class, 'fetch'])->name('dynamicdependent.fetch');
	Route::get('viewcomments/{id}', [EmployeeRequisitionController::class, 'viewcomments']);
	Route::POST('/commentsapprovalstore', [EmployeeRequisitionController::class, 'commentsapprovalstore']);
	Route::resource('jobs', JobsControlller::class);
	Route::get('employeerequisitionsettings', [EmployeeRequisitionController::class, 'employeerequisitionsettings'])->middleware('auth');
	Route::POST('/employeerequisitionsettingsstore', [EmployeeRequisitionController::class, 'employeerequisitionsettingsstore']);
	Route::POST('/employeerequisitionusersstore', [EmployeeRequisitionController::class, 'employeerequisitionusersstore']);
	Route::delete('destroyrequisitionsettings/{id}', [EmployeeRequisitionController::class, 'destroyrequisitionsetting'])->name('destroyrequisitionsetting');
	Route::delete('destroyrequisition/{id}', [EmployeeRequisitionController::class, 'destroy'])->name('employeerequisitions.destroy');
   Route::delete('destroyrequisitionusers/{id}', [EmployeeRequisitionController::class, 'destroyrequisitionusers'])->name('employeerequisitionsusers.destroy');
	Route::POST('/employeerequisitionsettingsupdate', [EmployeeRequisitionController::class, 'employeerequisitionsettingsupdate'])->name('employeerequisitionsettingsupdate');
	Route::get('calltoaction', [EmployeeRequisitionController::class, 'calltoaction'])->name('calltoaction')->middleware('auth');
	Route::get('viewapprovers', [EmployeeRequisitionController::class, 'calltoaction'])->name('viewapprovers');
	Route::get('calltoaction1', [EmployeeRequisitionController::class, 'calltoaction1'])->name('calltoaction1')->middleware('auth');
	Route::get('calltoaction2', [EmployeeRequisitionController::class, 'calltoaction2'])->name('calltoaction2')->middleware('auth');
	Route::get('calltoaction3', [EmployeeRequisitionController::class, 'calltoaction3'])->name('calltoaction3')->middleware('auth');
	Route::get('employeerequisitionusers', [EmployeeRequisitionController::class, 'employeerequisitionusers'])->middleware('auth');
	Route::get('/applicants',[ApplicantsController::class,'applicants']);
	Route::resource('applicants', ApplicantsController::class);
	Route::get('initiate/{id}', [EmployeeRequisitionController::class, 'initiate'])->name('employeerequisitions.initiate');
	Route::get('approvedrequisitions', [EmployeeRequisitionController::class, 'approvedrequisitions']);
    Route::get('declinedrequisitions', [EmployeeRequisitionController::class, 'declinedrequisitions']);
    Route::get('readytopost{id}', [EmployeeRequisitionController::class, 'readytopost']);
    Route::get('/groupceotoexec/{id}', [EmployeeRequisitionController::class, 'groupceotoexec']);
    Route::get('/hrapprovingtoexec/{id}', [EmployeeRequisitionController::class, 'hrapprovingtoexec']);
    Route::get('/hrapprovingtoexec/{id}/{rec}', [EmployeeRequisitionController::class, 'hrapprovingtoexec1']);
    Route::get('/execapprovingtoceorecruinitiator/{id}', [EmployeeRequisitionController::class, 'execapprovingtoceorecruinitiator']);
    Route::get('/execapprovingtoceorecruinitiator/{id}/{rec}', [EmployeeRequisitionController::class, 'execapprovingtoceorecruinitiator1']);
    Route::get('/approvefromchiefrecruinitiator/{id}', [EmployeeRequisitionController::class, 'approvefromchiefrecruinitiator']);
    Route::get('/approvefromchiefrecruinitiator/{id}/{rec}', [EmployeeRequisitionController::class, 'approvefromchiefrecruinitiator1']);
    Route::get('/execapprovinghrinitiator/{id}/', [EmployeeRequisitionController::class, 'execapprovinghrinitiator']);
      Route::get('/execapprovinghrinitiator/{id}/{rec}', [EmployeeRequisitionController::class, 'execapprovinghrinitiator1']);
     Route::get('/approvefromchiefhrinitiator/{id}', [EmployeeRequisitionController::class, 'approvefromchiefhrinitiator']);
     Route::get('/approvefromchiefhrinitiator/{id}/{rec}', [EmployeeRequisitionController::class, 'approvefromchiefhrinitiator1']);
     Route::get('calltoactionceoexecinitiator', [EmployeeRequisitionController::class, 'calltoactionceoexecinitiator'])->name('calltoactionceoexecinitiator');
     Route::get('calltoactionexechrinitiator', [EmployeeRequisitionController::class, 'calltoactionexechrinitiator'])->name('calltoactionexechrinitiator')->middleware('auth');
     Route::get('calltoactionceochrinitiator', [EmployeeRequisitionController::class, 'calltoactionceochrinitiator'])->name('calltoactionceochrinitiator')->middleware('auth');
      Route::get('calltoactionhrrecrurinitiator', [EmployeeRequisitionController::class, 'calltoactionhrrecrurinitiator'])->name('calltoactionhrrecrurinitiator')->middleware('auth');

      Route::get('calltoactionexecrecrurinitiator', [EmployeeRequisitionController::class, 'calltoactionexecrecrurinitiator'])->name('calltoactionexecrecrurinitiator')->middleware('auth'); 
      Route::get('calltoactionceorecruinitiator', [EmployeeRequisitionController::class, 'calltoactionceorecruinitiator'])->name('calltoactionceorecruinitiator')->middleware('auth'); 
      	Route::get('employeerequest', [EmployeeRequisitionController::class, 'tabspage'])->name('tabspage')->middleware('auth');
      	 Route::get('/hiringapprovingtohr/{id}', [EmployeeRequisitionController::class, 'hiringapprovingtohr']); 
      	 Route::get('/hiringapprovingtohr/{id}/{rec}', [EmployeeRequisitionController::class, 'hiringapprovingtohr1']); 
      	 Route::get('/hrapprovingtoexerectohiring/{id}', [EmployeeRequisitionController::class, 'hrapprovingtoexerectohiring']);
      	 Route::get('/hrapprovingtoexerectohiring/{id}/{user}', [EmployeeRequisitionController::class, 'hrapprovingtoexerectohiring1']);
      	Route::get('/execapprovingtoexerectohiring/{id}', [EmployeeRequisitionController::class, 'execapprovingtoexerectohiring']);
      	Route::get('/execapprovingtoexerectohiring/{id}/{rec}', [EmployeeRequisitionController::class, 'execapprovingtoexerectohiring1']);
      Route::get('/ceoapprovingtoexerectohiring/{id}', [EmployeeRequisitionController::class, 'ceoapprovingtoexerectohiring']);  
      Route::get('/ceoapprovingtoexerectohiring/{id}/{rec}', [EmployeeRequisitionController::class, 'ceoapprovingtoexerectohiring1']);  
      	 
	//You ned 

	// Route::get('/filterLeads','LeadsController@filterLeads');
	// Route::get('agentReports',[LeadsController::class,'agentReports']);
	// Route::get('filterbydate',[LeadsController::class,'filterbydate']);
	// Route::get('ip_details',[LeadsController::class,'ip_details']);
	
	

	// Route::get('/text','LeadsController@text');

	// //offline crm upload
	// Route::post('/uploadOffline','LeadsController@uploadOffline');

	// //Route::get('/GetLogs','LeadsController@GetLogs');
	// Route::get('/GetLogs',[LeadsController::class,'GetLogs'])->name('crm2');
	// //Route::post('/Addlog',[LeadsController::class,'Addlog']);
 //    Route::get('logs', 'LeadsController@logs');
	// //agent taken a break
	// Route::post('takeBreak',[LeadsController::class,'takeBreak']);
	// Route::get('callagentBreak',[LeadsController::class,'callagentBreak']);
	// Route::get('subscribe',[LeadsController::class,'subscribe']);
	// Route::get('getLocation',[LeadsController::class,'getLocation']);
	// Route::get('viewAgentlocation',[LeadsController::class,'viewAgentlocation']);
	// Route::get('callLogs',[LeadsController::class,'callLogs']);
	// Route::get('callReports',[LeadsController::class,'callReports']);
	// Route::get('callDashboard',[LeadsController::class,'callDashboard']);
	// Route::get('makecall',[LeadsController::class,'makecall']);

	//survey 
// 	Route::get('/existingSurvey',[NewSurveyController::class,'existingSurvey']);
// 	Route::get('/newsurvey',[NewSurveyController::class,'index']);

//     Route::post('/addSurvey',[NewSurveyController::class,'addSurvey']);
//     Route::get('/viewSurvey/{id}',[NewSurveyController::class,'viewSurvey']);
//     Route::get('/editSurvey/{id}',[NewSurveyController::class,'editSurvey']);
// 	Route::post('/email/publish',[NewSurveyController::class,'publishSurvey']);
// 	Route::post('/email/publishtoclient',[NewSurveyController::class,'publishSurvey1']);
	



// 	//members
// Route::get('/members',[MembersController::class,'index']);
// Route::post('/sortGroup',[MembersController::class,'sortGroup']);
// Route::get('/sortEmail',[MembersController::class,'sortEmail']);
// Route::patch('/members/{user}',[MembersController::class,'update']);
// Route::post('/members/addClient',[MembersController::class,'addClient']);
	
	
	
	
	
	
	
	