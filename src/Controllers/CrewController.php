<?php

namespace Dorbitt\Controllers;

use App\Controllers\BaseController;
use App\Helpers\GlobalHelper;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\HTTP\IncomingRequest;
use Dorbitt\Helpers\CurlHelper;
use Dorbitt\Helpers\ViewsHelper;
use Dorbitt\Helpers\UmmuHelper;
use Dorbitt\Helpers\FileHelper;

class CrewController extends ResourceController
{
    public function __construct()
    {
        $this->pathAPI = "api/crewing/ms-crew";
        $this->moduleKodeAPI = "ms_crew";
        $this->module_kode = 'ms_crew';
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
        $data = [
            'page_title' => '<i class="fas fa-users-cog text-info mr-2"></i> Master Crew Database',
            'module_kode' => $this->module_kode,
            'navlink' => $this->module_kode,
            'group' => ['crewing'],
            'tmp' => $this->gHelp->tmp(),
            'dir_views' => $this->dir_view,
            'crud' => null,
            'breadcrumb' => [
                [
                    "name" => "Crewing",
                    "page" => "#",
                    "active" => ""
                ],
                [
                    "name" => "Master Crew",
                    "page" => "#",
                    "active" => "active"
                ]
            ],
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
            "type_id" => 1,
        ]);
        $queryString = http_build_query($payload);

        $path = $this->pathAPI . "?" . $queryString;
        $headers = $this->cH->headers3($this->module_kode);

        $builder = $this->cH->ummuGet($path, $headers);

