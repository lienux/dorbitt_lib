<?php
/**
    * =============================================
    * Author:       Ummu Ky
    * Website:      https://openapi2.com/
    * Email :       
    * Create date:  
    * Description:  
    * =============================================
*/

$routes->get('/', 'UmmuController::index', ['namespace' => 'Dorbitt\Controllers']);

$routes->group('auth', ['namespace' => 'Dorbitt\Controllers'], static  function ($routes) {
    $routes->get('/', 'LoginController::index');
    
    $routes->group('phone_number', function ($routes) {
        $routes->get('/', 'LoginController::oa2_index');
        $routes->post('find', 'LoginController::find');
        $routes->get('findSuccess', 'LoginController::findSuccess');
        $routes->get('login_password', 'LoginController::login_password');
        $routes->post('login_password_create', 'LoginController::login_password_create');
        $routes->get('login_otp', 'LoginController::login_otp');

        $routes->post('create_otp_email', 'LoginController::create_otp_email');
        $routes->post('create_otp_sms', 'LoginController::create_otp_sms');
        $routes->post('create_otp_wa', 'LoginController::create_otp_wa');

        $routes->get('create_otpSuccess', 'LoginController::create_otpSuccess');
    });

    // $routes->group('phone_number', function ($routes) {
    //     $routes->get('/', 'Auth\PhoneNumber::index');
    //     // $routes->get('find', 'Auth\PhoneNumber::find');
    //     $routes->post('find', 'Auth\PhoneNumber::find');
    //     $routes->post('get_otp', 'Auth\Login::get_otp');
    //     $routes->post('get_otp_email', 'Auth\Login::get_otp_email');
    //     $routes->post('get_otp_wa', 'Auth\Login::get_otp_wa');
    //     $routes->post('get_otp_sms', 'Auth\Login::get_otp_sms');
    // });

    $routes->group('oa2', function ($routes) {
        $routes->get('/', 'LoginController::oa2_index');
        $routes->get('create', 'LoginController::oa2_create');
        $routes->post('create', 'LoginController::oa2_create');
        // $routes->post('username', 'Auth\LoginController::username');
    });
});

$routes->group('admin', ['namespace' => 'Dorbitt\Controllers', 'filter' => 'auth'], static function($routes) {
    $routes->group('clients', function ($routes) {
        $routes->get('/', 'MsClientController::index');
        $routes->get('show', 'MsClientController::show');
        $routes->post('create', 'MsClientController::create');
        $routes->post('update/(:num)', 'MsClientController::update/$1');
    });

    $routes->group('ms_barge', function ($routes) {
        $routes->get('/', 'BargeController::index');
        $routes->get('show', 'BargeController::show');
    });

    $routes->group('tugboat', function ($routes) {
        $routes->get('/', 'TugboatController::index');
        $routes->get('show', 'TugboatController::show');
    });

    $routes->group('ms_activity', function ($routes) {
        $routes->get('/', 'MsActivityController::index');
        $routes->get('show', 'MsActivityController::show');
    });

    $routes->group('equipment', function ($routes) {
        $routes->get('/', 'MsEquipmentController::index');
        $routes->get('show', 'MsEquipmentController::show');
    });

    $routes->group('ms_location', function ($routes) {
        $routes->get('/', 'MsLocationController::index');
        $routes->get('show', 'MsLocationController::show');
    });

    $routes->group('project_site', function ($routes) {
        $routes->get('/', 'MsProjectSiteController::index');
        $routes->get('show', 'MsProjectSiteController::show');
    });

    $routes->group('sounding_report', function ($routes) {
        $routes->get('/', 'SoundingReportController::index');
        $routes->get('show', 'SoundingReportController::show');
    });

    $routes->group('barge_inspection_checklist', function ($routes) {
        $routes->get('/', 'BargeInspectionController::index');
        $routes->get('show', 'BargeInspectionController::show');
        $routes->get('show_equipment', 'BargeInspectionController::show_equipment');
        $routes->get('show_barge', 'BargeInspectionController::show_barge');
    });

    $routes->group('file_pomailer', function ($routes) {
        $routes->get('/', 'FilePomailerController::index');
        $routes->get('show', 'FilePomailerController::show');
    });

    $routes->group('passage_plan', function ($routes) {
        $routes->get('/', 'PassagePlanController::index');
    });

    $routes->group('dorbitt', function ($routes) {
        // $routes->get('/', 'DorbittController::index');
        
        $routes->group('encrypter', function ($routes) {
            $routes->get('generate_password', 'EncrypterController::generate_password');
        });
    });

    // Config
    $routes->group('config', function ($routes) {
        $routes->get('show_hierarchy_modules', 'ConfigController::show_hierarchy_modules');
        // $routes->group('config', function ($routes) {
        //     $routes->get('', 'PassagePlanController::index');
        // });
    });

    $routes->group('she_hazard_report', function ($routes) {
        $routes->get('/', 'HazardReportController::index');
        $routes->get('show', 'HazardReportController::show');
        $routes->get('kosong', 'HazardReportController::kosong');
        // $routes->get('show/(:any)', 'HazardReportController::show/$1');
        $routes->post('create', 'HazardReportController::create');
        $routes->put('update/(:num)', 'HazardReportController::update/$1');
        $routes->put('release', 'HazardReportController::release');
        $routes->put('approve', 'HazardReportController::approve');
        $routes->put('reject', 'HazardReportController::reject');
        $routes->delete('delete', 'HazardReportController::delete');

        $routes->get('number', 'HazardReportController::number');
    });

    // =============== openapi2 group ====================
    $routes->group('openapi2', function($routes) {
        $routes->get('/', 'Openapi2Controller::index');
        // $routes->get('show', 'AccountsController::show');
        // $routes->get('show/(:num)', 'AccountsController::show/$1');
        // $routes->post('create', 'AccountsController::create');
        // $routes->post('import', 'AccountsController::import');
        // $routes->put('update/(:num)', 'AccountsController::update/$1');
        // $routes->delete('delete/(:num)', 'AccountsController::delete/$1');
        
        // $routes->delete('multiple_delete', 'AccountsController::multiple_delete');
        // $routes->get('show_roles', 'AccountsController::show_roles');
        // // $routes->put('update_by_profile', 'AccountsController::update_by_profile');
    });

    // =============== include area ======================
    $routes->group('mcp_report', function ($routes) {
        require ROOTPATH . "vendor/dorbitt/lib/src/Config/mcp_report_routes.php";
    });
    require ROOTPATH . "vendor/dorbitt/lib/src/Config/mcp_report_routes.php";
});

