<?php
	if (isset($banner_path)) {
		$banner_path = base_url($banner_path);
	} else {
		$banner_path = "";
	}
	$msg = session()->getFlashdata('msg');

	if (strtotime($expired) < strtotime(date('Y-m-d H:i:s'))) {
		$is_expired = true;
	}else{
		$is_expired = false;
	}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1.0" name="viewport">

	<title>Hillcon Formulir</title>
	<meta content="" name="description">
	<meta content="" name="keywords">

	<!-- Favicons -->
	<link href="<?= base_url('hillcon_favicon.ico') ?>" rel="icon">
	<link href="<?= base_url('hillcon_favicon.ico') ?>" rel="apple-touch-icon">

	<!-- Google Fonts -->
	<link href="https://fonts.gstatic.com" rel="preconnect">
	<link
		href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
		rel="stylesheet">

	<script src="https://www.google.com/recaptcha/api.js" async defer></script>

	<!-- Vendor CSS Files -->
	<link href="<?= base_url() ?>vendor/NiceAdmin/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?= base_url() ?>vendor/NiceAdmin/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
	<link href="<?= base_url() ?>vendor/NiceAdmin/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
	<link href="<?= base_url() ?>vendor/NiceAdmin/assets/vendor/quill/quill.snow.css" rel="stylesheet">
	<link href="<?= base_url() ?>vendor/NiceAdmin/assets/vendor/quill/quill.bubble.css" rel="stylesheet">
	<link href="<?= base_url() ?>vendor/NiceAdmin/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
	<link href="<?= base_url() ?>vendor/NiceAdmin/assets/vendor/simple-datatables/style.css" rel="stylesheet">

	<!-- Template Main CSS File -->
	<link href="<?= base_url() ?>vendor/NiceAdmin/assets/css/style.css" rel="stylesheet">

	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">

	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

	<style>
		input[type='radio'] {
			-webkit-appearance: none;
			width: 20px;
			height: 20px;
			border-radius: 50%;
			outline: none;
			border: 3px solid #d2b4de;
		}

		input[type='radio']:before {
			content: '';
			display: block;
			width: 60%;
			height: 60%;
			margin: 20% auto;
			border-radius: 50%;
		}

		/*input[type="radio"]:checked:before {
			background: #8e44ad;
		}*/

		input[type="radio"]:checked {
			border-color: #6c3483;
			background-color: #6c3483;
		}

		.role {
			margin-right: 80px;
			margin-left: 20px;
			font-weight: normal;
		}

		.checkbox label {
			margin-bottom: 20px !important;
		}

		.roles {
			margin-bottom: 40px;
		}

		* {
			margin: 0;
			padding: 0;
		}

		html {
			height: 100%;
		}

		/*Background color*/
		#grad1 {
			background-color: : #9C27B0;
			background-image: linear-gradient(120deg, #FF4081, #81D4FA);
		}

		/*form styles*/
		#msform {
			text-align: center;
			position: relative;
			margin-top: 20px;
		}

		#msform fieldset .form-card {
			background: white;
			border: 0 none;
			border-radius: 0px;
			box-shadow: 0 2px 2px 2px rgba(0, 0, 0, 0.2);
			padding: 20px 40px 30px 40px;
			box-sizing: border-box;
			width: 94%;
			margin: 0 3% 20px 3%;

			/*stacking fieldsets above each other*/
			position: relative;
		}

		#msform fieldset {
			background: white;
			border: 0 none;
			border-radius: 0.5rem;
			box-sizing: border-box;
			width: 100%;
			margin: 0;
			padding-bottom: 20px;

			/*stacking fieldsets above each other*/
			position: relative;
		}

		/*Hide all except first fieldset*/
		#msform fieldset:not(:first-of-type) {
			display: none;
		}

		#msform fieldset .form-card {
			text-align: left;
			color: #9E9E9E;
		}

		#msform input,
		#msform textarea {
			padding: 0px 8px 4px 8px;
			border: none;
			border-bottom: 1px solid #ccc;
			border-radius: 0px;
			margin-bottom: 25px;
			margin-top: 2px;
			width: 100%;
			box-sizing: border-box;
			font-family: montserrat;
			color: #2C3E50;
			font-size: 16px;
			letter-spacing: 1px;
		}

		#msform input:focus,
		#msform textarea:focus {
			-moz-box-shadow: none !important;
			-webkit-box-shadow: none !important;
			box-shadow: none !important;
			border: none;
			font-weight: bold;
			border-bottom: 2px solid skyblue;
			outline-width: 0;
		}

		/*Blue Buttons*/
		#msform .action-button {
			width: 100px;
			background: skyblue;
			font-weight: bold;
			color: white;
			border: 0 none;
			border-radius: 0px;
			cursor: pointer;
			padding: 10px 5px;
			margin: 10px 5px;
		}

		#msform .action-button:hover,
		#msform .action-button:focus {
			box-shadow: 0 0 0 2px white, 0 0 0 3px skyblue;
		}

		/*Previous Buttons*/
		#msform .action-button-previous {
			width: 100px;
			background: #616161;
			font-weight: bold;
			color: white;
			border: 0 none;
			border-radius: 0px;
			cursor: pointer;
			padding: 10px 5px;
			margin: 10px 5px;
		}

		#msform .action-button-previous:hover,
		#msform .action-button-previous:focus {
			box-shadow: 0 0 0 2px white, 0 0 0 3px #616161;
		}

		/*Dropdown List Exp Date*/
		select.list-dt {
			border: none;
			outline: 0;
			border-bottom: 1px solid #ccc;
			padding: 2px 5px 3px 5px;
			margin: 2px;
		}

		select.list-dt:focus {
			border-bottom: 2px solid skyblue;
		}

		/*The background card*/
		.card {
			z-index: 0;
			border: none;
			border-radius: 0.5rem;
			position: relative;
		}

		/*FieldSet headings*/
		.fs-title {
			font-size: 25px;
			color: #2C3E50;
			margin-bottom: 10px;
			font-weight: bold;
			text-align: left;
		}

		/*progressbar*/
		#progressbar {
			margin-bottom: 30px;
			overflow: hidden;
			color: lightgrey;
		}

		#progressbar .active {
			color: #000000;
		}

		#progressbar li {
			list-style-type: none;
			font-size: 12px;
			width: 25%;
			float: left;
			position: relative;
		}

		/*Icons in the ProgressBar*/
		#progressbar #account:before {
			font-family: FontAwesome;
			content: "\f023";
		}

		#progressbar #personal:before {
			font-family: FontAwesome;
			content: "\f007";
		}

		#progressbar #payment:before {
			font-family: FontAwesome;
			content: "\f09d";
		}

		#progressbar #confirm:before {
			font-family: FontAwesome;
			content: "\f00c";
		}

		/*ProgressBar before any progress*/
		#progressbar li:before {
			width: 50px;
			height: 50px;
			line-height: 45px;
			display: block;
			font-size: 18px;
			color: #ffffff;
			background: lightgray;
			border-radius: 50%;
			margin: 0 auto 10px auto;
			padding: 2px;
		}

		/*ProgressBar connectors*/
		#progressbar li:after {
			content: '';
			width: 100%;
			height: 2px;
			background: lightgray;
			position: absolute;
			left: 0;
			top: 25px;
			z-index: -1;
		}

		/*Color number of the step and the connector before it*/
		#progressbar li.active:before,
		#progressbar li.active:after {
			background: skyblue;
		}

		/*Imaged Radio Buttons*/
		.radio-group {
			position: relative;
			margin-bottom: 25px;
		}

		.radio {
			display: inline-block;
			width: 204;
			height: 104;
			border-radius: 0;
			background: lightblue;
			box-shadow: 0 2px 2px 2px rgba(0, 0, 0, 0.2);
			box-sizing: border-box;
			cursor: pointer;
			margin: 8px 2px;
		}

		.radio:hover {
			box-shadow: 2px 2px 2px 2px rgba(0, 0, 0, 0.3);
		}

		.radio.selected {
			box-shadow: 1px 1px 2px 2px rgba(0, 0, 0, 0.1);
		}

		/*Fit image in bootstrap div*/
		.fit-image {
			width: 100%;
			object-fit: cover;
		}

		// Sass map from `_variables.scss`
		// Override this and recompile your Sass to generate different states
		$form-validation-states: map-merge(("valid": ("color": $form-feedback-valid-color,
						"icon": $form-feedback-icon-valid ),
					"invalid": ("color": $form-feedback-invalid-color,
						"icon": $form-feedback-icon-invalid )),
				$form-validation-states);

		// Loop from `_forms.scss`
		// Any modifications to the above Sass map will be reflected in your compiled
		// CSS via this loop.
		@each $state, $data in $form-validation-states {
			@include form-validation-state($state, map-get($data, color), map-get($data, icon));
		}
	</style>
