<form action="#" method="post" id="formRequestOrder">
	<div class="row">
		<div class="col-sm-12">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title text-warning"><b>Edit Complete Order</b></h4>
					<h4 class="card-title text-warning"><b>#<?= $a['t_order_kode']; ?></b></h4>
					<input type="hidden" class="form-control" id="t_order_kode" name="t_order_kode"
						value="<?= $a['t_order_kode']; ?>" />
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-sm-8">
							<h6 class="mb-2">Ordering from:</h6>
							<h6 class="mb-25"><b><?= $a['instansi_nama']; ?></b></h6>
							<p class="card-text mb-25"><?= $a['instansi_alamat']; ?></p>
							<br>
							<table>
								<tbody>
									<tr>
										<td class="pe-1">Req Code</td>
										<td>: <b>#<?= $a['t_req_kode']; ?></b></td>
										<input type="hidden" class="form-control" id="t_req_kode" name="t_req_kode"
											value="<?= $a['t_req_kode']; ?>" />
									</tr>
									<tr>
										<td class="pe-1">Jenis Order</td>
										<td>
											<?php if ($a['t_req_kategori'] == "E-Commerce") : ?>
											: <span class="badge badge-light-success"><?= $a['t_req_kategori']; ?></span>
											<?php elseif ($a['t_req_kategori'] == "E-catalog") : ?>
											: <span class="badge badge-light-warning"><?= $a['t_req_kategori']; ?></span>
											<?php else : ?>
											: <span class="badge badge-light-info"><?= $a['t_req_kategori']; ?></span>
											<?php endif; ?>
											<input type="hidden" class="form-control" id="t_order_kategori" name="t_order_kategori"
												value="<?= $a['t_req_kategori']; ?>" />
										</td>
									</tr>
									<tr>
										<td class="pe-1">Perusahaan</td>
										<td>: <b><?= $a['org_nama']; ?></b></td>
										<input type="hidden" class="form-control" id="t_order_perusahaan"
											name="t_order_perusahaan" value="<?= $a['org_id']; ?>" />
									</tr>
								</tbody>
							</table>

							<div id="showEcommerce"
								<?= $a['t_req_kategori'] == "E-Commerce" ? '' : 'style="display: none;"' ?>>
								<hr>
								<h6 class="mb-2">Data Konsumen:</h6>
								<table>
									<tbody>
										<tr>
											<td class="pe-1">Nama</td>
											<td>: <?= $a['t_req_konsumen']; ?></td>
										</tr>
										<tr>
											<td class="pe-1">Phone</td>
											<td>: <?= $a['t_req_phone']; ?></td>
										</tr>
										<tr>
											<td class="pe-1">Alamat</td>
											<td>: <?= $a['t_req_alamat']; ?></td>
										</tr>
									</tbody>
								</table>
							</div>
							<div class="row mt-1">
								<div class="col-xl-4 col-md-6 col-12">
									<div class="mb-1">
										<label class="form-label" for="t_order_paket_id">ID Paket <small class="text-muted">(Order
												Konfirmasi)</small></label>
										<input type="text" class="form-control" id="t_order_paket_id" name="t_order_paket_id"
											value="<?= $a['t_order_id_pket']; ?>" />
									</div>
								</div>
								<div class="col-xl-4 col-md-6 col-12">
									<div class="mb-1">
										<label class="form-label" for="t_order_tgl_order">Tanggal Order</label>
										<input type="date" class="form-control" id="t_order_tgl_order" name="t_order_tgl_order"
											value="<?= $a['t_order_tgl']; ?>" />
									</div>
								</div>
								<div class="col-xl-4 col-md-6 col-12">
									<div class="mb-1">
										<label class="form-label" for="t_order_tgl_kirim">Tanggal Kirim <small
												class="text-muted">(Estimasi)</small></label>
										<input type="date" class="form-control" id="t_order_tgl_kirim" name="t_order_tgl_kirim"
											value="<?= $a['t_order_tgl_kirim']; ?>" />
									</div>
								</div>
							</div>
							<input type="hidden" class="form-control" id="t_order_visit_history_id"
								name="t_order_visit_history_id" value="<?= $a['m_visit_history_id']; ?>" />
							<input type="hidden" class="form-control" id="t_order_visit_id" name="t_order_visit_id"
								value="<?= $a['m_visit_id']; ?>" />
						</div>
						<div class="col-sm-4 mt-2">
							<h6 class="mb-2">Details:</h6>
							<table>
								<tbody>
									<tr>
										<td class="pe-1">Order</td>
										<td>: <span class="badge badge-light-danger"><?= $a['t_req_status']; ?></span></td>
									</tr>
									<tr>
										<td class="pe-1">Sales Person</td>
										<td>: <b><?= $a['name_user']; ?></b></td>
										<input type="hidden" class="form-control" id="t_order_user" name="t_order_user"
											value="<?= $a['id_user']; ?>" />
									</tr>
									<tr>
										<td class="pe-1">Division</td>
										<td>: Marketing</td>
									</tr>
									<tr>
										<td class="pe-1">Date Req</td>
										<td>: <?= date('d F, Y', strtotime($a['t_req_tgl'])); ?></td>
										<input type="hidden" class="form-control" id="t_order_tgl_req" name="t_order_tgl_req"
											value="<?= $a['t_req_tgl']; ?>" />
									</tr>
								</tbody>
							</table>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>
	<div id="show_tableProduk"></div>
</form>

<script>
$(document).ready(function() {
	$("#show_tableProduk").load(
		"<?= base_url('OrderRiwayat/ShowTableEditProduk/' . $a['t_order_kode'] . ''); ?>");
});
</script>