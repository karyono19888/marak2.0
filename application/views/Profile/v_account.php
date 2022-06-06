<div class="card">
	<div class="card-header border-bottom">
		<h4 class="card-title">Profile Details</h4>
	</div>
	<div class="card-body py-2 my-25">
		<!-- header section -->
		<form class="validate-form pt-50" method="POST" id="formAccount" action="<?= base_url('Profile/UpdateAccount'); ?>" enctype="multipart/form-data">
			<div class="d-flex">
				<a href="#" class="me-25">
					<img src="<?= $profile->image_user; ?>" id="account_upload-img" class="uploadedAvatar rounded me-50" alt="profile image" height="100" width="100" />
				</a>
				<!-- upload and reset button -->
				<div class="d-flex align-items-end mt-75 ms-1">
					<div>
						<label for="account_upload" class="btn btn-sm btn-primary mb-75 me-75">Upload</label>
						<input type="file" id="account_upload" name="account_upload" hidden accept="image/*" />
						<button type="button" id="account-reset" class="btn btn-sm btn-outline-secondary mb-75">Reset</button>
						<p class="mb-0">Allowed file types: png, jpg, jpeg.</p>
					</div>
				</div>
				<!--/ upload and reset button -->
			</div>
			<!--/ header section -->

			<!-- form -->
			<div class="row mt-1">
				<input type="hidden" name="id_user" value="<?= $profile->id_user; ?>">
				<div class="col-12 col-sm-6 mb-1">
					<label class="form-label" for="username">Username</label>
					<input type="text" class="form-control" id="username" name="username" value="<?= $profile->username; ?>" readonly />
				</div>
				<div class="col-12 col-sm-6 mb-1">
					<label class="form-label" for="role_user">User Role</label>
					<input type="text" class="form-control" id="role_user" name="role_user" value="<?= $profile->role_name; ?>" readonly />
				</div>
				<div class="col-12 col-sm-6 mb-1">
					<label class="form-label" for="name_user">Nama Lengkap</label>
					<input type="text" class="form-control" id="name_user" name="name_user" placeholder="Organization name" value="<?= $profile->name_user; ?>" />
				</div>
				<div class="col-12 col-sm-6 mb-1">
					<label class="form-label" for="email_user">Email</label>
					<input type="email" class="form-control" id="email_user" name="email_user" placeholder="Your Name" value="<?= $profile->email_user; ?>" />
				</div>
				<div class="col-12 col-sm-6 mb-1">
					<label class="form-label" for="phone">Phone Number</label>
					<input type="text" class="form-control account-number-mask" id="phone" name="phone" placeholder="Phone Number" value="<?= $profile->phone; ?>" />
				</div>
				<div class="col-12 col-sm-6 mb-1">
					<label class="form-label" for="address">Address</label>
					<input type="text" class="form-control" id="address" name="address" placeholder="Your Address" value="<?= $profile->address; ?>" />
				</div>
				<div class="col-12 col-sm-6 mb-1">
					<label class="form-label" for="state">State</label>
					<input type="text" class="form-control" id="state" name="state" placeholder="State" readonly value="<?= $profile->state; ?>" />
				</div>
				<div class="col-12">
					<button type="submit" class="btn btn-primary mt-1 me-1" id="tombol_simpan">Save changes</button>
					<button type="reset" class="btn btn-outline-secondary mt-1">Discard</button>
				</div>
			</div>
		</form>
		<!--/ form -->
	</div>
</div>
<!--/ profile -->
<script>
	$(document).ready(function() {
		let accountUploadImg = $('#account_upload-img'),
			accountUploadBtn = $('#account_upload'),
			accountUserImage = $('.uploadedAvatar'),
			accountResetBtn = $('#account-reset');
		if (accountUserImage) {
			var resetImage = accountUserImage.attr('src');
			accountUploadBtn.on('change', function(e) {
				var reader = new FileReader(),
					files = e.target.files;
				reader.onload = function() {
					if (accountUploadImg) {
						accountUploadImg.attr('src', reader.result);
					}
				};
				reader.readAsDataURL(files[0]);
			});

			accountResetBtn.on('click', function() {
				accountUserImage.attr('src', resetImage);
			});
		}
	})
</script>