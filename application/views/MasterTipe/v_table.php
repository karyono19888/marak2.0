<div class="card">
	<div class="card-header">
		<h4 class="card-title">Search & Filter</h4>
		<a href="#" class="dt-button create-new btn btn-primary Tambah" type="button">
			<span>Add New Tipe</span>
		</a>
	</div>
	<div class="card-body">
		<div class="card-datatable">
			<table class="table table-hover table-borderless" id="mytable" width="100%">
				<thead>
					<tr>
						<th>No</th>
						<th>Kode</th>
						<th>Nama</th>
						<th>Deskripsi</th>
						<th>Status</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					<?php $i = 1;
					foreach ($data->result_array() as $a) : ?>
						<tr>
							<td><?= $i++; ?></td>
							<td><?= $a['m_tipe_kode']; ?></td>
							<td><?= $a['m_tipe_nama']; ?></td>
							<td><?= $a['m_tipe_deskripsi']; ?></td>
							<td>
								<?php if ($a['m_tipe_status'] == "Aktif") : ?>
									<span class="badge badge-light-primary"><?= $a['m_tipe_status']; ?></span>
								<?php else : ?>
									<span class="badge badge-light-danger"><?= $a['m_tipe_status']; ?></span>
								<?php endif; ?>
							</td>
							<td class="text-center" width="20%">
								<a href="#" type="button" class="btn btn-gradient-warning btn-sm Edit" data-id="<?= $a['m_tipe_id']; ?>">Edit</a>
								<a href="#" type="button" class="btn btn-gradient-danger btn-sm Delete" data-id="<?= $a['m_tipe_id']; ?>">Delete</a>
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
	});
</script>