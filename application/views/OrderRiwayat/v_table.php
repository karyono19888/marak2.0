<div class="card">
	<div class="card-header">
		<h4 class="card-title">Search & Filter</h4>
	</div>
	<div class="card-body">
		<div class="card-datatable">
			<table class="table table-hover table-borderless" id="mytable" width="100%">
				<thead>
					<tr>
						<th>No</th>
						<th>Order Date</th>
						<?php if ($this->session->userdata('role_user') == 1) : ?>
							<th>User</th>
							<th>Kode</th>
						<?php endif; ?>
						<th>Kategori</th>
						<th>Perusahaan</th>
						<th>Customer</th>
						<th>Alamat</th>
						<th>Prognosa</th>
						<th>Close</th>
						<th>Status</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$i = 1;
					foreach ($data->result_array() as $a) :
					?>
						<tr>
							<td><?= $i++; ?></td>
							<td width="10%"><?= date('d F, Y', strtotime($a['t_order_tgl_order'])); ?></td>
							<?php if ($this->session->userdata('role_user') == 1) : ?>
								<td><?= $a['name_user']; ?></td>
								<td><?= $a['t_order_kode']; ?></td>
							<?php endif; ?>
							<td>
								<?php if ($a['t_order_kategori'] == "E-Commerce") : ?>
									<span class="badge rounded-pill badge-light-success me-1"><?= $a['t_order_kategori']; ?></span>
								<?php elseif ($a['t_order_kategori'] == "Non E-catalog") : ?>
									<span class="badge rounded-pill badge-light-info me-1"><?= $a['t_order_kategori']; ?></span>
								<?php else : ?>
									<span class="badge rounded-pill badge-light-warning me-1"><?= $a['t_order_kategori']; ?></span>
								<?php endif; ?>
							</td>
							<td width="15%"><?= $a['org_nama']; ?></td>
							<td width="15%">
								<?php if ($a['t_order_kategori'] == "E-Commerce") : ?>
									<?= $a['t_req_konsumen']; ?>
								<?php else : ?>
									<?= $a['instansi_nama']; ?>
								<?php endif; ?>
							</td>
							<td width="20%">
								<?php if ($a['t_order_kategori'] == "E-Commerce") : ?>
									<?= $a['t_req_alamat']; ?>
								<?php else : ?>
									<?= $a['instansi_alamat']; ?>
								<?php endif; ?>
							</td>
							<td><?= number_format($a['m_visit_prognosa'], 0, '.', '.'); ?></td>
							<td><?= number_format($a['m_visit_po'], 0, '.', '.'); ?></td>
							<td>
								<span class="badge rounded-pill badge-light-danger me-1"><?= $a['t_order_status']; ?></span>
							</td>
							<td class="text-center" width="15%">
								<a href="#" type="button" class="btn btn-gradient-primary btn-sm Preview my-1" data-id="<?= $a['t_order_kode']; ?>">Preview</a>
							</td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<script>
	$(document).ready(function() {
		$('#mytable').DataTable();
	})
</script>