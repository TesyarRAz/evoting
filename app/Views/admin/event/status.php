<?= $this->extend('layouts/admin') ?>

<?= $this->section('content_header') ?>
Status Event : <?= $event['name'] ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="card">
	<div class="card-body">
		<div class="row justify-content-center">
			<div class="col-lg-6 my-3">
				<canvas data-toggle="chart-pemilih"></canvas>
			</div>
			<div class="col-lg-6 my-3">
				<canvas data-toggle="chart-team"></canvas>
			</div>
			<div class="col-lg-6 my-3">
				<!-- <object data="<?= site_url('admin/event/pdf/' . $event['id']) ?>" type="application/pdf" width="100%" height="100%"> -->
				  <p class="text-center">Download File Laporan <a target="_blank" href="<?= site_url('admin/event/pdf/' . $event['id']) ?>">Disini</a></p>
				<!-- </object> -->
			</div>
		</div>
	</div>
</div>
<div class="card">
	<div class="card-body">
		<h5 class="leading">Total Pemilih: <?= $total_pemilih ?></h5>
		<table class="table table-bordered table-responsive-sm">
			<thead>
				<tr>
					<th>Kelas</th>
					<th>Total</th>
					<th>Laporan</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($kelasses as $kelas): ?>
					<tr>
						<td>
							<?= $kelas['name'] ?>
						</td>
						<td>
							<?= $kelas['total_pemilih'] ?>
						</td>
						<td>
							<a href="<?= site_url('admin/event/absen/' . $event['id'] . '/' . $kelas['id']) ?>" target="_blank" class="btn btn-sm btn-primary">
								<i class="fas fa-upload"></i>
								Cetak
							</a>
						</td>
					</tr>
				<?php endforeach ?>
			</tbody>
		</table>
	</div>
</div>
<?= $this->endSection() ?>
<?= $this->section('js') ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.bundle.min.js"></script>

<script type="text/javascript">
	$(document).ready(function() {
		window.chartColors = {
			red: 'rgb(255, 99, 132)',
			orange: 'rgb(255, 159, 64)',
			yellow: 'rgb(255, 205, 86)',
			green: 'rgb(75, 192, 192)',
			blue: 'rgb(54, 162, 235)',
			purple: 'rgb(153, 102, 255)',
			grey: 'rgb(201, 203, 207)'
		};
		var randomColor = () => "#" + Math.floor(Math.random()*16777215).toString(16);
		var teams = <?= json_encode($teams) ?>;

		var pemilihChart, teamChart;

		$("[data-toggle=chart-pemilih]").each((_, item) => {
			const ctx = item.getContext('2d');

			const data = <?= json_encode($event) ?>;

			pemilihChart = new Chart(ctx, {
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

		$("[data-toggle=chart-team]").each((_, c) => {
			const ctx = c.getContext('2d');

			teamChart = new Chart(ctx, {
				type: 'bar',
				data: {
					datasets: [{
						data: teams.map(item => item.total_pemilih),
						backgroundColor: teams.map(_ => randomColor()),
						label: 'Status'
					}],
					labels: teams.map(item => item.name)
				},
				options: {
					responsive: true
				}
			});
		});

		// var eventSource = new EventSource('<?= site_url('admin/event/stream/' . $event['id']) ?>', { withCredentials: true });

		// eventSource.onmessage = function(event) {
		// 	console.log(event);
		// };
	});
</script>
<?= $this->endSection() ?>
