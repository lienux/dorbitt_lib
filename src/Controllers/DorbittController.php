<?php

namespace Dorbitt\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\Files\File;
use CodeIgniter\HTTP\Files\UploadedFile;
use App\Builder\Approval\ApprovalBuilder;
use Dorbitt\GviewsHelper;
use App\Helpers\GlobalHelper;

class DorbittController extends ResourceController
{
  public function __construct()
  {
    // $this->syshab = \Config\Database::connect('syshab');
    // $this->dorbitt = new DorbitT();
    $this->request = \Config\Services::request();
    $this->qbAppv = new ApprovalBuilder();
    $this->gViews = new GviewsHelper();
    $this->gHelp = new GlobalHelper();
  }

  public function index()
  {
    $login_module = session()->get('login_module');
    $data = [
      'page_title' => 'Home',
      'navlink' => 'dashboard',
      // 'breadcrumb' => ['Inventory', 'User Request', 'Index'],
      // 'breadcrumb_active' => ['active', ''],
      // 'group' => null,
      // 'all_jumlah'        => $this->qbAppv->sum()
      'include' => [
        $this->gViews->modal_loader()
      ],
      'tmp' => $this->gHelp->tmp()
    ];

    if ($login_module === 'mcp') {
      $page = 'pages/dashboard/mcp_index';
    } else {
      $page = 'pages/dashboard/index';
    }

    return view($page, $data);
  }

  private function sum()
  {
    // 

  }

  public function approval_sum()
  {
    $data = $this->qbAppv->sum();

    return $this->respond($data, 200);
  }

  public function session_show()
  {
    echo "<pre>";
    var_dump(session()->get());
  }

  public function session_destroy()
  {
    session()->destroy();
    return redirect()->to('/auth');
  }


  public function hazard_report()
  {
    $data = [
      'page_title' => 'Dashboard Hazard Report',
      'navlink' => 'dashboard_hazardreport',
      // 'breadcrumb' => ['Inventory', 'User Request', 'Index'],
      // 'breadcrumb_active' => ['active', ''],
      'group' => ["dashboard"],
      // 'all_jumlah'        => $this->qbAppv->sum()
      // 'include' => [
      //   $this->gViews->modal_loader()
      // ],
      'tmp' => $this->gHelp->tmp()
    ];

    return view('pages/dashboard/hazard_report/index', $data);
  }
}
