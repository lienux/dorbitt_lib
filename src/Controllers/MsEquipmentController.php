<?php

namespace Dorbitt\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\HTTP\IncomingRequest;
use Dorbitt\Helpers\CurlHelper;
use Dorbitt\Helpers\ViewsHelper;
use Dorbitt\Helpers\UmmuHelper;
use App\Helpers\GlobalHelper;

class MsEquipmentController extends ResourceController
{
    public function __construct()
    {
        $this->dir_view = 'pages/ms_equipment/';
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
            'page_title' => 'Master Data Equipment',
            'module_kode' => 'equipment',
            'navlink' => 'equipment',
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
                    "name" => "Equipment",
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
            "path"      => "api/equipment/show",
            "method" => 'GET',
            "payload" => $payload,
            "headers" => $this->cH->headers3('equipment')
        ];

        $builder = $this->cH->ummu2($params);

        return $this->respond($builder, 200);
    }

    public function create()
    {
        $category_id = $this->request->getVar('category');
        $kode = $this->request->getVar('kode');
        $name = $this->request->getVar('name');
        $model = $this->request->getVar('model');
        $serial_number = $this->request->getVar('serial_number');
        $manufacturer = $this->request->getVar('manufacturer');
        $maintenance_schedule = $this->request->getVar('maintenance_schedule');
        $criticality_level = $this->request->getVar('criticality_level');
        $location_id = $this->request->getVar('location');
        $description = $this->request->getVar('description');

        $payload = [
            "name" => $name,
            // "model" => $model,
            // "serial_number" => $serial_number,
            // "manufacturer" => $manufacturer,
            // "maintenance_schedule" => $maintenance_schedule,
            // "criticality_level" => $criticality_level,
            // "location" => $location_id,
            "description" => $description,
        ];

        $params = [
            "path"      => "api/equipment/create",
            "method" => 'POST',
            "payload" => $payload,
            "headers" => $this->cH->headers3('equipment')
        ];

        $builder = $this->cH->ummu2($params);

        return $this->respond($builder, 200);
    }

    public function update($id = null)
    {
        $name = $this->request->getVar('name');
        $description = $this->request->getVar('description');

        $payload = [
            "name" => $name,
            "description" => $description,
        ];

        $params = [
            "path"      => "api/equipment/update/" . $id,
            "method" => 'PUT',
            "payload" => $payload,
            "headers" => $this->cH->headers3('equipment')
        ];

        $builder = $this->cH->ummu2($params);

        return $this->respond($builder, 200);
    }

    public function delete($id = null)
    {
        $params = [
            "path"      => "api/equipment/delete/" . $id,
            "method" => 'DELETE',
            "payload" => [],
            "headers" => $this->cH->headers3('equipment')
        ];

        $builder = $this->cH->ummu2($params);

        return $this->respond($builder, 200);
    }
}
