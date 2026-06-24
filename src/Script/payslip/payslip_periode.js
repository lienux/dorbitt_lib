var globalVar = {
    qUrl: $base_url + 'admin/payslip_periode/',
    approval_authorization_level: null,
    errors_params: []
}


var table = new DataTable('#datatable', config());
// table.button(1).disable();
table.on('click', 'tbody tr td:nth-child(2)', function () {
    var row = table.row(this).data();
    console.log(row);

    $('#nika').html(row.nika);
    $('#name').html(row.name);
    // $('#site').html(row.site);
    // $('#jabatan').html(row.jabatan);
    // $('#periode_name').html(row.periode_name);
    // $('#gapok').html($ummu.helpers.currency.us(row.gapok_baru));
    // $('#rapel_gaji').html($ummu.helpers.currency.us(row.rapel_gaji));
    // $('#lain_lain').html($ummu.helpers.currency.us(row.lain_lain));
    // $('#tj_acting').html($ummu.helpers.currency.us(row.tj_acting));
    // $('#tj_kesetaraan').html($ummu.helpers.currency.us(row.tj_kesetaraan));
    // $('#insentif_produksi').html($ummu.helpers.currency.us(row.insentif_produksi));
    // $('#insentif_kehadiran').html($ummu.helpers.currency.us(row.insentif_kehadiran));
    // $('#total_tunjangan').html($ummu.helpers.currency.us(row.total_tunjangan));
    // $('#gaji_bruto').html($ummu.helpers.currency.us(row.gaji_bruto));
    // $('#potongan_kasbon').html($ummu.helpers.currency.us(row.potongan_kasbon));
    // $('#potongan_tiket').html($ummu.helpers.currency.us(row.potongan_tiket));
    // $('#potongan_jamsostek_jht').html($ummu.helpers.currency.us(row.potongan_jamsostek_jht));
    // $('#potongan_jamsostek_jp').html($ummu.helpers.currency.us(row.potongan_jamsostek_jp));
    // $('#total_potongan').html($ummu.helpers.currency.us(row.total_potongan));
    // $('#gaji_netto').html($ummu.helpers.currency.us(row.gaji_netto));

    $('#PayslipModal').modal('show');
});
table.on( 'select', function ( e, dt, type, indexes ) {
    $ummu.views.approval.button.approve_all()
});
table.on( 'deselect', function ( e, dt, type, indexes ) {
    $ummu.views.approval.button.approve_all()
});

$(document).ready(function () {
    $ummu.func.location_hash();

    $('#PayslipModal #btn_max').on('click', function() {
        $ummu.views.modal.fullscreen('#PayslipModal #modal_dialog');
    })

    $('#print').on('click', function() {
        var hasClassFull = $( "#PayslipModal #modal_dialog" ).hasClass( "modal-fullscreen");
        // console.log(hasClassFull)
        // $ummu.views.modal.fullscreen('#PayslipModal #modal_dialog');
        if (hasClassFull == false) {
            $('#PayslipModal #modal_dialog').addClass('modal-fullscreen');
        }
        window.print();
        $('#PayslipModal #modal_dialog').removeClass('modal-fullscreen');
    })

    $('#btn_save').on('click', function() {
        // $ummu.views.modal.fullscreen('#PayslipModal #modal_dialog');
        var val = $ummu.validation.payslip_periode.insert();
        if(val == true){
            save();
        }else{
            // 
        }
    })
});

