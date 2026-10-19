var app = {
    register: function () {
        app.config.autoload()
    },

    config: {
        autoload: function () {
            $ummu.func.location_hash();
            $ummu.config.datepicker()
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
            // Personal
            const full_name = $("#full_name").val();
            const seafarer_code = $('#seafarer_code').val();
            const tempat_lahir = $("#birth_place").val();
            const tanggal_lahir = $("#birth_date").val();
            const gender = $('#gender').val();
            const golongan_darah = $("#blood_type").val();
            const phone_number = $("#phone_number").val();
            const email = $("#email").val();
            const address = $("#address").val();

            // Identitas Resmi
            const national_id_number = $('#national_id_number').val();
            const family_card_number = $('#family_card_number').val();
            const tax_id_number = $('#tax_id_number').val();

            // Kesehatan & Komersial
            const vaccination_info = $('#vaccination_info').val();

            // Jabatan & Penempatan
            const tugboat_id = $("#tugboat").data('id');
            const base_rank_id = $("#crew_ranks").data('id');
            const employment_status = $("#employment_status").val();

            // Sertifikat COC
            const highest_coc_certificate = $("#highest_coc_certificate").val();
            const coc_certificate_number = $("#coc_certificate_number").val();
            const coc_expiry_date = $("#coc_expiry_date").val();
            
            // Buku Pelaut & MCU
            const seaman_book_number = $("#seaman_book_number").val();
            const seaman_book_expiry = $("#seaman_book_expiry").val();
            const mcu_maritime_number = $("#mcu_maritime_number").val();
            const mcu_maritime_expiry = $("#mcu_maritime_expiry").val();

            // Paspor & Berkas
            const passport_number = $("#passport_number").val();
            const passport_expiry = $("#passport_expiry").val();
            const crew_document_pdf = $("#crew_document_pdf")[0].files[0];

            // Status & Penempatan
            const current_crew_status = $("#current_crew_status").val();
            const sign_on_place = $("#sign_on_place").val();
            const sign_on_date = $("#sign_on_date").val();
            const sign_off_place = $("#sign_off_place").val();
            const sign_off_date = $("#sign_off_date").val();

            // Perlengkapan & Catatan
            const wearpack_size = $("#wearpack_size").val();
            const safety_shoes_size = $("#safety_shoes_size").val();
            const remarks = $("#remarks").val();

            // =============================================================
            // =============================================================
            // =============================================================
            $ummu.vars.formData = new FormData();
            $ummu.vars.formData.append("full_name", full_name);
            $ummu.vars.formData.append("seafarer_code", seafarer_code);
            $ummu.vars.formData.append("tempat_lahir", tempat_lahir);
            $ummu.vars.formData.append("tanggal_lahir", tanggal_lahir);
            $ummu.vars.formData.append("gender", gender);
            $ummu.vars.formData.append("golongan_darah", golongan_darah);
            $ummu.vars.formData.append("phone_number", phone_number);
            $ummu.vars.formData.append("email", email);
            $ummu.vars.formData.append("address", address);

            $ummu.vars.formData.append("national_id_number", national_id_number);
            $ummu.vars.formData.append("family_card_number", family_card_number);
            $ummu.vars.formData.append("tax_id_number", tax_id_number);

            $ummu.vars.formData.append("vaccination_info", vaccination_info);

            $ummu.vars.formData.append("tugboat_id", tugboat_id);
            $ummu.vars.formData.append("base_rank_id", base_rank_id);
            $ummu.vars.formData.append("employment_status", employment_status);

            $ummu.vars.formData.append("highest_coc_certificate", highest_coc_certificate);
            $ummu.vars.formData.append("coc_certificate_number", coc_certificate_number);
            $ummu.vars.formData.append("coc_expiry_date", coc_expiry_date);

            $ummu.vars.formData.append("seaman_book_number", seaman_book_number);
            $ummu.vars.formData.append("seaman_book_expiry", seaman_book_expiry);
            $ummu.vars.formData.append("mcu_maritime_number", mcu_maritime_number);
            $ummu.vars.formData.append("mcu_maritime_expiry", mcu_maritime_expiry);

            $ummu.vars.formData.append("passport_number", passport_number);
            $ummu.vars.formData.append("passport_expiry", passport_expiry);
            $ummu.vars.formData.append("crew_document_pdf", crew_document_pdf);

            $ummu.vars.formData.append("current_crew_status", current_crew_status);
            $ummu.vars.formData.append("sign_on_place", sign_on_place);
            $ummu.vars.formData.append("sign_on_date", sign_on_date);
            $ummu.vars.formData.append("sign_off_place", sign_off_place);
            $ummu.vars.formData.append("sign_off_date", sign_off_date);

            $ummu.vars.formData.append("wearpack_size", wearpack_size);
            $ummu.vars.formData.append("safety_shoes_size", safety_shoes_size);
            $ummu.vars.formData.append("remarks", remarks);

            var payload = {
                "full_name": full_name,
                "seafarer_code": seafarer_code,
                "tempat_lahir": tempat_lahir,
                "tanggal_lahir": tanggal_lahir,
                "gender": gender,
                "golongan_darah": golongan_darah,
                "phone_number": phone_number,
                "email": email,
                "address": address,

                "national_id_number": national_id_number,
                "family_card_number": family_card_number,
                "tax_id_number": tax_id_number,

                "vaccination_info": vaccination_info,

                "tugboat_id": tugboat_id,
                "base_rank_id": base_rank_id,
                "employment_status": employment_status,

                "highest_coc_certificate": highest_coc_certificate,
                "coc_certificate_number": coc_certificate_number,
                "coc_expiry_date": coc_expiry_date,

                "seaman_book_number": seaman_book_number,
                "seaman_book_expiry": seaman_book_expiry,
                "mcu_maritime_number": mcu_maritime_number,
                "mcu_maritime_expiry": mcu_maritime_expiry,

                "passport_number": passport_number,
                "passport_expiry": passport_expiry,
                "crew_document_pdf": crew_document_pdf,

                "current_crew_status": current_crew_status,
                "sign_on_place": sign_on_place,
                "sign_on_date": sign_on_date,
                "sign_off_place": sign_off_place,
                "sign_off_date": sign_off_date,

                "wearpack_size": wearpack_size,
                "safety_shoes_size": safety_shoes_size,
                "remarks": remarks,
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

            // validasi dulu
            if (typeof validateCrewForm === 'function' && !validateCrewForm()) {
                // otomatis pindah ke tab yang error
                return;
            }

            // const validation = app.validation.save();
            const validation = '';

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
                "method": "DELETE",
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
            }else if (id == 'tugboat') {
                $ummu.controllers.show_tugboat(id);
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

        on_click_tbody_trtd_child: function() {
            // ijo: function(row) {
            //     $("#ijo").val(row.number).attr('data-id', row.id)
            // },
            // ms_port: function(row) {
            //     $("#ms_port").val(row.name).attr('data-id', row.id)
            // },
            // ms_cost: function(row) {
            //     $("#ms_cost").val(row.name).attr('data-id', row.id)
            // },
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
            return $("#form_input .endis")
                // .not('#fixed_cost, #variable_cost')
        },

        setRow_toForm: function(row) {
            console.log(row);

            $ummu.vars.row = row;
            var tanggal_lahir_text = '';
            var tanggal_lahir_text = row.tanggal_lahir;

            $("#full_name").val(row.name);
            $("#seafarer_code").val(row.seafarer_code)
            $("#birth_place").val(row.tempat_lahir);
            $("#birth_date").val(row.tanggal_lahir);
            $("#gender").val(row.jenis_kelamin).trigger('change');
            $("#blood_type").val(row.golongan_darah);
            $("#phone_number").val(row.phone_number);
            $("#email").val(row.email);
            $("#national_id_number").val(row.nik);
            $("#family_card_number").val(row.kk);
            $("#tax_id_number").val(row.npwp);
            $("#passport_number").val(row.passport_number);
            $("#passport_expiry").val(row.passport_expiry);
            $("#address").val(row.alamat);
            $("#vaccination_info").val(row.vaccination_info);

            $("#tugboat").val(row.vessel_name).attr('data-id', row.vessel_id);
            $("#crew_ranks").val(row.rank_name_id).attr('data-id', row.base_rank_id);
            $("#highest_coc_certificate").val(row.highest_coc_certificate).trigger('change');
            $("#coc_certificate_number").val(row.coc_certificate_number);
            $("#coc_expiry_date").val(row.coc_expiry_date);
            $("#seaman_book_number").val(row.seaman_book_number);
            $("#seaman_book_expiry").val(row.seaman_book_expiry);
            $("#mcu_maritime_number").val(row.mcu_maritime_number);
            $("#mcu_maritime_expiry").val(row.mcu_maritime_expiry);
            $("#current_crew_status").val(row.current_crew_status);
            $("#sign_on_place").val(row.sign_on_place);
            $("#sign_on_date").val(row.sign_on_date);
            $("#sign_off_place").val(row.sign_off_place);
            $("#sign_off_date").val(row.sign_off_date);
            $("#current_crew_status").val(row.current_crew_status);

            $("#employment_status").val(row.employment_status_id).trigger('change');
            $("#wearpack_size").val(row.size_baju);
            $("#safety_shoes_size").val(row.size_sepatu);

            $("#remarks").val(row.remarks);

            $("#crew_document_pdf_text").html(row.file_name);
            $("#click_to_open_file").attr('href', row.file_url);

            console.log(tanggal_lahir_text)
            if (tanggal_lahir_text) {
                var age = $ummu.date.hitungUmur(tanggal_lahir_text);
            }else{
                var age = '..........';
            }

            $("#info-umur").html(`<strong class="mr-1">Usia:</strong>${age} Tahun`);

            $ummu.views.setIdentitiyToForm(row)
            $ummu.button.sbBtn_on_showData()
        },

        forClear: function() {
            $("#form_input input")
            // .not('#fixed_cost, #variable_cost')
            .val('');
            $(".is-data-id").removeAttr('data-id').removeData('id');
            $("#crew_document_pdf_text").html('Pilih Berkas PDF...');
            $("#click_to_open_file").attr('href', "");
            $("#form_input #info-umur").html('<strong class="mr-1">Usia:</strong>. . . . . . . .');
            // $('input[name="behavior"]').prop('checked', false);
            // $('input[name="behavior"]').prop('disabled', true);
            resetCrewFormValidation({ resetTab: true, resetFields: false });
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
                            var html = `(${row.rank_code}) ${row.rank_name_id}`;
                            // var html = `<div class="small text-muted">(${row.rank_code}) ${row.rank_name_id}</div>`;

                            return html;
                        }
                    },
                    { 
                        title: "Vessel",
                        data: "vessel_name",
                        className: 'align-middle',
                    },
                    { 
                        title: "Phone Number",
                        data: "phone_number",
                        className: 'align-middle',
                    },
                    { 
                        title: "Ijazah (COC)",
                        data: null,
                        className: 'align-middle',
                        render: function(data, type, row) {
                            var html = "";
                            var html = `<span class="badge badge-light border border-secondary text-secondary">${row.highest_coc_certificate}</span>`;

                            return html;
                        }
                    },
                    { 
                        title: "Seafarer Code",
                        data: "seafarer_code",
                        className: 'align-middle',
                    },
                    { 
                        title: "Tempat Lahir",
                        data: "tempat_lahir",
                        className: 'align-middle',
                    },
                    { 
                        title: "Tanggal Lahir",
                        data: "tanggal_lahir",
                        className: 'align-middle',
                    },
                    { 
                        title: "Usia",
                        data: null,
                        className: 'align-middle',
                        render: function(data, type, row) {
                            // 1. Ambil data tanpa deklarasi ganda
                            var tanggal_lahir_text = row.tanggal_lahir;

                            // 2. Validasi string dasar (kosong, null, atau format default MySQL)
                            if (!tanggal_lahir_text || tanggal_lahir_text === '0000-00-00' || tanggal_lahir_text === 'null' || tanggal_lahir_text.trim() === '') {
                                return '.....';
                            }

                            // 3. Validasi apakah string benar-benar tanggal yang valid
                            var parsedDate = new Date(tanggal_lahir_text);
                            if (isNaN(parsedDate.getTime())) {
                                return '.....';
                            }

                            // 4. Hitung umur
                            var umur = $ummu.date.hitungUmur(tanggal_lahir_text);

                            // 5. Pastikan hasil perhitungan valid (bukan NaN atau undefined)
                            if (umur !== null && umur !== undefined && !isNaN(umur)) {
                                return umur + ' Tahun';
                            }

                            return '.....';
                        }
                    },
                    { 
                        title: "Sign On Place",
                        data: "sign_on_place",
                        className: 'align-middle',
                    },
                    { 
                        title: "Sign On Date",
                        data: "sign_on_date",
                        className: 'align-middle',
                    },
                    { 
                        title: "Masa Kerja",
                        data: null,
                        className: 'align-middle',
                        render: function(data, type, row) {
                            var tanggal_text = row.sign_on_date;

                            // 1. Cek jika kosong, null, atau format default MySQL (0000-00-00)
                            if (!tanggal_text || tanggal_text === '0000-00-00' || tanggal_text === 'null') {
                                return '.....'; 
                            }

                            // 2. Validasi apakah string benar-benar tanggal yang valid
                            // (Mencegah error jika data berupa teks sembarang atau tanggal ngawur seperti 2023-02-30)
                            var parsedDate = new Date(tanggal_text);
                            if (isNaN(parsedDate.getTime())) {
                                return '.....'; // Tanggal tidak valid
                            }

                            // 3. Hitung Masa Kerja
                            var hasil = $ummu.date.hitungMasaKerja(tanggal_text);

                            // 4. Cek jika fungsi hitungMasaKerja mengembalikan error (sesuai fungsi yg kita buat sebelumnya)
                            if (hasil && hasil.error) {
                                return '.....';
                            }

                            // 5. Kembalikan hasil yang sudah diformat
                            return hasil && hasil.formatted ? hasil.formatted : '.....';
                        }
                    },
                    { 
                        title: "MCU",
                        data: "mcu_maritime_number",
                        className: 'align-middle',
                    },
                    { 
                        title: "MCU (Expiry)",
                        data: "mcu_maritime_expiry",
                        className: 'align-middle',
                    },
                    
                    // { 
                    //     title: "Buku Pelaut (Expiry)",
                    //     data: null,
                    //     className: 'align-middle',
                    //     render: function(data, type, row) {
                    //         var html = "";

                    //         var seaman_book_number = row.seaman_book_number;
                    //         var seaman_book_expiry = $ummu.date.tglIndo(row.seaman_book_expiry);
                    //         var seaman_book_expiry_status = row.seaman_book_expiry_status;

                    //         var text = `<small class="text-success font-weight-bold">
                    //                 <i class="fas fa-calendar-check mr-1"></i> ${seaman_book_expiry}
                    //             </small>`;
                    //         var textExp = `<small class="text-danger font-weight-bold animate-pulse">
                    //                 <i class="fas fa-exclamation-triangle mr-1"></i> ${seaman_book_expiry}
                    //             </small>`;

                    //         var textExpSoon = `<small class="text-warning font-weight-bold">
                    //                 <i class="fas fa-calendar-check mr-1"></i> ${seaman_book_expiry}
                    //             </small>`;

                    //         if (seaman_book_expiry_status == 'Active') {
                    //             var html_ = text;
                    //         }else if (seaman_book_expiry_status == 'Expired') {
                    //             var html_ = textExp;
                    //         }else{
                    //             var html_ = textExpSoon;
                    //         }

                    //         var html = `
                    //             <div class="mb-0 font-weight-bold">${seaman_book_number}</div>
                    //             ${html_}
                    //         `;

                    //         return html;
                    //     }
                    // },
                    { 
                        title: "Buku Pelaut (Number)",
                        data: "seaman_book_number",
                        className: 'align-middle',
                        // render: function(data, type, row) {
                        //     var html = "";

                        //     var seaman_book_number = row.seaman_book_number;
                        //     var seaman_book_expiry = $ummu.date.tglIndo(row.seaman_book_expiry);
                        //     var seaman_book_expiry_status = row.seaman_book_expiry_status;

                        //     var text = `<small class="text-success font-weight-bold">
                        //             <i class="fas fa-calendar-check mr-1"></i> ${seaman_book_expiry}
                        //         </small>`;
                        //     var textExp = `<small class="text-danger font-weight-bold animate-pulse">
                        //             <i class="fas fa-exclamation-triangle mr-1"></i> ${seaman_book_expiry}
                        //         </small>`;

                        //     var textExpSoon = `<small class="text-warning font-weight-bold">
                        //             <i class="fas fa-calendar-check mr-1"></i> ${seaman_book_expiry}
                        //         </small>`;

                        //     if (seaman_book_expiry_status == 'Active') {
                        //         var html_ = text;
                        //     }else if (seaman_book_expiry_status == 'Expired') {
                        //         var html_ = textExp;
                        //     }else{
                        //         var html_ = textExpSoon;
                        //     }

                        //     var html = `
                        //         <div class="mb-0 font-weight-bold">${seaman_book_number}</div>
                        //         ${html_}
                        //     `;

                        //     return html;
                        // }
                    },
                    { 
                        title: "Buku Pelaut (Expiry)",
                        data: "seaman_book_number",
                        className: 'align-middle',
                        render: function(data, type, row) {
                            var html = "";

                            var seaman_book_number = row.seaman_book_number;
                            var seaman_book_expiry = $ummu.date.tglIndo(row.seaman_book_expiry);
                            var seaman_book_expiry_status = row.seaman_book_expiry_status;

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

                                // <div class="mb-0 font-weight-bold">${seaman_book_number}</div>
                            var html = `
                                ${html_}
                            `;

                            return html;
                        }
                    },
                    { 
                        title: "Passpor",
                        data: "passport_number",
                        className: 'align-middle',
                    },
                    { 
                        title: "Passpor (Expiry)",
                        data: "passport_expiry",
                        className: 'align-middle',
                    },
                    { 
                        title: "KTP",
                        data: "nik",
                        className: 'align-middle',
                    },
                    { 
                        title: "KK",
                        data: "kk",
                        className: 'align-middle',
                    },
                    { 
                        title: "NPWP",
                        data: "npwp",
                        className: 'align-middle',
                    },
                    { 
                        title: "Vaksin",
                        data: "vaccination_info",
                        className: 'align-middle',
                    },
                    { 
                        title: "Status Kerja",
                        data: null,
                        className: 'align-middle small',
                        render: function(data, type, row) {
                            var html = "";

                            var on_board = `<span class="badge badge-success status-badge shadow-sm">
                                    <i class="fas fa-ship mr-1"></i> ON BOARD
                                </span>`;
                            var standby = `<span class="badge badge-info status-badge shadow-sm">
                                    <i class="fas fa-user-clock mr-1"></i> STANDBY
                                </span>`
                            var off_sign = `<span class="badge badge-secondary status-badge shadow-sm">
                                <i class="fas fa-home mr-1"></i> OFF SIGN / CUTI
                            </span>`;
                            var medical_leave = `<span class="badge badge-danger status-badge shadow-sm">
                                <i class="fas fa-clinic-medical"></i> MEDICAL LEAVE
                            </span>`;
                            // 'STANDBY','ON_BOARD','OFF_SIGN','MEDICAL_LEAVE'

                            var current_crew_status = row.current_crew_status;

                            if (current_crew_status == 'STANDBY') {
                                var html = standby;
                            }else if (current_crew_status == 'ON_BOARD') {
                                var html = on_board;
                            }else if (current_crew_status == 'OFF_SIGN') {
                                var html = off_sign;
                            }else{
                                var html = medical_leave;
                            }

                            return html;
                        }
                    },
                    { 
                        title: "Alamat",
                        data: "alamat",
                        className: 'align-middle',
                    },
                    { 
                        title: "Remarks",
                        data: "remarks",
                        className: 'align-middle',
                    },
                ];
        
                return columns;
            },

            serverSide: function() {
                return false;
            },

            onClick_nthChild_2: function(row) {
                // console.log(row)
                // const row_for_urlParams = row;
                // const queryString = $.param(row);
                // console.log(queryString)
                // $ummu.url.setParamFromRow(row);
                $ummu.url.setParamFromObject(row);
                app.views.setRow_toForm(row);

                // console.log(ummu)
            },

            columnDefs: function() {
                return [
                    {
                        targets: 0,
                        orderable: false,
                        width: '40px',
                        render: DataTable.render.select(),
                    },
                    {
                        targets: 1,
                        orderable: true,
                        width: '50px',
                        class: 'text-center',
                    }
                    // { 
                    //     targets: [26,27], 
                    //     visible: false 
                    // },
                ];
            },
        },
    },
};

