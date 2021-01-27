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
		<table class="table table-bordered table-responsive-sm">
			<thead>
				<tr>
					<th>No</th>
					<th>Nama</th>
					<th>Status</th>
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody>
				<?php $i = 0; ?>
				<?php foreach ($events as $d): ?>
					<tr>
						<td><?= ++$i ?></td>
						<td><?= $d['name'] ?></td>
						<td><?= $d['aktif'] ? 'Aktif' : 'Tidak' ?></td>
						<td>
							<a class="btn btn-sm btn-success" href="<?= site_url('admin/team/index/' . $d['id']) ?>">
								<i class="fas fa-book"></i>
								Team
							</a>
							<a data-html="true" data-toggle="tooltip" title="<i class='fas fa-info mr-2'></i>Bisa dilihat jika event sudah selesai" class="btn btn-sm btn-secondary" href="<?= $d['aktif'] ? '#' : site_url('admin/event/chart/' . $d['id']) ?>">
								<i class="fas fa-chart-area"></i>
								Status
							</a>
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

		<?= $pager->links() ?>
	</div>
</div>

<?= $this->endSection() ?>

<?= $this->section('js') ?>
<script type="text/javascript">
	$('[data-toggle="tooltip"]').tooltip({'placement': 'bottom'});
</script>
<?= $this->endSection() ?>