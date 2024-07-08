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
use Dorbitt\GlobalHelper;

class UmmuEmployeeAccount
{
    public function __construct()
    {
        $this->curli = new Curl();
        $this->gHelp = new GlobalHelper();
    }

    public function show($params)
    {
        $response = $this->curli->request4(
            [
                "path"           => "api/hcm/employee_account/show",
                "method"         => "GET",
                "payload"        => $params['payload'],
                "module_code"    => "employee_account",
                "token"          => $params['token']
            ]
        );

        return json_decode($response, false);
    }

    public function import($params)
    {
        $filepath = $this->gHelp->upload();

        $payload = [
            "path"           => "api/hcm/employee_account/import",
            "method"         => "POST",
            "payload"        => array('file'=> new \CURLFILE($filepath)),
            "module_code"    => "employee_account",
            "token"          => $params['token']
        ];

        $response = $this->curli->form($payload);

        unlink($filepath);

        return json_decode($response, false);
    }
}
