<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ActivityLog;

class ActivityController extends Controller
{
  
    public static function activity($user,$activity){
        ActivityLog::create([
             'employee_id'=>$user,
             'activity'=>$activity,
        ]);
    }
}
