<section class="basic-select2">
	<div class="row">
		<div class="col-sm-9">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title">Data Kunjungan</h4>
					<a href="<?= base_url('Jadwal'); ?>" class="btn btn-default btn-dark">Back</a>
				</div>
				<div class="card-body">
					<div class="card-datatable">
						<table class="table table-hover table-borderless" id="mytable" width="100%">
							<thead>
								<tr>
									<th>#</th>
									<th>User</th>
									<th>Date</th>
									<th>Instansi</th>
									<th>Agenda</th>
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
										<td width="30%"><?= $key['m_visit_agenda']; ?></td>
										<td>
											<?php if ($key['m_visit_status'] == "Close Po") : ?>
												<span class="badge rounded-pill badge-light-danger me-1"><?= $key['m_visit_status']; ?></span>
											<?php elseif ($key['m_visit_status'] == "Prognosa") : ?>
												<span class="badge rounded-pill badge-light-warning me-1"><?= $key['m_visit_status']; ?></span>
											<?php else : ?>
												<span class="badge rounded-pill badge-light-primary me-1"><?= $key['m_visit_status']; ?></span>
											<?php endif; ?>
										</td>
										<td>
											<a href="#" type="button" id="Pilih" data-id="<?= $key['m_visit_id']; ?>" class="btn btn-primary btn-sm Pilih">Pilih</a>
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
</section>
<script>
	$(document).ready(function() {
		$('#mytable').DataTable();
	});

	$(document).on("click", ".Pilih", function() {
		document.getElementById("kunjungan_baru").checked = false;
		document.getElementById("kunjungan_update").checked = true;
		let id = $(this).data('id');

		$.ajax({
			type: "POST",
			url: "<?= site_url('Jadwal/TambahKunjunganUpdate') ?>",
			data: {
				id: id
			},
			success: function(response) {
				$("#show_jadwal").html(response);
			}
		});
	});
</script>