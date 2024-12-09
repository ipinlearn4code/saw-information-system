<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container mt-4">
    <h1 class="mb-4">Detail Perangkingan</h1>
    <div class="mb-4">
        <h4>Nama Mahasiswa: <?= $mahasiswa['nama']; ?></h4>
        <h4>NIM: <?= $mahasiswa['nim']; ?></h4>
    </div>
    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Kriteria</th>
                <th>Nilai</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($kriteria as $krit): ?>
            <?php
                $nilai = 0;
                foreach ($penilaian as $pen) {
                    if ($pen['id_kriteria'] == $krit['id_kriteria']) {
                        $nilai = $pen['nilai'];
                        break;
                    }
                }
            ?>
            <tr>
                <td><?= $krit['nama_kriteria']; ?></td>
                <td><?= $nilai; ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <a href="/alternatif" class="btn btn-secondary">Kembali</a>
</div>
<?= $this->endSection(); ?>
