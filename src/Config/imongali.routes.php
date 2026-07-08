<?php

if (getEnv('app.type') == 'imongali') {
    $routes->group('blog', ['namespace' => 'Dorbitt\Controllers'], static function ($routes) {
        $routes->get('show_activity', 'BlogController::show_activity');
    });

    $routes->get('(:any)', 'UmmuController::index/$1', ['namespace' => 'Dorbitt\Controllers']);
}
