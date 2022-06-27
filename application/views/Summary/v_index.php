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
						<h2 class="content-header-title float-start mb-0">Summary Marketing</h2>
						<div class="breadcrumb-wrapper">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="<?= base_url('Products'); ?>">Management</a>
								</li>
								<li class="breadcrumb-item active">Summary Marketing
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
									<h3 class="fw-bolder mb-75">12</h3>
									<span>Total Product</span>
								</div>
								<div class="avatar bg-light-primary p-50">
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
									<h3 class="fw-bolder mb-75">1212</h3>
									<span>E-Cataloge</span>
								</div>
								<div class="fw-bold text-body-heading">12 %</div>
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
									<h3 class="fw-bolder mb-75">23</h3>
									<span>Non E-Cataloge</span>
								</div>
								<div class="fw-bold text-body-heading">12 %</div>
								<div class="avatar bg-light-success p-50">
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
						<a href="<?= base_url('SummaryMarketing/Download'); ?>" class="dt-button create-new btn btn-primary Download" type="button">
							<span><i data-feather='download'></i> Download</span>
						</a>
					</div>
					<div class="card-body">
						<div class="card-datatable">
							<table class="table table-hover table-borderless" id="mytable" width="100%">
								<?php
								date_default_timezone_set('Asia/Jakarta'); # add your city to set local time zone
								$now = date('Y-m-d');
								$ref_date = strtotime($now);
								$week_of_year = date('W', $ref_date);
								?>
								<thead>
									<tr style="text-align:center;">
										<th rowspan="2">No</th>
										<th rowspan="2">PIC</th>
										<th rowspan="2">Sum of Target</th>
										<th rowspan="2">Sum of APBD(N)</th>
										<th rowspan="2">Sum of Prospect</th>
										<th rowspan="2">Sum of Prognosa</th>
										<th rowspan="2">Sum of PO Last Week <?= $week_of_year - 2; ?></th>
										<th rowspan="2">Sum of PO Current Week <?= $week_of_year - 1; ?></th>
										<th colspan="2">Sum of PO <?= date('Y'); ?></th>
										<th colspan="2">Estimasi PO + Prognosa <?= date('Y'); ?></th>
										<th rowspan="2">Count of Visit</th>
									</tr>
									<tr style="text-align:center;">
										<th>Sum of PO</th>
										<th width="6%">%</th>
										<th>Total PO</th>
										<th>%</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>1</td>
										<td>1</td>
										<td>1</td>
										<td>1</td>
										<td>1</td>
										<td>1</td>
										<td>1</td>
										<td>1</td>
										<td>1</td>
										<td>1</td>
										<td>1</td>
										<td>1</td>
										<td>1</td>
									</tr>
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
</script>
<?php $this->load->view('Components/v_bottom'); ?>