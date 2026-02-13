<?= $this->extend('layout/' . config('Vh')->tmp()) ?>

<?= $this->section('css') ?>
    <?= $this->include(config('Ummu')->Views('plugins/dt_style_001')) ?>
    <style></style>
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
        $ummu.vars.page_url = $base_url + 'admin/project_site/';
        var table = $('#tbProjectSite')
        var $table = $('#tbProjectSite')
        var $remove = $('#remove')
        var selections = []
        var $crud = ["new","edit","delete"]
    </script>
    <script src="<?=config('Ummu')->script($module_kode . '/index')?>"></script>
<?= $this->endSection() ?>