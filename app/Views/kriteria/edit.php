<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container mt-4">
    <h1 class="mb-4">Edit Kriteria</h1>
    <form action="/kriteria/update/<?= $kriteria['id_kriteria']; ?>" method="post">
        <?= csrf_field(); ?>
        <input type="hidden" name="_method" value="PUT">
        <div class="mb-3">
            <label for="nama_kriteria" class="form-label">Nama Kriteria</label>
            <input type="text" class="form-control" id="nama_kriteria" name="nama_kriteria" value="<?= $kriteria['nama_kriteria']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="bobot" class="form-label">Bobot (%)</label>
            <input type="number" class="form-control" id="bobot" name="bobot" value="<?= $kriteria['bobot']; ?>" step="0.01" required>
        </div>
        <div class="mb-3">
            <label for="jenis" class="form-label">Jenis</label>
            <select class="form-select" id="jenis" name="jenis" required>
                <option value="benefit" <?= $kriteria['jenis'] === 'benefit' ? 'selected' : ''; ?>>Benefit</option>
                <option value="cost" <?= $kriteria['jenis'] === 'cost' ? 'selected' : ''; ?>>Cost</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="/kriteria" class="btn btn-secondary">Kembali</a>
    </form>
</div>
<?= $this->endSection(); ?>
