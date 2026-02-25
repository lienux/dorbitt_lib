var globalVar = {
    qUrl: $base_url + "admin/she_hazard_report/",
    pageUrl: $base_url + "admin/she_hazard_report/",
    approval_authorization_level: null,
    errors_params: [],
    agreement: localStorage.getItem("agreement"),
};

var app = {
    register: function () {
        app.config.autoload();
        app.events.persetujuan_change();
        // app.events.btn_lanjutkan_click();
        // app.events.btn_back_click();
        app.events.btn_show_date();
        app.events.btn_release();
    },
    config: {
        autoload: function () {
            app.dt.load();
            app.events.btn_delete();

            $(".clockpicker").clockpicker({
                // placement: 'top',
                autoclose: true,
                align: "left",
                donetext: "Done",
                default: "now",
            });

            $("#tgl_penemuan").datepicker({
                dateFormat: "yy-mm-dd",
                uiLibrary: "bootstrap4",
                modal: true,
                header: true,
                footer: true,
            });

            // $('#nav-notreleased-tab').click(function(){
            //     table.ajax.url(globalVar.qUrl + 'show?release[]=0').load();
            // })

            $("#nav-released-tab").click(function () {
                table.ajax.url(globalVar.qUrl + "show?release=1").load();
                $ummu.vars.nav_tab = 1;
                app.dt.load();
            });

            $("#nav-approved-tab").click(function () {
                table.ajax.url(globalVar.qUrl + "show?release=2").load();
                $ummu.vars.nav_tab = 2;
                app.dt.load();
            });

            $("#nav-rejected-tab").click(function () {
                table.ajax.url(globalVar.qUrl + "show?release=3").load();
                $ummu.vars.nav_tab = 3;
                app.dt.load();
            });

            $ummu.func.location_hash();
            // $ummu.events.onChange.inputFile_onChange_fileUpload();
            // $ummu.mygallery.photos.btn_mygallery_photos_submit_on_modal();

            $("#btn_do_approve").on("click", function () {
                $ummu.ajax.hazard_report.approve();
            });

            $("#btn_do_reject").on("click", function () {
                var validataion = $ummu.validation.hazard_report.reject();
                if (validataion == false) {
                    $("#modal_message").modal("show");
                } else {
                    $ummu.ajax.hazard_report.reject();
                }
            });

            /* $(document).on("click", "#modal_btn_edit", function () {
            // $ummu.views.button.hazard_report.on_modal_form_edit();
            $ummu.button.hazard_report.modal_form(["edit", "save", "cancel"]);
            $("#modal_btn_edit").prop("disabled", true);
            $ummu.mygallery.show_mygallery = true;
            $(".endis-edit").prop("disabled", false);
            $(".lbl-info").removeClass("collapse");
            }); */

            $(document).on("click", "#modal_btn_cancel", function () {
                // $ummu.views.button.hazard_report.on_modal_form_edit();
                $ummu.button.hazard_report.modal_form(["edit"]);
                $("#modal_btn_edit").prop("disabled", false);
                $ummu.mygallery.show_mygallery = false;
                $(".endis").prop("disabled", true);
                $(".lbl-info").addClass("collapse");
            });

            $(document).on("click", ".btn-save", function () {
                var id = $(this).attr("id");
                var validataion = $ummu.validation.hazard_report.insert();
                if (validataion == false) {
                    $("#modal_message").modal("show");
                } else {
                    if (id == "modal_btn_save") {
                        app.controllers.create();
                    } else if (id == "modal_btn_update") {
                        app.controllers.update();
                    }
                }
            });

            $(document).on("click", "#modal_btn_reject", function () {
                $("#modal_reject_confirm").modal("show");
            });

            $(document).on("click", "#modal_btn_approve", function () {
                $("#modal_approve_confirm").modal("show");
            });

            if (globalVar.agreement === "1") {
                $("#persetujuan").attr("checked", true);
                $("#lanjutkan").attr("disabled", false);
            } else {
                $("#lanjutkan").attr("disabled", true);
            }

            $("#modal_form").on("shown.bs.modal", function () {
                $("select").select2({
                    theme: "bootstrap4",
                    placeholder: "Choose...",
                    allowClear: true,
                    dropdownParent: $("#modal_form"),
                });
            });

            $(".nav-link").removeClass("active");
            $(".nav-link").on("click", function () {
                $ummu.views.hazard_report.layout();
            });

            if (localStorage.getItem("nav_tab_id") == "nav-approved-tab") {
                $ummu.vars.nav_tab_id = "nav-approved-tab";
                $ummu.vars.nav_tab = 2;
                // $ummu.dt.nth_child_onclick = 2;

                $("#nav-approved-tab").addClass("active");
                table.ajax.url(globalVar.qUrl + "show?release=2").load();
                app.dt.load();
            } else if (localStorage.getItem("nav_tab_id") == "nav-rejected-tab") {
                $ummu.vars.nav_tab_id = "nav-rejected-tab";
                $ummu.vars.nav_tab = 3;
                // $ummu.dt.nth_child_onclick = 2;

                $("#nav-rejected-tab").addClass("active");
                table.ajax.url(globalVar.qUrl + "show?release=3").load();
                app.dt.load();
            } else {
                $("#nav-released-tab").addClass("active");
                $ummu.vars.nav_tab_id = "nav-released-tab";
                $ummu.vars.nav_tab = 1;
                // $ummu.dt.nth_child_onclick = 3;

                table.ajax.url(globalVar.qUrl + "show?release=1").load();
                app.dt.load();
            }

            $ummu.vars.nav_tab_id = localStorage.getItem("nav_tab_id");

            // if ($ummu.vars.nav_tab_id == 'nav-released-tab') {
            //     // var body_tr_td = 'tbody tr td:nth-child(3)';
            //     table.on('click', 'tbody tr td:nth-child(3)', function () {
            //         var row = table.row(this).data();
            //         console.log(row);
            //         app.views.set_row_to_form(row);
            //         $('#modal_form').modal('show');

            //         if ($ummu.vars.nav_tab_id == 'nav-released-tab') {
            //             var btninmodal = ['approve','reject'];
            //             $ummu.button.hazard_report.modal_form(btninmodal);
            //         }else{
            //             $ummu.button.hazard_report.modal_form([]);
            //         }
            //     });
            // }else{
            //     // var body_tr_td = 'tbody tr td:nth-child(2)';
            //     table.on('click', 'tbody tr td:nth-child(2)', function () {
            //         var row = table.row(this).data();
            //         console.log(row);
            //         app.views.set_row_to_form(row);
            //         $('#modal_form').modal('show');

            //         if ($ummu.vars.nav_tab_id == 'nav-released-tab') {
            //             var btninmodal = ['approve','reject'];
            //             $ummu.button.hazard_report.modal_form(btninmodal);
            //         }else{
            //             $ummu.button.hazard_report.modal_form([]);
            //         }
            //     });
            // }

            table.on("click", "tbody tr td:nth-child(3)", function () {
                var row = table.row(this).data();
                $ummu.vars.is_row = true;
                app.controllers.detail(row);
            });

            $("#lanjutkan").on("click", function () {
                $(".modal-footer .btn-save").attr("id", "btn_save");
                $("#modal_agreement").modal("hide");
                $("#modal_form").modal("show");

                var btninmodal = ["back", "save"];
                $ummu.button.hazard_report.modal_form(btninmodal);
            });

            $(document).on("click", "#btn_back", function () {
                $("#modal_form").modal("hide");
                $("#modal_agreement").modal("show");
            });
        },
    },
    events: {
        persetujuan_change: function () {
            $("#persetujuan").change(function () {
                if (this.checked) {
                    $("#lanjutkan").attr("disabled", false);
                    localStorage.setItem("agreement", 1);
                } else {
                    $("#lanjutkan").attr("disabled", true);
                    localStorage.setItem("agreement", 0);
                }
            });
        },
        btn_lanjutkan_click: function () {
            // $('#lanjutkan').on('click', function(){
            //     $('.modal-footer .btn-save').attr('id', 'btn_save');
            //     $('#modal_agreement').modal('hide');
            //     $('#modal_form').modal('show');
            //     var btninmodal = ['back','save'];
            //     $ummu.button.hazard_report.modal_form(btninmodal);
            // })
        },
        btn_back_click: function () {
            // $(document).on('click', "#btn_back", function() {
            //     $('#modal_form').modal('hide');
            //     $('#modal_agreement').modal('show');
            // });
        },
        btn_show_date: function () {
            // $("#btn_show_date").on("click", function () {
            //     $("#tgl_penemuan").datepicker("show");
            // });
        },
        btn_delete: function () {
            $("#modal_btn_delete").on("click", function () {
                app.controllers.multiple_delete($ummu.vars.rows);
            });
        },
        btn_release: function () {
            $("#btn_do_release").on("click", function () {
                $ummu.ajax.hazard_report.release();
            });
        },
    },
    controllers: {
        show: function (params) {
            // console.log(params)
            var url = globalVar.qUrl;
            var ummu = $globalAjax.ummu(url, params);
            ummu
            .done(function (result) {
                var response = JSON.parse(result);
                params.success(response);
                $globFunc.ch_message(response.message);
                // app.Controllers.show_gedung()
                // app.Controllers.show_roomcateg()
            })
            .fail(function () {
                // An error occurred
            });
        },
        new: function () {
            $ummu.mygallery.show_mygallery = true;
            $(".endis").prop("disabled", false);
            $(".lbl-info").removeClass("collapse");

            var url = $ummu.vars.page_url + "number";
            var params = [];
            var ummu = $globalAjax.ummu(url, params);
            ummu
            .done(function (result) {
                var response = JSON.parse(result);
                var number = response[0];
                // console.log(response[0])
                $ummu.vars.safety.hazard_report.document_number = number;
                $("#doc_number").val(number);
            })
            .fail(function () {
                // An error occurred
            });

            $ummu.views.clear_modal_form();

            $("#modal_agreement").modal("show");
        },
        detail: function (row) {
            $ummu.vars.row = row;
            $ummu.vars.id = row.id;
            $ummu.mygallery.show_mygallery = false;
            $(".endis").prop("disabled", true);
            $(".lbl-info").addClass("collapse");

            var text = $ummu.vars.crud;
            if (text != "" || text != 0 || text != null) {
                var crud = text.split(",");
            } else {
                var crud = "";
            }

            // $('#btn_back').addClass('collapse');
            // $('#btn_').addClass('collapse');
            // $('.btn-save').attr('id', 'btn_update');
            // app.views.set_row_to_form(row);
            // $('#modal_form').modal('show');
            // $ummu.views.hazard_report.btn_edit();

            app.views.set_row_to_form(row);
            $("#modal_form").modal("show");

            if ($ummu.vars.nav_tab_id == "nav-released-tab") {
                if (crud[3] == 1) {
                    var btninmodal = ["approve", "reject"];
                } else {
                    var btninmodal = [];
                }
                $ummu.button.hazard_report.modal_form(btninmodal);
            } else {
                $ummu.button.hazard_report.modal_form([]);
            }

            if ($ummu.vars.nav_tab_id == "nav-rejected-tab") {
                $("#div_remark").removeClass("collapse");
                // $ummu.button.hazard_report.modal_form(["edit"]);
            } else {
                $("#div_remark").addClass("collapse");
            }

            // if ($ummu.vars.nav_tab_id == 'nav-approved-tab' || $ummu.vars.nav_tab_id == 'nav-rejected-tab') {
            //     $('#div_remark').removeClass('collapse');
            // }else{
            //     $('#div_remark').addClass('collapse');
            // }
        },
        edit: function (row) {
            $ummu.vars.row = row;
            $ummu.vars.id = row.id;
            $ummu.mygallery.show_mygallery = false;
            $(".endis").prop("disabled", true);
            $(".lbl-info").addClass("collapse");

            var text = $ummu.vars.crud;
            if (text != "" || text != 0 || text != null) {
                var crud = text.split(",");
            } else {
                var crud = "";
            }

            /* $('#btn_back').addClass('collapse');
            $('#btn_').addClass('collapse');
            $('.btn-save').attr('id', 'btn_update');
            app.views.set_row_to_form(row);
            $('#modal_form').modal('show');
            $ummu.views.hazard_report.btn_edit(); */

            app.views.set_row_to_form(row);
            $("#modal_form").modal("show");

            /* if ($ummu.vars.nav_tab_id == "nav-released-tab") {
            if (crud[3] == 1) {
            var btninmodal = ["approve", "reject"];
            } else {
            var btninmodal = [];
            }
            $ummu.button.hazard_report.modal_form(btninmodal);
            } else {
            $ummu.button.hazard_report.modal_form([]);
            } */

            /* if ($ummu.vars.nav_tab_id == "nav-rejected-tab") {
            $("#div_remark").removeClass("collapse");
            // $ummu.button.hazard_report.modal_form(["edit"]);

            $ummu.button.hazard_report.modal_form(["save"]);
            // $("#modal_btn_edit").prop("disabled", true);
            $ummu.mygallery.show_mygallery = true;
            $(".endis-edit").prop("disabled", false);
            $(".lbl-info").removeClass("collapse");
            } else {
            $("#div_remark").addClass("collapse");
            } */

            $("#div_remark").removeClass("collapse");
            // $ummu.button.hazard_report.modal_form(["edit"]);

            $ummu.button.hazard_report.modal_form(["update"]);
            // $("#modal_btn_edit").prop("disabled", true);
            $ummu.mygallery.show_mygallery = true;
            $(".endis-edit").prop("disabled", false);
            $(".lbl-info").removeClass("collapse");

            /* if ($ummu.vars.nav_tab_id == 'nav-approved-tab' || $ummu.vars.nav_tab_id == 'nav-rejected-tab') {
            $('#div_remark').removeClass('collapse');
            }else{
            $('#div_remark').addClass('collapse');
            } */
        },
        create: function () {
            var payload = JSON.stringify({
                body: {
                    nomor_dokumen: $ummu.vars.safety.hazard_report.document_number,
                    tgl_temuan: $("#tgl_penemuan").val(),
                    waktu_temuan: $("#waktu_penemuan").val(),
                    lokasi_temuan_id: $("#lokasi_penemuan").val(),
                    lokasi_temuan_text: $("#lokasi_penemuan").find(":selected").text(),
                    detail_lokasi: $("#detail_lokasi").val(),
                    jenis_temuan_id: $("#jenis_temuan").val(),
                    bahaya_ditemukan: $("#bahaya_ditemukan").val(),
                    penyebab_bahaya: $("#penyebab_bahaya").val(),
                    kode_bahaya_id: $("#kode_bahaya").val(),
                    foto_temuan_id: $("#foto_temuan").attr("data-id"),
                    rincian_tindakan: $("#rincian_tindakan").val(),
                    foto_perbaikan_id: $("#foto_perbaikan").attr("data-id"),
                    status_id: $("input:radio[name=status]:checked").val(),
                    nm_atasan: $("#nm_atasan").val(),
                },
            });
            // console.log(JSON.parse(payload));

            var params = {
                url: globalVar.qUrl + "create",
                type: "post",
                action: "insert",
                data: payload,
                cache: true,
                contentType: "application/json",
                dataType: "json",
            };
            // console.log(params)
            $("#text_loader").html("Saving process...");
            var ummu = $ummu.ajax.ummu3(params);
            ummu
            .done(function (result) {
                // console.log(result);
                // var response = JSON.parse(result);
                var response = result;
                // console.log(response.status)
                if (response.status == true) {
                    table.ajax.reload();
                    $("#modal_form").modal("hide");
                    // $('#modal_loader').modal('hide');
                    // app.Views.set_value_to_table('insert',response.response);
                    $globFunc.ch_message(response.message);
                    // app.Events.clear_form();
                    setTimeout(function () {
                        $("#modal_loader").modal("hide");
                    }, 1000);
                } else {
                    $("#message_title, #text_message").empty();
                    var message = response.message;
                    var errors = response.errors;
                    $("#message_title").html(message);
                    for (let index in errors) {
                        var $error =
                        '<div class="alert alert-danger alert-dismissible fade show" role="alert">' +
                            '<i class="bi bi-exclamation-octagon me-1"></i>' +
                            errors[index] +
                        "</div>";
                        $("#text_message").append($error);
                    }
                    $("#message_modal").modal("show");
                    setTimeout(function () {
                        $("#modal_loader").modal("hide");
                    }, 1000);
                }
                $ummu.dt.after_cud();
            })
            .fail(function () {
                // An error occurred
                console.log(ummu);
            });
        },
        update: function () {
            var payload = JSON.stringify({
                body: {
                    tgl_temuan: $("#tgl_penemuan").val(),
                    waktu_temuan: $("#waktu_penemuan").val(),
                    lokasi_temuan_id: $("#lokasi_penemuan").val(),
                    detail_lokasi: $("#detail_lokasi").val(),
                    jenis_temuan_id: $("#jenis_temuan").val(),
                    bahaya_ditemukan: $("#bahaya_ditemukan").val(),
                    penyebab_bahaya: $("#penyebab_bahaya").val(),
                    kode_bahaya_id: $("#kode_bahaya").val(),
                    foto_temuan_id: $("#foto_temuan").attr("data-id"),
                    rincian_tindakan: $("#rincian_tindakan").val(),
                    foto_perbaikan_id: $("#foto_perbaikan").attr("data-id"),
                    status_id: $("input:radio[name=status]:checked").val(),
                    nm_atasan: $("#nm_atasan").val(),
                    site_project_kode: $ummu.vars.site_project_kode,
                    nav_tab_id: $ummu.vars.nav_tab_id,
                },
            });
            // console.log(JSON.parse(payload));

            var params = {
                url: globalVar.qUrl + "update/" + $ummu.vars.id,
                type: "put",
                action: "update",
                data: payload,
                cache: true,
                contentType: "application/json",
                dataType: "json",
            };
            // console.log(params)
            $("#text_loader").html("Update process...");

            var ummu = $ummu.ajax.ummu3(params);
            ummu
            .done(function (result) {
                // console.log(result);
                // var response = JSON.parse(result);
                var response = result;
                // console.log(response.status)
                if (response.status == true) {
                    table.ajax.reload();
                    $("#modal_form").modal("hide");
                    // $('#modal_loader').modal('hide');
                    // app.Views.set_value_to_table('insert',response.response);
                    $globFunc.ch_message(response.message);
                    // app.Events.clear_form();
                    setTimeout(function () {
                        $("#modal_loader").modal("hide");
                    }, 1000);
                } else {
                    // $('#message_title, #text_message').empty();
                    // var message = response.message;
                    // var errors = response.errors;
                    // $('#message_title').html(message);
                    // for(let index in errors){
                    //     var $error = '<div class="alert alert-danger alert-dismissible fade show" role="alert">'+
                    //                     '<i class="bi bi-exclamation-octagon me-1"></i>'+
                    //                     errors[index]+
                    //                  '</div>';
                    //     $('#text_message').append($error);
                    // }
                    // $('#message_modal').modal('show');
                    setTimeout(function () {
                        $("#modal_loader").modal("hide");
                    }, 1000);
                }
                $ummu.dt.after_cud();
            })
            .fail(function () {
                // An error occurred
                console.log(ummu);
            });
        },
        multiple_delete: function (rows) {
            var r = [];
            $.each(rows, function (index, value) {
            r[index] = {};

            r[index] = value.id;
            // r[index].appv_remark = "by multiple approve";
            // r[index].doc_number = value.doc_code;

            // var d = [];
            // $.each(value.detail, function( index2, value2) {
            //     d[index2] = {};

            //     // d[index2].status = 1;
            //     // d[index2].comment = "by multiple approve";
            //     // d[index2].part_code = value2.Prod_code;
            //     // d[index2].part_qty = value2.part_qty;
            //     // d[index2].harga = value2.harga;
            //     // d[index2].disc = value2.Disc;
            //     // d[index2].nomer = value2.nomer;
            //     d[index2].id = value2.id;
            // })

            // r[index].details = d;
            });

            var payload = JSON.stringify({
            body: {
            ids: r,
            },
            });

            // console.log(payload)

            // var payload = JSON.stringify(
            // {
            //     "body": {
            //         "ids": $ummu.func.getIdSelections()
            //     }
            // });

            var params = {
            type: "delete",
            action: "multiple_delete",
            data: payload,
            cache: true,
            contentType: "application/json",
            dataType: "json",
            };
            $("#text_loader").html("Delete process...");
            var url = globalVar.qUrl + "delete";
            var ummu = $ummu.ajax.ummay(url, params);
            $("#modal_delete_confirm").modal("hide");
            ummu
            .done(function (result) {
            var response = JSON.parse(result);
            // console.log(response)
            if (response.status == true) {
            table.rows(".selected").remove().draw();
            // $('#modal_delete_confirm').modal('hide');
            //     $globFunc.ch_message(response.message);
            //     $table.bootstrapTable('remove', {
            //         field: 'id',
            //         values: $globFunc.getIdSelections()
            //     })
            //     $remove.prop('disabled', true)
            } else {
            //     $('#modal_alert_input').html("");
            //     var errors = response.errors;
            //     $('#modal_alert_input').addClass('bg-danger');
            //     for(let index in errors){
            //         $('#modal_alert_input').append("<li>"+errors[index]+"</li>");
            //     }
            //     $('#modal_alert_input').fadeIn().delay(3000).fadeOut();
            }
            // $('#modal_confirmation_multiple_delete').modal('hide')
            $ummu.dt.after_cud();
            })
            .fail(function () {
            // An error occurred
            console.log(ummu);
            });
        },

        /* number_document: function() {
        var url = $ummu.vars.page_url + 'number';
        var params = [];
        var ali = $globalAjax.ummu(url,params);
        ali.done(function(result) {
        var response = JSON.parse(result);
        console.log(response[0])
        }).fail(function() {
        // An error occurred
        });
        } */
    },
    views: {
        set_to_cash: function () {
            $("#cash").empty();
            var rows = JSON.parse(localStorage.getItem("usp_0101_SHB_0009")).rows;
            for (let index in rows) {
            var text = rows[index].KoKas + " - " + rows[index].NamKas;
            $("#cash").append(
            "<option value='" + rows[index].KoKas + "'>" + text + "</option>"
            );
            }
        },
        set_row_to_form: function (row) {
            // console.log(row)

            if (row.is_release == 0) {
            var badgecolor = "badge-secondary";
            } else if (row.is_release == 1) {
            var badgecolor = "badge-warning";
            } else if (row.is_release == 2) {
            var badgecolor = "badge-success";
            } else if (row.is_release == 3) {
            var badgecolor = "badge-danger";
            } else {
            var badgecolor = "";
            }

            if (row.foto_temuan_url) {
            var foto_temuan = row.foto_temuan_url;
            } else {
            var foto_temuan = $base_url + "uploads/no_image.jpg";
            }

            if (row.foto_perbaikan_url) {
            var foto_perbaikan = row.foto_perbaikan_url;
            } else {
            var foto_perbaikan = $base_url + "uploads/no_image.jpg";
            }

            // var row = rows[0];
            $("#doc_number").val(row.nomor_dokumen);
            $("#status").html(
            '<span class="badge ' + badgecolor + '">' + row.release_name + "</span>"
            );
            $("#tgl_penemuan").val(row.tgl_temuan);
            $("#waktu_penemuan").val(row.waktu_temuan.substring(0, 5));
            $("#lokasi_penemuan").val(row.lokasi_temuan_id);
            $("#detail_lokasi").val(row.detail_lokasi);
            $("#jenis_temuan").val(row.jenis_temuan_id);
            $("#kode_bahaya").val(row.kode_bahaya_id);
            $("#bahaya_ditemukan").val(row.bahaya_ditemukan);
            $("#penyebab_bahaya").val(row.penyebab_bahaya);
            $("#rincian_tindakan").val(row.rincian_tindakan);
            $("#nm_atasan").val(row.nm_atasan);
            $("#modal_form #remark").val(row.remark);

            $("#img_foto_temuan").attr("src", foto_temuan);
            $("#foto_temuan").attr("data-id", row.foto_temuan_id);

            $("#img_foto_perbaikan").attr("src", foto_perbaikan);
            $("#foto_perbaikan").attr("data-id", row.foto_perbaikan_id);

            if (row.status_id == null || row.status_id == "" || row.status_id == 0) {
            var status_id = 0;
            } else {
            var status_id = row.status_id;
            }
            $("input:radio[value=" + status_id + "]").prop("checked", true);

            $("#created_at").html(row.created_at);
            $("#created_by").html(row.created_by_name);

            $("#approved_at").html(row.approved_at);
            $("#approved_by").html(row.approved_by_name);

            $("#rejected_at").html(row.rejected_at);
            $("#rejected_by").html(row.rejected_by_name);
        },
    },
    dt: {
        config: function () {
            if ($ummu.vars.nav_tab == 2) {
                var urlurl = globalVar.qUrl + "show?release=2";
            } else if ($ummu.vars.nav_tab == 3) {
                var urlurl = globalVar.qUrl + "show?release=3";
            } else if ($ummu.vars.nav_tab == 1) {
                var urlurl = globalVar.qUrl + "show?release=1";
            } else {
                var urlurl = globalVar.qUrl + "kosong";
            }

            return {
                ajax: {
                    dataSrc: "rows",
                    url: urlurl,
                    data: function (d) {
                        d.myKey = "myValue";
                        // d.custom = $('#myInput').val();
                        // d.release = [0];
                        // etc
                    },
                },
                processing: true,
                serverSide: true,
                responsive: true,
                keys: true,
                // language: { "processing": "Hang on. Waiting for data.." },
                deferLoading: 57,
                lengthMenu: [10, 50, 100, { label: "All", value: -1 }],
                layout: {
                    topStart: {
                        buttons: [],
                    },
                },
                columnDefs: [
                {
                    targets: 0,
                    orderable: false,
                    render: DataTable.render.select(),
                },
                // {
                //     target: 1,
                //     visible: false,
                //     searchable: false
                // },
                // {
                //     target: 2,
                //     visible: false,
                //     searchable: false
                // },
                // {
                //     target: 3,
                //     visible: false,
                //     searchable: false
                // }
                ],
                // fixedColumns: {
                //     start: 3
                // },
                order: [[0, "desc"]],
                // rowGroup: {
                //     dataSrc: 'region_name'
                // },
                scrollCollapse: true,
                scrollX: true,
                scrollY: 360,
                select: $ummu.dt.config.select(),
                columns: app.dt.config_columns(),
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
                },
            };
        },
        load: function () {
            $ummu.dt.layout.button_crud();
            $ummu.dt.button.crud();
            $ummu.dt.select.load();
        },
        config_columns: function () {
            let columns = [
                { data: null, render: DataTable.render.select() },
                // {   data: 'id',
                //     render: function() {
                //         return '';
                //     }
                // },
                // {   data: 'foto_temuan_url',
                //     render: function (data, type) {
                //         return '<img src="'+data+'" class="img-thumbnail" alt="..." width="100px">';
                //     }
                // },
                // {   data: 'foto_perbaikan_url',
                //     render: function (data, type) {
                //         return '<img src="'+data+'" class="img-thumbnail" alt="..." width="100px">';
                //     }
                // },
                { data: "site_project_kode" },
                { data: "nomor_dokumen",
                    render: function (data, type) {
                        if ($ummu.vars.nav_tab == 1) {
                            var warna = "text-info";
                        } else if ($ummu.vars.nav_tab == 2) {
                            var warna = "text-success";
                        } else {
                            var warna = "text-danger";
                        }

                        // return '<a href="#" id="'+data+'"> <span class="'+warna+'">'+data+'</span></a>';
                        // return '<a href="javascript:void(0);">' + data + ' <i class="fas fa-external-link-alt ml-2"></i></a>';
                        return (
                            '<a href="javascript:void(0);">'+
                                '<div><span class="' + warna + '">' + data + '</span> <i class="fas fa-external-link-alt ml-2"></i></div>'+
                            '</a>'
                        );
                    },
                },
                { data: "name" },
                { data: "nikaryawan" },
                { data: "tgl_temuan" },
                { data: "waktu_temuan" },
                { data: "lokasi_temuan_name" },
                { data: "detail_lokasi" },
                { data: "jenis_temuan_longname" },
                { data: "bahaya_ditemukan" },
                { data: "penyebab_bahaya" },
                { data: "kode_bahaya_longname" },
                { data: "status_name"},
                { data: "nm_atasan"},
                { data: "remark" },
                { data: "created_at" },
                { data: "approved_by_name" },
                { data: "rejected_by_name" },
            ];

            return columns;
        },  
        config_columnDefs: function() {
            let columnDefs = [
                {
                    targets: 0,
                    orderable: false,
                    render: DataTable.render.select(),
                },
                { 
                    targets: [26,27], 
                    visible: false 
                },
            ];
            return columnDefs;
        },  
        config_rowGroup: function() {
            let rowGroup = {
                dataSrc: ["tipe","unit_code"],
                startRender: function (rows, group) {
                    // Display the group name and the number of rows in that group
                    return group + " (" + rows.count() + " rows)";
                },
                endRender: function (rows, group, level) {
                    // =======================================================
                    // OB ====================================================
                    // =======================================================
                    var day_rit_ob_count = rows
                    .data()
                    .pluck('day_rit_ob')
                    .reduce( function (a, b) {
                        return parseFloat(a) + parseFloat(b);
                    }, 0) ;

                    var night_rit_ob_count = rows
                    .data()
                    .pluck('night_rit_ob')
                    .reduce( function (a, b) {
                        return parseFloat(a) + parseFloat(b);
                    }, 0) ;

                    var total_rit_ob_count = rows
                    .data()
                    .pluck('total_rit_ob')
                    .reduce( function (a, b) {
                        return parseFloat(a) + parseFloat(b);
                    }, 0) ;

                    var day_ob_count = rows
                    .data()
                    .pluck('day_ob')
                    .reduce( function (a, b) {
                        return parseFloat(a) + parseFloat(b);
                    }, 0) ;

                    var night_ob_count = rows
                    .data()
                    .pluck('night_ob')
                    .reduce( function (a, b) {
                        return parseFloat(a) + parseFloat(b);
                    }, 0) ;

                    var total_ob_count = rows
                    .data()
                    .pluck('total_ob')
                    .reduce( function (a, b) {
                        return parseFloat(a) + parseFloat(b);
                    }, 0) ;


                    // =========================================================
                    // Coal Getting ============================================
                    // =========================================================
                    var day_rit_cg_count = rows
                    .data()
                    .pluck('day_rit_cg')
                    .reduce( function (a, b) {
                        return parseFloat(a) + parseFloat(b);
                    }, 0) ;

                    var night_rit_cg_count = rows
                    .data()
                    .pluck('night_rit_cg')
                    .reduce( function (a, b) {
                    return parseFloat(a) + parseFloat(b);
                    }, 0) ;

                    var total_rit_cg_count = rows
                    .data()
                    .pluck('total_rit_cg')
                    .reduce( function (a, b) {
                        return parseFloat(a) + parseFloat(b);
                    }, 0) ;

                    var day_cg_count = rows
                    .data()
                    .pluck('day_cg')
                    .reduce( function (a, b) {
                        return parseFloat(a) + parseFloat(b);
                    }, 0) ;

                    var night_cg_count = rows
                    .data()
                    .pluck('night_cg')
                    .reduce( function (a, b) {
                        return parseFloat(a) + parseFloat(b);
                    }, 0) ;

                    var total_cg_count = rows
                    .data()
                    .pluck('total_cg')
                    .reduce( function (a, b) {
                        return parseFloat(a) + parseFloat(b);
                    }, 0) ;


                    // =========================================================
                    // Coal Hauling ============================================
                    // =========================================================
                    var day_rit_cl_count = rows
                    .data()
                    .pluck('day_rit_cl')
                    .reduce( function (a, b) {
                        return parseFloat(a) + parseFloat(b);
                    }, 0) ;

                    var night_rit_cl_count = rows
                    .data()
                    .pluck('night_rit_cl')
                    .reduce( function (a, b) {
                        return parseFloat(a) + parseFloat(b);
                    }, 0) ;

                    var total_rit_cl_count = rows
                    .data()
                    .pluck('total_rit_cl')
                    .reduce( function (a, b) {
                        return parseFloat(a) + parseFloat(b);
                    }, 0) ;

                    var day_cl_count = rows
                    .data()
                    .pluck('day_cl')
                    .reduce( function (a, b) {
                        return parseFloat(a) + parseFloat(b);
                    }, 0) ;

                    var night_cl_count = rows
                    .data()
                    .pluck('night_cl')
                    .reduce( function (a, b) {
                        return parseFloat(a) + parseFloat(b);
                    }, 0) ;

                    var total_cl_count = rows
                    .data()
                    .pluck('total_cl')
                    .reduce( function (a, b) {
                        return parseFloat(a) + parseFloat(b);
                    }, 0) ;

                    // ===========================================================================
                    var fuel_count = rows
                    .data()
                    .pluck('fuel')
                    .reduce( function (a, b) {
                        return parseFloat(a) + parseFloat(b);
                    }, 0) ;


                    if (level === 0) {
                        let tr = document.createElement('tr');
                        let classs = $ummu.dt.endRender_class();
                        $ummu.dt.addCell(tr, group, 2, classs);
                        $ummu.dt.addCell(tr, $ummu.helpers.currency.us(day_rit_ob_count),null,classs);
                        $ummu.dt.addCell(tr, $ummu.helpers.currency.us(night_rit_ob_count),null,classs);
                        $ummu.dt.addCell(tr, $ummu.helpers.currency.us(total_rit_ob_count),null,classs);
                        $ummu.dt.addCell(tr, $ummu.helpers.currency.us(day_ob_count),null,classs);
                        $ummu.dt.addCell(tr, $ummu.helpers.currency.us(night_ob_count),null,classs);
                        $ummu.dt.addCell(tr, $ummu.helpers.currency.us(total_ob_count),null,classs);

                        $ummu.dt.addCell(tr, $ummu.helpers.currency.us(day_rit_cg_count),null,classs);
                        $ummu.dt.addCell(tr, $ummu.helpers.currency.us(night_rit_cg_count),null,classs);
                        $ummu.dt.addCell(tr, $ummu.helpers.currency.us(total_rit_cg_count),null,classs);
                        $ummu.dt.addCell(tr, $ummu.helpers.currency.us(day_cg_count),null,classs);
                        $ummu.dt.addCell(tr, $ummu.helpers.currency.us(night_cg_count),null,classs);
                        $ummu.dt.addCell(tr, $ummu.helpers.currency.us(total_cg_count),null,classs);

                        $ummu.dt.addCell(tr, $ummu.helpers.currency.us(day_rit_cl_count),null,classs);
                        $ummu.dt.addCell(tr, $ummu.helpers.currency.us(night_rit_cl_count),null,classs);
                        $ummu.dt.addCell(tr, $ummu.helpers.currency.us(total_rit_cl_count),null,classs);
                        $ummu.dt.addCell(tr, $ummu.helpers.currency.us(day_cl_count),null,classs);
                        $ummu.dt.addCell(tr, $ummu.helpers.currency.us(night_cl_count),null,classs);
                        $ummu.dt.addCell(tr, $ummu.helpers.currency.us(total_cl_count),null,classs);                

                        $ummu.dt.addCell(tr, $ummu.helpers.currency.us(fuel_count),null,classs);
                        $ummu.dt.addCell(tr, '', 5, classs);
                        return tr;
                    } else if (level === 1) {
                        let tr = document.createElement('tr');
                        let classs = 'text-right font-weight-bold bg-warning';
                        $ummu.dt.addCell(tr, '', 4);
                        $ummu.dt.addCell(tr, $ummu.helpers.currency.us(total_rit_ob_count),null,classs);
                        $ummu.dt.addCell(tr, '', 2);
                        $ummu.dt.addCell(tr, $ummu.helpers.currency.us(total_ob_count),null,classs);
                        $ummu.dt.addCell(tr, '', 2);
                        $ummu.dt.addCell(tr, $ummu.helpers.currency.us(total_rit_cg_count),null,classs);
                        $ummu.dt.addCell(tr, '', 2);
                        $ummu.dt.addCell(tr, $ummu.helpers.currency.us(total_cg_count),null,classs);
                        $ummu.dt.addCell(tr, '', 2);
                        $ummu.dt.addCell(tr, $ummu.helpers.currency.us(total_rit_cl_count),null,classs);
                        $ummu.dt.addCell(tr, '', 2);
                        $ummu.dt.addCell(tr, $ummu.helpers.currency.us(total_cl_count),null,classs);
                        $ummu.dt.addCell(tr, $ummu.helpers.currency.us(fuel_count),null,classs);
                        $ummu.dt.addCell(tr, '', 5);            
                        return tr;
                    }          
                }
            };

            return rowGroup;
        },
    },
};

var table = new DataTable(table_id, app.dt.config());

$(document).ready(function () {
    if (!localStorage.getItem("nav_tab_id")) {
        localStorage.setItem("nav_tab_id", "nav-released-tab");
    }
    app.register.apply();
    $ummu.views.hazard_report.layout();
});
