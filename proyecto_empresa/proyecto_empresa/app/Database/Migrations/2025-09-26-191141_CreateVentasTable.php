<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateVentas extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'          => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'cliente_id'  => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true], // 🔥 nuevo
            'usuario_id'  => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'producto_id' => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'cantidad'    => ['type' => 'INT', 'constraint' => 11],
            'total'       => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'fecha'       => ['type' => 'DATE'],
            'created_at'  => ['type' => 'DATETIME', 'null' => true],
            'updated_at'  => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('ventas', true);
    }

    public function down()
    {
        $this->forge->dropTable('ventas');
    }
}
