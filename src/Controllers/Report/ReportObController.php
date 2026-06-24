<?php

namespace Dorbitt\Controllers\Report;

use CodeIgniter\RESTful\ResourceController;
use App\Helpers\GlobalHelper;

class ReportObController extends ResourceController
{
    public $dir_view;
    public $dir_view2;
    public $db;
    public $mcp;
    public $gHelp;

    public function __construct()
    {
        $this->dir_view = 'pages/report/report_ob/';
        $this->db = \Config\Database::connect();
        $this->mcp = \Config\Database::connect('mcp');
        $this->request = \Config\Services::request();
        $this->gHelp = new GlobalHelper();
    }

    public function index()
    {
        $data = [
            'module_kode' => 'report_ob',
            'navlink' => 'report_ob',
            'group' => ['report_management', 'report_production'],
            'tmp' => $this->gHelp->tmp(),
            'dir_views' => $this->dir_view,
            'crud' => null,
            'breadcrumb' => [
                [
                    "name" => "MCP Report",
                    "page" => "#",
                    "active" => ""
                ],
                [
                    "name" => "Production",
                    "page" => "#",
                    "active" => ""
                ],
                [
                    "name" => "Overburden",
                    "page" => "#",
                    "active" => "active"
                ]
            ]
        ];
        return view($this->dir_view . 'index', $data);
    }

    public function show_hourly()
    {
        $tgl = $this->request->getVar('tgl'); 
        $site = $this->request->getVar('site');
    }
}