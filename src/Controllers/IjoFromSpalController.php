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

class IjoFromSpalController extends ResourceController
{
    public function __construct()
    {
        $this->module_kode = 'ijo_from_spal';
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
            'page_title' => 'Internal Job Order',
            'module_kode' => $this->module_kode,
            'navlink' => $this->module_kode,
            'group' => ['marketing_sales','ijo'],
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
                    "name" => "IJO",
                    "page" => "#",
                    "active" => ""
                ],
                [
                    "name" => "IJO from SPAL",
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
            "path"      => "api/ijo/show",
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
            "spal_id" => $this->request->getPost('spal_id'),
            "spal_number" => $this->request->getPost('spal_number'),
            "tgl" => $this->request->getPost('tgl'),
            "number" => $this->request->getPost('number'),
            "from_dept_id" => $this->request->getPost('from_dept_id'),
            "to_dept_id" => $this->request->getPost('to_dept_id'),

            "client_id" => $this->request->getPost("client_id"),
            "tugboat_id" => $this->request->getPost("tugboat_id"),
            "barge_id" => $this->request->getPost("barge_id"),
            "barge_loa" => $this->request->getPost("barge_loa"),
            "qty" => $this->request->getPost("tonnage"),
            "uom_id" => $this->request->getPost("uom_id"),

            "eta_loading_port" => $this->request->getPost("eta_loading_port"),
            "eta_loading_port_to" => $this->request->getPost("eta_loading_port_to"),
            "eta_discharge_port" => $this->request->getPost("eta_discharge_port"),
            
            "loading_port" => $this->request->getPost("loading_port"),
            "discharge_port" => $this->request->getPost("discharge_port"),
        ];

        $params = [
            "path"      => "api/ijo/create",
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
            "spal_id" => $this->request->getPost('spal_id'),
            "spal_number" => $this->request->getPost('spal_number'),
            "tgl" => $this->request->getPost('tgl'),
            "number" => $this->request->getPost('number'),
            "from_dept_id" => $this->request->getPost('from_dept_id'),
            "to_dept_id" => $this->request->getPost('to_dept_id'),

            "client_id" => $this->request->getPost("client_id"),
            "tugboat_id" => $this->request->getPost("tugboat_id"),
            "barge_id" => $this->request->getPost("barge_id"),
            "barge_loa" => $this->request->getPost("barge_loa"),
            "qty" => $this->request->getPost("tonnage"),
            "uom_id" => $this->request->getPost("uom_id"),

            "eta_loading_port" => $this->request->getPost("eta_loading_port"),
            "eta_loading_port_to" => $this->request->getPost("eta_loading_port_to"),
            "eta_discharge_port" => $this->request->getPost("eta_discharge_port"),
            
            "loading_port" => $this->request->getPost("loading_port"),
            "discharge_port" => $this->request->getPost("discharge_port"),
        ];

        $params = [
            "path"      => "api/ijo/update/" . $id,
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
            "path"      => "api/ijo/delete/" . $id,
            "method" => 'DELETE',
            "payload" => [],
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
            "path"      => "api/ijo/show_si",
            "method" => 'GET',
            "payload" => $payload,
            "headers" => $this->cH->headers3($this->module_kode)
        ];

        $builder = $this->cH->ummu2($params);

        return $this->respond($builder, 200);
    }

    public function show_spal()
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
            "path"      => "api/ijo/show_spal",
            "method" => 'GET',
            "payload" => $payload,
            "headers" => $this->cH->headers3($this->module_kode)
        ];

        $builder = $this->cH->ummu2($params);

        return $this->respond($builder, 200);
    }

    public function show_dept()
    {
        $params = [
            "path"      => "api/ijo/show_dept",
            "method" => 'GET',
            "payload" => [],
            "headers" => $this->cH->headers3($this->module_kode)
        ];

        $builder = $this->cH->ummu2($params);

        return $this->respond($builder, 200);
    }

    public function release($id)
    {
        $params = [
            "path"      => "api/ijo/release/" . $id,
            "method" => 'PUT',
            "payload" => [],
            "headers" => $this->cH->headers3($this->module_kode)
        ];

        $builder = $this->cH->ummu2($params);

        return $this->respond($builder, 200);
    }
}
