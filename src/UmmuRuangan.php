<?php

namespace Dorbitt;

use Dorbitt\Curl;

class UmmuRuangan
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
            $path = "api/ruangan/show/" . $id;
        }else{
            $path = "api/ruangan/show";
        }

        $params = [
            "path"           => $path,
            "method"         => "GET",
            "payload"        => $payload,
            "module_code"    => "ruangan",
            "token"          => $token
        ];

        $response = $this->curli->request3($params);

        return json_decode($response, false);
    }

    public function show_roomcateg($params)
    {
        $payload = $params['payload'];
        $token = $params['token'];
        
        $path = "api/ruangan/show_roomcateg";

        $params = [
            "path"           => $path,
            "method"         => "GET",
            "payload"        => $payload,
            "module_code"    => "ruangan",
            "token"          => $token
        ];

        $response = $this->curli->request3($params);

        return json_decode($response, false);
    }
}
