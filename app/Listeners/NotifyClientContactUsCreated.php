<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\ClientContactUsMail;
use App\User;
use Mail;
use App\Mail\ClientContactUsMail as ClientMail;

class NotifyClientContactUsCreated{


    
    public function __construct()
    {
        //
    }

  
    public function handle(ClientContactUsMail $userData)
    {

        $email = $userData->userData['client_email'];
        Mail::to($email)->send(new ClientMail($userData->userData)); 
    }

}