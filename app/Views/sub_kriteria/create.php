<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container mt-4">
    <h1 class="mb-4">Tambah Sub-Kriteria untuk <?= $kriteria['nama_kriteria']; ?></h1>
    <form action="/sub_kriteria/store" method="post">
        <?= csrf_field(); ?>
        <input type="hidden" name="id_kriteria" value="<?= $id_kriteria; ?>">
        <div class="mb-3">
            <label for="nama_sub_kriteria" class="form-label">Nama Sub-Kriteria</label>
            <input type="text" class="form-control" id="nama_sub_kriteria" name="nama_sub_kriteria" required>
        </div>
        <div class="mb-3">
            <label for="nilai" class="form-label">Nilai</label>
            <input type="number" class="form-control" id="nilai" name="nilai" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="/kriteria/sub_kriteria/<?= $id_kriteria; ?>" class="btn btn-secondary">Kembali</a>
    </form>
</div>
<?= $this->endSection(); ?>
