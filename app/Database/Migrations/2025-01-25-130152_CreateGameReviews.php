<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateGameReviews extends Migration
{
    public function up()
    {
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
            'rating' => [
                'type' => 'INT',
                'null' => false,
            ],
            'review' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'created_at timestamp default current_timestamp',
            'updated_at timestamp default current_timestamp on update current_timestamp',
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('game_id', 'games', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('game_reviews');
    }

    public function down()
    {
        $this->forge->dropTable('game_reviews');
    }
}
