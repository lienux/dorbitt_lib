var app = {
    register: function () {
        app.config.autoload()
    },

    config: {
        autoload: function () {
            $ummu.func.location_hash()
            if (localStorage.getItem('isDataLocalStorage') == false) {
                // Ini adalah config dataTable dalam mengambil data, serverSide menggunakan pagging dll ataukah tidak.
                $ummu.dt.config.serverSide = true;

                // Untuk menentukan apakah ketika setelah page loading, rows pada dataTable otomatis dimunculkan dengan cara Get Data?
                $ummu.dt.config.autoGetData = false;
            }
            app.controllers.index();
        },
    },

    vars: {
        initTable2: null,
        runing_id: null,
    },

    controllers: {
        index: function() {
            $ummu.dt.controllers.index();
        },

        show: function (params) {
            // if ($ummu.dt.is_init($table) == true) {
            //     $ummu.dt.init_destroy();
            // }

           $ummu.dt.controllers.reload()

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
                "phone_number": $("#form_input #phone").val(),
                "email": $("#form_input #email").val(),
                "address": $("#form_input #address").val(),
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

            var ummu = $ummu.ajax.ummu8(params);   
            ummu.done(function(result) {
                $ummu.views.after_sbToolbar_save(result, func, id, payload);
            }).fail(function() {
                // An error occurred
                console.log(ummu)
            });
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
                console.log(result)
                $ummu.views.after_sbToolbar_delete(id, result);
            }).fail(function() {
                // An error occurred
                console.log(ummu)
            });
        },

        on_btn_getData_click: function () {
            $ummu.views.after_sbToolbar_getData();
        },
    },

    views: {
        formParams: function () {
            return $("#name, #address, #email, #phone");
        },

        setRow_toForm: function(row) {
            $("#name").val(row.name)
            $("#phone").val(row.phone_number)
            $("#email").val(row.email)
            $("#address").val(row.address)

            $ummu.views.setIdentitiyToForm(row)
            $ummu.button.sbBtn_on_showData()
        },
    },

    dt: {
        init: null,

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
                        title: "Name",
                        data: "name"
                    },
                    { 
                        title: "Phone Number",
                        data: "phone_number"
                    },
                    { 
                        title: "Email",
                        data: "email"
                    },
                    { 
                        title: "Address",
                        data: "address"
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