<?php

namespace Dorbitt\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\HTTP\IncomingRequest;
use Dorbitt\Helpers\CurlHelper;
use Dorbitt\Helpers\ViewsHelper;
use Dorbitt\Helpers\UmmuHelper;
use App\Helpers\GlobalHelper;
use Dorbitt\Helpers\FileHelper;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class NotificationController extends ResourceController
{
    protected $db;
    protected $dorbitt;
    protected $module_kode;
    protected $dir_view;
    protected $request;
    protected $cH;
    protected $gHelp;
    protected $vH;
    protected $umHelp;
    protected $fileH;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->dorbitt = \Config\Database::connect('dorbitt');
        $this->pathAPI = "api/notifications/";
        $this->module_kode = 'service_notification';
        $this->dir_view = 'pages/'. $this->module_kode .'/';
        $this->request = \Config\Services::request();
        $this->cH = new CurlHelper();
        $this->gHelp = new GlobalHelper();
        $this->vH = new ViewsHelper();
        $this->umHelp = new UmmuHelper();
        $this->fileH = new FileHelper();
    }

    public function index()
    {
        $timesheets = [];
        $show_ijo = [];
        $ijo_id = '';

        $filters = [
            'status' => $this->request->getGet('status'),
        ];

        $employee_id = session()->get('oa2_employee')->id;

        $data = [
            'page_title'    => '<i class="fas fa-users-cog text-info mr-2"></i> Notifications',
            'module_kode'   => $this->module_kode,
            'navlink'       => $this->module_kode,
            'group'         => ['system','service_notification'],
            'tmp'           => $this->gHelp->tmp(),
            'dir_views'     => $this->dir_view,
            'crud'          => null,
            'breadcrumb'    => [
                [
                    "name" => "System",
                    "page" => "#",
                    "active" => ""
                ],
                [
                    "name" => "Notifications",
                    "page" => "#",
                    "active" => "active"
                ]
            ],
            // 'pager'         => $this->timesheetModel->pager,
            'pager'         => [],
            'filters'       => $filters,
            'cuaca'         => $this->dorbitt->table('voyage_condition')->where('category', 'Cuaca')->get()->getResultArray()
        ];
        return view($this->vH->ummuViewPartialIndex(), $data);
    }

    public function show($id = null)
    {
        $type = $this->request->getGet('type');
        $is_read = $this->request->getGet('is_read');
        $search = $this->request->getGet('search');

        $payload = $this->umHelp->filter_payload();
        $payload = array_merge($payload, [
            "id"        => $id,
            // "date"      => [
            //     "from"  => $date_from,
            //     "to"    => $date_to
            // ],
            "selects" => "*",
            "type" => $type,
            "is_read" => $is_read,
            "search" => $search,
        ]);

        $urlParams = $this->cH->payload_http_build_query($payload);

        if ($id) {
            $path = "api/notifications/show/" . $id;
        }else{
            $path = "api/notifications?" . $urlParams;
        }

        $params = [
            "path"      => $path,
            "method"    => 'GET',
            "payload"   => [],
            "headers"   => $this->cH->headers3($this->module_kode)
        ];

        $builder = $this->cH->ummu2($params);
        // $builder = $params;

        return $this->respond($builder, 200);
    }

    public function count()
    {
        $payload = $this->umHelp->dt_payload2();
        $payload = array_merge($payload, [
            "selects"   => "*",
        ]);

        $urlParams = $this->cH->payload_http_build_query($payload);

        $path = "api/notifications/count?" . $urlParams;

        $params = [
            "path"      => $path,
            "method"    => 'GET',
            "payload"   => [],
            "headers"   => $this->cH->headers3($this->module_kode)
        ];

        $builder = $this->cH->ummu2($params);
        // $builder = $urlParams;

        return $this->respond($builder, 200);
    }

    public function read($id)
    {
        $payload = [];

        $params = [
            "path" => $this->pathAPI . "read/" . $id,
            "method" => 'POST',
            "payload" => $payload,
            "headers" => $this->cH->headers3($this->module_kode)
        ];

        $builder = $this->cH->ummu2($params);

        return $this->respond($builder, 200);
    }

    public function readAll()
    {
        $payload = [];

        $params = [
            "path" => $this->pathAPI . "read-all",
            "method" => 'POST',
            "payload" => $payload,
            "headers" => $this->cH->headers3($this->module_kode)
        ];

        $builder = $this->cH->ummu2($params);

        return $this->respond($builder, 200);
    }
}
