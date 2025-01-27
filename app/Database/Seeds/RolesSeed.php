<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class RolesSeed extends Seeder
{
    public function run()
    {
        $factories = [
            [
                'role_name' => 'Admin',
            ],
            [
                'role_name' => 'Cliente',
            ],
            [
                'role_name' => 'Produtor',
            ]
        ];

        $builder = $this->db->table('user_roles');

        foreach ($factories as $factory) {
            $builder->insert($factory);
        }
    }
}
