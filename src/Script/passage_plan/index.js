var app = {
    register: function () {
        app.config.autoload()
    },

    config: {
        autoload: function () {
            $ummu.func.location_hash()

            $ummu.dt.init2_kosong(table2);
            $ummu.dt.layout.buttonDefaultAndCustom($ummu.dt.init2, ['btn_new']);
            // $ummu.dt.init2.button('#dt_btn_new').disable();

            $ummu.localStorage.dt_default('passage_plan');
            $ummu.dt.layout.buttonAll($ummu.dt.init);

            $("#sailing_conditions").on("change", function() {
                // console.log($(this).val())
                if ($("#tugboat").val() == '') {
                    $ummu.views.errors_msg("Silahkan pilih IJO terlebih dahulu");
                    $("#sailing_conditions").val('')
                }else{
                    if ($(this).val() == 1) {
                        $("#kecepatan").val($("#tugboat").attr('data-ladensea'))
                    }else{
                        $("#kecepatan").val($("#tugboat").attr('data-ballastsea'))
                    }
                }
            })
        },
    },

    controllers: {
        on_btn_getData_click: function () {
            $ummu.views.after_sbToolbar_getData();
            app.views.forClear()
        },

        show: function (params) {
            if ($ummu.dt.is_init(table) == true) {
                $ummu.dt.init_destroy();
            }

            $ummu.dt.init = new DataTable(
                table,
                app.dt.default.config_show()
            );

            $ummu.dt.layout.buttonAll($ummu.dt.init)

            $ummu.dt.init.on('xhr', function () {
                var response = $ummu.dt.init.ajax.json();
                if (response.status == true) {
                    localStorage.setItem($localStrgKey, JSON.stringify(response));
                }else{
                    $ummu.modal.ummu_msg(response.message)
                }
            });
        },

        sbNew: function () {
            app.views.forClear()
            $("#status").html('<span class="badge badge-secondary">Draft</span>')
            $("#from_dept").val($ummu.vars.employee.department).attr('data-id', $ummu.vars.employee.department_id)
            $ummu.dt.init2.button('#dt_btn_new').enable();
        },

        sbSave: function () {
            var ijo_id = $("#ijo").attr('data-id');
            var tgl = $("#iDate").val();
            var barge_id = $("#barge").attr('data-id');
            var location = $("#location").val();
            var auditor_id = $("#auditor").attr('data-id');
            var auditor_jobtitle_id = $("#job_title").attr('data-id');

            // $ummu.vars.formData.append("spal_id", spal_id);
            // $ummu.vars.formData.append("spal_number", spal_number);
            // $ummu.vars.formData.append("tgl", tgl);
            // $ummu.vars.formData.append("number", number);
            // $ummu.vars.formData.append("from_dept_id", from_dept_id);
            // $ummu.vars.formData.append("to_dept_id", to_dept_id);

            // $ummu.vars.formData.append("client_id", client_id);
            // $ummu.vars.formData.append("tugboat_id", tugboat_id);
            // $ummu.vars.formData.append("barge_id", barge_id);
            // $ummu.vars.formData.append("barge_loa", ukuran_barge);
            // $ummu.vars.formData.append("tonnage", tonnage);
            // $ummu.vars.formData.append("uom_id", uom_id);

            // $ummu.vars.formData.append("eta_loading_port", eta_loading_port);
            // $ummu.vars.formData.append("eta_loading_port_to", eta_loading_port_to);
            // $ummu.vars.formData.append("eta_discharge_port", eta_discharge_port);

            // $ummu.vars.formData.append("loading_port", loading_port);
            // $ummu.vars.formData.append("discharge_port", discharge_port);

            var payload = {
                "ijo_id": ijo_id,
                "tgl": tgl,
                "barge_id": barge_id,
                "location": location,
                "auditor_id": auditor_id,
                "auditor_jobtitle_id": auditor_jobtitle_id,
            };

            const id = $ummu.url.getParam('id');

            if (id) {
                var func = "update/" + id
            }else{
                var func = "create"
            }

            // var params = {
            //     "function": func,
            //     "data": $ummu.vars.formData,
            //     "loader": true,
            // };

            const validation = app.validation.save();

            if (validation.length > 0) {
                $ummu.views.errors_msg(validation)
                $(".btn-endis").removeClass('btn-outline-secondary').addClass('btn-primary')
                $ummu.dt.init2.button('#dt_btn_new').disable();
            }else{
                // var ummu = $ummu.ajax.ummu7(params);   
                // ummu.done(function(result) {
                //     const response = JSON.parse(result);
                //     $ummu.views.after_sbToolbar_save(response, func, id, payload);

                //     if (response.status == true) {
                //         $("#file_url").attr("href", response.data.fileUrl)
                //         let is_release = response.data.is_release;
                //         if (is_release == null || is_release == '' || is_release == 0) {
                //             $ummu.button.sbBtnToolbar.addRemove_btnRelease('add');
                //         }else{
                //             $ummu.button.sbBtnToolbar.addRemove_btnRelease('rm');
                //         }
                //     }else{
                //         $(".btn-endis").removeClass('btn-outline-secondary').addClass('btn-primary')
                //     }
                // }).fail(function() {
                //     // An error occurred
                //     console.log(ummu)
                // });
            }
        },

        sbCancle: function () {
            if ($ummu.url.getParam('id')) {
                // 
            }else{
                app.views.forClear()
            }
        },

        sbEdit: function () {
            $ummu.dt.init2.button('#dt_btn_new').enable();
        },

        sbDelete: function(id) {
            $("#modalDeleteConfirm").modal('hide')
            var params = {
                "function": "delete/" + id,
                "method": "POST",
                "data": [],
                "cache": true,
                "contentType": "application/json",
                "dataType": "json",
                "loader": true,
                "textLoader": "Delete on progress..."
            };

            var ummu = $ummu.ajax.ummu8(params);   
            ummu.done(function(result) {
                $ummu.views.after_sbToolbar_delete(id, result);
                app.views.forClear()
            }).fail(function() {
                // An error occurred
                console.log(ummu)
            });
        },

        sbClear: function() {
            app.views.forClear()
        },

        sbRelease: function() {
            $("#modalReleaseConfirm").modal('hide')
            var id = $ummu.url.getParam('id');
            var func = "release/" + id;
            var payload = [];

            var params = {
                "function": func,
                "method": "POST",
                "data": [],
                "cache": true,
                "contentType": "application/json",
                "dataType": "json",
                "loader": true,
                "textLoader": "Release on progress...",
            };

            var ummu = $ummu.ajax.ummu8(params);   
            ummu.done(function(result) {
                payload = result.data;
                $ummu.views.after_sbToolbar_save(result, func, id, payload);
                if (result.status == true) {
                    if (result.data.is_release == 1) {
                        $ummu.button.sbBtnToolbar.addRemove_btnRelease('rm');
                        $ummu.dt.init2.button('#dt_btn_new').disable();
                    }
                }
            }).fail(function() {
                // An error occurred
                console.log(ummu)
            });
        },

        on_showLeftModal: function(id) {
            // console.log(id)
            if (id == 'client') {
                $ummu.controllers.show_clients(id);
            }else if (id == 'tugboat') {
                $ummu.controllers.show_tugboat(id);
            }else if (id == 'barge') {
                $ummu.controllers.show_barge(id);
            }else if (id == 'uom') {
                $ummu.controllers.show_uom(id);
            }else if (id == 'shipment') {
                $ummu.controllers.show_shippingInstruction(id);
            }else if (id == 'spal') {
                $ummu.controllers.show_spal(id);
            }else if (id == 'to_dept') {
                $ummu.controllers.show_dept(id);
            }else if (id == 'ijo') {
                $ummu.controllers.show_ijo(id);
            }else if (id == 'auditor') {
                $ummu.controllers.show_crew(id);
            }else{
                //
            }
        },

        on_click_tbody_trtd_child1: function(row) {
            // console.log(row)
            app.views.setRow_toForm_freightCharter(row)
        },

        on_click_tbody_trtd_child_spal: function(row) {
            console.log(row)
            $("#loading_port").val(row.loading_port)
            $("#discharge_port").val(row.discharge_port)

            $("#client").val(row.client_name).attr('data-id', row.client_id)
            $("#tugboat").val(row.tugboat_name).attr('data-id', row.tugboat_id)
            $("#barge").val(row.barge_name).attr('data-id', row.barge_id)
            $("#ukuran_barge").val(row.barge_loa)
            $("#tonnage").val(row.qty)
            $("#uom").val(row.uom_kode).attr('data-id', row.uom_id)

            $("#eta_loading_port").val(row.loading_availability_date_from + " - " + row.loading_availability_date_to)
            .attr('data-from', row.loading_availability_date_from)
            .attr('data-to', row.loading_availability_date_to)

            $("#si_number").val(row.si_number)
            $("#si_url").attr('href', row.si_fileUrl)
        },

        on_click_tbody_trtd_child_dept: function(row) {
            // console.log(row)
            $("#to_dept").val(row.name).attr('data-id', row.id);
        },

        on_click_tbody_trtd_child_ijo: function(row) {
            $("#ijo").val(row.number).attr('data-id', row.id);
            $("#tugboat").val(row.tugboat_name)
            .attr('data-id', row.tugboat_id)
            .attr('data-ladensea', row.laden_sea_speed)
            .attr('data-ballastsea', row.ballast_sea_speed)
        },

        on_dtBtnNew_click: function() {
            // var kondisiBerlayar = $("#sailing_conditions").val();

            // if (kondisiBerlayar == "" || kondisiBerlayar == null) {
            //     $ummu.views.errors_msg("Silahkan pilih Conditions terlebih dahulu.");
            // }else{
            //     $("#modalForm_inputWaypoint").modal('show');
            // }
            $("#modalForm_inputWaypoint").modal('show');
        },

        contoh: function() {
            const wp1 = { lat: $ummu.func.parseCoordinate("04-20.000S"), lon: $ummu.func.parseCoordinate("113-50.000E") };
            const wp2 = { lat: $ummu.func.parseCoordinate("05-00.000S"), lon: $ummu.func.parseCoordinate("114-30.000E") };

            const result = $ummu.func.calculateLeg(wp1.lat, wp1.lon, wp2.lat, wp2.lon);
            console.log(`Haluan: ${result.bearing}°T, Jarak: ${result.distance} NM`);

            // Untuk estimasi total (Asumsi kecepatan 10 knots, konsumsi 100 liter/jam)
            const summary = $ummu.func.calculateVoyageSummary([wp1, wp2], 10, 100);
            console.log(summary);
        },

        contoh2: function() {
            // Data dari Form atau API
            const passageData = {
                voyage_id: "V-2023-001",
                config: { speed: 12.5, consumption: 150 },
                waypoints: [
                    { wp_name: "WP 01", lat_raw: "04-20.000S", lon_raw: "113-50.000E" },
                    { wp_name: "WP 02", lat_raw: "05-00.000S", lon_raw: "114-30.000E" },
                    { wp_name: "WP 03", lat_raw: "06-10.000S", lon_raw: "115-20.000E" }
                ]
            };

            // Eksekusi
            const report = $ummu.func.processPassagePlan(passageData);
            console.log(JSON.stringify(report, null, 2));
        }
    },

    views: {
        formParams: function() {
            return $("#form_input .endis");
        },

        setRow_toForm: function(row) {
            // console.log(row)
            $("#spal").val(row.spal_number).attr('data-id', row.spal_id)
            $("#iDate").val(row.tgl)
            $("#number").val(row.number)
            $("#from_dept").val(row.from_dept_name).attr('data-id', row.from_dept_id)
            $("#to_dept").val(row.to_dept_name).attr('data-id', row.to_dept_id)

            $("#client").val(row.client_name).attr('data-id', row.client_id)
            $("#tugboat").val(row.tugboat_name).attr('data-id', row.tugboat_id)
            $("#barge").val(row.barge_name).attr('data-id', row.barge_id)
            $("#ukuran_barge").val(row.barge_loa)
            // $("#load_type").val(row.load_type)
            $("#tonnage").val($ummu.formatter.id(row.qty))
            $("#uom").val(row.uom_kode).attr('data-id', row.uom_id)

            $("#eta_loading_port").val(row.eta_loading_port)
            $("#eta_loading_port_to").val(row.eta_loading_port_to)
            $("#loading_port").val(row.loading_port)
            $("#discharge_port").val(row.discharge_port)
            $(".custom-file-label").html(row.fileNameOrigin)
            $("#file_url").attr("href", row.fileUrl)

            if (row.fileNameOrigin) {
                // $("#form_input #file_url span").html(row.fileNameOrigin)
                $("#file_url").attr("href", row.fileUrl)
            }else{
                // $("#form_input #file_url span").html("File not available.")
                $(".custom-file-label").html('No file...')

            }

            $ummu.views.setIdentitiyToForm(row)

            $("#ummu_nav_tab #nav-tab-listData").removeClass("active")
            $("#ummu_tab_contnet #nav-listData").removeClass("show active")
            
            $("#ummu_nav_tab #nav-tab-form").addClass("active")
            $("#ummu_tab_contnet #nav-form").addClass("show active")

            $ummu.button.sbBtn_on_showData()

            if (row.is_release == null || row.is_release == '' || row.is_release == 0) {
                $ummu.button.sbBtnToolbar.addRemove_btnRelease('add');
                $ummu.button.sbBtnToolbar.addRemove_btnEdit('add')
                $ummu.button.sbBtnToolbar.addRemove_btnDelete('add')

                $("#status").html('<span class="badge badge-secondary">Draft</span>')
            }else{
                $ummu.button.sbBtnToolbar.addRemove_btnRelease('rm');
                // $('#btn_edit, #btn_delete').addClass('collapse')
                $ummu.button.sbBtnToolbar.addRemove_btnEdit('rm')
                $ummu.button.sbBtnToolbar.addRemove_btnDelete('rm')

                if (row.is_release == 1) {
                    $("#status").html('<span class="badge badge-secondary">Draft</span>')
                }else if (row.is_release == 2) {
                    $("#status").html('<span class="badge badge-primary">Approve</span>')
                }else if (row.is_release == 3) {
                    $("#status").html('<span class="badge badge-warning">Progress</span>')
                }else if (row.is_release == 4) {
                    $("#status").html('<span class="badge badge-success">Done</span>')
                }
            }
        },

        forClear: function() {
            $("#form_input input").val('');
            $("#status").html('')
            $ummu.dt.init2.button('#dt_btn_new').disable();

            $("#created_at").html('');
            $("#updated_at").html('');
            $("#created_by").html('');
            $("#updated_by").html('');
        },
    },

    dt: {
        default: {
            config_show: function () {
                return {
                    ajax: {
                        dataSrc: "rows",
                        url: $ummu.vars.page_url + "show",
                        data: function (d) {
                            // // d.myKey = "myValue";
                            // // d.custom = $('#myInput').val();
                            // // d.release = [0];
                            // // etc
                            // d.tgl = tgl.replace(/-/g, "");
                            // d.tgl2 = tgl2.replace(/-/g, "");
                            // d.site = site;
                        },
                    },
                    columns: app.dt.default.config_columns(),
                    processing: true,
                    // serverSide: true,
                    responsive: true,
                    keys: true,
                    deferLoading: 57,
                    lengthMenu: [10, 50, 100, { label: "All", value: -1 }],
                    layout: {
                        topStart: {
                            buttons: [],
                        }
                    },
                    columnDefs: app.dt.default.config_columnDefs(),
                    select: $ummu.dt.config.select(),
                    // order: [[26, "asc"],[27,"asc"]],
                    // rowGroup: app.dt.clients.config_rowGroup(),
                    // fixedColumns: {
                    //     start: 2,
                    //     // end: 1
                    // },
                    paging: true,
                    // scrollCollapse: true,
                    // scrollX: true,
                    // scrollY: '60vh',
                    drawCallback: function (settings) {
                        // var api = this.api();
                    },
                };
            },  
            config_columns: function () {
                let columns = [
                    { data: null, render: DataTable.render.select() },
                    { data: "id"},
                    { data: "kode"},
                    { data: "name"},
                    { data: "capacity"},
                    { data: "is_rental"},
                ];
        
                return columns;
            },  
            config_columnDefs: function() {
                let columnDefs = [
                    {
                        targets: 0,
                        orderable: false,
                        render: DataTable.render.select(),
                    },
                    // { 
                    //     targets: [26,27], 
                    //     visible: false 
                    // },
                ];
                return columnDefs;
            },  
            config_rowGroup: function() {
                let rowGroup = {
                    dataSrc: ["tipe","unit_code"],
                    startRender: function (rows, group) {
                    // Display the group name and the number of rows in that group
                    return group + " (" + rows.count() + " rows)";
                    },
                    endRender: function (rows, group, level) {
                    // =======================================================
                    // OB ====================================================
                    // =======================================================
                    var day_rit_ob_count = rows
                    .data()
                    .pluck('day_rit_ob')
                    .reduce( function (a, b) {
                        return parseFloat(a) + parseFloat(b);
                    }, 0) ;
        
                    var night_rit_ob_count = rows
                    .data()
                    .pluck('night_rit_ob')
                    .reduce( function (a, b) {
                        return parseFloat(a) + parseFloat(b);
                    }, 0) ;
        
                    var total_rit_ob_count = rows
                    .data()
                    .pluck('total_rit_ob')
                    .reduce( function (a, b) {
                        return parseFloat(a) + parseFloat(b);
                    }, 0) ;

                    var day_ob_count = rows
                    .data()
                    .pluck('day_ob')
                    .reduce( function (a, b) {
                        return parseFloat(a) + parseFloat(b);
                    }, 0) ;
        
                    var night_ob_count = rows
                    .data()
                    .pluck('night_ob')
                    .reduce( function (a, b) {
                        return parseFloat(a) + parseFloat(b);
                    }, 0) ;

                    var total_ob_count = rows
                    .data()
                    .pluck('total_ob')
                    .reduce( function (a, b) {
                        return parseFloat(a) + parseFloat(b);
                    }, 0) ;
                    
                    
                    // =========================================================
                    // Coal Getting ============================================
                    // =========================================================
                    var day_rit_cg_count = rows
                    .data()
                    .pluck('day_rit_cg')
                    .reduce( function (a, b) {
                        return parseFloat(a) + parseFloat(b);
                    }, 0) ;
        
                    var night_rit_cg_count = rows
                    .data()
                    .pluck('night_rit_cg')
                    .reduce( function (a, b) {
                        return parseFloat(a) + parseFloat(b);
                    }, 0) ;

                    var total_rit_cg_count = rows
                    .data()
                    .pluck('total_rit_cg')
                    .reduce( function (a, b) {
                        return parseFloat(a) + parseFloat(b);
                    }, 0) ;

                    var day_cg_count = rows
                    .data()
                    .pluck('day_cg')
                    .reduce( function (a, b) {
                        return parseFloat(a) + parseFloat(b);
                    }, 0) ;
        
                    var night_cg_count = rows
                    .data()
                    .pluck('night_cg')
                    .reduce( function (a, b) {
                        return parseFloat(a) + parseFloat(b);
                    }, 0) ;

                    var total_cg_count = rows
                    .data()
                    .pluck('total_cg')
                    .reduce( function (a, b) {
                        return parseFloat(a) + parseFloat(b);
                    }, 0) ;
                    

                    // =========================================================
                    // Coal Hauling ============================================
                    // =========================================================
                    var day_rit_cl_count = rows
                    .data()
                    .pluck('day_rit_cl')
                    .reduce( function (a, b) {
                        return parseFloat(a) + parseFloat(b);
                    }, 0) ;
        
                    var night_rit_cl_count = rows
                    .data()
                    .pluck('night_rit_cl')
                    .reduce( function (a, b) {
                        return parseFloat(a) + parseFloat(b);
                    }, 0) ;

                    var total_rit_cl_count = rows
                    .data()
                    .pluck('total_rit_cl')
                    .reduce( function (a, b) {
                        return parseFloat(a) + parseFloat(b);
                    }, 0) ;

                    var day_cl_count = rows
                    .data()
                    .pluck('day_cl')
                    .reduce( function (a, b) {
                        return parseFloat(a) + parseFloat(b);
                    }, 0) ;
        
                    var night_cl_count = rows
                    .data()
                    .pluck('night_cl')
                    .reduce( function (a, b) {
                        return parseFloat(a) + parseFloat(b);
                    }, 0) ;

                    var total_cl_count = rows
                    .data()
                    .pluck('total_cl')
                    .reduce( function (a, b) {
                        return parseFloat(a) + parseFloat(b);
                    }, 0) ;
                    
                    // ===========================================================================
                    var fuel_count = rows
                    .data()
                    .pluck('fuel')
                    .reduce( function (a, b) {
                        return parseFloat(a) + parseFloat(b);
                    }, 0) ;
        
                        
                    if (level === 0) {
                        let tr = document.createElement('tr');
                        let classs = $ummu.dt.endRender_class();
                        $ummu.dt.addCell(tr, group, 2, classs);
                        $ummu.dt.addCell(tr, $ummu.helpers.currency.us(day_rit_ob_count),null,classs);
                        $ummu.dt.addCell(tr, $ummu.helpers.currency.us(night_rit_ob_count),null,classs);
                        $ummu.dt.addCell(tr, $ummu.helpers.currency.us(total_rit_ob_count),null,classs);
                        $ummu.dt.addCell(tr, $ummu.helpers.currency.us(day_ob_count),null,classs);
                        $ummu.dt.addCell(tr, $ummu.helpers.currency.us(night_ob_count),null,classs);
                        $ummu.dt.addCell(tr, $ummu.helpers.currency.us(total_ob_count),null,classs);

                        $ummu.dt.addCell(tr, $ummu.helpers.currency.us(day_rit_cg_count),null,classs);
                        $ummu.dt.addCell(tr, $ummu.helpers.currency.us(night_rit_cg_count),null,classs);
                        $ummu.dt.addCell(tr, $ummu.helpers.currency.us(total_rit_cg_count),null,classs);
                        $ummu.dt.addCell(tr, $ummu.helpers.currency.us(day_cg_count),null,classs);
                        $ummu.dt.addCell(tr, $ummu.helpers.currency.us(night_cg_count),null,classs);
                        $ummu.dt.addCell(tr, $ummu.helpers.currency.us(total_cg_count),null,classs);

                        $ummu.dt.addCell(tr, $ummu.helpers.currency.us(day_rit_cl_count),null,classs);
                        $ummu.dt.addCell(tr, $ummu.helpers.currency.us(night_rit_cl_count),null,classs);
                        $ummu.dt.addCell(tr, $ummu.helpers.currency.us(total_rit_cl_count),null,classs);
                        $ummu.dt.addCell(tr, $ummu.helpers.currency.us(day_cl_count),null,classs);
                        $ummu.dt.addCell(tr, $ummu.helpers.currency.us(night_cl_count),null,classs);
                        $ummu.dt.addCell(tr, $ummu.helpers.currency.us(total_cl_count),null,classs);                

                        $ummu.dt.addCell(tr, $ummu.helpers.currency.us(fuel_count),null,classs);
                        $ummu.dt.addCell(tr, '', 5, classs);
                        return tr;
                    } else if (level === 1) {
                        let tr = document.createElement('tr');
                        let classs = 'text-right font-weight-bold bg-warning';
                        $ummu.dt.addCell(tr, '', 4);
                        $ummu.dt.addCell(tr, $ummu.helpers.currency.us(total_rit_ob_count),null,classs);
                        $ummu.dt.addCell(tr, '', 2);
                        $ummu.dt.addCell(tr, $ummu.helpers.currency.us(total_ob_count),null,classs);
                        $ummu.dt.addCell(tr, '', 2);
                        $ummu.dt.addCell(tr, $ummu.helpers.currency.us(total_rit_cg_count),null,classs);
                        $ummu.dt.addCell(tr, '', 2);
                        $ummu.dt.addCell(tr, $ummu.helpers.currency.us(total_cg_count),null,classs);
                        $ummu.dt.addCell(tr, '', 2);
                        $ummu.dt.addCell(tr, $ummu.helpers.currency.us(total_rit_cl_count),null,classs);
                        $ummu.dt.addCell(tr, '', 2);
                        $ummu.dt.addCell(tr, $ummu.helpers.currency.us(total_cl_count),null,classs);
                        $ummu.dt.addCell(tr, $ummu.helpers.currency.us(fuel_count),null,classs);
                        $ummu.dt.addCell(tr, '', 5);            
                        return tr;
                    }          
                    }
                };
        
                return rowGroup;
            },
        },
    },
};

$(document).ready(function () {
    app.config.autoload()
});