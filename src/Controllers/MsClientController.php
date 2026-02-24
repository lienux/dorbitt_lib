<?php

namespace Dorbitt\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\HTTP\IncomingRequest;
use App\Helpers\GlobalHelper;
use Dorbitt\Helpers\CurlHelper;
use Dorbitt\Helpers\ViewsHelper;
use Dorbitt\Helpers\UmmuHelper;

class MsClientController extends ResourceController
{
    public function __construct()
    {
        $this->dir_view = 'pages/clients/';
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
            'page_title' => 'Master Data Client',
            'module_kode' => 'clients',
            'navlink' => 'clients',
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
                    "name" => "Clients",
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

        $params = [
            "path"      => "api/clients/show",
            "method" => 'GET',
            "payload" => $payload,
            "headers" => $this->cH->headers3('clients')
        ];

        $builder = $this->cH->ummu2($params);

        return $this->respond($builder, 200);
    }

    public function create()
    {
        $payload = [
            "name" => $this->request->getVar('name'),
            "phone_number" => $this->request->getVar('phone_number'),
            "email" => $this->request->getVar('email'),
            "address" => $this->request->getVar('address'),
        ];

        $params = [
            "path"      => "api/clients/create",
            "method" => 'POST',
            "payload" => $payload,
            "headers" => $this->cH->headers3('clients')
        ];

        $builder = $this->cH->ummu2($params);

        return $this->respond($builder, 200);
    }
}
