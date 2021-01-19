<?= $this->extend('layouts/siswa') ?>

<?= $this->section('css') ?>
<style type="text/css">
	html {
		cursor: url('<?= base_url('coblos.png') ?>'), auto;
	}

	.img-paku {
		position: absolute;
		opacity: 0;
		width: 50%;
		height: 50%;
		right: 0;
		top: 0;
		display: none;
	}
	.btn-paku .img-paku {
		display: block;
		opacity: 1;

		transform: translateY(25%) translateX(-25%);
		transition: transform .5s;
	}
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
	<div class="card">
		<div class="card-header">
			<div class="row">
				<div class="col">
					<h6 class="font-bold text-primary">Daftar Team</h6>
				</div>
				<div class="ml-auto">
					<a href="#" type="submit" id="submit-selesai" class="btn btn-primary btn disabled">Selesai Nyoblos</a>
				</div>
			</div>
		</div>
		<div class="card-body">
			<div class="row">
				<?php foreach ($teams as $team): ?>
					<div class="col-lg-4 col-sm-6 col-12">
						<div class="card my-2">
							<a class="position-relative" style="min-height: 50px; cursor: inherit;" href="<?= site_url('siswa/event/select/' . $team['event_id'] . '/' . $team['id']) ?>" data-toggle="coblos">
								<img style="object-fit: fill;" src="<?= base_url($team['gambar']) ?>" class="card-img-top" height="300px">

								<img src="<?= base_url('coblos.png') ?>" class="img-paku">
							</a>
							<div class="card-body">
								<h4 class="text-white font-weight-bold"><?= $team['name'] ?></h4>
								<p class="card-text"><?= $team['deskripsi'] ?></p>
							</div>
						</div>
					</div>
				<?php endforeach ?>
			</div>
		</div>
	</div>
<?= $this->endSection() ?>

<?= $this->section('js') ?>
<script type="text/javascript">
	var active;

	$("[data-toggle=coblos]").on('click', function(e) {
		e.preventDefault();

		if (active != null)
			active.removeClass('btn-paku');

		$(this).addClass('btn-paku');
		
		$("#submit-selesai").removeClass('disabled').attr('href', $(this).attr('href'));
		active = $(this);
	});
</script>
<?= $this->endSection() ?>