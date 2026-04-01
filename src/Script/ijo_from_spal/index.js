var app = {
    register: function () {
        app.config.autoload()
    },

    config: {
        autoload: function () {
            $ummu.func.location_hash()
            $ummu.localStorage.dt_default($localStrgKey);
            $ummu.dt.layout.buttonAll($ummu.dt.init);

            $ummu.dt.init.on("click", "tbody tr td:nth-child(2)", function () {
                var row = $ummu.dt.init.row(this).data();
                // console.log(row)
                $ummu.url.setParamFromRow(row)
                // $ummu.vars.is_row = true;
                // app.controllers.detail(row);
                app.views.setRow_toForm(row);
            });
        },
    },

    vars: {
        initTable2: null,
        runing_id: null,
        init: null,

        general_information: function() {
            return {
                "type": $("#form_input #type").val(),
                "kode": $("#form_input #kode").val(),
                "name": $("#form_input #name").val(),
                "flag_registry": $("#form_input #flag_registry").val(),
                "classification": $("#form_input #classification").val(),
                "yearBuild_place": $("#form_input #yearBuild_place").val(),
            }
        },

        machinary_propulsion: function() {
            return {
                "MainEngines": $("#form_input #MainEngines").val(),
                "BrandMainEngines": $("#form_input #BrandMainEngines").val(),
                "AuxiliaryEngines": $("#form_input #AuxiliaryEngines").val(),
                "BrandAuxiliaryEngines": $("#form_input #BrandAuxiliaryEngines").val(),
                "HorsePower": $("#form_input #HorsePower").val(),
                "lightship": $("#form_input #lightship").val(),
                "propulsion": $("#form_input #propulsion").val(),
                "ServiceSpeed": $("#form_input #ServiceSpeed").val(),
            }
        },

        tank_capacity:function() {
            return {
                "fot": $("#form_input #fot").val(),
                "fwt": $("#form_input #fwt").val(),
            }
        },

        dimension_capacity:function() {
            return {
                "loa": $("#form_input #loa").val(),
                "breadth": $("#form_input #breadth").val(),
                "depth": $("#form_input #depth").val(),
                "MaxDraft": $("#form_input #MaxDraft").val(),
                "Sideboard": $("#form_input #Sideboard").val(),
                "GrossTonnage": $("#form_input #GrossTonnage").val(),
                "Deadweight": $("#form_input #Deadweight").val(),
                "DeckStrength": $("#form_input #DeckStrength").val(),
                "NetTonnage": $("#form_input #NetTonnage").val(),
            }
        },

        fuel_consumtion:function() {
            return {
                "fuelConsumtion_laden_river": $("#form_input #fuelConsumtion_laden_river").val(),
                "fuelConsumtion_laden_sea": $("#form_input #fuelConsumtion_laden_sea").val(),
                "fuelConsumtion_ballast_river": $("#form_input #fuelConsumtion_ballast_river").val(),
                "fuelConsumtion_ballast_sea": $("#form_input #fuelConsumtion_ballast_sea").val(),
                "fuelConsumtion_runningfree": $("#form_input #fuelConsumtion_runningfree").val(),
                "fuelConsumtion_standby": $("#form_input #fuelConsumtion_standby").val(),
            }
        },

        speed:function() {
            return {
                "speed_laden_river": $("#form_input #speed_laden_river").val(),
                "speed_laden_sea": $("#form_input #speed_laden_sea").val(),
                "speed_ballast_river": $("#form_input #speed_ballast_river").val(),
                "speed_ballast_sea": $("#form_input #speed_ballast_sea").val(),
                "speed_runningfree": $("#form_input #speed_runningfree").val(),
            }
        },
    },

    controllers: {
        on_btn_getData_click: function () {
            $ummu.views.after_sbToolbar_getData();
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
        },

        sbSave: function () {
            var spal_id = $("#spal").attr('data-id');
            var tgl = $("#iDate").val();
            var number = $("#number").val();
            var from_dept_id = $("#from_dept").attr('data-id');
            var to_dept_id = $("#to_dept").attr('data-id');

            var client_id = $("#client").attr('data-id');
            var tugboat_id = $("#tugboat").attr('data-id');
            var barge_id = $("#barge").attr('data-id');
            var tonage = $("#tonage").val();
            var uom_id = $("#uom").attr('data-id');

            var eta_loading_port = $("#eta_loading_port").attr('data-from');
            var eta_loading_port_to = $("#eta_loading_port").attr('data-to');
            var eta_discharge_port = $("#eta_discharge_port").val();

            var loading_port = $("#loading_port").val();
            var discharge_port = $("#discharge_port").val();

            $ummu.vars.formData.append("spal_id", spal_id);
            $ummu.vars.formData.append("tgl", tgl);
            $ummu.vars.formData.append("number", number);
            $ummu.vars.formData.append("from_dept_id", from_dept_id);
            $ummu.vars.formData.append("to_dept_id", to_dept_id);

            $ummu.vars.formData.append("client_id", client_id);
            $ummu.vars.formData.append("tugboat_id", tugboat_id);
            $ummu.vars.formData.append("barge_id", barge_id);
            $ummu.vars.formData.append("tonage", tonage);
            $ummu.vars.formData.append("uom_id", uom_id);

            $ummu.vars.formData.append("eta_loading_port", eta_loading_port);
            $ummu.vars.formData.append("eta_loading_port_to", eta_loading_port_to);
            $ummu.vars.formData.append("eta_discharge_port", eta_discharge_port);

            $ummu.vars.formData.append("loading_port", loading_port);
            $ummu.vars.formData.append("discharge_port", discharge_port);

            var payload = {
                "spal_id": spal,
                "tgl": tgl,
                "number": number,
                "from_dept_id": from_dept_id,
                "to_dept_id": to_dept_id,

                "client_id": client_id,
                "tugboat_id": tugboat_id,
                "barge_id": barge_id,
                "tonage": tonage,
                "uom_id": uom_id,

                "eta_loading_port": eta_loading_port,
                "eta_loading_port_to": eta_loading_port_to,
                "eta_discharge_port": eta_discharge_port,

                "loading_port": loading_port,
                "discharge_port": discharge_port,
            };

            const id = $ummu.url.getParam('id');

            if (id) {
                var func = "update/" + id
            }else{
                var func = "create"
            }

            var params = {
                "function": func,
                "data": $ummu.vars.formData,
                "loader": true,
            };

            const validation = app.validation.save();

            if (validation.length > 0) {
                $ummu.views.errors_msg(validation)
                $(".btn-endis").removeClass('btn-outline-secondary').addClass('btn-primary')
            }else{
                var ummu = $ummu.ajax.ummu7(params);   
                ummu.done(function(result) {
                    const response = JSON.parse(result);
                    $ummu.views.after_sbToolbar_save(response, func, id, payload);

                    $("#file_url").attr("href", response.data.fileUrl)

                    if (response.status == false) {
                        $(".btn-endis").removeClass('btn-outline-secondary').addClass('btn-primary')
                    }
                }).fail(function() {
                    // An error occurred
                    console.log(ummu)
                });
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
            // 
        },

        sbDelete: function(id) {
            var params = {
                "function": "delete/" + id,
                "method": "POST",
                "data": [],
                "cache": true,
                "contentType": "application/json",
                "dataType": "json",
                "loader": true,
            };

            var ummu = $ummu.ajax.ummu8(params);   
            ummu.done(function(result) {
                $ummu.views.after_sbToolbar_delete(id, result);

            }).fail(function() {
                // An error occurred
                console.log(ummu)
            });
        },

        sbClear: function() {
            app.views.forClear()
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
            $("#tonage").val(row.qty)
            $("#uom").val(row.uom_kode).attr('data-id', row.uom_id)

            $("#eta_loading_port").val(row.loading_availability_date_from + " - " + row.loading_availability_date_to)
            .attr('data-from', row.loading_availability_date_from)
            .attr('data-to', row.loading_availability_date_to)

            $("#si_number").val(row.si_number)
            $("#si_url").attr('href', row.fileUrl)
        },

        on_click_tbody_trtd_child_dept: function(row) {
            // console.log(row)
            $("#to_dept").val(row.name).attr('data-id', row.id);
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
            $("#shipment").val(row.si_number).attr('data-id', row.si_id)
            $("#iDate").val(row.tgl)
            $("#number").val(row.number)
            $("#biaya_angkutan").val($ummu.formatter.id(row.price))
            $("#kondisi_perjanjian").val(row.kondisi_perjanjian)

            $("#client").val(row.client_name).attr('data-id', row.client_id)
            $("#tugboat").val(row.tugboat_name).attr('data-id', row.tugboat_id)
            $("#barge").val(row.barge_name).attr('data-id', row.barge_id)
            $("#load_type").val(row.load_type)
            $("#qty").val($ummu.formatter.id(row.qty))
            $("#uom").val(row.uom_kode).attr('data-id', row.uom_id)

            $("#iDateLoadingFrom").val(row.loading_availability_date_from)
            $("#iDateLoadingTo").val(row.loading_availability_date_to)
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
        },

        forClear: function() {
            $("#form_input input").val('');

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
                    { data: "id",
                        render: function (data, type) {
                            return (
                                '<a href="javascript:void(0);">'+
                                    '<div><span>' + data + '</span> <i class="fas fa-external-link-alt ml-2"></i></div>'+
                                '</a>'
                            );
                        }
                    },
                    { data: "type_name"},
                    { data: "kode"},
                    { data: "name"},
                    { data: "flag_registry"},
                    { data: "classification"},
                    { data: "yearBuild_place"},

                    { data: "MainEngines"},
                    { data: "BrandMainEngines"},
                    { data: "AuxiliaryEngines"},
                    { data: "BrandAuxiliaryEngines"},
                    { data: "HorsePower",
                        render: function (data, type) {
                            if (data) {
                                return (
                                    '<a href="javascript:void(0);">'+
                                        data + ' BHP'+
                                    '</a>'
                                );
                            }else{
                                return ''
                            }
                        }
                    },
                    { data: "lightship"},
                    { data: "propulsion"},
                    { data: "ServiceSpeed",
                        render: function (data, type) {
                            if (data) {
                                return (
                                    '<a href="javascript:void(0);">'+
                                        data + ' Knots'+
                                    '</a>'
                                );
                            }else{
                                return ''
                            }
                        }
                    },

                    { data: "fot"},
                    { data: "fwt"},

                    { data: "loa"},
                    { data: "breadth"},
                    { data: "depth"},
                    { data: "MaxDraft"},
                    { data: "Sideboard"},
                    { data: "GrossTonnage"},
                    { data: "Deadweight"},
                    { data: "DeckStrength"},
                    { data: "NetTonnage"},

                    { data: "fuelConsumtion_laden_river"},
                    { data: "fuelConsumtion_laden_sea"},
                    { data: "fuelConsumtion_ballast_river"},
                    { data: "fuelConsumtion_ballast_sea"},
                    { data: "fuelConsumtion_runningfree"},
                    { data: "fuelConsumtion_standby"},

                    { data: "speed_laden_river"},
                    { data: "speed_laden_sea"},
                    { data: "speed_ballast_river"},
                    { data: "speed_ballast_sea"},
                    { data: "speed_runningfree"},
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