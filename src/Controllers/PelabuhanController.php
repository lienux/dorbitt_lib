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
        return view($this->vH->ummuView($this->dir_view . 'index'), $data);
    }

    // private function index_show()
    // {
    //     $params = [
    //         "path"      => "api/". $this->module_kode,
    //         "method" => 'GET',
    //         "payload" => [],
    //         "headers" => $this->cH->headers3($this->module_kode)
    //     ];

    //     $builder = $this->cH->ummu2($params);

    //     return $builder;
    // }

    // public function show_data()
    // {
    //     $params = [
    //         "path"      => "api/". $this->module_kode,
    //         "method" => 'GET',
    //         "payload" => [],
    //         "headers" => $this->cH->headers3($this->module_kode)
    //     ];

    //     $builder = $this->cH->ummu2($params);

    //     return $this->respond($builder, 200);
    // }

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
            "path"      => $this->pathAPI ."/show",
            "method" => 'GET',
            "payload" => $payload,
            "headers" => $this->cH->headers3($this->module_kode)
        ];

        $builder = $this->cH->ummu2($params);

        return $this->respond($builder, 200);
    }

    private function payload()
    {
        $type = $this->request->getVar("type");
        $kode = $this->request->getVar("kode");
        $name = $this->request->getVar("name");
        $flag_registry = $this->request->getVar("flag_registry");
        $classification = $this->request->getVar("classification");
        $yearBuild_place = $this->request->getVar("yearBuild_place");//
        $MainEngines = $this->request->getVar("MainEngines");
        $BrandMainEngines = $this->request->getVar("BrandMainEngines");
        $AuxiliaryEngines = $this->request->getVar("AuxiliaryEngines");
        $BrandAuxiliaryEngines = $this->request->getVar("BrandAuxiliaryEngines");
        $HorsePower = $this->request->getVar("HorsePower");
        $lightship = $this->request->getVar("lightship");
        $propulsion = $this->request->getVar("propulsion");
        $ServiceSpeed = $this->request->getVar("ServiceSpeed");//
        $fot = $this->request->getVar("fot");
        $fwt = $this->request->getVar("fwt");//
        $loa = $this->request->getVar("loa");
        $breadth = $this->request->getVar("breadth");
        $depth = $this->request->getVar("depth");
        $MaxDraft = $this->request->getVar("MaxDraft");
        $Sideboard = $this->request->getVar("Sideboard");
        $GrossTonnage = $this->request->getVar("GrossTonnage");
        $Deadweight = $this->request->getVar("Deadweight");
        $DeckStrength = $this->request->getVar("DeckStrength");
        $NetTonnage = $this->request->getVar("NetTonnage");//
        $fuelConsumtion_laden_river = $this->request->getVar("fuelConsumtion_laden_river");
        $fuelConsumtion_laden_sea = $this->request->getVar("fuelConsumtion_laden_sea");
        $fuelConsumtion_ballast_river = $this->request->getVar("fuelConsumtion_ballast_river");
        $fuelConsumtion_ballast_sea = $this->request->getVar("fuelConsumtion_ballast_sea");
        $fuelConsumtion_runningfree = $this->request->getVar("fuelConsumtion_runningfree");
        $fuelConsumtion_standby = $this->request->getVar("fuelConsumtion_standby");//
        $speed_laden_river = $this->request->getVar("speed_laden_river");
        $speed_laden_sea = $this->request->getVar("speed_laden_sea");
        $speed_ballast_river = $this->request->getVar("speed_ballast_river");
        $speed_ballast_sea = $this->request->getVar("speed_ballast_sea");
        $speed_runningfree = $this->request->getVar("speed_runningfree");

        $payload = [
            "type_id" => $type,
            "kode" => $kode,
            "name" => $name,
            "flag_registry" => $flag_registry,
            "classification" => $classification,
            "yearBuild_place" => $yearBuild_place,
            "MainEngines" => $MainEngines,
            "BrandMainEngines" => $BrandMainEngines,
            "AuxiliaryEngines" => $AuxiliaryEngines,
            "BrandAuxiliaryEngines" => $BrandAuxiliaryEngines,
            "HorsePower" => $HorsePower,
            "lightship" => $lightship,
            "propulsion" => $propulsion,
            "ServiceSpeed" => $ServiceSpeed,
            "fot" => $fot,
            "fwt" => $fwt,
            "loa" => $loa,
            "breadth" => $breadth,
            "depth" => $depth,
            "MaxDraft" => $MaxDraft,
            "Sideboard" => $Sideboard,
            "GrossTonnage" => $GrossTonnage,
            "Deadweight" => $Deadweight,
            "DeckStrength" => $DeckStrength,
            "NetTonnage" => $NetTonnage,
            "fuelConsumtion_laden_river" => $fuelConsumtion_laden_river,
            "fuelConsumtion_laden_sea" => $fuelConsumtion_laden_sea,
            "fuelConsumtion_ballast_river" => $fuelConsumtion_ballast_river,
            "fuelConsumtion_ballast_sea" => $fuelConsumtion_ballast_sea,
            "fuelConsumtion_runningfree" => $fuelConsumtion_runningfree,
            "fuelConsumtion_standby" => $fuelConsumtion_standby,
            "speed_laden_river" => $speed_laden_river,
            "speed_laden_sea" => $speed_laden_sea,
            "speed_ballast_river" => $speed_ballast_river,
            "speed_ballast_sea" => $speed_ballast_sea,
            "speed_runningfree" => $speed_runningfree,
        ];

        return $payload;
    }

    public function create()
    {
        $payload = $this->payload();

        $params = [
            "path"      => "api/". $this->module_kode ."/create",
            "method" => 'POST',
            "payload" => $payload,
            "headers" => $this->cH->headers3($this->module_kode)
        ];

        $builder = $this->cH->ummu2($params);

        return $this->respond($builder, 200);
    }

    public function update($id = null)
    {
        $payload = $this->payload();

        $params = [
            "path"      => "api/". $this->module_kode ."/update/" . $id,
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
            "path"      => "api/". $this->module_kode ."/delete/" . $id,
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

    public function showMsCost($id = null)
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
            "path"      => $this->pathAPI . '/show-ms-cost',
            "method" => 'GET',
            "payload" => $payload,
            "headers" => $this->cH->headers3($this->module_kode)
        ];

        $builder = $this->cH->ummu2($params);

        return $this->respond($builder, 200);
    }
}
