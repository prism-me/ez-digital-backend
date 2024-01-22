<?php

namespace App\Services;
use Illuminate\Support\Str;
use App\Models\StripeCustomer;
use App\Models\User;
use App\Models\StripeTransaction;

use Stripe;


class PaymentService {

    public function makePayment ($data,$customer){
      
        
        $addCustomer = PaymentService::addCustomer($data);
        $addCustomer = PaymentService::stripeTransaction($data,$customer);
        $user = PaymentService::createUser($data);
    }


    public function addCustomer($data){

        $customer = StripeCustomer::create([
                        "user_id" => 1,
                        "line1" => $data['line1'],
                        "postal_code" => $data['postal_code'],
                        "city" => $data['city'],
                        "state" => $data['state'],
                        "country" => $data['country']
                    ]);
        if (!$customer) throw new  \Exception("Error", 1);
        return false;

    }


    public function stripeTransaction($data,$customer){
         $transaction = StripeTransaction::create([
                        "user_id" => 1,
                        "customer_id" => $customer['id'],
                        "name" => $data['name'],
                        "amount" => 100 * 100,
                        "currency" => "usd",
                        "description" => $data['description']
                      
                    ]);
        if (!$customer) throw new  \Exception("Error", 1);
        return false;
    }


    public function createUser($data){

        $create = [
            'name' => $data['name'],
            'email' => $data['email'],
            'mobile' => $data['mobile'],
        ];
        $randomPassword = "new" . Str::random(10) . "user"; 
        $create['password'] = bcrypt($randomPassword);
        $user  = User::create($create);
        SendEmailService::user($data,$randomPassword);
        return true;


    }


}
