<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\RegisterMail;
use Mail;
use App\Mail\RegisterVerifyMail as Verify;

class NotifyRegisterCreated
{
 
    public function __construct()
    {

    }
  
    public function handle(RegisterMail $userData)
    {

        $email = $userData->userData['email'];
        Mail::to($email)->send(new Verify($userData->userData));
    }
}
