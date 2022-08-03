<?php $this->load->view('Components/v_header'); ?>

<link rel="stylesheet" href="//cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
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
						<h2 class="content-header-title float-start mb-0">Order Masuk</h2>
						<div class="breadcrumb-wrapper">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="#">Admin Marketing</a>
								</li>
								<li class="breadcrumb-item active">Data Order
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
			<!-- Dashboard Ecommerce Starts -->
			<section class="app-user-list">
				<div class="row">
					<div class="col-lg-3 col-sm-6">
						<div class="card">
							<div class="card-body d-flex align-items-center justify-content-between">
								<div>
									<h3 class="fw-bolder mb-75">09</h3>
									<span>Total Orders</span>
								</div>
								<div class="avatar bg-light-primary p-50">
									<span class="avatar-content">
										<i data-feather="shopping-bag" class="font-medium-4"></i>
									</span>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-3 col-sm-6">
						<div class="card">
							<div class="card-body d-flex align-items-center justify-content-between">
								<div>
									<h3 class="fw-bolder mb-75">09</h3>
									<span>Total New PO</span>
								</div>
								<div class="avatar bg-light-warning p-50">
									<span class="avatar-content">
										<i data-feather="bell" class="font-medium-4"></i>
									</span>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-3 col-sm-6">
						<div class="card">
							<div class="card-body d-flex align-items-center justify-content-between">
								<div>
									<h3 class="fw-bolder mb-75">09</h3>
									<span>Total PO by Ammount</span>
								</div>
								<div class="avatar bg-light-success p-50">
									<span class="avatar-content">
										<i data-feather="dollar-sign" class="font-medium-4"></i>
									</span>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-3 col-sm-6">
						<div class="card">
							<div class="card-body d-flex align-items-center justify-content-between">
								<div>
									<h3 class="fw-bolder mb-75">12</h3>
									<span>Total New PO by Ammount</span>
								</div>
								<div class="avatar bg-light-danger p-50">
									<span class="avatar-content">
										<i data-feather="dollar-sign" class="font-medium-4"></i>
									</span>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- list and filter start -->
				<div id="show_data"></div>
				<!-- list and filter end -->
			</section>
			<!-- Dashboard Ecommerce ends -->

			<!-- Modal -->
			<div class="modal fade text-start" id="ModalProduk" tabindex="-1" aria-labelledby="myModalLabel1" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title" id="judul_tambah">Tambah Produk</h4>
							<h4 class="modal-title" id="judul_edit">Edit Produk</h4>
							<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="HapusValue()"></button>
						</div>
						<div class="modal-body">
							<form action="#" method="post" id="formProduk">
								<div class="mb-1">
									<small>Nama Produk</small>
									<div class="input-group mb-1">
										<input type="hidden" class="form-control" value="<?= $kode; ?>" id="t_produk_order_kode" name="t_produk_order_kode">
										<input type="hidden" class="form-control" id="t_produk_id" name="t_produk_id">
										<select name="t_produk_nama" id="t_produk_nama" class="form-control">
											<option value="">- Pilih -</option>
											<?php foreach ($namaProduk->result_array() as $a) : ?>
												<option value="<?= $a['m_prod_id']; ?>"><?= $a['m_prod_kode']; ?> - <?= $a['m_prod_nama']; ?></option>
											<?php endforeach; ?>
										</select>
									</div>
								</div>
								<div class="mb-1">
									<small>Qty</small>
									<div class="input-group mb-1">
										<input type="number" class="form-control" name="t_produk_qty" id="t_produk_qty" placeholder="000">
									</div>
								</div>
								<div class="mb-1">
									<small>Harga</small>
									<div class="input-group mb-1">
										<input type="text" class="form-control" id="t_produk_harga" name="t_produk_harga" placeholder="Rp. 100.000.000">
									</div>
								</div>
								<div class="mb-1">
									<small>Biaya Kirim</small>
									<div class="input-group mb-1">
										<input type="text" class="form-control" id="t_produk_ongkir" name="t_produk_ongkir" placeholder="Rp. 100.000.000">
									</div>
								</div>
								<div class="mb-1">
									<small>Catatan <i class="text-muted">(Optional)</i></small>
									<div class="input-group mb-1">
										<textarea name="t_produk_catatan" id="t_produk_catatan" cols="30" rows="3" class="form-control" placeholder="Deskripsi Produk"></textarea>
									</div>
								</div>
							</form>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-primary" id="tombol_simpanProduk">Simpan</button>
							<button type="button" class="btn btn-warning" id="tombol_editProduk">Edit</button>
							<button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" onclick="HapusValue()">Cancle</button>
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
</div>
<!-- END: Content-->

<?php $this->load->view('Components/v_footer'); ?>
<script src="//cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets'); ?>/vendors/js/forms/cleave/cleave.min.js"></script>
<script src="<?= base_url('assets'); ?>/vendors/js/forms/cleave/addons/cleave-phone.us.js"></script>
<script>
	let t_produk_harga = $('#t_produk_harga');
	let t_produk_ongkir = $('#t_produk_ongkir');
	if (t_produk_harga.length) {
		new Cleave(t_produk_harga, {
			numeral: true,
			numeralThousandsGroupStyle: 'thousand'
		});
	}
	if (t_produk_ongkir.length) {
		new Cleave(t_produk_ongkir, {
			numeral: true,
			numeralThousandsGroupStyle: 'thousand'
		});
	}
