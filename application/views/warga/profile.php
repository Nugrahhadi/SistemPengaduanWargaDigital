<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Profil Saya</h1>
    
    <?= $this->session->flashdata('message'); ?>
    
    <div class="row">
        <div class="col-md-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Edit Profil</h6>
                </div>
                <div class="card-body">
                    <?= form_open('warga/profile'); ?>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="username" value="<?= $user->username; ?>" readonly>
                            <small class="form-text text-muted">Username tidak dapat diubah</small>
                        </div>
                        <div class="form-group">
                            <label for="nama_lengkap">Nama Lengkap</label>
                            <input type="text" class="form-control <?= form_error('nama_lengkap') ? 'is-invalid' : ''; ?>" id="nama_lengkap" name="nama_lengkap" value="<?= set_value('nama_lengkap', $user->nama_lengkap); ?>">
                            <div class="invalid-feedback">
                                <?= form_error('nama_lengkap'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <textarea class="form-control <?= form_error('alamat') ? 'is-invalid' : ''; ?>" id="alamat" name="alamat" rows="3"><?= set_value('alamat', $user->alamat); ?></textarea>
                            <div class="invalid-feedback">
                                <?= form_error('alamat'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="no_telp">No. Telepon</label>
                            <input type="text" class="form-control <?= form_error('no_telp') ? 'is-invalid' : ''; ?>" id="no_telp" name="no_telp" value="<?= set_value('no_telp', $user->no_telp); ?>">
                            <div class="invalid-feedback">
                                <?= form_error('no_telp'); ?>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Simpan Perubahan
                        </button>
                    <?= form_close(); ?>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Informasi Akun</h6>
                </div>
                <div class="card-body">
                    <div class="text-center mb-3">
                        <img class="img-profile rounded-circle" src="https://ui-avatars.com/api/?name=<?= urlencode($user->nama_lengkap); ?>&background=random&size=128">
                    </div>
                    <ul class="list-group">
                        <li class="list-group-item">
                            <strong>Username:</strong> <?= $user->username; ?>
                        </li>
                        <li class="list-group-item">
                            <strong>Role:</strong> <?= ucfirst($user->role); ?>
                        </li>
                        <li class="list-group-item">
                            <strong>Tanggal Daftar:</strong> <?= date('d-m-Y', strtotime($user->created_at)); ?>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>