<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Detail Pengaduan</h1>
    
    <?= $this->session->flashdata('message'); ?>
    
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Informasi Pengaduan</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <table class="table">
                                <tr>
                                    <th width="150">Tanggal</th>
                                    <td><?= date('d-m-Y H:i', strtotime($pengaduan->tanggal_pengaduan)); ?></td>
                                </tr>
                                <tr>
                                    <th>Pelapor</th>
                                    <td><?= $pengaduan->nama_pelapor; ?></td>
                                </tr>
                                <tr>
                                    <th>Kategori</th>
                                    <td><?= $pengaduan->nama_kategori; ?></td>
                                </tr>
                                <tr>
                                    <th>Judul</th>
                                    <td><?= $pengaduan->judul; ?></td>
                                </tr>
                                <tr>
                                    <th>Isi Laporan</th>
                                    <td><?= nl2br($pengaduan->isi_laporan); ?></td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td>
                                        <?php if($pengaduan->status == 'baru'): ?>
                                            <span class="badge badge-baru">Baru</span>
                                        <?php elseif($pengaduan->status == 'diproses'): ?>
                                            <span class="badge badge-diproses">Diproses</span>
                                        <?php else: ?>
                                            <span class="badge badge-selesai">Selesai</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-header bg-primary text-white">
                                    <h6 class="mb-0">Update Status</h6>
                                </div>
                                <div class="card-body">
                                    <?= form_open('admin/update_status/'.$pengaduan->id); ?>
                                        <div class="form-group">
                                            <label for="status">Status</label>
                                            <select class="form-control" id="status" name="status">
                                                <option value="baru" <?= $pengaduan->status == 'baru' ? 'selected' : ''; ?>>Baru</option>
                                                <option value="diproses" <?= $pengaduan->status == 'diproses' ? 'selected' : ''; ?>>Diproses</option>
                                                <option value="selesai" <?= $pengaduan->status == 'selesai' ? 'selected' : ''; ?>>Selesai</option>
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-block">
                                            <i class="fas fa-save"></i> Update Status
                                        </button>
                                    <?= form_close(); ?>
                                    
                                    <hr>
                                    
                                    <div class="card mt-3">
                                        <div class="card-header bg-info text-white">
                                            <h6 class="mb-0">Riwayat Status</h6>
                                        </div>
                                        <div class="card-body">
                                            <?php if(empty($log_status)): ?>
                                                <p class="text-center">Belum ada perubahan status</p>
                                            <?php else: ?>
                                                <ul class="timeline">
                                                    <?php foreach($log_status as $log): ?>
                                                        <li class="mb-3">
                                                            <span class="font-weight-bold"><?= date('d-m-Y H:i', strtotime($log->tanggal_perubahan)); ?></span><br>
                                                            Status diubah dari 
                                                            <span class="badge badge-<?= $log->status_lama; ?>"><?= ucfirst($log->status_lama); ?></span> 
                                                            menjadi 
                                                            <span class="badge badge-<?= $log->status_baru; ?>"><?= ucfirst($log->status_baru); ?></span>
                                                            <br>
                                                            <small class="text-muted">Oleh: <?= $log->nama_lengkap; ?></small>
                                                        </li>
                                                    <?php endforeach; ?>
                                                </ul>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Tanggapan</h6>
                </div>
                <div class="card-body">
                    <?php if(empty($tanggapan)): ?>
                        <p class="text-center">Belum ada tanggapan</p>
                    <?php else: ?>
                        <?php foreach($tanggapan as $t): ?>
                            <div class="card mb-3 <?= $t->role == 'admin' ? 'border-primary' : 'border-info'; ?>">
                                <div class="card-header <?= $t->role == 'admin' ? 'bg-primary text-white' : 'bg-info text-white'; ?>">
                                    <strong><?= $t->nama_lengkap; ?></strong> 
                                    <span class="badge badge-light"><?= $t->role == 'admin' ? 'Admin' : 'Warga'; ?></span>
                                    <small class="float-right"><?= date('d-m-Y H:i', strtotime($t->tanggal_tanggapan)); ?></small>
                                </div>
                                <div class="card-body">
                                    <?= nl2br($t->tanggapan); ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    
                    <hr>
                    
                    <div class="card mt-4">
                        <div class="card-header bg-success text-white">
                            <h6 class="mb-0">Tambah Tanggapan</h6>
                        </div>
                        <div class="card-body">
                            <?= form_open('admin/detail_pengaduan/'.$pengaduan->id); ?>
                                <div class="form-group">
                                    <label for="tanggapan">Tanggapan</label>
                                    <textarea class="form-control <?= form_error('tanggapan') ? 'is-invalid' : ''; ?>" id="tanggapan" name="tanggapan" rows="3" placeholder="Tulis tanggapan Anda disini"><?= set_value('tanggapan'); ?></textarea>
                                    <div class="invalid-feedback">
                                        <?= form_error('tanggapan'); ?>
                                    </div>
                                </div>
                                <div class="form-group form-check">
                                    <input type="checkbox" class="form-check-input" id="update_status" name="update_status" value="1">
                                    <label class="form-check-label" for="update_status">Update status pengaduan saat mengirim tanggapan</label>
                                </div>
                                <div id="status_container" class="form-group" style="display: none;">
                                    <label for="status">Status Baru</label>
                                    <select class="form-control" id="status" name="status">
                                        <option value="baru" <?= $pengaduan->status == 'baru' ? 'selected' : ''; ?>>Baru</option>
                                        <option value="diproses" <?= $pengaduan->status == 'diproses' ? 'selected' : ''; ?>>Diproses</option>
                                        <option value="selesai" <?= $pengaduan->status == 'selesai' ? 'selected' : ''; ?>>Selesai</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-success">Kirim Tanggapan</button>
                            <?= form_close(); ?>
                            
                            <script>
                                $(document).ready(function() {
                                    $('#update_status').change(function() {
                                        if(this.checked) {
                                            $('#status_container').show();
                                        } else {
                                            $('#status_container').hide();
                                        }
                                    });
                                });
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-12">
            <a href="<?= base_url('admin/daftar_pengaduan'); ?>" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
            <a href="<?= base_url('admin/hapus_pengaduan/'.$pengaduan->id); ?>" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus pengaduan ini?')">
                <i class="fas fa-trash"></i> Hapus Pengaduan
            </a>
        </div>
    </div>
</div>