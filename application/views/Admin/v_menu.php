<?php $this->load->view('Components/v_header'); ?>
<link rel="stylesheet" href="//cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="<?= base_url('assets'); ?>/vendors/css/forms/select/select2.min.css">
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
				<div class="col-6">
					<div class="card">
						<div class="card-header">
							<h4 class="card-title">Table Menu Roles</h4>
							<button class="dt-button create-new btn btn-primary Tambah" type="button" data-bs-toggle="modal" data-bs-target="#backdrop">
								<span><i data-feather='plus'></i> Add New Menu</span>
							</button>
						</div>
						<div class="card-body">
							<table class="table table-borderless" id="myTable">
								<thead>
									<tr>
										<th>Nama Menu</th>
										<th>Actions</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($menu->result_array() as $m) : ?>
										<tr>
											<td>
												<span class="fw-bold"><?= $m['menu_name']; ?></span>
											</td>
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
				<div class="col-6">
					<div class="pricing-free-trial">
						<div class="row">
							<div class="col-12 col-lg-10 col-lg-offset-3 mx-auto">
								<div class="pricing-trial-content d-flex justify-content-between">
									<div class="text-center text-md-start mt-3">
										<h3 class="text-primary">Menu Management</h3>
										<h5>You will get full access to with all the features.</h5>
									</div>

									<!-- image -->
									<img src="<?= base_url('assets') ?>/images/illustration/pricing-Illustration.svg" class="pricing-trial-img img-fluid" alt="svg img" />
								</div>
							</div>
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
							<button class="dt-button create-new btn btn-primary Tambah" type="button" data-bs-toggle="modal" data-bs-target="#ModalMainMenu">
								<span><i data-feather='plus'></i> Add New MainMenu</span>
							</button>
						</div>
						<div class="card-body">
							<table class="table table-borderless" id="myTable2">
								<thead>
									<tr>
										<th>User Menu</th>
										<th>Nama Main Menu</th>
										<th>URL</th>
										<th>Icon</th>
										<th>Status</th>
										<th>Actions</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($mainmenu->result_array() as $mm) : ?>
										<tr>
											<td>
												<span class="fw-bold"><?= $mm['menu_name']; ?></span>
											</td>
											<td>
												<i data-feather='<?= $mm['menu_icon']; ?>'></i>
												<span class="fw-bold"><?= $mm['menu_nama']; ?></span>
											</td>
											<td>
												<span class="fw-bold"><?= $mm['menu_url']; ?></span>
											</td>
											<td>
												<span class="fw-bold"><?= $mm['menu_icon']; ?></span>
											</td>
											<td>
												<?php if ($mm['is_active'] == 1) : ?>
													<span class="badge rounded-pill badge-light-primary me-1">Active</span>
												<?php else : ?>
													<span class="badge rounded-pill badge-light-danger me-1">Not Active</span>
												<?php endif; ?>
											</td>
											<td>
												<div class="dropdown">
													<button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0" data-bs-toggle="dropdown">
														<i data-feather="more-vertical"></i>
													</button>
													<div class="dropdown-menu dropdown-menu-end">
														<a class="dropdown-item EditMenu" href="#" data-id="<?= $mm['id']; ?>" data-bs-toggle="modal" data-bs-target="#ModalMainMenu">
															<i data-feather="edit-2" class="me-50"></i>
															<span>Edit</span>
														</a>
														<a class="dropdown-item HapusMenu" href="#" data-id="<?= $mm['id']; ?>">
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
			<!-- end mainMenu -->
		</div>
	</div>
</div>
<!-- END: Content-->
<!-- modal MainMenu -->
<div class="modal fade text-start" id="ModalMainMenu" tabindex="-1" aria-labelledby="myModalLabel4" data-bs-backdrop="false" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="judul_tambah1">Tambah Data</h4>
				<h4 class="modal-title" id="judul_update1">Update Data</h4>
				<button type="button" class="btn-close closeMenu " data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form class="form form-horizontal" method="POST" id="formMainmenu">
				<div class="modal-body">
					<div class="row">
						<div class="col-12">
							<div class="mb-1 row">
								<div class="col-sm-3">
									<label class="col-form-label" for="user_menu">User Menu</label>
								</div>
								<div class="col-sm-9">
									<select class="form-select" id="user_menu" name="user_menu" style="width: 100%;">
										<option value="">- Pilih -</option>
									</select>
									<input type="hidden" name="id" id="id">
								</div>
							</div>
						</div>
						<div class="col-12">
							<div class="mb-1 row">
								<div class="col-sm-3">
									<label class="col-form-label" for="menu_nama">Nama Menu</label>
								</div>
								<div class="col-sm-9">
									<div class="input-group input-group-merge">
										<span class="input-group-text"><i data-feather="menu"></i></span>
										<input type="text" id="menu_nama" class="form-control" name="menu_nama" placeholder="Nama Menu" />
									</div>
								</div>
							</div>
						</div>
						<div class="col-12">
							<div class="mb-1 row">
								<div class="col-sm-3">
									<label class="col-form-label" for="menu_url">URL</label>
								</div>
								<div class="col-sm-9">
									<div class="input-group input-group-merge">
										<span class="input-group-text"><i data-feather="link"></i></span>
										<input type="text" id="menu_url" class="form-control" name="menu_url" placeholder="Link Url" />
									</div>
								</div>
							</div>
						</div>
						<div class="col-12">
							<div class="mb-1 row">
								<div class="col-sm-3">
									<label class="col-form-label" for="menu_icon">Icon</label>
								</div>
								<div class="col-sm-9">
									<div class="input-group input-group-merge">
										<span class="input-group-text"><i data-feather="circle"></i></span>
										<input type="text" id="menu_icon" class="form-control" name="menu_icon" placeholder="Nama Icon" />
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-9 offset-sm-3">
							<div class="mb-1">
								<div class="form-check">
									<input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1" checked="checked" onclick="Aktif()" />
									<label class="form-check-label" for="is_active">Aktif ?</label>
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-primary me-1" id="tombol_tambah1">Simpan</button>
						<button type="button" class="btn btn-warning me-1" id="tombol_update1">Update</button>
						<button type="reset" class="btn btn-outline-secondary">Reset</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<?php $this->load->view('Components/v_footer'); ?>
