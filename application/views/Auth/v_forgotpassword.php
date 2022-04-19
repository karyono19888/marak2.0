<?php $this->load->view('Auth/layouts/auth_header'); ?>

<body class="vertical-layout vertical-menu-modern blank-page navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="blank-page">
	<!-- BEGIN: Content-->
	<div class="app-content content ">
		<div class="content-overlay"></div>
		<div class="header-navbar-shadow"></div>
		<div class="content-wrapper">
			<div class="content-header row">
			</div>
			<div class="content-body">
				<div class="auth-wrapper auth-cover">
					<div class="auth-inner row m-0">
						<!-- Brand logo-->
						<a class="brand-logo" href="index.html">
							<img src="<?= base_url('assets'); ?>/images/logo/logo.png" alt="logo-brand" width="5%">
							<h2 class="brand-text text-primary ms-1">Marak</h2>
						</a>
						<!-- /Brand logo-->
						<!-- Left Text-->
						<div class="d-none d-lg-flex col-lg-8 align-items-center p-5">
							<div class="w-100 d-lg-flex align-items-center justify-content-center px-5"><img class="img-fluid" src="<?= base_url('assets'); ?>/images/pages/forgot-password-v2.svg" alt="Forgot password V2" /></div>
						</div>
						<!-- /Left Text-->
						<!-- Forgot password-->
						<div class="d-flex col-lg-4 align-items-center auth-bg px-2 p-lg-5">
							<div class="col-12 col-sm-8 col-md-6 col-lg-12 px-xl-2 mx-auto">
								<h2 class="card-title fw-bold mb-1">Forgot Password? 🔒</h2>
								<p class="card-text mb-2">Enter your email and we'll send you instructions to reset your password</p>
								<form class="auth-forgot-password-form mt-2" action="auth-reset-password-cover.html" method="POST">
									<div class="mb-1">
										<label class="form-label" for="forgot-password-email">Email</label>
										<input class="form-control" id="forgot-password-email" type="text" name="forgot-password-email" placeholder="john@example.com" aria-describedby="forgot-password-email" autofocus="" tabindex="1" />
									</div>
									<button class="btn btn-primary w-100" tabindex="2">Send reset link</button>
								</form>
								<p class="text-center mt-2"><a href="<?= base_url('Auth'); ?>"><i data-feather="chevron-left"></i> Back to login</a></p>
							</div>
						</div>
						<!-- /Forgot password-->
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- END: Content-->


	<?php $this->load->view('Auth/Layouts/auth_footer'); ?>
	<?php $this->load->view('Auth/Layouts/auth_buttom'); ?>