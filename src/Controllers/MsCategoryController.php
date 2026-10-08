<?php

namespace Dorbitt\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\HTTP\IncomingRequest;
use Dorbitt\Helpers\CurlHelper;
use Dorbitt\Helpers\ViewsHelper;
use Dorbitt\Helpers\UmmuHelper;
use App\Helpers\GlobalHelper;

class MsCategoryController extends ResourceController
{
    protected $module_kode;
    protected $dir_view;
    protected $request;
    protected $cH;
    protected $db;
    protected $gHelp;
    protected $vH;
    protected $umHelp;
    protected $bCategory;

    public function __construct()
    {
        $this->module_kode = 'ms_category';
        $this->dir_view = 'pages/'.$this->module_kode.'/';
        $this->request = \Config\Services::request();
        $this->cH = new CurlHelper();
        $this->db = \Config\Database::connect();
        $this->gHelp = new GlobalHelper();
        $this->vH = new ViewsHelper();
        $this->umHelp = new UmmuHelper();
    }

    public function index()
    {
        $data = [
            'page_title' => 'Master Category',
            'module_kode' => $this->module_kode,
            'navlink' => $this->module_kode,
            'group' => ['config'],
            'tmp' => $this->gHelp->tmp(),
            'dir_views' => $this->dir_view,
            'crud' => null,
            'breadcrumb' => [
                [
                    "name" => "Config",
                    "page" => "#",
                    "active" => ""
                ],
                [
                    "name" => "Category List",
                    "page" => "#",
                    "active" => "active"
                ]
            ]
        ];
        return view($this->vH->ummuViewPartialIndex(), $data);
    }

    public function show($id = null)
    {
        $payload = $this->umHelp->dt_payload2();
        $payload = array_merge($payload, [
            "date" => [
                "from" => "",
                "to" => ""
            ],
            "selects" => "*"
        ]);

        $params = [
            "path"      => "api/master-data/category",
            "method" => 'GET',
            "payload" => $payload,
            "headers" => $this->cH->headers3('ms_category')
        ];

        $builder = $this->cH->ummu2($params);

        return $this->respond($builder, 200);
    }

    public function create()
    {
        $domain_id = $this->request->getVar('domain_id');
        $kode = $this->request->getVar('kode');
        $name = $this->request->getVar('name');
        $description = $this->request->getVar('description');
        $category_id = $this->request->getVar('category_id');
        $tcode_id = $this->request->getVar('tcode_id');
        $responsibility_id = $this->request->getVar('responsibility_id');

        $payload = [
            "domain_id" => $domain_id,
            "kode" => $kode,
            "name" => $name,
            "description" => $description,
            "category_id" => $category_id,
            "tcode_id" => $tcode_id,
            "responsibility_id" => $responsibility_id,
        ];

        $params = [
            "path"      => "api/master-data/activity",
            "method" => 'POST',
            "payload" => $payload,
            "headers" => $this->cH->headers3('ms_activity')
        ];

        $builder = $this->cH->ummu2($params);

        return $this->respond($builder, 200);
    }

    public function update($id = null)
    {
        $domain_id = $this->request->getVar('domain_id');
        $kode = $this->request->getVar('kode');
        $name = $this->request->getVar('name');
        $description = $this->request->getVar('description');
        $category_id = $this->request->getVar('category_id');
        $tcode_id = $this->request->getVar('tcode_id');
        $responsibility_id = $this->request->getVar('responsibility_id');

        $payload = [
            "domain_id" => $domain_id,
            "kode" => $kode,
            "name" => $name,
            "description" => $description,
            "category_id" => $category_id,
            "tcode_id" => $tcode_id,
            "responsibility_id" => $responsibility_id,
        ];

        $params = [
            "path"      => "api/master-data/activity/" . $id,
            "method" => 'PUT',
            "payload" => $payload,
            "headers" => $this->cH->headers3('ms_activity')
        ];

        $builder = $this->cH->ummu2($params);

        return $this->respond($builder, 200);
    }

    public function delete($id = null)
    {
        $params = [
            "path"      => "api/master-data/activity/" . $id,
            "method" => 'DELETE',
            "payload" => [],
            "headers" => $this->cH->headers3('ms_activity')
        ];

        $builder = $this->cH->ummu2($params);

        return $this->respond($builder, 200);
    }

    public function category()
    {
        $payload = $this->umHelp->dt_payload2();
        $payload = array_merge($payload, [
            "date" => [
                "from" => "",
                "to" => ""
            ],
            "selects" => "*"
        ]);

        $params = [
            "path"      => "api/master-data/activity/category",
            "method" => 'GET',
            "payload" => $payload,
            "headers" => $this->cH->headers3($this->module_kode)
        ];

        $builder = $this->cH->ummu2($params);

        return $this->respond($builder, 200);
    }

    public function tcode()
    {
        $payload = $this->umHelp->dt_payload2();
        $payload = array_merge($payload, [
            "date" => [
                "from" => "",
                "to" => ""
            ],
            "selects" => "*"
        ]);

        $params = [
            "path"      => "api/master-data/activity/tcode",
            "method" => 'GET',
            "payload" => $payload,
            "headers" => $this->cH->headers3($this->module_kode)
        ];

        $builder = $this->cH->ummu2($params);

        return $this->respond($builder, 200);
    }

    public function responsibility()
    {
        $payload = $this->umHelp->dt_payload2();
        $payload = array_merge($payload, [
            "date" => [
                "from" => "",
                "to" => ""
            ],
            "selects" => "*"
        ]);

        $params = [
            "path"      => "api/master-data/activity/responsibility",
            "method" => 'GET',
            "payload" => $payload,
            "headers" => $this->cH->headers3($this->module_kode)
        ];

        $builder = $this->cH->ummu2($params);

        return $this->respond($builder, 200);
    }

    public function domains()
    {
        $payload = $this->umHelp->dt_payload2();
        $payload = array_merge($payload, [
            "date" => [
                "from" => "",
                "to" => ""
            ],
            "selects" => "*"
        ]);

        $params = [
            "path"      => "api/master-data/activity/domains",
            "method" => 'GET',
            "payload" => $payload,
            "headers" => $this->cH->headers3($this->module_kode)
        ];

        $builder = $this->cH->ummu2($params);

        return $this->respond($builder, 200);
    }
}
