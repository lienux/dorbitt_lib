<?php
	if (isset($banner_path)) {
		$banner_path = base_url($banner_path);
	} else {
		$banner_path = "";
	}
	$msg = session()->getFlashdata('msg');
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

			<?php if ($msg) { ?>
				<div class="card mb-2 rounded border rounded-top" style="border-top: .50rem solid #6c3483 !important;">
					<div class="card-body">
						<h1 class="card-title"><?= $msg ?></h1>
					</div>
				</div>
			<?php } else { ?>
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
					<!-- DATA DIRI -->
					<div class="card mb-2">
						<div class="card-body">
							<h5 class="card-title">DATA PESERTA</h5>

							<div class="col-md-12 mb-3">
								<label class="form-label small mb-0">
									<strong>Nama perusahaan anda ?</strong>
								</label>
								<select class="form-select select2" name="supplier" id="supplier" required>
									<option value="" selected disabled>Choose...</option>
									<option value="1">SINOPACIFIC PERALATAN INDONUSA, PT</option>
									<option value="2">BACH MULTI GLOBAL, PT</option>
									<option value="3">MULTITECH PRIMA UTAMA, PT</option>
									<option value="4">SOLIDSTEEL TAMAJAYA INDONESIA, PT</option>
									<option value="5">UNIVERSAL TRAKTOR INDONESIA, PT</option>
									<option value="6">SANGGAR SARANA BAJA, PT</option>
									<option value="7">TRI SWARDANA UTAMA, PT</option>
									<option value="8">DWIPA YUDHA PERDANA, PT</option>
									<option value="9">SUMBER KEMBANG TRANSPORT, CV</option>
									<option value="10">DELILAS CATERING</option>
									<option value="11">BRANJANGAN PUTRA UTAMA, PT</option>
									<option value="12">SAMATOR GAS INDUSTRI, PT</option>
									<option value="13">SEJAHTERA TRIDAYA PRIMA, PT</option>
									<option value="14">FITRI UTAMA, CV</option>
									<option value="15">LOGISTIC ONE SOLUTION, PT</option>
									<option value="16">SINAR BINTANG ALBAR, PT</option>
									<option value="17">BINTANG JAYA STEEL, PT</option>
									<option value="18">SALSABHILA, CV</option>
									<option value="19">QUADRA PACIFIC INDONESIA, PT</option>
									<option value="20">PRODIA WIDYAHUSADA JAKARTA, PT</option>
									<option value="21">INTEGRASI AVIASI SOLUSI, PT</option>
									<option value="22">BUANA BERKAH MANDIRI, CV</option>
									<option value="23">PUTRA MEMBANGUN BERSAMA, CV</option>
									<option value="24">BERKAT JAYA KOMPUTINDO, PT</option>
									<option value="25">INDOPRIMA MANDIRI UTAMA,PT</option>
									<option value="26">ARSHAKA MANDIRI PERKASA, CV</option>
									<option value="27">CAKRA MITRA SENTOSA, PT</option>
									<option value="28">JAYA MANGGALA INDONESIA, CV</option>
									<option value="29">IWAN MOTOR, CV</option>
									<option value="30">SINAGA SUKSES DIESELINDO, CV</option>
									<option value="31">THEKO DIGITAL SOLUSINDO, PT</option>
									<option value="32">CAHAYA, UD (ERLA SAFETY)</option>
									<option value="33">RSUD. PURUK CAHU</option>
									<option value="34">RSUD PANGERAN JAYA SUMITRA KOTABARU</option>
									<option value="35">PORTI MULTI INDONESIA, PT</option>
									<option value="36">BERDIKARI JAYA DIESEL, PT</option>
									<option value="37">TANJUNG BERSAMA LESTARI, CV</option>
									<option value="38">MANDARA SERVIS PRATAMA, PT</option>
									<option value="39">BUANA PENTAPRIMA, PT</option>
									<option value="40">GALA JAYA MANADO, UD</option>
									<option value="41">LANDSO BUMI JAYA, PT</option>
									<option value="42">KHAHAYAN JAYA PERSADA, PT</option>
									<option value="43">GLOBAL INTI SEJATI, PT</option>
									<option value="44">ASTRINUSA JAYA DHARMA, PT</option>
									<option value="45">HYUNDAI OTO KOMERSIAL INDONESIA. PT</option>
									<option value="46">TRISTAN FABIAN UTAMA, CV</option>
									<option value="47">SAMATOR INDO GAS TBK, PT (KENDARI)</option>
									<option value="48">FERINDO ENERGI INSTRUMEN, PT</option>
									<option value="49">JEROLIN INDONESIA TEKNIK, PT</option>
									<option value="50">ENGGAL SUKSES PERKASA,PT</option>
									<option value="51">BIG BENGKEL DIESELTAMA, PT</option>
									<option value="52">LOTTE GLOBAL LOGISTICS, PT</option>
									<option value="53">STAR WAGEN INDONESIA, PT</option>
									<option value="54">JAYA BERKAT USAHA, PT</option>
									<option value="55">RSUD ULIN BANJARMASIN</option>
									<option value="56">BOMM AKSES TEKNOLOGI, PT</option>
									<option value="57">FAHMAN BERKAT ABADI, PT</option>
									<option value="58">SEPAKAT, CV</option>
									<option value="59">TOP JAYA AUTOPART CENTER, CV</option>
									<option value="60">ANEKA MITRA CIPTA, PT</option>
									<option value="61">DYANDRA  ASTAGINA, CV</option>
									<option value="62">SAPTA BUANA LOGISTIC, PT</option>
									<option value="63">DJAJA LISTRIK, PT</option>
									<option value="64">JAYARAMA ARTHA RODA, PT</option>
									<option value="65">TRIJAYA PRIMA, CV</option>
									<option value="66">PHOENIX CAHAYA TECHNIQUE, PT</option>
									<option value="67">TELEKOMUNIKASI SELULAR, PT</option>
									<option value="68">RS.ANANDA BEKASI</option>
									<option value="69">GALAJAYA TIMUR PERKASA, PT</option>
									<option value="70">EDELWEISS, RS</option>
									<option value="71">BEKTI JAYA MANDIRI, CV</option>
									<option value="72">MITRA USAHA FURNITURE, CV</option>
									<option value="73">BU TANTO, WARUNG</option>
									<option value="74">KASANA TEKNINDO GEMILANG, PT</option>
									<option value="75">BINTANG SELATAN, CV</option>
									<option value="76">MERANTI SARANA NIAGA, PT</option>
									<option value="77">HENDRA JAYA MAKMUR, CV</option>
									<option value="78">CHARIS PERKASA AMARTA, PT</option>
									<option value="79">OSEANLAND SURVEI INDONESIA, PT</option>
									<option value="80">DARMANSYAH ( DESA TABULANG )</option>
									<option value="81">AGUNG KENDARI, TOKO</option>
									<option value="82">RUKUN SEJAHTERA TEKNIK, PT</option>
									<option value="83">INDOTEKNIK DOTCOM GEMILANG, PT</option>
									<option value="84">DUA PUTRI LESTARI ENERGI, PT</option>
									<option value="85">ALPHA OMEGA TRANSPORTINDO, PT</option>
									<option value="86">SULTRA ALAM PERKASA, PT</option>
									<option value="87">TRIATRA SINERGIA PRATAMA, PT</option>
									<option value="88">IMAR ( DESA OLONG ULU )</option>
									<option value="89">SUMBER INTI GLOBAL SUKSES, PT</option>
									<option value="90">HERMINA KENDARI, RS UMUM</option>
									<option value="91">PACIFIC FIRSTRACK INDONESIA, PT( IDR )</option>
									<option value="92">KAMANDRI ( DESA OSOM TOMPOK )</option>
									<option value="93">SUKU CADANG OTO SEJAHTERA , PT</option>
									<option value="94">HUDAYA MAJU MANDIRI, PT</option>
									<option value="95">OBED NDAWA WOHANGARA</option>
									<option value="96">MAKMUR PERSADA, CV</option>
									<option value="97">BLUD RS KONAWE UTARA</option>
									<option value="98">ANUGERAH CIPTA KARYA, CV</option>
									<option value="99">ASURANSI CENTRAL ASIA, PT ( MAKASSAR )</option>
									<option value="100">RAFVINDOTAMA JAYA PERSADA, CV</option>
									<option value="101">DINAMIKA JAYA SEMESTA, PT</option>
									<option value="102">MAKMUR PERSADA, CV (CONSIGNMENT)</option>
									<option value="103">SURYA SEALINDO TEKNOLOGI, PT</option>
									<option value="104">TUGU MAS ABADI, PT</option>
									<option value="105">BARAK TRANSPORT, CV</option>
									<option value="106">ANAK BUNGSU, CV</option>
									<option value="107">PROLINTAS TRANSUTAMA LOGISTIK, PT</option>
									<option value="108">KALIMANTAN CIPTA TEKNINDO, PT</option>
									<option value="109">PANRITA MARINA FARMASI, PT</option>
									<option value="110">LIUS PIKAL ( DESA OLUNG BALO )</option>
									<option value="111">SUMBER NUSA SEJAHTERA, PT</option>
									<option value="112">JAKARTA ANUGERAH MANDIRI, PT</option>
									<option value="113">DEWATA SOLUSI TEKNOLOGI, PT</option>
									<option value="114">IMMCO ALISON INDONESIA, PT</option>
									<option value="115">ANTAM MEDIKA, RS</option>
									<option value="116">SENTRAL AC, CV</option>
									<option value="117">ANEKA MAKMUR UTAMA, CV</option>
									<option value="118">MITRA AC MOBIL</option>
									<option value="119">KARYA TIKA BORNEO, CV (TITAN)</option>
									<option value="120">RSUD KOLONODALE, BENDAHARA PENERIMA</option>
									<option value="121">SRIKANDI MAJU MANDIRI, PT</option>
									<option value="122">SRIKANDI DIAMOND MOTORS, PT</option>
									<option value="123">KARYA MANUNTUNG,CV</option>
									<option value="124">NURRAHMAN PETIRO KARYA ABADI, PT</option>
									<option value="125">APOTEK SAUDARA BEKASI</option>
									<option value="126">JAGAT TEKNIK DIGDAYA, PT</option>
									<option value="127">SOLID UNIVERSAL INDONESIA, PT</option>
									<option value="128">TRACTOR PART INDONESIA,CV</option>
									<option value="129">ANDALAN BARU SOLUSITAMA, PT</option>
									<option value="130">TITIAN JAYA BOGA, PT</option>
									<option value="131">ABE MANDIRI, PT ( MUARA TEWEH )</option>
									<option value="132">KEMKOMINFO (KOMDIGI)</option>
									<option value="133">EVOTEK GLOBAL PRIMA, PT</option>
									<option value="134">MAXINDO MITRA SOLUSI</option>
									<option value="135">KOKANO SUKSES SEJAHTERA, PT</option>
									<option value="136">SOLUSI MONITORING INDONESIA, PT</option>
									<option value="137">INDOCORE PERKASA, PT</option>
									<option value="138">SAMATOR INDO GAS TBK, PT (MOROWALI)</option>
									<option value="139">RSUD BATARA GURU</option>
									<option value="140">HOKKY INTI MEDIKA, PT</option>
									<option value="141">VIDISTAR INDOQUIP PRADANA, PT</option>
									<option value="142">GLOBAL ANDALAN SOLUSI SUKSES,  PT </option>
									<option value="143">CARTO ANDRIYANTO</option>
									<option value="144">TETY HERAWATI</option>
									<option value="145">LIMPAH MAS INDONESIA, PT</option>
									<option value="146">MANDIRI PERKASA LOGIS, CV</option>
									<option value="147">RONNY RAMBING (NABE SURYA LESTARI)</option>
									<option value="148">BINTANG PARIAMA MANDIRI, CV (SOMIL PAK ALI)*</option>
									<option value="149">CRYSTAL GRAFIKA, CV *</option>
									<option value="150">INDRIA INTEREDINDO, PT</option>
									<option value="151">SAMATOR GAS INDUSTRI, PT (MUARA TEWEH)</option>
									<option value="152">ANUGERAH BERKAH LIMA TUJUH SATU, PT</option>
									<option value="153">IWIN</option>
									<option value="154">BERKAT TECHNICA ABADI, PT</option>
									<option value="155">SISKA APRILIANTY (DESA DIRUNG BAKUNG)</option>
									<option value="156">AIRINDO SAKTI, PT</option>
									<option value="157">ROMANDY PASIR, DEPO</option>
									<option value="158">EKO SAPUTRA  UG (DESA TUMBANG BAHAN)</option>
									<option value="159">DEDI IRAWAN, AMK ( DESA DOAN ARUNG )</option>
									<option value="160">BANUA OLAH NIAGA, PT</option>
									<option value="161">SUPRIADI</option>
									<option value="162">DUTA KREASI TEHNIK,PT</option>
									<option value="163">TUNAS OPTIMA PERKASA, PT</option>
									<option value="164">PILAR PRATAMA DINAMIKA, PT</option>
									<option value="165">INDOMOBIL PRIMA NIAGA,PT</option>
									<option value="166">SACON INDONESIA, PT</option>
									<option value="167">KAWAN LAMA SOLUSI, PT</option>
									<option value="168">CAHAYA BUANA NUSANTARA, CV</option>
									<option value="169">BAHANA SAMUDERA KREASINDO, PT</option>
									<option value="170">ASURANSI CENTRAL ASIA, PT ( JAKARTA )</option>
									<option value="171">CATERING PCN</option>
									<option value="172">BINAJAYA BERSAMA, CV</option>
									<option value="173">RELAZINDO USAHA BERSAMA, PT</option>
									<option value="174">HANS SUKU CADANG, PT</option>
									<option value="175">EONCHEMICALS PUTRA, PT</option>
									<option value="176">KAVA PRIMATAMA INDONESIA, PT</option>
									<option value="177">TRIMITRA SINERGI NUSA, PT</option>
									<option value="178">YAPINDO TRANSPORTAMA, PT</option>
									<option value="179">ABDUL ASIS</option>
									<option value="180">SUGIONO ( DESA CANGKANG )</option>
									<option value="181">ULTRA MEDICA SEJAHTERA, PT</option>
									<option value="182">ETEK ( DESA MAHANYAN )</option>
									<option value="183">PATIROI TAHIR (AIR ISI ULANG)</option>
									<option value="184">BUMEN REDJA ABADI, PT</option>
									<option value="185">SURYA BANJAR UTAMA, PT</option>
									<option value="186">BU SUGI, CATERING</option>
									<option value="187">CATERING TC</option>
									<option value="188">TIRTA INVESTAMA, PT</option>
									<option value="189">RSUD WEDA</option>
									<option value="190">ERLY SUTISNA ( DESA OLUNG DOJOU )</option>
									<option value="191">HAFARA TEKNIK, CV</option>
									<option value="192">GLOBAL DIGITAL NIAGA, PT</option>
									<option value="193">PEGASUS MANDIRI PRESSINDO, PT</option>
									<option value="194">ABISTAR GEMILANG RAJASANEGARA, CV</option>
									<option value="195">INDOMAX ASCARYA MACHINERY, PT</option>
									<option value="196">ATIQAH DIAN AMELIA, PT</option>
									<option value="197">EBET ( DESA MANTIAT PARI )</option>
									<option value="198">BILLY ANTHONY LIE & REKAN, KJPP</option>
									<option value="199">NICO JAYA TEKNIK, UD</option>
									<option value="200">LUTHFI ANGKASA RAYA, PT</option>
									<option value="201">RIFAI TRAKTOR DIESEL, CV</option>
									<option value="202">AFFIK BERKAH, TOKO</option>
									<option value="203">PATRA SUPPLIES AND SERVICES, PT</option>
									<option value="204">IEFPE PRATAMA DESAIN, PT</option>
									<option value="205">PELAYARAN SUMBER BAHARI, PT</option>
									<option value="206">YSA WELDINDO TEHNIK, PT</option>
									<option value="207">EMIRSYAH FAROUQ UTAMA, PT</option>
									<option value="208">PRIMED SUMBER BERKAH UTAMA, PT</option>
									<option value="209">CITRA ANDALAN MOBILINDO CEMERLANG, PT</option>
									<option value="210">MEKTEK TANJUNG LESTARI, PT</option>
									<option value="211">KLINIK SIMPANG</option>
									<option value="212">SATO LABEL SOLUTIONS, PT</option>
									<option value="213">ATHALLAH TEKNIK, CV</option>
									<option value="214">KADER ABD MUIN</option>
									<option value="215">BERLIAN KHARISMA PASIFIK, PT.</option>
									<option value="216">DIAMOND STAR, CV </option>
									<option value="217">NAJWA POWER. PT</option>
									<option value="218">GLOMINPRO INDONESIA, PT</option>
									<option value="219">SINERGI SAFETYPRENUR MULTIUSAHA, PT</option>
									<option value="220">TEKENOMIKS INDONESIA, PT</option>
									<option value="221">TEJA AULYA, CV</option>
									<option value="222">PUSAKA JAYA SARANA, CV</option>
									<option value="223">PUSKESMAS GEBE, UPTD</option>
									<option value="224">PANA OIL INDONESIA, PT</option>
									<option value="225">BERKAT KAWAN TEKNIK, CV.</option>
									<option value="226">BORNEO INDO TEHNIK,CV</option>
									<option value="227">TANJUNG SARANA INVESTAMA, PT</option>
									<option value="228">CAKRAWALA ENERGI KONSTRUKSI, PT</option>
									<option value="229">SLISIC INOVASI PRAKARSA, PT </option>
									<option value="230">DIESEL UTAMA INDONESIA, PT</option>
									<option value="231">ANDIKA TEGUH SETYA, PT</option>
									<option value="232">SANY INDONESIA HEAVY EQUIPMENT, PT</option>
									<option value="233">LESTARI MOTOR</option>
									<option value="234">OTR TIRE INDONESIA, TOKO</option>
									<option value="235">UU, PAK (AIR ISI ULANG)</option>
									<option value="236">WARUNG NEY SELLA</option>
									<option value="237">MAJU MANDIRI, UD</option>
									<option value="238">ANEKA GAS INDUSTRI, PT (KENDARI)</option>
									<option value="239">BAHTERA ALAM SEJAHTERA, PT</option>
									<option value="240">TELESAVE TELEKOMUNIKASI INDONESIA, PT</option>
									<option value="241">USAHA BARU *</option>
									<option value="242">AIR BERSIH DURAHMAN</option>
									<option value="243">AKBAR TRAVEL </option>
									<option value="244">INTAN PRIMA MINERAL INDONESIA, PT</option>
									<option value="245">AZHAR JAYA *</option>
									<option value="246">METCOINDO PENTA PERKASA, PT</option>
									<option value="247">MAJU,UD</option>
									<option value="248">JK MOTOR SPORT </option>
									<option value="249">HAMZAH</option>
									<option value="250">SETIA BENGKEL</option>
									<option value="251">DUNIA MOTOR (DAVID YAORI) *</option>
									<option value="252">AMCO SPAREPART INDONESIA, PT</option>
									<option value="253">PUNCAK TOMPIRA</option>
									<option value="254">ALIF AUTO VARIASI, BENGKEL</option>
									<option value="255">J & T EXPRESS</option>
								</select>
								<div class="invalid-feedback">
									Please choose your company.
								</div>
							</div>

							<!-- <form class="row g-3"> -->
							<div class="col-md-12 mb-3">
								<label for="nama" class="form-label small mb-0">
									<strong>Nama Peserta 1</strong><span class="text-danger"> *</span>
								</label>
								<input type="text" class="form-control" name="nama" id="nama" required>
								<div class="invalid-feedback">
									Please insert your name.
								</div>
							</div>

							<div class="col-md-12 mb-3">
								<label for="nama" class="form-label small mb-0">
									<strong>Nama Peserta 2</strong>
								</label>
								<input type="text" class="form-control" name="nama2" id="nama2" required>
								<div class="invalid-feedback">
									Please insert your name2.
								</div>
							</div>
						</div>
					</div>
				<?php } ?>

				<div class="card mb-2">
					<div class="card-body">
						<h1 class="card-title">Terimakasih telah mengisi form.</h1>
						<div class="col-md-12 mb-3">
							<label class="mb-3">Kami tunggu kehadiran Bapak/Ibu.</label><br>
						</div>
						<?php if (!$msg) { ?>
							<div class="col-md-12 mb-3">
								<label>
									<strong>SILAHKAN KLIK SUBMIT DIBAWAH INI UNTUK MENYELESAIKAN.</strong>
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