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

class UmmuEmployeeSalary
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
                "path"           => "api/hcm/payroll/employee_salary/show",
                "method"         => "GET",
                "payload"        => $params['payload'],
                "module_code"    => "employee_salary",
                "token"          => $params['token']
            ]
        );

        return json_decode($response, false);
    }

    public function import($params)
    {
        $filepath = $this->gHelp->upload();

        $response = $this->curli->form(
            [
                "path"           => "api/hcm/payroll/employee_salary/import",
                "method"         => "POST",
                "payload"        => array('file'=> new \CURLFILE($filepath)),
                "module_code"    => "employee_salary",
                "token"          => $params['token']
            ]
        );

        unlink($filepath);

        return json_decode($response, false);
    }
}
