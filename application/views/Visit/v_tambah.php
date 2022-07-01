<?php $this->load->view('Components/v_header'); ?>
<link rel="stylesheet" type="text/css" href="<?= base_url('assets'); ?>/vendors/css/pickers/flatpickr/flatpickr.min.css">
<link rel="stylesheet" type="text/css" href="<?= base_url('assets'); ?>/css/components.css">
<link rel="stylesheet" type="text/css" href="<?= base_url('assets'); ?>/css/plugins/forms/pickers/form-flat-pickr.css">
<link rel="stylesheet" type="text/css" href="<?= base_url('assets'); ?>/css/pages/app-invoice.css">
<link rel="stylesheet" type="text/css" href="<?= base_url('assets'); ?>/vendors/css/maps/leaflet.min.css">
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
				<form method="POST" id="formTambahKunjungan">
					<div class="row invoice-add">
						<!-- Invoice Add Left starts -->
						<div class="col-xl-9 col-md-8 col-12">
							<div class="card invoice-preview-card">

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
														<option value="">- Pilih Instansi -</option>
													</select>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-xl-8 col-sm-8 col-12">
											<div class="mb-1">
												<label class="form-label" for="m_visit_agenda">Agenda Kunjungan</label>
												<div class="invoice-customer">
													<input type="text" name="m_visit_agenda" id="m_visit_agenda" class="form-control" placeholder="contoh : Kunjungan pertama presentasi produk">
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-xl-2 col-sm-6 col-12">
											<div class="mb-1">
												<label class="form-label" for="m_visit_jam_mulai">Jam Mulai</label>
												<div class="input-group">
													<input type="text" name="m_visit_jam_mulai" id="m_visit_jam_mulai" class="form-control flatpickr-time" placeholder="HH:MM">
												</div>
											</div>
										</div>
										<div class="col-xl-2 col-sm-6 col-12">
											<div class="mb-1">
												<label class="form-label" for="m_visit_jam_selesai">Jam Selesai</label>
												<div class="input-group">
													<input type="text" name="m_visit_jam_selesai" id="m_visit_jam_selesai" class="form-control flatpickr-time" placeholder="HH:MM">
												</div>
											</div>
										</div>
										<div class="col-xl-4 col-sm-6 col-12">
											<div class="mb-1">
												<label class="form-label" for="m_visit_tgl">Tanggal Kunjungan</label>
												<div class="input-group">
													<input type="date" name="m_visit_tgl" id="m_visit_tgl" class="form-control date-picker">
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
														<div class="row w-100 pe-lg-0 pe-1 my-1">
															<div class="col-lg-4 col-12 mb-lg-0 mt-lg-0 mt-1">
																<p class="card-text col-title mb-md-50 mb-0">Nama Peserta</p>
																<input type="text" class="form-control" id="peserta_nama" name="peserta_nama[]" placeholder="Nama Lengkap" />
															</div>
															<div class="col-lg-4 col-12 my-lg-0 mt-1">
																<p class="card-text col-title mb-md-2 mb-0">Jabatan</p>
																<input type="text" class="form-control" id="peserta_jabatan" name="peserta_jabatan[]" placeholder="Nama Jabatan" />
															</div>
															<div class="col-lg-3 col-12 my-lg-0 mt-1">
																<p class="card-text col-title mb-md-2 mb-0">Phone/Whatsapp</p>
																<input type="number" class="form-control" id="peserta_phone" name="peserta_phone[]" placeholder="+61 8123 456 789" />
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

								<!-- apbn -->
								<div class="card-body invoice-padding py-0">
									<!-- Invoice Note starts -->
									<div class="row">
										<div class="col-12">
											<div class="my-2">
												<label for="m_visit_note" class="form-label fw-bold">Notulensi</label>
												<input type="hidden" name="m_visit_note" id="m_visit_note" value="<?= set_value('m_visit_note') ?>">
												<div id="editor" style="min-height: 100px;"><?= set_value('m_visit_note') ?></div>
											</div>
										</div>
									</div>
									<!-- Invoice Note ends -->
									<div class="row">
										<div class="col-xl-3 col-sm-6 col-12">
											<div class="mb-1">
												<label class="form-label" for="m_visit_anggaran_BUMN">APBN/P/D</label>
												<small class="text-muted"><i>Satuan Jutaan</i></small>
												<div class="input-group input-group-merge mb-2">
													<span class="input-group-text" id="basic-addon-search2">Rp</span>
													<input type="text" class="form-control numeral-mask" maxlength="7" id="m_visit_anggaran_BUMN" name="m_visit_anggaran_BUMN" placeholder=" 000.000" />
												</div>
											</div>
										</div>
										<div class="col-xl-3 col-sm-6 col-12">
											<div class="mb-1">
												<label class="form-label" for="m_visit_prospek">Prospek</label>
												<small class="text-muted"><i>Satuan Jutaan</i></small>
												<div class="input-group input-group-merge mb-2">
													<span class="input-group-text" id="basic-addon-search2">Rp</span>
													<input type="text" class="form-control numeral-mask" maxlength="7" id="m_visit_prospek" name="m_visit_prospek" placeholder=" 000.000" />
												</div>
											</div>
										</div>
										<div class="col-xl-3 col-sm-6 col-12">
											<div class="mb-1">
												<label class="form-label" for="m_visit_prognosa">Prognosa</label>
												<small class="text-muted"><i>Satuan Jutaan</i></small>
												<div class="input-group input-group-merge mb-2">
													<span class="input-group-text" id="basic-addon-search2">Rp</span>
													<input type="text" class="form-control numeral-mask" maxlength="7" id="m_visit_prognosa" name="m_visit_prognosa" placeholder=" 000.000" />
												</div>
											</div>
										</div>
										<div class="col-xl-3 col-sm-6 col-12">
											<div class="mb-1">
												<label class="form-label" for="m_visit_po">Close PO</label>
												<small class="text-muted"><i>Satuan Jutaan</i></small>
												<div class="input-group input-group-merge mb-2">
													<span class="input-group-text" id="basic-addon-search2">Rp</span>
													<input type="text" class="form-control numeral-mask" id="m_visit_po" name="m_visit_po" placeholder=" 000.000" readonly />
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
												<label class="form-label" for="m_visit_estimasi_order">Estimasi Order</label>
												<div class="input-group input-group-merge mb-2">
													<span class="input-group-text" id="basic-addon-search2"><i data-feather='calendar'></i></span>
													<select name="m_visit_estimasi_order" id="m_visit_estimasi_order" class="form-select">
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
												<label class="form-label" for="m_visit_estimasi_tahun">Estimasi Tahun</label>
												<div class="input-group input-group-merge mb-2">
													<span class="input-group-text" id="basic-addon-search2"><i data-feather='calendar'></i></span>
													<select name="m_visit_estimasi_tahun" id="m_visit_estimasi_tahun" class="form-select">
														<option value="">- Pilih Tahun -</option>
														<option value="<?= date('Y'); ?>"><?= date('Y'); ?></option>
														<option value="<?= date('Y') + 1; ?>"><?= date('Y') + 1; ?></option>
													</select>
												</div>
											</div>
										</div>
										<div class="col-xl-4 col-sm-6 col-12">
											<div class="mb-1">
												<label class="form-label" for="m_visit_status">Status</label>
												<select name="m_visit_status" id="m_visit_status" class="form-select">
													<option label="">- Pilih Status -</option>
													<option value="Prospek">Prospek</option>
													<option value="Prognosa">Prognosa</option>
												</select>
											</div>
										</div>
									</div>
								</div>

								<!-- map show position -->
								<div class="card-body invoice-padding">
									<div class="row invoice-sales-total-wrapper">
										<div class="col-xl-3 col-sm-6 col-12">
											<button type="button" onclick="getlocation()" id="tombol_maps" class="btn btn-sm btn-primary mb-75"><i data-feather='map-pin'></i> Show Position</button>
										</div>
										<div class="col-xl-9 col-sm-6 col-12" id="showmap">

										</div>
										<div class="row">
											<div class="col-sm-8">
												<div class="row">
													<div class="col-xl-6 col-sm-6 col-12">
														<div class="mb-1">
															<small class="text-muted"><i>Koordinat Lat</i></small>
															<div class="input-group mb-2">
																<input type="text" class="form-control" id="m_visit_koor_lat" name="m_visit_koor_lat" placeholder=" -0.0000000" readonly />
															</div>
														</div>
													</div>
													<div class="col-xl-6 col-sm-6 col-12">
														<div class="mb-1">
															<small class="text-muted"><i>Koordinat Long</i></small>
															<div class="input-group mb-2">
																<input type="text" class="form-control" id="m_visit_koor_long" name="m_visit_koor_long" placeholder=" 000.000000" readonly />
															</div>
														</div>
													</div>
												</div>
												<div class="leaflet-map" id="user-location" style="height: 150px; border-radius:5px;  visibility: hidden;"></div>
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
									<button class="btn btn-primary w-100 mb-75" id="tombol_add" type="button">Simpan</button>
									<a href="<?= base_url('Visit'); ?>" class="btn btn-outline-primary w-100" type="button">Cancle</a>
								</div>
							</div>
						</div>
						<!-- Invoice Add Right ends -->
					</div>
				</form>
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
								<form method="POST" id="formInstansi">
									<div class="mb-1">
										<label for="instansi_kategori" class="form-label">Kategori Instansi</label>
										<select class="form-select" id="instansi_kategori" name="instansi_kategori">
											<option value="">- Pilih Kategori -</option>
											<option value="Pemerintahan">Pemerintahan</option>
											<option value="Swasta">Swasta</option>
											<option value="Perorangan">Perorangan</option>
										</select>
									</div>
									<div class="mb-1">
										<label for="instansi_nama" class="form-label">Nama Instansi/ Swasta/ Perorangan</label>
										<input type="text" class="form-control" id="instansi_nama" name="instansi_nama" placeholder="Nama instansi lengkap" />
									</div>
									<div class="mb-1">
										<label for="instansi_alamat" class="form-label">Alamat</label>
										<textarea class="form-control" id="instansi_alamat" name="instansi_alamat" cols="2" rows="2" placeholder="Isi alamat lengkap"></textarea>
									</div>
									<div class="mb-1 position-relative">
										<label for="instansi_wil" class="form-label">Wilayah</label>
										<select class="form-select" id="instansi_wil" name="instansi_wil">
											<option value="">- Pilih wilayah -</option>
										</select>
									</div>
									<div class="mb-1 position-relative">
										<label for="instansi_prov" class="form-label">Provinsi</label>
										<select class="form-select" id="instansi_prov" name="instansi_prov">
											<option value="">- Pilih provinsi -</option>
										</select>
									</div>
									<div class="mb-1 position-relative">
										<label for="instansi_kab" class="form-label">Kabupaten</label>
										<select class="form-select" id="instansi_kab" name="instansi_kab">
											<option value="">- Pilih kabapaten -</option>
										</select>
									</div>
									<div class="mb-1 d-flex flex-wrap mt-2">
										<button type="button" class="btn btn-primary me-1" id="tombol_tambah">Add</button>
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
<script src="<?= base_url('assets'); ?>/vendors/js/maps/leaflet.min.js"></script>
<script src="<?= base_url('assets'); ?>/js/scripts/pages/app-invoice.js"></script>
<script src="<?= base_url('assets'); ?>/js/geolocation.js"></script>
<script src="<?= base_url('assets'); ?>/vendors/js/forms/cleave/cleave.min.js"></script>
<script src="<?= base_url('assets'); ?>/vendors/js/forms/cleave/addons/cleave-phone.us.js"></script>
<script>
	var quill = new Quill('#editor', {
		theme: 'snow'
	});

	quill.on('text-change', function(delta, oldDelta, source) {
		document.querySelector("input[name='m_visit_note']").value = quill.root.innerHTML;
	});
