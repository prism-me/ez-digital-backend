<?php

namespace App\Services;
use App\Mail\UserWelcomeMail;
use Illuminate\Support\Facades\Mail;
class SendEmailService {

    public function user ($data,$password,$serviceDetail)
    {

        
        if(count($segment) != 3){
                
            $service = Service::where('route',$serviceDetail[1] )->first();
            $package = Package::where('route',$serviceDetail[2])->first();
            $plan = Plan::where('route',$serviceDetail[3])->first();

        }else{

            $service = Service::where('route',$serviceDetail[0] )->first();
            $package = Package::where('route',$serviceDetail[1])->first();
            $plan = Plan::where('route',$serviceDetail[2])->first();


        }
        if ($service  == null  || $package == null || $plan == null){
            
            return redirect()->back();

        }
        $amount =  PackagePrice::where('service_id',$service['id'] )
                                ->where('package_id' , $package['id'] )
                                ->where('plan_id' , $plan['id'] )
                                ->first();
        

        $gst =  5 / 100 * $amount['amount'] ;
        $total = $amount['amount'] + $gst;
        
        $data = [
            
        ]; 
        $userData = [
            'sub_total' => '$' . $amount['amount'],
            'service' => $service['name'],
            'plan' => $plan['name'],
            'gst' => '5%',
            'gst_total' => '$' . $gst,
            'total' =>   '$' . $total,
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $password
        ];
        $userMail = $data['email'];

        Mail::to($userMail)->send(new UserWelcomeMail($userData));
        return true;


    }
}