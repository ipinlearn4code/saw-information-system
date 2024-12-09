<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container mt-4">
    <h1 class="mb-4">Hasil Akhir</h1>

    <!-- Tabel Hasil Akhir -->
    <table class="table table-bordered">
        <thead class="table-primary">
            <tr>
                <th>Mahasiswa</th>
                <th>Hasil Akhir</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($hasil_akhir as $hasil): ?>
            <tr>
                <td><?= $hasil['nama']; ?></td>
                <td><?= number_format($hasil['hasil_akhir'], 9, ',', '.'); ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Tombol Urutkan -->
    <form action="/penilaian/urutkan" method="POST">
        <?= csrf_field(); ?>
        <button type="submit" class="btn btn-success">Urutkan</button>
    </form>
</div>
<?= $this->endSection(); ?>
