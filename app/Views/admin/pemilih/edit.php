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
					<label>Kelas</label>
					<select id="kelas-edit" class="form-control" name="kelas_id" required>
						<?php foreach ($kelasses as $kelas): ?>
							<option value="<?= $kelas['id'] ?>"><?= $kelas['name'] ?></option>
						<?php endforeach ?>
					</select>
				</div>
				<div class="form-group">
					<label>Username</label>
					<input id="username-edit" type="text" name="username" class="form-control" placeholder="Bisa dikosongkan, otomatis generate system">
				</div>
				<div class="form-group">
					<label>Password</label>
					<input type="text" name="password" class="form-control" placeholder="Bisa dikosongkan, otomatis generate system">
				</div>
				<div class="form-group">
					<label>Phone</label>
					<input id="phone-edit" type="tlp" name="phone" class="form-control" placeholder="Optional, Untuk mengirim link login">
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
		$("#modal-edit").attr('action', `<?= site_url('admin/pemilih/update') ?>/${id}`);

		$.getJSON(`<?= site_url('admin/pemilih/edit') ?>/${id}`, data => {
			$("#name-edit").val(data.name);
			$("#kelas-edit").val(data.kelas_id);
			$("#username-edit").val(data.username);
			$("#phone-edit").val(data.phone);

			$("#modal-edit").modal();
		});
	}
</script>