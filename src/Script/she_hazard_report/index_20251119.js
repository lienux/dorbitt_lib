var globalVar = {
    qUrl: $base_url + 'admin/she_hazard_report/',
    approval_authorization_level: null,
    errors_params: [],
    aggreement: localStorage.getItem('aggreement')
}

var app = {
    register: {
        // app.config.dt_config();
        // app.config.dt_supplier();
        // app.config.dt_affilitaion();
        // app.config.dt_projectArea();
    },
    config: {
        dt_config: function() {
            return {
                ajax: {
                    dataSrc: 'rows',
                    url: globalVar.qUrl + 'show',
                    data: function (d) {
                        d.myKey = 'myValue';
                        // d.custom = $('#myInput').val();
                        // etc
                    }
                },
                processing: true,
                serverSide: true,
                responsive: true,
                keys: true,
                // language: { "processing": "Hang on. Waiting for data.." },
                deferLoading: 57,
                lengthMenu: [10, 50, 100, { label: 'All', value: -1 }],
                layout: {
                    topStart: {
                        buttons: [
                            { extend: 'pageLength', className: 'py-1' },
                            /*{ extend: 'selectAll', className: 'py-1' },
                            { extend: 'selectNone', className: 'py-1' },
                            {
                                text: '<i class="fas fa-file-excel text-success"></i> Import',
                                attr: { id: 'btn_import'},
                                className: 'btn-showall-color hidden collapse py-1',
                                action: function (e, dt, node, config) {
                                    // if(localStorage.getItem("level_id") == "1") {
                                        $('#periode').val('');
                                        $('#modal_import2').modal('show');
                                    // }
                                    // var rows = $ummu.dt.select.data();
                                    // console.log(rows)
                                    // multi_approve(rows);
                                }
                            },
                            {
                                text: '<i class="fas fa-trash-alt text-danger"></i> Delete all selected',
                                attr: { id: 'btn_delete'},
                                className: 'btn-showall-color hidden collapse py-1',
                                action: function (e, dt, node, config) {
                                    // // if(localStorage.getItem("level_id") == "1") {
                                    //     $('#periode').val('');
                                    //     $('#modal_filter_employee_salary').modal('show');
                                    // // }
                                    // // var rows = $ummu.dt.select.data();
                                    // // console.log(rows)
                                    // // multi_approve(rows);
                                    var rows = $ummu.dt.select.data();
                                    // console.log(rows)
                                    multi_delete(rows);
                                }
                            }*/
                            // {
                            //     text: '<i class="fas fa-filter text-danger"></i> Filter',
                            //     attr: { id: 'btn_filter'},
                            //     className: 'btn-showall-color hidden collapse py-1',
                            //     action: function (e, dt, node, config) {
                            //         // if(localStorage.getItem("level_id") == "1") {
                            //             $('#periode').val('');
                            //             $('#modal_filter_employee_salary').modal('show');
                            //         // }
                            //         // var rows = $ummu.dt.select.data();
                            //         // console.log(rows)
                            //         // multi_approve(rows);
                            //     }
                            // },
                        ]
                    }
                },
                columnDefs: [
                    {
                        targets: 0,
                        orderable: false,
                        render: DataTable.render.select()
                    },
                    // {
                    //     target: 3,
                    //     visible: false
                    // }
                ],
                // fixedColumns: {
                //     start: 3
                // },
                order: [[0, 'desc']],
                // rowGroup: {
                //     dataSrc: 'region_name'
                // },
                scrollCollapse: true,
                scrollX: true,
                // scrollY: 300,
                select: {
                    style: 'multi+shift',
                    selector: 'td:first-child',
                    headerCheckbox: 'select-page'
                },
                columns: [
                    {
                        data: null,
                        render: DataTable.render.select()
                    },
                    { 
                        data: 'date_discovery' 
                    },
                    {
                        data: 'date_discovery'
                    },
                    { 
                        data: 'lokasi_temuan_name'
                    },
                    { 
                        data: 'detail_lokasi_temuan'
                    },
                    { 
                        data: 'jenis_temuan_kode' 
                    },
                    { 
                        data: 'danger_discovered' 
                    },
                    { 
                        data: 'cause_hazard'
                    },
                    { 
                        data: 'kode_bahaya'
                    },
                    { 
                        data: 'status_name'
                    }
                ],
                // fnDrawCallback: function (data){
                //     console.log(data)
                //     // var orderVec = settings.oSavedState.order
                //     // setCookie("releaseTicketSort", orderVec, exp=1000)
                //     // getCookie("releaseTicketSort")
                // },
                drawCallback: function (settings) {
                    var api = this.api();
             
                    // Output the data for the visible rows to the browser's console
                    // var data_jumlah = api.rows({ page: 'current' }).data()[0];
                    var data_jumlah = api.row().data();
                    // var a = Array.isArray(data_jumlah);
                    // var a = data_jumlah;
                    // console.log(a.data_jumlah);
                    // Cookies.set('data_jumlah', data_jumlah);
                    // set_jumlah(data_jumlah)
                    // for(key in data_jumlah) {
                    //     if(data_jumlah.hasOwnProperty(key)) {
                    //         var value = data_jumlah[key];
                    //         //do something with value;
                    //         console.log(value)
                    //     }
                    // }

                    // for(k in data_jumlah) {
                    //     console.log(k)
                    // }

                    // console.log(a)
                }
            };
        },
        // dt_supplier: function() {
        //     return {
        //         data: JSON.parse(localStorage.getItem('ms_supplier')).rows,
        //         fixedHeader: true,
        //         processing: true,
        //         responsive: true,
        //         keys: true,
        //         deferLoading: 57,
        //         lengthMenu: [10, 50, 100, { label: 'All', value: -1 }],
        //         layout: {
        //             topStart: {
        //                 buttons: [
        //                     { 
        //                         extend: 'pageLength', 
        //                         className: 'py-1' 
        //                     },
        //                     {
        //                         text: '<i class="fa-solid fa-floppy-disk"></i>',
        //                         attr: { id: 'btn_save_select'},
        //                         className: 'btn-showall-color hidden collapse py-1',
        //                         action: function (e, dt, node, config) {
        //                             var rows = $ummu.dt.select.data();
        //                             var row = $ummu.dt.select.getRow(table_supplier);
        //                             // var row = table_supplier.row({selected: true}).data();
        //                             console.log(row)
        //                             $('#supplier_kode').val(row.supplier_code);
        //                             $('#supplier').val(row.supplier_name);
        //                             $('#currency_kode').val(row.cur_code);
        //                             $('#supplier_modal').modal('hide');
        //                             // if(localStorage.getItem("level_id") == "1") {
        //                                 // $('#periode').val('');
        //                                 // $('#modal_import2').modal('show');
        //                             // }
        //                             // var rows = $ummu.dt.select.data();
        //                             // console.log(rows)
        //                             // multi_approve(rows);
        //                         }
        //                         // $('#example tbody').on( 'click', 'tr',  (event) =>  {
        //                         //     console.log( table.row( event.currentTarget ).data() );
        //                         // } );
        //                     }
        //                 ]
        //             }
        //         },
        //         columnDefs: [
        //             {
        //                 targets: 0,
        //                 orderable: false
        //             },
        //         ],
        //         order: [[0, 'desc']],
        //         scrollCollapse: true,
        //         scrollX: true,
        //         select: {
        //             style: 'single',
        //             headerCheckbox: false
        //         },
        //         columns: [
        //             {
        //                 data: null,
        //                 render: DataTable.render.select()
        //             },
        //             { 
        //                 data: 'supplier_code' 
        //             },
        //             {
        //                 data: 'supplier_name'
        //             },
        //             { 
        //                 data: 'cur_code'
        //             },
        //             { 
        //                 data: 'contact1'
        //             },
        //             { 
        //                 data: 'contact2' 
        //             },
        //             { 
        //                 data: 'group_name' 
        //             },
        //             { 
        //                 data: 'merk'
        //             }
        //         ]
        //     };
        // },
        // dt_affilitaion: function() {
        //     return {
        //         data: JSON.parse(localStorage.getItem('ms_affiliation')).rows,
        //         fixedHeader: true,
        //         processing: true,
        //         responsive: true,
        //         keys: true,
        //         deferLoading: 57,
        //         lengthMenu: [10, 50, 100, { label: 'All', value: -1 }],
        //         layout: {
        //             topStart: {
        //                 buttons: [
        //                     { 
        //                         extend: 'pageLength', 
        //                         className: 'py-1' 
        //                     },
        //                     {
        //                         text: '<i class="fa-solid fa-floppy-disk"></i>',
        //                         attr: { id: 'btn_save_select'},
        //                         className: 'btn-showall-color hidden collapse py-1',
        //                         action: function (e, dt, node, config) {
        //                             var rows = $ummu.dt.select.data();
        //                             var row = $ummu.dt.select.getRow(table_affiliation);
        //                             // var row = table_supplier.row({selected: true}).data();
        //                             console.log(row)
        //                             $('#supplier_kode').val(row.emp_code);
        //                             $('#supplier').val(row.emp_name);
        //                             $('#currency_kode').val(row.cur_code);
        //                             $('#supplier_modal').modal('hide');

        //                             // if(localStorage.getItem("level_id") == "1") {
        //                                 // $('#periode').val('');
        //                                 // $('#modal_import2').modal('show');
        //                             // }
        //                             // var rows = $ummu.dt.select.data();
        //                             // console.log(rows)
        //                             // multi_approve(rows);
        //                         }
        //                         // $('#example tbody').on( 'click', 'tr',  (event) =>  {
        //                         //     console.log( table.row( event.currentTarget ).data() );
        //                         // } );
        //                     }
        //                 ]
        //             }
        //         },
        //         columnDefs: [
        //             {
        //                 targets: 0,
        //                 orderable: false
        //             },
        //         ],
        //         order: [[0, 'desc']],
        //         scrollCollapse: true,
        //         scrollX: true,
        //         select: {
        //             style: 'single',
        //             headerCheckbox: false
        //         },
        //         columns: [
        //             {
        //                 data: null,
        //                 render: DataTable.render.select()
        //             },
        //             { 
        //                 data: 'emp_name' 
        //             },
        //             {
        //                 data: 'tipe'
        //             },
        //             { 
        //                 data: 'Jabatan'
        //             },
        //             { 
        //                 data: 'cur_code'
        //             },
        //             { 
        //                 data: 'emp_code' 
        //             }
        //         ]
        //     };
        // },
        // dt_projectArea: function() {
        //     return {
        //         data: JSON.parse(localStorage.getItem('usp_0202_SHB_0004')).rows,
        //         fixedHeader: true,
        //         processing: true,
        //         responsive: true,
        //         keys: true,
        //         deferLoading: 57,
        //         lengthMenu: [10, 50, 100, { label: 'All', value: -1 }],
        //         layout: {
        //             topStart: {
        //                 buttons: [
        //                     { 
        //                         extend: 'pageLength', 
        //                         className: 'py-1' 
        //                     },
        //                     {
        //                         text: '<i class="fa-solid fa-floppy-disk"></i>',
        //                         attr: { id: 'btn_save_select'},
        //                         className: 'btn-showall-color hidden collapse py-1',
        //                         action: function (e, dt, node, config) {
        //                             var row = $ummu.dt.select.getRow(table_projectArea);
        //                             // console.log(row)
        //                             $('#project_area_kode').val(row.region_code);
        //                             $('#project_area_name').val(row.region_name);
        //                             $('#project_area_modal').modal('hide');
        //                         }
        //                     }
        //                 ]
        //             }
        //         },
        //         columnDefs: [
        //             {
        //                 targets: 0,
        //                 orderable: false
        //             },
        //         ],
        //         order: [[0, 'desc']],
        //         scrollCollapse: true,
        //         scrollX: true,
        //         select: {
        //             style: 'single',
        //             headerCheckbox: false
        //         },
        //         columns: [
        //             {
        //                 data: null,
        //                 render: DataTable.render.select()
        //             },
        //             { 
        //                 data: 'region_code' 
        //             },
        //             {
        //                 data: 'region_name'
        //             }
        //         ]
        //     };
        // }
    },
    controllers: {
        get_supplier: function() {
            var params = {
                "type": "get",
                "action": "get",
                "data": {
                    "limit":0,
                    "offset":0,
                    "sort": "id",
                    "order": "desc",
                    "search": ""
                },
                "cache": true,
                "contentType": "application/json",
                "dataType": "json"
            };
            var url = globalVar.qUrl+'show_supplier';
            var ali = $globalAjax.ummay(url,params);
            ali.done(function(result) {
                var response = JSON.parse(result);
                // console.log(response)
                localStorage.setItem("ms_supplier", result);
                // var params = {
                //     "element_id": 'periode',
                //     "rows": response,
                //     "with_kode": 0
                // }
                // $ummu.views.select_option_append(params);

                // var params2 = {
                //     "element_id": 'periode2',
                //     "rows": response,
                //     "with_kode": 0
                // }
                // $ummu.views.select_option_append(params2);
            }).fail(function() {
                // An error occurred
            });
        },
        get_affiliation: function() {
            var params = {
                "type": "get",
                "action": "get",
                "data": {
                    "limit":0,
                    "offset":0,
                    "sort": "id",
                    "order": "desc",
                    "search": ""
                },
                "cache": true,
                "contentType": "application/json",
                "dataType": "json"
            };
            var url = globalVar.qUrl+'show_affiliation';
            var ali = $globalAjax.ummay(url,params);
            ali.done(function(result) {
                var response = JSON.parse(result);
                // console.log(response)
                localStorage.setItem("ms_affiliation", result);
                // var params = {
                //     "element_id": 'periode',
                //     "rows": response,
                //     "with_kode": 0
                // }
                // $ummu.views.select_option_append(params);

                // var params2 = {
                //     "element_id": 'periode2',
                //     "rows": response,
                //     "with_kode": 0
                // }
                // $ummu.views.select_option_append(params2);
            }).fail(function() {
                // An error occurred
            });
        },
        usp_0202_SHB_0004: function() {
            var params = {
                "type": "get",
                "action": "get",
                "data": {
                    "limit":0,
                    "offset":0,
                    "sort": "id",
                    "order": "desc",
                    "search": ""
                },
                "cache": true,
                "contentType": "application/json",
                "dataType": "json"
            };
            var url = globalVar.qUrl+'usp_0202_SHB_0004';
            var ali = $globalAjax.ummay(url,params);
            ali.done(function(result) {
                var response = JSON.parse(result);
                console.log(response)
                localStorage.setItem("usp_0202_SHB_0004", result);
            }).fail(function() {
                // An error occurred
            });
        },
        usp_0101_SHB_0009: function() {
            var params = {
                "type": "get",
                "action": "get",
                "data": {
                    "limit":0,
                    "offset":0,
                    "sort": "id",
                    "order": "desc",
                    "search": ""
                },
                "cache": true,
                "contentType": "application/json",
                "dataType": "json"
            };
            var url = globalVar.qUrl+'usp_0101_SHB_0009_kas';
            var ali = $globalAjax.ummay(url,params);
            ali.done(function(result) {
                var response = JSON.parse(result);
                console.log(response)
                localStorage.setItem("usp_0101_SHB_0009", result);
            }).fail(function() {
                // An error occurred
            });
        }
    },
    views: {
        set_to_cash: function() {
            $('#cash').empty();
            var rows = JSON.parse(localStorage.getItem('usp_0101_SHB_0009')).rows;
            for(let index in rows){
                var text = rows[index].KoKas + ' - ' + rows[index].NamKas;
                $('#cash').append("<option value='" + rows[index].KoKas + "'>" + text + "</option>");
            }
        }
    }
}

