<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\SeRankingApiTrait;
use App\Models\Project;

class ProjectController extends Controller
{
    use SeRankingApiTrait;

    public function get_user_project(Request $request){
        if(Project::where('user_id', $request->user_id)->count() > 0){
            $project = Project::where('user_id', $request->user_id)->first();
            return response()->json(['success' => 'Request successfull','data' => $project], 200);
        }else{
            return response()->json([ 'error' => 'Project not found'], 400);
        }
    }

    public function create_project(Request $request){

        $data = [
            "url" => $request->web_url,
            "titl" => $request->title
        ];
        $end_point = "sites";

        $response = $this->SeRankingApi($data, $end_point);
        if($response){
            $project = new Project();
            $project->user_id = $request->user_id;
            $project->title = $request->title;
            $project->web_url = $request->web_url;
            $project->cms_url = $request->cms_url;
            $project->cpanel_url = $request->cpanel_url;
            $project->cms_username = $request->cms_username;
            $project->cms_password = $request->cms_password;
            $project->cpanel_username = $request->cpanel_username;
            $project->cpanel_password = $request->cpanel_password;
            $project->site_id = $response->site_id;
            $project->save();

            return response()->json([ 'success' => 'Project added successfully'], 200);
        }
        else{
            return response()->json([ 'error' => 'Something went wrong!'], 400);

        }

    }

    public function add_search_engine(Request $request){
        $data = [
            "search_engine_id" => $request->search_engine_id
        ];
        $end_point = "sites/".$request->site_id."/search-engines";
        $response = $this->SeRankingApi($data, $end_point);

        if($response){
            Project::where('site_id', $site_id)->update(['search_engine_id' => $request->search_engine_id]);
            return response()->json([ 'success' => 'Search engine added successfully']);
        }
        else{
            return response()->json([ 'error' => 'Something went wrong!']);

        }


    }


    public function get_search_engines(){
        $data = [
            "url" => "https://ez-digital.co",
            "titl" => "test"
        ];
        $data = [];
        $end_point = "system/search-engines";

        $response = $this->SeRankingApiGet($end_point);
        if($response){
            return response()->json(['success' => 'Request successfull','data' => $response], 200);
        }else{
            return response()->json([ 'error' => "Something went wrong"], 400);

        }

    }



}
