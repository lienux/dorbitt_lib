var app = {
    register: function () {
        app.config.autoload()
    },

    config: {
        autoload: function () {
            $ummu.func.location_hash()
            $ummu.localStorage.dt_default($localStrgKey);
            $ummu.dt.layout.buttonAll($ummu.dt.init);

            // $ummu.dt.init.on("click", "tbody tr td:nth-child(2)", function () {
            //     var row = $ummu.dt.init.row(this).data();
            //     // console.log(row)
            //     $ummu.url.setParamFromRow(row)
            //     // $ummu.vars.is_row = true;
            //     // app.controllers.detail(row);
            //     app.views.setRow_toForm(row);
            // });
        },
    },

    vars: {
        initTable2: null,
        runing_id: null,
        init: null,

        // general_information: function() {
        //     return {
        //         "type": $("#form_input #type").val(),
        //         "kode": $("#form_input #kode").val(),
        //         "name": $("#form_input #name").val(),
        //         "flag_registry": $("#form_input #flag_registry").val(),
        //         "classification": $("#form_input #classification").val(),
        //         "yearBuild_place": $("#form_input #yearBuild_place").val(),
        //     }
        // },

        // machinary_propulsion: function() {
        //     return {
        //         "MainEngines": $("#form_input #MainEngines").val(),
        //         "BrandMainEngines": $("#form_input #BrandMainEngines").val(),
        //         "AuxiliaryEngines": $("#form_input #AuxiliaryEngines").val(),
        //         "BrandAuxiliaryEngines": $("#form_input #BrandAuxiliaryEngines").val(),
        //         "HorsePower": $("#form_input #HorsePower").val(),
        //         "lightship": $("#form_input #lightship").val(),
        //         "propulsion": $("#form_input #propulsion").val(),
        //         "ServiceSpeed": $("#form_input #ServiceSpeed").val(),
        //     }
        // },

        // tank_capacity:function() {
        //     return {
        //         "fot": $("#form_input #fot").val(),
        //         "fwt": $("#form_input #fwt").val(),
        //     }
        // },

        // dimension_capacity:function() {
        //     return {
        //         "loa": $("#form_input #loa").val(),
        //         "breadth": $("#form_input #breadth").val(),
        //         "depth": $("#form_input #depth").val(),
        //         "MaxDraft": $("#form_input #MaxDraft").val(),
        //         "Sideboard": $("#form_input #Sideboard").val(),
        //         "GrossTonnage": $("#form_input #GrossTonnage").val(),
        //         "Deadweight": $("#form_input #Deadweight").val(),
        //         "DeckStrength": $("#form_input #DeckStrength").val(),
        //         "NetTonnage": $("#form_input #NetTonnage").val(),
        //     }
        // },

        // fuel_consumtion:function() {
        //     return {
        //         "fuelConsumtion_laden_river": $("#form_input #fuelConsumtion_laden_river").val(),
        //         "fuelConsumtion_laden_sea": $("#form_input #fuelConsumtion_laden_sea").val(),
        //         "fuelConsumtion_ballast_river": $("#form_input #fuelConsumtion_ballast_river").val(),
        //         "fuelConsumtion_ballast_sea": $("#form_input #fuelConsumtion_ballast_sea").val(),
        //         "fuelConsumtion_runningfree": $("#form_input #fuelConsumtion_runningfree").val(),
        //         "fuelConsumtion_standby": $("#form_input #fuelConsumtion_standby").val(),
        //     }
        // },

        // speed:function() {
        //     return {
        //         "speed_laden_river": $("#form_input #speed_laden_river").val(),
        //         "speed_laden_sea": $("#form_input #speed_laden_sea").val(),
        //         "speed_ballast_river": $("#form_input #speed_ballast_river").val(),
        //         "speed_ballast_sea": $("#form_input #speed_ballast_sea").val(),
        //         "speed_runningfree": $("#form_input #speed_runningfree").val(),
        //     }
        // },
    },

    controllers: {
        index: function() {
            $ummu.dt.controllers.index();
        },

        // Digunakan untuk mengambil data dari database / API, dan terdapat pengaturannya setelah proses xhr selesai.
        show: function () {
            $ummu.dt.controllers.reload()

            $ummu.dt.init.on('xhr.dt', function (e, settings, json, xhr) {
                // Gunakan parameter 'json' langsung, bukan .ajax.json()
                if (json && json.status === true) {
                    if (localStorage.getItem('isDataLocalStorage') == 'true') {
                        localStorage.setItem($ummu.vars.module_kode, JSON.stringify(json));
                    }else{
                        localStorage.removeItem($ummu.vars.module_kode);
                    }
                } else {
                    console.warn("Status response false atau JSON tidak valid");
                }
            });
        },

        // sbNew: function () {
        //     app.views.forClear()
        //     $("#status").html('<span class="badge badge-secondary">Draft</span>')
        //     $("#from_dept").val($ummu.vars.employee.department).attr('data-id', $ummu.vars.employee.department_id)
        // },

        // sbSave: function () {
        //     var spal_id = $("#spal").attr('data-id');
        //     var spal_number = $("#spal").val();
        //     var tgl = $("#iDate").val();
        //     var number = $("#number").val();
        //     var from_dept_id = $("#from_dept").attr('data-id');
        //     var to_dept_id = $("#to_dept").attr('data-id');

        //     var client_id = $("#client").attr('data-id');
        //     var tugboat_id = $("#tugboat").attr('data-id');
        //     var barge_id = $("#barge").attr('data-id');
        //     var ukuran_barge = $("#ukuran_barge").val();
        //     var tonnage = $("#tonnage").val();
        //     var uom_id = $("#uom").attr('data-id');

        //     var eta_loading_port = $("#eta_loading_port").attr('data-from');
        //     var eta_loading_port_to = $("#eta_loading_port").attr('data-to');
        //     var eta_discharge_port = $("#eta_discharge_port").val();

        //     var loading_port = $("#loading_port").val();
        //     var discharge_port = $("#discharge_port").val();

        //     $ummu.vars.formData.append("spal_id", spal_id);
        //     $ummu.vars.formData.append("spal_number", spal_number);
        //     $ummu.vars.formData.append("tgl", tgl);
        //     $ummu.vars.formData.append("number", number);
        //     $ummu.vars.formData.append("from_dept_id", from_dept_id);
        //     $ummu.vars.formData.append("to_dept_id", to_dept_id);

        //     $ummu.vars.formData.append("client_id", client_id);
        //     $ummu.vars.formData.append("tugboat_id", tugboat_id);
        //     $ummu.vars.formData.append("barge_id", barge_id);
        //     $ummu.vars.formData.append("barge_loa", ukuran_barge);
        //     $ummu.vars.formData.append("tonnage", tonnage);
        //     $ummu.vars.formData.append("uom_id", uom_id);

        //     $ummu.vars.formData.append("eta_loading_port", eta_loading_port);
        //     $ummu.vars.formData.append("eta_loading_port_to", eta_loading_port_to);
        //     $ummu.vars.formData.append("eta_discharge_port", eta_discharge_port);

        //     $ummu.vars.formData.append("loading_port", loading_port);
        //     $ummu.vars.formData.append("discharge_port", discharge_port);

        //     var payload = {
        //         "spal_id": spal,
        //         "spal_number": spal_number,
        //         "tgl": tgl,
        //         "number": number,
        //         "from_dept_id": from_dept_id,
        //         "to_dept_id": to_dept_id,

        //         "client_id": client_id,
        //         "tugboat_id": tugboat_id,
        //         "barge_id": barge_id,
        //         "barge_loa": ukuran_barge,
        //         "tonnage": tonnage,
        //         "uom_id": uom_id,

        //         "eta_loading_port": eta_loading_port,
        //         "eta_loading_port_to": eta_loading_port_to,
        //         "eta_discharge_port": eta_discharge_port,

        //         "loading_port": loading_port,
        //         "discharge_port": discharge_port,
        //     };

        //     const id = $ummu.url.getParam('id');

        //     if (id) {
        //         var func = "update/" + id
        //     }else{
        //         var func = "create"
        //     }

        //     var params = {
        //         "function": func,
        //         "data": $ummu.vars.formData,
        //         "loader": true,
        //     };

        //     const validation = app.validation.save();

        //     if (validation.length > 0) {
        //         $ummu.views.errors_msg(validation)
        //         $(".btn-endis").removeClass('btn-outline-secondary').addClass('btn-primary')
        //     }else{
        //         var ummu = $ummu.ajax.ummu7(params);   
        //         ummu.done(function(result) {
        //             const response = JSON.parse(result);
        //             $ummu.views.after_sbToolbar_save(response, func, id, payload);

        //             if (response.status == true) {
        //                 $("#file_url").attr("href", response.data.fileUrl)
        //                 let is_release = response.data.is_release;
        //                 if (is_release == null || is_release == '' || is_release == 0) {
        //                     $ummu.button.sbBtnToolbar.addRemove_btnRelease('add');
        //                 }else{
        //                     $ummu.button.sbBtnToolbar.addRemove_btnRelease('rm');
        //                 }
        //             }else{
        //                 $(".btn-endis").removeClass('btn-outline-secondary').addClass('btn-primary')
        //             }
        //         }).fail(function() {
        //             // An error occurred
        //             console.log(ummu)
        //         });
        //     }
        // },

        // sbCancle: function () {
        //     if ($ummu.url.getParam('id')) {
        //         // 
        //     }else{
        //         app.views.forClear()
        //     }
        // },

        // sbEdit: function () {
        //     // 
        // },

        // sbDelete: function(id) {
        //     $("#modalDeleteConfirm").modal('hide')
        //     var params = {
        //         "function": "delete/" + id,
        //         "method": "POST",
        //         "data": [],
        //         "cache": true,
        //         "contentType": "application/json",
        //         "dataType": "json",
        //         "loader": true,
        //         "textLoader": "Delete on progress..."
        //     };

        //     var ummu = $ummu.ajax.ummu8(params);   
        //     ummu.done(function(result) {
        //         $ummu.views.after_sbToolbar_delete(id, result);
        //         app.views.forClear()
        //     }).fail(function() {
        //         // An error occurred
        //         console.log(ummu)
        //     });
        // },

        // sbClear: function() {
        //     app.views.forClear()
        // },

        // sbRelease: function() {
        //     $("#modalReleaseConfirm").modal('hide')
        //     var id = $ummu.url.getParam('id');
        //     var func = "release/" + id;
        //     var payload = [];

        //     var params = {
        //         "function": func,
        //         "method": "POST",
        //         "data": [],
        //         "cache": true,
        //         "contentType": "application/json",
        //         "dataType": "json",
        //         "loader": true,
        //         "textLoader": "Release on progress...",
        //     };

        //     var ummu = $ummu.ajax.ummu8(params);   
        //     ummu.done(function(result) {
        //         payload = result.data;
        //         $ummu.views.after_sbToolbar_save(result, func, id, payload);
        //         if (result.status == true) {
        //             if (result.data.is_release == 1) {
        //                 $ummu.button.sbBtnToolbar.addRemove_btnRelease('rm');
        //             }
        //         }
        //     }).fail(function() {
        //         // An error occurred
        //         console.log(ummu)
        //     });
        // },

        // on_showLeftModal: function(id) {
        //     // console.log(id)
        //     if (id == 'client') {
        //         $ummu.controllers.show_clients(id);
        //     }else if (id == 'tugboat') {
        //         $ummu.controllers.show_tugboat(id);
        //     }else if (id == 'barge') {
        //         $ummu.controllers.show_barge(id);
        //     }else if (id == 'uom') {
        //         $ummu.controllers.show_uom(id);
        //     }else if (id == 'shipment') {
        //         $ummu.controllers.show_shippingInstruction(id);
        //     }else if (id == 'spal') {
        //         $ummu.controllers.show_spal(id);
        //     }else if (id == 'to_dept') {
        //         $ummu.controllers.show_dept(id);
        //     }else if (id == 'ijo') {
        //         $ummu.controllers.show_ijo(id);
        //     }
        // },

        // on_click_tbody_trtd_child1: function(row) {
        //     // console.log(row)
        //     app.views.setRow_toForm_freightCharter(row)
        // },

        // on_click_tbody_trtd_child_spal: function(row) {
        //     console.log(row)
        //     $("#loading_port").val(row.loading_port)
        //     $("#discharge_port").val(row.discharge_port)

        //     $("#client").val(row.client_name).attr('data-id', row.client_id)
        //     $("#tugboat").val(row.tugboat_name).attr('data-id', row.tugboat_id)
        //     $("#barge").val(row.barge_name).attr('data-id', row.barge_id)
        //     $("#ukuran_barge").val(row.barge_loa)
        //     $("#tonnage").val(row.qty)
        //     $("#uom").val(row.uom_kode).attr('data-id', row.uom_id)

        //     $("#eta_loading_port").val(row.loading_availability_date_from + " - " + row.loading_availability_date_to)
        //     .attr('data-from', row.loading_availability_date_from)
        //     .attr('data-to', row.loading_availability_date_to)

        //     $("#si_number").val(row.si_number)
        //     $("#si_url").attr('href', row.si_fileUrl)
        // },

        // on_click_tbody_trtd_child_dept: function(row) {
        //     // console.log(row)
        //     $("#to_dept").val(row.name).attr('data-id', row.id);
        // },

        // on_click_tbody_trtd_child_ijo: function(row) {
        //     $("#ijo").val(row.number).attr('data-id', row.id);
        //     $("#client").val(row.client_name).attr('data-id', row.client_id);
        //     $("#tugboat").val(row.tugboat_name).attr('data-id', row.tugboat_id);
        //     $("#barge").val(row.barge_name).attr('data-id', row.barge_id);
        // },

        on_btn_getData_click: function () {
            $ummu.views.after_sbToolbar_getData();
            // app.views.forClear()
        },
    },

    validation: {
        save: function() {
            var list = [];
            list = $ummu.validation.inputValidate();

            return list;
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

            $("#created_at").html('');
            $("#updated_at").html('');
            $("#created_by").html('');
            $("#updated_by").html('');
        },
    },

    dt: {
        config: {
            columns: function () {
                let columns = [
                    { 
                        data: null,
                        orderable: false,
                        render: DataTable.render.select()
                    },
                    { 
                        title: "ID",
                        data: "id",
                        // className: 'align-middle',
                        // render: function (data, type) {
                        //     return (
                        //         '<a href="javascript:void(0);">'+
                        //             '<div><span>' + data + '</span> <i class="fas fa-external-link-alt ml-2"></i></div>'+
                        //         '</a>'
                        //     );
                        // }
                    },
                    { 
                        title: "Nomor IJO",
                        data: "ijo_number",
                        // className: 'align-middle',
                    },
                    { 
                        title: "Tugboat",
                        data: "j_tugboat_name",
                        // className: 'align-middle',
                    },
                    { 
                        title: "Barge",
                        data: "j_barge_name",
                        // className: 'align-middle',
                    },
                    { 
                        title: "Tanggal",
                        data: "activity_date",
                        // className: 'align-middle',
                        render: function(data, type, row) {
                            var html = row.activity_date + ' ' + row.activity_time;
                            return html;
                        }
                    },
                    { 
                        title: "Activity",
                        data: "activity_name",
                        // className: 'align-middle',
                    },
                    { 
                        title: "Lokasi / Posisi",
                        data: "location",
                        // className: 'align-middle',
                    },
                    { 
                        title: "Koordinat",
                        data: null,
                        // className: 'align-middle',
                        render: function (data, type, row) {
                            if (row.latitude == null || row.longitude == null) return '-';
                            
                            var lat = row.latitude;
                            var lng = row.longitude;
                            
                            return '<a href="#" class="btn-map" data-lat="' + lat + '" data-lng="' + lng + '">'
                                 + lat + ', ' + lng + '</a>';
                        }
                    },
                    { 
                        title: "Cuaca",
                        data: "weather_condition",
                        // className: 'align-middle',
                        // render: function(data, type, row) {
                        //     var html = "";
                        //     var html = `<span class="badge badge-light border border-secondary text-secondary">${row.highest_coc_certificate}</span>`;

                        //     return html;
                        // }
                    },
                    { 
                        title: "Speed",
                        data: "speed_knot",
                        // className: 'align-middle text-right',
                        // render: function(data, type, row) {
                        //     const basic_salary = row.basic_salary;
                        //     const currency = row.currency;
                        //     const basic_salary_format = $ummu.formatter.input_rupiah.formatRupiah2(row.basic_salary);
                        //     var html = '';

                        //     if (basic_salary) {
                        //         // var html = `${currency} ${basic_salary_format}`
                        //         var html = basic_salary_format
                        //     }
                        //     return html;
                        // }
                    },
                    { 
                        title: "Jarak Tempuh",
                        data: "distance_nm",
                        // className: 'align-middle',
                    },
                    { 
                        title: "ETA",
                        data: null,
                        className: 'align-middle',
                        render: function(data, type, row) {
                            var html = row.eta_date + ' ' + row.eta_time;
                            return html;
                        }
                    },
                    { 
                        title: "Remarks",
                        data: "remarks",
                        // className: 'align-middle',
                    },
                    { 
                        title: "Create By",
                        data: "created_by_name",
                        // className: 'align-middle',
                    },
                ];
        
                return columns;
            },

            serverSide: function() {
                return true;
            },

            onClick_nthChild_2: function(row) {
                app.views.forClear()
                // console.log(row)
                // const row_for_urlParams = row;
                // const queryString = $.param(row);
                // console.log(queryString)
                // $ummu.url.setParamFromRow(row);
                $ummu.url.setParamFromObject(row);
                app.views.setRow_toForm(row);

                // console.log(ummu)
            },

            columnDefs: function() {
                return [
                    {
                        targets: 0,
                        orderable: false,
                        width: '40px',
                        render: DataTable.render.select(),
                    },
                    {
                        targets: 1,
                        orderable: true,
                        width: '50px',
                        class: 'text-center',
                    }
                    // { 
                    //     targets: [26,27], 
                    //     visible: false 
                    // },
                ];
            },

            on_reload_params: function (d) {
                // // filter wajib
                // d.date_from = $("#date_from").val() || "";
                // d.date_to   = $("#date_to").val()   || "";

                // filter opsional
                var vessel_id = $("#form_filter #vessel_id").data('id');
                if (vessel_id) d.vessel_id = vessel_id;

                var rank_id = $("#form_filter #rank_id").data('id');
                if (rank_id) d.rank_id = rank_id;

                // // filter dari modal_filter (via localStorage)
                // var lcFrom = localStorage.getItem("date_from");
                // var lcTo   = localStorage.getItem("date_to");
                // if (lcFrom) d.date_from = lcFrom;
                // if (lcTo)   d.date_to   = lcTo;
            },
        },
    },
};

