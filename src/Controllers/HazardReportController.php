<?php

namespace Dorbitt\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\RESTful\ResourceController;

use Dorbitt\UmmuWhatsappGateway;
// use Dorbitt\Helpers\Curl;
use Dorbitt\Helpers\CurlHelper;
use Dorbitt\Helpers\GviewsHelper;
use Dorbitt\Helpers\UmmuHelper;
use Dorbitt\Builder\HazardReportBuilder;

use App\Builder\GlobalBuilder;
use App\Helpers\GlobalHelper;
use App\Helpers\HazardReportHelper;
use App\Builder\EmployeeBuilder;
use App\Builder\WhatsappBuilder;
use App\Builder\Approval\PoBuilder;
use App\Builder\Approval\ApprovalBuilder;

class HazardReportController extends ResourceController
{
    public function __construct()
    {
        $this->kode = 'she_hazard_report';
        $this->kode2 = 'she_hazard_report_achievement';
        $this->dir_view = 'pages/hazard_report/';

        $this->request = \Config\Services::request();
        $this->curl = new CurlHelper();
        $this->gBuilder = new GlobalBuilder();
        $this->qBuilder = new HazardReportBuilder();
        $this->gView = new GviewsHelper();
        $this->gHelp = new GlobalHelper();
        $this->uHelp = new UmmuHelper();
        $this->qbEmployee = new EmployeeBuilder();
        $this->qbWA = new WhatsappBuilder();
        $this->helper = new HazardReportHelper();
    }

    public function index()
    {
        $crud = $this->uHelp->index($this->kode);
        $data = [
            'navlink' => $this->kode,
            'page_title' => 'Hazard Report',
            'group' => ['she_safety'],
            'tmp' => $this->gHelp->tmp(),
            'module_kode' => $this->kode,
            'dir_views' => $this->dir_view,
            'include_tab' => $this->gView->nav_tab_doc_status(),
            'crud' => $crud
        ];
        return view(config('Ummu')->Views($this->dir_view . 'index'), $data);
    }

    public function number()
    {
        $builder = $this->qBuilder->number();
        return $this->respond($builder, 200);
    }

    public function ho()
    {
        // $data = [
        //     'navlink' => 'hazard_report_ho',
        //     'page_title' => 'Hazard Report',
        //     'group' => ['hazard_report'],
        //     'include' => [
        //         $this->gViews->modal_gallery('sbadmin2'),
        //         // $this->gViews->modal_loader(),
        //         // $this->gViews->modal_confirm()
        //     ],
        //     'tmp' => $this->gHelp->tmp()
        // ];
        // return view('pages/hazard_report/index', $data);
    }

    public function kosong()
    {
        return $this->respond([
            "rows" => [],
            "recordsTotal" => 0,
            "recordsFiltered" => 0
        ], 200);
    }

    public function show($id = null)
    {
        $builder = $this->qBuilder->show($id);
        return $this->respond($builder, 200);
    }

    public function create()
    {
        $body = $this->request->getJsonVar('body');
        $lokasi_temuan_id = $body->lokasi_temuan_id;
        $kode_bahaya_id = $body->kode_bahaya_id;

        foreach ($body as $key => $value) {
            $body->site_project_kode = session()->get('kode_site');
            $body->option_response = [
                "data" => false
            ];
            $body->is_open_integration = true;
        }
        $body->KdDepar = session()->get("KdDepar");
        $body->NmDepar = session()->get("NmDepar");
        $body->KdLevel = session()->get("KdLevel");
        $body->NmLevel = session()->get("NmLevel");
        $body->KdJabatan = session()->get("KdJabatan");
        $body->jabatanxx = session()->get("jabatanxx");
        $body->Nik = session()->get("nika");

        $builder = $this->qBuilder->create($body);

        $used_number = null;
        if (isset($builder->status) and $builder->status == true) {
            $used_number = $this->qBuilder->used_number($body->nomor_dokumen);
            if ($lokasi_temuan_id == 2) {
                if (in_array($kode_bahaya_id, [1, 2])) {
                    // // Send email ke admin safety
                    // $send_mail = $this->helper->send_mail_by_kode_bahaya($builder->data);
                    // $builder->send_mail = $send_mail;

                    // insert to queue
                    $data = $builder->data;
                    // $id = $data->id;
                    $insert_to_queue = $this->qBuilder->insert_queue_mail($data->id);
                }
            }
        }

        return $this->respond($builder, 200);
        // return $this->respond($body, 200);
    }

    public function update($id = null)
    {
        $body = $this->request->getJsonVar('body');
        $nav_tab_id = $body->nav_tab_id;
        if ($nav_tab_id == 'nav-rejected-tab') {
            $body->is_release = 1;
        }
        // foreach ($body as $key => $value) {
        //     $body->site_project_kode = session()->get('kode_site');
        // }
        $builder = $this->qBuilder->update($id, $body);
        return $this->respond($builder, 200);
    }

    public function delete($id = null)
    {
        $body = $this->request->getJsonVar('body');
        $builder = $this->qBuilder->delete($id, $body);
        return $this->respond($builder, 200);
    }

    public function release()
    {
        $body = $this->request->getJsonVar('body');
        $body = array_merge((array) $body, ['release' => 1]);
        $builder = $this->qBuilder->update_release($body);
        return $this->respond($body, 200);
    }

