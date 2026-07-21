var app = {
    register: function () {
        app.config.autoload()
    },

    config: {
        autoload: function () {
            $ummu.func.location_hash();
            $ummu.button.sbToolbar()
            localStorage.setItem(`${$ummu.vars.module_kode}_isDtServerSide`, false);
            $ummu.config.dataTables()
            // if (localStorage.getItem('isDataLocalStorage') == false) {
            //     // Ini adalah config dataTable dalam mengambil data, serverSide menggunakan pagging dll ataukah tidak.
            //     $ummu.dt.config.serverSide = true;

            //     // Untuk menentukan apakah ketika setelah page loading, rows pada dataTable otomatis dimunculkan dengan cara Get Data?
            //     $ummu.dt.config.autoGetData = false;
            // }
            app.controllers.index();
            $ummu.formatter.number2($("#amount"), 10);
        },
    },

    vars: {
        initTable2: null,
        runing_id: null,
        init: null,
    },

    controllers: {
        index: function() {
            $ummu.dt.controllers.index();
            // $ummu.dt.config.install();

            // $ummu.dt.init = new DataTable($table,{
            //     ajax: {
            //         dataSrc: "rows",
            //         url: $ummu.vars.page_url + "show",
            //         type: "POST",
            //         data: function (d) {
            //             // // d.myKey = "myValue";
            //             // // d.custom = $('#myInput').val();
            //             // // d.release = [0];
            //             // // etc
            //             // d.tgl = tgl.replace(/-/g, "");
            //             // d.tgl2 = tgl2.replace(/-/g, "");
            //             // d.site = site;
            //         },
            //     },
            //     columns: app.dt.config.columns(),
            //     columnDefs: $ummu.dt.config.columnDefs(),
            //     select: $ummu.dt.config.select(),
            //     processing: true,
            //     serverSide: MyServerSide,
            //     // serverSide: true,
            //     responsive: true,
            //     keys: true,
            //     deferLoading: 57,
            //     lengthMenu: [10, 50, 100, { label: "All", value: -1 }],
            //     layout: {
            //         topStart: {
            //             buttons: [],
            //         }
            //     },
            //     paging: true,
            //     // order: [[26, "asc"],[27,"asc"]],
            //     // rowGroup: app.dt.clients.config_rowGroup(),
            //     // fixedColumns: {
            //     //     start: 2,
            //     //     // end: 1
            //     // },
            //     // scrollCollapse: true,
            //     // scrollX: true,
            //     // scrollY: '60vh',
            //     drawCallback: function (settings) {
            //         // var api = this.api();
            //     },
            // });

            // $ummu.dt.layout.buttonAll($ummu.dt.init)
        },

        // Digunakan untuk mengambil data dari database / API, dan terdapat pengaturannya setelah proses xhr selesai.
        show: function () {
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

        on_btn_getData_click: function () {
            $ummu.views.after_sbToolbar_getData();
            app.views.forClear()
        },

        on_showLeftModal: function(id) {
            // console.log(id)
            // $ummu.controllers.show_data_link(id)
            if (id == 'crew_ranks') {
                $ummu.controllers.show_crew_ranks(id);
            // }else if (id == 'tugboat') {
            //     $ummu.controllers.show_tugboat(id);
            // }else if (id == 'barge') {
            //     $ummu.controllers.show_barge(id);
            // }else if (id == 'uom') {
            //     $ummu.controllers.show_uom(id);
            // }else if (id == 'shipment') {
            //     $ummu.controllers.show_shippingInstruction(id);
            // }else if (id == 'spal') {
            //     $ummu.controllers.show_spal(id);
            // }else if (id == 'to_dept') {
            //     $ummu.controllers.show_dept(id);
            }
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
                    { 
                        data: null,
                        orderable: false,
                        render: DataTable.render.select()
                    },
                    { 
                        title: "ID",
                        data: "id",
                        className: 'align-middle',
                        render: function (data, type) {
                            return (
                                '<a href="javascript:void(0);">'+
                                    '<div><span>' + data + '</span> <i class="fas fa-external-link-alt ml-2"></i></div>'+
                                '</a>'
                            );
                        }
                    },
                    { 
                        title: "Nama Crew",
                        data: "name",
                        className: 'align-middle',
                    },
                    { 
                        title: "Jabatan (Rank)",
                        data: null,
                        className: 'align-middle',
                        render: function(data, type, row) {
                            var html = "";
                            if (row.crew_details != null) {
                                var html = `<div>${row.crew_details.rank_name_en}</div>
                                <div class="small text-muted">(${row.crew_details.rank_name_id})</div>`;
                            }

                            return html;
                        }
                    },
                    { 
                        title: "Ijazah (COC)",
                        data: null,
                        className: 'align-middle',
                        render: function(data, type, row) {
                            var html = "";
                            if (row.crew_details != null && row.crew_details.highest_coc_certificate) {
                                var html = `<span class="badge badge-light border border-secondary text-secondary">${row.crew_details.highest_coc_certificate}</span>`;
                            }

                            return html;
                        }
                    },
                    { 
                        title: "Buku Pelaut (Expiry)",
                        data: null,
                        className: 'align-middle',
                        render: function(data, type, row) {
                            var html = "";

                            if (row.crew_details != null && row.crew_details.seaman_book_number) {
                                var seaman_book_number = row.crew_details.seaman_book_number;
                                var seaman_book_expiry = $ummu.date.tglIndo(row.crew_details.seaman_book_expiry);
                                var seaman_book_expiry_status = row.crew_details.seaman_book_expiry_status;

                                var text = `<small class="text-success font-weight-bold">
                                        <i class="fas fa-calendar-check mr-1"></i> ${seaman_book_expiry}
                                    </small>`;
                                var textExp = `<small class="text-danger font-weight-bold animate-pulse">
                                        <i class="fas fa-exclamation-triangle mr-1"></i> ${seaman_book_expiry}
                                    </small>`;

                                var textExpSoon = `<small class="text-warning font-weight-bold">
                                        <i class="fas fa-calendar-check mr-1"></i> ${seaman_book_expiry}
                                    </small>`;

                                if (seaman_book_expiry_status == 'Active') {
                                    var html_ = text;
                                }else if (seaman_book_expiry_status == 'Expired') {
                                    var html_ = textExp;
                                }else{
                                    var html_ = textExpSoon;
                                }

                                var html = `
                                    <div class="mb-0 font-weight-bold">${seaman_book_number}</div>
                                    ${html_}
                                `;
                            }

                            return html;
                        }
                    },
                    { 
                        title: "Status Kerja",
                        data: null,
                        className: 'align-middle',
                        render: function(data, type, row) {
                            var html = "";

                            var on_board = `<span class="badge badge-success status-badge shadow-sm">
                                    <i class="fas fa-ship mr-1"></i> ON BOARD
                                </span>`;
                            var standby = `<span class="badge badge-info status-badge shadow-sm">
                                    <i class="fas fa-user-clock mr-1"></i> STANDBY
                                </span>`;
                            var off_sign = `<span class="badge badge-secondary status-badge shadow-sm">
                                <i class="fas fa-home mr-1"></i> OFF SIGN / CUTI
                            </span>`;
                            var medical_leave = `<span class="badge badge-danger status-badge shadow-sm">
                                <i class="fas fa-clinic-medical"></i> MEDICAL LEAVE
                            </span>`;
                            // 'STANDBY','ON_BOARD','OFF_SIGN','MEDICAL_LEAVE'

                            if (row.crew_details != null) {
                                var current_crew_status = row.crew_details.current_crew_status;

                                if (current_crew_status == 'STANDBY') {
                                    var html = standby;
                                }else if (current_crew_status == 'ON_BOARD') {
                                    var html = on_board;
                                }else if (current_crew_status == 'OFF_SIGN') {
                                    var html = off_sign;
                                }else{
                                    var html = medical_leave;
                                }
                            }

                            return html;
                        }
                    },
                ];
        
                return columns;
            },

            serverSide: function() {
                return false;
            }
        },
    },
};

$(document).ready(function () {
    app.config.autoload()
});