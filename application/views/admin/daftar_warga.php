<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Daftar Warga</h1>
    
    <?= $this->session->flashdata('message'); ?>
    
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Warga Terdaftar</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Lengkap</th>
                            <th>Username</th>
                            <th>Alamat</th>
                            <th>No. Telepon</th>
                            <th>Tanggal Daftar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; foreach ($warga as $w): ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $w->nama_lengkap; ?></td>
                            <td><?= $w->username; ?></td>
                            <td><?= $w->alamat; ?></td>
                            <td><?= $w->no_telp; ?></td>
                            <td><?= date('d-m-Y', strtotime($w->created_at)); ?></td>
                        </tr>
                        <?php endforeach; ?>
                        
                        <?php if(empty($warga)): ?>
                        <tr>
                            <td colspan="6" class="text-center">Belum ada warga terdaftar</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>