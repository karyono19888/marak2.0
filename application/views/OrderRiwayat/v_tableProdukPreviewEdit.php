<div class="row">
	<div class="col-sm-12">
		<div class="card">
			<div class="card-header">
				<!-- tombol modal produk  -->
				<button class="btn btn-outline-primary mt-2" id="tombolModalTambah" type="button" data-bs-toggle="modal"
					data-bs-target="#ModalProduk">
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
							$subtotal 	= 0;
							$pajakNilai = 0;
							$pajakId 	= 0;
							$pajakNama 	= "";
							$ppn 			= 0;
							$grandtotal = 0;
							$kodePO 		= 0;
							foreach ($data->result_array() as $a) :
								$jml 			= $a['t_order_produk_qty'] * $a['t_order_produk_harga'] + $a['t_order_produk_ongkir'];
								$subtotal 	+= $jml;
								$pajakNilai = $a['m_pajak_nilai'];
								$pajakId 	= $a['m_pajak_id'];
								$pajakNama  = $a['m_pajak_nama'];
								$ppn			= $a['t_order_ppn'];
								$grandtotal = $a['t_order_grandtotal'];
								$kodePO     = $a['t_order_kode'];
							?>
						<tr>
							<td><?= $i++; ?></td>
							<td>
								<?= $a['m_prod_kode']; ?> -
								<?= $a['m_prod_nama']; ?>
							</td>
							<td width="2%"><?= $a['t_order_produk_qty']; ?></td>
							<td><?= $a['m_uom_nama']; ?></td>
							<td><?= number_format($a['t_order_produk_harga'], 0, '.', '.'); ?></td>
							<td><?= number_format($a['t_order_produk_ongkir'], 0, '.', '.'); ?></td>
							<td><?= number_format($a['t_produk_subtotal'], 0, '.', '.'); ?></td>
							<td><?= $a['t_order_produk_catatan']; ?></td>
							<td class="text-center">
								<button type="button" class="btn btn-sm btn-relief-warning EditProduk" data-bs-toggle="modal"
									data-bs-target="#ModalProduk" data-id="<?= $a['t_order_produk_id']; ?>">Edit</button>
								<button type="button" class="btn btn-sm btn-relief-danger DeleteProduk"
									data-id="<?= $a['t_order_produk_id']; ?>" data-kode="<?= $a['t_order_produk_kode']; ?>"
									id="hapusProduk">Delete</button>
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
					<label for="t_order_pajak" class="col-sm-4 col-form-label">Jenis Pajak</label>
					<div class="col-sm-8">
						<select name="t_order_pajak" id="t_order_pajak" class="form-control">
							<option data-price="<?= empty($subtotal) ? '0' : '' . $subtotal . ''; ?>"
								data-ppn="<?= $pajakNilai; ?>" value="<?= $pajakId; ?>"><?= $pajakNama; ?></option>
							<?php foreach ($pajak->result_array() as $a) : ?>
							<option data-price="<?= empty($subtotal) ? '0' : '' . $subtotal . ''; ?>"
								data-ppn="<?= $a['m_pajak_nilai']; ?>" value="<?= $a['m_pajak_id']; ?>">
								<?= $a['m_pajak_nama']; ?></option>
							<?php endforeach; ?>
						</select>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-4">Subtotal <span class="text-muted">Rp.</span> </div>
					<div class="col-sm-4"></div>
					<div class="col-sm-4">
						<b
							class="float-end"><?= empty($subtotal) ? '0' : '' . number_format($subtotal, 0, ".", ".") . ''; ?></b>
						<input type="hidden" class="form-control" id="t_order_subtotal" name="t_order_subtotal"
							value="<?= empty($subtotal) ? '0' : '' . $subtotal . ''; ?>" />
					</div>
				</div>
				<div class="row">
					<div class="col-sm-4">Pajak <span class="text-muted">Rp.</span> </div>
					<div class="col-sm-4"></div>
					<div class="col-sm-4">
						<b id="showPajak" class="float-end"><?= number_format($ppn, 0, '.', '.'); ?></b>
						<input type="hidden" class="form-control" id="t_order_ppn" name="t_order_ppn" value="<?= $ppn; ?>" />
					</div>
				</div>
				<h3 class="mt-2  text-muted">Grand Total</h3>
				<div class="row">
					<div class="col-sm-4"><span class="text-muted h1">Rp.</span></div>
					<div class="col-sm-4"></div>
					<div class="col-sm-4">
						<h1 class="text-center"><b id="showTotal"
								class="float-end"><?= number_format($grandtotal, 0, '.', '.'); ?></b></h1>
						<input type="hidden" class="form-control" id="t_order_grandtotal" name="t_order_grandtotal"
							value="<?= $grandtotal; ?>" />
					</div>
				</div>
			</div>
		</div>
		<div class="card">
			<div class="card-body">
				<button class="btn btn-warning w-100 mb-75" id="tombol_complete" type="button">Edit Complete Order</button>
				<a href="#" class="btn btn-outline-warning	 w-100" id="BacktoPreview" type="button">Back</a>
			</div>
		</div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade text-start" id="ModalProduk" tabindex="-1" aria-labelledby="myModalLabel1" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="judul_tambah">Tambah Produk</h4>
				<h4 class="modal-title" id="judul_edit">Edit Produk</h4>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
					onclick="HapusValue()"></button>
			</div>
			<div class="modal-body">
				<form action="#" method="post" id="formProduk">
					<div class="mb-1">
						<small>Nama Produk</small>
						<div class="input-group mb-1">
							<input type="hidden" class="form-control" value="<?= $kodePO; ?>" id="t_produk_order_kode"
								name="t_produk_order_kode">
							<input type="hidden" class="form-control" id="t_produk_id" name="t_produk_id">
							<select name="t_produk_nama" id="t_produk_nama" class="form-control">
								<option value="">- Pilih -</option>
								<?php foreach ($namaProduk->result_array() as $a) : ?>
								<option value="<?= $a['m_prod_id']; ?>"><?= $a['m_prod_kode']; ?> - <?= $a['m_prod_nama']; ?>
								</option>
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
							<input type="text" class="form-control" id="t_produk_harga" name="t_produk_harga"
								placeholder="Rp. 100.000.000">
						</div>
					</div>
					<div class="mb-1">
						<small>Biaya Kirim</small>
						<div class="input-group mb-1">
							<input type="text" class="form-control" id="t_produk_ongkir" name="t_produk_ongkir"
								placeholder="Rp. 100.000.000">
						</div>
					</div>
					<div class="mb-1">
						<small>Catatan <i class="text-muted">(Optional)</i></small>
						<div class="input-group mb-1">
							<textarea name="t_produk_catatan" id="t_produk_catatan" cols="30" rows="3" class="form-control"
								placeholder="Deskripsi Produk"></textarea>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" id="tombol_simpanProduk">Simpan</button>
				<button type="button" class="btn btn-warning" id="tombol_editProduk">Edit</button>
				<button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal"
					onclick="HapusValue()">Cancle</button>
			</div>
		</div>
	</div>
</div>

<script>
$(document).ready(function() {
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
});

$('#t_order_pajak').on('change', function() {
	let value = $('#t_order_pajak').val();
	const price = $('#t_order_pajak option:selected').data('price');
	const ppn = $('#t_order_pajak option:selected').data('ppn');
	const totalPpn = (price * ppn / 100)
	const total = price + totalPpn;
	$('[name=t_order_ppn]').val(totalPpn);
	// tampilkan data ke element
	const bilangan = totalPpn;
	let number_string = bilangan.toString(),
		sisa = number_string.length % 3,
		rupiah = number_string.substr(0, sisa),
		ribuan = number_string.substr(sisa).match(/\d{3}/g);

	if (ribuan) {
		separator = sisa ? '.' : '';
		rupiah += separator + ribuan.join('.');
	}

	// tampilkan data ke element
	$('#showPajak').text(`${rupiah}`);

	const bilanganA = total;
	let reverse = bilanganA.toString().split('').reverse().join(''),
		ribuanA = reverse.match(/\d{1,3}/g);
	ribuan = ribuanA.join('.').split('').reverse().join('');


	$('[name=t_order_grandtotal]').val(total);
	$('#showTotal').text(`${ribuan}`);
})
</script>