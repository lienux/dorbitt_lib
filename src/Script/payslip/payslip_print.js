var globalVar = {
    qUrl: $base_url + '',
    errors_params: [],
    id: null,

    // nik: $ummu.func.getUrlParameter('nik'),
    // name: $ummu.func.getUrlParameter('name'),
    // site: $ummu.func.getUrlParameter('site'),
    // jabatan: $ummu.func.getUrlParameter('jabatan'),
    // periode_name: $ummu.func.getUrlParameter('periode_name'),

    // gapok: $ummu.helpers.currency.us($ummu.func.getUrlParameter('gapok_baru')),
    // rapel_gaji: $ummu.helpers.currency.us($ummu.func.getUrlParameter('rapel_gaji')),
    // lain_lain: $ummu.helpers.currency.us($ummu.func.getUrlParameter('lain_lain')),
    // insentif_produksi: $ummu.helpers.currency.us($ummu.func.getUrlParameter('insentif_produksi')),
    // insentif_kehadiran: $ummu.helpers.currency.us($ummu.func.getUrlParameter('insentif_kehadiran')),
    // tj_kesetaraan: $ummu.helpers.currency.us($ummu.func.getUrlParameter('tj_kesetaraan')),
    // tj_acting: $ummu.helpers.currency.us($ummu.func.getUrlParameter('tj_acting')),
    // potongan_jamsostek_jht: $ummu.helpers.currency.us($ummu.func.getUrlParameter('potongan_jamsostek_jht')),
    // potongan_jamsostek_jp: $ummu.helpers.currency.us($ummu.func.getUrlParameter('potongan_jamsostek_jp')),
    // potongan_kasbon: $ummu.helpers.currency.us($ummu.func.getUrlParameter('potongan_kasbon')),
    // potongan_tiket: $ummu.helpers.currency.us($ummu.func.getUrlParameter('potongan_tiket')),
    // total_potongan: $ummu.helpers.currency.us($ummu.func.getUrlParameter('total_potongan')),
    // total_tunjangan: $ummu.helpers.currency.us($ummu.func.getUrlParameter('total_tunjangan')),
    // gaji_bruto: $ummu.helpers.currency.us($ummu.func.getUrlParameter('gaji_bruto')),
    // total_potongan: $ummu.helpers.currency.us($ummu.func.getUrlParameter('total_potongan')),
    // gaji_netto: $ummu.helpers.currency.us($ummu.func.getUrlParameter('gaji_netto')),
    // saldo_kasbon: $ummu.helpers.currency.us($ummu.func.getUrlParameter('saldo_kasbon')),
    // qrcode: $ummu.func.getUrlParameter('qrcode')

    gapok: gapok,
    rapel_gaji: rapel_gaji,
    lain_lain: lain_lain,
    insentif_produksi: insentif_produksi,
    insentif_kehadiran: insentif_kehadiran,
    tj_kesetaraan: tj_kesetaraan,
    tj_acting: tj_acting,
    potongan_jamsostek_jht: potongan_jamsostek_jht,
    potongan_jamsostek_jp: potongan_jamsostek_jp,
    potongan_kasbon: potongan_kasbon,
    potongan_tiket: potongan_tiket,
    total_potongan: total_potongan,
    total_tunjangan: total_tunjangan,
    gaji_bruto: gaji_bruto,
    total_potongan: total_potongan,
    gaji_netto: gaji_netto,
    saldo_kasbon: saldo_kasbon,
    qrcode: qrcode,

    // gapok: $ummu.helpers.currency.us($ummu.vars.hcm.payroll.gapok),
    // rapel_gaji: $ummu.helpers.currency.us($ummu.vars.hcm.payroll.rapel_gaji),
    // lain_lain: $ummu.helpers.currency.us($ummu.vars.hcm.payroll.lain_lain),
    // insentif_produksi: $ummu.helpers.currency.us($ummu.vars.hcm.payroll.insentif_produksi),
    // insentif_kehadiran: $ummu.helpers.currency.us($ummu.vars.hcm.payroll.insentif_kehadiran),
    // tj_kesetaraan: $ummu.helpers.currency.us($ummu.vars.hcm.payroll.tj_kesetaraan),
    // tj_acting: $ummu.helpers.currency.us($ummu.vars.hcm.payroll.tj_acting),
    // potongan_jamsostek_jht: $ummu.helpers.currency.us($ummu.vars.hcm.payroll.potongan_jamsostek_jht),
    // potongan_jamsostek_jp: $ummu.helpers.currency.us($ummu.vars.hcm.payroll.potongan_jamsostek_jp),
    // potongan_kasbon: $ummu.helpers.currency.us($ummu.vars.hcm.payroll.potongan_kasbon),
    // potongan_tiket: $ummu.helpers.currency.us($ummu.vars.hcm.payroll.potongan_tiket),
    // total_potongan: $ummu.helpers.currency.us($ummu.vars.hcm.payroll.total_potongan),
    // total_tunjangan: $ummu.helpers.currency.us($ummu.vars.hcm.payroll.total_tunjangan),
    // gaji_bruto: $ummu.helpers.currency.us($ummu.vars.hcm.payroll.gaji_bruto),
    // total_potongan: $ummu.helpers.currency.us($ummu.vars.hcm.payroll.total_potongan),
    // gaji_netto: $ummu.helpers.currency.us($ummu.vars.hcm.payroll.gaji_netto),
    // saldo_kasbon: $ummu.helpers.currency.us($ummu.vars.hcm.payroll.saldo_kasbon),
    // qrcode: $ummu.vars.hcm.payroll.qrcode
}

