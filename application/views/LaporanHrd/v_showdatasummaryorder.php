<div class="card">
	<div class="card-header">
		<h4 class="card-title" id="title"><?= $title; ?></h4>
		<form id="formDownload">
			<input type="hidden" value="<?= $start; ?>" id="start" name="start">
			<input type="hidden" value="<?= $end; ?>" id="end" name="end">
		</form>
		<button class="btn <?= empty($data->result_array()) == "" ? 'btn-success' : 'btn-secondary disabled'; ?>" id="tombol_download" type="button"> <span>Download Excel</span></button>
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
		form1.attr('action', "<?= site_url('Laporan/DownloadDataSummaryOrder'); ?>");
		form1.attr('method', 'POST');
		$this.html('<span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span><span class="ms-25 align-middle"> Loading... </span>');
		form1.submit();
		setTimeout(() => {
			$this.html('<span class="ms-25 align-middle">Download Success</span>');
			$this.attr('disabled', 'disabled');
		}, 2000);
	});
</script>