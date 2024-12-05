<?php

namespace App\Controllers;

use App\Models\UserModel;

class UserController extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    // Menampilkan daftar user
    public function index()
    {
        $data['users'] = $this->userModel->findAll(); // Mengambil semua data user
        return view('users/index', $data); // Mengirim data ke view
    }

    // Menampilkan form tambah user
    public function create()
    {
        return view('users/create');
    }

    // Menyimpan user baru
    public function store()
    {
        $data = [
            'username' => $this->request->getPost('username'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_BCRYPT),
            'role'     => $this->request->getPost('role'),
            'email'    => $this->request->getPost('email'),
        ];

        $this->userModel->save($data); // Fungsi save bisa digunakan untuk insert dan update
        return redirect()->to('/users');
    }

    // Menampilkan form edit user
    public function edit($id)
    {
        $data['user'] = $this->userModel->find($id); // Mengambil data user berdasarkan ID
        return view('users/edit', $data);
    }

    // Memperbarui user
    public function update($id)
    {
        $data = [
            'id_user'  => $id, // CI4 akan otomatis mengupdate berdasarkan primary key
            'username' => $this->request->getPost('username'),
            'role'     => $this->request->getPost('role'),
            'email'    => $this->request->getPost('email'),
        ];

        // Update password jika ada perubahan
        if ($this->request->getPost('password')) {
            $data['password'] = password_hash($this->request->getPost('password'), PASSWORD_BCRYPT);
        }

        $this->userModel->save($data);
        return redirect()->to('/users');
    }

    // Menghapus user
    public function delete($id)
    {
        $this->userModel->delete($id); // Menghapus data berdasarkan ID
        return redirect()->to('/users');
    }
}
