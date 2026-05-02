var app = {
    register: function () {
        app.config.autoload()
    },

    config: {
        autoload: function () {
            $ummu.func.location_hash()
            $ummu.dt.load2();
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
        },

        sbSave: function () {
            var spal_id = $("#spal").attr('data-id');
            var spal_number = $("#spal").val();
            var tgl = $("#iDate").val();
            var number = $("#number").val();
            var from_dept_id = $("#from_dept").attr('data-id');
            var to_dept_id = $("#to_dept").attr('data-id');

            var client_id = $("#client").attr('data-id');
            var tugboat_id = $("#tugboat").attr('data-id');
            var barge_id = $("#barge").attr('data-id');
            var ukuran_barge = $("#ukuran_barge").val();
            var tonnage = $("#tonnage").val();
            var uom_id = $("#uom").attr('data-id');

            var eta_loading_port = $("#eta_loading_port").attr('data-from');
            var eta_loading_port_to = $("#eta_loading_port").attr('data-to');
            var eta_discharge_port = $("#eta_discharge_port").val();

            var loading_port = $("#loading_port").val();
            var discharge_port = $("#discharge_port").val();

            $ummu.vars.formData.append("spal_id", spal_id);
            $ummu.vars.formData.append("spal_number", spal_number);
            $ummu.vars.formData.append("tgl", tgl);
            $ummu.vars.formData.append("number", number);
            $ummu.vars.formData.append("from_dept_id", from_dept_id);
            $ummu.vars.formData.append("to_dept_id", to_dept_id);

            $ummu.vars.formData.append("client_id", client_id);
            $ummu.vars.formData.append("tugboat_id", tugboat_id);
            $ummu.vars.formData.append("barge_id", barge_id);
            $ummu.vars.formData.append("barge_loa", ukuran_barge);
            $ummu.vars.formData.append("tonnage", tonnage);
            $ummu.vars.formData.append("uom_id", uom_id);

            $ummu.vars.formData.append("eta_loading_port", eta_loading_port);
            $ummu.vars.formData.append("eta_loading_port_to", eta_loading_port_to);
            $ummu.vars.formData.append("eta_discharge_port", eta_discharge_port);

            $ummu.vars.formData.append("loading_port", loading_port);
            $ummu.vars.formData.append("discharge_port", discharge_port);

            var payload = {
                "spal_id": spal,
                "spal_number": spal_number,
                "tgl": tgl,
                "number": number,
                "from_dept_id": from_dept_id,
                "to_dept_id": to_dept_id,

                "client_id": client_id,
                "tugboat_id": tugboat_id,
                "barge_id": barge_id,
                "barge_loa": ukuran_barge,
                "tonnage": tonnage,
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
            $("#tonnage").val(row.qty)
            $("#uom").html(row.uom_kode).attr('data-id', row.uom_id)

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
            $("#uom").html(row.uom_kode).attr('data-id', row.uom_id)

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
                    $("#status").html('<span class="badge badge-secondary">Release</span>')
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
            $("#status, #uom").html('')

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
                        render: DataTable.render.select()
                    },
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
                        title: "Status",
                        data: "release_name",
                        render: function(data, type, row) {
                            if (row.is_release == null || row.is_release == 0 || row.is_release == 1) {
                                return '<span class="text-secondary">'+data+'</span>';
                            }else if (row.is_release == 2) {
                                return '<span class="text-primary">'+data+'</span>';
                            }else if (row.is_release == 3) {
                                return '<span class="text-warning">'+data+'</span>';
                            }else{
                                return '<span class="text-success">'+data+'</span>';
                            }
                        }
                    },
                    { 
                        title: "Tanggal IJO",
                        data: "tgl"
                    },
                    { 
                        title: "Nomor IJO",
                        data: "number"
                    },
                    { 
                        title: "Dari Departemen",
                        data: "from_dept_name"
                    },
                    { 
                        title: "Untuk Departemen",
                        data: "to_dept_name"
                    },
                    { 
                        title: "SPAL Number",
                        data: "spal_number"
                    },
                    { 
                        title: "Port of Loading",
                        data: "loading_port"
                    },
                    { 
                        title: "Port of Discharge",
                        data: "discharge_port"
                    },
                ];
        
                return columns;
            },
        },
    },
};

$(document).ready(function () {
    app.config.autoload()
});