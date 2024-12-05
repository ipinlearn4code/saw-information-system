<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AlternatifModel;

class AlternatifController extends BaseController
{
    public function __construct()
    {
        $this->alternatifModel = new AlternatifModel();
    }
    public function index()
    {
        $data = [
            'title' => 'Daftar Alternatif',
            'alternatif' => $this->alternatifModel->findAll()
        ];

        return view('alternatif/index', $data);
    }

    public function create()
    {
        $mahasiswa = [
            'title' => 'Tambah Alternatif'
        ];

        // return view('alternatif/create', $mahasiswa);
    }

    public function store()
    {
        $this->alternatifModel->save([
            'id_mahasiswa' => $this->request->getPost('id_mahasiswa'),
            'nilai_akhir' => $this->request->getPost('nilai_akhir'),
            'ranking' => $this->request->getPost('ranking')
        ]);

        // return redirect()->to('/alternatif')->with('success', 'Alternatif berhasil ditambahkan.');
    }

    public function delete($id)
    {
        $this->alternatifModel->delete($id);
        // return redirect()->to('/alternatif')->with('success', 'Alternatif berhasil dihapus.');
    }

    public function clear()
    {
        $this->alternatifModel->truncate();
        // return redirect()->to('/alternatif')->with('success', 'Alternatif berhasil dihapus.');
    }
}