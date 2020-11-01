<?php

use App\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
                'role' => 'plain_user',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'role' => 'admin',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'role' => 'author',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];

        DB::table('roles')->insert($roles);
    }
}