</head>

<body>
	<div class="container-fluid" id="grad1">
		<div class="col-xl-6 py-4" style="margin-left: auto; margin-right: auto;">
			<!-- COVER -->
			<div class="card mb-2 rounded border rounded-top collapse">
				<div class="card-body p-0">
					<img src="<?= $banner_url ?>" class="img-fluid" alt="...">
				</div>
			</div>

			<!-- <?//php if (strtotime($expired) < strtotime(date('Y-m-d H:i:s')) { ?> -->
			<?php if ($is_expired == true) { ?>
				<div class="card mb-2 rounded border rounded-top" style="border-top: .50rem solid #6c3483 !important;">
					<div class="card-body">
						<h1 class="card-title">Mohon ma'af form konfirmasi kehadiran telah ditutup.</h1>
					</div>
				</div>
				<?php 
			}else{
				if ($msg) { ?>
					<div class="card mb-2 rounded border rounded-top" style="border-top: .50rem solid #6c3483 !important;">
						<div class="card-body">
							<h1 class="card-title"><?= $msg ?></h1>
						</div>
					</div>
					<?php 
				} else { ?>
					<!-- INFORMATION -->
					<div class="card mb-2 rounded border rounded-top" style="border-top: .50rem solid #6c3483 !important;">
						<div class="card-body">
							<h1 class="card-title">FORM Konfirmasi Kehadiran Rekanan (Supplier) PT Hillconjaya Sakti</h1>
							<div class="">
								Mohon Bapak/Ibu semua berkenan mengisi form kehadiran ini untuk mempermudah jalannya acara.
								<p>
								<p>Batas pengisian form : <strong><?= date("d F Y", strtotime($expired)); ?></strong></p>

								<p>
									<!-- <img src="<?= base_url('assets/img/rYZqPCBaG70.png') ?>" alt="" width="30px">
									Nomor Whatsapp Official :
									<a href="https://web.whatsapp.com/send?phone=+6281389883029" target="_blank">
										081389883029
									</a><br> -->

									<img src="<?= base_url('assets/img/VsNE-OHk_8a.png') ?>" alt="" width="23px" class="m-1">
									Instagram :
									<a href="https://www.instagram.com/hillconindonesia/" target="_blank">@hillconindonesia</a>

									<br>
									<img src="<?= base_url('assets/img/world-wide-web_1927746.png') ?>" alt="" width="23px" class="m-1">
									Website :
									<a href="https://hillcon.co.id/" target="_blank">hillcon.co.id</a>
								</p>

								<p>
									Terimakasih.<br>
									PT. Hillconjaya Sakti<br>
								</p>
							</div>
						</div>
					</div>

					<form class="needs-validation" action="<?= base_url('form_konfirmasi_kehadiran_pertemuan_supplier/create?event_id=2') ?>"
						method="POST" enctype="multipart/form-data" id="form_applicant" novalidate>
						<!-- DATA PERUSAHAAN -->
						<div class="card mb-2">
							<div class="card-body">
								<h5 class="card-title"><i class="bi bi-building-fill-check"></i> DATA PERUSAHAAN <span class="text-danger"> *</span></h5>

								<div class="col-md-12 mb-3">
									<label class="form-label small mb-0">
										<strong>Nama perusahaan anda ?</strong>
									</label>
									<!-- <select class="form-select select2" name="supplier" id="supplier" required>
										<option value="" selected disabled>Choose...</option>
										<option value="1">SINOPACIFIC PERALATAN INDONUSA, PT</option>
									</select>
									<div class="invalid-feedback">
										Please choose your company.
									</div> -->
									<input type="text" class="form-control" name="supplier" id="supplier" required>
									<div class="invalid-feedback">
										Please insert your company name.
									</div>
								</div>
							</div>
						</div>

						<div class="card mb-2">
							<div class="card-body">
								<h5 class="card-title"><i class="bi bi-person-fill-check"></i> DATA PESERTA 1 <span class="text-danger"> *</span></h5>

								<div class="col-md-12 mb-3">
									<label for="nama" class="form-label small mb-0">
										<strong>Nama</strong><span class="text-danger"> *</span>
									</label>
									<input type="text" class="form-control" name="nama" id="nama" required>
									<div class="invalid-feedback">
										Please insert nama peserta.
									</div>
								</div>

								<div class="col-md-12 mb-3">
									<label for="jabatan" class="form-label small mb-0">
										<strong>Jabatan</strong><span class="text-danger"> *</span>
									</label>
									<input type="text" class="form-control" name="jabatan" id="jabatan" required>
									<div class="invalid-feedback">
										Please insert jabatan peserta 1.
									</div>
								</div>
							</div>
						</div>

						<div class="card mb-2">
							<div class="card-body">
								<h5 class="card-title"><i class="bi bi-person-fill-check"></i> DATA PESERTA 2</h5>

								<div class="col-md-12 mb-3">
									<label for="nama" class="form-label small mb-0">
										<strong>Nama</strong>
									</label>
									<input type="text" class="form-control" name="nama2" id="nama2">
									<div class="invalid-feedback">
										Please insert nama peserta 2.
									</div>
								</div>

								<div class="col-md-12 mb-3">
									<label for="jabatan2" class="form-label small mb-0">
										<strong>Jabatan</strong>
									</label>
									<input type="text" class="form-control" name="jabatan2" id="jabatan2">
									<div class="invalid-feedback">
										Please insert jabatan peserta 2.
									</div>
								</div>
							</div>
						</div>
					<?php } ?>

					<div class="card mb-2">
						<div class="card-body">
							<h1 class="card-title">Terimakasih telah mengisi form.</h1>
							<div class="col-md-12 mb-3">
								<label class="">Kami tunggu kehadiran Bapak/Ibu.</label><br>
							</div>
							<?php if (!$msg) { ?>
								<div class="col-md-12 mb-4">
									<strong>Note :</strong>
									<!-- <ol><li>&nbsp;Wajib membawa surat tugas.</li></ol> -->
									<br>Dimohon Peserta yang akan hadir membawa surat tugas dari perusahaan.
								</div>
								<div class="col-md-12 mb-3">
									<label>
										<strong>Silahkan klik SUBMIT di bawah ini untuk menyelesaikan.</strong>
									</label>
								</div>
							<?php } ?>
						</div>
					</div>

					<?php if (!$msg) { ?>
						<input type="submit" class="btn px-4" style="background-color: #6c3483; color: #ffff;"
							value="Submit"></input>
					<?php } ?>
				</form>

				<?php
				if (isset($include)) {
					foreach ($include as $key => $value) {
						echo $this->include($value);
					}
				}
			}
			?>

			<footer class="mt-4 small" style="margin-left: auto; margin-right: auto;">
				&copy; Copyright <strong><span>Hillcon</span></strong>. All Rights Reserved <br>
				Designed by <a href="https://iescm.hillcon.co.id/" target="_blank">IESCM</a>
				<div class="mt-4 text-center" style="font-size: 20px;"><span class="fw-bold"
						style="color:#6c3483;">Hillcon</span> Formulir</div>
			</footer>
		</div>
	</div>


	<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
			class="bi bi-arrow-up-short"></i></a>

	<!-- Vendor JS Files -->
	<script src="<?= base_url() ?>vendor/NiceAdmin/assets/vendor/apexcharts/apexcharts.min.js"></script>
	<script src="<?= base_url() ?>vendor/NiceAdmin/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="<?= base_url() ?>vendor/NiceAdmin/assets/vendor/chart.js/chart.umd.js"></script>
	<script src="<?= base_url() ?>vendor/NiceAdmin/assets/vendor/echarts/echarts.min.js"></script>
	<script src="<?= base_url() ?>vendor/NiceAdmin/assets/vendor/quill/quill.min.js"></script>
	<script src="<?= base_url() ?>vendor/NiceAdmin/assets/vendor/simple-datatables/simple-datatables.js"></script>
	<script src="<?= base_url() ?>vendor/NiceAdmin/assets/vendor/tinymce/tinymce.min.js"></script>
	<script src="<?= base_url() ?>vendor/NiceAdmin/assets/vendor/php-email-form/validate.js"></script>
	<script src="<?= base_url() ?>vendor/jquery/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

	<!-- Template Main JS File -->
	<script src="<?= base_url() ?>vendor/NiceAdmin/assets/js/main.js"></script>
	<script src="<?= config('Ummu')->gViHe('ummujsInclude') ?>"></script>

	<script>
		var $base_url = '<?= base_url() ?>';

		$(document).ready(function () {
			$('.select2').select2();
		});

		// $('#input_perusahaan_lainnya').on('click', function () {
		// 	$('#perusahaan_terakhir_lainnya').prop('checked', true);
		// })

		// $('#input_perusahaan_lainnya2').on('click', function () {
		// 	$('#perusahaan_terakhir_lainnya2').prop('checked', true);
		// })

		// function insert() {
		// 	$('#spinner_kirim').removeClass('collapse');
		// 	$('#btn_kirim').addClass('disabled');
		// 	var lainnya2 = $('#lainnya2').val();
		// 	var body = {
		// 		"body": {
		// 			"event_id": $('#event').val(),
		// 			"contact": $('#contact').val(),
		// 			"name": $('#name').val(),
		// 			"status_kehadiran": $('input:radio[name=status_kehadiran]:checked').val(),
		// 			"status_kehadiran_lainnya": $('#lainnya2').val(),
		// 			"sudah_mengenal": $('input:radio[name=sudah_mengenal]:checked').val()
		// 		}
		// 	};
		// 	// controllers.create(payload);
		// 	// console.log(body);

		// 	var params = {
		// 		"type": "post",
		// 		"action": "insert",
		// 		"data": JSON.stringify(body),
		// 		"cache": true,
		// 		"contentType": "application/json",
		// 		"dataType": "json"
		// 	};

		// 	var url = $base_url + '/event_registration/create'
		// 	var ummu = $globalAjax.ummu(url, params);
		// 	ummu.done(function (result) {
		// 		console.log(result)
		// 		var response = JSON.parse(result);
		// 		if (response.status == true) {
		// 			window.location.href = $base_url + ('/event_registration/success');
		// 			// $('#InsertModal').modal('hide');
		// 			// var crRow = {
		// 			//     "id": response.response,
		// 			//     "kode": $('#kode').val(),
		// 			//     "name": $('#name').val(),
		// 			//     "jumlah_lantai": $('#jumlah_lantai').val(),
		// 			//     "address": $('#address').val(),
		// 			//     "latitude": $('#latitude').val(),
		// 			//     "longitude": $('#longitude').val()
		// 			// }

		// 			// $table.bootstrapTable('insertRow', {
		// 			//     index: 0,
		// 			//     row: crRow
		// 			// })

		// 			// $globFunc.ch_message(response.message);
		// 			// app.Events.clear_form();
		// 		} else {
		// 			// $('#message_title, #text_message').empty();
		// 			// var message = response.message;
		// 			// var errors = response.errors;
		// 			// $('#message_title').html(message);
		// 			// for(let index in errors){
		// 			//     var $error = '<div class="alert alert-danger alert-dismissible fade show" role="alert">'+
		// 			//                     '<i class="bi bi-exclamation-octagon me-1"></i>'+
		// 			//                     errors[index]+
		// 			//                  '</div>';
		// 			//     $('#text_message').append($error);
		// 			// }
		// 			// $('#message_modal').modal('show');
		// 			$('#spinner_kirim').addClass('collapse');
		// 			$('#btn_kirim').removeClass('disabled');
		// 		}
		// 	}).fail(function () {
		// 		// An error occurred
		// 		console.log(ummu)
		// 	});
		// }

		function addClsClps() {
			$('#alert_name').addClass('collapse');
			$('#alert_status_kehadiran').addClass('collapse');
			$('#alert_status_kehadiran').addClass('collapse');
			$('#alert_status_sudah_mengenal').addClass('collapse');
		}

		// $(document).ready(function () {
		// 	// $('#btn_kirim').on('click', function () {
		// 	// 	var name = $('#name').val();

		// 	// 	var status_kehadiran = $('input:radio[name=status_kehadiran]:checked').val();
		// 	// 	var lainnya2 = $('#lainnya2').val();

		// 	// 	var sudah_mengenal = $('input:radio[name=sudah_mengenal]:checked').val();

		// 	// 	if (name == 'undefined' || name == '' || name == null || name == 0) {
		// 	// 		addClsClps();
		// 	// 		$('#alert_name').removeClass('collapse');
		// 	// 	} else if (status_kehadiran == 'undefined' || status_kehadiran == '' || status_kehadiran == null) {
		// 	// 		addClsClps();
		// 	// 		$('#alert_status_kehadiran').removeClass('collapse').html('Status kehadiran wajib dipilih');
		// 	// 	} else if (status_kehadiran == 3 && lainnya2 == '') {
		// 	// 		addClsClps();
		// 	// 		$('#alert_status_kehadiran').removeClass('collapse').html('Lainnya wajib diisi');
		// 	// 	} else if (sudah_mengenal == 'undefined' || sudah_mengenal == '' || sudah_mengenal == null) {
		// 	// 		addClsClps();
		// 	// 		$('#alert_status_sudah_mengenal').removeClass('collapse');
		// 	// 	} else {
		// 	// 		addClsClps();
		// 	// 		insert();
		// 	// 	}
		// 	// })
		// });

		// $(document).ready(function () {

		// 	var current_fs, next_fs, previous_fs; //fieldsets
		// 	var opacity;

		// 	$(".next").click(function () {

		// 		current_fs = $(this).parent();
		// 		next_fs = $(this).parent().next();

		// 		//Add Class Active
		// 		$("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

		// 		//show the next fieldset
		// 		next_fs.show();
		// 		//hide the current fieldset with style
		// 		current_fs.animate({ opacity: 0 }, {
		// 			step: function (now) {
		// 				// for making fielset appear animation
		// 				opacity = 1 - now;

		// 				current_fs.css({
		// 					'display': 'none',
		// 					'position': 'relative'
		// 				});
		// 				next_fs.css({ 'opacity': opacity });
		// 			},
		// 			duration: 600
		// 		});
		// 	});

		// 	$(".previous").click(function () {

		// 		current_fs = $(this).parent();
		// 		previous_fs = $(this).parent().prev();

		// 		//Remove class active
		// 		$("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

		// 		//show the previous fieldset
		// 		previous_fs.show();

		// 		//hide the current fieldset with style
		// 		current_fs.animate({ opacity: 0 }, {
		// 			step: function (now) {
		// 				// for making fielset appear animation
		// 				opacity = 1 - now;

		// 				current_fs.css({
		// 					'display': 'none',
		// 					'position': 'relative'
		// 				});
		// 				previous_fs.css({ 'opacity': opacity });
		// 			},
		// 			duration: 600
		// 		});
		// 	});

		// 	$('.radio-group .radio').click(function () {
		// 		$(this).parent().find('.radio').removeClass('selected');
		// 		$(this).addClass('selected');
		// 	});

		// 	$(".submit").click(function () {
		// 		return false;
		// 	})

		// 	// $ummu.events.form_applicant();

		// });

		// Example starter JavaScript for disabling form submissions if there are invalid fields
		(function () {
			'use strict';
			window.addEventListener('load', function () {
				// Fetch all the forms we want to apply custom Bootstrap validation styles to
				var forms = document.getElementsByClassName('needs-validation');
				// Loop over them and prevent submission
				var validation = Array.prototype.filter.call(forms, function (form) {
					form.addEventListener('submit', function (event) {
						if (form.checkValidity() === false) {
							event.preventDefault();
							event.stopPropagation();
						}
						form.classList.add('was-validated');
					}, false);
				});
			}, false);
		})();
	</script>
</body>

</html>