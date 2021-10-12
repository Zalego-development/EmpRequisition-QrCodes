<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobApproval extends Model
{
    use HasFactory;
    protected $fillable=['comment','userId','jobid'];
}
