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
        $this->request = \Config\Services::request();
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
        $periode_id = $this->request->getVar('periode_id');
        $filepath = $this->gHelp->upload();

        $payload = [
            "path"           => "api/hcm/payroll/employee_salary/import",
            "method"         => "POST",
            "payload"        => array(
                'periode_id'    => $periode_id,
                'file'          => new \CURLFILE($filepath)
            ),
            "module_code"    => "employee_salary",
            "token"          => $params['token']
        ];

        $response = $this->curli->form($payload);

        unlink($filepath);

        return json_decode($response, false);
        // return $payload;
    }

    public function show_payslip_periode($params)
    {
        $response = $this->curli->request4(
            [
                "path"           => "api/hcm/payroll/employee_salary/show_payslip_periode",
                "method"         => "GET",
                "payload"        => $params['payload'],
                "module_code"    => "employee_salary",
                "token"          => $params['token']
            ]
        );

        return json_decode($response, false);
    }
}