var app = {
    register: function() {
        app.config.autoload();
    },
    config: {
        autoload: function() {
            // app.views.set_header();
            app.func.gapok();
            app.func.tunjangan();
            app.func.potongan();
            app.func.total_tunjangan();
            app.func.total_potongan();
            app.func.qrcode();
        }
    },
    events: {
        // 
    },
    controllers: {
        // show: function() {
        //     var params = {
        //         "type": "get",
        //         "action": "get",
        //         "data": {
        //             "limit":0,
        //             "offset":0,
        //             "sort": "id",
        //             "order": "desc",
        //             "search": ""
        //         },
        //         "cache": true,
        //         "contentType": "application/json",
        //         "dataType": "json"
        //     };
        //     var url = globalVar.qUrl+'show';
        //     var ali = $globalAjax.ummay(url,params);
        //     ali.done(function(result) {
        //         var response = JSON.parse(result);
        //         if (response.status == true) {
        //             var rows = response.rows;
        //             if (rows == null || rows == 0 || rows == '' || rows == 'null') {
        //                 $('#modal_loader').modal('hide');
        //             }else{
        //                 $('#nik').html(rows.nika);
        //                 $('#name').html(rows.name);
        //                 $('#site').html(rows.site);
        //                 $('#jabatan').html(rows.jabatan);
        //                 $('#periode_name').html(rows.periode_name);

        //                 var gapok = $ummu.helpers.currency.us(rows.gapok_baru);
        //                 var rapel_gaji = $ummu.helpers.currency.us(rows.rapel_gaji);
        //                 var lain_lain = $ummu.helpers.currency.us(rows.lain_lain);

        //                 var insentif_produksi = $ummu.helpers.currency.us(rows.insentif_produksi);
        //                 var insentif_kehadiran = $ummu.helpers.currency.us(rows.insentif_kehadiran);
        //                 var globalVar.tj_kesetaraan= $ummu.helpers.currency.us(rows.tj_kesetaraan);
        //                 var globalVar.tj_acting= $ummu.helpers.currency.us(rows.tj_acting);

        //                 var total_tunjangan = $ummu.helpers.currency.us(rows.total_tunjangan);
        //                 var gaji_bruto = $ummu.helpers.currency.us(rows.gaji_bruto);

        //                 var globalVar.potongan_jamsostek_jht= $ummu.helpers.currency.us(rows.potongan_jamsostek_jht);
        //                 var globalVar.potongan_jamsostek_jp= $ummu.helpers.currency.us(rows.potongan_jamsostek_jp);
        //                 var globalVar.potongan_kasbon= $ummu.helpers.currency.us(rows.potongan_kasbon);
        //                 var globalVar.potongan_tiket= $ummu.helpers.currency.us(rows.potongan_tiket);

        //                 var total_potongan = $ummu.helpers.currency.us(rows.total_potongan);
        //                 var gaji_netto = $ummu.helpers.currency.us(rows.gaji_netto);
        //                 var globalVar.saldo_kasbon= $ummu.helpers.currency.us(rows.saldo_kasbon);

        //                 app.func.gapok(gapok,rapel_gaji,lain_lain);
        //                 app.func.tunjangan(insentif_produksi,insentif_kehadiran,tj_kesetaraan,tj_acting);
        //                 app.func.total_tunjangan(total_tunjangan,gaji_bruto);
        //                 app.func.potongan(potongan_jamsostek_jht,potongan_jamsostek_jp,potongan_kasbon,potongan_tiket);
        //                 app.func.total_potongan(total_potongan,gaji_netto,saldo_kasbon);
        //                 app.func.qrcode(rows.qrcode);

        //                 $('#modal_loader').modal('hide');
        //             }
        //         }else{
        //             $('#modal_loader').modal('hide');
        //         }

        //         setTimeout( function(){ 
        //             $('#modal_loader').modal('hide');
        //         }, 1000 );
        //     }).fail(function() {
        //         // An error occurred
        //     });
        // }
    },
    views: {
        set_header: function() {
            $('#nik').html(globalVar.nik);
            $('#name').html(globalVar.name);
            $('#site').html(globalVar.site);
            $('#jabatan').html(globalVar.jabatan);
            $('#periode_name').html(globalVar.periode_name);
        }
    },
    func: {
        gapok: function() {
            $('#gapok_value').html('<span class="font-weight-bold">'+ globalVar.gapok +'</span>');

            if (globalVar.rapel_gaji == 0 || globalVar.rapel_gaji == null || globalVar.rapel_gaji == '' || globalVar.rapel_gaji == '0,00' || globalVar.rapel_gaji == '0.00') {
                $('#rapel_gaji_name, #rapel_gaji_rp, #rapel_gaji_value').html('');
                $('#rapel_gaji_name2, #rapel_gaji_rp2, #rapel_gaji_value2').html('<span class="ml-5"></span>');
            }else{
                $('#rapel_gaji_name').html('<span class="ml-5">Rapel Gaji</span>');
                $('#rapel_gaji_rp').html('<span>Rp. </span>');
                $('#rapel_gaji_value').html('<span>'+ globalVar.rapel_gaji +'</span>');
            }

            if (globalVar.lain_lain == 0 || globalVar.lain_lain == null || globalVar.lain_lain == '' || globalVar.lain_lain == '0,00' || globalVar.lain_lain == '0.00') {
                $('#lain_lain_name, #lain_lain_rp, #lain_lain_value').html('');
                $('#lain_lain_name2, #lain_lain_rp2, #lain_lain_value2').html('<span class="ml-5"></span>');
            }else{
                $('#lain_lain_name').html('<span class="ml-5">Lain Lain</span>');
                $('#lain_lain_rp').html('<span>Rp. </span>');
                $('#lain_lain_value').html('<span>'+ globalVar.lain_lain +'</span>');
            }
        },
        tunjangan: function() {
            if (globalVar.insentif_produksi == 0 || globalVar.insentif_produksi == null || globalVar.insentif_produksi == '' || globalVar.insentif_produksi == '0,00' || globalVar.insentif_produksi == '0.00') {
                $('#insentif_produksi_name, #insentif_produksi_rp, #insentif_produksi_value').html('');
                $('#insentif_produksi_name2, #insentif_produksi_rp2, #insentif_produksi_value2').html('<span class="ml-5"></span>');
            }else{
                $('#insentif_produksi_name').html('<span class="ml-5">Insentif Produksi</span>');
                $('#insentif_produksi_rp').html('<span>Rp. </span>');
                $('#insentif_produksi_value').html('<span>'+ globalVar.insentif_produksi +'</span>');
            }

            if (globalVar.insentif_kehadiran == 0 || globalVar.insentif_kehadiran == null || globalVar.insentif_kehadiran == '' || globalVar.insentif_kehadiran == '0,00' || globalVar.insentif_kehadiran == '0.00') {
                $('#insentif_kehadiran_name, #insentif_kehadiran_rp, #insentif_kehadiran_value').html('');
                $('#insentif_kehadiran_name2, #insentif_kehadiran_rp2, #insentif_kehadiran_value2').html('<span class="ml-5"></span>');
            }else{
                $('#insentif_kehadiran_name').html('<span class="ml-5">Insentif Kehadiran</span>');
                $('#insentif_kehadiran_rp').html('<span>Rp. </span>');
                $('#insentif_kehadiran_value').html('<span>'+ globalVar.insentif_kehadiran +'</span>');
            }

            if (globalVar.tj_kesetaraan== 0 || globalVar.tj_kesetaraan== null || globalVar.tj_kesetaraan== '' || globalVar.tj_kesetaraan== '0,00' || globalVar.tj_kesetaraan== '0.00') {
                $('#tj_kesetaraan_name, #tj_kesetaraan_rp, #tj_kesetaraan_value').html('');
                $('#tj_kesetaraan_name2, #tj_kesetaraan_rp2, #tj_kesetaraan_value2').html('<span class="ml-5"></span>');
            }else{
                $('#tj_kesetaraan_name').html('<span class="ml-5">Tunjangan Kesetaraan</span>');
                $('#tj_kesetaraan_rp').html('<span>Rp. </span>');
                $('#tj_kesetaraan_value').html('<span>'+ globalVar.tj_kesetaraan+'</span>');
            }

            if (globalVar.tj_acting== 0 || globalVar.tj_acting== null || globalVar.tj_acting== '' || globalVar.tj_acting== '0,00' || globalVar.tj_acting== '0.00') {
                $('#tj_acting_name, #tj_acting_rp, #tj_acting_value').html('');
                $('#tj_acting_name2, #tj_acting_rp2, #tj_acting_value2').html('<span class="ml-5"></span>');
            }else{
                $('#tj_acting_name').html('<span class="ml-5">Tunjangan Acting</span>');
                $('#tj_acting_rp').html('<span>Rp. </span>');
                $('#tj_acting_value').html('<span>'+ globalVar.tj_acting+'</span>');
            }
        },
        total_tunjangan: function() {
            $('#total_tunjangan_value').html('<span class="font-weight-bold">'+ globalVar.total_tunjangan +'</span>');
            $('#gaji_bruto_value').html('<span class="font-weight-bold">'+ globalVar.gaji_bruto +'</span>');
        },
        potongan: function(){
            if (globalVar.potongan_jamsostek_jht== 0 || globalVar.potongan_jamsostek_jht== null || globalVar.potongan_jamsostek_jht== '' || globalVar.potongan_jamsostek_jht== '0,00' || globalVar.potongan_jamsostek_jht== '0.00') {
                $('#potongan_jamsostek_jht_name, #potongan_jamsostek_jht_rp, #potongan_jamsostek_jht_value').html('');
                $('#potongan_jamsostek_jht_name2, #potongan_jamsostek_jht_rp2, #potongan_jamsostek_jht_value2').html('<span class="ml-5"></span>');
            }else{
                $('#potongan_jamsostek_jht_name').html('<span class="ml-5">Potongan Jaminan Hari Tua (JHT)</span>');
                $('#potongan_jamsostek_jht_rp').html('<span>Rp. </span>');
                $('#potongan_jamsostek_jht_value').html('<span>'+ globalVar.potongan_jamsostek_jht+'</span>');
            }
            
            if (globalVar.potongan_jamsostek_jp== 0 || globalVar.potongan_jamsostek_jp== null || globalVar.potongan_jamsostek_jp== '' || globalVar.potongan_jamsostek_jp== '0,00' || globalVar.potongan_jamsostek_jp== '0.00') {
                $('#potongan_jamsostek_jp_name, #potongan_jamsostek_jp_rp, #potongan_jamsostek_jp_value').html('');
                $('#potongan_jamsostek_jp_name2, #potongan_jamsostek_jp_rp2, #potongan_jamsostek_jp_value2').html('<span class="ml-5"></span>');
            }else{
                $('#potongan_jamsostek_jp_name').html('<span class="ml-5">Potongan Jaminan Pensiun (JP)</span>');
                $('#potongan_jamsostek_jp_rp').html('<span>Rp. </span>');
                $('#potongan_jamsostek_jp_value').html('<span>'+ globalVar.potongan_jamsostek_jp+'</span>');
            }
            
            if (globalVar.potongan_kasbon== 0 || globalVar.potongan_kasbon== null || globalVar.potongan_kasbon== '' || globalVar.potongan_kasbon== '0,00' || globalVar.potongan_kasbon== '0.00') {
                $('#potongan_kasbon_name, #potongan_kasbon_rp, #potongan_kasbon_value').html('');
                $('#potongan_kasbon_name2, #potongan_kasbon_rp2, #potongan_kasbon_value2').html('<span class="ml-5"></span>');
            }else{
                $('#potongan_kasbon_name').html('<span class="ml-5">Potongan Kasbon</span>');
                $('#potongan_kasbon_rp').html('<span>Rp. </span>');
                $('#potongan_kasbon_value').html('<span>'+ globalVar.potongan_kasbon+'</span>');
            }
            
            if (globalVar.potongan_tiket== 0 || globalVar.potongan_tiket== null || globalVar.potongan_tiket== '' || globalVar.potongan_tiket== '0,00' || globalVar.potongan_tiket== '0.00') {
                $('#potongan_tiket_name, #potongan_tiket_rp, #potongan_tiket_value').html('');
                $('#potongan_tiket_name2, #potongan_tiket_rp2, #potongan_tiket_value2').html('<span class="ml-5"></span>');
            }else{
                $('#potongan_tiket_name').html('<span class="ml-5">Potongan Tiket</span>');
                $('#potongan_tiket_rp').html('<span>Rp. </span>');
                $('#potongan_tiket_value').html('<span>'+ globalVar.potongan_tiket+'</span>');
            }
        },
        total_potongan: function() {
            $('#total_potongan_value').html('<span class="font-weight-bold">'+ globalVar.total_potongan +'</span>');
            $('#gaji_netto_value').html('<span class="font-weight-bold">'+ globalVar.gaji_netto +'</span>');

            if (globalVar.saldo_kasbon== 0 || globalVar.saldo_kasbon== null || globalVar.saldo_kasbon== '' || globalVar.saldo_kasbon== '0,00' || globalVar.saldo_kasbon== '0.00') {
                $('#saldo_kasbon_name, #saldo_kasbon_rp, #saldo_kasbon_value').html('');
                $('#saldo_kasbon_name2, #saldo_kasbon_rp2, #saldo_kasbon_value2').html('<span class="ml-5"></span>');
            }else{
                $('#saldo_kasbon_name').html('<span class="font-weight-bold">Saldo Kasbon</span>');
                $('#saldo_kasbon_rp').html('<span>Rp. </span>');
                $('#saldo_kasbon_value').html('<span class="font-weight-bold">'+ globalVar.saldo_kasbon+'</span>');
            }
        },
        qrcode: function(){
            $('#qrcode').attr('src',globalVar.qrcode);
        }
    }
}

$(document).ready(function () {
    $ummu.func.location_hash();
    app.register();
});