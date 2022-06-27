<?php $this->load->view('Components/v_header'); ?>
<link rel="stylesheet" type="text/css" href="<?= base_url('assets'); ?>/vendors/css/pickers/flatpickr/flatpickr.min.css">
<link rel="stylesheet" type="text/css" href="<?= base_url('assets'); ?>/css/components.css">
<link rel="stylesheet" type="text/css" href="<?= base_url('assets'); ?>/css/plugins/forms/pickers/form-flat-pickr.css">
<link rel="stylesheet" type="text/css" href="<?= base_url('assets'); ?>/css/pages/app-invoice.css">
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
						<h2 class="content-header-title float-start mb-0">Tambah Kunjungan Baru</h2>
						<div class="breadcrumb-wrapper">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="<?= base_url('Marketing'); ?>">Marketing</a>
								</li>
								<li class="breadcrumb-item active">Tambah Kunjungan Baru
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
			<!-- Dashboard Ecommerce Starts -->
			<section class="invoice-add-wrapper">
				<div class="row invoice-add">
					<!-- Invoice Add Left starts -->
					<div class="col-xl-9 col-md-8 col-12">
						<div class="card invoice-preview-card">
							<!-- Header starts -->
							<!-- <div class="card-body invoice-padding pb-0">
								<div class="d-flex justify-content-between flex-md-row flex-column invoice-spacing">
									<div>
										<div class="logo-wrapper">
											<img src="<?= base_url('assets'); ?>/images/logo/logo.png" alt="logo-brand" width="20%">
											<h3 class="text-primary invoice-logo">Marak</h3>
										</div>
									</div>
									<div class="invoice-number-date mt-md-0 mt-2">
										<div class="d-flex align-items-center mb-1">
											<span class="title">Date:</span>
											<input type="date" class="form-control invoice-edit-input date-picker" />
										</div>
									</div>
								</div>
							</div> -->
							<!-- Header ends -->

							<hr class="invoice-spacing mt-0" />

							<!-- Address and Contact starts -->
							<div class="card-body invoice-padding pt-0">
								<div class="row">
									<div class="col-xl-4 col-sm-6 col-12">
										<div class="mb-1">
											<label class="form-label" for="basicInput">Provinsi</label>
											<div class="input-group">
												<select name="m_visit_prov" id="m_visit_prov" class="form-select">
													<option value="">- Pilih Provinsi -</option>
												</select>
											</div>
										</div>
									</div>
									<div class="col-xl-4 col-sm-6 col-12">
										<div class="mb-1">
											<label class="form-label" for="basicInput">Kab/Kota</label>
											<div class="input-group">
												<select name="m_visit_kab" id="m_visit_kab" class="form-select">
													<option value="">- Pilih Kabupaten -</option>
												</select>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-xl-8 col-sm-8 col-12">
										<div class="mb-1">
											<label class="form-label" for="basicInput">Instansi</label>
											<div class="invoice-customer">
												<select class="invoiceto form-select" id="m_visit_instansi" name="m_visit_instansi">
													<option value=""></option>
												</select>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-xl-2 col-sm-6 col-12">
										<div class="mb-1">
											<label class="form-label" for="basicInput">Jam Mulai</label>
											<div class="input-group">
												<input type="time" name="" id="" class="form-control">
											</div>
										</div>
									</div>
									<div class="col-xl-2 col-sm-6 col-12">
										<div class="mb-1">
											<label class="form-label" for="basicInput">Jam Selesai</label>
											<div class="input-group">
												<input type="time" name="" id="" class="form-control">
											</div>
										</div>
									</div>
									<div class="col-xl-4 col-sm-6 col-12">
										<div class="mb-1">
											<label class="form-label" for="basicInput">Tanggal Kunjungan</label>
											<div class="input-group">
												<input type="date" name="" id="" class="form-control date-picker">
											</div>
										</div>
									</div>
								</div>
							</div>
							<!-- Address and Contact ends -->

							<!-- Product Details starts -->
							<div class="card-body invoice-padding invoice-product-details">
								<form class="source-item">
									<div data-repeater-list="group-a">
										<div class="repeater-wrapper" data-repeater-item>
											<div class="row">
												<div class="col-sm-12 d-flex product-details-border position-relative pe-0">
													<div class="row w-100 pe-lg-0 pe-1 py-1">
														<div class="col-lg-4 col-12 mb-lg-0 mb-2 mt-lg-0 mt-2">
															<p class="card-text col-title mb-md-50 mb-0">Nama Peserta</p>
															<input type="text" class="form-control" value="" placeholder="Nama Lengkap" />
														</div>
														<div class="col-lg-3 col-12 my-lg-0 my-2">
															<p class="card-text col-title mb-md-2 mb-0">Jabatan</p>
															<input type="text" class="form-control" value="" placeholder="Nama Jabatan" />
														</div>
														<div class="col-lg-3 col-12 my-lg-0 my-2">
															<p class="card-text col-title mb-md-2 mb-0">Phone/Whatsapp</p>
															<input type="number" class="form-control" value="" placeholder="+61 8123 456 789" />
														</div>
													</div>
													<div class="d-flex flex-column align-items-center justify-content-between border-start invoice-product-actions py-50 px-25">
														<i data-feather="x" class="cursor-pointer font-medium-3" data-repeater-delete></i>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="row mt-1">
										<div class="col-12 px-0">
											<button type="button" class="btn btn-primary btn-sm btn-add-new" data-repeater-create>
												<i data-feather="plus" class="me-25"></i>
												<span class="align-middle">Add Peserta</span>
											</button>
										</div>
									</div>
								</form>
							</div>
							<!-- Product Details ends -->

							<div class="card-body invoice-padding py-0">
								<!-- Invoice Note starts -->
								<div class="row">
									<div class="col-12">
										<div class="my-2">
											<label for="note" class="form-label fw-bold">Notulensi</label>
											<textarea class="form-control" rows="3" id="note"></textarea>
										</div>
									</div>
								</div>
								<!-- Invoice Note ends -->
								<div class="row">
									<div class="col-xl-3 col-sm-6 col-12">
										<div class="mb-1">
											<label class="form-label" for="basicInput">APBN/P/D</label>
											<small class="text-muted"><i>Satuan Jutaan</i></small>
											<div class="input-group input-group-merge mb-2">
												<span class="input-group-text" id="basic-addon-search2">Rp</span>
												<input type="text" class="form-control" placeholder="000.000" />
											</div>
										</div>
									</div>
									<div class="col-xl-3 col-sm-6 col-12">
										<div class="mb-1">
											<label class="form-label" for="basicInput">Prospek</label>
											<small class="text-muted"><i>Satuan Jutaan</i></small>
											<div class="input-group input-group-merge mb-2">
												<span class="input-group-text" id="basic-addon-search2">Rp</span>
												<input type="text" class="form-control" placeholder="000.000" />
											</div>
										</div>
									</div>
									<div class="col-xl-3 col-sm-6 col-12">
										<div class="mb-1">
											<label class="form-label" for="basicInput">Prognosa</label>
											<small class="text-muted"><i>Satuan Jutaan</i></small>
											<div class="input-group input-group-merge mb-2">
												<span class="input-group-text" id="basic-addon-search2">Rp</span>
												<input type="text" class="form-control" placeholder="000.000" />
											</div>
										</div>
									</div>
									<div class="col-xl-3 col-sm-6 col-12">
										<div class="mb-1">
											<label class="form-label" for="basicInput">Close PO</label>
											<small class="text-muted"><i>Satuan Jutaan</i></small>
											<div class="input-group input-group-merge mb-2">
												<span class="input-group-text" id="basic-addon-search2">Rp</span>
												<input type="text" class="form-control" placeholder="000.000" />
											</div>
										</div>
									</div>
								</div>
							</div>
							<hr class="invoice-spacing mt-0" />
							<div class="card-body invoice-padding py-0">
								<div class="row">
									<div class="col-xl-4 col-sm-6 col-12">
										<div class="mb-1">
											<label class="form-label" for="basicInput">Estimasi Order</label>
											<div class="input-group input-group-merge mb-2">
												<span class="input-group-text" id="basic-addon-search2"><i data-feather='calendar'></i></span>
												<select name="" id="" class="form-select">
													<option value="">- Pilih Quartal -</option>
													<option value="Quartal 1">Quartal 1</option>
													<option value="Quartal 2">Quartal 2</option>
													<option value="Quartal 3">Quartal 3</option>
													<option value="Quartal 4">Quartal 4</option>
												</select>
											</div>
										</div>
									</div>
									<div class="col-xl-4 col-sm-6 col-12">
										<div class="mb-1">
											<label class="form-label" for="basicInput">Estimasi Tahun</label>
											<div class="input-group input-group-merge mb-2">
												<span class="input-group-text" id="basic-addon-search2"><i data-feather='calendar'></i></span>
												<select name="" id="" class="form-select">
													<option value="">- Pilih Tahun -</option>
													<option value="<?= date('Y'); ?>"><?= date('Y'); ?></option>
													<option value="<?= date('Y') + 1; ?>"><?= date('Y') + 1; ?></option>
												</select>
											</div>
										</div>
									</div>
									<div class="col-xl-4 col-sm-6 col-12">
										<div class="mb-1">
											<label class="form-label" for="basicInput">Status</label>
											<select name="" id="" class="form-select">
												<option label="">- Pilih Status -</option>
												<option value="Prospek">Prospek</option>
												<option value="Prognosa">Prognosa</option>
											</select>
										</div>
									</div>
								</div>
							</div>

							<!-- Invoice Total starts -->
							<div class="card-body invoice-padding">
								<div class="row invoice-sales-total-wrapper">
									<div class="col-xl-6 col-sm-6 col-12"></div>
									<div class="col-xl-3 col-sm-6 col-12">
										<div class="mb-1">
											<small class="text-muted"><i>Koordinat</i></small>
											<div class="input-group input-group-merge mb-2">
												<span class="input-group-text" id="basic-addon-search2">Lat</span>
												<input type="text" class="form-control" placeholder=" -0.0000000" readonly />
											</div>
										</div>
									</div>
									<div class="col-xl-3 col-sm-6 col-12">
										<div class="mb-1">
											<small class="text-muted"><i>Koordinat</i></small>
											<div class="input-group input-group-merge mb-2">
												<span class="input-group-text" id="basic-addon-search2">Long</span>
												<input type="text" class="form-control" placeholder=" 000.000000" readonly />
											</div>
										</div>
									</div>
								</div>
							</div>
							<!-- Invoice Total ends -->
						</div>
					</div>
					<!-- Invoice Add Left ends -->

					<!-- Invoice Add Right starts -->
					<div class="col-xl-3 col-md-4 col-12">
						<div class="card">
							<div class="card-body">
								<button class="btn btn-primary w-100 mb-75">Simpan</button>
								<button type="button" class="btn btn-outline-primary w-100">Cancle</button>
							</div>
						</div>
					</div>
					<!-- Invoice Add Right ends -->
				</div>

				<!-- Add New Customer Sidebar -->
				<div class="modal modal-slide-in fade" id="add-new-customer-sidebar" aria-hidden="true">
					<div class="modal-dialog sidebar-lg">
						<div class="modal-content p-0">
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
							<div class="modal-header mb-1">
								<h5 class="modal-title">
									<span class="align-middle">Add Instansi</span>
								</h5>
							</div>
							<div class="modal-body flex-grow-1">
								<form>
									<div class="mb-1">
										<label for="customer-name" class="form-label">Kategori Instansi</label>
										<select class="form-select" id="" name="">
											<option value="">- Pilih Kategori -</option>
											<option value="Pemerintahan">Pemerintahan</option>
											<option value="Swasta">Swasta</option>
											<option value="Perorangan">Perorangan</option>
										</select>
									</div>
									<div class="mb-1">
										<label for="customer-name" class="form-label">Nama Instansi/ Swasta/ Perorangan</label>
										<input type="text" class="form-control" id="customer-name" placeholder="Nama instansi lengkap" />
									</div>
									<div class="mb-1">
										<label for="customer-address" class="form-label">Alamat</label>
										<textarea class="form-control" id="customer-address" cols="2" rows="2" placeholder="Isi alamat lengkap"></textarea>
									</div>
									<div class="mb-1 position-relative">
										<label for="customer-country" class="form-label">Wilayah</label>
										<select class="form-select" id="customer-country" name="customer-country">
											<option value="">- Pilih wilayah -</option>
										</select>
									</div>
									<div class="mb-1 position-relative">
										<label for="customer-country" class="form-label">Provinsi</label>
										<select class="form-select" id="customer-country" name="customer-country">
											<option value="">- Pilih provinsi -</option>
										</select>
									</div>
									<div class="mb-1 position-relative">
										<label for="customer-country" class="form-label">Kabupaten</label>
										<select class="form-select" id="customer-country" name="customer-country">
											<option value="">- Pilih kabapaten -</option>
										</select>
									</div>
									<div class="mb-1 d-flex flex-wrap mt-2">
										<button type="button" class="btn btn-primary me-1" data-bs-dismiss="modal">Add</button>
										<button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<!-- /Add New Customer Sidebar -->
			</section>
			<!-- Dashboard Ecommerce ends -->

		</div>
	</div>
