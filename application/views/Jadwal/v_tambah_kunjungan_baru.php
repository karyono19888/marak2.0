<section class="basic-select2">
	<div class="row">
		<div class="col-sm-9">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title">Tambah Data Jadwal <span class="fw-bolder"></span></h4>
					<a href="<?= base_url('Jadwal'); ?>" class="btn btn-default btn-dark">Back</a>
				</div>
				<div class="card-body">
					<form id="tambahJadwalForm" class="row gy-1" method="POST" action="">
						<div class="alert alert-primary" role="alert">
							<div class="alert-body"><strong>Perhatian!</strong> Pastikan data Instansi/Swasta/Perorangan sudah terdaftar pada Menu Data Instansi.</div>
						</div>
						<div class="col-12 col-md-6">
							<label class="form-label" for="provinsi">Provinsi<span class="text-danger">*</span></label>
							<select id="provinsi" name="provinsi" class="form-select select2" aria-label="Default select example">
								<option value="">- Pilih -</option>
							</select>
						</div>
						<div class="col-12 col-md-6">
							<label class="form-label" for="kabupaten">Kabupaten/Kota<span class="text-danger">*</span></label>
							<select id="kabupaten" name="kabupaten" class="form-select select2" aria-label="Default select example">
								<option value="">- Pilih -</option>
							</select>
						</div>
						<div class="col-12">
							<label class="form-label" for="instansi">Instansi/Swasta/Perorangan<span class="text-danger">*</span></label>
							<select id="instansi" name="instansi" class="form-select select2" aria-label="Default select example">
								<option value="">- Pilih -</option>
							</select>
						</div>

						<div class="col-sm-3">
							<label class="form-label" for="date_visit">Tanggal <span class="text-danger">*</span></label>
							<div class="input-group">
								<input type="date" id="date_visit" class="form-control date-picker" name="date_visit" />
							</div>
						</div>
						<div class="col-sm-3">
							<label class="form-label" for="time">Jam <span class="text-danger">*</span></label>
							<div class="input-group">
								<input type="time" id="time" class="form-control flatpickr-time" name="time" placeholder="00:00" />
							</div>
						</div>
						<div class="col-sm-3">
							<label class="form-label" for="type_alamat">Alamat Kunjungan<span class="text-danger">*</span></label>
							<select id="type_alamat" name="type_alamat" class="form-select" aria-label="Default select example">
								<option value="">- Pilih -</option>
								<option value="Alamat Kantor">Alamat Kantor</option>
								<option value="Alamat Rumah">Alamat Rumah</option>
								<option value="Alamat Lain">Alamat lain</option>
							</select>
						</div>
						<div class="col-sm-3">
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

	let timePickr = $('.flatpickr-time');
	if (timePickr.length) {
		timePickr.flatpickr({
			enableTime: true,
			noCalendar: true
		});
	}
</script>

<script>
	// provinsi
	$(document).ready(function() {
		$("#provinsi").select2({
			ajax: {
				url: '<?= base_url('Wilayah/Provinsi'); ?>',
				type: "post",
				dataType: 'json',
				delay: 200,
				data: function(params) {
					return {
						searchTerm: params.term
					};
				},
				processResults: function(response) {
					return {
						results: response
					};
				},
				cache: true
			}
		});
	});
	// kabupaten
	$("#provinsi").change(function() {
		var id_prov = $("#provinsi").val();
		$("#kabupaten").select2({
			ajax: {
				url: '<?= base_url(); ?>Wilayah/Kabupaten/' + id_prov,
				type: "post",
				dataType: 'json',
				delay: 200,
				data: function(params) {
					return {
						searchTerm: params.term
					};
				},
				processResults: function(response) {
					return {
						results: response
					};
				},
				cache: true
			}
		});
	});

	$("#kabupaten").change(function() {
		var id_kab = $("#kabupaten").val();
		$("#instansi").select2({
			ajax: {
				url: '<?= base_url('Wilayah/Instansi/') ?>' + id_kab,
				type: "post",
				dataType: 'json',
				delay: 200,
				data: function(params) {
					return {
						searchTerm: params.term
					};
				},
				processResults: function(response) {
					return {
						results: response
					};
				},
				cache: true
			}
		});
	});
</script>

<!-- simpan tambah -->
<script>
	$(document).on("click", "#tombol_tambah", function() {
		if (validasi()) {
			let data = $('#tambahJadwalForm').serialize();
			$.ajax({
				type: 'POST',
				url: '<?= base_url('Jadwal/TambahJadwalBaru'); ?>',
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