<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>

<div class="container mt-4">
    <h1 class="mb-4">Form Penilaian Mahasiswa</h1>
    <form action="/penilaian/submit" method="POST">
        <!-- Mahasiswa Dropdown -->
        <div class="mb-3">
            <label for="mahasiswa_id" class="form-label">Mahasiswa</label>
            <select name="mahasiswa_id" id="mahasiswa_id" class="form-select" required>
                <option value="">Pilih Mahasiswa</option>
                <?php foreach ($mahasiswa as $m): ?>
                    <option value="<?= $m['id_mahasiswa']; ?>"><?= $m['nama']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- Kriteria dan Nilai -->
        <div class="mb-3">
            <label for="kriteria_id" class="form-label">Kriteria</label>
            <select name="kriteria_id" id="kriteria_id" class="form-select" required>
                <option value="">Pilih Kriteria</option>
                <?php foreach ($kriteria as $k): ?>
                    <option value="<?= $k['id_kriteria']; ?>"><?= $k['nama_kriteria']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- Nilai Input untuk Kriteria -->
        <div class="mb-3">
            <label for="nilai" class="form-label">Nilai</label>
            <input type="number" name="nilai" id="nilai" class="form-control" placeholder="Masukkan Nilai" required min="1" max="100">
        </div>

        <!-- Submit Button -->
        <div class="mb-3">
            <button type="submit" class="btn btn-primary">Kirim Penilaian</button>
        </div>
    </form>
</div>


<?= $this->endSection(); ?>