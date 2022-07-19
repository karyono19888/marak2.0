<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
	<meta name="author" content="PIXINVENT">
	<title>Absensi Karyawan</title>
	<link rel="apple-touch-icon" href="<?= base_url('assets'); ?>/images/ico/apple-icon-120.png">
	<link rel="shortcut icon" type="image/x-icon" href="<?= base_url('assets'); ?>/images/ico/favicon.ico">
	<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets'); ?>/vendors/css/extensions/sweetalert2.min.css">

	<!-- BEGIN: Vendor CSS-->
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets'); ?>/vendors/css/vendors.min.css">
	<!-- END: Vendor CSS-->

	<!-- BEGIN: Theme CSS-->
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets'); ?>/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets'); ?>/css/bootstrap-extended.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets'); ?>/css/colors.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets'); ?>/css/components.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets'); ?>/css/themes/dark-layout.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets'); ?>/css/themes/bordered-layout.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets'); ?>/css/themes/semi-dark-layout.css">

	<!-- BEGIN: Page CSS-->
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets'); ?>/css/core/menu/menu-types/vertical-menu.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets'); ?>/css/plugins/forms/form-validation.css">
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets'); ?>/css/pages/authentication.css">
	<!-- END: Page CSS-->
	<link rel="stylesheet" href="//cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern blank-page navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="blank-page">
	<!-- BEGIN: Content-->
	<div class="app-content content ">
		<div class="content-overlay"></div>
		<div class="header-navbar-shadow"></div>
		<div class="content-wrapper">
			<div class="content-header row">
			</div>
			<div class="content-body">
				<div class="auth-wrapper auth-cover">
					<div class="auth-inner row m-0">
						<!-- Brand logo-->
						<a class="brand-logo" href="#">
							<img src="<?= base_url('assets'); ?>/images/logo/logo-name.png" alt="logo-brand" width="5%">
						</a>
						<!-- /Brand logo-->
						<!-- Left Text-->
						<div class="d-none d-lg-flex col-lg-8 align-items-center p-5">
							<div class="w-100  align-items-center justify-content-center">
								<div class="row">
									<div class="col-sm-12">
										<div class="card">
											<div class="card-body">
												<div class="card-datatable">
													<table class="table table-hover table-borderless" id="mytable" width="100%">
														<thead>
															<tr>
																<th></th>
																<th>Nama</th>
																<th>Image</th>
																<th>Bagian</th>
																<th>Tanggal</th>
																<th>Jam Masuk</th>
																<th>Jam Pulang</th>
															</tr>
														</thead>
														<tbody>

														</tbody>
													</table>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- /Left Text-->
						<!-- Forgot password-->
						<div class="d-flex col-lg-4 align-items-center auth-bg px-2 p-lg-5">
							<div class="col-12 col-sm-8 col-md-6 col-lg-12 px-xl-2 mx-auto">
								<h2 class="card-title fw-bold mb-1" id="judul">Absensi Karyawan 🔒</h2>
								<p class="card-text mb-2" id="subjudul">Silahkan pilih jenis absensi yang akan anda inputkan.</p>
								<div id="showinputabsen"></div>
							</div>
						</div>
						<!-- /Forgot password-->
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- END: Content-->


	<!-- BEGIN: Vendor JS-->
	<script src="<?= base_url('assets'); ?>/vendors/js/vendors.min.js"></script>
	<!-- BEGIN Vendor JS-->
	<script src="//cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
	<!-- BEGIN: Page Vendor JS-->
	<script src="<?= base_url('assets'); ?>/vendors/js/forms/validation/jquery.validate.min.js"></script>
	<!-- END: Page Vendor JS-->

	<!-- END: Theme JS-->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.js"></script>
	<!-- BEGIN: Page JS-->
	<script src="<?= base_url('assets'); ?>/js/scripts/pages/auth-forgot-password.js"></script>
	<script src="<?= base_url('assets'); ?>/vendors/js/extensions/sweetalert2.all.min.js"></script>
	<!-- END: Page JS-->

	<script>
		$(window).on('load', function() {
			if (feather) {
				feather.replace({
					width: 14,
					height: 14
				});
			}
		})

		$(document).ready(function() {
			$("#showinputabsen").load("<?= base_url('Absensi/PilihAbsen'); ?>");
			$('#mytable').DataTable();
		});

		$(document).on("click", "#absenMasuk", function() {
			$("#showinputabsen").load("<?= base_url('Absensi/ShowAbsenMasuk'); ?>");
			document.getElementById('judul').innerText = "Absensi Masuk 🔒";
			document.getElementById('subjudul').innerText = "Inputkan nik karyawan yang terdaftar.";
			setTimeout(() => {
				window.location.reload();
			}, 360000);
		});

		$(document).on("click", "#absenPulang", function() {
			$("#showinputabsen").load("<?= base_url('Absensi/ShowAbsenPulang'); ?>");
			document.getElementById('judul').innerText = "Absensi Pulang 🔒";
			document.getElementById('subjudul').innerText = "Inputkan nik karyawan yang terdaftar.";
			setTimeout(() => {
				window.location.reload();
			}, 360000);
		});
	</script>
</body>
<!-- END: Body-->

</html>