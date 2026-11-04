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
            'page_title'    => '<i class="fas fa-users-cog text-info mr-2"></i> Time Sheet',
            'module_kode'   => $this->module_kode,
            'navlink'       => $this->module_kode,
            'group'         => ['operations','time_sheet'],
            'tmp'           => $this->gHelp->tmp(),
            'dir_views'     => $this->dir_view,
            'crud'          => null,
            'breadcrumb'    => [
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
        $ijo_id = $this->request->getVar('ijo_id');

        $payload = $this->umHelp->dt_payload2();
        $payload = array_merge($payload, [
            "id"        => $id,
            "date"      => [
                "from"  => "",
                "to"    => ""
            ],
            "selects"   => "*",
            "ijo_id"    => $ijo_id,
            // "where"     => ["type_id", "1"],
        ]);

        $urlParams = $this->cH->payload_http_build_query($payload);

        if ($id) {
            $path = "api/time_sheet/show/" . $id;
        }else{
            $path = "api/time_sheet?" . $urlParams;
        }

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

    public function create()
    {
        $post = $this->request->getPost();

        $activityTime = null;
        if (!empty($post['activity_time'])) {
            $activityTime = $post['activity_time'];
        } elseif (!empty($post['activity_hour']) && isset($post['activity_minute'])) {
            $activityTime = str_pad($post['activity_hour'], 2, '0', STR_PAD_LEFT)
                          . ':' . str_pad($post['activity_minute'], 2, '0', STR_PAD_LEFT);
        }

        $payload = [
            'ijo_id'            => $post['ijo_id'],
            'ijo_number'        => $post['ijo_number'],
            'vessel_id'         => $post['vessel_id'] ?? null,
            'tugboat_id'        => $post['vessel_id'] ?? null,
            'tugboat_name'      => $post['vessel_name'] ?? null,
            'barge_id'          => $post['barge_id'] ?? null,
            'barge_name'        => $post['barge_name'] ?? null,
            'activity_id'       => (int) ($post['activity_id'] ?? 0),
            'activity_name'     => $post['activity_name'] ?? '',
            'activity_kode'     => $post['activity_kode'] ?? null,
            'activity_date'     => $post['activity_date'] ?? null,
            'activity_time'     => $activityTime,
            'location'          => $post['location'] ?? null,
            'latitude'          => (isset($post['latitude']) && $post['latitude'] !== '') ? (float) $post['latitude'] : null,
            'longitude'         => (isset($post['longitude']) && $post['longitude'] !== '') ? (float) $post['longitude'] : null,
            'coord_format'      => $post['coord_format'] ?? 'DMS',
            'coord_source'      => $post['coord_source'] ?? 'manual',
            'distance_nm'       => !empty($post['distance_nm']) ? $post['distance_nm'] : null,
            'speed_knot'        => !empty($post['speed_knot']) ? $post['speed_knot'] : null,
            'weather_condition' => $post['weather_condition'] ?? null,
            'remarks'           => $post['remarks'] ?? null,
            'eta_date'          => !empty($post['eta_date']) ? $post['eta_date'] : null,
            'eta_time'          => !empty($post['eta_time']) ? $post['eta_time'] : null,
            'eta_remarks'       => $post['eta_remarks'] ?? null,
            'status'            => 'submitted',
            'rejection_reason'  => null,
        ];

        $params = [
            "path"          => "api/". $this->module_kode,
            "method"        => 'POST',
            "payload"       => $payload,
            "headers"       => $this->cH->headers3($this->module_kode)
        ];

        $builder = $this->cH->ummu2($params);
        // $builder = $params;

        return $this->respond($builder, 200);
    }

    public function update($id = null)
    {
        $post = $this->request->getPost();

        $activityTime = null;
        if (!empty($post['activity_time'])) {
            $activityTime = $post['activity_time'];
        } elseif (!empty($post['activity_hour']) && isset($post['activity_minute'])) {
            $activityTime = str_pad($post['activity_hour'], 2, '0', STR_PAD_LEFT)
                          . ':' . str_pad($post['activity_minute'], 2, '0', STR_PAD_LEFT);
        }

        $data = [
            'ijo_id'            => $post['ijo_id'],
            'activity_id'       => (int) ($post['activity_id'] ?? 0),
            'activity_name'     => $post['activity_name'] ?? '',
            'activity_kode'     => $post['activity_kode'] ?? null,
            'activity_date'     => $post['activity_date'] ?? null,
            'activity_time'     => $activityTime,
            'location'          => $post['location'] ?? null,
            'latitude'          => (isset($post['latitude']) && $post['latitude'] !== '') ? (float) $post['latitude'] : null,
            'longitude'         => (isset($post['longitude']) && $post['longitude'] !== '') ? (float) $post['longitude'] : null,
            'coord_format'      => $post['coord_format'] ?? 'DMS',
            'coord_source'      => $post['coord_source'] ?? 'manual',
            'distance_nm'       => !empty($post['distance_nm']) ? $post['distance_nm'] : null,
            'speed_knot'        => !empty($post['speed_knot']) ? $post['speed_knot'] : null,
            'weather_condition' => $post['weather_condition'] ?? null,
            'remarks'           => $post['remarks'] ?? null,
            'eta_date'          => !empty($post['eta_date']) ? $post['eta_date'] : null,
            'eta_time'          => !empty($post['eta_time']) ? $post['eta_time'] : null,
            'eta_remarks'       => $post['eta_remarks'] ?? null,
            'status'            => 'submitted',
            'rejection_reason'  => null,
        ];

        // // ✅ TAMBAH: cek duplikat saat update (exclude record ini sendiri)
        // if ($this->timesheetModel->isDuplicate(
        //     $oa2_employee->id,
        //     $data['activity_date'],
        //     $data['activity_time'],
        //     (int) $id
        // )) {
        //     return $this->response->setJSON([
        //         'status'  => false,
        //         'message' => 'Sudah ada timesheet lain di tanggal & jam yang sama.',
        //     ])->setStatusCode(409);
        // }

        // if (!$this->timesheetModel->update($id, $data)) {
        //     return $this->response->setJSON([
        //         'status'  => false,
        //         'message' => 'Gagal update.',
        //         'errors'  => $this->timesheetModel->errors(),
        //     ])->setStatusCode(422);
        // }

        // return $this->response->setJSON(['status' => true, 'message' => 'Timesheet berhasil diupdate.']);




        // $ijo_id = $this->request->getPost('ijo_id');
        // $ijo_number = $this->request->getPost('ijo_number');
        // $vessel_id = $this->request->getPost('vessel_id');
        // $vessel_name = $this->request->getPost('vessel_name');
        // $barge_id = $this->request->getPost('barge_id');
        // $barge_name = $this->request->getPost('barge_name');

        $payload = $data;
        // $payload = [
        //     "si_id" => $this->request->getPost('si_id'),
        //     "tgl" => $this->request->getPost('tgl_surat'),
        //     "number" => $this->request->getPost('nomor_surat'),
        //     "price" => str_replace(['.', ','], ['', '.'], $this->request->getPost('biaya_angkutan')),
        //     "kondisi_perjanjian" => $this->request->getPost('kondisi_perjanjian'),

        //     "client_id" => $this->request->getPost('client'),
        //     "tugboat_id" => $this->request->getPost('tugboat'),
        //     "barge_id" => $this->request->getPost('barge'),
        //     "load_type" => $this->request->getPost('load_type'),
        //     "qty" => str_replace(['.', ','], ['', '.'], $this->request->getPost('qty')),
        //     "uom_id" => $this->request->getPost('uom_id'),

        //     "loading_availability_date_from" => $this->request->getPost('loading_availability_date_from'),
        //     "loading_availability_date_to" => $this->request->getPost('loading_availability_date_to'),

        //     "loading_port" => $this->request->getPost('loading_port'),
        //     "discharge_port" => $this->request->getPost('discharge_port'),
        // ];

        // if ($upload) {
        //     $payload = array_merge($upload,$payload);
        // }

        $params = [
            "path"          => "api/". $this->module_kode . '/' . $id,
            "method"        => 'PUT',
            "payload"       => $payload,
            "headers"       => $this->cH->headers3($this->module_kode)
        ];

        $builder = $this->cH->ummu2($params);
        // $builder = $params;

        return $this->respond($builder, 200);
    }

    public function delete($id = null)
    {
        $params = [
            "path"          => "api/" . $this->module_kode . '/' . $id,
            "method"        => 'DELETE',
            "payload"       => [],
            "headers"       => $this->cH->headers3($this->module_kode)
        ];

        $builder = $this->cH->ummu2($params);

        return $this->respond($builder, 200);
    }

    // public function show_clients($id = null)
    // {
    //     $payload = $this->umHelp->dt_payload2();
    //     $payload = array_merge($payload, [
    //         "date" => [
    //             "from" => "",
    //             "to" => ""
    //         ],
    //         "selects" => "*"
    //     ]);

    //     $params = [
    //         "path"      => "api/spal/show_clients",
    //         "method" => 'GET',
    //         "payload" => $payload,
    //         "headers" => $this->cH->headers3($this->module_kode)
    //     ];

    //     $builder = $this->cH->ummu2($params);

    //     return $this->respond($builder, 200);
    // }

    // public function show_tugboat($id = null)
    // {
    //     $payload = $this->umHelp->dt_payload2();
    //     $payload = array_merge($payload, [
    //         "date" => [
    //             "from" => "",
    //             "to" => ""
    //         ],
    //         "selects" => "*"
    //     ]);

    //     $params = [
    //         "path"      => "api/spal/show_tugboat",
    //         "method" => 'GET',
    //         "payload" => $payload,
    //         "headers" => $this->cH->headers3($this->module_kode)
    //     ];

    //     $builder = $this->cH->ummu2($params);

    //     return $this->respond($builder, 200);
    // }

    // public function show_barge($id = null)
    // {
    //     $payload = $this->umHelp->dt_payload2();
    //     $payload = array_merge($payload, [
    //         "date" => [
    //             "from" => "",
    //             "to" => ""
    //         ],
    //         "selects" => "*"
    //     ]);

    //     $params = [
    //         "path"      => "api/spal/show_barge",
    //         "method" => 'GET',
    //         "payload" => $payload,
    //         "headers" => $this->cH->headers3($this->module_kode)
    //     ];

    //     $builder = $this->cH->ummu2($params);

    //     return $this->respond($builder, 200);
    // }

    // public function show_uom($id = null)
    // {
    //     $payload = $this->umHelp->dt_payload2();
    //     $payload = array_merge($payload, [
    //         "date" => [
    //             "from" => "",
    //             "to" => ""
    //         ],
    //         "selects" => "*"
    //     ]);

    //     $params = [
    //         "path"      => "api/spal/show_uom",
    //         "method" => 'GET',
    //         "payload" => $payload,
    //         "headers" => $this->cH->headers3($this->module_kode)
    //     ];

    //     $builder = $this->cH->ummu2($params);

    //     return $this->respond($builder, 200);
    // }

    // public function show_si($id = null)
    // {
    //     $payload = $this->umHelp->dt_payload2();
    //     $payload = array_merge($payload, [
    //         "date" => [
    //             "from" => "",
    //             "to" => ""
    //         ],
    //         "selects" => "*"
    //     ]);

    //     $params = [
    //         "path"      => "api/spal/show_si",
    //         "method" => 'GET',
    //         "payload" => $payload,
    //         "headers" => $this->cH->headers3($this->module_kode)
    //     ];

    //     $builder = $this->cH->ummu2($params);

    //     return $this->respond($builder, 200);
    // }

    public function show_ijo()
    {
        $limitAll = $this->request->getVar('limitAll');

        $payload = $this->umHelp->dt_payload2();
        $payload = array_merge($payload, [
            "date"      => [
                "from"  => "",
                "to"    => ""
            ],
            "selects"   => "*",
            "limitAll"  => $limitAll
        ]);

        $urlParams = $this->cH->payload_http_build_query($payload);

        $params = [
            "path"          => "api/" . $this->module_kode . "/ijo?" . $urlParams,
            "method"        => "GET",
            "payload"       => $payload,
            "headers"       => $this->cH->headers3($this->module_kode)
        ];

        $builder = $this->cH->ummu2($params);

        return $this->respond($builder, 200);
    }


    /**
     * Generate laporan WhatsApp
     */
    public function reportWa()
    {
        $ijo_id = $this->request->getGet('ijo_id');
        $dateFrom = $this->request->getGet('date_from');
        $dateTo   = $this->request->getGet('date_to');
        $tugboatName   = $this->request->getGet('tugboat_name');
        $bargeName   = $this->request->getGet('barge_name');
        // $oa2_employee = session()->get('oa2_employee');

        // if (!$crew || !$oa2_employee) {
        //     return $this->response->setJSON(['status' => false, 'message' => 'Session tidak valid.'])->setStatusCode(401);
        // }

        // $builder = $this->timesheetModel->builder()
        //     ->where('ijo_id', $ijo_id)
        //     ->where('deleted_at', null);


        // // Default backend: 3 hari ke belakang jika kosong
        // if (empty($dateFrom) && empty($dateTo)) {
        //     $dateTo   = date('Y-m-d');
        //     $dateFrom = date('Y-m-d', strtotime('-2 days'));
        // } elseif (!empty($dateFrom) && empty($dateTo)) {
        //     $dateTo = $dateFrom;
        // } elseif (empty($dateFrom) && !empty($dateTo)) {
        //     $dateFrom = $dateTo;
        // }

        // if ($dateFrom) $builder->where('activity_date >=', $dateFrom);
        // if ($dateTo)   $builder->where('activity_date <=', $dateTo);

        // $rows = $builder->orderBy('activity_date', 'DESC')
        //             ->orderBy('activity_time', 'DESC')
        //             ->get()
        //             ->getResultArray();

        $payload = $this->umHelp->dt_payload2();
        $payload = array_merge($payload, [
            "date"      => [
                "from"  => "",
                "to"    => ""
            ],
            "selects"   => "*",
            "limitAll"  => $limitAll
        ]);

        $urlParams = $this->cH->payload_http_build_query($payload);

        $params = [
            "path"          => "api/" . $this->module_kode . "/reportWa?" . $urlParams,
            "method"        => "GET",
            "payload"       => $payload,
            "headers"       => $this->cH->headers3($this->module_kode)
        ];

        $builder = $this->cH->ummu2($params);

        $meta = [
            'tugboat_name' => $tugboatName ?? '',
            'barge_name'   => $bargeName ?? '',
            // 'pic_name'     => $crew->pic_name ?? '',
            // 'client_name'  => $crew->client_name ?? '',
        ];

        $text = $this->buildWaReport($meta, $builder->$rows);

        return $this->response->setJSON([
            'status' => true,
            'text'   => $text,
            'count'  => count($builder->rows),
        ]);
    }

    /**
     * Bangun format laporan WhatsApp
     */
    private function buildWaReport(array $meta, array $rows): string
    {
        if (empty($rows)) {
            return "Belum ada data timesheet untuk dilaporkan.";
        }

        $lines = [];

        // Header
        $lines[] = '*Tugboat: ' . ($meta['tugboat_name'] ?: 'TB: -') . '*';
        $lines[] = '*Barge: ' . ($meta['barge_name'] ?: 'BG: -') . '*';
        $lines[] = '================';

        // Status terkini
        $latest = $rows[0];
        $lines[] = 'Tanggal:*' . $this->formatTanggalIndo($latest['activity_date']) . '*';
        $lines[] = 'Time:' . (!empty($latest['activity_time']) ? substr($latest['activity_time'], 0, 5) : '-');
        $lines[] = 'Posisi:' . ($latest['location'] ?: '-');
        $lines[] = 'Status:' . ($latest['activity_name'] ?: '-');
        if (!empty($latest['weather_condition'])) {
            $lines[] = 'Cuaca:' . $latest['weather_condition'];
        }
        $lines[] = '';
        $lines[] = '';

        // Group per tanggal
        $grouped = [];
        foreach ($rows as $r) {
            $grouped[$r['activity_date']][] = $r;
        }
        ksort($grouped);

        foreach ($grouped as $date => $items) {
            $lines[] = '*' . $this->formatTanggalIndo($date) . '*';

            usort($items, function ($a, $b) {
                return strcmp($a['activity_time'] ?? '', $b['activity_time'] ?? '');
            });

            foreach ($items as $it) {
                $time = !empty($it['activity_time']) ? substr($it['activity_time'], 0, 5) : '--:--';
                $activity = $it['activity_name'] ?? '-';
                $lines[] = '-' . $time . ' ' . $activity;
            }
        }

        // Note
        $lines[] = '';
        $lines[] = 'Note:';
        $lines[] = !empty($latest['remarks']) ? $latest['remarks'] : '-';

        return implode("\n", $lines);
    }

    /**
     * Format tanggal Indonesia: "Selasa 29/09/2026"
     */
    private function formatTanggalIndo(string $date): string
    {
        $hari = [
            'Sunday'    => 'Minggu',
            'Monday'    => 'Senin',
            'Tuesday'   => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday'  => 'Kamis',
            'Friday'    => 'Jumat',
            'Saturday'  => 'Sabtu',
        ];

        $ts = strtotime($date);
        $dayEn = date('l', $ts);
        $dayId = $hari[$dayEn] ?? $dayEn;

        return $dayId . ' ' . date('d/m/Y', $ts);
    }

    public function latestCoordinate()
    {
        $crewId = session()->get('crew_id'); // sesuaikan dengan session Anda
        $ijoId = session()->get('crew')->ijo_id; // sesuaikan dengan session Anda
        
        $row = $this->timesheetModel
            // ->where('crew_id', $crewId)
            ->where('ijo_id', $ijoId)
            ->where('latitude !=', null)
            ->where('longitude !=', null)
            ->orderBy('activity_date', 'DESC')
            ->orderBy('activity_time', 'DESC')
            ->orderBy('id', 'DESC')
            ->first();
        
        if (!$row) {
            return $this->response->setJSON(['status' => false, 'message' => 'Tidak ada koordinat.']);
        }
        
        return $this->response->setJSON([
            'status' => true,
            'data' => [
                'latitude'     => $row['latitude'],
                'longitude'    => $row['longitude'],
                'coord_format' => $row['coord_format'] ?? 'DMS',
                'location'     => $row['location'] ?? '',
                'activity_date'=> $row['activity_date'],
            ]
        ]);
    }
}
