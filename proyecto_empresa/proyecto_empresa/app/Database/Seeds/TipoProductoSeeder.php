<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class TipoProductoSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['nombre' => 'Electrónica', 'descripcion' => 'Dispositivos y accesorios'],
            ['nombre' => 'Ropa',        'descripcion' => 'Prendas de vestir'],
            ['nombre' => 'Alimentos',   'descripcion' => 'Comestibles y bebidas'],
        ];

        $this->db->table('tipos_productos')->ignore(true)->insertBatch($data);
    }
}
