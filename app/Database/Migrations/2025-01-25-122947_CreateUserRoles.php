<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUserRoles extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'role_name' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'null'       => false,
            ],
            'created_at timestamp default current_timestamp',
            'updated_at timestamp default current_timestamp on update current_timestamp',
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('user_roles');
    }

    public function down()
    {
        $this->forge->dropTable('user_roles');
    }
}
