<?= $this->extend('layouts/app') ?>

<?= $this->section('title') ?>
Dashboard
<?= $this->endSection() ?>

<?= $this->section('css') ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/startbootstrap-sb-admin-2/4.1.3/css/sb-admin-2.min.css" integrity="sha512-RIG2KoKRs0GLkvl0goS0cdkTgQ3mOiF/jupXuBsMvyB3ITFpTJLnBu59eE+0R39bxDQKo2dsatA5CwHeIKVFcw==" crossorigin="anonymous" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<?php $request = service('request'); ?>
<!-- Page Wrapper -->
<div id="wrapper">

	<!-- Sidebar -->
	<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion toggled" id="accordionSidebar">

		<!-- Sidebar - Brand -->
		<a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
			<div class="sidebar-brand-icon rotate-n-15">
				<i class="fas fa-vote-yea"></i>
			</div>
			<div class="sidebar-brand-text mx-3">evoting <sup>2</sup></div>
		</a>

		<!-- Divider -->
		<hr class="sidebar-divider my-0">

		<!-- Nav Item - Dashboard -->
		<li class="nav-item <?= $request->uri->getPath() == 'siswa' ? 'active' : '' ?>">
			<a class="nav-link" href="<?= site_url('/') ?>">
				<i class="fas fa-fw fa-tachometer-alt"></i>
				<span>Event</span>
			</a>
		</li>

		<!-- Divider -->
		<hr class="sidebar-divider">

		<div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>
	</ul>
	<!-- End of Sidebar -->

	<!-- Content Wrapper -->
	<div id="content-wrapper" class="d-flex flex-column">

		<!-- Main Content -->
		<div id="content">

			<!-- Topbar -->
			<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

				<!-- Sidebar Toggle (Topbar) -->
				<button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
					<i class="fa fa-bars"></i>
				</button>

				<!-- Topbar Navbar -->
				<ul class="navbar-nav ml-auto">

					<!-- Nav Item - User Information -->
					<li class="nav-item dropdown no-arrow">
						<a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<span class="mr-2 d-lg-inline text-gray-600 small">
								<?= session('name') ?>
							</span>
						</a>
						<!-- Dropdown - User Information -->
						<div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
							<a class="dropdown-item" href="<?= site_url('home/setting') ?>">
								<i class="fas fa-lock fa-sm fa-fw mr-2 text-gray-400"></i>
								Setting
							</a>
							<a class="dropdown-item" href="<?= site_url('home/logout') ?>">
								<i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
								Logout
							</a>
						</div>
					</li>

				</ul>

			</nav>
			<!-- End of Topbar -->

			<!-- Begin Page Content -->
			<div class="container-fluid">

				<!-- Page Heading -->
				<div class="d-sm-flex align-items-center justify-content-between mb-4">
					<h1 class="h3 mb-0 text-gray-800">
						<?= $this->renderSection('content_header') ?>
					</h1>
				</div>

				<?= $this->renderSection('content') ?>
			</div>
			<!-- Footer -->
			<!-- <footer class="sticky-footer bg-white">
				<div class="container my-auto">
					<div class="copyright text-center my-auto">
						<span>Copyright &copy; TesyarRAz 2021</span>
					</div>
				</div>
			</footer> -->
			<!-- End of Footer -->

		</div>
		<!-- End of Content Wrapper -->

	</div>
</div>

<?= $this->endSection() ?>

<?= $this->section('js') ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/startbootstrap-sb-admin-2/4.1.3/js/sb-admin-2.min.js" integrity="sha512-COtY6/Rv4GyQdDShOyay/0YI4ePJ7QeKwtJIOCQ3RNE32WOPI4IYxq6Iz5JWcQpnylt/20KBvqEROZTEj/Hopw==" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script type="text/javascript">
	<?php if (session()->has('status')): ?>
		Swal.fire("Informasi", '<?= session('status') ?>', 'info');
	<?php endif ?>
</script>
<?= $this->endSection() ?>