<?php

namespace App\Services;

class SendEmailService {

    public function user ($data,$password){

        $value = [
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $password
        ];

    }
}