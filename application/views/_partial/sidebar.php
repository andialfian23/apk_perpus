<?php
$is_login = $this->session->userdata('is_login');
$level = $this->session->userdata('level');
?>

<ul class="navbar-nav bg-gray-900 sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-book"></i>
        </div>
        <div class="sidebar-brand-text mx-3">APK PERPUS</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <?php if ($is_login) : ?>
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url(); ?>">
                <i class="fas fa-fw fa-home"></i>
                <span>Home</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">
        <li class="nav-item <?= ($halaman == 'anggota') ? 'active' : ''; ?>">
            <a class="nav-link" href="<?= base_url('anggota'); ?>">
                <i class="fas fa-fw fa-users"></i>
                <span>Anggota</span></a>
        </li>
        <li class="nav-item <?= ($halaman == 'buku') ? 'active' : ''; ?>">
            <a class="nav-link" href="<?= base_url('judul'); ?>">
                <i class="fas fa-fw fa-book"></i>
                <span>Buku</span></a>
        </li>
        <?php if ($level === 'admin') : ?>
            <li class="nav-item <?= ($halaman == 'user') ? 'active' : ''; ?>">
                <a class="nav-link" href="<?= base_url('user'); ?>">
                    <i class="fas fa-fw fa-users-cog"></i>
                    <span>User</span></a>
            </li>
        <?php endif; ?>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <li class="nav-item <?= (($halaman == 'peminjaman') || ($halaman == 'pengembalian')) ? 'active' : ''; ?>">
            <a class="nav-link <?= (($halaman == 'peminjaman') || ($halaman == 'pengembalian')) ? '' : 'collapsed'; ?>" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="<?= (($halaman == 'peminjaman') || ($halaman == 'pengembalian')) ? 'false' : 'true'; ?>" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-file-archive"></i>
                <span>Transaksi</span>
            </a>
            <div id="collapseTwo" class="collapse <?= (($halaman == 'peminjaman') || ($halaman == 'pengembalian')) ? 'show' : ''; ?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item <?= ($halaman == 'peminjaman') ? 'active' : ''; ?>" href="<?= base_url('peminjaman'); ?>">Peminjaman</a>
                    <a class="collapse-item <?= ($halaman == 'pengembalian') ? 'active' : ''; ?>" href="<?= base_url('pengembalian'); ?>">Pengembalian</a>
                </div>
            </div>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <li class="nav-item <?= (($halaman == 'laporan-buku') || ($halaman == 'laporan-peminjaman') || ($halaman == 'laporan-pengembalian') || ($halaman == 'laporan-denda')) ? 'active' : ''; ?>">
            <a class="nav-link <?= (($halaman == 'laporan-buku') || ($halaman == 'laporan-peminjaman') || ($halaman == 'laporan-pengembalian') || ($halaman == 'laporan-denda')) ? '' : 'collapsed'; ?>" href="#" data-toggle="collapse" data-target="#collapseThree" aria-expanded="<?= (($halaman == 'laporan-buku') || ($halaman == 'laporan-peminjaman') || ($halaman == 'laporan-pengembalian') || ($halaman == 'laporan-denda')) ? 'false' : 'true'; ?>" aria-controls="collapseThree">
                <i class="fas fa-fw fa-file-alt"></i>
                <span>Laporan</span>
            </a>
            <div id="collapseThree" class="collapse <?= (($halaman == 'laporan-buku') || ($halaman == 'laporan-peminjaman') || ($halaman == 'laporan-pengembalian') || ($halaman == 'laporan-denda')) ? 'show' : ''; ?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item <?= ($halaman == 'laporan-buku') ? 'active' : ''; ?>" href="<?= base_url('laporan-buku'); ?>">Buku</a>
                    <a class="collapse-item <?= ($halaman == 'laporan-peminjaman') ? 'active' : ''; ?>" href="<?= base_url('laporan-peminjaman'); ?>">Peminjaman</a>
                    <a class="collapse-item <?= ($halaman == 'laporan-pengembalian') ? 'active' : ''; ?>" href="<?= base_url('laporan-pengembalian'); ?>">Pengembalian</a>
                    <a class="collapse-item <?= ($halaman == 'laporan-denda') ? 'active' : ''; ?>" href="<?= base_url('laporan-denda'); ?>">Denda</a>
                </div>
            </div>
        </li>

    <?php else : ?>
        <!-- Divider -->
        <hr class="sidebar-divider">
        <li class="nav-item <?= ($halaman == 'home') ? 'active' : ''; ?>">
            <a class="nav-link" href="<?= base_url(); ?>">
                <i class="fas fa-fw fa-home"></i>
                <span>Home</span></a>
        </li>
        <li class="nav-item <?= ($halaman == 'buku') ? 'active' : ''; ?>">
            <a class="nav-link" href="<?= base_url('judul'); ?>">
                <i class="fas fa-fw fa-book"></i>
                <span>Buku</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('login'); ?>">
                <i class="fas fa-fw fa-sign-in-alt"></i>
                <span>Login</span></a>
        </li>
    <?php endif; ?>


    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>