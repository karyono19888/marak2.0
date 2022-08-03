<div class="row">
	<div class="col-sm-9">
		<div class="card">
			<div class="card-header">
				<h4 class="card-title text-info"><b>Preview Order</b></h4>
				<h4 class="card-title text-info"><b>#<?= $data['t_req_kode']; ?></b></h4>
			</div>
			<div class="card-body">
				<form action="#" method="post" id="formRequestOrder">
					<div class="row">
						<div class="col-sm-8">
							<h6 class="mb-2">Ordering from:</h6>
							<h6 class="mb-25"><b><?= $data['instansi_nama']; ?></b></h6>
							<p class="card-text mb-25"><?= $data['instansi_alamat']; ?></p>
							<br>
							<table>
								<tbody>
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
										</td>
									</tr>
									<tr>
										<td class="pe-1">Perusahaan</td>
										<td>: <b><?= $data['org_nama']; ?></b></td>
									</tr>
								</tbody>
							</table>

							<div id="showEcommerce" <?= $data['t_req_kategori'] == "E-Commerce" ? '' : 'style="display: none;"' ?>>
								<hr>
								<table class="table table-bordered">
									<thead>
										<tr>
											<th>Konsumen</th>
											<th>Phone</th>
											<th>Alamat</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td><?= $data['t_req_konsumen']; ?></td>
											<td><?= $data['t_req_phone']; ?></td>
											<td><?= $data['t_req_alamat']; ?></td>
										</tr>
									</tbody>
								</table>
							</div>
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
									</tr>
									<tr>
										<td class="pe-1">Division</td>
										<td>: Marketing</td>
									</tr>
									<tr>
										<td class="pe-1">Date Req</td>
										<td>: <?= date('d F, Y', strtotime($data['t_req_tgl'])); ?></td>
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
				<button class="btn btn-danger w-100 mb-75" id="tombol_close" data-id="<?= $data['t_req_id']; ?>" type="button">Close Order</button>
				<a href="#" class="btn btn-outline-primary w-100 Kembali" type="button">Back</a>
			</div>
		</div>
	</div>
</div>

<script>
	$(document).on("click", ".Kembali", function() {
		$("#show_data").load("<?= base_url('OrderMasuk/ShowTableData'); ?>");
	});
</script>