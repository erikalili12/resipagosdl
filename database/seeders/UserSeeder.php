<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Admin User',
                'username' => 'adminuser',
                'email' => 'admin@gmail.com',
                'role' => 'admin',
                'status' => 'active',
                'password' =>bcrypt('12345678'),
            ],
            [
                'name' => 'Vigilante User',
                'username' => 'vigilanteuser',
                'email' => 'vigilante@gmail.com',
                'role' => 'vigilante',
                'status' => 'active',
                'password' =>bcrypt('12344679'),
            ],
            [
                'name' => 'Oficina user',
                'username' => 'oficina',
                'email' => 'oficina@gmail.com',
                'role' => 'oficina',
                'status' => 'active',
                'password' =>bcrypt('12345677'),
            ]
]);
}
}