$routes->group('mygallery', ['filter' => 'auth'], function ($routes) {
    $routes->group('photos', ['namespace' => 'Dorbitt\Controllers\MyGallery'], static function ($routes) {
        $routes->get('/', 'PhotosController::index');
        $routes->get('show', 'PhotosController::show');
        $routes->post('create', 'PhotosController::create');
        $routes->post('upload', 'PhotosController::upload');
        $routes->delete('delete/(:num)', 'PhotosController::delete/$1');
    });
});

$routes->group('ummu', ['namespace' => 'Dorbitt\Controllers'], static function ($routes) {
    $routes->group('auth', function ($routes) {
        $routes->group('phone_number', function ($routes) {
            $routes->get('/', 'LoginController::index');
            $routes->get('f_find', 'LoginController::index');
            $routes->get('f_login_password', 'LoginController::login_password');
            $routes->get('f_login_otp', 'LoginController::login_otp');

            $routes->post('create_otp_email', 'LoginController::create_otp_email');
            $routes->post('create_otp_sms', 'LoginController::create_otp_sms');
            $routes->post('create_otp_wa', 'LoginController::create_otp_wa');
        });

        $routes->get('show_msdb', 'LoginController::show_msdb');
        $routes->post('find_phone_number', 'LoginController::find_phone_number');
        $routes->post('create_otp', 'LoginController::create_otp');
        $routes->get('create_otp_email', 'LoginController::create_otp_email');
        $routes->post('create_otp_email', 'LoginController::create_otp_email');
        $routes->post('create_otp_sms', 'LoginController::create_otp_sms');
        $routes->post('create_otp_wa', 'LoginController::create_otp_wa');

        // $routes->group('login', function ($routes) {
        //     $routes->get('/', 'Auth\LoginController::index');
        //     $routes->get('phone', 'Auth\LoginController::phone');
        //     $routes->get('cloud', 'Auth\LoginController::cloud');
        //     $routes->get('create', 'Auth\LoginController::create');
        //     $routes->post('create', 'Auth\LoginController::create');
        //     $routes->post('create_without_msdb', 'Auth\LoginController::create_without_msdb');
        //     $routes->post('create_shakti', 'Auth\LoginController::create_shakti');
        //     $routes->post('create_with_phone', 'Auth\LoginController::create_with_phone');
        //     $routes->post('create_cloud', 'Auth\LoginController::create_with_cloud');

        //     $routes->post('username', 'Auth\LoginController::username');
        // });

        // $routes->group('login_mcp', function ($routes) {
        //     $routes->get('/', 'Auth\LoginController::mcp_index');
        //     $routes->get('create', 'Auth\LoginController::create');
        //     $routes->post('create', 'Auth\LoginController::create');
        //     $routes->post('username', 'Auth\LoginController::username');
        // });

        $routes->get('logout', 'Dorbitt\LoginController::logout');
        $routes->get('msdb', 'Dorbitt\LoginController::msdb');
    });

    $routes->get('company_profile', 'UmmuController::company_profile');
    
    $routes->group('session', ['namespace' => 'Dorbitt\Controllers'], static function ($routes) {
        $routes->get('show', 'DorbittController::session_show');
        $routes->get('destroy', 'DorbittController::session_destroy');
    });
});

$routes->group('encrypter', function ($routes) {
    $routes->get('generate_password', 'EncrypterController::generate_password');
    $routes->get('jwtEncrypt', 'EncrypterController::jwtEncrypt');
    $routes->get('jwtDecrypt', 'EncrypterController::jwtDecrypt');
});