<?php

namespace Dorbitt\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\HTTP\IncomingRequest;
use Dorbitt\Helpers\CurlHelper;
use Dorbitt\Helpers\GviewsHelper;
use Dorbitt\Helpers\ViewsHelper;
use Dorbitt\Helpers\EncrypterHelper;

class LoginController extends ResourceController
{
    public $cH;
    public $gViews;
    public $vH;
    public $encrypter;

    public function __construct()
    {
        $this->request = \Config\Services::request();
        $this->session = session();
        $this->cH = new CurlHelper();
        $this->vH = new ViewsHelper();
        $this->gViews = new GviewsHelper();
        $this->encrypter = new EncrypterHelper();
    }

    public function index()
    {
        return view($this->vH->ummuView("pages/auth/form_check_phoneNumber"));
    }

    public function find()
    {
        $phone_number = $this->request->getVar('phone_number');

        $this->session->setFlashdata('phone_number_encript', $this->encrypter->encrypt($phone_number));

        $payload = [
            "phone_number" => $phone_number
        ];

        $params = [
            "path"           => "auth/phone_number/find",
            "method"         => "POST",
            "payload"        => $payload,
            "headers"        => array(
                'Content-Type: application/json',
                'App-Id: ' . getenv('app.id'),
                'Company-Token: ' . getenv('company_token')
            )
        ];

        $response = $this->cH->ummu2($params);

        return $this->respond($response, 200);
    }

    public function findSuccess()
    {
        $phone_number = $this->request->getVar('phone_number');
        $phone_number_encrypt = $this->encrypter->encrypt($phone_number);

        $text = 'auth/phone_number/login_password?phone_number=' . $phone_number_encrypt;
        return redirect()->to($text);
        // return $text;
        // return $this->encrypter->decrypt($phone_number_encrypt);
    }

    public function login_password()
    {
        $phone_number_encrypt = $this->request->getVar('phone_number');
        $phone_number = $this->encrypter->decrypt($phone_number_encrypt);
        // return $this->encrypter->decrypt($phone_number);
        // return $phone_number;

        if (!$phone_number) {
            return redirect()->to('auth/phone_number'); 
        }
        return view($this->vH->ummuView("pages/auth/form_login_withPassword"));
    }

    public function login_otp()
    {
        return view($this->vH->ummuView("pages/auth/form_login_withOTP"));
    }

