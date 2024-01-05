<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\UserSubscriberMail;
use App\User;
use Mail;
use App\Mail\UserSubscriberMail as UserMail;

class NotifyUserSubscriberCreated{


    
    public function __construct()
    {
        //
    }

  
    public function handle(UserSubscriberMail $userData)
    {

        
        $email = $userData->userData['email'];
        Mail::to($email)->send(new UserMail($userData->userData)); 
    }

}