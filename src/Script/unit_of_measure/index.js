// $ummu.vars.page_url = $base_url + 'admin/' + PHP_VARS.moduleKode + '/';
// var $crud = ["new","edit","delete"]
// var $localStrgKey = PHP_VARS.moduleKode;

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
            // app.dt.crew.init.button('#dt_btn_new').enable();
        },

        sbSave: function () {
            var kode = $("#kode").val();
            var name = $("#name").val();

            $ummu.vars.formData.append("kode", kode);
            $ummu.vars.formData.append("name", name);

            var payload = {
                "kode": kode,
                "name": name,
            };

            const id = $ummu.url.getParam('id');

            if (id) {
                $ummu.vars.formData.append("_method", "PUT");
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
                $ummu.views.errors_msg(validation)
                $(".btn-endis").removeClass('btn-outline-secondary').addClass('btn-primary')
            }else{
                var ummu = $ummu.ajax.ummu7(params);   
                ummu.done(function(result) {
                    const response = JSON.parse(result);
                    $ummu.views.after_sbToolbar_save(response, func, id, payload);

                    // if (response.status == true) {
                    //     $("#file_url").attr("href", response.data.fileUrl)
                    //     let is_release = response.data.is_release;
                    //     if (is_release == null || is_release == '' || is_release == 0) {
                    //         $ummu.button.sbBtnToolbar.addRemove_btnRelease('add');
                    //     }else{
                    //         $ummu.button.sbBtnToolbar.addRemove_btnRelease('rm');
                    //     }
                    // }else{
                    //     $(".btn-endis").removeClass('btn-outline-secondary').addClass('btn-primary')
                    // }
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
            $("#modalDeleteConfirm").modal('hide')

            $ummu.vars.formData.append("_method", "DELETE");

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
            }).fail(function() {
                // An error occurred
                console.log(ummu)
            });
        },

        sbClear: function() {
            app.views.forClear()
        },

        on_btn_getData_click: function () {
            $ummu.views.after_sbToolbar_getData();
        },
    },

    validation: {
        save: function() {
            var list = [];
            list = $ummu.validation.inputValidate3();

            return list;
        },
    },

    views: {
        formParams: function() {
            return $("#form_input .endis");
        },

        setRow_toForm: function(row) {
            $ummu.views.tab_content('setRow_toForm')

            $("#kode").val(row.kode);
            $("#name").val(row.name);


            $ummu.views.setIdentitiyToForm(row)
            $ummu.button.sbBtn_on_showData()
        },

        forClear: function() {
            $("#form_input input").val('');

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
                        data: null,
                        render: DataTable.render.select() 
                    },
                    { 
                        data: null,
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
                        width: '55px',
                        // render: function (data, type, row) {
                        //     const is_mutabannat = row.is_mutabannat;
                        //     if (is_mutabannat === '1') {
                        //         return `<div class="text-muted">${data} <i class="far fa-lock"></i></div>`;
                        //     }else{
                        //         return (
                        //             `<a href="javascript:void(0);">
                        //                 <div><span>${data}</span> <i class="fas fa-external-link-alt ml-2"></i></div>
                        //             </a>`
                        //         );
                        //     }
                        // }
                    },
                    { 
                        title: "Kode",
                        data: "kode"
                    },
                    { 
                        title: "Name",
                        data: "name"
                    },
                ];
        
                return columns;
            },
            onClick_nthChild_2: function(row) {
                // 1. Tambahkan url param dari row
                $ummu.url.setParamFromRow(row)

                app.views.setRow_toForm(row);
                $ummu.views.tab_content('setRow_toForm')
            },
        },
    },
};

$(document).ready(function () {
    app.config.autoload()
});