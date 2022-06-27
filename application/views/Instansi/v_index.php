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
						<h2 class="content-header-title float-start mb-0">Instansi</h2>
						<div class="breadcrumb-wrapper">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="<?= base_url('Marketing'); ?>">Marketing</a>
								</li>
								<li class="breadcrumb-item active">Data Instansi
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
									<h3 class="fw-bolder mb-75"><?= $totalsemuapelanggan; ?></h3>
									<span>Total Semua Pelanggan</span>
								</div>
								<div class="avatar bg-light-primary p-50">
									<span class="avatar-content">
										<i data-feather="users" class="font-medium-4"></i>
									</span>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-3 col-sm-6">
						<div class="card">
							<div class="card-body d-flex align-items-center justify-content-between">
								<div>
									<h3 class="fw-bolder mb-75"><?= $totalpemerintahan; ?></h3>
									<span>Total Pemerintahan</span>
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
									<h3 class="fw-bolder mb-75"><?= $totalswasta; ?></h3>
									<span>Total Swasta</span>
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
									<h3 class="fw-bolder mb-75"><?= $totalperorangan; ?></h3>
									<span>Total Perorangan</span>
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
						<a href="<?= base_url('Instansi/Tambah'); ?>" class="dt-button create-new btn btn-primary Tambah" type="button">
							<span><i data-feather='plus'></i> Add New Instansi</span>
						</a>
					</div>
					<div class="card-body">
						<div class="card-datatable">
							<table class="table table-hover table-borderless" id="mytable" width="100%">
								<thead>
									<tr>
										<th>#</th>
										<th>Gol</th>
										<th>Nama</th>
										<th>Alamat</th>
										<th>Provinsi</th>
										<th>Kab/Kota</th>
										<th>Status</th>
										<?php if ($this->session->userdata('role_user') == 1) : ?>
											<th>Actions</th>
										<?php endif; ?>
									</tr>
								</thead>
								<tbody>
									<?php
									$i = 1;
									foreach ($datainstansi->result_array() as $m) :
									?>
										<tr>
											<td class="text-center"><?= $i++; ?></td>
											<td><?= $m['instansi_kategori']; ?></td>
											<td><?= $m['instansi_nama']; ?></td>
											<td><?= $m['instansi_alamat']; ?></td>
											<td><?= $m['prov_nama']; ?></td>
											<td><?= $m['kab_nama']; ?></td>
											<td>
												<?php if ($m['instansi_lok'] === "Belum Penlok") : ?>
													<span class="badge badge-light-primary">
														<i data-feather="unlock" class="me-25"></i>
														<span><?= $m['instansi_lok']; ?></span>
													</span>
												<?php else : ?>
													<span class="badge badge-light-danger">
														<i data-feather="lock" class="me-25"></i>
														<span><?= $m['instansi_lok']; ?></span>
													</span>
												<?php endif; ?>
											</td>
											<?php if ($this->session->userdata('role_user') == 1) : ?>
												<td width="12%">
													<a href="<?= base_url('Instansi/Edit/' . $m['instansi_id']) ?>" type="button" class="btn btn-warning btn-sm">Edit</a>
													<a href="#" data-id="<?= $m['instansi_id']; ?>" type="button" class="btn btn-danger btn-sm Hapus">Delete</a>
												</td>
											<?php endif; ?>
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

<!-- BEGIN: Page Vendor JS-->
<script src="<?= base_url('assets'); ?>/vendors/js/forms/select/select2.full.min.js"></script>
<!-- END: Page Vendor JS-->
<!-- BEGIN: Theme JS-->
<script src="<?= base_url('assets'); ?>/js/core/app-menu.js"></script>
<script src="<?= base_url('assets'); ?>/js/core/app.js"></script>
<!-- END: Theme JS-->

<script src="//cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script>
	$(document).ready(function() {
		$('#mytable').DataTable();
	});
</script>

<!-- hapus User -->
<script>
	$(document).on("click", ".Hapus", function() {
		let id = $(this).data('id');
		Swal.fire({
			title: 'Are you sure?',
			text: "Delete instansi!",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Yes, delete it!'
		}).then((result) => {
			if (result.isConfirmed) {
				$.ajax({
					type: 'POST',
					url: '<?= site_url('Instansi/Delete') ?>',
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
							window.location.assign('<?php echo site_url("Instansi") ?>');
						}, 1500);
					}
				});
			}
		})
	});
</script>


<?php $this->load->view('Components/v_bottom'); ?>