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
						<h2 class="content-header-title float-start mb-0">Tools</h2>
						<div class="breadcrumb-wrapper">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="<?= base_url('Marketing'); ?>">Marketing</a>
								</li>
								<li class="breadcrumb-item"><a href="#">Data Tools</a>
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
									<h3 class="fw-bolder mb-75"><?= $totaltool; ?></h3>
									<span>Total Tools</span>
								</div>
								<div class="avatar bg-light-primary p-50">
									<span class="avatar-content">
										<i data-feather="folder" class="font-medium-4"></i>
									</span>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-3 col-sm-6">
						<div class="card">
							<div class="card-body d-flex align-items-center justify-content-between">
								<div>
									<h3 class="fw-bolder mb-75"><?= $marketing; ?></h3>
									<span>Total Marketing</span>
								</div>
								<div class="avatar bg-light-warning p-50">
									<span class="avatar-content">
										<i data-feather="file-text" class="font-medium-4"></i>
									</span>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-3 col-sm-6">
						<div class="card">
							<div class="card-body d-flex align-items-center justify-content-between">
								<div>
									<h3 class="fw-bolder mb-75"><?= $general; ?></h3>
									<span>Total General</span>
								</div>
								<div class="avatar bg-light-success p-50">
									<span class="avatar-content">
										<i data-feather="file-plus" class="font-medium-4"></i>
									</span>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-3 col-sm-6">
						<div class="card">
							<div class="card-body d-flex align-items-center justify-content-between">
								<div>
									<h3 class="fw-bolder mb-75"><?= $tidakAktif; ?></h3>
									<span>Tools Tidak Aktif</span>
								</div>
								<div class="avatar bg-light-danger p-50">
									<span class="avatar-content">
										<i data-feather="file-minus" class="font-medium-4"></i>
									</span>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- list and filter start -->
				<?= $this->session->flashdata('message'); ?>
				<div class="card">
					<div class="card-header">
						<h4 class="card-title">Search & Filter</h4>
						<a href="<?= base_url('Tools/Tambah'); ?>" class="dt-button create-new btn btn-primary Tambah" type="button">
							<span><i data-feather='plus'></i> Add New Tools</span>
						</a>
					</div>
					<div class="card-body">
						<div class="card-datatable">
							<table class="table table-hover table-borderless" id="mytable" width="100%">
								<thead>
									<tr>
										<th>#</th>
										<th>Role</th>
										<th>Owner</th>
										<th>Type</th>
										<th>Nama File</th>
										<th>Status</th>
										<th>Actions</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$i = 1;
									foreach ($data->result_array() as $a) :
									?>
										<tr>
											<td><?= $i++; ?></td>
											<td><?= $a['tools_role']; ?></td>
											<td><?= $a['org_nama']; ?></td>
											<td><?= $a['tools_type']; ?></td>
											<td><?= $a['tools_nama']; ?></td>
											<td>
												<?php if ($a['tools_status'] === "Aktif") : ?>
													<span class="badge badge-light-primary">
														<i data-feather="unlock" class="me-25"></i>
														<span><?= $a['tools_status']; ?></span>
													</span>
												<?php else : ?>
													<span class="badge badge-light-danger">
														<i data-feather="lock" class="me-25"></i>
														<span><?= $a['tools_status']; ?></span>
													</span>
												<?php endif; ?>
											</td>
											<td>
												<div class="btn-group" role="group" aria-label="Basic example">
													<?php if ($this->session->userdata('role_user') == 1) : ?>
														<a href="<?= base_url('Tools/Edit/' . $a['tools_id']); ?>" type="button" class="btn btn-outline-warning btn-sm">Edit</a>
														<button type="button" class="btn btn-outline-danger btn-sm Hapus" data-id="<?= $a['tools_id']; ?>">Delete</button>
													<?php endif; ?>
													<button type="button" class="btn btn-outline-primary btn-sm dropdown-toggle " data-bs-toggle="dropdown">Share</button>
													<div class="dropdown-menu dropdown-menu-end">
														<a class="dropdown-item" href="whatsapp://send?text=<?= base_url('/assets/tools/' . $a['tools_upload']); ?>">
															<i data-feather="twitch" class="text-success"></i>
															<span>Whatsapp</span>
														</a>
														<a class="dropdown-item" href="<?= base_url('/assets/tools/' . $a['tools_upload']); ?>" target="_blank">
															<i data-feather="file" class="text-danger"></i>
															<span>Pdf</span>
														</a>
														<a class="dropdown-item" href="mailto:?subject=Tools Marakapp&amp;body=Check out this file : <?= base_url('/assets/tools/' . $a['tools_upload']); ?>" title="Share by Email tools Marakapp">
															<i data-feather="mail" class="text-primary"></i>
															<span>Email</span>
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

<?php $this->load->view('Components/v_footer'); ?>
<script src="//cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script>
	$(document).ready(function() {
		$('#mytable').DataTable();
	});

	$(document).on("click", ".Hapus", function() {
		let id = $(this).data('id');
		Swal.fire({
			title: 'Are you sure?',
			text: "Delete Tools Permanent!",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Yes, delete it!'
		}).then((result) => {
			if (result.isConfirmed) {
				$.ajax({
					type: 'POST',
					url: '<?= site_url('Tools/Delete') ?>',
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
							window.location.assign('<?php echo site_url("Tools") ?>');
						}, 1500);
					}
				});
			}
		})
	});
</script>
<?php $this->load->view('Components/v_bottom'); ?>