var table = new DataTable('#dt_hazard_report', app.config.dt_config());
table.columns.adjust();
// var table_supplier = new DataTable('#dt_supplier', app.config.dt_supplier());
// var table_affiliation = new DataTable('#dt_affiliation', app.config.dt_affilitaion());
// var table_projectArea = new DataTable('#dt_projectArea', app.config.dt_projectArea());

/*table.on('click', 'tbody tr td:nth-child(4)', function () {
    var row = table.row(this).data();
    console.log(row);

    $('#nika').html(row.nika);
    $('#name').html(row.name);
    $('#site').html(row.site);
    $('#jabatan').html(row.jabatan);
    $('#periode_name').html(row.periode_name);
    $('#gapok').html($ummu.helpers.currency.us(row.gapok_baru));
    $('#rapel_gaji').html($ummu.helpers.currency.us(row.rapel_gaji));
    $('#lain_lain').html($ummu.helpers.currency.us(row.lain_lain));
    $('#tj_acting').html($ummu.helpers.currency.us(row.tj_acting));
    $('#tj_kesetaraan').html($ummu.helpers.currency.us(row.tj_kesetaraan));
    $('#insentif_produksi').html($ummu.helpers.currency.us(row.insentif_produksi));
    $('#insentif_kehadiran').html($ummu.helpers.currency.us(row.insentif_kehadiran));
    $('#total_tunjangan').html($ummu.helpers.currency.us(row.total_tunjangan));
    $('#gaji_bruto').html($ummu.helpers.currency.us(row.gaji_bruto));
    $('#potongan_kasbon').html($ummu.helpers.currency.us(row.potongan_kasbon));
    $('#potongan_tiket').html($ummu.helpers.currency.us(row.potongan_tiket));
    $('#potongan_jamsostek_jht').html($ummu.helpers.currency.us(row.potongan_jamsostek_jht));
    $('#potongan_jamsostek_jp').html($ummu.helpers.currency.us(row.potongan_jamsostek_jp));
    $('#total_potongan').html($ummu.helpers.currency.us(row.total_potongan));
    $('#gaji_netto').html($ummu.helpers.currency.us(row.gaji_netto));

    $('#PayslipModal').modal('show');
});*/
/*table.on( 'select', function ( e, dt, type, indexes ) {
    $ummu.views.button.delete_selected(4)
});*/
/*table.on( 'deselect', function ( e, dt, type, indexes ) {
    $ummu.views.button.delete_selected(4)
});*/

