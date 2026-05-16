var app = {
    register: function () {
        app.config.autoload()
    },

    config: {
        autoload: function () {
            $ummu.func.location_hash()
            // $ummu.dt.load2();
            if (localStorage.getItem('isDataLocalStorage') == false) {
                // Ini adalah config dataTable dalam mengambil data, serverSide menggunakan pagging dll ataukah tidak.
                $ummu.dt.config.serverSide = true;

                // Untuk menentukan apakah ketika setelah page loading, rows pada dataTable otomatis dimunculkan dengan cara Get Data?
                $ummu.dt.config.autoGetData = false;
            }

            // $ummu.dt.load2();
            $ummu.dt.controllers.index();
        },
    },

    vars: {
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
            // 
        },

        sbSave: function () {
            var payload = {
                "name": $("#form_input #name").val(),
                "description": $("#form_input #description").val(),
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

            if (app.validation.save == false) {
                console.log('ada validation')
            }else{
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
            // 
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
        }
    },

    validation: {
        save: function() {
            if ($("#form_input #name").val() == '') {

            }
        }
    },

    views: {
        formParams: function () {
            return $("#form_input input, #form_input textarea");
        },

        setRow_toForm: function(row) {
            $("#type").val(row.type)
            $("#kode").val(row.kode)
            $("#name").val(row.name)
            $("#description").val(row.description)

            $ummu.views.setIdentitiyToForm(row)
            $ummu.button.sbBtn_on_showData()
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
                    // { 
                    //     title: "Category",
                    //     data: "category_id"
                    // },
                    // { 
                    //     title: "Model",
                    //     data: "model"
                    // },
                    // { 
                    //     title: "Serial Number",
                    //     data: "serial_number"
                    // },
                    // { 
                    //     title: "Manufacturer",
                    //     data: "manufacturer"
                    // },
                    // { 
                    //     title: "Maintenance Schedule",
                    //     data: "maintenance_schedule"
                    // },
                    // { 
                    //     title: "Criticality Level",
                    //     data: "criticality_level"
                    // },
                    // { 
                    //     title: "Location Name",
                    //     data: "location_name"
                    // },
                    { 
                        title: "Description",
                        data: "description"
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