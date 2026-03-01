<?php

namespace Dorbitt\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\HTTP\IncomingRequest;
use Dorbitt\Helpers\CurlHelper;
use Dorbitt\Helpers\ViewsHelper;
use Dorbitt\Helpers\UmmuHelper;
use App\Helpers\GlobalHelper;

class TugboatController extends ResourceController
{
    public function __construct()
    {
        $this->dir_view = 'pages/tugboat/';
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
            'page_title' => 'Master Data Tugboat',
            'module_kode' => 'tugboat',
            'navlink' => 'tugboat',
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
                    "name" => "Tugboat",
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
            "path"      => "api/tugboat/show",
            "method" => 'GET',
            "payload" => $payload,
            "headers" => $this->cH->headers3('tugboat')
        ];

        $builder = $this->cH->ummu2($params);

        return $this->respond($builder, 200);
    }

    public function create()
    {
        $kode = $this->request->getVar('kode');
        $name = $this->request->getVar('name');
        $nome = $this->request->getVar('nome');
        $hp = $this->request->getVar('hp');
        $lightship = $this->request->getVar('lightship');
        $capacity = $this->request->getVar('capacity');
        // $client_id = $this->request->getVar('client_id');
        $laden_river_speed = $this->request->getVar('laden_river_speed');
        $laden_river_fuelcons = $this->request->getVar('laden_river_fuelcons');
        $laden_sea_speed = $this->request->getVar('laden_sea_speed');
        $laden_sea_fuelcons = $this->request->getVar('laden_sea_fuelcons');
        $ballast_river_speed = $this->request->getVar('ballast_river_speed');
        $ballast_river_fuelcons = $this->request->getVar('ballast_river_fuelcons');
        $ballast_sea_speed = $this->request->getVar('ballast_sea_speed');
        $ballast_sea_fuelcons = $this->request->getVar('ballast_sea_fuelcons');
        $stby_fuelcons = $this->request->getVar('stby_fuelcons');
        $runningfree_speed = $this->request->getVar('runningfree_speed');
        $runningfree_cons = $this->request->getVar('runningfree_cons');

        $payload = [
            "kode" => $kode,
            "name" => $name,
            "nome" => $nome,
            "hp" => $hp,
            "lightship" => $lightship,
            "capacity" => $capacity,
            // "client_id" => $client_id,
            "laden_river_speed" => $laden_river_speed,
            "laden_river_fuelcons" => $laden_river_fuelcons,
            "laden_sea_speed" => $laden_sea_speed,
            "laden_sea_fuelcons" => $laden_sea_fuelcons,
            "ballast_river_speed" => $ballast_river_speed,
            "ballast_river_fuelcons" => $ballast_river_fuelcons,
            "ballast_sea_speed" => $ballast_sea_speed,
            "ballast_sea_fuelcons" => $ballast_sea_fuelcons,
            "stby_fuelcons" => $stby_fuelcons,
            "runningfree_speed" => $runningfree_speed,
            "runningfree_cons" => $runningfree_cons,
        ];

        $params = [
            "path"      => "api/tugboat/create",
            "method" => 'POST',
            "payload" => $payload,
            "headers" => $this->cH->headers3('tugboat')
        ];

        $builder = $this->cH->ummu2($params);

        return $this->respond($builder, 200);
    }

    public function update($id = null)
    {
        $kode = $this->request->getVar('kode');
        $name = $this->request->getVar('name');
        $nome = $this->request->getVar('nome');
        $hp = $this->request->getVar('hp');
        $lightship = $this->request->getVar('lightship');
        $capacity = $this->request->getVar('capacity');
        // $client_id = $this->request->getVar('client_id');
        $laden_river_speed = $this->request->getVar('laden_river_speed');
        $laden_river_fuelcons = $this->request->getVar('laden_river_fuelcons');
        $laden_sea_speed = $this->request->getVar('laden_sea_speed');
        $laden_sea_fuelcons = $this->request->getVar('laden_sea_fuelcons');
        $ballast_river_speed = $this->request->getVar('ballast_river_speed');
        $ballast_river_fuelcons = $this->request->getVar('ballast_river_fuelcons');
        $ballast_sea_speed = $this->request->getVar('ballast_sea_speed');
        $ballast_sea_fuelcons = $this->request->getVar('ballast_sea_fuelcons');
        $stby_fuelcons = $this->request->getVar('stby_fuelcons');
        $runningfree_speed = $this->request->getVar('runningfree_speed');
        $runningfree_cons = $this->request->getVar('runningfree_cons');

        $payload = [
            "kode" => $kode,
            "name" => $name,
            "nome" => $nome,
            "hp" => $hp,
            "lightship" => $lightship,
            "capacity" => $capacity,
            // "client_id" => $client_id,
            "laden_river_speed" => $laden_river_speed,
            "laden_river_fuelcons" => $laden_river_fuelcons,
            "laden_sea_speed" => $laden_sea_speed,
            "laden_sea_fuelcons" => $laden_sea_fuelcons,
            "ballast_river_speed" => $ballast_river_speed,
            "ballast_river_fuelcons" => $ballast_river_fuelcons,
            "ballast_sea_speed" => $ballast_sea_speed,
            "ballast_sea_fuelcons" => $ballast_sea_fuelcons,
            "stby_fuelcons" => $stby_fuelcons,
            "runningfree_speed" => $runningfree_speed,
            "runningfree_cons" => $runningfree_cons,
        ];

        $params = [
            "path"      => "api/tugboat/update/" . $id,
            "method" => 'PUT',
            "payload" => $payload,
            "headers" => $this->cH->headers3('tugboat')
        ];

        $builder = $this->cH->ummu2($params);

        return $this->respond($builder, 200);
    }

    public function delete($id = null)
    {
        $params = [
            "path"      => "api/tugboat/delete/" . $id,
            "method" => 'DELETE',
            "payload" => [],
            "headers" => $this->cH->headers3('tugboat')
        ];

        $builder = $this->cH->ummu2($params);

        return $this->respond($builder, 200);
    }
}