</div>
<!-- END: Content-->

<?php $this->load->view('Components/v_footer'); ?>

<script src="<?= base_url('assets'); ?>/vendors/js/forms/repeater/jquery.repeater.min.js"></script>
<script src="<?= base_url('assets'); ?>/vendors/js/forms/select/select2.full.min.js"></script>
<script src="<?= base_url('assets'); ?>/vendors/js/pickers/flatpickr/flatpickr.min.js"></script>

<script src="<?= base_url('assets'); ?>/js/scripts/pages/app-invoice.js"></script>
<script>
	alert($(document).find(".select2-results__message"));
	// provinsi
	$(document).ready(function() {
		$("#m_visit_prov").select2({
			ajax: {
				url: '<?= base_url('Wilayah/Provinsi'); ?>',
				type: "post",
				dataType: 'json',
				delay: 200,
				data: function(params) {
					return {
						searchTerm: params.term
					};
				},
				processResults: function(response) {
					return {
						results: response
					};
				},
				cache: true
			}
		});
	});
	// kabupaten
	$("#m_visit_prov").change(function() {
		var id_prov = $("#m_visit_prov").val();
		$("#m_visit_kab").select2({
			ajax: {
				url: '<?= base_url(); ?>Wilayah/Kabupaten/' + id_prov,
				type: "post",
				dataType: 'json',
				delay: 200,
				data: function(params) {
					return {
						searchTerm: params.term
					};
				},
				processResults: function(response) {
					return {
						results: response
					};
				},
				cache: true
			}
		});
	});

	$("#m_visit_kab").change(function() {
		var id_kab = $("#m_visit_kab").val();
		$("#m_visit_instansi").select2({
			ajax: {
				url: '<?= base_url('Wilayah/Instansi/') ?>' + id_kab,
				type: "post",
				dataType: 'json',
				delay: 200,
				data: function(params) {
					return {
						searchTerm: params.term
					};
				},
				processResults: function(response) {
					return {
						results: response
					};
				},
				cache: true
			}
		});
	});
</script>
<?php $this->load->view('Components/v_bottom'); ?>