var app = {
    register: function () {
        app.config.autoload()
    },

    config: {
        autoload: function () {
            $ummu.func.location_hash()
            $ummu.helpers.renderComplexHeader($table, app.dt.config.columns());
            $ummu.dt.load2();

            // $ummu.formatter.number($("#form_input #nome"), 1);
            // $ummu.formatter.number($("#form_input #hp"), 4);
            // $ummu.formatter.number($("#form_input #lightship"), 4);
            // $ummu.formatter.number($("#form_input #capacity"), 5);
            // $ummu.formatter.number($("#form_input .speed"), 1, ' Knot');
            // $ummu.formatter.number($("#form_input .fuelcons"), 3);
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
            var file_upload = $("#file_upload")[0].files[0];
            var tgl = $("#iDate").val();
            var number = $("#number").val();
            var client_id = $("#client").attr('data-id');
            var tugboat_id = $("#tugboat").attr('data-id');
            var barge_id = $("#barge").attr('data-id');
            var load_type = $("#load_type").val();
            var qty = $("#qty").val();
            var uom_id = $("#uom").attr('data-id');
            var rute_id = $("#voyage_route").attr('data-id');
            var loading_availability_date_from = $("#iDateLoadingFrom").val();
            var loading_availability_date_to = $("#iDateLoadingTo").val();
            var loading_port = $("#loading_port").val();
            var discharge_port = $("#discharge_port").val();

            var formData = new FormData();
            formData.append("file_upload", file_upload);
            formData.append("tgl", tgl);
            formData.append("number", number);
            formData.append("client_id", client_id);
            formData.append("tugboat_id", tugboat_id);
            formData.append("barge_id", barge_id);
            formData.append("load_type", load_type);
            formData.append("qty", qty);
            formData.append("uom_id", uom_id);
            formData.append("rute_id", rute_id);
            formData.append("loading_availability_date_from", loading_availability_date_from);
            formData.append("loading_availability_date_to", loading_availability_date_to);
            formData.append("loading_port", loading_port);
            formData.append("discharge_port", discharge_port);

            var payload = {
                "tgl": tgl,
                "number": number,
                "client_id": client_id,
                "tugboat_id": tugboat_id,
                "barge_id": barge_id,
                "load_type": load_type,
                "qty": qty,
                "uom_id": uom_id,
                "rute_id": rute_id,
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
                "data": formData,
                "loader": true,
            };

            const validation = app.validation.save(func);

            if (validation.length > 0) {
                $ummu.views.errors_msg(validation)
                $(".btn-endis").removeClass('btn-outline-secondary').addClass('btn-primary')
            }else{
                console.log('tidak ada validation')
                var ummu = $ummu.ajax.ummu7(params);   
                ummu.done(function(result) {
                    const response = JSON.parse(result);
                    $ummu.views.after_sbToolbar_save(response, func, id, payload);

                    $(".custom-file-label").html(response.data.fileNameOrigin)
                    $("#file_url").attr("href", response.data.fileUrl)

                    if (func == 'create') {
                        //
                    }else{
                        // 
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
            }else if (id == 'voyage_route') {
                $ummu.controllers.show_voyage_route();
            }
        },

        on_click_tbody_trtd_child_voyage_route2: function(row) {
            $("#voyage_route").val(row.name).attr('data-id', row.id);
            $("#loading_port").val(row.from_name);
            $("#discharge_port").val(row.to_name);
        },
    },

    validation: {
        save: function(func) {
            var list = [];
            
            list = $ummu.validation.inputValidate();

            if (func == 'create') {
                var file_upload = $('#file_upload').val();

                if ($ummu.func.isValue(file_upload) == false) {
                    list.push('File is required')
                }
            }else{
                var filename = $(".custom-file-label").html()

                if ($ummu.func.isValue(filename) == false) {
                    list.push('File is required.')
                }
            }

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
        },
    },

    views: {
        formParams: function() {
            return $("#form_input .endis");
        },

        setRow_toForm: function(row) {
            // console.log(row)
            $("#iDate").val(row.tgl)
            $("#number").val(row.number)
            $("#client").val(row.client_name).attr('data-id', row.client_id)
            $("#tugboat").val(row.tugboat_name).attr('data-id', row.tugboat_id)
            $("#barge").val(row.barge_name).attr('data-id', row.barge_id)
            $("#load_type").val(row.load_type)
            $("#qty").val(row.qty)
            $("#uom").val(row.uom_kode).attr('data-id', row.uom_id)
            $("#voyage_route").val(row.rute_name).attr('data-id', row.rute_id)

            $("#iDateLoadingFrom").val(row.loading_availability_date_from)
            $("#iDateLoadingTo").val(row.loading_availability_date_to)
            $("#loading_port").val(row.from_name)
            $("#discharge_port").val(row.to_name)
            $(".custom-file-label").html(row.fileNameOrigin)
            $("#file_url").attr("href", row.fileUrl)

            if (row.fileNameOrigin) {
                // $("#file_url span").html(row.fileNameOrigin)
                $("#file_url").attr("href", row.fileUrl)
            }else{
                // $("#file_url span").html("File not available.")
                $(".custom-file-label").html('No file...')

            }

            $ummu.views.setIdentitiyToForm(row)
            $ummu.button.sbBtn_on_showData()
        },

        forClear: function() {
            $("#form_input input").val('');

            $("#file_url").removeAttr('href')
            $(".custom-file-label").html('Choose file...')

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
                        rowspan: true,
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
                        title: "Date",
                        rowspan: true,
                        data: "tgl"
                    },
                    { 
                        title: "Number",
                        rowspan: true,
                        data: "number"
                    },
                    { 
                        title: "Shipper",
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
                        title: "Type",
                        group: "Loading",
                        data: "load_type"
                    },
                    { 
                        title: "Qty",
                        group: "Loading",
                        data: "qty"
                    },
                    { 
                        title: "UoM",
                        group: "Loading",
                        data: "uom_name"
                    },
                    { 
                        title: "Date of Loading",
                        group: "Loading",
                        data: null,
                        render: function (data, type, row) {
                            return row.loading_availability_date_from + '  -  ' + row.loading_availability_date_to;
                        }
                    },
                    { 
                        title: "Port of Loading",
                        group: "Port",
                        data: "loading_port"
                    },
                    { 
                        title: "Port of Discharge",
                        group: "Port",
                        data: "discharge_port"
                    },
                    { 
                        title: "File",
                        rowspan: true,
                        data: "fileNameOrigin"
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