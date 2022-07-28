<div class="row">
	<div class="col-sm-9">
		<div class="card">
			<div class="card-header">
				<h4 class="card-title text-warning"><b>Edit Permintaan Close Order</b></h4>
				<h4 class="card-title text-warning"><b>#<?= $data['t_req_kode']; ?></b></h4>
			</div>
			<div class="card-body">
				<form action="#" method="post" id="formRequestOrder">
					<div class="row">
						<div class="col-sm-8">
							<h6 class="mb-2">Ordering from:</h6>
							<h6 class="mb-25"><b><?= $data['instansi_nama']; ?></b></h6>
							<p class="card-text mb-25"><?= $data['instansi_alamat']; ?></p>
							<input type="hidden" class="form-control" name="t_req_history_visit" value="<?= $data['t_req_history_visit']; ?>">
							<input type="hidden" class="form-control" name="t_req_visit" value="<?= $data['t_req_visit']; ?>">
							<input type="hidden" name="t_req_kode" id="t_req_kode" value="<?= $data['t_req_kode']; ?>">
							<input type="hidden" name="t_req_user" id="t_req_user" value="<?= $data['t_req_user']; ?>">

							<div class="row mt-2">
								<div class="col-sm-6">
									<div class="mb-1">
										<small class="text-muted"><i>Perusahaan</i></small>
										<div class="input-group mb-2">
											<select class="form-select select2" id="t_req_perusahaan" name="t_req_perusahaan">
												<option value="<?= $data['org_id']; ?>"><?= $data['org_nama']; ?></option>
												<?php foreach ($org->result_array() as $a) : ?>
													<option value="<?= $a['org_id']; ?>"><?= $a['org_nama']; ?></option>
												<?php endforeach; ?>
											</select>
										</div>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="mb-1">
										<small class="text-muted"><i>Jenis Order</i></small>
										<div class="input-group mb-2">
											<select class="form-select select2" id="t_req_kategori" name="t_req_kategori">
												<option value="<?= $data['t_req_kategori']; ?>"><?= $data['t_req_kategori']; ?></option>
												<option value="E-catalog">E-catalog</option>
												<option value="Non E-catalog">Non E-catalog</option>
												<option value="E-Commerce">E-Commerce</option>
											</select>
										</div>
									</div>
								</div>
							</div>

							<div id="showEcommerce" <?= $data['t_req_kategori'] == "E-Commerce" ? '' : 'style="display: none;"' ?>>
								<div class="row">
									<hr>
									<div class="col-sm-6">
										<div class="mb-1">
											<small class="text-muted"><i>Nama Penerima</i></small>
											<div class="input-group mb-2">
												<input type="text" class="form-control" name="t_req_konsumen" id="t_req_konsumen" placeholder="Nama lengkap" value="<?= $data['t_req_konsumen']; ?>">
											</div>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="mb-1">
											<small class="text-muted"><i>Nomor Handphone</i></small>
											<div class="input-group mb-2">
												<input type="number" class="form-control" name="t_req_phone" id="t_req_phone" placeholder="0812 3456 7689" value="<?= $data['t_req_phone']; ?>">
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-6">
										<div class="mb-1">
											<small class="text-muted"><i>Alamat Lengkap</i></small>
											<div class="input-group mb-2">
												<textarea name="t_req_alamat" id="t_req_alamat" cols="30" rows="3" class="form-control" placeholder="Jl. contoh No.123"><?= $data['t_req_alamat']; ?></textarea>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-4 mt-2">
							<h6 class="mb-2">Details:</h6>
							<table>
								<tbody>
									<tr>
										<td class="pe-1">Order</td>
										<td>: <span class="badge badge-light-info"><?= $data['t_req_status']; ?></span></td>
									</tr>
									<tr>
										<td class="pe-1">Sales Person</td>
										<td>: <b><?= $data['name_user']; ?></b></td>
									</tr>
									<tr>
										<td class="pe-1">Division</td>
										<td>: Marketing</td>
									</tr>
									<tr>
										<td class="pe-1">Order Req</td>
										<td><input type="date" name="t_req_tgl" id="t_req_tgl" class="form-control" value="<?= $data['t_req_tgl']; ?>"></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	<div class="col-sm-3">
		<div class="card">
			<div class="card-body">
				<button class="btn btn-warning w-100 mb-75" id="tombol_simpan" type="button">Edit</button>
				<a href="#" class="btn btn-outline-primary w-100 Kembali" type="button">Back</a>
			</div>
		</div>
	</div>
</div>

<script>
	$(document).on("click", ".Kembali", function() {
		$("#show_data").load("<?= base_url('OrderRequest/ShowTableData'); ?>");
	});

	$('#t_req_kategori').change(function() {
		if ($(this).val() == "E-Commerce") {
			document.getElementById('showEcommerce').style.display = "block";
		} else {
			document.getElementById('showEcommerce').style.display = "none";
		}
	})

	$(document).on("click", "#tombol_simpan", function() {
		if (validasi()) {
			let data = $('#formRequestOrder').serialize();
			$.ajax({
				type: 'POST',
				url: '<?= base_url('OrderRequest/EditOrderRequest'); ?>',
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
							showConfirmButton: true,
							timer: 2000
						});
					}
					setTimeout(() => {
						window.location.assign('<?= site_url("OrderRequest") ?>');
					}, 2000);
				}
			});
		}
	});

	function validasi() {
		let t_req_perusahaan = document.getElementById("t_req_perusahaan").value;
		let t_req_kategori = document.getElementById("t_req_kategori").value;
		if ((t_req_perusahaan == "") || (t_req_kategori == "")) {

			if (t_req_kategori == "") {
				notif("Jenis Order");
			}

			if (t_req_perusahaan == "") {
				notif("Perusahaan");
			}

		} else if (t_req_kategori === "E-Commerce") {
			let t_req_konsumen = document.getElementById("t_req_konsumen").value;
			let t_req_phone = document.getElementById("t_req_phone").value;
			let t_req_alamat = document.getElementById("t_req_alamat").value;
			if ((t_req_konsumen == "") || (t_req_phone == "") || (t_req_alamat == "")) {

				if (t_req_alamat == "") {
					notif("Alamat Lengkap");
				}
				if (t_req_phone == "") {
					notif("Nomor Handphone");
				}
				if (t_req_konsumen == "") {
					notif("Nama Konsumen");
				}

			} else {
				return true;
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
</script>