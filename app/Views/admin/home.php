<?= $this->extend('layouts/admin') ?>

<?= $this->section('content_header') ?>
Dashboard
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<?php
	$i = 0;
	foreach ($events as $event): ?>
		<div class="card">
			<div class="card-header">
				<h6 class="card-title text-primary font-weight-bold"><?= $event['name'] ?></h6>
			</div>
			<div class="card-body">
				<div class="row justify-content-center">
					<div class="col-lg-6">
						<canvas data-toggle="chart-pemilih" data-id="<?= $i++ ?>"></canvas>
					</div>
				</div>
			</div>
		</div>
	<?php endforeach ?>
	<?php if (empty($events)): ?>
		<div class="card">
			<div class="card-body">
				<div class="p-5">
					<h4 align="center">Tidak Ada Event yang Sedang Berlangsung</h4>
					<p align="center">Buat Event <a href="<?= site_url('admin/event/index') ?>">Disini</a></p>
				</div>
			</div>
		</div>
	<?php endif ?>
<?= $this->endSection() ?>

<?= $this->section('js') ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.bundle.min.js"></script>

<script type="text/javascript">
	$(document).ready(function() {
		const jj = <?= json_encode($events) ?>;
		window.chartColors = {
			red: 'rgb(255, 99, 132)',
			orange: 'rgb(255, 159, 64)',
			yellow: 'rgb(255, 205, 86)',
			green: 'rgb(75, 192, 192)',
			blue: 'rgb(54, 162, 235)',
			purple: 'rgb(153, 102, 255)',
			grey: 'rgb(201, 203, 207)'
		};
		$("[data-toggle=chart-pemilih]").each((_, item) => {
			const ctx = item.getContext('2d');

			const data = jj[$(item).attr('data-id')];

			var chart = new Chart(ctx, {
				type: 'pie',
				data: {
					datasets: [{
						data: [
							data.total_pemilih,
							data.pemilih
						],
						backgroundColor: [
							window.chartColors.red,
							window.chartColors.blue
						],
						label: 'Status'
					}],
					labels: [
						'Sudah memilih',
						'Belum memilih'
					]
				},
				options: {
					responsive: true
				}
			});
		})
	});
</script>
<?= $this->endSection() ?>
