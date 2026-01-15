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

$routes->group('auth', ['namespace' => 'Dorbitt\Controllers'], static  function ($routes) {
    $routes->get('/', 'LoginController::index');
    
    $routes->group('phone_number', function ($routes) {
        $routes->get('/', 'LoginController::oa2_index');
        $routes->post('find', 'LoginController::find');
        $routes->get('findSuccess', 'LoginController::findSuccess');
        $routes->get('login_password', 'LoginController::login_password');
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

$routes->group('admin', function($routes) {
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

    $routes->group('file_pomailer', ['namespace' => 'Dorbitt\Controllers'], static function ($routes) {
        $routes->get('/', 'FilePomailerController::index');
        $routes->get('show', 'FilePomailerController::show');
    });

    $routes->group('passage_plan', ['namespace' => 'Dorbitt\Controllers'], static function ($routes) {
        $routes->get('/', 'PassagePlanController::index');
    });
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