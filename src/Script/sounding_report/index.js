var app = {
    register: function () {
        app.config.autoload()
    },

    config: {
        autoload: function () {
            $ummu.func.location_hash()
            $ummu.helpers.renderComplexHeader($table, app.dt.config.columns());
            $ummu.dt.load2();

            $ummu.dt.init2_kosong(table2);
            $ummu.dt.layout.buttonDefaultAndCustom($ummu.dt.init2, ['btn_insert']);
        },
    },

    controllers: {
        on_btn_getData_click: function() {
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
                    localStorage.setItem('passage_plan', JSON.stringify(response));
                }
            });
        },

        show_enmod: function (params) {
            var account_id = $ummu.url.getParam('account_id');

            if (account_id) {
                var ali = $ummu.ajax.ummuBTshowFunc('show_enmod_by_accountID/'+account_id, params);
                ali.done(function (result) {
                    var response = JSON.parse(result)
                    params.success(response)
                })
                .fail(function () {
                    // An error occurred
                });
            }else{
                params.success($ummu.vars.show_data_empty)
            }
        },

        show_dismod: function (params) {
        if ($ummu.func.isNull($ummu.$.company) == true) {
            params.success($ummu.vars.show_data_empty)
        }else{
            if ($ummu.url.getParam('account_id')) {
            var func = 'show_dismod_by_accountID?company_id='+$ummu.$.company.val();
            }else{
            var func = 'show_dismod_by_accountID?company_id='+$ummu.$.company.val()+'&account_id='+$ummu.url.getParam('account_id');
            }

            var ali = $ummu.ajax.ummuBTshowFunc(func, params);
            ali.done(function (result) {
            var response = JSON.parse(result)
            params.success(response)
            })
            .fail(function () {
            // An error occurred
            });
            // }
        }
        },

        new: function () {
        if ($ummu.vars.element_id == "tbAccount") {
            app.views.formParams().prop('disabled', true).val('');
            $table2.bootstrapTable('removeAll');

            $("#table-tab").removeClass("active")
            $("#form-tab").addClass("active")

            $("#myTabContent #form").addClass("show active")
            $("#myTabContent #table").removeClass("show active")
        }else if ($ummu.vars.element_id == "tbPriv") {
            // app.controllers.show_dismod()
            if (!$ummu.url.getParam('account_id')) {
            $ummu.modal.ummu_msg('Silahkan pilih salah satu list pada tab list data, atau isi dan simpan form header, setelah itu baru tambahkan access modulnya.')
            }else{
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
        }else{
            // 
        }
        },

        sbNew: function () {
            $ummu.url.delAllParam();
            $ummu.vars.id = null
            $ummu.vars.account.id = null
            app.views.formParams().prop('disabled', false).val('');
        },

        create_account_access: function (row) {
        // var payload = JSON.stringify(
        // {
        //     "body": {
        //         "gedung_id": $('#gedung').val(),
        //         "kode": $('#kode').val(),
        //         "name": $('#name').val(),
        //         "lantai": $('#lantai').val(),
        //         "seat": $('#jumlah_seat').val()
        //     }
        // });
        // // controllers.create(payload);

        var payload = JSON.stringify(
        {
            "account_id": $ummu.vars.account.id,
            "module_id": row.module_id
        });

        var params = {
            "function": "create_enmod",
            "method": "POST",
            "data": payload,
            "cache": true,
            "contentType": "application/json",
            "dataType": "json",
            "loader": true,
        };

        var ummu = $ummu.ajax.ummu8(params);   
        ummu.done(function(result) {
            // console.log(result)
            app.bt.table2_inserRow(result, row)
            app.bt.table3_removeRow(row)
        }).fail(function() {
            // An error occurred
            console.log(ummu)
        });
        // console.log(ummu)
        },

        save_selected: function(table_id) {
        var ids = $ummu.bt.select.getIds($('#'+table_id));

        if ($ummu.vars.parentTableID == "tbDismodModule") {
            app.controllers.create_account_access2(table_id, ids)
        }else{
            // 
        }
        },

        create_account_access2: function (table_id, ids) {
        let $table_id = $('#'+table_id);
        var module_id = $ummu.bt.select.get_module_id($table_id);
        var rows = $ummu.bt.select.getRows($table_id);
        var payload = JSON.stringify(
        {
            "account_id": $ummu.vars.account.id,
            "module_id": module_id
        });

        var params = {
            "function": "create_enmod",
            "method": "POST",
            "data": payload,
            "cache": true,
            "contentType": "application/json",
            "dataType": "json",
            "loader": true,
        };

        var ummu = $ummu.ajax.ummu8(params);   
        ummu.done(function(result) {
            if ($ummu.bt.select.length($table_id) == 1) {
                app.bt.table2_inserRow(result.data, rows[0]);
            } else if ($ummu.bt.select.length($table_id) > 1) {
                $.each(rows, function(index, value) {
                $.each(result.data, function(index2, value2) {
                    // console.log(index+'  === '+index2)
                    if(index2 == index) {
                    // console.log('sama '+index+'  = '+index2)
                    app.bt.table2_inserRow(value2, value);
                    }
                });
                });
            }

            $ummu.bt.remove($table_id);
            $ummu.$.modal_dismod.modal('hide');
        }).fail(function() {
            // An error occurred
            console.log(ummu)
        });
        // console.log(ummu)
        },

        sbCancleNew: function() {
            app.views.formParams().prop('disabled', true).val('');
        },
        
        sbEdit: function () {
            app.views.formParams().prop('disabled', false);
        },

        sbCancleEdit: function() {
            app.views.formParams().prop('disabled', true);
        },

        edit: function(row) {
            console.log(row)
        },

        delete: function(rows) {
            console.log(rows)
        },

        delete2: function($table_id, ids) {
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
            ummu.done(function(result) {
                console.log(result)
                $ummu.bt.remove($table_id);

                if ($ummu.vars.modal_id_show) {
                    $ummu.vars.modal_id_show.modal('hide')
                }
            }).fail(function() {
                // An error occurred
                console.log(ummu)
            });
        },
    },

    views: {
        formParams: function() {
            return $(".endis");
        },

        button: function() {
            return $ummu.bt.button.crud(['new','edit','delete'])
        },

        table3_butoon: function() {
            return $ummu.bt.button.crud(['save_selected'])
        }
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
                        title: "Type",
                        rowspan: true,
                        data: "type"
                    },

                    // Group Tugboat
                    { 
                        title: "Name",
                        group: "Tugboat",
                        data: "tugboat_name"
                    },
                    { 
                        title: "HP Engine",
                        group: "Tugboat",
                        data: "hp_engine"
                    },

                    { 
                        title: "Barge",
                        rowspan: true,
                        data: "barge_name"
                    },
                    { 
                        title: "Cargo",
                        rowspan: true,
                        data: "tugboat_name"
                    },
                    { 
                        title: "Trip Number",
                        rowspan: true,
                        data: "trip_number"
                    },

                    // Departure Group
                    { 
                        title: "Location",
                        group: "Departure",
                        data: "departure_location"
                    },
                    { 
                        title: "Date Time",
                        group: "Departure",
                        data: "departure_datetime"
                    },

                    // Arrival
                    { 
                        title: "Location",
                        group: "Arrival",
                        data: "arrival_location"
                    },
                    { 
                        title: "Date Time",
                        group: "Arrival",
                        data: "arrival_datetime"
                    },

                    // Stop Engine
                    { 
                        title: "Location",
                        group: "Stop Engine",
                        data: "stopengine_location"
                    },
                    { 
                        title: "Date Time",
                        group: "Stop Engine",
                        data: "stopengine_datetime"
                    },
                    // ===

                    { 
                        title: "Aditional Report",
                        rowspan: true,
                        data: null
                    },
                    { 
                        title: "Foto",
                        rowspan: true,
                        data: null
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
