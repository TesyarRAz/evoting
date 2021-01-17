<?= $this->extend('layouts/admin') ?>

<?= $this->section('content_header') ?>
Kelola Event
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<?= $this->include('admin/event/create') ?>
<?= $this->include('admin/event/edit') ?>

<div class="card">
	<div class="card-header">
		<div class="row">
			<div class="col">
				<h6 class="text-primary font-weight-bold">Daftar Event</h6>
			</div>
			<div class="ml-auto">
				<button type="button" class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#modal-create">
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
					<th>Aktif</th>
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody>
				<?php $i = 0; ?>
				<?php foreach ($events as $d): ?>
					<tr>
						<td><?= ++$i ?></td>
						<td><?= $d['name'] ?></td>
						<td><?= $d['aktif'] ? "Aktif" : "Tidak" ?></td>
						<td>
							<a class="btn btn-sm btn-primary" href="#" onclick="action_edit(<?= $d['id'] ?>)">
								<i class="fas fa-book"></i>
								Edit
							</a>
							<a class="btn btn-sm btn-danger" href="<?= site_url('admin/event/destroy/' . $d['id']) ?>" onclick="return confirm('Yakin ingin dihapus?')">
								<i class="fas fa-trash"></i>
								Hapus
							</a>
						</td>
					</tr>
				<?php endforeach ?>
			</tbody>
		</table>

		<div class="clearfix">
			<div class="float-right">
				<?= $pager->links() ?>
			</div>
		</div>
	</div>
</div>

<?= $this->endSection() ?>