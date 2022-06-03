<?php $this->load->view('Components/v_header'); ?>

<link rel="stylesheet" href="//cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
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
						<h2 class="content-header-title float-start mb-0">User</h2>
						<div class="breadcrumb-wrapper">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="<?= base_url('Administrator'); ?>">Administrator</a>
								</li>
								<li class="breadcrumb-item"><a href="#">User</a>
								</li>
								<li class="breadcrumb-item active">List
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
									<h3 class="fw-bolder mb-75"><?= number_format($totaluser, 0, '.', '.'); ?></h3>
									<span>Total Users</span>
								</div>
								<div class="avatar bg-light-primary p-50">
									<span class="avatar-content">
										<i data-feather="user-plus" class="font-medium-4"></i>
									</span>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-3 col-sm-6">
						<div class="card">
							<div class="card-body d-flex align-items-center justify-content-between">
								<div>
									<h3 class="fw-bolder mb-75"><?= number_format($suspenduser, 0, '.', '.'); ?></h3>
									<span>Suspend Users</span>
								</div>
								<div class="avatar bg-light-warning p-50">
									<span class="avatar-content">
										<i data-feather="user" class="font-medium-4"></i>
									</span>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-3 col-sm-6">
						<div class="card">
							<div class="card-body d-flex align-items-center justify-content-between">
								<div>
									<h3 class="fw-bolder mb-75"><?= number_format($activeuser, 0, '.', '.'); ?></h3>
									<span>Active Users</span>
								</div>
								<div class="avatar bg-light-success p-50">
									<span class="avatar-content">
										<i data-feather="user-check" class="font-medium-4"></i>
									</span>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-3 col-sm-6">
						<div class="card">
							<div class="card-body d-flex align-items-center justify-content-between">
								<div>
									<h3 class="fw-bolder mb-75"><?= number_format($nonActiveuser, 0, '.', '.'); ?></h3>
									<span>Not Active Users</span>
								</div>
								<div class="avatar bg-light-danger p-50">
									<span class="avatar-content">
										<i data-feather="user-x" class="font-medium-4"></i>
									</span>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- list and filter start -->
				<div class="card">
					<div class="card-header">
						<h4 class="card-title">Search & Filter</h4>
						<button class="dt-button create-new btn btn-primary Tambah" type="button" data-bs-toggle="modal" data-bs-target="#ModalMainMenu">
							<span><i data-feather='plus'></i> Add New User</span>
						</button>
					</div>
					<div class="card-body">
						<div class="card-datatable table-responsive pt-0">
							<table class="user-list-table table table-borderless" id="mytable">
								<thead class="table-light">
									<tr>
										<th></th>
										<th>Name</th>
										<th>Role</th>
										<th>Email</th>
										<th>Username</th>
										<th>Status</th>
										<th>Actions</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$i = 1;
									foreach ($user->result_array() as $key) :
									?>
										<tr>
											<td class="text-center"><?= $i++; ?></td>
											<td>
												<div class="avatar">
													<img src="<?= $key['image_user']; ?>" height="26" width="26" al="<?= $key['name_user']; ?>" />

												</div>
												<span class="fw-bold"><?= $key['name_user']; ?></span>
											</td>
											<td><?= $key['role_name'];; ?></td>
											<td><?= $key['email_user']; ?></td>
											<td><?= $key['username']; ?></td>
											<td>
												<?php if ($key['is_active'] == 1) : ?>
													<span class="badge rounded-pill badge-light-primary me-1">Active</span>
												<?php elseif ($key['is_active'] == 2) : ?>
													<span class="badge rounded-pill badge-light-warning me-1">Suspend</span>
												<?php else : ?>
													<span class="badge rounded-pill badge-light-danger me-1">Not Active</span>
												<?php endif; ?>
											</td>
											<td class="text-center">
												<div class="dropdown">
													<button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0" data-bs-toggle="dropdown">
														<i data-feather="more-vertical"></i>
													</button>
													<div class="dropdown-menu dropdown-menu-end">
														<a class="dropdown-item Edit" href="#" data-id="<?= $key['id_user']; ?>" data-bs-toggle="modal" data-bs-target="#ModalMainMenu">
															<i data-feather="edit-2" class="me-50"></i>
															<span>Edit</span>
														</a>
														<a class="dropdown-item Hapus" href="#" data-id="<?= $key['id_user']; ?>">
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
				<!-- list and filter end -->
			</section>
			<!-- Dashboard Ecommerce ends -->

		</div>
	</div>
