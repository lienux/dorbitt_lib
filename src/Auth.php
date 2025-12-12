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

class Auth
{
    public function __construct()
    {
        $this->cH = new CurlHelper();
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

        $response = $this->cH->request3($params);

        return json_decode($response, false);
        // return $response;
    }

    public function login2($payload)
    {
        $params = [
            "path"           => "auth/login/create",
            "method"         => "POST",
            "payload"        => $payload['payload'],
            "headers"        => $payload['headers']
        ];

        $response = $this->cH->ummu2($params);

        return $response;
    }

    public function register($payload)
    {
        // 
    }

    public function get_otp_sms($payload)
    {
        $params = [
            "path"           => "auth/otp/sms",
            "method"         => "POST",
            "payload"        => $payload,
            "headers"        => array(
                'Content-Type: application/json',
                'Company-Token: '.getenv('company_token')
            )
        ];

        $response = $this->cH->ummu2_v1_20250704($params);

        return $response;
    }

    public function get_otp_email($payload)
    {
        $params = [
            "path"           => "auth/otp/email",
            "method"         => "POST",
            "payload"        => $payload,
            "headers"        => array(
                'Content-Type: application/json',
                'Company-Token: '.getenv('company_token')
            )
        ];

        $response = $this->cH->ummu2_v1_20250704($params);

        return $response;
    }

    public function get_otp_wa($payload)
    {
        $params = [
            "path"           => "auth/otp/whatsapp",
            "method"         => "POST",
            "payload"        => $payload,
            "headers"        => array(
                'Content-Type: application/json',
                'Company-Token: '.getenv('company_token')
            )
        ];

        $response = $this->cH->ummu2_v1_20250704($params);

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

        $response = $this->cH->ummu2($params);

        return $response;
    }

    public function find_phone_number($payload)
    {
        $params = [
            "path"           => "auth/login/find_phone_number",
            "method"         => "POST",
            "payload"        => $payload,
            "headers"        => array(
                'Content-Type: application/json',
                'App-Id: ' . getenv('app_id'),
                'Company-Token: ' . getenv('company_token')
            )
        ];

        $response = $this->cH->ummu2($params);

        return $response;
    }

    public function username($payload)
    {
        $params = [
            "path"           => "auth/login/username",
            "method"         => "POST",
            "payload"        => $payload,
            "module_code"    => null,
            "token"          => null
        ];

        $response = $this->cH->request3($params);

        return json_decode($response, false);
        // return $response;
    }

    public function create_next($payload)
    {
        $params = [
            "path"           => "auth/login/create_next",
            "method"         => "POST",
            "payload"        => $payload,
            "module_code"    => null,
            "token"          => null
        ];

        $response = $this->cH->request3($params);

        return json_decode($response, false);
        // return $response;
    }

    public function partisipan($payload)
    {
        $params = [
            "path"           => "auth/login/partisipan",
            "method"         => "POST",
            "payload"        => $payload,
            "module_code"    => null,
            "token"          => null
        ];

        $response = $this->cH->request3($params);

        return json_decode($response, false);
        // return $response;
    }

    public function is_token($params)
    {
        $response = $this->cH->request4([
            "path"           => "auth/is_token",
            "method"         => "POST",
            "payload"        => null,
            "module_code"    => null,
            "token"          => $params["token"]
        ]);

        return json_decode($response, false);
    }

    public function show_msdb($params)
    {
        $payload = $params['payload'];
        $token = $params['token'];
        
        $path = "show_msdb";

        $params = [
            "path"           => $path,
            "method"         => "GET",
            "payload"        => $payload,
            "module_code"    => "msdb",
            "token"          => $token
        ];

        $response = $this->cH->request3($params);

        return json_decode($response, false);
    }

    public function phone_number_find($payload)
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

    public function company_profile()
    {
        $params = [
            "path"      => "company_profile",
            "method"    => "GET",
            "payload"   => [],
            "headers"   => array(
                'Content-Type: application/json',
                'Company-Token: '.getenv('company_token')
            )
        ];

        $response = $this->cH->ummu2($params);

        return $response;
    }
}
