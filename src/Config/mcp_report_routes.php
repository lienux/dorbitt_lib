<?php

 $routes->group('report_ob', ['namespace' => 'Dorbitt\Controllers\Report'], static function ($routes) {
    $routes->get('/', 'ReportObController::index');
    $routes->get('hourly', 'ReportObController::hourly');
});