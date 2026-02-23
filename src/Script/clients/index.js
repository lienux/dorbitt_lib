var app = {
    register: function () {
        app.config.autoload()
    },

    config: {
        autoload: function () {
            $ummu.func.location_hash()
            $ummu.localStorage.dt_default('clients');
            $ummu.dt.layout.buttonAll($ummu.dt.init);
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
                app.dt.default.config_show()
            );

            $ummu.dt.layout.buttonAll($ummu.dt.init)

            $ummu.dt.init.on('xhr', function () {
                var response = $ummu.dt.init.ajax.json();
                if (response.status == true) {
                    localStorage.setItem('clients', JSON.stringify(response));
                }
            });
        },

        sbNew: function () {
            // $ummu.url.delAllParam();
            $ummu.url.delParamNotIn(['g']);
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

        sbSave: function () {
            // console.log('OK')
            var payload = JSON.stringify({
                "name": $("#form_input #name").val(),
                "phone": $("#form_input #phone").val(),
                "email": $("#form_input #email").val(),
                "address": $("#form_input #address").val(),
            });

            var params = {
                "function": "create",
                "method": "POST",
                "data": payload,
                "cache": true,
                "contentType": "application/json",
                "dataType": "json",
                "loader": true,
            };

            // var ummu = $ummu.ajax.ummu8(params);   
            // ummu.done(function(result) {
            //     console.log(result)
            //     // app.bt.table2_inserRow(result, row)
            //     // app.bt.table3_removeRow(row)
            // }).fail(function() {
            //     // An error occurred
            //     console.log(ummu)
            // });

            console.log(params)
        },

        sbCancleNew: function () {
            app.views.formParams().prop('disabled', true).val('');
        },

        sbCancle: function () {
            app.views.formParams().prop('disabled', true).val('');
        },

        sbEdit: function () {
            app.views.formParams().prop('disabled', false);
        },

        sbCancleEdit: function () {
            app.views.formParams().prop('disabled', true);
        },




        // show_enmod: function (params) {
        //     var account_id = $ummu.url.getParam('account_id');

        //     if (account_id) {
        //         var ali = $ummu.ajax.ummuBTshowFunc('show_enmod_by_accountID/'+account_id, params);
        //         ali.done(function (result) {
        //             var response = JSON.parse(result)
        //             params.success(response)
        //         })
        //         .fail(function () {
        //             // An error occurred
        //         });
        //     }else{
        //         params.success($ummu.vars.show_data_empty)
        //     }
        // },

        // show_dismod: function (params) {
        // if ($ummu.func.isNull($ummu.$.company) == true) {
        //     params.success($ummu.vars.show_data_empty)
        // }else{
        //     if ($ummu.url.getParam('account_id')) {
        //     var func = 'show_dismod_by_accountID?company_id='+$ummu.$.company.val();
        //     }else{
        //     var func = 'show_dismod_by_accountID?company_id='+$ummu.$.company.val()+'&account_id='+$ummu.url.getParam('account_id');
        //     }

        //     var ali = $ummu.ajax.ummuBTshowFunc(func, params);
        //     ali.done(function (result) {
        //     var response = JSON.parse(result)
        //     params.success(response)
        //     })
        //     .fail(function () {
        //     // An error occurred
        //     });
        //     // }
        // }
        // },

        // new: function () {
        // if ($ummu.vars.element_id == "tbAccount") {
        //     app.views.formParams().prop('disabled', true).val('');
        //     $table2.bootstrapTable('removeAll');

        //     $("#table-tab").removeClass("active")
        //     $("#form-tab").addClass("active")

        //     $("#myTabContent #form").addClass("show active")
        //     $("#myTabContent #table").removeClass("show active")
        // }else if ($ummu.vars.element_id == "tbPriv") {
        //     // app.controllers.show_dismod()
        //     if (!$ummu.url.getParam('account_id')) {
        //     $ummu.modal.ummu_msg('Silahkan pilih salah satu list pada tab list data, atau isi dan simpan form header, setelah itu baru tambahkan access modulnya.')
        //     }else{
        //     // if ($ummu.func.isNull($ummu.$.company) == true) {
        //     //   $ummu.modal.ummu_msg('Silahkan pilih Company terlebih dahulu.')
        //     // }else{
        //     //   // $ummu.bt.initTable($table3)
        //     //   $("#modal_dismod").modal("show")
        //     // }
        //     // $ummu.bt.initTable($table3)
        //     console.log('show dismod')
        //     $("#modal_dismod").modal("show")
        //     }
        // }else{
        //     // 
        // }
        // },

        // create_account_access: function (row) {
        // // var payload = JSON.stringify(
        // // {
        // //     "body": {
        // //         "gedung_id": $('#gedung').val(),
        // //         "kode": $('#kode').val(),
        // //         "name": $('#name').val(),
        // //         "lantai": $('#lantai').val(),
        // //         "seat": $('#jumlah_seat').val()
        // //     }
        // // });
        // // // controllers.create(payload);

        // var payload = JSON.stringify(
        // {
        //     "account_id": $ummu.vars.account.id,
        //     "module_id": row.module_id
        // });

        // var params = {
        //     "function": "create_enmod",
        //     "method": "POST",
        //     "data": payload,
        //     "cache": true,
        //     "contentType": "application/json",
        //     "dataType": "json",
        //     "loader": true,
        // };

        // var ummu = $ummu.ajax.ummu8(params);   
        // ummu.done(function(result) {
        //     // console.log(result)
        //     app.bt.table2_inserRow(result, row)
        //     app.bt.table3_removeRow(row)
        // }).fail(function() {
        //     // An error occurred
        //     console.log(ummu)
        // });
        // // console.log(ummu)
        // },

        // save_selected: function(table_id) {
        // var ids = $ummu.bt.select.getIds($('#'+table_id));

        // if ($ummu.vars.parentTableID == "tbDismodModule") {
        //     app.controllers.create_account_access2(table_id, ids)
        // }else{
        //     // 
        // }
        // },

        // create_account_access2: function (table_id, ids) {
        // let $table_id = $('#'+table_id);
        // var module_id = $ummu.bt.select.get_module_id($table_id);
        // var rows = $ummu.bt.select.getRows($table_id);
        // var payload = JSON.stringify(
        // {
        //     "account_id": $ummu.vars.account.id,
        //     "module_id": module_id
        // });

        // var params = {
        //     "function": "create_enmod",
        //     "method": "POST",
        //     "data": payload,
        //     "cache": true,
        //     "contentType": "application/json",
        //     "dataType": "json",
        //     "loader": true,
        // };

        // var ummu = $ummu.ajax.ummu8(params);   
        // ummu.done(function(result) {
        //     if ($ummu.bt.select.length($table_id) == 1) {
        //         app.bt.table2_inserRow(result.data, rows[0]);
        //     } else if ($ummu.bt.select.length($table_id) > 1) {
        //         $.each(rows, function(index, value) {
        //         $.each(result.data, function(index2, value2) {
        //             // console.log(index+'  === '+index2)
        //             if(index2 == index) {
        //             // console.log('sama '+index+'  = '+index2)
        //             app.bt.table2_inserRow(value2, value);
        //             }
        //         });
        //         });
        //     }

        //     $ummu.bt.remove($table_id);
        //     $ummu.$.modal_dismod.modal('hide');
        // }).fail(function() {
        //     // An error occurred
        //     console.log(ummu)
        // });
        // // console.log(ummu)
        // },

        // edit: function(row) {
        //     console.log(row)
        // },

        // delete: function(rows) {
        //     console.log(rows)
        // },

        // delete2: function($table_id, ids) {
        //     // console.log($table_id)
        //     // console.log(ids)

        //     var payload = JSON.stringify(
        //     {
        //         "account_id": $ummu.vars.account.id,
        //         "id": ids
        //     });

        //     var params = {
        //         "function": "delete_account_access",
        //         "method": "POST",
        //         "data": payload,
        //         "cache": true,
        //         "contentType": "application/json",
        //         "dataType": "json",
        //         "loader": true,
        //     };
        //     console.log(params)

        //     var ummu = $ummu.ajax.ummu8(params);
        //     // console.log(ummu)
        //     ummu.done(function(result) {
        //         console.log(result)
        //         $ummu.bt.remove($table_id);

        //         if ($ummu.vars.modal_id_show) {
        //             $ummu.vars.modal_id_show.modal('hide')
        //         }
        //     }).fail(function() {
        //         // An error occurred
        //         console.log(ummu)
        //     });
        // },
    },

    views: {
        formParams: function () {
            return $("#name, #address, #email, #phone");
        },

        button: function () {
            return $ummu.bt.button.crud(['new', 'edit', 'delete'])
        },

        table3_butoon: function () {
            return $ummu.bt.button.crud(['save_selected'])
        }
    },

    bt: {
        table2_inserRow: function (id, row) {
            $table2.bootstrapTable('insertRow', {
                index: 0,
                row: {
                    id: id,
                    module_id: row.module_id,
                    kode: row.kode,
                    name: row.name,
                    path: row.path
                }
            })

        },
        // table3_removeRow: function(row) {
        //   $table3.bootstrapTable('remove', {
        //     field: 'id',
        //     values: row.id
        //   })
        // }
    },

    dt: {
        init: null,

        default: {
            config_show: function () {
                return {
                    ajax: {
                        dataSrc: "rows",
                        url: $ummu.vars.page_url + "show",
                        data: function (d) {
                            // // d.myKey = "myValue";
                            // // d.custom = $('#myInput').val();
                            // // d.release = [0];
                            // // etc
                            // d.tgl = tgl.replace(/-/g, "");
                            // d.tgl2 = tgl2.replace(/-/g, "");
                            // d.site = site;
                        },
                    },
                    columns: app.dt.default.config_columns(),
                    processing: true,
                    // serverSide: true,
                    responsive: true,
                    keys: true,
                    deferLoading: 57,
                    lengthMenu: [10, 50, 100, { label: "All", value: -1 }],
                    layout: {
                        topStart: {
                            buttons: [],
                        }
                    },
                    columnDefs: app.dt.default.config_columnDefs(),
                    select: $ummu.dt.config.select(),
                    // order: [[26, "asc"],[27,"asc"]],
                    // rowGroup: app.dt.default.config_rowGroup(),
                    // fixedColumns: {
                    //     start: 2,
                    //     // end: 1
                    // },
                    paging: true,
                    // scrollCollapse: true,
                    // scrollX: true,
                    // scrollY: '60vh',
                    drawCallback: function (settings) {
                        // var api = this.api();
                    },
                };
            },
            config_columns: function () {
                let columns = [
                    { data: null },
                    { data: "id" },
                    { data: "name" },
                    { data: "phone_number" },
                    { data: "email" },
                    { data: "address" },

                    // // =======================================================
                    // // OB ====================================================
                    // // =======================================================
                    // { data: "day_rit_ob", 
                    //     class: "text-right",
                    //     render: function (data, type) {
                    //         return $ummu.helpers.currency.us(data)
                    //     },
                    // },
                    // { data: "night_rit_ob", 
                    //     class: "text-right",
                    //     render: function (data, type) {
                    //         return $ummu.helpers.currency.us(data)
                    //     },
                    // },
                    // { data: "total_rit_ob", 
                    //     class: "text-right",
                    //     render: function (data, type) {
                    //         return $ummu.helpers.currency.us(data)
                    //     },
                    // },
                    // { data: "day_ob", 
                    //     class: "text-right",
                    //     render: function (data, type) {
                    //         return $ummu.helpers.currency.us(data)
                    //     },
                    // },
                    // { data: "night_ob", 
                    //     class: "text-right",
                    //     render: function (data, type) {
                    //         return $ummu.helpers.currency.us(data)
                    //     },
                    // },
                    // { data: "total_ob", 
                    //     class: "text-right",
                    //     render: function (data, type) {
                    //         return $ummu.helpers.currency.us(data)
                    //     },
                    // },

                    // // =========================================================
                    // // Coal Getting ============================================
                    // // =========================================================
                    // { data: "day_rit_cg", 
                    //     class: "text-right",
                    //     render: function (data, type) {
                    //         return $ummu.helpers.currency.us(data)
                    //     },
                    // },
                    // { data: "night_rit_cg", 
                    //     class: "text-right",
                    //     render: function (data, type) {
                    //         return $ummu.helpers.currency.us(data)
                    //     },
                    // },
                    // { data: "total_rit_cg", 
                    //     class: "text-right",
                    //     render: function (data, type) {
                    //         return $ummu.helpers.currency.us(data)
                    //     },
                    // },
                    // { data: "day_cg", 
                    //     class: "text-right",
                    //     render: function (data, type) {
                    //         return $ummu.helpers.currency.us(data)
                    //     },
                    // },
                    // { data: "night_cg", 
                    //     class: "text-right",
                    //     render: function (data, type) {
                    //         return $ummu.helpers.currency.us(data)
                    //     },
                    // },
                    // { data: "total_cg", 
                    //     class: "text-right",
                    //     render: function (data, type) {
                    //         return $ummu.helpers.currency.us(data)
                    //     },
                    // },

                    // // =========================================================
                    // // Coal Hauling ============================================
                    // // =========================================================
                    // { data: "day_rit_cl", 
                    //     class: "text-right",
                    //     render: function (data, type) {
                    //         return $ummu.helpers.currency.us(data)
                    //     },
                    // },
                    // { data: "night_rit_cl", 
                    //     class: "text-right",
                    //     render: function (data, type) {
                    //         return $ummu.helpers.currency.us(data)
                    //     },
                    // },
                    // { data: "total_rit_cl", 
                    //     class: "text-right",
                    //     render: function (data, type) {
                    //         return $ummu.helpers.currency.us(data)
                    //     },
                    // },
                    // { data: "day_cl", 
                    //     class: "text-right",
                    //     render: function (data, type) {
                    //         return $ummu.helpers.currency.us(data)
                    //     },
                    // },
                    // { data: "night_cl", 
                    //     class: "text-right",
                    //     render: function (data, type) {
                    //         return $ummu.helpers.currency.us(data)
                    //     },
                    // },
                    // { data: "total_cl", 
                    //     class: "text-right",
                    //     render: function (data, type) {
                    //         return $ummu.helpers.currency.us(data)
                    //     },
                    // },

                    // // ====================================================
                    // // ====================================================
                    // // ====================================================
                    // { data: "fuel", 
                    //     class: "text-right",
                    //     render: function (data, type) {
                    //         return $ummu.helpers.currency.us(data)
                    //     },
                    // },
                    // { data: "bd", 
                    //     class: "text-right",
                    //     render: function (data, type) {
                    //         return $ummu.helpers.currency.us(data)
                    //     },
                    // },
                    // { data: "stb", 
                    //     class: "text-right",
                    //     render: function (data, type) {
                    //         return $ummu.helpers.currency.us(data)
                    //     },
                    // },
                    // { data: "bd", 
                    //     class: "text-right",
                    //     render: function (data, type) {
                    //         return $ummu.helpers.currency.us(data)
                    //     },
                    // },
                    // { data: "bd", 
                    //     class: "text-right",
                    //     render: function (data, type) {
                    //         return $ummu.helpers.currency.us(data)
                    //     },
                    // },
                    // { data: "bd", 
                    //     class: "text-right",
                    //     render: function (data, type) {
                    //         return $ummu.helpers.currency.us(data)
                    //     },
                    // },
                    // { data: "tipe" },
                    // { data: "unit_code" },
                ];

                return columns;
            },
            config_columnDefs: function () {
                let columnDefs = [
                    {
                        targets: 0,
                        orderable: false,
                        render: DataTable.render.select(),
                    },
                    // { 
                    //     targets: [26,27], 
                    //     visible: false 
                    // },
                ];
                return columnDefs;
            },
            config_rowGroup: function () {
                let rowGroup = {
                    dataSrc: ["tipe", "unit_code"],
                    startRender: function (rows, group) {
                        // Display the group name and the number of rows in that group
                        return group + " (" + rows.count() + " rows)";
                    },
                    endRender: function (rows, group, level) {
                        // =======================================================
                        // OB ====================================================
                        // =======================================================
                        var day_rit_ob_count = rows
                            .data()
                            .pluck('day_rit_ob')
                            .reduce(function (a, b) {
                                return parseFloat(a) + parseFloat(b);
                            }, 0);

                        var night_rit_ob_count = rows
                            .data()
                            .pluck('night_rit_ob')
                            .reduce(function (a, b) {
                                return parseFloat(a) + parseFloat(b);
                            }, 0);

                        var total_rit_ob_count = rows
                            .data()
                            .pluck('total_rit_ob')
                            .reduce(function (a, b) {
                                return parseFloat(a) + parseFloat(b);
                            }, 0);

                        var day_ob_count = rows
                            .data()
                            .pluck('day_ob')
                            .reduce(function (a, b) {
                                return parseFloat(a) + parseFloat(b);
                            }, 0);

                        var night_ob_count = rows
                            .data()
                            .pluck('night_ob')
                            .reduce(function (a, b) {
                                return parseFloat(a) + parseFloat(b);
                            }, 0);

                        var total_ob_count = rows
                            .data()
                            .pluck('total_ob')
                            .reduce(function (a, b) {
                                return parseFloat(a) + parseFloat(b);
                            }, 0);


                        // =========================================================
                        // Coal Getting ============================================
                        // =========================================================
                        var day_rit_cg_count = rows
                            .data()
                            .pluck('day_rit_cg')
                            .reduce(function (a, b) {
                                return parseFloat(a) + parseFloat(b);
                            }, 0);

                        var night_rit_cg_count = rows
                            .data()
                            .pluck('night_rit_cg')
                            .reduce(function (a, b) {
                                return parseFloat(a) + parseFloat(b);
                            }, 0);

                        var total_rit_cg_count = rows
                            .data()
                            .pluck('total_rit_cg')
                            .reduce(function (a, b) {
                                return parseFloat(a) + parseFloat(b);
                            }, 0);

                        var day_cg_count = rows
                            .data()
                            .pluck('day_cg')
                            .reduce(function (a, b) {
                                return parseFloat(a) + parseFloat(b);
                            }, 0);

                        var night_cg_count = rows
                            .data()
                            .pluck('night_cg')
                            .reduce(function (a, b) {
                                return parseFloat(a) + parseFloat(b);
                            }, 0);

                        var total_cg_count = rows
                            .data()
                            .pluck('total_cg')
                            .reduce(function (a, b) {
                                return parseFloat(a) + parseFloat(b);
                            }, 0);


                        // =========================================================
                        // Coal Hauling ============================================
                        // =========================================================
                        var day_rit_cl_count = rows
                            .data()
                            .pluck('day_rit_cl')
                            .reduce(function (a, b) {
                                return parseFloat(a) + parseFloat(b);
                            }, 0);

                        var night_rit_cl_count = rows
                            .data()
                            .pluck('night_rit_cl')
                            .reduce(function (a, b) {
                                return parseFloat(a) + parseFloat(b);
                            }, 0);

                        var total_rit_cl_count = rows
                            .data()
                            .pluck('total_rit_cl')
                            .reduce(function (a, b) {
                                return parseFloat(a) + parseFloat(b);
                            }, 0);

                        var day_cl_count = rows
                            .data()
                            .pluck('day_cl')
                            .reduce(function (a, b) {
                                return parseFloat(a) + parseFloat(b);
                            }, 0);

                        var night_cl_count = rows
                            .data()
                            .pluck('night_cl')
                            .reduce(function (a, b) {
                                return parseFloat(a) + parseFloat(b);
                            }, 0);

                        var total_cl_count = rows
                            .data()
                            .pluck('total_cl')
                            .reduce(function (a, b) {
                                return parseFloat(a) + parseFloat(b);
                            }, 0);

                        // ===========================================================================
                        var fuel_count = rows
                            .data()
                            .pluck('fuel')
                            .reduce(function (a, b) {
                                return parseFloat(a) + parseFloat(b);
                            }, 0);


                        if (level === 0) {
                            let tr = document.createElement('tr');
                            let classs = $ummu.dt.endRender_class();
                            $ummu.dt.addCell(tr, group, 2, classs);
                            $ummu.dt.addCell(tr, $ummu.helpers.currency.us(day_rit_ob_count), null, classs);
                            $ummu.dt.addCell(tr, $ummu.helpers.currency.us(night_rit_ob_count), null, classs);
                            $ummu.dt.addCell(tr, $ummu.helpers.currency.us(total_rit_ob_count), null, classs);
                            $ummu.dt.addCell(tr, $ummu.helpers.currency.us(day_ob_count), null, classs);
                            $ummu.dt.addCell(tr, $ummu.helpers.currency.us(night_ob_count), null, classs);
                            $ummu.dt.addCell(tr, $ummu.helpers.currency.us(total_ob_count), null, classs);

                            $ummu.dt.addCell(tr, $ummu.helpers.currency.us(day_rit_cg_count), null, classs);
                            $ummu.dt.addCell(tr, $ummu.helpers.currency.us(night_rit_cg_count), null, classs);
                            $ummu.dt.addCell(tr, $ummu.helpers.currency.us(total_rit_cg_count), null, classs);
                            $ummu.dt.addCell(tr, $ummu.helpers.currency.us(day_cg_count), null, classs);
                            $ummu.dt.addCell(tr, $ummu.helpers.currency.us(night_cg_count), null, classs);
                            $ummu.dt.addCell(tr, $ummu.helpers.currency.us(total_cg_count), null, classs);

                            $ummu.dt.addCell(tr, $ummu.helpers.currency.us(day_rit_cl_count), null, classs);
                            $ummu.dt.addCell(tr, $ummu.helpers.currency.us(night_rit_cl_count), null, classs);
                            $ummu.dt.addCell(tr, $ummu.helpers.currency.us(total_rit_cl_count), null, classs);
                            $ummu.dt.addCell(tr, $ummu.helpers.currency.us(day_cl_count), null, classs);
                            $ummu.dt.addCell(tr, $ummu.helpers.currency.us(night_cl_count), null, classs);
                            $ummu.dt.addCell(tr, $ummu.helpers.currency.us(total_cl_count), null, classs);

                            $ummu.dt.addCell(tr, $ummu.helpers.currency.us(fuel_count), null, classs);
                            $ummu.dt.addCell(tr, '', 5, classs);
                            return tr;
                        } else if (level === 1) {
                            let tr = document.createElement('tr');
                            let classs = 'text-right font-weight-bold bg-warning';
                            $ummu.dt.addCell(tr, '', 4);
                            $ummu.dt.addCell(tr, $ummu.helpers.currency.us(total_rit_ob_count), null, classs);
                            $ummu.dt.addCell(tr, '', 2);
                            $ummu.dt.addCell(tr, $ummu.helpers.currency.us(total_ob_count), null, classs);
                            $ummu.dt.addCell(tr, '', 2);
                            $ummu.dt.addCell(tr, $ummu.helpers.currency.us(total_rit_cg_count), null, classs);
                            $ummu.dt.addCell(tr, '', 2);
                            $ummu.dt.addCell(tr, $ummu.helpers.currency.us(total_cg_count), null, classs);
                            $ummu.dt.addCell(tr, '', 2);
                            $ummu.dt.addCell(tr, $ummu.helpers.currency.us(total_rit_cl_count), null, classs);
                            $ummu.dt.addCell(tr, '', 2);
                            $ummu.dt.addCell(tr, $ummu.helpers.currency.us(total_cl_count), null, classs);
                            $ummu.dt.addCell(tr, $ummu.helpers.currency.us(fuel_count), null, classs);
                            $ummu.dt.addCell(tr, '', 5);
                            return tr;
                        }
                    }
                };

                return rowGroup;
            },
        },
    },
};

$(document).ready(function () {
    app.config.autoload()
});