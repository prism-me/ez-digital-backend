<?php

namespace App\Services;
use App\Mail\UserWelcomeMail;
use Illuminate\Support\Facades\Mail;
class SendEmailService {

    public function user ($data,$password){

        $userData = [
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $password
        ];
        $userMail = $data['email'];

        Mail::to($userMail)->send(new UserWelcomeMail($userData));
        return true;


    }
}