<?php $this->load->view('Components/v_header'); ?>
<link rel="stylesheet" type="text/css" href="<?= base_url('assets'); ?>/vendors/css/maps/leaflet.min.css">
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
		</div>
		<div class="content-body">
			<!-- Dashboard Ecommerce Starts -->
			<section id="dashboard-ecommerce">
				<div class="row match-height">
					<!-- Medal Card -->
					<div class="col-xl-4 col-md-6 col-12">
						<div class="card card-congratulation-medal">
							<div class="card-body">
								<h5>Congratulations 🎉 <?= $this->session->userdata('nickname'); ?>!</h5>
								<p class="card-text font-small-3">You have won gold medal</p>
								<h3 class="mb-75 mt-2 pt-50">
									<a href="#">
										<h4 class="fw-bolder mb-0"><?= number_format($totalClose, 0, '.', '.'); ?><sup><?= strlen($totalClose) > 3 ? 'MIL' : 'JT' ?></sup></h4>
									</a>

								</h3>
								<div class="progress-wrapper">
									<?php $close_vs_target = round($totalClose / $totalTargetMarketing * 100, 2); ?>
									<small>Close vs Target</small>
									<div class="progress progress-bar-primary">
										<div class="progress-bar" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: <?= $close_vs_target; ?>%"><?= $close_vs_target; ?>%</div>
									</div>
								</div>
								<?php if (strlen($totalClose) > 3) : ?>
									<img src="<?= base_url('assets'); ?>/images/illustration/badge.svg" class="congratulation-medal" alt="Medal Gols" />
								<?php elseif (strlen($totalClose) >= 2) : ?>
									<img src="<?= base_url('assets'); ?>/images/illustration/badge-brown.svg" class="congratulation-medal" alt="Medal Brown" />
								<?php else : ?>
									<img src="<?= base_url('assets'); ?>/images/illustration/badge-silver.svg" class="congratulation-medal" alt="Medal Silver" />
								<?php endif; ?>
							</div>
						</div>
					</div>
					<!--/ Medal Card -->

					<!-- Statistics Card -->
					<div class="col-xl-8 col-md-6 col-12">
						<div class="card card-statistics">
							<div class="card-header">
								<h4 class="card-title">Statistics by Ammount</h4>
								<div class="d-flex align-items-center">
									<p class="card-text font-small-2 me-25 mb-0">Satuan dalam jutaan (Rp)</p>
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
												<h4 class="fw-bolder mb-0"><?= number_format($totalApbn, 0, '.', '.'); ?><sup><small><?= strlen($totalApbn) > 3 ? 'Mil' : 'Jt' ?></small></sup></h4>
												<p class="card-text font-small-3 mb-0">APBN/D</p>
											</div>
										</div>
									</div>
									<div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
										<div class="d-flex flex-row">
											<div class="avatar bg-light-info me-2">
												<div class="avatar-content">
													<i data-feather="bar-chart-2" class="avatar-icon"></i>
												</div>
											</div>
											<div class="my-auto">
												<h4 class="fw-bolder mb-0"><?= number_format($totalProspek, 0, '.', '.'); ?><sup><small><?= strlen($totalProspek) > 3 ? 'Mil' : 'Jt' ?></small></sup></h4>
												<p class="card-text font-small-3 mb-0">Prospek</p>
											</div>
										</div>

										<!-- <div class="progress-wrapper">
											<?php $pros_vs_apbn = round($totalProspek / $totalApbn * 100, 2); ?>
											<small>Pros vs APBN</small>
											<div class="progress progress-bar-info">
												<div class="progress-bar" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: <?= $pros_vs_apbn; ?>%"><?= $pros_vs_apbn; ?>%</div>
											</div>
										</div> -->

									</div>
									<div class="col-xl-3 col-sm-6 col-12 mb-2 mb-sm-0">
										<div class="d-flex flex-row">
											<div class="avatar bg-light-success me-2">
												<div class="avatar-content">
													<i data-feather="sliders" class="avatar-icon"></i>
												</div>
											</div>
											<div class="my-auto">
												<h4 class="fw-bolder mb-0"><?= number_format($totalPrognosa, 0, '.', '.'); ?><sup><small><?= strlen($totalPrognosa) > 3 ? 'Mil' : 'Jt' ?></small></sup></h4>
												<p class="card-text font-small-3 mb-0">Prognosa</p>
											</div>
										</div>

										<!-- <div class="progress-wrapper">
											<?php $pros_vs_prog = round($totalPrognosa / $totalProspek * 100, 2); ?>
											<small>Prog vs Pros</small>
											<div class="progress progress-bar-success">
												<div class="progress-bar" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: <?= $pros_vs_prog; ?>%"><?= $pros_vs_prog; ?>%</div>
											</div>
										</div> -->

									</div>
									<div class="col-xl-3 col-sm-6 col-12">
										<div class="d-flex flex-row">
											<div class="avatar bg-light-danger me-2">
												<div class="avatar-content">
													<i data-feather="dollar-sign" class="avatar-icon"></i>
												</div>
											</div>
											<div class="my-auto">
												<h4 class="fw-bolder mb-0"><?= number_format($totalClose, 0, '.', '.'); ?><sup><small><?= strlen($totalClose) > 3 ? 'Mil' : 'Jt' ?></small></sup></h4>
												<p class="card-text font-small-3 mb-0">Close PO</p>
											</div>
										</div>

										<!-- <div class="progress-wrapper">
											<?php $prog_vs_close = round($totalClose / $totalPrognosa * 100, 2); ?>
											<small>Close vs Prog</small>
											<div class="progress progress-bar-danger">
												<div class="progress-bar" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: <?= $prog_vs_close; ?>%"><?= $prog_vs_close; ?>%</div>
											</div>
										</div> -->

									</div>
								</div>
							</div>
						</div>
					</div>
					<!--/ Statistics Card -->
				</div>

				<div class="row match-height">
					<div class="col-lg-4 col-12">
						<div class="row match-height">
							<!-- Bar Chart - Orders -->
							<div class="col-lg-6 col-md-3 col-6">
								<div class="card">
									<div class="card-body pb-50">
										<h6>Target <?= date('Y'); ?></h6>
										<h2 class="fw-bolder mb-1"><?= number_format($totalTargetMarketing, 0, '.', '.'); ?><sup><?= strlen($totalTargetMarketing) > 3 ? 'Mil' : 'Jt' ?></sup></h2>
										<div id="statistics-order-chart"></div>
									</div>
								</div>
							</div>
							<!--/ Bar Chart - Orders -->

							<!-- Line Chart - Profit -->
							<div class="col-lg-6 col-md-3 col-6">
								<div class="card card-tiny-line-stats">
									<div class="card-body pb-50">
										<h6>Total Visit <?= date('Y'); ?></h6>
										<h2 class="fw-bolder mb-1"><?= number_format($totalKunjungan, 0, '.', '.'); ?> <sup>x</sup></h2>
										<div id="statistics-profit-chart"></div>
									</div>
								</div>
							</div>
							<!--/ Line Chart - Profit -->

							<!-- Earnings Card -->
							<div class="col-lg-12 col-md-6 col-12">
								<div class="card earnings-card">
									<div class="card-body">
										<div class="row">
											<div class="col-12">
												<h6 class="mb-50 mb-sm-0">Grafik</h6>
												<canvas id="ChartMarket" style="min-height: 190px; height: 100%; max-height: 200px; max-width: 100%; width: 100%;"></canvas>
											</div>
										</div>
									</div>
								</div>
							</div>
							<!--/ Earnings Card -->
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
									<canvas id="myChart" style="min-height: 250px; height: 100%; max-height: 250px; max-width: 100%; width: 100%;"></canvas>
								</div>
							</div>
						</div>
					</div>
					<!--/ Revenue Report Card -->
				</div>

				<div class="row match-height">

					<!-- maps -->
					<div class="col-lg-12 col-md-12 col-12">
						<div class="card card-revenue-budget">
							<div class="row mx-0">
								<div class="col-md-12 col-12 revenue-report-wrapper">
									<div class="d-sm-flex justify-content-between align-items-center mb-3">
										<h4 class="card-title mb-50 mb-sm-0">Distribution Map</h4>
										<div class="d-flex align-items-center">
											<div class="d-flex align-items-center me-2">
												<span class="bullet bullet-primary font-small-3 me-50 cursor-pointer"></span>
												<span>Prospek</span>
											</div>
											<div class="d-flex align-items-center ms-75">
												<span class="bullet bullet-warning font-small-3 me-50 cursor-pointer"></span>
												<span>Prognosa</span>
											</div>
											<div class="d-flex align-items-center ms-75">
												<span class="bullet bullet-danger font-small-3 me-50 cursor-pointer"></span>
												<span>Close PO</span>
											</div>
										</div>
									</div>
									<div class="leaflet-map" id="user-location" style="height: 450px; border-radius:5px;"></div>
								</div>
							</div>
						</div>
					</div>
					<!--/ maps -->
				</div>
			</section>
			<!-- Dashboard Ecommerce ends -->

		</div>
	</div>
