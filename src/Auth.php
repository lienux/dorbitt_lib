<?php

namespace Dorbitt;

/**
* =============================================
* Author: Ummu
* Website: https://ummukhairiyahyusna.com/
* App: DORBITT LIB
* Description: 
* =============================================
*/

use Dorbitt\Curl;

class Auth
{
    public function __construct()
    {
        $this->curli = new Curl();
    }

    public function login($payload)
    {
        $params = [
            "path"           => "auth/login/create",
            "method"         => "POST",
            "payload"        => $payload,
            "module_code"    => null,
            "token"          => null
        ];

        $response = $this->curli->request3($params);

        return json_decode($response, false);
        // return $response;

    }

    public function register($payload)
    {
        // 
    }
}
