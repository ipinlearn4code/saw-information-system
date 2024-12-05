<?php
namespace App\Models;

use CodeIgniter\Model;

class AlternatifModel extends Model
{
    protected $table = 'alternatif';
    protected $primaryKey = 'id_alternatif';
    protected $allowedFields = ['id_mahasiswa', 'nilai_akhir', 'rangking'];
    protected $returnType = 'array';
}
