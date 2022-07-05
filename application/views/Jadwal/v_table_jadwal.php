<div class="card-header">
	<h4 class="card-title" id="title"><?= $label; ?></h4>
	<a href="<?= base_url('Jadwal/Tambah'); ?>" class="dt-button create-new btn btn-primary Tambah" type="button">
		<span>Add New Jadwal</span>
	</a>
</div>
<div class="card-body">
	<div class="card-datatable">
		<table class="table table-hover table-borderless" id="mytable" width="100%">
			<thead>
				<tr>
					<th>#</th>
					<?php if ($this->session->userdata('role_user') == 1) : ?>
						<th>Pic</th>
					<?php endif; ?>
					<th>Date</th>
					<th>Type</th>
					<th>Instansi</th>
					<th>Activity</th>
					<th>Kunjungan</th>
					<th>Agenda</th>
					<th>Status</th>
					<th>Actions</th>
				</tr>
			</thead>

			<tbody>
				<?php
				$i = 1;
				foreach ($jadwal->result_array() as $key) :
				?>
					<tr>
						<td><?= $i++; ?></td>
						<?php if ($this->session->userdata('role_user') == 1) : ?>
							<td><?= $key['name_user']; ?></td>
						<?php endif; ?>
						<td><?= $key['date_visit']; ?>, <?= $key['time']; ?></td>
						<td>
							<?php if ($key['new_or_update'] === '0') : ?>
								<span class="badge rounded-pill badge-light-primary me-1">New</span>
							<?php else : ?>
								<span class="badge rounded-pill badge-light-warning me-1">Update</span>
							<?php endif; ?>
						</td>
						<td><?= $key['instansi_nama']; ?></td>
						<td><?= $key['type_act']; ?></td>
						<td><?= $key['type_alamat']; ?></td>
						<td><?= $key['acara']; ?></td>
						<td>
							<?php if ($key['status'] == "Planning") : ?>
								<span class="badge rounded-pill badge-light-primary me-1"><?= $key['status']; ?></span>
							<?php elseif ($key['status'] == "Visited") : ?>
								<span class="badge rounded-pill badge-light-success me-1"><?= $key['status']; ?></span>
							<?php else : ?>
								<span class="badge rounded-pill badge-light-danger me-1"><?= $key['status']; ?></span>
							<?php endif; ?>
						</td>
						<td>
							<div class="btn-group" role="group" aria-label="Basic example">
								<?php if ($key['status'] == "Planning") : ?>
									<a href="<?= base_url('Jadwal/Edit/' . $key['id_jadwal']); ?>" type="button" class="btn btn-outline-warning btn-sm">Edit</a>
									<?php if ($this->session->userdata('role_user') == 1) : ?>
										<button type="button" class="btn btn-outline-danger btn-sm Hapus" data-id="<?= $key['id_jadwal']; ?>">Delete</button>
									<?php endif; ?>
								<?php else : ?>
									<button type="button" class="btn btn-outline-info btn-sm Result viewResult" data-id="<?= $key['id_jadwal']; ?>" data-bs-toggle="modal" data-bs-target="#exampleModalCenter">Preview</button>
								<?php endif; ?>
								<?php if ($key['status'] == "Planning") : ?>
									<button type="button" class="btn btn-outline-primary btn-sm dropdown-toggle " data-bs-toggle="dropdown">Actions</button>
									<div class="dropdown-menu dropdown-menu-end">
										<a class="dropdown-item" href="<?= $key['visit_id'] == 0 ? '' . base_url('Jadwal/tambahBaruKunjungan/' . $key['id_jadwal']) . '' : '' . base_url('Visit/ViewUpdate/' . $key['visit_id']) . '' ?>">
											<span class="text-info">Visited</span>
										</a>
										<a class="dropdown-item Notvisited" href="#" data-bs-toggle="modal" data-bs-target="#exampleModalCenter" data-id="<?= $key['id_jadwal']; ?>">
											<span class="text-danger">Not Visited</span>
										</a>
									</div>
							</div>
						<?php endif; ?>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>

