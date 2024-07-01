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

class UmmuPayslip
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
                "path"           => "api/hcm/payroll/payslip/show",
                "method"         => "GET",
                "payload"        => $params['payload'],
                "module_code"    => "payslip",
                "token"          => $params['token']
            ]
        );

        return json_decode($response, false);
    }
}
