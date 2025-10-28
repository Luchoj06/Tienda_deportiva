<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTiposProductos extends Migration
{
    public function up()
    {
        if (! $this->db->tableExists('tipos_productos')) {
            $this->forge->addField([
                'id' => [
                    'type'           => 'INT',
                    'constraint'     => 11,
                    'unsigned'       => true,
                    'auto_increment' => true,
                ],
                'nombre' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 100,
                ],
                'descripcion' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 255,
                    'null'       => true,
                ],
                'created_at' => [
                    'type' => 'DATETIME',
                    'null' => true,
                ],
                'updated_at' => [
                    'type' => 'DATETIME',
                    'null' => true,
                ],
            ]);

            $this->forge->addKey('id', true);
            $this->forge->createTable('tipos_productos');
        }
    }

    public function down()
    {
        if ($this->db->tableExists('tipos_productos')) {
            $this->forge->dropTable('tipos_productos');
        }
    }
}
