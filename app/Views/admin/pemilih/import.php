<form enctype="multipart/form-data" method="post" action="<?= site_url('admin/pemilih/import') ?>" class="modal fade" tabindex="-1" role="dialog" id="modal-import">
	<?= csrf_field() ?>
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Import Pemilih</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<label>Berkas</label>
					<input type="file" name="berkas" class="form-control-file" accept="text/csv" required>
				</div>
				<div class="form-group">
					<label>Delimiter CSV</label>
					<input type="text" name="delimiter" class="form-control" value=";" required>
				</div>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-primary">Simpan</button>
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
			</div>
		</div>
	</div>
</form>