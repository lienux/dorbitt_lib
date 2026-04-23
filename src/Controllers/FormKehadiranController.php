<?php

namespace Dorbitt\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\HTTP\IncomingRequest;
use Dorbitt\Helpers\CurlHelper;
use Dorbitt\Helpers\ViewsHelper;
use Dorbitt\Helpers\UmmuHelper;
use App\Helpers\GlobalHelper;

class FormKehadiranController extends ResourceController
{
    public function __construct()
    {
        $this->module_kode = 'visitor';
        $this->dir_view = 'pages/'. $this->module_kode .'/';
        $this->request = \Config\Services::request();
        $this->cH = new CurlHelper();
        $this->db = \Config\Database::connect();
        $this->gHelp = new GlobalHelper();
        $this->vH = new ViewsHelper();
        $this->umHelp = new UmmuHelper();
        $this->session = session();
    }

    public function index()
    {
        // $data = [
        //     'page_title' => 'Master Data Vessel',
        //     'module_kode' => $this->module_kode,
        //     'navlink' => $this->module_kode,
        //     'group' => ['masterdata'],
        //     'tmp' => $this->gHelp->tmp(),
        //     'dir_views' => $this->dir_view,
        //     'crud' => null,
        //     'breadcrumb' => [
        //         [
        //             "name" => "Master Data",
        //             "page" => "#",
        //             "active" => ""
        //         ],
        //         [
        //             "name" => "Vessel",
        //             "page" => "#",
        //             "active" => "active"
        //         ]
        //     ],
        //     // "data" => $this->index_show()
        // ];
        // return $this->respond($data, 200);
        // $id = null;
        // $builder = $this->qBuilder->show_event($id);
        // if ($builder->status == true) {
            $rows = [];
            $data = [
                "id" => 9,
                "name" => 'Pertemuan Supplier',
                "banner_url" => '',
                "posisi_dibutuhkan_name" => [],
                "lokasi_test" => [],
                "provinces" => [],
                'include' => [
                    // $this->gViews->modal_loader()
                ],
                // 'expired' => $rows->expired
                'expired' => '2026-04-22 23:59:00'
            ];
            // return view('pages/HCM/form_pelamar/index', $data);
        // } else {
            // return view('pages/HCM/form_pelamar/close_recruitment');
        // }
        return view($this->vH->ummuView('pages/form_kehadiran_pertemuan_supplier/index'), $data);
    }

    public function create()
    {
        $payload = [
            "event_id" => $this->request->getVar('event_id'),
            "supplier" => $this->request->getPost('supplier'),
            "name" => $this->request->getPost('nama'),
            "jabatan" => $this->request->getPost('jabatan'),
            "name2" => $this->request->getPost('nama2'),
            "jabatan2" => $this->request->getPost('jabatan2'),
        ];

        $params = [
            "path" => "api/event_management/visitor/create",
            "method" => 'POST',
            "payload" => $payload,
            "headers" => $this->cH->headers4($this->module_kode)
        ];

        $builder = $this->cH->ummu2($params);

        if ($builder->status == true) {
            $this->session->setFlashdata('msg', $builder->message);
        } else {
            $this->session->setFlashdata('msg', 'Insert data failed.');
        }

        return redirect('form_konfirmasi_kehadiran_pertemuan_supplier');
        // return $this->respond($builder, 200);
    }
}
