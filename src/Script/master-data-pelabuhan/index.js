var app = {
    register: function () {
        app.config.autoload()
    },

    config: {
        autoload: function () {
            $ummu.func.location_hash()
            $ummu.button.sbToolbar()
            localStorage.setItem(`${$ummu.vars.module_kode}_isDtServerSide`, false);
            $ummu.config.dataTables()
            app.controllers.index();
        },
    },

    vars: {
        initTable2: null,
        runing_id: null,
        init: null,
    },

    controllers: {
        index: function() {
            $ummu.dt.controllers.index();
        },

        show: function () {
            $ummu.dt.controllers.reload()

            $ummu.dt.init.on('xhr.dt', function (e, settings, json, xhr) {
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

        sbNew: function () {
            app.views.forClear()
            $("#lintang_arah, #bujur_arah").prop('disabled', false)
            // $("#status").html('<span class="badge badge-secondary">Draft</span>')
            // $("#from_dept").val($ummu.vars.employee.department).attr('data-id', $ummu.vars.employee.department_id)
        },

        sbSave: function () {
            var name = $("#name").val();

            var lintang_sudut = $("#lintang_sudut").val();
            var lintang_menit = $("#lintang_menit").val();
            var lintang_arah = $("#lintang_arah").val();

            var bujur_sudut = $("#bujur_sudut").val();
            var bujur_menit = $("#bujur_menit").val();
            var bujur_arah = $("#bujur_arah").val();

            $ummu.vars.formData.append("name", name);

            $ummu.vars.formData.append("lintang_sudut", lintang_sudut);
            $ummu.vars.formData.append("lintang_menit", lintang_menit);
            $ummu.vars.formData.append("lintang_arah", lintang_arah);

            $ummu.vars.formData.append("bujur_sudut", bujur_sudut);
            $ummu.vars.formData.append("bujur_menit", bujur_menit);
            $ummu.vars.formData.append("bujur_arah", bujur_arah);

            var payload = {
                "name": name,

                "lintang_sudut": lintang_sudut,
                "lintang_menit": lintang_menit,
                "lintang_arah": lintang_arah,

                "bujur_sudut": bujur_sudut,
                "bujur_menit": bujur_menit,
                "bujur_arah": bujur_arah,
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
                        $("#lintang_arah, #bujur_arah").prop('disabled', true)
                    }
                }).fail(function() {
                    // An error occurred
                    console.log(ummu)
                });
            }
        },

        sbCancle: function () {
            $("#lintang_arah, #bujur_arah").prop('disabled', true)
            if ($ummu.url.getParam('id')) {
                // 
            }else{
                app.views.forClear()
            }
        },

        sbEdit: function () {
            $("#lintang_arah, #bujur_arah").prop('disabled', false)
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

        on_btn_getData_click: function () {
            $ummu.views.after_sbToolbar_getData();
            app.views.forClear()
        },

        on_showLeftModal: function(id) {
            console.log(id)
            if (id == 'country') {
                $ummu.controllers.show_country(id);
            }else if (id == 'province') {
                $ummu.controllers.show_province(id);
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
            $("#uom").html(row.uom_kode).attr('data-id', row.uom_id)

            $("#eta_loading_port").val(row.loading_availability_date_from + " - " + row.loading_availability_date_to)
            .attr('data-from', row.loading_availability_date_from)
            .attr('data-to', row.loading_availability_date_to)

            $("#si_number").val(row.si_number)
            $("#si_url").attr('href', row.si_fileUrl)
        },

        on_click_tbody_trtd_child_country: function(row) {
            // console.log(row)
            $("#country").val(row.name).attr('data-id', row.id);
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
            return $("#form_input .endis").not('#lintang_arah, #bujur_arah');
        },

        setRow_toForm: function(row) {
            // console.log(row)
            $("#name").val(row.name)

            $("#lintang_sudut").val(row.lintang_sudut)
            $("#lintang_menit").val(row.lintang_menit)
            $("#lintang_arah").val(row.lintang_arah)

            $("#bujur_sudut").val(row.bujur_sudut)
            $("#bujur_menit").val(row.bujur_menit)
            $("#bujur_arah").val(row.bujur_arah)

            $ummu.views.setIdentitiyToForm(row)
            $ummu.button.sbBtn_on_showData()
        },

        forClear: function() {
            $("#form_input input").not('#lintang_arah, #bujur_arah').val('');
            // $("#status, #uom").html('')

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
                    // { 
                    //     title: "Code",
                    //     data: "kode"
                    // },
                    { 
                        title: "Name",
                        data: "name"
                    },
                    { 
                        title: "Latitude",
                        data: "latitude_ddm"
                    },
                    { 
                        title: "Longitude",
                        data: "longitude_ddm"
                    },
                    { 
                        title: "Country",
                        data: "country_name"
                    },
                    { 
                        title: "Province",
                        data: "province_name"
                    },
                    { 
                        title: "Time Zone",
                        data: "time_zone"
                    },
                    {   title: "Draft Limit",
                        data: "kedalaman"
                    },
                    { 
                        title: "Type",
                        data: "type_name"
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