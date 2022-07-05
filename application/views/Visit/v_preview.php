<?php $this->load->view('Components/v_header'); ?>
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
		</div>
		<div class="content-body">
			<section class="invoice-preview-wrapper">
				<div class="row invoice-preview">
					<!-- Invoice -->
					<div class="col-xl-9 col-md-8 col-12">
						<div class="card invoice-preview-card">
							<div class="card-body invoice-padding pb-0">
								<!-- Header starts -->
								<div class="d-flex justify-content-between flex-md-row flex-column invoice-spacing mt-0">
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

							<hr class="invoice-spacing" />

							<!-- Address and Contact starts -->
							<div class="card-body invoice-padding pt-0">
								<div class="row invoice-spacing">
									<div class="col-xl-8 p-0">
										<h6 class="mb-2">Agenda :</h6>
										<h6 class="mb-25"><?= $data['m_visit_agenda']; ?></h6>
									</div>
									<div class="col-xl-4 p-0 mt-xl-0 mt-2">
										<table>
											<tbody>
												<tr>
													<td class="pe-1">Tanggal</td>
													<td>: <?= date('d F Y', strtotime($data['m_visit_tgl'])); ?></td>
												</tr>
												<tr>
													<td class="pe-1">Waktu</td>
													<td>: <?= $data['m_visit_jam_mulai']; ?> - <?= $data['m_visit_jam_selesai']; ?></td>
												</tr>
												<tr>
													<td class="pe-1">Marketing</td>
													<td>
														<span class="fw-bold">: <?= $data['name_user']; ?></span>
													</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>
							<!-- Address and Contact ends -->

							<!-- Invoice Description starts -->
							<div class="table-responsive">
								<table class="table">
									<thead>
										<tr>
											<th class="py-1">No</th>
											<th class="py-1">Nama Peserta</th>
											<th class="py-1">Jabatan Peserta</th>
											<th class="py-1">Phone Peserta</th>
										</tr>
									</thead>
									<tbody>
										<?php if (empty($peserta->result_array())) : ?>
											<tr class="border-bottom">
												<td colspan='3' class='text-center'>Data tidak ditemukan.</td>
											</tr>
										<?php else : ?>
											<?php
											$i = 1;
											foreach ($peserta->result_array() as $a) :
											?>
												<tr class="border-bottom">
													<td class="py-1"><?= $i++; ?></td>
													<td class="py-1">
														<p class="card-text fw-bold mb-25"><?= $a['peserta_nama']; ?></p>
													</td>
													<td class="py-1">
														<span class="fw-bold"><?= $a['peserta_jabatan']; ?></span>
													</td>
													<td class="py-1">
														<span class="fw-bold"><?= $a['peserta_phone']; ?></span>
													</td>
												</tr>
											<?php endforeach; ?>
										<?php endif; ?>
									</tbody>
								</table>
							</div>

							<div class="card-body invoice-padding pt-0">
								<div class="row invoice-spacing">
									<div class="col-xl-8 p-0">
										<table>
											<tbody>
												<tr>
													<td class="pe-1">APBN/P/D</td>
													<td><span>: <?= number_format($data['m_visit_anggaran_BUMN'], 0, '.', '.'); ?></span></td>
												</tr>
												<tr>
													<td class="pe-1">Prospek</td>
													<td>: <?= number_format($data['m_visit_prospek'], 0, '.', '.'); ?></td>
												</tr>
												<tr>
													<td class="pe-1">Prognosa</td>
													<td>: <?= number_format($data['m_visit_prognosa'], 0, '.', '.'); ?></td>
												</tr>
												<tr>
													<td class="pe-1">Close PO</td>
													<td>: <?= number_format($data['m_visit_po'], 0, '.', '.'); ?></td>
												</tr>

											</tbody>
										</table>
									</div>
									<div class="col-xl-4 p-0 mt-xl-0 mt-2">
										<table>
											<tbody>
												<tr>
													<td class="pe-1">Estimasi Order</td>
													<td><span class="fw-bold">: <?= $data['m_visit_estimasi_order']; ?></span></td>
												</tr>
												<tr>
													<td class="pe-1">Estimasi Tahun</td>
													<td>: <?= $data['m_visit_estimasi_tahun']; ?></td>
												</tr>
												<tr>
													<td class="pe-1">Status</td>
													<?php if ($data['m_visit_status'] == "Close Po") : ?>
														<td>
															<span class="badge rounded-pill badge-light-danger me-1"><?= $data['m_visit_status']; ?></span>
														</td>
													<?php elseif ($data['m_visit_status'] == "Prognosa") : ?>
														<td>
															<span class="badge rounded-pill badge-light-warning me-1"><?= $data['m_visit_status']; ?></span>
														</td>
													<?php else : ?>
														<td>
															<span class="badge rounded-pill badge-light-primary me-1"><?= $data['m_visit_status']; ?></span>
														</td>
													<?php endif; ?>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>
							<!-- Invoice Description ends -->

							<hr class="invoice-spacing" />

							<!-- Invoice Note starts -->
							<div class="card-body invoice-padding pt-0">
								<div class="row">
									<div class="col-12">
										<span class="fw-bold">Notulensi</span>
										<span>: <?= $data['m_visit_note']; ?></span>
									</div>
								</div>
							</div>
							<!-- Invoice Note ends -->

							<hr class="invoice-spacing" />
							<div class="card-body invoice-padding pt-0">
								<div class="row">
									<div class="col-12">
										<div class="leaflet-map" id="user-location" style="height: 150px; border-radius:5px;"></div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- /Invoice -->

					<!-- Invoice Actions -->
					<div class="col-xl-3 col-md-4 col-12 invoice-actions mt-md-0 mt-2">
						<div class="card">
							<div class="card-body">
								<a href="<?= base_url('Visit'); ?>" class="btn btn-primary w-100 mb-75"> Back</a>
								<?php if ($this->session->userdata('role_user') == 1) : ?>
									<a class="btn btn-outline-secondary w-100 mb-75" href="<?= base_url('Visit/Edit/') . $data['m_visit_history_id']; ?>"> Edit </a>
								<?php endif; ?>
								<a class="btn btn-success w-100" href="<?= base_url('Visit/ViewUpdate/') . $data['m_visit_id']; ?>"> Update Kunjungan </a>
							</div>
						</div>
					</div>
					<!-- /Invoice Actions -->
				</div>
			</section>

		</div>
	</div>
</div>
<!-- END: Content-->

<?php $this->load->view('Components/v_footer'); ?>
<script src="<?= base_url('assets'); ?>/vendors/js/maps/leaflet.min.js"></script>
<script>
	$(document).ready(function() {
		let long = <?= str_replace(",", ".", $data['m_visit_koor_long']); ?>;
		let lat = <?= str_replace(",", ".", $data['m_visit_koor_lat']); ?>;
		let userLocation = L.map("user-location").setView([lat, long], 13);
		userLocation.locate({
			setView: true,
			maxZoom: 18,
		});

		L.marker([lat, long])
			.addTo(userLocation)
			.bindPopup("Titik kunjungan <b><?= $data['name_user']; ?></b>")
			.openPopup();

		L.tileLayer("https://{s}.tile.osm.org/{z}/{x}/{y}.png", {
			attribution: 'Map data &copy; <a href="#">Marak 2.0</a>',
			maxZoom: 18,
		}).addTo(userLocation);
	})
</script>
<?php $this->load->view('Components/v_bottom'); ?>