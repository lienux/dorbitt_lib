<?php

namespace Dorbitt\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\HTTP\IncomingRequest;
use Dorbitt\Helpers\CurlHelper;
use Dorbitt\Helpers\ViewsHelper;

class ConfigController extends ResourceController
{
    protected $request;
    protected $vH;

    public function __construct()
    {
        $this->pathAPI = "api/config/profile";
        $this->moduleKodeAPI = "config_profile";
        $this->module_kode = 'config_profile';
        $this->dir_view = 'pages/'. $this->module_kode .'/';
        $this->request = \Config\Services::request();
        $this->cH = new CurlHelper();
        $this->vH = new ViewsHelper();
    }

    public function show_hierarchy_modules()
    {
        $params = [
            "path"      => "api/config/account_access/show_hierarchy_modules",
            "method"    => "GET",
            "payload"   => [],
            "headers"   => array(
                'Content-Type: application/json',
                'Company-Token: '.getenv('company_token'),
                'Module-Code: config_account_access',
                'Authorization: Bearer ' . session()->get('token')
            )
        ];

        $response = $this->cH->ummu2_v1_20250704($params);

        return $this->respond($response, 200);
        // var_dump($response);
    }

    public function index_update_password()
    {
        return view($this->vH->ummuView("pages/auth/form_update_password"));
    }

    public function update_password()
    {
        $json = $this->request->getJSON(true);

        $currentPassword       = $json['current_password']       ?? null;
        $password              = $json['password']               ?? null;
        $password_confirmation = $json['password_confirmation']  ?? null;

        // === Validasi dasar ===
        $errors = [];
        if (!$currentPassword) {
            $errors['current_password'] = 'Password saat ini wajib diisi.';
        }
        if (!$password) {
            $errors['password'] = 'Password baru wajib diisi.';
        } elseif (strlen($password) < 8) {
            $errors['password'] = 'Password minimal 8 karakter.';
        }
        if (!$password_confirmation) {
            $errors['password_confirmation'] = 'Konfirmasi password wajib diisi.';
        } elseif ($password !== $password_confirmation) {
            $errors['password_confirmation'] = 'Konfirmasi password tidak cocok.';
        }

        if (!empty($errors)) {
            return $this->respond([
                'status'  => false,
                'message' => 'Validasi gagal.',
                'errors'  => $errors,
            ], 200);
        }

        // === Payload ke API ===
        // sesuaikan nama field dengan API
        $payload = [
            'current_password' => $currentPassword,
            'new_password'     => $password,
            'renew_password'   => $password_confirmation,
        ];

        $params = [
            'path'    => $this->pathAPI . '/update_password',
            'method'  => 'PUT',
            'payload' => $payload,
            'headers' => $this->cH->headers3($this->module_kode),
        ];

        $builder = $this->cH->ummu2($params);

        return $this->respond($builder, 200);
    }
}
