<?php
namespace App\Models;

use CodeIgniter\Model;

class PenilaianModel extends Model
{
    protected $table = 'penilaian';
    protected $primaryKey = 'id_penilaian';
    protected $allowedFields = ['id_mahasiswa', 'id_kriteria', 'nilai'];
    protected $returnType = 'array';


    public function getPenilaianByMahasiswa($mahasiswa_id)
    {
        return $this->select('penilaian.*, kriteria.nama_kriteria')
            ->join('kriteria', 'penilaian.kriteria_id = kriteria.id_kriteria')
            ->where('penilaian.mahasiswa_id', $mahasiswa_id)
            ->findAll();
    }
}
