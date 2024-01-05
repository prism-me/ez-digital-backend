<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\ClientListYourPropertyMail;
use Mail;
use App\Mail\ClientListYourPropertyMail as ClientMail;

class NotifyClientListYourPropertyCreated{


    

  
    public function handle(ClientListYourPropertyMail $userData)
    {
       
        
        $email = $userData->userData['client_email'];
        Mail::to($email)->send(new ClientMail($userData->userData)); 
    }

}