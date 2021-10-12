<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use DB;

class UserLoggedIn
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    use SerializesModels;
    public $userId;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($userId)
    {
        //
        $this->userId = $userId;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
    
    public function handle(UserLoggedIn $event)
    {
        $user = User::find($event->userId); // find the user associated with this event
        $user->updated_time = new DateTime;
        //$user->last_login_ip = $this->request->getClientIp();
        $user->save();
        $insert=DB::insert('INSERT INTO history_log(email_address,action) VALUES(?,?)',['pqatr','has loged in']);
    }

   
}
