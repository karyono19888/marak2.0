<?php $this->load->view('Components/v_header'); ?>
<link rel="stylesheet" type="text/css" href="<?= base_url('assets'); ?>/css/components.css">
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
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
						<h2 class="content-header-title float-start mb-0">Tambah Jadwal</h2>
						<div class="breadcrumb-wrapper">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="<?= base_url('Jadwal'); ?>">Jadwal</a>
								</li>
								<li class="breadcrumb-item active">Tambah Jadwal Kunjungan
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

			<div class="row">
				<!-- custom option radio -->
				<div class="col-lg-9">
					<div class="card">
						<div class="card-header">
							<h4 class="card-title">Pilih Rencana Kunjungan</h4>
						</div>
						<div class="card-body">
							<div class="row custom-options-checkable g-1">
								<div class="col-md-6">
									<input class="custom-option-item-check" type="radio" name="kunjungan_baru" id="kunjungan_baru" />
									<label class="custom-option-item p-1" for="kunjungan_baru">
										<span class="d-flex justify-content-between flex-wrap mb-50">
											<span class="fw-bolder">Kunjungan Baru</span>
											<span>
												<div class="avatar bg-primary">
													<div class="avatar-content">
														<i data-feather="plus" class="avatar-icon"></i>
													</div>
												</div>
											</span>
										</span>
										<small class="d-block">Pilih untuk jadwal yang <span class="fw-bolder">belum terkunjungi</span>.</small>
									</label>
								</div>

								<div class="col-md-6">
									<input class="custom-option-item-check" type="radio" name="kunjungan_update" id="kunjungan_update" value="" />
									<label class="custom-option-item p-1" for="kunjungan_update">
										<span class="d-flex justify-content-between flex-wrap mb-50">
											<span class="fw-bolder">Kunjungan Update</span>
											<span class="fw-bolder">
												<div class="avatar bg-warning">
													<div class="avatar-content">
														<i data-feather="edit-2" class="avatar-icon"></i>
													</div>
												</div>
											</span>
										</span>
										<small class="d-block">Pilih untuk jadwal yang <span class="fw-bolder">sudah terkunjungi</span>.</small>
									</label>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- Select2 Start  -->
			<div id="show_jadwal"></div>
			<!-- Select2 End -->

		</div>
	</div>
</div>
<!-- END: Content-->

<?php $this->load->view('Components/v_footer'); ?>
<script src="<?= base_url('assets'); ?>/vendors/js/forms/select/select2.full.min.js"></script>
<script src="<?= base_url('assets'); ?>/js/scripts/forms/form-select2.js"></script>
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="//cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

<script>
	$(document).ready(function() {

		$("#kunjungan_baru").click(function() {
			document.getElementById("kunjungan_baru").checked = true;
			document.getElementById("kunjungan_update").checked = false;
			$('#show_jadwal').load("<?= base_url('Jadwal/TambahKunjunganBaru') ?>");
		});

		$("#kunjungan_update").click(function() {
			document.getElementById("kunjungan_baru").checked = false;
			document.getElementById("kunjungan_update").checked = true;
			$("#show_jadwal").load("<?= base_url('Jadwal/TableKunjunganMarketing') ?>");
		});
	});
</script>

<?php $this->load->view('Components/v_bottom'); ?>