$(document).ready(function () {
    app.config.autoload()
});

$(function () {
    // ============================================================
    // HITUNG JUMLAH FIELD WAJIB KOSONG PER TAB (badge merah)
    // ============================================================
    function updateTabBadges() {
        if (window.__isResettingCrewForm) return; // <-- penting

        jQuery('#crewFormTabContent .tab-pane').each(function () {
            const $pane  = jQuery(this);
            const paneId = $pane.attr('id');
            let missing  = 0;

            $pane.find('[required]').each(function () {
                const $f = jQuery(this);
                if ($f.prop('disabled')) return;
                if (jQuery(this).closest('.select2, .flatpickr-calendar').length) return;
                const v = String($f.val() || '').trim();
                if (!v) missing++;
            });

            const $badge = jQuery('#crewFormTabs a[href="#' + paneId + '"] [data-tab-badge]');
            if (missing > 0) {
                $badge.text(missing).removeClass('d-none');
            } else {
                $badge.addClass('d-none');
            }
        });
    }

    // ============================================================
    // VALIDASI FORM -> AUTO-PINDAH KE TAB YANG ERROR
    // Return true jika valid, false jika ada yang kosong
    // ============================================================
    window.validateCrewForm = function () {
        if (window.__isResettingCrewForm) return true;

        let firstInvalidPane  = null;
        let firstInvalidField = null;

        jQuery('#crewFormTabContent [required]').removeClass('is-invalid');

        jQuery('#crewFormTabContent .tab-pane').each(function () {
            if (firstInvalidPane) return;
            const $pane  = jQuery(this);
            const paneId = $pane.attr('id');

            $pane.find('[required]').each(function () {
                if (firstInvalidField) return;
                const $f = jQuery(this);
                if ($f.prop('disabled')) return;
                if ($f.closest('.select2, .flatpickr-calendar').length) return;
                const v = String($f.val() || '').trim();
                if (!v) {
                    $f.addClass('is-invalid');
                    firstInvalidPane  = paneId;
                    firstInvalidField = $f.attr('id');
                }
            });
        });

        if (firstInvalidPane) {
            jQuery('#crewFormTabs a[href="#' + firstInvalidPane + '"]').tab('show');

            setTimeout(function () {
                const el = document.getElementById(firstInvalidField);
                if (el) {
                    el.focus();
                    if (el.scrollIntoView) {
                        el.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    }
                }
                updateTabBadges();
            }, 350);

            return false;
        }

        updateTabBadges();
        return true;
    };

    // ============================================================
    // LIVE UPDATE: setiap input berubah -> refresh badge & error
    // ============================================================
    $(document).on('input change blur',
        '#crewFormTabContent [required]',
        function () {
            const $f = $(this);
            if ($f.prop('disabled')) return;
            const v = String($f.val() || '').trim();
            $f.toggleClass('is-invalid', !v);
            updateTabBadges();
        }
    );

    // refresh ketika tab diklik (supaya badge akurat)
    $('#crewFormTabs a').on('shown.bs.tab', updateTabBadges);

    // inisialisasi awal
    setTimeout(updateTabBadges, 500);
});

