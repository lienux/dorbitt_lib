<?php

namespace Dorbitt\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\HTTP\IncomingRequest;
use Dorbitt\Helpers\CurlHelper;
use Dorbitt\Helpers\ViewsHelper;
use Dorbitt\Helpers\UmmuHelper;
use App\Helpers\GlobalHelper;

class UomController extends ResourceController
{
    public function __construct()
    {
        $this->module_kode = 'unit_of_measure';
        $this->pathAPI = "api/master-data/" . $this->module_kode;
        $this->dir_view = 'pages/'. $this->module_kode .'/';
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
            'page_title' => 'Unit of Measure',
            'module_kode' => $this->module_kode,
            'navlink' => $this->module_kode,
            'group' => ['config'],
            'tmp' => $this->gHelp->tmp(),
            'dir_views' => $this->dir_view,
            'crud' => null,
            'breadcrumb' => [
                [
                    "name" => "Configuration",
                    "page" => "#",
                    "active" => ""
                ],
                [
                    "name" => "Unit of Measure (UoM)",
                    "page" => "#",
                    "active" => "active"
                ]
            ],
        ];
        return view(config('Ummu')->Views('partials/index'), $data);
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

        $queryString = http_build_query($payload);

        $path = $this->pathAPI . "?" . $queryString;
        $headers = $this->cH->headers3($this->module_kode);

        $builder = $this->cH->ummuGet($path, $headers);

        return $this->respond($builder, 200);
    }

    public function create()
    {
        $payload = [
            "behavior" => $this->request->getPost('behavior'),
            "category" => $this->request->getPost('category'),
            "name" => $this->request->getPost('name'),
            "amount" => $this->request->getPost('amount'),
        ];

        $params = [
            "path"      => $this->pathAPI,
            "method" => 'POST',
            "payload" => $payload,
            "headers" => $this->cH->headers3($this->module_kode)
        ];

        $builder = $this->cH->ummu2($params);

        return $this->respond($builder, 200);
    }

    public function update($id = null)
    {
        $payload = [
            "kode" => $this->request->getPost('kode'),
            "name" => $this->request->getPost('name'),
        ];

        $params = [
            "path" => $this->pathAPI ."/" . $id,
            "method" => 'PUT',
            "payload" => $payload,
            "headers" => $this->cH->headers3($this->module_kode)
        ];

        $builder = $this->cH->ummu2($params);

        return $this->respond($builder, 200);
    }

    public function delete($id = null)
    {
        $params = [
            "path" => $this->pathAPI ."/" . $id,
            "method" => 'DELETE',
            "payload" => [],
            "headers" => $this->cH->headers3($this->module_kode)
        ];

        $builder = $this->cH->ummu2($params);

        return $this->respond($builder, 200);
    }
}
