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
							<h4 class="mb-0">1.23k</h4>
							<small>Visit Total</small>
						</div>
					</div>
					<div class="d-flex align-items-start">
						<span class="badge bg-light-primary p-75 rounded">
							<i data-feather="briefcase" class="font-medium-2"></i>
						</span>
						<div class="ms-75">
							<h4 class="mb-0">568</h4>
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
			<h4 class="card-header">User Activity Timeline</h4>
			<div class="card-body pt-1">
				<ul class="timeline ms-50">
					<li class="timeline-item">
						<span class="timeline-point timeline-point-indicator"></span>
						<div class="timeline-event">
							<div class="d-flex justify-content-between flex-sm-row flex-column mb-sm-0 mb-1">
								<h6>User login</h6>
								<span class="timeline-event-time me-1">12 min ago</span>
							</div>
							<p>User login at 2:12pm</p>
						</div>
					</li>
					<li class="timeline-item">
						<span class="timeline-point timeline-point-warning timeline-point-indicator"></span>
						<div class="timeline-event">
							<div class="d-flex justify-content-between flex-sm-row flex-column mb-sm-0 mb-1">
								<h6>Meeting with john</h6>
								<span class="timeline-event-time me-1">45 min ago</span>
							</div>
							<p>React Project meeting with john @10:15am</p>
							<div class="d-flex flex-row align-items-center mb-50">
								<div class="avatar me-50">
									<img src="<?= base_url('assets'); ?>/images/portrait/small/avatar-s-7.jpg" alt="Avatar"
										width="38" height="38" />
								</div>
								<div class="user-info">
									<h6 class="mb-0">Leona Watkins (Client)</h6>
									<p class="mb-0">CEO of pixinvent</p>
								</div>
							</div>
						</div>
					</li>
					<li class="timeline-item">
						<span class="timeline-point timeline-point-info timeline-point-indicator"></span>
						<div class="timeline-event">
							<div class="d-flex justify-content-between flex-sm-row flex-column mb-sm-0 mb-1">
								<h6>Create a new react project for client</h6>
								<span class="timeline-event-time me-1">2 day ago</span>
							</div>
							<p>Add files to new design folder</p>
						</div>
					</li>
					<li class="timeline-item">
						<span class="timeline-point timeline-point-danger timeline-point-indicator"></span>
						<div class="timeline-event">
							<div class="d-flex justify-content-between flex-sm-row flex-column mb-sm-0 mb-1">
								<h6>Create Invoices for client</h6>
								<span class="timeline-event-time me-1">12 min ago</span>
							</div>
							<p class="mb-0">Create new Invoices and send to Leona Watkins</p>
							<div class="d-flex flex-row align-items-center mt-50">
								<img class="me-1" src="<?= base_url('assets'); ?>/images/icons/pdf.png" alt="data.json"
									height="25" />
								<h6 class="mb-0">Invoices.pdf</h6>
							</div>
						</div>
					</li>
				</ul>
			</div>
		</div>
		<!--/ post 1 -->

	</div>
	<!--/ center profile info section -->
</div>