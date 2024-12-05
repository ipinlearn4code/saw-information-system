<?php

namespace App\Controllers;

use App\Models\MahasiswaModel;

class MahasiswaController extends BaseController
{
    protected $mahasiswaModel;

    public function __construct()
    {
        $this->mahasiswaModel = new MahasiswaModel();
    }

    // Menampilkan daftar mahasiswa
    public function index()
    {
        $data = [
            'title' => 'Daftar Mahasiswa',
            'mahasiswa' => $this->mahasiswaModel->findAll()
        ];

        return view('mahasiswa/index', $data);
    }

    // Menampilkan form tambah mahasiswa
    public function create()
    {
        $mahasiswa = [
            'title' => 'Tambah Mahasiswa'
        ];

        return view('mahasiswa/create', $mahasiswa);
    }

    // Menyimpan data mahasiswa baru
    public function store()
    {
        $this->mahasiswaModel->save([
            'nama' => $this->request->getPost('nama'),
            'nim' => $this->request->getPost('nim'),
            'jurusan' => $this->request->getPost('jurusan'),
            'semester' => $this->request->getPost('semester'),
            'kontak' => $this->request->getPost('kontak')
        ]);

        return redirect()->to('/mahasiswa')->with('success', 'Mahasiswa berhasil ditambahkan.');
    }

    // Menampilkan form edit mahasiswa
    public function edit($id)
    {
        $data = [
            'title' => 'Edit Mahasiswa',
            'mahasiswa' => $this->mahasiswaModel->find($id)
        ];

        return view('mahasiswa/edit', $data);
    }

    // Memperbarui data mahasiswa
    public function update($id)
    {
        $this->mahasiswaModel->update($id, [
            'nama' => $this->request->getPost('nama'),
            'nim' => $this->request->getPost('nim'),
            'jurusan' => $this->request->getPost('jurusan'),
            'semester' => $this->request->getPost('semester'),
            'kontak' => $this->request->getPost('kontak')
        ]);

        return redirect()->to('/mahasiswa')->with('success', 'Data mahasiswa berhasil diperbarui.');
    }

    // Menghapus data mahasiswa
    public function delete($id)
    {
        $this->mahasiswaModel->delete($id);
        return redirect()->to('/mahasiswa')->with('success', 'Mahasiswa berhasil dihapus.');
    }
}
