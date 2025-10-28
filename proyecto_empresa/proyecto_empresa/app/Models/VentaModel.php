<?php

namespace App\Models;

use CodeIgniter\Model;

class VentaModel extends Model
{
    protected $table            = 'ventas';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;

    protected $allowedFields    = ['cliente_id', 'usuario_id', 'producto_id', 'cantidad', 'total', 'fecha'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Método opcional con JOIN a productos
    public function getVentasConProductos($clienteId)
    {
        return $this->select('ventas.*, productos.nombre as producto')
                    ->join('productos', 'productos.id = ventas.producto_id')
                    ->where('ventas.cliente_id', $clienteId)
                    ->findAll();
    }
}
