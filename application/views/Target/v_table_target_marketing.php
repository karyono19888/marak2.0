<div class="card">
	<div class="card-header">
		<h4 class="card-title">Search & Filter</h4>
		<button class="dt-button create-new btn btn-primary Tambah" type="button">
			<span>Add New Target</span>
		</button>
	</div>
	<div class="card-body">
		<div class="card-datatable table-responsive pt-0">
			<table class="user-list-table table table-borderless" id="mytable">
				<thead class="table-light">
					<tr>
						<th>No</th>
						<th>User</th>
						<th>Target</th>
						<th>Area Cover</th>
						<th>Tahun</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$i = 1;
					foreach ($data->result_array() as $a) :
						$this->db->join('m_provinsi', 'id_prov=m_cover_prov_id', 'left');
						$wilayah = $this->db->get_where('m_area_cover_wilayah', ['m_cover_prov_user' => $a['m_target_user'], 'm_cover_prov_thn' => $a['m_target_thn']])->result_array();
					?>
						<tr>
							<td class="text-center"><?= $i++; ?></td>
							<td><?= $a['name_user']; ?></td>
							<td>Rp. <?= number_format($a['m_target_jml'], 0, '.', '.'); ?></td>
							<td>
								<div class="avatar-group">
									<?php foreach ($wilayah as $b) : ?>
										<div data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" class=" pull-up my-0" title="<?= $b['prov_nama']; ?>">
											<span class="badge badge-light-primary"><?= $b['prov_nama']; ?></span>,
										</div>
									<?php endforeach; ?>
								</div>
							</td>
							<td><?= $a['m_target_thn']; ?></td>
							<td>
								<a href="#" class="btn btn-sm btn-warning Edit" data-id="<?= $a['m_target_id']; ?>">Edit</a>
								<a href="#" class="btn btn-sm btn-danger Hapus" data-id="<?= $a['m_target_id']; ?>">Hapus</a>
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

	$(document).on("click", ".Edit", function() {
		let id = $(this).data('id');
		$.ajax({
			type: "Post",
			url: "<?= base_url('TargetMarketing/ViewEditTarget'); ?>",
			data: {
				id: id
			},
			success: function(response) {
				$("#showData").html(response);
			}
		});
	});

	$(document).on("click", ".Hapus", function() {
		let id = $(this).data('id');
		Swal.fire({
			title: 'Are you sure?',
			text: "Hapus Permanent Data!",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Yes, delete it!'
		}).then((result) => {
			if (result.isConfirmed) {
				$.ajax({
					type: 'POST',
					url: '<?= site_url('TargetMarketing/Delete') ?>',
					data: {
						id: id
					},
					success: function(response) {
						let data = JSON.parse(response);
						if (data.success) {
							SweetAlert.fire({
								icon: 'success',
								title: 'Deleted!',
								text: data.msg,
								showConfirmButton: false,
								timer: 1500
							});
						} else {
							SweetAlert.fire({
								icon: 'error',
								title: 'Error',
								text: data.msg,
								showConfirmButton: false,
								timer: 1500
							});
						}
						setTimeout(() => {
							window.location.assign('<?= site_url("TargetMarketing") ?>');
						}, 1500);
					}
				});
			}
		})
	});
</script>