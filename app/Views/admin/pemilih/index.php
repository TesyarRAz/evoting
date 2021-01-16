<?= $this->extend('layouts/admin') ?>

<?= $this->section('content_header') ?>
Kelola Pemilih
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<?= $this->include('admin/pemilih/create') ?>

<div class="card">
	<div class="card-header">
		<div class="row">
			<div class="col">
				<h6 class="text-primary font-weight-bold">Daftar Pemilih</h6>
			</div>
			<div class="ml-auto">
				<button class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#modal-create">
					<i class="fas fa-download"></i>
					Import
				</button>
				<button class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#modal-create">
					<i class="fas fa-plus"></i>
					Tambah
				</button>
			</div>
		</div>
	</div>
	<div class="card-body">
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>No</th>
					<th>Nama</th>
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody>
				<?php $i = 0; ?>
				<?php foreach ($pemilihs as $d): ?>
					<tr>
						<td><?= ++$i ?></td>
						<td><?= $d['name'] ?></td>
						<td>
							
						</td>
					</tr>
				<?php endforeach ?>
			</tbody>
		</table>

		<div class="clearfix">
			<div class="float-right">

			</div>
		</div>
	</div>
</div>

<?= $this->endSection() ?>