// ============================================================
// RESET SEMUA STATE VALIDASI (badge, is-invalid, tab aktif)
// RESET SEMUA STATE VALIDASI + SEMUA WIDGET
// ============================================================
window.resetCrewFormValidation = function (options) {
    const opts = Object.assign({
        resetTab: true,      // balik ke tab pertama?
        resetFields: false,  // kosongkan nilai field juga?
        clearWidgets: true   // reset datepicker/select2/dll
    }, options || {});

    // aktifkan flag supaya validasi tidak jalan selama proses reset
    window.__isResettingCrewForm = true;

    try {

        // --------------------------------------------------
        // 1. HAPUS SEMUA TANDA ERROR
        // --------------------------------------------------
        const $container = jQuery('#crewFormTabContent');
        $container.find('.is-invalid').removeClass('is-invalid');
        $container.find('[required]').removeClass('is-invalid');

        // --------------------------------------------------
        // 2. SEMBUNYIKAN SEMUA BADGE
        // --------------------------------------------------
        jQuery('#crewFormTabs [data-tab-badge]')
            .addClass('d-none')
            .text('0');

        // --------------------------------------------------
        // 3. (OPSIONAL) KOSONGKAN SEMUA FIELD + WIDGET
        // --------------------------------------------------
        if (opts.resetFields) {
            $container.find('input, select, textarea').each(function () {
                const el  = this;
                const $f  = jQuery(el);
                const type = (el.type || '').toLowerCase();

                // skip tombol2 internal widget
                if ($f.hasClass('btn-endis') || $f.hasClass('btn-show-datepicker')) return;
                if ($f.closest('.select2, .flatpickr-calendar, .ui-datepicker').length) return;

                // file input
                if (type === 'file') {
                    try { el.value = ''; } catch (e) {}
                    return;
                }

                // summernote
                if ($f.hasClass('summernote') || $f.hasClass('summernote-simple')) {
                    _resetSummernote(el);
                    return;
                }

                // clockpicker (class khusus)
                if ($f.hasClass('ummu-clockpicker') || $f.hasClass('bootstrap-clockpicker')) {
                    _resetClockPicker(el);
                    return;
                }

                // datepicker (flatpickr / jquery ui)
                if ($f.hasClass('ummu-datepicker') ||
                    $f.hasClass('ummu-birth-datepicker') ||
                    $f.hasClass('hasDatepicker')) {
                    _resetDatePicker(el);
                    return;
                }

                // select2 / select biasa
                if (type === 'select-one' || type === 'select-multiple' ||
                    $f.hasClass('select2') ||
                    $f.data('select2')) {
                    _resetSelect2(el);
                    // set default ke opsi pertama
                    try { el.selectedIndex = 0; } catch (e) {}
                    return;
                }

                // input with is-data-id (misal tugboat, crew_ranks)
                if ($f.hasClass('is-data-id')) {
                    $f.val('').removeData('id').removeData('label');
                    return;
                }

                // default
                $f.val('').removeClass('is-invalid');
            });

            // ----------------------------------------------
            // 3a. Reset label custom-file
            // ----------------------------------------------
            jQuery('#crew_document_pdf_text').text('Pilih Berkas PDF...');

            // ----------------------------------------------
            // 3b. Re-init bs-custom-file-input agar label sinkron
            // ----------------------------------------------
            if (window.bsCustomFileInput && typeof bsCustomFileInput.init === 'function') {
                try { bsCustomFileInput.init(); } catch (e) {}
            }

            // ----------------------------------------------
            // 3c. Reset info umur
            // ----------------------------------------------
            jQuery('#info-umur').html('<strong class="mr-1">Usia:</strong>. . . . . . . .');

            // ----------------------------------------------
            // 3d. Reset link file & sembunyikan
            // ----------------------------------------------
            jQuery('#click_to_open_file').attr('href', '').hide();

            // ----------------------------------------------
            // 3e. Reset semua checkbox / radio (kalau ada)
            // ----------------------------------------------
            $container.find('input[type="checkbox"], input[type="radio"]').prop('checked', false);
        }

        // --------------------------------------------------
        // 4. BALIK KE TAB PERTAMA
        // --------------------------------------------------
        if (opts.resetTab) {
            const $first = jQuery('#crewFormTabs a').first();
            if ($first.length) {
                try { $first.tab('show'); } catch (e) {}
            }
        }

        // --------------------------------------------------
        // 5. SEMBUNYIKAN TOOLTIP / POPOVER ERROR
        // --------------------------------------------------
        if (window.jQuery && jQuery.fn.tooltip) {
            $container.find('[data-toggle="tooltip"]').tooltip('hide');
        }

    } finally {
        // matikan flag setelah reset selesai
        // pakai setTimeout(0) supaya event 'change' dari select2
        // yang mungkin async sudah selesai
        setTimeout(function () {
            window.__isResettingCrewForm = false;
        }, 50);
    }
};

