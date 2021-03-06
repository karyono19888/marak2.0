<div class="row">
	<div class="col-sm-9">
		<div class="card">
			<div class="card-header">
				<h4 class="card-title">Edit Uom <b><?= $data['m_uom_nama']; ?></b></h4>
			</div>
			<div class="card-body">
				<form class="form" id="formUom">
					<div class="row">
						<div class="col-sm-4">
							<div class="mb-1">
								<label class="form-label" for="m_uom_kode">Kode</label>
								<input type="hidden" id="m_uom_id" class="form-control" placeholder="Kode" name="m_uom_id" value="<?= $data['m_uom_id']; ?>" />
								<input type="text" id="m_uom_kode" class="form-control" placeholder="Kode" name="m_uom_kode" value="<?= $data['m_uom_kode']; ?>" />
							</div>
						</div>
						<div class="col-sm-4">
							<div class="mb-1">
								<label class="form-label" for="m_uom_symbol">Symbol</label>
								<input type="text" id="m_uom_symbol" class="form-control" placeholder="Simbol" name="m_uom_symbol" value="<?= $data['m_uom_symbol']; ?>" />
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-4">
							<div class="mb-1">
								<label class="form-label" for="m_uom_nama">Nama</label>
								<input type="text" id="m_uom_nama" class="form-control" placeholder="Nama" name="m_uom_nama" value="<?= $data['m_uom_nama']; ?>" />
							</div>
						</div>
						<div class="col-sm-4">
							<label class="form-label" for="m_uom_status">Status</label>
							<select class="form-select select2" id="m_uom_status" name="m_uom_status">
								<?php if ($data['m_uom_status'] == "Aktif") : ?>
									<option value="<?= $data['m_uom_status']; ?>"><?= $data['m_uom_status']; ?></option>
									<option value="Tidak Aktif">Tidak Aktif</option>
								<?php else : ?>
									<option value="<?= $data['m_uom_status']; ?>"><?= $data['m_uom_status']; ?></option>
									<option value="Aktif">Aktif</option>
								<?php endif; ?>
							</select>
						</div>
						<div class="col-sm-4">
							<div class="mb-1">
								<label class="form-label" for="m_uom_deskripsi">Deskripsi</label>
								<textarea name="m_uom_deskripsi" id="m_uom_deskripsi" cols="30" rows="3" class="form-control" placeholder="Deskripsi"><?= $data['m_uom_deskripsi']; ?></textarea>
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
				<button class="btn btn-warning w-100 mb-75" id="tombol_simpan" type="button">Edit</button>
				<a href="#" class="btn btn-outline-primary w-100 Kembali" type="button">Back</a>
			</div>
		</div>
	</div>
</div>
<script>
	$(document).on("click", ".Kembali", function() {
		$("#show_data").load("<?= base_url('MasterUom/ShowTableData'); ?>");
	});
</script>
<!-- simpan tambah -->
<script>
	$(document).on("click", "#tombol_simpan", function() {
		if (validasi()) {
			let data = $('#formUom').serialize();
			$.ajax({
				type: 'POST',
				url: '<?= base_url('MasterUom/EditUom'); ?>',
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
						window.location.assign('<?= site_url("MasterUom") ?>');
					}, 2000);
				}
			});
		}
	});

	function validasi() {
		let m_uom_nama = document.getElementById("m_uom_nama").value;
		let m_uom_kode = document.getElementById("m_uom_kode").value;
		let m_uom_symbol = document.getElementById("m_uom_symbol").value;
		let m_uom_deskripsi = document.getElementById("m_uom_deskripsi").value;
		let m_uom_status = document.getElementById("m_uom_status").value;
		if ((m_uom_nama == "") || (m_uom_kode == "") || (m_uom_symbol == "") || (m_uom_deskripsi == "") || (m_uom_status == "")) {
			if (m_uom_deskripsi == "") {
				notif("Deskripsi");
			}
			if (m_uom_status == "") {
				notif("Status");
			}
			if (m_uom_nama == "") {
				notif("Nama");
			}
			if (m_uom_symbol == "") {
				notif("Symbol");
			}
			if (m_uom_kode == "") {
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