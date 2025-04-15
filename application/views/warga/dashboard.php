<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Dashboard Warga</h1>
    
    <?= $this->session->flashdata('message'); ?>
    
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Selamat Datang, <?= $user->nama_lengkap; ?>!</h5>
                </div>
                <div class="card-body">
                    <p>Anda dapat menggunakan sistem ini untuk melaporkan masalah atau pengaduan kepada pihak RT. Silakan gunakan menu <strong>Tambah Pengaduan</strong> untuk membuat laporan baru.</p>
                    <a href="<?= base_url('warga/tambah_pengaduan'); ?>" class="btn btn-primary">
                        <i class="fas fa-plus-circle"></i> Buat Pengaduan Baru
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Riwayat Pengaduan Saya</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Kategori</th>
                                    <th>Judul</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; foreach ($pengaduan as $p): ?>
                                <tr>
                                    <td><?= $no++; ?></td>
                                    <td><?= date('d-m-Y', strtotime($p->tanggal_pengaduan)); ?></td>
                                    <td><?= $p->nama_kategori; ?></td>
                                    <td><?= $p->judul; ?></td>
                                    <td>
                                        <?php if($p->status == 'baru'): ?>
                                            <span class="badge badge-baru">Baru</span>
                                        <?php elseif($p->status == 'diproses'): ?>
                                            <span class="badge badge-diproses">Diproses</span>
                                        <?php else: ?>
                                            <span class="badge badge-selesai">Selesai</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <a href="<?= base_url('warga/detail_pengaduan/'.$p->id); ?>" class="btn btn-info btn-sm">
                                            <i class="fas fa-eye"></i> Detail
                                        </a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                                
                                <?php if(empty($pengaduan)): ?>
                                <tr>
                                    <td colspan="6" class="text-center">Belum ada pengaduan</td>
                                </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>