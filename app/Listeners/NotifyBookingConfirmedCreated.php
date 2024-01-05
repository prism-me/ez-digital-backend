<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\BookingConfirmedMail;
use App\User;
use Mail;
use App\Mail\BookingConfirmedMail as ConfirmMail;

class NotifyBookingConfirmedCreated{


    
    public function __construct()
    {
        //
    }

  
    public function handle(BookingConfirmedMail $userData)
    {

        
        $email = $userData->userData['email'];
        Mail::to($email)->send(new ConfirmMail($userData->userData)); 
    }

}