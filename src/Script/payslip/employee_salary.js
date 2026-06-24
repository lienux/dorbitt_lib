var app = {
  register: function () {
    app.config.autoload();
  },
  config: {
    autoload: function () {
      app.dt.load();
      $("#PayslipModal #btn_max").on("click", function () {
        $ummu.views.modal.fullscreen("#PayslipModal #modal_dialog");
      });

      app.controllers.get_periode();

      $("#download_payslip").on("click", function () {
        $("#loader_download").removeClass("collapse");
        var url = $ummu.vars.page_url + "create_pdf/" + $ummu.vars.row.id;
        var ummu = $ummu.ajax.show0(url);
        ummu.done(function (result) {
          console.log(result);
          var response = result;
          // var response = JSON.parse(result);
          if (response.status == true) {
            $("#loader_download").addClass("collapse");

            // window.location.href = response.file_url;
            window.open(response.file_url, "_blank");
            // table.ajax.reload();
            // $('#modal_import2').modal('hide');
            // $ummu.func.ch_message(response.message);
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
          }
        });
      });
    },
  },

  // events: {
  //   /* btn_print: function () {
  //     $("#print").on("click", function () {
  //       $("#accordionSidebar").removeClass("toggled");
  //       $("#dorbitt_tab_page").removeClass("collapse");
  //       $("#dorbitt_tab_page").removeClass("collapse");
  //       $("#card_slip").removeClass("shadow");
  //       $("#card_slip").addClass("border-0");

  //       var hasClassSidebar = $("#accordionSidebar").hasClass("toggled");
  //       var hasClassTabPage = $("#dorbitt_tab_page").hasClass("collapse");

  //       if (hasClassSidebar == false) {
  //         $("#accordionSidebar").addClass("toggled");
  //       }

  //       if (hasClassTabPage == false) {
  //         $("#dorbitt_tab_page").addClass("collapse");
  //       }

  //       window.print();
  //     });
  //   }, */

  //   // btn_download_payslip: function () {
  //   //   $("#download_payslip").on("click", function () {
  //   //     $("#loader_download").removeClass("collapse");

  //   //     var ummu = $ummu.ajax.show0(globalVar.download_url);
  //   //     ummu.done(function (result) {
  //   //       console.log(result);
  //   //       var response = result;
  //   //       if (response.status == true) {
  //   //         $("#loader_download").addClass("collapse");
  //   //         window.open(response.file_url, "_blank");
  //   //       } else {
  //   //       }
  //   //     });
  //   //   });
  //   // },

  //   btn_delete_pdf: function () {
  //     $("#delete_pdf").on("click", function () {
  //       $("#loader_delete_pdf").removeClass("collapse");

  //       var ummu = $ummu.ajax.show0(globalVar.delete_url);
  //       ummu.done(function (result) {
  //         console.log(result);
  //         var response = result;
  //         if (response.status == true) {
  //           $("#loader_delete_pdf").addClass("collapse");
  //         }
  //       });
  //     });
  //   },
  // },

  controllers: {
    show: function () {
      var params = {
        type: "get",
        action: "get",
        data: {
          limit: 0,
          offset: 0,
          sort: "id",
          order: "desc",
          search: "",
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
          console.log(response);
          if (response.status == true) {
            $("#nik").html(response.rows.nika);
            $("#name").html(response.rows.name);
            $("#site").html(response.rows.site);
            $("#jabatan").html(response.rows.jabatan);
            $("#periode_name").html(response.rows.periode_name);

            var gapok = $ummu.helpers.currency.us(response.rows.gapok_baru);
            var rapel_gaji = $ummu.helpers.currency.us(
              response.rows.rapel_gaji
            );
            var lain_lain = $ummu.helpers.currency.us(response.rows.lain_lain);

            var insentif_produksi = $ummu.helpers.currency.us(
              response.rows.insentif_produksi
            );
            var insentif_kehadiran = $ummu.helpers.currency.us(
              response.rows.insentif_kehadiran
            );
            var tj_kesetaraan = $ummu.helpers.currency.us(
              response.rows.tj_kesetaraan
            );
            var tj_acting = $ummu.helpers.currency.us(response.rows.tj_acting);

            var total_tunjangan = $ummu.helpers.currency.us(
              response.rows.total_tunjangan
            );
            var gaji_bruto = $ummu.helpers.currency.us(
              response.rows.gaji_bruto
            );

            var potongan_jamsostek_jht = $ummu.helpers.currency.us(
              response.rows.potongan_jamsostek_jht
            );
            var potongan_jamsostek_jp = $ummu.helpers.currency.us(
              response.rows.potongan_jamsostek_jp
            );
            var potongan_kasbon = $ummu.helpers.currency.us(
              response.rows.potongan_kasbon
            );
            var potongan_tiket = $ummu.helpers.currency.us(
              response.rows.potongan_tiket
            );

            var total_potongan = $ummu.helpers.currency.us(
              response.rows.total_potongan
            );
            var gaji_netto = $ummu.helpers.currency.us(
              response.rows.gaji_netto
            );
            var saldo_kasbon = $ummu.helpers.currency.us(
              response.rows.saldo_kasbon
            );

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
            app.func.qrcode(response.rows.qrcode);
            $("#modal_loader").modal("hide");
          }
        })
        .fail(function () {
          // An error occurred
        });
    },

    au_import: function () {
      var url = globalVar.qUrl + "import";

      var ummu = $ummu.ajax.aumImport2(url);
      ummu
        .done(function (result) {
          // console.log(result)
          var response = JSON.parse(result);
          if (response.status == true) {
            table.ajax.reload();
            $("#modal_import2").modal("hide");
            $ummu.func.ch_message(response.message);
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
          }
        })
        .fail(function () {
          // An error occurred
          console.log(ummu);
        });
    },

    get_periode: function () {
      var params = {
        type: "get",
        action: "get",
        data: {
          limit: 0,
          offset: 0,
          sort: "id",
          order: "desc",
          search: "",
        },
        cache: true,
        contentType: "application/json",
        dataType: "json",
      };
      var url = globalVar.qUrl + "show_payslip_periode";
      var ali = $globalAjax.ummay(url, params);
      ali
        .done(function (result) {
          var response = JSON.parse(result);
          // console.log(response)
          var params = {
            element_id: "periode",
            rows: response,
            with_kode: 0,
          };
          $ummu.views.select_option_append(params);

          var params2 = {
            element_id: "periode2",
            rows: response,
            with_kode: 0,
          };
          $ummu.views.select_option_append(params2);
        })
        .fail(function () {
          // An error occurred
        });
    },

    multi_delete: function (rows) {
      console.log(rows);

      /*$('#btn_approve').prop('disabled', true);
            $('#modal_loader_approval').show();*/

      var r = [];
      $.each(rows, function (index, value) {
        r[index] = {};

        r[index] = value.id;
        // r[index].appv_remark = "by multiple approve";
        // r[index].doc_number = value.doc_code;

        // var d = [];
        // $.each(value.detail, function( index2, value2) {
        //     d[index2] = {};

        //     d[index2].status = 1;
        //     d[index2].comment = "by multiple approve";
        //     d[index2].part_code = value2.Prod_code;
        //     d[index2].part_qty = value2.part_qty;
        //     d[index2].harga = value2.harga;
        //     d[index2].disc = value2.Disc;
        //     d[index2].nomer = value2.nomer;
        // })

        // r[index].details = d;
      });

      var payload = JSON.stringify({
        body: {
          ids: r,
        },
      });

      // console.log(r)

      app.controllers.do_delete(payload);
    },

    do_delete: function (payload) {
      var url = globalVar.qUrl + "delete";
      var params = {
        url: url,
        type: "delete",
        action: "delete",
        data: payload,
        cache: true,
        contentType: "application/json",
        dataType: "json",
      };

      // console.log(JSON.parse(payload))
      // console.log(JSON.parse(params))
      // console.log(params)

      var ummu = $ummu.ajax.ummu2(params);
      ummu
        .done(function (result) {
          console.log(result);
          var response = JSON.parse(result);
          if (response.status == true) {
            table.ajax.reload();
            // $('#ApproveModal').modal('hide');
            // $ummu.func.ch_message(response.message);
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
          }
          // $('#btn_approve').prop('disabled', false);
          // $('#modal_loader_approval').hide();
          // sum();
        })
        .fail(function () {
          // An error occurred
          console.log(ummu);
        });
      // console.log(params)
    },

    import: function () {
      $("#periode").val("");
      $("#modal_import2").modal("show");
    },
  },

  views: {
    loader_show: function () {
      $("#modal_loader").modal("show");
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

  dt: {
    config: function () {
      return {
        ajax: {
          dataSrc: "rows",
          url: globalVar.qUrl + "show",
          data: function (d) {
            d.myKey = "myValue";
            // d.custom = $('#myInput').val();
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
            buttons: [
              //   { extend: "pageLength", className: "py-1" },
              //   {
              //     text: '<i class="fas fa-file-excel text-success"></i> Import',
              //     attr: { id: "btn_import" },
              //     className: "btn-showall-color hidden collapse py-1",
              //     action: function (e, dt, node, config) {
              //       // if(localStorage.getItem("level_id") == "1") {
              //       $("#periode").val("");
              //       $("#modal_import2").modal("show");
              //       // }
              //       // var rows = $ummu.dt.select.data();
              //       // console.log(rows)
              //       // multi_approve(rows);
              //     },
              //   },
              //   {
              //     text: '<i class="fas fa-trash-alt text-danger"></i> Delete',
              //     attr: { id: "btn_multi_delete" },
              //     className: "btn-showall-color hidden collapse py-1",
              //     action: function (e, dt, node, config) {
              //       // // if(localStorage.getItem("level_id") == "1") {
              //       //     $('#periode').val('');
              //       //     $('#modal_filter_employee_salary').modal('show');
              //       // // }
              //       // // var rows = $ummu.dt.select.data();
              //       // // console.log(rows)
              //       // // multi_approve(rows);
              //       var rows = $ummu.dt.select.data();
              //       // console.log(rows)
              //       app.controllers.multi_delete(rows);
              //     },
              //   },
            ],
          },
        },
        columnDefs: [
          {
            targets: 0,
            orderable: false,
            render: DataTable.render.select(),
          },
          // {
          //     target: 3,
          //     visible: false
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
        // scrollY: 300,
        select: {
          style: "multi+shift",
          selector: "td:first-child",
          headerCheckbox: "select-page",
        },
        columns: [
          {
            data: null,
            render: DataTable.render.select(),
          },
          {
            data: "id",
          },
          {
            data: "payslip_periode",
            className: "text-right",
          },
          {
            data: "nika",
            render: function (data, type) {
              return (
                '<a href="javascript:void(0);">' +
                data +
                ' <i class="fas fa-external-link-alt ml-2"></i></a>'
              );
            },
          },
          {
            data: "name",
          },
          {
            data: "jabatan",
          },
          {
            data: "dept",
          },
          {
            data: "tgl_join",
            className: "text-right",
          },
          {
            data: "gol",
            className: "text-center",
          },
          {
            data: "gapok_baru",
            className: "text-right",
            render: function (data, type) {
              return $ummu.helpers.currency.us(data);
            },
          },
          {
            data: "tj_acting",
            className: "text-right",
            render: function (data, type) {
              return $ummu.helpers.currency.us(data);
            },
          },
          {
            data: "rapel_gaji",
            className: "text-right",
            render: function (data, type) {
              return $ummu.helpers.currency.us(data);
            },
          },
          {
            data: "lain_lain",
            className: "text-right",
            render: function (data, type) {
              return $ummu.helpers.currency.us(data);
            },
          },
          // {
          //     data: 'uang_hadir',
          //     className: 'text-right',
          //     render: function (data, type) {
          //         return $ummu.helpers.currency.us(data);
          //     }
          // },
          {
            data: "tj_kesetaraan",
            className: "text-right",
            render: function (data, type) {
              return $ummu.helpers.currency.us(data);
            },
          },
          {
            data: "insentif_produksi",
            className: "text-right",
            render: function (data, type) {
              return $ummu.helpers.currency.us(data);
            },
          },
          {
            data: "insentif_kehadiran",
            className: "text-right",
            render: function (data, type) {
              return $ummu.helpers.currency.us(data);
            },
          },
          {
            data: "total_tunjangan",
            className: "text-right",
            render: function (data, type) {
              return $ummu.helpers.currency.us(data);
            },
            createdCell: function (td) {
              $(td).css("background-color", "yellow");
            },
          },
          {
            data: "gaji_bruto",
            className: "text-right",
            render: function (data, type) {
              return $ummu.helpers.currency.us(data);
            },
            createdCell: function (td) {
              $(td).css("background-color", "yellow");
            },
          },
          {
            data: "potongan_kasbon",
            className: "text-right",
            render: function (data, type) {
              return $ummu.helpers.currency.us(data);
            },
          },
          {
            data: "potongan_tiket",
            className: "text-right",
            render: function (data, type) {
              return $ummu.helpers.currency.us(data);
            },
          },
          {
            data: "potongan_jamsostek_jht",
            className: "text-right",
            render: function (data, type) {
              return $ummu.helpers.currency.us(data);
            },
          },
          {
            data: "potongan_jamsostek_jp",
            className: "text-right",
            render: function (data, type) {
              return $ummu.helpers.currency.us(data);
            },
          },
          {
            data: "total_potongan",
            className: "text-right",
            render: function (data, type) {
              return $ummu.helpers.currency.us(data);
            },
            createdCell: function (td) {
              $(td).css("background-color", "yellow");
            },
          },
          {
            data: "gaji_netto",
            className: "text-right",
            render: function (data, type) {
              return $ummu.helpers.currency.us(data);
            },
            createdCell: function (td) {
              $(td).css("background-color", "yellow");
            },
          },
          {
            data: "no_rek",
            render: function (data, type) {
              return $ummu.helpers.rekeningFormatter(data);
            },
          },
          { data: "nama_rekening" },
          { data: "bank" },
          { data: "site" },
          { data: "email" },
          { data: "whatsapp" },
        ],
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
      table.button("#btn_multi_delete").disable();
      table.on("click", "tbody tr td:nth-child(4)", function () {
        var row = table.row(this).data();
        // console.log(row);
        $ummu.vars.row = row;

        globalVar.id = row.id;
        $("#nik").html(row.nika);
        $("#name").html(row.name);
        $("#site").html(row.site);
        $("#jabatan").html(row.jabatan);
        $("#periode_name").html(row.periode_name);

        var gapok = $ummu.helpers.currency.us(row.gapok_baru);
        var rapel_gaji = $ummu.helpers.currency.us(row.rapel_gaji);
        var lain_lain = $ummu.helpers.currency.us(row.lain_lain);

        var insentif_produksi = $ummu.helpers.currency.us(
          row.insentif_produksi
        );
        var insentif_kehadiran = $ummu.helpers.currency.us(
          row.insentif_kehadiran
        );
        var tj_kesetaraan = $ummu.helpers.currency.us(row.tj_kesetaraan);
        var tj_acting = $ummu.helpers.currency.us(row.tj_acting);

        var total_tunjangan = $ummu.helpers.currency.us(row.total_tunjangan);
        var gaji_bruto = $ummu.helpers.currency.us(row.gaji_bruto);

        var potongan_jamsostek_jht = $ummu.helpers.currency.us(
          row.potongan_jamsostek_jht
        );
        var potongan_jamsostek_jp = $ummu.helpers.currency.us(
          row.potongan_jamsostek_jp
        );
        var potongan_kasbon = $ummu.helpers.currency.us(row.potongan_kasbon);
        var potongan_tiket = $ummu.helpers.currency.us(row.potongan_tiket);

        var total_potongan = $ummu.helpers.currency.us(row.total_potongan);
        var gaji_netto = $ummu.helpers.currency.us(row.gaji_netto);
        var saldo_kasbon = $ummu.helpers.currency.us(row.saldo_kasbon);

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
        app.func.qrcode(row.qrcode);

        $("#PayslipModal").modal("show");
      });
      table.on("select", function (e, dt, type, indexes) {
        $ummu.views.button.delete_selected("#btn_multi_delete");
      });
      table.on("deselect", function (e, dt, type, indexes) {
        $ummu.views.button.delete_selected("#btn_multi_delete");
      });
    },
  },
};

$(document).ready(function () {
  $ummu.dt.layout.button();
  if ($ummu.vars.account.level_id == 1) {
    $ummu.dt.layout.button_crud(["import"]);
  }
  $ummu.func.location_hash();
  app.register();
});

function au_import() {
  app.controllers.au_import();
}

var table = new DataTable("#dt_salary", app.dt.config());
