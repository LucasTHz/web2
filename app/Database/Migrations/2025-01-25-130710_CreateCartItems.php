<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCartItems extends Migration
{
    public function up()
    {
        /*
        id INT AUTO_INCREMENT PRIMARY KEY ,
50 | user_id INT ,
51 | game_id INT ,
52 | quantity INT NOT NULL DEFAULT 1 ,
53 | added_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ,
54 | FOREIGN KEY ( user_id ) REFERENCES users ( id ) ,
55 | FOREIGN KEY ( game_id ) REFERENCES games ( id )
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
            'game_id' => [
                'type'     => 'INT',
                'unsigned' => true,
                'null'     => false,
            ],
            'quantity' => [
                'type'    => 'INT',
                'null'    => false,
                'default' => 1,
            ],
            'created_at timestamp default current_timestamp',
            'updated_at timestamp default current_timestamp on update current_timestamp',
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('game_id', 'games', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('cart_items');
    }

    public function down()
    {
        $this->forge->dropTable('cart_items');
    }
}