$(document).ready(function () {
    app.config.autoload()

    // ==================== STATE ====================
    let currentIjo   = null;
    let currentRows  = [];
    let waReportText = '';

    let currentFormat = 'DMS';

    // ==================== INIT ====================
    $('#ijoSelect').select2({
        placeholder: '-- Cari / Pilih Shipping / IJO --',
        allowClear: true,
        width: '100%'
    });

    $('#activitySelect').select2({
        placeholder: '-- Cari / Pilih Activity --',
        allowClear: true,
        width: '100%',
        dropdownParent: $('#timesheetModal')
    });

    // FIX #5: tunggu IJO list selesai dulu, baru load activities + auto-select URL
    loadIjoList(function () {
        loadActivities();
    });

    // FIX #1: binding pakai wrapper, bukan langsung handleIjoChange
    // FIX #4: tambahkan juga handler 'change' sebagai fallback programmatic trigger
    $('#ijoSelect')
        .on('select2:select', function (e) {
            handleIjoChange(e.params.data.id);
        })
        .on('select2:unselect', function () {
            handleIjoChange(null);
        })
        .on('change', function () {
            const v = $(this).val();
            // hanya trigger kalau beda dari currentIjo (hindari double-call dari select2:select)
            if (v && (!currentIjo || String(currentIjo.id) !== String(v))) {
                handleIjoChange(v);
            } else if (!v && currentIjo) {
                handleIjoChange(null);
            }
        });

    console.log('[IJO] bindings attached. Element count:', $('#ijoSelect').length);

    // ==================== FILTER ====================
    $('#btnFilter').on('click', loadTimesheets);
    $('#btnResetFilter').on('click', function() {
        $('#filterStatus').val('');
        $('#filterDateFrom').val('');
        $('#filterDateTo').val('');
        loadTimesheets();
    });
    $('#btnReloadIjo').on('click', function () { loadIjoList(); });
    $('#btnGetAllIjo').on('click', loadAllIjoList);

    $('#formatSwitch button').on('click', function() {
        const fmt = $(this).data('format');
        if (fmt === currentFormat) return;
        currentFormat = fmt;
        $('#coord_format').val(fmt);
        $('#formatSwitch button').removeClass('active');
        $(this).addClass('active');
        $('.coord-format-section').removeClass('active');
        $(`.coord-format-section[data-format="${fmt}"]`).addClass('active');
        if (fmt === 'DD') syncFromDMS(); else syncFromDD();
    });

    $('#latitude_dd, #longitude_dd').on('input', function () { $('#coord_source').val('manual'); syncFromDD(); });
    $('#lat_deg, #lat_min, #lat_sec, #lat_dir, #lng_deg, #lng_min, #lng_sec, #lng_dir').on('input change', function () {
        $('#coord_source').val('manual'); syncFromDMS();
    });

    $('#btnGetLocation').on('click', function() {
        const $btn = $(this), $status = $('#coordStatus');
        if (!navigator.geolocation) {
            $status.removeClass('success').addClass('error').html('<i class="fas fa-times-circle mr-1"></i>Browser tidak mendukung Geolocation.');
            return;
        }
        $btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i>');
        $status.removeClass('success error').html('<i class="fas fa-spinner fa-spin mr-1"></i>Mengambil koordinat...');
        navigator.geolocation.getCurrentPosition(
            function(pos) {
                const lat = pos.coords.latitude.toFixed(6);
                const lng = pos.coords.longitude.toFixed(6);
                const acc = pos.coords.accuracy ? Math.round(pos.coords.accuracy) : '-';
                setCoordinates(lat, lng, 'gps');
                $status.removeClass('error').addClass('success').html(`<i class="fas fa-check-circle mr-1"></i>Koordinat diambil (akurasi ±${acc} m)`);
                $btn.prop('disabled', false).html('<i class="fas fa-crosshairs mr-1"></i>GPS');
            },
            function(err) {
                let msg = 'Gagal mengambil lokasi.';
                if (err.code === 1) msg = 'Akses lokasi ditolak.';
                if (err.code === 2) msg = 'Posisi tidak tersedia.';
                if (err.code === 3) msg = 'Timeout. Coba lagi.';
                $status.removeClass('success').addClass('error').html(`<i class="fas fa-times-circle mr-1"></i>${msg}`);
                $btn.prop('disabled', false).html('<i class="fas fa-crosshairs mr-1"></i>GPS');
            },
            { enableHighAccuracy: true, timeout: 15000, maximumAge: 0 }
        );
    });

    $('#btnReset').on('click', resetForm);

    $('#btnSubmitForm').on('click', function() { submitTimesheet('submit'); });

    // ==================== TAMBAH BARU ====================
    $('#btnTambahData').on('click', function() {
        if (!currentIjo) { alert('Pilih IJO terlebih dahulu.'); return; }
        resetForm();
        $('#timesheetModal').modal('show');
    });

    $('#btnCopyWA').on('click', function() {
        const $btn = $(this);
        const orig = $btn.html();
        $btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin mr-1"></i>Memuat...');

        loadWaReport(function(text) {
            $('#waPreview').val(text);
            $('#waModal').modal('show');
            $btn.prop('disabled', false).html(orig);
        });
    });

    $('#btnCopyClipboard').on('click', function() {
        const text = $('#waPreview').val();
        if (!text) { alert('Tidak ada text.'); return; }
        if (navigator.clipboard && navigator.clipboard.writeText) {
            navigator.clipboard.writeText(text).then(function() {
                alert('Laporan berhasil dicopy. Silakan paste di WhatsApp.');
                $('#waModal').modal('hide');
            }).catch(function() { fallbackCopy(text); });
        } else { fallbackCopy(text); }
    });

    $('#btnOpenWA').on('click', function() {
        const text = $('#waPreview').val();
        if (!text) { alert('Tidak ada text.'); return; }
        const encoded = encodeURIComponent(text);
        const isMobile = /Android|iPhone|iPad|iPod/i.test(navigator.userAgent);
        if (isMobile) window.open('whatsapp://send?text=' + encoded, '_blank');
        else window.open('https://web.whatsapp.com/send?text=' + encoded, '_blank');
    });

    // ==================== EXPORT EXCEL (AJAX) ====================
    $('#btnExportExcel').on('click', function () {
        const ijoId = $('#ijoSelect').val();
        if (!ijoId) return alert('Pilih IJO terlebih dahulu!');

        const params = new URLSearchParams({
            ijo_id: ijoId,
            date_from: $('#waDateFrom').val() || '',
            date_to:   $('#waDateTo').val() || '',
            status:    $('#filterStatus').val() || '',
        });

        const $btn = $(this);
        const origHtml = $btn.html();
        $btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin mr-1"></i>Exporting...');

        $.ajax({
            url: BASE_URL + '/export-excel?' + params.toString(),
            method: 'GET',
            xhrFields: { responseType: 'blob' },
            success: function (blob, status, xhr) {
                const ct = xhr.getResponseHeader('Content-Type') || '';
                if (ct.includes('application/json')) {
                    const reader = new FileReader();
                    reader.onload = function () {
                        try {
                            const json = JSON.parse(reader.result);
                            alert('Export gagal: ' + (json.message || 'Unknown error'));
                        } catch (e) {
                            alert('Export gagal.');
                        }
                    };
                    reader.readAsText(blob);
                    return;
                }

                let filename = 'Timesheet.xlsx';
                const disposition = xhr.getResponseHeader('Content-Disposition') || '';
                const match = disposition.match(/filename\*?=(?:UTF-8'')?["']?([^"';]+)["']?/i);
                if (match && match[1]) filename = decodeURIComponent(match[1]);

                const url = window.URL.createObjectURL(blob);
                const a = document.createElement('a');
                a.href = url;
                a.download = filename;
                document.body.appendChild(a);
                a.click();
                a.remove();
                window.URL.revokeObjectURL(url);
            },
            error: function (xhr) {
                alert('Export gagal: HTTP ' + xhr.status);
            },
            complete: function () {
                $btn.prop('disabled', false).html(origHtml);
            }
        });
    });

    // ==================== UTIL ====================
    function ddToDms(dd, isLat) {
        if (dd === '' || dd === null || isNaN(dd)) return null;
        dd = parseFloat(dd);
        const abs = Math.abs(dd);
        const deg = Math.floor(abs);
        const minFloat = (abs - deg) * 60;
        const min = Math.floor(minFloat);
        const sec = ((minFloat - min) * 60).toFixed(2);
        const dir = isLat ? (dd >= 0 ? 'N' : 'S') : (dd >= 0 ? 'E' : 'W');
        return { deg, min, sec: parseFloat(sec), dir };
    }
    function dmsToDd(deg, min, sec, dir) {
        if (deg === '' || deg === null || isNaN(deg)) return '';
        deg = parseFloat(deg) || 0; min = parseFloat(min) || 0; sec = parseFloat(sec) || 0;
        let dd = deg + min / 60 + sec / 3600;
        if (dir === 'S' || dir === 'W') dd = -dd;
        return parseFloat(dd.toFixed(6));
    }
    function formatCoordForWA(lat, lng, format) {
        if (lat === null || lat === undefined || lat === '' ||
            lng === null || lng === undefined || lng === '') return '-';
        const latNum = parseFloat(lat), lngNum = parseFloat(lng);
        if (isNaN(latNum) || isNaN(lngNum)) return '-';
        if (format === 'DMS') {
            const latDms = ddToDms(latNum, true), lngDms = ddToDms(lngNum, false);
            return `${latDms.deg}°${latDms.min}'${latDms.sec}"${latDms.dir} ${lngDms.deg}°${lngDms.min}'${lngDms.sec}"${lngDms.dir}`;
        }
        return `${latNum.toFixed(6)}, ${lngNum.toFixed(6)}`;
    }
    function escapeHtml(s) {
        if (s === null || s === undefined) return '';
        return String(s).replace(/[&<>"']/g, c => ({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'})[c]);
    }
    function ucfirst(s) { return s ? s.charAt(0).toUpperCase() + s.slice(1) : ''; }
    function formatDateIndo(d) {
        if (!d) return '-';
        const dt = new Date(d);
        if (isNaN(dt.getTime())) return d;
        const months = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'];
        return `${dt.getDate()} ${months[dt.getMonth()]} ${dt.getFullYear()}`;
    }
    function isValidDate(d) {
        return d && d !== '0000-00-00' && !d.startsWith('0000');
    }

    // FIX #3: helper untuk ambil ijo_id dari URL dengan guard $ummu
    function getUrlIjoId() {
        if (window.$ummu && $ummu.url && typeof $ummu.url.getParam === 'function') {
            return $ummu.url.getParam('ijo_id');
        }
        return new URLSearchParams(location.search).get('ijo_id');
    }
    function setUrlIjoId(id) {
        if (window.$ummu && $ummu.url && typeof $ummu.url.setParam === 'function') {
            $ummu.url.setParam('ijo_id', id);
        }
        // fallback: tidak wajib, kalau $ummu tidak ada, biarkan
    }

    // ==================== PILIH IJO (DEFENSIVE) ====================
    // FIX #2: ekspos ke window supaya bisa dipanggil dari mana saja
    window.handleIjoChange = function (id) {
        const $sel = $('#ijoSelect');
        // FIX #1: pakai assignment, bukan const redeclare
        if (id === undefined) id = $sel.val();

        const urlIjoId = getUrlIjoId();
        if (id && String(id) !== String(urlIjoId || '')) {
            setUrlIjoId(id);
        }

        console.log('[IJO] change triggered. id =', id);

        if (!id) {
            currentIjo = null;
            $('#ijoInfoCard, #listCard').hide();
            $('#ijoMetaBadges').empty();
            $('#timesheetList').html('<tr><td colspan="11" class="text-center text-muted py-4"><i class="fas fa-inbox fa-2x d-block mb-2"></i>Pilih IJO terlebih dahulu</td></tr>');
            return;
        }

        // FIX #6: pakai .data() sebagai primary, fallback ke attr
        const $opt = $sel.find('option:selected');
        let dataIjo = $opt.data('ijo');

        if (!dataIjo) {
            const raw = $opt.attr('data-ijo');
            if (raw) {
                try { dataIjo = JSON.parse(raw); }
                catch (e) {
                    console.error('[IJO] Gagal parse JSON data-ijo:', e, '\nRaw:', raw);
                    alert('Data IJO rusak / tidak valid. Coba reload halaman.');
                    return;
                }
            }
        }

        if (!dataIjo) {
            console.error('[IJO] data IJO tidak ditemukan pada option. Cek apakah option punya .data("ijo").');
            alert('Data IJO tidak ditemukan. Coba reload halaman.');
            return;
        }

        // kalau dataIjo ternyata string (dari attr), parse
        if (typeof dataIjo === 'string') {
            try { dataIjo = JSON.parse(dataIjo); }
            catch (e) {
                console.error('[IJO] Gagal parse string dataIjo:', e);
                alert('Data IJO rusak / tidak valid.');
                return;
            }
        }

        currentIjo = dataIjo;
        console.log('[IJO] loaded:', currentIjo);
        finishIjoSelection();
    };

    function finishIjoSelection() {
        if (!currentIjo) return;
        renderIjoInfo(currentIjo);
        $('#ijoInfoCard, #listCard').show();
        loadTimesheets();
    }

    // ==================== RENDER INFO IJO ====================
    function renderIjoInfo(ijo) {
        $('#ijoIdLabel').text('(ID ' + ijo.id + ')');
        $('#ijoNumberLabel').text(ijo.number || '-');
        $('#tugboatLabel').text(ijo.tugboat_name || '-');
        $('#bargeLabel').text(ijo.barge_name || '-');
        $('#routeLabel').text((ijo.loading_port || '-') + ' → ' + (ijo.discharge_port || '-'));
        $('#clientLabel').text(ijo.client_name || '-');
        $('#spalLabel').text(ijo.spal_number || '-');

        let etaLoad = '-';
        if (isValidDate(ijo.eta_loading_port)) {
            etaLoad = formatDateIndo(ijo.eta_loading_port);
            if (isValidDate(ijo.eta_loading_port_to) && ijo.eta_loading_port_to !== ijo.eta_loading_port) {
                etaLoad += ' s/d ' + formatDateIndo(ijo.eta_loading_port_to);
            }
        }
        $('#etaLoadingLabel').text(etaLoad);

        const rel = (ijo.release_name || '').toLowerCase();
        let statusClass = 'text-primary', statusText = 'Release', statusIcon = 'check-circle';
        if (rel === 'done') { statusClass = 'text-success'; statusText = 'Done'; statusIcon = 'check-double'; }
        else if (rel === 'progress') { statusClass = 'text-warning'; statusText = 'Progress'; statusIcon = 'spinner'; }
        else if (rel === 'cancel' || rel === 'canceled') { statusClass = 'text-danger'; statusText = 'Cancel'; statusIcon = 'times-circle'; }
        $('#ijoStatusBadge')
            .removeClass('text-primary text-success text-warning text-danger')
            .addClass(statusClass)
            .html(`<i class="fas fa-${statusIcon} mr-1"></i>${statusText}`);

        const badges = [];
        if (ijo.client_name) badges.push(`<span class="badge badge-info"><i class="fas fa-building mr-1"></i>${escapeHtml(ijo.client_name)}</span>`);
        if (ijo.spal_number) badges.push(`<span class="badge badge-secondary"><i class="fas fa-file-alt mr-1"></i>SPAL ${escapeHtml(ijo.spal_number)}</span>`);
        if (ijo.is_testing == '1') badges.push(`<span class="badge badge-warning"><i class="fas fa-flask mr-1"></i>Testing</span>`);
        if (isValidDate(ijo.eta_loading_port)) badges.push(`<span class="badge badge-light border"><i class="fas fa-calendar-check mr-1"></i>ETA Load: ${formatDateIndo(ijo.eta_loading_port)}</span>`);
        $('#ijoMetaBadges').html(badges.join(''));

        $('#formIjoId').val(ijo.id);
        $('#formIjoNumber').val(ijo.number);
        $('#formVesselId').val(ijo.tugboat_id || '');
        $('#formVesselName').val(ijo.tugboat_name || '');
        $('#formBargeId').val(ijo.barge_id || '');
        $('#formBargeName').val(ijo.barge_name || '');
    }

    // ==================== LOAD TIMESHEET ====================
    function loadTimesheets() {
        if (!currentIjo) return;

        const status   = $('#filterStatus').val();
        const dateFrom = $('#filterDateFrom').val();
        const dateTo   = $('#filterDateTo').val();

        let qs = `ijo_id=${currentIjo.id}`;
        if (status)   qs += `&status=${status}`;
        if (dateFrom) qs += `&date_from=${dateFrom}`;
        if (dateTo)   qs += `&date_to=${dateTo}`;

        $ummu.showLoader('Mengambil data...');

        $('#timesheetList').html('<tr><td colspan="11" class="text-center py-4"><i class="fas fa-spinner fa-spin"></i> Memuat...</td></tr>');

        $.ajax({
            url: `${BASE_URL}/show?${qs}`,
            type: 'GET',
            dataType: 'json',
            success: function(res) {
                $ummu.hideLoader();
                if (!res.status) {
                    $('#timesheetList').html('<tr><td colspan="11" class="text-center text-danger py-4">Gagal memuat data / Data tidak ditemukan.</td></tr>');
                    return;
                }
                currentRows = res.rows || [];
                renderTimesheetTable(currentRows);
                $ummu.hideLoader();
            },
            error: function() {
                $ummu.hideLoader();
                $('#timesheetList').html('<tr><td colspan="11" class="text-center text-danger py-4">Gagal menghubungi server.</td></tr>');
            }
        });
    }

    function renderTimesheetTable(rows) {
        const $tbody = $('#timesheetList');
        $tbody.empty();
        $('#countDisplay').text(rows.length);

        if (rows.length === 0) {
            $tbody.html('<tr><td colspan="11" class="text-center text-muted py-4"><i class="fas fa-inbox fa-2x d-block mb-2"></i>Belum ada data timesheet untuk IJO ini</td></tr>');
            return;
        }

        const statusMap = { draft:'secondary', submitted:'primary', approved:'success', rejected:'danger' };

        rows.forEach(function(t) {
            const badge = statusMap[t.status] || 'secondary';
            let etaText = '-';
            if (t.eta_date) {
                etaText = t.eta_date;
                if (t.eta_time) etaText += ' ' + String(t.eta_time).slice(0, 5);
            }
            const tr = `
                <tr data-id="${t.id}">
                    <td class="text-nowrap">${t.activity_date || '-'}</td>
                    <td>${t.activity_time ? String(t.activity_time).slice(0,5) : '-'}</td>
                    <td><span class="badge badge-info">${escapeHtml(t.activity_name || '-')}</span></td>
                    <td>${escapeHtml(t.location || '-')}</td>
                    <td>${escapeHtml(t.weather_condition || '-')}</td>
                    <td>${t.speed_knot ? parseFloat(t.speed_knot).toFixed(2)+' kn' : '-'}</td>
                    <td>${t.distance_nm ? parseFloat(t.distance_nm).toFixed(2)+' NM' : '-'}</td>
                    <td class="text-nowrap">${etaText}</td>
                    <td><small>${escapeHtml(t.remarks || '-')}</small></td>
                    <td><span class="badge badge-${badge} status-badge">${ucfirst(t.status || 'draft')}</span></td>
                    <td class="text-center text-nowrap">
                        <button class="btn btn-sm btn-outline-info btn-detail" data-id="${t.id}" title="Detail"><i class="fas fa-eye"></i></button>
                        <button class="btn btn-sm btn-outline-warning btn-edit" data-id="${t.id}" title="Edit"><i class="fas fa-edit"></i></button>
                        <button class="btn btn-sm btn-outline-danger btn-delete" data-id="${t.id}" title="Hapus"><i class="fas fa-trash"></i></button>
                    </td>
                </tr>`;
            $tbody.append(tr);
        });
    }

    // ==================== SYNC JAM ====================
    function syncActivityTime() {
        const h = $('#activityHour').val() || '00';
        const m = $('#activityMinute').val() || '00';
        $('#activityTime').val(`${h}:${m}`);
    }
    $('#activityHour, #activityMinute').on('change', syncActivityTime);
    syncActivityTime();

    function syncEtaTime() {
        const h = $('#etaHour').val(), m = $('#etaMinute').val();
        $('#etaTime').val((h && m) ? `${h}:${m}` : '');
    }
    $('#etaHour, #etaMinute').on('change', syncEtaTime);
    syncEtaTime();

    // ==================== CUACA "LAINNYA" ====================
    $('#weatherCondition').on('change', function() {
        if ($(this).val() === 'Lainnya') $('#weatherOther').show().focus();
        else $('#weatherOther').hide().val('');
    });

    // ==================== LOAD ACTIVITY ====================
    function loadActivities() {
        const $sel = $('#activitySelect');
        $sel.empty().append('<option value="">-- Memuat activity... --</option>');
        $.ajax({
            url: API_ACTIVITY_URL, type: 'GET', dataType: 'json',
            success: function(res) {
                $sel.empty().append('<option value="">-- Pilih Activity --</option>');
                if (res.status && Array.isArray(res.rows)) {
                    const rows = res.rows.filter(r => r.deleted_at === null);
                    rows.sort((a, b) => (a.name || '').localeCompare(b.name || ''));
                    rows.forEach(r => {
                        const name = (r.name || '').trim();
                        const label = r.kode ? `${name} [${r.kode}]` : name;
                        $sel.append(`<option value="${r.id}" data-name="${name}" data-kode="${r.kode || ''}">${label}</option>`);
                    });
                    $('#activityCount').text(`${rows.length} activity tersedia`);
                }
                $sel.trigger('change.select2');

                // FIX #4 & #5: auto-select ijo dari URL (list IJO sudah selesai load)
                const ijoId = getUrlIjoId();
                if (ijoId) {
                    const exists = $('#ijoSelect option[value="' + ijoId + '"]').length > 0;
                    if (exists) {
                        $('#ijoSelect').val(ijoId).trigger('change');  // akan trigger handler 'change'
                    } else {
                        console.warn('[IJO] ijo_id dari URL tidak ada di daftar:', ijoId);
                    }
                }
            },
            error: function() {
                $sel.empty().append('<option value="">-- Error memuat activity --</option>');
            }
        });
    }

    // ==================== KOORDINAT ====================
    function syncFromDD() {
        const latDD = $('#latitude_dd').val(), lngDD = $('#longitude_dd').val();
        $('#latitude').val(latDD || ''); $('#longitude').val(lngDD || '');
        const latDms = ddToDms(latDD, true);
        if (latDms) {
            $('#lat_deg').val(latDms.deg); $('#lat_min').val(latDms.min);
            $('#lat_sec').val(latDms.sec); $('#lat_dir').val(latDms.dir);
        } else {
            $('#lat_deg, #lat_min, #lat_sec').val(''); $('#lat_dir').val('N');
        }
        const lngDms = ddToDms(lngDD, false);
        if (lngDms) {
            $('#lng_deg').val(lngDms.deg); $('#lng_min').val(lngDms.min);
            $('#lng_sec').val(lngDms.sec); $('#lng_dir').val(lngDms.dir);
        } else {
            $('#lng_deg, #lng_min, #lng_sec').val(''); $('#lng_dir').val('E');
        }
    }
    function syncFromDMS() {
        const latDD = dmsToDd($('#lat_deg').val(), $('#lat_min').val(), $('#lat_sec').val(), $('#lat_dir').val());
        const lngDD = dmsToDd($('#lng_deg').val(), $('#lng_min').val(), $('#lng_sec').val(), $('#lng_dir').val());
        if (latDD !== '') $('#latitude_dd').val(latDD);
        if (lngDD !== '') $('#longitude_dd').val(lngDD);
        $('#latitude').val(latDD === '' ? '' : latDD);
        $('#longitude').val(lngDD === '' ? '' : lngDD);
    }
    function setCoordinates(lat, lng, source) {
        $('#latitude_dd').val(lat); $('#longitude_dd').val(lng);
        $('#coord_source').val(source || 'gps'); syncFromDD();
    }

    // ==================== RESET FORM ====================
    function resetForm() {
        $('#formTimesheet')[0].reset();
        $('#timesheetId').val('');
        $('#formTitle').text('Form Input Timesheet');
        $('#activitySelect').val(null).trigger('change');
        $('#latitude_dd, #longitude_dd').val('');
        $('#lat_deg, #lat_min, #lat_sec').val('');
        $('#lng_deg, #lng_min, #lng_sec').val('');
        $('#lat_dir').val('N'); $('#lng_dir').val('E');
        $('#latitude, #longitude').val('');
        currentFormat = 'DMS';
        $('#coord_format').val('DMS');
        $('#formatSwitch button').removeClass('active');
        $('#formatSwitch button[data-format="DMS"]').addClass('active');
        $('.coord-format-section').removeClass('active');
        $('.coord-format-section[data-format="DMS"]').addClass('active');
        $('#coord_source').val('manual');
        $('#coordStatus').removeClass('success error')
            .html('<i class="fas fa-info-circle mr-1"></i>Klik "GPS" untuk mengambil titik otomatis, atau ketik manual.');

        // FIX #10: pakai format lokal, bukan toISOString() (hindari shift timezone)
        const now = new Date();
        const yyyy = now.getFullYear();
        const mm   = String(now.getMonth() + 1).padStart(2, '0');
        const dd   = String(now.getDate()).padStart(2, '0');
        $('input[name="activity_date"]').val(`${yyyy}-${mm}-${dd}`);

        const hh = String(now.getHours()).padStart(2, '0');
        const min = String(Math.floor(now.getMinutes() / 5) * 5).padStart(2, '0');
        $('#activityHour').val(hh);
        $('#activityMinute').val(min);
        syncActivityTime();
        $('#etaDate').val(''); $('#etaHour').val(''); $('#etaMinute').val(''); $('#etaTime').val('');
        $('#weatherCondition').val(''); $('#weatherOther').hide().val('');
        if (currentIjo) renderIjoInfo(currentIjo);
    }

    // ==================== SUBMIT ====================
    function submitTimesheet(saveAs) {
        if (!currentIjo) { alert('Pilih IJO terlebih dahulu.'); return; }

        const id = $('#timesheetId').val();
        const url = id ? `${BASE_URL}/update/${id}` : `${BASE_URL}/create`;
        const $form = $('#formTimesheet');
        const activityId = $('#activitySelect').val();

        if (!activityId) {
            alert('Activity wajib dipilih.');
            $('#activitySelect').select2('open');
            return;
        }
        syncActivityTime();
        if (!$('#activityTime').val()) { alert('Jam wajib diisi.'); return; }
        syncEtaTime();

        if ($('#weatherCondition').val() === 'Lainnya' && !$('#weatherOther').val().trim()) {
            alert('Mohon sebutkan kondisi cuaca lainnya.');
            $('#weatherOther').focus();
            return;
        }

        const $opt = $('#activitySelect option:selected');
        const activityName = $opt.data('name') || $opt.text();
        const activityKode = $opt.data('kode') || '';

        const lat = $('#latitude').val(), lng = $('#longitude').val();
        if ((lat && !lng) || (!lat && lng)) {
            alert('Isi Latitude dan Longitude sekaligus, atau kosongkan keduanya.');
            return;
        }

        const formData = $form.serializeArray();
        formData.push({ name: 'activity_name', value: activityName });
        formData.push({ name: 'activity_kode', value: activityKode });
        formData.push({ name: 'save_as', value: saveAs });

        if ($('#weatherCondition').val() === 'Lainnya') {
            const otherVal = $('#weatherOther').val().trim();
            const idx = formData.findIndex(f => f.name === 'weather_condition');
            if (idx !== -1) formData[idx].value = otherVal;
            else formData.push({ name: 'weather_condition', value: otherVal });
        }

        formData.push({ name: CSRF_NAME, value: CSRF_HASH });

        const $btn = $('#btnSubmitForm');
        const origHtml = $btn.html();
        $btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin mr-1"></i>Menyimpan...');

        $ummu.showLoader('Menyimpan data...');

        $.ajax({
            url: url, type: 'POST', data: $.param(formData), dataType: 'json',
            success: function(res) {
                $ummu.hideLoader();
                if (res.status) {
                    alert(res.message || 'Berhasil disimpan.');
                    $('#timesheetModal').modal('hide');
                    loadTimesheets();
                } else {
                    let msg = res.message || 'Gagal menyimpan.';
                    if (res.errors) msg += '\n' + Object.values(res.errors).join('\n');
                    alert(msg);
                }
                $btn.prop('disabled', false).html(origHtml);
            },
            error: function(xhr) {
                $ummu.hideLoader();
                let msg = 'Terjadi kesalahan server.';
                try { const r = JSON.parse(xhr.responseText); msg = r.message || msg; } catch (e) {}
                alert(msg);
                $btn.prop('disabled', false).html(origHtml);
            }
        });
    }

    // ==================== EDIT ====================
    $(document).on('click', '.btn-edit', function() {
        if (!currentIjo) return;
        const id = $(this).data('id');

        $ummu.showLoader('Mengambil data...');

        $.get(`${BASE_URL}/show/${id}`, function(res) {
            $ummu.hideLoader();
            if (!res.status) { alert('Data tidak ditemukan.'); return; }
            const d = res.rows[0];
            resetForm();

            $('#timesheetId').val(d.id);
            $('#formTitle').text('Edit Timesheet #' + d.id);
            $('input[name="activity_date"]').val(d.activity_date);

            if (d.activity_time) {
                const parts = d.activity_time.split(':');
                if ($('#activityHour option[value="'+parts[0]+'"]').length) $('#activityHour').val(parts[0]);
                const mmNum = parseInt(parts[1], 10);
                const mmRounded = Math.round(mmNum / 5) * 5 % 60;
                const mmStr = String(mmRounded).padStart(2, '0');
                if ($('#activityMinute option[value="'+mmStr+'"]').length) $('#activityMinute').val(mmStr);
                else $('#activityMinute').val('00');
            }
            syncActivityTime();
            $('input[name="location"]').val(d.location || '');
            $('input[name="distance_nm"]').val(d.distance_nm || '');
            $('input[name="speed_knot"]').val(d.speed_knot || '');
            $('textarea[name="remarks"]').val(d.remarks || '');

            if (d.eta_date) $('#etaDate').val(d.eta_date);
            if (d.eta_time) {
                const etaParts = d.eta_time.split(':');
                if ($('#etaHour option[value="'+etaParts[0]+'"]').length) $('#etaHour').val(etaParts[0]);
                const etaMNum = parseInt(etaParts[1], 10);
                const etaMRounded = Math.round(etaMNum / 5) * 5 % 60;
                const etaMStr = String(etaMRounded).padStart(2, '0');
                if ($('#etaMinute option[value="'+etaMStr+'"]').length) $('#etaMinute').val(etaMStr);
            }
            syncEtaTime();

            const weatherVal = d.weather_condition || '';
            const $weatherSelect = $('#weatherCondition');
            if ($weatherSelect.find('option[value="'+weatherVal+'"]').length && weatherVal !== 'Lainnya') {
                $weatherSelect.val(weatherVal);
            } else if (weatherVal) {
                $weatherSelect.val('Lainnya');
                $('#weatherOther').show().val(weatherVal);
            } else {
                $weatherSelect.val('');
            }

            $('#activitySelect').val(d.activity_id).trigger('change');

            if (d.latitude !== null && d.longitude !== null) {
                setCoordinates(parseFloat(d.latitude).toFixed(6), parseFloat(d.longitude).toFixed(6), d.coord_source || 'manual');
            }
            const fmt = d.coord_format || 'DMS';
            currentFormat = fmt;
            $('#coord_format').val(fmt);
            $('#formatSwitch button').removeClass('active');
            $('#formatSwitch button[data-format="'+fmt+'"]').addClass('active');
            $('.coord-format-section').removeClass('active');
            $('.coord-format-section[data-format="'+fmt+'"]').addClass('active');

            $('#timesheetModal').modal('show');
            $ummu.hideLoader();
        });
    });

    // ==================== DETAIL ====================
    $(document).on('click', '.btn-detail', function() {
        const id = $(this).data('id');

        $ummu.showLoader('Mengambil data...');

        $.get(`${BASE_URL}/show/${id}`, function(res) {
            $ummu.hideLoader();
            if (!res.status) { alert('Data tidak ditemukan.'); return; }
            const d = res.rows[0];
            const etaText = (d.eta_date || d.eta_time) ? `${d.eta_date || '-'} ${d.eta_time || ''}`.trim() : '-';
            const coordText = formatCoordForWA(d.latitude, d.longitude, d.coord_format || 'DMS');
            const msg = `
                ID           : ${d.id}
                Tanggal      : ${d.activity_date}
                Jam          : ${d.activity_time || '-'}
                Crew         : ${d.crew_name || '-'} (${d.nika || '-'})
                Activity     : ${d.activity_name}
                Lokasi       : ${d.location || '-'}
                Koordinat    : ${coordText}
                Jarak (NM)   : ${d.distance_nm || '-'}
                Speed (knot) : ${d.speed_knot || '-'}
                ETA          : ${etaText}
                Cuaca        : ${d.weather_condition || '-'}
                Keterangan   : ${d.remarks || '-'}
                Status       : ${d.status}
            `;
            $ummu.hideLoader();
            alert(msg.trim());
        });
    });

    // ==================== DELETE ====================
    $(document).on('click', '.btn-delete', function() {
        if (!confirm('Yakin hapus data timesheet ini? Tindakan tidak bisa dibatalkan.')) return;

        const id = $(this).data('id');

        $ummu.showLoader('Menghapus data...');

        $.post(`${BASE_URL}/delete/${id}`, { [CSRF_NAME]: CSRF_HASH }, function(res) {
            $ummu.hideLoader();
            if (res.status) {
                alert(res.message || 'Berhasil dihapus.');
                loadTimesheets();
            } else {
                alert(res.message || 'Gagal menghapus.');
            }
        }, 'json').fail(function() {
            $ummu.hideLoader();
            alert('Terjadi kesalahan server.');
        });
    });

    // ==================== WHATSAPP ====================
    function getLatestCoordinate(callback) {
        if (!currentIjo) { callback(null); return; }
        $.ajax({
            url: `${BASE_URL}/latest-coordinate?ijo_id=${currentIjo.id}`,
            type: 'GET',
            dataType: 'json',
            success: function(res) { callback(res.status && res.data ? res.data : null); },
            error: function() { callback(null); }
        });
    }

    function injectCoordinateToReport(reportText, coordText) {
        if (!coordText || coordText === '-') return reportText;
        const lines = reportText.split('\n');
        const result = [];
        let inserted = false;
        for (let i = 0; i < lines.length; i++) {
            result.push(lines[i]);
            if (!inserted && /^\s*(Posisi|Lokasi)\s*[:\-]/i.test(lines[i])) {
                result.push(`Koordinat : ${coordText}`);
                inserted = true;
            }
        }
        if (!inserted) {
            const out = [];
            let done = false;
            for (let i = 0; i < result.length; i++) {
                out.push(result[i]);
                if (!done && /Tanggal\s*[:\-]/i.test(result[i])) {
                    out.push(`Koordinat : ${coordText}`);
                    done = true;
                }
            }
            if (!done) return `Koordinat : ${coordText}\n${reportText}`;
            return out.join('\n');
        }
        return result.join('\n');
    }

    function loadWaReport(callback) {
        if (!currentIjo) { alert('Pilih IJO terlebih dahulu.'); return; }

        let dateFrom = $('#waDateFrom').val();
        let dateTo   = $('#waDateTo').val();

        if (!dateFrom && !dateTo) {
            const today = new Date();
            const threeDaysAgo = new Date();
            threeDaysAgo.setDate(today.getDate() - 2);
            dateFrom = threeDaysAgo.toISOString().slice(0, 10);
            dateTo   = today.toISOString().slice(0, 10);
            $('#waDateFrom').val(dateFrom);
            $('#waDateTo').val(dateTo);
        } else if (dateFrom && !dateTo) { dateTo = dateFrom; $('#waDateTo').val(dateTo); }
        else if (!dateFrom && dateTo) { dateFrom = dateTo; $('#waDateFrom').val(dateFrom); }

        if (dateFrom > dateTo) {
            alert('Tanggal "Dari" tidak boleh lebih besar dari tanggal "Sampai".');
            return;
        }

        $.ajax({
            url: `${BASE_URL}/report-wa?ijo_id=${currentIjo.id}&date_from=${dateFrom}&date_to=${dateTo}`,
            type: 'GET',
            dataType: 'json',
            success: function(res) {
                if (res.status && res.text) {
                    waReportText = res.text;
                    getLatestCoordinate(function(coord) {
                        let finalText = waReportText;
                        if (coord && coord.latitude && coord.longitude) {
                            const coordText = formatCoordForWA(coord.latitude, coord.longitude, coord.coord_format || 'DMS');
                            finalText = injectCoordinateToReport(waReportText, coordText);
                        }
                        if (callback) callback(finalText);
                    });
                } else {
                    alert(res.message || 'Gagal membuat laporan.');
                }
            },
            error: function() { alert('Gagal menghubungi server.'); }
        });
    }

    function fallbackCopy(text) {
        const $temp = $('<textarea>').val(text).css({ position: 'fixed', left: '-9999px' }).appendTo('body');
        $temp[0].select();
        try {
            document.execCommand('copy');
            alert('Laporan berhasil dicopy. Silakan paste di WhatsApp.');
            $('#waModal').modal('hide');
        } catch (err) {
            alert('Gagal copy otomatis. Silakan block text di preview lalu Ctrl+C.');
        }
        $temp.remove();
    }

    // ==================== LOADER HELPER ====================
    function showIjoLoader(title, text) {
        $('#ijoLoadingTitle').text(title || 'Memuat Data IJO');
        $('#ijoLoadingText').text(text || 'Mengambil daftar Shipping / IJO...');
        $('#ijoLoadingModal').modal('show');
    }

    function hideIjoLoader() {
        $('#ijoLoadingModal').modal('hide');
    }

    // ==================== LOAD IJO LIST ====================
    // FIX #5: tambah parameter onDone callback
    function loadIjoList(onDone) {
        const $sel = $('#ijoSelect');
        $sel.empty().append('<option value="">-- Memuat IJO... --</option>');
        $('#ijoMetaBadges').empty();

        showIjoLoader('Memuat Data IJO', 'Mengambil daftar Shipping / IJO...');

        $.ajax({
            url: API_IJO_URL,
            type: 'GET',
            dataType: 'json',
            success: function(res) {
                if (res.status && Array.isArray(res.rows)) {
                    $sel.empty().append('<option value="">-- Pilih Shipping / IJO --</option>');

                    const rows = res.rows.filter(r => !r.deleted_at);
                    rows.sort((a, b) => (parseInt(b.id) || 0) - (parseInt(a.id) || 0));

                    rows.forEach(r => {
                        const tug = r.tugboat_name || '-';
                        const barge = r.barge_name || '-';
                        const load = r.loading_port || '-';
                        const disc = r.discharge_port || '-';
                        const label = `${r.number || ('ID '+r.id)} — ${tug} / ${barge} (${load} → ${disc})`;
                        const $option = $('<option>').val(r.id).text(label);
                        $option.data('ijo', r);
                        $sel.append($option);
                    });
                    $sel.trigger('change.select2');

                    $('#ijoHint').html(
                        `<i class="fas fa-info-circle mr-1"></i>${rows.length} IJO tersedia — pilih untuk menampilkan timesheet.`
                    );

                    $('#ijoLoadingText').text(`${rows.length} IJO berhasil dimuat.`);
                } else {
                    $sel.empty().append('<option value="">-- Gagal memuat IJO --</option>');
                    $('#ijoHint').text('Gagal memuat IJO. Coba reload.');
                    $('#ijoLoadingTitle').text('Gagal Memuat IJO');
                    $('#ijoLoadingText').text('Data IJO tidak tersedia.');
                    $ummu.modal.ummu_msg(res.message);
                }
            },
            error: function() {
                $sel.empty().append('<option value="">-- Error memuat IJO --</option>');
                $('#ijoHint').text('Error memuat IJO. Cek koneksi / endpoint.');
                $('#ijoLoadingTitle').text('Gagal Terhubung');
                $('#ijoLoadingText').text('Tidak dapat menghubungi server.');
            },
            complete: function() {
                setTimeout(hideIjoLoader, 400);
                if (typeof onDone === 'function') onDone();
            }
        });
    }

    function loadAllIjoList(onDone) {
        const $sel = $('#ijoSelect');
        $sel.empty().append('<option value="">-- Memuat IJO... --</option>');
        $('#ijoMetaBadges').empty();

        showIjoLoader('Memuat Data IJO', 'Mengambil daftar Shipping / IJO...');

        $.ajax({
            url: API_IJO_URL + '?limitAll=Y',
            type: 'GET',
            dataType: 'json',
            success: function(res) {
                if (res.status && Array.isArray(res.rows)) {
                    $sel.empty().append('<option value="">-- Pilih Shipping / IJO --</option>');

                    const rows = res.rows.filter(r => !r.deleted_at);
                    rows.sort((a, b) => (parseInt(b.id) || 0) - (parseInt(a.id) || 0));

                    rows.forEach(r => {
                        const tug = r.tugboat_name || '-';
                        const barge = r.barge_name || '-';
                        const load = r.loading_port || '-';
                        const disc = r.discharge_port || '-';
                        const label = `${r.number || ('ID '+r.id)} — ${tug} / ${barge} (${load} → ${disc})`;
                        const $option = $('<option>').val(r.id).text(label);
                        $option.data('ijo', r);
                        $sel.append($option);
                    });
                    $sel.trigger('change.select2');

                    $('#ijoHint').html(
                        `<i class="fas fa-info-circle mr-1"></i>${rows.length} IJO tersedia — pilih untuk menampilkan timesheet.`
                    );

                    $('#ijoLoadingText').text(`${rows.length} IJO berhasil dimuat.`);
                } else {
                    $sel.empty().append('<option value="">-- Gagal memuat IJO --</option>');
                    $('#ijoHint').text('Gagal memuat IJO. Coba reload.');
                    $('#ijoLoadingTitle').text('Gagal Memuat IJO');
                    $('#ijoLoadingText').text('Data IJO tidak tersedia.');
                }
            },
            error: function() {
                $sel.empty().append('<option value="">-- Error memuat IJO --</option>');
                $('#ijoHint').text('Error memuat IJO. Cek koneksi / endpoint.');
                $('#ijoLoadingTitle').text('Gagal Terhubung');
                $('#ijoLoadingText').text('Tidak dapat menghubungi server.');
            },
            complete: function() {
                setTimeout(hideIjoLoader, 400);
                if (typeof onDone === 'function') onDone();
            }
        });
    }
});