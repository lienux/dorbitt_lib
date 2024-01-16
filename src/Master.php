<?php

namespace Dorbitt;

use Dorbitt\Curl;

class Master
{
    public function __construct()
    {
        $this->curli = new Curl();
    }

    public function site_project($payload)
    {

        $url = "api/master/site_project/show";
        $method = "GET";
        $module_code = "site_project";
        $token = null;

        $create = $this->curli->request($url,$method,$payload,$module_code,$token);

        return json_decode($create, false);
    }
}
