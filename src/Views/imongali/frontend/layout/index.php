<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Imong Ali | SparkCode</title>

	<!-- App favicon -->
    <link rel="shortcut icon" href="<?=base_url($appType."/favicon.ico")?>">

	<!-- Google Font: Source Sans Pro -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
	<!-- Font Awesome Icons -->
	<link rel="stylesheet" href="<?=base_url($appType."/assets/plugins/fontawesome-free/css/all.min.css")?>">
	<!-- Theme style -->
	<link rel="stylesheet" href="<?=base_url($appType."/assets/dist/css/adminlte.min.css")?>">
</head>
<body class="hold-transition layout-top-nav">
	<div class="wrapper">
		<?= $this->include(config('Ummu')->Views($appType.'/frontend/partials/navbar')) ?>

		<div class="content-wrapper">
			<div class="content pt-4">
				<div class="container">
					<div class="row">
				        <div class="col-lg-3 col-md-4">
				            <?= $this->include(config('Ummu')->Views($appType.'/frontend/widgets/profile')) ?>
				            <?= $this->include(config('Ummu')->Views($appType.'/frontend/widgets/about')) ?>
				        </div>
				        <div class="col-lg-9 col-md-8">
							<?= $this->renderSection('content') ?>
				        </div>
				    </div>
				</div>
			</div>
		</div>

		<aside class="control-sidebar control-sidebar-dark">
			<!-- Control sidebar content goes here -->
		</aside>

		<footer class="main-footer">
			<!-- <div class="float-right d-none d-sm-inline">
				Anything you want
			</div> -->
			<strong>Copyright &copy; 2023 <a href="<?=base_url()?>">ImongALI</a>.</strong> All rights reserved.
		</footer>
	</div>

	<!-- REQUIRED SCRIPTS -->
	<!-- jQuery -->
	<script src="<?=base_url($appType."/assets/plugins/jquery/jquery.min.js")?>"></script>
	<!-- Bootstrap 4 -->
	<script src="<?=base_url($appType."/assets/plugins/bootstrap/js/bootstrap.bundle.min.js")?>"></script>
	<!-- AdminLTE App -->
	<script src="<?=base_url($appType."/assets/dist/js/adminlte.min.js")?>"></script>
	<!-- AdminLTE for demo purposes -->
	<!-- <script src="<?//=base_url()?>assets/dist/js/demo.js"></script> -->
	<?= $this->renderSection('javascript') ?>
</body>
</html>
