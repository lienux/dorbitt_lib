var app = {
  register: function () {
    app.config.autoload();
  },

  config: {
    autoload: function () {
      app.views.loader_show();
      // app.events.btn_print();
      // app.events.btn_download_payslip();
      // app.events.btn_delete_pdf();
      app.controllers.show_periode();

      $("#search_payslip").on("click", function () {
        var select_payslip_periode = $("#select_payslip_periode").val();
        var otp = $("#payslip_otp").val();
        if (
          select_payslip_periode == "undefined" ||
          select_payslip_periode == "" ||
          select_payslip_periode == null
        ) {
          alert("Please choose Periode");
        } else if (otp == "undefined" || otp == "" || otp == null) {
          alert("Insert your OTP!");
        } else {
          // app.views.loader_show();
          app.views.clear_form();
          app.controllers.show();
          // $("#payslip_otp").val("");
        }
      });

      $("#create_payslip_topdf").on("click", function () {
        var select_payslip_periode = $("#select_payslip_periode").val();
        var otp = $("#payslip_otp").val();
        if (
          select_payslip_periode == "undefined" ||
          select_payslip_periode == "" ||
          select_payslip_periode == null
        ) {
          alert("Please choose Periode");
        } else if (otp == "undefined" || otp == "" || otp == null) {
          alert("Insert your OTP!");
        } else {
          if (
            $ummu.vars.hcm.payroll.payslip.pdf.periode_id ==
            select_payslip_periode
          ) {
            $("#pdf_payslip embed").prop(
              "src",
              $ummu.vars.hcm.payroll.payslip.pdf.url
            );
            $("#loader_download, #card_slip").addClass("collapse");
            $("#pdf_payslip").removeClass("collapse");
          } else {
            $("#loader_download").removeClass("collapse");

            var ummu = $ummu.ajax.show0(
              globalVar.url_create_pdf +
                "?periode_id=" +
                select_payslip_periode +
                "&otp=" +
                otp
            );
            ummu.done(function (result) {
              console.log(result);
              var response = result;
              if (response.status == true) {
                // $("#loader_download").addClass("collapse");
                // window.open(response.file_url, "_blank");
                $("#link_pdf_payslip").prop("data", response.file_url);
                $("#loader_download, #card_slip").addClass("collapse");
                $("#pdf_payslip").removeClass("collapse");

                $ummu.vars.hcm.payroll.payslip.pdf.periode_id = $(
                  "#select_payslip_periode"
                ).val();
                $ummu.vars.hcm.payroll.payslip.pdf.url = response.file_url;
              } else {
              }
            });
          }
        }
      });
    },
  },

  events: {
    // btn_print: function () {
    //   $("#print").on("click", function () {
    //     $("#accordionSidebar").removeClass("toggled");
    //     $("#dorbitt_tab_page").removeClass("collapse");
    //     $("#dorbitt_tab_page").removeClass("collapse");
    //     $("#card_slip").removeClass("shadow");
    //     $("#card_slip").addClass("border-0");

    //     var hasClassSidebar = $("#accordionSidebar").hasClass("toggled");
    //     var hasClassTabPage = $("#dorbitt_tab_page").hasClass("collapse");

    //     if (hasClassSidebar == false) {
    //       $("#accordionSidebar").addClass("toggled");
    //     }

    //     if (hasClassTabPage == false) {
    //       $("#dorbitt_tab_page").addClass("collapse");
    //     }

    //     window.print();
    //   });
    // },

    // btn_download_payslip: function () {
    //   $("#download_payslip").on("click", function () {
    //     var select_payslip_periode = $("#select_payslip_periode").val();
    //     var otp = $("#payslip_otp").val();
    //     if (
    //       select_payslip_periode == "undefined" ||
    //       select_payslip_periode == "" ||
    //       select_payslip_periode == null
    //     ) {
    //       alert("Please choose Periode");
    //     } else if (otp == "undefined" || otp == "" || otp == null) {
    //       alert("Insert your OTP!");
    //     } else {
    //       $("#loader_download").removeClass("collapse");

    //       var ummu = $ummu.ajax.show0(
    //         globalVar.download_url +
    //           "?periode_id=" +
    //           select_payslip_periode +
    //           "&otp=" +
    //           otp
    //       );
    //       ummu.done(function (result) {
    //         console.log(result);
    //         var response = result;
    //         if (response.status == true) {
    //           $("#loader_download").addClass("collapse");
    //           window.open(response.file_url, "_blank");
    //         } else {
    //         }
    //       });
    //     }
    //   });
    // },

    btn_delete_pdf: function () {
      // $("#delete_pdf").on("click", function () {
      $("#payslip_clear").on("click", function () {
        $("#loader_delete_pdf").removeClass("collapse");

        var ummu = $ummu.ajax.show0(globalVar.delete_url);
        ummu.done(function (result) {
          console.log(result);
          var response = result;
          if (response.status == true) {
            $("#loader_delete_pdf").addClass("collapse");
          }
        });
      });
    },
  },

  controllers: {
    show: function () {
      var select_payslip_periode = $("#select_payslip_periode").val();
      if (
        $ummu.vars.hcm.payroll.payslip.show.periode_id == select_payslip_periode
      ) {
        // $("#pdf_payslip embed").prop("src", $ummu.vars.payslip.pdf.url);
        app.views.set_row_to_form($ummu.vars.hcm.payroll.payslip.show.row);
        // console.log("sama");
        // console.log($ummu.vars.hcm.payroll.payslip.show.row);
        $("#modal_loader").modal("hide");
      } else {
        // console.log("get ulang");
        app.views.loader_show();
        var params = {
          type: "get",
          action: "get",
          data: {
            periode_id: $("#select_payslip_periode").val(),
            otp: $("#payslip_otp").val(),
          },
          cache: true,
          contentType: "application/json",
          dataType: "json",
        };
        var url = globalVar.qUrl + "show";
        var ali = $globalAjax.ummay(url, params);
        ali
          .done(function (result) {
            var response = JSON.parse(result);
            // console.log(response);
            if (response.status == true) {
              var row = response.rows[0];
              $ummu.vars.hcm.payroll.payslip.show.periode_id =
                select_payslip_periode;
              $ummu.vars.hcm.payroll.payslip.show.row = row;

              if (row == null || row == 0 || row == "" || row == "null") {
                $("#modal_loader").modal("hide");
              } else {
                app.views.set_row_to_form(row);

                $("#modal_loader").modal("hide");
                // $("#download_payslip, #delete_pdf").removeClass("disabled");
              }

              console.log(row);
            } else {
              $("#modal_loader").modal("hide");
            }

            setTimeout(function () {
              $("#modal_loader").modal("hide");
            }, 1000);
          })
          .fail(function () {
            // An error occurred
          });
      }

      $("#loader_download, #pdf_payslip").addClass("collapse");
      $("#modal_loader").modal("hide");
      $("#card_slip").removeClass("collapse");
    },
    show_periode: function () {
      var params = {
        type: "get",
        action: "get",
        data: null,
        cache: true,
        contentType: "application/json",
        dataType: "json",
      };
      var url = globalVar.qUrl + "show_periode";
      var ali = $globalAjax.ummay(url, params);
      ali
        .done(function (result) {
          var response = JSON.parse(result);
          // console.log(response);
          var params = {
            element_id: "select_payslip_periode",
            rows: response,
            with_kode: 0,
          };
          $ummu.views.select_option_append(params);

          setTimeout(function () {
            $("#modal_loader").modal("hide");
          }, 1000);
        })
        .fail(function () {
          // An error occurred
        });
    },
  },

  views: {
    loader_show: function () {
      $("#modal_loader").modal("show");
    },

    clear_form: function () {
      $("#nik").html("");
      $("#name").html("");
      $("#site").html("");
      $("#jabatan").html("");
      $("#periode_name").html("");
      $("#download_payslip, #delete_pdf").addClass("disabled");

      var gapok = "";
      var rapel_gaji = "";
      var lain_lain = "";

      var insentif_produksi = "";
      var insentif_kehadiran = "";
      var tj_kesetaraan = "";
      var tj_acting = "";

      var total_tunjangan = "";
      var gaji_bruto = "";

      var potongan_jamsostek_jht = "";
      var potongan_jamsostek_jp = "";
      var potongan_kasbon = "";
      var potongan_tiket = "";

      var total_potongan = "";
      var gaji_netto = "";
      var saldo_kasbon = "";

      app.func.gapok(gapok, rapel_gaji, lain_lain);
      app.func.tunjangan(
        insentif_produksi,
        insentif_kehadiran,
        tj_kesetaraan,
        tj_acting
      );
      app.func.total_tunjangan(total_tunjangan, gaji_bruto);
      app.func.potongan(
        potongan_jamsostek_jht,
        potongan_jamsostek_jp,
        potongan_kasbon,
        potongan_tiket
      );
      app.func.total_potongan(total_potongan, gaji_netto, saldo_kasbon);
      app.func.qrcode("");
    },

    set_row_to_form: function (rows) {
      $("#nik").html(rows.nika);
      $("#name").html(rows.name);
      $("#site").html(rows.site);
      $("#jabatan").html(rows.jabatan);
      $("#periode_name").html(rows.periode_name);

      var gapok = $ummu.helpers.currency.us(rows.gapok_baru);
      var rapel_gaji = $ummu.helpers.currency.us(rows.rapel_gaji);
      var lain_lain = $ummu.helpers.currency.us(rows.lain_lain);

      var insentif_produksi = $ummu.helpers.currency.us(rows.insentif_produksi);
      var insentif_kehadiran = $ummu.helpers.currency.us(
        rows.insentif_kehadiran
      );
      var tj_kesetaraan = $ummu.helpers.currency.us(rows.tj_kesetaraan);
      var tj_acting = $ummu.helpers.currency.us(rows.tj_acting);

      var total_tunjangan = $ummu.helpers.currency.us(rows.total_tunjangan);
      var gaji_bruto = $ummu.helpers.currency.us(rows.gaji_bruto);

      var potongan_jamsostek_jht = $ummu.helpers.currency.us(
        rows.potongan_jamsostek_jht
      );
      var potongan_jamsostek_jp = $ummu.helpers.currency.us(
        rows.potongan_jamsostek_jp
      );
      var potongan_kasbon = $ummu.helpers.currency.us(rows.potongan_kasbon);
      var potongan_tiket = $ummu.helpers.currency.us(rows.potongan_tiket);

      var total_potongan = $ummu.helpers.currency.us(rows.total_potongan);
      var gaji_netto = $ummu.helpers.currency.us(rows.gaji_netto);
      var saldo_kasbon = $ummu.helpers.currency.us(rows.saldo_kasbon);

      app.func.gapok(gapok, rapel_gaji, lain_lain);
      app.func.tunjangan(
        insentif_produksi,
        insentif_kehadiran,
        tj_kesetaraan,
        tj_acting
      );
      app.func.total_tunjangan(total_tunjangan, gaji_bruto);
      app.func.potongan(
        potongan_jamsostek_jht,
        potongan_jamsostek_jp,
        potongan_kasbon,
        potongan_tiket
      );
      app.func.total_potongan(total_potongan, gaji_netto, saldo_kasbon);
      // app.func.qrcode(rows.qrcode);

      $("#modal_loader").modal("hide");
      // $("#download_payslip, #delete_pdf").removeClass("disabled");
    },
  },

  func: {
    gapok: function (gapok, rapel_gaji, lain_lain) {
      $("#gapok_value").html(
        '<span class="font-weight-bold">' + gapok + "</span>"
      );

      if (
        rapel_gaji == 0 ||
        rapel_gaji == null ||
        rapel_gaji == "" ||
        rapel_gaji == "0,00" ||
        rapel_gaji == "0.00"
      ) {
        $("#rapel_gaji_name, #rapel_gaji_rp, #rapel_gaji_value").html("");
        $("#rapel_gaji_name2, #rapel_gaji_rp2, #rapel_gaji_value2").html(
          '<span class="ml-5"></span>'
        );
      } else {
        $("#rapel_gaji_name").html('<span class="ml-5">Rapel Gaji</span>');
        $("#rapel_gaji_rp").html("<span>Rp. </span>");
        $("#rapel_gaji_value").html("<span>" + rapel_gaji + "</span>");
      }

      if (
        lain_lain == 0 ||
        lain_lain == null ||
        lain_lain == "" ||
        lain_lain == "0,00" ||
        lain_lain == "0.00"
      ) {
        $("#lain_lain_name, #lain_lain_rp, #lain_lain_value").html("");
        $("#lain_lain_name2, #lain_lain_rp2, #lain_lain_value2").html(
          '<span class="ml-5"></span>'
        );
      } else {
        $("#lain_lain_name").html('<span class="ml-5">Lain Lain</span>');
        $("#lain_lain_rp").html("<span>Rp. </span>");
        $("#lain_lain_value").html("<span>" + lain_lain + "</span>");
      }
    },
    tunjangan: function (
      insentif_produksi,
      insentif_kehadiran,
      tj_kesetaraan,
      tj_acting
    ) {
      if (
        insentif_produksi == 0 ||
        insentif_produksi == null ||
        insentif_produksi == "" ||
        insentif_produksi == "0,00" ||
        insentif_produksi == "0.00"
      ) {
        $(
          "#insentif_produksi_name, #insentif_produksi_rp, #insentif_produksi_value"
        ).html("");
        $(
          "#insentif_produksi_name2, #insentif_produksi_rp2, #insentif_produksi_value2"
        ).html('<span class="ml-5"></span>');
      } else {
        $("#insentif_produksi_name").html(
          '<span class="ml-5">Insentif Produksi</span>'
        );
        $("#insentif_produksi_rp").html("<span>Rp. </span>");
        $("#insentif_produksi_value").html(
          "<span>" + insentif_produksi + "</span>"
        );
      }

      if (
        insentif_kehadiran == 0 ||
        insentif_kehadiran == null ||
        insentif_kehadiran == "" ||
        insentif_kehadiran == "0,00" ||
        insentif_kehadiran == "0.00"
      ) {
        $(
          "#insentif_kehadiran_name, #insentif_kehadiran_rp, #insentif_kehadiran_value"
        ).html("");
        $(
          "#insentif_kehadiran_name2, #insentif_kehadiran_rp2, #insentif_kehadiran_value2"
        ).html('<span class="ml-5"></span>');
      } else {
        $("#insentif_kehadiran_name").html(
          '<span class="ml-5">Insentif Kehadiran</span>'
        );
        $("#insentif_kehadiran_rp").html("<span>Rp. </span>");
        $("#insentif_kehadiran_value").html(
          "<span>" + insentif_kehadiran + "</span>"
        );
      }

      if (
        tj_kesetaraan == 0 ||
        tj_kesetaraan == null ||
        tj_kesetaraan == "" ||
        tj_kesetaraan == "0,00" ||
        tj_kesetaraan == "0.00"
      ) {
        $("#tj_kesetaraan_name, #tj_kesetaraan_rp, #tj_kesetaraan_value").html(
          ""
        );
        $(
          "#tj_kesetaraan_name2, #tj_kesetaraan_rp2, #tj_kesetaraan_value2"
        ).html('<span class="ml-5"></span>');
      } else {
        $("#tj_kesetaraan_name").html(
          '<span class="ml-5">Tunjangan Remote Area</span>'
        );
        $("#tj_kesetaraan_rp").html("<span>Rp. </span>");
        $("#tj_kesetaraan_value").html("<span>" + tj_kesetaraan + "</span>");
      }

      if (
        tj_acting == 0 ||
        tj_acting == null ||
        tj_acting == "" ||
        tj_acting == "0,00" ||
        tj_acting == "0.00"
      ) {
        $("#tj_acting_name, #tj_acting_rp, #tj_acting_value").html("");
        $("#tj_acting_name2, #tj_acting_rp2, #tj_acting_value2").html(
          '<span class="ml-5"></span>'
        );
      } else {
        $("#tj_acting_name").html('<span class="ml-5">Tunjangan Acting</span>');
        $("#tj_acting_rp").html("<span>Rp. </span>");
        $("#tj_acting_value").html("<span>" + tj_acting + "</span>");
      }
    },
    total_tunjangan: function (total_tunjangan, gaji_bruto) {
      $("#total_tunjangan_value").html(
        '<span class="font-weight-bold">' + total_tunjangan + "</span>"
      );
      $("#gaji_bruto_value").html(
        '<span class="font-weight-bold">' + gaji_bruto + "</span>"
      );
    },
    potongan: function (
      potongan_jamsostek_jht,
      potongan_jamsostek_jp,
      potongan_kasbon,
      potongan_tiket
    ) {
      if (
        potongan_jamsostek_jht == 0 ||
        potongan_jamsostek_jht == null ||
        potongan_jamsostek_jht == "" ||
        potongan_jamsostek_jht == "0,00" ||
        potongan_jamsostek_jht == "0.00"
      ) {
        $(
          "#potongan_jamsostek_jht_name, #potongan_jamsostek_jht_rp, #potongan_jamsostek_jht_value"
        ).html("");
        $(
          "#potongan_jamsostek_jht_name2, #potongan_jamsostek_jht_rp2, #potongan_jamsostek_jht_value2"
        ).html('<span class="ml-5"></span>');
      } else {
        $("#potongan_jamsostek_jht_name").html(
          '<span class="ml-5">Potongan Jaminan Hari Tua (JHT)</span>'
        );
        $("#potongan_jamsostek_jht_rp").html("<span>Rp. </span>");
        $("#potongan_jamsostek_jht_value").html(
          "<span>" + potongan_jamsostek_jht + "</span>"
        );
      }

      if (
        potongan_jamsostek_jp == 0 ||
        potongan_jamsostek_jp == null ||
        potongan_jamsostek_jp == "" ||
        potongan_jamsostek_jp == "0,00" ||
        potongan_jamsostek_jp == "0.00"
      ) {
        $(
          "#potongan_jamsostek_jp_name, #potongan_jamsostek_jp_rp, #potongan_jamsostek_jp_value"
        ).html("");
        $(
          "#potongan_jamsostek_jp_name2, #potongan_jamsostek_jp_rp2, #potongan_jamsostek_jp_value2"
        ).html('<span class="ml-5"></span>');
      } else {
        $("#potongan_jamsostek_jp_name").html(
          '<span class="ml-5">Potongan Jaminan Pensiun (JP)</span>'
        );
        $("#potongan_jamsostek_jp_rp").html("<span>Rp. </span>");
        $("#potongan_jamsostek_jp_value").html(
          "<span>" + potongan_jamsostek_jp + "</span>"
        );
      }

      if (
        potongan_kasbon == 0 ||
        potongan_kasbon == null ||
        potongan_kasbon == "" ||
        potongan_kasbon == "0,00" ||
        potongan_kasbon == "0.00"
      ) {
        $(
          "#potongan_kasbon_name, #potongan_kasbon_rp, #potongan_kasbon_value"
        ).html("");
        $(
          "#potongan_kasbon_name2, #potongan_kasbon_rp2, #potongan_kasbon_value2"
        ).html('<span class="ml-5"></span>');
      } else {
        $("#potongan_kasbon_name").html(
          '<span class="ml-5">Potongan Kasbon</span>'
        );
        $("#potongan_kasbon_rp").html("<span>Rp. </span>");
        $("#potongan_kasbon_value").html(
          "<span>" + potongan_kasbon + "</span>"
        );
      }

      if (
        potongan_tiket == 0 ||
        potongan_tiket == null ||
        potongan_tiket == "" ||
        potongan_tiket == "0,00" ||
        potongan_tiket == "0.00"
      ) {
        $(
          "#potongan_tiket_name, #potongan_tiket_rp, #potongan_tiket_value"
        ).html("");
        $(
          "#potongan_tiket_name2, #potongan_tiket_rp2, #potongan_tiket_value2"
        ).html('<span class="ml-5"></span>');
      } else {
        $("#potongan_tiket_name").html(
          '<span class="ml-5">Potongan Tiket</span>'
        );
        $("#potongan_tiket_rp").html("<span>Rp. </span>");
        $("#potongan_tiket_value").html("<span>" + potongan_tiket + "</span>");
      }
    },
    total_potongan: function (total_potongan, gaji_netto, saldo_kasbon) {
      $("#total_potongan_value").html(
        '<span class="font-weight-bold">' + total_potongan + "</span>"
      );
      $("#gaji_netto_value").html(
        '<span class="font-weight-bold">' + gaji_netto + "</span>"
      );

      if (
        saldo_kasbon == 0 ||
        saldo_kasbon == null ||
        saldo_kasbon == "" ||
        saldo_kasbon == "0,00" ||
        saldo_kasbon == "0.00"
      ) {
        $("#saldo_kasbon_name, #saldo_kasbon_rp, #saldo_kasbon_value").html("");
        $("#saldo_kasbon_name2, #saldo_kasbon_rp2, #saldo_kasbon_value2").html(
          '<span class="ml-5"></span>'
        );
      } else {
        $("#saldo_kasbon_name").html(
          '<span class="font-weight-bold">Saldo Kasbon</span>'
        );
        $("#saldo_kasbon_rp").html("<span>Rp. </span>");
        $("#saldo_kasbon_value").html(
          '<span class="font-weight-bold">' + saldo_kasbon + "</span>"
        );
      }
    },
    qrcode: function (qrcode) {
      $("#qrcode").attr("src", qrcode);
    },
  },
};

$(document).ready(function () {
  $ummu.func.location_hash();
  app.register();
});
