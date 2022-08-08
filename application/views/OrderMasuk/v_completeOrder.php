<form action="#" method="post" id="formRequestOrder">
	<div class="row">
		<div class="col-sm-12">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title text-primary"><b>Complete Order</b></h4>
					<h4 class="card-title text-primary"><b>#<?= $kode; ?></b></h4>
					<input type="hidden" class="form-control" id="t_order_kode" name="t_order_kode" value="<?= $kode; ?>" />
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-sm-8">
							<h6 class="mb-2">Ordering from:</h6>
							<h6 class="mb-25"><b><?= $data['instansi_nama']; ?></b></h6>
							<p class="card-text mb-25"><?= $data['instansi_alamat']; ?></p>
							<br>
							<table>
								<tbody>
									<tr>
										<td class="pe-1">Req Code</td>
										<td>: <b>#<?= $data['t_req_kode']; ?></b></td>
										<input type="hidden" class="form-control" id="t_req_kode" name="t_req_kode" value="<?= $data['t_req_kode']; ?>" />
									</tr>
									<tr>
										<td class="pe-1">Jenis Order</td>
										<td>
											<?php if ($data['t_req_kategori'] == "E-Commerce") : ?>
												: <span class="badge badge-light-success"><?= $data['t_req_kategori']; ?></span>
											<?php elseif ($data['t_req_kategori'] == "E-catalog") : ?>
												: <span class="badge badge-light-warning"><?= $data['t_req_kategori']; ?></span>
											<?php else : ?>
												: <span class="badge badge-light-info"><?= $data['t_req_kategori']; ?></span>
											<?php endif; ?>
											<input type="hidden" class="form-control" id="t_order_kategori" name="t_order_kategori" value="<?= $data['t_req_kategori']; ?>" />
										</td>
									</tr>
									<tr>
										<td class="pe-1">Perusahaan</td>
										<td>: <b><?= $data['org_nama']; ?></b></td>
										<input type="hidden" class="form-control" id="t_order_perusahaan" name="t_order_perusahaan" value="<?= $data['org_id']; ?>" />
									</tr>
								</tbody>
							</table>

							<div id="showEcommerce" <?= $data['t_req_kategori'] == "E-Commerce" ? '' : 'style="display: none;"' ?>>
								<hr>
								<h6 class="mb-2">Data Konsumen:</h6>
								<table>
									<tbody>
										<tr>
											<td class="pe-1">Nama</td>
											<td>: <?= $data['t_req_konsumen']; ?></td>
										</tr>
										<tr>
											<td class="pe-1">Phone</td>
											<td>: <?= $data['t_req_phone']; ?></td>
										</tr>
										<tr>
											<td class="pe-1">Alamat</td>
											<td>: <?= $data['t_req_alamat']; ?></td>
										</tr>
									</tbody>
								</table>
							</div>
							<div class="row mt-1">
								<div class="col-xl-4 col-md-6 col-12">
									<div class="mb-1">
										<label class="form-label" for="t_order_paket_id">ID Paket <small class="text-muted">(Order Konfirmasi)</small></label>
										<input type="text" class="form-control" id="t_order_paket_id" name="t_order_paket_id" placeholder="000 000 000" />
									</div>
								</div>
								<div class="col-xl-4 col-md-6 col-12">
									<div class="mb-1">
										<label class="form-label" for="t_order_tgl_order">Tanggal Order</label>
										<input type="date" class="form-control" id="t_order_tgl_order" name="t_order_tgl_order" />
									</div>
								</div>
								<div class="col-xl-4 col-md-6 col-12">
									<div class="mb-1">
										<label class="form-label" for="t_order_tgl_kirim">Tanggal Kirim <small class="text-muted">(Estimasi)</small></label>
										<input type="date" class="form-control" id="t_order_tgl_kirim" name="t_order_tgl_kirim" />
									</div>
								</div>
							</div>
							<input type="hidden" class="form-control" id="t_order_visit_history_id" name="t_order_visit_history_id" value="<?= $data['m_visit_history_id']; ?>" />
							<input type="hidden" class="form-control" id="t_order_visit_id" name="t_order_visit_id" value="<?= $data['m_visit_id']; ?>" />
						</div>
						<div class="col-sm-4 mt-2">
							<h6 class="mb-2">Details:</h6>
							<table>
								<tbody>
									<tr>
										<td class="pe-1">Order</td>
										<td>: <span class="badge badge-light-warning"><?= $data['t_req_status']; ?></span></td>
									</tr>
									<tr>
										<td class="pe-1">Sales Person</td>
										<td>: <b><?= $data['name_user']; ?></b></td>
										<input type="hidden" class="form-control" id="t_order_user" name="t_order_user" value="<?= $data['id_user']; ?>" />
									</tr>
									<tr>
										<td class="pe-1">Division</td>
										<td>: Marketing</td>
									</tr>
									<tr>
										<td class="pe-1">Date Req</td>
										<td>: <?= date('d F, Y', strtotime($data['t_req_tgl'])); ?></td>
										<input type="hidden" class="form-control" id="t_order_tgl_req" name="t_order_tgl_req" value="<?= $data['t_req_tgl']; ?>" />
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
		$("#show_tableProduk").load("<?= base_url('OrderMasuk/ShowTableProduk/' . $kode . ''); ?>");
	});
</script>