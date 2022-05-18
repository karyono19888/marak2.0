<?php $this->load->view('Components/v_header'); ?>

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
						<h2 class="content-header-title float-start mb-0">User Access</h2>
						<div class="breadcrumb-wrapper">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="<?= base_url('Admin/Roles'); ?>">Role</a>
								</li>
								<li class="breadcrumb-item"><a href="#">User Access</a>
								</li>
								<li class="breadcrumb-item active"><?= $useraccess['role_name']; ?>
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
			<div class="row">
				<div class="col-sm-6">
					<div class="card">
						<div class="card-header">
							<h4 class="pt-50">Role : <?= $useraccess['role_name']; ?></h4>
							<div class="float-right">
								<a href="<?= base_url('Admin/Roles'); ?>" class="btn btn-dark">Back</a>
							</div>
						</div>
						<div class="card-body">
							<!-- Permission table -->
							<div class="table-responsive">
								<table class="table table-flush-spacing">
									<tbody>
										<?php foreach ($userMenu->result_array() as $m) : ?>
											<tr>
												<td class="text-nowrap fw-bolder"><?= $m['menu_name']; ?></td>
												<td>
													<div class="d-flex">
														<div class="form-check me-3 me-lg-5">
															<input class="form-check-input" type="checkbox" id="userManagementRead" <?= check_access($useraccess['role_id'], $m['id_menu']); ?> data-role="<?= $useraccess['role_id']; ?>" data-menu="<?= $m['id_menu']; ?>" />
															<label class="form-check-label" for="userManagementRead"> Read </label>
														</div>
														<div class="form-check me-3 me-lg-5">
															<input class="form-check-input" type="checkbox" id="userManagementWrite" />
															<label class="form-check-label" for="userManagementWrite"> Write </label>
														</div>
														<div class="form-check">
															<input class="form-check-input" type="checkbox" id="userManagementCreate" />
															<label class="form-check-label" for="userManagementCreate"> Create </label>
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
			</div>
			<!-- Dashboard Ecommerce ends -->

		</div>
	</div>
</div>
<!-- END: Content-->

<?php $this->load->view('Components/v_footer'); ?>
<script>
	$('.form-check-input').on('click', function() {
		const menuId = $(this).data('menu');
		const roleId = $(this).data('role');
		$.ajax({
			url: "<?= base_url('Admin/Roles/ChangeAccess'); ?>",
			type: "POST",
			data: {
				menuId: menuId,
				roleId: roleId
			},
			success: function(response) {
				let data = JSON.parse(response);
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
				document.location.href = "<?= base_url('Admin/Roles/UserAccess/') ?>" + roleId;
			}
		});
	})
</script>
<?php $this->load->view('Components/v_bottom'); ?>