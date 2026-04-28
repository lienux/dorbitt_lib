var app = {
    register: function () {
        app.config.autoload()
    },

    config: {
        autoload: function () {
            $ummu.func.location_hash()
            $ummu.localStorage.dt_default($localStrgKey);
            $ummu.dt.layout.buttonAll($ummu.dt.init);

            // $ummu.dt.init2_kosong(table2);

            var waypoint_rows = [];

            app.dt.waypoint.init = new DataTable(
                table2, {
                columns: [
                    {
                        title: "ID",
                        data: "id",
                        className: "text-center",
                        render: function (data, type, row) {
                            return (
                                '<a href="javascript:void(0);"><div><span class="">' +
                                data +
                                '</span> <i class="fas fa-external-link-alt ml-2"></i></div></a>'
                            );
                        },
                    },
                    { 
                        title: "Sequence", 
                        data: "sequence",
                        className: "text-center"
                    },
                    { title: "Name", data: "nama" },
                    { title: "Latitude", data: "lintang" },
                    { title: "Longitude", data: "bujur" },
                    { title: "Course (°T)", data: "haluan" },
                    { title: "Distance between points (NM)", data: "jarak_antar_titik" },
                    { title: "Total distance (NM)", data: "total_jarak" },
                ],
                createdRow: function(row, data, dataIndex) {
                    // Ambil total jumlah data
                    const totalRows = this.api().rows().count();

                    // Cek jika baris pertama (index 0) 
                    // atau baris terakhir (index totalRows - 1)
                    if (dataIndex === 0 || dataIndex === totalRows - 1) {
                        $(row).addClass('font-weight-bold');
                    }
                },
                data: waypoint_rows,
                layout: {
                    topStart: {
                        buttons: [],
                    },
                },
            });

            setTimeout(() => {
                $ummu.dt.layout.buttonDefaultAndCustom(app.dt.waypoint.init, ['btn_new']);
                app.dt.waypoint.init.button('#dt_btn_new').disable();
            }, 1000); // 2000 ms = 2 detik

            $ummu.dt.init.on("click", "tbody tr td:nth-child(2)", function () {
                var row = $ummu.dt.init.row(this).data();
                // console.log(row)
                
                $ummu.url.setParamFromRow(row)

                // 2. Ubah bagian array (detail_waypoint) menjadi string JSON
                // Karena URL params tidak mendukung struktur nested secara native
                const detail_waypoint = JSON.stringify(row.detail_waypoint);

                // 3. Masukkan ke URLSearchParams
                // const params = new URLSearchParams(formattedData);
                $ummu.url.setParam('detail_waypoint', detail_waypoint);

                // $ummu.vars.is_row = true;
                // app.controllers.detail(row);
                app.views.setRow_toForm(row);
            });

            $("#modal_btnSave_waypoint").on('click', function(){
                // console.log('ok')
                app.controllers.collect_waypoint();
            });
        },
    },

    vars: {
        initTable2: null,
        runing_id: null,
        init: null,
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
            app.dt.waypoint.init.button('#dt_btn_new').enable();
        },

        sbSave: function () {
            var name = $("#name").val();
            var from_id = $("#port_of_loading").attr('data-id');
            var to_id = $("#port_of_discharge").attr('data-id');

            $ummu.vars.formData.append("name", name);
            $ummu.vars.formData.append("from_id", from_id);
            $ummu.vars.formData.append("to_id", to_id);

            var payload = {
                "name": name,
                "from_id": from_id,
                "to_id": to_id,
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
                $ummu.views.errors_msg(validation) //string or array
                $(".btn-endis").removeClass('btn-outline-secondary').addClass('btn-primary')
            }else{
                var ummu = $ummu.ajax.ummu7(params);   
                ummu.done(function(result) {
                    const response = JSON.parse(result);
                    $ummu.views.after_sbToolbar_save(response, func, id, payload);

                    if (response.status == true) {
                        $("#file_url").attr("href", response.data.fileUrl)
                        let is_release = response.data.is_release;
                        if (is_release == null || is_release == '' || is_release == 0) {
                            $ummu.button.sbBtnToolbar.addRemove_btnRelease('add');
                        }else{
                            $ummu.button.sbBtnToolbar.addRemove_btnRelease('rm');
                        }
                    }else{
                        $(".btn-endis").removeClass('btn-outline-secondary').addClass('btn-primary')
                    }
                }).fail(function() {
                    // An error occurred
                    console.log(ummu)
                });
            }
        },

        sbCancle: function () {
            app.dt.waypoint.init.button('#dt_btn_new').disable();
            if ($ummu.url.getParam('id')) {
                // 
            }else{
                app.views.forClear()
            }
        },

        sbEdit: function () {
            app.dt.waypoint.init.button('#dt_btn_new').enable();
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
                    }
                }
            }).fail(function() {
                // An error occurred
                console.log(ummu)
            });
        },

        on_showLeftModal: function(id) {
            console.log(id)
            if (id == 'port_of_loading' || id == 'port_of_discharge') {
                $ummu.url.setParam('set_to_id', id);
                $ummu.controllers.show_pelabuhan(id);
            } else{
                //
            }
        },

        // on_click_tbody_trtd_child1: function(row) {
        //     console.log(row)
        //     // app.views.setRow_toForm_freightCharter(row)
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
        //     $("#uom").html(row.uom_kode).attr('data-id', row.uom_id)

        //     $("#eta_loading_port").val(row.loading_availability_date_from + " - " + row.loading_availability_date_to)
        //     .attr('data-from', row.loading_availability_date_from)
        //     .attr('data-to', row.loading_availability_date_to)

        //     $("#si_number").val(row.si_number)
        //     $("#si_url").attr('href', row.si_fileUrl)
        // },

        // on_click_tbody_trtd_child_country: function(row) {
        //     // console.log(row)
        //     $("#country").val(row.name).attr('data-id', row.id);
        // },

        on_click_tbody_trtd_child_pelabuhan: function(row) {
            // console.log(row)
            var set_to_id = $ummu.url.getParam('set_to_id');

            if (set_to_id == 'port_of_loading' && $("#port_of_discharge").attr('data-id') == row.id) {
                let msg = "Has been used for Discharge.";
                $ummu.views.errors_msg(msg) //string or array
            }else if (set_to_id == 'port_of_discharge' && $("#port_of_loading").attr('data-id') == row.id) {
                let msg = "Has been used for Loading.";
                $ummu.views.errors_msg(msg) //string or array
            } else{
                $("#"+set_to_id).val(row.name).attr('data-id', row.id);
                $ummu.url.delParam('set_to_id');
            }
        },

        on_dtBtnNew_click: function() {
            // var kondisiBerlayar = $("#sailing_conditions").val();

            // if (kondisiBerlayar == "" || kondisiBerlayar == null) {
            //     $ummu.views.errors_msg("Silahkan pilih Conditions terlebih dahulu.");
            // }else{
                $("#modalForm_inputWaypoint").modal('show');
            // }
        },

        collect_waypoint: function() {
            var name = $("#name").val();
            var lintang = $("#lintang").val();
            var lintang_menit = $("#lintang_menit").val();
            var arah_sn = $("#arah_sn").val();
            var bujur = $("#bujur").val();
            var bujur_menit = $("#bujur_menit").val();
            var arah_ew = $("#arah_ew").val();

            var payload = {
                "nama": name,
                "lintang": lintang+'-'+lintang_menit+arah_sn,
                "bujur": bujur+'-'+bujur_menit+arah_ew,
            };

            console.log(payload)
        },
    },

    validation: {
        save: function() {
            var list = [];
            list = $ummu.validation.inputValidate3();

            return list;
        }
    },

    views: {
        formParams: function() {
            return $("#form_input .endis");
        },

        setRow_toForm: function(row) {
            // console.log(JSON.parse(row.detail_waypoint))

            $ummu.views.tab_content('setRow_toForm')

            $("#name").val(row.name)
            $("#port_of_loading").val(row.from_name).attr('data-id', row.from_id)
            $("#port_of_discharge").val(row.to_name).attr('data-id', row.to_id)


            $ummu.views.setIdentitiyToForm(row)
            $ummu.button.sbBtn_on_showData()
            
            setTimeout(() => {
                var detail_waypoint = JSON.parse($ummu.url.getParam('detail_waypoint'));
                // console.log("Eksekusi setelah 2 detik");
                app.dt.waypoint.init.clear().rows.add(detail_waypoint).draw();
            }, 1000); // 2000 ms = 2 detik
        },

        forClear: function() {
            $("#form_input input").val('');
            // $("#status, #uom").html('')

            if (app.dt.waypoint.init.rows().count() > 0) {
                app.dt.waypoint.init.clear().draw();
            }

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
                    { data: "name"},
                    { data: "from_name"},
                    { data: "to_name"},
                    { data: "distance"},
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
        waypoint: {
            init: null,
        }
    },
};

$(document).ready(function () {
    app.config.autoload()
});