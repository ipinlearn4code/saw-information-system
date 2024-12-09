<?php

namespace App\Controllers;

use App\Models\KriteriaModel;
use App\Models\SubKriteriaModel;

class KriteriaController extends BaseController
{
    protected $kriteriaModel;
    protected $subKriteriaModel;

    public function __construct()
    {
        $this->kriteriaModel = new KriteriaModel();
        $this->subKriteriaModel = new SubKriteriaModel();
    }

    // Menampilkan daftar kriteria
    public function index()
    {
        $kriteria = $this->kriteriaModel->findAll();
        $totalBobot = array_sum(array_column($kriteria, 'bobot'));

        $data = [
            'title' => 'Daftar Kriteria',
            'kriteria' => $kriteria,
            'total_bobot' => $totalBobot
        ];

        return view('kriteria/index', $data);
    }


    // Menampilkan form tambah kriteria
    public function create()
    {
        $data = [
            'title' => 'Tambah Kriteria'
        ];

        return view('kriteria/create', $data);
    }

    // Menyimpan kriteria baru
    public function store()
    {
        $this->kriteriaModel->save([
            'nama_kriteria' => $this->request->getPost('nama_kriteria'),
            'bobot' => $this->request->getPost('bobot'),
            'jenis' => $this->request->getPost('jenis')
        ]);

        return redirect()->to('/kriteria')->with('success', 'Kriteria berhasil ditambahkan.');
    }

    // Menampilkan form edit kriteria
    public function edit($id)
    {
        $data = [
            'title' => 'Edit Kriteria',
            'kriteria' => $this->kriteriaModel->find($id)
        ];

        return view('kriteria/edit', $data);
    }

    // Memperbarui data kriteria
    public function update($id)
    {
        $this->kriteriaModel->update($id, [
            'nama_kriteria' => $this->request->getPost('nama_kriteria'),
            'bobot' => $this->request->getPost('bobot'),
            'jenis' => $this->request->getPost('jenis')
        ]);

        return redirect()->to('/kriteria')->with('success', 'Data kriteria berhasil diperbarui.');
    }

    // Menghapus kriteria
    public function delete($id)
    {
        $this->kriteriaModel->delete($id);
        return redirect()->to('/kriteria')->with('success', 'Kriteria berhasil dihapus.');
    }

    // Menampilkan sub-kriteria berdasarkan kriteria tertentu
    public function subKriteria($id)
    {
        $data = [
            'title' => 'Sub-Kriteria',
            'kriteria' => $this->kriteriaModel->find($id),
            'sub_kriteria' => $this->subKriteriaModel->where('id_kriteria', $id)->findAll()
        ];

        return view('kriteria/sub_kriteria', $data);
    }
}