<!-- Vertical modal -->
<div class="vertical-modal-ex">
	<!-- Modal -->
	<div class="modal fade" id="exampleModalCenter" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-hidden="false" data-bs-backdrop="false">
		<div class="modal-dialog modal-dialog-centered modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalCenterTitle">Result "<span id="namaDinas" class="fw-bolder"></span>"</h5>
					<button type="button" class="btn-close close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<form action="" method="POST" id="formResult">
						<div class="row">
							<div class="col-12">
								<label class="form-label" for="notvisited">Isi result ?<span class="text-danger">*</span></label>
								<input type="hidden" name="notvisited" id="notvisited" value="<?= set_value('notvisited') ?>">
								<div id="editor" style="min-height: 100px;"><?= set_value('notvisited') ?></div>
								<input type="hidden" name="id_jadwal" id="id_jadwal">
							</div>
						</div>
					</form>
				</div>
				<div class="modal-footer mt-5">
					<button type="button" class="btn btn-primary" id="tombol_simpan">Simpan</button>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Vertical modal end-->
<script>
	$(document).ready(function() {
		$('#mytable').DataTable();
	});
</script>
<script>
	var quill = new Quill('#editor', {
		theme: 'snow'
	});

	quill.on('text-change', function(delta, oldDelta, source) {
		document.querySelector("input[name='notvisited']").value = quill.root.innerHTML;
	});

	// getview
	$(document).on("click", ".viewResult", function() {
		$('#tombol_simpan').hide();
		let id = $(this).data('id');
		$.ajax({
			type: 'POST',
			url: '<?= site_url('Jadwal/ViewNotVisited') ?>',
			data: {
				id: id
			},
			success: function(response) {
				let data = JSON.parse(response);
				if (data.success) {
					$('#id_jadwal').val(data.id_jadwal);
					$("input[name='notvisited']").val(data.result_not_visited);
					document.getElementById("namaDinas").innerHTML = data.instansi_nama;
					document.getElementById("editor").innerHTML = data.result_not_visited;
				} else {
					Swal.fire({
						icon: 'warning',
						title: 'Warning',
						text: data.msg,
						showConfirmButton: false,
						timer: 1500
					});
				}
			}
		});
	});

	$(document).on("click", ".Notvisited", function() {
		let id = $(this).data('id');
		$.ajax({
			type: 'POST',
			url: '<?= site_url('Jadwal/ViewNotVisited') ?>',
			data: {
				id: id
			},
			success: function(response) {
				let data = JSON.parse(response);
				if (data.success) {
					$('#id_jadwal').val(data.id_jadwal);
					document.getElementById("namaDinas").innerHTML = data.instansi_nama;
				} else {
					Swal.fire({
						icon: 'warning',
						title: 'Warning',
						text: data.msg,
						showConfirmButton: false,
						timer: 1500
					});
				}
			}
		});
	});


	$(document).on("click", ".close", function() {
		$("input[name='notvisited']").val("");
		$('#id_jadwal').val("");
	});

	// update
	$(document).on("click", "#tombol_simpan", function() {
		if (validasiupdate()) {
			let data = $('#formResult').serialize();
			$.ajax({
				type: 'POST',
				url: '<?= site_url('Jadwal/ResultSimpan') ?>',
				data: data,
				success: function(response) {
					var data = JSON.parse(response);
					if (data.success) {
						Swal.fire({
							icon: 'success',
							title: 'Success',
							text: data.msg,
							showConfirmButton: false,
							timer: 1500
						});
					} else {
						Swal.fire({
							icon: 'error',
							title: 'Error',
							text: data.msg,
							showConfirmButton: false,
							timer: 1500
						});
					}
					setTimeout(() => {
						window.location.assign('<?= site_url("Jadwal") ?>');
					}, 1500);
				}
			});
		}
	});

	function validasiupdate() {
		let notvisited = document.getElementById("notvisited").value;
		if (notvisited == "") {
			notif("Result Tidak terkunjungi");
		} else {
			return true;
		}
	}