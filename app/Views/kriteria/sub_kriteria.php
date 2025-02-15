<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container mt-4">
    <h1 class="mb-4">Sub-Kriteria untuk <?= $kriteria['nama_kriteria']; ?></h1>
    <a href="/sub_kriteria/create/<?= $kriteria['id_kriteria']; ?>" class="btn btn-primary mb-3">Tambah Sub-Kriteria</a>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nama Sub-Kriteria</th>
                    <th>Nilai</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($sub_kriteria as $sub): ?>
                <tr>
                    <td><?= $sub['id_sub_kriteria']; ?></td>
                    <td><?= $sub['nama_sub_kriteria']; ?></td>
                    <td><?= $sub['nilai']; ?></td>
                    <td>
                        <a href="/sub_kriteria/edit/<?= $sub['id_sub_kriteria']; ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="/sub_kriteria/delete/<?= $sub['id_sub_kriteria']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?');">Hapus</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <a href="/kriteria" class="btn btn-secondary">Kembali</a>
</div>
<?= $this->endSection(); ?>
