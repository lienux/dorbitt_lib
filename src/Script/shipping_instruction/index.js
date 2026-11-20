var app = {
    register: function () {
        app.config.autoload()
    },

    config: {
        autoload: function () {
            $ummu.func.location_hash()
            $ummu.config.datepicker()
            $ummu.button.sbToolbar()
            localStorage.setItem(`${$ummu.vars.module_kode}_isDtServerSide`, false)
            $ummu.config.dataTables()
            app.controllers.index();
            $ummu.helpers.renderComplexHeader($table, app.dt.config.columns());

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
        
        on_btn_getData_click: function () {
            $ummu.views.after_sbToolbar_getData();
        },

        sbNew: function () {
            app.views.forClear()
        },

        sbSave: function () {
            var file_upload = $("#file_upload")[0].files[0];
            var tgl = $("#iDate").val();
            var number = $("#number").val();
            var client_id = $("#client").attr('data-id');
            var tugboat_id = $("#tugboat").attr('data-id');
            var barge_id = $("#barge").attr('data-id');
            var load_type = $("#load_type").val();
            var qty = $("#qty").val();
            var uom_id = $("#uom").attr('data-id');
            var rute_id = $("#voyage_route").attr('data-id');
            var loading_availability_date_from = $("#iDateLoadingFrom").val();
            var loading_availability_date_to = $("#iDateLoadingTo").val();
            var loading_port = $("#loading_port").val();
            var discharge_port = $("#discharge_port").val();

            var formData = new FormData();
            formData.append("file_upload", file_upload);
            formData.append("tgl", tgl);
            formData.append("number", number);
            formData.append("client_id", client_id);
            formData.append("tugboat_id", tugboat_id);
            formData.append("barge_id", barge_id);
            formData.append("load_type", load_type);
            formData.append("qty", qty);
            formData.append("uom_id", uom_id);
            formData.append("rute_id", rute_id);
            formData.append("loading_availability_date_from", loading_availability_date_from);
            formData.append("loading_availability_date_to", loading_availability_date_to);
            formData.append("loading_port", loading_port);
            formData.append("discharge_port", discharge_port);

            var payload = {
                "tgl": tgl,
                "number": number,
                "client_id": client_id,
                "tugboat_id": tugboat_id,
                "barge_id": barge_id,
                "load_type": load_type,
                "qty": qty,
                "uom_id": uom_id,
                "rute_id": rute_id,
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

            const validation = app.validation.save(func);

            if (validation.length > 0) {
                $ummu.views.errors_msg(validation)
                $(".btn-endis").removeClass('btn-outline-secondary').addClass('btn-primary')
            }else{
                console.log('tidak ada validation')
                var ummu = $ummu.ajax.ummu7(params);   
                ummu.done(function(result) {
                    const response = JSON.parse(result);
                    $ummu.views.after_sbToolbar_save(response, func, id, payload);

                    $(".custom-file-label").html(response.data.fileNameOrigin)
                    $("#file_url").attr("href", response.data.fileUrl)

                    if (func == 'create') {
                        //
                    }else{
                        // 
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
            }else if (id == 'voyage_route') {
                $ummu.controllers.show_voyage_route();
            }
        },

        on_click_tbody_trtd_child_voyage_route2: function(row) {
            $("#voyage_route").val(row.name).attr('data-id', row.id);
            $("#loading_port").val(row.from_name);
            $("#discharge_port").val(row.to_name);
        },
    },

    validation: {
        save: function(func) {
            var list = [];
            
            list = $ummu.validation.inputValidate();

            if (func == 'create') {
                var file_upload = $('#file_upload').val();

                if ($ummu.func.isValue(file_upload) == false) {
                    list.push('File is required')
                }
            }else{
                var filename = $(".custom-file-label").html()

                if ($ummu.func.isValue(filename) == false) {
                    list.push('File is required.')
                }
            }

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
        },
    },

    views: {
        formParams: function() {
            return $("#form_input .endis");
        },

        setRow_toForm: function(row) {
            // console.log(row)
            $("#iDate").val(row.tgl)
            $("#number").val(row.number)
            $("#client").val(row.client_name).attr('data-id', row.client_id)
            $("#tugboat").val(row.tugboat_name).attr('data-id', row.tugboat_id)
            $("#barge").val(row.barge_name).attr('data-id', row.barge_id)
            $("#load_type").val(row.load_type)
            $("#qty").val(row.qty)
            $("#uom").val(row.uom_kode).attr('data-id', row.uom_id)
            $("#voyage_route").val(row.rute_name).attr('data-id', row.rute_id)

            $("#iDateLoadingFrom").val(row.loading_availability_date_from)
            $("#iDateLoadingTo").val(row.loading_availability_date_to)
            $("#loading_port").val(row.from_name)
            $("#discharge_port").val(row.to_name)
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
        config: { 
            columns: function () {
                let columns = [
                    { 
                        rowspan: true,
                        data: null, 
                        render: DataTable.render.select()
                    },
                    {
                        data: null,
                        rowspan: true,
                        render: function (data, type, row) {
                            const is_mutabannat = row.is_mutabannat;
                            if (is_mutabannat === '1') {
                                return (
                                    `<div class="text-muted">
                                        <i class="far fa-lock"></i>
                                    </div>`
                                );
                            }else{
                                return (
                                    `<a href="javascript:void(0);">
                                        <i class="fas fa-external-link-alt"></i>
                                    </a>`
                                );
                            }
                        }
                    },
                    { 
                        title: "ID",
                        data: "id",
                        width: '100px',
                        rowspan: true
                    },
                    { 
                        title: "Date",
                        rowspan: true,
                        data: "tgl"
                    },
                    { 
                        title: "Number",
                        rowspan: true,
                        data: "number"
                    },
                    { 
                        title: "Shipper",
                        rowspan: true,
                        data: "client_name"
                    },
                    { 
                        title: "Tugboat",
                        rowspan: true,
                        data: "tugboat_name"
                    },
                    { 
                        title: "Barge",
                        rowspan: true,
                        data: "barge_name"
                    },
                    { 
                        title: "Type",
                        group: "Loading",
                        data: "load_type"
                    },
                    { 
                        title: "Qty",
                        group: "Loading",
                        data: "qty"
                    },
                    { 
                        title: "UoM",
                        group: "Loading",
                        data: "uom_name"
                    },
                    { 
                        title: "Date of Loading",
                        group: "Loading",
                        data: null,
                        render: function (data, type, row) {
                            return row.loading_availability_date_from + '  -  ' + row.loading_availability_date_to;
                        }
                    },
                    { 
                        title: "Port of Loading",
                        group: "Port",
                        data: "loading_port"
                    },
                    { 
                        title: "Port of Discharge",
                        group: "Port",
                        data: "discharge_port"
                    },
                    { 
                        title: "File",
                        rowspan: true,
                        data: "fileNameOrigin"
                    },
                    { 
                        title: "Created By",
                        rowspan: true,
                        data: "created_by_name"
                    },
                ];
        
                return columns;
            },

            on_reload_params: function (d) {
                // // filter wajib
                // d.date_from = $("#date_from").val() || "";
                // d.date_to   = $("#date_to").val()   || "";

                // filter opsional
                var vessel_id = $("#form_filter #filter_vessel").data('id');
                if (vessel_id) d.vessel_id = vessel_id;

                var client_id = $("#form_filter #filter_client").data('id');
                if (client_id) d.client_id = client_id;

                // // filter dari modal_filter (via localStorage)
                // var lcFrom = localStorage.getItem("date_from");
                // var lcTo   = localStorage.getItem("date_to");
                // if (lcFrom) d.date_from = lcFrom;
                // if (lcTo)   d.date_to   = lcTo;
            },
        },
    },
};

$(document).ready(function () {
    app.config.autoload()
});

$(document).ready(function () {

    // ================================================================
    // MOCK DATA PORTS
    // ================================================================
    const MOCK_PORTS = [
        { id: 1, name: "Jetty Borneo Mandiri Prima Energi, Batang Kulur, KalSel" },
        { id: 2, name: "Jetty Pelindo, Bojonegara, Jawa Barat" },
        { id: 3, name: "Tanjung Priok, Jakarta" },
        { id: 4, name: "Tanjung Perak, Surabaya" },
        { id: 5, name: "Pelabuhan Samarinda, KalTim" },
        { id: 6, name: "Pelabuhan Banjarmasin, KalSel" },
        { id: 7, name: "Jetty Adaro, Taboneo, KalSel" },
        { id: 8, name: "Pelabuhan Palembang, SumSel" }
    ];

    // ================================================================
    // 1. Load Ports
    // ================================================================
    function loadPorts() {
        renderPorts(MOCK_PORTS);
    }

    function renderPorts(list) {
        const $dlLoad = $('#list_loading_port').empty();
        const $dlDisc = $('#list_discharge_port').empty();

        list.forEach(function (p) {
            const name = (typeof p === 'string') ? p : p.name;
            const safe = escapeHtml(name);
            $dlLoad.append('<option value="' + safe + '"></option>');
            $dlDisc.append('<option value="' + safe + '"></option>');
        });
    }

    function escapeHtml(str) {
        return String(str)
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;')
            .replace(/'/g, '&#039;');
    }

    // ================================================================
    // 2. Smart Datalist Logic (Auto-Koreksi & Peringatan)
    // ================================================================
    // Fungsi universal untuk menangani input berbasis datalist
    function handleSmartDatalist(inputId, listId, warnId) {
        const $el = $('#' + inputId);
        const $warn = $('#' + warnId);
        
        // 1. Sanitasi: Hapus spasi ganda dan spasi di ujung
        let val = $el.val().replace(/\s+/g, ' ').trim();
        $el.val(val);

        // Jika kosong, hilangkan warning dan reset state
        if (val === '') {
            $el.removeClass('is-warning-custom').data('is-new', false);
            $warn.hide();
            return;
        }

        let exactMatch = null;
        let similarMatch = null;

        // 2. Cari di datalist
        $('#' + listId + ' option').each(function () {
            const listVal = $(this).val();
            
            // Cek Exact Match (persis sama abaikan huruf besar/kecil)
            if (listVal.toLowerCase() === val.toLowerCase()) {
                exactMatch = listVal;
            }
            // Cek Similar Match (kata terkandung di dalamnya)
            else if (listVal.toLowerCase().includes(val.toLowerCase()) || val.toLowerCase().includes(listVal.toLowerCase())) {
                similarMatch = listVal;
            }
        });

        // 3. LOGIKA EKSEKUSI
        if (exactMatch) {
            // Auto-Koreksi: Jika ada yang persis sama (typo kapitalisasi/spasi)
            $el.val(exactMatch);
            $el.removeClass('is-warning-custom').data('is-new', false);
            $warn.hide();
        } 
        else if (similarMatch) {
            // Peringatan: Jika mirip tapi tidak persis
            $el.addClass('is-warning-custom').data('is-new', true);
            $warn.html('<i class="fas fa-exclamation-triangle"></i> Mirip dengan: <b>' + escapeHtml(similarMatch) + '</b>. Yakin tambah baru?').show();
        } 
        else {
            // Info: Jika benar-benar baru
            $el.addClass('is-warning-custom').data('is-new', true);
            $warn.html('<i class="fas fa-info-circle"></i> Info: Data baru (akan didaftarkan ke sistem).').show();
        }
    }

    // Binding Events
    $('#loading_port').on('blur change', function() {
        handleSmartDatalist('loading_port', 'list_loading_port', 'warn_loading');
    });
    
    $('#discharge_port').on('blur change', function() {
        handleSmartDatalist('discharge_port', 'list_discharge_port', 'warn_discharge');
    });
    
    $('#load_type').on('blur change', function() {
        handleSmartDatalist('load_type', 'list_cargo_type', 'warn_load_type');
    });

    // ================================================================
    // 3. Auto-Format Ribuan pada Quantity (Hanya Angka)
    // ================================================================
    $('#qty').on('input', function() {
        // Hapus karakter selain angka dan titik (mencegah user ngetik huruf)
        let val = $(this).val().replace(/[^0-9.]/g, '');
        
        if (val === '') {
            $(this).val('');
            return;
        }
        
        let parts = val.split('.');
        parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        
        $(this).val(parts.join('.'));
    });

    // ================================================================
    // 4. Validasi Rentang Tanggal
    // ================================================================
    function validateDates() {
        const from = $('#iDateLoadingFrom').val();
        const to = $('#iDateLoadingTo').val();
        let isError = false;

        if (from && to) {
            const d1 = new Date(from);
            const d2 = new Date(to);
            if (d1 > d2) {
                isError = true;
            }
        }

        if (isError) {
            $('#date_group').addClass('is-invalid-custom');
            $('#err_date').show();
        } else {
            $('#date_group').removeClass('is-invalid-custom');
            $('#err_date').hide();
        }
        return !isError;
    }

    $('#iDateLoadingFrom, #iDateLoadingTo').on('change blur', validateDates);

    // ================================================================
    // 5. Submit, Draft & Reset Handlers
    // ================================================================
    function buildDatalistPayload(selector) {
        const $el = $(selector);
        return {
            name: $el.val().trim(),
            is_new: $el.data('is-new') === true
        };
    }

    function validateForm() {
        let isValid = true;

        // Validasi Quantity
        if ($('#qty').val().trim() === '' || $('#qty').val().trim() === '0' || $('#uom').val() === null) {
            $('#qty_group').addClass('is-invalid-custom');
            $('#err_qty').show();
            isValid = false;
        } else {
            $('#qty_group').removeClass('is-invalid-custom');
            $('#err_qty').hide();
        }

        // Validasi Tanggal
        if (!validateDates()) {
            isValid = false;
        }

        // Pemicu Smart Datalist untuk update state terakhir
        handleSmartDatalist('loading_port', 'list_loading_port', 'warn_loading');
        handleSmartDatalist('discharge_port', 'list_discharge_port', 'warn_discharge');
        handleSmartDatalist('load_type', 'list_cargo_type', 'warn_load_type');

        return isValid;
    }

    // Tombol Simpan & Submit
    $('#btn_submit').on('click', function () {
        if (!validateForm()) {
            // Scroll ke elemen error pertama
            if ($('.is-invalid-custom').length > 0) {
                $('html, body').animate({
                    scrollTop: $('.is-invalid-custom').first().offset().top - 100
                }, 300);
            }
            return;
        }

        const payload = {
            status: 'SUBMITTED',
            date_loading: {
                from: $('#iDateLoadingFrom').val(),
                to: $('#iDateLoadingTo').val()
            },
            cargo_type:     buildDatalistPayload('#load_type'),
            loading_port:   buildDatalistPayload('#loading_port'),
            discharge_port: buildDatalistPayload('#discharge_port'),
            quantity: {
                qty: $('#qty').val().replace(/,/g, ''), 
                uom: $('#uom').val()
            }
        };

        $('#preview_payload').text(JSON.stringify(payload, null, 2));
        console.log('Payload Submit:', payload);
    });

    // Tombol Save as Draft
    $('#btn_draft').on('click', function () {
        const payload = {
            status: 'DRAFT',
            date_loading: {
                from: $('#iDateLoadingFrom').val(),
                to: $('#iDateLoadingTo').val()
            },
            cargo_type:     buildDatalistPayload('#load_type'),
            loading_port:   buildDatalistPayload('#loading_port'),
            discharge_port: buildDatalistPayload('#discharge_port'),
            quantity: {
                qty: $('#qty').val().replace(/,/g, ''),
                uom: $('#uom').val()
            }
        };

        $('#preview_payload').text(JSON.stringify(payload, null, 2));
        console.log('Payload Draft:', payload);
    });

    // Tombol Reset
    $('#btn_reset').on('click', function () {
        $('#loading_port, #discharge_port, #load_type').val('').removeClass('is-warning-custom').removeData('is-new');
        $('#qty').val('');
        $('#uom').val('');
        $('#iDateLoadingFrom, #iDateLoadingTo').val('');
        $('#preview_payload').text('-');
        
        $('#qty_group').removeClass('is-invalid-custom');
        $('#date_group').removeClass('is-invalid-custom');
        $('#err_qty, #err_date, #warn_loading, #warn_discharge, #warn_load_type').hide();
    });

    // ================================================================
    // 6. Init
    // ================================================================
    loadPorts();

    // DEMO: aktifkan field agar bisa langsung dites
    // $('#qty, #uom, #loading_port, #discharge_port, #iDateLoadingFrom, #iDateLoadingTo, #load_type').prop('disabled', false);
});
