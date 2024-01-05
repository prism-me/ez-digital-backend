<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\UserContactUsMail;
use App\User;
use Mail;
use App\Mail\UserContactUsMail as UserMail;

class NotifyUserContactUsCreated{


    
    public function __construct()
    {
        //
    }

  
    public function handle(UserContactUsMail $userData)
    {

        
        $email = $userData->userData['email'];
        Mail::to($email)->send(new UserMail($userData->userData)); 
    }

}