<?php 
    use Dorbitt\Helpers\EncrypterHelper;
    use Dorbitt\Helpers\ViewsHelper;

    $encrypter = new EncrypterHelper();
    $vH = new ViewsHelper();
?>

<?= $this->extend($vH->ummuView('layout/auth')) ?>

<?= $this->section('content') ?>
    <div class="pt-4 pb-2">
        <h5 class="card-title text-center pb-0 fs-4"><?=$vH->appName() ?></h5>
        <p class="text-center small">Enter your phone number to login</p>
    </div>

    <div id="alert"></div>

    <div class="" id="page_login_with_phone_number">
        <div class="row g-3 needs-validation" id="form_cek_phone">
            <div class="form-group label">
                <label for="phone_number" class="form-label mb-0">Phone number</label>
                <input type="tel" name="phone_number" class="form-control" id="phone_number" placeholder="e.g. 085853383750" required>
            </div>

            <div class="col-12" id="div_check_remember_me">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" value="true" id="rememberMe">
                    <label class="form-check-label" for="rememberMe">Remember me</label>
                </div>
            </div>

            <div class="col-12" id="div_btn_next_step">
                <button class="btn btn-purple w-100" type="button" id="btn_next_step">
                    Next step <i class="bi bi-chevron-right"></i>
                    <span class="spinner-border spinner-border-sm collapse loader-btn-next" role="status" aria-hidden="true"
                        id="loader_next_step"></span>
                </button>
            </div>

            <div class="col-12 mb-2" id="link_register">
                <p class="small mb-0">Don't have account? <a href="<?=base_url('auth/register');?>">Create an account</a></p>
            </div>
        </div>
        
        <div class="text-left collapse" id="div_btn_back">
            <hr>
            <a class="small" href="#">
                <i class="fa-solid fa-angles-left"></i>
                Back
            </a>
        </div>
    </div>
<?= $this->endSection() ?>

<?= $this->section('javascript') ?>
    <script>
        $("#phone_number").focus();
    </script>
<?= $this->endSection() ?>