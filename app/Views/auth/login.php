<?= $this->extend('layouts/app') ?>

<?= $this->section('title') ?>
	Login
<?= $this->endSection() ?>

<?= $this->section('css') ?>
<style type="text/css">
	body {
		height: 100vh;
	}
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row p-0 m-0 h-100 justify-content-center align-items-center">
	<div class="col-5">
		<form method="post" action="<?= site_url('home/postLogin') ?>" class="card">
			<?= csrf_field() ?>
			<div class="card-header bg-primary text-white">
				<h5 class="card-title">Login</h5>
			</div>
			<div class="card-body">
				<div class="form-group">
					<label>Username</label>
					<input type="text" name="username" class="form-control" required>
					<?php if (session()->has('status')): ?>
						<span class="text-danger"><?= session('status') ?></span>
					<?php endif ?>
				</div>
				<div class="form-group">
					<label>Password</label>
					<input type="password" name="password" class="form-control" required>
				</div>
			</div>
			<div class="card-footer bg-white">
				<div class="clearfix">
					<button class="btn btn-primary float-right">Masuk</button>
				</div>
			</div>
		</form>
	</div>
</div>
<?= $this->endSection() ?>