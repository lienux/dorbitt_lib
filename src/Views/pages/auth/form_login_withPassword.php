<?php 
    use Dorbitt\Helpers\EncrypterHelper;
    use Dorbitt\Helpers\ViewsHelper;

    $vH = new ViewsHelper();
    $encrypter = new EncrypterHelper();
    $session = session();
    $phone_number_encrypt = $_GET['n'];
    $phone_number = $encrypter->decrypt($phone_number_encrypt);
?>
<?= $this->extend($vH->ummuView('layout/auth')) ?>

<?= $this->section('content') ?>
<div class="pt-4 pb-2">
    <h5 class="card-title text-center pb-0 fs-4"><?=$vH->appName() ?></h5>
    <p class="text-center small">Enter your password to login</p>
</div>

<div id="alert"></div>

<div class="" id="page_login_with_phone_number">
    <div class="row g-3 needs-validation" id="form_login_password">
        <div class="form-group label">
            <label for="phone_number" class="form-label mb-0">Phone number</label>
            <input type="tel" name="phone_number" class="form-control disabled" id="phone_number" value="<?=$phone_number?>" required disabled readonly>
        </div>

        <div class="form-group label" id="div_input_password">
            <label for="password" class="form-label mb-0">Password</label>
            <input type="password" name="password" id="password" class="form-control" autocomplete="new-password">
        </div>

        <div class="form-group" id="div_btn_login">
            <button class="btn btn-purple btn-user btn-block w-100" id="btn_login_password">
                <i class="fa-solid fa-unlock"></i> Login
                <span class="spinner-border spinner-border-sm collapse" role="status" aria-hidden="true"
                    id="loader_login"></span>
            </button>
        </div>
    </div>

    <div class="row needs-validation" id="form_get_otp">
        <div class="with-line my-3">Login with OTP</div>
        <div class="mb-2">
            <button class="btn btn-outline-primary btn-block w-100 text-left text-start btn-next btn-get-otp" id="btn_get_otp_email">
                <img src="<?= base_url("gmail_icon.png") ?>" alt="" style="width: 30px;">
                <span class="pl-2">Send OTP to Email</span>
                <span class="spinner-border spinner-border-sm collapse loader-btn-next" role="status"
                    aria-hidden="true" id="loader_get_otp_email"></span>
            </button>
            <div class="text-danger font-italic collapse" id="text_get_otp_email" style="font-size:10px;">
            </div>
        </div>

        <div class="mb-2">
            <button class="btn btn-outline-primary btn-block w-100 text-left text-start btn-next btn-get-otp" id="btn_get_otp_wa">
                <img src="<?= base_url("whatsapp_icon.png") ?>" alt="" style="width: 30px;">
                <span class="pl-2">Send OTP to Whatsapp</span>
                <span class="spinner-border spinner-border-sm collapse loader-btn-next" role="status"
                    aria-hidden="true" id="loader_get_otp_wa"></span>
            </button>
            <div class="text-danger font-italic collapse" id="text_get_otp_wa" style="font-size:10px;">
            </div>
        </div>

        <div class="mb-2">
            <button class="btn btn-outline-primary btn-block w-100 text-left text-start btn-next btn-get-otp" id="btn_get_otp_sms">
                <img src="<?= base_url("sms_icon.png") ?>" alt="" style="width: 30px;">
                <span class="pl-2">Send OTP to SMS</span>
                <span class="spinner-border spinner-border-sm collapse loader-btn-next" role="status"
                    aria-hidden="true" id="loader_get_otp_sms"></span>
            </button>
            <div class="text-danger font-italic collapse" id="text_get_otp_sms" style="font-size:10px;"> SMS is
                temporarily unusable
            </div>
        </div>
    </div>

    
    <div class="text-left" id="div_btn_back">
        <hr>
        <a class="small" href="<?=base_url('auth/phone_number')?>">
            <i class="fa-solid fa-angles-left"></i>
            Back
        </a>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('javascript') ?>
<script>
    var conf_get_otp_wa = "<?= getenv("conf_get_otp_wa") ?>";
    var conf_get_otp_wa_text = "<?= getenv("conf_get_otp_wa_text") ?>";
    $("#password").focus();
</script>
<?= $this->endSection() ?>