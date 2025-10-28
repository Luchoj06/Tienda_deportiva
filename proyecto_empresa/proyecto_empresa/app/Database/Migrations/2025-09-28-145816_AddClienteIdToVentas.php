<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddClienteIdToVentas extends Migration
{
    public function up()
    {
        if (! $this->db->fieldExists('cliente_id', 'ventas')) {
            $this->forge->addColumn('ventas', [
                'cliente_id' => [
                    'type'       => 'INT',
                    'constraint' => 11,
                    'unsigned'   => true,
                    'null'       => true,
                    'after'      => 'id',
                ],
            ]);
        }
    }

    public function down()
    {
        if ($this->db->fieldExists('cliente_id', 'ventas')) {
            $this->forge->dropColumn('ventas', 'cliente_id');
        }
    }
}
