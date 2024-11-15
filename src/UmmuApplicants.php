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

class UmmuApplicants
{
    public function __construct()
    {
        $this->curli = new Curl();
        $this->gHelp = new GlobalHelper();
        $this->request = \Config\Services::request();
        $this->urli = 'api/hcm/applicants/';
    }

    public function show($params)
    {
        $response = $this->curli->request4(
            [
                "path"           => $this->urli . "show",
                "method"         => "GET",
                "payload"        => $params['payload'],
                "module_code"    => "hcm_applicants",
                "token"          => $params['token']
            ]
        );

        return json_decode($response, false);
    }

    // public function delete($params)
    // {
    //     $response = $this->curli->request4(
    //         [
    //             "path"           => $this->urli . "delete",
    //             "method"         => "DELETE",
    //             "payload"        => $params['payload'],
    //             "module_code"    => "employee_salary",
    //             "token"          => $params['token']
    //         ]
    //     );

    //     return json_decode($response, false);
    // }
}
