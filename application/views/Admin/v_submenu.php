<?php $this->load->view('Components/v_header'); ?>

<link rel="stylesheet" type="text/css" href="<?= base_url('assets'); ?>/fonts/font-awesome/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="<?= base_url('assets'); ?>/vendors/css/extensions/jstree.min.css">
<link rel="stylesheet" type="text/css" href="<?= base_url('assets'); ?>/css/plugins/extensions/ext-component-tree.css">
<style>
	ul,
	#myUL {
		list-style-type: none;
	}

	#myUL {
		margin: 0;
		padding: 5;
	}


	.caret::before {
		color: black;
		display: inline-block;
	}


	.nested {
		display: none;
	}

	.active {
		display: block;
	}
</style>
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
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="content-body">
			<!-- mainMenu -->
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-header">
							<h4 class="card-title">SubMenu</h4>
							<button class="dt-button create-new btn btn-primary Tambah" type="button" data-bs-toggle="modal" data-bs-target="#ModalMainMenu">
								<span><i data-feather='plus'></i> Add New SubMenu</span>
							</button>
						</div>
					</div>
				</div>
			</div>
			<!-- end mainMenu -->
			<?php foreach ($mainMenu->result() as $sm) : ?>
				<?php
				$this->db->select('*');
				$this->db->where('menu_parentId', $sm->id);
				$this->db->join('user_menu', 'id_menu=menu_id', 'left');
				$subMenu  = $this->db->get('user_sub_menu');
				?>
				<ul id="myUL">
					<?php if ($subMenu->num_rows() > 0) : ?>
						<li>
							<span class="caret">
								<div class="row">
									<div class="col-sm-6">
										<div class="card">
											<div class="card-body">
												<div class="row">
													<div class="col-sm-5">

														<span><i class="fas fa-folder-plus"></i> <?= $sm->menu_nama; ?></span>
													</div>
													<div class="col-sm-2"></div>
													<div class="col-sm-5">
														<?php if ($sm->is_active == 1) : ?>
															<span class="badge rounded-pill badge-light-primary me-1">Active</span>
														<?php else : ?>
															<span class="badge rounded-pill badge-light-danger me-1">Not Active</span>
														<?php endif; ?>
														<button class="dt-button create-new btn btn-warning btn-sm" type="button">
															<span><i class="fas fa-pencil-alt"></i></span>
														</button>
														<button class="dt-button create-new btn btn-danger btn-sm" type="button">
															<span><i class="fas fa-trash-alt"></i></span>
														</button>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</span>
							<ul class="nested">
								<?php foreach ($subMenu->result() as $sub) : ?>
									<li>
										<div class="row">
											<div class="col-sm-6">
												<div class="card">
													<div class="card-body">
														<div class="row">
															<div class="col-sm-3">
																<span><i class="fas fa-caret-right"></i> <?= $sub->menu_nama; ?></span>
															</div>
															<div class="col-sm-4"></div>
															<div class="col-sm-5">
																<?php if ($sm->is_active == 1) : ?>
																	<span class="badge rounded-pill badge-light-primary me-1">Active</span>
																<?php else : ?>
																	<span class="badge rounded-pill badge-light-danger me-1">Not Active</span>
																<?php endif; ?>
																<button class="dt-button create-new btn btn-warning btn-sm" type="button">
																	<span><i class="fas fa-pencil-alt"></i></span>
																</button>
																<button class="dt-button create-new btn btn-danger btn-sm" type="button">
																	<span><i class="fas fa-trash-alt"></i></span>
																</button>
															</div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</li>
								<?php endforeach; ?>
							</ul>
						</li>
					<?php else : ?>
						<li>
							<div class="row">
								<div class="col-sm-6">
									<div class="card">
										<div class="card-body">
											<div class="row">
												<div class="col-sm-5">
													<span><i class="fas fa-caret-right"></i> <?= $sm->menu_nama; ?></span>
												</div>
												<div class="col-sm-2"></div>
												<div class="col-sm-5">
													<?php if ($sm->is_active == 1) : ?>
														<span class="badge rounded-pill badge-light-primary me-1">Active</span>
													<?php else : ?>
														<span class="badge rounded-pill badge-light-danger me-1">Not Active</span>
													<?php endif; ?>
													<button class="dt-button create-new btn btn-warning btn-sm" type="button">
														<span><i class="fas fa-pencil-alt"></i></span>
													</button>
													<button class="dt-button create-new btn btn-danger btn-sm" type="button">
														<span><i class="fas fa-trash-alt"></i></span>
													</button>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</li>
					<?php endif; ?>
				</ul>
			<?php endforeach; ?>
		</div>
	</div>
</div>
<!-- END: Content-->

<?php $this->load->view('Components/v_footer'); ?>

<script src="<?= base_url('assets'); ?>/vendors/js/extensions/jstree.min.js"></script>

<script src="<?= base_url('assets'); ?>/js/scripts/extensions/ext-component-tree.js"></script>
<script>
	var toggler = document.getElementsByClassName("caret");
	var i;

	for (i = 0; i < toggler.length; i++) {
		toggler[i].addEventListener("click", function() {
			this.parentElement.querySelector(".nested").classList.toggle("active");
			this.classList.toggle("caret-down");
		});
	}
</script>
<?php $this->load->view('Components/v_bottom'); ?>