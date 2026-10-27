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

class TimeSheetController extends ResourceController
{
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->module_kode = 'time_sheet';
        $this->dir_view = 'pages/'. $this->module_kode .'/';
        $this->request = \Config\Services::request();
        $this->cH = new CurlHelper();
        $this->db = \Config\Database::connect();
        $this->gHelp = new GlobalHelper();
        $this->vH = new ViewsHelper();
        $this->umHelp = new UmmuHelper();
        $this->fileH = new FileHelper();
    }

    public function index()
    {
        // $crew = session()->get('crew');
        $timesheets = [];
        $show_ijo = [];
        $ijo_id = '';

        // // Cek position_id (harus 105 = Kapten)
        // if (!$crew || $this->jabatan_id != 105) {
        //     // return redirect()->to('/')->with('error', 'Hanya Kapten yang bisa input timesheet.');

        // }

        // // Jika jabatannya adalah Crew
        // if ($this->jabatan_id == getenv('crewing.jabatan_id')) {
        //     // Jika Rank nya adalah Kapten
        //     // if (session()->get('crew')->base_rank_id == '1') {
        //     //     // code...
        //     // }
        // }

        // if (!$crew) {
        //     // return redirect()->to('/')->with('error', 'Hanya Kapten yang bisa input timesheet.');
        //     $show_ijo = $this->dorbitt->table('ijo a')
        //         ->select(implode(',', [
        //             "a.*",
        //             "b.name as tugboat_name",
        //         ]))
        //         ->join('vessel b', 'b.id = a.tugboat_id', 'left')
        //         ->whereIn('a.is_release', [2,3])
        //         ->get()
        //         ->getResultArray()
        //     ;
        // }

        // Cek IJO aktif (status_id 2 atau 3)
        // $ijo_status_id = isset($crew->ijo_status_id) ? $crew->ijo_status_id : '';
        // $ijoActive = in_array($ijo_status_id, ['1', '2', '3']);

        // List timesheet milik crew ini
        $filters = [
            'status' => $this->request->getGet('status'),
        ];

        $employee_id = session()->get('oa2_employee')->id;
        // $show_meCrew = $this->builder_get_crewDetail($employee_id)->get()->getFirstRow();
        // $crew_assignment = $this->dorbitt->table('crew_assignment')
        //     ->where('employee_id', $employee_id)
        //     ->get()
        //     ->getRow()
        // ;

        // $vessel_id = ($crew_assignment) ? $crew_assignment->vessel_id : null;

        // $show_myIjo = $this->builder_get_ijo($vessel_id)->get()->getFirstRow();

        // $ijo_id = $show_myIjo->id;
        // $timesheets = $this->timesheetModel->getListByIjo($ijo_id, $filters, 10);

        // $data = [
        //     'vessel_id'     => $vessel_id,
        //     'employee_id'   => $employee_id,
        //     'crew'          => $show_meCrew,
        //     'ijo_id'        => $ijo_id,
        //     'show_myIjo'    => $show_myIjo,
        //     'ijoActive'     => $ijoActive,
        //     'timesheets'    => $timesheets,
        //     'pager'         => $this->timesheetModel->pager,
        //     'filters'       => $filters,
        //     'kondisi_cuaca' => $this->list_cuaca()
        // ];

        // $data = [
        //     'page_title' => 'Daily Record - Time Sheet',
        //     'module_kode' => $this->module_kode,
        //     'navlink' => $this->module_kode,
        //     'group' => ['operations','time_sheet'],
        //     'tmp' => $this->gHelp->tmp(),
        //     'dir_views' => $this->dir_view,
        //     'crud' => null,
        //     'breadcrumb' => [
        //         [
        //             "name" => "Operations",
        //             "page" => "#",
        //             "active" => ""
        //         ],
        //         [
        //             "name" => "Time Sheet",
        //             "page" => "#",
        //             "active" => "active"
        //         ]
        //     ]
        // ];
        // return view($this->vH->ummuView($this->dir_view . 'index'), $data);

        $data = [
            'page_title' => '<i class="fas fa-users-cog text-info mr-2"></i> Time Sheet',
            'module_kode' => $this->module_kode,
            'navlink' => $this->module_kode,
            'group' => ['operations','time_sheet'],
            'tmp' => $this->gHelp->tmp(),
            'dir_views' => $this->dir_view,
            'crud' => null,
            'breadcrumb' => [
                [
                    "name" => "Operations",
                    "page" => "#",
                    "active" => ""
                ],
                [
                    "name" => "Time Sheet",
                    "page" => "#",
                    "active" => "active"
                ]
            ],
            // 'pager'         => $this->timesheetModel->pager,
            'pager'         => [],
            'filters'       => $filters,
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
            "selects" => "*",
            // "where" => ["type_id", "1"]
        ]);

        $params = [
            "path"      => "api/time_sheet?ijo_id=",
            "method" => 'GET',
            "payload" => $payload,
            "headers" => $this->cH->headers3($this->module_kode)
        ];

        $builder = $this->cH->ummu2($params);

        return $this->respond($builder, 200);
    }

    public function create()
    {
        $upload = $this->fileH->file_update();

        $payload = [
            "type_id" => 1,
            "si_id" => $this->request->getPost('si_id'),
            "tgl" => $this->request->getPost('tgl_surat'),
            "number" => $this->request->getPost('nomor_surat'),
            "price" => str_replace(['.', ','], ['', '.'], $this->request->getPost('biaya_angkutan')),
            "kondisi_perjanjian" => $this->request->getPost('kondisi_perjanjian'),

            "client_id" => $this->request->getPost('client'),
            "tugboat_id" => $this->request->getPost('tugboat'),
            "barge_id" => $this->request->getPost('barge'),
            "load_type" => $this->request->getPost('load_type'),
            "qty" => str_replace(['.', ','], ['', '.'], $this->request->getPost('qty')),
            "uom_id" => $this->request->getPost('uom_id'),

            "loading_availability_date_from" => $this->request->getPost('loading_availability_date_from'),
            "loading_availability_date_to" => $this->request->getPost('loading_availability_date_to'),

            "loading_port" => $this->request->getPost('loading_port'),
            "discharge_port" => $this->request->getPost('discharge_port'),
        ];

        if ($upload) {
            $payload = array_merge($upload,$payload);
        }

        $params = [
            "path" => "api/spal/create",
            "method" => 'POST',
            "payload" => $payload,
            "headers" => $this->cH->headers3($this->module_kode)
        ];

        $builder = $this->cH->ummu2($params);

        return $this->respond($builder, 200);
    }

    public function update($id = null)
    {
        $upload = $this->fileH->file_update();

        $payload = [
            "si_id" => $this->request->getPost('si_id'),
            "tgl" => $this->request->getPost('tgl_surat'),
            "number" => $this->request->getPost('nomor_surat'),
            "price" => str_replace(['.', ','], ['', '.'], $this->request->getPost('biaya_angkutan')),
            "kondisi_perjanjian" => $this->request->getPost('kondisi_perjanjian'),

            "client_id" => $this->request->getPost('client'),
            "tugboat_id" => $this->request->getPost('tugboat'),
            "barge_id" => $this->request->getPost('barge'),
            "load_type" => $this->request->getPost('load_type'),
            "qty" => str_replace(['.', ','], ['', '.'], $this->request->getPost('qty')),
            "uom_id" => $this->request->getPost('uom_id'),

            "loading_availability_date_from" => $this->request->getPost('loading_availability_date_from'),
            "loading_availability_date_to" => $this->request->getPost('loading_availability_date_to'),

            "loading_port" => $this->request->getPost('loading_port'),
            "discharge_port" => $this->request->getPost('discharge_port'),
        ];

        if ($upload) {
            $payload = array_merge($upload,$payload);
        }

        $params = [
            "path"      => "api/spal/update/" . $id,
            "method" => 'PUT',
            "payload" => $payload,
            "headers" => $this->cH->headers3($this->module_kode)
        ];

        $builder = $this->cH->ummu2($params);

        return $this->respond($builder, 200);
    }

    public function delete($id = null)
    {
        $params = [
            "path"      => "api/spal/delete/" . $id,
            "method" => 'DELETE',
            "payload" => [],
            "headers" => $this->cH->headers3($this->module_kode)
        ];

        $builder = $this->cH->ummu2($params);

        return $this->respond($builder, 200);
    }

    public function show_clients($id = null)
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
            "path"      => "api/spal/show_clients",
            "method" => 'GET',
            "payload" => $payload,
            "headers" => $this->cH->headers3($this->module_kode)
        ];

        $builder = $this->cH->ummu2($params);

        return $this->respond($builder, 200);
    }

    public function show_tugboat($id = null)
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
            "path"      => "api/spal/show_tugboat",
            "method" => 'GET',
            "payload" => $payload,
            "headers" => $this->cH->headers3($this->module_kode)
        ];

        $builder = $this->cH->ummu2($params);

        return $this->respond($builder, 200);
    }

    public function show_barge($id = null)
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
            "path"      => "api/spal/show_barge",
            "method" => 'GET',
            "payload" => $payload,
            "headers" => $this->cH->headers3($this->module_kode)
        ];

        $builder = $this->cH->ummu2($params);

        return $this->respond($builder, 200);
    }

    public function show_uom($id = null)
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
            "path"      => "api/spal/show_uom",
            "method" => 'GET',
            "payload" => $payload,
            "headers" => $this->cH->headers3($this->module_kode)
        ];

        $builder = $this->cH->ummu2($params);

        return $this->respond($builder, 200);
    }

    public function show_si($id = null)
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
            "path"      => "api/spal/show_si",
            "method" => 'GET',
            "payload" => $payload,
            "headers" => $this->cH->headers3($this->module_kode)
        ];

        $builder = $this->cH->ummu2($params);

        return $this->respond($builder, 200);
    }

    public function show_ijo()
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
            "path"      => "api/" . $this->module_kode . "/ijo",
            "method"    => "GET",
            "payload"   => $payload,
            "headers"   => $this->cH->headers3($this->module_kode)
        ];

        $builder = $this->cH->ummu2($params);

        return $this->respond($builder, 200);
    }
}
