<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container mt-4">
    <h1 class="mb-4">Hasil Perangkingan</h1>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Peringkat</th>
                    <th>Nama Mahasiswa</th>
                    <th>NIM</th>
                    <th>Total Nilai</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $peringkat = 1; ?>
                <?php foreach ($alternatif as $alt): ?>
                <tr>
                    <td><?= $peringkat++; ?></td>
                    <td><?= $alt['mahasiswa']['nama']; ?></td>
                    <td><?= $alt['mahasiswa']['nim']; ?></td>
                    <td><?= number_format($alt['total_nilai'], 2); ?></td>
                    <td>
                        <a href="/alternatif/detail/<?= $alt['mahasiswa']['id_mahasiswa']; ?>" class="btn btn-info btn-sm">Detail</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection(); ?>
