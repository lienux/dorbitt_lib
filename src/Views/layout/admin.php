<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?=(getenv('app.name')) ? getenv('app.name') : "D'ORBITT SYSTEM" ?></title>
	
	<!-- Favicons -->
	<link href="<?=base_url('assets/img/dorbitt_favicon.ico')?>" rel="icon">
	<link href="<?=base_url('assets/img/dorbitt_favicon.ico')?>" rel="apple-touch-icon">

	<?= $this->include('plugins/nice/style') ?>
	<?= $this->include('plugins/head') ?>
	<?= $this->renderSection('css') ?>

	<link rel="stylesheet" type="text/css"
    href="<?= base_url(); ?>vendor/clockpicker-gh-pages/dist/bootstrap-clockpicker.min.css">
	<style>
		.divider-custom {
			display: block;
			text-align: center;
			overflow: hidden;
			margin: 1rem 0;
		}

		.divider-custom .divider-text {
			position: relative;
			display: inline-block;
			font-size: 12px;
			padding: 2px 6px;
			color: #000444;
			border: 1px dashed #eceff5;
			border-radius: 30px;
			font-family: "Roboto", sans-serif;
		}

		.divider-custom .divider-text:after {
			left: 100%;
		}

		.divider-custom .divider-text:before {
			right: 100%;
		}

		.divider-custom .divider-text:after,
		.divider-custom .divider-text:before {
			content: '';
			position: absolute;
			top: 50%;
			width: 9999px;
			border-top: 1px dashed #eceff5;
		}

		.dropdown-xl {
		  	min-width: 20rem;
		}

		.bg-soft-classic {
			background-color: #f1f5fa !important;
			color: #303e67 !important;
		}

		.text-justify{text-align:justify!important}
	</style>

	<!-- =======================================================
	* Template Name: NiceAdmin - v2.1.0
	* Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
	* Author: BootstrapMade.com
	* License: https://bootstrapmade.com/license/
	======================================================== -->
</head>
<body>
    <?= $this->include('partials/admin/header') ?>
    <?= $this->include('partials/admin/sidebar') ?>
    <main id="main" class="main">
        <div class="pagetitle">
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?=base_url('admin')?>">Admin</a></li>
                    <li class="breadcrumb-item <?=$breadcrumb_active[0]?>"><a href="#"><?=$breadcrumb[0]?></a></li>
                    <?php if ($breadcrumb[1]!=null) { ?>
                    <li class="breadcrumb-item <?=$breadcrumb_active[1]?>"><?=$breadcrumb[1]?></li>
                    <?php } ?>
                </ol>
            </nav>
        </div>
        <?= $this->renderSection('content') ?>
        <?php 
			if (isset($include)) {
				foreach ($include as $key => $value) {
					echo $this->include($value);
				}
			}
		?>
    </main>

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
	    <div class="copyright">
	    	<strong><span><?=session()->get('company_name');?></span></strong>
	    </div>
	    <?php if (getenv('app.copyright')==1) { ?>
	    <div class="credits">
		    Copyright &#169; <a href="https://dorbitt.com/" target="_blank">DORBITT.COM</a>
	    </div>
		<?php } ?>
    </footer><!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center">
    	<i class="bi bi-arrow-up-short"></i>
    </a>

    <?= $this->include('plugins/nice/script') ?>
    <?= $this->renderSection('javascript') ?>
    <?= $this->renderSection('script') ?>

    <script type="text/javascript"
    src="<?= base_url(); ?>vendor/clockpicker-gh-pages/dist/bootstrap-clockpicker.min.js"></script>
    <script>
    	$ummu.vars.module_kode = '<?= (isset($module_kode)) ? $module_kode : ''; ?>';
        $ummu.vars.crud = '<?= (isset($crud)) ? $crud : ''; ?>';
        // $ummu.vars.identity.nikaryawan = '<?= session()->get('nika'); ?>';
        // $ummu.vars.identity.name = '<?= session()->get('name'); ?>';
    </script>
</body>
</html>