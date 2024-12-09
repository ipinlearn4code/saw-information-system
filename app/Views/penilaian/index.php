<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container mt-4">
    <h1 class="mb-4">Penilaian Mahasiswa</h1>

    <!-- Tombol Tambah Penilaian -->
    <a href="/penilaian/create" class="btn btn-primary mb-3">Tambah Penilaian</a>

    <!-- Tabel Penilaian -->
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Alternatif</th>
                    <?php foreach ($kriteria as $krit): ?>
                        <th><?= $krit['nama_kriteria']; ?></th>
                    <?php endforeach; ?>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($mahasiswa) > 0): ?>
                    <?php foreach ($mahasiswa as $index => $mhs): ?>
                        <tr>
                            <td><?= $index + 1; ?></td>
                            <td><?= $mhs['nama']; ?></td>
                            <?php foreach ($kriteria as $krit): ?>
                                <?php
                                    $nilai = 0;
                                    foreach ($penilaian as $pen) {
                                        if ($pen['id_mahasiswa'] == $mhs['id_mahasiswa'] && $pen['id_kriteria'] == $krit['id_kriteria']) {
                                            $nilai = $pen['nilai'];
                                            break;
                                        }
                                    }
                                ?>
                                <td><?= $nilai; ?></td>
                            <?php endforeach; ?>
                            <td>
                                <a href="/penilaian/edit/<?= $mhs['id_mahasiswa']; ?>" class="btn btn-warning btn-sm">Ubah</a>
                                <a href="/penilaian/delete/<?= $mhs['id_mahasiswa']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus penilaian?');">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="<?= count($kriteria) + 3; ?>" class="text-center">Belum ada data penilaian.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection(); ?>
