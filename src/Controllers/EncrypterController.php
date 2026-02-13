<?php

namespace Dorbitt\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\RESTful\ResourceController;
// use CodeIgniter\HTTP\IncomingRequest;
// use App\Helpers\GlobalHelper;
// use Dorbitt\Helpers\CurlHelper;
// use Dorbitt\Helpers\JwtHelper;

class EncrypterController extends ResourceController
{
    public function __construct()
    {
        // $this->dir_view = 'pages/plan_setting/passage_plan/';
        // $this->request = \Config\Services::request();
        // $this->cH = new CurlHelper();
        // $this->db = \Config\Database::connect();
        // $this->gHelp = new GlobalHelper();
        // $this->vH = new ViewsHelper();
    }

    public function index()
    {
    }

    public function generate_password()
    {
        return config('Ummu')->EncrHe('generate_password');
    }

    public function jwtEncrypt()
    {
        $data = $this->request->getJsonVar();
        // return config('Ummu')->jwtH('encrypt', $data);
        return $data;
    }
}
