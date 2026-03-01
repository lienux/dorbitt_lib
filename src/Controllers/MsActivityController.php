<?php

namespace Dorbitt\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\HTTP\IncomingRequest;
use Dorbitt\Helpers\CurlHelper;
use Dorbitt\Helpers\ViewsHelper;
use Dorbitt\Helpers\UmmuHelper;
use App\Helpers\GlobalHelper;

class MsActivityController extends ResourceController
{
    public function __construct()
    {
        $this->dir_view = 'pages/ms_activity/';
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
            'page_title' => 'Master Data Activity',
            'module_kode' => 'ms_activity',
            'navlink' => 'ms_activity',
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
                    "name" => "Activity",
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
            "path"      => "api/ms_activity/show",
            "method" => 'GET',
            "payload" => $payload,
            "headers" => $this->cH->headers3('ms_activity')
        ];

        $builder = $this->cH->ummu2($params);

        return $this->respond($builder, 200);
    }

    public function create()
    {
        $kode = $this->request->getVar('kode');
        $name = $this->request->getVar('name');
        $description = $this->request->getVar('description');

        $payload = [
            "kode" => $kode,
            "name" => $name,
            "description" => $description,
        ];

        $params = [
            "path"      => "api/ms_activity/create",
            "method" => 'POST',
            "payload" => $payload,
            "headers" => $this->cH->headers3('ms_activity')
        ];

        $builder = $this->cH->ummu2($params);

        return $this->respond($builder, 200);
    }

    public function update($id = null)
    {
        $kode = $this->request->getVar('kode');
        $name = $this->request->getVar('name');
        $description = $this->request->getVar('description');

        $payload = [
            "kode" => $kode,
            "name" => $name,
            "description" => $description,
        ];

        $params = [
            "path"      => "api/ms_activity/update/" . $id,
            "method" => 'PUT',
            "payload" => $payload,
            "headers" => $this->cH->headers3('ms_activity')
        ];

        $builder = $this->cH->ummu2($params);

        return $this->respond($builder, 200);
    }

    public function delete($id = null)
    {
        $params = [
            "path"      => "api/ms_activity/delete/" . $id,
            "method" => 'DELETE',
            "payload" => [],
            "headers" => $this->cH->headers3('ms_activity')
        ];

        $builder = $this->cH->ummu2($params);

        return $this->respond($builder, 200);
    }
}
