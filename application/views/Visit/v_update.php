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
				<form method="POST" id="formUpdateKunjungan">
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
													<input type="hidden" name="id" value="<?= $data['m_visit_id']; ?>">
													<input type="hidden" name="m_visit_instansi" value="<?= $data['m_visit_instansi']; ?>">
													<input type="hidden" name="m_visit_prov" value="<?= $data['m_visit_prov']; ?>">
													<input type="hidden" name="m_visit_kab" value="<?= $data['m_visit_kab']; ?>">
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
								<div class="card-body invoice-padding pt-0">
									<button type="button" class="btn btn-outline-secondary btn-sm btn-add-new mb-1" id="addpeserta">
										<i data-feather="plus" class="me-25"></i>
										<span class="align-middle">Add Column Peserta</span>
									</button>
									<div class="table-responsive">
										<small class="text-muted"><i><span class="text-danger">*</span> Tambahkan kolom input peserta sesuai dengan jumlah peserta</i></small>
										<table class="table">
											<thead>
												<tr>
													<th>Nama Peserta</th>
													<th>Jabatan Peserta</th>
													<th>Phone Peserta</th>
													<th>Actions</th>
												</tr>
											</thead>
											<tbody id="viewpeserta">
												<?php if (empty($peserta->result_array())) : ?>
													<tr class="border-bottom">
														<td colspan='4' class='text-center'>Data tidak ditemukan.</td>
													</tr>
												<?php else : ?>
													<?php
													foreach ($peserta->result_array() as $a) :
													?>
														<tr>
															<td>
																<input type="text" value="<?= $a['peserta_nama']; ?>" class="form-control" id="peserta_nama" name="peserta_nama[]">
																<input type="hidden" value="<?= $a['id_peserta']; ?>" id="id_peserta" name="id_peserta[]">
															</td>
															<td>
																<input type="text" value="<?= $a['peserta_jabatan']; ?>" class="form-control" id="peserta_jabatan" name="peserta_jabatan[]">
															</td>
															<td>
																<input type="text" value="<?= $a['peserta_phone']; ?>" class="form-control" id="peserta_phone" name="peserta_phone[]">
															</td>
															<td>
																<button type="button" class="btn btn-sm btn-icon btn-icon rounded-circle btn-flat-success">
																	<i data-feather="check"></i>
																</button>
															</td>
														</tr>
													<?php endforeach; ?>
												<?php endif; ?>
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
														<option value="<?= $data['m_visit_estimasi_order']; ?>"><?= $data['m_visit_estimasi_order']; ?></option>
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
									<a href="<?= base_url('Visit/Preview/' . $data['m_visit_history_id']); ?>" class="btn btn-outline-primary w-100" type="button">Cancle</a>
								</div>
							</div>
						</div>
						<!-- Invoice Add Right ends -->
					</div>
				</form>
			</section>
			<!-- history kunjungan -->
			<div class="card">
				<div class="card-header">
					<h4 class="card-title">History Kunjungan "<b><?= $data['instansi_nama']; ?></b>"</h4>
				</div>
				<div class="card-body">
					<div class="card-datatable">
						<table class="table table-hover table-borderless" id="mytable" width="100%">
							<thead>
								<tr>
									<th>No</th>
									<th>History</th>
									<th>Date</th>
									<th>Instansi</th>
									<th>Agenda</th>
									<th>Status</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
								<?php if (empty($history->result_array())) : ?>
									<tr class="border-bottom">
										<td colspan='7' class='text-center'>Data tidak ditemukan.</td>
									</tr>
								<?php else : ?>
									<?php
									$i = 1;
									foreach ($history->result_array() as $k) :
									?>
										<tr>
											<td><?= $i++; ?></td>
											<td><?= $k['m_visit_history'] ?></td>
											<td><?= $k['m_visit_tgl'] ?></td>
											<td><?= $k['instansi_nama'] ?></td>
											<td><?= $k['m_visit_agenda'] ?></td>
											<td>
												<?php if ($k['m_visit_status'] == "Close Po") : ?>
													<span class="badge rounded-pill badge-light-danger me-1"><?= $k['m_visit_status']; ?></span>
												<?php elseif ($k['m_visit_status'] == "Prognosa") : ?>
													<span class="badge rounded-pill badge-light-warning me-1"><?= $k['m_visit_status']; ?></span>
												<?php else : ?>
													<span class="badge rounded-pill badge-light-primary me-1"><?= $k['m_visit_status']; ?></span>
												<?php endif; ?>
											</td>
											<td>
												<a href="#" type="button" class="btn btn-flat-warning btn-sm PreviewHistory" data-id="<?= $k['m_visit_history_id']; ?>" data-bs-toggle="modal" data-bs-target="#referEarnModal">Preview</a>
											</td>

										</tr>
									<?php endforeach; ?>
								<?php endif; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>

		</div>
	</div>
