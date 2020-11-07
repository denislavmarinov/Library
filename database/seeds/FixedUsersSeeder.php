<?php

use Illuminate\Database\Seeder;

class FixedUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	 $users = [
            [
                'first_name' => 'Test',
                'last_name' => 'Testov',
                'role_id' => '1',
                'image' => null,
                'email' => 'test@example.com',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'logged' => '0',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'first_name' => 'Author',
                'last_name' => 'Authorski',
                'role_id' => '3',
                'image' => null,
                'email' => 'author@example.com',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'logged' => '0',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'first_name' => 'Admin',
                'last_name' => 'Adminov',
                'role_id' => '2',
                'image' => null,
                'email' => 'admin@example.com',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'logged' => '0',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];

        DB::table('users')->insert($users);

    }
}
