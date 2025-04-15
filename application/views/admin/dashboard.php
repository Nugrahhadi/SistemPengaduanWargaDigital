<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Dashboard Admin</h1>
    
    <?= $this->session->flashdata('message'); ?>
    
    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Pengaduan</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_pengaduan; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                Pengaduan Baru</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $pengaduan_baru; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-exclamation-circle fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Pengaduan Diproses</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $pengaduan_diproses; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-spinner fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Pengaduan Selesai</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $pengaduan_selesai; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-check-circle fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Pengaduan Terbaru</h6>
                    <a href="<?= base_url('admin/daftar_pengaduan'); ?>" class="btn btn-sm btn-primary">
                        <i class="fas fa-list"></i> Lihat Semua
                    </a>
                </div>
                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-md-4 mb-4">
                            <div class="card border-danger h-100">
                                <div class="card-header bg-danger text-white">
                                    <h6 class="mb-0">Pengaduan Baru</h6>
                                </div>
                                <div class="card-body">
                                    <h1 class="text-center display-4"><?= $pengaduan_baru; ?></h1>
                                    <p class="text-center">
                                        <a href="<?= base_url('admin/daftar_pengaduan'); ?>" class="btn btn-sm btn-danger">
                                            <i class="fas fa-arrow-right"></i> Lihat Detail
                                        </a>
                                    </p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-4 mb-4">
                            <div class="card border-warning h-100">
                                <div class="card-header bg-warning text-dark">
                                    <h6 class="mb-0">Sedang Diproses</h6>
                                </div>
                                <div class="card-body">
                                    <h1 class="text-center display-4"><?= $pengaduan_diproses; ?></h1>
                                    <p class="text-center">
                                        <a href="<?= base_url('admin/daftar_pengaduan'); ?>" class="btn btn-sm btn-warning">
                                            <i class="fas fa-arrow-right"></i> Lihat Detail
                                        </a>
                                    </p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-4 mb-4">
                            <div class="card border-success h-100">
                                <div class="card-header bg-success text-white">
                                    <h6 class="mb-0">Selesai</h6>
                                </div>
                                <div class="card-body">
                                    <h1 class="text-center display-4"><?= $pengaduan_selesai; ?></h1>
                                    <p class="text-center">
                                        <a href="<?= base_url('admin/daftar_pengaduan'); ?>" class="btn btn-sm btn-success">
                                            <i class="fas fa-arrow-right"></i> Lihat Detail
                                        </a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>