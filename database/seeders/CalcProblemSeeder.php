<?php

namespace Database\Seeders;

use App\Models\CalcProblem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CalcProblemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CalcProblem::create([
            'question' => 'Find the derivative of $f(x)=2x$',
            'A' => '$\log{x}$',
            'B' => '$sin(x)$',
            'C' => '$x^2-1$',
            'D' => '$\\frac{2x}{3}$',
            'answer_letter' => 'A',
            'answer' => '$e^x$',
            'difficulty' => 'easy',
            'tutorial_video' => 'www.google.com',
            'collegeboard_unit' => 'Unit 2',
            'tags' => "['power rule', 'derivative rules']",
            'python_file_id' => 1
        ]);
    }
}
