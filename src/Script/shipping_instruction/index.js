var app = {
    register: function () {
        app.config.autoload()
    },

    config: {
        autoload: function () {
            $ummu.func.location_hash()
            $ummu.localStorage.dt_default($localStrgKey);
            $ummu.dt.layout.buttonAll($ummu.dt.init);

            $ummu.dt.init.on("click", "tbody tr td:nth-child(2)", function () {
                var row = $ummu.dt.init.row(this).data();
                // console.log(row)
                $ummu.url.setParamFromRow(row)
                // $ummu.vars.is_row = true;
                // app.controllers.detail(row);
                app.views.setRow_toForm(row);
            });

            // $ummu.formatter.number($("#form_input #nome"), 1);
            // $ummu.formatter.number($("#form_input #hp"), 4);
            // $ummu.formatter.number($("#form_input #lightship"), 4);
            // $ummu.formatter.number($("#form_input #capacity"), 5);
            // $ummu.formatter.number($("#form_input .speed"), 1, ' Knot');
            // $ummu.formatter.number($("#form_input .fuelcons"), 3);
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
            if ($ummu.dt.is_init(table) == true) {
                $ummu.dt.init_destroy();
            }

            $ummu.dt.init = new DataTable(
                table,
                app.dt.default.config_show()
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
            var file_upload = $("#file_upload")[0].files[0];
            var tgl = $("#iDate").val();
            var number = $("#number").val();
            var client_id = $("#client").attr('attr-id');
            var tugboat = $("#tugboat").attr('attr-id');
            var barge = $("#barge").attr('attr-id');
            var load_type = $("#load_type").val();
            var qty = $("#qty").val();
            var uom_id = $("#uom").attr('attr-id');
            var loading_availability_date_from = $("#iDateLoadingFrom").val();
            var loading_availability_date_to = $("#iDateLoadingTo").val();
            var loading_port = $("#loading_port").val();
            var discharge_port = $("#discharge_port").val();

            var formData = new FormData();
            formData.append("file_upload", file_upload);
            formData.append("tgl", tgl);
            formData.append("number", number);
            formData.append("shipper", client_id);
            formData.append("tugboat", tugboat);
            formData.append("barge", barge);
            formData.append("load_type", load_type);
            formData.append("qty", qty);
            formData.append("uom_id", uom_id);
            formData.append("loading_availability_date_from", loading_availability_date_from);
            formData.append("loading_availability_date_to", loading_availability_date_to);
            formData.append("loading_port", loading_port);
            formData.append("discharge_port", discharge_port);

            var payload = {
                "tgl": tgl,
                "number": number,
                "shipper": client_id,
                "tugboat": tugboat,
                "barge": barge,
                "load_type": load_type,
                "qty": qty,
                "uom_id": uom_id,
                "loading_availability_date_from": loading_availability_date_from,
                "loading_availability_date_to": loading_availability_date_to,
                "loading_port": loading_port,
                "discharge_port": discharge_port,
            };

            const id = $ummu.url.getParam('id');

            if (id) {
                var func = "update/" + id
            }else{
                var func = "create"
            }

            var params = {
                "function": func,
                "data": formData,
                "loader": true,
            };

            const validation = app.validation.save();

            if (validation.length > 0) {
                $ummu.views.errors_msg(validation)
                $(".btn-endis").removeClass('btn-outline-secondary').addClass('btn-primary')
            }else{
                console.log('tidak ada validation')
                var ummu = $ummu.ajax.ummu7(params);   
                ummu.done(function(result) {
                    const response = JSON.parse(result);
                    $ummu.views.after_sbToolbar_save(response, func, id, payload);

                    if (func == 'create') {
                        //
                    }else{
                        $("#form_input #file_url").attr("href", response.data.fileUrl)

                        if (response.data.fileNameOrigin) {
                            $("#form_input #file_url span").html(response.data.fileNameOrigin)
                        }else{
                            $("#form_input #file_url span").html("File not available.")
                        }
                    }
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
            // console.log(id)
            if (id == 'client') {
                $ummu.controllers.show_clients();
            }else if (id == 'tugboat') {
                $ummu.controllers.show_tugboat();
            }else if (id == 'barge') {
                $ummu.controllers.show_barge();
            }else if (id == 'uom') {
                $ummu.controllers.show_uom();
            }
        },
    },

    validation: {
        save: function() {
            var list = [];
            list = $ummu.validation.inputValidate();

            // var charterTypeId = $('input[name="charterTypeId"]:checked').val();

            // if ($ummu.func.isValue(charterTypeId) == false) {
            //     list.push('Charter Type required')
            // }

            // if (charterTypeId == "1") {
            //     if ($ummu.func.isValue($("#shipment").attr('data-id')) == false) {
            //         list.push($("#shipment").attr('data-label'))
            //     }
            // }

            return list;
        }
    },

    views: {
        formParams: function() {
            return $("#form_input .endis");
        },

        setRow_toForm: function(row) {
            console.log(row)
            $("#iDate").val(row.tgl)
            $("#number").val(row.number)
            $("#client").val(row.client_name).attr('data-id', row.shipper_client_id)
            $("#tugboat").val(row.tugboat_name).attr('data-id', row.tugboat_id)
            $("#barge").val(row.barge_name).attr('data-id', row.barge_id)
            $("#load_type").val(row.load_type)
            $("#qty").val(row.qty)
            $("#uom").val(row.uom_kode).attr('data-id', row.uom_id)

            $("#iDateLoadingFrom").val(row.loading_availability_date_from)
            $("#iDateLoadingTo").val(row.loading_availability_date_to)
            $("#loading_port").val(row.loading_port)
            $("#discharge_port").val(row.discharge_port)
            $(".custom-file-label").html(row.fileNameOrigin)
            $("#file_url").attr("href", row.fileUrl)

            if (row.fileNameOrigin) {
                // $("#file_url span").html(row.fileNameOrigin)
                $("#file_url").attr("href", row.fileUrl)
            }else{
                // $("#file_url span").html("File not available.")
                $(".custom-file-label").html('No file...')

            }

            $ummu.views.setIdentitiyToForm(row)

            $("#ummu_nav_tab #nav-tab-listData").removeClass("active")
            $("#ummu_tab_contnet #nav-listData").removeClass("show active")
            
            $("#ummu_nav_tab #nav-tab-form").addClass("active")
            $("#ummu_tab_contnet #nav-form").addClass("show active")

            $ummu.button.sbBtn_on_showData()
        },

        forClear: function() {
            $("#form_input input").val('');

            $("#file_url").removeAttr('href')
            $(".custom-file-label").html('Choose file...')

            $("#created_at").html('');
            $("#updated_at").html('');
            $("#created_by").html('');
            $("#updated_by").html('');
        },
    },

    dt: {
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
                    // rowGroup: app.dt.clients.config_rowGroup(),
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
                    { data: null, render: DataTable.render.select() },
                    { data: "id",
                        render: function (data, type) {
                            return (
                                '<a href="javascript:void(0);">'+
                                    '<div><span>' + data + '</span> <i class="fas fa-external-link-alt ml-2"></i></div>'+
                                '</a>'
                            );
                        }
                    },
                    { data: "tgl"},
                    { data: "number"},
                    { data: "client_name"},
                    { data: "tugboat_name"},
                    { data: "barge_name"},
                    { data: "load_type"},
                    { data: "qty"},
                    { data: "uom_name"},
                    { data: "loading_availability_date_from"},
                    { data: "loading_availability_date_to"},
                    { data: "loading_port"},
                    { data: "discharge_port"},
                    { data: "fileNameOrigin"},
                ];
        
                return columns;
            },  
            config_columnDefs: function() {
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
            config_rowGroup: function() {
                // let rowGroup = {
                //     dataSrc: ["tipe","unit_code"],
                //     startRender: function (rows, group) {
                //     // Display the group name and the number of rows in that group
                //     return group + " (" + rows.count() + " rows)";
                //     },
                //     endRender: function (rows, group, level) {
                //     // =======================================================
                //     // OB ====================================================
                //     // =======================================================
                //     var day_rit_ob_count = rows
                //     .data()
                //     .pluck('day_rit_ob')
                //     .reduce( function (a, b) {
                //         return parseFloat(a) + parseFloat(b);
                //     }, 0) ;
        
                //     var night_rit_ob_count = rows
                //     .data()
                //     .pluck('night_rit_ob')
                //     .reduce( function (a, b) {
                //         return parseFloat(a) + parseFloat(b);
                //     }, 0) ;
        
                //     var total_rit_ob_count = rows
                //     .data()
                //     .pluck('total_rit_ob')
                //     .reduce( function (a, b) {
                //         return parseFloat(a) + parseFloat(b);
                //     }, 0) ;

                //     var day_ob_count = rows
                //     .data()
                //     .pluck('day_ob')
                //     .reduce( function (a, b) {
                //         return parseFloat(a) + parseFloat(b);
                //     }, 0) ;
        
                //     var night_ob_count = rows
                //     .data()
                //     .pluck('night_ob')
                //     .reduce( function (a, b) {
                //         return parseFloat(a) + parseFloat(b);
                //     }, 0) ;

                //     var total_ob_count = rows
                //     .data()
                //     .pluck('total_ob')
                //     .reduce( function (a, b) {
                //         return parseFloat(a) + parseFloat(b);
                //     }, 0) ;
                    
                    
                //     // =========================================================
                //     // Coal Getting ============================================
                //     // =========================================================
                //     var day_rit_cg_count = rows
                //     .data()
                //     .pluck('day_rit_cg')
                //     .reduce( function (a, b) {
                //         return parseFloat(a) + parseFloat(b);
                //     }, 0) ;
        
                //     var night_rit_cg_count = rows
                //     .data()
                //     .pluck('night_rit_cg')
                //     .reduce( function (a, b) {
                //         return parseFloat(a) + parseFloat(b);
                //     }, 0) ;

                //     var total_rit_cg_count = rows
                //     .data()
                //     .pluck('total_rit_cg')
                //     .reduce( function (a, b) {
                //         return parseFloat(a) + parseFloat(b);
                //     }, 0) ;

                //     var day_cg_count = rows
                //     .data()
                //     .pluck('day_cg')
                //     .reduce( function (a, b) {
                //         return parseFloat(a) + parseFloat(b);
                //     }, 0) ;
        
                //     var night_cg_count = rows
                //     .data()
                //     .pluck('night_cg')
                //     .reduce( function (a, b) {
                //         return parseFloat(a) + parseFloat(b);
                //     }, 0) ;

                //     var total_cg_count = rows
                //     .data()
                //     .pluck('total_cg')
                //     .reduce( function (a, b) {
                //         return parseFloat(a) + parseFloat(b);
                //     }, 0) ;
                    

                //     // =========================================================
                //     // Coal Hauling ============================================
                //     // =========================================================
                //     var day_rit_cl_count = rows
                //     .data()
                //     .pluck('day_rit_cl')
                //     .reduce( function (a, b) {
                //         return parseFloat(a) + parseFloat(b);
                //     }, 0) ;
        
                //     var night_rit_cl_count = rows
                //     .data()
                //     .pluck('night_rit_cl')
                //     .reduce( function (a, b) {
                //         return parseFloat(a) + parseFloat(b);
                //     }, 0) ;

                //     var total_rit_cl_count = rows
                //     .data()
                //     .pluck('total_rit_cl')
                //     .reduce( function (a, b) {
                //         return parseFloat(a) + parseFloat(b);
                //     }, 0) ;

                //     var day_cl_count = rows
                //     .data()
                //     .pluck('day_cl')
                //     .reduce( function (a, b) {
                //         return parseFloat(a) + parseFloat(b);
                //     }, 0) ;
        
                //     var night_cl_count = rows
                //     .data()
                //     .pluck('night_cl')
                //     .reduce( function (a, b) {
                //         return parseFloat(a) + parseFloat(b);
                //     }, 0) ;

                //     var total_cl_count = rows
                //     .data()
                //     .pluck('total_cl')
                //     .reduce( function (a, b) {
                //         return parseFloat(a) + parseFloat(b);
                //     }, 0) ;
                    
                //     // ===========================================================================
                //     var fuel_count = rows
                //     .data()
                //     .pluck('fuel')
                //     .reduce( function (a, b) {
                //         return parseFloat(a) + parseFloat(b);
                //     }, 0) ;
        
                        
                //     if (level === 0) {
                //         let tr = document.createElement('tr');
                //         let classs = $ummu.dt.endRender_class();
                //         $ummu.dt.addCell(tr, group, 2, classs);
                //         $ummu.dt.addCell(tr, $ummu.helpers.currency.us(day_rit_ob_count),null,classs);
                //         $ummu.dt.addCell(tr, $ummu.helpers.currency.us(night_rit_ob_count),null,classs);
                //         $ummu.dt.addCell(tr, $ummu.helpers.currency.us(total_rit_ob_count),null,classs);
                //         $ummu.dt.addCell(tr, $ummu.helpers.currency.us(day_ob_count),null,classs);
                //         $ummu.dt.addCell(tr, $ummu.helpers.currency.us(night_ob_count),null,classs);
                //         $ummu.dt.addCell(tr, $ummu.helpers.currency.us(total_ob_count),null,classs);

                //         $ummu.dt.addCell(tr, $ummu.helpers.currency.us(day_rit_cg_count),null,classs);
                //         $ummu.dt.addCell(tr, $ummu.helpers.currency.us(night_rit_cg_count),null,classs);
                //         $ummu.dt.addCell(tr, $ummu.helpers.currency.us(total_rit_cg_count),null,classs);
                //         $ummu.dt.addCell(tr, $ummu.helpers.currency.us(day_cg_count),null,classs);
                //         $ummu.dt.addCell(tr, $ummu.helpers.currency.us(night_cg_count),null,classs);
                //         $ummu.dt.addCell(tr, $ummu.helpers.currency.us(total_cg_count),null,classs);

                //         $ummu.dt.addCell(tr, $ummu.helpers.currency.us(day_rit_cl_count),null,classs);
                //         $ummu.dt.addCell(tr, $ummu.helpers.currency.us(night_rit_cl_count),null,classs);
                //         $ummu.dt.addCell(tr, $ummu.helpers.currency.us(total_rit_cl_count),null,classs);
                //         $ummu.dt.addCell(tr, $ummu.helpers.currency.us(day_cl_count),null,classs);
                //         $ummu.dt.addCell(tr, $ummu.helpers.currency.us(night_cl_count),null,classs);
                //         $ummu.dt.addCell(tr, $ummu.helpers.currency.us(total_cl_count),null,classs);                

                //         $ummu.dt.addCell(tr, $ummu.helpers.currency.us(fuel_count),null,classs);
                //         $ummu.dt.addCell(tr, '', 5, classs);
                //         return tr;
                //     } else if (level === 1) {
                //         let tr = document.createElement('tr');
                //         let classs = 'text-right font-weight-bold bg-warning';
                //         $ummu.dt.addCell(tr, '', 4);
                //         $ummu.dt.addCell(tr, $ummu.helpers.currency.us(total_rit_ob_count),null,classs);
                //         $ummu.dt.addCell(tr, '', 2);
                //         $ummu.dt.addCell(tr, $ummu.helpers.currency.us(total_ob_count),null,classs);
                //         $ummu.dt.addCell(tr, '', 2);
                //         $ummu.dt.addCell(tr, $ummu.helpers.currency.us(total_rit_cg_count),null,classs);
                //         $ummu.dt.addCell(tr, '', 2);
                //         $ummu.dt.addCell(tr, $ummu.helpers.currency.us(total_cg_count),null,classs);
                //         $ummu.dt.addCell(tr, '', 2);
                //         $ummu.dt.addCell(tr, $ummu.helpers.currency.us(total_rit_cl_count),null,classs);
                //         $ummu.dt.addCell(tr, '', 2);
                //         $ummu.dt.addCell(tr, $ummu.helpers.currency.us(total_cl_count),null,classs);
                //         $ummu.dt.addCell(tr, $ummu.helpers.currency.us(fuel_count),null,classs);
                //         $ummu.dt.addCell(tr, '', 5);            
                //         return tr;
                //     }          
                //     }
                // };
        
                // return rowGroup;
            },
        },
    },
};

$(document).ready(function () {
    app.config.autoload()
});