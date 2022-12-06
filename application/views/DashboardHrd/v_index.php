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
						<h2 class="content-header-title float-start mb-0">Dashboard</h2>
						<div class="breadcrumb-wrapper">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="#">Human Resource Development</a>
								</li>
								<li class="breadcrumb-item active">Dashboard
								</li>
							</ol>
						</div>
					</div>
				</div>
			</div>
			<div class="content-header-right text-md-end col-md-3 col-12 d-md-block d-none">
				<div class="mb-1 breadcrumb-right">
					<div class="dropdown">
						<button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" type="button"
							data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i data-feather="grid"></i>
						</button>
					</div>
				</div>
			</div>
		</div>
		<div class="content-body">
			<!-- Dashboard Ecommerce Starts -->
			<section id="dashboard-ecommerce">
				<div class="row match-height">
					<!-- Medal Card -->
					<div class="col-xl-4 col-md-6 col-12">
						<div class="row">
							<!-- Bar Chart - Orders -->
							<div class="col-lg-6 col-md-3 col-6">
								<div class="card">
									<div class="card-body pb-50">
										<h6>Marketing Team</h6>
										<h2 class="fw-bolder mb-1">2,76 Activity</h2>
									</div>
								</div>
							</div>
							<!--/ Bar Chart - Orders -->

							<!-- Line Chart - Profit -->
							<div class="col-lg-6 col-md-3 col-6">
								<div class="card card-tiny-line-stats">
									<div class="card-body pb-50">
										<h6>Project Team</h6>
										<h2 class="fw-bolder mb-1">6,24 Activity</h2>
										<div id="statistics-profit-chart"></div>
									</div>
								</div>
							</div>
							<!--/ Line Chart - Profit -->

							<!-- Earnings Card -->
							<div class="col-lg-12 col-md-6 col-12">
								<div class="card">
									<div class="card-body">
										<div class="row">
											<div class="col-12">
												<h4 class="card-title mb-1">Summary</h4>
												<div class="font-small-2">Bulan ini</div>
												<h5 class="mb-1">1.234 Activity</h5>
												<p class="card-text text-muted font-small-2">
													<span class="fw-bolder">68.2%</span><span> more earnings than last month.</span>
												</p>
											</div>
										</div>
									</div>
								</div>
							</div>
							<!--/ Earnings Card -->
						</div>
					</div>
					<!--/ Medal Card -->

					<!-- Statistics Card -->
					<div class="col-xl-8 col-md-6 col-12">
						<div class="card card-statistics">
							<div class="card-header">
								<h4 class="card-title">Statistics</h4>
								<div class="d-flex align-items-center">
									<p class="card-text font-small-2 me-25 mb-0">Updated 1 month ago</p>
								</div>
							</div>
							<div class="card-body statistics-body">
								<div class="row">
									<div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
										<div class="d-flex flex-row">
											<div class="avatar bg-light-primary me-2">
												<div class="avatar-content">
													<i data-feather="trending-up" class="avatar-icon"></i>
												</div>
											</div>
											<div class="my-auto">
												<h4 class="fw-bolder mb-0">230k</h4>
												<p class="card-text font-small-3 mb-0">Sales</p>
											</div>
										</div>
									</div>
									<div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
										<div class="d-flex flex-row">
											<div class="avatar bg-light-info me-2">
												<div class="avatar-content">
													<i data-feather="user" class="avatar-icon"></i>
												</div>
											</div>
											<div class="my-auto">
												<h4 class="fw-bolder mb-0">8.549k</h4>
												<p class="card-text font-small-3 mb-0">Customers</p>
											</div>
										</div>
									</div>
									<div class="col-xl-3 col-sm-6 col-12 mb-2 mb-sm-0">
										<div class="d-flex flex-row">
											<div class="avatar bg-light-danger me-2">
												<div class="avatar-content">
													<i data-feather="box" class="avatar-icon"></i>
												</div>
											</div>
											<div class="my-auto">
												<h4 class="fw-bolder mb-0">1.423k</h4>
												<p class="card-text font-small-3 mb-0">Products</p>
											</div>
										</div>
									</div>
									<div class="col-xl-3 col-sm-6 col-12">
										<div class="d-flex flex-row">
											<div class="avatar bg-light-success me-2">
												<div class="avatar-content">
													<i data-feather="dollar-sign" class="avatar-icon"></i>
												</div>
											</div>
											<div class="my-auto">
												<h4 class="fw-bolder mb-0">$9745</h4>
												<p class="card-text font-small-3 mb-0">Revenue</p>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!--/ Statistics Card -->
				</div>
			</section>
			<!-- Dashboard Ecommerce ends -->

		</div>
	</div>
</div>
<!-- END: Content-->

<?php $this->load->view('Components/v_footer'); ?>
<?php $this->load->view('Components/v_bottom'); ?>