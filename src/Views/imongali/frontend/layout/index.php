<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>IMONG ALI</title>

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

		<!-- Navbar -->
		<?= $this->include(config('Ummu')->Views($appType.'/frontend/partials/navbar')) ?>
		<!-- /.navbar -->

		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<!-- Content Header (Page header) -->
			<div class="content-header">
				<div class="container">
					<div class="row mb-2">
						<div class="col-sm-6">
							<h1 class="m-0"> <?=(isset($page_title) ? $page_title : '')?> <small></small></h1>
						</div><!-- /.col -->
						<div class="col-sm-6">
							<ol class="breadcrumb float-sm-right">
								<li class="breadcrumb-item"><a href="#">Home</a></li>
								<li class="breadcrumb-item"><a href="#">Profile</a></li>
								<!-- <li class="breadcrumb-item active">Top Navigation</li> -->
							</ol>
						</div><!-- /.col -->
					</div><!-- /.row -->
				</div><!-- /.container-fluid -->
			</div>
			<!-- /.content-header -->

			<!-- Main content -->
			<div class="content">
				<div class="container">
					<?= $this->renderSection('content') ?>
				</div><!-- /.container-fluid -->
			</div>
			<!-- /.content -->
		</div>
		<!-- /.content-wrapper -->

		<!-- Control Sidebar -->
		<aside class="control-sidebar control-sidebar-dark">
			<!-- Control sidebar content goes here -->
		</aside>
		<!-- /.control-sidebar -->

		<!-- Main Footer -->
		<footer class="main-footer">
			<!-- To the right -->
			<div class="float-right d-none d-sm-inline">
				Anything you want
			</div>
			<!-- Default to the left -->
			<strong>Copyright &copy; 2023 <a href="https://imongali.com">ImongALI</a>.</strong> All rights reserved.
		</footer>
	</div>
	<!-- ./wrapper -->

	<!-- REQUIRED SCRIPTS -->

	<!-- jQuery -->
	<script src="<?=base_url($appType."/assets/plugins/jquery/jquery.min.js")?>"></script>
	<!-- Bootstrap 4 -->
	<script src="<?=base_url($appType."/assets/plugins/bootstrap/js/bootstrap.bundle.min.js")?>"></script>
	<!-- AdminLTE App -->
	<script src="<?=base_url($appType."/assets/dist/js/adminlte.min.js")?>"></script>
	<!-- AdminLTE for demo purposes -->
	<!-- <script src="<?=base_url()?>assets/dist/js/demo.js"></script> -->
	<?= $this->renderSection('javascript') ?>
</body>
</html>
