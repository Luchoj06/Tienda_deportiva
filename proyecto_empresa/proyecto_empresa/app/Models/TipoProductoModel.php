<?php

namespace App\Models;

use CodeIgniter\Model;

class TipoProductoModel extends Model
{
    protected $table            = 'tipos_productos';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $allowedFields    = ['nombre', 'descripcion'];
    protected $useTimestamps    = true;
    protected $createdField     = 'created_at';
    protected $updatedField     = 'updated_at';
}
