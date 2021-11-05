<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QrCodeEmp extends Model
{
    use HasFactory;

       protected $fillable = ['Title', 'Department', 'fname' ,'lname','email','phone','url'];

    protected $table = 'qrcodes';
}
