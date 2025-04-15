<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Register Sistem Pengaduan Warga</h4>
            </div>
            <div class="card-body">
                <?= $this->session->flashdata('message'); ?>

                <?= form_open('auth/register', ['class' => 'needs-validation']); ?>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control <?= form_error('username') ? 'is-invalid' : ''; ?>" id="username" name="username" value="<?= set_value('username'); ?>" placeholder="Masukkan username">
                    <div class="invalid-feedback">
                        <?= form_error('username'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control <?= form_error('password') ? 'is-invalid' : ''; ?>" id="password" name="password" placeholder="Masukkan password">
                    <small class="form-text text-muted">Password minimal 6 karakter</small>
                    <div class="invalid-feedback">
                        <?= form_error('password'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="password2">Konfirmasi Password</label>
                    <input type="password" class="form-control <?= form_error('password2') ? 'is-invalid' : ''; ?>" id="password2" name="password2" placeholder="Konfirmasi password">
                    <div class="invalid-feedback">
                        <?= form_error('password2'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="nama_lengkap">Nama Lengkap</label>
                    <input type="text" class="form-control <?= form_error('nama_lengkap') ? 'is-invalid' : ''; ?>" id="nama_lengkap" name="nama_lengkap" value="<?= set_value('nama_lengkap'); ?>" placeholder="Masukkan nama lengkap">
                    <div class="invalid-feedback">
                        <?= form_error('nama_lengkap'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <textarea class="form-control <?= form_error('alamat') ? 'is-invalid' : ''; ?>" id="alamat" name="alamat" rows="3" placeholder="Masukkan alamat lengkap"><?= set_value('alamat'); ?></textarea>
                    <div class="invalid-feedback">
                        <?= form_error('alamat'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="no_telp">No. Telepon</label>
                    <input type="text" class="form-control <?= form_error('no_telp') ? 'is-invalid' : ''; ?>" id="no_telp" name="no_telp" value="<?= set_value('no_telp'); ?>" placeholder="Masukkan nomor telepon">
                    <div class="invalid-feedback">
                        <?= form_error('no_telp'); ?>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Register</button>
                <?= form_close(); ?>

                <div class="mt-3 text-center">
                    <p>Sudah memiliki akun? <a href="<?= base_url('auth'); ?>">Login disini</a></p>
                </div>
            </div>
        </div>
    </div>
</div>