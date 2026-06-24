<?php
    if (isset($saldo_kasbon)) {
        $saldo_kasbon = $saldo_kasbon;
    } else {
        $saldo_kasbon = 0;
    }
?>
<?= $this->extend('layout/payslip') ?>

<?= $this->section('css') ?>
<style>
    @page {
        size: a5 landscape;
        margin: 0;
    }

    @media print {
        @page {
            size: a5 landscape;
            margin: 0;
        }
    }

    /* body{
            margin-top:20px;
            background:#eee;
        } */

    .invoice {
        /*background: url(<?= base_url('CONFIDENTIAL.png') ?>);*/
        /*background-size: 75%;*/
        /*background: #fff;*/
        /*background-attachment: fixed;*/
        /*background-position: center;*/
        /* Center the image */
        /*background-repeat: no-repeat !important;*/
        /* Do not repeat the image */
        /*background-size: cover;*/
        /* Resize the background image to cover the entire container */
        /*visibility: visible;*/
        /*padding: 20px;*/
        /*webkit-print-color-adjust: exact !important;
            -moz-print-color-adjust: exact !important;
            -ms-print-color-adjust: exact !important;
            print-color-adjust: exact !important;*/
    }

    .invoice-content {
        background: url(<?= base_url('CONFIDENTIAL.png') ?>);
        background-position: center;
        /* Center the image */
        background-repeat: no-repeat !important;
        /* Do not repeat the image */
        font-size: 14px;
    }

    .invoice-company {
        font-size: 20px
    }

    .invoice-header {
        /* margin: 0 -20px; */
        background: #f0f3f4;
        padding: 5px 0px;
        font-size: 14px;
    }

    .invoice-date,
    .invoice-from,
    .invoice-to {
        display: table-cell;
        width: 1%
    }

    .invoice-from,
    .invoice-to {
        padding-right: 20px
    }

    .invoice-date .date,
    .invoice-from strong,
    .invoice-to strong {
        font-size: 16px;
        font-weight: 600
    }

    .invoice-date {
        text-align: right;
        padding-left: 20px
    }

    .invoice-price {
        background: #f0f3f4;
        display: table;
        width: 100%
    }

    .invoice-price .invoice-price-left,
    .invoice-price .invoice-price-right {
        display: table-cell;
        padding: 20px;
        font-size: 20px;
        font-weight: 600;
        width: 75%;
        position: relative;
        vertical-align: middle
    }

    .invoice-price .invoice-price-left .sub-price {
        display: table-cell;
        vertical-align: middle;
        padding: 0 20px
    }

    .invoice-price small {
        font-size: 14px;
        font-weight: 400;
        display: block
    }

    .invoice-price .invoice-price-row {
        display: table;
        float: left
    }

    .invoice-price .invoice-price-right {
        width: 25%;
        background: #2d353c;
        color: #fff;
        font-size: 28px;
        text-align: right;
        vertical-align: bottom;
        font-weight: 300
    }

    .invoice-price .invoice-price-right small {
        display: block;
        opacity: .6;
        position: absolute;
        top: 10px;
        left: 10px;
        font-size: 14px
    }

    .invoice-footer {
        border-top: 1px solid #ddd;
        padding-top: 10px;
        font-size: 10px
    }

    .invoice-note {
        color: #999;
        /*margin-top: 10px;*/
        font-size: 85%
    }

    .invoice>div:not(.invoice-footer) {
        /* margin-bottom: 20px */
    }

    .btn.btn-white,
    .btn.btn-white.disabled,
    .btn.btn-white.disabled:focus,
    .btn.btn-white.disabled:hover,
    .btn.btn-white[disabled],
    .btn.btn-white[disabled]:focus,
    .btn.btn-white[disabled]:hover {
        color: #2d353c;
        background: #fff;
        border-color: #d9dfe3;
    }

    @media print {
        .table td {
            background-color: transparent !important;
        }
    }

    .row {
        display: flex;
        flex-wrap: wrap;
        margin-right: 0rem;
        margin-left: 0rem;
    }

    .table th,
    .table td {
        padding: 0.15rem;
        /* vertical-align: top;
            border-top: 1px solid #dee2e6; */
    }

    .table td,
    .table th {
        padding: .15rem;
        /* vertical-align: top;
            border-top: 1px solid #e3e6f0; */
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="invoice" id="card_slip">
    <div class="invoice-company text-inverse f-w-600">
        <img src="<?= base_url() ?>hillcon_logo_text.jpeg" width="170px"><br>
        <span class="pl-2">PT. HILLCONJAYA SAKTI</span>
    </div>
    <?= $this->include('pages/payroll/payslip/payslip_parameter') ?>
    <div class="invoice-note">
        * Slip gaji ini dibuat dengan menggunakan sistem online<br>
    </div>
    <div class="invoice-footer">
        <p class="text-center">
            <span class="m-r-10">
                www.hillcon.co.id
            </span>
        </p>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
    $('#print').on('click', function () {
        $('#accordionSidebar').removeClass('toggled');
        $('#dorbitt_tab_page').removeClass('collapse');
        $('#dorbitt_tab_page').removeClass('collapse');
        $('#card_slip').removeClass('shadow')
        $('#card_slip').addClass('border-0')

        var hasClassSidebar = $('#accordionSidebar').hasClass('toggled');
        var hasClassTabPage = $('#dorbitt_tab_page').hasClass('collapse')

        if (hasClassSidebar == false) {
            $('#accordionSidebar').addClass('toggled');
        }

        if (hasClassTabPage == false) {
            $('#dorbitt_tab_page').addClass('collapse');
        }

        window.print();
    });

    var gapok = $ummu.helpers.currency.us('<?= (isset($gapok)) ? $gapok : ''?>'),
    rapel_gaji = $ummu.helpers.currency.us('<?= (isset($rapel_gaji)) ? $rapel_gaji : ''?>'),
    lain_lain = $ummu.helpers.currency.us('<?= (isset($lain_lain)) ? $lain_lain : ''?>'),
    insentif_produksi = $ummu.helpers.currency.us('<?= (isset($insentif_produksi)) ? $insentif_produksi : ''?>'),
    insentif_kehadiran = $ummu.helpers.currency.us('<?= (isset($insentif_kehadiran)) ? $insentif_kehadiran : ''?>'),
    tj_kesetaraan = $ummu.helpers.currency.us('<?= (isset($tj_kesetaraan)) ? $tj_kesetaraan : ''?>'),
    tj_acting = $ummu.helpers.currency.us('<?= (isset($tj_acting)) ? $tj_acting : ''?>'),
    potongan_jamsostek_jht = $ummu.helpers.currency.us('<?= (isset($potongan_jamsostek_jht)) ? $potongan_jamsostek_jht : ''?>'),
    potongan_jamsostek_jp = $ummu.helpers.currency.us('<?= (isset($potongan_jamsostek_jp)) ? $potongan_jamsostek_jp : ''?>'),
    potongan_kasbon = $ummu.helpers.currency.us('<?= (isset($potongan_kasbon)) ? $potongan_kasbon : ''?>'),
    potongan_tiket = $ummu.helpers.currency.us('<?= (isset($potongan_tiket)) ? $potongan_tiket : ''?>'),
    total_potongan = $ummu.helpers.currency.us('<?= (isset($total_potongan)) ? $total_potongan : ''?>'),
    total_tunjangan = $ummu.helpers.currency.us('<?= (isset($total_tunjangan)) ? $total_tunjangan : ''?>'),
    gaji_bruto = $ummu.helpers.currency.us('<?= (isset($gaji_bruto)) ? $gaji_bruto : ''?>'),
    total_potongan = $ummu.helpers.currency.us('<?= (isset($total_potongan)) ? $total_potongan : ''?>'),
    gaji_netto = $ummu.helpers.currency.us('<?= (isset($gaji_netto)) ? $gaji_netto : ''?>'),
    saldo_kasbon = $ummu.helpers.currency.us('<?= (isset($saldo_kasbon)) ? $saldo_kasbon : ''?>'),
    qrcode = '<?= (isset($qrcode)) ? $qrcode : '' ?>';

    $('#nik').html('<?= (isset($nika)) ? $nika : '' ?>');
    $('#name').html('<?= (isset($name)) ? $name : '' ?>');
    $('#site').html('<?= (isset($site)) ? $site : '' ?>');
    $('#jabatan').html('<?= (isset($jabatan)) ? $jabatan : '' ?>');
    $('#periode_name').html('<?= (isset($periode_name)) ? $periode_name : '' ?>');

    // globalVar.gapok = '<?= (isset($gapok)) ? number_format($gapok, 2, ",", ".") : '' ?>';
    // globalVar.rapel_gaji = '<?= (isset($rapel_gaji)) ? number_format($rapel_gaji, 2, ",", ".") : '' ?>';
    // globalVar.lain_lain = '<?= (isset($lain_lain)) ? number_format($lain_lain, 2, ",", ".") : '' ?>';

    // globalVar.insentif_produksi = '<?= (isset($insentif_produksi)) ? number_format($insentif_produksi, 2, ",", ".") : '' ?>';
    // globalVar.insentif_kehadiran = '<?= (isset($insentif_kehadiran)) ? number_format($insentif_kehadiran, 2, ",", ".") : '' ?>';
    // globalVar.tj_kesetaraan = '<?= (isset($tj_kesetaraan)) ? number_format($tj_kesetaraan, 2, ",", ".") : '' ?>';
    // globalVar.tj_acting = '<?= (isset($tj_acting)) ? number_format($tj_acting, 2, ",", ".") : '' ?>';

    // globalVar.potongan_jamsostek_jht = '<?= (isset($potongan_jamsostek_jht)) ? number_format($potongan_jamsostek_jht, 2, ",", ".") : '' ?>';
    // globalVar.potongan_jamsostek_jp = '<?= (isset($potongan_jamsostek_jp)) ? number_format($potongan_jamsostek_jp, 2, ",", ".") : '' ?>';
    // globalVar.potongan_kasbon = '<?= (isset($potongan_kasbon)) ? number_format($potongan_kasbon, 2, ",", ".") : '' ?>';
    // globalVar.potongan_tiket = '<?= (isset($potongan_tiket)) ? number_format($potongan_tiket, 2, ",", ".") : '' ?>';

    // globalVar.total_tunjangan = '<?= (isset($total_tunjangan)) ? number_format($total_tunjangan, 2, ",", ".") : '' ?>';
    // globalVar.gaji_bruto = '<?= (isset($gaji_bruto)) ? number_format($gaji_bruto, 2, ",", ".") : '' ?>';

    // globalVar.total_potongan = '<?= (isset($total_potongan)) ? number_format($total_potongan, 2, ",", ".") : '' ?>';
    // globalVar.gaji_netto = '<?= (isset($gaji_netto)) ? number_format($gaji_netto, 2, ",", ".") : '' ?>';
    // globalVar.saldo_kasbon = '<?= (isset($saldo_kasbon)) ? number_format($saldo_kasbon, 2, ",", ".") : '' ?>';

    // globalVar.qrcode = '<?= $qrcode ?>';

    // $ummu.vars.hcm.payroll.gapok = '<?= (isset($gapok)) ? $gapok : '' ?>';
    // $ummu.vars.hcm.payroll.rapel_gaji = '<?= (isset($rapel_gaji)) ? $rapel_gaji : '' ?>';
    // $ummu.vars.hcm.payroll.lain_lain = '<?= (isset($lain_lain)) ? $lain_lain : '' ?>';
    // $ummu.vars.hcm.payroll.insentif_produksi = '<?= (isset($insentif_produksi)) ? $insentif_produksi : '' ?>';
    // $ummu.vars.hcm.payroll.insentif_kehadiran = '<?= (isset($insentif_kehadiran)) ? $insentif_kehadiran : '' ?>';
    // $ummu.vars.hcm.payroll.tj_kesetaraan = '<?= (isset($tj_kesetaraan)) ? $tj_kesetaraan : '' ?>';
    // $ummu.vars.hcm.payroll.tj_acting = '<?= (isset($tj_acting)) ? $tj_acting : '' ?>';
    // $ummu.vars.hcm.payroll.potongan_jamsostek_jht = '<?= (isset($potongan_jamsostek_jht)) ? $potongan_jamsostek_jht : '' ?>';
    // $ummu.vars.hcm.payroll.potongan_jamsostek_jp = '<?= (isset($potongan_jamsostek_jp)) ? $potongan_jamsostek_jp : '' ?>';
    // $ummu.vars.hcm.payroll.potongan_kasbon = '<?= (isset($potongan_kasbon)) ? $potongan_kasbon : '' ?>';
    // $ummu.vars.hcm.payroll.potongan_tiket = '<?= (isset($potongan_tiket)) ? $potongan_tiket : '' ?>';
    // $ummu.vars.hcm.payroll.total_tunjangan = '<?= (isset($total_tunjangan)) ? $total_tunjangan : '' ?>';
    // $ummu.vars.hcm.payroll.total_potongan = '<?= (isset($total_potongan)) ? $total_potongan : '' ?>';
    // $ummu.vars.hcm.payroll.gaji_bruto = '<?= (isset($gaji_bruto)) ? $gaji_bruto : '' ?>';
    // $ummu.vars.hcm.payroll.gaji_netto = '<?= (isset($gaji_netto)) ? $gaji_netto : '' ?>';
    // $ummu.vars.hcm.payroll.saldo_kasbon = '<?= (isset($saldo_kasbon)) ? $saldo_kasbon : '' ?>';
    // $ummu.vars.hcm.payroll.qrcode = '<?= $qrcode ?>';
</script>
<script src="<?= base_url() ?>js/admin/payroll/payslip_print.js"></script>
<?= $this->endSection() ?>