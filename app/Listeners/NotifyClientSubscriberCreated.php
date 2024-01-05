<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\ClientSubscriberMail;
use App\User;
use Mail;
use App\Mail\ClientSubscriberMail as ClientMail;

class NotifyClientSubscriberCreated{


  
    public function handle(ClientSubscriberMail $userData)
    {
        $email = $userData->userData['client_email'];
        Mail::to($email)->send(new ClientMail($userData->userData)); 

    }

}