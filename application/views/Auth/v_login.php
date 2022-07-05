<?php $this->load->view('Auth/layouts/auth_header'); ?>
<!-- BEGIN: Body-->

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
						<a class="brand-logo" href="#">
							<img src="<?= base_url('assets'); ?>/images/logo/logo-name.png" alt="logo-brand" width="8%">
							<!-- <h2 class="brand-text text-primary ms-1">MARAK</h2> -->
						</a>
						<!-- /Brand logo-->
						<!-- Left Text-->
						<div class="d-none d-lg-flex col-lg-8 align-items-center p-5">
							<div class="w-100 d-lg-flex align-items-center justify-content-center px-5"><img class="img-fluid" src="<?= base_url('assets'); ?>/images/pages/login-v2.svg" alt="Login V2" /></div>
						</div>
						<!-- /Left Text-->
						<!-- Login-->
						<div class="d-flex col-lg-4 align-items-center auth-bg px-2 p-lg-5">
							<div class="col-12 col-sm-8 col-md-6 col-lg-12 px-xl-2 mx-auto">
								<h2 class="card-title fw-bold mb-1">Welcome to Marak! 👋</h2>
								<p class="card-text mb-2">Please sign-in to your account and start the adventure</p>
								<?= $this->session->flashdata('message'); ?>
								<form class="auth-login-form mt-2" action="<?= base_url('Auth'); ?>" method="POST">
									<div class="mb-1">
										<label class="form-label" for="username">Username</label>
										<input class="form-control <?= form_error('username') ? 'is-invalid' : ''; ?>" id="username" type="text" name="username" placeholder="username" aria-describedby="username" autofocus="" tabindex="1" />
										<?= form_error('username', '<small class="text-sm text-danger">', '</small>'); ?>
									</div>
									<div class="mb-1">
										<div class="d-flex justify-content-between">
											<label class="form-label" for="password">Password</label>
											<a href="<?= base_url('Auth/forgotpassword'); ?>"><small>Forgot Password?</small></a>
										</div>
										<div class="input-group input-group-merge form-password-toggle">
											<input class="form-control form-control-merge <?= form_error('password') ? 'is-invalid' : ''; ?>" id="password" type="password" name="password" placeholder="············" aria-describedby="password" tabindex="2" /><span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
										</div>
										<?= form_error('password', '<small class="text-sm text-danger">', '</small>'); ?>
									</div>
									<div class="mb-1">
										<div class="form-check">
											<input class="form-check-input" id="remember-me" name="remember-me" type="checkbox" tabindex="3" />
											<label class="form-check-label" for="remember-me"> Remember Me</label>
										</div>
									</div>
									<button class="btn btn-primary w-100" type="submit" tabindex="4">Sign in</button>
								</form>
								<div class="divider my-2">
									<div class="divider-text"></div>
								</div>
								<div class="auth-footer-btn d-flex justify-content-center">
									<p class="social-text">
										&copy; Copyright <strong><span>Marak 2.0 | <?= date('Y'); ?></span></strong>
									</p>
								</div>
							</div>
						</div>
						<!-- /Login-->
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- END: Content-->

	<?php $this->load->view('Auth/layouts/auth_footer'); ?>
	<?php $this->load->view('Auth/layouts/auth_buttom'); ?>