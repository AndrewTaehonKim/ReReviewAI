<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class BetaTesterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Savannah',
            'email' => 'savannac2006@icloud.com',
            'password' => bcrypt('beta1234'),
        ]);
        User::create([
            'name' => 'Sania ',
            'email' => 'saniapanjwani1@gmail.com',
            'password' => bcrypt('beta1234'),
        ]);
        User::create([
            'name' => 'Haniel ',
            'email' => 'hanieljing68@gmail.com@gmail.com',
            'password' => bcrypt('beta1234'),
        ]);
    }
}
