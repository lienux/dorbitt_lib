$ummu.vars.page_url = $base_url + 'admin/' + PHP_VARS.moduleKode + '/';
var table2 = $('#tbWaypoint')
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
            const rawWaypoint = $ummu.url.getParam('detail_waypoint');
            let initialData = [];

            if (rawWaypoint) {
                initialData = (typeof rawWaypoint === 'string') ? JSON.parse(rawWaypoint) : rawWaypoint;
            }

            // Jalankan init2 menggunakan data yang sebenarnya dari URL (bukan dipaksa [] kosong)
            app.dt.init2(initialData);
            // =================================================================

            // Pasang event penanganan tombol setelah inisialisasi siap
            if (app.dt.waypoint.init !== null) {
                $ummu.dt.layout.buttonDefaultAndCustom(app.dt.waypoint.init, ['btn_new']);
                app.dt.waypoint.init.button('#dt_btn_new').disable();
            }

            app.dt.waypoint.init.on("click", "tbody tr td:nth-child(1)", function () {
                var row = app.dt.waypoint.init.row(this).data();

                app.vars.id = row.id
                $("#waypoint_name").val(row.nama);
                $("#sequence").val(row.sequence);
                $("#lintang_sudut").val(row.lintang_sudut);
                $("#lintang_menit").val(row.lintang_menit);
                $("#lintang_arah").val(row.lintang_arah);
                $("#bujur_sudut").val(row.bujur_sudut);
                $("#bujur_menit").val(row.bujur_menit);
                $("#bujur_arah").val(row.bujur_arah);
                $("#haluan").val(row.haluan);
                $("#jarak").val(row.jarak_antar_titik);
                $("#total_jarak").val(row.total_jarak);

                $("#waypoint_modal_title").text('Form Edit Waypoint')
                $("#modalForm_inputWaypoint").modal('show');
                $("#modal_btnDelete_waypoint").removeClass('collapse')
            });

            $("#modal_btnSave_waypoint").on('click', function(){
                app.controllers.save_waypoint();
            });

            $("#modal_btnSave_hitungKoordinat").on('click', function(){
                // Pastikan sequence diubah menjadi tipe data Angka (Integer)
                const sequence = parseInt($("#sequence").val());

                const lintang_sudut = $("#lintang_sudut").val();
                const lintang_menit = $("#lintang_menit").val();
                const lintang_arah = $("#lintang_arah").val();
                const lintang = `${lintang_sudut}-${lintang_menit}${lintang_arah}`;

                const bujur_sudut = $("#bujur_sudut").val();
                const bujur_menit = $("#bujur_menit").val();
                const bujur_arah = $("#bujur_arah").val();
                const bujur = `${bujur_sudut}-${bujur_menit}${bujur_arah}`;

                // Ambil semua data rute dari URL
                const waypointData = JSON.parse($ummu.url.getParam('detail_waypoint')) || [];

                var lastRow = $ummu.func.findMaxDataByProperty(waypointData, 'sequence');
                
                var lat1 = null;
                var lon1 = null;

                if (app.vars.id)  {
                    console.log('Mode: Update Data');
                    
                    if (sequence !== 1) {
                        // PERBAIKAN: Cari waypoint SEBELUMNYA (sequence - 1) di dalam array
                        var prevSequence = sequence - 1;
                        var prevRow = waypointData.find(function(item) {
                            return parseInt(item.sequence) === prevSequence;
                        });

                        if (prevRow) {
                            jarak1 = prevRow.total_jarak;
                            lat1 = $ummu.gps.parseToDD(prevRow.lintang).toFixed(5);
                            lon1 = $ummu.gps.parseToDD(prevRow.bujur).toFixed(5);
                        } else {
                            console.error('⚠️ Waypoint sebelumnya (Seq ' + prevSequence + ') tidak ditemukan di URL!');
                        }
                    }
                } else {
                    console.log('Mode: New Data');
                    // Jika data baru, koordinat asal diambil dari waypoint terakhir (max sequence)
                    if (lastRow) {
                        jarak1 = lastRow.total_jarak;
                        lat1 = $ummu.gps.parseToDD(lastRow.lintang).toFixed(5);
                        lon1 = $ummu.gps.parseToDD(lastRow.bujur).toFixed(5);
                    }
                }
                
                const lat2 = $ummu.gps.parseToDD(lintang).toFixed(5);
                const lon2 = $ummu.gps.parseToDD(bujur).toFixed(5);

                // Paksa konversi ke angka murni desimal
                var nLat1 = parseFloat(lat1);
                var nLon1 = parseFloat(lon1);
                var nLat2 = parseFloat(lat2);
                var nLon2 = parseFloat(lon2);

                if (sequence !== 1) {
                    console.log('MASUK BLOK PERHITUNGAN (sequence != 1)');
                    console.log('Titik Asal (Seq ' + (sequence - 1) + '):', nLat1, nLon1);
                    console.log('Titik Tujuan Baru (Seq ' + sequence + '):', nLat2, nLon2);
                    
                    // Validasi jika koordinat kosong atau bukan angka
                    if (isNaN(nLat1) || isNaN(nLon1) || isNaN(nLat2) || isNaN(nLon2)) {
                        console.error('⚠️ Error: Ada koordinat yang tidak valid / NaN!');
                        var haluan = 0;
                        var jarak = 0;
                        var total_jarak = 0;
                    } else {
                        var haluan = Math.round($ummu.gps.calculateBearing(nLat1, nLon1, nLat2, nLon2));
                        var jarak = Math.round($ummu.gps.calculateDistance(nLat1, nLon1, nLat2, nLon2));
                        var total_jarak =  parseFloat(jarak) + parseFloat(jarak1);
                    }
                    
                    console.log('Hasil Haluan Hitung:', haluan);
                    console.log('Hasil Jarak Hitung:', jarak);
                    console.log('Hasil Total Jarak Hitung:', total_jarak);
                } else {
                    console.log('MASUK BLOK ELSE (sequence == 1), NILAI OTOMATIS 0');
                    var haluan = 0;
                    var jarak = 0;
                    var total_jarak = 0;
                }

                $("#haluan").val(haluan).prop('disabled', false);
                $("#jarak").val(jarak).prop('disabled', false);
                $("#total_jarak").val(total_jarak).prop('disabled', false);
            });

            $("#modal_btnDelete_waypoint").on('click', function(){
                if (app.vars.id !== null) {
                    app.controllers.delete_waypoint(app.vars.id)
                }else{
                    console.log('ID not found on app.vars.id')
                }
            })
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
        },

        sbSave: function () {
            var name = $("#name").val();
            var from_id = $("#port_of_loading").attr('data-id');
            var to_id = $("#port_of_discharge").attr('data-id');

            $ummu.vars.formData.append("name", name);
            $ummu.vars.formData.append("from_id", from_id);
            $ummu.vars.formData.append("to_id", to_id);

            var payload = {
                "name": name,
                "from_id": from_id,
                "to_id": to_id,
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
                $ummu.views.errors_msg(validation) //string or array
                $(".btn-endis").removeClass('btn-outline-secondary').addClass('btn-primary')
            }else{
                var ummu = $ummu.ajax.ummu7(params);   
                ummu.done(function(result) {
                    const response = JSON.parse(result);
                    $ummu.views.after_sbToolbar_save(response, func, id, payload);
                }).fail(function() {
                    // An error occurred
                    console.log(ummu)
                });
            }
        },

        sbCancle: function () {
            app.dt.waypoint.init.button('#dt_btn_new').disable();
            if ($ummu.url.getParam('id')) {
                // 
            }else{
                app.views.forClear()
            }
        },

        sbEdit: function () {
            app.dt.waypoint.init.button('#dt_btn_new').enable();
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
            if (id == 'port_of_loading' || id == 'port_of_discharge') {
                $ummu.url.setParam('set_to_id', id);
                $ummu.controllers.show_pelabuhan(id);
            } else{
                //
            }
        },

        on_btn_getData_click: function () {
            $ummu.views.after_sbToolbar_getData();
            app.views.forClear()
        },

        on_click_tbody_trtd_child_pelabuhan: function(row) {
            // console.log(row)
            var set_to_id = $ummu.url.getParam('set_to_id');

            if (set_to_id == 'port_of_loading' && $("#port_of_discharge").attr('data-id') == row.id) {
                let msg = "Has been used for Discharge.";
                $ummu.views.errors_msg(msg) //string or array
            }else if (set_to_id == 'port_of_discharge' && $("#port_of_loading").attr('data-id') == row.id) {
                let msg = "Has been used for Loading.";
                $ummu.views.errors_msg(msg) //string or array
            } else{
                $("#"+set_to_id).val(row.name).attr('data-id', row.id);
                $ummu.url.delParam('set_to_id');
            }
        },

        on_dtBtnNew_click: function() {
            app.vars.id = null
            $("#waypoint_modal_title").text('Form Input Waypoint')
            $("#modalForm_inputWaypoint input").val('')
            $("#modalForm_inputWaypoint").modal('show')
            $("#modal_btnDelete_waypoint").addClass('collapse')
        },

        save_waypoint: function(id) {
            // 1. WAJIB: Reset global FormData agar data tidak menumpuk saat tombol diklik berulang kali
            $ummu.vars.formData = new FormData(); 

            // 2. Ambil parameter dasar dari URL dan status aplikasi
            const rute_id = $ummu.url.getParam("id");
            const is_update = (app.vars.id !== null); // Menentukan mode Insert atau Update

            // 3. Otomatisasi pembacaan field (Lebih bersih daripada menulis .val() & .append() satu per satu)
            const fields = [
                "waypoint_name", "sequence", "lintang_sudut", "lintang_menit", 
                "lintang_arah", "bujur_sudut", "bujur_menit", "bujur_arah", 
                "haluan", "jarak", "total_jarak"
            ];

            fields.forEach(field => {
                let value = $(`#${field}`).val();
                // Kondisi khusus: 'waypoint_name' di-append dengan key 'name' sesuai kebutuhan backend
                let key = (field === 'waypoint_name') ? 'name' : field;
                $ummu.vars.formData.append(key, value);
            });

            // Tambahkan data relasi rute_id
            $ummu.vars.formData.append("rute_id", rute_id);

            // 4. Set Route Function dan Method Spoofing untuk CodeIgniter 4
            if (!is_update) {
                // Mode Insert Data (POST)
                $ummu.ajax.function = "waypoint";
            } else {
                // Mode Update Data (PUT Spoofing)
                // Menambahkan parameter _method agar dibaca sebagai PUT oleh CodeIgniter 4
                $ummu.vars.formData.append("_method", "PUT");
                $ummu.ajax.function = `waypoint/${app.vars.id}`;
            }

            // 5. Jalankan Validasi Sisi Klien
            const validation = app.validation.save_waypoint();

            if (validation.length > 0) {
                $ummu.views.errors_msg(validation); // Tampilkan pesan error jika ada field kosong
                return; // Hentikan eksekusi script
            }

            // 6. Eksekusi request AJAX melalui library ummu.js
            var params = {
                "data": $ummu.vars.formData,
                "loader": true,
            };

            var ummu = $ummu.ajax.ummu7b(params);   
            
            ummu.done(function(result) {
                // Mengamankan parsing data jika response dari server sudah berupa objek otomatis
                const response = (typeof result === 'string') ? JSON.parse(result) : result;
                
                if (response.status === true) {
                    // Tutup Modal Form Input
                    $("#modalForm_inputWaypoint").modal("hide");

                    // Update parameter detail_waypoint di URL
                    const detail_waypoint = JSON.stringify(response.rows);
                    $ummu.url.setParam('detail_waypoint', detail_waypoint);

                    // Sinkronisasi data ke localStorage
                    // 1. itemName = voyage_route
                    // 2. 
                    // 3. keyName = detail_waypoint
                    // 4. rows = response.rwos
                    $ummu.localStorage.controllers.updateParam_byID2('voyage_route', rute_id, 'detail_waypoint', response.rows);

                    // Refresh tampilan Datatables secara real-time
                    if (app.dt.waypoint && app.dt.waypoint.init) {
                        app.dt.waypoint.init.clear().rows.add(response.rows).draw();
                    }
                } else {
                    // Tampilkan pesan error kiriman dari validasi backend server
                    $ummu.views.errors_msg(response.errors || "Terjadi kesalahan sistem saat menyimpan data.");
                }
            }).fail(function(xhr) {
                console.error("AJAX Error Response:", xhr.responseText);
                $ummu.views.errors_msg("Gagal terhubung dengan server. Silahkan periksa koneksi internet Anda.");
            });
        },

        delete_waypoint: function(id) {
            $("#modalForm_inputWaypoint").modal('hide')

            var rute_id = $ummu.url.getParam('id');

            $ummu.vars.formData = new FormData();
            $ummu.vars.formData.append("_method", "DELETE");
            $ummu.vars.formData.append("rute_id", rute_id);
            $ummu.ajax.function = `waypoint/${id}`;

            var params = {
                "data": $ummu.vars.formData,
                "loader": true,
                "textLoader": "Delete on progress..."
            };

            var ummu = $ummu.ajax.ummu7b(params);   
            ummu.done(function(result) {
                // Mengamankan parsing data jika response dari server sudah berupa objek otomatis
                const response = (typeof result === 'string') ? JSON.parse(result) : result;

                if (response.status == true) {
                    // Update parameter detail_waypoint di URL
                    const detail_waypoint = JSON.stringify(response.rows);
                    $ummu.url.setParam('detail_waypoint', detail_waypoint);

                    // Sinkronisasi data ke localStorage
                    // 1. itemName = voyage_route
                    // 2. 
                    // 3. keyName = detail_waypoint
                    // 4. rows = response.rwos
                    $ummu.localStorage.controllers.updateParam_byID2('voyage_route', rute_id, 'detail_waypoint', response.rows);

                    // Refresh tampilan Datatables secara real-time
                    if (app.dt.waypoint && app.dt.waypoint.init) {
                        app.dt.waypoint.init.clear().rows.add(response.rows).draw();
                    }

                    $(".sb-toolbar #modalSuccessMessage #alert").html("");
                    $(".sb-toolbar #modalSuccessMessage #alert").html(response.message);
                    $(".sb-toolbar #modalSuccessMessage").modal("show");
                }else{
                    // Tampilkan pesan error kiriman dari validasi backend server
                    $ummu.views.errors_msg(response.errors || "Terjadi kesalahan sistem saat hapus data.");
                }
            }).fail(function(xhr) {
                console.error("AJAX Error Response:", xhr.responseText);
                $ummu.views.errors_msg("Gagal terhubung dengan server. Silahkan periksa koneksi internet Anda.");
            });
        },
    },

    validation: {
        save: function() {
            var list = [];
            list = $ummu.validation.inputValidate3();

            return list;
        },

        save_waypoint: function() {
            var list = [];
            list = $ummu.validation.inputValidate4('modalForm_inputWaypoint');

            return list;
        }
    },

    views: {
        formParams: function() {
            return $("#form_input .endis");
        },

        setRow_toForm: function(row) {
            // console.log(JSON.parse(row.detail_waypoint))

            $ummu.views.tab_content('setRow_toForm')

            $("#name").val(row.name)
            $("#port_of_loading").val(row.from_name).attr('data-id', row.from_id)
            $("#port_of_discharge").val(row.to_name).attr('data-id', row.to_id)


            $ummu.views.setIdentitiyToForm(row)
            $ummu.button.sbBtn_on_showData()
            
            // // setTimeout(() => {
            // if (app.dt.waypoint.init) {
            //     if ($ummu.url.getParam('detail_waypoint')) {
            //         const detail_waypoint = JSON.parse($ummu.url.getParam('detail_waypoint'));
            //         // console.log("Eksekusi setelah 2 detik");
            //         app.dt.waypoint.init.clear().rows.add(detail_waypoint).draw();
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
            //     if (app.dt.waypoint && app.dt.waypoint.init != null) {
            //         // JIKA SUDAH SELESAI: Langsung bersihkan dan masukkan data baru
            //         app.dt.waypoint.init.clear().rows.add(parsedData).draw();
            //         console.log('app.dt.waypoint && app.dt.waypoint.init != null')
            //     } else {
            //         // JIKA BELUM SELESAI / MASIH NULL: 
            //         // Jangan panggil .clear(), tapi langsung hancurkan cetakan lama 
            //         // dan buat objek DataTable utuh langsung bersama datanya!
            //         app.dt.init2(parsedData);
            //         console.log('else')
            //     }
            // }

            const rawWaypoint = $ummu.url.getParam('detail_waypoint');
        
            if (rawWaypoint) {
                const parsedData = (typeof rawWaypoint === 'string') ? JSON.parse(rawWaypoint) : rawWaypoint;
                
                // Cukup gunakan pengaman ini saja. Jika belum siap, abaikan karena 
                // pembuatan tabel pada Langkah 1 di atas pasti akan menampilkannya.
                if (app.dt.waypoint && app.dt.waypoint.init !== null) {
                    app.dt.waypoint.init.clear().rows.add(parsedData).draw();
                }
            }
        },

        forClear: function() {
            $("#form_input input").val('');
            // $("#status, #uom").html('')

            if (app.dt.waypoint.init.rows().count() > 0) {
                app.dt.waypoint.init.clear().draw();
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
                    { 
                        title: "Name",
                        data: "name"
                    },
                    { 
                        title: "Port of Loading",
                        data: "from_name"
                    },
                    { 
                        title: "Port of Discharge",
                        data: "to_name"
                    },
                    { 
                        title: "Distance",
                        data: "distance"
                    },
                ];
        
                return columns;
            },
            onClick_nthChild_2: function(row) {
                // 1. Tambahkan url param dari row
                $ummu.url.setParamFromRow(row)

                // 2. Ubah bagian array (detail_waypoint) menjadi string JSON
                // Karena URL params tidak mendukung struktur nested secara native
                const detail_waypoint = JSON.stringify(row.detail_waypoint);

                // 3. Masukkan ke URLSearchParams
                // const params = new URLSearchParams(formattedData);
                $ummu.url.setParam('detail_waypoint', detail_waypoint);

                // $ummu.vars.is_row = true;
                // app.controllers.detail(row);
                // app.views.setRow_toForm(row);

                app.views.setRow_toForm(row);
                $ummu.views.tab_content('setRow_toForm')

                // console.log(row)
            },
            rowGroup: function() {
                // // contoh:
                // var myRowGroup = {
                //     dataSrc: ["tipe","unit_code"],
                //     startRender: function (rows, group) {
                //         // Display the group name and the number of rows in that group
                //         return group + " (" + rows.count() + " rows)";
                //     },
                //     endRender: function (rows, group, level) {
                //         // =======================================================
                //         // OB ====================================================
                //         // =======================================================
                //         var day_rit_ob_count = rows
                //         .data()
                //         .pluck('day_rit_ob')
                //         .reduce( function (a, b) {
                //             return parseFloat(a) + parseFloat(b);
                //         }, 0) ;
            
                //         var night_rit_ob_count = rows
                //         .data()
                //         .pluck('night_rit_ob')
                //         .reduce( function (a, b) {
                //             return parseFloat(a) + parseFloat(b);
                //         }, 0) ;
            
                //         var total_rit_ob_count = rows
                //         .data()
                //         .pluck('total_rit_ob')
                //         .reduce( function (a, b) {
                //             return parseFloat(a) + parseFloat(b);
                //         }, 0) ;

                //         var day_ob_count = rows
                //         .data()
                //         .pluck('day_ob')
                //         .reduce( function (a, b) {
                //             return parseFloat(a) + parseFloat(b);
                //         }, 0) ;
            
                //         var night_ob_count = rows
                //         .data()
                //         .pluck('night_ob')
                //         .reduce( function (a, b) {
                //             return parseFloat(a) + parseFloat(b);
                //         }, 0) ;

                //         var total_ob_count = rows
                //         .data()
                //         .pluck('total_ob')
                //         .reduce( function (a, b) {
                //             return parseFloat(a) + parseFloat(b);
                //         }, 0) ;
                        
                        
                //         // =========================================================
                //         // Coal Getting ============================================
                //         // =========================================================
                //         var day_rit_cg_count = rows
                //         .data()
                //         .pluck('day_rit_cg')
                //         .reduce( function (a, b) {
                //             return parseFloat(a) + parseFloat(b);
                //         }, 0) ;
            
                //         var night_rit_cg_count = rows
                //         .data()
                //         .pluck('night_rit_cg')
                //         .reduce( function (a, b) {
                //             return parseFloat(a) + parseFloat(b);
                //         }, 0) ;

                //         var total_rit_cg_count = rows
                //         .data()
                //         .pluck('total_rit_cg')
                //         .reduce( function (a, b) {
                //             return parseFloat(a) + parseFloat(b);
                //         }, 0) ;

                //         var day_cg_count = rows
                //         .data()
                //         .pluck('day_cg')
                //         .reduce( function (a, b) {
                //             return parseFloat(a) + parseFloat(b);
                //         }, 0) ;
            
                //         var night_cg_count = rows
                //         .data()
                //         .pluck('night_cg')
                //         .reduce( function (a, b) {
                //             return parseFloat(a) + parseFloat(b);
                //         }, 0) ;

                //         var total_cg_count = rows
                //         .data()
                //         .pluck('total_cg')
                //         .reduce( function (a, b) {
                //             return parseFloat(a) + parseFloat(b);
                //         }, 0) ;
                        

                //         // =========================================================
                //         // Coal Hauling ============================================
                //         // =========================================================
                //         var day_rit_cl_count = rows
                //         .data()
                //         .pluck('day_rit_cl')
                //         .reduce( function (a, b) {
                //             return parseFloat(a) + parseFloat(b);
                //         }, 0) ;
            
                //         var night_rit_cl_count = rows
                //         .data()
                //         .pluck('night_rit_cl')
                //         .reduce( function (a, b) {
                //             return parseFloat(a) + parseFloat(b);
                //         }, 0) ;

                //         var total_rit_cl_count = rows
                //         .data()
                //         .pluck('total_rit_cl')
                //         .reduce( function (a, b) {
                //             return parseFloat(a) + parseFloat(b);
                //         }, 0) ;

                //         var day_cl_count = rows
                //         .data()
                //         .pluck('day_cl')
                //         .reduce( function (a, b) {
                //             return parseFloat(a) + parseFloat(b);
                //         }, 0) ;
            
                //         var night_cl_count = rows
                //         .data()
                //         .pluck('night_cl')
                //         .reduce( function (a, b) {
                //             return parseFloat(a) + parseFloat(b);
                //         }, 0) ;

                //         var total_cl_count = rows
                //         .data()
                //         .pluck('total_cl')
                //         .reduce( function (a, b) {
                //             return parseFloat(a) + parseFloat(b);
                //         }, 0) ;
                        
                //         // ===========================================================================
                //         var fuel_count = rows
                //         .data()
                //         .pluck('fuel')
                //         .reduce( function (a, b) {
                //             return parseFloat(a) + parseFloat(b);
                //         }, 0) ;
            
                            
                //         if (level === 0) {
                //             let tr = document.createElement('tr');
                //             let classs = $ummu.dt.endRender_class();
                //             $ummu.dt.addCell(tr, group, 2, classs);
                //             $ummu.dt.addCell(tr, $ummu.helpers.currency.us(day_rit_ob_count),null,classs);
                //             $ummu.dt.addCell(tr, $ummu.helpers.currency.us(night_rit_ob_count),null,classs);
                //             $ummu.dt.addCell(tr, $ummu.helpers.currency.us(total_rit_ob_count),null,classs);
                //             $ummu.dt.addCell(tr, $ummu.helpers.currency.us(day_ob_count),null,classs);
                //             $ummu.dt.addCell(tr, $ummu.helpers.currency.us(night_ob_count),null,classs);
                //             $ummu.dt.addCell(tr, $ummu.helpers.currency.us(total_ob_count),null,classs);

                //             $ummu.dt.addCell(tr, $ummu.helpers.currency.us(day_rit_cg_count),null,classs);
                //             $ummu.dt.addCell(tr, $ummu.helpers.currency.us(night_rit_cg_count),null,classs);
                //             $ummu.dt.addCell(tr, $ummu.helpers.currency.us(total_rit_cg_count),null,classs);
                //             $ummu.dt.addCell(tr, $ummu.helpers.currency.us(day_cg_count),null,classs);
                //             $ummu.dt.addCell(tr, $ummu.helpers.currency.us(night_cg_count),null,classs);
                //             $ummu.dt.addCell(tr, $ummu.helpers.currency.us(total_cg_count),null,classs);

                //             $ummu.dt.addCell(tr, $ummu.helpers.currency.us(day_rit_cl_count),null,classs);
                //             $ummu.dt.addCell(tr, $ummu.helpers.currency.us(night_rit_cl_count),null,classs);
                //             $ummu.dt.addCell(tr, $ummu.helpers.currency.us(total_rit_cl_count),null,classs);
                //             $ummu.dt.addCell(tr, $ummu.helpers.currency.us(day_cl_count),null,classs);
                //             $ummu.dt.addCell(tr, $ummu.helpers.currency.us(night_cl_count),null,classs);
                //             $ummu.dt.addCell(tr, $ummu.helpers.currency.us(total_cl_count),null,classs);                

                //             $ummu.dt.addCell(tr, $ummu.helpers.currency.us(fuel_count),null,classs);
                //             $ummu.dt.addCell(tr, '', 5, classs);
                //             return tr;
                //         } else if (level === 1) {
                //             let tr = document.createElement('tr');
                //             let classs = 'text-right font-weight-bold bg-warning';
                //             $ummu.dt.addCell(tr, '', 4);
                //             $ummu.dt.addCell(tr, $ummu.helpers.currency.us(total_rit_ob_count),null,classs);
                //             $ummu.dt.addCell(tr, '', 2);
                //             $ummu.dt.addCell(tr, $ummu.helpers.currency.us(total_ob_count),null,classs);
                //             $ummu.dt.addCell(tr, '', 2);
                //             $ummu.dt.addCell(tr, $ummu.helpers.currency.us(total_rit_cg_count),null,classs);
                //             $ummu.dt.addCell(tr, '', 2);
                //             $ummu.dt.addCell(tr, $ummu.helpers.currency.us(total_cg_count),null,classs);
                //             $ummu.dt.addCell(tr, '', 2);
                //             $ummu.dt.addCell(tr, $ummu.helpers.currency.us(total_rit_cl_count),null,classs);
                //             $ummu.dt.addCell(tr, '', 2);
                //             $ummu.dt.addCell(tr, $ummu.helpers.currency.us(total_cl_count),null,classs);
                //             $ummu.dt.addCell(tr, $ummu.helpers.currency.us(fuel_count),null,classs);
                //             $ummu.dt.addCell(tr, '', 5);            
                //             return tr;
                //         }          
                //     }
                // };
                
                // return myRowGroup;
            },
        },

        // =================================================================
        // START TABLE 2
        // =================================================================
        waypoint: {
            init: null,
        },

        init2: function(waypoint_rows) {
            if ($ummu.dt.is_init(table2) == true) {
                $ummu.dt.init_destroy(app.dt.waypoint.init);
            }

            app.dt.waypoint.init = new DataTable(
                table2, {
                columns: [
                    // {
                    //     data: null,
                    //     render: function (data, type, row) {
                    //         return (`<a href="#"><i class="fas fa-edit"></i></a>`);
                    //     },
                    // },
                    {
                        title: "ID",
                        data: "id",
                        className: "text-center",
                        render: function (data, type, row) {
                            return (
                                '<a href="javascript:void(0);"><div><span class="">' +
                                data +
                                '</span> <i class="fas fa-external-link-alt ml-2"></i></div></a>'
                            );
                        },
                    },
                    { 
                        title: "Sequence", 
                        data: "sequence",
                        className: "text-center"
                    },
                    { title: "Name", data: "nama" },
                    { title: "Latitude", data: "lintang" },
                    { title: "Longitude", data: "bujur" },
                    { title: "Course (°T)", data: "haluan" },
                    { title: "Distance between points (NM)", data: "jarak_antar_titik" },
                    { title: "Total distance (NM)", data: "total_jarak" },
                ],
                createdRow: function(row, data, dataIndex) {
                    // Ambil total jumlah data
                    const totalRows = this.api().rows().count();

                    // Cek jika baris pertama (index 0) 
                    // atau baris terakhir (index totalRows - 1)
                    if (dataIndex === 0 || dataIndex === totalRows - 1) {
                        $(row).addClass('font-weight-bold');
                    }
                },
                data: waypoint_rows,
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