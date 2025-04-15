<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Tambah Pengaduan</h1>
    
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Form Pengaduan</h6>
                </div>
                <div class="card-body">
                    <?= form_open('warga/tambah_pengaduan'); ?>
                        <div class="form-group">
                            <label for="judul">Judul Pengaduan</label>
                            <input type="text" class="form-control <?= form_error('judul') ? 'is-invalid' : ''; ?>" id="judul" name="judul" value="<?= set_value('judul'); ?>" placeholder="Masukkan judul pengaduan">
                            <div class="invalid-feedback">
                                <?= form_error('judul'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="kategori_id">Kategori</label>
                            <select class="form-control <?= form_error('kategori_id') ? 'is-invalid' : ''; ?>" id="kategori_id" name="kategori_id">
                                <option value="">-- Pilih Kategori --</option>
                                <?php foreach ($kategori as $k): ?>
                                <option value="<?= $k->id; ?>" <?= set_value('kategori_id') == $k->id ? 'selected' : ''; ?>><?= $k->nama_kategori; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="invalid-feedback">
                                <?= form_error('kategori_id'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="isi_laporan">Isi Laporan</label>
                            <textarea class="form-control <?= form_error('isi_laporan') ? 'is-invalid' : ''; ?>" id="isi_laporan" name="isi_laporan" rows="5" placeholder="Jelaskan detail pengaduan Anda"><?= set_value('isi_laporan'); ?></textarea>
                            <div class="invalid-feedback">
                                <?= form_error('isi_laporan'); ?>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Kirim Pengaduan</button>
                        <a href="<?= base_url('warga/dashboard'); ?>" class="btn btn-secondary">Batal</a>
                    <?= form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>