</div>
<!-- END: Content-->
<!-- peserta modal -->
<div class="modal fade" id="referEarnModal" tabindex="-1" aria-labelledby="referEarnTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-lg modal-refer-earn">
		<div class="modal-content">
			<div class="modal-header bg-transparent">
				<button type="button" class="btn-close closePreview" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-sm-12">
						<h1 class="text-center mb-1" id="m_visit_instansi">Nama Dinas not found</h1>
						<p class="text-center">
							<span id="instansi_alamat">alamat not found</span>
							<br />
							<span id="kab_nama">Kabupaten not found</span>, <span id="prov_nama">Provinsi not found</span>
						</p>
					</div>
				</div>
				<hr />

				<div class="row mb-2">
					<div class="col-sm-7">
						<h6>Agenda :</h6>
						<span class="mb-2" id="agenda_isi">nama agenda not found</span>
					</div>
					<div class="col-xl-4 mt-xl-0 mt-2">
						<table>
							<tbody>
								<tr>
									<td class="pe-1">Tanggal</td>
									<td>: <span id="tgl">YYY:MM:DD</span></td>
								</tr>
								<tr>
									<td class="pe-1">Waktu</td>
									<td>: <span id="jam_start"></span> - <span id="jam_end"></span></td>
								</tr>
								<tr>
									<td class="pe-1">Marketing</td>
									<td>
										<span class="fw-bold">: <span id="userMkt">Nama Marketing not found</span></span>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>

				<div class="table-responsive mb-2">
					<table class="table">
						<thead>
							<tr>
								<th>No</th>
								<th>Nama Peserta</th>
								<th>Jabatan Peserta</th>
								<th>Phone Peserta</th>
							</tr>
						</thead>
						<tbody id="tampil">
							<tr>
								<td colspan='4' class="text-center">
									<form method="POST" id="formtampilPeserta">
										<input type="hidden" id="pesertaId" name="pesertaId">
										<a href="#" type="button" class="btn btn-sm btn-primary" id="button-peserta">Tampilkan Data Peserta</a>
									</form>
								</td>
							</tr>
						</tbody>
					</table>
				</div>

				<div class="row mb-2">
					<div class="col-sm-4">
						<table>
							<tbody>
								<tr>
									<td class="pe-1">APBN/P/D</td>
									<td>: <span id="apbn">0000</span></td>
								</tr>
								<tr>
									<td class="pe-1">Prospek</td>
									<td>: <span id="prospek">0000</span></td>
								</tr>
							</tbody>
						</table>
					</div>
					<div class="col-sm-4">
						<table>
							<tbody>
								<tr>
									<td class="pe-1">Prognosa</td>
									<td>: <span id="prognosa">0000</span></td>
								</tr>
								<tr>
									<td class="pe-1">Close PO</td>
									<td>: <span id="closepo">0000</span></td>
								</tr>
							</tbody>
						</table>
					</div>
					<div class="col-sm-4">
						<table>
							<tbody>
								<tr>
									<td class="pe-1">Estimasi Order</td>
									<td>: <span class="fw-bold" id="esorder"></span></td>
								</tr>
								<tr>
									<td class="pe-1">Estimasi Tahun</td>
									<td>: <span id="esthn">0000</span></td>
								</tr>
								<tr>
									<td class="pe-1">Status</td>
									<td>
										<span id="status_kunjungan"></span>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
				<hr>
				<div class="row mb-2">
					<div class="col-12">
						<span class="fw-bold">Notulensi</span>
						:<span id="noted"></span>
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="col-12">
						<div class="leaflet-map" id="modal-user-location" style="height: 150px; border-radius:5px;"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- / refer and earn modal -->

