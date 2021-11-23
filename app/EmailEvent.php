<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmailEvent extends Model
{
    //
    protected $table='email_events';
  
    protected $fillable=[
       'subject',
        'message',
        'total',
        'group',
    ];

    //
    public function gemailevent(){
        return $this->hasMany(GEmailEvent::class);
    }

    //
    public function attachment(){
        return $this->hasMany(Attachment::class);
    }
}
