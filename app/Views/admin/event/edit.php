<form method="post" class="modal fade" tabindex="-1" role="dialog" id="modal-edit">
	<?= csrf_field() ?>
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Edit Pemilih</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="form-group">
					<label>Nama</label>
					<input id="name-edit" type="text" name="name" class="form-control" required>
				</div>
				<div class="form-group">
					<label>Keterangan</label>
					<textarea id="keterangan-edit" class="form-control" name="keterangan" required></textarea>
				</div>
				<div class="form-group">
					<label>Password</label>
					<input id="password-edit" type="text" name="password" class="form-control" placeholder="Opsional">
				</div>
				<div class="form-group">
					<div class="form-check">
						<input id="aktif-edit" type="checkbox" name="aktif" class="form-check-input">
						<label for="aktif-edit">Aktif</label>
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

<script type="text/javascript">
	function action_edit(id) {
		$("#modal-edit").attr('action', `<?= site_url('admin/event/update') ?>/${id}`);

		$.getJSON(`<?= site_url('admin/event/edit') ?>/${id}`, data => {
			$("#name-edit").val(data.name);
			$("#keterangan-edit").val(data.keterangan);
			$("#password-edit").val(data.password);
			data.aktif == true && $("#aktif-edit").attr('checked', '');

			$("#modal-edit").modal();
		});
	}
</script>