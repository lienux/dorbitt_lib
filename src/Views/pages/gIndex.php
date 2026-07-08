<?= (CLAYOUT == 'MPA') ? $this->extend('layout/' . config('Vh')->tmp()) : '' ?>

<?= (CLAYOUT == 'MPA') ? $this->section('css') : '' ?>
    <?= $this->include(config('Ummu')->Views('plugins/dt_style_001')) ?>
    <style></style>
<?= (CLAYOUT == 'MPA') ? $this->endSection() : '' ?>

<?= (CLAYOUT == 'MPA') ? $this->section('content') : '' ?>
    <?= $this->include(config('Ummu')->Views('partials/page_content')) ?>
<?= (CLAYOUT == 'MPA') ? $this->endSection() : '' ?>

<?= (CLAYOUT == 'MPA') ? $this->section('script') : '' ?>
    <script>
        $ummu.vars.page_url = $base_url + 'admin/<?=$module_kode?>/';
        var $crud = ["new","edit","delete"]
        var $localStrgKey = '<?=$module_kode?>'

        // Membuat variabel global pendukung yang dinamis dari PHP
        const PHP_VARS = {
            moduleKode: '<?= $module_kode ?>'
        };
    </script>
    <script src="<?=config('Ummu')->script($module_kode . '/index')?>"></script>
<?= (CLAYOUT == 'MPA') ? $this->endSection() : '' ?>