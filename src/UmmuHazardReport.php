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

class UmmuHazardReport
{
    public function __construct()
    {
        $this->curli = new Curl();
        $this->gHelp = new GlobalHelper();
        $this->urli = 'api/she/hazard_report/';
    }

    public function show($params)
    {
        $response = $this->curli->request4(
            [
                "path"           => $this->urli . "show",
                "method"         => "GET",
                "payload"        => $params['payload'],
                "module_code"    => "she_hazard_report",
                "token"          => $params['token']
            ]
        );

        return json_decode($response, false);
    }

    public function insert($params)
    {
        $response = $this->curli->request4([
            "path"           => $this->urli. "create",
            "method"         => "POST",
            "payload"        => $params["payload"],
            "module_code"    => "she_hazard_report",
            "token"          => $params["token"]
        ]);

        return json_decode($response, false);
    }

    public function delete($params)
    {
        $response = $this->curli->request4(
            [
                "path"           => $this->urli. "delete",
                "method"         => "DELETE",
                "payload"        => $params['payload'],
                "module_code"    => "she_hazard_report",
                "token"          => $params['token']
            ]
        );

        return json_decode($response, false);
    }

    public function update($params)
    {
        $response = $this->curli->request4(
            [
                "path"           => $this->urli. "update",
                "method"         => "PUT",
                "payload"        => $params['payload'],
                "module_code"    => "she_hazard_report",
                "token"          => $params['token']
            ]
        );

        return json_decode($response, false);
    }

    public function release($params)
    {
        $response = $this->curli->request4(
            [
                "path"           => $this->urli. "release",
                "method"         => "POST",
                "payload"        => $params['payload'],
                "module_code"    => "she_hazard_report",
                "token"          => $params['token']
            ]
        );

        return json_decode($response, false);
    }

    public function approve($params)
    {
        $response = $this->curli->request4(
            [
                "path"           => $this->urli. "approve",
                "method"         => "POST",
                "payload"        => $params['payload'],
                "module_code"    => "she_hazard_report",
                "token"          => $params['token']
            ]
        );

        return json_decode($response, false);
    }

    public function update_release($params)
    {
        $response = $this->curli->request4(
            [
                "path"           => $this->urli. "update_release",
                "method"         => "PUT",
                "payload"        => $params['payload'],
                "module_code"    => "she_hazard_report",
                "token"          => $params['token']
            ]
        );

        return json_decode($response, false);
    }
}
