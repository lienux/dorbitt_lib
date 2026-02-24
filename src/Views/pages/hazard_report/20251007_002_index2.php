<?= $this->extend('layout/'.config('Vh')->tmp()) ?>

<?= $this->section('css') ?>
<?= $this->include('plugins/datatables/style') ?>
<!-- <link rel="stylesheet" type="text/css" href="<?= base_url() ?>css/admin/approval.css"> -->
<style>
    .table td {
        padding: 0rem;
        /* vertical-align: top; */
        /* border-top: 1px solid #dee2e6; */
    }

    /*.dorbitt-form-control {
            border: 0px;
            width: 100px;
        }*/
    .td-form-control {
        display: block;
        width: 100%;
        /*height: calc(1.5em + 0.75rem + 2px);*/
        /*height: 0px;*/
        /*padding: 0px;*/
        /*font-size: 1rem;*/
        /*font-weight: 400;*/
        /*line-height: 1.5;*/
        color: #495057;
        /*background-color: #fff;*/
        /*background-clip: padding-box;*/
        border: 0px;
        /*border-radius: 0.25rem;*/
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    }

    .dorbitt-form-control-sm {
        height: calc(1.5em + 0rem + 1px);
        /* padding: 0.25rem 0.5rem; */
        /* font-size: 0.875rem; */
        /* line-height: 1.5; */
        /* border-radius: 0.2rem; */
    }

    .dataTables_scroll {
        overflow: auto;
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="card rounded-0 mb-3">
    <div class="card-body pt-2 collapse" id="agreement_area">
        <?= $this->include('pages/hazard_report/agreement2') ?>
    </div>
    <div class="card-body pt-2 collapsez" id="entry_area" style="min-height: 370px;">
        <!-- <div class="card py-1 my-1">
                <div class="row">
                    <div class="col-md-6 col-sm-12 my-1">
                        <div class="col-lg-6">
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroup-sizing-sm"><i class="fa-light fa-magnifying-glass"></i> Search : </span>
                                </div>
                                <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12 my-1" id="btn_std_shb"></div>
                </div>
            </div> -->
        <div>
            <nav>
                <div class="nav nav-tabs text-sm" id="nav-tab" role="tablist">
                    <!-- <button class="nav-link active py-0" id="nav-agreement-tab" data-toggle="tab" data-target="#nav-agreement" type="button" role="tab" aria-controls="nav-agreement" aria-selected="true">
                            <i class="far fa-file-contract text-info"></i>
                            Agreement
                        </button> -->
                    <button class="nav-link py-0 active" id="nav-home-tab" data-toggle="tab" data-target="#nav-home"
                        type="button" role="tab" aria-controls="nav-home" aria-selected="true">
                        <i class="fa-light fa-laptop-arrow-down text-info"></i>
                        Entry
                    </button>
                    <button class="nav-link disabled" id="nav-list-tab" data-toggle="tab" data-target="#nav-list"
                        type="button" role="tab" aria-controls="nav-list" aria-selected="false">
                        <i class="fal fa-list-alt text-info"></i>
                        Data list
                    </button>
                </div>
            </nav>
        </div>
        <div class="tab-content pt-2" id="nav-tabContent">
            <!-- <div class="tab-pane fade active show" id="nav-agreement" role="tabpanel" aria-labelledby="nav-agreement-tab">
                    <?//= $this->include('pages/hazard_report/agreement') ?>
                </div> -->
            <div class="tab-pane fade active show" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                <!-- <div class="card py-1 my-1"> -->
                <div class="row mb-2">
                    <div class="col-md-6 col-sm-12 my-1" id="btn_std_shb"></div>
                </div>
                <!-- </div> -->
                <?= $this->include('pages/hazard_report/form') ?>
            </div>
            <div class="tab-pane fade" id="nav-list" role="tabpanel" aria-labelledby="nav-list-tab">
                <?= $this->include('pages/hazard_report/table') ?>
            </div>
        </div>
    </div>
</div>
<!-- <?//= $this->include('pages/payment_request/cash/form') ?> -->
<?= $this->include('pages/payment_request/cash/modal') ?>
<?= $this->include('partials/modal') ?>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
    var datenow = "<?= date('Y-m-d') ?>";
</script>
<?= $this->include('plugins/datatables/script') ?>
<script src="<?= base_url('js/admin/hazard_report/index.js?time=' . date('YmdHis')) ?>"></script>
<script>
    // $('#dbtn_new').attr('disabled', false);
    new DateTime(document.getElementById('date_from'));
    new DateTime(document.getElementById('date_to'));

    // if ($ummu.vars.action == 'new' || $ummu.vars.action == 'edit') {
    // $('#from_date, #to_date, #doc_date, #cash_date').datepicker({
    //     // uiLibrary: 'bootstrap4'
    //     "dateFormat": "yy-mm-dd"
    // });
    // }else{

    // }

    // ----------multiplefile-upload---------
    $("#multiplefileupload").fileinput({
        theme: "explorer-fas",
        uploadUrl: "#",
        deleteUrl: "#",
        initialPreviewAsData: true,
        overwriteInitial: false,
        dropZoneTitle: '<div class="upload-area"><i class="far fa-images"></i><p>Browse or Drag and Drop .jpg, .png, .gif</p> <div> <button>Browse File</button> </div></div>',
        dropZoneClickTitle: "",
        browseOnZoneClick: true,
        showRemove: false,
        showUpload: false,
        showZoom: false,
        showCaption: false,
        showBrowse: false,
        browseClass: "btn btn-danger",
        browseLabel: "",
        browseIcon: "<i class='fa fa-plus'></i>",
        fileActionSettings: {
            showUpload: false,
            showDownload: false,
            showZoom: false,
            showDrag: true,
            removeIcon: "<i class='fa fa-times'></i>",
            uploadIcon: "<i class='fa fa-upload'></i>",
            dragIcon: "<i class='fa fa-arrows-alt'></i>",
            uploadRetryIcon: "<i class='fa fa-undo-alt'></i>",
            dragClass: "file-drag",
            removeClass: "file-remove",
            removeErrorClass: 'file-remove',
            uploadClass: "file-upload",
        },
        frameClass: "file-sortable",
        layoutTemplates: {
            preview:
                '<div class="file-preview {class}">\n' +
                '    <div class="{dropClass}">\n' +
                '    <div class="clearfix"></div>' +
                '    <div class="file-preview-status text-center text-success"></div>\n' +
                '    <div class="kv-fileinput-error"></div>\n' +
                "    </div>\n" +
                "</div>" +
                ' <div class="file-preview-thumbnails">\n' +
                " </div>\n",
            actionDrag: '<button class="file-drag-handle {dragClass}" title="{dragTitle}">{dragIcon}</button>',
            footer: '<div class="file-thumbnail-footer">\n' + '<div class="file-detail">' + '<div class="file-caption-name">{caption}</div>\n' + '    <div class="file-size">{size}</div>\n' + "</div>" + "   {actions}\n" + "</div>",
        },
    });

    // if ($('#persetujuan').is(':checked')) {
    //     $('#dbtn_new').attr('disabled', false);
    // }else{
    //     $('#dbtn_new').attr('disabled', true);
    // }
</script>
<?php
if (session()->get('level_id') != 1) { ?>
    <!-- <script>
                table.buttons('#btn_import').nodes().css("display", "none");
                table.buttons('#btn_delete').nodes().css("display", "none");
            </script> -->
<?php } ?>
<?= $this->endSection() ?>