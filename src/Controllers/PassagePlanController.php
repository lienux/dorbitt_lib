<?php

namespace Dorbitt\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\HTTP\IncomingRequest;
use App\Helpers\GlobalHelper;
use Dorbitt\Helpers\CurlHelper;
use Dorbitt\Helpers\ViewsHelper;

class PassagePlanController extends ResourceController
{
  public function __construct()
  {
    $this->dir_view = 'pages/passage_plan/';
    $this->request = \Config\Services::request();
    $this->cH = new CurlHelper();
    $this->db = \Config\Database::connect();
    $this->gHelp = new GlobalHelper();
    $this->vH = new ViewsHelper();
  }

  public function index()
  {
    $data = [
        'module_kode' => 'passage_plan',
        'navlink' => 'passage_plan',
        'group' => ['plan_setting'],
        'tmp' => $this->gHelp->tmp(),
        'dir_views' => $this->dir_view,
        'crud' => null,
        'breadcrumb' => [
            [
                "name" => "Plan Setting",
                "page" => "#",
                "active" => ""
            ],
            [
                "name" => "Passage Plan",
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

    // return json_decode($request, false);
    return $this->respond($request, 200);
  }
}
