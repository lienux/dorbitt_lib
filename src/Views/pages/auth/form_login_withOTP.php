<?php 
    use Dorbitt\Helpers\EncrypterHelper;
    $encrypter = new EncrypterHelper();
    $session = session();
    $phone_number_encrypt = $_GET['n'];
    $phone_number = $encrypter->decrypt($phone_number_encrypt);
?>
<?= $this->extend('layout/auth') ?>

<?= $this->section('content') ?>
<div class="pt-4 pb-2">
    <h5 class="card-title text-center pb-0 fs-4"><?=(getenv('app.name')) ? getenv('app.name') : "D'ORBITT SYSTEM" ?></h5>
    <p class="text-center small">Enter your phone number to login</p>
</div>

<div id="alert"></div>

<div class="" id="page_login_with_phone_number">
    <div class="row g-3 needs-validation" id="form_login_otp">
        <div class="form-group label">
            <label for="phone_number" class="form-label mb-0">Phone number</label>
            <input type="tel" name="phone_number" class="form-control disabled" id="phone_number" placeholder="e.g. 085853383750" value="<?=$phone_number?>" required disabled readonly>
        </div>

        <div class="form-group label" id="div_input_otp">
            <label for="otp" class="form-label mb-0">OTP</label>
            <input type="text" name="otp" id="otp" class="form-control">
        </div>

        <div class="form-group" id="div_btn_login">
            <button class="btn btn-purple btn-user btn-block w-100" id="btn_login">
                <i class="fa-solid fa-unlock"></i> Login
                <span class="spinner-border spinner-border-sm collapse" role="status" aria-hidden="true"
                    id="loader_login"></span>
            </button>
        </div>
    </div>

    <div class="text-left" id="div_btn_back">
        <hr>
        <a class="small" href="<?=base_url('auth/phone_number/login_password?n=' . $phone_number_encrypt)?>">
            <i class="fa-solid fa-angles-left"></i>
            Back
        </a>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('javascript') ?>
<script>
    // 
</script>
<?= $this->endSection() ?>