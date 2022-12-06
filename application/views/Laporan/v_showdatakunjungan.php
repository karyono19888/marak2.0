<div class="card">
	<div class="card-header">
		<h4 class="card-title" id="title"><?= $title; ?></h4>
		<form id="formDownload">
			<input type="hidden" value="<?= $start; ?>" id="start" name="start">
			<input type="hidden" value="<?= $end; ?>" id="end" name="end">
		</form>
		<button class="btn <?= empty($data->result_array()) == "" ? 'btn-success' : 'btn-secondary disabled'; ?>"
			id="tombol_download" type="button"> <span>Download Excel</span></button>
	</div>
	<div class="card-body">
		<div class="table-responsive-sm">
			<table class="table table-hover table-borderless" id="mytable" width="100%">
				<thead>
					<tr>
						<th></th>
						<th>Date</th>
						<th>Instansi</th>
						<th>Agenda</th>
						<th>APBN/D/P</th>
						<th>Prospek</th>
						<th>Prognosa</th>
						<th>PO</th>
						<th>Estimasi Order</th>
						<th>Status</th>
						<th>Jenis Kunjungan</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<?php
					foreach ($data->result_array() as $a) :
					?>
					<tr>
						<td></td>
						<td><?= date('d F, Y', strtotime($a['m_visit_tgl'])); ?></td>
						<td><?= $a['instansi_nama']; ?></td>
						<td><?= $a['m_visit_agenda']; ?></td>
						<td><?= number_format($a['m_visit_anggaran_BUMN'], 0, '.', '.'); ?></td>
						<td><?= number_format($a['m_visit_prospek'], 0, '.', '.'); ?></td>
						<td><?= number_format($a['m_visit_prognosa'], 0, '.', '.'); ?></td>
						<td><?= number_format($a['m_visit_po'], 0, '.', '.'); ?></td>
						<td><?= $a['m_visit_estimasi_order']; ?></td>
						<td>
							<?php if ($a['m_visit_status'] == "Close Po") : ?>
							<span class="badge rounded-pill badge-light-danger me-1"><?= $a['m_visit_status']; ?></span>
							<?php elseif ($a['m_visit_status'] == "Prognosa") : ?>
							<span class="badge rounded-pill badge-light-warning me-1"><?= $a['m_visit_status']; ?></span>
							<?php else : ?>
							<span class="badge rounded-pill badge-light-primary me-1"><?= $a['m_visit_status']; ?></span>
							<?php endif; ?>
						</td>
						<td><?= $a['m_visit_history']; ?></td>
						<td></td>
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
});

$(document).on("click", "#tombol_download", function() {
	let $this = $(this);
	let form1 = $('#formDownload');
	form1.attr('action', "<?= site_url('Laporan/DownloadDataLaporanKunjungan'); ?>");
	form1.attr('method', 'POST');
	$this.html(
		'<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span><span class="ms-25 align-middle"> Loading... </span>'
		);
	form1.submit();
	setTimeout(() => {
		$this.html('<span class="ms-25 align-middle">Download Success</span>');
		$this.attr('disabled', 'disabled');
	}, 2000);
});
</script>