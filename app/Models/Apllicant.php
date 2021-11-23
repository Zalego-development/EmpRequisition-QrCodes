<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apllicant extends Model
{

    use HasFactory;
    protected $fillable=['id','fname','lname', 'surname','gender' ,'email', 'action'];
}
