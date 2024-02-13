<?php

namespace App\Services;
use App\Models\ServicePackageDetail;
use App\Services\SendEmailService;
use App\Models\StripeTransaction;
use App\Models\StripeCustomer;
use App\Models\PackagePrice;
use App\Models\UserPackage;
use Illuminate\Support\Str;
use App\Models\Service;
use App\Models\Package;
use App\Models\User;
use App\Models\Plan;

use Stripe;


class PaymentService {

    public function makePayment ($data,$customer,$serviceDetail,$total){
        $user = PaymentService::createUser($data,$serviceDetail);
        $addCustomer = PaymentService::addCustomer($data,$user);
        $addTransaction = PaymentService::stripeTransaction($data,$customer,$user,$total);
        $service = PaymentService::getServiceDetail($serviceDetail);
        $userPackage = PaymentService::addUserPackage($user,$serviceDetail);
        return $service;
    }


    public function addCustomer($data,$user){

        $customer = StripeCustomer::create([
                        "user_id" => $user['id'],
                        "line1" => $data['line1'],
                        "postal_code" => $data['postal_code'],
                        "city" => $data['city'],
                        "state" => $data['state'],
                        "country" => $data['country']
                    ]);
        if (!$customer) throw new  \Exception("Error", 1);
        return false;

    }


    public function stripeTransaction($data,$customer,$user,$total){
         $transaction = StripeTransaction::create([
                        "user_id" => $user['id'],
                        "customer_id" => $customer['id'],
                        "name" => $data['name'],
                        "amount" => 100 * $total,
                        "currency" => "usd",
                    ]);
        if (!$transaction) throw new  \Exception("Error", 1);
        return false;
    }


    public function createUser($data,$serviceDetail){

        $create = [
            'name' => $data['name'],
            'email' => $data['email'],
            'mobile' => $data['mobile'],
            'user_type' => 'customer',
        ];
        $randomPassword = "new" . Str::random(10) . "user"; 
        $create['password'] = bcrypt($randomPassword);
        $user  = User::create($create);
        $email =  (new SendEmailService())->user($data,$randomPassword,$serviceDetail);
        return $user;


    }

    public function getServiceDetail($serviceDetail){

        if(count($serviceDetail) != 3){
                
            $service = Service::where('route',$serviceDetail[1] )->first();
            $package = Package::where('route',$serviceDetail[2])->first();
            $plan = Plan::where('route',$serviceDetail[3])->first();
            return PackagePrice::where('service_id',$service['id'] )
                                    ->where('package_id' , $package['id'] )
                                    ->where('plan_id' , $plan['id'] )
                                    ->first();

        }else{

            $service = Service::where('route',$serviceDetail[0] )->first();
            $package = Package::where('route',$serviceDetail[1])->first();
            $plan = Plan::where('route',$serviceDetail[2])->first();
            return PackagePrice::where('service_id',$service['id'] )
                                    ->where('package_id' , $package['id'] )
                                    ->where('plan_id' , $plan['id'] )
                                    ->first();

        }
       
       
    }

    public function addUserPackage($user,$serviceDetail){
        
        if(count($serviceDetail) != 3){
                
            $service = Service::where('route',$serviceDetail[1] )->first();
            $package = Package::where('route',$serviceDetail[2])->first();
            $plan = Plan::where('route',$serviceDetail[3])->first();
         
        }else{

            $service = Service::where('route',$serviceDetail[0] )->first();
            $package = Package::where('route',$serviceDetail[1])->first();
            $plan = Plan::where('route',$serviceDetail[2])->first();
           

        }
        UserPackage::create([
            'user_id' => $user['id'],
            'service_id' => $service['id'],
            'plan_id' => $plan['id'],
            'package_id' => $package['id'],
        ]);
        return true;

    }


}
