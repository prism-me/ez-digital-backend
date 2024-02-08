<?php

namespace App\Traits;

use Illuminate\Http\Request;

trait SeRankingApiTrait {

    /**
     * @param Request $request
     * @return $this|false|string
     */
    public function SeRankingApi($data, $end_point) 
    {
        $url = env("SERANKING_BASE_URL").$end_point;
        // $url = "API_BASE_URL/sites";
        // $data = [
        //     "url" => "https://example.com",
        //     "titl" => "my new test project"
        // ];

        $token = env("SERANKING_TOKEN");
       
        $curl = curl_init($url);
        curl_setopt_array($curl, [
            CURLOPT_HTTPHEADER => ["Authorization: Token ".$token],
            CURLOPT_HEADER => 0,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_POST =>true,
            CURLOPT_POSTFIELDS=>json_encode($data)
        ]);
        $content = curl_exec($curl);
        if (!$content) {
            return 0;
            echo "Request failed!";
        } else {
            $info = curl_getinfo($curl);
            $result = json_decode($content);
            if (201 == $info["http_code"]) {
            return $result;
        } else {
            return 0;
            
            }
        }

    }


    public function SeRankingApiGet($end_point) {
        $url = env("SERANKING_BASE_URL"). $end_point;
       
        $token = env("SERANKING_TOKEN");

        $curl = curl_init();

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            "Authorization: Token ".$token
        ));
        
        $content = curl_exec($curl);
       
        if(!$content){
            return 0;
        }else{
            $info = curl_getinfo($curl);
            $result = json_decode($content);
            return $result;

            if (201 == $info["http_code"]) {
            return $result;
        } else {
            return 0;
           
            }
        }

    }

}