$(document).ready(function () {
    $ummu.func.location_hash();
    $ummu.views.button.shb_btn_std(false,false,false,false,false,false,true);



    // $('#supplier_modal #btn_max').on('click', function() {
    //     $ummu.views.modal.fullscreen('#supplier_modal #modal_dialog');
    // })

    // $('#btn_show_supplier').on('click', function() {
    //     $('#supplier_modal').modal('show');
    // })

    // $('#btn_show_projectArea').on('click', function() {
    //     $('#project_area_modal').modal('show');
    // })

    // if (!localStorage.getItem('ms_supplier')) {
    //     app.controllers.get_supplier();
    // }

    // if (!localStorage.getItem('ms_affiliation')) {
    //     app.controllers.get_affiliation();
    // }

    // if (!localStorage.getItem('usp_0202_SHB_0004')) {
    //     app.controllers.usp_0202_SHB_0004();
    // }

    // if (!localStorage.getItem('usp_0101_SHB_0009')) {
    //     app.controllers.usp_0101_SHB_0009();
    // }

    // $('#rad_supplier').on('click', function(){
    //     $('#div_supplier').removeClass('collapse');
    //     $('#div_affiliation').addClass('collapse');
    // })

    // $('#rad_affiliation').on('click', function(){
    //     $('#div_affiliation').removeClass('collapse');
    //     $('#div_supplier').addClass('collapse');
    // })

    $('#dbtn_new').on('click', function(){
        $('#date').val(datenow);
        $ummu.views.button.std_shb.onNew();
        
        $('#nav-home-tab').removeClass('disabled').addClass('active');
        $('#nav-home').addClass('active show');
        
        $('#nav-agreement-tab, #nav-list-tab').removeClass('active');
        $('#nav-agreement-tab, #nav-list-tab').addClass('disabled');
        $('#nav-agreement, #nav-list').removeClass('active show');
    })

    $('#dbtn_can').on('click', function(){
        $ummu.views.button.std_shb.onCan();
        $('#nav-agreement-tab, #nav-list-tab').removeClass('disabled');
    })

    $('#btn_show_date').on('click', function(){
        $('#date').datepicker({
            // uiLibrary: 'bootstrap4'
            "dateFormat": "yy-mm-dd"
        }).datepicker('show');
    })

    // $('#btn_cash_date').on('click', function(){
    //     $('#cash_date').datepicker({
    //         // uiLibrary: 'bootstrap4'
    //         "dateFormat": "yy-mm-dd"
    //     }).datepicker('show');
    // })


    if(globalVar.aggreement === '1') {
        $('#persetujuan').attr("checked", true);
        $('#lanjutkan, #dbtn_new').attr('disabled', false);
        $('#nav-home-tab, #nav-list-tab').removeClass('disabled');
    }else{
        $('#dbtn_new, #lanjutkan').attr('disabled', true);
        $('#nav-home-tab, #nav-list-tab').removeClass('active').addClass('disabled');
        $('#nav-agreement-tab').addClass('active');
    }

    $('#persetujuan').change(function() {
        if(this.checked) {
            $('#lanjutkan').attr('disabled', false);
            localStorage.setItem('aggreement', 1);
        }else{
            $('#dbtn_new, #lanjutkan').attr('disabled', true);
            $('#nav-home-tab, #nav-list-tab').removeClass('active').addClass('disabled');
            $('#nav-agreement-tab').addClass('active');
            localStorage.setItem('aggreement', 0);
        }
    });

    $('#lanjutkan').on('click', function(){
        $('#dbtn_new').attr('disabled', false);

        $('#nav-agreement-tab').removeClass('active');
        $('#nav-home-tab, #nav-list-tab').removeClass('disabled');
        $('#nav-home-tab').addClass('active');
        // $('#nav-list-tab').removeClass('disabled');

        $('#nav-agreement').removeClass('active show');
        $('#nav-home').addClass('active show');
    })

    $('.clockpicker').clockpicker({
        placement: 'top',
        align: 'left',
        donetext: 'Done'
    });

    // $($.fn.dataTable.tables(true)).DataTable().columns.adjust();
});




































