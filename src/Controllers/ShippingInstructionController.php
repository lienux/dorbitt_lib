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

class ShippingInstructionController extends ResourceController
{
    public function __construct()
    {
        $this->module_kode = 'shipping_instruction';
        $this->dir_view = 'pages/' . $this->module_kode . '/';
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
            'page_title' => 'Shipping Instruction',
            'module_kode' => $this->module_kode,
            'navlink' => $this->module_kode,
            'group' => ['marketing_sales'],
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
                    "name" => "Shipping Instruction",
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
            "path"      => "api/" . $this->module_kode . "/show",
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
            "tgl" => $this->request->getPost('tgl'),
            "number" => $this->request->getPost('number'),
            "client_id" => $this->request->getPost('client_id'),
            "tugboat_id" => $this->request->getPost('tugboat_id'),
            "barge_id" => $this->request->getPost('barge_id'),
            "load_type" => $this->request->getPost('load_type'),
            "qty" => $this->request->getPost('qty'),
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
            "path"      => "api/" . $this->module_kode . "/create",
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
            "tgl" => $this->request->getPost('tgl'),
            "number" => $this->request->getPost('number'),
            "client_id" => $this->request->getPost('client_id'),
            "tugboat_id" => $this->request->getPost('tugboat_id'),
            "barge_id" => $this->request->getPost('barge_id'),
            "load_type" => $this->request->getPost('load_type'),
            "qty" => $this->request->getPost('qty'),
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
            "path"      => "api/" . $this->module_kode . "/update/" . $id,
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
            "path"      => "api/" . $this->module_kode . "/delete/" . $id,
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
            "path"      => "api/" . $this->module_kode . "/show_clients",
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
            "path"      => "api/" . $this->module_kode . "/show_tugboat",
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
            "path"      => "api/" . $this->module_kode . "/show_barge",
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
            "path"      => "api/" . $this->module_kode . "/show_uom",
            "method" => 'GET',
            "payload" => $payload,
            "headers" => $this->cH->headers3($this->module_kode)
        ];

        $builder = $this->cH->ummu2($params);

        return $this->respond($builder, 200);
    }

    public function show_voyage_route($id = null)
    {
        $payload = $this->umHelp->dt_payload2();
        $payload = array_merge($payload, [
            "date" => [
                "from" => "",
                "to" => ""
            ],
            "selects" => "*",
            "type_id" => 1
        ]);

        $params = [
            "path"      => "api/" . $this->module_kode . "/show-rute",
            "method" => 'GET',
            "payload" => $payload,
            "headers" => $this->cH->headers3($this->module_kode)
        ];

        $builder = $this->cH->ummu2($params);

        return $this->respond($builder, 200);
    }
}
