<?php
use Dorbitt\Helpers\GviewsHelper;
use Dorbitt\Helpers\ViewsHelper;

$gView = new GviewsHelper();
$vH = new ViewsHelper();
?>

<?= $this->extend('layout/' . (isset($tmp) ? $tmp : 'admin')) ?>

<?= $this->section('css') ?>
<?= $this->include('plugins/datatables/style') ?>
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
<?= $this->include($gView->include_rangeDate_site()) ?>
<nav class="ummu-nav">
    <div class="nav nav-tabs" id="nav_tab_dailyprodmonitor" role="tablist_stc">
        <button class="nav-link mr-1 active" id="nav-tab-all" data-toggle="tab" data-target="#nav-all" type="button"
            role="tab" aria-controls="nav-all" aria-selected="true">
            <span class="d-none d-sm-block"><i class="far fa-clipboard-list"></i> Form</span>
            <span class="d-block d-sm-none"><i class="far fa-clipboard-list"></i></span>
        </button>
        <button class="nav-link mr-1" id="nav-tab-ob" data-toggle="tab" data-target="#nav-ob" type="button" role="tab"
            aria-controls="nav-ob" aria-selected="false">
            <span class="d-none d-sm-block"><i class="far fa-list-alt"></i> List Data</span>
            <span class="d-block d-sm-none"><i class="far fa-list-alt"></i></span>
        </button>
        <!-- <button class="nav-link mr-1" id="nav-tab-coalhauling" data-toggle="tab" data-target="#nav-coalhauling"
            type="button" role="tab" aria-controls="nav-coalhauling" aria-selected="false">
            <span class="d-none d-sm-block"><i class="fas fa-truck-monster text-danger"></i> Coal Hauling</span>
            <span class="d-block d-sm-none"><i class="fas fa-truck-monster text-danger"></i></span>
        </button>
        <button class="nav-link mr-1" id="nav-tab-coalgetting" data-toggle="tab" data-target="#nav-coalgetting"
            type="button" role="tab" aria-controls="nav-night" aria-selected="false">
            <span class="d-none d-sm-block"><i class="fas fa-digging text-warning"></i> Coal Getting</span>
            <span class="d-block d-sm-none"><i class="fas fa-digging text-warning"></i></span>
        </button> -->
    </div>
</nav>
<div class="section-body">
    <div class="card mb-3 border-top-0 rounded-0 rounded-bottom">
        <div class="card-body pt-2" id="entry_area" stylez="min-height: 370px;">
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="nav-all" role="tabpanel">
                    Daily Production Monitoring <span class="badge badge-warning mb-1">(All Activity)</span>
                    <?= $this->include($vH->ummuView($dir_views . 'form')) ?>
                </div>
                <div class="tab-pane fade" id="nav-ob" role="tabpanel">
                    Daily Production Monitoring <span class="badge badge-warning mb-1">(OB)</span>
                    <?= $this->include($vH->ummuView($dir_views . 'table')) ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->include('partials/modal') ?>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
    var datenow = "<?= date('Y-m-d') ?>";
    var table1 = "#tbDailyProdMonitAll";

    var table2 = "#tbDailyProdPerLoc";
    var table3 = "#tbDailyProdPerTgl";

    var table4 = "#tbDailyProdCoalhaulingPerLoc";
    var table5 = "#tbDailyProdCoalhaulingPerUnit";

    var table6 = "#tbDailyProdCoalgettingPerLoc";
    var table7 = "#tbDailyProdCoalgettingPerTgl";

    $ummu.vars.page_url = $base_url + 'spark/syshab/mcp_report/daily_monitoring/production_result/';
</script>
<?= $this->include('plugins/datatables/script') ?>
<script
    src="<?= base_url('js/admin/pages/mcp_report/production/daily_monitoring/production_result.js?time=' . date('YmdHis')) ?>"></script>
<script>
    // 
</script>
<?= $this->endSection() ?>