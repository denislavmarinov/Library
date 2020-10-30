<?php

use App\Role;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [
                'role' => 'plain_user'
            ],
            [
                'role' => 'admin'
            ]
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
