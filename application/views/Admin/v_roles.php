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
						<h2 class="content-header-title float-start mb-0">Roles</h2>
						<div class="breadcrumb-wrapper">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="<?= base_url('Administrator'); ?>">Administrator</a>
								</li>
								<li class="breadcrumb-item"><a href="#">Role & Permisson</a>
								</li>
								<li class="breadcrumb-item active">Role
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
			<h3>Roles List</h3>
			<p class="mb-2">
				A role provided access to predefined menus and features so that depending <br />
				on assigned role an administrator can have access to what he need
			</p>

			<!-- Role cards -->
			<div class="row">
				<?php
				foreach ($role->result_array() as $a) :
					$this->db->where('role_user', $a['role_id']);
					$numusers = $this->db->get('users');

					$users = $numusers->result();
				?>
					<div class="col-xl-4 col-lg-6 col-md-6">
						<div class="card">
							<div class="card-body">
								<div class="d-flex justify-content-between">
									<span>Total <?= $numusers->num_rows(); ?> users</span>
									<ul class="list-unstyled d-flex
									align-items-center avatar-group mb-0">
										<?php foreach ($numusers->result() as $key) : ?>
											<li data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" title="<?= $key->name_user; ?>" class="avatar avatar-sm pull-up">
												<img class="rounded-circle" src="<?= $key->image_user; ?>" alt="Avatar" />
											</li>
										<?php endforeach; ?>
									</ul>
								</div>
								<div class="d-flex justify-content-between align-items-end mt-1 pt-25">
									<div class="role-heading">
										<h4 class="fw-bolder"><?= $a['role_name']; ?></h4>
										<a href="<?= base_url('Admin/Roles/UserAccess/' . $a['role_id'] . ''); ?>" class="role-edit-modal btn btn-sm btn-warning">
											<small class="fw-bolder">User Access</small>
										</a>
										<a href="javascript:;" class="role-edit-modal Edit btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addRoleModal" data-id="<?= $a['role_id']; ?>">
											<small class="fw-bolder">Edit Role</small>
										</a>
										<?php if ($numusers->num_rows() == 0) : ?>
											<a href="javascript:;" class="role-edit-modal Hapus btn btn-sm btn-danger" data-id="<?= $a['role_id']; ?>">
												<small class="fw-bolder">Hapus</small>
											</a>
										<?php endif; ?>
									</div>
									<a href="javascript:void(0);" class="text-body"><i data-feather="copy" class="font-medium-5"></i></a>
								</div>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
				<div class="col-xl-4 col-lg-6 col-md-6">
					<div class="card">
						<div class="row">
							<div class="col-sm-5">
								<div class="d-flex align-items-end justify-content-center h-100">
									<img src="<?= base_url('assets'); ?>/images/illustration/faq-illustrations.svg" class="img-fluid mt-2" alt="Image" width="85" />
								</div>
							</div>
							<div class="col-sm-7">
								<div class="card-body text-sm-end text-center ps-sm-0">
									<a href="javascript:void(0)" data-bs-target="#addRoleModal" data-bs-toggle="modal" class="stretched-link text-nowrap add-new-role Tambah">
										<span class="btn btn-primary mb-1">Add New Role</span>
									</a>
									<p class="mb-0">Add role, if it does not exist</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!--/ Role cards -->

			<h3 class="mt-50">Total users with their roles</h3>
			<p class="mb-2">Find all of your company’s administrator accounts and their associate roles.</p>
			<!-- table -->
			<div class="card">
				<div class="card-body">
					<div class="table-responsive">
						<table class="user-list-table table-hover table table-borderless" id="mytable">
							<thead class="table-light">
								<tr>
									<th>No</th>
									<th>Name User</th>
									<th>Role</th>
									<th>Status</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
								<?php $i = 1;
								foreach ($tablerole->result_array() as $b) : ?>
									<tr>
										<td><?= $i++; ?></td>
										<td><?= $b['name_user']; ?></td>
										<td><?= $b['role_name']; ?></td>
										<td>
											<?php if ($b['is_active'] == 1) : ?>
												<span class="badge rounded-pill badge-light-primary me-1">Active</span>
											<?php elseif ($b['is_active'] == 2) : ?>
												<span class="badge rounded-pill badge-light-warning me-1">Suspend</span>
											<?php else : ?>
												<span class="badge rounded-pill badge-light-danger me-1">Not Active</span>
											<?php endif; ?>
										</td>
										<td width="10%">
											<a href="" type="button" class="btn btn-outline-primary round">Edit</a>
										</td>
									</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<!-- table -->

			<!-- Add Role Modal -->
			<div class="modal fade" id="addRoleModal" tabindex="-1" data-bs-backdrop="false" aria-hidden="true">
				<div class="modal-dialog modal-lg modal-dialog-centered modal-add-new-role">
					<div class="modal-content">
						<div class="modal-header bg-transparent">
							<button type="button" class="btn-close closeMenu" data-bs-dismiss="modal" aria-label="Close"></button>
						</div>
						<div class="modal-body px-5 pb-5">
							<div class="text-center mb-4">
								<h1 class="role-title" id="judul1">Add New Role</h1>
								<h1 class="role-title" id="judul2">Update Role</h1>
								<p>Set role permissions</p>
							</div>
							<!-- Add role form -->
							<form id="addRoleForm" class="row" onsubmit="return false" method="POST">
								<div class="col-12">
									<label for="role_name" class="form-label">Role Name</label>
									<input type="hidden" name="role_id" id="role_id">
									<input type="text" id="role_name" name="role_name" class="form-control" placeholder="Enter role name" tabindex="-1" data-msg="Please enter role name" />
								</div>
								<div class="col-12 text-center mt-2">
									<button type="submit" class="btn btn-primary me-1" id="save">Save</button>
									<button type="submit" class="btn btn-primary me-1" id="update">Update</button>
									<button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal" aria-label="Close">
										Discard
									</button>
								</div>
							</form>
							<!--/ Add role form -->
						</div>
					</div>
				</div>
			</div>
			<!--/ Add Role Modal -->

		</div>
	</div>
