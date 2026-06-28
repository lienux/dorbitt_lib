<?= $this->extend('frontend/layout/index') ?>

<?= $this->section('content') ?>
    <div class="row">
        <div class="col-md-3">
            <!-- Profile Image -->
            <?= $this->include(config('Ummu')->Views($appType.'/frontend/widgets/profile')) ?>
            <!-- /.card -->

            <!-- About Me Box -->
            <?= $this->include(config('Ummu')->Views($appType.'/frontend/widgets/about')) ?>
            <!-- /.card -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
            <?= $this->include(config('Ummu')->Views($appType.'/frontend/pages/gallery/gallery')) ?>
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
    <!-- Ekko Lightbox -->
    <script src="<?=base_url('imongali/assets/plugins/ekko-lightbox/ekko-lightbox.min.js')?>"></script>
    <!-- Filterizr-->
    <script src="<?=base_url('imongali/assets/plugins/filterizr/jquery.filterizr.min.js')?>"></script>
    <!-- Page specific script -->
    <script>
        $(function () {
            $(document).on('click', '[data-toggle="lightbox"]', function(event) {
                event.preventDefault();
                $(this).ekkoLightbox({
                    alwaysShowClose: true
                });
            });

            $('.filter-container').filterizr({gutterPixels: 3});
            $('.btn[data-filter]').on('click', function() {
                $('.btn[data-filter]').removeClass('active');
                $(this).addClass('active');
            });
        })
    </script>
<?= $this->endSection() ?>