<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container mt-4">
    <h1 class="mb-4">Tambah Penilaian</h1>

    <form action="/penilaian/store" method="POST">
        <?= csrf_field(); ?>

        <!-- Dropdown Mahasiswa -->
        <div class="mb-3">
            <label for="mahasiswa" class="form-label">Mahasiswa</label>
            <select name="id_mahasiswa" id="mahasiswa" class="form-control" required>
                <option value="">Pilih Mahasiswa</option>
                <?php foreach ($mahasiswa as $mhs): ?>
                    <option value="<?= $mhs['id_mahasiswa']; ?>"><?= $mhs['nama']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- Input Penilaian untuk setiap Kriteria -->
        <?php foreach ($kriteria as $krit): ?>
            <div class="mb-3">
                <label for="nilai_<?= $krit['id_kriteria']; ?>" class="form-label"><?= $krit['nama_kriteria']; ?></label>
                <input type="number" name="nilai[<?= $krit['id_kriteria']; ?>]" id="nilai_<?= $krit['id_kriteria']; ?>" class="form-control" required>

                <!-- Tambahkan keterangan jika kriteria memiliki sub-kriteria -->
                <?php 
                // Filter sub-kriteria berdasarkan id_kriteria
                $subKriteria = array_filter($sub_kriteria, function($sub) use ($krit) {
                    return $sub['id_kriteria'] == $krit['id_kriteria'];
                });

                // Jika ada sub-kriteria, tampilkan keterangan
                if (!empty($subKriteria)): ?>
                    <small class="form-text text-muted mt-2">
                        Jumlahkan poin dari subkriteria berikut:
                        <ul>
                            <?php foreach ($subKriteria as $sub): ?>
                                <li><?= $sub['nama_sub_kriteria']; ?> : <?= $sub['nilai']; ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </small>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
<?= $this->endSection(); ?>
