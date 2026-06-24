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

            app.dt.init2([])
            setTimeout(() => {
                $ummu.dt.layout.buttonDefaultAndCustom(app.dt.waypoint.init, ['btn_new']);
                app.dt.waypoint.init.button('#dt_btn_new').disable();
            }, 1000); // 2000 ms = 2 detik


            $ummu.dt.init.on("click", "tbody tr td:nth-child(2)", function () {
                var row = $ummu.dt.init.row(this).data();
                // console.log(row)
                
                $ummu.url.setParamFromRow(row)

                // 2. Ubah bagian array (detail_waypoint) menjadi string JSON
                // Karena URL params tidak mendukung struktur nested secara native
                const detail_waypoint = JSON.stringify(row.detail_waypoint);

                // 3. Masukkan ke URLSearchParams
                // const params = new URLSearchParams(formattedData);
                $ummu.url.setParam('detail_waypoint', detail_waypoint);

                // $ummu.vars.is_row = true;
                // app.controllers.detail(row);
                app.views.setRow_toForm(row);
            });

            $("#modal_btnSave_waypoint").on('click', function(){
                // console.log('ok')
                app.controllers.save_waypoint();
            });

            $("#modal_btnSave_hitungKoordinat").on('click', function(){
                const rowCurrent = $ummu.func.findMaxDataByProperty(JSON.parse($ummu.url.getParam('detail_waypoint')),'sequence');

                // const lat1 = $ummu.gps.parseToDD("03-03.500S").toFixed(5);
                // const lon1 = $ummu.gps.parseToDD("115-09.000E").toFixed(5);

                // const lat2 = $ummu.gps.parseToDD("03-36.000S").toFixed(5);
                // const lon2 = $ummu.gps.parseToDD("114-28.000E").toFixed(5);

                // const lat1 = $ummu.gps.parseToDD("03-03.500S");
                // const lon1 = $ummu.gps.parseToDD("115-09.000E");
                // const lat2 = $ummu.gps.parseToDD("03-36.000S");
                // const lon2 = $ummu.gps.parseToDD("114-28.000E");

                const lat1 = $ummu.gps.parseToDD(rowCurrent.lintang).toFixed(5);
                const lon1 = $ummu.gps.parseToDD(rowCurrent.bujur).toFixed(5);
                
                const lat2 = $ummu.gps.parseToDD("03-36.000S").toFixed(5);
                const lon2 = $ummu.gps.parseToDD("114-28.000E").toFixed(5);


                const jarak = Math.round($ummu.gps.calculateDistance(lat1,lon1,lat2,lon2));
                const haluan = Math.round($ummu.gps.calculateBearing(lat1,lon1,lat2,lon2));

                $("#haluan").val(haluan).prop('disabled', false)
                $("#jarak").val(jarak).prop('disabled', false)
            })
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
            // var kondisiBerlayar = $("#sailing_conditions").val();

            // if (kondisiBerlayar == "" || kondisiBerlayar == null) {
            //     $ummu.views.errors_msg("Silahkan pilih Conditions terlebih dahulu.");
            // }else{
                $("#modalForm_inputWaypoint").modal('show');
            // }
        },

        save_waypoint: function() {
            const rute_id = $ummu.url.getParam("id");
            const waypoint_name = $("#waypoint_name").val();
            const sequence = $("#sequence").val();

            const lintang_sudut = $("#lintang_sudut").val();
            const lintang_menit = $("#lintang_menit").val();
            const lintang_arah = $("#lintang_arah").val();

            const bujur_sudut = $("#bujur_sudut").val();
            const bujur_menit = $("#bujur_menit").val();
            const bujur_arah = $("#bujur_arah").val();

            const haluan = $("#haluan").val();
            const jarak = $("#jarak").val();

            const payload = {
                "rute_id": rute_id,
                "name": waypoint_name,
                "sequence": sequence,
                // "lintang": lintang+'-'+lintang_menit+arah_sn,
                // "bujur": bujur+'-'+bujur_menit+arah_ew,
                "lintang_sudut" : lintang_sudut,
                "lintang_menit" : lintang_menit,
                "lintang_arah" : lintang_arah,

                "bujur_sudut" : bujur_sudut,
                "bujur_menit" : bujur_menit,
                "bujur_arah" : bujur_arah,

                "haluan": haluan,
                "jarak": jarak,
            };

            // console.log(payload)

            $ummu.vars.formData.append("rute_id", rute_id);
            $ummu.vars.formData.append("name", waypoint_name);
            $ummu.vars.formData.append("sequence", sequence);

            $ummu.vars.formData.append("lintang_sudut", lintang_sudut);
            $ummu.vars.formData.append("lintang_menit", lintang_menit);
            $ummu.vars.formData.append("lintang_arah", lintang_arah);

            $ummu.vars.formData.append("bujur_sudut", bujur_sudut);
            $ummu.vars.formData.append("bujur_menit", bujur_menit);
            $ummu.vars.formData.append("bujur_arah", bujur_arah);

            $ummu.vars.formData.append("haluan", haluan);
            $ummu.vars.formData.append("jarak", jarak);

            var params = {
                "function": "create-waypoint",
                "data": $ummu.vars.formData,
                "loader": true,
            };

            const validation = app.validation.save();

            if (validation.length > 0) {
                $ummu.views.errors_msg(validation) //string or array
            }else{
                var ummu = $ummu.ajax.ummu7(params);   
                ummu.done(function(result) {
                    // console.log(result)
                    const response = JSON.parse(result);
                    // $ummu.views.after_sbToolbar_save(response, func, id, payload);
                    $("#modalForm_inputWaypoint").modal("hide")
                    if (response.status == true) {
                        // update param pada url
                        const detail_waypoint = JSON.stringify(response.rows);
                        $ummu.url.setParam('detail_waypoint', detail_waypoint);

                        // update data pada localStorage
                        $ummu.localStorage.controllers.updateParam_byID2('voyage_route', rute_id, 'detail_waypoint', response.rows)

                        // update data pada datatable
                        app.dt.waypoint.init.clear().rows.add(response.rows).draw()
                    }else{
                        $ummu.views.errors_msg(response.errors)
                    }
                }).fail(function() {
                    // An error occurred
                    console.log(ummu)
                });
            }
        },
    },

    validation: {
        save: function() {
            var list = [];
            list = $ummu.validation.inputValidate3();

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
            
            setTimeout(() => {
                if ($ummu.url.getParam('detail_waypoint')) {
                    const detail_waypoint = JSON.parse($ummu.url.getParam('detail_waypoint'));
                    // console.log("Eksekusi setelah 2 detik");
                    app.dt.waypoint.init.clear().rows.add(detail_waypoint).draw();
                }
            }, 1000); // 2000 ms = 2 detik
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
        },

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
            });
        },
    },
};

