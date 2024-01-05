<?php

namespace App\Http\Controllers;

use App\Models\Service;
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
}
