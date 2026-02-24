<?= $this->extend('layout/' . config('Vh')->tmp()) ?>

<?= $this->section('css') ?>
<?= $this->include('plugins/datatables/style') ?>
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

    .popover {
        z-index: 9999;
    }

    .datepicker {
        z-index: 19999 !important;
        /* has to be larger than 1050 */
    }

    .ui-datepicker {
        z-index: 1151 !important;
    }

    /* .select2-close-mask {
        z-index: 2099;
    }

    .select2-dropdown {
        z-index: 3051;
    }

    .select2-container {
        z-index: 99999;
    } */
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<?= (isset($include_tab) ? $this->include($include_tab) : "") ?>
<div class="section-body">
    <div class="card mb-3 border-top-0 rounded-0 rounded-bottom">
        <div class="card-body pt-2" id="entry_area" stylez="min-height: 370px;">
            <?= $this->include(config('Ummu')->Views($dir_views . 'table')) ?>
        </div>
    </div>
</div>
<?= $this->include(config('Ummu')->Views($dir_views . 'modal')) ?>
<?= $this->include('partials/modal') ?>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
    var datenow = "<?= date('Y-m-d') ?>";
    var table_id = '#dt_hazard_report';
    $ummu.vars.page_url = $base_url + 'admin/she_hazard_report/';
</script>
<?= $this->include('plugins/datatables/script') ?>
<script src="<?=config('Ummu')->script($module_kode . '/index')?>"></script>
<script>
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
            preview: '<div class="file-preview {class}">\n' +
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
</script>
<?= $this->endSection() ?>