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
        tbAccount: {
            init: null,
        },
        tbPriv: {
            init: null,
        },
        tbDismodModule: {
            // 
        },
    },

    controllers: {
        on_btn_getData_click: function () {
            app.controllers.show()
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
                    localStorage.setItem('project_site', JSON.stringify(response));
                }
            });
        },

        new: function () {
            if ($ummu.vars.element_id == "tbAccount") {
                app.views.formParams().prop('disabled', true).val('');
                $table2.bootstrapTable('removeAll');

                $("#table-tab").removeClass("active")
                $("#form-tab").addClass("active")

                $("#myTabContent #form").addClass("show active")
                $("#myTabContent #table").removeClass("show active")
            } else if ($ummu.vars.element_id == "tbPriv") {
                // app.controllers.show_dismod()
                if (!$ummu.url.getParam('account_id')) {
                    $ummu.modal.ummu_msg('Silahkan pilih salah satu list pada tab list data, atau isi dan simpan form header, setelah itu baru tambahkan access modulnya.')
                } else {
                    // if ($ummu.func.isNull($ummu.$.company) == true) {
                    //   $ummu.modal.ummu_msg('Silahkan pilih Company terlebih dahulu.')
                    // }else{
                    //   // $ummu.bt.initTable($table3)
                    //   $("#modal_dismod").modal("show")
                    // }
                    // $ummu.bt.initTable($table3)
                    console.log('show dismod')
                    $("#modal_dismod").modal("show")
                }
            } else {
                // 
            }
        },

        sbNew: function () {
            $ummu.url.delAllParam();
            $ummu.vars.id = null
            $ummu.vars.account.id = null
            // app.vars.runing_id = null
            // console.log("OK")
            if (app.vars.initTable2 == null) {
                // $ummu.bt.initTable($table2)
                // app.vars.initTable2 = true;
            } else {
                // 
            }

            app.views.formParams().prop('disabled', false).val('');
            // $table2.bootstrapTable('removeAll');
        },

        sbCancleNew: function () {
            app.views.formParams().prop('disabled', true).val('');
        },

        sbEdit: function () {
            app.views.formParams().prop('disabled', false);
        },

        sbCancleEdit: function () {
            app.views.formParams().prop('disabled', true);
        },

        edit: function (row) {
            console.log(row)
        },

        delete: function (rows) {
            console.log(rows)
        },

        delete2: function ($table_id, ids) {
            // console.log($table_id)
            // console.log(ids)

            var payload = JSON.stringify(
                {
                    "account_id": $ummu.vars.account.id,
                    "id": ids
                });

            var params = {
                "function": "delete_account_access",
                "method": "POST",
                "data": payload,
                "cache": true,
                "contentType": "application/json",
                "dataType": "json",
                "loader": true,
            };
            console.log(params)

            var ummu = $ummu.ajax.ummu8(params);
            // console.log(ummu)
            ummu.done(function (result) {
                console.log(result)
                $ummu.bt.remove($table_id);

                if ($ummu.vars.modal_id_show) {
                    $ummu.vars.modal_id_show.modal('hide')
                }
            }).fail(function () {
                // An error occurred
                console.log(ummu)
            });
        },
    },

    views: {
        formParams: function () {
            return $(".endis");
        },

        button: function () {
            return $ummu.bt.button.crud(['new', 'edit', 'delete'])
        },

        table3_butoon: function () {
            return $ummu.bt.button.crud(['save_selected'])
        }
    },

    dt: {
        config: {
            columns: function () {
                let columns = [
                    { data: null, render: DataTable.render.select() },
                    { 
                        title: "ID",
                        data: "id"
                    },
                    { 
                        title: "Code",
                        data: "kode"
                    },
                    { 
                        title: "Name",
                        data: "name"
                    },
                    { 
                        title: "Latitude",
                        data: "latitude"
                    },
                    { 
                        title: "Longitude",
                        data: "longitude"
                    },
                    { 
                        title: "Area ID",
                        data: "project_area_id"
                    },
                    { 
                        title: "Address",
                        data: "address"
                    },
                    { 
                        title: "Description",
                        data: "description"
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