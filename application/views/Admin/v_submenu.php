<?php $this->load->view('Components/v_header'); ?>

<!-- BEGIN: Body-->


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
						<h2 class="content-header-title float-start mb-0">SubMenu</h2>
						<div class="breadcrumb-wrapper">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="<?= base_url('Administrator'); ?>">Administrator</a>
								</li>
								<li class="breadcrumb-item"><a href="#">Menu Management</a>
								</li>
								<li class="breadcrumb-item active">SubMenu
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
						<div class="dropdown-menu dropdown-menu-end">
							<a class="dropdown-item" href="app-todo.html">
								<i class="me-1" data-feather="check-square"></i>
								<span class="align-middle">Todo</span>
							</a>
							<a class="dropdown-item" href="app-chat.html">
								<i class="me-1" data-feather="message-square"></i>
								<span class="align-middle">Chat</span>
							</a>
							<a class="dropdown-item" href="app-email.html">
								<i class="me-1" data-feather="mail"></i>
								<span class="align-middle">Email</span>
							</a>
							<a class="dropdown-item" href="app-calendar.html">
								<i class="me-1" data-feather="calendar"></i>
								<span class="align-middle">Calendar</span>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="content-body">
			<!-- Dashboard Ecommerce Starts -->
			<p>content</p>
			<!-- Dashboard Ecommerce ends -->

		</div>
	</div>
</div>
<!-- END: Content-->

<?php $this->load->view('Components/v_footer'); ?>
<?php $this->load->view('Components/v_bottom'); ?>