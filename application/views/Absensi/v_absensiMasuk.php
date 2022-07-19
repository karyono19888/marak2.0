<form class="mt-2" id="formAbsenMasuk" action="#" method="POST">
	<div id="my_camera" class="mb-2"></div>
	<div class="mb-1">
		<label class="form-label" for="m_user_nik">NIK</label>
		<input class="form-control" id="m_user_nik" type="text" name="m_user_nik" placeholder="0000-0000" aria-describedby="m_user_nik" autofocus="" tabindex="1" />
	</div>
	<div class="row">
		<div class="col-sm-6">
			<button class="btn btn-primary round w-100" type="submit" tabindex="2">Send</button>
		</div>
		<div class="col-sm-6">
			<button class="btn btn-outline-dark round w-100" onclick="location.reload();" type="button" id="tombolShowAbsenPulang" tabindex="2">Back</button>
		</div>
	</div>
</form>

<script>
	Webcam.set({
		width: 360,
		height: 260,
		image_format: 'jpeg',
		jpeg_quality: 90
	});
	Webcam.attach('#my_camera');

	$("#formAbsenMasuk").on('submit', function(e) {
		e.preventDefault();
		let image = '';
		Webcam.snap(function(data_uri) {
			image = data_uri;
		});
		let nik = $('#m_user_nik').val();
		$.ajax({
			url: '<?php echo site_url("Absensi/saveAbsensiMAsuk"); ?>',
			type: 'POST',
			data: {
				nik: nik,
				image: image
			},
			success: function(response) {
				const data = JSON.parse(response);
				if (data.success) {
					SweetAlert.fire({
						icon: 'success',
						title: 'Absen Berhasil',
						text: data.msg,
						imageUrl: '<?= base_url('/uploads/'); ?>' + data.image,
						imageWidth: 300,
						imageHeight: 300,
						showConfirmButton: false,
						timer: 2000
					});
					setTimeout(() => {
						$('#formAbsenMasuk')[0].reset();
					}, 2500);
				} else {
					SweetAlert.fire({
						icon: 'error',
						title: 'Absen Gagal',
						text: data.msg,
						showConfirmButton: false,
						timer: 2000
					});
					setTimeout(() => {
						$('#formAbsenMasuk')[0].reset();
					}, 2500);
				}
			}
		})

	})
</script>