<script src="//cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets'); ?>/vendors/js/forms/select/select2.full.min.js"></script>
<script src="<?= base_url('assets'); ?>/js/scripts/forms/form-select2.js"></script>
<!-- table -->
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

<!-- tambah MainMenu Hiden -->
<script>
	$(document).on("click", ".Tambah", function() {
		$('#judul_update1').hide();
		$('#tombol_update1').hide();
		$('#judul_tambah1').show();
		$('#tombol_tambah1').show();
	})
</script>

<!-- select2 usermenu -->
<script>
	$(document).ready(function() {
		$("#user_menu").select2({
			ajax: {
				url: '<?= base_url('Menu/Menu/selectUserMenu'); ?>',
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

<!-- tambah data MainMenu -->
<script>
	$(document).on("click", "#tombol_tambah1", function() {
		if (validasiMainMenu()) {
			let data = $('#formMainmenu').serialize();
			$.ajax({
				type: 'POST',
				url: '<?= site_url('Menu/Menu/TambahMainMenu') ?>',
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

	function validasiMainMenu() {
		let user_menu = document.getElementById("user_menu").value;
		let menu_nama = document.getElementById("menu_nama").value;
		let menu_url = document.getElementById("menu_url").value;
		let menu_icon = document.getElementById("menu_icon").value;
		let is_active = document.getElementById("is_active").value;
		if ((user_menu == "") || (menu_nama == "") || (menu_url == "") || (menu_icon == "") || (is_active == "")) {
			if (is_active == "") {
				notif("Status Aktif");
			}
			if (menu_icon == "") {
				notif("Menu Icon");
			}
			if (menu_url == "") {
				notif("Menu Url");
			}
			if (menu_nama == "") {
				notif("Main Menu");
			}
			if (user_menu == "") {
				notif("User Menu");
			}
		} else {
			return true;
		}
	}
</script>

<!-- edit menu -->
<script>
	$(document).on("click", ".EditMenu", function() {
		$('#judul_update1').show();
		$('#tombol_update1').show();
		$('#judul_tambah1').hide();
		$('#tombol_tambah1').hide();
		let id = $(this).data('id');
		let userMenu = "";
		let isactive = "";
		$.ajax({
			type: 'POST',
			url: '<?= site_url('Menu/Menu/ViewMenu') ?>',
			data: {
				id: id
			},
			success: function(response) {
				let data = JSON.parse(response);
				if (data.success) {
					$('#id').val(data.id);
					$('#menu_nama').val(data.menu_nama);
					$('#menu_url').val(data.menu_url);
					$('#menu_icon').val(data.menu_icon);
					userMenu += '<option value=' + data.id_menu + '>' + data.menu_name + '</option>';
					$('#user_menu').html(userMenu);
					if (data.is_active == 1) {
						document.getElementById("is_active").checked = true;
						$('#is_active').val(data.is_active);
					} else {
						document.getElementById("is_active").checked = false;
						$('#is_active').val(data.is_active);
					}
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
	$(document).on("click", ".closeMenu", function() {
		let html = "";
		$('#id').val("");
		html += '<option value="">- Pilih -</option>';
		$('#user_menu').html(html);
		$('#menu_nama').val("");
		$('#menu_url').val("");
		$('#menu_icon').val("");
		$('#is_active').val("");
		document.getElementById("is_active").checked = false;
	});
</script>

<!-- onlclick aktif -->
<script>
	function Aktif() {
		let check = document.getElementById("is_active");
		if (check.checked == true) {
			$('#is_active').val('1');
		} else {
			$('#is_active').val("0");
		}
	}
</script>

<!-- update data menu -->
<script>
	$(document).on("click", "#tombol_update1", function() {
		if (validasiMainMenu()) {
			let data = $('#formMainmenu').serialize();
			$.ajax({
				type: 'POST',
				url: '<?= site_url('Menu/Menu/UpdateMainMenu') ?>',
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

<!-- hapus MainMenu -->
<script>
	$(document).on("click", ".HapusMenu", function() {
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
					url: '<?= site_url('Menu/Menu/DeleteMainMenu') ?>',
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
<?php $this->load->view('Components/v_bottom'); ?>