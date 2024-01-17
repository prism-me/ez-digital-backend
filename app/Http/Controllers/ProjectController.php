<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\SeRankingApiTrait;
use App\Models\Project;

class ProjectController extends Controller
{
    use SeRankingApiTrait;

    public function create_project(Request $request){

        $data = [
            "url" => $request->web_url,
            "titl" => $request->title
        ];
        $table->string('web_url');
        $table->string('cms_url')->nullable();
        $table->string('cpanel_url')->nullable();
        $table->string('cms_username')->nullable();
        $table->string('cms_password')->nullable();
        $table->string('cpanel_username')->nullable();
        $table->string('cpanel_password')->nullable();
        $table->integer('site_id')->nullable();
        $end_point = "sites";

        $response = $this->SeRankingApi($data, $end_point);
        if($response){
            $project = new Project();
            $project->user_id = $request->user_id;
            $project->title = $request->title;
            $project->web_url = $request->title;
            $project->cms_url = $request->title;
            $project->cpanel_url = $request->title;
            $project->cms_username = $request->title;
            $project->cms_password = $request->title;
            $project->cpanel_username = $request->title;
            $project->cpanel_password = $request->title;
            $project->site_id = $request->title;
            $project->save();

            return response()->json([ 'success' => 'Project added successfully']);
        }
        else{
            return response()->json([ 'error' => 'Something went wrong!']);

        }

        dd($response);

    }

}
