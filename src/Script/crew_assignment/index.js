$ummu.vars.page_url = $base_url + 'admin/' + PHP_VARS.moduleKode + '/';
var table2 = $('#table2')
var $crud = ["new","edit","delete"]
var $localStrgKey = PHP_VARS.moduleKode;

var app = {
    register: function () {
        app.config.autoload()
    },

    config: {
        autoload: function () {
            $ummu.func.location_hash()
            $ummu.button.sbToolbar()
            localStorage.setItem(`${$ummu.vars.module_kode}_isDtServerSide`, false)
            $ummu.config.dataTables()
            app.controllers.index();

            // =================================================================
            // START TABLE 2
            // PERBAIKAN 1: Ambil data dari URL terlebih dahulu jika ada
            // =================================================================
                // const rawWaypoint = $ummu.url.getParam('detail_waypoint');
                let initialData = [];

                // if (rawWaypoint) {
                //     initialData = (typeof rawWaypoint === 'string') ? JSON.parse(rawWaypoint) : rawWaypoint;
                // }

                // Jalankan init2 menggunakan data yang sebenarnya dari URL (bukan dipaksa [] kosong)
                app.dt.init2(initialData);
                // =================================================================

                // Pasang event penanganan tombol setelah inisialisasi siap
                if (app.dt.crew.init !== null) {
                    $ummu.dt.layout.buttonAllCustom(app.dt.crew.init, ['btn_page_length','btn_new']);
                    app.dt.crew.init.button('#dt_btn_new').disable();
                }

                app.dt.crew.init.on("click", "tbody tr td:nth-child(1)", function () {
                    var row = app.dt.crew.init.row(this).data();

                    app.vars.id = row.id
                    $("#crew").val(row.employee_name).attr('data-id', row.employee_id);
                    $("#rank").val(row.rank_name_id).attr('data-id', row.rank_id);

                    $("#crew_modal_title").text('Form Edit Crew');
                    $("#modalForm_inputCrew").modal('show');
                    // $("#modal_btnDelete_waypoint").removeClass('collapse')
                    // console.log(row)
                });

                $("#modal_btnSave_CrewItems").on('click', function(){
                    app.controllers.save_crewItems();
                });

                // $("#modal_btnDelete_waypoint").on('click', function(){
                //     if (app.vars.id !== null) {
                //         app.controllers.delete_waypoint(app.vars.id)
                //     }else{
                //         console.log('ID not found on app.vars.id')
                //     }
                // })
                if ($ummu.url.getParam('vessel_id')) {
                    var getRowsFilter = $ummu.dt.controllers.getRowsFilter($ummu.dt.init, 'vessel_id', $ummu.url.getParam('vessel_id'));
                    app.dt.crew.init.clear();
                    $ummu.dt.controllers.addRows(app.dt.crew.init, getRowsFilter);
                }
            // =================================================================
            // END TABLE 2
            // =================================================================
        },
    },

    vars: {
        id: null,
        initTable2: null,
        runing_id: null,
        init: null,
    },

    controllers: {
        index: function() {
            $ummu.dt.controllers.index();
        },

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
            $("#status").html('<span class="badge badge-secondary">Draft</span>')
            $("#from_dept").val($ummu.vars.employee.department).attr('data-id', $ummu.vars.employee.department_id)
            app.dt.crew.init.button('#dt_btn_new').enable();
        },

        sbSave: function () {
            var vessel_name = $("#tugboat").val();
            var vessel_id = $("#tugboat").attr('data-id');
            var dtRows = $ummu.dt.controllers.getRows(app.dt.crew.init);

            // 3. Gunakan .map() untuk menyisipkan field 'vessel_id' ke setiap objek/baris
            var dataBaru = dtRows.map(function(row) {
                // Jika data asal berupa OBJECT {}
                return {
                    ...row, // Salin semua field yang sudah ada (destructuring)
                    vessel_id: vessel_id, // Tambahkan field baru di sini
                    vessel_name: vessel_name
                };
            });

            var data = JSON.stringify(dataBaru);

            const id = $ummu.url.getParam('id');

            var params = {
                "data": data,
                "loader": true,
                "loaderText": 'Save data progress...'
            };

            const validation = app.validation.save();

            if (validation.length > 0) {
                $ummu.views.errors_msg(validation) //string or array
                $(".btn-endis").removeClass('btn-outline-secondary').addClass('btn-primary')
            }else{
                var ummu = $ummu.ajax2.post_json(params);
                ummu.done(function(result) {
                    const response = JSON.parse(result);
                    // $ummu.views.after_sbToolbar_save(response, func, id, payload);
                    console.log(result)
                }).fail(function() {
                    // An error occurred
                    console.log(ummu)
                });
                // console.log(ummu)
            }
        },

        sbCancle: function () {
            app.dt.crew.init.button('#dt_btn_new').disable();
            if ($ummu.url.getParam('id')) {
                // 
            }else{
                app.views.forClear()
            }
        },

        sbEdit: function () {
            app.dt.crew.init.button('#dt_btn_new').enable();
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
            }).fail(function() {
                // An error occurred
                console.log(ummu)
            });
        },

        sbClear: function() {
            app.views.forClear()
        },

        on_showLeftModal: function(id) {
            console.log(id)
            if (id == 'tugboat') {
                // $ummu.url.setParam('set_to_id', id);
                $ummu.dt.tugboat.func = "tugboat";
                $ummu.controllers.show_tugboat(id);
            }else if (id == 'crew') {
                // $ummu.dt.crew.func = "crew";
                $ummu.controllers.show_crew(id);
            }else if (id == 'rank') {
                // $ummu.dt.rank.func = "rank";
                $ummu.controllers.show_crew_ranks(id);
            }
        },

        on_btn_getData_click: function () {
            $ummu.views.after_sbToolbar_getData();
            app.views.forClear()
        },

        // on_click_tbody_trtd_child_pelabuhan: function(row) {
        //     // console.log(row)
        //     var set_to_id = $ummu.url.getParam('set_to_id');

        //     if (set_to_id == 'port_of_loading' && $("#port_of_discharge").attr('data-id') == row.id) {
        //         let msg = "Has been used for Discharge.";
        //         $ummu.views.errors_msg(msg) //string or array
        //     }else if (set_to_id == 'port_of_discharge' && $("#port_of_loading").attr('data-id') == row.id) {
        //         let msg = "Has been used for Loading.";
        //         $ummu.views.errors_msg(msg) //string or array
        //     } else{
        //         $("#"+set_to_id).val(row.name).attr('data-id', row.id);
        //         $ummu.url.delParam('set_to_id');
        //     }
        // },

        on_click_tbody_trtd_child_crew: function(row) {
            // console.log(row)
            $("#crew").val(row.name).attr('data-id', row.id);
        },

        on_click_tbody_trtd_child_crewRanks: function(row) {
            $("#rank").val(row.rank_name_id)
                .attr('data-id', row.id)
                .attr('data-code', row.rank_code);
        },

        on_click_tbody_trtd_child_tugboat: function(row) {
            // console.log(row)
            var getRowsFilter = $ummu.dt.controllers.getRowsFilter($ummu.dt.init, 'vessel_id', row.id);
            app.dt.crew.init.clear();
            $ummu.dt.controllers.addRows(app.dt.crew.init, getRowsFilter);
        },

        on_dtBtnNew_click: function() {
            app.vars.id = null
            if ($("#tugboat").val()) {
                $("#crewForm_modal_title").text('Form Input Crew')
                $("#modalForm_inputCrew input").val('')
                $("#modalForm_inputCrew").modal('show')
                $("#modal_btnDelete_waypoint").addClass('collapse')
            }else{
                alert("Silahkan pilih tugboat terlebih dahulu.")
            }
        },

        // save_waypoint: function(id) {
        //     // 1. WAJIB: Reset global FormData agar data tidak menumpuk saat tombol diklik berulang kali
        //     $ummu.vars.formData = new FormData(); 

        //     // 2. Ambil parameter dasar dari URL dan status aplikasi
        //     const rute_id = $ummu.url.getParam("id");
        //     const is_update = (app.vars.id !== null); // Menentukan mode Insert atau Update

        //     // 3. Otomatisasi pembacaan field (Lebih bersih daripada menulis .val() & .append() satu per satu)
        //     const fields = [
        //         "waypoint_name", "sequence", "lintang_sudut", "lintang_menit", 
        //         "lintang_arah", "bujur_sudut", "bujur_menit", "bujur_arah", 
        //         "haluan", "jarak", "total_jarak"
        //     ];

        //     fields.forEach(field => {
        //         let value = $(`#${field}`).val();
        //         // Kondisi khusus: 'waypoint_name' di-append dengan key 'name' sesuai kebutuhan backend
        //         let key = (field === 'waypoint_name') ? 'name' : field;
        //         $ummu.vars.formData.append(key, value);
        //     });

        //     // Tambahkan data relasi rute_id
        //     $ummu.vars.formData.append("rute_id", rute_id);

        //     // 4. Set Route Function dan Method Spoofing untuk CodeIgniter 4
        //     if (!is_update) {
        //         // Mode Insert Data (POST)
        //         $ummu.ajax.function = "waypoint";
        //     } else {
        //         // Mode Update Data (PUT Spoofing)
        //         // Menambahkan parameter _method agar dibaca sebagai PUT oleh CodeIgniter 4
        //         $ummu.vars.formData.append("_method", "PUT");
        //         $ummu.ajax.function = `waypoint/${app.vars.id}`;
        //     }

        //     // 5. Jalankan Validasi Sisi Klien
        //     const validation = app.validation.save_waypoint();

        //     if (validation.length > 0) {
        //         $ummu.views.errors_msg(validation); // Tampilkan pesan error jika ada field kosong
        //         return; // Hentikan eksekusi script
        //     }

        //     // 6. Eksekusi request AJAX melalui library ummu.js
        //     var params = {
        //         "data": $ummu.vars.formData,
        //         "loader": true,
        //     };

        //     var ummu = $ummu.ajax.ummu7b(params);   
            
        //     ummu.done(function(result) {
        //         // Mengamankan parsing data jika response dari server sudah berupa objek otomatis
        //         const response = (typeof result === 'string') ? JSON.parse(result) : result;
                
        //         if (response.status === true) {
        //             // Tutup Modal Form Input
        //             $("#modalForm_inputCrew").modal("hide");

        //             // Update parameter detail_waypoint di URL
        //             const detail_waypoint = JSON.stringify(response.rows);
        //             $ummu.url.setParam('detail_waypoint', detail_waypoint);

        //             // Sinkronisasi data ke localStorage
        //             // 1. itemName = voyage_route
        //             // 2. 
        //             // 3. keyName = detail_waypoint
        //             // 4. rows = response.rwos
        //             $ummu.localStorage.controllers.updateParam_byID2('voyage_route', rute_id, 'detail_waypoint', response.rows);

        //             // Refresh tampilan Datatables secara real-time
        //             if (app.dt.crew && app.dt.crew.init) {
        //                 app.dt.crew.init.clear().rows.add(response.rows).draw();
        //             }
        //         } else {
        //             // Tampilkan pesan error kiriman dari validasi backend server
        //             $ummu.views.errors_msg(response.errors || "Terjadi kesalahan sistem saat menyimpan data.");
        //         }
        //     }).fail(function(xhr) {
        //         console.error("AJAX Error Response:", xhr.responseText);
        //         $ummu.views.errors_msg("Gagal terhubung dengan server. Silahkan periksa koneksi internet Anda.");
        //     });
        // },

        // delete_waypoint: function(id) {
        //     $("#modalForm_inputCrew").modal('hide')

        //     var rute_id = $ummu.url.getParam('id');

        //     $ummu.vars.formData = new FormData();
        //     $ummu.vars.formData.append("_method", "DELETE");
        //     $ummu.vars.formData.append("rute_id", rute_id);
        //     $ummu.ajax.function = `waypoint/${id}`;

        //     var params = {
        //         "data": $ummu.vars.formData,
        //         "loader": true,
        //         "textLoader": "Delete on progress..."
        //     };

        //     var ummu = $ummu.ajax.ummu7b(params);   
        //     ummu.done(function(result) {
        //         // Mengamankan parsing data jika response dari server sudah berupa objek otomatis
        //         const response = (typeof result === 'string') ? JSON.parse(result) : result;

        //         if (response.status == true) {
        //             // Update parameter detail_waypoint di URL
        //             const detail_waypoint = JSON.stringify(response.rows);
        //             $ummu.url.setParam('detail_waypoint', detail_waypoint);

        //             // Sinkronisasi data ke localStorage
        //             // 1. itemName = voyage_route
        //             // 2. 
        //             // 3. keyName = detail_waypoint
        //             // 4. rows = response.rwos
        //             $ummu.localStorage.controllers.updateParam_byID2('voyage_route', rute_id, 'detail_waypoint', response.rows);

        //             // Refresh tampilan Datatables secara real-time
        //             if (app.dt.crew && app.dt.crew.init) {
        //                 app.dt.crew.init.clear().rows.add(response.rows).draw();
        //             }

        //             $(".sb-toolbar #modalSuccessMessage #alert").html("");
        //             $(".sb-toolbar #modalSuccessMessage #alert").html(response.message);
        //             $(".sb-toolbar #modalSuccessMessage").modal("show");
        //         }else{
        //             // Tampilkan pesan error kiriman dari validasi backend server
        //             $ummu.views.errors_msg(response.errors || "Terjadi kesalahan sistem saat hapus data.");
        //         }
        //     }).fail(function(xhr) {
        //         console.error("AJAX Error Response:", xhr.responseText);
        //         $ummu.views.errors_msg("Gagal terhubung dengan server. Silahkan periksa koneksi internet Anda.");
        //     });
        // },

        save_crewItems: function(id) {
            var row = {
                employee_name: $('#crew').val(),
                employee_id: $('#crew').attr('data-id'),
                rank_id: $('#rank').attr('data-id'),
                rank_code: $('#rank').attr('data-code'),
                rank_name_id: $('#rank').val(),
            };

            const validation = app.validation.save_crew();

            if (validation.length > 0) {
                $ummu.views.errors_msg(validation) //string or array
            }else{
                $ummu.dt.controllers.addRow(app.dt.crew.init, row);
                $("#modalForm_inputCrew").modal('hide')
            }

            // console.log(row)
        },
    },

    validation: {
        save: function() {
            var list = [];
            list = $ummu.validation.inputValidate3();

            return list;
        },

        save_crew: function() {
            var list = [];
            list = $ummu.validation.inputValidate4('modalForm_inputCrew');

            var isCrewExist = app.dt.crew.init.rows().data().toArray().some(function(row) {
                return row.employee_id === $('#crew').attr('data-id');
            });

            var isRankCodeExist = app.dt.crew.init.rows().data().toArray().some(function(row) {
                return row.rank_code === $('#rank').attr('data-code'); 
            });

            if (isCrewExist) {
                list.push('Crew has changed.')
            }

            if (isRankCodeExist) {
                list.push('Rank has changed.')
            }

            return list;
        },

        crew_check_code: function(code) {
            // var table = $('#tb_client').DataTable();
            var table = app.dt.crew.init;

            // Ambil semua data baris, ubah ke array, lalu cek kondisinya
            var isExist = table.rows().data().toArray().some(function(row) {
                return row.rank_code === code; 
            });

            if (isExist) {
                console.log("Data dengan kode CAPT sudah ada!");
                // Jalankan logika jika data sudah ada (misal: tampilkan alert)
            } else {
                console.log("Data belum ada, aman untuk ditambah.");
            }
        },
    },

    views: {
        formParams: function() {
            return $("#form_input .endis");
        },

        setRow_toForm: function(row) {
            // console.log(JSON.parse(row.detail_waypoint))
            // const vessel_id = row.vessel_id;
            // console.log(vessel_id)

            $ummu.views.tab_content('setRow_toForm')

            $("#tugboat").val(row.vessel_name).attr('data-id', row.vessel_id);
            // $("#port_of_loading").val(row.from_name).attr('data-id', row.from_id)
            // $("#port_of_discharge").val(row.to_name).attr('data-id', row.to_id)


            $ummu.views.setIdentitiyToForm(row)
            $ummu.button.sbBtn_on_showData()
            
            // // setTimeout(() => {
            // if (app.dt.crew.init) {
            //     if ($ummu.url.getParam('detail_waypoint')) {
            //         const detail_waypoint = JSON.parse($ummu.url.getParam('detail_waypoint'));
            //         // console.log("Eksekusi setelah 2 detik");
            //         app.dt.crew.init.clear().rows.add(detail_waypoint).draw();
            //     }
            // // }, 1000); // 2000 ms = 2 detik
            // }


            // // Ambil data dari parameter URL
            // const rawWaypoint = $ummu.url.getParam('detail_waypoint');
            // // console.log(rawWaypoint)

            // if (rawWaypoint) {
            //     // 1. Amankan data dari crash string '[object Object]'
            //     let parsedData;
            //     if (typeof rawWaypoint === 'string') {
            //         parsedData = JSON.parse(rawWaypoint);
            //     } else {
            //         parsedData = rawWaypoint;
            //     }
                
            //     // 2. SOLUSI UTAMA: Cek apakah install DataTable sudah selesai atau belum
            //     if (app.dt.crew && app.dt.crew.init != null) {
            //         // JIKA SUDAH SELESAI: Langsung bersihkan dan masukkan data baru
            //         app.dt.crew.init.clear().rows.add(parsedData).draw();
            //         console.log('app.dt.crew && app.dt.crew.init != null')
            //     } else {
            //         // JIKA BELUM SELESAI / MASIH NULL: 
            //         // Jangan panggil .clear(), tapi langsung hancurkan cetakan lama 
            //         // dan buat objek DataTable utuh langsung bersama datanya!
            //         app.dt.init2(parsedData);
            //         console.log('else')
            //     }
            // }

            // const rawWaypoint = $ummu.url.getParam('detail_waypoint');
        
            // if (rawWaypoint) {
            //     const parsedData = (typeof rawWaypoint === 'string') ? JSON.parse(rawWaypoint) : rawWaypoint;
                
            //     // Cukup gunakan pengaman ini saja. Jika belum siap, abaikan karena 
            //     // pembuatan tabel pada Langkah 1 di atas pasti akan menampilkannya.
            //     if (app.dt.crew && app.dt.crew.init !== null) {
            //         app.dt.crew.init.clear().rows.add(parsedData).draw();
            //     }
            // }

            // var getRowsFilter = $ummu.dt.controllers.getRowsFilter($ummu.dt.init, 'vessel_id', vessel_id);
            // app.dt.crew.init.clear();
            // $ummu.dt.controllers.addRows(app.dt.crew.init, getRowsFilter);
        },

        forClear: function() {
            $("#form_input input").val('');
            // $("#status, #uom").html('')

            if (app.dt.crew.init.rows().count() > 0) {
                app.dt.crew.init.clear().draw();
            }

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
                    { data: null, render: DataTable.render.select() },
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
                    // { 
                    //     title: "Tugboat ID",
                    //     data: "vessel_id"
                    // },
                    { 
                        title: "Tugboat",
                        data: "vessel_name"
                    },
                    { 
                        title: "Crew Name",
                        data: "employee_name"
                    },
                    { 
                        title: "Rank Code",
                        data: "rank_code"
                    },
                    { 
                        title: "Rank Name",
                        data: "rank_name_id"
                    },
                ];
        
                return columns;
            },
            onClick_nthChild_2: function(row) {
                var getRowsFilter = $ummu.dt.controllers.getRowsFilter($ummu.dt.init, 'vessel_id', row.vessel_id);
                app.dt.crew.init.clear();
                $ummu.dt.controllers.addRows(app.dt.crew.init, getRowsFilter);

                // 1. Tambahkan url param dari row
                $ummu.url.setParamFromRow(row)

                // // 2. Ubah bagian array (detail_waypoint) menjadi string JSON
                // // Karena URL params tidak mendukung struktur nested secara native
                // const detail_waypoint = JSON.stringify(row.detail_waypoint);

                // // 3. Masukkan ke URLSearchParams
                // // const params = new URLSearchParams(formattedData);
                // $ummu.url.setParam('detail_waypoint', detail_waypoint);

                // // $ummu.vars.is_row = true;
                // // app.controllers.detail(row);
                // // app.views.setRow_toForm(row);

                app.views.setRow_toForm(row);
                $ummu.views.tab_content('setRow_toForm')
            },
            rowGroup: function() {
                // contoh:
                var myRowGroup = {
                    dataSrc: ["vessel_name"],
                    startRender: function (rows, group) {
                        // Display the group name and the number of rows in that group
                        return group + " (" + rows.count() + " rows)";
                    },
                    // endRender: function (rows, group, level) {
                    //     // =======================================================
                    //     // OB ====================================================
                    //     // =======================================================
                    //     var day_rit_ob_count = rows
                    //     .data()
                    //     .pluck('day_rit_ob')
                    //     .reduce( function (a, b) {
                    //         return parseFloat(a) + parseFloat(b);
                    //     }, 0) ;
            
                    //     // var night_rit_ob_count = rows
                    //     // .data()
                    //     // .pluck('night_rit_ob')
                    //     // .reduce( function (a, b) {
                    //     //     return parseFloat(a) + parseFloat(b);
                    //     // }, 0) ;
            
                    //     // var total_rit_ob_count = rows
                    //     // .data()
                    //     // .pluck('total_rit_ob')
                    //     // .reduce( function (a, b) {
                    //     //     return parseFloat(a) + parseFloat(b);
                    //     // }, 0) ;

                    //     // var day_ob_count = rows
                    //     // .data()
                    //     // .pluck('day_ob')
                    //     // .reduce( function (a, b) {
                    //     //     return parseFloat(a) + parseFloat(b);
                    //     // }, 0) ;
            
                    //     // var night_ob_count = rows
                    //     // .data()
                    //     // .pluck('night_ob')
                    //     // .reduce( function (a, b) {
                    //     //     return parseFloat(a) + parseFloat(b);
                    //     // }, 0) ;

                    //     // var total_ob_count = rows
                    //     // .data()
                    //     // .pluck('total_ob')
                    //     // .reduce( function (a, b) {
                    //     //     return parseFloat(a) + parseFloat(b);
                    //     // }, 0) ;
                        
                        
                    //     // // =========================================================
                    //     // // Coal Getting ============================================
                    //     // // =========================================================
                    //     // var day_rit_cg_count = rows
                    //     // .data()
                    //     // .pluck('day_rit_cg')
                    //     // .reduce( function (a, b) {
                    //     //     return parseFloat(a) + parseFloat(b);
                    //     // }, 0) ;
            
                    //     // var night_rit_cg_count = rows
                    //     // .data()
                    //     // .pluck('night_rit_cg')
                    //     // .reduce( function (a, b) {
                    //     //     return parseFloat(a) + parseFloat(b);
                    //     // }, 0) ;

                    //     // var total_rit_cg_count = rows
                    //     // .data()
                    //     // .pluck('total_rit_cg')
                    //     // .reduce( function (a, b) {
                    //     //     return parseFloat(a) + parseFloat(b);
                    //     // }, 0) ;

                    //     // var day_cg_count = rows
                    //     // .data()
                    //     // .pluck('day_cg')
                    //     // .reduce( function (a, b) {
                    //     //     return parseFloat(a) + parseFloat(b);
                    //     // }, 0) ;
            
                    //     // var night_cg_count = rows
                    //     // .data()
                    //     // .pluck('night_cg')
                    //     // .reduce( function (a, b) {
                    //     //     return parseFloat(a) + parseFloat(b);
                    //     // }, 0) ;

                    //     // var total_cg_count = rows
                    //     // .data()
                    //     // .pluck('total_cg')
                    //     // .reduce( function (a, b) {
                    //     //     return parseFloat(a) + parseFloat(b);
                    //     // }, 0) ;
                        

                    //     // // =========================================================
                    //     // // Coal Hauling ============================================
                    //     // // =========================================================
                    //     // var day_rit_cl_count = rows
                    //     // .data()
                    //     // .pluck('day_rit_cl')
                    //     // .reduce( function (a, b) {
                    //     //     return parseFloat(a) + parseFloat(b);
                    //     // }, 0) ;
            
                    //     // var night_rit_cl_count = rows
                    //     // .data()
                    //     // .pluck('night_rit_cl')
                    //     // .reduce( function (a, b) {
                    //     //     return parseFloat(a) + parseFloat(b);
                    //     // }, 0) ;

                    //     // var total_rit_cl_count = rows
                    //     // .data()
                    //     // .pluck('total_rit_cl')
                    //     // .reduce( function (a, b) {
                    //     //     return parseFloat(a) + parseFloat(b);
                    //     // }, 0) ;

                    //     // var day_cl_count = rows
                    //     // .data()
                    //     // .pluck('day_cl')
                    //     // .reduce( function (a, b) {
                    //     //     return parseFloat(a) + parseFloat(b);
                    //     // }, 0) ;
            
                    //     // var night_cl_count = rows
                    //     // .data()
                    //     // .pluck('night_cl')
                    //     // .reduce( function (a, b) {
                    //     //     return parseFloat(a) + parseFloat(b);
                    //     // }, 0) ;

                    //     // var total_cl_count = rows
                    //     // .data()
                    //     // .pluck('total_cl')
                    //     // .reduce( function (a, b) {
                    //     //     return parseFloat(a) + parseFloat(b);
                    //     // }, 0) ;
                        
                    //     // // ===========================================================================
                    //     // var fuel_count = rows
                    //     // .data()
                    //     // .pluck('fuel')
                    //     // .reduce( function (a, b) {
                    //     //     return parseFloat(a) + parseFloat(b);
                    //     // }, 0) ;
            
                            
                    //     // if (level === 0) {
                    //     //     let tr = document.createElement('tr');
                    //     //     let classs = $ummu.dt.endRender_class();
                    //     //     $ummu.dt.addCell(tr, group, 2, classs);
                    //     //     $ummu.dt.addCell(tr, $ummu.helpers.currency.us(day_rit_ob_count),null,classs);
                    //     //     $ummu.dt.addCell(tr, $ummu.helpers.currency.us(night_rit_ob_count),null,classs);
                    //     //     $ummu.dt.addCell(tr, $ummu.helpers.currency.us(total_rit_ob_count),null,classs);
                    //     //     $ummu.dt.addCell(tr, $ummu.helpers.currency.us(day_ob_count),null,classs);
                    //     //     $ummu.dt.addCell(tr, $ummu.helpers.currency.us(night_ob_count),null,classs);
                    //     //     $ummu.dt.addCell(tr, $ummu.helpers.currency.us(total_ob_count),null,classs);

                    //     //     $ummu.dt.addCell(tr, $ummu.helpers.currency.us(day_rit_cg_count),null,classs);
                    //     //     $ummu.dt.addCell(tr, $ummu.helpers.currency.us(night_rit_cg_count),null,classs);
                    //     //     $ummu.dt.addCell(tr, $ummu.helpers.currency.us(total_rit_cg_count),null,classs);
                    //     //     $ummu.dt.addCell(tr, $ummu.helpers.currency.us(day_cg_count),null,classs);
                    //     //     $ummu.dt.addCell(tr, $ummu.helpers.currency.us(night_cg_count),null,classs);
                    //     //     $ummu.dt.addCell(tr, $ummu.helpers.currency.us(total_cg_count),null,classs);

                    //     //     $ummu.dt.addCell(tr, $ummu.helpers.currency.us(day_rit_cl_count),null,classs);
                    //     //     $ummu.dt.addCell(tr, $ummu.helpers.currency.us(night_rit_cl_count),null,classs);
                    //     //     $ummu.dt.addCell(tr, $ummu.helpers.currency.us(total_rit_cl_count),null,classs);
                    //     //     $ummu.dt.addCell(tr, $ummu.helpers.currency.us(day_cl_count),null,classs);
                    //     //     $ummu.dt.addCell(tr, $ummu.helpers.currency.us(night_cl_count),null,classs);
                    //     //     $ummu.dt.addCell(tr, $ummu.helpers.currency.us(total_cl_count),null,classs);                

                    //     //     $ummu.dt.addCell(tr, $ummu.helpers.currency.us(fuel_count),null,classs);
                    //     //     $ummu.dt.addCell(tr, '', 5, classs);
                    //     //     return tr;
                    //     // } else if (level === 1) {
                    //     //     let tr = document.createElement('tr');
                    //     //     let classs = 'text-right font-weight-bold bg-warning';
                    //     //     $ummu.dt.addCell(tr, '', 4);
                    //     //     $ummu.dt.addCell(tr, $ummu.helpers.currency.us(total_rit_ob_count),null,classs);
                    //     //     $ummu.dt.addCell(tr, '', 2);
                    //     //     $ummu.dt.addCell(tr, $ummu.helpers.currency.us(total_ob_count),null,classs);
                    //     //     $ummu.dt.addCell(tr, '', 2);
                    //     //     $ummu.dt.addCell(tr, $ummu.helpers.currency.us(total_rit_cg_count),null,classs);
                    //     //     $ummu.dt.addCell(tr, '', 2);
                    //     //     $ummu.dt.addCell(tr, $ummu.helpers.currency.us(total_cg_count),null,classs);
                    //     //     $ummu.dt.addCell(tr, '', 2);
                    //     //     $ummu.dt.addCell(tr, $ummu.helpers.currency.us(total_rit_cl_count),null,classs);
                    //     //     $ummu.dt.addCell(tr, '', 2);
                    //     //     $ummu.dt.addCell(tr, $ummu.helpers.currency.us(total_cl_count),null,classs);
                    //     //     $ummu.dt.addCell(tr, $ummu.helpers.currency.us(fuel_count),null,classs);
                    //     //     $ummu.dt.addCell(tr, '', 5);            
                    //     //     return tr;
                    //     // }      
                    // }
                };
                
                return myRowGroup;
            },
        },

        // =================================================================
        // START TABLE 2
        // =================================================================
        crew: {
            init: null,
        },

        init2: function(dataRow) {
            if ($ummu.dt.is_init(table2) == true) {
                $ummu.dt.init_destroy(app.dt.crew.init);
            }

            app.dt.crew.init = new DataTable(
                table2, {
                columns: [
                    // {
                    //     title: "ID",
                    //     data: "id",
                    //     className: "text-center",
                    //     render: function (data, type, row) {
                    //         return (
                    //             '<a href="javascript:void(0);"><div><span class="">' +
                    //             data +
                    //             '</span> <i class="fas fa-external-link-alt ml-2"></i></div></a>'
                    //         );
                    //     },
                    // },
                    { 
                        title: "Crew Id",
                        data: "employee_id",
                        orderable: false,
                        className: "text-center",
                        render: function (data, type, row) {
                            return (
                                '<a href="javascript:void(0);"><div><span class="">' +
                                data +
                                '</span> <i class="fas fa-external-link-alt ml-2"></i></div></a>'
                            );
                        },
                    },
                    { title: "Crew Name", data: "employee_name" },
                    { title: "Rank Code", data: "rank_code" },
                    { title: "Rank Name", data: "rank_name_id" },
                ],
                // createdRow: function(row, data, dataIndex) {
                //     // Ambil total jumlah data
                //     const totalRows = this.api().rows().count();

                //     // Cek jika baris pertama (index 0) 
                //     // atau baris terakhir (index totalRows - 1)
                //     if (dataIndex === 0 || dataIndex === totalRows - 1) {
                //         $(row).addClass('font-weight-bold');
                //     }
                // },
                data: dataRow,
                layout: {
                    topStart: {
                        buttons: [],
                    },
                },
                initComplete: function(settings, json) {
                    // 
                },
                drawCallback: function (settings) {
                    // var api = this.api();
                },
            });
        },
        // =================================================================
        // END TABLE 2
        // =================================================================
    },
};

$(document).ready(function () {
    app.config.autoload()
});