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
						<h2 class="content-header-title float-start mb-0">Edit Instansi</h2>
						<div class="breadcrumb-wrapper">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="<?= base_url('Instansi'); ?>">Instansi</a>
								</li>
								<li class="breadcrumb-item active">Edit Instansi
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
								<h4 class="card-title">Edit Data - <span class="fw-bolder"><?= $editinstansi['instansi_nama']; ?></span></h4>
								<a href="<?= base_url('Instansi'); ?>" class="btn btn-default btn-dark">Back</a>
							</div>
							<div class="card-body">
								<div class="row">
									<div class="alert alert-warning" role="alert">
										<h4 class="alert-heading">Perhatian !</h4>
										<div class="alert-body">
											Pastikan Nama Instansi tidak boleh sama dengan data yang sudah ada.
										</div>
									</div>
									<form id="tambahInstansiForm" class="row gy-1" onsubmit="return false" method="POST">
										<input type="hidden" name="instansi_id" id="instansi_id" value="<?= $editinstansi['instansi_id']; ?>">
										<div class="col-12 col-md-6">
											<label class="form-label" for="instansi_kategori">Kategori Instansi <span class="text-danger">*</span></label>
											<select id="instansi_kategori" name="instansi_kategori" class="form-select select2" aria-label="Default select example">
												<option value="<?= $editinstansi['instansi_kategori']; ?>"><?= $editinstansi['instansi_kategori']; ?></option>
												<option value="Pemerintahan">Pemerintahan</option>
												<option value="Swasta">Swasta</option>
												<option value="Perorangan">Perorangan</option>
											</select>
										</div>
										<div class="col-12">
											<label class="form-label" for="instansi_nama">Nama Instansi / Swasta / Perorangan <span class="text-danger">*</span></label>
											<input type="text" id="instansi_nama" name="instansi_nama" class="form-control" placeholder="Masukan Nama dengan lengkap" value="<?= $editinstansi['instansi_nama']; ?>" />
										</div>
										<div class="col-12">
											<label class="form-label" for="instansi_alamat">Alamat Lengkap <span class="text-danger">*</span></label>
											<textarea name="instansi_alamat" id="instansi_alamat" cols="30" rows="4" class="form-control" placeholder="Masukan Alamat dengan lengkap"><?= $editinstansi['instansi_alamat']; ?></textarea>
										</div>
										<div class="col-12 col-md-6">
											<label class="form-label" for="wilayah">Wilayah <span class="text-danger">*</span></label>
											<select id="wilayah" name="wilayah" class="form-select" aria-label="Default select example">
												<option value="<?= $editinstansi['wilayah_id']; ?>"><?= $editinstansi['wilayah_nama']; ?></option>
											</select>
										</div>
										<div class="col-12 col-md-6">
											<label class="form-label" for="provinsi">Provinsi <span class="text-danger">*</span></label>
											<select id="provinsi" name="provinsi" class="form-select" aria-label="Default select example">
												<option value="<?= $editinstansi['id_prov']; ?>"><?= $editinstansi['prov_nama']; ?></option>
											</select>
										</div>
										<div class="col-12 col-md-6">
											<label class="form-label" for="kabupaten">Kabupaten / Kota <span class="text-danger">*</span></label>
											<select id="kabupaten" name="kabupaten" class="form-select" aria-label="Default select example">
												<option value="<?= $editinstansi['id_kab']; ?>"><?= $editinstansi['kab_nama']; ?></option>
											</select>
										</div>
										<div class="col-12 text-center mt-2 pt-50">
											<button type="button" class="btn btn-primary me-1" id="tombol_update">Update</button>
											<a href="<?= base_url('Instansi'); ?>" class="btn btn-outline-secondary">Discard</a>
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
				url: '<?= base_url() ?>Instansi/getdatawil',
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
				url: '<?= base_url() ?>Instansi/getdataprov/' + wilayah_id,
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
				url: '<?= base_url() ?>Instansi/getdatakab/' + id_prov,
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
	$(document).on("click", "#tombol_update", function() {
		if (validasi()) {
			let data = $('#tambahInstansiForm').serialize();
			$.ajax({
				type: 'POST',
				url: '<?= site_url('Instansi/UpdateInstansi') ?>',
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
						window.location.assign('<?= site_url("Instansi") ?>');
					}, 2000);
				}
			});
		}
	});

	function validasi() {
		let instansi_kategori = document.getElementById("instansi_kategori").value;
		let instansi_nama = document.getElementById("instansi_nama").value;
		let instansi_alamat = document.getElementById("instansi_alamat").value;
		let wilayah = document.getElementById("wilayah").value;
		let provinsi = document.getElementById("provinsi").value;
		let kabupaten = document.getElementById("kabupaten").value;
		if ((instansi_kategori == "") || (instansi_nama == "") || (instansi_alamat == "") || (wilayah == "") || (provinsi == "") || (kabupaten == "")) {
			if (kabupaten == "") {
				notif("Kabupaten");
			}
			if (provinsi == "") {
				notif("Provinsi");
			}
			if (wilayah == "") {
				notif("Wilayah");
			}
			if (instansi_alamat == "") {
				notif("Alamat Instansi");
			}
			if (instansi_nama == "") {
				notif("Nama Instansi");
			}
			if (instansi_kategori == "") {
				notif("Kategori Instansi");
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