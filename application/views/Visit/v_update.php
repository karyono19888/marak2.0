<?php $this->load->view('Components/v_header'); ?>
<link rel="stylesheet" type="text/css" href="<?= base_url('assets'); ?>/vendors/css/pickers/flatpickr/flatpickr.min.css">
<link rel="stylesheet" type="text/css" href="<?= base_url('assets'); ?>/css/components.css">
<link rel="stylesheet" type="text/css" href="<?= base_url('assets'); ?>/css/plugins/forms/pickers/form-flat-pickr.css">
<link rel="stylesheet" type="text/css" href="<?= base_url('assets'); ?>/css/pages/app-invoice.css">
<link rel="stylesheet" type="text/css" href="<?= base_url('assets'); ?>/vendors/css/maps/leaflet.min.css">
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
						<h2 class="content-header-title float-start mb-0">Update Kunjungan</h2>
						<div class="breadcrumb-wrapper">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="#">Data Kunjungan</a>
								</li>
								<li class="breadcrumb-item active">Update Kunjungan
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
								<div class="card-body invoice-padding pb-0">
									<!-- Header starts -->
									<div class="d-flex justify-content-start flex-md-row flex-column invoice-spacing mt-0">
										<div class="col-sm-7">
											<div class="logo-wrapper">
												<img src="<?= base_url('assets'); ?>/images/logo/logo.png" alt="logo-brand" width="10%">
												<h3 class="text-primary invoice-logo">Marak</h3>
											</div>
											<p class="card-text mb-25"><b><?= $data['instansi_nama']; ?></b></p>
											<p class="card-text mb-25"><?= $data['instansi_alamat']; ?></p>
											<p class="card-text mb-0"><?= $data['kab_nama']; ?>, <?= $data['prov_nama']; ?></p>
										</div>
									</div>
									<!-- Header ends -->
								</div>
								<hr class="invoice-spacing mt-0" />

								<!-- Address and Contact starts -->
								<div class="card-body invoice-padding pt-0">
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
								<div class="card-body">
									<button type="button" class="btn btn-outline-secondary btn-sm btn-add-new mb-1" data-bs-toggle="modal" data-bs-target="#add-new-peserta-sidebar" id="addpeserta">
										<i data-feather="plus" class="me-25"></i>
										<span class="align-middle">Add Peserta</span>
									</button>
									<div class="table-responsive">
										<table class="table">
											<thead>
												<tr>
													<th>#</th>
													<th>Nama Peserta</th>
													<th>Jabatan Peserta</th>
													<th>Phone Peserta</th>
													<th>Actions</th>
												</tr>
											</thead>
											<tbody>
												<?php
												$i = 1;
												foreach ($peserta->result_array() as $a) :
												?>
													<tr>
														<td><?= $i++; ?></td>
														<td>
															<?= $a['peserta_nama']; ?>
														</td>
														<td>
															<?= $a['peserta_jabatan']; ?>
														</td>
														<td>
															<?= $a['peserta_phone']; ?>
														</td>
														<td>
															<button type="button" class="btn btn-sm btn-flat-warning EditPeserta" data-bs-toggle="modal" data-bs-target="#add-new-peserta-sidebar" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit" data-id="<?= $a['id_peserta']; ?>">
																<i data-feather="edit-2" class="me-20"></i>
															</button>
															<a class="btn btn-sm btn-flat-danger Delete" href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete" data-id="<?= $a['id_peserta']; ?>">
																<i data-feather="trash" class="me-20"></i>
															</a>
														</td>
													</tr>
												<?php endforeach; ?>
											</tbody>
										</table>
									</div>
								</div>
								<!-- Product Details ends -->

								<!-- apbn -->
								<div class="card-body invoice-padding py-0">
									<!-- Invoice Note starts -->
									<div class="row">
										<div class="col-12">
											<div class="my-2">
												<label for="m_visit_note" class="form-label fw-bold">Notulensi</label>
												<textarea class="form-control" rows="3" id="m_visit_note" name="m_visit_note"></textarea>
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
													<input type="text" class="form-control numeral-mask" maxlength="7" id="m_visit_anggaran_BUMN" name="m_visit_anggaran_BUMN" placeholder=" 000.000" value="<?= $data['m_visit_anggaran_BUMN']; ?>" />
												</div>
											</div>
										</div>
										<div class="col-xl-3 col-sm-6 col-12">
											<div class="mb-1">
												<label class="form-label" for="m_visit_prospek">Prospek</label>
												<small class="text-muted"><i>Satuan Jutaan</i></small>
												<div class="input-group input-group-merge mb-2">
													<span class="input-group-text" id="basic-addon-search2">Rp</span>
													<input type="text" class="form-control numeral-mask" maxlength="7" id="m_visit_prospek" name="m_visit_prospek" placeholder=" 000.000" value="<?= $data['m_visit_prospek']; ?>" />
												</div>
											</div>
										</div>
										<div class="col-xl-3 col-sm-6 col-12">
											<div class="mb-1">
												<label class="form-label" for="m_visit_prognosa">Prognosa</label>
												<small class="text-muted"><i>Satuan Jutaan</i></small>
												<div class="input-group input-group-merge mb-2">
													<span class="input-group-text" id="basic-addon-search2">Rp</span>
													<input type="text" class="form-control numeral-mask" maxlength="7" id="m_visit_prognosa" name="m_visit_prognosa" placeholder=" 000.000" value="<?= $data['m_visit_prognosa']; ?>" />
												</div>
											</div>
										</div>
										<div class="col-xl-3 col-sm-6 col-12">
											<div class="mb-1">
												<label class="form-label" for="m_visit_po">Close PO</label>
												<small class="text-muted"><i>Satuan Jutaan</i></small>
												<div class="input-group input-group-merge mb-2">
													<span class="input-group-text" id="basic-addon-search2">Rp</span>
													<input type="text" class="form-control numeral-mask" id="m_visit_po" name="m_visit_po" placeholder=" 000.000" value="<?= $data['m_visit_po']; ?>" readonly />
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
													<option value="<?= $data['m_visit_status']; ?>"><?= $data['m_visit_status']; ?></option>
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
									<button class="btn btn-primary w-100 mb-75" id="tombol_add" type="button">Update</button>
									<a href="<?= base_url('Visit/Preview/' . $data['m_visit_id']); ?>" class="btn btn-outline-primary w-100" type="button">Cancle</a>
								</div>
							</div>
						</div>
						<!-- Invoice Add Right ends -->
					</div>
				</form>
				<!-- Add New peserta Sidebar -->
				<div class="modal modal-slide-in fade" id="add-new-peserta-sidebar" aria-hidden="true">
					<div class="modal-dialog sidebar-lg">
						<div class="modal-content p-0">
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
							<div class="modal-header mb-1">
								<h5 class="modal-title">
									<span class="align-middle" id="judulAdd">Add Peserta</span>
									<span class="align-middle" id="judulEdit">Edit Peserta</span>
								</h5>
							</div>
							<div class="modal-body flex-grow-1">
								<form method="POST" id="formPeserta">
									<div class="mb-1">
										<label for="peserta_nama" class="form-label">Nama Peserta</label>
										<input type="text" class="form-control" id="peserta_nama" name="peserta_nama" placeholder="Nama Peserta lengkap" />
									</div>
									<div class="mb-1 position-relative">
										<label for="peserta_jabatan" class="form-label">Jabatan Peserta</label>
										<input type="text" class="form-control" id="peserta_jabatan" name="peserta_jabatan" placeholder="Nama Jabatan Peserta" />
									</div>
									<div class="mb-1 position-relative">
										<label for="peserta_phone" class="form-label">Phone Peserta</label>
										<input type="number" class="form-control" id="peserta_phone" name="peserta_phone" placeholder="+62 812 3456 7890" />
										<input type="hidden" value="<?= $data['m_visit_id']; ?>" id="m_visit_id" name="m_visit_id">
										<input type="hidden" value="<?= $data['m_visit_history_id']; ?>" id="m_visit_history_id" name="m_visit_history_id">
										<input type="hidden" value="<?= $data['m_visit_user_id']; ?>" id="m_visit_user_id" name="m_visit_user_id">
										<input type="hidden" id="id_peserta" name="id_peserta">
									</div>
									<div class="mb-1 d-flex flex-wrap mt-2">
										<button type="button" class="btn btn-primary me-1" id="tombol_tambah_peserta">Add</button>
										<button type="button" class="btn btn-warning me-1" id="tombol_edit_peserta">Edit</button>
										<button type="button" class="btn btn-outline-secondary Cancle" data-bs-dismiss="modal">Cancel</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<!-- /Add New peserta Sidebar -->
			</section>
			<!-- Dashboard Ecommerce ends -->
			<div class="card">
				<div class="card-header">
					<h4 class="card-title">History Kunjungan "<b><?= $data['instansi_nama']; ?></b>"</h4>
				</div>
				<div class="card-body">
					<div class="card-datatable">
						<table class="table table-hover table-borderless" id="mytable" width="100%">
							<thead>
								<tr>
									<th>#</th>
									<th>User</th>
									<th>Date</th>
									<th>Instansi</th>
									<th>Agenda</th>
									<th>Status</th>
									<th>Actions</th>
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
<script src="//cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script>
	$(document).ready(function() {
		$('#mytable').DataTable();
	});
	let timePickr = $('.flatpickr-time');
	if (timePickr.length) {
		timePickr.flatpickr({
			enableTime: true,
			noCalendar: true
		});
	}