    public function create()
    {
        $getVar = $this->request->getVar();
        // $getJsonVar = $this->request->getJsonVar();
        // $data = $this->request->getJsonVar('data');
        $msdb = $this->request->getVar('msdb');
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');
        $toMcp = $this->request->getVar('tomcp');
        $login_module = $this->request->getVar('login_module');

        $dataVar = [
            // "getVar" => $getVar,
            // "getJsonVar" => $getJsonVar,
            // "data" => $data,
            "username" => $username,
            "password" => $password,
            "msdb" => $msdb,
            "toMcp" => $toMcp,
            "login_module" => $login_module
        ];

        /* if ($msdb) {
            $msdb = explode("$$344$$", $msdb);
            $msdbName = $msdb[0];
            $msdbToken = $msdb[1];

            $builder = $this->qBuilder->create();
            // var_dump($builder);
            // return $this->respond($builder, 200);

            if ($builder->status == false and $builder->messages == 'Username no found!') {
                $payload = [
                    "username" => $this->request->getVar('username'),
                    "password" => $this->request->getVar('password'),
                    "join" => ["employee"]
                ];
                $builder = $this->qBuilder->openapi2Login($payload);
                // var_dump($builder);
                // return $this->respond($builder, 200);

                if ($builder->status == true) {
                    if (isset($builder->data->employee->nik)) {
                        $employee_show = $this->qbEmployee->show_by_nik($builder->data->employee->nik);
                        // return $this->respond($employee_show, 200);
                        if ($employee_show->status == true) {
                            $kode_site = $employee_show->rows[0]->KdSite;
                        }
                    } else {
                        $kode_site = null;
                    }

                    $sessData = [
                        "id" => $builder->data->id,
                        "name" => $builder->data->name,
                        "username" => $builder->data->username,
                        "company_id" => $builder->data->company_id,
                        "level_id" => $builder->data->level_id,
                        "phone_number" => $builder->data->phone_number,
                        "avatar" => $builder->data->avatar,
                        "token" => $builder->data->token,
                        "logged_in" => TRUE,
                        "dorbitt_in" => TRUE,
                        "logged_by" => "dorbitt",
                        "dorbitt_modules" => $builder->data->module_enabled,
                        "kode_site" => $kode_site
                    ];
                    session()->set($sessData);
                    return redirect()->to('/admin');
                    // return $this->respond($sessData, 200);
                } else {
                    $msg = $builder->messages . "<br>" . implode(" ", (array) $builder->errors);
                    session()->setFlashdata('msg', $msg);
                    return redirect()->to('/auth');
                }
            } else {
                $payload = [
                    "username" => getenv('dorbitt.username'),
                    "password" => getenv('dorbitt.password')
                ];
                $approval = $this->qBuilder->openapi2Login($payload);
                if (isset($approval->status)) {
                    if ($approval->status == true) {
                        $dorbitt_session = [
                            "dorbitt_account_id" => $approval->data->id,
                            "dorbitt_username" => $approval->data->username,
                            "dorbitt_company_id" => $approval->data->company_id,
                            "dorbitt_email" => $approval->data->email,
                            "dorbitt_avatar" => $approval->data->avatar,
                            "dorbitt_company_name" => $approval->data->company->name,
                            "dorbitt_company_avatar" => $approval->data->company->avatar,
                            "dorbitt_modules" => $approval->data->module_enabled,
                            "dorbitt_token" => $approval->data->token,
                        ];
                        session()->set($dorbitt_session);
                    }
                }

                if (isset($builder->status)) {
                    if ($builder->status == true) {
                        $data = $builder->data;
                        $user = $data->user;
                        $kdUser = $user->kdUser;
                        $nmUser = $user->nmUser;

                        $departement = $data->departement;
                        $dept_code = null;
                        $dept_name = null;
                        if ($departement) {
                            $dept_code = $departement[0]->dept_code;
                            $dept_name = $departement[0]->dept_name;
                        }

                        $sessData = [
                            "name" => $nmUser,
                            "username" => $kdUser,
                            "departement_kode" => $dept_code,
                            "departement" => $dept_name,
                            "avatar" => "https://cdn.dorbitt.my.id/icon/9131529.png",
                            "msdbToken" => $msdbToken,
                            "msdbName" => $msdbName,
                            'logged_in' => TRUE,
                            'herp_in' => TRUE,
                            "logged_by" => "herp"
                        ];
                        session()->set($sessData);

                        return redirect()->to('/admin');
                    }
                    session()->setFlashdata('msg', json_encode($builder->messages));
                    return redirect()->to('/auth');
                } else {
                    session()->setFlashdata('msg', json_encode($builder));
                    return redirect()->to('/auth');
                }
            }
        } else {
            session()->setFlashdata('msg', "Silahkan pilih company");
            return redirect()->to('/auth');
        } */


        if ($msdb) {
            $msdb = explode("$$344$$", $msdb);

            $msdbName = $msdb[0];
            $msdbToken = $msdb[1];

            /**
             * login to herp
             */
            $builder = $this->qBuilder->create();
            // $response = $builder;
            // var_dump($builder);
            // return $this->respond($builder, 200);

            // $builder = $this->qBuilder->create();
            // return $this->respond($dataVar, 200);

            if ($builder->status == false and $builder->messages == 'Username no found!') {
                $payload = [
                    "username" => $this->request->getVar('username'),
                    "password" => $this->request->getVar('password'),
                    "join" => ["employee"]
                ];

                /**
                 * login to open integrasi / openerp with username password
                 */
                $builder = $this->qBuilder->openapi2Login($payload);
                // var_dump($builder);
                // return $this->respond($builder, 200);

                if ($builder->status == true) {
                    $token = $builder->data->token;
                    $msdbTokenEmpl = $builder->data->employee->msdb_token;
                    $nika = $builder->data->employee->nik;
                    $site_project = $builder->data->employee->site_project;
                    $Oa2_KdSite = $builder->data->employee->KdSite;
                    $KdLevel = null;
                    $NmLevel = null;
                    $KdDepar = null;
                    $NmDepar = null;
                    $KdJabatan = null;
                    $jabatanxx = null;
                    $region_name = null;
                    $Alamat = null;
                    $kode_site = null;
                    $update_myKdSite = null;

                    if (isset($builder->data->employee->nik)) {
                        // $nika = $builder->data->employee->nik;
                        $employee_show = $this->qbEmployee->show_by_nik_for_login($nika);
                        // return $this->respond($employee_show, 200);
                        if ($employee_show->status == true) {
                            $kode_site = $employee_show->rows[0]->KdSite;
                            $KdLevel = $employee_show->rows[0]->KdLevel;
                            $NmLevel = $employee_show->rows[0]->NmLevel;
                            $KdDepar = $employee_show->rows[0]->KdDepar;
                            $NmDepar = $employee_show->rows[0]->NmDepar;
                            $KdJabatan = $employee_show->rows[0]->KdJabatan;
                            $jabatanxx = $employee_show->rows[0]->jabatanxx;
                            $region_name = $employee_show->rows[0]->region_name;
                            $Alamat = $employee_show->rows[0]->Alamat;

                            if ($kode_site != $Oa2_KdSite) {
                                $update_myKdSite = $this->qBuilder->update_myKdSite(["KdSite" => $kode_site], $token);
                            }
                        }
                    }
                    // else {
                    // $nika = $builder->data->employee->nik;
                    // $kode_site = null;
                    // $KdLevel = null;
                    // $NmLevel = null;
                    // $NmDepar = null;
                    // $jabatanxx = null;
                    // $region_name = null;
                    // $Alamat = null;
                    // }

                    $kode2 = null;
                    if ($kode_site) {
                        $opint = $this->qbSite->show_from_openintegrasi_by_kdsite_for_login($kode_site);
                        if (isset($opint->status)) {
                            if ($opint->status == true) {
                                $row = $opint->rows[0];
                                $kode2 = $row->kode2;
                            }
                        }
                    }

                    $sessData = [
                        "id" => $builder->data->id,
                        "nika" => $nika,
                        "name" => $builder->data->name,
                        "username" => $builder->data->username,
                        "username2" => $builder->data->username2,
                        "email" => $builder->data->email,
                        "email2" => $builder->data->email2,
                        "company_id" => $builder->data->company_id,
                        "level_id" => $builder->data->level_id,
                        "phone_number" => $builder->data->phone_number,
                        "avatar" => $builder->data->avatar,
                        "token" => $token,
                        "logged_in" => TRUE,
                        "logged_by" => "dorbitt",
                        "openapi2" => TRUE,
                        "openapi2_modules" => $builder->data->module_enabled,
                        "iescm_modules" => null,
                        "kode_site" => $kode_site,
                        "kode_site2" => $kode2,
                        "KdLevel" => $KdLevel,
                        "NmLevel" => $NmLevel,
                        "KdDepar" => $KdDepar,
                        "NmDepar" => $NmDepar,
                        "KdJabatan" => $KdJabatan,
                        "jabatanxx" => $jabatanxx,
                        "region_name" => $region_name,
                        "Alamat" => $Alamat,
                        "msdbToken" => $msdbToken,
                        // "msdbToken" => base64_decode($msdbToken),
                        "msdbTokenDec" => base64_decode($msdbToken),
                        "msdbName" => $msdbName,
                        "msdbTokenEmpl" => $msdbTokenEmpl,
                        "toMcp" => $toMcp,
                        "dorbitt_in" => TRUE,
                        "dorbitt_modules" => $builder->data->module_enabled,
                        // "update_myKdSite" => $update_myKdSite,
                        "update_myKdSite" => (isset($update_myKdSite->status)) ? $update_myKdSite->status : null,
                    ];
                    session()->set($sessData);
                    // return redirect()->to('/admin');
                    // return $this->respond($sessData, 200);
                    $response = [
                        "status" => true,
                        "message" => "Login success.",
                        "data" => "",
                        "toMcp" => $toMcp
                    ];
                    // return $this->respond($response, 200);
                } else {
                    $msg = $builder->messages . "<br>" . implode(" ", (array) $builder->errors);
                    // session()->setFlashdata('msg', $msg);
                    // return redirect()->to('/auth');
                    $response = [
                        "status" => false,
                        "message" => $msg,
                        "data" => ""
                    ];
                }
            } else {
                $payload = [
                    "username" => getenv('dorbitt.username'),
                    "password" => getenv('dorbitt.password')
                ];
                $approval = $this->qBuilder->openapi2Login($payload);
                if (isset($approval->status)) {
                    if ($approval->status == true) {
                        $dorbitt_session = [
                            "openapi2_account_id" => $approval->data->id,
                            "openapi2_username" => $approval->data->username,
                            "openapi2_company_id" => $approval->data->company_id,
                            "openapi2_email" => $approval->data->email,
                            "openapi2_avatar" => $approval->data->avatar,
                            "openapi2_company_name" => $approval->data->company->name,
                            "openapi2_company_avatar" => $approval->data->company->avatar,
                            "openapi2_modules" => $approval->data->module_enabled,
                            "openapi2_token" => $approval->data->token,

                            "dorbitt_account_id" => $approval->data->id,
                            "dorbitt_username" => $approval->data->username,
                            "dorbitt_company_id" => $approval->data->company_id,
                            "dorbitt_email" => $approval->data->email,
                            "dorbitt_avatar" => $approval->data->avatar,
                            "dorbitt_company_name" => $approval->data->company->name,
                            "dorbitt_company_avatar" => $approval->data->company->avatar,
                            "dorbitt_modules" => $approval->data->module_enabled,
                            "dorbitt_token" => $approval->data->token,
                            "login_module" => $login_module
                        ];
                        session()->set($dorbitt_session);
                    }
                }

                if (isset($builder->status)) {
                    if ($builder->status == true) {
                        $data = $builder->data;
                        $user = $data->user;
                        $kdUser = $user->kdUser;
                        $nmUser = $user->nmUser;

                        $departement = $data->departement;
                        $dept_code = null;
                        $dept_name = null;
                        if ($departement) {
                            $dept_code = $departement[0]->dept_code;
                            $dept_name = $departement[0]->dept_name;
                        }

                        $sessData = [
                            "name" => $nmUser,
                            "username" => $kdUser,
                            "departement_kode" => $dept_code,
                            "departement" => $dept_name,
                            "avatar" => "https://cdn.dorbitt.my.id/icon/9131529.png",
                            "msdbToken" => $msdbToken,
                            "msdbTokenDec" => base64_decode($msdbToken),
                            "msdbName" => $msdbName,
                            'logged_in' => TRUE,
                            'herp_in' => TRUE,
                            "logged_by" => "herp",
                            "toMcp" => $toMcp,
                            "login_module" => $login_module
                        ];

                        // if ($toMcp == true) {
                        //     $sessData['tmp'] = "trezo_admin";
                        // }

                        session()->set($sessData);

                        // return redirect()->to('/admin');
                        $response = [
                            "status" => true,
                            "message" => "Login success.",
                            "data" => "",
                            "toMcp" => $toMcp,
                            "login_module" => $login_module
                        ];
                        // return $this->respond($response, 200);
                    } else {
                        // session()->setFlashdata('msg', json_encode($builder->messages));
                        // return redirect()->to('/auth');
                        $response = [
                            "status" => false,
                            "message" => json_encode($builder->messages),
                            "data" => ""
                        ];
                    }
                } else {
                    // session()->setFlashdata('msg', json_encode($builder));
                    // return redirect()->to('/auth');
                    $response = [
                        "status" => false,
                        "message" => json_encode($builder),
                        "data" => ""
                    ];
                }
            }
        } else {
            // session()->setFlashdata('msg', "Silahkan pilih company");
            // return redirect()->to('/auth');
            $response = [
                "status" => false,
                "message" => "Silahkan pilih company",
                "data" => ""
            ];
        }

        return $this->respond($response, 200);
    }