// ============================================================
// FLAG: saat true, semua validasi & badge di-skip sementara
// ============================================================
window.__isResettingCrewForm = false;

// ============================================================
// RESET SATU WIDGET DATE / TIME PICKER
// ============================================================
function _resetDatePicker(el) {
    if (!el) return;

    // 1) flatpickr (dipakai ummu-datepicker, ummu-birth-datepicker)
    try {
        const fp = (window.flatpickr && flatpickr.getInstance)
            ? flatpickr.getInstance(el)
            : (el._flatpickr || null);
        if (fp && typeof fp.clear === 'function') {
            fp.clear();
            return;
        }
    } catch (e) { /* ignore */ }

    // 2) jQuery UI datepicker
    if (window.jQuery && jQuery(el).hasClass('hasDatepicker')) {
        try { jQuery(el).datepicker('setDate', null); } catch (e) {}
        jQuery(el).val('');
        return;
    }

    // 3) fallback
    el.value = '';
}

// ============================================================
// RESET SATU WIDGET SELECT2
// ============================================================
function _resetSelect2(el) {
    if (!el) return;

    const $el = window.jQuery ? jQuery(el) : null;
    if (!$el) return;

    const hasS2 = $el.data('select2') || $el.hasClass('select2-hidden-accessible');

    // matikan validasi sementara supaya 'change' tidak memicu badge
    const flagBackup = window.__isResettingCrewForm;
    window.__isResettingCrewForm = true;

    try {
        if (hasS2) {
            $el.val(null).trigger('change.select2');
        } else {
            $el.val('');
        }
    } catch (e) {
        try { $el.val(''); } catch (e2) {}
    } finally {
        window.__isResettingCrewForm = flagBackup;
    }
}

// ============================================================
// RESET SATU WIDGET CLOCKPICKER (bootstrap-clockpicker)
// ============================================================
function _resetClockPicker(el) {
    if (!el) return;
    try {
        // clockpicker biasanya cuma mengisi value input
        el.value = '';
        // kalau ada instance-nya di jQuery data:
        if (window.jQuery) {
            const $el = jQuery(el);
            if ($el.data('clockpicker')) {
                // beberapa versi pakai objek dengan method .val
                if (typeof $el.data('clockpicker').val === 'function') {
                    $el.data('clockpicker').val('');
                }
            }
        }
    } catch (e) { /* ignore */ }
}

// ============================================================
// RESET SATU WIDGET SUMMERNOTE
// ============================================================
function _resetSummernote(el) {
    if (!el || !window.jQuery) return;
    const $el = jQuery(el);
    if ($el.data('summernote')) {
        try { $el.summernote('reset'); } catch (e) {
            try { $el.summernote('code', ''); } catch (e2) {}
        }
    }
}