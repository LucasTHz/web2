<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateDeposits extends Migration
{
    public function up()
    {
        /*
        id INT AUTO_INCREMENT PRIMARY KEY ,
61 | user_id INT ,
62 | amount DECIMAL (10 , 2) NOT NULL ,
63 | deposited_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ,
64 | FOREIGN KEY ( user_id ) REFERENCES users ( id )
        */

        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'user_id' => [
                'type'     => 'INT',
                'unsigned' => true,
                'null'     => false,
            ],
            'amount' => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
                'null'       => false,
            ],
            'created_at timestamp default current_timestamp',
            'updated_at timestamp default current_timestamp on update current_timestamp',
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('deposits');
    }

    public function down()
    {
        $this->forge->dropTable('deposits');
    }
}
