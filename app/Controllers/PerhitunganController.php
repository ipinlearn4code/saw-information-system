<?php

namespace App\Controllers;

use App\Models\MahasiswaModel;
use App\Models\KriteriaModel;
use App\Models\PenilaianModel;
use App\Models\SubKriteriaModel;

class PerhitunganController extends BaseController
{
    protected $mahasiswaModel;
    protected $kriteriaModel;
    protected $penilaianModel;

    public function __construct()
    {
        $this->mahasiswaModel = new MahasiswaModel();
        $this->kriteriaModel = new KriteriaModel();
        $this->penilaianModel = new PenilaianModel();
        // $this->subKriteriaModel = new SubKriteriaModel();
    }
    public function index()
    {
        $penilaian = $this->penilaianModel->findAll();

        // Ambil data mahasiswa dan kriteria
        $mahasiswa = $this->mahasiswaModel->findAll();
        $kriteria = $this->kriteriaModel->findAll();

        // Inisialisasi matriks normalisasi dan weighting
        $normalisasi = [];
        $maxValues = [];
        $weightedResults = [];

        // Hitung nilai maksimum untuk setiap kriteria
        foreach ($kriteria as $krit) {
            $nilaiKriteria = array_filter($penilaian, fn($pen) => $pen['id_kriteria'] === $krit['id_kriteria']);

            // Pastikan array tidak kosong sebelum mengambil nilai maksimum
            if (!empty($nilaiKriteria)) {
                $maxValues[$krit['id_kriteria']] = max(array_column($nilaiKriteria, 'nilai'));
            } else {
                $maxValues[$krit['id_kriteria']] = 1; // Nilai default untuk mencegah pembagian dengan nol
            }
        }

        // Hitung normalisasi dan weighting
        foreach ($mahasiswa as $mhs) {
            $rowNormalisasi = ['nama' => $mhs['nama']];
            $weightedValue = 0;

            foreach ($kriteria as $krit) {
                $nilai = 0;

                foreach ($penilaian as $pen) {
                    if ($pen['id_mahasiswa'] === $mhs['id_mahasiswa'] && $pen['id_kriteria'] === $krit['id_kriteria']) {
                        $nilai = $pen['nilai'];
                        break;
                    }
                }

                // Normalisasi nilai
                $normalizedValue = $nilai / $maxValues[$krit['id_kriteria']];
                $rowNormalisasi['kriteria_' . $krit['id_kriteria']] = $normalizedValue;

                // Pembobotan nilai
                $weightedValue += $normalizedValue * $krit['bobot'];
            }

            $normalisasi[] = $rowNormalisasi;
            $weightedResults[] = [
                'nama' => $mhs['nama'],
                'hasil_akhir' => $weightedValue,
            ];
        }

        session()->set('hasil_akhir', $weightedResults);

        // Kirim data ke view
        $data = [
            'title' => 'Normalisasi Matriks dan Pembobotan',
            'normalisasi' => $normalisasi,
            'kriteria' => $kriteria,
            'hasil_akhir' => $weightedResults,
        ];

        // Tampilkan view
        // return view('penilaian/hasil', $data);


        return view('penilaian/hasil_akhir', $data);
    }
    public function urutkan()
    {
        // Ambil data penilaian
        $hasilAkhir = session()->get('hasil_akhir');

        if (!$hasilAkhir) {
            return redirect()->to('/penilaian')->with('error', 'Data tidak tersedia. Silakan hitung ulang.');
        }

        // Urutkan hasil berdasarkan nilai hasil_akhir (descending)
        usort($hasilAkhir, fn($a, $b) => $b['hasil_akhir'] <=> $a['hasil_akhir']);

        // Kirim data terurut ke view
        $data = [
            'title' => 'Perangkingan Mahasiswa',
            'hasil_akhir' => $hasilAkhir,
        ];

        return view('penilaian/hasil_akhir', $data);
    }
}