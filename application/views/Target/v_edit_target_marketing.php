<div class="row">
	<div class="col-sm-9">
		<div class="card">
			<form id="formtambah" method="post">
				<div class="card-header">
					<h4 class="card-title">Edit Target Marketing</h4>
				</div>
				<div class="card-body">
					<div class="row">
						<!-- Marketing -->
						<div class="col-sm-4 mb-1">
							<label class="form-label" for="marketing">Marketing</label>
							<select class="form-select select2" id="marketing" name="marketing">
								<option value="<?= $data['id_user']; ?>"><?= $data['name_user']; ?></option>
							</select>
						</div>
					</div>
					<div class="row">
						<!-- Target -->
						<div class="col-sm-4 mb-1">
							<label class="form-label" for="target">Target</label>
							<input type="text" class="form-control numeral-mask" id="target" name="target" placeholder="000.000" maxlength="7" value="<?= $data['m_target_jml']; ?>">
						</div>
						<!-- tahun -->
						<div class=" col-sm-4 mb-1">
							<label class="form-label" for="tahun">Tahun</label>
							<select class="form-select select2" id="tahun" name="tahun">
								<option value="<?= $data['m_target_thn']; ?>"><?= $data['m_target_thn']; ?></option>
								<option value="<?= date('Y'); ?>"><?= date('Y'); ?></option>
								<option value="<?= date('Y') + 1; ?>"><?= date('Y') + 1; ?></option>
							</select>
						</div>
						<!-- Provinsi -->
						<div class="col-sm-4 mb-1">
							<label class="form-label" for="provinsi">Provinsi</label>
							<select class="form-select select2" id="provinsi" name="provinsi[]" multiple="multiple">
								<?php
								$this->db->join('m_provinsi', 'id_prov=m_cover_prov_id', 'left');
								$wilayah = $this->db->get_where('m_area_cover_wilayah', ['m_cover_prov_user' => $data['m_target_user'], 'm_cover_prov_thn' => $data['m_target_thn']])->result_array();
								foreach ($wilayah as $b) :
								?>
									<option value="<?= $b['id_prov']; ?>" selected><?= $b['prov_nama']; ?></option>
								<?php endforeach; ?>
							</select>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
	<div class="col-sm-3">
		<div class="card">
			<div class="card-body">
				<button class="btn btn-warning w-100 mb-75" id="tombol_simpan" type="button">Edit Save</button>
				<a href="#" onclick="location.reload();" class="btn btn-outline-primary w-100" type="button">Cancle</a>
			</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function() {
		$("#marketing").select2({
			ajax: {
				url: '<?= base_url('TargetMarketing/showUserMarketing'); ?>',
				type: "post",
				dataType: 'json',
				delay: 200,
				data: function(params) {
					return {
						searchTerm: params.term
					};
				},
				processResults: function(response) {
					return {
						results: response
					};
				},
				cache: true
			}
		});
		$("#provinsi").select2({
			placeholder: '- Pilih area cover provinsi',
			ajax: {
				url: '<?= base_url('TargetMarketing/getProvinsi'); ?>',
				type: "post",
				dataType: 'json',
				delay: 200,
				data: function(params) {
					return {
						searchTerm: params.term
					};
				},
				processResults: function(response) {
					return {
						results: response
					};
				},
				cache: true
			}
		});
	});
	$(document).ready(function() {
		let numeralMask = $('.numeral-mask');
		new Cleave(numeralMask, {
			numeral: true,
			numeralThousandsGroupStyle: 'thousand'
		});
	})
	$(document).on("click", "#tombol_simpan", function() {
		if (validasi2()) {
			let data = $('#formtambah').serialize();
			$.ajax({
				type: 'POST',
				url: '<?= base_url('TargetMarketing/EditTargetMarketing'); ?>',
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
							showConfirmButton: true,
							timer: 2000
						});
					}
					setTimeout(() => {
						window.location.assign('<?= site_url("TargetMarketing") ?>');
					}, 2000);
				}
			});
		}
	});

	function validasi2() {
		let marketing = document.getElementById("marketing").value;
		let target = document.getElementById("target").value;
		let tahun = document.getElementById("tahun").value;
		let provinsi = document.getElementById("provinsi").value;
		if ((marketing == "") || (target == "") || (tahun == "") || (provinsi == "")) {
			if (provinsi == "") {
				notif("Provinsi Cover");
			}
			if (tahun == "") {
				notif("Tahun");
			}
			if (target == "") {
				notif("Target");
			}
			if (marketing == "") {
				notif("Nama Marketing");
			}
		} else {
			return true;
		}
	}

	function notif(word) {
		Swal.fire({
			title: 'Perhatian',
			text: word + ' wajib di isi !',
			icon: 'info',
		}).then((result) => {})
	}
</script>