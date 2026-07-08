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

$routes->group('form_konfirmasi_kehadiran_pertemuan_supplier', ['namespace' => 'Dorbitt\Controllers'], static function ($routes) {
    $routes->get('/', 'FormKehadiranController::index');
    $routes->post('create', 'FormKehadiranController::create');
});

$routes->group('encrypter', function ($routes) {
    $routes->get('generate_password', 'EncrypterController::generate_password');
    $routes->get('jwtEncrypt', 'EncrypterController::jwtEncrypt');
    $routes->get('jwtDecrypt', 'EncrypterController::jwtDecrypt');
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


// START ADMIN -----------------------------
$routes->group('admin', ['namespace' => 'Dorbitt\Controllers', 'filter' => 'auth'], static function($routes) {
    // g/{{module_kode}}/{{function}}
    $routes->get('g/(:any)', 'GlobalController::showAll/$1');

    $routes->group('employee', function ($routes) {
        $routes->get('/', 'EmployeeController::index');
        $routes->get('show', 'EmployeeController::show');
        $routes->post('show', 'EmployeeController::show');
        $routes->post('create', 'EmployeeController::create');
        $routes->post('update/(:num)', 'EmployeeController::update/$1');
        $routes->post('delete/(:num)', 'EmployeeController::delete/$1');
    });

    $routes->group('department', function ($routes) {
        $routes->get('/', 'DepartmentController::index');
        $routes->get('show', 'DepartmentController::show');
        $routes->post('show', 'DepartmentController::show');
        $routes->post('create', 'DepartmentController::create');
        $routes->post('update/(:num)', 'DepartmentController::update/$1');
        $routes->post('delete/(:num)', 'DepartmentController::delete/$1');
    });

    $routes->group('clients', function ($routes) {
        $routes->get('/', 'MsClientController::index');
        $routes->get('show', 'MsClientController::show');
        $routes->post('show', 'MsClientController::show');
        $routes->post('create', 'MsClientController::create');
        $routes->post('update/(:num)', 'MsClientController::update/$1');
        $routes->post('delete/(:num)', 'MsClientController::delete/$1');
    });

    $routes->group('ms_barge', function ($routes) {
        $routes->get('/', 'BargeController::index');
        $routes->get('show', 'BargeController::show');
        $routes->post('show', 'BargeController::show');
        $routes->post('create', 'BargeController::create');
        $routes->post('update/(:num)', 'BargeController::update/$1');
        $routes->post('delete/(:num)', 'BargeController::delete/$1');
    });

    $routes->group('tugboat', function ($routes) {
        $routes->get('/', 'TugboatController::index');
        $routes->get('show', 'TugboatController::show');
        $routes->post('show', 'TugboatController::show');
        $routes->post('create', 'TugboatController::create');
        $routes->post('update/(:num)', 'TugboatController::update/$1');
        $routes->post('delete/(:num)', 'TugboatController::delete/$1');
    });

    $routes->group('vessel', function ($routes) {
        $routes->get('/', 'VesselController::index');
        $routes->get('show', 'VesselController::show');
        $routes->post('show', 'VesselController::show');
        $routes->post('create', 'VesselController::create');
        $routes->post('update/(:num)', 'VesselController::update/$1');
        $routes->post('delete/(:num)', 'VesselController::delete/$1');

        $routes->get('show_data', 'VesselController::show_data');
    });

    $routes->group('master-data-pelabuhan', function ($routes) {
        $routes->get('/', 'PelabuhanController::index');
        $routes->get('show', 'PelabuhanController::show');
        $routes->post('show', 'PelabuhanController::show');
        $routes->post('create', 'PelabuhanController::create');
        $routes->post('update/(:num)', 'PelabuhanController::update/$1');
        $routes->post('delete/(:num)', 'PelabuhanController::delete/$1');

        $routes->get('show-country', 'PelabuhanController::showCountry');
        $routes->get('show-province', 'PelabuhanController::showProvince');
        $routes->get('show-ms-cost', 'PelabuhanController::showMsCost');
    });

    $routes->group('voyage_route', function ($routes) {
        $routes->get('/', 'VoyageRouteController::index');
        $routes->get('show', 'VoyageRouteController::show');
        $routes->post('show', 'VoyageRouteController::show');
        $routes->post('create', 'VoyageRouteController::create');
        $routes->post('update/(:num)', 'VoyageRouteController::update/$1');
        $routes->post('delete/(:num)', 'VoyageRouteController::delete/$1');

        $routes->get('show-pelabuhan', 'VoyageRouteController::show_pelabuhan');
        $routes->post('create-waypoint', 'VoyageRouteController::create_waypoint');
        $routes->post('update-waypoint/(:num)', 'VoyageRouteController::update_waypoint/$1');

        $routes->post('waypoint', 'VoyageRouteController::create_waypoint');
        $routes->put('waypoint/(:num)', 'VoyageRouteController::update_waypoint/$1');
        $routes->delete('waypoint/(:num)', 'VoyageRouteController::delete_waypoint/$1');
    });

    $routes->group('ms_activity', function ($routes) {
        $routes->get('/', 'MsActivityController::index');
        $routes->get('show', 'MsActivityController::show');
        $routes->post('show', 'MsActivityController::show');
        $routes->post('create', 'MsActivityController::create');
        $routes->post('update/(:num)', 'MsActivityController::update/$1');
        $routes->post('delete/(:num)', 'MsActivityController::delete/$1');
    });

    $routes->group('equipment', function ($routes) {
        $routes->get('/', 'MsEquipmentController::index');
        $routes->get('show', 'MsEquipmentController::show');
        $routes->post('show', 'MsEquipmentController::show');
        $routes->post('create', 'MsEquipmentController::create');
        $routes->post('update/(:num)', 'MsEquipmentController::update/$1');
        $routes->post('delete/(:num)', 'MsEquipmentController::delete/$1');
    });

    $routes->group('ms_location', function ($routes) {
        $routes->get('/', 'MsLocationController::index');
        $routes->get('show', 'MsLocationController::show');
        $routes->post('show', 'MsLocationController::show');
    });

    $routes->group('project_site', function ($routes) {
        $routes->get('/', 'MsProjectSiteController::index');
        $routes->get('show', 'MsProjectSiteController::show');
        $routes->post('show', 'MsProjectSiteController::show');
    });

    $routes->group('sounding_report', function ($routes) {
        $routes->get('/', 'SoundingReportController::index');
        $routes->get('show', 'SoundingReportController::show');
        $routes->post('show', 'SoundingReportController::show');
    });

    $routes->group('barge_inspection_checklist', function ($routes) {
        $routes->get('/', 'BargeInspectionController::index');
        $routes->get('show', 'BargeInspectionController::show');
        $routes->post('show', 'BargeInspectionController::show');

        $routes->get('show_equipment', 'BargeInspectionController::show_equipment');
        $routes->get('show_barge', 'BargeInspectionController::show_barge');
        $routes->get('show_ijo', 'BargeInspectionController::show_ijo');
    });

    $routes->group('shipping_instruction', function ($routes) {
        $routes->get('/', 'ShippingInstructionController::index');
        $routes->get('show', 'ShippingInstructionController::show');
        $routes->post('show', 'ShippingInstructionController::show');
        $routes->post('create', 'ShippingInstructionController::create');
        $routes->post('update/(:num)', 'ShippingInstructionController::update/$1');
        $routes->post('delete/(:num)', 'ShippingInstructionController::delete/$1');

        $routes->get('show_clients', 'ShippingInstructionController::show_clients');
        $routes->get('show_tugboat', 'ShippingInstructionController::show_tugboat');
        $routes->get('show_barge', 'ShippingInstructionController::show_barge');
        $routes->get('show_uom', 'ShippingInstructionController::show_uom');
        $routes->get('voyage-route', 'ShippingInstructionController::showVoyageRoute');
    });

    $routes->group('spal_standard', function ($routes) {
        $routes->get('/', 'SpalController::index');
        $routes->get('show', 'SpalController::show');
        $routes->post('show', 'SpalController::show');
        $routes->post('create', 'SpalController::create');
        $routes->post('update/(:num)', 'SpalController::update/$1');
        $routes->post('delete/(:num)', 'SpalController::delete/$1');

        $routes->get('show_clients', 'SpalController::show_clients');
        $routes->get('show_tugboat', 'SpalController::show_tugboat');
        $routes->get('show_barge', 'SpalController::show_barge');
        $routes->get('show_uom', 'SpalController::show_uom');
        $routes->get('show_si', 'SpalController::show_si');
    });

    $routes->group('freight_charter', function ($routes) {
        $routes->get('/', 'FreightCharterController::index');
        $routes->get('show', 'FreightCharterController::show');
        $routes->post('show', 'FreightCharterController::show');
        $routes->post('create', 'FreightCharterController::create');
        $routes->post('update/(:num)', 'FreightCharterController::update/$1');
        $routes->post('delete/(:num)', 'FreightCharterController::delete/$1');

        $routes->get('show_clients', 'FreightCharterController::show_clients');
        $routes->get('show_tugboat', 'FreightCharterController::show_tugboat');
        $routes->get('show_barge', 'FreightCharterController::show_barge');
        $routes->get('show_uom', 'FreightCharterController::show_uom');
        $routes->get('show_si', 'FreightCharterController::show_si');
    });

    $routes->group('time_charter', function ($routes) {
        $routes->get('/', 'TimeCharterController::index');
        $routes->get('show', 'TimeCharterController::show');
        $routes->post('show', 'TimeCharterController::show');
        $routes->post('create', 'TimeCharterController::create');
        $routes->post('update/(:num)', 'TimeCharterController::update/$1');
        $routes->post('delete/(:num)', 'TimeCharterController::delete/$1');

        $routes->get('show_clients', 'TimeCharterController::show_clients');
        $routes->get('show_tugboat', 'TimeCharterController::show_tugboat');
        $routes->get('show_barge', 'TimeCharterController::show_barge');
        $routes->get('show_uom', 'TimeCharterController::show_uom');
        $routes->get('show_si', 'TimeCharterController::show_si');
    });

    $routes->group('ijo_from_spal', function ($routes) {
        $routes->get('/', 'IjoFromSpalController::index');
        $routes->get('show', 'IjoFromSpalController::show');
        $routes->post('show', 'IjoFromSpalController::show');
        $routes->post('create', 'IjoFromSpalController::create');
        $routes->post('update/(:num)', 'IjoFromSpalController::update/$1');
        $routes->post('delete/(:num)', 'IjoFromSpalController::delete/$1');
        $routes->post('release/(:num)', 'IjoFromSpalController::release/$1');

        $routes->get('show_si', 'IjoFromSpalController::show_si');
        $routes->get('show_spal', 'IjoFromSpalController::show_spal');
        $routes->get('show_dept', 'IjoFromSpalController::show_dept');
    });

    $routes->group('gallery_photos', function ($routes) {
        $routes->get('/', 'MyGallery\PhotosController::index');
        $routes->get('show', 'MyGallery\PhotosController::show');
        $routes->post('show', 'MyGallery\PhotosController::show');
        $routes->post('create', 'MyGallery\PhotosController::create');
        $routes->post('upload', 'MyGallery\PhotosController::upload');
        $routes->delete('delete/(:num)', 'MyGallery\PhotosController::delete/$1');
    });

    $routes->group('gallery_files', function ($routes) {
        $routes->get('/', 'MyGallery\FilesController::index');
        $routes->get('show', 'MyGallery\FilesController::show');
        $routes->post('show', 'MyGallery\FilesController::show');
        $routes->post('create', 'MyGallery\FilesController::create');
        $routes->post('upload', 'MyGallery\FilesController::upload');
        $routes->delete('delete/(:num)', 'MyGallery\FilesController::delete/$1');
    });

    $routes->group('file_pomailer', function ($routes) {
        $routes->get('/', 'FilePomailerController::index');
        $routes->get('show', 'FilePomailerController::show');
        $routes->post('show', 'FilePomailerController::show');
    });

    $routes->group('passage_plan', function ($routes) {
        $routes->get('/', 'PassagePlanController::index');
        $routes->get('show', 'PassagePlanController::show');
        $routes->post('show', 'PassagePlanController::show');

        $routes->get('show_ijo', 'PassagePlanController::show_ijo');
        $routes->post('show_ijo', 'PassagePlanController::show_ijo');
    });

    $routes->group('time_sheet', function ($routes) {
        $routes->get('/', 'TimeSheetController::index');
        $routes->get('show', 'TimeSheetController::show');
        $routes->post('show', 'TimeSheetController::show');
        $routes->post('create', 'TimeSheetController::create');
        $routes->post('update/(:num)', 'TimeSheetController::update/$1');
        $routes->post('delete/(:num)', 'TimeSheetController::delete/$1');

        $routes->get('show_clients', 'TimeSheetController::show_clients');
        $routes->get('show_tugboat', 'TimeSheetController::show_tugboat');
        $routes->get('show_barge', 'TimeSheetController::show_barge');
        $routes->get('show_uom', 'TimeSheetController::show_uom');
        $routes->get('show_si', 'TimeSheetController::show_si');
        $routes->get('show_ijo', 'TimeSheetController::show_ijo');
    });

    $routes->group('vendor_verification', function ($routes) {
        $routes->get('/', 'VendorController::index_verification');
        $routes->get('show', 'VendorVerificationController::show_verification');
        $routes->post('show', 'VendorVerificationController::show_verification');
        // $routes->post('create', 'VendorController::create');
        // $routes->post('update/(:num)', 'VendorController::update/$1');
        // $routes->post('delete/(:num)', 'VendorController::delete/$1');
    });

    $routes->group('blast_whatsapp', function ($routes) {
        $routes->get('/', 'BlastWhatsappController::index');
        $routes->get('show', 'BlastWhatsappController::show');
        $routes->post('show', 'BlastWhatsappController::show');
        // $routes->post('create', 'BlastWhatsappController::create');
        // $routes->post('update/(:num)', 'BlastWhatsappController::update/$1');
        // $routes->post('delete/(:num)', 'BlastWhatsappController::delete/$1');
        $routes->post('send', 'BlastWhatsappController::send');
    });

    $routes->group('port-charges', function ($routes) {
        $routes->get('/', 'PortChargesController::index');
        $routes->get('show', 'PortChargesController::show');
        $routes->post('show', 'PortChargesController::show');
        $routes->post('create', 'PortChargesController::create');
        $routes->post('update/(:num)', 'PortChargesController::update/$1');
        $routes->post('delete/(:num)', 'PortChargesController::delete/$1');

        $routes->get('show-ijo', 'PortChargesController::show_ijo');
        $routes->get('show-port', 'PortChargesController::show_port');
        $routes->get('show-cost', 'PortChargesController::show_cost');
    });

    $routes->group('ms-costs', function ($routes) {
        $routes->get('/', 'MsCostsController::index');
        $routes->get('show', 'MsCostsController::show');
        $routes->post('show', 'MsCostsController::show');
        $routes->post('create', 'MsCostsController::create');
        $routes->post('update/(:num)', 'MsCostsController::update/$1');
        $routes->post('delete/(:num)', 'MsCostsController::delete/$1');
    });

    $routes->group('voyage-estimation-cost', function ($routes) {
        $routes->get('/', 'VoyageEstimationCostController::index');
        $routes->get('show', 'VoyageEstimationCostController::show');
        $routes->post('show', 'VoyageEstimationCostController::show');
        $routes->post('create', 'VoyageEstimationCostController::create');
        $routes->post('update/(:num)', 'VoyageEstimationCostController::update/$1');
        $routes->post('delete/(:num)', 'VoyageEstimationCostController::delete/$1');
    });

    $routes->group('unit_of_measure', function ($routes) {
        $routes->get('/', 'CoaController::index');
        $routes->get('show', 'CoaController::show');
        $routes->post('show', 'CoaController::show');
        $routes->post('create', 'CoaController::create');
        $routes->post('update/(:num)', 'CoaController::update/$1');
        $routes->post('delete/(:num)', 'CoaController::delete/$1');
    });

    $routes->group('crew_assignment', function ($routes) {
        $routes->get('/', 'CrewAssignmentController::index');
        $routes->get('show', 'CrewAssignmentController::show');
        $routes->post('show', 'CrewAssignmentController::show');
        $routes->post('/', 'CrewAssignmentController::create');
        // $routes->post('show', 'CrewAssignmentController::show');
        // $routes->post('create', 'CrewAssignmentController::create');
        // $routes->post('update/(:num)', 'CrewAssignmentController::update/$1');
        // $routes->post('delete/(:num)', 'CrewAssignmentController::delete/$1');

        $routes->get('tugboat', 'CrewAssignmentController::show_tugboat');
        $routes->get('crew', 'CrewAssignmentController::show_crew');
        $routes->get('crew-ranks', 'CrewAssignmentController::show_crew_ranks');
    });

    $routes->group('ms_crew', function ($routes) {
        $routes->get('/', 'CrewController::index');
        $routes->get('show', 'CrewController::show');
        $routes->post('create', 'CrewController::create');
        $routes->put('update/(:id)', 'CrewController::update/$1');
        $routes->delete('delete/(:id)', 'CrewController::delete/$1');
    });

    $routes->group('payslip', function ($routes) {
        $routes->get('/', 'PayslipController::index');
        $routes->get('show', 'PayslipController::show');
        // $routes->get('show/(:num)', 'PayslipController::show/$1');
        // $routes->get('print', 'PayslipController::print');
        // $routes->get('print/(:num)', 'PayslipController::print/$1');
        // $routes->get('download_pdf', 'PayslipController::download_pdf');
        // $routes->get('download_pdf/(:num)', 'PayslipController::download_pdf/$1');
        // $routes->get('delete_pdf', 'PayslipController::delete_pdf');
        // $routes->get('delete_pdf/(:num)', 'PayslipController::delete_pdf/$1');
        $routes->get('show_periode', 'PayslipController::show_periode');

        $routes->get('create_pdf', 'PayslipController::create_pdf');
        $routes->post('create_pdf', 'PayslipController::create_pdf');

        $routes->get('version1Alya_create_pdf', 'PayslipController::version1Alya_create_pdf');
        $routes->post('version1Alya_create_pdf', 'PayslipController::version1Alya_create_pdf');
        
        $routes->get('version1Alya_print_payslip_template', 'PayslipController::version1Alya_print_payslip_template');
        $routes->post('version1Alya_print_payslip_template', 'PayslipController::version1Alya_print_payslip_template');
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
        $routes->post('show', 'HazardReportController::show');
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
// END ADMIN -------------------------------


// WITH VERSION ----------------------------
$routes->group('v1-alya', function ($routes) {
    $routes->group('payslip-print', ['namespace' => 'Dorbitt\Controllers'], static function ($routes) {
        $routes->get('/', 'PayslipController::print');
        $routes->post('/', 'PayslipController::print');

        $routes->post('show_print', 'PayslipController::show_print');

        $routes->get('(:num)', 'PayslipController::print/$1');
        $routes->post('(:num)', 'PayslipController::print/$1');

        // $routes->get('/payslip_print', 'PayslipController::print');
        // $routes->post('/payslip_print', 'PayslipController::print');
        // $routes->get('/payslip_print/(:num)', 'PayslipController::print/$1');
    });

    $routes->group('auth', function ($routes) {
        // 
    });

    $routes->group('admin', ['filter' => 'auth'], function ($routes) {
        // 
    });
});

$routes->group('v2-aini', function ($routes) {
    // 
});

$routes->group('v3-ummu', function ($routes) {
    // 
});
// END VERSION -----------------------------


if (is_file(ROOTPATH . "vendor/dorbitt/lib/src/Config/auth.routes.php")) {
    require ROOTPATH . "vendor/dorbitt/lib/src/Config/auth.routes.php";
}

if (is_file(ROOTPATH . "vendor/dorbitt/lib/src/Config/imongali.routes.php")) {
    require ROOTPATH . "vendor/dorbitt/lib/src/Config/imongali.routes.php";
}