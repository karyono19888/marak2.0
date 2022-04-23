<?php $this->load->view('Components/v_header'); ?>
<link rel="stylesheet" type="text/css" href="<?= base_url('assets'); ?>/fonts/font-awesome/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="<?= base_url('assets'); ?>/vendors/css/forms/select/select2.min.css">
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
							<button class="dt-button create-new btn btn-primary Tambah" type="button" data-bs-toggle="modal" data-bs-target="#ModalSubMenu">
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
																<?php if ($sub->is_active == 1) : ?>
																	<span class="badge rounded-pill badge-light-primary me-1">Active</span>
																<?php else : ?>
																	<span class="badge rounded-pill badge-light-danger me-1">Not Active</span>
																<?php endif; ?>
																<button class="dt-button create-new btn btn-warning btn-sm EditSubMenu" type="button" data-id="<?= $sub->id; ?>" data-bs-toggle="modal" data-bs-target="#ModalSubMenu">
																	<span><i class="fas fa-pencil-alt"></i></span>
																</button>
																<button class="dt-button create-new btn btn-danger btn-sm HapusMenu" type="button" data-id="<?= $sub->id; ?>">
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
					<?php endif; ?>
				</ul>
			<?php endforeach; ?>
		</div>
	</div>
</div>
<!-- END: Content-->

<!-- modal MainMenu -->
<div class="modal fade text-start" id="ModalSubMenu" tabindex="-1" aria-labelledby="myModalLabel4" data-bs-backdrop="false" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="judul_tambah1">Tambah Data</h4>
				<h4 class="modal-title" id="judul_update1">Update Data</h4>
				<button type="button" class="btn-close closeMenu " data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<form class="form form-horizontal" method="POST" id="formSubmenu">
				<div class="modal-body">
					<div class="row">
						<div class="col-12">
							<div class="mb-1 row">
								<div class="col-sm-3">
									<label class="col-form-label" for="main_menu">Main Menu</label>
								</div>
								<div class="col-sm-9">
									<select class="form-select" id="main_menu" name="main_menu" style="width: 100%;">
										<option value="">- Pilih -</option>
									</select>
									<input type="hidden" name="id" id="id">
								</div>
							</div>
						</div>
						<div class="col-12">
							<div class="mb-1 row">
								<div class="col-sm-3">
									<label class="col-form-label" for="menu_nama">Nama Menu</label>
								</div>
								<div class="col-sm-9">
									<div class="input-group input-group-merge">
										<span class="input-group-text"><i data-feather="menu"></i></span>
										<input type="text" id="menu_nama" class="form-control" name="menu_nama" placeholder="Nama Menu" />
									</div>
								</div>
							</div>
						</div>
						<div class="col-12">
							<div class="mb-1 row">
								<div class="col-sm-3">
									<label class="col-form-label" for="menu_url">URL</label>
								</div>
								<div class="col-sm-9">
									<div class="input-group input-group-merge">
										<span class="input-group-text"><i data-feather="link"></i></span>
										<input type="text" id="menu_url" class="form-control" name="menu_url" placeholder="Link Url" />
									</div>
								</div>
							</div>
						</div>
						<div class="col-12">
							<div class="mb-1 row">
								<div class="col-sm-3">
									<label class="col-form-label" for="menu_sub_icon">Icon</label>
								</div>
								<div class="col-sm-9">
									<div class="input-group input-group-merge">
										<span class="input-group-text"><i data-feather="circle"></i></span>
										<input type="text" id="menu_sub_icon" class="form-control" name="menu_sub_icon" placeholder="Nama Icon" />
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-9 offset-sm-3">
							<div class="mb-1">
								<div class="form-check">
									<input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1" checked="checked" onclick="Aktif()" />
									<label class="form-check-label" for="is_active">Aktif ?</label>
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-primary me-1" id="tombol_tambah1">Simpan</button>
						<button type="button" class="btn btn-warning me-1" id="tombol_update1">Update</button>
						<button type="reset" class="btn btn-outline-secondary">Reset</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<?php $this->load->view('Components/v_footer'); ?>
<script src="<?= base_url('assets'); ?>/vendors/js/forms/select/select2.full.min.js"></script>

<script>
	let toggler = document.getElementsByClassName("caret");
	let i;

	for (i = 0; i < toggler.length; i++) {
		toggler[i].addEventListener("click", function() {
			this.parentElement.querySelector(".nested").classList.toggle("active");
			this.classList.toggle("caret-down");
		});
	}
</script>

<!-- onlclick aktif -->
<script>
	function Aktif() {
		let check = document.getElementById("is_active");
		if (check.checked == true) {
			$('#is_active').val('1');
		} else {
			$('#is_active').val("0");
		}
	}
</script>

<!-- tambah SubMenu Hiden -->
<script>
	$(document).on("click", ".Tambah", function() {
		$('#judul_update1').hide();
		$('#tombol_update1').hide();
		$('#judul_tambah1').show();
		$('#tombol_tambah1').show();
	})
</script>

<!-- select2 usermenu -->
<script>
	$(document).ready(function() {
		$("#main_menu").select2({
			ajax: {
				url: '<?= base_url('Menu/SubMenu/selectMainMenu'); ?>',
				type: "post",
				dataType: 'json',
				delay: 200,
				data: function(params) {
					return {
						searchTerm: params.term
					};
				},
				processResults: function(response) {
					return {
						results: response
					};
				},
				cache: true
			}
		});
	});
