<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container mt-4">
    <h1 class="mb-4">Hasil Penilaian Mahasiswa</h1>
    
    <div class="mb-3">
        <label for="mahasiswa_id" class="form-label">Mahasiswa</label>
        <select name="mahasiswa_id" id="mahasiswa_id" class="form-select" onchange="window.location.href='/penilaian/hasil/' + this.value;">
            <option value="">Pilih Mahasiswa</option>
            <?php foreach ($mahasiswa as $m): ?>
                <option value="<?= $m['id']; ?>" <?= ($m['id'] == $selected_mahasiswa) ? 'selected' : ''; ?>><?= $m['nama']; ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <?php if (isset($penilaian)): ?>
        <h4>Penilaian untuk <?= $selected_mahasiswa_name; ?></h4>
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Kriteria</th>
                    <th>Nilai</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($penilaian as $p): ?>
                    <tr>
                        <td><?= $p['nama_kriteria']; ?></td>
                        <td><?= $p['nilai']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>Belum ada penilaian untuk mahasiswa ini.</p>
    <?php endif; ?>
</div>
<?= $this->endSection(); ?>
