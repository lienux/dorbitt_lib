<?php

namespace Dorbitt\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\HTTP\IncomingRequest;
use Dorbitt\Helpers\CurlHelper;
use Dorbitt\Helpers\ViewsHelper;
use Dorbitt\Helpers\UmmuHelper;
use App\Helpers\GlobalHelper;

class CrewController extends ResourceController
{
    public function __construct()
    {
        $this->pathAPI = "api/crewing/ms-crew";
        $this->moduleKodeAPI = "ms_crew";
        $this->module_kode = 'ms_crew';
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
            'page_title' => '<i class="fas fa-users-cog text-info mr-2"></i> Master Crew Database',
            'module_kode' => $this->module_kode,
            'navlink' => $this->module_kode,
            'group' => ['crewing'],
            'tmp' => $this->gHelp->tmp(),
            'dir_views' => $this->dir_view,
            'crud' => null,
            'breadcrumb' => [
                [
                    "name" => "Crewing",
                    "page" => "#",
                    "active" => ""
                ],
                [
                    "name" => "Master Crew",
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
            "selects" => "*",
            "type_id" => 1,
        ]);
        $queryString = http_build_query($payload);

        $path = $this->pathAPI . "?" . $queryString;
        $headers = $this->cH->headers3($this->module_kode);

        $builder = $this->cH->ummuGet($path, $headers);

        return $this->respond($builder, 200);
    }

    public function create()
    {
        $getVar = $this->request->getVar();

        $payload = $getVar;

        $params = [
            "path" => $this->pathAPI,
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
            "type_id" => 1,
            "name" => $this->request->getPost('name'),
            "from_id" => $this->request->getPost('from_id'),
            "to_id" => $this->request->getPost('to_id'),
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

    public function showCountry($id = null)
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
            "path"      => $this->pathAPI,
            "method" => 'GET',
            "payload" => $payload,
            "headers" => $this->cH->headers3($this->module_kode)
        ];

        $builder = $this->cH->ummu2($params);

        return $this->respond($builder, 200);
    }

    public function show_pelabuhan($id = null)
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
            "path"      => $this->pathAPI . '/show-pelabuhan',
            "method"    => 'GET',
            "payload"   => $payload,
            "headers"   => $this->cH->headers3($this->moduleKodeAPI)
        ];

        $builder = $this->cH->ummu2($params);

        return $this->respond($builder, 200);
    }

    public function show_tugboat()
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

        $path = $this->pathAPI . "/tugboat";
        $headers = $this->cH->headers3($this->module_kode);

        $builder = $this->cH->ummuGet($path, $headers);

        return $this->respond($builder, 200);
    }

    public function create_waypoint()
    {
        $payload = [
            "rute_id" => $this->request->getPost('rute_id'),
            "name" => $this->request->getPost('name'),
            "sequence" => $this->request->getPost('sequence'),

            "lintang_sudut" => $this->request->getPost('lintang_sudut'),
            "lintang_menit" => $this->request->getPost('lintang_menit'),
            "lintang_arah" => $this->request->getPost('lintang_arah'),

            "bujur_sudut" => $this->request->getPost('bujur_sudut'),
            "bujur_menit" => $this->request->getPost('bujur_menit'),
            "bujur_arah" => $this->request->getPost('bujur_arah'),

            "haluan" => $this->request->getPost('haluan'),
            "jarak_antar_titik" => $this->request->getPost('jarak'),
        ];

        $params = [
            "path" => $this->pathAPI . "/waypoint",
            "method" => 'POST',
            "payload" => $payload,
            "headers" => $this->cH->headers3($this->module_kode)
        ];

        $builder = $this->cH->ummu2($params);

        return $this->respond($builder, 200);
    }

    public function update_waypoint($id = null)
    {
        if ($id == null) {
            $id = $this->request->getVar('id');
        }

        $payload = [
            "rute_id" => $this->request->getVar('rute_id'),
            "name" => $this->request->getVar('name'),
            "sequence" => $this->request->getVar('sequence'),

            "lintang_sudut" => $this->request->getVar('lintang_sudut'),
            "lintang_menit" => $this->request->getVar('lintang_menit'),
            "lintang_arah" => $this->request->getVar('lintang_arah'),

            "bujur_sudut" => $this->request->getVar('bujur_sudut'),
            "bujur_menit" => $this->request->getVar('bujur_menit'),
            "bujur_arah" => $this->request->getVar('bujur_arah'),

            "haluan" => $this->request->getVar('haluan'),
            "jarak_antar_titik" => $this->request->getVar('jarak'),
            "total_jarak" => $this->request->getVar('total_jarak'),
        ];

        $params = [
            "path" => $this->pathAPI . "/waypoint/" . $id,
            "method" => 'PUT',
            "payload" => $payload,
            "headers" => $this->cH->headers3($this->module_kode)
        ];

        $builder = $this->cH->ummu2($params);

        return $this->respond($builder, 200);
    }

    public function delete_waypoint($id)
    {
        $params = [
            "path" => $this->pathAPI . "/waypoint/" . $id,
            "method" => 'DELETE',
            "payload" => [
                "rute_id" => $this->request->getVar('rute_id')
            ],
            "headers" => $this->cH->headers3($this->module_kode)
        ];

        $builder = $this->cH->ummu2($params);

        return $this->respond($builder, 200);
    }

    public function show_crew()
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

        $path = $this->pathAPI . "/crew";
        $headers = $this->cH->headers3($this->module_kode);

        $builder = $this->cH->ummuGet($path, $headers);

        return $this->respond($builder, 200);
    }

    public function show_crew_ranks()
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

        $path = $this->pathAPI . "/crew-rank";
        $headers = $this->cH->headers3($this->module_kode);

        $builder = $this->cH->ummuGet($path, $headers);

        return $this->respond($builder, 200);
    }
}
