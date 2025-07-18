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
use Dorbitt\Helpers\UmmuHelper;
use Dorbitt\Helpers\GlobalHelper;

class UmmuInvestigation
{
    public function __construct()
    {
        $this->curli = new CurlHelper();
        $this->gHelp = new GlobalHelper();

        $this->kode = "she_investigation";
        $this->urli = 'api/she/investigation/';
    }

    public function show_created_name($params)
    {
        $response = $this->curli->request4(
            [
                "path"           => $this->urli . "show_created_name/".$params["id"],
                "method"         => "GET",
                "payload"        => $params['payload'],
                "module_code"    => "she_investigation",
                "token"          => $params['token']
            ]
        );

        return json_decode($response, false);
    }

    public function approval_queue($params)
    {
        $response = $this->curli->request4(
            [
                "path"           => $this->path,
                "method"         => "GET",
                "payload"        => $params['payload'],
                "module_code"    => $this->kode,
                "token"          => $params['token']
            ]
        );

        return json_decode($response, false);
    }
}
