<?php

namespace App\Services;

use App\Models\RmsClient;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Traits\ForwardsCalls;

class HttpService
{
    use ForwardsCalls;

    protected PendingRequest $http;
    public $client_url;

    public function __construct($payment = null)
    {
        if (is_null($payment)) {

            $this->client_url = RmsClient::select('client_url')->first()['client_url'];
            $this->http = Http::acceptJson()->baseUrl($this->client_url);
        } else {

            $this->http = Http::baseUrl(config('networks.Live.Base_url'));
        }
    }

    public function __call($method, $params)
    {
        return $this->forwardCallTo($this->http, $method, $params);
    }
}