</div>
<!-- END: Content-->

<?php $this->load->view('Components/v_footer'); ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="<?= base_url('assets'); ?>/vendors/js/maps/leaflet.min.js"></script>
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

<!-- Batang market -->
<script>
	const dataMkt = {
		labels: [
			'Target',
			'Prospek',
			'Prognosa',
			'Close Po',
		],
		datasets: [{
			label: 'Target Pencapaian',
			data: [
				<?php foreach ($byMkt->result_array() as $data) : ?>
					<?= $data['target_mkt']; ?>,
					<?= $data['prospek']; ?>,
					<?= $data['prognosa'] - $data['close_po']; ?>,
					<?= $data['close_po']; ?>,
				<?php endforeach; ?>
			],
			backgroundColor: [
				'rgba(153, 102, 255, 0.2)',
				'rgba(255, 205, 86, 0.2)',
				'rgba(54, 162, 235, 0.2)',
				'rgba(75, 192, 192, 0.2)',
				'rgba(255, 99, 132, 0.2)',
				'rgba(255, 159, 64, 0.2)',
				'rgba(201, 203, 207, 0.2)'
			],
			borderColor: [
				'rgb(153, 102, 255)',
				'rgb(255, 205, 86)',
				'rgb(54, 162, 235)',
				'rgb(75, 192, 192)',
				'rgb(255, 99, 132)',
				'rgb(255, 159, 64)',
				'rgb(201, 203, 207)'
			],
			borderWidth: 1
		}]
	};

	const configmkt = {
		type: 'bar',
		data: dataMkt,
		options: {
			scales: {
				y: {
					beginAtZero: true
				}
			}
		}
	};

	const myChartmkt = new Chart(
		document.getElementById('ChartMarket'),
		configmkt
	);
</script>

<script>
	$(document).ready(function() {
		var lat = -1.4419606;
		var long = 116.2544584;
		var zoom = 5;
		let userLocation = L.map("user-location").setView([lat, long], zoom);
		userLocation.locate({
			setView: true,
			maxZoom: 18,
		});


		L.tileLayer("https://{s}.tile.osm.org/{z}/{x}/{y}.png", {
			attribution: 'Map data &copy; <a href="#">Marak 2.0</a>',
			maxZoom: 18,
		}).addTo(userLocation);
	})
</script>
<?php $this->load->view('Components/v_bottom'); ?>