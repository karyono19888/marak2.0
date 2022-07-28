<?php $this->load->view('Components/v_header'); ?>
<link rel="stylesheet" type="text/css" href="<?= base_url('assets'); ?>/css/components.css">
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
						<h2 class="content-header-title float-start mb-0">Products</h2>
						<div class="breadcrumb-wrapper">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="<?= base_url('Products'); ?>">Products</a>
								</li>
								<li class="breadcrumb-item"><a href="#">Product Management</a>
								</li>
								<li class="breadcrumb-item active">Data Products
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
									<span>Total Product</span>
								</div>
								<div class="avatar bg-light-primary p-50">
									<span class="avatar-content">
										<i data-feather="box" class="font-medium-4"></i>
									</span>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-3 col-sm-6">
						<div class="card">
							<div class="card-body d-flex align-items-center justify-content-between">
								<div>
									<h3 class="fw-bolder mb-75"><?= $totalEcataloge; ?></h3>
									<span>E-Cataloge</span>
								</div>
								<?php $presentaseE = round($totalEcataloge / $total * 100, 2); ?>
								<div class="fw-bold text-body-heading <?= $presentaseE > 50 ? 'text-success' : 'text-danger'; ?>"><?= $presentaseE; ?> %</div>
								<div class="avatar bg-light-warning p-50">
									<span class="avatar-content">
										<i data-feather="briefcase" class="font-medium-4"></i>
									</span>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-3 col-sm-6">
						<div class="card">
							<div class="card-body d-flex align-items-center justify-content-between">
								<div>
									<h3 class="fw-bolder mb-75"><?= $totalNon; ?></h3>
									<span>Non E-Cataloge</span>
								</div>
								<?php $presentaseNon = round($totalNon / $total * 100, 2); ?>
								<div class="fw-bold text-body-heading <?= $presentaseNon > 50 ? 'text-success' : 'text-danger'; ?>"><?= $presentaseNon; ?> %</div>
								<div class="avatar bg-light-success p-50">
									<span class="avatar-content">
										<i data-feather="bookmark" class="font-medium-4"></i>
									</span>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- list and filter start -->
				<div id="show_data"></div>
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
<script>
	$(document).ready(function() {
		$("#show_data").load("<?= base_url('Products/ShowTableData'); ?>");
	});

	$(document).on("click", ".Tambah", function() {
		$("#show_data").load("<?= base_url('Products/ShowTambahData'); ?>");
	});

	$(document).on("click", ".Edit", function() {
		let id = $(this).data('id');
		$.ajax({
			type: "POST",
			url: "<?= site_url('Products/ShowDataEdit') ?>",
			data: {
				id: id
			},
			success: function(response) {
				$("#show_data").html(response);
			}
		});
	});

	$(document).on("click", ".Delete", function() {
		let id = $(this).data('id');
		Swal.fire({
			title: 'Are you sure?',
			text: "Delete Data Produk!",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Yes, delete it!'
		}).then((result) => {
			if (result.isConfirmed) {
				$.ajax({
					type: 'POST',
					url: '<?= site_url('Products/ProductDelete') ?>',
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
							window.location.assign('<?php echo site_url("Products") ?>');
						}, 1500);
					}
				});
			}
		})
	});
</script>
<?php $this->load->view('Components/v_bottom'); ?>