</script>

<!-- tambah data SubMenu -->
<script>
	$(document).on("click", "#tombol_tambah1", function() {
		if (validasiSubMenu()) {
			let data = $('#formSubmenu').serialize();
			$.ajax({
				type: 'POST',
				url: '<?= site_url('Menu/SubMenu/TambahSubMenu') ?>',
				data: data,
				success: function(response) {
					var data = JSON.parse(response);
					if (data.success) {
						Swal.fire({
							icon: 'success',
							title: 'Success',
							text: data.msg,
							showConfirmButton: false,
							timer: 1500
						});
					} else {
						Swal.fire({
							icon: 'error',
							title: 'Error',
							text: data.msg,
							showConfirmButton: false,
							timer: 1500
						});
					}
					setTimeout(() => {
						window.location.assign('<?= site_url("Menu/SubMenu") ?>');
					}, 1500);
				}
			});
		}
	});

	function validasiSubMenu() {
		let main_menu = document.getElementById("main_menu").value;
		let menu_nama = document.getElementById("menu_nama").value;
		let menu_url = document.getElementById("menu_url").value;
		let menu_sub_icon = document.getElementById("menu_sub_icon").value;
		let is_active = document.getElementById("is_active").value;
		if ((main_menu == "") || (menu_nama == "") || (menu_url == "") || (menu_sub_icon == "") || (is_active == "")) {
			if (is_active == "") {
				notif("Status Aktif");
			}
			if (menu_sub_icon == "") {
				notif("Menu Sub Icon");
			}
			if (menu_url == "") {
				notif("Menu Url");
			}
			if (menu_nama == "") {
				notif("Main Menu");
			}
			if (main_menu == "") {
				notif("Main Menu");
			}
		} else {
			return true;
		}
	}
</script>

<!-- notif -->
<script>
	function notif(word) {
		Swal.fire({
			title: 'Perhatian',
			text: word + ' wajib di isi !',
			icon: 'info',
		}).then((result) => {})
	}
</script>

<!-- edit menu -->
<script>
	$(document).on("click", ".EditSubMenu", function() {
		$('#judul_update1').show();
		$('#tombol_update1').show();
		$('#judul_tambah1').hide();
		$('#tombol_tambah1').hide();
		let id = $(this).data('id');
		let main_menu = "";
		let isactive = "";
		$.ajax({
			type: 'POST',
			url: '<?= site_url('Menu/SubMenu/ViewEditSubMenu') ?>',
			data: {
				id: id
			},
			success: function(response) {
				let data = JSON.parse(response);
				if (data.success) {
					$('#id').val(data.id);
					$('#menu_nama').val(data.menu_nama);
					$('#menu_url').val(data.menu_url);
					if (data.menu_sub_icon == "") {
						$('#menu_sub_icon').val(data.menu_icon);
					} else {
						$('#menu_sub_icon').val(data.menu_sub_icon);
					}
					main_menu += '<option value=' + data.id + '>' + data.menu_nama + '</option>';
					$('#main_menu').html(main_menu);
					if (data.is_active == 1) {
						document.getElementById("is_active").checked = true;
						$('#is_active').val(data.is_active);
					} else {
						document.getElementById("is_active").checked = false;
						$('#is_active').val(data.is_active);
					}
				} else {
					Swal.fire({
						icon: 'warning',
						title: 'Warning',
						text: data.msg,
						showConfirmButton: false,
						timer: 1500
					});
				}
			}
		});
	});
</script>

<!-- update data menu -->
<script>
	$(document).on("click", "#tombol_update1", function() {
		if (validasiSubMenu()) {
			let data = $('#formSubmenu').serialize();
			$.ajax({
				type: 'POST',
				url: '<?= site_url('Menu/SubMenu/UpdateSubMenu') ?>',
				data: data,
				success: function(response) {
					var data = JSON.parse(response);
					if (data.success) {
						Swal.fire({
							icon: 'success',
							title: 'Success',
							text: data.msg,
							showConfirmButton: false,
							timer: 1500
						});
					} else {
						Swal.fire({
							icon: 'error',
							title: 'Error',
							text: data.msg,
							showConfirmButton: false,
							timer: 1500
						});
					}
					setTimeout(() => {
						window.location.assign('<?= site_url("Menu/subMenu") ?>');
					}, 1500);
				}
			});
		}
	});
</script>

<!-- hapus MainMenu -->
<script>
	$(document).on("click", ".HapusMenu", function() {
		let id = $(this).data('id');
		Swal.fire({
			title: 'Are you sure?',
			text: "You won't be able to revert this!",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Yes, delete it!'
		}).then((result) => {
			if (result.isConfirmed) {
				$.ajax({
					type: 'POST',
					url: '<?= site_url('Menu/SubMenu/DeleteSubMenu') ?>',
					data: {
						id: id
					},
					success: function(response) {
						var data = JSON.parse(response);
						if (data.success) {
							SweetAlert.fire({
								icon: 'success',
								title: 'Success',
								text: data.msg,
								showConfirmButton: false,
								timer: 1500
							});
						} else {
							SweetAlert.fire({
								icon: 'error',
								title: 'Error',
								text: data.msg,
								showConfirmButton: false,
								timer: 1500
							});
						}
						setTimeout(() => {
							window.location.assign('<?php echo site_url("Menu/subMenu") ?>');
						}, 1500);
					}
				});
			}
		})
	});
</script>
<?php $this->load->view('Components/v_bottom'); ?>