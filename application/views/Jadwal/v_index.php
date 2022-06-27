<?php $this->load->view('Components/v_header'); ?>
<link rel="stylesheet" href="//cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="<?= base_url('assets'); ?>/vendors/css/pickers/flatpickr/flatpickr.min.css">
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="<?= base_url('assets'); ?>/css/components.css">
<link rel="stylesheet" type="text/css" href="<?= base_url('assets'); ?>/css/plugins/forms/pickers/form-flat-pickr.css">
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
						<h2 class="content-header-title float-start mb-0">Jadwal</h2>
						<div class="breadcrumb-wrapper">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="<?= base_url('Marketing'); ?>">Marketing</a>
								</li>
								<li class="breadcrumb-item active">Jadwal Kunjungan
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
			<!-- Dashboard Ecommerce Starts -->
			<section class="app-user-list">
				<div class="row">
					<div class="col-lg-3 col-sm-6">
						<div class="card">
							<div class="card-body d-flex align-items-center justify-content-between">
								<div>
									<h3 class="fw-bolder mb-75"><?= $total; ?></h3>
									<span>Total Rencana Kunjungan</span>
								</div>
								<div class="avatar bg-light-primary p-50">
									<span class="avatar-content">
										<i data-feather="navigation" class="font-medium-4"></i>
									</span>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-3 col-sm-6">
						<div class="card">
							<div class="card-body d-flex align-items-center justify-content-between">
								<div>
									<h3 class="fw-bolder mb-75"><?= $totalplan; ?></h3>
									<span>Total Planning</span>
								</div>
								<div class="avatar bg-light-warning p-50">
									<span class="avatar-content">
										<i data-feather="calendar" class="font-medium-4"></i>
									</span>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-3 col-sm-6">
						<div class="card">
							<div class="card-body d-flex align-items-center justify-content-between">
								<div>
									<h3 class="fw-bolder mb-75"><?= $totalvisited; ?></h3>
									<span>Total Visited</span>
								</div>
								<div class="avatar bg-light-success p-50">
									<span class="avatar-content">
										<i data-feather="git-pull-request" class="font-medium-4"></i>
									</span>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-3 col-sm-6">
						<div class="card">
							<div class="card-body d-flex align-items-center justify-content-between">
								<div>
									<h3 class="fw-bolder mb-75"><?= $totalnotvisit; ?></h3>
									<span>Total Not Visited</span>
								</div>
								<div class="avatar bg-light-danger p-50">
									<span class="avatar-content">
										<i data-feather="x" class="font-medium-4"></i>
									</span>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- list and filter start -->
				<div class="card">
					<div class="card-body">
						<form action="#" id="formSearching" method="POST">
							<div class="row">
								<div class="col-sm-3 my-1">
									<input type="text" id="start_date" name="start_date" class="form-control flatpickr-basic" placeholder="Start Date" />
								</div>
								<div class="col-sm-3 my-1">
									<input type="text" id="end_date" name="end_date" class="form-control flatpickr-basic" placeholder="End Date" />
								</div>
								<?php if ($this->session->userdata('role_user') == 1) : ?>
									<div class="col-sm-4 my-1">
										<select id="nama_marketing" name="nama_marketing" class="form-select select2" aria-label="Default select example">
											<option value="">- Pilih Nama Maketing -</option>
										</select>
									</div>
								<?php endif; ?>
								<div class="col-sm-2 my-1">
									<button class="btn btn-primary" type="button" id="tombol_searching"><i data-feather='search'></i> Search</button>
									<button onClick="window.location.reload();" class="btn btn-outline-secondary" type="button">Reset</button>
								</div>
							</div>
						</form>
					</div>
				</div>
				<div class="card">
					<div id="show_jadwal"></div>
				</div>
				<!-- list and filter end -->
			</section>
			<!-- Dashboard Ecommerce ends -->

		</div>
	</div>
</div>
<!-- END: Content-->

<?php $this->load->view('Components/v_footer'); ?>
<script src="//cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets'); ?>/vendors/js/forms/select/select2.full.min.js"></script>
<script src="<?= base_url('assets'); ?>/js/scripts/forms/form-select2.js"></script>
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<script src="<?= base_url('assets'); ?>/vendors/js/pickers/flatpickr/flatpickr.min.js"></script>
<script>
	$(document).ready(function() {
		$('#mytable').DataTable();
		$("#show_jadwal").load("<?= base_url('Jadwal/TableJadwal'); ?>");
		var basicPickr = $('.flatpickr-basic');
		basicPickr.flatpickr();
	});

	$(document).on("click", ".Hapus", function() {
		let id = $(this).data('id');
		Swal.fire({
			title: 'Are you sure?',
			text: "Delete Jadwal Kunjungan!",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Yes, delete it!'
		}).then((result) => {
			if (result.isConfirmed) {
				$.ajax({
					type: 'POST',
					url: '<?= site_url('Jadwal/Delete') ?>',
					data: {
						id: id
					},
					success: function(response) {
						var data = JSON.parse(response);
						if (data.success) {
							SweetAlert.fire({
								icon: 'success',
								title: 'Success',
								text: data.msg,
								showConfirmButton: false,
								timer: 1500
							});
						} else {
							SweetAlert.fire({
								icon: 'error',
								title: 'Error',
								text: data.msg,
								showConfirmButton: false,
								timer: 1500
							});
						}
						setTimeout(() => {
							window.location.assign('<?php echo site_url("Jadwal") ?>');
						}, 1500);
					}
				});
			}
		})
	});

	$(document).on("click", "#tombol_searching", function() {
		if (validasi()) {
			let data = $('#formSearching').serialize();
			$.ajax({
				type: 'POST',
				url: '<?= base_url('Jadwal/TableJadwal'); ?>',
				data: data,
				success: function(response) {
					$("#show_jadwal").html(response);
				}
			});
		}
	});

	function validasi() {
		let start_date = document.getElementById("start_date").value;
		let end_date = document.getElementById("end_date").value;
		if ((start_date == "") || (end_date == "")) {
			if (end_date == "") {
				notif("End Date");
			}
			if (start_date == "") {
				notif("Start Date");
			}
		} else {
			return true;
		}
	}

	$(document).ready(function() {
		$("#nama_marketing").select2({
			ajax: {
				url: '<?= base_url('Jadwal/NamaMarketing'); ?>',
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