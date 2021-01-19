<form enctype="multipart/form-data" method="post" action="<?= site_url('admin/team/store/' . $event_data['id']) ?>" class="modal fade" tabindex="-1" role="dialog" id="modal-create">
	<?= csrf_field() ?>
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Tambah Team</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<label>Nama</label>
					<input type="text" name="name" class="form-control" required>
				</div>
				<div class="form-group">
					<label>Deskripsi</label>
					<textarea class="form-control" name="deskripsi" required></textarea>
				</div>
				<div class="form-group">
					<label>Gambar</label>
					<input type="file" name="gambar" class="form-control-file" accept="image/*" required>
				</div>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-primary">Simpan</button>
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
			</div>
		</div>
	</div>
</form>