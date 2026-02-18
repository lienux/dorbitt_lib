<?= $this->extend('layout/' . config('Vh')->tmp()) ?>

<?= $this->section('css') ?>
    <?= $this->include(config('Ummu')->Views('plugins/dt_style_001')) ?>
    <style></style>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
    <?= $this->include(config('Ummu')->Views('partials/page_content')) ?>
    <nav class="ummu-nav">
        <div class="nav nav-tabs">
            <button class="nav-link mr-1 py-0 active" id="nav-tab-waypoint" data-toggle="tab" data-target="#nav-waypoint" type="button" role="tab" aria-selected="true">
                Tank Sounding Data
            </button>
        </div>
    </nav>
    <div class="section-body">
        <div class="card mb-3 border-top-0 rounded-0 rounded-bottom">
            <div class="card-body pt-2">
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="nav-waypoint" role="tabpanel">
                        <?= $this->include(config('Vh')->ummuView($dir_views . 'table_tank_sounding_data')) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
    <script>
        $ummu.vars.page_url = $base_url + 'admin/passage_plan/';
        var table = $('#tbPassagePlan')
        var table2 = $('#tbWaypoint')
        var $table = $('#tbPassagePlan')
        var $remove = $('#remove')
        var selections = []
        var $crud = ["new","edit","delete"]
    </script>
    <script src="<?=config('Ummu')->script($module_kode . '/index')?>"></script>
<?= $this->endSection() ?>