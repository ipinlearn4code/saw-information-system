<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container mt-4">
    <h1 class="mb-4">Normalisasi Matriks</h1>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Mahasiswa</th>
                <?php foreach ($kriteria as $krit): ?>
                    <th><?= $krit['nama_kriteria']; ?></th>
                <?php endforeach; ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($normalisasi as $index => $row): ?>
                <tr>
                    <td><?= $index + 1; ?></td>
                    <td><?= $row['nama']; ?></td>
                    <?php foreach ($kriteria as $krit): ?>
                        <td><?= number_format($row['kriteria_' . $krit['id_kriteria']], 4); ?></td>
                    <?php endforeach; ?>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?= $this->endSection(); ?>
