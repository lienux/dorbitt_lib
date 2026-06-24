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
            var id = $ummu.url.getParam('id');

            if (id) {
                var func = "update/" + id
            }else{
                var func = "create"
            }

            var payload = {
                "kode": $("#kode").val(),
                "name": $("#name").val(),
            };

            var params = {
                "function": func,
                "method": "POST",
                "data": JSON.stringify(payload),
                "cache": true,
                "contentType": "application/json",
                "dataType": "json",
                "loader": true,
            };

            const validation = app.validation.save();

            if (validation.length > 0) {
                $ummu.views.errors_msg(validation)
                // $(".btn-endis").removeClass('btn-outline-secondary').addClass('btn-primary')
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
        },

        sbCancle: function () {
            if ($ummu.url.getParam('id')) {
                //
            }else{
                // $("#nav-tab-machinery").prop("disabled", true).removeClass("active");
                // $("#nav-tab-tank").prop("disabled", true).removeClass("active");
                // $("#nav-tab-dimension").prop("disabled", true).removeClass("active");
                // $("#nav-tab-fuelconsum").prop("disabled", true).removeClass("active");
                // $("#nav-tab-speed").prop("disabled", true).removeClass("active");

                // $("#nav-machinery").removeClass("show active");
                // $("#nav-tank").removeClass("show active");
                // $("#nav-dimension").removeClass("show active");
                // $("#nav-fuelconsum").removeClass("show active");
                // $("#nav-speed").removeClass("show active");
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
            // $("#nav-tab-machinery").prop("disabled", true).removeClass("active");
            // $("#nav-tab-tank").prop("disabled", true).removeClass("active");
            // $("#nav-tab-dimension").prop("disabled", true).removeClass("active");
            // $("#nav-tab-fuelconsum").prop("disabled", true).removeClass("active");
            // $("#nav-tab-speed").prop("disabled", true).removeClass("active");

            // $("#nav-machinery").removeClass("show active");
            // $("#nav-tank").removeClass("show active");
            // $("#nav-dimension").removeClass("show active");
            // $("#nav-fuelconsum").removeClass("show active");
            // $("#nav-speed").removeClass("show active");
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
            return $("#form_input input, #form_input select");
        },

        setRow_toForm: function(row) {
            $("#kode").val(row.kode)
            $("#name").val(row.name)

            $ummu.views.setIdentitiyToForm(row)
            $ummu.button.sbBtn_on_showData()
        },

        forClear: function() {
            // $("#form_input input").not('#FreightCharter, #TimeCharter, #file_uploadz').val('');
            $("#form_input input").val('');
            // // $("#form_input #file_url span").html('')
            // $("#file_url").removeAttr('href')
            // $(".custom-file-label").html('Choose file...')
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
                        title: "NIK",
                        data: "nikaryawan"
                    },
                    { 
                        title: "Name",
                        data: "name"
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