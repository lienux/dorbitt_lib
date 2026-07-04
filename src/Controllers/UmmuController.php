<?php

namespace Dorbitt\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\HTTP\IncomingRequest;
use Dorbitt\Helpers\CurlHelper;
use Dorbitt\Helpers\ViewsHelper;
use Dorbitt\Helpers\UmmuHelper;
use Dorbitt\Builder\BlogBuilder;

class UmmuController extends ResourceController
{
    public function __construct()
    {
        $this->request = \Config\Services::request();
        $this->cH = new CurlHelper();
        $this->vH = new ViewsHelper();
        $this->umHelp = new UmmuHelper();
        $this->qBlog = new BlogBuilder();
    }

    public function index($page = null)
    {
        $appType = getenv('app.type');
        $rdefault = getenv('app.rdefault');

        $data = [
            "appType" => $appType
        ];

        if ($appType) {
            if ($page) {
                if ($page == 'projects') {
                    $data['projects'] = $this->qBlog->get_projects();
                }

                return view($this->vH->ummuView($appType.'/frontend/pages/'.$page.'/index'), $data);
            }else{
                $data['activity'] = $this->qBlog->get_activity();
                return view($this->vH->ummuView($appType.'/frontend/pages/home/index'), $data);
            }
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
}
