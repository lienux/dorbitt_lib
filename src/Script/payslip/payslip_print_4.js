var globalVar = {
    qUrl: $base_url + '',
    errors_params: [],
    id: null,

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
}

var app = {
    register: function() {
        app.config.autoload();
    },
    config: {
        autoload: function() {
            app.func.gapok();
            app.func.tunjangan();
            app.func.potongan();
            app.func.total_tunjangan();
            app.func.total_potongan();
            app.func.qrcode();
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