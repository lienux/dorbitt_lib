<?php 
    use Dorbitt\Helpers\EncrypterHelper;
    use Dorbitt\Helpers\ViewsHelper;

    $encrypter = new EncrypterHelper();
    $vH = new ViewsHelper();
?>

<?= $this->extend($vH->ummuView('layout/auth')) ?>

<?= $this->section('content') ?>
    <div class="pt-4 pb-2">
        <h5 class="card-title text-center pb-0 fs-4">Welcome to AdminERP</h5>
        <p class="text-center small">Enter your username & password to login</p>
    </div>

    <?php if(session()->getFlashdata('msg')):?>
        <div class="alert alert-danger"><?= session()->getFlashdata('msg') ?></div>
    <?php endif;?>

    <form class="row g-3 needs-validation" action="<?=base_url('login/username_check')?>" method="post" novalidate>
        <div class="col-12">
            <label for="Username" class="form-label">Username</label>
            <div class="input-group has-validation">
                <span class="input-group-text" id="inputGroupPrepend">@</span>
                <input type="text" name="username" class="form-control" id="username" required>
                <div class="invalid-feedback">Please enter your username.</div>
            </div>
        </div>

        <div class="col-12" id="div_check_remember_me">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="remember" value="true" id="rememberMe">
                <label class="form-check-label" for="rememberMe">Remember me</label>
            </div>
        </div>

        <div class="col-12">
            <button class="btn btn-purple w-100" type="submit">Next Step <i class="bi bi-chevron-right"></i></button>
        </div>
        
        <div class="col-12">
            <p class="small mb-0">Don't have account? <a href="<?=base_url('register')?>">Create an account</a></p>
        </div>
    </form>    
<?= $this->endSection() ?>

<?= $this->section('javascript') ?>
    <script>
        $("#username").focus();
    </script>
    <!-- <script src="<?//=base_url();?>js/pages/auth/login.js"></script> -->
<?= $this->endSection() ?>