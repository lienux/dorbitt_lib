<?php

namespace Dorbitt;

use Dorbitt\Curl;

class TahunAkademik
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
            $path = "api/tahun_akademik/show/" . $id;
        }else{
            $path = "api/tahun_akademik/show";
        }

        $params = [
            "path"           => $path,
            "method"         => "GET",
            "payload"        => $payload,
            "module_code"    => "tahun_akademik",
            "token"          => $token
        ];

        $response = $this->curli->request3($params);

        return json_decode($response, false);
    }
}