/*function config() {
    return {
        ajax: {
            dataSrc: 'rows',
            url: globalVar.qUrl + 'show',
            data: function (d) {
                d.myKey = 'myValue';
                // d.custom = $('#myInput').val();
                // etc
            }
        },
        processing: true,
        serverSide: true,
        responsive: true,
        keys: true,
        // language: { "processing": "Hang on. Waiting for data.." },
        deferLoading: 57,
        lengthMenu: [10, 50, 100, { label: 'All', value: -1 }],
        layout: {
            topStart: {
                buttons: [
                    { extend: 'pageLength', className: 'py-1' },
                    { extend: 'selectAll', className: 'py-1' },
                    { extend: 'selectNone', className: 'py-1' },
                    {
                        text: '<i class="fas fa-file-excel text-success"></i> Import',
                        attr: { id: 'btn_import'},
                        className: 'btn-showall-color hidden collapse py-1',
                        action: function (e, dt, node, config) {
                            // if(localStorage.getItem("level_id") == "1") {
                                $('#periode').val('');
                                $('#modal_import2').modal('show');
                            // }
                            // var rows = $ummu.dt.select.data();
                            // console.log(rows)
                            // multi_approve(rows);
                        }
                    },
                    {
                        text: '<i class="fas fa-trash-alt text-danger"></i> Delete all selected',
                        attr: { id: 'btn_delete'},
                        className: 'btn-showall-color hidden collapse py-1',
                        action: function (e, dt, node, config) {
                            // // if(localStorage.getItem("level_id") == "1") {
                            //     $('#periode').val('');
                            //     $('#modal_filter_employee_salary').modal('show');
                            // // }
                            // // var rows = $ummu.dt.select.data();
                            // // console.log(rows)
                            // // multi_approve(rows);
                            var rows = $ummu.dt.select.data();
                            // console.log(rows)
                            multi_delete(rows);
                        }
                    }
                    // {
                    //     text: '<i class="fas fa-filter text-danger"></i> Filter',
                    //     attr: { id: 'btn_filter'},
                    //     className: 'btn-showall-color hidden collapse py-1',
                    //     action: function (e, dt, node, config) {
                    //         // if(localStorage.getItem("level_id") == "1") {
                    //             $('#periode').val('');
                    //             $('#modal_filter_employee_salary').modal('show');
                    //         // }
                    //         // var rows = $ummu.dt.select.data();
                    //         // console.log(rows)
                    //         // multi_approve(rows);
                    //     }
                    // },
                ]
            }
        },
        columnDefs: [
            {
                targets: 0,
                orderable: false,
                render: DataTable.render.select()
            },
            // {
            //     target: 3,
            //     visible: false
            // }
        ],
        // fixedColumns: {
        //     start: 3
        // },
        order: [[0, 'desc']],
        // rowGroup: {
        //     dataSrc: 'region_name'
        // },
        scrollCollapse: true,
        scrollX: true,
        // scrollY: 300,
        select: {
            style: 'multi+shift',
            selector: 'td:first-child',
            headerCheckbox: 'select-page'
        },
        columns: [
            {
                data: null,
                render: DataTable.render.select()
            },
            { 
                data: 'id' 
            },
            {
                data: 'payslip_periode',
                className: 'text-right',
            },
            { 
                data: 'nika',
                render: function (data, type) {
                    return '<a href="javascript:void(0);">' + data + ' <i class="fas fa-external-link-alt ml-2"></i></a>';
                }
            },
            { 
                data: 'name'
            },
            { 
                data: 'jabatan' 
            },
            { 
                data: 'dept' 
            },
            { 
                data: 'tgl_join',
                className: 'text-right',
            },
            { 
                data: 'gol',
                className: 'text-center',
            },
            { 
                data: 'gapok_baru',
                className: 'text-right',
                render: function (data, type) {
                    return $ummu.helpers.currency.us(data);
                }
            },
            { 
                data: 'tj_acting',
                className: 'text-right',
                render: function (data, type) {
                    return $ummu.helpers.currency.us(data);
                }
            },
            { 
                data: 'rapel_gaji',
                className: 'text-right',
                render: function (data, type) {
                    return $ummu.helpers.currency.us(data);
                }
            },
            { 
                data: 'lain_lain',
                className: 'text-right',
                render: function (data, type) {
                    return $ummu.helpers.currency.us(data);
                }
            },
            { 
                data: 'uang_hadir',
                className: 'text-right',
                render: function (data, type) {
                    return $ummu.helpers.currency.us(data);
                }
            },
            { 
                data: 'tj_kesetaraan',
                className: 'text-right',
                render: function (data, type) {
                    return $ummu.helpers.currency.us(data);
                }
            },
            { 
                data: 'insentif_produksi',
                className: 'text-right',
                render: function (data, type) {
                    return $ummu.helpers.currency.us(data);
                }
            },
            { 
                data: 'insentif_kehadiran',
                className: 'text-right',
                render: function (data, type) {
                    return $ummu.helpers.currency.us(data);
                }
            },
            { 
                data: 'total_tunjangan',
                className: 'text-right',
                render: function (data, type) {
                    return $ummu.helpers.currency.us(data);
                },
                createdCell: function (td) {
                    $(td).css('background-color', "yellow")
                }
            },
            { 
                data: 'gaji_bruto',
                className: 'text-right',
                render: function (data, type) {
                    return $ummu.helpers.currency.us(data);
                },
                createdCell: function (td) {
                    $(td).css('background-color', "yellow")
                }
            },
            { 
                data: 'potongan_kasbon',
                className: 'text-right',
                render: function (data, type) {
                    return $ummu.helpers.currency.us(data);
                }
            },
            { 
                data: 'potongan_tiket',
                className: 'text-right',
                render: function (data, type) {
                    return $ummu.helpers.currency.us(data);
                }
            },
            { 
                data: 'potongan_jamsostek_jht',
                className: 'text-right',
                render: function (data, type) {
                    return $ummu.helpers.currency.us(data);
                }
            },
            { 
                data: 'potongan_jamsostek_jp',
                className: 'text-right',
                render: function (data, type) {
                    return $ummu.helpers.currency.us(data);
                }
            },
            { 
                data: 'total_potongan',
                className: 'text-right',
                render: function (data, type) {
                    return $ummu.helpers.currency.us(data);
                },
                createdCell: function (td) {
                    $(td).css('background-color', "yellow")
                }
            },
            { 
                data: 'gaji_netto',
                className: 'text-right',
                render: function (data, type) {
                    return $ummu.helpers.currency.us(data);
                },
                createdCell: function (td) {
                    $(td).css('background-color', "yellow")
                }
            },
            { 
                data: 'no_rek',
                render: function (data, type) {
                    return $ummu.helpers.rekeningFormatter(data);
                }
            },
            { data: 'nama_rekening' },
            { data: 'bank' },
            { data: 'site' },
            { data: 'email' },
            { data: 'whatsapp' }
        ],
        // fnDrawCallback: function (data){
        //     console.log(data)
        //     // var orderVec = settings.oSavedState.order
        //     // setCookie("releaseTicketSort", orderVec, exp=1000)
        //     // getCookie("releaseTicketSort")
        // },
        drawCallback: function (settings) {
            var api = this.api();
     
            // Output the data for the visible rows to the browser's console
            // var data_jumlah = api.rows({ page: 'current' }).data()[0];
            var data_jumlah = api.row().data();
            // var a = Array.isArray(data_jumlah);
            // var a = data_jumlah;
            // console.log(a.data_jumlah);
            // Cookies.set('data_jumlah', data_jumlah);
            // set_jumlah(data_jumlah)
            // for(key in data_jumlah) {
            //     if(data_jumlah.hasOwnProperty(key)) {
            //         var value = data_jumlah[key];
            //         //do something with value;
            //         console.log(value)
            //     }
            // }

            // for(k in data_jumlah) {
            //     console.log(k)
            // }

            // console.log(a)
        }
    };
}

function config_dt_supplier() {
    return {
        data: JSON.parse(localStorage.getItem('ms_supplier')).rows,
        fixedHeader: true,
        processing: true,
        responsive: true,
        keys: true,
        deferLoading: 57,
        lengthMenu: [10, 50, 100, { label: 'All', value: -1 }],
        layout: {
            topStart: {
                buttons: [
                    { 
                        extend: 'pageLength', 
                        className: 'py-1' 
                    },
                    {
                        text: '<i class="fa-solid fa-floppy-disk"></i>',
                        attr: { id: 'btn_save_select'},
                        className: 'btn-showall-color hidden collapse py-1',
                        action: function (e, dt, node, config) {
                            var rows = $ummu.dt.select.data();
                            var row = $ummu.dt.select.getRow(table_supplier);
                            // var row = table_supplier.row({selected: true}).data();
                            console.log(row)
                            $('#supplier_kode').val(row.supplier_code);
                            $('#supplier').val(row.supplier_name);
                            $('#currency_kode').val(row.cur_code);
                            $('#supplier_modal').modal('hide');
                            // if(localStorage.getItem("level_id") == "1") {
                                // $('#periode').val('');
                                // $('#modal_import2').modal('show');
                            // }
                            // var rows = $ummu.dt.select.data();
                            // console.log(rows)
                            // multi_approve(rows);
                        }
                        // $('#example tbody').on( 'click', 'tr',  (event) =>  {
                        //     console.log( table.row( event.currentTarget ).data() );
                        // } );
                    }
                ]
            }
        },
        columnDefs: [
            {
                targets: 0,
                orderable: false
            },
        ],
        order: [[0, 'desc']],
        scrollCollapse: true,
        scrollX: true,
        select: {
            style: 'single',
            headerCheckbox: false
        },
        columns: [
            {
                data: null,
                render: DataTable.render.select()
            },
            { 
                data: 'supplier_code' 
            },
            {
                data: 'supplier_name'
            },
            { 
                data: 'cur_code'
            },
            { 
                data: 'contact1'
            },
            { 
                data: 'contact2' 
            },
            { 
                data: 'group_name' 
            },
            { 
                data: 'merk'
            }
        ]
    };
}

function config_dt_affilitaion() {
    return {
        data: JSON.parse(localStorage.getItem('ms_affiliation')).rows,
        fixedHeader: true,
        processing: true,
        responsive: true,
        keys: true,
        deferLoading: 57,
        lengthMenu: [10, 50, 100, { label: 'All', value: -1 }],
        layout: {
            topStart: {
                buttons: [
                    { 
                        extend: 'pageLength', 
                        className: 'py-1' 
                    },
                    {
                        text: '<i class="fa-solid fa-floppy-disk"></i>',
                        attr: { id: 'btn_save_select'},
                        className: 'btn-showall-color hidden collapse py-1',
                        action: function (e, dt, node, config) {
                            var rows = $ummu.dt.select.data();
                            var row = $ummu.dt.select.getRow(table_affiliation);
                            // var row = table_supplier.row({selected: true}).data();
                            console.log(row)
                            $('#supplier_kode').val(row.emp_code);
                            $('#supplier').val(row.emp_name);
                            $('#currency_kode').val(row.cur_code);
                            $('#supplier_modal').modal('hide');

                            // if(localStorage.getItem("level_id") == "1") {
                                // $('#periode').val('');
                                // $('#modal_import2').modal('show');
                            // }
                            // var rows = $ummu.dt.select.data();
                            // console.log(rows)
                            // multi_approve(rows);
                        }
                        // $('#example tbody').on( 'click', 'tr',  (event) =>  {
                        //     console.log( table.row( event.currentTarget ).data() );
                        // } );
                    }
                ]
            }
        },
        columnDefs: [
            {
                targets: 0,
                orderable: false
            },
        ],
        order: [[0, 'desc']],
        scrollCollapse: true,
        scrollX: true,
        select: {
            style: 'single',
            headerCheckbox: false
        },
        columns: [
            {
                data: null,
                render: DataTable.render.select()
            },
            { 
                data: 'emp_name' 
            },
            {
                data: 'tipe'
            },
            { 
                data: 'Jabatan'
            },
            { 
                data: 'cur_code'
            },
            { 
                data: 'emp_code' 
            }
        ]
    };
}

function config_dt_projectArea() {
    return {
        data: JSON.parse(localStorage.getItem('usp_0202_SHB_0004')).rows,
        fixedHeader: true,
        processing: true,
        responsive: true,
        keys: true,
        deferLoading: 57,
        lengthMenu: [10, 50, 100, { label: 'All', value: -1 }],
        layout: {
            topStart: {
                buttons: [
                    { 
                        extend: 'pageLength', 
                        className: 'py-1' 
                    },
                    {
                        text: '<i class="fa-solid fa-floppy-disk"></i>',
                        attr: { id: 'btn_save_select'},
                        className: 'btn-showall-color hidden collapse py-1',
                        action: function (e, dt, node, config) {
                            var row = $ummu.dt.select.getRow(table_projectArea);
                            // console.log(row)
                            $('#project_area_kode').val(row.region_code);
                            $('#project_area_name').val(row.region_name);
                            $('#project_area_modal').modal('hide');
                        }
                    }
                ]
            }
        },
        columnDefs: [
            {
                targets: 0,
                orderable: false
            },
        ],
        order: [[0, 'desc']],
        scrollCollapse: true,
        scrollX: true,
        select: {
            style: 'single',
            headerCheckbox: false
        },
        columns: [
            {
                data: null,
                render: DataTable.render.select()
            },
            { 
                data: 'region_code' 
            },
            {
                data: 'region_name'
            }
        ]
    };
}*/

