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
						<h2 class="content-header-title float-start mb-0">Visit</h2>
						<div class="breadcrumb-wrapper">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="<?= base_url('Marketing'); ?>">Marketing</a>
								</li>
								<li class="breadcrumb-item"><a href="#">Data Kunjungan</a>
								</li>
								<li class="breadcrumb-item active">Kunjungan
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
									<h3 class="fw-bolder mb-75"><?= $totalkunjungan; ?></h3>
									<span>Total Kunjungan</span>
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
									<h3 class="fw-bolder mb-75"><?= $totalprospek; ?></h3>
									<span>Total Prospek</span>
								</div>
								<?php $presentaseprospek = round($totalprospek / $totalkunjungan * 100, 2); ?>
								<div class="fw-bold text-body-heading <?= $presentaseprospek > 50 ? 'text-success' : 'text-danger'; ?>"><?= $presentaseprospek; ?> %</div>
								<div class="avatar bg-light-primary p-50">
									<span class="avatar-content">
										<i data-feather="bar-chart-2" class="font-medium-4"></i>
									</span>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-3 col-sm-6">
						<div class="card">
							<div class="card-body d-flex align-items-center justify-content-between">
								<div>
									<h3 class="fw-bolder mb-75"><?= $totalprognosa; ?></h3>
									<span>Total Prognosa</span>
								</div>
								<?php $presentaseprognosa = round($totalprognosa / $totalkunjungan * 100, 2); ?>
								<div class="fw-bold text-body-heading <?= $presentaseprognosa > 50 ? 'text-success' : 'text-danger'; ?>"><?= $presentaseprognosa; ?> %</div>
								<div class="avatar bg-light-warning p-50">
									<span class="avatar-content">
										<i data-feather="trending-up" class="font-medium-4"></i>
									</span>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-3 col-sm-6">
						<div class="card">
							<div class="card-body d-flex align-items-center justify-content-between">
								<div>
									<h3 class="fw-bolder mb-75"><?= $totalclosepo; ?></h3>
									<span>Total Close PO</span>
								</div>
								<?php $presentaseclosepo = round($totalclosepo / $totalkunjungan * 100, 2); ?>
								<div class="fw-bold text-body-heading <?= $presentaseclosepo > 50 ? 'text-success' : 'text-danger'; ?>"><?= $presentaseclosepo; ?> %</div>
								<div class="avatar bg-light-danger p-50">
									<span class="avatar-content">
										<i data-feather="dollar-sign" class="font-medium-4"></i>
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
						<a href="<?= base_url('Visit/Tambah'); ?>" class="dt-button create-new btn btn-primary" id="Tambah" type="button" onclick="Tambah()">
							<span><i data-feather='plus'></i> Add New Visit</span>
						</a>
					</div>
					<div class="card-body">
						<div class="card-datatable">
							<table class="table table-hover table-borderless" id="mytable" width="100%">
								<thead>
									<tr>
										<th>#</th>
										<th>User</th>
										<th>Date</th>
										<th>Instansi</th>
										<th>Agenda</th>
										<th>Prospek</th>
										<th>Prognosa</th>
										<th>Close</th>
										<th>Status</th>
										<th>Actions</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$i = 1;
									foreach ($visit->result_array() as $key) :
									?>
										<tr>
											<td class="text-center"><?= $i++; ?></td>
											<td width="7%"><?= $key['name_user']; ?></td>
											<td width="10%"><?= date('d F, Y', strtotime($key['m_visit_tgl'])); ?></td>
											<td width="20%"><?= $key['instansi_nama']; ?></td>
											<td width="30%"><?= $key['m_visit_agenda']; ?></td>
											<td><?= number_format($key['m_visit_prospek'], 0, '.', '.'); ?></td>
											<td><?= number_format($key['m_visit_prognosa'], 0, '.', '.'); ?></td>
											<td><?= number_format($key['m_visit_po'], 0, '.', '.'); ?></td>
											<td>
												<?php if ($key['m_visit_status'] == "Close Po") : ?>
													<span class="badge rounded-pill badge-light-danger me-1"><?= $key['m_visit_status']; ?></span>
												<?php elseif ($key['m_visit_status'] == "Prognosa") : ?>
													<span class="badge rounded-pill badge-light-warning me-1"><?= $key['m_visit_status']; ?></span>
												<?php elseif ($key['m_visit_status'] == "Loss") : ?>
													<span class="badge rounded-pill badge-light-secondary me-1"><?= $key['m_visit_status']; ?></span>
												<?php else : ?>
													<span class="badge rounded-pill badge-light-primary me-1"><?= $key['m_visit_status']; ?></span>
												<?php endif; ?>
											</td>
											<td class="text-center" width="20%">
												<a href="<?= base_url('Visit/Preview/' . $key['m_visit_history_id']); ?>" type="button" class="btn btn-relief-warning btn-sm Edit">Preview</a>
												<?php if ($this->session->userdata('role_user') == 1) : ?>
													<a href="#" type="button" class="btn btn-relief-danger btn-sm Delete" data-id="<?= $key['m_visit_id']; ?>">Delete</a>
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

	function Tambah() {
		let element = document.getElementById("Tambah");
		element.classList.add("disabled");
		$('#Tambah').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> loading...')
	}

	$(document).on("click", ".Delete", function() {
		let id = $(this).data('id');
		Swal.fire({
			title: 'Are you sure?',
			text: "Hapus Permanent Data!",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Yes, delete it!'
		}).then((result) => {
			if (result.isConfirmed) {
				$.ajax({
					type: 'POST',
					url: '<?= site_url('Visit/Delete') ?>',
					data: {
						id: id
					},
					success: function(response) {
						let data = JSON.parse(response);
						if (data.success) {
							SweetAlert.fire({
								icon: 'success',
								title: 'Deleted!',
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
							window.location.assign('<?= site_url("Visit") ?>');
						}, 1500);
					}
				});
			}
		})
	});
</script>
<?php $this->load->view('Components/v_bottom'); ?>