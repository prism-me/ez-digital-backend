<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\UserListYourPropertyMail;
use Mail;
use App\Mail\UserListYourPropertyMail as UserMail;

class NotifyUserListYourPropertyCreated{

    public function handle(UserListYourPropertyMail $userData)
    {
       
        
        $email = $userData->userData['email'];
        Mail::to($email)->send(new UserMail($userData->userData)); 
    }

}