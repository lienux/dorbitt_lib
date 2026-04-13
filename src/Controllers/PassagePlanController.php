<?php

namespace Dorbitt\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\HTTP\IncomingRequest;
use App\Helpers\GlobalHelper;
use Dorbitt\Helpers\CurlHelper;
use Dorbitt\Helpers\ViewsHelper;
use Dorbitt\Helpers\FileHelper;
use Dorbitt\Helpers\UmmuHelper;

class PassagePlanController extends ResourceController
{
    public function __construct()
    {
        $this->module_kode = 'passage_plan';
        $this->dir_view = 'pages/' . $this->module_kode . '/';
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
            'page_title' => 'Passage Plan',
            'module_kode' => $this->module_kode,
            'navlink' => $this->module_kode,
            'group' => ['operations'],
            'tmp' => $this->gHelp->tmp(),
            'dir_views' => $this->dir_view,
            'crud' => null,
            'breadcrumb' => [
                [
                    "name" => "Operations",
                    "page" => "#",
                    "active" => ""
                ],
                [
                    "name" => "Passage Plan",
                    "page" => "#",
                    "active" => "active"
                ]
            ]
        ];
        return view($this->vH->ummuView($this->dir_view . 'index'), $data);
    }

    public function show_ijo()
    {
        $payload = $this->umHelp->dt_payload2();
        $payload = array_merge($payload, [
            "date" => [
                "from" => "",
                "to" => ""
            ],
            "selects" => "*"
        ]);

        $params = [
            "path"      => "api/". $this->module_kode ."/show_ijo",
            "method"    => 'GET',
            "payload"   => $payload,
            "headers"   => $this->cH->headers3($this->module_kode)
        ];

        $builder = $this->cH->ummu2($params);

        return $this->respond($builder, 200);
    }

    public function company_profile()
    {
        $params = [
            "path"      => "company_profile",
            "method"    => "GET",
            "payload"   => [],
            "headers"   => array(
                'Content-Type: application/json',
                'Company-Token: '.getenv('app.company_token')
            )
        ];

        $request = $this->cH->ummu2($params);

        return $this->respond($request, 200);
    }
}
