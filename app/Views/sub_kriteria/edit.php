<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container mt-4">
    <h1 class="mb-4">Edit Sub-Kriteria</h1>
    <form action="/sub_kriteria/update/<?= $sub_kriteria['id_sub_kriteria']; ?>" method="post">
        <?= csrf_field(); ?>
        <input type="hidden" name="_method" value="PUT">
        <input type="hidden" name="id_kriteria" value="<?= $sub_kriteria['id_kriteria']; ?>">
        <div class="mb-3">
            <label for="nama_sub_kriteria" class="form-label">Nama Sub-Kriteria</label>
            <input type="text" class="form-control" id="nama_sub_kriteria" name="nama_sub_kriteria" value="<?= $sub_kriteria['nama_sub_kriteria']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="nilai" class="form-label">Nilai</label>
            <input type="number" class="form-control" id="nilai" name="nilai" value="<?= $sub_kriteria['nilai']; ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="/kriteria/sub_kriteria/<?= $sub_kriteria['id_kriteria']; ?>" class="btn btn-secondary">Kembali</a>
    </form>
</div>
<?= $this->endSection(); ?>
