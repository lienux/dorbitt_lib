var globalVar = {
    qUrl: $base_url + 'admin/she_hazard_report_achievement/',
    pageUrl: $base_url + 'admin/she_hazard_report_achievement/',
    errors_params: [],
}

var app = {
    register: function() {
        app.config.autoload();
    },
    config: {
        autoload: function() {
            app.dt.load();
            $ummu.func.location_hash();
            $ummu.dt.layout.button();
        }
    },
    events: {
        // 
    },
    controllers: {
        show: function(params) {
            // console.log(params)
            var url = globalVar.qUrl;
            var ali = $globalAjax.ummu(url,params);
            ali.done(function(result) {
                var response = JSON.parse(result);
                params.success(response)
                $globFunc.ch_message(response.message);
                // app.Controllers.show_gedung()
                // app.Controllers.show_roomcateg()
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
        },
        set_selected_gallery_to_frame: function(ids,filenames,paths) {
            // console.log(rows)
            if (globalVar.element_for_gallery == 'btn_image') {
                var imgset = '#foto_temuan';
                var urlset = '#img_foto_temuan';
            }else{
                var imgset = '#foto_perbaikan';
                var urlset = '#img_foto_perbaikan';
            }
            $(imgset).val(filenames[0]);
            $(imgset).attr('data-id',ids[0]);
            $(urlset).attr('src',paths[0]);
        },
        set_row_to_form: function(row) {
            // var row = rows[0];
            $('#tgl_penemuan').val(row.tgl_temuan);
            $('#waktu_penemuan').val(row.waktu_temuan);
            $('#lokasi_penemuan').val(row.lokasi_temuan_id);
            $('#detail_lokasi').val(row.detail_lokasi);
            $('#jenis_temuan').val(row.jenis_temuan_id);
            $('#kode_bahaya').val(row.kode_bahaya_id);
            $('#bahaya_ditemukan').val(row.bahaya_ditemukan);
            $('#penyebab_bahaya').val(row.penyebab_bahaya);
            $('#rincian_tindakan').val(row.rincian_tindakan);
            $('#nm_atasan').val(row.nm_atasan);
            $('#img_foto_temuan').attr('src', row.foto_temuan_url);
            $('#img_foto_perbaikan').attr('src', row.foto_perbaikan_url);

            if (row.status_id == null || row.status_id == '' || row.status_id == 0) {
                var status_id = 0;
            }else{
                var status_id = row.status_id;
            }
            $("input:radio[value="+status_id+"]").prop('checked',true);
        }
    },
    dt: {
        config: function() {
            return {
                ajax: {
                    dataSrc: 'rows',
                    url: $ummu.vars.page_url + 'show',
                    data: function (d) {
                        // var filter = JSON.parse(localStorage.getItem('filter'));
                        // console.log(filter)
                        d.myKey = 'myValue';
                        d.date_from = localStorage.getItem('date_from');
                        d.time_from = localStorage.getItem('time_from');
                        d.date_to = localStorage.getItem('date_to');
                        d.time_to = localStorage.getItem('time_to');
                        d.site = localStorage.getItem('site_project_kode');
                        // d.custom = $('#myInput').val();
                        // d.release = [0];
                        // etc
                    }
                },
                processing: true,
                serverSide: true,
                responsive: true,
                keys: true,
                scrollCollapse: true,
                scrollX: true,
                scrollY: 360,
                // language: { "processing": "Hang on. Waiting for data.." },
                deferLoading: 57,
                // lengthMenu: [10, 50, 100, 1000, { label: 'All', value: -1 }],
                lengthMenu: [10, 50, 100, 500, 1000],
                layout: {
                    topStart: {
                        buttons: []
                    }
                },
                columnDefs: [
                    // 
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
                    // { 
                    //     data: 'id'
                    // },
                    { data: 'KdSite' },
                    {
                        data: 'nikaryawan'
                    },
                    {
                        data: 'name'
                    },
                    { 
                        data: 'jabatanxx'
                    },
                    { 
                        data: 'NmDepar'
                    },
                    {
                        data: 'NmLevel',
                        className: "text-center" 
                    },
                    {
                        data: 'target_hzr',
                        className: "text-right" 
                    },
                    { 
                        data: 'jml_capaian',
                        className: "text-right" 
                    },
                    { 
                        data: 'persen_capaian',
                        className: "text-right",
                        render: function (data, type) {
                            if (data >= 0 && data < 50) {
                                var text = '<span class="text-danger">'+data+' %</span>';
                            }else if(data >= 50 && data < 100) {
                                var text = '<span class="text-warning">'+data+' %</span>';
                            }else if (data >= 100) {
                                var text = '<span class="text-success">'+data+' %</span>';
                            }
                            return text;
                        }
                    },
                    {
                        data: 'nilai',
                        className: "text-right",
                        render: function (data, type) {
                            if (data == 0.25) {
                                var kelas = 'text-danger';
                            }else if(data == 0.5) {
                                var kelas = 'text-warning';
                            }else if (data == 1) {
                                var kelas = 'text-success';
                            }
                            return '<span class="'+kelas+'">'+data+'</span>';
                        }
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

                    var response = settings.json;
                    // console.log(response);
                    $ummu.views.dt.info_filter(response.filter);
                },
                footerCallback: function (row, data, start, end, display) {
                    // console.log(data)
                    let api = this.api();
                    // let filter = JSON.parse(localStorage.getItem('filter'));
             
                    // Remove the formatting to get integer data for summation
                    let intVal = function (i) {
                        return typeof i === 'string'
                            ? i.replace(/[\$,]/g, '') * 1
                            : typeof i === 'number'
                            ? i
                            : 0;
                    };
             
                    // // Total over all pages
                    // total = api
                    //     .column(6)
                    //     .data()
                    //     .reduce((a, b) => intVal(a) + intVal(b), 0);
             
                    // // Total over this page
                    // pageTotal = api
                    //     .column(6, { page: 'current' })
                    //     .data()
                    //     .reduce((a, b) => intVal(a) + intVal(b), 0);

                    total_jml_target = api
                        .column(6, { page: 'current' })
                        .data()
                        .reduce((a, b) => intVal(a) + intVal(b), 0);

                    total_jml_capaian = api
                        .column(7)
                        .data()
                        .reduce((a, b) => intVal(a) + intVal(b), 0);
             
                    // // Update footer
                    // api.column(6).footer().innerHTML =
                    //     pageTotal + ' (' + total + ' total)';
                    
                    // api.column(0).footer().innerHTML = 'FILTER: <br> From: '+ filter.date_from + ' To: ' + filter.date_to;
                    api.column(6).footer().innerHTML = total_jml_target;
                    api.column(7).footer().innerHTML = total_jml_capaian;
                }
            };
        },
        load: function() {
            // 
        }
    }
}

var table = new DataTable('#dt_hazard_report', app.dt.config());

$(document).ready(function () {
    app.register.apply();
});
