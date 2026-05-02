var app = {
    register: function () {
        app.config.autoload()
    },

    config: {
        autoload: function () {
            $ummu.func.location_hash()
            $ummu.dt.load2();

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
            if ($ummu.dt.is_init($table) == true) {
                $ummu.dt.init_destroy();
            }

            $ummu.dt.init = new DataTable(
                $table,
                $ummu.dt.config.show()
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
        config: {
            columns: function () {
                let columns = [
                    { data: null, render: DataTable.render.select() },
                    { 
                        title: "ID",
                        data: "id",
                        render: function (data, type) {
                            return (
                                '<a href="javascript:void(0);">'+
                                    '<div><span>' + data + '</span> <i class="fas fa-external-link-alt ml-2"></i></div>'+
                                '</a>'
                            );
                        }
                    },
                    { 
                        title: "Name",
                        data: "name"
                    },
                    { 
                        title: "Port of Loading",
                        data: "from_name"
                    },
                    { 
                        title: "Port of Discharge",
                        data: "to_name"
                    },
                    { 
                        title: "Distance",
                        data: "distance"
                    },
                ];
        
                return columns;
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