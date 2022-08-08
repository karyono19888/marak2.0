<div class="row">
	<div class="col-sm-12">
		<div class="card">
			<div class="card-header">
				<!-- tombol modal produk  -->
				<button class="btn btn-outline-primary mt-2" id="tombolModalTambah" type="button" data-bs-toggle="modal" data-bs-target="#ModalProduk">
					Tambah Produk
				</button>
			</div>
			<div class="card-body">
				<table class="table table-bordered" width="100%">
					<thead>
						<tr>
							<th>No</th>
							<th>Nama</th>
							<th>Qty</th>
							<th>Uom</th>
							<th>Harga</th>
							<th>Kirim</th>
							<th>Sub</th>
							<th>Catatan</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php if (empty($data->result_array())) : ?>
							<tr class=" border-bottom">
								<td colspan='9' class='text-center'>Data tidak ditemukan.</td>
							</tr>
						<?php else : ?>
							<?php
							$i = 1;
							$jml = 0;
							$subtotal = 0;
							foreach ($data->result_array() as $a) :
								$jml = $a['t_produk_qty'] * $a['t_produk_harga'] + $a['t_produk_ongkir'];
								$subtotal += $jml;
							?>
								<tr>
									<td><?= $i++; ?></td>
									<td>
										<?= $a['m_prod_kode']; ?> -
										<?= $a['m_prod_nama']; ?>
									</td>
									<td width="2%"><?= $a['t_produk_qty']; ?></td>
									<td><?= $a['m_uom_nama']; ?></td>
									<td><?= number_format($a['t_produk_harga'], 0, '.', '.'); ?></td>
									<td><?= number_format($a['t_produk_ongkir'], 0, '.', '.'); ?></td>
									<td><?= number_format($a['t_produk_subtotal'], 0, '.', '.'); ?></td>
									<td><?= $a['t_produk_catatan']; ?></td>
									<td class="text-center">
										<button type="button" class="btn btn-sm btn-relief-warning EditProduk" data-bs-toggle="modal" data-bs-target="#ModalProduk" data-id="<?= $a['t_produk_id']; ?>">Edit</button>
										<button type="button" class="btn btn-sm btn-relief-danger DeleteProduk" data-id="<?= $a['t_produk_id']; ?>">Delete</button>
									</td>
								</tr>
							<?php endforeach; ?>
						<?php endif; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-sm-8"></div>
	<div class="col-sm-4">
		<div class="card">
			<div class="card-body">
				<h6 class="mb-2">Payment :</h6>
				<div class="mb-1 row">
					<label for="t_order_pajak" class="col-sm-3 col-form-label">Jenis Pajak</label>
					<div class="col-sm-9">
						<select name="t_order_pajak" id="t_order_pajak" class="form-control">
							<option value="">- Pilih -</option>
							<?php foreach ($pajak->result_array() as $a) : ?>
								<option data-price="<?= empty($subtotal) ? '0' : '' . $subtotal . ''; ?>" data-ppn="<?= $a['m_pajak_nilai']; ?>" value="<?= $a['m_pajak_id']; ?>"><?= $a['m_pajak_nama']; ?></option>
							<?php endforeach; ?>
						</select>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-4">Subtotal <span class="text-muted">Rp.</span> </div>
					<div class="col-sm-4"></div>
					<div class="col-sm-4">
						<b class="float-end"><?= empty($subtotal) ? '0' : '' . number_format($subtotal, 0, ".", ".") . ''; ?></b>
						<input type="hidden" class="form-control" id="t_order_subtotal" name="t_order_subtotal" value="<?= empty($subtotal) ? '0' : '' . $subtotal . ''; ?>" />
					</div>
				</div>
				<div class="row">
					<div class="col-sm-4">Pajak <span class="text-muted">Rp.</span> </div>
					<div class="col-sm-4"></div>
					<div class="col-sm-4">
						<b id="showPajak" class="float-end">0</b>
						<input type="hidden" class="form-control" id="t_order_ppn" name="t_order_ppn" />
					</div>
				</div>
				<h3 class="mt-2  text-muted">Grand Total</h3>
				<div class="row">
					<div class="col-sm-4"><span class="text-muted h1">Rp.</span></div>
					<div class="col-sm-4"></div>
					<div class="col-sm-4">
						<h1 class="text-center"><b id="showTotal" class="float-end">0</b></h1>
						<input type="hidden" class="form-control" id="t_order_grandtotal" name="t_order_grandtotal" />
					</div>
				</div>
			</div>
		</div>
		<div class="card">
			<div class="card-body">
				<button class="btn btn-primary w-100 mb-75" id="tombol_complete" type="button">Complete Order</button>
				<a href="#" class="btn btn-outline-primary w-100" id="BacktoPreview" type="button">Back</a>
			</div>
		</div>
	</div>
</div>

<script>
	$('#t_order_pajak').on('change', function() {
		let value = $('#t_order_pajak').val();
		const price = $('#t_order_pajak option:selected').data('price');
		const ppn = $('#t_order_pajak option:selected').data('ppn');
		const totalPpn = (price * ppn / 100)
		const total = price + totalPpn;
		$('[name=t_order_ppn]').val(totalPpn);
		// tampilkan data ke element
		var bilangan = totalPpn;
		var number_string = bilangan.toString(),
			sisa = number_string.length % 3,
			rupiah = number_string.substr(0, sisa),
			ribuan = number_string.substr(sisa).match(/\d{3}/g);

		if (ribuan) {
			separator = sisa ? '.' : '';
			rupiah += separator + ribuan.join('.');
		}

		// tampilkan data ke element
		$('#showPajak').text(`${rupiah}`);

		var bilangan = total;
		var reverse = bilangan.toString().split('').reverse().join(''),
			ribuan = reverse.match(/\d{1,3}/g);
		ribuan = ribuan.join('.').split('').reverse().join('');


		$('[name=t_order_grandtotal]').val(total);
		$('#showTotal').text(`${ribuan}`);
	})
</script>