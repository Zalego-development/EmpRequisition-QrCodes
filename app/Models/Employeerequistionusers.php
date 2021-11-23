<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employeerequistionusers extends Model
{
    use HasFactory;
         protected $fillable = ['employeetype', 'userId' ,'company_id'];
     protected $table = 'employeerequisitionusers';
}
