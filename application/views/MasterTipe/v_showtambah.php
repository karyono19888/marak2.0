<div class="row">
	<div class="col-sm-9">
		<div class="card">
			<div class="card-header">
				<h4 class="card-title"><b>Tambah Tipe Baru</b></h4>
			</div>
			<div class="card-body">
				<form class="form" id="formTipe">
					<div class="row">
						<div class="col-sm-4">
							<div class="mb-1">
								<label class="form-label" for="m_tipe_kode">Kode</label>
								<input type="text" id="m_tipe_kode" class="form-control" placeholder="Kode" name="m_tipe_kode" />
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-4">
							<div class="mb-1">
								<label class="form-label" for="m_tipe_nama">Nama</label>
								<input type="text" id="m_tipe_nama" class="form-control" placeholder="Nama" name="m_tipe_nama" />
							</div>
						</div>
						<div class="col-sm-4">
							<label class="form-label" for="m_tipe_status">Status</label>
							<select class="form-select select2" id="m_tipe_status" name="m_tipe_status">
								<option value="">- Pilih -</option>
								<option value="Aktif">Aktif</option>
								<option value="Tidak Aktif">Tidak Aktif</option>
							</select>
						</div>
						<div class="col-sm-4">
							<div class="mb-1">
								<label class="form-label" for="m_tipe_deskripsi">Deskripsi</label>
								<textarea name="m_tipe_deskripsi" id="m_tipe_deskripsi" cols="30" rows="3" class="form-control" placeholder="Deskripsi"></textarea>
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
		$("#show_data").load("<?= base_url('MasterTipe/ShowTableData'); ?>");
	});
</script>
<!-- simpan tambah -->
<script>
	$(document).on("click", "#tombol_simpan", function() {
		if (validasi()) {
			let data = $('#formTipe').serialize();
			$.ajax({
				type: 'POST',
				url: '<?= base_url('MasterTipe/TambahTipe'); ?>',
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
						window.location.assign('<?= site_url("MasterTipe") ?>');
					}, 2000);
				}
			});
		}
	});

	function validasi() {
		let m_tipe_kode = document.getElementById("m_tipe_kode").value;
		let m_tipe_nama = document.getElementById("m_tipe_nama").value;
		let m_tipe_status = document.getElementById("m_tipe_status").value;
		let m_tipe_deskripsi = document.getElementById("m_tipe_deskripsi").value;
		if ((m_tipe_kode == "") || (m_tipe_nama == "") || (m_tipe_status == "") || (m_tipe_deskripsi == "")) {
			if (m_tipe_deskripsi == "") {
				notif("Deskripsi");
			}
			if (m_tipe_status == "") {
				notif("Status");
			}
			if (m_tipe_nama == "") {
				notif("Nama");
			}
			if (m_tipe_kode == "") {
				notif("Kode");
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