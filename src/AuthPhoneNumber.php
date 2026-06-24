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

use Dorbitt\Helpers\CurlHelper;

class AuthPhoneNumber
{
    public function __construct()
    {
        $this->cH = new CurlHelper();
    }

    public function find($payload)
    {
        $params = [
            "path"           => "auth/phone_number/find",
            "method"         => "POST",
            "payload"        => $payload,
            "headers"        => array(
                'Content-Type: application/json',
                'App-Id: ' . getenv('app.id'),
                'Company-Token: ' . getenv('company_token')
            )
        ];

        $response = $this->cH->ummu2($params);

        return $response;
    }

    public function login_password($payload)
    {
        $params = [
            "path"           => "auth/phone_number/login_with_password",
            "method"         => "POST",
            "payload"        => $payload,
            "headers"        => array(
                'Content-Type: application/json',
                'App-Id: ' . getenv('app.id'),
                'Company-Token: ' . getenv('company_token')
            )
        ];

        $response = $this->cH->ummu2($params);

        return $response;
    }

    public function login_otp()
    {
        // 
    }
}