/*function au_import() {
    var url = globalVar.qUrl + 'import';

    var ummu = $ummu.ajax.aumImport2(url);
    ummu.done(function(result) {
        // console.log(result)
        var response = JSON.parse(result);
        if (response.status==true) {
            table.ajax.reload();
            $('#modal_import2').modal('hide');
            $ummu.func.ch_message(response.message);
        }else{
            $('#message_title, #text_message').empty();
            var message = response.message;
            var errors = response.errors;
            $('#message_title').html(message);
            for(let index in errors){
                var $error = '<div class="alert alert-danger alert-dismissible fade show" role="alert">'+
                                '<i class="bi bi-exclamation-octagon me-1"></i>'+
                                errors[index]+
                             '</div>';
                $('#text_message').append($error);
            }
            $('#message_modal').modal('show');
        }
    }).fail(function() {
        // An error occurred
        console.log(ummu)
    });
}

function get_periode() {
    var params = {
        "type": "get",
        "action": "get",
        "data": {
            "limit":0,
            "offset":0,
            "sort": "id",
            "order": "desc",
            "search": ""
        },
        "cache": true,
        "contentType": "application/json",
        "dataType": "json"
    };
    var url = globalVar.qUrl+'show_payslip_periode';
    var ali = $globalAjax.ummay(url,params);
    ali.done(function(result) {
        var response = JSON.parse(result);
        // console.log(response)
        var params = {
            "element_id": 'periode',
            "rows": response,
            "with_kode": 0
        }
        $ummu.views.select_option_append(params);

        var params2 = {
            "element_id": 'periode2',
            "rows": response,
            "with_kode": 0
        }
        $ummu.views.select_option_append(params2);
    }).fail(function() {
        // An error occurred
    });
}*/

