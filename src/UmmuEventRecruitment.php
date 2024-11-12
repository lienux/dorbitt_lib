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

class UmmuEventRecruitment
{
    public function __construct()
    {
        $this->curli = new Curl();
    }

    public function show($params)
    {
        $id = $params['id'];
                
        if ($id) {
            $id = "/" . $id;
        }else{
            $id = "";
        }

        $params = [
            "path"           => "api/hcm/event_recruitment/show" . $id,
            "method"         => "GET",
            "payload"        => $params['payload'],
            "module_code"    => "event_recruitment",
            "token"          => $params['token']
        ];

        $response = $this->curli->request4($params);

        return json_decode($response, false);
    }

    public function create($params)
    {
        $params = [
            "path"           => "api/event_management/registration/create",
            "method"         => "POST",
            "payload"        => $params['payload'],
            "module_code"    => "event_registration",
            "token"          => $params['token']
        ];

        $response = $this->curli->request4($params);

        return json_decode($response, false);
    }

    public function create_applicants($params)
    {
        $params = [
            "path"           => "api/hcm/event_recruitment/create_applicants",
            "method"         => "POST",
            "payload"        => $params['payload'],
            "module_code"    => "event_recruitment",
            "token"          => $params['token']
        ];

        $response = $this->curli->request4($params);

        return json_decode($response, false);
    }
}
