<section class="basic-select2">
	<div class="row">
		<div class="col-sm-9">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title">Tambah Data Jadwal <span class="fw-bolder">Kunjungan Update</span></h4>
					<a href="<?= base_url('Jadwal'); ?>" class="btn btn-default btn-dark">Back</a>
				</div>
				<div class="card-body">
					<form id="tambahJadwalForm" class="row gy-1" method="POST" action="">
						<div class="alert alert-warning" role="alert">
							<div class="alert-body"><strong>Perhatian!</strong> Pastikan data Instansi/ Swasta/ Perorangan sudah terdaftar pada Menu Data Instansi.</div>
						</div>
						<div class="col-12">
							<label class="form-label" for="instansi">Instansi/ Swasta/ Perorangan<span class="text-danger">*</span></label>
							<select id="instansi" name="instansi" class="form-select select2" aria-label="Default select example">
								<option value="<?= $data['instansi_id']; ?>"><?= $data['instansi_nama']; ?></option>
							</select>
						</div>
						<div class="col-12">
							<label class="form-label" for="instansi">Alamat<span class="text-danger">*</span></label>
							<textarea name="alamatinstansi" id="alamatinstansi" cols="30" rows="2" class="form-control" readonly><?= $data['instansi_alamat']; ?></textarea>
						</div>
						<input type="hidden" id="m_visit_id" name="m_visit_id" value="<?= $data['m_visit_id'] ?>">
						<div class="col-sm-6">
							<label class="form-label" for="date_visit">Tanggal <span class="text-danger">*</span></label>
							<div class="input-group input-group-merge">
								<span class="input-group-text"><i data-feather="calendar"></i></span>
								<input type="date" id="date_visit" class="form-control" name="date_visit" placeholder="First Name" />
							</div>
						</div>
						<div class="col-sm-4">
							<label class="form-label" for="time">Jam <span class="text-danger">*</span></label>
							<div class="input-group input-group-merge">
								<span class="input-group-text"><i data-feather="clock"></i></span>
								<input type="time" id="time" class="form-control" name="time" placeholder="First Name" />
							</div>
						</div>
						<div class="col-12 col-md-6">
							<label class="form-label" for="type_alamat">Alamat Kunjungan<span class="text-danger">*</span></label>
							<select id="type_alamat" name="type_alamat" class="form-select" aria-label="Default select example">
								<option value="">- Pilih -</option>
								<option value="Alamat Kantor">Alamat Kantor</option>
								<option value="Alamat Rumah">Alamat Rumah</option>
								<option value="Alamat Lain">Alamat lain</option>
							</select>
						</div>
						<div class="col-12 col-md-6">
							<label class="form-label" for="type_act">Activity<span class="text-danger">*</span></label>
							<select id="type_act" name="type_act" class="form-select" aria-label="Default select example">
								<option value="">- Pilih -</option>
								<option value="Kunjungan Langsung">Kunjungan Langsung</option>
								<option value="By Phone">By Phone</option>
								<option value="Meet Online">Meet Online</option>
								<option value="Email">Email</option>
								<option value="lainnya">lainnya</option>
							</select>
						</div>
						<div class="col-12 mb-5">
							<label class="form-label" for="acara">Agenda Kunjungan <span class="text-danger">*</span></label>
							<input type="hidden" name="acara" id="acara" value="<?= set_value('acara') ?>">
							<div id="editor" style="min-height: 100px;"><?= set_value('acara') ?></div>
						</div>
						<div class="col-12 text-center mt-5">
							<button type="button" class="btn btn-primary me-1" id="tombol_tambah">Simpan</button>
							<a href="<?= base_url('Jadwal'); ?>" class="btn btn-outline-secondary">Discard</a>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>


<script>
	var quill = new Quill('#editor', {
		theme: 'snow'
	});

	quill.on('text-change', function(delta, oldDelta, source) {
		document.querySelector("input[name='acara']").value = quill.root.innerHTML;
	});
</script>

<!-- simpan tambah -->
<script>
	$(document).on("click", "#tombol_tambah", function() {
		if (validasi()) {
			let data = $('#tambahJadwalForm').serialize();
			$.ajax({
				type: 'POST',
				url: '<?= base_url('Jadwal/TambahJadwalUpdate'); ?>',
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
						window.location.assign('<?= site_url("Jadwal") ?>');
					}, 2000);
				}
			});
		}
	});

	function validasi() {
		let instansi = document.getElementById("instansi").value;
		let date_visit = document.getElementById("date_visit").value;
		let time = document.getElementById("time").value;
		let type_alamat = document.getElementById("type_alamat").value;
		let type_act = document.getElementById("type_act").value;
		let acara = document.getElementById("acara").value;
		if ((instansi == "") || (date_visit == "") || (time == "") || (type_alamat == "") || (type_act == "") || (acara == "")) {
			if (acara == "") {
				notif("Rencana Kunjungan");
			}
			if (type_act == "") {
				notif("Activity");
			}
			if (type_alamat == "") {
				notif("Alamat Kunjungan");
			}
			if (time == "") {
				notif("Jam Kunjungan");
			}
			if (date_visit == "") {
				notif("Tanggal");
			}
			if (instansi == "") {
				notif("Instansi");
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