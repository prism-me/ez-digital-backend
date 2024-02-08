<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Package;
use App\Models\Plan;
use App\Models\PackagePrice;
class InvoiceController extends Controller
{
    public function invoice($service= null , $sub = null, $package = null , $amount = null){
     
        $segment  = request()->segments();
        if( $segment == [] ){
           
            return view('invoice.home' );

        }else{

                $currentUrl = URL::current();
                $request = Request::create($currentUrl);
                $serviceDetail = $request->segments();
               
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
                'sub_total' => '$' . $amount['amount'],
                'service' => $service['name'],
                'plan' => $plan['name'],
                'gst' => '5%',
                'gst_total' => '$' . $gst,
                'total' =>   '$' . $total,
            ]; 
            
        
            return view('invoice.home' )->with('data',  $data);
      
        }
    }

}
