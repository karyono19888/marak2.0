<div class="card">
	<div class="card-header">
		<h4 class="card-title">Search & Filter</h4>
		<a href="#" class="dt-button create-new btn btn-primary Tambah" type="button">
			<span>Add New Product</span>
		</a>
	</div>
	<div class="card-body">
		<div class="card-datatable">
			<table class="table table-hover table-borderless" id="mytable" width="100%">
				<thead>
					<tr>
						<th>No</th>
						<th>Kategori</th>
						<th>Nama</th>
						<th>Kode</th>
						<th>Tipe</th>
						<th>Uom</th>
						<th>Deskripsi</th>
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
	});
</script>