/*function multi_delete(rows) {
    console.log(rows)

    $('#btn_approve').prop('disabled', true);
    $('#modal_loader_approval').show();

    var r = [];
    $.each(rows, function( index, value ) {
        r[index] = {};

        r[index] = value.id;
        // r[index].appv_remark = "by multiple approve";
        // r[index].doc_number = value.doc_code;

        // var d = [];
        // $.each(value.detail, function( index2, value2) {
        //     d[index2] = {};

        //     d[index2].status = 1;
        //     d[index2].comment = "by multiple approve";
        //     d[index2].part_code = value2.Prod_code;
        //     d[index2].part_qty = value2.part_qty;
        //     d[index2].harga = value2.harga;
        //     d[index2].disc = value2.Disc;
        //     d[index2].nomer = value2.nomer;
        // })

        // r[index].details = d;
    });

    var payload = JSON.stringify(
    {
        "body": {
            "ids": r
        }
    });

    // console.log(r)

    do_delete(payload)
}*/

/*function do_delete(payload) {
    var url = globalVar.qUrl + 'delete';
    var params = {
        "url": url,
        "type": "delete",
        "action": "delete",
        "data": payload,
        "cache": true,
        "contentType": "application/json",
        "dataType": "json"
    };

    // console.log(JSON.parse(payload))
    // console.log(JSON.parse(params))
    // console.log(params)

    var ummu = $ummu.ajax.ummu2(params);   
    ummu.done(function(result) {
        console.log(result)
        // var response = JSON.parse(result);
        // if (response.status==true) {
        //     table.ajax.reload();
        //     // $('#ApproveModal').modal('hide');
        //     // $ummu.func.ch_message(response.message);
        // }else{
        //     // $('#message_title, #text_message').empty();
        //     // var message = response.message;
        //     // var errors = response.errors;
        //     // $('#message_title').html(message);
        //     // for(let index in errors){
        //     //     var $error = '<div class="alert alert-danger alert-dismissible fade show" role="alert">'+
        //     //                     '<i class="bi bi-exclamation-octagon me-1"></i>'+
        //     //                     errors[index]+
        //     //                  '</div>';
        //     //     $('#text_message').append($error);
        //     // }
        //     // $('#message_modal').modal('show');
        // }
        // // $('#btn_approve').prop('disabled', false);
        // // $('#modal_loader_approval').hide();
        // // sum();
    }).fail(function() {
        // An error occurred
        console.log(ummu)
    });
    // console.log(params)
}*/