<?php $this->load->view('Components/v_footer'); ?>

<script src="<?= base_url('assets'); ?>/vendors/js/forms/repeater/jquery.repeater.min.js"></script>
<script src="<?= base_url('assets'); ?>/vendors/js/forms/select/select2.full.min.js"></script>
<script src="<?= base_url('assets'); ?>/vendors/js/pickers/flatpickr/flatpickr.min.js"></script>
<script src="<?= base_url('assets'); ?>/vendors/js/maps/leaflet.min.js"></script>
<script src="<?= base_url('assets'); ?>/js/scripts/pages/app-invoice.js"></script>
<script src="<?= base_url('assets'); ?>/js/geolocation.js"></script>
<script src="<?= base_url('assets'); ?>/js/geo-min.js"></script>
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

<script>
	var quill = new Quill('#editor', {
		theme: 'snow'
	});

	quill.on('text-change', function(delta, oldDelta, source) {
		document.querySelector("input[name='m_visit_note']").value = quill.root.innerHTML;
	});
</script>

<!-- tambah kunjungan -->
<script>
	$(document).on("click", "#tombol_add", function() {
		if (validasi2()) {
			let data = $('#formUpdateKunjungan').serialize();
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
	if (geo_position_js.init()) {
		geo_position_js.getCurrentPosition(success_callback, error_callback, {
			enableHighAccuracy: true
		});
	} else {
		alert("Functionality not available");
	}

	function success_callback(p) {
		if ($("#user-location").length) {
			var userLocation = L.map("user-location").setView([p.coords.latitude.toFixed(2), p.coords.longitude.toFixed(2)], 10);
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
	}

	function error_callback(p) {
		Swal.fire({
			icon: 'error',
			title: 'GPS Tidak Aktif',
			text: p.message,
		});
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
	$(document).on("click", ".closePreview", function() {
		let tampilPeserta = "";
		tampilPeserta += '<tr>' +
			'<td colspan="4" class="text-center">' +
			'<form method="POST" id="formtampilPeserta">' +
			'<input type="hidden" id="pesertaId" name="pesertaId">' +
			'<a href="#" type="button" class="btn btn-sm btn-primary" id="button-peserta">Tampilkan Data Peserta</a>' +
			'</form>' +
			'</td>' +
			'</tr>'
		$('#tampil').html(tampilPeserta);
	});
</script>

<script>
	$(document).on("click", ".PreviewHistory", function() {
		let id = $(this).data('id');
		no = 1;
		html = '';
		$.ajax({
			type: 'POST',
			url: '<?= site_url('Visit/ViewModalHistoryKunjungan') ?>',
			data: {
				id: id
			},
			success: function(response) {
				let data = JSON.parse(response);
				if (data.success) {
					document.getElementById('m_visit_instansi').innerText = data.m_visit_instansi;
					document.getElementById('instansi_alamat').innerText = data.instansi_alamat;
					document.getElementById('kab_nama').innerText = data.kab_nama;
					document.getElementById('prov_nama').innerText = data.prov_nama;
					document.getElementById('agenda_isi').innerText = data.m_visit_agenda;
					document.getElementById('tgl').innerText = data.m_visit_tgl;
					document.getElementById('jam_start').innerText = data.m_visit_jam_mulai;
					document.getElementById('jam_end').innerText = data.m_visit_jam_selesai;
					document.getElementById('userMkt').innerText = data.name_user;
					document.getElementById('pesertaId').value = data.m_visit_history_id;
					document.getElementById('apbn').innerText = data.m_visit_anggaran_BUMN;
					document.getElementById('prospek').innerText = data.m_visit_prospek;
					document.getElementById('prognosa').innerText = data.m_visit_prognosa;
					document.getElementById('closepo').innerText = data.m_visit_po;
					document.getElementById('esorder').innerText = data.m_visit_estimasi_order;
					document.getElementById('esthn').innerText = data.m_visit_estimasi_tahun;
					document.getElementById('noted').innerHTML = data.m_visit_note;
					if (data.m_visit_status == "Prospek") {
						html = '<span class="badge rounded-pill badge-light-primary me-1">' + data.m_visit_status + '</span>';
						document.getElementById('status_kunjungan').innerHTML = html;
					} else if (data.m_visit_status == "Prognosa") {
						html = '<span class="badge rounded-pill badge-light-warning me-1">' + data.m_visit_status + '</span>';
						document.getElementById('status_kunjungan').innerHTML = html;
					} else {
						html = '<span class="badge rounded-pill badge-light-danger me-1">' + data.m_visit_status + '</span>';
						document.getElementById('status_kunjungan').innerHTML = html;
					}

					let userLocation1 = L.map("modal-user-location").setView([data.m_visit_koor_lat, data.m_visit_koor_long], 13);
					userLocation1.locate({
						setView: true,
						maxZoom: 18,
					});

					L.marker([data.m_visit_koor_lat, data.m_visit_koor_long])
						.addTo(userLocation1)
						.bindPopup("Titik Input <b>" + data.name_user + "</b>")
						.openPopup();

					L.tileLayer("https://{s}.tile.osm.org/{z}/{x}/{y}.png", {
						attribution: 'Map data &copy; <a href="#">Marak 2.0</a>',
						maxZoom: 18,
					}).addTo(userLocation1);

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

	$(document).on("click", "#button-peserta", function() {
		let pesertaId = $('#formtampilPeserta').serialize();
		let tampilPeserta = "";
		no = 1;
		$.ajax({
			type: "post",
			url: "<?= site_url('Visit/viewPesertaTable'); ?>",
			data: pesertaId,
			success: function(response) {
				let data = JSON.parse(response);
				if (data.rows == "") {
					tampilPeserta += '<tr>' +
						'<td colspan="4" class="text-center"> Data tidak ditemukan </td>' +
						'</tr>'
				} else {
					for (i = 0; i < data.rows.length; i++) {
						tampilPeserta += '<tr>' +
							'<td>' + [no++] + '</td>' +
							'<td>' + data.rows[i].peserta_nama + '</td>' +
							'<td>' + data.rows[i].peserta_jabatan + '</td>' +
							'<td>' + data.rows[i].peserta_phone + '</td>' +
							'</tr>'
					}
				}
				$('#tampil').html(tampilPeserta);
			}
		});

	})
</script>

<script>
	$(document).ready(function(e) {
		$('.btn-add-new').click(function(e) {
			e.preventDefault();
			$('#viewpeserta').append(
				`<tr class="remove">
				<td>
					<input type="hidden" id="id_peserta" name="id_peserta[]">
					<input type="text" class="form-control" id="peserta_nama" name="peserta_nama[]" placeholder="Nama Lengkap">
				</td>
				<td>
					<input type="text" class="form-control" id="peserta_jabatan" name="peserta_jabatan[]" placeholder="Nama Jabatan Lengkap">
				</td>
				<td>
					<input type="text" class="form-control" id="peserta_phone" name="peserta_phone[]" placeholder="+62 8123 456 789">
				</td>
				<td>
					<button type="button" class="btn x btn-sm btn-icon btn-icon rounded-circle btn-danger">
						<i data-feather="x"></i>
					</button>
				</td>
			</tr>`
			);
		})
	})

	$(document).on('click', '.x', function(e) {
		e.preventDefault();
		$(this).parents('.remove').remove();
	});
</script>
<?php $this->load->view('Components/v_bottom'); ?>