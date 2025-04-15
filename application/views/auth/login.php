<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Login Sistem Pengaduan Warga</h4>
            </div>
            <div class="card-body">
                <?= $this->session->flashdata('message'); ?>

                <?= form_open('auth', ['class' => 'needs-validation']); ?>
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
                    <div class="invalid-feedback">
                        <?= form_error('password'); ?>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Login</button>
                <?= form_close(); ?>

                <div class="mt-3 text-center">
                    <p>Belum memiliki akun? <a href="<?= base_url('auth/register'); ?>">Daftar disini</a></p>
                </div>
            </div>
        </div>
    </div>
</div>