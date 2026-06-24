<?php
    if ($data->rows) {
        $nika = $data->rows->nika;
        $name = $data->rows->name;
        $site = $data->rows->site;
        $jabatan = $data->rows->jabatan;
        $periode_name = $data->rows->periode_name;
        $gapok = number_format($data->rows->gapok_baru,2,",",".");
        $rapel_gaji = number_format($data->rows->rapel_gaji,2,",",".");
        $lain_lain = number_format($data->rows->lain_lain,2,",",".");
        $tj_acting = number_format($data->rows->tj_acting,2,",",".");
        $tj_kesetaraan = number_format($data->rows->tj_kesetaraan,2,",",".");
        $insentif_produksi = number_format($data->rows->insentif_produksi,2,",",".");
        $insentif_kehadiran = number_format($data->rows->insentif_kehadiran,2,",",".");
        $total_tunjangan = number_format($data->rows->total_tunjangan,2,",",".");
        $gaji_bruto = number_format($data->rows->gaji_bruto,2,",",".");
        $potongan_kasbon = number_format($data->rows->potongan_kasbon,2,",",".");
        $potongan_tiket = number_format($data->rows->potongan_tiket,2,",",".");
        $potongan_jamsostek_jht = number_format($data->rows->potongan_jamsostek_jht,2,",",".");
        $potongan_jamsostek_jp = number_format($data->rows->potongan_jamsostek_jp,2,",",".");
        $total_potongan = number_format($data->rows->total_potongan,2,",",".");
        $gaji_netto = number_format($data->rows->gaji_netto,2,",",".");
        $qrcode = $data->rows->qrcode;
    }

    else{
        $nika = "";
        $name = "";
        $site = "";
        $jabatan = "";
        $periode_name = "PERIODE BULAN ...";
        $gapok = "-";
        $rapel_gaji = "-";
        $lain_lain = "-";
        $tj_acting = "-";
        $tj_kesetaraan = "-";
        $insentif_produksi = "-";
        $insentif_kehadiran = "-";
        $total_tunjangan = "-";
        $gaji_bruto = "-";
        $potongan_kasbon = "-";
        $potongan_tiket = "-";
        $potongan_jamsostek_jht = "-";
        $potongan_jamsostek_jp = "-";
        $total_potongan = "-";
        $gaji_netto = "-";
        $qrcode = '';
    }
?>

