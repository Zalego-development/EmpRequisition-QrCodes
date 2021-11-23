<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GEmailEvent extends Model
{
    //

    protected $table='g_email_events';
   
    protected $fillable=[
        'email_id',
        'client_id',
        'game',
        'status',
    ];

    public function email(){
        return $this->belongsTo(EmailEvent::class);
    }
    
    public function client(){
        return $this->belongsTo(Client::class);
    }
}
