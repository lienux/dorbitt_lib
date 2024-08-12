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
        $this->urli = 'api/hcm/employee_account/';
    }

    public function show($params)
    {
        $response = $this->curli->request4(
            [
                "path"           => $this->urli . "show",
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
            "path"           => $this->urli . "import",
            "method"         => "POST",
            "payload"        => array_merge(
                array('file' => new \CURLFILE($filepath)),
                $params['payload']
            ),
            "module_code"    => "employee_account",
            "token"          => $params['token']
        ];

        $response = $this->curli->form($payload);

        unlink($filepath);

        return json_decode($response, false);
    }

    public function delete($params)
    {
        $response = $this->curli->request4(
            [
                "path"           => $this->urli . "delete",
                "method"         => "DELETE",
                "payload"        => $params['payload'],
                "module_code"    => "employee_account",
                "token"          => $params['token']
            ]
        );

        return json_decode($response, false);
    }

    public function update($params)
    {
        $response = $this->curli->request4(
            [
                "path"           => $this->urli . "update",
                "method"         => "PUT",
                "payload"        => $params['payload'],
                "module_code"    => "employee_account",
                "token"          => $params['token']
            ]
        );

        return json_decode($response, false);
    }
}
