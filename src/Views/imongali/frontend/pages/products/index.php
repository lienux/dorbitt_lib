<?= $this->extend('frontend/layout/index') ?>

<?= $this->section('content') ?>

<div class="row">
    <div class="col-md-3">

        <!-- Profile Image -->
        <?= $this->include('frontend/widgets/profile') ?>
        <!-- /.card -->

        <!-- About Me Box -->
        <?= $this->include('frontend/widgets/about') ?>
        <!-- /.card -->
    </div>
    <!-- /.col -->
    <div class="col-md-9">
        <?= $this->include('frontend/pages/products/products') ?>
        <!-- /.card -->
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->

<?= $this->endSection() ?>

<?= $this->section('javascript') ?>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/10.0.3/highlight.min.js"></script> -->
<!-- <script type="module" src="<?=base_url();?>/app/Controllers/MahasiswaController.js"></script> -->
<!-- <script type="module" src="<?=base_url();?>js/pages/dashboard/index.js"></script> -->
<?= $this->endSection() ?>