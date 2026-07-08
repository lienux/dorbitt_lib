<?php

namespace Dorbitt\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\HTTP\IncomingRequest;
use Dorbitt\Helpers\CurlHelper;
use Dorbitt\Helpers\ViewsHelper;
use Dorbitt\Helpers\UmmuHelper;
use App\Helpers\GlobalHelper;

class PelabuhanController extends ResourceController
{
    public function __construct()
    {
        $this->pathAPI = "api/master-data/pelabuhan";
        $this->module_kode = 'master-data-pelabuhan';
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
            'page_title' => 'Master Data Port',
            'module_kode' => $this->module_kode,
            'navlink' => $this->module_kode,
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
                    "name" => "Port Master",
                    "page" => "#",
                    "active" => "active"
                ]
            ],
        ];
        return view($this->vH->ummuViewPartialIndex(), $data);
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
            "path" => $this->pathAPI ."/show",
            "method" => 'GET',
            "payload" => $payload,
            "headers" => $this->cH->headers3($this->module_kode)
        ];

        $builder = $this->cH->ummu2($params);

        return $this->respond($builder, 200);
    }

    public function create()
    {
        $payload = [
            "name" => $this->request->getPost('name'),
            
            "lintang_sudut" => $this->request->getPost('lintang_sudut'),
            "lintang_menit" => $this->request->getPost('lintang_menit'),
            "lintang_arah" => $this->request->getPost('lintang_arah'),

            "bujur_sudut" => $this->request->getPost('bujur_sudut'),
            "bujur_menit" => $this->request->getPost('bujur_menit'),
            "bujur_arah" => $this->request->getPost('bujur_arah'),
        ];

        $params = [
            "path" => $this->pathAPI . "/create",
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
            "name" => $this->request->getPost('name'),
            
            "lintang_sudut" => $this->request->getPost('lintang_sudut'),
            "lintang_menit" => $this->request->getPost('lintang_menit'),
            "lintang_arah" => $this->request->getPost('lintang_arah'),

            "bujur_sudut" => $this->request->getPost('bujur_sudut'),
            "bujur_menit" => $this->request->getPost('bujur_menit'),
            "bujur_arah" => $this->request->getPost('bujur_arah'),
        ];

        $params = [
            "path" => $this->pathAPI . "/update/" . $id,
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
            "path" => $this->pathAPI . "/delete/" . $id,
            "method" => 'DELETE',
            "payload" => [],
            "headers" => $this->cH->headers3($this->module_kode)
        ];

        $builder = $this->cH->ummu2($params);

        return $this->respond($builder, 200);
    }
}