</script>

<script>
	let timePickr = $('.flatpickr-time');
	if (timePickr.length) {
		timePickr.flatpickr({
			enableTime: true,
			noCalendar: true
		});
	}
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
	// instansi
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

<!-- intansi wilayah -->
<script>
	// wilayah
	$(document).ready(function() {
		$("#instansi_wil").select2({
			ajax: {
				url: '<?= base_url() ?>Wilayah/getdatawil',
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
	// Provinsi
	$("#instansi_wil").change(function() {
		var wilayah_id = $("#instansi_wil").val();
		$("#instansi_prov").select2({
			ajax: {
				url: '<?= base_url() ?>Wilayah/getdataprov/' + wilayah_id,
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
	// Kabupaten
	$("#instansi_prov").change(function() {
		var id_prov = $("#instansi_prov").val();
		$("#instansi_kab").select2({
			ajax: {
				url: '<?= base_url() ?>Wilayah/getdatakab/' + id_prov,
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

<!-- tambah -->
<script>
	$(document).on("click", "#tombol_tambah", function() {
		if (validasi()) {
			let data = $('#formInstansi').serialize();
			$.ajax({
				type: 'POST',
				url: '<?= base_url('Instansi/TambahInstansiKunjungan'); ?>',
				data: data,
				success: function(response) {
					var data = JSON.parse(response);
					if (data.success) {
						Swal.fire({
							icon: 'success',
							title: 'Success',
							text: data.msg,
							showConfirmButton: false,
							timer: 1500
						});
					} else {
						Swal.fire({
							icon: 'error',
							title: 'Error',
							text: data.msg,
							showConfirmButton: true,
							timer: 2000
						});
					}
					setTimeout(() => {
						window.location.assign('<?= site_url("Visit/Tambah") ?>');
					}, 2000);
				}
			});
		}
	});

	function validasi() {
		let instansi_kategori = document.getElementById("instansi_kategori").value;
		let instansi_nama = document.getElementById("instansi_nama").value;
		let instansi_alamat = document.getElementById("instansi_alamat").value;
		let instansi_wil = document.getElementById("instansi_wil").value;
		let instansi_prov = document.getElementById("instansi_prov").value;
		let instansi_kab = document.getElementById("instansi_kab").value;
		if ((instansi_kategori == "") || (instansi_nama == "") || (instansi_alamat == "") || (instansi_wil == "") || (instansi_prov == "") || (instansi_kab == "")) {
			if (instansi_kab == "") {
				notif("Kabupaten");
			}
			if (instansi_prov == "") {
				notif("Provinsi");
			}
			if (instansi_wil == "") {
				notif("Wilayah");
			}
			if (instansi_alamat == "") {
				notif("Alamat Instansi");
			}
			if (instansi_nama == "") {
				notif("Nama Instansi");
			}
			if (instansi_kategori == "") {
				notif("Kategori Instansi");
			}
		} else {
			return true;
		}
	}
</script>

<!-- tambah kunjungan -->
<script>
	$(document).on("click", "#tombol_add", function() {
		if (validasi2()) {
			let data = $('#formTambahKunjungan').serialize();
			$.ajax({
				type: 'POST',
				url: '<?= base_url('Visit/TambahKunjungan'); ?>',
				data: data,
				success: function(response) {
					var data = JSON.parse(response);
					if (data.success) {
						Swal.fire({
							icon: 'success',
							title: 'Success',
							text: data.msg,
							showConfirmButton: false,
							timer: 1500
						});
					} else {
						Swal.fire({
							icon: 'error',
							title: 'Error',
							text: data.msg,
							showConfirmButton: true,
							timer: 2000
						});
					}
					setTimeout(() => {
						window.location.assign('<?= site_url("Visit") ?>');
					}, 2000);
				}
			});
		}
	});

	function validasi2() {
		let m_visit_prov = document.getElementById("m_visit_prov").value;
		let m_visit_kab = document.getElementById("m_visit_kab").value;
		let m_visit_instansi = document.getElementById("m_visit_instansi").value;
		let m_visit_agenda = document.getElementById("m_visit_agenda").value;
		let m_visit_jam_mulai = document.getElementById("m_visit_jam_mulai").value;
		let m_visit_jam_selesai = document.getElementById("m_visit_jam_selesai").value;
		let m_visit_tgl = document.getElementById("m_visit_tgl").value;
		let peserta_nama = document.getElementById("peserta_nama").value;
		let peserta_jabatan = document.getElementById("peserta_jabatan").value;
		let peserta_phone = document.getElementById("peserta_phone").value;
		let m_visit_note = document.getElementById("m_visit_note").value;
		let m_visit_anggaran_BUMN = document.getElementById("m_visit_anggaran_BUMN").value;
		let m_visit_prospek = document.getElementById("m_visit_prospek").value;
		let m_visit_prognosa = document.getElementById("m_visit_prognosa").value;
		let m_visit_estimasi_order = document.getElementById("m_visit_estimasi_order").value;
		let m_visit_estimasi_tahun = document.getElementById("m_visit_estimasi_tahun").value;
		let m_visit_status = document.getElementById("m_visit_status").value;
		let m_visit_koor_lat = document.getElementById("m_visit_koor_lat").value;
		let m_visit_koor_long = document.getElementById("m_visit_koor_long").value;
		if ((m_visit_prov == "") || (m_visit_kab == "") || (m_visit_instansi == "") || (m_visit_agenda == "") || (m_visit_jam_mulai == "") || (m_visit_jam_selesai == "") || (m_visit_tgl == "") || (peserta_nama == "") || (peserta_jabatan == "") || (peserta_phone == "") || (m_visit_note == "") || (m_visit_anggaran_BUMN == "") || (m_visit_prospek == "") || (m_visit_prognosa == "") || (m_visit_estimasi_order == "") || (m_visit_estimasi_tahun == "") || (m_visit_status == "") || (m_visit_koor_lat == "") || (m_visit_koor_long == "")) {
			if (m_visit_koor_long == "") {
				notif("Koordinat Long");
			}
			if (m_visit_koor_lat == "") {
				notif("Koordinat Lat");
			}
			if (m_visit_status == "") {
				notif("Status");
			}
			if (m_visit_estimasi_tahun == "") {
				notif("Estimasi Tahun");
			}
			if (m_visit_estimasi_order == "") {
				notif("Estimasi Order");
			}
			if (m_visit_prognosa == "") {
				notif("Prognosa");
			}
			if (m_visit_prospek == "") {
				notif("Prospek");
			}
			if (m_visit_anggaran_BUMN == "") {
				notif("APBN/P/D");
			}
			if (m_visit_note == "") {
				notif("Notulensi");
			}
			if (peserta_phone == "") {
				notif("Phone Peserta");
			}
			if (peserta_jabatan == "") {
				notif("Jabatan Peserta");
			}
			if (peserta_nama == "") {
				notif("Nama Peserta");
			}
			if (m_visit_tgl == "") {
				notif("Tanggal");
			}
			if (m_visit_jam_selesai == "") {
				notif("Jam Selesai");
			}
			if (m_visit_jam_mulai == "") {
				notif("Jam Mulai");
			}
			if (m_visit_agenda == "") {
				notif("Agenda");
			}
			if (m_visit_instansi == "") {
				notif("Instansi");
			}
			if (m_visit_kab == "") {
				notif("Kabupaten");
			}
			if (m_visit_prov == "") {
				notif("Provinsi");
			}
		} else {
			return true;
		}
	}
</script>

<!-- notif -->
<script>
	function notif(word) {
		Swal.fire({
			title: 'Perhatian',
			text: word + ' wajib di isi !',
			icon: 'info',
		}).then((result) => {})
	}
</script>

<script>
	if ($("#user-location").length) {
		var userLocation = L.map("user-location").setView([42.35, -71.08], 10);
		userLocation.locate({
			setView: true,
			maxZoom: 18,
		});

		function onLocationFound(e) {
			L.marker(e.latlng)
				.addTo(userLocation)
				.bindPopup("You this here <b><?= $this->session->userdata('username'); ?></b> from this location")
				.openPopup();
		}
		userLocation.on("locationfound", onLocationFound);
		L.tileLayer("https://{s}.tile.osm.org/{z}/{x}/{y}.png", {
			attribution: 'Map data &copy; <a href="#">Marak 2.0</a>',
			maxZoom: 18,
		}).addTo(userLocation);
	}
</script>

<script>
	$(document).ready(function(e) {
		$('.btn-add-new').click(function(e) {
			e.preventDefault();
			$('.repeater-wrapper').append(
				`<div class="row mt-2 remove">
					<div class="col-sm-12 mt-1 d-flex product-details-border position-relative pe-0">
						<div class="row w-100 pe-lg-0 pe-1 py-1">
							<div class="col-lg-4 col-12 mb-lg-0 mb-2 mt-lg-0 mt-2">
								<p class="card-text col-title mb-md-50 mb-0">Nama Peserta</p>
								<input type="text" class="form-control" id="peserta_nama" name="peserta_nama[]" placeholder="Nama Lengkap" />
							</div>
							<div class="col-lg-4 col-12 my-lg-0 my-2">
								<p class="card-text col-title mb-md-2 mb-0">Jabatan</p>
								<input type="text" class="form-control" id="peserta_jabatan" name="peserta_jabatan[]" placeholder="Nama Jabatan" />
							</div>
							<div class="col-lg-3 col-12 my-lg-0 my-2">
								<p class="card-text col-title mb-md-2 mb-0">Phone/Whatsapp</p>
								<input type="number" class="form-control" id="peserta_phone" name="peserta_phone[]" placeholder="+61 8123 456 789" />
							</div>
						</div>
						<div class="d-flex flex-column align-items-center justify-content-between border-start invoice-product-actions py-50 px-25">
							<i data-feather="x" class="cursor-pointer font-medium-3" data-repeater-delete></i>
						</div>
					</div>
				</div>`
			);
		});
	});

	$(document).on('click', '.invoice-product-actions', function(e) {
		e.preventDefault();
		$(this).parents('.remove').remove();
	});
</script>

<script>
	$(document).ready(function() {
		let m_visit_anggaran_BUMN = $('#m_visit_anggaran_BUMN');
		let m_visit_prospek = $('#m_visit_prospek');
		let m_visit_prognosa = $('#m_visit_prognosa');
		new Cleave(m_visit_anggaran_BUMN, {
			numeral: true,
			numeralThousandsGroupStyle: 'thousand'
		});
		new Cleave(m_visit_prospek, {
			numeral: true,
			numeralThousandsGroupStyle: 'thousand'
		});
		new Cleave(m_visit_prognosa, {
			numeral: true,
			numeralThousandsGroupStyle: 'thousand'
		});
	})
</script>

<?php $this->load->view('Components/v_bottom'); ?>