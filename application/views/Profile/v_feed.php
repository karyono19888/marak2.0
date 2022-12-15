<div class="row">
	<!-- left profile info section -->
	<div class="col-lg-4 col-12 order-2 order-lg-1">

		<div class="card">
			<div class="card-body">
				<div class="d-flex justify-content-around my-2 pt-75">
					<div class="d-flex align-items-start me-2">
						<span class="badge bg-light-primary p-75 rounded">
							<i data-feather="check" class="font-medium-2"></i>
						</span>
						<div class="ms-75">
							<h4 class="mb-0"><?= number_format($total, 0, '.', '.'); ?></h4>
							<small>Visit Total</small>
						</div>
					</div>
					<div class="d-flex align-items-start">
						<span class="badge bg-light-primary p-75 rounded">
							<i data-feather="briefcase" class="font-medium-2"></i>
						</span>
						<div class="ms-75">
							<h4 class="mb-0">
								<?= number_format($close, 0, '.', '.'); ?><sup><?= strlen($close) > 3 ? 'Mil' : 'Jt' ?></sup>
							</h4>
							<small>Ammount PO</small>
						</div>
					</div>
				</div>
				<h4 class="fw-bolder border-bottom pb-50 mb-1">Details</h4>
				<div class="info-container">
					<ul class="list-unstyled">
						<li class="mb-75">
							<span class="fw-bolder me-25">Username:</span>
							<span><?= $profile->username; ?></span>
						</li>
						<li class="mb-75">
							<span class="fw-bolder me-25">Email:</span>
							<span><?= $profile->email_user; ?></span>
						</li>
						<li class="mb-75">
							<span class="fw-bolder me-25">Status:</span>
							<span class="badge bg-light-success">Active</span>
						</li>
						<li class="mb-75">
							<span class="fw-bolder me-25">Role:</span>
							<span><?= $profile->role_name; ?></span>
						</li>
						<li class="mb-75">
							<span class="fw-bolder me-25">Contact:</span>
							<span><?= $profile->phone; ?></span>
						</li>
						<li class="mb-75">
							<span class="fw-bolder me-25">Wilayah:</span>
							<span><?= $profile->state; ?></span>
						</li>
						<li class="mb-75">
							<span class="fw-bolder me-25">Joined:</span>
							<span><?= date('d-m-Y H:i:s', $profile->created_at); ?></span>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<!-- /User Card -->
	</div>
	<!--/ left profile info section -->

	<!-- center profile info section -->
	<div class="col-lg-8 col-12 order-1 order-lg-2">
		<!-- post 1 -->
		<div class="card">
			<h4 class="card-header">User Activity Log</h4>
			<div class="card-body pt-1">
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
								<p>User "<?= $a['log_desc']; ?>" at <?= date('h:i:s a', strtotime($a['log_time'])); ?></p>
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
		<!--/ post 1 -->

	</div>
	<!--/ center profile info section -->
</div>