<?php

namespace App\Services;

use App\Models\Auth;
use App\Services\HttpService;

class AuthService

{
    public function generateToken()
    {
        // $auth = [
        //     // "agentId" => 787,
        //     "agentId" => 15,
        //     // "agentPassword" => 'npfiyCxl8roPZUE!',
        //     "agentPassword" => '1h&29$vk449f8',
        //     "clientId" => 11281,
        //     "clientPassword" => '6k!Dp$N4',
        //     "useTrainingDatabase" => true,
        //     "moduleType" => [
        //         // "distribution",
        //         "pointOfSale",
        //         "kiosk"
        //     ]
        // ];

        $auth = [
            "agentId" => 787,
            // "agentId" => 15,
            "agentPassword" => 'npfiyCxl8roPZUE!',
            // "agentPassword" => '1h&29$vk449f8',
            "clientId" => 15111,
            "clientPassword" => 'L!m8$6Ac',
            "useTrainingDatabase" => false,
            "moduleType" => [
                "distribution",
                // "pointOfSale",
                // "kiosk"
            ]
        ];

        $response = (new HttpService)->post('authToken', $auth);

        $data = $response->json();
        if ($response->getStatusCode() == 200) {
            Auth::truncate();
            Auth::create([
                'token' => $data['token'],
                'expiry_date' => $data['expiryDate']
            ]);

            return $data['token'];
        } else {

            return false;
            throw new \Exception("Error Processing Auth Request", 400);
        }
    }


    public function getToken()
    {
        // $data = Auth::get();
        return $this->generateToken();
    }

    public function refreshToken()
    {
        return $this->generateToken();
    }
}
