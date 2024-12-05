<?php

namespace App\Controllers;

use App\Models\KriteriaModel;
use App\Models\MahasiswaModel;
use App\Models\PenilaianModel;

class PenilaianController extends BaseController
{
    protected $kriteriaModel;
    protected $mahasiswaModel;
    protected $penilaianModel;

    public function __construct()
    {
        $this->kriteriaModel = new KriteriaModel();
        $this->mahasiswaModel = new MahasiswaModel();
        $this->penilaianModel = new PenilaianModel();
    }

    public function index()
    {
        $mahasiswaModel = new MahasiswaModel();
        $kriteriaModel = new KriteriaModel();

        $mahasiswa = $mahasiswaModel->findAll();
        $kriteria = $kriteriaModel->findAll();

        return view('penilaian/index', [
            'mahasiswa' => $mahasiswa,
            'kriteria' => $kriteria
        ]);
    }

    // Menampilkan form penilaian
    public function submit()
    {
        $penilaianModel = new PenilaianModel();

        // Ambil data dari form
        $data = [
            'id_mahasiswa' => $this->request->getPost('mahasiswa_id'),
            'id_kriteria' => $this->request->getPost('kriteria_id'),
            'nilai' => $this->request->getPost('nilai')
        ];

        // Simpan penilaian ke dalam database
        $penilaianModel->save($data);

        // Redirect ke halaman hasil atau kembali ke form
        return redirect()->to('/penilaian/hasil');
    }

    // Menampilkan hasil penilaian per mahasiswa
    public function hasil($mahasiswa_id = null)
    {
        if ($mahasiswa_id === null) {
            return redirect()->to('/penilaian');
        }

        // Ambil data mahasiswa dan penilaian berdasarkan mahasiswa_id
        $mahasiswa = $this->mahasiswaModel->findAll();
        $selected_mahasiswa = $mahasiswa_id;
        $selected_mahasiswa_name = $this->mahasiswaModel->find($mahasiswa_id)['nama'];
        $penilaian = $this->penilaianModel->getPenilaianByMahasiswa($mahasiswa_id);

        $data = [
            'title' => 'Hasil Penilaian',
            'mahasiswa' => $mahasiswa,
            'selected_mahasiswa' => $selected_mahasiswa,
            'selected_mahasiswa_name' => $selected_mahasiswa_name,
            'penilaian' => $penilaian
        ];

        return view('penilaian/hasil', $data);
    }
}
