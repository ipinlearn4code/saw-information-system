<?php
namespace App\Models;

use CodeIgniter\Model;

class MahasiswaModel extends Model
{
    protected $table = 'mahasiswa';
    protected $primaryKey = 'id_mahasiswa';
    protected $allowedFields = ['nama', 'nim', 'jurusan', 'semester', 'kontak'];
    protected $returnType = 'array';
}
