<div class="row">
	<div class="col-sm-12">
		<div class="card">
			<div class="card-header">
				<!-- tombol modal produk  -->
				<h4 class="card-title text-danger"><b>Data Produk</b></h4>
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
							$pajak = "";
							$ppn = "";
							$grandtotal = "";
							$kodePO = "";
							foreach ($data->result_array() as $a) :
								$jml 			= $a['t_produk_qty'] * $a['t_produk_harga'] + $a['t_produk_ongkir'];
								$subtotal 	+= $jml;
								$pajak 		= $a['m_pajak_nama'];
								$ppn 			= $a['t_order_ppn'];
								$grandtotal = $a['t_order_grandtotal'];
								$kodePO     = $a['t_order_kode'];
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
						<b id="showPajak" class="float-end"><?= $pajak; ?></b>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-4">Subtotal <span class="text-muted">Rp.</span> </div>
					<div class="col-sm-4"></div>
					<div class="col-sm-4">
						<b class="float-end"><?= empty($subtotal) ? '0' : '' . number_format($subtotal, 0, ".", ".") . ''; ?></b>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-4">Pajak <span class="text-muted">Rp.</span> </div>
					<div class="col-sm-4"></div>
					<div class="col-sm-4">
						<b id="showPajak" class="float-end"><?= number_format($ppn, 0, '.', '.'); ?></b>
					</div>
				</div>
				<h3 class="mt-2  text-muted">Grand Total</h3>
				<div class="row">
					<div class="col-sm-4"><span class="text-muted h1">Rp.</span></div>
					<div class="col-sm-4"></div>
					<div class="col-sm-4">
						<h1 class="text-center"><b id="showTotal" class="float-end"><?= number_format($grandtotal, 0, '.', '.'); ?></b></h1>
					</div>
				</div>
			</div>
		</div>
		<div class="card">
			<div class="card-body">
				<button class="btn btn-warning w-100 mb-75" id="tombol_editOrder" data-id="<?= $kodePO; ?>" type="button">Edit Order</button>
				<a href="#" class="btn btn-outline-warning w-100" id="BacktoPreview" type="button">Back</a>
			</div>
		</div>
	</div>
</div>