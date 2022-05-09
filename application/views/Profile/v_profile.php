<?php $this->load->view('Components/v_header'); ?>

<link rel="stylesheet" type="text/css" href="<?= base_url('assets'); ?>/css/core/menu/menu-types/vertical-menu.css">
<link rel="stylesheet" type="text/css" href="<?= base_url('assets'); ?>/css/pages/page-profile.css">

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
						<h2 class="content-header-title float-start mb-0">Profile</h2>
						<div class="breadcrumb-wrapper">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="#">Home</a>
								</li>
								<li class="breadcrumb-item"><a href="#">Pages</a>
								</li>
								<li class="breadcrumb-item active">Profile
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
			<div id="user-profile">
				<!-- profile header -->
				<div class="row">
					<div class="col-12">
						<div class="card profile-header mb-2">
							<!-- profile cover photo -->
							<img class="card-img-top" src="<?= base_url("assets"); ?>/images/profile/user-uploads/timeline.jpg" alt="User Profile Image" />
							<!--/ profile cover photo -->

							<div class="position-relative">
								<!-- profile picture -->
								<div class="profile-img-container d-flex align-items-center">
									<div class="profile-img">
										<img src="<?= $profile->image_user ?>" class="rounded img-fluid" alt="Card image" width="100%" />
									</div>
									<!-- profile title -->
									<div class="profile-title ms-3">
										<h2 class="text-white"><?= $this->session->userdata('name_user'); ?></h2>
										<p class="text-white"><?= $profile->role_name; ?></p>
									</div>
								</div>
							</div>

							<!-- tabs pill -->
							<div class="profile-header-nav">
								<!-- navbar -->
								<nav class="navbar navbar-expand-md navbar-light justify-content-end justify-content-md-between w-100">
									<button class="btn btn-icon navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
										<i data-feather="align-justify" class="font-medium-5"></i>
									</button>

									<!-- collapse  -->
									<div class="collapse navbar-collapse" id="navbarSupportedContent">
										<div class="profile-tabs d-flex justify-content-between flex-wrap mt-1 mt-md-0">
											<ul class="nav nav-pills mb-0">
												<li class="nav-item">
													<a class="nav-link fw-bold active feed" href="#" id="feed">
														<span class="d-none d-md-block">Feed</span>
														<i data-feather="rss" class="d-block d-md-none"></i>
													</a>
												</li>
												<li class="nav-item">
													<a class="nav-link fw-bold" href="#" id="account">
														<span class="d-none d-md-block">Account</span>
														<i data-feather="info" class="d-block d-md-none"></i>
													</a>
												</li>
												<li class="nav-item">
													<a class="nav-link fw-bold" href="#" id="security">
														<span class="d-none d-md-block">Security</span>
														<i data-feather="image" class="d-block d-md-none"></i>
													</a>
												</li>
											</ul>
											<!-- edit button -->
											<button class="btn btn-primary">
												<i data-feather="edit" class="d-block d-md-none"></i>
												<span class="fw-bold d-none d-md-block">Edit</span>
											</button>
										</div>
									</div>
									<!--/ collapse  -->
								</nav>
								<!--/ navbar -->
							</div>
						</div>
					</div>
				</div>
				<!--/ profile header -->
				<?= $this->session->flashdata('message'); ?>
				<!-- profile info section -->
				<section id="profile-info">
					<div id="viewProfile"></div>
				</section>
				<!--/ profile info section -->
			</div>

		</div>
	</div>
</div>
<!-- END: Content-->


<?php $this->load->view('Components/v_footer'); ?>

<!-- BEGIN: Theme JS-->
<script src="<?= base_url("assets"); ?>/js/core/app-menu.js"></script>
<script src="<?= base_url("assets"); ?>/js/core/app.js"></script>
<!-- END: Theme JS-->

<!-- BEGIN: Page JS-->
<script src="<?= base_url("assets"); ?>/js/scripts/pages/page-profile.js"></script>
<!-- END: Page JS-->

<script src="<?= base_url('assets'); ?>/js/scripts/pages/page-account-settings-account.js"></script>

<script>
	$(window).on('load', function() {
		if (feather) {
			feather.replace({
				width: 14,
				height: 14
			});
		}
	})
</script>
<script>
	$(document).ready(function() {
		$('#viewProfile').load("<?= base_url('Profile/Feed') ?>");

		$("#feed").click(function() {
			$('#viewProfile').load("<?= base_url('Profile/Feed') ?>");
		});

		$("#account").click(function() {
			$("#viewProfile").load("<?= base_url('Profile/Account') ?>");
		});

		$("#security").click(function() {
			$("#viewProfile").load("<?= base_url('Profile/Security') ?>");
		});
		$('.nav-link').on('click', function() {
			$('.nav-link').removeClass('active');
			$(this).addClass('active');
		});
	});
</script>
<?php $this->load->view('Components/v_bottom'); ?>