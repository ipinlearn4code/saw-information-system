<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container mt-4">
    <h1 class="mb-4">Daftar Kriteria</h1>
    
    <!-- Menampilkan status total bobot -->
    <div class="mb-4">
        <?php if ($total_bobot == 100): ?>
        <p class="text-success">
            <i class="fas fa-check-circle"></i> Bobot total: 100% (Valid)
        </p>
        <?php else: ?>
        <p class="text-danger">
            <i class="fas fa-times-circle"></i> Bobot error: <?= $total_bobot; ?>% (Perbaiki agar total bobot menjadi 100%)
        </p>
        <?php endif; ?>
    </div>

    <a href="/kriteria/create" class="btn btn-primary mb-3">Tambah Kriteria</a>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nama Kriteria</th>
                    <th>Bobot</th>
                    <th>Jenis</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($kriteria as $k): ?>
                <tr>
                    <td><?= $k['id_kriteria']; ?></td>
                    <td><?= $k['nama_kriteria']; ?></td>
                    <td><?= $k['bobot']; ?>%</td>
                    <td><?= ucfirst($k['jenis']); ?></td>
                    <td>
                        <a href="/kriteria/edit/<?= $k['id_kriteria']; ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="/kriteria/delete/<?= $k['id_kriteria']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?');">Hapus</a>
                        <a href="/kriteria/sub_kriteria/<?= $k['id_kriteria']; ?>" class="btn btn-info btn-sm">Sub-Kriteria</a>

                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection(); ?>
