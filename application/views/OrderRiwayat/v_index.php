<?php $this->load->view('Components/v_header'); ?>

<link rel="stylesheet" href="//cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

<link rel="stylesheet" href="<?= base_url('assets'); ?>/vendors/css/forms/select/select2.min.css">
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
						<h2 class="content-header-title float-start mb-0">Order Riwayat</h2>
						<div class="breadcrumb-wrapper">
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="#">Admin Marketing</a>
								</li>
								<li class="breadcrumb-item active">Data Riwayat Order
								</li>
							</ol>
						</div>
					</div>
				</div>
			</div>
			<div class="content-header-right text-md-end col-md-3 col-12 d-md-block d-none">
				<div class="mb-1 breadcrumb-right">
					<div class="dropdown">
						<button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" type="button"
							data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i data-feather="grid"></i>
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
									<h3 class="fw-bolder mb-75"><?= $totalClose; ?></h3>
									<span>Total Close</span>
								</div>
								<div class="avatar bg-light-primary p-50">
									<span class="avatar-content">
										<i data-feather="shopping-bag" class="font-medium-4"></i>
									</span>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-sm-6">
						<div class="card">
							<div class="card-body d-flex align-items-center justify-content-between">
								<div>
									<h3 class="fw-bolder mb-75">Rp. <?= number_format($totalClosebyAmmount, 0, '.', '.') ?>
										<small class="text-muted"><?= strlen($totalClosebyAmmount) > 3 ? 'Mil' : 'Jt' ?></small>
									</h3>
									<span>Total Close by Ammount</span>
								</div>
								<div class="avatar bg-light-success p-50">
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

		</div>
	</div>
</div>
<!-- END: Content-->

<?php $this->load->view('Components/v_footer'); ?>
<script src="<?= base_url('assets'); ?>/vendors/js/forms/select/select2.full.min.js"></script>
<script src="//cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets'); ?>/vendors/js/forms/cleave/cleave.min.js"></script>
<script src="<?= base_url('assets'); ?>/vendors/js/forms/cleave/addons/cleave-phone.us.js"></script>
<script>
$(document).ready(function() {
	$("#show_data").load("<?= base_url('OrderRiwayat/ShowTableData'); ?>");
});

$(document).on("click", ".Preview", function() {
	let id = $(this).data('id');
	$.ajax({
		type: "POST",
		url: "<?= site_url('OrderRiwayat/ShowDataPreview') ?>",
		data: {
			id: id
		},
		success: function(response) {
			$("#show_data").html(response);
		}
	});
});

$(document).on("click", "#BacktoPreview", function() {
	$("#show_data").load("<?= base_url('OrderRiwayat/ShowTableData'); ?>");
});

$(document).on("click", "#tombol_editOrder", function() {
	let id = $(this).data('id');
	$.ajax({
		type: "POST",
		url: "<?= site_url('OrderRiwayat/ShowDataEdit') ?>",
		data: {
			id: id
		},
		success: function(response) {
			$("#show_data").html(response);
		}
	});
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
		url: '<?= site_url('OrderRiwayat/ViewProduk') ?>',
		data: {
			id: id
		},
		success: function(response) {
			let data = JSON.parse(response);
			if (data.success) {
				$('#t_produk_id').val(data.t_order_produk_id);
				$('#t_produk_order_kode').val(data.t_order_produk_kode);
				html += '<option selected value=' + data.m_prod_id + '>' + data.m_prod_kode + ' - ' + data
					.m_prod_nama + '</option>';
				$('#t_produk_nama').html(html);
				$('#t_produk_qty').val(data.t_order_produk_qty);
				$('#t_produk_harga').val(data.t_order_produk_harga);
				$('#t_produk_ongkir').val(data.t_order_produk_ongkir);
				$('#t_produk_catatan').val(data.t_order_produk_catatan);
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
			url: '<?= base_url('OrderRiwayat/EditProduk'); ?>',
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
			url: '<?= base_url('OrderRiwayat/TambahProduk'); ?>',
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

$(document).on("click", "#tombol_complete", function() {
	if (validasiComplete()) {
		let data = $('#formRequestOrder').serialize();
		$.ajax({
			type: 'POST',
			url: '<?= base_url('OrderRiwayat/EditOrderComplete'); ?>',
			data: data,
			beforeSend: function() {
				$('#tombol_complete').prop('disabled', true);
				$('#tombol_complete').html(
					'<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span><span class="ms-25 align-middle">Loading...</span>'
				);
			},
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
						showConfirmButton: true,
						timer: 2000
					});
				}
				setTimeout(() => {
					window.location.assign('<?= site_url("OrderRiwayat") ?>');
				}, 2000);
			}
		});
	}
});

function validasiComplete() {
	let t_order_paket_id = document.getElementById("t_order_paket_id").value;
	let t_order_tgl_order = document.getElementById("t_order_tgl_order").value;
	let t_order_tgl_kirim = document.getElementById("t_order_tgl_kirim").value;
	let t_order_pajak = document.getElementById("t_order_pajak").value;
	let t_order_grandtotal = document.getElementById("t_order_grandtotal").value;
	if ((t_order_paket_id == "") || (t_order_tgl_order == "") || (t_order_tgl_kirim == "") || (t_order_pajak == "") || (
			t_order_grandtotal == "0")) {
		if (t_order_grandtotal == "0") {
			notif("Produk");
		}
		if (t_order_pajak == "") {
			notif("Jenis Pajak");
		}
		if (t_order_tgl_kirim == "") {
			notif("Tanggal Kirim");
		}
		if (t_order_tgl_order == "") {
			notif("Tanggal Order");
		}
		if (t_order_paket_id == "") {
			notif("ID Paket");
		}
	} else {
		return true;
	}
}


function HapusValue() {
	$('#t_produk_nama').val("");
	$('#t_produk_qty').val("");
	$('#t_produk_harga').val("");
	$('#t_produk_ongkir').val("");
	$('#t_produk_catatan').val("");
}

$(document).on("click", "#tombol_hapusOrder", function() {
	let id = $(this).data('id');
	Swal.fire({
		title: 'Are you sure?',
		text: "Hapus permanent order!",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Yes, delete it!'
	}).then((result) => {
		if (result.isConfirmed) {
			$.ajax({
				type: 'POST',
				url: '<?= site_url('OrderRiwayat/DeleteOrder') ?>',
				data: {
					id: id,
				},
				beforeSend: function() {
					$('#tombol_hapusOrder').prop('disabled', true);
					$('#tombol_hapusOrder').html(
						'<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span><span class="ms-25 align-middle">Loading...</span>'
					);
				},
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
							showConfirmButton: true,
							timer: 2000
						});
					}
					setTimeout(() => {
						window.location.assign('<?= site_url("OrderRiwayat") ?>');
					}, 2000);
				}
			});
		}
	})
});

$(document).on("click", ".DeleteProduk", function() {
	let id = $(this).data('id');
	let kode = $("#hapusProduk").data('kode');
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
				url: '<?= site_url('OrderRiwayat/DeleteProduk') ?>',
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

function notif(word) {
	Swal.fire({
		title: 'Perhatian',
		text: word + ' wajib di isi !',
		icon: 'info',
	}).then((result) => {})
}
</script>
<?php $this->load->view('Components/v_bottom'); ?>