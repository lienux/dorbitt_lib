<?php

namespace Dorbitt;

use Dorbitt\Curl;

class WorkorderSap
{
     public function __construct()
    {
        $this->curli = new Curl();
    }

    public function show($params)
    {
        $payload = $params['payload'];
        $token = $params['token'];
        $path = "api/pm/workorder_sap/show";

        $params = [
            "path"           => $path,
            "method"         => "GET",
            "payload"        => $payload,
            "module_code"    => "pm_workorder_sap",
            "token"          => $token
        ];

        $response = $this->curli->request3($params);

        return json_decode($response, false);
    }
}
