<?php

namespace Dorbitt\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\HTTP\IncomingRequest;
use Dorbitt\Helpers\CurlHelper;
use Dorbitt\Helpers\ViewsHelper;
use Dorbitt\Helpers\UmmuHelper;

class UmmuController extends ResourceController
{
    public function __construct()
    {
        $this->request = \Config\Services::request();
        $this->cH = new CurlHelper();
        $this->vH = new ViewsHelper();
        $this->umHelp = new UmmuHelper();
    }

    public function index()
    {
        $appType = getenv('app.type');
        $rdefault = getenv('app.rdefault');

        $data = [
            "appType" => $appType
        ];

        if ($appType) {
            $data['page_title'] = 'Activity';
            $data['activity'] = $this->get_blog_activity();

            // return view($this->vH->ummuView($appType.'/frontend/layout/index'), $data);
            return view($this->vH->ummuView($appType.'/frontend/pages/home/index'), $data);
            // return $this->respond($data, 200);
        }else{
            if ($rdefault) {
                return redirect()->to($rdefault);
            }else{
                return view($this->vH->ummuView("welcome_message")); 
            }
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

    private function get_blog_activity()
    {
        $token = getenv('account.token');
        $path = "api/blog/activity";
        $headers = $this->cH->headers3_a("activity",$token);

        $reqHttp = $this->cH->ummuGet($path, $headers);

        return $reqHttp;
    }
}
