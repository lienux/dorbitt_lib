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
    $routes->group('session', ['namespace' => 'Dorbitt\Controllers'], static function ($routes) {
        $routes->get('show', 'DorbittController::session_show');
        $routes->get('destroy', 'DorbittController::session_destroy');
    });
});