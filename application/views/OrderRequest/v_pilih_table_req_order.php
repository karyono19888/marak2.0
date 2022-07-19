<div class="row">
	<div class="col-sm-12">
		<div class="card">
			<div class="card-header">
				<h4 class="card-title">Pilih Instansi / Perorangan</h4>
				<button class="btn btn-dark Kembali">Back</button>
			</div>
			<div class="card-body">
				<div class="card-datatable">
					<table class="table table-hover table-borderless" id="mytable" width="100%">
						<thead>
							<tr>
								<th>No</th>
								<th>User</th>
								<th>Date</th>
								<th>Instansi</th>
								<th>Agenda</th>
								<th>Apbn/d/p</th>
								<th>Prospek</th>
								<th>Prognosa</th>
								<th>Status</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$i = 1;
							foreach ($visit->result_array() as $key) :
							?>
								<tr>
									<td class="text-center"><?= $i++; ?></td>
									<td width="7%"><?= $key['name_user']; ?></td>
									<td width="10%"><?= date('d F, Y', strtotime($key['m_visit_tgl'])); ?></td>
									<td width="20%"><?= $key['instansi_nama']; ?></td>
									<td width="20%"><?= $key['m_visit_agenda']; ?></td>
									<td width="10%">Rp. <?= number_format($key['m_visit_anggaran_BUMN'], 0, '.', '.'); ?></td>
									<td width="10%">Rp. <?= number_format($key['m_visit_prospek'], 0, '.', '.'); ?></td>
									<td width="10%">Rp. <?= number_format($key['m_visit_prognosa'], 0, '.', '.'); ?></td>
									<td>
										<?php if ($key['m_visit_status'] == "Close Po") : ?>
											<span class="badge rounded-pill badge-light-danger me-1"><?= $key['m_visit_status']; ?></span>
										<?php elseif ($key['m_visit_status'] == "Prognosa") : ?>
											<span class="badge rounded-pill badge-light-warning me-1"><?= $key['m_visit_status']; ?></span>
										<?php else : ?>
											<span class="badge rounded-pill badge-light-primary me-1"><?= $key['m_visit_status']; ?></span>
										<?php endif; ?>
									</td>
									<td class="text-center" width="20%">
										<a href="#" type="button" data-id="<?= $key['m_visit_history_id']; ?>" class="btn btn-flat-primary btn-sm Pilih">Pilih</a>
									</td>
								</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	$(document).ready(function() {
		$('#mytable').DataTable();
	})
	$(document).on("click", ".Kembali", function() {
		$("#show_data").load("<?= base_url('OrderRequest/ShowTableData'); ?>");
	});

	$(document).on("click", ".Pilih", function() {
		let id = $(this).data('id');
		$.ajax({
			type: "POST",
			url: "<?= site_url('OrderRequest/getDataShowRequest') ?>",
			data: {
				id: id
			},
			success: function(response) {
				$("#show_data").html(response);
			}
		});
	});
</script>