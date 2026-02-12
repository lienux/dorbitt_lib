<?= $this->extend('layout/' . config('Vh')->tmp()) ?>

<?= $this->section('css') ?>
    <style>
        .table td {
            /* padding: 0rem; */
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

        table.dataTable>thead>tr>th {
            padding: 2px 6px;
        }

        table.dataTable>tbody>tr>td {
            padding: 2px 6px;
        }
    </style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
    <nav class="ummu-nav">
        <div class="nav nav-tabs" id="nav_tab_dailyprodmonitor">
            <button class="nav-link mr-1 active" id="nav-tab-form" data-toggle="tab" data-target="#nav-form" type="button"
                role="tab" aria-selected="true">
                <span class="d-none d-sm-block"><i class="far fa-clipboard-list"></i> Form</span>
                <span class="d-block d-sm-none"><i class="far fa-clipboard-list"></i></span>
            </button>
            <button class="nav-link mr-1" id="nav-tab-listData" data-toggle="tab" data-target="#nav-listData" type="button" role="tab"
                aria-selected="false">
                <span class="d-none d-sm-block"><i class="far fa-list-alt"></i> List Data</span>
                <span class="d-block d-sm-none"><i class="far fa-list-alt"></i></span>
            </button>
        </div>
    </nav>
    <div class="section-body">
        <div class="card mb-3 border-top-0 rounded-0 rounded-bottom">
            <div class="card-body pt-2" id="entry_area" stylez="min-height: 370px;">
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="nav-form" role="tabpanel">
                        <?= $this->include(config('Vh')->ummuView($dir_views . 'form')) ?>
                    </div>
                    <div class="tab-pane fade" id="nav-listData" role="tabpanel">
                        <?= $this->include(config('Vh')->ummuView($dir_views . 'table')) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?= $this->include('partials/modal') ?>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
    <script>
        $ummu.vars.page_url = $base_url + 'admin/ms_activity/';
        var table = $('#tbMsActivity')
        var $table = $('#tbMsActivity')
        var $remove = $('#remove')
        var selections = []
        var $crud = ["new","edit","delete"]
    </script>
    <script src="<?=base_url('js/admin/pages/ms_activity/index.js?time='.date('YmdHis'));?>"></script>
<?= $this->endSection() ?>