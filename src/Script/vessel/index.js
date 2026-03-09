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

            $ummu.formatter.number2($("#form_input .meterKoma"), 2);

            // $ummu.formatter.number2($("#form_input #loa"), 2);
            // $ummu.formatter.number($("#form_input #hp"), 4);
            $ummu.formatter.number($("#form_input #lightship"), 4);
            // $ummu.formatter.number($("#form_input #capacity"), 5);
            $ummu.formatter.number($("#form_input .speed"), 1);
            $ummu.formatter.number($("#form_input .fuelcons"), 3);
            // $ummu.formatter.number($("#form_input #crew_capacity"), 3);

            $("#form_input #type").on("change", function(){
                let type_id = $(this).val();
                app.views.showHide_form(type_id)
            })

            // $("#form_input .showHide").removeClass("collapse");
            // app.controllers.show_data();
            
            $(".barge-spec").removeClass("collapse");
            $(".boat-spec").removeClass("collapse");
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

        show_data: function() {
            var payload = {};

            var params = {
                function: "show_data",
                type: "get",
                action: "get",
                data: payload,
                cache: true,
                contentType: "application/json",
                dataType: "json",
                loader: true,
            };

            var ali = $ummu.ajax.ummu4(params);
            ali
                .done(function (result) {
                    console.log(result)
                })
                .fail(function () {
                    // An error occurred
                });
        },

        sbNew: function () {
            $("#nav-tab-machinery").prop("disabled", true).removeClass("active");
            $("#nav-tab-tank").prop("disabled", true).removeClass("active");
            $("#nav-tab-dimension").prop("disabled", true).removeClass("active");
            $("#nav-tab-fuelconsum").prop("disabled", true).removeClass("active");
            $("#nav-tab-speed").prop("disabled", true).removeClass("active");

            $("#nav-machinery").removeClass("show active");
            $("#nav-tank").removeClass("show active");
            $("#nav-dimension").removeClass("show active");
            $("#nav-fuelconsum").removeClass("show active");
            $("#nav-speed").removeClass("show active");
        },

        sbSave: function () {
            var type_id = $("#form_input #type").val();
            var id = $ummu.url.getParam('id');

            if (id) {
                var func = "update/" + id
            }else{
                var func = "create"
            }

            if (type_id ) {
                if (type_id == 1) {
                    var payload = {...app.vars.general_information(), ...app.vars.machinary_propulsion(), ...app.vars.tank_capacity(), ...app.vars.fuel_consumtion(), ...app.vars.speed()}
                }else if (type_id == 2) {
                    var payload = {...app.vars.general_information(), ...app.vars.dimension_capacity()}
                }else if (type_id == 3) {
                    var payload = {...app.vars.general_information(), ...app.vars.machinary_propulsion(), ...app.vars.tank_capacity(), ...app.vars.dimension_capacity(), ...app.vars.fuel_consumtion(), ...app.vars.speed()}
                }

                var params = {
                    "function": func,
                    "method": "POST",
                    "data": JSON.stringify(payload),
                    "cache": true,
                    "contentType": "application/json",
                    "dataType": "json",
                    "loader": true,
                };

                // console.log(params)

                if (app.validation.save().length > 0) {
                    // console.log('ada validation')
                    $("#ummu_modal_message").modal('show')
                }else{
                    // console.log('tidak ada validation')
                    var ummu = $ummu.ajax.ummu8(params);   
                    ummu.done(function(result) {
                        $ummu.views.after_sbToolbar_save(result, func, id, payload);
                    }).fail(function() {
                        // An error occurred
                        console.log(ummu)
                    });
                }
            }else{
                alert("Type Vessel is required.");
            }
        },

        sbCancle: function () {
            if ($ummu.url.getParam('id')) {
                //
            }else{
                $("#nav-tab-machinery").prop("disabled", true).removeClass("active");
                $("#nav-tab-tank").prop("disabled", true).removeClass("active");
                $("#nav-tab-dimension").prop("disabled", true).removeClass("active");
                $("#nav-tab-fuelconsum").prop("disabled", true).removeClass("active");
                $("#nav-tab-speed").prop("disabled", true).removeClass("active");

                $("#nav-machinery").removeClass("show active");
                $("#nav-tank").removeClass("show active");
                $("#nav-dimension").removeClass("show active");
                $("#nav-fuelconsum").removeClass("show active");
                $("#nav-speed").removeClass("show active");
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
            $("#nav-tab-machinery").prop("disabled", true).removeClass("active");
            $("#nav-tab-tank").prop("disabled", true).removeClass("active");
            $("#nav-tab-dimension").prop("disabled", true).removeClass("active");
            $("#nav-tab-fuelconsum").prop("disabled", true).removeClass("active");
            $("#nav-tab-speed").prop("disabled", true).removeClass("active");

            $("#nav-machinery").removeClass("show active");
            $("#nav-tank").removeClass("show active");
            $("#nav-dimension").removeClass("show active");
            $("#nav-fuelconsum").removeClass("show active");
            $("#nav-speed").removeClass("show active");
        },
    },

    validation: {
        save: function() {
            $("#ummu_modal_message #alert").empty();
            var name = $("#form_input #name").val();
            var flag_registry = $("#form_input #flag_registry").val();
            var classification = $("#form_input #classification").val();
            var yearBuild_place = $("#form_input #yearBuild_place").val();

            var $var = [];

            if (name == '' || name == null || name == 'undefined') {
                $("#ummu_modal_message #alert").append(
                    '<div class="alert alert-danger alert-dismissible fade show" role="alert">'+
                        '<i class="bi bi-exclamation-octagon me-1"></i> The name field is required.'+
                    '</div>'
                )

                $var.push('name');
            }

            if (flag_registry == '' || flag_registry == null || flag_registry == 'undefined') {
                $("#ummu_modal_message #alert").append(
                    '<div class="alert alert-danger alert-dismissible fade show" role="alert">'+
                        '<i class="bi bi-exclamation-octagon me-1"></i> The flag_registry field is required.'+
                    '</div>'
                )

                $var.push('flag_registry');
            }

            if (classification == '' || classification == null || classification == 'undefined') {
                $("#ummu_modal_message #alert").append(
                    '<div class="alert alert-danger alert-dismissible fade show" role="alert">'+
                        '<i class="bi bi-exclamation-octagon me-1"></i> The classification field is required.'+
                    '</div>'
                )

                $var.push('classification');
            }

            if (yearBuild_place == '' || yearBuild_place == null || yearBuild_place == 'undefined') {
                $("#ummu_modal_message #alert").append(
                    '<div class="alert alert-danger alert-dismissible fade show" role="alert">'+
                        '<i class="bi bi-exclamation-octagon me-1"></i> The yearBuild_place field is required.'+
                    '</div>'
                )

                $var.push('yearBuild_place');
            }

            return $var;
        }
    },

    views: {
        formParams: function() {
            return $("#form_input input, #form_input select");
        },

        setRow_toForm: function(row) {
            $("#type").val(row.type_id).change()
            $("#kode").val(row.kode)
            $("#name").val(row.name)
            $("#flag_registry").val(row.flag_registry)
            $("#classification").val(row.classification)
            $("#yearBuild_place").val(row.yearBuild_place)

            $("#MainEngines").val(row.MainEngines)
            $("#BrandMainEngines").val(row.BrandMainEngines)
            $("#AuxiliaryEngines").val(row.AuxiliaryEngines)
            $("#BrandAuxiliaryEngines").val(row.BrandAuxiliaryEngines)
            $("#HorsePower").val(row.HorsePower)
            $("#lightship").val(row.lightship)
            $("#propulsion").val(row.propulsion)
            $("#ServiceSpeed").val(row.ServiceSpeed)

            $("#fot").val(row.fot)
            $("#fwt").val(row.fwt)

            $("#loa").val(row.loa)
            $("#breadth").val(row.breadth)
            $("#depth").val(row.depth)
            $("#MaxDraft").val(row.MaxDraft)
            $("#Sideboard").val(row.Sideboard)
            $("#GrossTonnage").val(row.GrossTonnage)
            $("#Deadweight").val(row.Deadweight)
            $("#DeckStrength").val(row.DeckStrength)
            $("#NetTonnage").val(row.NetTonnage)

            $("#fuelConsumtion_laden_river").val(row.fuelConsumtion_laden_river)
            $("#fuelConsumtion_laden_sea").val(row.fuelConsumtion_laden_sea)
            $("#fuelConsumtion_ballast_river").val(row.fuelConsumtion_ballast_river)
            $("#fuelConsumtion_ballast_sea").val(row.fuelConsumtion_ballast_sea)
            $("#fuelConsumtion_runningfree").val(row.fuelConsumtion_runningfree)
            $("#fuelConsumtion_standby").val(row.fuelConsumtion_standby)
            
            $("#speed_laden_river").val(row.speed_laden_river)
            $("#speed_laden_sea").val(row.speed_laden_sea)
            $("#speed_ballast_river").val(row.speed_ballast_river)
            $("#speed_ballast_sea").val(row.speed_ballast_sea)
            $("#speed_runningfree").val(row.speed_runningfree)

            $("#created_at").html(row.created_at)
            $("#updated_at").html(row.updated_at)
            $("#created_by").html(row.created_by_name)
            $("#updated_by").html(row.updated_by_name)


            $("#ummu_nav_tab #nav-tab-listData").removeClass("active")
            $("#ummu_tab_contnet #nav-listData").removeClass("show active")
            
            $("#ummu_nav_tab #nav-tab-form").addClass("active")
            $("#ummu_tab_contnet #nav-form").addClass("show active")

            $ummu.button.sbBtn_on_showData()

            app.views.showHide_form(row.type_id)
        },

        showHide_form: function(type_id)
        {
            if (type_id == "1") {
                $("#nav-tab-machinery").prop("disabled", false).addClass("active");
                $("#nav-tab-tank").prop("disabled", false).removeClass("active");
                $("#nav-tab-dimension").prop("disabled", true).removeClass("active");
                $("#nav-tab-fuelconsum").prop("disabled", false).removeClass("active");
                $("#nav-tab-speed").prop("disabled", false).removeClass("active");

                $("#nav-machinery").addClass("show active");
                $("#nav-tank").removeClass("show active");
                $("#nav-dimension").removeClass("show active");
                $("#nav-fuelconsum").removeClass("show active");
                $("#nav-speed").removeClass("show active");
            }else if (type_id == "2") {
                $("#nav-tab-machinery").prop("disabled", true).removeClass("active");
                $("#nav-tab-tank").prop("disabled", true).removeClass("active");
                $("#nav-tab-dimension").prop("disabled", false).addClass("active");
                $("#nav-tab-fuelconsum").prop("disabled", true).removeClass("active");
                $("#nav-tab-speed").prop("disabled", true).removeClass("active");

                $("#nav-machinery").removeClass("show active");
                $("#nav-tank").removeClass("show active");
                $("#nav-dimension").addClass("show active");
                $("#nav-fuelconsum").removeClass("show active");
                $("#nav-speed").removeClass("show active");
            }else if (type_id == "3") {
                $("#nav-tab-machinery").prop("disabled", false).addClass("active");
                $("#nav-tab-tank").prop("disabled", false).removeClass("active");
                $("#nav-tab-dimension").prop("disabled", false).removeClass("active");
                $("#nav-tab-fuelconsum").prop("disabled", false).removeClass("active");
                $("#nav-tab-speed").prop("disabled", false).removeClass("active");

                $("#nav-machinery").addClass("show active");
                $("#nav-tank").removeClass("show active");
                $("#nav-dimension").removeClass("show active");
                $("#nav-fuelconsum").removeClass("show active");
                $("#nav-speed").removeClass("show active");
            }else{
                $("#nav-tab-machinery").prop("disabled", true).removeClass("active");
                $("#nav-tab-tank").prop("disabled", true).removeClass("active");
                $("#nav-tab-dimension").prop("disabled", true).removeClass("active");
                $("#nav-tab-fuelconsum").prop("disabled", true).removeClass("active");
                $("#nav-tab-speed").prop("disabled", true).removeClass("active");

                $("#nav-machinery").removeClass("show active");
                $("#nav-tank").removeClass("show active");
                $("#nav-dimension").removeClass("show active");
                $("#nav-fuelconsum").removeClass("show active");
                $("#nav-speed").removeClass("show active");
            }
        }
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