</div>
<!-- END: Content-->

<!-- modal MainMenu -->
<div class="modal fade text-start" id="ModalMainMenu" tabindex="-1" aria-labelledby="myModalLabel4" data-bs-backdrop="false" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="judul_tambah">Tambah Data</h4>
				<h4 class="modal-title" id="judul_update">Update Data</h4>
				<button type="button" class="btn-close closeMenu " data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form class="form form-horizontal" method="POST" id="formMainmenu">
				<div class="modal-body">
					<div class="row">
						<div class="col-12">
							<div class="mb-1 row">
								<div class="col-sm-3">
									<label class="col-form-label" for="role_user">User Role</label>
								</div>
								<div class="col-sm-9">
									<select class="form-select" id="role_user" name="role_user" style="width: 100%;">
										<option value="">- Pilih -</option>
										<?php foreach ($selectUserRole->result_array() as $i) : ?>
											<option value="<?= $i['role_id']; ?>"><?= $i['role_name']; ?></option>
										<?php endforeach; ?>
									</select>
									<input type="hidden" name="id_user" id="id_user">
								</div>
							</div>
						</div>
						<div class="col-12">
							<div class="mb-1 row">
								<div class="col-sm-3">
									<label class="col-form-label" for="name_user">Nama User</label>
								</div>
								<div class="col-sm-9">
									<div class="input-group input-group-merge">
										<span class="input-group-text"><i data-feather="user-check"></i></span>
										<input type="text" id="name_user" class="form-control" name="name_user" placeholder="Nama Lengkap" />
									</div>
								</div>
							</div>
						</div>
						<div class="col-12">
							<div class="mb-1 row">
								<div class="col-sm-3">
									<label class="col-form-label" for="username">Username</label>
								</div>
								<div class="col-sm-9">
									<div class="input-group input-group-merge">
										<span class="input-group-text"><i data-feather="link"></i></span>
										<input type="text" id="username" class="form-control" name="username" placeholder="Username" />
									</div>
								</div>
							</div>
						</div>
						<div class="col-12">
							<div class="mb-1 row">
								<div class="col-sm-3">
									<label class="col-form-label" for="password_user">Password</label>
								</div>
								<div class="col-sm-9">
									<div class="input-group input-group-merge">
										<span class="input-group-text"><i data-feather="lock"></i></span>
										<input type="password" id="password_user" class="form-control" name="password_user" placeholder="**********" />
									</div>
								</div>
							</div>
						</div>
						<div class="col-12">
							<div class="mb-1 row">
								<div class="col-sm-3">
									<label class="col-form-label" for="is_active">Status</label>
								</div>
								<div class="col-sm-9">
									<select class="form-select" id="is_active" name="is_active" style="width: 100%;">
										<option value="">- Pilih -</option>
										<option value="1">Aktif</option>
										<option value="2">Suspend</option>
										<option value="0">Tidak Aktif</option>
									</select>
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-primary me-1" id="tombol_tambah">Simpan</button>
						<button type="button" class="btn btn-warning me-1" id="tombol_update">Update</button>
						<button type="reset" class="btn btn-outline-secondary">Reset</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<?php $this->load->view('Components/v_footer'); ?>
