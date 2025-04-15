<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Daftar Pengaduan</h1>
    
    <?= $this->session->flashdata('message'); ?>
    
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Pengaduan</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Pelapor</th>
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
                            <td><?= $p->nama_pelapor; ?></td>
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
                                <a href="<?= base_url('admin/detail_pengaduan/'.$p->id); ?>" class="btn btn-info btn-sm">
                                    <i class="fas fa-eye"></i> Detail
                                </a>
                                <a href="<?= base_url('admin/hapus_pengaduan/'.$p->id); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus pengaduan ini?')">
                                    <i class="fas fa-trash"></i> Hapus
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        
                        <?php if(empty($pengaduan)): ?>
                        <tr>
                            <td colspan="7" class="text-center">Belum ada pengaduan</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>