<?php

namespace Dorbitt\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\RESTful\ResourceController;
use Dorbitt\Helpers\GviewsHelper;
use Dorbitt\UmmuProfile;
use Dorbitt\Helpers\CurlHelper;
use Dorbitt\Helpers\ViewsHelper;
use Dorbitt\Helpers\UmmuHelper;
use Dorbitt\Helpers\FileHelper;

use App\Helpers\GlobalHelper;
use App\Builder\Config\ProfileBuilder;
use App\Builder\Auth\LoginBuilder;

class ProfileController extends ResourceController
{
    public $gViews;
    public $umProfile;
    public $gHelp;
    public $qBuilder;
    public $qbLogin;

    public function __construct()
    {
        $this->request = \Config\Services::request();
        $this->pathAPI = "api/config/profile";
        $this->moduleKodeAPI = "config_profile";
        $this->module_kode = 'config_profile';
        $this->dir_view = 'pages/'. $this->module_kode .'/';

        $this->gViews = new GviewsHelper();
        $this->umProfile = new UmmuProfile();

        $this->gHelp = new GlobalHelper();
        $this->qBuilder = new ProfileBuilder();
        $this->qbLogin = new LoginBuilder();

        $this->cH = new CurlHelper();
        $this->vH = new ViewsHelper();
        $this->umHelp = new UmmuHelper();
        $this->fileH = new FileHelper();
    }

    public function index()
    {
        $data = [
            'page_title' => '<i class="fas fa-users-cog text-info mr-2"></i> Profile',
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
                    "name" => "Profile",
                    "page" => "#",
                    "active" => "active"
                ]
            ],
        ];
        return view($this->vH->ummuViewPartialIndex(), $data);
        // return $this->respond($data, 200);
    }

    public function show($id = null)
    {
        $payload = $this->umHelp->dt_payload2();
        $payload = array_merge($payload, [
            "date"      => [
                "from"  => "",
                "to"    => ""
            ],
            "selects"   => "*",
        ]);

        $urlParams = $this->cH->payload_http_build_query($payload);

        $params = [
            "path"          => $this->pathAPI . "?" . $urlParams,
            "method"        => "GET",
            "payload"       => $payload,
            "headers"       => $this->cH->headers3($this->module_kode)
        ];

        $builder = $this->cH->ummu2($params);

        return $this->respond($builder, 200);
    }

    public function sync_to_herp()
    {
        $username = $this->request->getJsonVar('username');

        $builder = $this->qbLogin->sync_to_herp();
        if ($builder->status == true) {
            $payload = [
                "username2" => $username
            ];

            $update = $this->qBuilder->update($payload);
            if ($update->status == true) {
                session()->set(["username2" => $username]);
            }
        }

        return $this->respond($builder, 200);
    }

    public function update_profile()
    {
        $email_office = $this->request->getJsonVar('email_office');
        $foto_avatar = $this->request->getJsonVar('foto_avatar');

        $payload = [
            "email2" => $email_office,
            "avatar" => $foto_avatar
        ];

        $builder = $this->qBuilder->update($payload);

        if ($builder->status == true) {
            session()->set(["email2" => $email_office]);
        }

        return $this->respond($builder, 200);
    }

    public function session()
    {
        $data = [
            'page_title' => 'Session',
            'navlink' => 'config_profile',
            'module_kode' => 'config_profile',
            'breadcrumb' => [],
            'breadcrumb_active' => [],
            'group' => ['config'],
            // 'all_jumlah'        => $this->qbAppv->sum()
            'include' => [
                $this->gViews->modal_loader(),
                $this->gViews->modal_info()
            ],
            'tmp' => $this->gHelp->tmp(),
            // 'session' => $this->respond(session()->get(), 200)
        ];

        return view('pages/profile/session', $data);
    }

    public function session_get()
    {
        $ssn = (array) session()->get();
        // var_dump($ssn);
        return $this->respond($ssn, 200);
    }

    public function update_password()
    {
        $currentPassword = $this->request->getJsonVar('current_password');
        $newPassword = $this->request->getJsonVar('new_password');
        $renewPassword = $this->request->getJsonVar('renew_password');

        if ($newPassword != $renewPassword) {
            $response = [
                "status"  => false,
                "message" => "Validation error",
                "errors"   => ["password" => "New Password and Renew Password not same!"]
            ];
            return $this->response->setJSON($response);
        }

        $payload = [
            "current_password"  => $currentPassword,
            "new_password"      => $newPassword,
            "renew_password"    => $renewPassword
        ];

        $params = [
            "path"          => $this->pathAPI . '/update_password',
            "method"        => 'PUT',
            "payload"       => $payload,
            "headers"       => $this->cH->headers3($this->module_kode)
        ];

        $builder = $this->cH->ummu2($params);
        // $builder = $params;

        return $this->respond($builder, 200);
    }
}
