<?= $this->extend(config('Ummu')->Views($appType.'/frontend/layout/index')) ?>

<?= $this->section('content') ?>
    <!--  -->
<?= $this->endSection() ?>

<?= $this->section('javascript') ?>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/10.0.3/highlight.min.js"></script> -->
    <!-- <script type="module" src="<?=base_url();?>/app/Controllers/MahasiswaController.js"></script> -->
    <!-- <script type="module" src="<?=base_url();?>js/pages/dashboard/index.js"></script> -->
<?= $this->endSection() ?>