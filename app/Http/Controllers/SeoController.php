<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\SeRankingApiTrait;
use App\Models\Project;

class SeoController extends Controller
{
    use SeRankingApiTrait;

    public function website_keywords_list(Request $request){

        $site_id = $request->site_id; //"6005651";
        $search_engine_id = $request->search_engine_id; // "336616";

        $end_point = "sites/".$site_id."/keywords?site_engine_id=".$search_engine_id;

        $response = $this->SeRankingApiGet($end_point);
        if($response){
            return response()->json(['success' => 'Request successfull','data' => $response], 200);
        }else{
            return response()->json([ 'error' => "Something went wrong"], 400);

        }

    }
}
