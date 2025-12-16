<?php

namespace Dorbitt\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\HTTP\IncomingRequest;
// use CodeIgniter\Files\File;
// use CodeIgniter\HTTP\Files\UploadedFile;
// use App\Builder\Approval\ApprovalBuilder;
// use Dorbitt\GviewsHelper;
// use App\Helpers\GlobalHelper;
use Dorbitt\Helpers\CurlHelper;

class UmmuController extends ResourceController
{
  public function __construct()
  {
    // $this->syshab = \Config\Database::connect('syshab');
    // $this->dorbitt = new DorbitT();
    $this->request = \Config\Services::request();
    // $this->qbAppv = new ApprovalBuilder();
    // $this->gViews = new GviewsHelper();
    // $this->gHelp = new GlobalHelper();
    $this->cH = new CurlHelper();
  }

  public function index()
  {
    // 
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
