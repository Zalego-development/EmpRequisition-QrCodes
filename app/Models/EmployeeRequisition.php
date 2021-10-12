<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeRequisition extends Model
{
    use HasFactory;

    protected $fillable = ['jobtittle', 'jobdescription', 'positions' ,'employementtype','responsibilities','salary','salaryto','salarybudget','posskills', 'posrequirements','positiontype','intenting','pwd', 'jobcategory', 'location' ,'startdate' ,'interviews','manager'];

    protected $table = 'employeerequisitions';

}
