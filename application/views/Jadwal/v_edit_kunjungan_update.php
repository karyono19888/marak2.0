<section class="basic-select2">
	<div class="row">
		<div class="col-sm-9">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title">Edit Data Jadwal <span class="fw-bolder"></span></h4>
					<a href="<?= base_url('Jadwal'); ?>" class="btn btn-default btn-dark">Back</a>
				</div>
				<div class="card-body">
					<form id="updateJadwalForm" class="row gy-1" method="POST" action="">
						<div class="alert alert-warning" role="alert">
							<div class="alert-body"><strong>Perhatian!</strong> Pastikan data Instansi/Swasta/Perorangan sudah terdaftar pada Menu Data Instansi.</div>
						</div>
						<div class="col-12 col-md-6">
							<label class="form-label" for="provinsi">Provinsi<span class="text-danger">*</span></label>
							<select id="provinsi" name="provinsi" class="form-select select2" aria-label="Default select example">
								<option value="<?= $data['id_prov']; ?>"><?= $data['prov_nama']; ?></option>
							</select>
						</div>
						<input type="hidden" id="visit_id" name="visit_id" value="<?= $data['visit_id']; ?>">
						<input type="hidden" id="id_jadwal" name="id_jadwal" value="<?= $data['id_jadwal']; ?>">
						<div class="col-12 col-md-6">
							<label class="form-label" for="kabupaten">Kabupaten/Kota<span class="text-danger">*</span></label>
							<select id="kabupaten" name="kabupaten" class="form-select select2" aria-label="Default select example">
								<option value="<?= $data['id_kab']; ?>"><?= $data['kab_nama']; ?></option>
							</select>
						</div>
						<div class="col-12">
							<label class="form-label" for="instansi">Instansi/Swasta/Perorangan<span class="text-danger">*</span></label>
							<select id="instansi" name="instansi" class="form-select select2" aria-label="Default select example">
								<option value="<?= $data['instansi_id']; ?>"><?= $data['instansi_nama']; ?></option>
							</select>
						</div>

						<div class="col-sm-6">
							<label class="form-label" for="date_visit">Tanggal <span class="text-danger">*</span></label>
							<div class="input-group input-group-merge">
								<span class="input-group-text"><i data-feather="calendar"></i></span>
								<input type="date" id="date_visit" class="form-control" name="date_visit" placeholder="First Name" value="<?= $data['date_visit']; ?>" />
							</div>
						</div>
						<div class="col-sm-3">
							<label class="form-label" for="time">Jam <span class="text-danger">*</span></label>
							<div class="input-group input-group-merge">
								<span class="input-group-text"><i data-feather="clock"></i></span>
								<input type="time" id="time" class="form-control" name="time" placeholder="First Name" value="<?= $data['time']; ?>" />
							</div>
						</div>
						<div class="col-12 col-md-6">
							<label class="form-label" for="type_alamat">Alamat Kunjungan<span class="text-danger">*</span></label>
							<select id="type_alamat" name="type_alamat" class="form-select" aria-label="Default select example">
								<option value="<?= $data['type_alamat']; ?>"><?= $data['type_alamat']; ?></option>
								<option value="Alamat Kantor">Alamat Kantor</option>
								<option value="Alamat Rumah">Alamat Rumah</option>
								<option value="Alamat Lain">Alamat lain</option>
							</select>
						</div>
						<div class="col-12 col-md-6">
							<label class="form-label" for="type_act">Activity<span class="text-danger">*</span></label>
							<select id="type_act" name="type_act" class="form-select" aria-label="Default select example">
								<option value="<?= $data['type_act']; ?>"><?= $data['type_act']; ?></option>
								<option value="Kunjungan Langsung">Kunjungan Langsung</option>
								<option value="By Phone">By Phone</option>
								<option value="Meet Online">Meet Online</option>
								<option value="Email">Email</option>
								<option value="lainnya">lainnya</option>
							</select>
						</div>
						<div class="col-12 mb-5">
							<label class="form-label" for="acara">Agenda Kunjungan <span class="text-danger">*</span></label>
							<input type="hidden" name="acara" id="acara" value="<?= $data['acara']; ?>">
							<div id="editor" style="min-height: 100px;"><?= $data['acara']; ?></div>
						</div>
						<div class="col-12 text-center mt-5">
							<button type="button" class="btn btn-primary me-1" id="tombol_update">Update</button>
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
	$(document).on("click", "#tombol_update", function() {
		if (validasi()) {
			let data = $('#updateJadwalForm').serialize();
			$.ajax({
				type: 'POST',
				url: '<?= base_url('Jadwal/UpdateJadwalUpdate'); ?>',
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