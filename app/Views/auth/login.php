<?= $this->extend('layouts/app') ?>

<?= $this->section('title') ?>
Login
<?= $this->endSection() ?>

<?= $this->section('css') ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />
<style type="text/css">
	body {
		height: 100vh;
	}
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row p-0 m-0 w- h-100 justify-content-center align-items-center" style="height: 70%">
	<div class="col-lg-3 d-lg-block d-none bg-primary h-50">
		<div class="row p-0 m-0 h-100 justify-content-center align-items-center">
			<div>
				<h2 class="font-weight-bold text-white">E-Vote</h2>
				<h5 class="text-white font-weight-bold">&nbsp;&nbsp;Simple Vote For OSIS</h5>
			</div>
		</div>
	</div>
	<div class="col-lg-4 col-md-7 col-11 pl-lg-0 h-50">
		<form method="post" action="<?= site_url('home/postLogin' . ($is_admin ? '?admin' : '')) ?>" class="card h-100">
			<?= csrf_field() ?>
			<div class="card-header bg-primary text-white">
				<h3 class="card-title">Login</h3>
			</div>
			<div class="card-body">
				<div class="row justify-content-center align-items-center h-lg-100 ">
					<div class="col-12">
						<div class="form-group">
							<label>Username</label>
							<input type="text" name="username" class="form-control" required>
							<?php if (session()->has('status')): ?>
								<span class="text-danger"><?= session('status') ?></span>
							<?php endif ?>
						</div>
					</div>
					<div class="col-12">
						<div class="form-group">
							<label>Password</label>
							<input type="password" name="password" class="form-control" required>
						</div>
					</div>
					<div class="col-12">
						<div class="form-group">
							<div class="clearfix">
								<button class="btn btn-primary float-right">Masuk</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</form>
</div>
</div>
<?= $this->endSection() ?>