        return $this->respond($builder, 200);
    }

    public function create()
    {
        $payload = $this->payload();

        $params = [
            "path" => $this->pathAPI,
            "method" => 'POST',
            "payload" => $payload,
            "headers" => $this->cH->headers3($this->module_kode)
        ];

        $builder = $this->cH->ummu2($params);

        return $this->respond($builder, 200);
    }

    public function update($id = null)
    {
        $payload = $this->payload();

        $params = [
            "path" => $this->pathAPI . "/" . $id,
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
            "path" => $this->pathAPI . "/" . $id,
            "method" => 'DELETE',
            "payload" => [],
            "headers" => $this->cH->headers3($this->module_kode)
        ];

        $builder = $this->cH->ummu2($params);

        return $this->respond($builder, 200);
    }

    // public function showCountry($id = null)
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
    //         "path"      => $this->pathAPI,
    //         "method" => 'GET',
    //         "payload" => $payload,
    //         "headers" => $this->cH->headers3($this->module_kode)
    //     ];

    //     $builder = $this->cH->ummu2($params);

    //     return $this->respond($builder, 200);
    // }

    // public function show_pelabuhan($id = null)
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
    //         "path"      => $this->pathAPI . '/show-pelabuhan',
    //         "method"    => 'GET',
    //         "payload"   => $payload,
    //         "headers"   => $this->cH->headers3($this->moduleKodeAPI)
    //     ];

    //     $builder = $this->cH->ummu2($params);

    //     return $this->respond($builder, 200);
    // }

    public function show_vessel()
    {
        $payload = $this->umHelp->dt_payload2();
        $payload = array_merge($payload, [
            "date" => [
                "from" => "",
                "to" => ""
            ],
            "selects" => "*"
        ]);

        $queryString = http_build_query($payload);

        $path = $this->pathAPI . "/vessel";
        $headers = $this->cH->headers3($this->module_kode);

        $builder = $this->cH->ummuGet($path, $headers);

        return $this->respond($builder, 200);
    }

    // public function create_waypoint()
    // {
    //     $payload = [
    //         "rute_id" => $this->request->getPost('rute_id'),
    //         "name" => $this->request->getPost('name'),
    //         "sequence" => $this->request->getPost('sequence'),

    //         "lintang_sudut" => $this->request->getPost('lintang_sudut'),
    //         "lintang_menit" => $this->request->getPost('lintang_menit'),
    //         "lintang_arah" => $this->request->getPost('lintang_arah'),

    //         "bujur_sudut" => $this->request->getPost('bujur_sudut'),
    //         "bujur_menit" => $this->request->getPost('bujur_menit'),
    //         "bujur_arah" => $this->request->getPost('bujur_arah'),

    //         "haluan" => $this->request->getPost('haluan'),
    //         "jarak_antar_titik" => $this->request->getPost('jarak'),
    //     ];

    //     $params = [
    //         "path" => $this->pathAPI . "/waypoint",
    //         "method" => 'POST',
    //         "payload" => $payload,
    //         "headers" => $this->cH->headers3($this->module_kode)
    //     ];

    //     $builder = $this->cH->ummu2($params);

    //     return $this->respond($builder, 200);
    // }

    // public function update_waypoint($id = null)
    // {
    //     if ($id == null) {
    //         $id = $this->request->getVar('id');
    //     }

    //     $payload = [
    //         "rute_id" => $this->request->getVar('rute_id'),
    //         "name" => $this->request->getVar('name'),
    //         "sequence" => $this->request->getVar('sequence'),

    //         "lintang_sudut" => $this->request->getVar('lintang_sudut'),
    //         "lintang_menit" => $this->request->getVar('lintang_menit'),
    //         "lintang_arah" => $this->request->getVar('lintang_arah'),

    //         "bujur_sudut" => $this->request->getVar('bujur_sudut'),
    //         "bujur_menit" => $this->request->getVar('bujur_menit'),
    //         "bujur_arah" => $this->request->getVar('bujur_arah'),

    //         "haluan" => $this->request->getVar('haluan'),
    //         "jarak_antar_titik" => $this->request->getVar('jarak'),
    //         "total_jarak" => $this->request->getVar('total_jarak'),
    //     ];

    //     $params = [
    //         "path" => $this->pathAPI . "/waypoint/" . $id,
    //         "method" => 'PUT',
    //         "payload" => $payload,
    //         "headers" => $this->cH->headers3($this->module_kode)
    //     ];

    //     $builder = $this->cH->ummu2($params);

    //     return $this->respond($builder, 200);
    // }

    // public function delete_waypoint($id)
    // {
    //     $params = [
    //         "path" => $this->pathAPI . "/waypoint/" . $id,
    //         "method" => 'DELETE',
    //         "payload" => [
    //             "rute_id" => $this->request->getVar('rute_id')
    //         ],
    //         "headers" => $this->cH->headers3($this->module_kode)
    //     ];

    //     $builder = $this->cH->ummu2($params);

    //     return $this->respond($builder, 200);
    // }

    // public function show_crew()
    // {
    //     $payload = $this->umHelp->dt_payload2();
    //     $payload = array_merge($payload, [
    //         "date" => [
    //             "from" => "",
    //             "to" => ""
    //         ],
    //         "selects" => "*"
    //     ]);

    //     $queryString = http_build_query($payload);

    //     $path = $this->pathAPI . "/crew";
    //     $headers = $this->cH->headers3($this->module_kode);

    //     $builder = $this->cH->ummuGet($path, $headers);

    //     return $this->respond($builder, 200);
    // }

    public function show_ranks()
    {
        $payload = $this->umHelp->dt_payload2();
        // $payload = array_merge($payload, [
        //     "date" => [
        //         "from" => "",
        //         "to" => ""
        //     ],
        //     "selects" => "*"
        // ]);

        $queryString = http_build_query($payload);

        $path = $this->pathAPI . "/ranks";
        $headers = $this->cH->headers3($this->module_kode);

        $builder = $this->cH->ummuGet($path, $headers);

        return $this->respond($builder, 200);
    }

    private function payload()
    {
        $full_name = $this->request->getPost('full_name');
        $seafarer_code = $this->request->getPost('seafarer_code');
        $tempat_lahir = $this->request->getPost('tempat_lahir');
        $tanggal_lahir = $this->request->getPost('tanggal_lahir');
        $gender = $this->request->getPost('gender');
        $golongan_darah = $this->request->getPost('golongan_darah');
        $phone_number = $this->request->getPost('phone_number');
        $email = $this->request->getPost('email');
        $address = $this->request->getPost('address');

        $national_id_number = $this->request->getPost('national_id_number');
        $family_card_number = $this->request->getPost('family_card_number');
        $tax_id_number = $this->request->getPost('tax_id_number');

        $vaccination_info = $this->request->getPost('vaccination_info');

        $tugboat_id = $this->request->getPost('tugboat_id');
        $base_rank_id = $this->request->getPost('base_rank_id');
        $employment_status = $this->request->getPost('employment_status');

        $highest_coc_certificate = $this->request->getPost('highest_coc_certificate');
        $coc_certificate_number = $this->request->getPost('coc_certificate_number');
        $coc_expiry_date = $this->request->getPost('coc_expiry_date');

        $seaman_book_number = $this->request->getPost('seaman_book_number');
        $seaman_book_expiry = $this->request->getPost('seaman_book_expiry');
        $mcu_maritime_number = $this->request->getPost('mcu_maritime_number');
        $mcu_maritime_expiry = $this->request->getPost('mcu_maritime_expiry');

        $passport_number = $this->request->getPost('passport_number');
        $passport_expiry = $this->request->getPost('passport_expiry');
        $crew_document_pdf = $this->request->getFile('crew_document_pdf');

        $current_crew_status = $this->request->getPost('current_crew_status');
        $sign_on_place = $this->request->getPost('sign_on_place');
        $sign_on_date = $this->request->getPost('sign_on_date');
        $sign_off_place = $this->request->getPost('sign_off_place');
        $sign_off_date = $this->request->getPost('sign_off_date');

        $wearpack_size = $this->request->getPost('wearpack_size');
        $safety_shoes_size = $this->request->getPost('safety_shoes_size');
        $remarks = $this->request->getPost('remarks');

        $departemen_id = getenv('crewing.departemen_id');
        $jabatan_id = getenv('crewing.jabatan_id');

        $payload = [
            'name' => $full_name,
            'seafarer_code' => $seafarer_code,
            'tempat_lahir' => $tempat_lahir,
            'tanggal_lahir' => $tanggal_lahir,
            'jenis_kelamin' => $gender,
            'golongan_darah' => $golongan_darah,
            'phone_number' => $phone_number,
            'email' => $email,
            'alamat' => $address,

            'national_id_number' => $national_id_number,
            'family_card_number' => $family_card_number,
            'tax_id_number' => $tax_id_number,

            'vaccination_info' => $vaccination_info,

            'tugboat_id' => $tugboat_id,
            'base_rank_id' => $base_rank_id,
            'employment_status' => $employment_status,
            'departemen_id' => $departemen_id,
            'jabatan_id' => $jabatan_id,

            'highest_coc_certificate' => $highest_coc_certificate,
            'coc_certificate_number' => $coc_certificate_number,
            'coc_expiry_date' => $coc_expiry_date,

            'seaman_book_number' => $seaman_book_number,
            'seaman_book_expiry' => $seaman_book_expiry,
            'mcu_maritime_number' => $mcu_maritime_number,
            'mcu_maritime_expiry' => $mcu_maritime_expiry,

            'passport_number' => $passport_number,
            'passport_expiry' => $passport_expiry,

            'current_crew_status' => $current_crew_status,
            'sign_on_place' => $sign_on_place,
            'sign_on_date' => $sign_on_date,
            'sign_off_place' => $sign_off_place,
            'sign_off_date' => $sign_off_date,

            'wearpack_size' => $wearpack_size,
            'safety_shoes_size' => $safety_shoes_size,
            'remarks' => $remarks,
        ];

        // Proses save file
        $upload = $this->fileH->upload2($crew_document_pdf);

        if ($upload['status'] == true) {
            $payload['file_name'] = $upload['originalName'];
            $payload['file_url'] = $upload['fileUrl'];
        }

        return $payload;
    }
}
