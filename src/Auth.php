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

    public function get_otp_sms($payload)
    {
        $params = [
            "path"           => "auth/otp/sms/create",
            "method"         => "POST",
            "payload"        => $payload,
            "headers"        => array(
                'Content-Type: application/json',
                'Company-Token: '.getenv('company_token')
            )
        ];

        $response = $this->curli->ummu2($params);

        return $response;
    }

    public function login_with_phone($payload)
    {
        $params = [
            "path"           => "auth/login/create_with_phone",
            "method"         => "POST",
            "payload"        => $payload,
            "headers"        => array(
                'Content-Type: application/json',
                // 'Company-Token: '.getenv('company_token'),
                'App-Id: ' . getenv('app_id')
            )
        ];

        $response = $this->curli->ummu2($params);

        return $response;
    }
}