function config() {
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
                    {
                        text: '<i class="bi bi-folder-plus text-primary"></i> New',
                        attr: { id: 'btn_new'},
                        className: 'btn-showall-color hidden collapse py-1',
                        action: function (e, dt, node, config) {
                            // if(localStorage.getItem("level_id") == "1") {
                                $('#form_input_modal').modal('show');
                            // }
                            // var rows = $ummu.dt.select.data();
                            // console.log(rows)
                            // multi_approve(rows);
                        }
                    }
                    // {
                    //     text: '<i class="bi bi-file-earmark-excel"></i> Import',
                    //     attr: { id: 'btn_import'},
                    //     className: 'btn-showall-color hidden collapse',
                    //     action: function (e, dt, node, config) {
                    //         // if(localStorage.getItem("level_id") == "1") {
                    //             $('#modal_import').modal('show');
                    //         // }
                    //         // var rows = $ummu.dt.select.data();
                    //         // console.log(rows)
                    //         // multi_approve(rows);
                    //     }
                    // },
                    // 'selectAll',
                    // 'selectNone'
                ]
            }
        },
        columnDefs: [
            // {
            //     targets: 0,
            //     orderable: false,
            //     render: DataTable.render.select()
            // },
            // {
            //     target: 3,
            //     visible: false
            // }
        ],
        // fixedColumns: {
        //     start: 3
        // },
        order: [[1, 'asc']],
        // rowGroup: {
        //     dataSrc: 'region_name'
        // },
        scrollCollapse: true,
        scrollX: true,
        // scrollY: 300,
        // select: {
        //     style: 'multi+shift',
        //     selector: 'td:first-child',
        //     headerCheckbox: 'select-page'
        // },
        columns: [
            // {
            //     data: null,
            //     render: DataTable.render.select()
            // },
            // {
            //     data: 'id'
            //     // className: 'text-right',
            // },
            { 
                data: 'name'
                // render: function (data, type) {
                //     return '<a href="javascript:void(0);">' + data + ' <i class="fas fa-external-link-alt ml-2"></i></a>';
                // }
            },
            // { 
            //     data: 'is_release',
            //     render: function (data, type) {
            //         return $ummu.formatter.is_release(data);
            //     }
            // },
            // { data: 'jabatan' },
            // { data: 'dept' },
            // { 
            //     data: 'tgl_join',
            //     className: 'text-right',
            // },
            // { 
            //     data: 'gol',
            //     className: 'text-center',
            // },
            // { 
            //     data: 'gapok_baru',
            //     className: 'text-right',
            //     render: function (data, type) {
            //         return $ummu.helpers.currency.us(data);
            //     }
            // },
            // { 
            //     data: 'tj_acting',
            //     className: 'text-right',
            //     render: function (data, type) {
            //         return $ummu.helpers.currency.us(data);
            //     }
            // },
            // { 
            //     data: 'rapel_gaji',
            //     className: 'text-right',
            //     render: function (data, type) {
            //         return $ummu.helpers.currency.us(data);
            //     }
            // },
            // { 
            //     data: 'lain_lain',
            //     className: 'text-right',
            //     render: function (data, type) {
            //         return $ummu.helpers.currency.us(data);
            //     }
            // },
            // { 
            //     data: 'uang_hadir',
            //     className: 'text-right',
            //     render: function (data, type) {
            //         return $ummu.helpers.currency.us(data);
            //     }
            // },
            // { 
            //     data: 'tj_kesetaraan',
            //     className: 'text-right',
            //     render: function (data, type) {
            //         return $ummu.helpers.currency.us(data);
            //     }
            // },
            // { 
            //     data: 'insentif_produksi',
            //     className: 'text-right',
            //     render: function (data, type) {
            //         return $ummu.helpers.currency.us(data);
            //     }
            // },
            // { 
            //     data: 'insentif_kehadiran',
            //     className: 'text-right',
            //     render: function (data, type) {
            //         return $ummu.helpers.currency.us(data);
            //     }
            // },
            // { 
            //     data: 'total_tunjangan',
            //     className: 'text-right',
            //     render: function (data, type) {
            //         return $ummu.helpers.currency.us(data);
            //     },
            //     createdCell: function (td) {
            //         $(td).css('background-color', "yellow")
            //     }
            // },
            // { 
            //     data: 'gaji_bruto',
            //     className: 'text-right',
            //     render: function (data, type) {
            //         return $ummu.helpers.currency.us(data);
            //     },
            //     createdCell: function (td) {
            //         $(td).css('background-color', "yellow")
            //     }
            // },
            // { 
            //     data: 'potongan_kasbon',
            //     className: 'text-right',
            //     render: function (data, type) {
            //         return $ummu.helpers.currency.us(data);
            //     }
            // },
            // { 
            //     data: 'potongan_tiket',
            //     className: 'text-right',
            //     render: function (data, type) {
            //         return $ummu.helpers.currency.us(data);
            //     }
            // },
            // { 
            //     data: 'potongan_jamsostek_jht',
            //     className: 'text-right',
            //     render: function (data, type) {
            //         return $ummu.helpers.currency.us(data);
            //     }
            // },
            // { 
            //     data: 'potongan_jamsostek_jp',
            //     className: 'text-right',
            //     render: function (data, type) {
            //         return $ummu.helpers.currency.us(data);
            //     }
            // },
            // { 
            //     data: 'total_potongan',
            //     className: 'text-right',
            //     render: function (data, type) {
            //         return $ummu.helpers.currency.us(data);
            //     },
            //     createdCell: function (td) {
            //         $(td).css('background-color', "yellow")
            //     }
            // },
            // { 
            //     data: 'gaji_netto',
            //     className: 'text-right',
            //     render: function (data, type) {
            //         return $ummu.helpers.currency.us(data);
            //     },
            //     createdCell: function (td) {
            //         $(td).css('background-color', "yellow")
            //     }
            // },
            // { 
            //     data: 'no_rek',
            //     render: function (data, type) {
            //         return $ummu.helpers.rekeningFormatter(data);
            //     }
            // },
            // { data: 'nama_rekening' },
            // { data: 'bank' },
            // { data: 'site' },
            // { data: 'email' },
            // { data: 'whatsapp' }
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

function save() {
    $('#btn_save').addClass('disabled');
    $('#loader_form_modal').show();

    var payload = JSON.stringify(
    {
        "body": {
            "name": $('#name').val()
        }
    });

    create(payload)
}

function create(payload) {
    var url = globalVar.qUrl + 'create';
    var params = {
        "url": url,
        "type": "post",
        "action": "insert",
        "data": payload,
        "cache": true,
        "contentType": "application/json",
        "dataType": "json"
    };

    // console.log(JSON.parse(payload))
    // console.log(params)

    var ummu = $ummu.ajax.ummu2(params);   
    ummu.done(function(result) {
        console.log(result)
        var response = JSON.parse(result);
        if (response.status==true) {
            table.ajax.reload();
            $('#form_input_modal').modal('hide');
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
        $('#loader_form_modal').hide();
        $('#btn_save').removeClass('disabled');
    }).fail(function() {
        // An error occurred
        console.log(ummu)
    });

    // console.log(params)
}