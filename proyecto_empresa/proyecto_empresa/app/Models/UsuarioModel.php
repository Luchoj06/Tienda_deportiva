<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuarioModel extends Model
{
    protected $table            = 'usuarios';   // Nombre de la tabla
    protected $primaryKey       = 'id';         // Clave primaria
    protected $useAutoIncrement = true;

    protected $returnType       = 'array';      // Los datos se devolverán como arrays
    protected $useSoftDeletes   = false;        // Si quisieras "borrado lógico" lo activas aquí

    protected $allowedFields    = ['nombre', 'email', 'password', 'rol'];

    // Timestamps
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
