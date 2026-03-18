<?= $this->extend('layout/' . config('Vh')->tmp()) ?>

<?= $this->section('css') ?>
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
    <?= $this->include(config('Ummu')->Views('pages/' . $module_kode . '/form')) ?>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
    <script>
        // 
    </script>
    <script src="<?=config('Ummu')->script($module_kode . '/index')?>"></script>
<?= $this->endSection() ?>