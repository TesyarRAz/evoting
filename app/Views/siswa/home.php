<?= $this->extend('layouts/siswa') ?>

<?= $this->section('content') ?>
	<div class="card">
		<div class="card-header">
			<h6 class="font-bold text-primary">Daftar Event</h6>
		</div>
		<div class="card-body">
			<div class="row">
				<?php foreach ($events as $event): ?>
					<div class="col-4">
						<div class="card">
							<div class="card-header bg-primary">
								<h4 class="text-white font-weight-bold"><?= $event['name'] ?></h4>
							</div>
							<div class="card-body">
								<p class="card-text"><?= $event['keterangan'] ?></p>
							</div>
							<div class="card-footer">
								<div class="clearfix">
									<a class="btn float-right btn-sm btn-success" href="<?= site_url('siswa/event/join/' . $event['id']) ?>">
										<i class="fa fa-door-open"></i>
										<span>Join</span>
									</a>
								</div>
							</div>
						</div>
					</div>
				<?php endforeach ?>
			</div>
		</div>
	</div>
<?= $this->endSection() ?>