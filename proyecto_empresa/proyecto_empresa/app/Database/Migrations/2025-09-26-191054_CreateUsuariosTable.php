<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUsuariosTable extends Migration
{
    public function up()
{
    $this->forge->addField([
        'id'          => ['type' => 'INT', 'auto_increment' => true],
        'nombre'      => ['type' => 'VARCHAR', 'constraint' => 100],
        'email'       => ['type' => 'VARCHAR', 'constraint' => 100, 'unique' => true],
        'password'    => ['type' => 'VARCHAR', 'constraint' => 255],
        'rol'         => ['type' => 'ENUM("admin","vendedor","cajero")', 'default' => 'vendedor'],
        'created_at'  => ['type' => 'DATETIME', 'null' => true],
        'updated_at'  => ['type' => 'DATETIME', 'null' => true],
    ]);
    $this->forge->addKey('id', true);
    $this->forge->createTable('usuarios', true);

}


    public function down()
    {
        //
    }
}