$(document).ready(function () {
    app.config.autoload()
});




const waypoints = [
    { name: "WP 01", lat: -3.24167, lon: 114.73667 }, // Konversi dari 03°14.500' S / 114°44.200' E
    { name: "WP 02", lat: -3.38333, lon: 114.52500 },
    // ... masukkan titik lainnya
];

function calculateDistance(lat1, lon1, lat2, lon2) {
    const R = 3440.065; // Radius bumi dalam Nautical Miles (NM)
    const dLat = (lat2 - lat1) * Math.PI / 180;
    const dLon = (lon2 - lon1) * Math.PI / 180;
    
    const a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
              Math.cos(lat1 * Math.PI / 180) * Math.cos(lat2 * Math.PI / 180) *
              Math.sin(dLon / 2) * Math.sin(dLon / 2);
    const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
    return R * c; // Hasil dalam NM
}

function calculateBearing(lat1, lon1, lat2, lon2) {
    const y = Math.sin((lon2 - lon1) * Math.PI / 180) * Math.cos(lat2 * Math.PI / 180);
    const x = Math.cos(lat1 * Math.PI / 180) * Math.sin(lat2 * Math.PI / 180) -
              Math.sin(lat1 * Math.PI / 180) * Math.cos(lat2 * Math.PI / 180) * 
              Math.cos((lon2 - lon1) * Math.PI / 180);
    const brng = (Math.atan2(y, x) * 180 / Math.PI + 360) % 360;
    return brng; // Hasil dalam derajat (True North)
}

// Loop untuk total jarak
let totalDistance = 0;
for (let i = 0; i < waypoints.length - 1; i++) {
    let dist = calculateDistance(waypoints[i].lat, waypoints[i].lon, waypoints[i+1].lat, waypoints[i+1].lon);
    totalDistance += dist;
    console.log(`${waypoints[i].name} ke ${waypoints[i+1].name}: ${dist.toFixed(2)} NM`);
}
console.log(`Total Jarak: ${totalDistance.toFixed(2)} NM`);