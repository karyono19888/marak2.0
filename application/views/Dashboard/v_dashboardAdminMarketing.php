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
								<li class="breadcrumb-item"><a href="<?= base_url(); ?>">Admin Marketing</a>
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
				<!-- Stats Horizontal Card -->
				<div class="row">
					<div class="col-lg-4 col-sm-6 col-12">
						<div class="card">
							<div class="card-header">
								<div>
									<h2 class="fw-bolder mb-0">Rp. <?= number_format($totalClosebyAmmount, 0, '.', '.') ?>
										<small class="text-muted"><?= strlen($totalClosebyAmmount) > 3 ? 'Mil' : 'Jt' ?></small>
									</h2>
									<p class="card-text">Purchase Order</p>
								</div>
								<div class="avatar bg-light-success p-50 m-0">
									<div class="avatar-content">
										<i data-feather="shopping-bag" class="font-medium-5"></i>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-sm-6 col-12">
						<div class="card">
							<div class="card-header">
								<div>
									<h2 class="fw-bolder mb-0">Rp. <?= number_format($totalClosebyecataloge, 0, '.', '.') ?>
										<small class="text-muted"><?= strlen($totalClosebyecataloge) > 3 ? 'Mil' : 'Jt' ?></small>
									</h2>
									<p class="card-text">E-Cataloge</p>
								</div>
								<div class="avatar bg-light-danger p-50 m-0">
									<div class="avatar-content">
										<i data-feather="home" class="font-medium-5"></i>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-sm-6 col-12">
						<div class="card">
							<div class="card-header">
								<div>
									<h2 class="fw-bolder mb-0">Rp. <?= number_format($totalClosebyNonecataloge, 0, '.', '.') ?>
										<small
											class="text-muted"><?= strlen($totalClosebyNonecataloge) > 3 ? 'Mil' : 'Jt' ?></small>
									</h2>
									<p class="card-text">Non E-Cataloge</p>
								</div>
								<div class="avatar bg-light-primary p-50 m-0">
									<div class="avatar-content">
										<i data-feather="briefcase" class="font-medium-5"></i>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!--/ Stats Horizontal Card -->

				<div class="row">
					<div class="col-lg-4 col-md-6 col-12">
						<div class="card card-developer-meetup">
							<div class="meetup-img-wrapper rounded-top text-center">
								<img src="<?= base_url('assets'); ?>/images/illustration/email.svg" alt="Meeting Pic"
									height="140" width="100%" />
							</div>
							<div class="card-body">
								<div class="meetup-header d-flex align-items-center">
									<div class="meetup-day">
										<h6 class="mb-0"><?= date('D'); ?></h6>
										<h3 class="mb-0"><?= date('d'); ?></h3>
									</div>
									<div class="my-auto">
										<h4 class="card-title mb-25">Informasi Order</h4>
										<p class="card-text mb-0">Administrator</p>
									</div>
								</div>
								<div class="mt-2">
									<div class="avatar float-start bg-light-warning rounded me-1">
										<div class="avatar-content">
											<i data-feather="bell" class="avatar-icon font-medium-3"></i>
										</div>
									</div>
									<div class="more-info">
										<h6 class="mb-0"><?= $totalNewPo; ?></h6>
										<small>Order New Request</small>
									</div>
								</div>
								<div class="avatar-group">
									<?php foreach ($NewPoUser->result_array() as $a) : ?>
									<div data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="bottom"
										title="<?= $a['nickname']; ?>" class="avatar pull-up">
										<img src="<?= $a['image_user']; ?>" alt="Avatar" width="33" height="33" />
									</div>
									<?php endforeach; ?>
									<?php if (!$totalNewPo == 0) : ?>
									<a href="<?= base_url('OrderMasuk'); ?>"
										class="align-self-center cursor-pointer ms-50 btn-flat-primary">Lihat
										Data</a>
									<?php endif; ?>
								</div>
							</div>
						</div>
					</div>

					<!-- Revenue Report Card -->
					<div class="col-lg-8 col-12">
						<div class="card card-revenue-budget">
							<div class="row mx-0">
								<div class="col-md-12 col-12 revenue-report-wrapper">
									<div class="d-sm-flex justify-content-between align-items-center mb-3">
										<h4 class="card-title mb-50 mb-sm-0">Summary Weekly</h4>

									</div>
									<canvas id="myChart"
										style="min-height: 250px; height: 100%; max-height: 250px; max-width: 100%; width: 100%;"></canvas>
								</div>
							</div>
						</div>
					</div>
					<!--/ Revenue Report Card -->
				</div>

				<div class="row match-height">
					<!-- Timeline Card -->
					<div class="col-lg-4 col-12">
						<div class="card card-user-timeline">
							<div class="card-header">
								<div class="d-flex align-items-center">
									<i data-feather="list" class="user-timeline-title-icon"></i>
									<h4 class="card-title">User Activity Log</h4>
								</div>
							</div>
							<div class="card-body">
								<div class="card-block" style="margin-top: 20px; height: 350px; overflow:auto;">
									<ul class="timeline ms-50">
										<?php foreach ($log->result_array() as $a) : ?>
										<li class="timeline-item">
											<?php if ($a['log_tipe'] == 'Login') : ?>
											<span class="timeline-point timeline-point-indicator"></span>
											<?php elseif ($a['log_tipe'] == 'Logout') : ?>
											<span class="timeline-point timeline-point-indicator timeline-point-danger"></span>
											<?php else : ?>
											<span class="timeline-point timeline-point-indicator timeline-point-warning"></span>
											<?php endif; ?>
											<div class="timeline-event">
												<div class="d-flex justify-content-between flex-sm-row flex-column mb-sm-0 mb-1">
													<h6><?= $a['log_tipe']; ?></h6>
													<?php
														$post_date = strtotime($a['log_time']);
														$now = time();
														$units = 2;
														?>
													<span class="timeline-event-time me-1"><?= timespan($post_date, $now); ?></span>
												</div>
												<p>User "<?= $a['log_desc']; ?>" at
													<?= date('h:i:s a', strtotime($a['log_time'])); ?></p>
												<?php if ($this->session->userdata('id_user') == 1) : ?>
												<div class="d-flex flex-row align-items-center mb-50">
													<div class="avatar me-50">
														<img src="<?= $a['image_user']; ?>" alt="Avatar" width="38" height="38" />
													</div>
													<div class="user-info">
														<h6 class="mb-0"><?= $a['nickname']; ?></h6>
														<p class="mb-0"><?= $a['role_name']; ?></p>
													</div>
												</div>
												<?php endif; ?>
											</div>
										</li>
										<?php endforeach; ?>
									</ul>
								</div>
							</div>
						</div>
					</div>
					<!--/ Timeline Card -->
				</div>

			</section>
			<!-- Dashboard Ecommerce ends -->

		</div>
	</div>
