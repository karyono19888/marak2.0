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
						<h2 class="content-header-title float-start mb-0">Edit Tools</h2>
						<div class="breadcrumb-wrapper">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="<?= base_url('Tools'); ?>">Tools</a>
								</li>
								<li class="breadcrumb-item active">Edit Tools
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
								<h4 class="card-title">Edit Data Tools - <span class="fw-bolder text-warning"><?= $data['tools_nama']; ?></span></h4>
								<a href="<?= base_url('Tools'); ?>" class="btn btn-default btn-dark">Back</a>
							</div>
							<div class="card-body">
								<div class="row">
									<?= $this->session->flashdata('message'); ?>
									<form id="tambahInstansiForm" class="row" method="POST" action="<?= base_url('Tools/Edit/' . $data['tools_id']); ?>" enctype="multipart/form-data">

										<input type="hidden" id="tools_id" name="tools_id" value="<?= $data['tools_id']; ?>">
										<div class="col-12 col-md-6 mb-1">
											<label class="form-label" for="tools_owner">Document Owner <span class="text-danger">*</span></label>
											<select id="tools_owner" name="tools_owner" class="form-select" aria-label="Default select example">
												<option value="<?= $data['org_id']; ?>"><?= $data['org_nama']; ?></option>
											</select>
											<?= form_error('tools_owner', '<small class="text-sm text-danger">', '</small>'); ?>
										</div>
										<div class="col-12 col-md-6 mb-1">
											<label class="form-label" for="tools_role">Role File <span class="text-danger">*</span></label>
											<select id="tools_role" name="tools_role" class="form-select select2" aria-label="Default select example">
												<option value="<?= $data['tools_role']; ?>"><?= $data['tools_role']; ?></option>
												<option value="Marketing">Marketing</option>
												<option value="Agent">Agent</option>
												<option value="General">General</option>
											</select>
											<?= form_error('tools_role', '<small class="text-sm text-danger">', '</small>'); ?>
										</div>
										<div class="col-12 col-md-6 mb-1">
											<label class="form-label" for="tools_type">Type File <span class="text-danger">*</span></label>
											<select id="tools_type" name="tools_type" class="form-select select2">
												<option value="<?= $data['tools_type']; ?>"><?= $data['tools_type']; ?></option>
												<option value="Browsur">Browsur</option>
												<option value="IES FIle">IES FIle</option>
												<option value="Instruksi Manual">Instruksi Manual</option>
												<option value="Sertifikat">Sertifikat</option>
												<option value="Regulasi PJU">Regulasi PJU</option>
												<option value="Regulasi PLTS ATAP">Regulasi PLTS ATAP</option>
												<option value="Regulasi KPBU">Regulasi KPBU</option>
												<option value="Others">Others</option>
											</select>
											<?= form_error('tools_type', '<small class="text-sm text-danger">', '</small>'); ?>
										</div>
										<div class="col-12 col-sm-6 mb-1">
											<label class="form-label" for="tools_nama">Nama File <span class="text-danger">*</span></label>
											<input type="text" id="tools_nama" name="tools_nama" class="form-control <?= form_error('tools_nama') ? 'is-invalid' : ''; ?>" placeholder="Masukan Nama dengan lengkap" style="text-transform:capitalize ;" value="<?= $data['tools_nama']; ?>" />
											<?= form_error('tools_nama', '<small class="text-sm text-danger">', '</small>'); ?>
										</div>
										<div class="col-12 col-md-6 mb-1">
											<label class="form-label" for="tools_upload">FILE <span class="text-danger">*</span></label>
											<input type="file" class="form-control" name="tools_upload" id="tools_upload" accept=".pdf">
											<?= form_error('tools_upload', '<small class="text-sm text-danger">', '</small>'); ?>
											<small class="text-muted"><span class="text-danger">*</span> Ukuran file max 2Mb dan type file PDF</small>
											<?php if (isset($error)) : ?>
												<div class="invalid-feedback"><?= $error ?></div>
											<?php endif; ?>
										</div>
										<div class="col-12 col-md-6 mb-1">
											<label class="form-label" for="tools_status">Status <span class="text-danger">*</span></label>
											<select id="tools_status" name="tools_status" class="form-select select2" aria-label="Default select example">
												<option value="<?= $data['tools_status']; ?>"><?= $data['tools_status']; ?></option>
												<?php if ($data['tools_status'] == "Aktif") : ?>
													<option value="Tidak Aktif">Tidak Aktif</option>
												<?php else : ?>
													<option value="Aktif">Aktif</option>
												<?php endif; ?>
											</select>
											<?= form_error('tools_status', '<small class="text-sm text-danger">', '</small>'); ?>
										</div>
										<div class="col-12 text-center mt-2 pt-50">
											<button type="submit" class="btn btn-warning me-1" id="tombol_tambah">Update</button>
											<a href="<?= base_url('Tools'); ?>" class="btn btn-outline-secondary">Discard</a>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="card">
							<div class="card-body">
								<h4 class="card-title">Preview</h4>
								<iframe id="previewpdf" src="<?= base_url('/assets/tools/' . $data['tools_upload']); ?>" style="width: 100%; height:200%; border: none;" frameborder="0"></iframe>
								<p class="card-text" id="namafilepdf"><?= $data['tools_upload']; ?></p>
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
	// document owner
	$(document).ready(function() {
		$("#tools_owner").select2({
			ajax: {
				url: '<?= base_url('Tools/dataOwner'); ?>',
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

	function Changetype() {
		let x = document.getElementById("tools_type");
		let y = x.options[x.selectedIndex].value;
		document.getElementById("tools_nama").value = y;
	}

	$(document).ready(function() {
		let tools_upload = document.getElementById('tools_upload');
		let previewpdf = document.getElementById('previewpdf');
		let namafilepdf = document.getElementById('namafilepdf');
		tools_upload.onchange = evt => {
			const [file] = tools_upload.files
			let namafile = $('#tools_upload').val().split('\\').pop();
			if (tools_upload.files[0].size > 5000000) {
				Swal.fire({
					icon: 'warning',
					title: 'Perhatian',
					text: 'Maaf, File terlalu besar! Maksimal upload 5MB',
				});
			} else {
				previewpdf.src = URL.createObjectURL(file)
				namafilepdf.innerHTML = namafile;
			}
		}
	})
</script>

<?php $this->load->view('Components/v_bottom'); ?>