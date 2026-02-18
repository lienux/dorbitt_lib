<?php

namespace Dorbitt\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\HTTP\IncomingRequest;
use App\Helpers\GlobalHelper;
use Dorbitt\Helpers\CurlHelper;
use Dorbitt\Helpers\ViewsHelper;

class BargeInspectionController extends ResourceController
{
    public function __construct()
    {
        $this->dir_view = 'pages/barge_inspection_checklist/';
        $this->request = \Config\Services::request();
        $this->cH = new CurlHelper();
        $this->db = \Config\Database::connect();
        $this->gHelp = new GlobalHelper();
        $this->vH = new ViewsHelper();
    }

    public function index()
    {
        $data = [
            'module_kode' => 'barge_inspection_checklist',
            'navlink' => 'barge_inspection_checklist',
            'group' => ['applications'],
            'tmp' => $this->gHelp->tmp(),
            'dir_views' => $this->dir_view,
            'crud' => null,
            'breadcrumb' => [
                [
                    "name" => "Application",
                    "page" => "#",
                    "active" => ""
                ],
                [
                    "name" => "Barge Inspection Checklist",
                    "page" => "#",
                    "active" => "active"
                ]
            ]
        ];
        return view($this->vH->ummuView($this->dir_view . 'index'), $data);
    }

    public function company_profile()
    {
        $params = [
            "path"      => "company_profile",
            "method"    => "GET",
            "payload"   => [],
            "headers"   => array(
                'Content-Type: application/json',
                'Company-Token: '.getenv('app.company_token')
            )
        ];

        $request = $this->cH->ummu2($params);

        return $this->respond($request, 200);
    }
}
