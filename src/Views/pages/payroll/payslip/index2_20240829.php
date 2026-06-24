<?php
    $nika = $nika;
    $name = $name;
    $site = $site;
    $jabatan = $jabatan;
    $periode_name = $periode_name;
    $gapok = number_format($gapok,2,",",".");
    $rapel_gaji = number_format($rapel_gaji,2,",",".");
    $lain_lain = number_format($lain_lain,2,",",".");
    $tj_acting = number_format($tj_acting,2,",",".");
    $tj_kesetaraan = number_format($tj_kesetaraan,2,",",".");
    $insentif_produksi = number_format($insentif_produksi,2,",",".");
    $insentif_kehadiran = number_format($insentif_kehadiran,2,",",".");
    $total_tunjangan = number_format($total_tunjangan,2,",",".");
    $gaji_bruto = number_format($gaji_bruto,2,",",".");
    $potongan_kasbon = number_format($potongan_kasbon,2,",",".");
    $potongan_tiket = number_format($potongan_tiket,2,",",".");
    $potongan_jamsostek_jht = number_format($potongan_jamsostek_jht,2,",",".");
    $potongan_jamsostek_jp = number_format($potongan_jamsostek_jp,2,",",".");
    $total_potongan = number_format($total_potongan,2,",",".");
    $gaji_netto = number_format($gaji_netto,2,",",".");
?>

<?= $this->extend('layout/paper') ?>

