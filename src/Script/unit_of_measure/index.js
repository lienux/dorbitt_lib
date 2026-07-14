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
            var vessel_name = $("#tugboat").val();
            var vessel_id = $("#tugboat").attr('data-id');
            // var dtRows = $ummu.dt.controllers.getRows(app.dt.crew.init);

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