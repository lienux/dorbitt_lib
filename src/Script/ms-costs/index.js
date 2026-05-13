var app = {
    register: function () {
        app.config.autoload()
    },

    config: {
        autoload: function () {
            $ummu.func.location_hash();
            // localStorage.getItem('isDataLocalStorage') = false;
            // $ummu.localStorage.config.init_j = false;

            if (localStorage.getItem('isDataLocalStorage') == false) {
                // Ini adalah config dataTable dalam mengambil data, serverSide menggunakan pagging dll ataukah tidak.
                $ummu.dt.config.serverSide = true;

                // Untuk menentukan apakah ketika setelah page loading, rows pada dataTable otomatis dimunculkan dengan cara Get Data?
                $ummu.dt.config.autoGetData = false;
            }

            // $ummu.dt.load2();
            $ummu.dt.controllers.index();
            $ummu.formatter.number2($("#amount"), 10);
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

        // Digunakan untuk mengambil data dari database / API, dan terdapat pengaturannya setelah proses xhr selesai.
        show: function (params) {
            if ($ummu.dt.is_init($table) == true) {
                $ummu.dt.init_destroy();
            }

            $ummu.dt.init = new DataTable(
                $table,
                $ummu.dt.controllers.show()
            );

            $ummu.dt.layout.buttonAll($ummu.dt.init)

            $ummu.dt.init.on('xhr.dt', function (e, settings, json, xhr) {
                // Gunakan parameter 'json' langsung, bukan .ajax.json()
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
            $('#fixed_cost, #variable_cost').prop('disabled', false);
            // $("#status").html('<span class="badge badge-secondary">Draft</span>')
            // $("#from_dept").val($ummu.vars.employee.department).attr('data-id', $ummu.vars.employee.department_id)
        },

        sbSave: function () {
            var behavior = $("input:radio[name=behavior]:checked").val();
            var category = $("#category").val();
            var name = $("#name").val();
            var amount = null;
            if ($("#amount").val()) {
                amount = $("#amount").val().replaceAll(',', '');
            }

            $ummu.vars.formData.append("behavior", behavior);
            $ummu.vars.formData.append("category", category);
            $ummu.vars.formData.append("name", name);
            $ummu.vars.formData.append("amount", amount);

            var payload = {
                "behavior": behavior,
                "category": category,
                "name": name,
                "amount": amount,
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
                    // //     $("#file_url").attr("href", response.data.fileUrl)
                    // //     let is_release = response.data.is_release;
                    // //     if (is_release == null || is_release == '' || is_release == 0) {
                    // //         $ummu.button.sbBtnToolbar.addRemove_btnRelease('add');
                    // //     }else{
                    // //         $ummu.button.sbBtnToolbar.addRemove_btnRelease('rm');
                    // //     }
                    // }else{
                    // //     $(".btn-endis").removeClass('btn-outline-secondary').addClass('btn-primary')
                    // }
                }).fail(function() {
                    // An error occurred
                    console.log(ummu)
                });
            }

            // console.log(payload)
        },

        sbCancle: function () {
            $('#fixed_cost, #variable_cost').prop('disabled', false);

            if ($ummu.url.getParam('id')) {
                $('input[name="behavior"]').prop('disabled', true);
            }else{
                app.views.forClear()
            }
        },

        sbEdit: function () {
            // 
            $('#fixed_cost, #variable_cost').prop('disabled', false);
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
                $('#fixed_cost, #variable_cost').prop('disabled', true);
            }).fail(function() {
                // An error occurred
                console.log(ummu)
            });
        },

        sbClear: function() {
            app.views.forClear()
            // $('#fixed_cost, #variable_cost').prop('disabled', true);
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
            var behavior = $("#behavior").val();
            var category = $("#category").val();

            list = $ummu.validation.inputValidate3();

            if (category == null) {
                list.category = "Category field is required."
            }

            return list;
        }
    },

    views: {
        formParams: function() {
            return $("#form_input .endis").not('#fixed_cost, #variable_cost');
        },

        setRow_toForm: function(row) {
            // console.log(row)
            $('input[name="behavior"][value="'+row.behavior+'"]').prop('checked', true);
            $("#category").val(row.category);
            $("#name").val(row.name);
            $("#amount").val($ummu.formatter.us(row.amount))

            $ummu.views.setIdentitiyToForm(row)
            $ummu.button.sbBtn_on_showData()
        },

        forClear: function() {
            $("#form_input input").not('#fixed_cost, #variable_cost').val('');
            $('input[name="behavior"]').prop('checked', false);
            $('input[name="behavior"]').prop('disabled', true);

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
                        title: "Cost Behavior",
                        data: "behavior",
                        render: function(data, type, row) {
                            var text = "";
                            if (data == '1') {
                                text = "Fixed Cost";
                            }else if (data == '2') {
                                text = "Variable Cost";
                            }

                            return text;
                        }
                    },
                    { 
                        title: "Const Category",
                        data: "category",
                        render: function(data, type, row) {
                            var text = "";
                            if (data == 'port_charges') {
                                text = "Port Charges";
                            }else if (data == 'fixed_cost') {
                                text = "Fixed Cost";
                            }else if (data == 'variable_cost') {
                                text = 'Variable Cost';
                            }else if ('perjalanan_dinas') {
                                text = 'Perjalanan Dinas';
                            }

                            return text;
                        }
                    },
                    { 
                        title: "Cost Name",
                        data: "name"
                    },
                    { 
                        title: "Amount",
                        data: "amount",
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