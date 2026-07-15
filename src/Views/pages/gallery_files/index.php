<?= (CLAYOUT == 'MPA') ? $this->extend('layout/' . config('Vh')->tmp()) : '' ?>
<?= (CLAYOUT == 'MPA') ? $this->section('css') : '' ?>
    <style>
        /**/
    </style>
<?= (CLAYOUT == 'MPA') ? $this->endSection() : '' ?>
<?= (CLAYOUT == 'MPA') ? $this->section('content') : '' ?>
    <?= $this->include(config('Ummu')->Views('pages/' . $module_kode . '/form')) ?>
    <!-- <?//= $this->include(config('Ummu')->Views('pages/' . $module_kode . '/table')) ?> -->
<?= (CLAYOUT == 'MPA') ? $this->endSection() : '' ?>
<?= (CLAYOUT == 'MPA') ? $this->section('script') : '' ?>
    <script>
        $ummu.vars.page_url = $base_url + 'admin/mygallery_files/';
        var table = $('#tbFileList')
        var $table = $('#tbFileList')
        var $remove = $('#remove')
        var selections = []
        // var $crud = ["new","edit","delete"]
        var $localStrgKey = "mygallery_files"
    </script>
    <script src="<?=config('Ummu')->script($module_kode . '/index')?>"></script>
<?= (CLAYOUT == 'MPA') ? $this->endSection() : '' ?>