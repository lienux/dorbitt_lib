<?php

namespace Dorbitt\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\RESTful\ResourceController;
use Dorbitt\Curl;
use Dorbitt\GviewsHelper;
use Dorbitt\Helpers\CurlHelper;
use Dorbitt\Helpers\ViewsHelper;
use Dorbitt\Helpers\UmmuHelper;
use Dorbitt\Helpers\ChromePhpHelper;
use Dorbitt\Helpers\FileHelper;
use App\Builder\GlobalBuilder;
use App\Builder\Approval\DocBuilder;
use App\Builder\Payroll\PayslipBuilder;
// use App\Builder\Approval\ApprovalBuilder;
use App\Builder\Payroll\EmployeeSalaryBuilder;
use App\Helpers\GlobalHelper;

class PayslipController extends ResourceController
{
    public function __construct()
    {
        $this->module_kode = 'payslip';
        $this->pathAPI = "api/hcm/payroll/" . $this->module_kode;
        $this->dir_view = 'pages/payroll/'. $this->module_kode .'/';

        $this->request = \Config\Services::request();
        $this->curl = new Curl();
        $this->gBuilder = new GlobalBuilder();
        $this->qBuilder = new PayslipBuilder();
        $this->gViews = new GviewsHelper();
        $this->qBEmplSlry = new EmployeeSalaryBuilder();
        $this->cH = new CurlHelper();
        $this->gHelp = new GlobalHelper();
        $this->umHelp = new UmmuHelper();
        $this->vH = new ViewsHelper();
        $this->chrome = new ChromePhpHelper();
        $this->fHelp = new FileHelper();
    }

    public function index()
    {
        $data = [
            'page_title' => 'Payslip',
            'module_kode' => $this->module_kode,
            'navlink' => $this->module_kode,
            'group' => ['payroll'],
            'tmp' => $this->gHelp->tmp(),
            'dir_views' => $this->dir_view,
            'crud' => null,
            'breadcrumb' => [
                [
                    "name" => "Payroll",
                    "page" => "#",
                    "active" => ""
                ],
                [
                    "name" => "Payslip",
                    "page" => "#",
                    "active" => "active"
                ]
            ],
        ];
        
        return view($this->vH->ummuView($this->dir_view . 'version1_alya_index4_autohide'), $data);
    }

    public function print($id = null)
    {
        $periode_id = $this->request->getVar('periode_id');
        $otp = $this->request->getVar('otp');
        $token = $this->request->getVar('t');

        $params = "periode_id=".$periode_id."&otp=".$otp;

        $path = $this->pathAPI ."/show-print?".$params;
        $headers = $this->cH->headers3_a($this->module_kode, $token);

        $builder = $this->cH->ummuGet($path, $headers);

        if ($builder) {
            $row = $builder->row;
            $row = (array) $row;
        }else{
            $row = [];
        }

        $row['module_kode'] = $this->module_kode;
        $row['navlink'] = $this->module_kode;
        $row['dir_views'] = $this->dir_view;

        return view($this->vH->ummuView($this->dir_view . 'print_autohide_4'), $row);
    }

    private function print_with_getVar_data($id)
    {
        $data = [
            "nika" => $this->request->getVar('nika'),
            "name" => $this->request->getVar('name'),
            "site" => $this->request->getVar('site'),
            "jabatan" => $this->request->getVar('jabatan'),
            "periode_name" => $this->request->getVar('periode_name'),
            "gapok" => $this->request->getVar('gapok_baru'),
            "rapel_gaji" => $this->request->getVar('rapel_gaji'),
            "lain_lain" => $this->request->getVar('lain_lain'),
            "tj_acting" => $this->request->getVar('tj_acting'),
            "tj_kesetaraan" => $this->request->getVar('tj_kesetaraan'),
            "insentif_produksi" => $this->request->getVar('insentif_produksi'),
            "insentif_kehadiran" => $this->request->getVar('insentif_kehadiran'),
            "total_tunjangan" => $this->request->getVar('total_tunjangan'),
            "gaji_bruto" => $this->request->getVar('gaji_bruto'),
            "potongan_kasbon" => $this->request->getVar('potongan_kasbon'),
            "potongan_tiket" => $this->request->getVar('potongan_tiket'),
            "potongan_jamsostek_jht" => $this->request->getVar('potongan_jamsostek_jht'),
            "potongan_jamsostek_jp" => $this->request->getVar('potongan_jamsostek_jp'),
            "total_potongan" => $this->request->getVar('total_potongan'),
            "gaji_netto" => $this->request->getVar('gaji_netto'),
            "saldo_kasbon" => $this->request->getVar('saldo_kasbon'),
            'qrcode' => $this->request->getVar('qrcode')
        ];

        return view('pages/payroll/payslip/print_autohide_4', $data);
    }

