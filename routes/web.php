<?php

use Illuminate\Support\Facades\Route;
//use App\Http\Controllers\LeadsController;
use App\Http\Controllers\QrCodeController;
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
 
      	 
	//developing qr code system
	//developing qr code system
      Route::get('/generate-qrcode', [QrCodeController::class, 'index'])->name('generate-qrcode');
      Route::get('/generatevisitor', [QrCodeController::class, 'visitor'])->name('visitor');
       Route::get('/generate{userId}', [QrCodeController::class, 'generate'])->name('generate');
        Route::post('/export', [QrCodeController::class, 'export'])->name('export');
         Route::post('/exportdepartments', [QrCodeController::class, 'exportdepartments'])->name('exportdepartments');
        Route::get('/exportdownload{userId}', [QrCodeController::class, 'exportdownload'])->name('exportdownload');
        Route::get('/employeesqrcodes', [QrCodeController::class, 'employees'])->name('employeesqrcodes');
         Route::POST('/dynamic_dependent/fetch', [QrCodeController::class, 'fetch2'])->name('dynamicdependent.fetch2');



	
	
	
	
	
	
	
	