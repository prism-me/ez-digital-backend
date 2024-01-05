<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    
    public function index()
    {
        $plan = Plan::all();
        return parent::returnData($plan);
    }

 
    public function store(Request $request)
    {

        if (Plan::where('id', $request->id)->exists()) {

            #update
            $plan = Plan::where('id', $request->id)->update($request->all());
            
        } else {

            #create
            $plan = Plan::create($request->all());
        }

        return parent::returnData($plan);
        
    }

    
    public function show($route)
    {
      
        $plan = Plan::where('route',$route)->first();
        return parent::returnData($plan);
        
    }


    public function destroy($route)
    {
      
        $plan = Plan::where('route',$route)->delete();
        return parent::returnData($plan);
       
    }
}
