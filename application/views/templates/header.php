<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?></title>
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    
    <style>
        .badge-baru {
            background-color: #dc3545;
            color: white;
        }
        .badge-diproses {
            background-color: #ffc107;
            color: black;
        }
        .badge-selesai {
            background-color: #28a745;
            color: white;
        }
        .sidebar {
            min-height: 100vh;
        }
    </style>
</head>
<body>

<?php if($this->session->userdata('logged_in')): ?>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="#">Sistem Pengaduan Warga</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown">
                            <i class="fas fa-user"></i> <?= $this->session->userdata('nama_lengkap'); ?>
                        </a>
                        <div class="dropdown-menu">
                            <?php if($this->session->userdata('role') == 'warga'): ?>
                                <a class="dropdown-item" href="<?= base_url('warga/profile'); ?>">
                                    <i class="fas fa-id-card"></i> Profil Saya
                                </a>
                            <?php endif; ?>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="<?= base_url('auth/logout'); ?>">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid mt-4">
        <div class="row">
            <?php if($this->session->userdata('role') == 'admin'): ?>

                <div class="col-md-3 col-lg-2 d-md-block bg-light sidebar">
                    <div class="list-group">
                        <a href="<?= base_url('admin/dashboard'); ?>" class="list-group-item list-group-item-action <?= $this->uri->segment(2) == 'dashboard' ? 'active' : ''; ?>">
                            <i class="fas fa-tachometer-alt"></i> Dashboard
                        </a>
                        <a href="<?= base_url('admin/daftar_pengaduan'); ?>" class="list-group-item list-group-item-action <?= $this->uri->segment(2) == 'daftar_pengaduan' || $this->uri->segment(2) == 'detail_pengaduan' ? 'active' : ''; ?>">
                            <i class="fas fa-clipboard-list"></i> Daftar Pengaduan
                        </a>
                        <a href="<?= base_url('admin/daftar_warga'); ?>" class="list-group-item list-group-item-action <?= $this->uri->segment(2) == 'daftar_warga' ? 'active' : ''; ?>">
                            <i class="fas fa-users"></i> Daftar Warga
                        </a>
                    </div>
                </div>

                <main class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
            <?php else: ?>

                <div class="col-md-3 col-lg-2 d-md-block bg-light sidebar">
                    <div class="list-group">
                        <a href="<?= base_url('warga/dashboard'); ?>" class="list-group-item list-group-item-action <?= $this->uri->segment(2) == 'dashboard' ? 'active' : ''; ?>">
                            <i class="fas fa-tachometer-alt"></i> Dashboard
                        </a>
                        <a href="<?= base_url('warga/tambah_pengaduan'); ?>" class="list-group-item list-group-item-action <?= $this->uri->segment(2) == 'tambah_pengaduan' ? 'active' : ''; ?>">
                            <i class="fas fa-plus-circle"></i> Tambah Pengaduan
                        </a>
                        <a href="<?= base_url('warga/profile'); ?>" class="list-group-item list-group-item-action <?= $this->uri->segment(2) == 'profile' ? 'active' : ''; ?>">
                            <i class="fas fa-user"></i> Profil Saya
                        </a>
                    </div>
                </div>

                <main class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
            <?php endif; ?>
<?php else: ?>
    <div class="container mt-5">
<?php endif; ?>