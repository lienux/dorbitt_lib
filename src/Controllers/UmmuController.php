<?php

namespace Dorbitt\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\HTTP\IncomingRequest;
use Dorbitt\Helpers\CurlHelper;
use Dorbitt\Helpers\ViewsHelper;

class UmmuController extends ResourceController
{
    public function __construct()
    {
        $this->request = \Config\Services::request();
        $this->cH = new CurlHelper();
        $this->vH = new ViewsHelper();
    }

    public function index()
    {
        $rdefault = getenv('app.rdefault');

        if ($rdefault) {
            return redirect()->to($rdefault);
        }else{
            return view($this->vH->ummuView("welcome_message")); 
        }
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
