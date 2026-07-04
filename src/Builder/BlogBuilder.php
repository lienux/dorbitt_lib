<?php

namespace Dorbitt\Builder;

use Dorbitt\Helpers\UmmuHelper;
use Dorbitt\Helpers\CurlHelper;

class BlogBuilder
{
    public function __construct()
    {
        $this->request = \Config\Services::request();
        $this->cH = new CurlHelper();
        $this->umHelp = new UmmuHelper();
    }

    public function get_activity()
    {
        $limit = 5;
        $page = $this->request->getVar('page');

        $p = (!$page) ? 1 : $page;
        $offset = ($p == 1) ? 0 : ($p-1) * $limit;

        $token = getenv('account.token');
        $path = "api/blog/activity?limit=".$limit."&offset=".$offset;
        $headers = $this->cH->headers3_a("activity",$token);

        $reqHttp = $this->cH->ummuGet($path, $headers);

        return $reqHttp;
    }

    public function get_projects()
    {
        $token = getenv('account.token');
        $path = "api/blog/projects?sort=tgl&order=desc";
        $headers = $this->cH->headers3_a("projects",$token);

        $reqHttp = $this->cH->ummuGet($path, $headers);

        return $reqHttp;
    }
}