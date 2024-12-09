<?php

namespace App\Controllers;

use App\Models\SubKriteriaModel;
use App\Models\KriteriaModel;

class SubKriteriaController extends BaseController
{
    protected $subKriteriaModel;
    protected $kriteriaModel;

    public function __construct()
    {
        $this->subKriteriaModel = new SubKriteriaModel();
        $this->kriteriaModel = new KriteriaModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Daftar Sub-Kriteria',
            'sub_kriteria' => $this->subKriteriaModel->findAll() // Ambil semua sub-kriteria
        ];

        return view('sub_kriteria/index', $data); // Pastikan ada view sub_kriteria/index.php
    }
    // public function index($id_kriteria)
    // {
    //     $data = [
    //         'title' => 'Sub-Kriteria',
    //         'kriteria' => $this->kriteriaModel->find($id_kriteria),
    //         'sub_kriteria' => $this->subKriteriaModel->where('id_kriteria', $id_kriteria)->findAll()
    //     ];

    //     return view('sub_kriteria/index', $data);
    // }

    // Menampilkan form tambah sub-kriteria
    public function create($id_kriteria)
    {
        $data = [
            'title' => 'Tambah Sub-Kriteria',
            'id_kriteria' => $id_kriteria,
            'kriteria' => $this->kriteriaModel->find($id_kriteria)
        ];

        return view('sub_kriteria/create', $data);
    }

    // Menyimpan data sub-kriteria baru
    public function store()
    {
        $this->subKriteriaModel->save([
            'id_kriteria' => $this->request->getPost('id_kriteria'),
            'nama_sub_kriteria' => $this->request->getPost('nama_sub_kriteria'),
            'nilai' => $this->request->getPost('nilai')
        ]);

        return redirect()->to('/kriteria/sub_kriteria/' . $this->request->getPost('id_kriteria'))->with('success', 'Sub-Kriteria berhasil ditambahkan.');
    }

    // Menampilkan form edit sub-kriteria
    public function edit($id_sub_kriteria)
    {
        $sub_kriteria = $this->subKriteriaModel->find($id_sub_kriteria);
        $data = [
            'title' => 'Edit Sub-Kriteria',
            'sub_kriteria' => $sub_kriteria,
            'kriteria' => $this->kriteriaModel->find($sub_kriteria['id_kriteria'])
        ];

        return view('sub_kriteria/edit', $data);
    }

    // Memperbarui sub-kriteria
    public function update($id_sub_kriteria)
    {
        $this->subKriteriaModel->update($id_sub_kriteria, [
            'nama_sub_kriteria' => $this->request->getPost('nama_sub_kriteria'),
            'nilai' => $this->request->getPost('nilai')
        ]);

        return redirect()->to('/kriteria/sub_kriteria/' . $this->request->getPost('id_kriteria'))->with('success', 'Sub-Kriteria berhasil diperbarui.');
    }

    // Menghapus sub-kriteria
    public function delete($id_sub_kriteria)
    {
        $sub_kriteria = $this->subKriteriaModel->find($id_sub_kriteria);
        $this->subKriteriaModel->delete($id_sub_kriteria);

        return redirect()->to('/kriteria/sub_kriteria/' . $sub_kriteria['id_kriteria'])->with('success', 'Sub-Kriteria berhasil dihapus.');
    }
}
