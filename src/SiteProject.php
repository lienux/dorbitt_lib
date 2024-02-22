<?php

namespace Dorbitt;

use Dorbitt\Curl;

class SiteProject
{
     public function __construct()
    {
        $this->curli = new Curl();
    }

    public function show($params)
    {
        $id = $params['id'];
        $payload = $params['payload'];
        $token = $params['token'];
        
        if ($id) {
            $path = "api/site_project/show/" . $id;
        }else{
            $path = "api/site_project/show";
        }

        $params = [
            "url"            => $path,
            "path"           => $path,
            "method"         => "GET",
            "payload"        => $payload,
            "module_code"    => "site_project",
            "token"          => $token
        ];

        $response = $this->curli->request2($params);

        return json_decode($response, false);
    }
}