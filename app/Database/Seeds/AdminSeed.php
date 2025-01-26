<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AdminSeed extends Seeder
{
    public function run()
    {
        $factories = [
            [
                'name'      => 'Admin',
                'email'     => 'admin@gmail.com',
                'password'  => password_hash('admin', PASSWORD_DEFAULT),
                'role_id'   => 1,
            ],
        ];

        $builder = $this->db->table('users');

        foreach ($factories as $factory) {
            $builder->insert($factory);
        }
    }
}
