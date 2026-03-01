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

            $ummu.formatter.number($("#form_input #nome"), 1);
            $ummu.formatter.number($("#form_input #hp"), 4);
            $ummu.formatter.number($("#form_input #lightship"), 4);
            $ummu.formatter.number($("#form_input #capacity"), 5);
            $ummu.formatter.number($("#form_input .speed"), 1, ' Knot');
            $ummu.formatter.number($("#form_input .fuelcons"), 3);
        },
    },

    vars: {
        initTable2: null,
        runing_id: null,
        init: null,
    },

    controllers: {
        on_btn_getData_click: function () {
            $ummu.url.delParamNotIn(['g']);
            app.views.formParams().prop('disabled', true).val('');
            $ummu.button.sbBtn_default();
            app.controllers.show()
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
                }
            });
        },

        sbNew: function () {
            // $ummu.url.delAllParam();
            $ummu.url.delParamNotIn(['g']);
            $ummu.vars.id = null
            $ummu.vars.account.id = null
            // app.vars.runing_id = null
            // console.log("OK")
            if (app.vars.initTable2 == null) {
                // $ummu.bt.initTable($table2)
                // app.vars.initTable2 = true;
            } else {
                // 
            }

            app.views.formParams().prop('disabled', false).val('');
            // $table2.bootstrapTable('removeAll');
        },

        sbSave: function () {
            var payload = {
                "kode": $("#form_input #kode").val(),
                "name": $("#form_input #name").val(),
                "nome": $("#form_input #nome").val(),
                "hp": $("#form_input #hp").val(),
                "lightship": $("#form_input #lightship").val(),
                "capacity": $("#form_input #capacity").val(),
                "laden_river_speed": $("#form_input #laden_river_speed").val(),
                "laden_river_fuelcons": $("#form_input #laden_river_fuelcons").val(),
                "laden_sea_speed": $("#form_input #laden_sea_speed").val(),
                "laden_sea_fuelcons": $("#form_input #laden_sea_fuelcons").val(),
                "ballast_river_speed": $("#form_input #ballast_river_speed").val(),
                "ballast_river_fuelcons": $("#form_input #ballast_river_fuelcons").val(),
                "ballast_sea_speed": $("#form_input #ballast_sea_speed").val(),
                "ballast_sea_fuelcons": $("#form_input #ballast_sea_fuelcons").val(),
                "stby_fuelcons": $("#form_input #stby_fuelcons").val(),
                "runningfree_speed": $("#form_input #runningfree_speed").val(),
                "runningfree_cons": $("#form_input #runningfree_cons").val(),
            };

            const id = $ummu.url.getParam('id');

            if (id) {
                var func = "update/" + id
            }else{
                var func = "create"
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

            console.log(params)

            if (app.validation.save == false) {
                console.log('ada validation')
            }else{
                console.log('tidak ada validation')
                var ummu = $ummu.ajax.ummu8(params);   
                ummu.done(function(result) {
                    // console.log(result)
                    if (result.status == true) {
                        $ummu.views.after_save(result, func, id, payload);
                    }

                }).fail(function() {
                    // An error occurred
                    console.log(ummu)
                });
            }
        },

        sbCancleNew: function () {
            app.views.formParams().prop('disabled', true).val('');
        },

        sbCancle: function () {
            app.views.formParams().prop('disabled', true).val('');
        },

        sbEdit: function () {
            app.views.formParams().prop('disabled', false);
        },

        sbCancleEdit: function () {
            app.views.formParams().prop('disabled', true);
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
                console.log(result)
                if (result.status == true) {
                    // hapus params para url
                    $ummu.url.delParamNotIn(['g']);

                    // sb-button default
                    $ummu.button.sbBtn_default();

                    // disable dan kosongkan form
                    app.views.formParams().prop('disabled', true).val('');

                    // hapus row pada localStorage
                    $ummu.localStorage.deleteRowById($localStrgKey, id);

                    // delete row pada table dengan cara get rows dari localStorage yang sudah diupdate
                    $ummu.localStorage.dt_default($localStrgKey);

                    // hide modal delete confirm
                    $(".sb-toolbar #modalDeleteConfirm").modal("hide")
                }

            }).fail(function() {
                // An error occurred
                console.log(ummu)
            });
        }
    },

    validation: {
        save: function() {
            if ($("#form_input #name").val() == '') {

            }
        }
    },

    views: {
        formParams: function() {
            // return $("#kode, #name, #nome, #hp, #lightship, #capacity, #stby_fuelcons, #laden_river_speed, #laden_river_fuelcons, #laden_sea_speed, #laden_sea_fuelcons");
            return $("#form_input input");
        },

        setRow_toForm: function(row) {
            $("#kode").val(row.kode)
            $("#name").val(row.name)
            $("#nome").val(row.nome)
            $("#hp").val(row.hp)
            $("#lightship").val(row.lightship)
            $("#capacity").val(row.capacity)
            $("#stby_fuelcons").val(row.stby_fuelcons)

            $("#laden_river_speed").val(row.laden_river_speed)
            $("#laden_river_fuelcons").val(row.laden_river_fuelcons)
            $("#laden_sea_speed").val(row.laden_sea_speed)
            $("#laden_sea_fuelcons").val(row.laden_sea_fuelcons)

            $("#ballast_river_speed").val(row.ballast_river_speed)
            $("#ballast_river_fuelcons").val(row.ballast_river_fuelcons)
            $("#ballast_sea_speed").val(row.ballast_sea_speed)
            $("#ballast_sea_fuelcons").val(row.ballast_sea_fuelcons)
            
            $("#runningfree_speed").val(row.runningfree_speed)
            $("#runningfree_cons").val(row.runningfree_cons)



            $("#ummu_nav_tab #nav-tab-listData").removeClass("active")
            $("#ummu_tab_contnet #nav-listData").removeClass("show active")
            
            $("#ummu_nav_tab #nav-tab-form").addClass("active")
            $("#ummu_tab_contnet #nav-form").addClass("show active")

            $ummu.button.sbBtn_on_showData()
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
                    { data: "kode"},
                    { data: "name"},
                    { data: "nome"},
                    { data: "hp"},
                    { data: "lightship"},
                    { data: "capacity"},
                    { data: "client_id"},
                    { data: "laden_river_speed"},
                    { data: "laden_river_fuelcons"},
                    { data: "laden_sea_speed"},
                    { data: "laden_sea_fuelcons"},
                    { data: "ballast_river_speed"},
                    { data: "ballast_river_fuelcons"},
                    { data: "ballast_sea_speed"},
                    { data: "ballast_sea_fuelcons"},
                    { data: "stby_fuelcons"},
                    { data: "runningfree_speed"},
                    { data: "runningfree_cons"},
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