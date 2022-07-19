<div class="card">
	<div class="card-header">
		<h4 class="card-title">Search & Filter</h4>
		<a href="#" class="dt-button create-new btn btn-primary Tambah" type="button">
			<span><i data-feather='plus'></i> Add New Request</span>
		</a>
	</div>
	<div class="card-body">
		<div class="card-datatable">
			<table class="table table-hover table-borderless" id="mytable" width="100%">
				<thead>
					<tr>
						<th>#</th>
						<th>Req Date</th>
						<th>Pic</th>
						<th>Instansi</th>
						<th>Alamat</th>
						<th>Prognosa</th>
						<th>Status</th>
						<th>Actions</th>
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
	})
</script>