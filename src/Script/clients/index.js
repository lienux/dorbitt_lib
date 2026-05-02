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
        }
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
                    { data: null },
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