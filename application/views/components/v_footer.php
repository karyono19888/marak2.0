<div class="sidenav-overlay"></div>
<div class="drag-target"></div>

<!-- BEGIN: Footer-->
<footer class="footer footer-static footer-light">
	<p class="clearfix mb-0"><span class="float-md-start d-block d-md-inline-block mt-25">COPYRIGHT &copy; <?= date('Y'); ?><a class="ms-25" href="#" target="_blank">Marak 2.0</a><span class="d-none d-sm-inline-block">, All rights Reserved</span></span><span class="float-md-end d-none d-md-block">Hand-crafted & Made with<i data-feather="heart"></i></span></p>
</footer>
<button class="btn btn-primary btn-icon scroll-top" type="button"><i data-feather="arrow-up"></i></button>
<!-- END: Footer-->


<!-- BEGIN: Vendor JS-->
<script src="<?= base_url('assets'); ?>/vendors/js/vendors.min.js"></script>
<!-- BEGIN Vendor JS-->

<!-- BEGIN: Page Vendor JS-->
<script src="<?= base_url('assets'); ?>/vendors/js/extensions/toastr.min.js"></script>
<!-- END: Page Vendor JS-->

<!-- BEGIN: Theme JS-->
<script src="<?= base_url('assets'); ?>/js/core/app-menu.js"></script>
<script src="<?= base_url('assets'); ?>/js/core/app.js"></script>
<!-- END: Theme JS-->

<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<script src="<?= base_url('assets'); ?>/vendors/js/extensions/sweetalert2.all.min.js"></script>
<script>
	$(document).ready(function() {
		let section = $('#section-block');
		section.block({
			message: '<div class="d-flex justify-content-center align-items-center"><p class="me-50 mb-0">Please wait...</p><div class="spinner-grow spinner-grow-sm text-white" role="status"></div>',
			timeout: 1000,
			css: {
				backgroundColor: 'transparent',
				color: '#fff',
				border: '0'
			},
			overlayCSS: {
				opacity: 0.5
			}
		});
	})
</script>

<script>
	$(window).on('load', function() {
		if (feather) {
			feather.replace({
				width: 14,
				height: 14
			});
		}
	})
</script>

<script>
	let span = document.getElementById('span');

	function time() {
		let options = {
			weekday: 'long',
			year: 'numeric',
			month: 'long',
			day: 'numeric'
		};
		let today = new Date();
		let d = new Date();
		let s = d.getSeconds();
		let m = d.getMinutes();
		let h = d.getHours();
		span.textContent = today.toLocaleDateString("en-GB", options) + "  " + ("0" + h).substr(-2) + ":" + ("0" + m).substr(-2) + ":" + ("0" + s).substr(-2);
	}

	setInterval(time, 1000);
</script>

</script>
<?php if ($this->session->flashdata('success')) : ?>
	<script>
		Swal.fire({
			icon: 'success',
			title: 'Success',
			text: '<?php echo $this->session->flashdata('success'); ?>',
			showConfirmButton: false,
			timer: 1500
		})
	</script>

	<script>
		setTimeout(function() {
			toastr['success'](
				'Tetap semangat ya, semoga sehat selalu',
				'???? Selamat Datang, <?= $this->session->userdata('name_user'); ?>!', {
					closeButton: true,
					tapToDismiss: false,
				}
			);
		}, 2000);
	</script>
<?php endif;
unset($_SESSION['success']); ?>

<script>
	function Logout() {
		Swal.fire({
			title: 'Logout ?',
			text: "Yakin mau keluar dari aplikasi ?",
			icon: 'question',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Yes'
		}).then((result) => {
			if (result.isConfirmed) {
				window.location.assign('<?php echo base_url('Auth/logout') ?>');
			}
		})
	}

	function pengembangan() {
		Swal.fire({
			icon: 'error',
			title: 'Oops...',
			text: 'Something went wrong!',
			customClass: {
				confirmButton: 'btn btn-primary'
			},
			buttonsStyling: false
		});
	}
</script>