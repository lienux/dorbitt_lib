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
        },
    },

    vars: {
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
            app.views.forClear()
        },

        sbNew: function () {
            app.views.forClear()
        },

        sbSave: function () {
            var payload = {
                "domain_id": $("#form_input #domains").attr('data-id'),
                "kode": $("#form_input #kode").val(),
                "name": $("#form_input #name").val(),
                "description": $("#form_input #description").val(),
                "category_id": $("#form_input #category").attr('data-id'),
                "tcode_id": $("#form_input #tcode").attr('data-id'),
                "responsibility_id": $("#form_input #responsibility").attr('data-id'),
                "is_pic_only": $ummu.views.getPicOnly(),
            };

            const id = $ummu.url.getParam('id');

            if (id) {
                var func = "update/" + id
            }else{
                var func = "create"
            }

            var params = {
                "function": func,
                "method": "POST",
                "data": JSON.stringify(payload),
                "cache": true,
                "contentType": "application/json",
                "dataType": "json",
                "loader": true,
            };

            if (app.validation.save == false) {
                console.log('ada validation')
            }else{
                var ummu = $ummu.ajax.ummu8(params);   
                ummu.done(function(result) {
                    $ummu.views.after_sbToolbar_save(result, func, id, payload);
                }).fail(function() {
                    // An error occurred
                    console.log(ummu)
                });
            }
            // console.log(params)
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
            console.log(id)
            if (id == 'category') {
                $ummu.controllers.show_ms_category(id);
            }else if (id == 'tcode') {
                $ummu.controllers.show_ms_tcode(id);
            }else if (id == 'responsibility') {
                $ummu.controllers.show_ms_responsibility(id);
            }else if (id == 'domains') {
                $ummu.controllers.show_activity_domains(id);
            }
        },

        // on_click_tbody_trtd_child1: function(row) {
        //     console.log(row)
        //     app.views.setRow_toForm(row)
        // },

        on_click_tbody_trtd_child_ms_category: function(row) {
            // console.log(row)
            $("#category").val(row.name).attr('data-id', row.id);
        },

        on_click_tbody_trtd_child_ms_tcode: function(row) {
            // console.log(row)
            $("#tcode").val(row.name).attr('data-id', row.id);
        },

        on_click_tbody_trtd_child_ms_responsibility: function(row) {
            // console.log(row)
            $("#responsibility").val(row.name).attr('data-id', row.id);
        },

        on_click_tbody_trtd_child_activity_domains: function(row) {
            // console.log(row)
            $("#domains").val(row.name).attr('data-id', row.id);
        },
    },

    validation: {
        save: function() {
            if ($("#form_input #name").val() == '') {

            }
        }
    },

    views: {
        formParams: function () {
            return $("#form_input .endis");
        },

        setRow_toForm: function(row) {
            // $('.endis').prop('disabled', false);
            console.log(row)

            $("#domains").val(row.domain_name).data('id', row.domain_id)
            $("#kode").val(row.kode)
            $("#name").val(row.name)
            $("#description").val(row.description)
            $("#category").val(row.category_name).data('id', row.category_id)
            $("#tcode").val(row.tcode_name).data('id', row.tcode_id)
            $("#responsibility").val(row.responsibility_name).data('id', row.responsibility_id)
            $ummu.views.setPicOnly(row.is_pic_only)
            $ummu.views.setIdentitiyToForm(row)
            $ummu.button.sbBtn_on_showData()
            // $('.endis').prop('disabled', true);
        },

        forClear: function () {
            // 1. Kosongkan semua input teks/textarea, KECUALI radio/checkbox pic_only
            $("#form_input input")
                .not('input[name="pic_only"]')
                .not(':radio, :checkbox')   // safety: jangan sentuh radio/checkbox lain
                .val('');

            // 2. Kosongkan textarea (jika ada)
            $("#form_input textarea").val('');

            // 3. Hapus data-id
            $(".is-data-id").removeAttr('data-id').removeData('id');

            // 4. Reset PIC Only ke default "No" via helper (aman untuk disabled)
            // $ummu.views.setPicOnly(0, "pic_only", true);   // true = tetap disabled
        }
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
                        title: "Activity Domain",
                        data: "domain_name",
                        class: "text-left",
                    },
                    { 
                        title: "Kode",
                        data: "kode"
                    },
                    { 
                        title: "Name",
                        data: "name"
                    },
                    {
                        title: "PIC Only",
                        data: "is_pic_only",
                        render: function (data, type) {
                            var val = String(data);
                            if (val === "1" || val === "true") {
                                return '<i class="fas fa-check-circle text-success"></i> Yes';
                            }
                            return '<i class="fas fa-times-circle text-secondary"></i> No';
                        }
                    },
                    { 
                        title: "TCODE",
                        data: "tcode_name"
                    },
                    { 
                        title: "Category",
                        data: "category_name"
                    },
                    { 
                        title: "Responsibility",
                        data: "responsibility_name"
                    },
                    { 
                        title: "Description",
                        data: "description"
                    },
                ];

                return columns;
            },
        }
    },
};

$(document).ready(function () {
    app.config.autoload()
});