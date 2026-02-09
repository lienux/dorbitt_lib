<?php

namespace Dorbitt\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\HTTP\IncomingRequest;
// use CodeIgniter\Files\File;
// use CodeIgniter\HTTP\Files\UploadedFile;
// use App\Builder\Approval\ApprovalBuilder;
// use Dorbitt\GviewsHelper;
use Dorbitt\Helpers\CurlHelper;
// use App\Helpers\GlobalHelper;

class ConfigController extends ResourceController
{
    public function __construct()
    {
        // $this->syshab = \Config\Database::connect('syshab');
        // $this->dorbitt = new DorbitT();
        $this->request = \Config\Services::request();
        // $this->qbAppv = new ApprovalBuilder();
        // $this->gViews = new GviewsHelper();
        $this->cH = new CurlHelper();
        // $this->gHelp = new GlobalHelper();
    }

    public function show_hierarchy_modules()
    {
        $params = [
            "path"      => "api/config/account_access/show_hierarchy_modules",
            "method"    => "GET",
            "payload"   => [],
            "headers"   => array(
                'Content-Type: application/json',
                'Company-Token: '.getenv('company_token'),
                'Module-Code: config_account_access',
                'Authorization: Bearer ' . session()->get('token')
            )
        ];

        $response = $this->cH->ummu2_v1_20250704($params);

        return $this->respond($response, 200);
        // var_dump($response);
    }
}
