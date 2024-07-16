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

class UmmuOtp
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
            $path = "api/server/otp/show/" . $id;
        }else{
            $path = "api/server/otp/show";
        }

        $params = [
            "path"           => $path,
            "method"         => "GET",
            "payload"        => $payload,
            "module_code"    => "otp_kode",
            "token"          => $token
        ];

        $response = $this->curli->request3($params);

        return json_decode($response, false);
    }

    public function create($params)
    {
        $payload = $params['payload'];
        $token = $params['token'];
        $path = "api/server/otp/create";

        $params = [
            "path"           => $path,
            "method"         => "POST",
            "payload"        => $payload,
            "module_code"    => "otp_kode",
            "token"          => $token
        ];

        $response = $this->curli->request3($params);

        return json_decode($response, false);
    }

    public function create($params)
    {
        $payload = $params['payload'];
        $token = $params['token'];
        $path = "api/server/otp/confirm";

        $params = [
            "path"           => $path,
            "method"         => "PUT",
            "payload"        => $payload,
            "module_code"    => "otp_kode",
            "token"          => $token
        ];

        $response = $this->curli->request3($params);

        return json_decode($response, false);
    }
}
