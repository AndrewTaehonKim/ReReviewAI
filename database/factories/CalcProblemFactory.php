<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\PythonFile;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CalcProblem>
 */
class CalcProblemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
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
        ];
    }
}
