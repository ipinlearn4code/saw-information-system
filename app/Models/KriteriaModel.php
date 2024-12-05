<?php
namespace App\Models;

use CodeIgniter\Model;

class KriteriaModel extends Model
{
    protected $table = 'kriteria';
    protected $primaryKey = 'id_kriteria';
    protected $allowedFields = ['nama_kriteria', 'bobot', 'jenis'];
    protected $returnType = 'array';
}
