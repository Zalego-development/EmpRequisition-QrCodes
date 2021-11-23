<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{

 protected $fillable=['group_id','firstName','middleName','lastName',
                       'phone','email','location',];

 public function group(){
	return $this->belongsTo(Group::class);
}

public function gemailevent(){
    return $this->hasMany(GEmailEvent::class);
}


}
