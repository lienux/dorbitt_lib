<?= $this->extend('layout/' . config('Vh')->tmp()) ?>

<?= $this->section('css') ?>
    <?= $this->include(config('Ummu')->Views('plugins/dt_style_001')) ?>
    <style></style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
    <?= $this->include(config('Ummu')->Views('partials/page_content')) ?>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
    <script>
        var $localStrgKey = $ummu.vars.module_kode;
        var $crud = ["new","edit","delete"]
    </script>
    <script src="<?=config('Ummu')->script($module_kode . '/index')?>"></script>
<?= $this->endSection() ?>