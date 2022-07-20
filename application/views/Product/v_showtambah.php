<div class="row">
	<div class="col-sm-9">
		<div class="card">
			<div class="card-header">
				<h4 class="card-title">Tambah Data Produk</h4>
			</div>
			<div class="card-body">
				<form class="form" id="formProduk">
					<div class="row">
						<div class="col-sm-4">
							<div class="mb-1">
								<label class="form-label" for="m_prod_category">Kategori</label>
								<select class="form-select select2" id="m_prod_category" name="m_prod_category">
									<option value="">- Pilih -</option>
									<option value="E-catalog">E-catalog</option>
									<option value="Non E-catalog">Non E-catalog</option>
								</select>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-4">
							<div class="mb-1">
								<label class="form-label" for="m_prod_kode">Kode Produk</label>
								<input type="text" id="m_prod_kode" class="form-control" placeholder="Kode Produk" name="m_prod_kode" />
							</div>
						</div>
						<div class="col-sm-4">
							<div class="mb-1">
								<label class="form-label" for="m_prod_nama">Nama Produk</label>
								<input type="text" id="m_prod_nama" class="form-control" placeholder="Nama Produk" name="m_prod_nama" />
							</div>
						</div>
						<div class="col-sm-4">
							<div class="mb-1">
								<label class="form-label" for="m_prod_type">Tipe Produk</label>
								<input type="text" id="m_prod_type" class="form-control" placeholder="Tipe Produk" name="m_prod_type" />
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-4">
							<div class="mb-1">
								<label class="form-label" for="m_prod_uom">Uom</label>
								<input type="text" id="m_prod_uom" class="form-control" placeholder="Uom" name="m_prod_uom" />
							</div>
						</div>
						<div class="col-sm-4">
							<label class="form-label" for="m_prod_status">Status</label>
							<select class="form-select select2" id="m_prod_status" name="m_prod_status">
								<option value="">- Pilih -</option>
								<option value="Aktif">Aktif</option>
								<option value="Tidak Aktif">Tidak Aktif</option>
							</select>
						</div>
						<div class="col-sm-4">
							<div class="mb-1">
								<label class="form-label" for="m_prod_ket">Deskripsi</label>
								<textarea name="m_prod_ket" id="m_prod_ket" cols="30" rows="3" class="form-control" placeholder="Deskripsi"></textarea>
							</div>
						</div>
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
		$("#show_data").load("<?= base_url('Products/ShowTableData'); ?>");
	});
</script>
<!-- simpan tambah -->
<script>
	$(document).on("click", "#tombol_simpan", function() {
		if (validasi()) {
			let data = $('#formProduk').serialize();
			$.ajax({
				type: 'POST',
				url: '<?= base_url('Products/TambahProduk'); ?>',
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
						window.location.assign('<?= site_url("Products") ?>');
					}, 2000);
				}
			});
		}
	});

	function validasi() {
		let m_prod_category = document.getElementById("m_prod_category").value;
		let m_prod_kode = document.getElementById("m_prod_kode").value;
		let m_prod_nama = document.getElementById("m_prod_nama").value;
		let m_prod_type = document.getElementById("m_prod_type").value;
		let m_prod_uom = document.getElementById("m_prod_uom").value;
		let m_prod_status = document.getElementById("m_prod_status").value;
		let m_prod_ket = document.getElementById("m_prod_ket").value;
		if ((m_prod_category == "") || (m_prod_kode == "") || (m_prod_nama == "") || (m_prod_type == "") || (m_prod_uom == "") || (m_prod_status == "") || (m_prod_ket == "")) {
			if (m_prod_ket == "") {
				notif("Deskripsi");
			}
			if (m_prod_status == "") {
				notif("Status");
			}
			if (m_prod_uom == "") {
				notif("Uom");
			}
			if (m_prod_type == "") {
				notif("Tipe");
			}
			if (m_prod_nama == "") {
				notif("Nama Produk");
			}
			if (m_prod_kode == "") {
				notif("Kode Produk");
			}
			if (m_prod_category == "") {
				notif("Kategori");
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