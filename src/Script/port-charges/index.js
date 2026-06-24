var app = {
    register: function () {
        app.config.autoload()
    },

    config: {
        autoload: function () {
            $ummu.func.location_hash();
            $ummu.config.localStorage = true;
            $ummu.config.dataLink_localStorage = true;
            $ummu.dt.load2();
            $ummu.formatter.number2($("#tarif"), 10);
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

            $ummu.dt.init.on('xhr.dt', function (e, settings, json, xhr) {
                // Gunakan parameter 'json' langsung, bukan .ajax.json()
                if (json && json.status === true) {
                    localStorage.setItem($localStrgKey, JSON.stringify(json));
                } else {
                    console.warn("Status response false atau JSON tidak valid");
                }
            });
        },

        sbNew: function () {
            app.views.forClear()
            // $("#status").html('<span class="badge badge-secondary">Draft</span>')
            // $("#from_dept").val($ummu.vars.employee.department).attr('data-id', $ummu.vars.employee.department_id)
        },

        sbSave: function () {
            var ijo_id = $("#ijo").attr('data-id');
            var port_id = $("#ms_port").attr('data-id');
            var cost_id = $("#ms_cost").attr('data-id');
            var tarif = $("#tarif").val().replaceAll(',', '');

            $ummu.vars.formData.append("ijo_id", ijo_id);
            $ummu.vars.formData.append("port_id", port_id);
            $ummu.vars.formData.append("cost_id", cost_id);
            $ummu.vars.formData.append("tarif", tarif);

            var payload = {
                "ijo_id": ijo_id,
                "port_id": port_id,
                "cost_id": cost_id,
                "tarif": tarif,
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

                    // if (response.status == true) {
                    //     $("#file_url").attr("href", response.data.fileUrl)
                    //     let is_release = response.data.is_release;
                    //     if (is_release == null || is_release == '' || is_release == 0) {
                    //         $ummu.button.sbBtnToolbar.addRemove_btnRelease('add');
                    //     }else{
                    //         $ummu.button.sbBtnToolbar.addRemove_btnRelease('rm');
                    //     }
                    // }else{
                    //     $(".btn-endis").removeClass('btn-outline-secondary').addClass('btn-primary')
                    // }
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

        on_showLeftModal: function(id) {
            console.log(id)
            $ummu.controllers.show_data_link(id)
        },

        on_click_tbody_trtd_child: {
            ijo: function(row) {
                $("#ijo").val(row.number).attr('data-id', row.id)
            },
            ms_port: function(row) {
                $("#ms_port").val(row.name).attr('data-id', row.id)
            },
            ms_cost: function(row) {
                $("#ms_cost").val(row.name).attr('data-id', row.id)
            },
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
            $("#ijo").val(row.ijo_number).attr('data-id', row.ijo_id);
            $("#ms_port").val(row.port_name).attr('data-id', row.port_id);
            $("#ms_cost").val(row.cost_name).attr('data-id', row.cost_id);
            $("#tarif").val($ummu.formatter.us(row.tarif))

            $ummu.views.setIdentitiyToForm(row)
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
                        title: "IJO Number",
                        data: "ijo_number"
                    },
                    { 
                        title: "Cost Name",
                        data: "cost_name"
                    },
                    { 
                        title: "Port Name",
                        data: "port_name"
                    },
                    { 
                        title: "Rates",
                        data: "tarif",
                        render: function (data, type, row) {
                            return $ummu.formatter.us(data);
                        }
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