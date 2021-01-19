<?= $this->extend('layouts/' . (session('role') == 'admin' ? 'admin' : 'siswa')) ?>

<?= $this->section('content_header') ?>
Pengaturan
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<form method="post" action="<?= site_url('home/postSetting/changePassword') ?>" class="card bg-white">

	<div class="card-header bg-white">
		<h6 class="text-primary card-title">Ganti Password</h6>
	</div>
	<div class="card-body">
		<div class="form-group">
			<div class="form-row">
				<div class="col-md-4">
					<label>Old Password</label>
				</div>
				<div class="col">
					<input type="password" name="old_password" class="form-control" required>
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="form-row">
				<div class="col-md-4">
					<label>New Password</label>
				</div>
				<div class="col">
					<input type="password" name="new_password" class="form-control" required>
				</div>
			</div>
		</div>
		<div class="form-group">
			<div class="form-row">
				<div class="col-md-4">
					<label>New Password Confirmation</label>
				</div>
				<div class="col">
					<input type="password" name="new_password_confirmation" class="form-control" required>
				</div>
			</div>
		</div>
		<div class="form-group clearfix">
			<button type="submit" class="btn btn-primary float-right">Simpan</button>
		</div>
	</div>
</form>>
<?= $this->endSection() ?>