    private function print_with_query_data($id)
    {
        if ($id) {
            $builder = $this->qBEmplSlry->show($id);
        } else {
            $builder = $this->qBuilder->show($id);
        }

        if ($builder->status == true) {
            if ($id) {
                $rows = $builder->rows;
                $row = $rows[0];
            } else {
                $row = $builder->rows;
            }

            $data = [
                "nika" => $row->nika,
                "name" => $row->name,
                "site" => $row->site,
                "jabatan" => $row->jabatan,
                "periode_name" => $row->periode_name,
                "gapok" => $row->gapok_baru,
                "rapel_gaji" => $row->rapel_gaji,
                "lain_lain" => $row->lain_lain,
                "tj_acting" => $row->tj_acting,
                "tj_kesetaraan" => $row->tj_kesetaraan,
                "insentif_produksi" => $row->insentif_produksi,
                "insentif_kehadiran" => $row->insentif_kehadiran,
                "total_tunjangan" => $row->total_tunjangan,
                "gaji_bruto" => $row->gaji_bruto,
                "potongan_kasbon" => $row->potongan_kasbon,
                "potongan_tiket" => $row->potongan_tiket,
                "potongan_jamsostek_jht" => $row->potongan_jamsostek_jht,
                "potongan_jamsostek_jp" => $row->potongan_jamsostek_jp,
                "total_potongan" => $row->total_potongan,
                "gaji_netto" => $row->gaji_netto,
                "saldo_kasbon" => $row->saldo_kasbon,
                'qrcode' => $row->qrcode
            ];

            return view('pages/payroll/payslip/print_autohide_3', $data);
        }
    }

    public function show_print()
    {
        $data = $this->get_print();

        return $this->respond($data, 200);
    }

    private function get_print()
    {
        $periode_id = $this->request->getVar('periode_id');
        $otp = $this->request->getVar('otp');

        $params = "periode_id=".$periode_id."&otp=".$otp;

        $path = $this->pathAPI ."/show-print?".$params;
        $headers = $this->cH->headers3($this->module_kode);

        $builder = $this->cH->ummuGet($path, $headers);

        return $builder;
    }

    public function show($id = null)
    {
        $response = $this->get_print();

        return $this->respond($response, 200);
    }

    public function sum()
    {
        $builder = $this->qBuilder->sum();

        return $this->respond($builder, 200);
    }

    public function download_pdf($id = null)
    {
        $builder = $this->qBuilder->download_pdf($id);

        return $this->respond($builder, 200);
    }

    public function create_pdf()
    {
        $builder = $this->qBuilder->create_pdf();

        return $this->respond($builder, 200);
    }

    public function version1Alya_create_pdf()
    {
        $periode_id = $this->request->getVar('periode_id');
        $otp = $this->request->getVar('otp');
        $token = session()->get('token');

        $params = "periode_id=".$periode_id."&otp=".$otp."&t=".$token;

        $url = base_url("v1-alya/payslip-print?".$params);
        $folder = 'create_pdf/payslip/' . date('Ymd') . '/';
        $newName = $this->fHelp->newName() . '.pdf';

        $data = [
            "url"   => $url,
            "name"  => $newName,
            "dir"   => WRITEPATH . $folder,
            "row"   => [],
        ];

        $create = $this->chrome->create_v2($data);
        $file_url = base_url($folder.$newName);

        $response = [
            "status"        => true,
            "message"       => 'Create Pdf success',
            "file_url"      => $file_url,
            // "update_url"    => $update_url_pdf,
            // "response"      => $create,
            // "privilege"     => $this->privilege->my_privileges(),
            // "url_template"  => $url_template,
            // "row"           => $row
        ];

        return $this->respond($response, 200);
    }

    public function version1Alya_print_payslip_template()
    {
        $periode_id = $this->request->getVar('periode_id');
        $otp = $this->request->getVar('otp');

        $params = "periode_id=".$periode_id."&otp=".$otp;

        $path = $this->pathAPI ."/show-print?".$params;
        $headers = $this->cH->headers3($this->module_kode);

        // $builder = $this->cH->ummuGet($path, $headers);

        // $row = $builder->row;
        // $row = (array) $row;

        // return view('pages/payroll/payslip/print_autohide_4', $row);
        return $this->respond($builder = ["OK"], 200);
    }

    public function delete_pdf($id = null)
    {
        $builder = $this->qBuilder->delete_pdf($id);

        return $this->respond($builder, 200);
    }

    public function show_periode()
    {
        $builder = $this->qBuilder->show_periode();

        return $this->respond($builder, 200);
    }
}
