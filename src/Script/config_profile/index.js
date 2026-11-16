var app = {
    register: function () {
        app.config.autoload();
    },
    config: {
        autoload: function () {
            $ummu.func.location_hash();
            $ummu.mygallery.show_mygallery = true;
            $ummu.config.mygallery();
            app.controllers.show();

            $("#btn_sysnc_to_herp").on("click", function () {
                // var id = $(this).attr("id");
                // var validataion = $ummu.validation.mechanic_activity.insert();
                // if (validataion == false) {
                //   $("#modal_message").modal("show");
                // } else {
                //   if (id == "modal_btn_save") {
                //     app.controllers.create();
                //   } else if (id == "modal_btn_update") {
                //     app.controllers.update();
                //   }
                // }
                app.controllers.sync_to_herp();
            });

            $("#btn_update_profile").on("click", function () {
                app.controllers.update_profile();
            });

            $("#btn_reload_profile").on("click", function() {
                app.controllers.show();
            })

            $('#btn_update_password').on('click', function() {
                app.controllers.update_password();
            })
        },
    },
    controllers: {
        show: function() {
            var params = {
                "path": 'admin/config_profile/show',
                "type": "GET",
                "data": [],
                "cache": true,
                "contentType": "application/json",
                "dataType": "json",
                "loader": true,
            };

            var ummu = $ummu.ajax.ummu9(params);   
            ummu.done(function(result) {
                console.log(result)
                // console.log(result.status)
                const response = result;
                // const response = JSON.parse(result);
                if (response.status == true && response.rows && response.rows.length > 0) {
                    const row = response.rows[0];

                    $('#img_avatar_view').attr('src', row.avatar);
                    $('#img_name_view').html(row.name);
                    $('#img_jabatan_view').html(row.jabatan_name);

                    // Overview: profile image
                    const ovw_profile_image = row.avatar
                        ? '<i class="fas fa-check-circle text-success"></i>'
                        : '<i class="fas fa-times-circle text-danger"></i>';
                    $('#overview_profile_image').html(ovw_profile_image);

                    $('#overview_profile_company_name').html(row.company_name);
                    $('#overview_profile_nika').html(row.nikaryawan);
                    $('#overview_profile_nama_lengkap').html(row.identity_name);
                    $('#overview_profile_golongan').html(row.level_grade);
                    $('#overview_profile_jabatan').html(row.jabatan_name);
                    $('#overview_profile_department_name').html(row.department_name);
                    $('#overview_profile_site').html(row.site_project_name);
                    $('#overview_profile_alamat').html(row.alamat);
                    $('#overview_profile_phone_number').html(row.phone_number);

                    // Overview: HERP sync
                    const ovw_profile_herp_sync = row.username2
                        ? row.username2 + ' <i class="fas fa-check-circle text-success"></i>'
                        : '<i class="fas fa-times-circle text-danger"></i>';
                    $('#overview_profile_herp_sync').html(ovw_profile_herp_sync);

                    // Overview: HERP sync
                    const ovw_profile_email_office = row.email2
                        ? row.email2 + ' <i class="fas fa-check-circle text-success"></i>'
                        : '<i class="fas fa-times-circle text-danger"></i>';
                    $('#overview_profile_email_office').html(ovw_profile_email_office);

                    // Form Edit Profile
                    $('#email_office').val(row.email2);
                    $('#username_herp').val(row.username2);
                    $('#password_herp').val('');
                }
            }).fail(function() {
                // An error occurred
                console.log(ummu)
            });
        },

        sync_to_herp: function () {
            var payload = JSON.stringify({
                username: $("#username_herp").val(),
                password: $("#password_herp").val(),
            });

            var params = {
                function: "sync_to_herp",
                type: "POST",
                // action: "create",
                data: payload,
                cache: true,
                contentType: "application/json",
                dataType: "json",
                loader: true,
            };

            // console.log(JSON.parse(payload))
            // console.log(params)

            var ummu = $ummu.ajax.ummu4(params);
            ummu.done(function (result) {
                // console.log(result);
                // var response = JSON.parse(result);
                var response = result;
                if (response.status == true) {
                    var msg =
                        '<div class="alert alert-success text-sm" id="alert">Synchronization Success.</div>';
                } else {
                    var msg =
                    '<div class="alert alert-danger text-sm" id="alert">' +
                        response.message +
                    "</div>";
                }
                $("#modal_message2 .modal-body").html(msg);
                $("#modal_message2").modal("show");
                //   if (response.status == true) {
                //     var login_by = response.login_by;
                //     // console.log("OK");
                //     if (login_by == 0 || login_by == 1) {
                //       // $('#btn_next').removeClass('disabled');
                //       $("#username_area, #btn_next").addClass("collapse");
                //       $("#password_area, #btn_verify_password").removeClass("collapse");
                //       $("#username_change").val($("#username").val());
                //       $("#alert").html("");
                //       setTimeout(function () {
                //         // Do something after 1 second
                //         $("#modal_loader").modal("hide");
                //       }, 1000);
                //     } else if (login_by == 3) {
                //       app.Controllers.get_otp_sms($("#username").val());
                //     } else {
                //       // $('#otp_area').removeClass('collapse');
                //       // app.Controllers.get_otp_sms
                //     }
                //   } else {
                //     $("#alert").html(
                //       '<div class="alert alert-danger">' + response.messages + "</div>"
                //     );
                //     // $('#loader_next_step').addClass('collapse');
                //   }
                //   $("#btn_next").removeClass("disabled");
            })
            .fail(function () {
                // An error occurred
                console.log(ummu);
            });
        },

        update_profile: function () {
            var payload = JSON.stringify({
                email_office: $("#email_office").val(),
                foto_avatar: $("#img_foto_avatar").attr("src"),
            });

            var params = {
                function: "update_profile",
                type: "POST",
                data: payload,
                cache: true,
                contentType: "application/json",
                dataType: "json",
                loader: true,
            };

            var ummu = $ummu.ajax.ummu4(params);
            ummu
            .done(function (result) {
                var response = result;
                // var response = JSON.parse(result);
                if (response.status == true) {
                    var msg =
                        '<div class="alert alert-success text-sm" id="alert">' +
                        response.message +
                        "</div>";
                } else {
                    var msg =
                        '<div class="alert alert-danger text-sm" id="alert">' +
                        response.message +
                        "</div>";
                }
                $("#modal_message2 .modal-body").html(msg);
                $("#modal_message2").modal("show");
                // console.log(response);
            })
            .fail(function () {
                // An error occurred
                console.log(ummu);
            });
        },

        update_password: function() {
            const current_password = $("#currentPassword").val();
            const new_password = $("#newPassword").val();
            const renew_password = $("#renewPassword").val();

            var payload = JSON.stringify({
                "current_password": current_password,
                "new_password": new_password,
                "renew_password": renew_password,
            });

            var params = {
                function: "update_password",
                type: "POST",
                data: payload,
                cache: true,
                contentType: "application/json",
                dataType: "json",
                loader: true,
            };

            var ummu = $ummu.ajax.ummu4(params);
            ummu
            .done(function (result) {
                console.log(result);
                var response = result;
                console.log(response)
                // var response = JSON.parse(result);
                if (response.status == true) {
                    var msg =
                        '<div class="alert alert-success text-sm" id="alert">' +
                        response.message +
                        "</div>";
                } else {
                    const errors = response.errors;
                    var errors_value = Object.values(errors);
                    for (const [key, value] of Object.entries(errors)) {
                        var msg = `<div class="alert alert-danger text-sm" id="alert">
                            Error ${key} : ${value}
                        </div>`;
                    }

                }
                $("#modal_message2 .modal-body").html(msg);
                $("#modal_message2").modal("show");
            })
            .fail(function () {
                // An error occurred
                console.log(ummu);
            });
        },
    },
    views: {
        // 
    },
};

$(document).ready(function () {
    app.register.apply();
    // $("#username").focus();
});
