<?php

namespace Dorbitt;

use Dorbitt\Curl;

class Auth
{
    public function __construct()
    {
        $this->curli = new Curl();
    }

    public function login($payload)
    {
        $url = "auth/login/create";
        $method = "GET";
        $module_code = "";
        $token = null;

        $create = $this->curli->request($url,$method,$payload,$module_code,$token);

        return json_decode($create, false);

    }

    public function register($payload)
    {
        // 
    }
}