</script>


<!-- tambah kunjungan -->
<script>
	$(document).on("click", "#tombol_add", function() {
		if (validasi2()) {
			let data = $('#formTambahKunjungan').serialize();
			$.ajax({
				type: 'POST',
				url: '<?= base_url('Visit/UpdateKunjungan'); ?>',
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
		let m_visit_agenda = document.getElementById("m_visit_agenda").value;
		let m_visit_jam_mulai = document.getElementById("m_visit_jam_mulai").value;
		let m_visit_jam_selesai = document.getElementById("m_visit_jam_selesai").value;
		let m_visit_tgl = document.getElementById("m_visit_tgl").value;
		let m_visit_note = document.getElementById("m_visit_note").value;
		let m_visit_anggaran_BUMN = document.getElementById("m_visit_anggaran_BUMN").value;
		let m_visit_prospek = document.getElementById("m_visit_prospek").value;
		let m_visit_prognosa = document.getElementById("m_visit_prognosa").value;
		let m_visit_estimasi_order = document.getElementById("m_visit_estimasi_order").value;
		let m_visit_estimasi_tahun = document.getElementById("m_visit_estimasi_tahun").value;
		let m_visit_status = document.getElementById("m_visit_status").value;
		let m_visit_koor_lat = document.getElementById("m_visit_koor_lat").value;
		let m_visit_koor_long = document.getElementById("m_visit_koor_long").value;
		if ((m_visit_agenda == "") || (m_visit_jam_mulai == "") || (m_visit_jam_selesai == "") || (m_visit_tgl == "") || (m_visit_note == "") || (m_visit_anggaran_BUMN == "") || (m_visit_prospek == "") || (m_visit_prognosa == "") || (m_visit_estimasi_order == "") || (m_visit_estimasi_tahun == "") || (m_visit_status == "") || (m_visit_koor_lat == "") || (m_visit_koor_long == "")) {
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

<script>
	$(document).on("click", "#tombol_edit_peserta", function() {
		if (validasipeserta()) {
			let data = $('#formPeserta').serialize();
			$.ajax({
				type: 'POST',
				url: '<?= base_url('Visit/EditPeserta'); ?>',
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
						window.location.assign('<?= site_url("Visit/ViewUpdate/" . $data['m_visit_id']); ?>');
					}, 2000);
				}
			});
		}
	});
</script>

<!-- add modal -->
<script>
	$(document).on("click", "#addpeserta", function() {
		$('#judulAdd').show();
		$('#tombol_tambah_peserta').show();
		$('#judulEdit').hide();
		$('#tombol_edit_peserta').hide();
	});
	$(document).on("click", "#tombol_tambah_peserta", function() {
		if (validasipeserta()) {
			let data = $('#formPeserta').serialize();
			$.ajax({
				type: 'POST',
				url: '<?= base_url('Visit/TambahPeserta'); ?>',
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
						window.location.assign('<?= site_url("Visit/ViewUpdate/" . $data['m_visit_id']); ?>');
					}, 2000);
				}
			});
		}
	});

	function validasipeserta() {
		let peserta_nama = document.getElementById("peserta_nama").value;
		let peserta_jabatan = document.getElementById("peserta_jabatan").value;
		let peserta_phone = document.getElementById("peserta_phone").value;
		if ((peserta_nama == "") || (peserta_jabatan == "") || (peserta_phone == "")) {
			if (peserta_phone == "") {
				notif("Phone Peserta");
			}
			if (peserta_jabatan == "") {
				notif("Jabatan Peserta");
			}
			if (peserta_nama == "") {
				notif("Nama Peserta");
			}
		} else {
			return true;
		}
	}
