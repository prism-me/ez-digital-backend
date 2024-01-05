<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\ClientBookingConfirmedMail;
use App\User;
use Mail;
use App\Mail\ClientBookingConfirmedMail as ConfirmMail;

class NotifyClientBookingConfirmedCreated{


    
    public function __construct()
    {
        //
    }

  
    public function handle(ClientBookingConfirmedMail $userData)
    {

        
        $email = $userData->userData['client_email'];
        Mail::to($email)->send(new ConfirmMail($userData->userData)); 
    }

}