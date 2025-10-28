<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddTipoProductoIdToProductos extends Migration
{
    public function up()
    {
        // Agregar columna si no existe
        if (! $this->db->fieldExists('tipo_producto_id', 'productos')) {
            $this->forge->addColumn('productos', [
                'tipo_producto_id' => [
                    'type'       => 'INT',
                    'constraint' => 11,
                    'unsigned'   => true,
                    'null'       => true,
                    'after'      => 'id',
                ],
            ]);
        }

        // Agregar foreign key (si no existe ya)
        $this->db->query("
            ALTER TABLE productos
            ADD CONSTRAINT fk_productos_tipo
            FOREIGN KEY (tipo_producto_id)
            REFERENCES tipos_productos(id)
            ON UPDATE CASCADE
            ON DELETE SET NULL
        ");
    }

    public function down()
    {
        // Eliminar la FK si existe
        try {
            $this->db->query("ALTER TABLE productos DROP FOREIGN KEY fk_productos_tipo;");
        } catch (\Throwable $e) {
            // ignorar si no existe
        }

        if ($this->db->fieldExists('tipo_producto_id', 'productos')) {
            $this->forge->dropColumn('productos', 'tipo_producto_id');
        }
    }
}
