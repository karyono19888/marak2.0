<div class="row">
	<!-- left profile info section -->
	<div class="col-lg-3 col-12 order-2 order-lg-1">
		<!-- about -->
		<div class="card">
			<div class="card-body">
				<h5 class="mb-75">Username</h5>
				<p class="card-text">
					<?= $profile->username; ?>
				</p>
				<div class="mt-2">
					<h5 class="mb-75">Joined:</h5>
					<p class="card-text"><?= date('d-m-Y H:i:s', $profile->created_at); ?></p>
				</div>
				<div class="mt-2">
					<h5 class="mb-75">Role:</h5>
					<p class="card-text"><?= $profile->role_name; ?></p>
				</div>
				<div class="mt-2">
					<h5 class="mb-75">Email:</h5>
					<p class="card-text"><?= $profile->email_user; ?></p>
				</div>
				<div class="mt-2">
					<h5 class="mb-50">Wilayah:</h5>
					<p class="card-text mb-0"><?= $profile->state; ?></p>
				</div>
			</div>
		</div>
		<!--/ about -->
	</div>
	<!--/ left profile info section -->

	<!-- center profile info section -->
	<div class="col-lg-6 col-12 order-1 order-lg-2">
		<!-- post 1 -->
		<div class="card">
			<div class="card-body">
				<div class="d-flex justify-content-start align-items-center mb-1">
					<!-- avatar -->
					<div class="avatar me-1">
						<img src="<?= $profile->image_user; ?>" alt="avatar img" height="50" width="50" />
					</div>
					<!--/ avatar -->
					<div class="profile-user-info">
						<h6 class="mb-0"><?= $profile->name_user; ?></h6>
						<small class="text-muted">12 Dec 2018 at 1:16 AM</small>
					</div>
				</div>
				<p class="card-text">
					Wonderful Machine· A well-written bio allows viewers to get to know a photographer beyond the work. This
					can make the difference when presenting to clients who are looking for the perfect fit.
				</p>
			</div>
		</div>
		<!--/ post 1 -->

	</div>
	<!--/ center profile info section -->

	<!-- right profile info section -->
	<div class="col-lg-3 col-12 order-3">


		<!-- polls card -->
		<div class="card">
			<div class="card-body">
				<h5 class="mb-1">Target</h5>
				<p class="card-text mb-0">Rp. 30.000.000</p>

				<!-- polls -->
				<div class="profile-polls-info mt-2">
					<!-- custom radio -->
					<div class="d-flex justify-content-between">
						<div class="form-check">
							<input type="radio" id="bestActorPoll1" name="bestActorPoll" class="form-check-input" />
							<label class="form-check-label" for="bestActorPoll1">RDJ</label>
						</div>
						<div class="text-end">82%</div>
					</div>
					<!--/ custom radio -->

					<!-- progressbar -->
					<div class="progress progress-bar-primary my-50">
						<div class="progress-bar" role="progressbar" aria-valuenow="58" aria-valuemin="58" aria-valuemax="100">
						</div>
					</div>
					<!--/ progressbar -->

					<!-- avatar group with tooltip -->
					<div class=" avatar-group my-1">
						<div data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="bottom" title="Tonia Seabold" class="avatar pull-up">
							<img src="<?= base_url("assets"); ?>/images/portrait/small/avatar-s-12.jpg" alt="Avatar" height="26" width="26" />
						</div>
						<div data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="bottom" title="Carissa Dolle" class="avatar pull-up">
							<img src="<?= base_url("assets"); ?>/images/portrait/small/avatar-s-5.jpg" alt="Avatar" height="26" width="26" />
						</div>
						<div data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="bottom" title="Kelle Herrick" class="avatar pull-up">
							<img src="<?= base_url("assets"); ?>/images/portrait/small/avatar-s-9.jpg" alt="Avatar" height="26" width="26" />
						</div>
						<div data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="bottom" title="Len Bregantini" class="avatar pull-up">
							<img src="<?= base_url("assets"); ?>/images/portrait/small/avatar-s-10.jpg" alt="Avatar" height="26" width="26" />
						</div>
						<div data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="bottom" title="John Doe" class="avatar pull-up">
							<img src="<?= base_url("assets"); ?>/images/portrait/small/avatar-s-11.jpg" alt="Avatar" height="26" width="26" />
						</div>
					</div>
					<!--/ avatar group with tooltip -->
				</div>
			</div>
		</div>
		<!--/ polls card -->
	</div>
	<!--/ right profile info section -->
</div>

<!-- reload button -->
<div class="row">
	<div class="col-12 text-center">
		<button type="button" class="btn btn-sm btn-primary block-element border-0 mb-1">Load More</button>
	</div>
</div>