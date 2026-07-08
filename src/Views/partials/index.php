<?= (CLAYOUT == 'MPA') ? $this->extend('layout/' . config('Vh')->tmp()) : '' ?>

<?= (CLAYOUT == 'MPA') ? $this->section('css') : '' ?>
    <?= $this->include(config('Ummu')->Views('plugins/dt_style_001')) ?>

    <?php
        if (is_file(ROOTPATH . 'vendor/dorbitt/lib/src/Views/' . $dir_views . 'style.php')) {
            echo $this->include(config('Vh')->ummuView($dir_views . 'style'));
        }
    ?>
<?= (CLAYOUT == 'MPA') ? $this->endSection() : '' ?>

<?= (CLAYOUT == 'MPA') ? $this->section('content') : '' ?>
    <?= $this->include(config('Ummu')->Views('partials/page_content')) ?>

    <?php
        if (is_file(ROOTPATH . 'vendor/dorbitt/lib/src/Views/' . $dir_views . 'content.php')) {
            echo $this->include(config('Vh')->ummuView($dir_views . 'content'));
        }
    ?>
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

    <?php
        if (is_file(ROOTPATH . 'vendor/dorbitt/lib/src/Views/' . $dir_views . 'script.php')) {
            echo $this->include(config('Vh')->ummuView($dir_views . 'script'));
        }
    ?>

    <script src="<?=config('Ummu')->script($module_kode . '/index')?>"></script>
<?= (CLAYOUT == 'MPA') ? $this->endSection() : '' ?>