<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;


class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Test User',
            'email' => 'test@test.com',
            'password' => bcrypt('test1234'),
        ]);
        User::create([
            'name' => 'Andrew Kim',
            'email' => 'akakimmykim@gmail.com',
            'password' => bcrypt('a1234'),
        ]);
    }
}
