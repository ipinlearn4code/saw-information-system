<?php

namespace App\Controllers;

use App\Models\MahasiswaModel;
use App\Models\KriteriaModel;
use App\Models\PenilaianModel;

class AlternatifController extends BaseController
{
    protected $mahasiswaModel;
    protected $kriteriaModel;
    protected $penilaianModel;

    public function __construct()
    {
        $this->mahasiswaModel = new MahasiswaModel();
        $this->kriteriaModel = new KriteriaModel();
        $this->penilaianModel = new PenilaianModel();
    }

    // Menampilkan hasil perangkingan
    public function index()
    {
        $mahasiswa = $this->mahasiswaModel->findAll();
        $kriteria = $this->kriteriaModel->findAll();
        $penilaian = $this->penilaianModel->findAll();

        // Perhitungan SAW
        $alternatif = [];
        foreach ($mahasiswa as $mhs) {
            $totalNilai = 0;

            foreach ($kriteria as $krit) {
                // Ambil nilai dari penilaian untuk mahasiswa dan kriteria saat ini
                $nilai = 0;
                foreach ($penilaian as $pen) {
                    if ($pen['id_mahasiswa'] == $mhs['id_mahasiswa'] && $pen['id_kriteria'] == $krit['id_kriteria']) {
                        $nilai = $pen['nilai'];
                        break;
                    }
                }

                // Cari nilai maksimum untuk kriteria tertentu
                $nilaiKriteria = array_filter($penilaian, function ($pen) use ($krit) {
                    return $pen['id_kriteria'] == $krit['id_kriteria'];
                });

                $nilaiKriteriaArray = array_column($nilaiKriteria, 'nilai');
                $maxNilai = $nilaiKriteriaArray ? max($nilaiKriteriaArray) : 1; // Hindari pembagian dengan 0

                // Normalisasi
                $normalisasi = $nilai / $maxNilai;

                // Hitung nilai akhir
                $totalNilai += $normalisasi * $krit['bobot'];
            }

            $alternatif[] = [
                'mahasiswa' => $mhs,
                'total_nilai' => $totalNilai
            ];
        }

        // Urutkan berdasarkan nilai tertinggi
        usort($alternatif, function ($a, $b) {
            return $b['total_nilai'] <=> $a['total_nilai'];
        });

        $data = [
            'title' => 'Hasil Perangkingan',
            'alternatif' => $alternatif
        ];

        return view('alternatif/index', $data);
    }

    // Menampilkan detail perangkingan untuk mahasiswa tertentu
    public function detail($id_mahasiswa)
    {
        $mahasiswa = $this->mahasiswaModel->find($id_mahasiswa);
        $kriteria = $this->kriteriaModel->findAll();
        $penilaian = $this->penilaianModel->where('id_mahasiswa', $id_mahasiswa)->findAll();

        $data = [
            'title' => 'Detail Perangkingan',
            'mahasiswa' => $mahasiswa,
            'kriteria' => $kriteria,
            'penilaian' => $penilaian
        ];

        return view('alternatif/detail', $data);
    }
}
