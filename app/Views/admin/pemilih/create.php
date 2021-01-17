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
					<label>Username</label>
					<input type="text" name="username" class="form-control" placeholder="Bisa dikosongkan, otomatis generate system">
				</div>
				<div class="form-group">
					<label>Password</label>
					<input type="text" name="password" class="form-control" placeholder="Bisa dikosongkan, otomatis generate system">
				</div>
				<div class="form-group">
					<label>Phone</label>
					<input type="tlp" name="phone" class="form-control" placeholder="Optional, Untuk mengirim link login">
				</div>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-primary">Simpan</button>
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
			</div>
		</div>
	</div>
</form>