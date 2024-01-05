<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\ClientInteriorQuotationMail;
use Mail;
use App\Mail\ClientInteriorQuotationMail as ClientMail;

class NotifyClientInteriorQuotationCreated{


    

  
    public function handle(ClientInteriorQuotationMail $userData)
    {
        
        $email = $userData->userData['client_email'];
        Mail::to($email)->send(new ClientMail($userData->userData)); 
    }

}