    public function create2()
    {
        $msdb = $this->request->getJsonVar('msdb');

        if ($msdb) {
            $msdb = explode("$$344$$", $msdb);
            $msdbName = $msdb[0];
            $msdbToken = $msdb[1];

            $builder = $this->qBuilder->create();
            // var_dump($builder);
            return $this->respond($builder, 200);

            /* if ($builder->status == false and $builder->messages == 'Username no found!') {
                $payload = [
                    "username" => $this->request->getJsonVar('username'),
                    "password" => $this->request->getJsonVar('password'),
                    "join" => ["employee"]
                ];
                $builder = $this->qBuilder->openapi2Login($payload);
                // var_dump($builder);
                // return $this->respond($builder, 200);

                if ($builder->status == true) {
                    if (isset($builder->data->employee->nik)) {
                        $employee_show = $this->qbEmployee->show_by_nik($builder->data->employee->nik);
                        // return $this->respond($employee_show, 200);
                        if ($employee_show->status == true) {
                            $kode_site = $employee_show->rows[0]->KdSite;
                        }
                    } else {
                        $kode_site = null;
                    }

                    $sessData = [
                        "id" => $builder->data->id,
                        "name" => $builder->data->name,
                        "username" => $builder->data->username,
                        "company_id" => $builder->data->company_id,
                        "level_id" => $builder->data->level_id,
                        "phone_number" => $builder->data->phone_number,
                        "avatar" => $builder->data->avatar,
                        "token" => $builder->data->token,
                        "logged_in" => TRUE,
                        "dorbitt_in" => TRUE,
                        "logged_by" => "dorbitt",
                        "dorbitt_modules" => $builder->data->module_enabled,
                        "kode_site" => $kode_site
                    ];
                    session()->set($sessData);
                    return redirect()->to('/admin');
                    // return $this->respond($sessData, 200);
                } else {
                    $msg = $builder->messages . "<br>" . implode(" ", (array) $builder->errors);
                    session()->setFlashdata('msg', $msg);
                    return redirect()->to('/auth');
                }
            } else {
                $payload = [
                    "username" => getenv('dorbitt.username'),
                    "password" => getenv('dorbitt.password')
                ];
                $approval = $this->qBuilder->openapi2Login($payload);
                if (isset($approval->status)) {
                    if ($approval->status == true) {
                        $dorbitt_session = [
                            "dorbitt_account_id" => $approval->data->id,
                            "dorbitt_username" => $approval->data->username,
                            "dorbitt_company_id" => $approval->data->company_id,
                            "dorbitt_email" => $approval->data->email,
                            "dorbitt_avatar" => $approval->data->avatar,
                            "dorbitt_company_name" => $approval->data->company->name,
                            "dorbitt_company_avatar" => $approval->data->company->avatar,
                            "dorbitt_modules" => $approval->data->module_enabled,
                            "dorbitt_token" => $approval->data->token,
                        ];
                        session()->set($dorbitt_session);
                    }
                }

                if (isset($builder->status)) {
                    if ($builder->status == true) {
                        $data = $builder->data;
                        $user = $data->user;
                        $kdUser = $user->kdUser;
                        $nmUser = $user->nmUser;

                        $departement = $data->departement;
                        $dept_code = null;
                        $dept_name = null;
                        if ($departement) {
                            $dept_code = $departement[0]->dept_code;
                            $dept_name = $departement[0]->dept_name;
                        }

                        $sessData = [
                            "name" => $nmUser,
                            "username" => $kdUser,
                            "departement_kode" => $dept_code,
                            "departement" => $dept_name,
                            "avatar" => "https://cdn.dorbitt.my.id/icon/9131529.png",
                            "msdbToken" => $msdbToken,
                            "msdbName" => $msdbName,
                            'logged_in' => TRUE,
                            'herp_in' => TRUE,
                            "logged_by" => "herp"
                        ];
                        session()->set($sessData);

                        return redirect()->to('/admin');
                    }
                    session()->setFlashdata('msg', json_encode($builder->messages));
                    return redirect()->to('/auth');
                } else {
                    session()->setFlashdata('msg', json_encode($builder));
                    return redirect()->to('/auth');
                }
            } */
        } else {
            session()->setFlashdata('msg', "Silahkan pilih company");
            return redirect()->to('/auth');
        }
    }

