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
									<h3 class="fw-bolder mb-75">09</h3>
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
									<h3 class="fw-bolder mb-75">09</h3>
									<span>Total Draft</span>
								</div>
								<div class="avatar bg-light-warning p-50">
									<span class="avatar-content">
										<i data-feather="layers" class="font-medium-4"></i>
									</span>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-3 col-sm-6">
						<div class="card">
							<div class="card-body d-flex align-items-center justify-content-between">
								<div>
									<h3 class="fw-bolder mb-75">09</h3>
									<span>Total Terkunjungi</span>
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
									<h3 class="fw-bolder mb-75">12</h3>
									<span>Total Belum Terkunjungi</span>
								</div>
								<div class="avatar bg-light-danger p-50">
									<span class="avatar-content">
										<i data-feather="user" class="font-medium-4"></i>
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
						<a href="<?= base_url('Jadwal/Tambah'); ?>" class="dt-button create-new btn btn-primary Tambah" type="button">
							<span><i data-feather='plus'></i> Add New Jadwal</span>
						</a>
					</div>
					<div class="card-body">
						<div class="card-datatable">
							<table class="table table-hover table-borderless" id="mytable" width="100%">
								<thead>
									<tr>
										<th>#</th>
										<?php if ($this->session->userdata('role_user') == 1) : ?>
											<th>Pic</th>
										<?php endif; ?>
										<th>Date</th>
										<th>Type</th>
										<th>Instansi</th>
										<th>Activity</th>
										<th>Kunjungan</th>
										<th>Agenda</th>
										<th>Status</th>
										<th>Actions</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$i = 1;
									foreach ($jadwal->result_array() as $key) :
									?>
										<tr>
											<td><?= $i++; ?></td>
											<?php if ($this->session->userdata('role_user') == 1) : ?>
												<td><?= $key['name_user']; ?></td>
											<?php endif; ?>
											<td><?= $key['date_visit']; ?>, <?= $key['time']; ?></td>
											<td>
												<?php if ($key['new_or_update'] === '0') : ?>
													<span class="badge rounded-pill badge-light-primary me-1">New</span>
												<?php else : ?>
													<span class="badge rounded-pill badge-light-warning me-1">Update</span>
												<?php endif; ?>
											</td>
											<td><?= $key['instansi_nama']; ?></td>
											<td><?= $key['type_act']; ?></td>
											<td><?= $key['type_alamat']; ?></td>
											<td><?= $key['acara']; ?></td>
											<td>
												<?php if ($key['status'] == "Planning") : ?>
													<span class="badge rounded-pill badge-light-primary me-1"><?= $key['status']; ?></span>
												<?php elseif ($key['status'] == "Visited") : ?>
													<span class="badge rounded-pill badge-light-success me-1"><?= $key['status']; ?></span>
												<?php else : ?>
													<span class="badge rounded-pill badge-light-danger me-1"><?= $key['status']; ?></span>
												<?php endif; ?>
											</td>
											<td>
												<div class="btn-group" role="group" aria-label="Basic example">
													<?php if ($key['status'] == "Planning") : ?>
														<a href="<?= base_url('Jadwal/Edit/' . $key['id_jadwal']); ?>" type="button" class="btn btn-outline-warning btn-sm">Edit</a>
														<button type="button" class="btn btn-outline-danger btn-sm Hapus" data-id="<?= $key['id_jadwal']; ?>">Delete</button>
													<?php else : ?>
														<button type="button" class="btn btn-outline-info btn-sm Result" data-id="<?= $key['id_jadwal']; ?>">Result</button>
													<?php endif; ?>
													<?php if ($key['status'] == "Planning") : ?>
														<button type="button" class="btn btn-outline-primary btn-sm dropdown-toggle " data-bs-toggle="dropdown">Actions</button>
														<div class="dropdown-menu dropdown-menu-end">
															<a class="dropdown-item" href="">
																<i data-feather="twitch" class="text-success"></i>
																<span>Visited</span>
															</a>
															<a class="dropdown-item" href="">
																<i data-feather="file" class="text-danger"></i>
																<span>Not Visited</span>
															</a>
														</div>
												</div>
											<?php endif; ?>
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
</script>
<?php $this->load->view('Components/v_bottom'); ?>