<?php

namespace Database\Seeders;

use App\Models\CalcImage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CalcImagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CalcImage::create([
            'question' => 'app/images/calc/test/image_648582ef1c40a.png',
            'A' => 'app/images/calc/test/image_648582f23cb18.png',
            'B' => 'app/images/calc/test/image_648582f5bc484.png',
            'C' => 'app/images/calc/test/image_648582f949a27.png',
            'D' => 'app/images/calc/test/image_648582fc34574.png',
            'answer' => 'app/images/calc/test/image_648582ff802d3.png',
            'calc_problem_id' => 1
        ]);
    }
}