/*function get_supplier() {
    var params = {
        "type": "get",
        "action": "get",
        "data": {
            "limit":0,
            "offset":0,
            "sort": "id",
            "order": "desc",
            "search": ""
        },
        "cache": true,
        "contentType": "application/json",
        "dataType": "json"
    };
    var url = globalVar.qUrl+'show_supplier';
    var ali = $globalAjax.ummay(url,params);
    ali.done(function(result) {
        var response = JSON.parse(result);
        // console.log(response)
        localStorage.setItem("ms_supplier", result);
        // var params = {
        //     "element_id": 'periode',
        //     "rows": response,
        //     "with_kode": 0
        // }
        // $ummu.views.select_option_append(params);

        // var params2 = {
        //     "element_id": 'periode2',
        //     "rows": response,
        //     "with_kode": 0
        // }
        // $ummu.views.select_option_append(params2);
    }).fail(function() {
        // An error occurred
    });
}

function get_affiliation() {
    var params = {
        "type": "get",
        "action": "get",
        "data": {
            "limit":0,
            "offset":0,
            "sort": "id",
            "order": "desc",
            "search": ""
        },
        "cache": true,
        "contentType": "application/json",
        "dataType": "json"
    };
    var url = globalVar.qUrl+'show_affiliation';
    var ali = $globalAjax.ummay(url,params);
    ali.done(function(result) {
        var response = JSON.parse(result);
        // console.log(response)
        localStorage.setItem("ms_affiliation", result);
        // var params = {
        //     "element_id": 'periode',
        //     "rows": response,
        //     "with_kode": 0
        // }
        // $ummu.views.select_option_append(params);

        // var params2 = {
        //     "element_id": 'periode2',
        //     "rows": response,
        //     "with_kode": 0
        // }
        // $ummu.views.select_option_append(params2);
    }).fail(function() {
        // An error occurred
    });
}

function usp_0202_SHB_0004() {
    var params = {
        "type": "get",
        "action": "get",
        "data": {
            "limit":0,
            "offset":0,
            "sort": "id",
            "order": "desc",
            "search": ""
        },
        "cache": true,
        "contentType": "application/json",
        "dataType": "json"
    };
    var url = globalVar.qUrl+'usp_0202_SHB_0004';
    var ali = $globalAjax.ummay(url,params);
    ali.done(function(result) {
        var response = JSON.parse(result);
        console.log(response)
        localStorage.setItem("usp_0202_SHB_0004", result);
    }).fail(function() {
        // An error occurred
    });
}*/