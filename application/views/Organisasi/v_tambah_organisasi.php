<?php $this->load->view('Components/v_header'); ?>

<link rel="stylesheet" type="text/css" href="<?= base_url('assets'); ?>/css/components.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">

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
						<h2 class="content-header-title float-start mb-0">Tambah Organisasi</h2>
						<div class="breadcrumb-wrapper">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="<?= base_url('Organisasi'); ?>">Organisasi</a>
								</li>
								<li class="breadcrumb-item active">Tambah Organisasi
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
			<!-- Select2 Start  -->
			<section class="basic-select2">
				<div class="row">
					<div class="col-sm-8">
						<div class="card">
							<div class="card-header">
								<h4 class="card-title">Tambah Data Organisasi</h4>
								<a href="<?= base_url('Organisasi'); ?>" class="btn btn-default btn-dark">Back</a>
							</div>
							<div class="card-body">
								<div class="row">
									<div class="alert alert-warning" role="alert">
										<h4 class="alert-heading">Perhatian !</h4>
										<div class="alert-body">
											Pastikan Nama Organisasi tidak boleh sama dengan data yang sudah ada.
										</div>
									</div>
									<form id="tambahOrganisasiForm" class="row gy-1" method="POST" action="">
										<div class="col-12">
											<label class="form-label" for="org_nama">Nama Organisasi<span class="text-danger">*</span></label>
											<div class="input-group input-group-merge">
												<span class="input-group-text"><i data-feather="user"></i></span>
												<input type="text" id="org_nama" class="form-control" name="org_nama" placeholder="Masukan Nama Organisasi" style="text-transform:capitalize ;" />
											</div>
										</div>
										<div class="col-12 col-md-6">
											<label class="form-label" for="org_email">Email<span class="text-danger">*</span></label>
											<div class="input-group input-group-merge">
												<span class="input-group-text"><i data-feather="mail"></i></span>
												<input type="email" id="org_email" class="form-control" name="org_email" placeholder="contoh@email.com" />
											</div>
										</div>
										<div class="col-12 col-md-6">
											<label class="form-label" for="org_phone">Phone<span class="text-danger">*</span></label>
											<div class="input-group input-group-merge">
												<span class="input-group-text"><i data-feather="phone"></i></span>
												<input type="number" id="org_phone" class="form-control" name="org_phone" placeholder="021 123 456 78" />
											</div>
										</div>
										<div class="col-12">
											<label class="form-label" for="org_alamat">Alamat Lengkap <span class="text-danger">*</span></label>
											<textarea name="org_alamat" id="org_alamat" cols="30" rows="4" class="form-control" placeholder="Masukan Alamat lengkap"></textarea>
										</div>
										<div class="col-12 col-md-6">
											<label class="form-label" for="wilayah">Wilayah <span class="text-danger">*</span></label>
											<select id="wilayah" name="wilayah" class="form-select" aria-label="Default select example">
												<option value="">- Pilih -</option>
											</select>
										</div>
										<div class="col-12 col-md-6">
											<label class="form-label" for="provinsi">Provinsi <span class="text-danger">*</span></label>
											<select id="provinsi" name="provinsi" class="form-select" aria-label="Default select example">
												<option value="">- Pilih -</option>
											</select>
										</div>
										<div class="col-12 col-md-6">
											<label class="form-label" for="kabupaten">Kabupaten / Kota <span class="text-danger">*</span></label>
											<select id="kabupaten" name="kabupaten" class="form-select" aria-label="Default select example">
												<option value="">- Pilih -</option>
											</select>
										</div>
										<div class="col-12 col-md-6">
											<label class="form-label" for="kecamatan">Kecamatan <span class="text-danger">*</span></label>
											<select id="kecamatan" name="kecamatan" class="form-select" aria-label="Default select example">
												<option value="">- Pilih -</option>
											</select>
										</div>
										<div class="col-12 text-center mt-2 pt-50">
											<button type="button" class="btn btn-primary me-1" id="tombol_tambah">Simpan</button>
											<a href="<?= base_url('Organisasi'); ?>" class="btn btn-outline-secondary">Discard</a>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
			<!-- Select2 End -->

		</div>
	</div>
</div>
<!-- END: Content-->

<?php $this->load->view('Components/v_footer'); ?>

<script src="<?= base_url('assets'); ?>/vendors/js/forms/select/select2.full.min.js"></script>

<script src="<?= base_url('assets'); ?>/js/scripts/forms/form-select2.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

<script>
	// wilayah
	$(document).ready(function() {
		$("#wilayah").select2({
			ajax: {
				url: '<?= base_url() ?>Wilayah/getdatawil',
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
	// Provinsi
	$("#wilayah").change(function() {
		var wilayah_id = $("#wilayah").val();
		$("#provinsi").select2({
			ajax: {
				url: '<?= base_url() ?>Wilayah/getdataprov/' + wilayah_id,
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

	// Kabupaten
	$("#provinsi").change(function() {
		var id_prov = $("#provinsi").val();
		$("#kabupaten").select2({
			ajax: {
				url: '<?= base_url() ?>Wilayah/getdatakab/' + id_prov,
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

	// Kecamatan
	$("#kabupaten").change(function() {
		var id_kab = $("#kabupaten").val();
		$("#kecamatan").select2({
			ajax: {
				url: '<?= base_url() ?>Wilayah/getdatakec/' + id_kab,
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
			let data = $('#tambahOrganisasiForm').serialize();
			$.ajax({
				type: 'POST',
				url: '<?= base_url('Organisasi/TambahOrganisasi'); ?>',
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
						window.location.assign('<?= site_url("Organisasi") ?>');
					}, 2000);
				}
			});
		}
	});

	function validasi() {
		let org_nama = document.getElementById("org_nama").value;
		let org_email = document.getElementById("org_email").value;
		let org_phone = document.getElementById("org_phone").value;
		let org_alamat = document.getElementById("org_alamat").value;
		let wilayah = document.getElementById("wilayah").value;
		let provinsi = document.getElementById("provinsi").value;
		let kabupaten = document.getElementById("kabupaten").value;
		let kecamatan = document.getElementById("kecamatan").value;
		if ((org_nama == "") || (org_email == "") || (org_phone == "") || (org_alamat == "") || (wilayah == "") || (provinsi == "") || (kabupaten == "") || (kecamatan == "")) {
			if (kecamatan == "") {
				notif("Kecamatan");
			}
			if (kabupaten == "") {
				notif("Kabupaten");
			}
			if (provinsi == "") {
				notif("Provinsi");
			}
			if (wilayah == "") {
				notif("Wilayah");
			}
			if (org_alamat == "") {
				notif("Alamat Organisasi");
			}
			if (org_phone == "") {
				notif("Nomor Phone");
			}
			if (org_email == "") {
				notif("Email");
			}
			if (org_nama == "") {
				notif("Nama Organisasi");
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

<?php $this->load->view('Components/v_bottom'); ?>