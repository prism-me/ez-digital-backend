<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Model\User;

class UserListYourPropertyMail {

    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $userData;

  
    public function __construct($userData)
    {
        $this->userData = $userData;   
    }

}