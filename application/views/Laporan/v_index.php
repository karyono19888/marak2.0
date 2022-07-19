<?php $this->load->view('Components/v_header'); ?>
<link rel="stylesheet" type="text/css" href="<?= base_url('assets'); ?>/vendors/css/pickers/pickadate/pickadate.css">
<link rel="stylesheet" type="text/css" href="<?= base_url('assets'); ?>/css/components.css">
<link rel="stylesheet" type="text/css" href="<?= base_url('assets'); ?>/css/plugins/forms/pickers/form-pickadate.css">
<link rel="stylesheet" href="//cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<!-- BEGIN: Body-->
<?php $this->load->view('Components/v_headerbottom'); ?>

<!-- BEGIN: Header-->
<?php $this->load->view('Components/v_navbar'); ?>
<!-- END: Header-->


<!-- BEGIN: Main Menu-->
<?php $this->load->view('Components/v_sidebar'); ?>
<!-- END: Main Menu-->

<!-- BEGIN: Content-->
<div class="app-content content ">
	<div class="content-overlay"></div>
	<div class="header-navbar-shadow"></div>
	<div class="content-wrapper container-xxl p-0">
		<div class="content-header row">
			<div class="content-header-left col-md-9 col-12 mb-2">
				<div class="row breadcrumbs-top">
					<div class="col-12">
						<h2 class="content-header-title float-start mb-0">Laporan</h2>
						<div class="breadcrumb-wrapper">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="<?= base_url('Marketing'); ?>">Marketing</a>
								</li>
								<li class="breadcrumb-item active">Data Laporan
								</li>
							</ol>
						</div>
					</div>
				</div>
			</div>
			<div class="content-header-right text-md-end col-md-3 col-12 d-md-block d-none">
				<div class="mb-1 breadcrumb-right">
					<div class="dropdown">
						<button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i data-feather="grid"></i>
						</button>
					</div>
				</div>
			</div>
		</div>
		<div class="content-body">
			<!-- content Starts -->
			<div class="row">
				<div class="col-sm-6">
					<div class="card">
						<div class="card-header">
							<div class="card-title">Laporan Kunjungan</div>
						</div>
						<div class="card-body">
							<form id="formLaporanKunjungan">
								<div class="row">
									<div class="col-sm-6 position-relative">
										<div class="mb-1">
											<label class="form-label" for="date_start_laporan">Tanggal Mulai</label>
											<input type="date" class="form-control pickadate" id="date_start_laporan" name="date_start_laporan" placeholder="YYYY:MM:DD" />
										</div>
									</div>
									<div class="col-sm-6 position-relative">
										<div class="mb-1">
											<label class="form-label" for="date_end_laporan">Tanggal Selesai</label>
											<input type="date" class="form-control pickadate" id="date_end_laporan" name="date_end_laporan" placeholder="YYYY:MM:DD" />
										</div>
									</div>
								</div>
							</form>
							<div class="row">
								<div class="col-sm-3">
									<button type="button" class="btn btn-outline-primary" id="tombol_laporan">
										<i data-feather="search"></i>
										<span>Search</span>
									</button>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="card">
						<div class="card-header">
							<div class="card-title">Summary Order</div>
						</div>
						<div class="card-body">
							<form id="formSumamry">
								<div class="row">
									<div class="col-sm-6 position-relative">
										<div class="mb-1">
											<label class="form-label" for="date_start_summary">Tanggal Mulai</label>
											<input type="date" class="form-control pickadate" id="date_start_summary" name="date_start_summary" placeholder="YYYY:MM:DD" />
										</div>
									</div>
									<div class="col-sm-6 position-relative">
										<div class="mb-1">
											<label class="form-label" for="date_end_summary">Tanggal Selesai</label>
											<input type="date" class="form-control pickadate" id="date_end_summary" name="date_end_summary" placeholder="YYYY:MM:DD" />
										</div>
									</div>
								</div>
							</form>
							<div class="row">
								<div class="col-sm-3">
									<button type="button" class="btn btn-outline-primary" id="tombol_summary">
										<i data-feather="search"></i>
										<span>Search</span>
									</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-sm-12">
					<div id="showdata"></div>
				</div>
			</div>
			<!-- content ends -->
		</div>
	</div>
</div>
<!-- END: Content-->

<?php $this->load->view('Components/v_footer'); ?>
<script src="//cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets'); ?>/vendors/js/pickers/pickadate/picker.js"></script>
<script src="<?= base_url('assets'); ?>/vendors/js/pickers/pickadate/picker.date.js"></script>
<script src="<?= base_url('assets'); ?>/vendors/js/pickers/pickadate/picker.time.js"></script>
<script src="<?= base_url('assets'); ?>/vendors/js/pickers/pickadate/legacy.js"></script>
<script src="<?= base_url('assets'); ?>/vendors/js/pickers/pickadate/picker.date.js"></script>
<script>
	$('.pickadate').pickadate();

	$(document).on("click", "#tombol_laporan", function() {
		if (validasi()) {
			let data = $('#formLaporanKunjungan').serialize();
			$.ajax({
				type: 'POST',
				url: '<?= base_url('Laporan/ShowDataLaporanKunjungan'); ?>',
				data: data,
				success: function(response) {
					$("#showdata").html(response);
				}
			});
		}
	});

	function validasi() {
		let date_start_laporan = document.getElementById("date_start_laporan").value;
		let date_end_laporan = document.getElementById("date_end_laporan").value;
		if ((date_start_laporan == "") || (date_end_laporan == "")) {
			if (date_end_laporan == "") {
				notif("Tanggal Selesai");
			}
			if (date_start_laporan == "") {
				notif("Tanggal Mulai");
			}
		} else {
			return true;
		}
	}

	$(document).on("click", "#tombol_summary", function() {
		if (validasiA()) {
			let data = $('#formSumamry').serialize();
			$.ajax({
				type: 'POST',
				url: '<?= base_url('Laporan/ShowDataSummaryOrder'); ?>',
				data: data,
				success: function(response) {
					$("#showdata").html(response);
				}
			});
		}
	});

	function validasiA() {
		let date_start_summary = document.getElementById("date_start_summary").value;
		let date_end_summary = document.getElementById("date_end_summary").value;
		if ((date_start_summary == "") || (date_end_summary == "")) {
			if (date_end_summary == "") {
				notif("Tanggal Selesai");
			}
			if (date_start_summary == "") {
				notif("Tanggal Mulai");
			}
		} else {
			return true;
		}
	}

	function notif(word) {
		Swal.fire({
			title: 'Perhatian',
			text: word + ' wajib di isi !',
			icon: 'info',
		}).then((result) => {})
	}
</script>
<?php $this->load->view('Components/v_bottom'); ?>