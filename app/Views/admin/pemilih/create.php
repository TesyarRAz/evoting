<form method="post" action="<?= site_url('admin/pemilih/store') ?>" class="modal fade" tabindex="-1" role="dialog" id="modal-create">
	<?= csrf_field() ?>
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Tambah Pemilih</h5>
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
					<label>Kelas</label>
					<select class="form-control" name="kelas_id" required>
						<?php foreach ($kelasses as $kelas): ?>
							<option value="<?= $kelas['id'] ?>"><?= $kelas['name'] ?></option>
						<?php endforeach ?>
					</select>
				</div>
				<div class="form-group">
					<label>Email</label>
					<input type="email" name="phone" class="form-control" placeholder="Wajib, untuk kirim email akses">
				</div>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-primary">Simpan</button>
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
			</div>
		</div>
	</div>
</form>