<script src="//cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script>
	$(document).ready(function() {
		$('#mytable').DataTable();
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

<!-- simpan tambah -->
<script>
	$(document).on("click", "#tombol_tambah", function() {
		if (validasi()) {
			let data = $('#formMainmenu').serialize();
			$.ajax({
				type: 'POST',
				url: '<?= site_url('Admin/User/Tambah') ?>',
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
						window.location.assign('<?= site_url("Admin/User") ?>');
					}, 2000);
				}
			});
		}
	});

	function validasi() {
		let role_user = document.getElementById("role_user").value;
		let name_user = document.getElementById("name_user").value;
		let username = document.getElementById("username").value;
		let password = document.getElementById("password_user").value;
		let is_active = document.getElementById("is_active").value;
		if ((role_user == "") || (name_user == "") || (username == "") || (password == "") || (is_active == "")) {
			if (is_active == "") {
				notif("Status");
			}
			if (password == "") {
				notif("Password");
			}
			if (username == "") {
				notif("Username");
			}
			if (name_user == "") {
				notif("Nama User");
			}
			if (role_user == "") {
				notif("Role User");
			}
		} else {
			return true;
		}
	}
</script>

<!-- edit view -->
<script>
	$(document).on("click", ".Edit", function() {
		$('#judul_update').show();
		$('#tombol_update').show();
		$('#judul_tambah').hide();
		$('#tombol_tambah').hide();
		let id = $(this).data('id');
		let roleNama = "";
		let isactive = "";
		$.ajax({
			type: 'POST',
			url: '<?= site_url('Admin/User/View') ?>',
			data: {
				id: id
			},
			success: function(response) {
				let data = JSON.parse(response);
				if (data.success) {
					$('#id_user').val(data.id_user);
					$('#name_user').val(data.name_user);
					$('#username').val(data.username);
					roleNama += '<option value=' + data.role_id + '>' + data.role_name + '</option>';
					roleNama += '<?php foreach ($selectUserRole->result_array() as $data) { ?><option value="<?= $data['role_id'] ?>"><?= $data['role_name'] ?></option><?php } ?>';
					$('#role_user').html(roleNama);
					$('#is_active').val(data.is_active);
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

<!-- btn close modal -->
<script>
	$(document).on("click", ".closeMenu", function() {
		let html = '';
		let aktif = '';
		$('#id_user').val("");
		$('#name_user').val("");
		$('#username').val("");
		$('#password_user').val("");
		html += '<option value="">- Pilih -</option>';
		html += '<?php foreach ($selectUserRole->result_array() as $data) { ?><option value="<?= $data['role_id'] ?>"><?= $data['role_name'] ?></option><?php } ?>';
		$('#role_user').html(html);
	});
</script>

<!-- update data menu -->
<script>
	$(document).on("click", "#tombol_update", function() {
		if (validasiupdate()) {
			let data = $('#formMainmenu').serialize();
			$.ajax({
				type: 'POST',
				url: '<?= site_url('Admin/User/Update') ?>',
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
						window.location.assign('<?= site_url("Admin/User") ?>');
					}, 1500);
				}
			});
		}
	});

	function validasiupdate() {
		let role_user = document.getElementById("role_user").value;
		let name_user = document.getElementById("name_user").value;
		let username = document.getElementById("username").value;
		let is_active = document.getElementById("is_active").value;
		if ((role_user == "") || (name_user == "") || (username == "") || (is_active == "")) {
			if (is_active == "") {
				notif("Status");
			}
			if (username == "") {
				notif("Username");
			}
			if (name_user == "") {
				notif("Nama User");
			}
			if (role_user == "") {
				notif("Role User");
			}
		} else {
			return true;
		}
	}
</script>

<!-- hapus User -->
<script>
	$(document).on("click", ".Hapus", function() {
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
					url: '<?= site_url('Admin/User/Delete') ?>',
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
							window.location.assign('<?php echo site_url("Admin/User") ?>');
						}, 1500);
					}
				});
			}
		})
	});
</script>
<?php $this->load->view('Components/v_bottom'); ?>