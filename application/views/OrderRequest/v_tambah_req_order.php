<div class="row">
	<div class="col-sm-9">
		<div class="card">
			<div class="card-header">
				<h4 class="card-title"><b>Permintaan Close Order</b></h4>
			</div>
			<div class="card-body">
				<form action="" method="post">
					<div class="row">
						<div class="col-sm-8">
							<h6 class="mb-2">Ordering from:</h6>
							<h6 class="mb-25"><?= $data['instansi_nama']; ?></h6>
							<p class="card-text mb-25"><?= $data['instansi_alamat']; ?></p>
							<table class="mt-2">
								<tbody>
									<tr>
										<td class="pe-1">ID Paket</td>
										<td><input type="text" class="form-control" placeholder="APJ-****-******"></td>
									</tr>
									<tr>
										<td class="pe-1">Client</td>
										<td>
											<select class="form-select select2" id="tahun" name="tahun">
												<option value="">- Pilih -</option>
												<option value="E-catalog">E-catalog</option>
												<option value="Non E-catalog">Non E-catalog</option>
											</select>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="col-sm-4 mt-2">
							<h6 class="mb-2">Details:</h6>
							<table>
								<tbody>
									<tr>
										<td class="pe-1">Order Date</td>
										<td><input type="date" class="form-control"></td>
									</tr>
									<tr>
										<td class="pe-1">Jenis Order</td>
										<td>
											<select class="form-select select2" id="tahun" name="tahun">
												<option value="">- Pilih -</option>
												<option value="E-catalog">E-catalog</option>
												<option value="Non E-catalog">Non E-catalog</option>
											</select>
										</td>
									</tr>
									<tr>
									<tr>
										<td class="pe-1">Sales Person</td>
										<td>: <b><?= $this->session->userdata('name_user'); ?></b></td>
									</tr>
									<tr>
										<td class="pe-1">Division</td>
										<td>: Marketing</td>
									</tr>
									<tr>
										<td class="pe-1">Order</td>
										<td>: <span class="badge badge-light-info">New Order</span></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>

					<hr class="invoice-spacing mt-2" />
					<div class="enable-backdrop">
						<button type="button" class="btn btn-outline-secondary btn-sm btn-add-new mb-1" id="addpeserta" data-bs-toggle="offcanvas" data-bs-target="#offcanvasBackdrop" aria-controls="offcanvasBackdrop">
							<span class="align-middle">Tambah Kolom Produk</span>
						</button>
						<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasBackdrop" aria-labelledby="offcanvasBackdropLabel" data-bs-scroll="true" data-bs-backdrop="true">
							<div class="offcanvas-header">
								<h5 id="offcanvasBackdropLabel" class="offcanvas-title">Tambah Produk</h5>
								<button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
							</div>
							<div class="offcanvas-body my-auto mx-0 flex-grow-0">
								<form class="form" id="tambahProduct">
									<div class="row">
										<div class="col-12">
											<div class="mb-1">
												<label class="form-label" for="first-name-vertical">Nama Produk</label>
												<input type="text" id="first-name-vertical" class="form-control" name="fname" placeholder="Bimasakti" />
											</div>
										</div>
										<div class="col-12">
											<div class="mb-1">
												<label class="form-label" for="email-id-vertical">Kuantitas</label>
												<input type="number" id="email-id-vertical" class="form-control" name="email-id" placeholder="00" />
											</div>
										</div>
										<div class="col-12">
											<div class="mb-1">
												<label class="form-label" for="contact-info-vertical">Harga Satuan</label>
												<input type="number" id="contact-info-vertical" class="form-control" name="contact" placeholder="Rp. XXX.XXXX" />
											</div>
										</div>
										<div class="col-12">
											<div class="mb-1">
												<label class="form-label" for="password-vertical">Tanggal Pengiriman</label>
												<input type="date" id="password-vertical" class="form-control" name="contact" placeholder="Password" />
											</div>
										</div>
										<div class="col-12">
											<div class="mb-1">
												<label class="form-label" for="password-vertical">Total Harga</label>
												<input type="number" id="password-vertical" class="form-control" name="contact" placeholder="Rp. XXX.XXXX" />
											</div>
										</div>
										<div class="col-12">
											<div class="mb-1">
												<label class="form-label" for="password-vertical">Catatan</label>
												<textarea name="" id="" cols="10" rows="3" class="form-control"></textarea>
											</div>
										</div>
									</div>
								</form>
								<button type="button" class="btn btn-primary mb-1 d-grid w-100">Simpan</button>
								<button type="button" class="btn btn-outline-secondary d-grid w-100" data-bs-dismiss="offcanvas">
									Cancel
								</button>
							</div>
						</div>
					</div>
					<div class="table-responsive">
						<small class="text-muted"><i><span class="text-danger">*</span> Tambahkan kolom input produk sesuai dengan jumlah pesanan</i></small>
						<table class="table">
							<thead>
								<tr>
									<th>Nama Produk</th>
									<th>Kuantitas</th>
									<th>Harga Satuan</th>
									<th>Tanggal Pengiriman</th>
									<th>Total Harga</th>
									<th>Catatan</th>
								</tr>
							</thead>
							<tbody id="viewpeserta">
								<tr class="border-bottom">
									<td colspan='6' class='text-center'>Data tidak ditemukan.</td>
								</tr>

							</tbody>
						</table>
					</div>
				</form>
			</div>
		</div>
	</div>
	<div class="col-sm-3">
		<div class="card">
			<div class="card-body">
				<button class="btn btn-primary w-100 mb-75" id="tombol_simpan" type="button">Save</button>
				<a href="#" class="btn btn-outline-primary w-100 Kembali" type="button">Back</a>
			</div>
		</div>
	</div>
</div>

<script>
	$(document).on("click", ".Kembali", function() {
		$("#show_data").load("<?= base_url('OrderRequest/ShowPilihTableData'); ?>");
	});
</script>