<?= $this->section('css') ?>
    <style>
        /* body{
            margin-top:20px;
            background:#eee;
        } */

        .invoice {
            /*background-image: url(<?=base_url('CONFIDENTIAL.png')?>);*/
            background: url(<?=base_url('CONFIDENTIAL.png')?>);
            /*background: #fff;*/
            background-position: center; /* Center the image */
            background-repeat: no-repeat !important; /* Do not repeat the image */
            /*background-size: cover;*/ /* Resize the background image to cover the entire container */
            /*visibility: visible;*/
            /*padding: 20px;*/
            /*webkit-print-color-adjust: exact !important;
            -moz-print-color-adjust: exact !important;
            -ms-print-color-adjust: exact !important;
            print-color-adjust: exact !important;*/
        }

        .invoice-company {
            font-size: 20px
        }

        .invoice-header {
            margin: 0 -20px;
            background: #f0f3f4;
            padding: 20px 0px;
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
            font-size: 12px;
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
            font-size: 12px
        }

        .invoice-footer {
            border-top: 1px solid #ddd;
            padding-top: 10px;
            font-size: 10px
        }

        .invoice-note {
            color: #999;
            margin-top: 80px;
            font-size: 85%
        }

        .invoice>div:not(.invoice-footer) {
            margin-bottom: 20px
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
                    <div class="col"><?=$nika?></div>
                </div>
                <div class="row">
                    <div class="col-4 px-0">Nama</div>
                    <div>:</div>
                    <div class="col"><?=$name?></div>
                </div>
            </div>
            <div class="col-6">
                <div class="row">
                    <div class="col-4 px-0">Lokasi Tugas</div>
                    <div>:</div>
                    <div class="col"><?=$site?></div>
                </div>
                <div class="row">
                    <div class="col-4 px-0">Jabatan</div>
                    <div>:</div>
                    <div class="col"><?=$jabatan?></div>
                </div>
            </div>
            <div class="col-12 text-center pt-4">
                <h5 class="font-weight-bold"><?=$periode_name?></h5>
            </div>
        </div>
        <div class="invoice-content">
            <div class="table-responsive">
                <table class="table table-invoice">
                    <tbody>
                        <tr>
                            <td class="Description">
                                <span class="text-inverse">Gaji Pokok</span><br>
                                <small class="ml-5">Rapel Gaji</small><br>
                                <small class="ml-5">Lain Lain</small>
                            </td>
                            <td class="text-center Rp"></td>
                            <td class="text-right Nilai"></td>
                            <td class="text-right Nilai"></td>
                            <td class="text-center Rp">
                                <small>Rp.</small><br>
                                <small>Rp.</small><br>
                                <small>Rp.</small>
                            </td>
                            <td class="text-right Nilai">
                                <small class="font-weight-bold"><?=$gapok?></small><br>
                                <small class="font-weight-bold"><?=$rapel_gaji?></small><br>
                                <small class="font-weight-bold"><?=$lain_lain?></small>
                            </td>
                        </tr>
                        <tr>
                            <td class="Description">
                                <span class="text-inverse">Tunjangan</span><br>
                                <small class="ml-5">Tunjangan Acting</small><br>
                                <small class="ml-5">Tunjangan Kesetaraan</small><br>
                                <small class="ml-5">Insentif Produksi</small><br>
                                <small class="ml-5">Insentif Kehadiran</small>
                            </td>
                            <td class="text-center">
                                <span></span><br>
                                <small>Rp.</small> <br>
                                <small>Rp.</small> <br>
                                <small>Rp.</small> <br>
                                <small>Rp.</small>
                            </td>
                            <td class="text-right">
                                <small></small> <br>
                                <small><?=$tj_acting?></small> <br>
                                <small><?=$tj_kesetaraan?></small> <br>
                                <small><?=$insentif_produksi?></small> <br>
                                <small><?=$insentif_kehadiran?></small>
                            </td>
                            <td class="text-center"></td>
                            <td class="text-center"></td>
                            <td class="text-right"></td>
                        </tr>
                        <tr>
                            <td colspan="4" class="text-right">
                                <small>Total Tunjangan</small><br>
                                <small class="font-weight-bold">Gaji Bruto</small>
                            </td>
                            <td class="text-center">
                                <small>Rp.</small><br>
                                <small>Rp.</small>
                            </td>
                            <td class="text-right">
                                <small class="font-weight-bold"><?=$total_tunjangan?></small><br>
                                <small class="font-weight-bold"><?=$gaji_bruto?></small>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <span class="text-inverse">Potongan</span><br>
                                <small class="ml-5">Potongan Kasbon</small><br>
                                <small class="ml-5">Potongan Tiket</small><br>
                                <small class="ml-5">Potongan Jamsostek JHT</small><br>
                                <small class="ml-5">Potongan Jamsostek JP</small>
                            </td>
                            <td class="text-center">
                                <span></span><br>
                                <small>Rp.</small> <br>
                                <small>Rp.</small> <br>
                                <small>Rp.</small> <br>
                                <small>Rp.</small>
                            </td>
                            <td class="text-right">
                                <small></small> <br>
                                <small><?=$potongan_kasbon?></small> <br>
                                <small><?=$potongan_tiket?></small> <br>
                                <small><?=$potongan_jamsostek_jht?></small> <br>
                                <small><?=$potongan_jamsostek_jp?></small>
                            </td>
                            <td class="text-center"></td>
                            <td class="text-center"></td>
                            <td class="text-right"></td>
                        </tr>
                        <tr>
                            <td colspan="4" class="text-right">
                                <small>Total Potongan</small><br>
                                <small class="font-weight-bold">Gaji Netto (THP)</small>
                            </td>
                            <td class="text-center">
                                <small>Rp.</small><br>
                                <small>Rp.</small>
                            </td>
                            <td class="text-right">
                                <small class="font-weight-bold"><?=$total_potongan?></small><br>
                                <small class="font-weight-bold"><?=$gaji_netto?></small>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="invoice-note">
            * Slip gaji ini dibuat dengan menggunakan sistem online<br>
            <!-- * Jika Anda mempunyai pertanyaan mengenai slip gaji ini, hubungi HR site masing-masing. -->
        </div>
        <div class="invoice-footer">
            <!-- <p class="text-center m-b-5 f-w-600">
                THANK YOU FOR YOUR DEDICATION
            </p> -->
            <p class="text-center">
                <span class="m-r-10">
                    www.hillcon.co.id
                </span>
            </p>
        </div>
    </div>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
    <!-- <script src="<?=base_url()?>js/admin/approval/doc.js"></script> -->
    <script>
        $('#print').on('click', function() {
            $('#accordionSidebar').removeClass('toggled');
            $('#dorbitt_tab_page').removeClass('collapse');
            $('#dorbitt_tab_page').removeClass('collapse');
            $('#card_slip').removeClass('shadow')
            $('#card_slip').addClass('border-0')
            // $('.invoice').css('background-image', 'url("https://iescm.hillcon.co.id/CONFIDENTIAL.png")');
            
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
    </script>
<?= $this->endSection() ?>