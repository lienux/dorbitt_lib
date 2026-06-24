<?= $this->extend('layout/'. config('Vh')->tmp()) ?>

<?= $this->section('css') ?>
    <style>
        /* body{
                margin-top:20px;
                background:#eee;
            } */

        .invoice {
            /*background-image: url(<?= base_url('CONFIDENTIAL.png') ?>);*/
            background: url(<?= base_url('CONFIDENTIAL.png') ?>);
            /*background: #fff;*/
            background-position: center;
            /* Center the image */
            background-repeat: no-repeat !important;
            /* Do not repeat the image */
            /*background-size: cover;*/
            /* Resize the background image to cover the entire container */
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
            /*margin-top: 10px;*/
            font-size: 85%
        }

        .invoice>div:not(.invoice-footer) {
            margin-bottom: 20px
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
            body {
                -webkit-print-color-adjust: exact;
                -moz-print-color-adjust: exact;
                -ms-print-color-adjust: exact;
                print-color-adjust: exact;
                background-image: url(<?= base_url('CONFIDENTIAL.png') ?>);
            }

            .invoice {
                background-image: url(<?= base_url('CONFIDENTIAL.png') ?>);
                background-position: center;
                /* Center the image */
                background-repeat: no-repeat !important;
                /* Do not repeat the image */
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
    <div class="col-md-6 col-sm-12 input-group input-group-sm mb-3 pl-0">
        <div class="input-group-prepend">
            <span class="input-group-text bg-info text-light">Periode</span>
        </div>
        <select class="custom-select" id="select_payslip_periode" name="select_payslip_periode">
            <option value="" disabled>Choose...</option>
        </select>
        <input type="password" aria-label="OTP" class="form-control" id="payslip_otp" name="payslip_otp"
            placeholder="OTP Saat Login">
        <div class="input-group-append">
            <button class="btn btn-outline-primary" type="button" id="search_payslip">SEARCH</button>
            <button class="btn btn-outline-primary" type="button" id="create_payslip_topdf">
                <i class="fas fa-file-pdf"></i>
                Create PDF
                <div class="spinner-border spinner-border-sm text-danger collapse" role="status" id="loader_download"></div>
            </button>
            <!-- <button class="btn btn-outline-primary" type="button" id="payslip_clear">
                Clear
                <div class="spinner-border spinner-border-sm text-danger collapse" role="status" id="loader_delete_pdf">
                </div>
            </button> -->
        </div>
    </div>

    <div class="card mb-4 shadow collapse" id="card_slip">
        <div class="card-body">
            <div class="col-md-12">
                <div class="invoice">
                    <div class="invoice-company text-inverse f-w-600">
                        <img src="<?= base_url() ?>hillcon_logo_text.jpeg" width="170px"><br>
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
                            <!-- <a href="javascript:;" class="btn btn-sm btn-white m-b-10 p-l-5 disabled" id="download_payslip"> -->
                            <!-- <i class="fas fa-file-download text-primary"></i>  -->
                            <!-- <i class="far fa-file-download text-danger"></i> -->
                            <!-- Download PDF -->
                            <!-- </a> -->
                            <!-- <div class="spinner-border spinner-border-sm text-danger collapse" role="status"
                                id="loader_download"></div> -->
                            <!-- <a href="javascript:;" class="btn btn-sm btn-white m-b-10 p-l-5 disabled" id="delete_pdf">
                                <i class="fa-solid fa-trash text-danger"></i>
                            </a> -->
                            <!-- <div class="spinner-border spinner-border-sm text-danger collapse" role="status"
                                id="loader_delete_pdf"></div> -->
                        </span>
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
            </div>
        </div>
    </div>

    <div class="card mb-4 collapse" id="pdf_payslip">
        <div class="card-body">
            <div class="col-md-12">
                <!-- <iframe src="" width="100%" height="700" id="link_pdf_payslip"></iframe> -->
                <object type="application/pdf" data="" width="100%" height="700" id="link_pdf_payslip"></object>
            </div>
        </div>
    </div>
<?= $this->include('partials/modal') ?>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
    <script>
        var globalVar = {
            qUrl: '<?= base_url() ?>' + 'admin/payslip/',
            errors_params: [],
            id: null,
            url_create_pdf: '<?= base_url('admin/payslip/version1Alya_create_pdf') ?>',
            delete_url: '<?= base_url('admin/payslip/delete_pdf') ?>'
        }
    </script>
    <script src="<?=config('Ummu')->script($module_kode . '/version1_alya_payslip')?>"></script>
<?= $this->endSection() ?>