</div>
<!-- END: Content-->

<?php $this->load->view('Components/v_footer'); ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
var ctx = document.getElementById('myChart').getContext('2d');
var chart = new Chart(ctx, {
	type: 'line',
	data: {
		labels: [
			<?php
				foreach ($number->result_array() as $row) {
					echo "'" . $row['tahun_minggu'] . "', ";
				}
				?>
		],
		datasets: [{
				label: 'PROSPEK',
				backgroundColor: '#36b9cc',
				borderColor: '#36b9cc',
				data: [
					<?php
						foreach ($weekly->result_array() as $row) {
							echo "'" . $row['prospek'] . "', ";
						}
						?>
				]
			},
			{
				label: 'PROGNOSA',
				backgroundColor: '#1cc88a',
				borderColor: '#1cc88a',
				data: [
					<?php
						foreach ($weekly->result_array() as $row) {
							echo "'" . $row['prognosa'] . "', ";
						}
						?>
				]
			},
			{
				label: 'Close PO',
				backgroundColor: '#FC4F4F',
				borderColor: '#FC4F4F',
				data: [
					<?php
						foreach ($weekly->result_array() as $row) {
							echo "'" . $row['close'] . "', ";
						}
						?>
				]
			}
		]
	},
	options: {
		responsive: true,
		plugins: {
			legend: {
				position: 'top',
			},
			title: {
				display: false,
				text: 'Summary Mingguan Semua Marketing'
			}
		}
	},
});
</script>
<?php $this->load->view('Components/v_bottom'); ?>