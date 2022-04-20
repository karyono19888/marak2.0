<?php $this->load->view('Components/v_header'); ?>
<link rel="stylesheet" type="text/css" href="<?= base_url('assets'); ?>/vendors/css/vendors.min.css">
<link rel="stylesheet" type="text/css" href="<?= base_url('assets'); ?>/vendors/css/tables/datatable/dataTables.bootstrap5.min.css">
<link rel="stylesheet" type="text/css" href="<?= base_url('assets'); ?>/vendors/css/tables/datatable/responsive.bootstrap5.min.css">
<link rel="stylesheet" type="text/css" href="<?= base_url('assets'); ?>/vendors/css/tables/datatable/buttons.bootstrap5.min.css">
<?php $this->load->view('Components/v_headerbottom'); ?>
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
						<h2 class="content-header-title float-start mb-0">Menu</h2>
						<div class="breadcrumb-wrapper">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="<?= base_url('Administrator'); ?>">Administrator</a>
								</li>
								<li class="breadcrumb-item"><a href="#">Menu Management</a>
								</li>
								<li class="breadcrumb-item active">Menu
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
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="content-body">
			<!-- Content start -->
			<section id="basic-datatable">
				<div class="row">
					<div class="col-12">
						<div class="card">
							<table class="datatables-basic table">
								<thead>
									<tr>
										<th></th>
										<th></th>
										<th>id</th>
										<th>Name</th>
										<th>Email</th>
										<th>Date</th>
										<th>Salary</th>
										<th>Status</th>
										<th>Action</th>
									</tr>
								</thead>
							</table>
						</div>
					</div>
				</div>
				<!-- Modal to add new record -->
				<div class="modal modal-slide-in fade" id="modals-slide-in">
					<div class="modal-dialog sidebar-sm">
						<form class="add-new-record modal-content pt-0">
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
							<div class="modal-header mb-1">
								<h5 class="modal-title" id="exampleModalLabel">New Record</h5>
							</div>
							<div class="modal-body flex-grow-1">
								<div class="mb-1">
									<label class="form-label" for="basic-icon-default-fullname">Full Name</label>
									<input type="text" class="form-control dt-full-name" id="basic-icon-default-fullname" placeholder="John Doe" aria-label="John Doe" />
								</div>
								<div class="mb-1">
									<label class="form-label" for="basic-icon-default-post">Post</label>
									<input type="text" id="basic-icon-default-post" class="form-control dt-post" placeholder="Web Developer" aria-label="Web Developer" />
								</div>
								<div class="mb-1">
									<label class="form-label" for="basic-icon-default-email">Email</label>
									<input type="text" id="basic-icon-default-email" class="form-control dt-email" placeholder="john.doe@example.com" aria-label="john.doe@example.com" />
									<small class="form-text"> You can use letters, numbers & periods </small>
								</div>
								<div class="mb-1">
									<label class="form-label" for="basic-icon-default-date">Joining Date</label>
									<input type="text" class="form-control dt-date" id="basic-icon-default-date" placeholder="MM/DD/YYYY" aria-label="MM/DD/YYYY" />
								</div>
								<div class="mb-4">
									<label class="form-label" for="basic-icon-default-salary">Salary</label>
									<input type="text" id="basic-icon-default-salary" class="form-control dt-salary" placeholder="$12000" aria-label="$12000" />
								</div>
								<button type="button" class="btn btn-primary data-submit me-1">Submit</button>
								<button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
							</div>
						</form>
					</div>
				</div>
			</section>
			<!-- Dend content -->
		</div>
	</div>
</div>
<!-- END: Content-->

<?php $this->load->view('Components/v_footer'); ?>
<script src="<?= base_url('assets'); ?>/vendors/js/tables/datatable/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets'); ?>/vendors/js/tables/datatable/dataTables.bootstrap5.min.js"></script>
<script src="<?= base_url('assets'); ?>/vendors/js/tables/datatable/dataTables.responsive.min.js"></script>
<script src="<?= base_url('assets'); ?>/vendors/js/tables/datatable/responsive.bootstrap5.min.js"></script>
<script src="<?= base_url('assets'); ?>/vendors/js/tables/datatable/datatables.checkboxes.min.js"></script>
<script src="<?= base_url('assets'); ?>/vendors/js/tables/datatable/datatables.buttons.min.js"></script>
<script src="<?= base_url('assets'); ?>/js/scripts/tables/table-datatables-basic.js"></script>
<?php $this->load->view('Components/v_bottom'); ?>