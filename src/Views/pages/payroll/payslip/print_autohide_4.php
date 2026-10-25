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
        <span class="pl-2" id="company_name">PT. HILLCONJAYA SAKTI</span>
    </div>
    <?= $this->include(config('Vh')->ummuView($dir_views . 'payslip_parameter')) ?>
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

    var gapok = $ummu.helpers.currency.us('<?= (isset($gapok_baru)) ? $gapok_baru : ''?>'),
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
    qrcode = '<?= (isset($qrcode)) ? $qrcode : '' ?>',
    nik = '<?= (isset($nika)) ? $nika : '' ?>',
    name = '<?= (isset($name)) ? $name : '' ?>',
    site = '<?= (isset($site)) ? $site : '' ?>',
    jabatan = '<?= (isset($jabatan)) ? $jabatan : '' ?>',
    periode_name = '<?= (isset($periode_name)) ? $periode_name : '' ?>';

    $('#nik').html(nik);
    $('#name').html(name);
    $('#site').html(site);
    $('#jabatan').html(jabatan);
    $('#periode_name').html(periode_name);

    $('#company_name').addClass('collapse')

    // 1. Cari elemen berdasarkan ID
    const elemen = document.getElementById('company_name');

    // 2. Tambahkan class baru (misalnya class "btn-success" dan "active")
    if (elemen) {
        elemen.classList.add('collapse');
        
        // Kamu juga bisa menambahkan beberapa class sekaligus:
        // elemen.classList.add('class1', 'class2', 'class3');
    }
</script>
<script src="<?=config('Ummu')->script($module_kode . '/payslip_print_4')?>"></script>
<?= $this->endSection() ?>