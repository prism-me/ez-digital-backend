<?php

namespace App\Services;
use Illuminate\Support\Str;
use App\Models\StripeCustomer;
use App\Models\User;
use App\Models\StripeTransaction;

use Stripe;


class PaymentService {

    public function makePayment ($data,$customer,$serviceDetail){
      
        
        $addCustomer = PaymentService::addCustomer($data);
        $addCustomer = PaymentService::stripeTransaction($data,$customer);
        $user = PaymentService::createUser($data,$serviceDetail);
        return $user;
        $service = PaymentService::getServiceDetail($serviceDetail);
        return $service;
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
        if (!$transaction) throw new  \Exception("Error", 1);
        return false;
    }


    public function createUser($data,$serviceDetail){

        $create = [
            'name' => $data['name'],
            'email' => $data['email'],
            'mobile' => $data['mobile'],
        ];
        $randomPassword = "new" . Str::random(10) . "user"; 
        $create['password'] = bcrypt($randomPassword);
        $user  = User::create($create);
        SendEmailService::user($data,$randomPassword,$serviceDetail);
        return true;


    }

    public function getServiceDetail($serviceDetail){
        
        $service = Service::where('route',$serviceDetail[0] )->first();
        $package = Package::where('route',$serviceDetail[1])->first();
        $plan = Plan::where('route',$serviceDetail[2])->first();
        return ServicePackageDetail::where('service_id',$service['id'] )
                                ->where('package_id' , $package['id'] )
                                ->where('plan_id' , $plan['id'] )
                                ->first();

         
    }


}
