<?php

namespace App\Controllers;

use App\Models\MahasiswaModel;
use App\Models\KriteriaModel;
use App\Models\PenilaianModel;
use App\Models\UserModel;

class Dashboard extends BaseController
{
    protected $mahasiswaModel;
    protected $kriteriaModel;
    protected $penilaianModel;
    protected $userModel;

    public function __construct()
    {
        $this->mahasiswaModel = new MahasiswaModel();
        $this->kriteriaModel = new KriteriaModel();
        $this->penilaianModel = new PenilaianModel();
        $this->userModel = new UserModel();
    }

    public function index()
    {
        // Hitung statistik
        $totalMahasiswa = $this->mahasiswaModel->countAllResults();
        $totalKriteria = $this->kriteriaModel->countAllResults();
        $totalPenilaian = $this->penilaianModel->countAllResults();
        $totalPengguna = $this->userModel->countAllResults();

        // Ambil data rangking untuk tabel
        $penilaian = $this->penilaianModel->findAll();
        $kriteria = $this->kriteriaModel->findAll();
        $mahasiswa = $this->mahasiswaModel->findAll();

        // Hitung hasil akhir
        $hasilAkhir = [];
        foreach ($mahasiswa as $mhs) {
            $totalNilai = 0;
            foreach ($kriteria as $krit) {
                foreach ($penilaian as $pen) {
                    if ($pen['id_mahasiswa'] === $mhs['id_mahasiswa'] && $pen['id_kriteria'] === $krit['id_kriteria']) {
                        $totalNilai += $pen['nilai'] * $krit['bobot'];
                    }
                }
            }
            $hasilAkhir[] = [
                'nama' => $mhs['nama'],
                'hasil_akhir' => $totalNilai,
            ];
        }

        // Urutkan hasil akhir
        usort($hasilAkhir, fn($a, $b) => $b['hasil_akhir'] <=> $a['hasil_akhir']);

        // Data untuk grafik
        $chartData = [];
        foreach ($kriteria as $krit) {
            $chartData[] = [
                'label' => $krit['nama_kriteria'],
                'value' => array_sum(array_column(array_filter($penilaian, fn($pen) => $pen['id_kriteria'] === $krit['id_kriteria']), 'nilai')),
            ];
        }

        $data = [
            'title' => 'Dashboard',
            'totalMahasiswa' => $totalMahasiswa,
            'totalKriteria' => $totalKriteria,
            'totalPenilaian' => $totalPenilaian,
            'totalPengguna' => $totalPengguna,
            'hasilAkhir' => $hasilAkhir,
            'chartData' => $chartData,
        ];

        return view('dashboard', $data);
    }
}
