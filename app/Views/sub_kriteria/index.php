<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container mt-4">
    <h1 class="mb-4">Daftar Sub-Kriteria</h1>
    
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nama Sub-Kriteria</th>
                    <th>Nilai</th>
                    <th>Kriteria</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($sub_kriteria as $sub): ?>
                <tr>
                    <td><?= $sub['id_sub_kriteria']; ?></td>
                    <td><?= $sub['nama_sub_kriteria']; ?></td>
                    <td><?= $sub['nilai']; ?></td>
                    <td><?= $sub['id_kriteria']; ?> <!-- Anda bisa ganti ini dengan nama kriteria jika diinginkan --></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection(); ?>
