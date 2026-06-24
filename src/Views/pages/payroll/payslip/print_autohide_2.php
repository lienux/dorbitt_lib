<?php 
    if (isset($saldo_kasbon)) {
        $saldo_kasbon = $saldo_kasbon;
    }else{
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
        
        @media print{
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
            /*background: url(<?=base_url('CONFIDENTIAL.png')?>);*/
            /*background-size: 75%;*/
            /*background: #fff;*/
            /*background-attachment: fixed;*/
            /*background-position: center;*/ /* Center the image */
            /*background-repeat: no-repeat !important;*/ /* Do not repeat the image */
            /*background-size: cover;*/ /* Resize the background image to cover the entire container */
            /*visibility: visible;*/
            /*padding: 20px;*/
            /*webkit-print-color-adjust: exact !important;
            -moz-print-color-adjust: exact !important;
            -ms-print-color-adjust: exact !important;
            print-color-adjust: exact !important;*/
        }

        .invoice-content {
            background: url(<?=base_url('CONFIDENTIAL.png')?>);
            background-position: center; /* Center the image */
            background-repeat: no-repeat !important; /* Do not repeat the image */
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

        .btn.btn-white, .btn.btn-white.disabled, .btn.btn-white.disabled:focus, .btn.btn-white.disabled:hover, .btn.btn-white[disabled], .btn.btn-white[disabled]:focus, .btn.btn-white[disabled]:hover {
            color: #2d353c;
            background: #fff;
            border-color: #d9dfe3;
        }

        @media print{
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

        .table th, .table td {
            padding: 0.15rem;
            /* vertical-align: top;
            border-top: 1px solid #dee2e6; */
        }
        .table td, .table th {
            padding: .15rem;
            /* vertical-align: top;
            border-top: 1px solid #e3e6f0; */
        }
    </style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
    <div class="invoice" id="card_slip">
        <div class="invoice-company text-inverse f-w-600">
            <img src="<?=base_url()?>hillcon_logo_text.jpeg" width="170px"><br>
            <span class="pl-2">PT. HILLCONJAYA SAKTI</span>
        </div>
        <div class="invoice-header row">
            <div class="col-6">
                <div class="row">
                    <div class="col-4 px-0">NIK</div>
                    <div>:</div>
                    <div class="col" id="nik"></div>
                </div>
                <div class="row">
                    <div class="col-4 px-0">Nama</div>
                    <div>:</div>
                    <div class="col" id="name"></div>
                </div>
            </div>
            <div class="col-6">
                <div class="row">
                    <div class="col-4 px-0">Lokasi Tugas</div>
                    <div>:</div>
                    <div class="col" id="site"></div>
                </div>
                <div class="row">
                    <div class="col-4 px-0">Jabatan</div>
                    <div>:</div>
                    <div class="col" id="jabatan"></div>
                </div>
            </div>
            <div class="col-12 text-center pt-2">
                <h5 class="font-weight-bold m-0" id="periode_name"></h5>
            </div>
        </div>
        <div class="invoice-content mb-0">
            <div class="table-responsive mb-0">
                <table class="table table-invoice mb-0">
                    <tbody>
                        <!-- Gapok -->
                        <tr>
                            <td class="Description">
                                <span class="text-inverse" style="font-weight: bold;">Gaji Pokok</span><br>
                                <?=($rapel_gaji == 0 OR $rapel_gaji == null OR $rapel_gaji == '' OR $rapel_gaji == '0.00') ?'':'<span class="ml-5">Rapel Gaji</span><br>' ?>
                                <?=($lain_lain == 0 OR $lain_lain == null OR $lain_lain == '' OR $lain_lain == '0.00') ?'':'<span class="ml-5">Lain Lain</span><br>' ?>

                                <?=($rapel_gaji == 0 OR $rapel_gaji == null OR $rapel_gaji == '' OR $rapel_gaji == '0.00') ?'<span class="ml-5"></span><br>':'' ?>
                                <?=($lain_lain == 0 OR $lain_lain == null OR $lain_lain == '' OR $lain_lain == '0.00') ?'<span class="ml-5"></span><br>':'' ?>
                            </td>
                            <td class="text-center Rp"></td>
                            <td class="text-right Nilai"></td>
                            <td class="text-right Nilai"></td>
                            <td class="text-center Rp">
                                <span>Rp.</span><br>
                                <?=($rapel_gaji == 0 OR $rapel_gaji == null OR $rapel_gaji == '' OR $rapel_gaji == '0.00') ?'':'<span>Rp. </span><br>' ?>
                                <?=($lain_lain == 0 OR $lain_lain == null OR $lain_lain == '' OR $lain_lain == '0.00') ?'':'<spa>Rp. </span><br>' ?>
                            </td>
                            <td class="text-right Nilai">
                                <span class="font-weight-bold"><?=number_format($gapok,2,",",".")?></span><br>
                                <?=($rapel_gaji == 0 OR $rapel_gaji == null OR $rapel_gaji == '' OR $rapel_gaji == '0.00') ?'':'<span>'. number_format($rapel_gaji,2,",",".") .'</span><br>' ?>
                                <?=($lain_lain == 0 OR $lain_lain == null OR $lain_lain == '' OR $lain_lain == '0.00') ?'':'<span>'. number_format($lain_lain,2,",",".") .'</span><br>' ?>
                            </td>
                        </tr>
                        
                        <!-- Tunjangan -->
                        <tr>
                            <td class="Description">
                                <span class="text-inverse" style="font-weight: bold;">Tunjangan</span><br>
                                <?=($insentif_produksi == 0 OR $insentif_produksi == null OR $insentif_produksi == '' OR $insentif_produksi == '0.00') ?'':'<span class="ml-5">Insentif Produksi</span><br>' ?>
                                <?=($insentif_kehadiran == 0 OR $insentif_kehadiran == null OR $insentif_kehadiran == '' OR $insentif_kehadiran == '0.00') ?'':'<span class="ml-5">Insentif Kehadiran</span><br>' ?>
                                <?=($tj_kesetaraan == 0 OR $tj_kesetaraan == null OR $tj_kesetaraan == '' OR $tj_kesetaraan == '0.00') ?'':'<span class="ml-5">Tunjangan Kesetaraan</span><br>' ?>
                                <?=($tj_acting == 0 OR $tj_acting == null OR $tj_acting == '' OR $tj_acting == '0.00') ?'':'<span class="ml-5">Tunjangan Acting</span><br>' ?>

                                <?=($insentif_produksi == 0 OR $insentif_produksi == null OR $insentif_produksi == '' OR $insentif_produksi == '0.00') ?'<span class="ml-5"></span><br>':'' ?>
                                <?=($insentif_kehadiran == 0 OR $insentif_kehadiran == null OR $insentif_kehadiran == '' OR $insentif_kehadiran == '0.00') ?'<span class="ml-5"></span><br>':'' ?>
                                <?=($tj_kesetaraan == 0 OR $tj_kesetaraan == null OR $tj_kesetaraan == '' OR $tj_kesetaraan == '0.00') ?'<span class="ml-5"></span><br>':'' ?>
                                <?=($tj_acting == 0 OR $tj_acting == null OR $tj_acting == '' OR $tj_acting == '0.00') ?'<span class="ml-5"></span><br>':'' ?>
                            </td>
                            <td class="text-center">
                                <span></span><br>
                                <?=($insentif_produksi == 0 OR $insentif_produksi == null OR $insentif_produksi == '' OR $insentif_produksi == '0.00') ?'':'<span>Rp. </span><br>' ?>
                                <?=($insentif_kehadiran == 0 OR $insentif_kehadiran == null OR $insentif_kehadiran == '' OR $insentif_kehadiran == '0.00') ?'':'<span>Rp. </span><br>' ?>
                                <?=($tj_kesetaraan == 0 OR $tj_kesetaraan == null OR $tj_kesetaraan == '' OR $tj_kesetaraan == '0.00') ?'':'<span>Rp. </span><br>' ?>
                                <?=($tj_acting == 0 OR $tj_acting == null OR $tj_acting == '' OR $tj_acting == '0.00') ?'':'<span>Rp. </span><br>' ?>
                            </td>
                            <td class="text-right">
                                <span></span><br>
                                <?=($insentif_produksi == 0 OR $insentif_produksi == null OR $insentif_produksi == '' OR $insentif_produksi == '0.00') ?'':'<span>'. number_format($insentif_produksi,2,",",".") .'</span><br>' ?>
                                <?=($insentif_kehadiran == 0 OR $insentif_kehadiran == null OR $insentif_kehadiran == '' OR $insentif_kehadiran == '0.00') ?'':'<span>'. number_format($insentif_kehadiran,2,",",".") .'</span><br>' ?>
                                <?=($tj_kesetaraan == 0 OR $tj_kesetaraan == null OR $tj_kesetaraan == '' OR $tj_kesetaraan == '0.00') ?'':'<span>'. number_format($tj_kesetaraan,2,",",".") .'</span><br>' ?>
                                <?=($tj_acting == 0 OR $tj_acting == null OR $tj_acting == '' OR $tj_acting == '0.00') ?'':'<span>'. number_format($tj_acting,2,",",".") .'</span><br>' ?>
                            </td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        
                        <!-- total tunjangan -->
                        <tr>
                            <td></td>
                            <td colspan="3" class="text-right">
                                <div class="font-weight-bold text-left">Total Tunjangan</div>
                                <div class="font-weight-bold">Gaji Bruto</div>
                            </td>
                            <td class="text-center">
                                <span>Rp.</span><br>
                                <span>Rp.</span>
                            </td>
                            <td class="text-right">
                                <span class="font-weight-bold"><?=number_format($total_tunjangan,2,",",".")?></span><br>
                                <span class="font-weight-bold"><?=number_format($gaji_bruto,2,",",".")?></span>
                            </td>
                        </tr>
                        
                        <!-- Potongan -->
                        <tr>
                            <td>
                                <span class="text-inverse" style="font-weight: bold;">Potongan</span><br>
                                <?=($potongan_jamsostek_jht == 0 OR $potongan_jamsostek_jht == null OR $potongan_jamsostek_jht == '' OR $potongan_jamsostek_jht == '0.00') ?'':'<span class="ml-5">Potongan Jamsostek (JHT 2%)</span><br>' ?>
                                <?=($potongan_jamsostek_jp == 0 OR $potongan_jamsostek_jp == null OR $potongan_jamsostek_jp == '' OR $potongan_jamsostek_jp == '0.00') ?'':'<span class="ml-5">Potongan Jamsostek (JP 1%)</span><br>' ?>
                                <?=($potongan_kasbon == 0 OR $potongan_kasbon == null OR $potongan_kasbon == '' OR $potongan_kasbon == '0.00') ?'':'<span class="ml-5">Potongan Kasbon</span><br>' ?>
                                <?=($potongan_tiket == 0 OR $potongan_tiket == null OR $potongan_tiket == '' OR $potongan_tiket == '0.00') ?'':'<span class="ml-5">Potongan Tiket</span><br>' ?>

                                <?=($potongan_jamsostek_jht == 0 OR $potongan_jamsostek_jht == null OR $potongan_jamsostek_jht == '' OR $potongan_jamsostek_jht == '0.00') ?'<span class="ml-5"></span><br>':'' ?>
                                <?=($potongan_jamsostek_jp == 0 OR $potongan_jamsostek_jp == null OR $potongan_jamsostek_jp == '' OR $potongan_jamsostek_jp == '0.00') ?'<span class="ml-5"></span><br>':'' ?>
                                <?=($potongan_kasbon == 0 OR $potongan_kasbon == null OR $potongan_kasbon == '' OR $potongan_kasbon == '0.00') ?'<span class="ml-5"></span><br>':'' ?>
                                <?=($potongan_tiket == 0 OR $potongan_tiket == null OR $potongan_tiket == '' OR $potongan_tiket == '0.00') ?'<span class="ml-5"></span><br>':'' ?>
                            </td>
                            <td class="text-center">
                                <span></span><br>
                                <?=($potongan_jamsostek_jht == 0 OR $potongan_jamsostek_jht == null OR $potongan_jamsostek_jht == '' OR $potongan_jamsostek_jht == '0.00') ?'':'<span>Rp. </span><br>' ?>
                                <?=($potongan_jamsostek_jp == 0 OR $potongan_jamsostek_jp == null OR $potongan_jamsostek_jp == '' OR $potongan_jamsostek_jp == '0.00') ?'':'<span>Rp. </span><br>' ?>
                                <?=($potongan_kasbon == 0 OR $potongan_kasbon == null OR $potongan_kasbon == '' OR $potongan_kasbon == '0.00') ?'':'<span>Rp. </span><br>' ?>
                                <?=($potongan_tiket == 0 OR $potongan_tiket == null OR $potongan_tiket == '' OR $potongan_tiket == '0.00') ?'':'<span>Rp. </span><br>' ?>
                            </td>
                            <td class="text-right">
                                <span></span><br>
                                <?=($potongan_jamsostek_jht == 0 OR $potongan_jamsostek_jht == null OR $potongan_jamsostek_jht == '' OR $potongan_jamsostek_jht == '0.00') ?'':'<span class="ml-5">'. number_format($potongan_jamsostek_jht,2,",",".") .'</span><br>' ?>
                                <?=($potongan_jamsostek_jp == 0 OR $potongan_jamsostek_jp == null OR $potongan_jamsostek_jp == '' OR $potongan_jamsostek_jp == '0.00') ?'':'<span class="ml-5">'. number_format($potongan_jamsostek_jp,2,",",".") .'</span><br>' ?>
                                <?=($potongan_kasbon == 0 OR $potongan_kasbon == null OR $potongan_kasbon == '' OR $potongan_kasbon == '0.00') ?'':'<span class="ml-5">'. number_format($potongan_kasbon,2,",",".") .'</span><br>' ?>
                                <?=($potongan_tiket == 0 OR $potongan_tiket == null OR $potongan_tiket == '' OR $potongan_tiket == '0.00') ?'':'<span class="ml-5">'. number_format($potongan_tiket,2,",",".") .'</span><br>' ?>
                            </td>
                            <td class="text-center"></td>
                            <td class="text-center"></td>
                            <td class="text-right"></td>
                        </tr>
                        
                        <!-- total potongan -->
                        <tr>
                            <td>
                                <img src="<?=$qrcode?>" width="75px">
                                <span></span><br>
                                <span></span>
                            </td>
                            <td colspan="3" class="text-right">
                                <div class="font-weight-bold text-left">Total Potongan</div>
                                <div class="font-weight-bold">Gaji Netto (THP)</div>
                                <div class="font-weight-bold">Saldo Kasbon</div>
                            </td>
                            <td class="text-center">
                                <span>Rp.</span><br>
                                <span>Rp.</span><br>
                                <span>Rp.</span><br>
                            </td>
                            <td class="text-right">
                                <span class="font-weight-bold"><?=number_format($total_potongan,2,",",".")?></span><br>
                                <span class="font-weight-bold"><?=number_format($gaji_netto,2,",",".")?></span><br>
                                <span class="font-weight-bold"><?=number_format($saldo_kasbon,2,",",".")?></span><br>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
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
        $('#print').on('click', function() {
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

        $('#nik').html('<?=(isset($nika))?$nika:''?>');
        $('#name').html('<?=(isset($name))?$name:''?>');
        $('#site').html('<?=(isset($site))?$site:''?>');
        $('#jabatan').html('<?=(isset($jabatan))?$jabatan:''?>');
        $('#periode_name').html('<?=(isset($periode_name))?$periode_name:''?>');
    </script>
<?= $this->endSection() ?>