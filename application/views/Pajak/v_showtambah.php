<div class="row">
	<div class="col-sm-9">
		<div class="card">
			<div class="card-header">
				<h4 class="card-title"><b>Tambah Nama Pajak Baru</b></h4>
			</div>
			<div class="card-body">
				<form class="form" id="formPajak">
					<div class="row">
						<div class="col-sm-4">
							<div class="mb-1">
								<label class="form-label" for="m_pajak_nama">Nama</label>
								<input type="text" id="m_pajak_nama" class="form-control" placeholder="contoh : PPN 10%" name="m_pajak_nama" />
							</div>
						</div>
						<div class="col-sm-4">
							<div class="mb-1">
								<label class="form-label" for="m_pajak_nilai">Nilai</label>
								<input type="number" id="m_pajak_nilai" class="form-control" placeholder="10" name="m_pajak_nilai" />
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-4">
							<div class="mb-1">
								<label class="form-label" for="m_pajak_persen">Persen</label>
								<input type="number" id="m_pajak_persen" class="form-control" placeholder="100" name="m_pajak_persen" />
							</div>
						</div>
						<div class="col-sm-4">
							<label class="form-label" for="m_pajak_status">Status</label>
							<select class="form-select select2" id="m_pajak_status" name="m_pajak_status">
								<option value="">- Pilih -</option>
								<option value="Aktif">Aktif</option>
								<option value="Tidak Aktif">Tidak Aktif</option>
							</select>
						</div>
						<div class="col-sm-4">
							<div class="mb-1">
								<label class="form-label" for="m_pajak_ket">Deskripsi</label>
								<textarea name="m_pajak_ket" id="m_pajak_ket" cols="30" rows="3" class="form-control" placeholder="Deskripsi"></textarea>
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
		$("#show_data").load("<?= base_url('Pajak/ShowTableData'); ?>");
	});
</script>
<!-- simpan tambah -->
<script>
	$(document).on("click", "#tombol_simpan", function() {
		if (validasi()) {
			let data = $('#formPajak').serialize();
			$.ajax({
				type: 'POST',
				url: '<?= base_url('Pajak/TambahPajak'); ?>',
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
						window.location.assign('<?= site_url("Pajak") ?>');
					}, 2000);
				}
			});
		}
	});

	function validasi() {
		let m_pajak_nama = document.getElementById("m_pajak_nama").value;
		let m_pajak_nilai = document.getElementById("m_pajak_nilai").value;
		let m_pajak_persen = document.getElementById("m_pajak_persen").value;
		let m_pajak_ket = document.getElementById("m_pajak_ket").value;
		let m_pajak_status = document.getElementById("m_pajak_status").value;
		if ((m_pajak_nama == "") || (m_pajak_nilai == "") || (m_pajak_persen == "") || (m_pajak_ket == "") || (m_pajak_status == "")) {
			if (m_pajak_ket == "") {
				notif("Deskripsi");
			}
			if (m_pajak_status == "") {
				notif("Status");
			}
			if (m_pajak_persen == "") {
				notif("Persen");
			}
			if (m_pajak_nilai == "") {
				notif("Nilai");
			}
			if (m_pajak_nama == "") {
				notif("Nama");
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