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

    // Show list of all kriteria
    public function index()
    {
        $data['kriteria'] = $this->kriteriaModel->findAll();
        return view('kriteria/index', $data);
    }

    // Show form to create a new kriteria
    public function create()
    {
        return view('kriteria/create');
    }

    // Store new kriteria to the database
    public function store()
    {
        $this->kriteriaModel->save([
            'nama_kriteria' => $this->request->getPost('nama_kriteria'),
            'bobot' => $this->request->getPost('bobot'),
            'jenis' => $this->request->getPost('jenis'),
        ]);
        return redirect()->to('/kriteria');
    }

    // Show form to edit an existing kriteria
    public function edit($id)
    {
        $data['kriteria'] = $this->kriteriaModel->find($id);
        return view('kriteria/edit', $data);
    }

    // Update kriteria in the database
    public function update($id)
    {
        $this->kriteriaModel->update($id, [
            'nama_kriteria' => $this->request->getPost('nama_kriteria'),
            'bobot' => $this->request->getPost('bobot'),
            'jenis' => $this->request->getPost('jenis'),
        ]);
        return redirect()->to('/kriteria');
    }

    // Delete a kriteria from the database
    public function delete($id)
    {
        $this->kriteriaModel->delete($id);
        return redirect()->to('/kriteria');
    }

    // Show list of sub-kriteria for a specific kriteria
    public function sub_kriteria($id)
    {
        $data['sub_kriteria'] = $this->subKriteriaModel->where('id_kriteria', $id)->findAll();
        return view('kriteria/sub_kriteria', $data);
    }
}
