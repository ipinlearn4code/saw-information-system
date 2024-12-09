<?php

namespace App\Controllers;

use App\Models\MahasiswaModel;
use App\Models\KriteriaModel;
use App\Models\PenilaianModel;
use App\Models\SubKriteriaModel;

class PenilaianController extends BaseController
{
    protected $mahasiswaModel;
    protected $kriteriaModel;
    protected $penilaianModel;

    public function __construct()
    {
        $this->mahasiswaModel = new MahasiswaModel();
        $this->kriteriaModel = new KriteriaModel();
        $this->penilaianModel = new PenilaianModel();
        $this->subKriteriaModel = new SubKriteriaModel();
    }

    // Halaman Index (List Penilaian)
    public function index()
    {
        $kriteria = $this->kriteriaModel->findAll();
        $penilaian = $this->penilaianModel->findAll();
        $mahasiswaIds = array_unique(array_column($penilaian, 'id_mahasiswa'));
        $mahasiswa = $this->mahasiswaModel->whereIn('id_mahasiswa', $mahasiswaIds)->findAll();

        $data = [
            'title' => 'Penilaian',
            'mahasiswa' => $mahasiswa,
            'kriteria' => $kriteria,
            'penilaian' => $penilaian,
        ];

        return view('penilaian/index', $data);
    }

    // Halaman Tambah Penilaian
    // public function create()
    // {
    //     $kriteria = $this->kriteriaModel->findAll();
    //     $penilaian = $this->penilaianModel->findAll();
    //     $mahasiswaIds = array_unique(array_column($penilaian, 'id_mahasiswa'));
    //     $mahasiswa = $this->mahasiswaModel->whereNotIn('id_mahasiswa', $mahasiswaIds)->findAll();

    //     $data = [
    //         'title' => 'Tambah Penilaian',
    //         'kriteria' => $kriteria,
    //         'mahasiswa' => $mahasiswa,
    //     ];

    //     return view('penilaian/create', $data);
    // }

    public function create()
    {
        // Ambil data kriteria dan sub-kriteria dari model
        $kriteria = $this->kriteriaModel->findAll();
        $subKriteria = $this->subKriteriaModel->findAll();
        $mahasiswa = $this->mahasiswaModel->whereNotIn('id_mahasiswa', array_column($this->penilaianModel->findAll(), 'id_mahasiswa'))->findAll();

        // Kirim data ke view
        return view('penilaian/create', [
            'kriteria' => $kriteria,
            'sub_kriteria' => $subKriteria,
            'mahasiswa' => $mahasiswa
        ]);
    }

    // Simpan Data Penilaian
    public function store()
    {
        $idMahasiswa = $this->request->getPost('id_mahasiswa');
        $nilaiKriteria = $this->request->getPost('nilai');

        foreach ($nilaiKriteria as $idKriteria => $nilai) {
            $this->penilaianModel->insert([
                'id_mahasiswa' => $idMahasiswa,
                'id_kriteria' => $idKriteria,
                'nilai' => $nilai,
            ]);
        }

        return redirect()->to('/penilaian')->with('success', 'Penilaian berhasil ditambahkan.');
    }

    // Halaman Edit Penilaian
    public function edit($idMahasiswa)
    {
        // Ambil data mahasiswa, kriteria, dan sub-kriteria
        $mahasiswa = $this->mahasiswaModel->find($idMahasiswa);
        $kriteria = $this->kriteriaModel->findAll();
        $subKriteria = $this->subKriteriaModel->findAll();

        // Ambil data penilaian untuk mahasiswa ini
        $penilaian = $this->penilaianModel->where('id_mahasiswa', $idMahasiswa)->findAll();

        // Susun data penilaian berdasarkan id_kriteria
        $penilaianGrouped = [];
        foreach ($penilaian as $pen) {
            $penilaianGrouped[$pen['id_kriteria']] = $pen['nilai'];
        }

        $data = [
            'title' => 'Edit Penilaian',
            'id_mahasiswa' => $idMahasiswa,
            'mahasiswa' => $mahasiswa,
            'kriteria' => $kriteria,
            'sub_kriteria' => $subKriteria,
            'penilaian' => $penilaianGrouped
        ];

        return view('penilaian/edit', $data);
    }


    // Update Data Penilaian
    public function update($idMahasiswa)
    {
        // Ambil data dari form
        $data = $this->request->getPost();
        $this->penilaianModel->where('id_mahasiswa', $idMahasiswa)->delete(); // Hapus data lama

        $penilaian = [];

        // Input nilai langsung (untuk kriteria tanpa sub-kriteria)
        if (isset($data['nilai'])) {
            foreach ($data['nilai'] as $idKriteria => $nilaiKriteria) {
                $penilaian[] = [
                    'id_mahasiswa' => $idMahasiswa,
                    'id_kriteria' => $idKriteria,
                    'nilai' => $nilaiKriteria,
                ];
            }
        }

        // Input berdasarkan sub-kriteria (checkbox)
        if (isset($data['kriteria'])) {
            foreach ($data['kriteria'] as $idKriteria => $subNilai) {
                $nilaiTotal = array_sum($subNilai);
                $penilaian[] = [
                    'id_mahasiswa' => $idMahasiswa,
                    'id_kriteria' => $idKriteria,
                    'nilai' => $nilaiTotal,
                ];
            }
        }

        $this->penilaianModel->insertBatch($penilaian);
        return redirect()->to('/penilaian')->with('success', 'Penilaian berhasil diperbarui.');
    }

    // Hapus Penilaian
    public function delete($idMahasiswa)
    {
        $this->penilaianModel->where('id_mahasiswa', $idMahasiswa)->delete();

        return redirect()->to('/penilaian')->with('success', 'Penilaian berhasil dihapus.');
    }

    public function normalisasi()
    {
        // Ambil semua data penilaian
        $penilaian = $this->penilaianModel->findAll();

        // Ambil data mahasiswa dan kriteria
        $mahasiswa = $this->mahasiswaModel->findAll();
        $kriteria = $this->kriteriaModel->findAll();

        // Inisialisasi matriks normalisasi
        $normalisasi = [];
        $maxValues = [];

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

        // Hitung normalisasi
        foreach ($mahasiswa as $mhs) {
            $row = ['nama' => $mhs['nama']];
            foreach ($kriteria as $krit) {
                $nilai = 0;

                foreach ($penilaian as $pen) {
                    if ($pen['id_mahasiswa'] === $mhs['id_mahasiswa'] && $pen['id_kriteria'] === $krit['id_kriteria']) {
                        $nilai = $pen['nilai'];
                        break;
                    }
                }

                // Normalisasi nilai
                $row['kriteria_' . $krit['id_kriteria']] = $nilai / $maxValues[$krit['id_kriteria']];
            }
            $normalisasi[] = $row;
        }

        // Kirim data ke view
        $data = [
            'title' => 'Normalisasi Matriks',
            'normalisasi' => $normalisasi,
            'kriteria' => $kriteria,
        ];

        return view('penilaian/normalisasi', $data);
    }
}
