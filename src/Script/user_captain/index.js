var $dataTable_tr_sign_on_off = $('#dataTable_tr_sign_on_off');

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
            // $ummu.button.sbBtnToolbar.addRemove_btnNew('rm')
            $('#toolbar_buttons #btn_new, #toolbar_buttons #btn_delete').remove()
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
            // $('#fixed_cost, #variable_cost').prop('disabled', false);
            // $("#status").html('<span class="badge badge-secondary">Draft</span>')
            // $("#from_dept").val($ummu.vars.employee.department).attr('data-id', $ummu.vars.employee.department_id)
            $('#toolbar_buttons #btn_new, #toolbar_buttons #btn_delete').remove()
        },

        sbSave: function () {
            // Personal
            const phone_number = $("#phone_number").val();
            const password = $("#password").val();

            // =============================================================
            $ummu.vars.formData = new FormData();
            $ummu.vars.formData.append("phone_number", phone_number);
            $ummu.vars.formData.append("password", password);

            var payload = {
                "phone_number": phone_number,
                "password": password,
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
            // $('#fixed_cost, #variable_cost').prop('disabled', false);

            if ($ummu.url.getParam('id')) {
                // $('input[name="behavior"]').prop('disabled', true);
                $('#password').val('')
            }else{
                app.views.forClear()
            }
            $('#toolbar_buttons #btn_new, #toolbar_buttons #btn_delete').remove()
        },

        sbEdit: function () {
            // 
            // $('#fixed_cost, #variable_cost').prop('disabled', false);
            /*if ($('#tugboat').val()) {
                $('#btn_show_vessel').attr('disabled', true).addClass('btn-outline-secondary').removeClass('btn-primary');
            }

            if ($('#crew_ranks').val()) {
                $('#btn_show_ranks').attr('disabled', true).addClass('btn-outline-secondary').removeClass('btn-primary');
            }

            if ($('#basic_salary').val()) {
                $('#basic_salary').attr('disabled', true);
            }*/
            $('#toolbar_buttons #btn_new, #toolbar_buttons #btn_delete').remove()
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
            $('#toolbar_buttons #btn_new, #toolbar_buttons #btn_delete').remove()
        },

        on_btn_getData_click: function () {
            $ummu.views.after_sbToolbar_getData();
            app.views.forClear()
        },

        on_showLeftModal: function(id) {
            console.log(id)
            // $ummu.controllers.show_data_link(id)
            if (id == 'crew_ranks') {
                $ummu.controllers.show_crew_ranks(id);
            }else if (id == 'tugboat') {
                $ummu.controllers.show_tugboat(id);
            }else if (id == 'vessel_id') {
                $ummu.dt.modal_list.show("vessel_id");
            }else if (id == 'rank_id') {
                $ummu.dt.modal_list.show("rank_id");
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
            $("#vessel_name").html(`<label class="badge badge-secondary">${row.vessel_name}</label>`)
            $("#name").html(`<label class="badge badge-secondary">${row.name}</label> <span class="text-muted small">${row.i_phone_number}</span>`);
            $("#phone_number").val(row.phone_number);

            $('#header_tr_perubahan_data').html(`#${row.name}`)

            $ummu.views.setIdentitiyToForm(row)
            $ummu.button.sbBtn_on_showData()
        },

        forClear: function() {
            $ummu.views.clearForm();
            $("#form_input input")
            // .not('#fixed_cost, #variable_cost')
            .val('');
            $(".ummu-label-value").html('')
            // $(".is-data-id").removeAttr('data-id').removeData('id');
            // $("#crew_document_pdf_text").html('Pilih Berkas PDF...');
            // $("#click_to_open_file").attr('href', "");
            // $("#form_input #info-umur").html('<strong class="mr-1">Usia:</strong>. . . . . . . .');
            // $('input[name="behavior"]').prop('checked', false);
            // $('input[name="behavior"]').prop('disabled', true);
            resetCrewFormValidation({ resetTab: true, resetFields: false });
        },
    },

    dt: {
        init: {
            // 
        },

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
                        title: "Vessel",
                        data: "vessel_name",
                        className: 'align-middle',
                    },
                    { 
                        title: "Nama Kapten",
                        data: "name",
                        className: 'align-middle',
                        render: function(data, type, row) {
                            var html = `<div class="">${data}</div>
                                        <div class="small text-muted">${row.i_phone_number}</div>`;

                            return html;
                        }
                    },
                    { 
                        title: "Phone Number Login",
                        data: "phone_number",
                        className: 'align-middle',
                    },
                    { 
                        title: "Status User Login",
                        data: "account_status",
                        className: 'align-middle',
                        render: function(data, type, row) {
                            if (data == 'Sudah aktif') {
                                var html = `<label class="badge badge-success">${data}</label>`;
                            }else{
                                var html = `<label class="badge badge-danger">${data}</label>`;
                            }

                            return html;
                        }
                    },
                    { 
                        title: "Jabatan (Rank)",
                        data: null,
                        className: 'align-middle',
                        render: function(data, type, row) {
                            var html = `${row.rank_name_id}`;
                            // var html = `<div class="small text-muted">(${row.rank_code}) ${row.rank_name_id}</div>`;

                            return html;
                        }
                    },
                ];
        
                return columns;
            },

            serverSide: function() {
                return false;
            },

            onClick_nthChild_2: function(row) {
                app.views.forClear()
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

            on_reload_params: function (d) {
                // // filter wajib
                // d.date_from = $("#date_from").val() || "";
                // d.date_to   = $("#date_to").val()   || "";

                // filter opsional
                var vessel_id = $("#form_filter #vessel_id").data('id');
                if (vessel_id) d.vessel_id = vessel_id;

                var rank_id = $("#form_filter #rank_id").data('id');
                if (rank_id) d.rank_id = rank_id;

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