<div class="modal fade" id="PayslipModal" tabindex="-1" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-scrollable modal-xl" id="modal_dialog">
        <div class="modal-content bg-light">
            <div class="modal-header bg-info py-2 text-light">
                <h6 class="modal-title">
                    <i class="fa-light fa-file-invoice"></i>
                    Payslip
                </h6>
                <div class="">
                    <button type="button" class="btn btn-sm btn-outline-light" id="btn_max"><i
                            class="fa-regular fa-arrows-maximize"></i></button>
                    <button type="button" class="btn btn-sm btn-outline-light" data-bs-dismiss="modal"><i
                            class="fa-light fa-rectangle-xmark"></i></button>
                </div>
            </div>
            <div class="modal-body">
                <style>
                    /* body{
                        margin-top:20px;
                        background:#eee;
                    } */

                    .invoice {
                        background: #fff;
                        padding: 20px
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
                        /*                        margin-top: 80px;*/
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
                </style>

                <div class="card mb-4 shadow">
                    <div class="card-body">
                        <div class="col-md-12">
                            <div class="invoice">
                                <div class="invoice-company text-inverse f-w-600">
                                    <img src="<?= base_url() ?>hillcon_logo_text.jpeg" width="170px"><br>
                                    <span class="pl-2">PT. HILLCONJAYA SAKTI</span>
                                    <span class="pull-right hidden-print float-right">
                                        <a href="javascript:;" class="btn btn-sm btn-white m-b-10 p-l-5"
                                            id="download_payslip">
                                            <i class="far fa-file-download text-danger"></i>
                                            Download PDF
                                        </a>
                                        <div class="spinner-border spinner-border-sm text-danger collapse" role="status"
                                            id="loader_download"></div>
                                        <a href="javascript:;" class="btn btn-sm btn-white m-b-10 p-l-5"
                                            id="delete_pdf">
                                            <i class="fa-solid fa-trash text-danger"></i>
                                        </a>
                                        <div class="spinner-border spinner-border-sm text-danger collapse" role="status"
                                            id="loader_delete_pdf"></div>
                                    </span>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_import2" tabindex="-2" style="z-index: 3000;">
    <div class="modal-dialog modal-dialog-centeredz">
        <div class="modal-content">
            <div class="modal-header bg-secondary py-2">
                <h5 class="modal-title text-light" id="message_title">Import</h5>
                <button type="button" class="btn-close bg-light" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="alert text-light collapse" id="modal_alert_import"></div>
            <div class="collapse" id="loader">
                <div class="d-flex justify-content-center mt-2">
                    <div class="spinner-border text-danger" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
            </div>
            <div class="modal-body">
                <form enctype="multipart/form-data" id="form_import_file">
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Periode</label>
                        <div class="col-sm-10">
                            <select class="custom-select" id="periode" name="periode">
                                <option value="" disabled>Choose...</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">File</label>
                        <div class="col-sm-10" id="form_import">
                            <input class="form-control" type="file" name="file" id="file_import">
                        </div>
                    </div>
                </form>

                <div class="mt-3">
                    <a class="text-sm" href="<?= base_url() ?>template_import/PAYROLL-GOL_3_up-dummy.xlsx"
                        target="_blank">
                        <i class="fas fa-file-excel"></i>
                        Click for download format import file
                    </a>
                </div>
            </div>
            <div class="modal-footer py-2">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <a href="#" type="button" class="btn btn-primary" id="btnImport" onclick="au_import();">Import</a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_filter_employee_salary" tabindex="-2">
    <div class="modal-dialog modal-dialog-centeredz">
        <div class="modal-content">
            <div class="modal-header bg-secondary py-2">
                <h5 class="modal-title text-light" id="message_title">Filter</h5>
                <button type="button" class="btn-close bg-light" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="alert text-light collapse" id="modal_alert_import"></div>
            <div class="collapse" id="loader">
                <div class="d-flex justify-content-center mt-2">
                    <div class="spinner-border text-danger" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
            </div>
            <div class="modal-body">
                <div class="form-group row mb-1">
                    <label for="date_from" class="col-sm-4 ccol-form-label col-form-label-sm">From Date</label>
                    <div class="col-sm-8">
                        <input name="date_from" id="date_from" type="text" class="form-control form-control-sm"
                            id="date_from">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="date_to" class="col-sm-4 col-form-label col-form-label-sm">To Date</label>
                    <div class="col-sm-8">
                        <input name="date_to" id="date_to" type="text" class="form-control form-control-sm">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="date_to" class="col-sm-4 col-form-label col-form-label-sm">Periode</label>
                    <div class="col-sm-8">
                        <select class="custom-selectz form-control form-control-sm" id="periode2"
                            name="periode2"></select>
                    </div>
                </div>
            </div>
            <div class="modal-footer py-2">
                <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
                <a href="#" type="button" class="btn btn-sm btn-primary" id="btnFilter"
                    onclick="add_fillter();">Save</a>
            </div>
        </div>
    </div>
</div>