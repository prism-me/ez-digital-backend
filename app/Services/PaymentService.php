<?php

namespace App\Services;
use Stripe;


class PaymentService {

    public function makePayment($data){

        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        $customer = Stripe\Customer::create(array(
            "address" => [
                    "line1" => $data['line1'],
                    "postal_code" => $data['postal_code'],
                    "city" => $data['city'],
                    "state" => $data['state'],
                    "country" => $data['country'],
            ],
            "email" =>  $data['email'],
            "name" =>  $data['name'],
            "source" => $request->stripeToken
        ));
      
        $charge = Stripe\Charge::create ([
                "amount" => $data['total_amount'] * 100,
                "currency" => "usd",
                "customer" => $customer->id,
                "description" => $data['description'],
                "shipping" => [
                    "name" => $data['name'] ,
                    "address" => [
                        "line1" => $data['line1'],
                        "postal_code" => $data['postal_code'],
                        "city" => $data['city'],
                        "state" => $data['state'],
                        "country" => $data['country'],
                    ],
                ]
        ]); 

        $addCustomer = $this->addCustomer($data);
        $addCustomer = $this->stripeTransaction($data,$customer);
        $user = $this->createUser($data);
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
         $transaction = StripeCustomer::create([
                        "user_id" => 1,
                        "customer_id" => $customer['id'],
                        "line1" => $data['line1'],
                        "postal_code" => $data['postal_code'],
                        "city" => $data['city'],
                        "state" => $data['state'],
                        "country" => $data['country'],
                        "total_amount" => $data['amount'],
                        "currency" => "usd",
                        "description" => $data['description'],
                    ]);
        if (!$customer) throw new  \Exception("Error", 1);
        return false;
    }


    public function createUser($data){

        $create = [
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
        ];
        $create['password'] = bcrypt($data['change_password']);
        User::create($create);

    }


}