    public function approve()
    {
        $body = $this->request->getJsonVar('body');
        $body = array_merge((array) $body, ['release' => 2]);
        $builder = $this->qBuilder->update_release($body);
        return $this->respond($body, 200);
    }

    public function reject()
    {
        $body = $this->request->getJsonVar('body');

        $ids = [];
        foreach ($body as $key => $value) {
            $ids[] = $value->id;
            $remark = $value->remark;
        }

        $payload = [
            "ids" => $ids,
            "release" => 3,
            "remark" => $remark
        ];

        $builder = $this->qBuilder->update_release($payload);

        foreach ($body as $key => $value) {
            $doc_number = $value->document_number;
            $phone_number = $value->phone_number;
            $message = "📄 *Hazard Report* ⚠️ anda dengan Nomor Dokumen : *" . $doc_number . "* telah di-reject (❌)  oleh admin 👷🏻‍♂️, silahkan buat dokumen baru atau edit dokumen pada Tab Rejected List. https://herp.my.id/auth/login/phone";
            $this->qbWA->send_message($phone_number, $message);
        }

        return $this->respond($builder, 200);
    }

    public function sum()
    {
        // $builder = $this->qBuilder->sum();
        // return $this->respond($builder, 200);
    }

    public function she_hazard_report_achievement()
    {
        $crud = $this->uHelp->index($this->kode);
        $data = [
            'navlink' => $this->kode2,
            'page_title' => 'Hazard Report Achievement',
            'group' => ['she_safety'],
            'include' => [
                $this->gView->modal_gallery('sbadmin2'),
                $this->gView->modal_loader(),
                $this->gView->modal_confirm(),
                $this->gView->modal_filter()
            ],
            'tmp' => $this->gHelp->tmp(),
            'crud' => $crud
            // 'crud' => $this->uHelp->crud_from_modules('dorbitt_modules', $this->kode2),
            // 'crud_arr' => json_encode($this->uHelp->crud_from_modules_name('dorbitt_modules', $this->kode2))
        ];
        // return view('pages/hazard_report/report_achievement_index', $data);
        return view(config('Ummu')->Views($this->dir_view . 'report_achievement_index'), $data);
    }

    public function she_hazard_report_achievement_show()
    {
        $site = $this->request->getVar('site');
        if ($site and $site != 'undefined') {
            $site = explode(',', $site);
        } else {
            $site = session()->get('kode_site');
        }
        $selects = "KdSite,Nik,jabatanxx,NmDepar,NmLevel,KdLevel";

        $payload_empl = [
            "limit" => 0,
            "offset" => 0,
            "sort" => "id",
            "order" => "desc",
            "search" => "",
            "site" => $site,
            "nik" => [],
            "where_by" => ["site"],
            "selects" => $selects
        ];

        $employee_show = $this->qbEmployee->show($payload_empl);

        $nik_arr = [];
        if ($employee_show->status == true) {
            $rows = $employee_show->rows;

            foreach ($rows as $key => $value) {
                $nik_arr[] = $value->Nik;
            }
        }

        $builder = $this->qBuilder->she_hazard_report_achievement_show_by_nik($nik_arr);

        if ($builder->status == true) {
            $rows = $builder->rows;

            foreach ($rows as $key => $value) {
                $nik = $value->nikaryawan;
                $jml_capaian = $value->jml_capaian;
                if ($jml_capaian == null or $jml_capaian == '') {
                    $jml_capaian = 0;
                }

                $KdSite = null;
                $jabatanxx = null;
                $NmDepar = null;
                $NmLevel = null;
                $KdLevel = 0;

                if (isset($employee_show->status)) {
                    if ($employee_show->status == true) {
                        foreach ($employee_show->rows as $key2 => $value2) {
                            if ($nik === $value2->Nik) {
                                $KdSite = $value2->KdSite;
                                $jabatanxx = $value2->jabatanxx;
                                $NmDepar = $value2->NmDepar;
                                $NmLevel = $value2->NmLevel;
                                $KdLevel = $value2->KdLevel;
                            }
                        }
                    }
                }

                if ($KdLevel == 1 or $KdLevel == 2) {
                    $target_hzr = 2;
                } else if ($KdLevel == 3 or $KdLevel == 4 or $KdLevel == 5) {
                    $target_hzr = 1;
                } else {
                    $target_hzr = 0;
                }

                $rows[$key]->KdSite = $KdSite;
                $rows[$key]->jabatanxx = $jabatanxx;
                $rows[$key]->NmDepar = $NmDepar;
                $rows[$key]->NmLevel = $NmLevel;
                $rows[$key]->target_hzr = $target_hzr;

                if ($target_hzr != 0) {
                    $persen_capaian = $jml_capaian / $target_hzr * 100;
                } else {
                    $persen_capaian = 0;
                }
                $rows[$key]->persen_capaian = $persen_capaian;

                if ($persen_capaian >= 0 and $persen_capaian < 50) {
                    $nilai = 0.25;
                } elseif ($persen_capaian >= 50 and $persen_capaian < 100) {
                    $nilai = 0.5;
                } else {
                    $nilai = 1;
                }
                $rows[$key]->nilai = $nilai;
            }

            $response = [
                "rows" => $rows,
                "count" => $builder->count,
                "total" => $builder->total,
                "recordsTotal" => $builder->recordsTotal,
                "recordsFiltered" => $builder->recordsFiltered,
                "filter" => $builder->filter
            ];
        } else {
            $response = $builder;
        }

        return $this->respond($builder, 200);
    }
}