</script>
<script>
	$(document).ready(function() {
		$("#show_data").load("<?= base_url('OrderMasuk/ShowTableData'); ?>");
	});

	$(document).on("click", ".Preview", function() {
		let id = $(this).data('id');
		$.ajax({
			type: "POST",
			url: "<?= site_url('OrderMasuk/ShowDataPreview') ?>",
			data: {
				id: id
			},
			success: function(response) {
				$("#show_data").html(response);
			}
		});
	});

	$(document).on("click", "#tombol_close", function() {
		let id = $(this).data('id');
		$.ajax({
			type: "POST",
			url: "<?= site_url('OrderMasuk/ShowCompliteOrder') ?>",
			data: {
				id: id
			},
			success: function(response) {
				$("#show_data").html(response);
			}
		});
	});

	$(document).on("click", "#BacktoPreview", function() {
		$("#show_data").load("<?= base_url('OrderMasuk/ShowTableData'); ?>");
	});

	$(document).on("click", "#tombolModalTambah", function() {
		$('#judul_edit').hide();
		$('#tombol_editProduk').hide();
		$('#judul_tambah').show();
		$('#tombol_simpanProduk').show();
	})

	$(document).on("click", ".EditProduk", function() {
		$('#judul_edit').show();
		$('#tombol_editProduk').show();
		$('#judul_tambah').hide();
		$('#tombol_simpanProduk').hide();
		let id = $(this).data('id');
		let html = "";
		$.ajax({
			type: 'POST',
			url: '<?= site_url('OrderMasuk/ViewProduk') ?>',
			data: {
				id: id
			},
			success: function(response) {
				let data = JSON.parse(response);
				if (data.success) {
					$('#t_produk_id').val(data.t_produk_id);
					$('#t_produk_order_kode').val(data.t_produk_order_kode);
					html += '<option value=' + data.m_prod_id + '>' + data.m_prod_kode + ' - ' + data.m_prod_nama + '</option>';
					html += '<?php foreach ($namaProduk->result_array() as $data) { ?><option value="<?= $data['m_prod_id'] ?>"><?= $data['m_prod_kode'] ?> - <?= $data['m_prod_nama'] ?></option><?php } ?>';
					$('#t_produk_nama').html(html);
					$('#t_produk_nama').html(html);
					$('#t_produk_qty').val(data.t_produk_qty);
					$('#t_produk_harga').val(data.t_produk_harga);
					$('#t_produk_ongkir').val(data.t_produk_ongkir);
					$('#t_produk_catatan').val(data.t_produk_catatan);
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

	$(document).on("click", "#tombol_editProduk", function() {
		if (validasi()) {
			let data = $('#formProduk').serialize();
			$.ajax({
				type: 'POST',
				url: '<?= base_url('OrderMasuk/EditProduk'); ?>',
				data: data,
				success: function(response) {
					Swal.fire({
						icon: 'success',
						title: 'Success',
						text: "Produk Berhasil disimpan!",
						showConfirmButton: false,
						timer: 1500
					});
					$('#ModalProduk').modal('hide');
					HapusValue();
					$("#show_tableProduk").html(response);
				}
			});
		}
	});

	$(document).on("click", "#tombol_simpanProduk", function() {
		if (validasi()) {
			let data = $('#formProduk').serialize();
			$.ajax({
				type: 'POST',
				url: '<?= base_url('OrderMasuk/TambahProduk'); ?>',
				data: data,
				success: function(response) {
					Swal.fire({
						icon: 'success',
						title: 'Success',
						text: "Produk Berhasil disimpan!",
						showConfirmButton: false,
						timer: 1500
					});
					$('#ModalProduk').modal('hide');
					HapusValue();
					$("#show_tableProduk").html(response);
				}
			});
		}
	});

	function validasi() {
		let t_produk_nama = document.getElementById("t_produk_nama").value;
		let t_produk_qty = document.getElementById("t_produk_qty").value;
		let t_produk_harga = document.getElementById("t_produk_harga").value;
		let t_produk_ongkir = document.getElementById("t_produk_ongkir").value;
		if ((t_produk_nama == "") || (t_produk_qty == "") || (t_produk_harga == "") || (t_produk_ongkir == "")) {
			if (t_produk_ongkir == "") {
				notif("Ongkos kirim");
			}
			if (t_produk_harga == "") {
				notif("Harga");
			}
			if (t_produk_qty == "") {
				notif("Qty");
			}
			if (t_produk_nama == "") {
				notif("Nama");
			}
		} else {
			return true;
		}
	}

	function notif(word) {
		Swal.fire({
			title: 'Perhatian',
			text: word + ' wajib di isi !',
			icon: 'info',
		}).then((result) => {})
	}

	function HapusValue() {
		$('#t_produk_nama').val("");
		$('#t_produk_qty').val("");
		$('#t_produk_harga').val("");
		$('#t_produk_ongkir').val("");
		$('#t_produk_catatan').val("");
	}

	$(document).on("click", ".DeleteProduk", function() {
		let id = $(this).data('id');
		var kode = $('#t_produk_order_kode').val();
		Swal.fire({
			title: 'Are you sure?',
			text: "Hapus permanent produk!",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Yes, delete it!'
		}).then((result) => {
			if (result.isConfirmed) {
				$.ajax({
					type: 'POST',
					url: '<?= site_url('OrderMasuk/DeleteProduk') ?>',
					data: {
						id: id,
						kode: kode
					},
					success: function(response) {
						Swal.fire({
							icon: 'success',
							title: 'Success',
							text: "Produk Berhasil dihapus!",
							showConfirmButton: false,
							timer: 1500
						});
						$("#show_tableProduk").html(response);
					}
				});
			}
		})
	});
</script>
<?php $this->load->view('Components/v_bottom'); ?>