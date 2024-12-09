<?php
namespace App\Models;

use CodeIgniter\Model;

class PenilaianModel extends Model
{
    protected $table = 'penilaian';
    protected $primaryKey = 'id_penilaian';
    protected $allowedFields = ['id_mahasiswa', 'id_kriteria', 'nilai'];
    protected $returnType = 'array';


    public function getPenilaianByMahasiswa($mahasiswa_id)
    {
        return $this->select('penilaian.*, kriteria.nama_kriteria')
            ->join('kriteria', 'penilaian.kriteria_id = kriteria.id_kriteria')
            ->where('penilaian.mahasiswa_id', $mahasiswa_id)
            ->findAll();
    }

    public function getPenilaianData()
    {
        // Ambil semua data penilaian lengkap dengan mahasiswa dan kriteria
        $penilaian = $this->db->table($this->table)
            ->select('penilaian.id_mahasiswa, mahasiswa.nama as nama_mahasiswa, penilaian.id_kriteria, kriteria.nama_kriteria, kriteria.jenis, kriteria.bobot, penilaian.nilai')
            ->join('mahasiswa', 'mahasiswa.id_mahasiswa = penilaian.id_mahasiswa')
            ->join('kriteria', 'kriteria.id_kriteria = penilaian.id_kriteria')
            ->get()
            ->getResultArray();

        // Susun data berdasarkan mahasiswa
        $mahasiswa = [];
        $kriteria = [];
        foreach ($penilaian as $row) {
            $mahasiswa[$row['id_mahasiswa']]['nama_mahasiswa'] = $row['nama_mahasiswa'];
            $mahasiswa[$row['id_mahasiswa']]['kriteria'][$row['id_kriteria']] = $row;
            $kriteria[$row['id_kriteria']] = $row['jenis'];
        }

        // Normalisasi Matriks
        foreach ($kriteria as $id_kriteria => $jenis) {
            $nilai = array_column(array_column($mahasiswa, 'kriteria'), $id_kriteria);

            // Cari nilai max atau min tergantung jenis kriteria
            $max = max($nilai);
            $min = min($nilai);

            foreach ($mahasiswa as $id_mahasiswa => &$data) {
                if ($jenis == 'benefit') {
                    $data['kriteria'][$id_kriteria]['normalized'] = $data['kriteria'][$id_kriteria]['nilai'] / $max;
                } elseif ($jenis == 'cost') {
                    $data['kriteria'][$id_kriteria]['normalized'] = $min / $data['kriteria'][$id_kriteria]['nilai'];
                }
            }
        }

        // Hitung Weighted Normalization dan Total Nilai
        foreach ($mahasiswa as $id_mahasiswa => &$data) {
            $total = 0;

            foreach ($data['kriteria'] as $id_kriteria => &$kriteria_data) {
                $kriteria_data['weighted'] = $kriteria_data['normalized'] * $kriteria_data['bobot'];
                $total += $kriteria_data['weighted'];
            }

            $data['total'] = $total; // Total nilai akhir
        }

        return $mahasiswa;
    }

}
