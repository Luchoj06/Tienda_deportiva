<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateProductos extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'          => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'nombre'      => ['type' => 'VARCHAR', 'constraint' => 100],
            'descripcion' => ['type' => 'TEXT', 'null' => true],
            'precio'      => ['type' => 'DECIMAL', 'constraint' => '10,2'],
            'stock'       => ['type' => 'INT', 'constraint' => 11],
            'created_at'  => ['type' => 'DATETIME', 'null' => true],
            'updated_at'  => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('productos', true); 

    }

    public function down()
    {
        $this->forge->dropTable('productos');
    }
}
