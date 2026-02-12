<?php

namespace Dorbitt\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\HTTP\IncomingRequest;
use Dorbitt\Helpers\CurlHelper;
use Dorbitt\Helpers\ViewsHelper;
use Dorbitt\Helpers\UmmuHelper;
use App\Helpers\GlobalHelper;

class MsLocationController extends ResourceController
{
    public function __construct()
    {
        $this->dir_view = 'pages/ms_location/';
        $this->request = \Config\Services::request();
        $this->cH = new CurlHelper();
        $this->db = \Config\Database::connect();
        $this->gHelp = new GlobalHelper();
        $this->vH = new ViewsHelper();
        $this->umHelp = new UmmuHelper();
    }

    public function index()
    {
        $data = [
            'page_title' => 'Master Data Locations',
            'module_kode' => 'ms_location',
            'navlink' => 'ms_location',
            'group' => ['masterdata'],
            'tmp' => $this->gHelp->tmp(),
            'dir_views' => $this->dir_view,
            'crud' => null,
            'breadcrumb' => [
                [
                    "name" => "Master Data",
                    "page" => "#",
                    "active" => ""
                ],
                [
                    "name" => "Locations",
                    "page" => "#",
                    "active" => "active"
                ]
            ]
        ];
        return view($this->vH->ummuView($this->dir_view . 'index'), $data);
    }

    public function show($id = null)
    {
        $payload = $this->umHelp->dt_payload2();
        $payload = array_merge($payload, [
            "date" => [
                "from" => "",
                "to" => ""
            ],
            "selects" => "*"
        ]);

        $module_kode = "ms_location";

        $params = [
            "path"      => "api/locations/show",
            "method" => 'GET',
            "payload" => $payload,
            "headers" => $this->cH->headers3($module_kode)
        ];

        $builder = $this->cH->ummu2($params);

        return $this->respond($builder, 200);
    }
}