    public function create_otp_email()
    {
        $payload = [
            "phone_number" => $this->request->getVar("phone_number"),
            "smtp_id" => getenv('smtp_id')
        ];

        $params = [
            "path"           => "auth/otp/email",
            "method"         => "POST",
            "payload"        => $payload,
            "headers"        => array(
                'Content-Type: application/json',
                'Company-Token: '.getenv('company_token')
            )
        ];

        $response = $this->cH->ummu2_v1_20250704($params);

        return $this->respond($response, 200);
    }

    public function create_otpSuccess()
    {
        $phone_number = $this->request->getVar('phone_number');
        $phone_number_encrypt = $this->encrypter->encrypt($phone_number);

        $text = 'auth/phone_number/login_otp?phone_number=' . $phone_number_encrypt;
        return redirect()->to($text);
    }

    public function create_otp_sms()
    {
        $builder = $this->qBuilder->create_otp_sms();
        return $this->respond($builder, 200);
    }

    public function create_otp_wa()
    {
        $builder = $this->qBuilder->create_otp_wa();
        return $this->respond($builder, 200);
    }

    public function logout()
    {
        $login_module = session()->get('login_module');

        session()->destroy();

        if ($login_module == 'iescm') {
            return redirect()->to('/auth/login/phone');
        } else if ($login_module == 'mcp') {
            return redirect()->to('/auth/login_mcp');
        } else {
            return redirect()->to('/auth');
        }
    }
}
