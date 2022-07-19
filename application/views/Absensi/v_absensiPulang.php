<form class="auth-forgot-password-form mt-2" action="#" method="POST">
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
			<button class="btn btn-outline-dark round w-100" type="button" onclick="location.reload();" id="tombolShowAbsenMasuk" tabindex="2">Back</button>
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
</script>