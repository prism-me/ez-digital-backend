<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Package;
use App\Models\Plan;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    
    public function index()
    {
        $service = Service::all();
        return parent::returnData($service);
    }

 
    public function store(Request $request)
    {

        if (Service::where('id', $request->id)->exists()) {

            #update
            $service = Service::where('id', $request->id)->update($request->all());
            
        } else {

            #create
            $service = Service::create($request->all());
        }

        return parent::returnData($service);
        
    }

    
    public function show($route)
    {
      
         $service = Service::where('route',$route)->first();
        return parent::returnData($service);
        
    }


    public function destroy($route)
    {
      
        $service = Service::where('route',$route)->delete();
        return parent::returnData($service);
       
    }


    public function allServices(){
            $data = Service::with('package')->get();
            return parent::returnData($data);


    }

    public function price(){

            $data = Service::with(['price' => function ($q){
                $q->select('id','service_id','plan_id','package_id','amount');
            }])->where('id', 1)->select('id','name','route')->first();
            foreach($data['price'] as $key => $value){
                
                $data['price'][$key]['package'] = Package::where('id' ,$value['package_id'])->select('name')->first();
                $data['price'][$key]['plan'] = Plan::where('id' ,$value['plan_id'])->select('name')->first();
             
            }
            return parent::returnData($data);


    }
}
