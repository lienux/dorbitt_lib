<?php

namespace Dorbitt\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\HTTP\IncomingRequest;
use Dorbitt\Helpers\CurlHelper;
use Dorbitt\Helpers\ViewsHelper;
use Dorbitt\Helpers\UmmuHelper;
use App\Helpers\GlobalHelper;
use Dorbitt\Helpers\FileHelper;

class FreightCharterController extends ResourceController
{
    public function __construct()
    {
        $this->module_kode = 'freight_charter';
        $this->dir_view = 'pages/freight_charter/';
        $this->request = \Config\Services::request();
        $this->cH = new CurlHelper();
        $this->db = \Config\Database::connect();
        $this->gHelp = new GlobalHelper();
        $this->vH = new ViewsHelper();
        $this->umHelp = new UmmuHelper();
        $this->fileH = new FileHelper();
    }

    public function index()
    {
        $data = [
            'page_title' => 'Surat Perjanjian Angkutan Laut (SPAL)',
            'module_kode' => $this->module_kode,
            'navlink' => $this->module_kode,
            'group' => ['marketing_sales','spal'],
            'tmp' => $this->gHelp->tmp(),
            'dir_views' => $this->dir_view,
            'crud' => null,
            'breadcrumb' => [
                [
                    "name" => "Marketing & Sales",
                    "page" => "#",
                    "active" => ""
                ],
                [
                    "name" => "Surat Perjanjian Angkutan Laut",
                    "page" => "#",
                    "active" => ""
                ],
                [
                    "name" => "Freight Charter",
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
            "selects" => "*",
            "where" => ["type_id", "1"]
        ]);

        $params = [
            "path"      => "api/spal/show",
            "method" => 'GET',
            "payload" => $payload,
            "headers" => $this->cH->headers3($this->module_kode)
        ];

        $builder = $this->cH->ummu2($params);

        return $this->respond($builder, 200);
    }

    public function create()
    {
        $upload = $this->fileH->file_update();

        $payload = [
            "type_id" => 1,
            "si_id" => $this->request->getPost('si_id'),
            "tgl" => $this->request->getPost('tgl_surat'),
            "number" => $this->request->getPost('nomor_surat'),
            "price" => str_replace(['.', ','], ['', '.'], $this->request->getPost('biaya_angkutan')),
            "kondisi_perjanjian" => $this->request->getPost('kondisi_perjanjian'),

            "client_id" => $this->request->getPost('client'),
            "tugboat_id" => $this->request->getPost('tugboat'),
            "barge_id" => $this->request->getPost('barge'),
            "load_type" => $this->request->getPost('load_type'),
            "qty" => str_replace(['.', ','], ['', '.'], $this->request->getPost('qty')),
            "uom_id" => $this->request->getPost('uom_id'),

            "loading_availability_date_from" => $this->request->getPost('loading_availability_date_from'),
            "loading_availability_date_to" => $this->request->getPost('loading_availability_date_to'),

            "loading_port" => $this->request->getPost('loading_port'),
            "discharge_port" => $this->request->getPost('discharge_port'),
        ];

        if ($upload) {
            $payload = array_merge($upload,$payload);
        }

        $params = [
            "path" => "api/spal/create",
            "method" => 'POST',
            "payload" => $payload,
            "headers" => $this->cH->headers3($this->module_kode)
        ];

        $builder = $this->cH->ummu2($params);

        return $this->respond($builder, 200);
    }

    public function update($id = null)
    {
        $upload = $this->fileH->file_update();

        $payload = [
            "si_id" => $this->request->getPost('si_id'),
            "tgl" => $this->request->getPost('tgl_surat'),
            "number" => $this->request->getPost('nomor_surat'),
            "price" => str_replace(['.', ','], ['', '.'], $this->request->getPost('biaya_angkutan')),
            "kondisi_perjanjian" => $this->request->getPost('kondisi_perjanjian'),

            "client_id" => $this->request->getPost('client'),
            "tugboat_id" => $this->request->getPost('tugboat'),
            "barge_id" => $this->request->getPost('barge'),
            "load_type" => $this->request->getPost('load_type'),
            "qty" => str_replace(['.', ','], ['', '.'], $this->request->getPost('qty')),
            "uom_id" => $this->request->getPost('uom_id'),

            "loading_availability_date_from" => $this->request->getPost('loading_availability_date_from'),
            "loading_availability_date_to" => $this->request->getPost('loading_availability_date_to'),

            "loading_port" => $this->request->getPost('loading_port'),
            "discharge_port" => $this->request->getPost('discharge_port'),
        ];

        if ($upload) {
            $payload = array_merge($upload,$payload);
        }

        $params = [
            "path"      => "api/spal/update/" . $id,
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
            "path"      => "api/spal/delete/" . $id,
            "method" => 'DELETE',
            "payload" => [],
            "headers" => $this->cH->headers3($this->module_kode)
        ];

        $builder = $this->cH->ummu2($params);

        return $this->respond($builder, 200);
    }

    public function show_clients($id = null)
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
            "path"      => "api/spal/show_clients",
            "method" => 'GET',
            "payload" => $payload,
            "headers" => $this->cH->headers3($this->module_kode)
        ];

        $builder = $this->cH->ummu2($params);

        return $this->respond($builder, 200);
    }

    public function show_tugboat($id = null)
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
            "path"      => "api/spal/show_tugboat",
            "method" => 'GET',
            "payload" => $payload,
            "headers" => $this->cH->headers3($this->module_kode)
        ];

        $builder = $this->cH->ummu2($params);

        return $this->respond($builder, 200);
    }

    public function show_barge($id = null)
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
            "path"      => "api/spal/show_barge",
            "method" => 'GET',
            "payload" => $payload,
            "headers" => $this->cH->headers3($this->module_kode)
        ];

        $builder = $this->cH->ummu2($params);

        return $this->respond($builder, 200);
    }

    public function show_uom($id = null)
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
            "path"      => "api/spal/show_uom",
            "method" => 'GET',
            "payload" => $payload,
            "headers" => $this->cH->headers3($this->module_kode)
        ];

        $builder = $this->cH->ummu2($params);

        return $this->respond($builder, 200);
    }

    public function show_si($id = null)
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
            "path"      => "api/spal/show_si",
            "method" => 'GET',
            "payload" => $payload,
            "headers" => $this->cH->headers3($this->module_kode)
        ];

        $builder = $this->cH->ummu2($params);

        return $this->respond($builder, 200);
    }
}