</div>
<!-- END: Content-->

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
		$('#judul2').hide();
		$('#update').hide();
		$('#judul1').show();
		$('#save').show();
	})
	$(document).on("click", "#save", function() {
		if (validasi()) {
			let data = $('#addRoleForm').serialize();
			$.ajax({
				type: 'POST',
				url: '<?= site_url('Admin/Roles/Tambah') ?>',
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
						window.location.assign('<?= site_url("Admin/Roles") ?>');
					}, 2000);
				}
			});
		}
	});

	function validasi() {
		let role_name = document.getElementById("role_name").value;
		if (role_name == "") {
			notif("Role Name");
		} else {
			return true;
		}
	}
</script>

<!-- Edit hide Menu -->
<script>
	$(document).on("click", ".Edit", function() {
		$('#judul2').show();
		$('#update').show();
		$('#judul1').hide();
		$('#save').hide();
		let id = $(this).data('id');
		$.ajax({
			type: 'POST',
			url: '<?= site_url('Admin/Roles/View') ?>',
			data: {
				id: id
			},
			success: function(response) {
				let data = JSON.parse(response);
				if (data.success) {
					$('#role_id').val(data.role_id);
					$('#role_name').val(data.role_name);
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
	})
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
		$('#role_id').val("");
		$('#role_name').val("");
	});
</script>

<!-- update data menu -->
<script>
	$(document).on("click", "#update", function() {
		if (validasi()) {
			let data = $('#addRoleForm').serialize();
			$.ajax({
				type: 'POST',
				url: '<?= site_url('Admin/Roles/Update') ?>',
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
						window.location.assign('<?= site_url("Admin/Roles") ?>');
					}, 1500);
				}
			});
		}
	});
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
					url: '<?= site_url('Admin/Roles/Delete') ?>',
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
							window.location.assign('<?php echo site_url("Admin/Roles") ?>');
						}, 1500);
					}
				});
			}
		})
	});
</script>
<?php $this->load->view('Components/v_bottom'); ?>