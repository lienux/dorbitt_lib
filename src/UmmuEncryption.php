<?php

namespace Dorbitt;

use Dorbitt\Curl;

class UmmuEncryption
{
    public function __construct()
    {
        $this->curli = new Curl();
    }

    public function encrypt($params)
    {
        $payload = $params['payload'];
        $token = $params['token'];
        
        $path = "api/lib/encryption/encrypt";

        $params = [
            "path"           => $path,
            "method"         => "GET",
            "payload"        => $payload,
            "module_code"    => "encryption",
            "token"          => $token
        ];

        $response = $this->curli->request3($params);

        return json_decode($response, false);
    }

    public function decrypt($params)
    {
        $payload = $params['payload'];
        $token = $params['token'];
        
        $path = "api/lib/encryption/decrypt";

        $params = [
            "path"           => $path,
            "method"         => "GET",
            "payload"        => $payload,
            "module_code"    => "encryption",
            "token"          => $token
        ];

        $response = $this->curli->request3($params);

        return json_decode($response, false);
    }
}
