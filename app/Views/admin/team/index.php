<?= $this->extend('layouts/admin') ?>

<?= $this->section('content_header') ?>
<a class="btn btn-sm btn-primary" href="<?= site_url('admin/event/index') ?>">
	<i class="fas fa-arrow-left"></i>
</a>
<span>Kelola Team</span>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<?= $this->include('admin/team/create') ?>
<?= $this->include('admin/team/edit') ?>

<div class="card">
	<div class="card-header">
		<div class="row">
			<div class="col">
				<h6 class="text-primary font-weight-bold">Daftar Team</h6>
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
		<table class="table table-bordered table-responsive-sm">
			<thead>
				<tr>
					<th>No</th>
					<th>Nama</th>
					<th>Gambar</th>
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody>
				<?php $i = 0; ?>
				<?php foreach ($teams as $d): ?>
					<tr>
						<td><?= ++$i ?></td>
						<td><?= $d['name'] ?></td>
						<td>
							<a href="<?= base_url($d['gambar']) ?>" class="btn btn-sm btn-secondary" target="_blank">Lihat</a>
						</td>
						<td>
							<a class="btn btn-sm btn-primary" href="#" onclick="action_edit(<?= $d['id'] ?>)">
								<i class="fas fa-book"></i>
								Edit
							</a>
							<a class="btn btn-sm btn-danger" href="<?= site_url('admin/team/destroy/' . $d['id']) ?>" onclick="return confirm('Yakin ingin dihapus?')">
								<i class="fas fa-trash"></i>
								Hapus
							</a>
						</td>
					</tr>
				<?php endforeach ?>
			</tbody>
		</table>

		<?= $pager->links() ?>
	</div>
</div>

<?= $this->endSection() ?>