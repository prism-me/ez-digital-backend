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


    public function website_summary_statistics(Request $request){

        $site_id = $request->site_id;
        // $site_id = "6005651";
        // $search_engine_id = $request->search_engine_id; // "336616";

        $end_point = "sites/".$site_id."/stat";

        $response = $this->SeRankingApiGet($end_point);
        if($response){
            return response()->json(['success' => 'Request successfull','data' => $response], 200);
        }else{
            return response()->json([ 'error' => "Something went wrong"], 400);

        }

    }


    public function keyword_statistics(Request $request){

        $site_id = $request->site_id;
        // $site_id = "6005651";
        $search_engine_id = $request->search_engine_id; // "336616";
        $date_from = "2022-01-01";
        $date_to = "2024-01-01";
        $site_engine_id = "336616";

        // $end_point = "sites/".$site_id."/positions?date_from=".$date_from."&date_to=".$date_to."&site_engine_id=".$site_engine_id."&with_landing_pages=1&with_serp_features=1
        // ";

        // $end_point = "sites/".$site_id."/positions?site_engine_id=".$site_engine_id;
        $end_point = "sites/".$site_id."/positions";

        $response = $this->SeRankingApiGet($end_point);
        if($response){
            return response()->json(['success' => 'Request successfull','data' => $response], 200);
        }else{
            return response()->json([ 'error' => "Something went wrong"], 400);

        }

    }


    public function competitors($domain){

        $end_point = "research/" . "ae" . "/competitors/" . "?domain" . '=' .  $domain . "&type=organic" . "&stats=1";
        $response = $this->SeRankingApiGet($end_point);
        return parent::returnData($response, 200);

    }

    public function keywordOverview($domain){


        $end_point    = "research/" . "ae" . "/overview/" . "?domain" . '=' . $domain . "&type=organic" ;
        $response = $this->SeRankingApiGet($end_point);
        return parent::returnData($response, 200);
    }

    public function google_analytics(Request $request){

        $site_id = $request->site_id; //"6005651";

        $end_point = "analytics/".$site_id."/google";

        $response = $this->SeRankingApiGet($end_point);
        if($response){
            return response()->json(['success' => 'Request successfull','data' => $response], 200);
        }else{
            return response()->json([ 'error' => "Something went wrong"], 400);

        }

    }


    public function audit(Request $request){

        $site_id = $request->site_id; //"6005651";

        $end_point    = "audit/" . $site_id . "/report";
        $response = $this->SeRankingApiGet($end_point);
        return parent::returnData($response, 200);

    }





    public function create_audit($domain){

        $data = [
            'domain' => $domain
        ];

        $end_point    = "audit/create";
        $response = $this->SeRankingApi($data, $end_point);
        return $response;
        // return parent::returnData($response, 200);

    }

    public function audit_report(Request $request){

        if(Project::where('user_id', $request->user_id)->count() > 0){
            $project = Project::where('user_id', $request->user_id)->first();
            if($project->report_id == 0){
                $parse = parse_url($project->web_url);
                $domain =  $parse['host'];
                $response = $this->create_audit($domain);
                $report_id = $response->id;
                $project->report_id = $report_id;
                $project->save();
            }

            $end_point    = "audit/" . $project->report_id . "/report";
            $response = $this->SeRankingApiGet($end_point);
            return parent::returnData($response, 200);

            return response()->json(['success' => 'Request successfull','data' => $project], 200);
        }else{
            return response()->json([ 'error' => 'Project not found'], 400);
        }




    }


    public function audit_report_recheck(Request $request){


        $end_point    = "audit/" . $request->report_id . "/recheck";
        $response = $this->SeRankingApiGet($end_point);
        return parent::returnData($response, 200);

    }


    public function analyze(Request $request){
        $data = [
            'keywords' => $request->keywords
        ];
        $end_point    = "research/" . "ae" . "/analyze-keywords/";
        $response = $this->SeRankingApi($data,$end_point);
        return parent::returnData($response, 200);
    }


    public function bestPages(){

    }


}
