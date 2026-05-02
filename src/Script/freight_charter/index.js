var app = {
    register: function () {
        app.config.autoload()
    },

    config: {
        autoload: function () {
            $ummu.func.location_hash()
            $ummu.helpers.renderComplexHeader($table, app.dt.config.columns());
            $ummu.dt.load2()
            $ummu.formatter.number($("#biaya_angkutan"), 12)
            $ummu.formatter.number($("#qty"), 6)
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
        },

        sbSave: function () {
            var shipment = $("#shipment").attr('data-id');
            var tgl = $("#iDate").val();
            var number = $("#number").val();
            var biaya_angkutan = $("#biaya_angkutan").val();
            var kondisi_perjanjian = $("#kondisi_perjanjian").val();
            var file_upload = $("#file_upload")[0].files[0];

            var client = $("#client").attr('data-id');
            var tugboat = $("#tugboat").attr('data-id');
            var barge = $("#barge").attr('data-id');
            var load_type = $("#load_type").val();
            var qty = $("#qty").val();
            var uom_id = $("#uom").attr('data-id');

            var loading_availability_date_from = $("#iDateLoadingFrom").val();
            var loading_availability_date_to = $("#iDateLoadingTo").val();
            var loading_port = $("#loading_port").val();
            var discharge_port = $("#discharge_port").val();

            $ummu.vars.formData.append("si_id", shipment);
            $ummu.vars.formData.append("tgl_surat", tgl);
            $ummu.vars.formData.append("nomor_surat", number);
            $ummu.vars.formData.append("biaya_angkutan", biaya_angkutan);
            $ummu.vars.formData.append("kondisi_perjanjian", kondisi_perjanjian);
            $ummu.vars.formData.append("file_upload", file_upload);

            $ummu.vars.formData.append("client", client);
            $ummu.vars.formData.append("tugboat", tugboat);
            $ummu.vars.formData.append("barge", barge);
            $ummu.vars.formData.append("load_type", load_type);
            $ummu.vars.formData.append("qty", qty);
            $ummu.vars.formData.append("uom_id", uom_id);

            $ummu.vars.formData.append("loading_availability_date_from", loading_availability_date_from);
            $ummu.vars.formData.append("loading_availability_date_to", loading_availability_date_to);
            $ummu.vars.formData.append("loading_port", loading_port);
            $ummu.vars.formData.append("discharge_port", discharge_port);

            var payload = {
                "tgl": tgl,
                "number": number,
                "client": client,
                "tugboat": tugboat,
                "barge": barge,
                "load_type": load_type,
                "qty": qty,
                "uom_id": uom_id,
                "price": biaya_angkutan,
                "loading_availability_date_from": loading_availability_date_from,
                "loading_availability_date_to": loading_availability_date_to,
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
                app.views.forClear()
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
                $ummu.controllers.show_clients();
            }else if (id == 'tugboat') {
                $ummu.controllers.show_tugboat();
            }else if (id == 'barge') {
                $ummu.controllers.show_barge();
            }else if (id == 'uom') {
                $ummu.controllers.show_uom();
            }else if (id == 'shipment') {
                $ummu.controllers.show_shippingInstruction();
            }
        },

        on_click_tbody_trtd_child1: function(row) {
            // console.log(row)
            app.views.setRow_toForm_freightCharter(row)
        },
    },

    validation: {
        save: function() {
            var list = [];
            list = $ummu.validation.inputValidate();

            // var charterTypeId = $('input[name="charterTypeId"]:checked').val();

            // if ($ummu.func.isValue(charterTypeId) == false) {
            //     list.push('Charter Type required')
            // }

            // if (charterTypeId == "1") {
            //     if ($ummu.func.isValue($("#shipment").attr('data-id')) == false) {
            //         list.push($("#shipment").attr('data-label'))
            //     }
            // }

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
            $("#uom").html(row.uom_kode).attr('data-id', row.uom_id)

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
            $ummu.button.sbBtn_on_showData()
        },

        setRow_toForm_freightCharter: function(row) {
            // console.log(row)
            // $("#form_input #iDate").val(row.tgl)
            // $("#form_input #number").val(row.number)
            $("#client").val(row.client_name).attr('data-id', row.client_id)
            $("#tugboat").val(row.tugboat_name).attr('data-id', row.tugboat_id)
            $("#barge").val(row.barge_name).attr('data-id', row.barge_id)
            $("#load_type").val(row.load_type)
            // $("#form_input #qty").val(row.qty)
            $("#qty").val($ummu.formatter.id(row.qty))
            $("#uom").html(row.uom_kode).attr('data-id', row.uom_id)

            $("#iDateLoadingFrom").val(row.loading_availability_date_from)
            $("#iDateLoadingTo").val(row.loading_availability_date_to)
            $("#loading_port").val(row.loading_port)
            $("#discharge_port").val(row.discharge_port)
            // $(".custom-file-label").html(row.fileNameOrigin)
            // $("#form_input #file_url").attr("href", row.fileUrl)

            // if (row.fileNameOrigin) {
            //     // $("#form_input #file_url span").html(row.fileNameOrigin)
            //     $("#form_input #file_url").attr("href", row.fileUrl)
            // }else{
            //     // $("#form_input #file_url span").html("File not available.")
            //     $(".custom-file-label").html('No file...')

            // }

            // $("#form_input #file_url").attr("href", row.fileUrl)

            // if (row.fileNameOrigin) {
            //     $("#form_input #file_url span").html(row.fileNameOrigin)
            // }else{
            //     $("#form_input #file_url span").html("File not available.")
            // }

            // $ummu.views.setIdentitiyToForm(row)

            // $("#ummu_nav_tab #nav-tab-listData").removeClass("active")
            // $("#ummu_tab_contnet #nav-listData").removeClass("show active")
            
            // $("#ummu_nav_tab #nav-tab-form").addClass("active")
            // $("#ummu_tab_contnet #nav-form").addClass("show active")

            // $ummu.button.sbBtn_on_showData()
        },

        forClear: function() {
            // $("#form_input input").not('#FreightCharter, #TimeCharter, #file_uploadz').val('');
            $("#form_input input").val('');
            $("#uom").html('')
            $("#file_url").removeAttr('href')
            $(".custom-file-label").html('Choose file...')
            // $("#FreightCharter, #TimeCharter").prop('checked', false)
            // $("#FreightCharter, #TimeCharter, #file_upload").prop('disabled', true)

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
                        rowspan: true,
                        data: null,
                        render: DataTable.render.select()
                    },
                    { 
                        title: "ID",
                        rowspan: true,
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
                        title: "Shipment (SI)",
                        rowspan: true,
                        data: "si_number"
                    },
                    { 
                        title: "Tgl Surat",
                        rowspan: true,
                        data: "tgl"
                    },
                    { 
                        title: "Nomor Surat",
                        rowspan: true,
                        data: "number"
                    },
                    { 
                        title: "Biaya Angkut",
                        rowspan: true,
                        data: "price",
                        render: function(data, type) {
                            return $ummu.formatter.id(data)
                        }
                    },
                    { 
                        title: "Kondisi Perjanjian",
                        rowspan: true,
                        data: "kondisi_perjanjian"
                    },
                    { 
                        title: "Penyewa",
                        rowspan: true,
                        data: "client_name"
                    },
                    { 
                        title: "Tugboat",
                        rowspan: true,
                        data: "tugboat_name"
                    },
                    { 
                        title: "Barge",
                        rowspan: true,
                        data: "barge_name"
                    },
                    { 
                        title: "Jenis Muatan",
                        rowspan: true,
                        data: "load_type"
                    },
                    {
                        title: "Volume Muatan",
                        rowspan: true,
                        data: "qty",
                        className: "text-right",
                        render: function(data, type, row) {
                            return $ummu.formatter.id(data) + ' ' + row.uom_kode
                        }
                    },
                    { 
                        title: "Date of Loading",
                        rowspan: true,
                        data: null,
                        render: function(data, type, row) {
                            return 'From: ' + row.loading_availability_date_from + ' To: ' + row.loading_availability_date_to;
                        }
                    },
                    {
                        title: "Loading",
                        data: "loading_port",
                        group: "Port of"
                    },
                    { 
                        title: "Discharge",
                        data: "discharge_port",
                        group: "Port of"
                    },
                ];
        
                return columns;
            },
        }
    },
};

$(document).ready(function () {
    app.config.autoload()
});