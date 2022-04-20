<?php $this->load->view('Components/v_header'); ?>
<link rel="stylesheet" href="//cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<?php $this->load->view('Components/v_headerbottom'); ?>
<!-- BEGIN: Body-->

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
						<h2 class="content-header-title float-start mb-0">Menu</h2>
						<div class="breadcrumb-wrapper">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="<?= base_url('Administrator'); ?>">Administrator</a>
								</li>
								<li class="breadcrumb-item"><a href="#">Menu Management</a>
								</li>
								<li class="breadcrumb-item active">Menu
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
						<div class="dropdown-menu dropdown-menu-end">
							<a class="dropdown-item" href="app-todo.html">
								<i class="me-1" data-feather="check-square"></i>
								<span class="align-middle">Todo</span>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="content-body">
			<!-- Content start -->
			<div class="row" id="basic-table">
				<div class="col-12">
					<div class="card">
						<div class="card-header">
							<h4 class="card-title">Table Menu</h4>
							<button class="dt-button create-new btn btn-primary Tambah" type="button" data-bs-toggle="modal" data-bs-target="#backdrop">
								<span><i data-feather='plus'></i> Add New Menu</span>
							</button>
						</div>
						<div class="card-body">
							<table class="table table-borderless" id="myTable">
								<thead>
									<tr>
										<th>Nama Menu</th>
										<th>Status</th>
										<th>Actions</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($menu->result_array() as $m) : ?>
										<tr>
											<td>
												<span class="fw-bold"><?= $m['menu_name']; ?></span>
											</td>
											<td><span class="badge rounded-pill badge-light-primary me-1">Active</span></td>
											<td>
												<div class="dropdown">
													<button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0" data-bs-toggle="dropdown">
														<i data-feather="more-vertical"></i>
													</button>
													<div class="dropdown-menu dropdown-menu-end">
														<a class="dropdown-item" href="#" data-id="<?= $m['id_menu']; ?>" data-bs-toggle="modal" data-bs-target="#backdrop" id="Edit" type="button">
															<i data-feather="edit-2" class="me-50"></i>
															<span>Edit</span>
														</a>
														<a class="dropdown-item Delete" href="#" data-id="<?= $m['id_menu']; ?>">
															<i data-feather="trash" class="me-50"></i>
															<span>Delete</span>
														</a>
													</div>
												</div>
											</td>
										</tr>
									<?php endforeach; ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			<!-- Modal -->
			<div class="modal fade text-start" id="backdrop" tabindex="-1" aria-labelledby="myModalLabel4" data-bs-backdrop="false" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title" id="judul_tambah">Tambah Data</h4>
							<h4 class="modal-title" id="judul_update">Update Data</h4>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<form class="form form-horizontal" method="POST" id="form">
							<div class="modal-body">
								<div class="row">
									<div class="col-12">
										<div class="mb-1 row">
											<div class="col-sm-3">
												<label class="col-form-label" for="menu_name">Nama Menu</label>
											</div>
											<div class="col-sm-9">
												<input type="hidden" name="id_menu" id="id_menu">
												<div class="input-group input-group-merge">
													<span class="input-group-text"><i data-feather="menu"></i></span>
													<input type="text" id="menu_name" class="form-control" name="menu_name" placeholder="Nama Menu" />
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-primary me-1" id="tombol_tambah">Simpan</button>
								<button type="button" class="btn btn-warning me-1" id="tombol_update">Update</button>
								<button type="reset" class="btn btn-outline-secondary">Reset</button>
							</div>
						</form>
					</div>
				</div>
			</div>

			<!-- Dend content -->

			<!-- mainMenu -->
			<div class="row" id="basic-table">
				<div class="col-12">
					<div class="card">
						<div class="card-header">
							<h4 class="card-title">Table MainMenu</h4>
							<button class="dt-button create-new btn btn-primary" type="button">
								<span><i data-feather='plus'></i> Add New MainMenu</span>
							</button>
						</div>
						<div class="card-body">
							<table class="table" id="myTable2">
								<thead>
									<tr>
										<th>Nama Menu</th>
										<th>Status</th>
										<th>Actions</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>
											<img src="<?= base_url('assets'); ?>/images/icons/angular.svg" class="me-75" height="20" width="20" alt="Angular" />
											<span class="fw-bold">Angular Project</span>
										</td>
										<td><span class="badge rounded-pill badge-light-primary me-1">Active</span></td>
										<td>
											<div class="dropdown">
												<button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0" data-bs-toggle="dropdown">
													<i data-feather="more-vertical"></i>
												</button>
												<div class="dropdown-menu dropdown-menu-end">
													<a class="dropdown-item" href="#">
														<i data-feather="edit-2" class="me-50"></i>
														<span>Edit</span>
													</a>
													<a class="dropdown-item" href="#">
														<i data-feather="trash" class="me-50"></i>
														<span>Delete</span>
													</a>
												</div>
											</div>
										</td>
									</tr>

								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			<!-- end mainMenu -->
		</div>
	</div>