</script>

<!-- hapus peserta -->
<script>
	$(document).on("click", ".Delete", function() {
		let id = $(this).data('id');
		Swal.fire({
			title: 'Are you sure?',
			text: "Hapus Permanent Data!",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Yes, delete it!'
		}).then((result) => {
			if (result.isConfirmed) {
				$.ajax({
					type: 'POST',
					url: '<?= site_url('Visit/DeletePeserta') ?>',
					data: {
						id: id
					},
					success: function(response) {
						let data = JSON.parse(response);
						if (data.success) {
							SweetAlert.fire({
								icon: 'success',
								title: 'Deleted!',
								text: data.msg,
								showConfirmButton: false,
								timer: 1500
							});
						} else {
							SweetAlert.fire({
								icon: 'error',
								title: 'Error',
								text: data.msg,
								showConfirmButton: false,
								timer: 1500
							});
						}
						setTimeout(() => {
							window.location.assign('<?= site_url("Visit/ViewUpdate/" . $data['m_visit_id']); ?>');
						}, 1500);
					}
				});
			}
		})
	});
</script>

<!-- edit view -->
<script>
	$(document).on("click", ".EditPeserta", function() {
		$('#judulAdd').hide();
		$('#tombol_tambah_peserta').hide();
		$('#judulEdit').show();
		$('#tombol_edit_peserta').show();
		let id = $(this).data('id');
		$.ajax({
			type: 'POST',
			url: '<?= site_url('Visit/ViewPeserta') ?>',
			data: {
				id: id
			},
			success: function(response) {
				let data = JSON.parse(response);
				if (data.success) {
					$('#id_peserta').val(data.id_peserta);
					$('#peserta_nama').val(data.peserta_nama);
					$('#peserta_jabatan').val(data.peserta_jabatan);
					$('#peserta_phone').val(data.peserta_phone);
				} else {
					Swal.fire({
						icon: 'warning',
						title: 'Warning',
						text: data.msg,
						showConfirmButton: false,
						timer: 1500
					});
				}
			}
		});
	});
</script>

<script>
	$(document).on("click", ".Cancle", function() {
		$('#peserta_nama').val("");
		$('#peserta_jabatan').val("");
		$('#peserta_phone').val("");
	});
</script>

<?php $this->load->view('Components/v_bottom'); ?>