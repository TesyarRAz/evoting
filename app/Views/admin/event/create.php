<form method="post" action="<?= site_url('admin/event/store') ?>" class="modal fade" tabindex="-1" role="dialog" id="modal-create">
	<?= csrf_field() ?>
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Tambah Event</h5>
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
					<label>Keterangan</label>
					<textarea class="form-control" name="keterangan" required></textarea>
				</div>
				<div class="form-group">
					<label>Password</label>
					<input type="text" name="password" class="form-control" placeholder="Opsional">
				</div>
				<div class="form-group">
					<div class="form-check">
						<input id="aktif-create" type="checkbox" name="aktif" class="form-check-input">
						<label for="aktif-create">Aktif</label>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-primary">Simpan</button>
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
			</div>
		</div>
	</div>
</form>