</div>
<!-- END: Content-->

<?php $this->load->view('Components/v_footer'); ?>
<script src="//cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script>
	$(document).ready(function() {
		$('#myTable').DataTable();
		$('#myTable2').DataTable();
	});
</script>

<!-- Tambah hide Menu -->
<script>
	$(document).on("click", ".Tambah", function() {
		$('#judul_update').hide();
		$('#tombol_update').hide();
		$('#judul_tambah').show();
		$('#tombol_tambah').show();
	})
</script>
<!-- tambah data Menu -->
<script>
	$(document).on("click", "#tombol_tambah", function() {
		if (validasi()) {
			let data = $('#form').serialize();
			$.ajax({
				type: 'POST',
				url: '<?= site_url('Menu/Menu/Tambah') ?>',
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
							showConfirmButton: false,
							timer: 1500
						});
					}
					setTimeout(() => {
						window.location.assign('<?= site_url("Menu/Menu") ?>');
					}, 1500);
				}
			});
		}
	});

	function validasi() {
		var menu_name = document.getElementById("menu_name").value;
		if (menu_name == "") {
			notif("Nama Menu");
		} else {
			return true;
		}
	}
</script>

<!-- edit menu -->
<script>
	$(document).on("click", "#Edit", function() {
		$('#judul_update').show();
		$('#tombol_update').show();
		$('#judul_tambah').hide();
		$('#tombol_tambah').hide();
		var id = $(this).data('id');
		$.ajax({
			type: 'POST',
			url: '<?= site_url('Menu/Menu/View') ?>',
			data: {
				id: id
			},
			success: function(response) {
				var data = JSON.parse(response);
				if (data.success) {
					$('#id_menu').val(data.id_menu);
					$('#menu_name').val(data.menu_name);
				} else {
					Swal.fire({
						icon: 'warning',
						title: 'Warning',
						text: data.msg,
						showConfirmButton: false,
						timer: 1500
					});
				}
			}
		});
	});
</script>

<!-- close modal -->
<script>
	$(document).on("click", ".btn-close", function() {
		$('#id_menu').val("");
		$('#menu_name').val("");
	});
</script>

<!-- update data menu -->
<script>
	$(document).on("click", "#tombol_update", function() {
		if (validasi()) {
			let data = $('#form').serialize();
			$.ajax({
				type: 'POST',
				url: '<?= site_url('Menu/Menu/Update') ?>',
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
							showConfirmButton: false,
							timer: 1500
						});
					}
					setTimeout(() => {
						window.location.assign('<?= site_url("Menu/Menu") ?>');
					}, 1500);
				}
			});
		}
	});
</script>

<!-- hapus Menu -->
<script>
	$(document).on("click", ".Delete", function() {
		let id = $(this).data('id');
		Swal.fire({
			title: 'Are you sure?',
			text: "You won't be able to revert this!",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Yes, delete it!'
		}).then((result) => {
			if (result.isConfirmed) {
				$.ajax({
					type: 'POST',
					url: '<?= site_url('Menu/Menu/Delete') ?>',
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
							window.location.assign('<?php echo site_url("Menu/Menu") ?>');
						}, 1500);
					}
				});
			}
		})
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