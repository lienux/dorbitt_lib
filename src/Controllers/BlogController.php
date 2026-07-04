<?php

namespace Dorbitt\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\HTTP\IncomingRequest;
use Dorbitt\Helpers\CurlHelper;
use Dorbitt\Helpers\ViewsHelper;
use Dorbitt\Helpers\UmmuHelper;
use Dorbitt\Builder\BlogBuilder;

class BlogController extends ResourceController
{
    public function __construct()
    {
        $this->request = \Config\Services::request();
        $this->cH = new CurlHelper();
        $this->umHelp = new UmmuHelper();
        $this->vH = new ViewsHelper();
        $this->qBuilder = new BlogBuilder();
    }

    public function index($page = null)
    {
        // $appType = getenv('app.type');
        // $rdefault = getenv('app.rdefault');

        // $data = [
        //     "appType" => $appType
        // ];

        // if ($appType) {
        //     if ($page) {
        //         if ($page == 'projects') {
        //             $data['projects'] = $this->get_blog_projects();
        //         }

        //         return view($this->vH->ummuView($appType.'/frontend/pages/'.$page.'/index'), $data);
        //     }else{
        //         $data['activity'] = $this->get_blog_activity();
        //         return view($this->vH->ummuView($appType.'/frontend/pages/home/index'), $data);
        //     }
        //     // return $this->respond($data, 200);
        // }else{
        //     if ($rdefault) {
        //         return redirect()->to($rdefault);
        //     }else{
        //         return view($this->vH->ummuView("welcome_message")); 
        //     }
        // }
    }

    public function show_activity()
    {
        return $this->respond($this->qBuilder->get_activity(), 200);
    }

    public function show_projects()
    {
        return $this->respond($this->qBuilder->get_projects(), 200);
    }
}
