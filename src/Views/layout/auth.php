<?php

    use Dorbitt\Helpers\GviewsHelper;
    use Dorbitt\Helpers\ViewsHelper;

    $gvH = new GviewsHelper();
    $vH = new ViewsHelper();
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title><?=$vH->appTitle()?></title>

    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="<?=$vH->appIco() ?>" rel="icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="<?=base_url();?>/templates/NiceAdmin/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?=base_url();?>/templates/NiceAdmin/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="<?=base_url();?>/templates/NiceAdmin/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="<?=base_url();?>/templates/NiceAdmin/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="<?=base_url();?>/templates/NiceAdmin/assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="<?=base_url();?>/templates/NiceAdmin/assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="<?=base_url();?>/templates/NiceAdmin/assets/vendor/simple-datatables/style.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="<?=base_url();?>/templates/NiceAdmin/assets/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="<?=base_url()?>vendor/fontawesome-6.5.1/all.css">
    <link rel="stylesheet" href="<?= $gvH->ummucssInclude() ?>">

    <style>
        body {
            background-image: url(<?=$vH->bgAuthImg() ?>); 
        }
    </style>

    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>

    <!-- =======================================================
    * Template Name: NiceAdmin - v2.1.0
    * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
    * Author: BootstrapMade.com
    * License: https://bootstrapmade.com/license/
    ======================================================== -->
</head>
<body class="ummu-auth" id="ummu_auth">
    <main>
       <div class="container">

           <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
               <div class="container">
                   <div class="row justify-content-center">
                       <div class="col-xl-4 col-lg-6 col-md-8 d-flex flex-column align-items-center justify-content-center">

                           <div class="d-flex justify-content-center py-2">
                                <!-- <h5 class="d-none d-lg-block">D'ORBITT SYSTEM</h5> -->
                                <img src="<?=$vH->appLogo() ?>" width="<?=(getenv('app.logo_size') ? getenv('app.logo_size') : "75px") ?>">
                           </div><!-- End Logo -->

                           <div class="card mb-3">
                               <div class="card-body">
                                    <?= $this->renderSection('content') ?>
                                    <div class="footer-text">
                                        &copy; 2026 <span></span>
                                    </div>
                               </div>

                           </div>

                           <div class="credits">
                               <!-- All the links in the footer should remain intact. -->
                               <!-- You can delete the links only if you purchased the pro version. -->
                               <!-- Licensing information: https://bootstrapmade.com/license/ -->
                               <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
                               <!-- <a href="<?=base_url()?>"><?=$vH->appCredit() ?></a> -->
                               <?=$vH->appCredit() ?>
                           </div>
                       </div>
                   </div>
               </div>
           </section>

       </div>
    </main><!-- End #main -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
    
    <!-- Vendor JS Files -->
    <script src="<?=base_url();?>/templates/NiceAdmin/assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
    <script src="<?=base_url();?>/templates/NiceAdmin/assets/vendor/php-email-form/validate.js"></script>
    <script src="<?=base_url();?>/templates/NiceAdmin/assets/vendor/quill/quill.min.js"></script>
    <script src="<?=base_url();?>/templates/NiceAdmin/assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="<?=base_url();?>/templates/NiceAdmin/assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="<?=base_url();?>/templates/NiceAdmin/assets/vendor/chart.js/chart.min.js"></script>
    <script src="<?=base_url();?>/templates/NiceAdmin/assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="<?=base_url();?>/templates/NiceAdmin/assets/vendor/echarts/echarts.min.js"></script>
    <script src="<?=base_url();?>/templates/NiceAdmin/assets/js/main.js"></script>
    <script src="<?= $gvH->ummujsInclude() ?>"></script>

    <?= $this->renderSection('javascript') ?>
</body>
</html>