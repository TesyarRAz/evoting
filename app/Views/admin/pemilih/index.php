<?= $this->extend('layouts/admin') ?>

<?= $this->section('content_header') ?>
Kelola Pemilih
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<?= $this->include('admin/pemilih/create') ?>
<?= $this->include('admin/pemilih/edit') ?>
<?= $this->include('admin/pemilih/import') ?>
<?= $this->include('admin/pemilih/verifikasi') ?>

<div class="card">
	<div class="card-header">
		<div class="row">
			<div class="col">
				<h6 class="text-primary font-weight-bold">Daftar Pemilih</h6>
			</div>
			<div class="ml-auto">

				<button type="button" class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#modal-verifikasi">
					<i class="fas fa-envelope"></i>
					Verifikasi
				</button>
				<button type="button" class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#modal-import">
					<i class="fas fa-download"></i>
					Import
				</button>
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
					<th>Kelas</th>
					<th>Email</th>
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody>
				<?php $i = 0; ?>
				<?php foreach ($pemilihs as $d): ?>
					<tr>
						<td><?= ++$i ?></td>
						<td><?= $d['name'] ?></td>
						<td><?= $d['kelas'] ?></td>
						<td><?= $d['email'] ?></td>
						<td>
							<a class="btn btn-sm btn-primary" href="#" onclick="action_edit(<?= $d['id'] ?>)">
								<i class="fas fa-book"></i>
								Edit
							</a>
							<a class="btn btn-sm btn-danger" href="<?= site_url('admin/pemilih/destroy/' . $d['id']) ?>" onclick="return confirm('Yakin ingin dihapus?')">
								<i class="fas fa-trash"></i>
								Hapus
							</a>
							<a class="btn btn-sm btn-success" href="<?= site_url('admin/pemilih/email/' . $d['id']) ?>">
								<i class="fas fa-envelope"></i>
								Verifikasi
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