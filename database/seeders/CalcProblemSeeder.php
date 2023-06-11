<?php

namespace Database\Seeders;

use App\Models\CalcProblem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PythonFile;

class CalcProblemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CalcProblem::create([
            'question' => 'Solve for $\\frac{dy}{dx}$ given $ y=e^x-cos(x) $',
            'A' => '$\\frac{dy}{dx} = e^x-sin(x)$',
            'B' => '$\\frac{dy}{dx} = e^x+sin(x)$',
            'C' => '$\\frac{dy}{dx} = e^x+cos(x)$',
            'D' => '$\\frac{dy}{dx}$ = $e^{x-1}+sin(x)$',
            'answer_letter' => 'B',
            'answer' => 'The answer is: $\\frac{dy}{dx} = e^x+sin(x)$',
            'difficulty' => 'easy',
            'tutorial_video' => 'https://www.youtube.com/watch?v=uEtl_ZaFx-c&t=1s&ab_channel=Mr.A',
            'collegeboard_unit' => 'Unit 2: Differentiation: Definition and Fundamental Properties',
            'tags' => json_encode(["power_rule"]),
            'python_file_id' => PythonFile::factory()->create()->id
        ]);
    }
}