<?= $this->extend('layout/'. config('Vh')->tmp()) ?>

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
            visibility: visible;
            padding: 20px;
            -webkit-print-color-adjust: exact !important;
            -moz-print-color-adjust: exact !important;
            -ms-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }

        .invoice-company {
            font-size: 20px
        }

        .invoice-header {
            /*margin: 0 -20px;*/
            background: #f0f3f4;
            padding: 20px 10px;
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
/*            margin-top: 10px;*/
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
            body {
                -webkit-print-color-adjust: exact;
                -moz-print-color-adjust: exact;
                -ms-print-color-adjust: exact;
                print-color-adjust: exact;
                background-image: url(<?=base_url('CONFIDENTIAL.png')?>);
            }
            .invoice {
                background-image: url(<?=base_url('CONFIDENTIAL.png')?>);
                background-position: center; /* Center the image */
                background-repeat: no-repeat !important; /* Do not repeat the image */
                visibility: visible;
                padding: 20px;
                -webkit-print-color-adjust: exact !important;
                -moz-print-color-adjust: exact !important;
                -ms-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }
        }
    </style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
    <div class="card mb-4 shadow" id="card_slip">
        <div class="card-body">
            <div class="col-md-12">
                <div class="invoice">
                    <!-- begin invoice-company -->
                    <div class="invoice-company text-inverse f-w-600">
                        <img src="<?=base_url()?>hillcon_logo_text.jpeg" width="170px"><br>
                        <span class="pl-2">PT. HILLCONJAYA SAKTI</span>
                        <span class="pull-right hidden-print float-right">
                            <!-- <a href="javascript:;" class="btn btn-sm btn-white m-b-10 p-l-5">
                                <i class="fa fa-file t-plus-1 text-danger fa-fw fa-lg"></i> Export as PDF
                            </a> -->
                            <!-- <a href="javascript:;" class="btn btn-sm btn-white m-b-10 p-l-5" id="print">
                                <i class="fa fa-print t-plus-1 fa-fw fa-lg"></i> Print
                            </a> -->
                            <!-- <a href="javascript:;" class="btn btn-sm btn-white m-b-10 p-l-5" id="create_pdf">
                                <i class="fa-solid fa-file-pdf text-danger"></i>
                                Create PDF
                            </a> -->
                            <a href="javascript:;" class="btn btn-sm btn-white m-b-10 p-l-5" id="download_payslip">
                                <!-- <i class="fas fa-file-download text-primary"></i>  -->
                                <i class="far fa-file-download text-danger"></i>
                                Download PDF
                            </a>
                            <div class="spinner-border spinner-border-sm text-danger collapse" role="status" id="loader_download"></div>
                            <a href="javascript:;" class="btn btn-sm btn-white m-b-10 p-l-5" id="delete_pdf">
                                <i class="fa-solid fa-trash text-danger"></i>
                            </a>
                            <div class="spinner-border spinner-border-sm text-danger collapse" role="status" id="loader_delete_pdf"></div>
                        </span>
                    </div>
                    <!-- end invoice-company -->
                    <!-- begin invoice-header -->
                    <div class="invoice-header row">
                        <div class="col-4">
                            <div class="row">
                                <div class="col">NIK</div>
                                <div>:</div>
                                <div class="col"><?=$nika?></div>
                            </div>
                            <div class="row">
                                <div class="col">Nama</div>
                                <div>:</div>
                                <div class="col"><?=$name?></div>
                            </div>
                        </div>
                        <div class="col-4"></div>
                        <div class="col-4">
                            <div class="row">
                                <div class="col">Lokasi Tugas</div>
                                <div>:</div>
                                <div class="col"><?=$site?></div>
                            </div>
                            <div class="row">
                                <div class="col">Jabatan</div>
                                <div>:</div>
                                <div class="col"><?=$jabatan?></div>
                            </div>
                        </div>
                        <div class="col-12 text-center pt-4">
                            <h5 class="font-weight-bold"><?=$periode_name?></h5>
                        </div>
                    </div>
                    <!-- end invoice-header -->
                    <!-- begin invoice-content -->
                    <div class="invoice-content">
                        <!-- begin table-responsive -->
                        <div class="table-responsive">
                            <table class="table table-invoice">
                               <!--  <thead>
                                    <tr>
                                        <th width="">TASK DESCRIPTION</th>
                                        <th class="text-center">Rp</th>
                                        <th class="text-right">Nilai</th>
                                        <th class="text-right">Description</th>
                                        <th class="text-center">Rp</th>
                                        <th class="text-right">Nilai</th>
                                    </tr>
                                </thead> -->
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
                                        <td>
                                            <img src="<?=$qrcode?>" width="100px">
                                        </td>
                                        <td colspan="3" class="text-right">
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
                        <!-- end table-responsive -->
                        <!-- begin invoice-price -->
                        <!-- <div class="invoice-price">
                            <div class="invoice-price-left">
                                <div class="invoice-price-row">
                                    <div class="sub-price">
                                        <small>SUBTOTAL</small>
                                        <span class="text-inverse">$4,500.00</span>
                                    </div>
                                    <div class="sub-price">
                                        <i class="fa fa-plus text-muted"></i>
                                    </div>
                                    <div class="sub-price">
                                        <small>PAYPAL FEE (5.4%)</small>
                                        <span class="text-inverse">$108.00</span>
                                    </div>
                                </div>
                            </div>
                            <div class="invoice-price-right">
                                <small>TOTAL</small> <span class="f-w-600">$4508.00</span>
                            </div>
                        </div> -->
                        <!-- end invoice-price -->
                    </div>
                    <!-- end invoice-content -->
                    <!-- begin invoice-note -->
                    <div class="invoice-note">
                        <!-- * This pay slip is created using an online system<br> -->
                        * Slip gaji ini dibuat dengan menggunakan sistem online<br>
                        <!-- * This payslip is confidential<br> -->
                        <!-- * If you have any questions concerning this payslip, contact  [Hendra, 0858xxxxx, ho.hro.sectionhead@hillconmining.com] -->
                        <!-- * Jika Anda mempunyai pertanyaan mengenai slip gaji ini, hubungi HR site masing-masing. -->
                    </div>
                    <!-- end invoice-note -->
                    <!-- begin invoice-footer -->
                    <div class="invoice-footer">
                        <!-- <p class="text-center m-b-5 f-w-600">
                            THANK YOU FOR YOUR DEDICATION
                        </p> -->
                        <p class="text-center">
                            <span class="m-r-10">
                                <!-- <i class="fa fa-fw fa-lg fa-globe"></i> -->
                                www.hillcon.co.id
                            </span>
                            <!-- <span class="m-r-10">
                                <i class="fa fa-fw fa-lg fa-phone-volume"></i> 
                                T:016-18192302
                            </span>
                            <span class="m-r-10">
                                <i class="fa fa-fw fa-lg fa-envelope"></i>
                                ho.hro.sectionhead@hillconmining.com
                            </span> -->
                        </p>
                    </div>
                    <!-- end invoice-footer -->
                </div>
            </div>
        </div>
    </div>
    <?= $this->include('pages/approval/doc/form') ?>
    <?= $this->include('partials/modal') ?>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
    <!-- <script src="<?=base_url()?>js/admin/approval/doc.js"></script> -->
    <script>
        // 

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

        $('#download_payslip').on('click', function() {
            $('#loader_download').removeClass('collapse');
            
            var url = "<?=base_url('admin/payslip/download_pdf')?>";

            var ummu = $ummu.ajax.show0(url);
            ummu.done(function(result) {
                console.log(result)
                var response = result;
                // var response = JSON.parse(result);
                if (response.status==true) {
                    $('#loader_download').addClass('collapse');

                    // window.location.href = response.file_url;
                    window.open(response.file_url, '_blank');
                    // table.ajax.reload();
                    // $('#modal_import2').modal('hide');
                    // $ummu.func.ch_message(response.message);
                }else{
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
            })
        });

        $('#delete_pdf').on('click', function() {
            $('#loader_delete_pdf').removeClass('collapse');

            var url = "<?=base_url('admin/payslip/delete_pdf')?>";

            var ummu = $ummu.ajax.show0(url);
            ummu.done(function(result) {
                console.log(result)
                var response = result;
                // var response = JSON.parse(result);
                if (response.status==true) {
                    $('#loader_delete_pdf').addClass('collapse');
                }
            })
        });
    </script>
<?= $this->endSection() ?>